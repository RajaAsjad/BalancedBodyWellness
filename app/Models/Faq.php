<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

class Faq extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public const PAGE_SERVICE_DETAIL = 'service-detail';

    /** @return array<string, string> */
    public static function pageOptions(): array
    {
        $pages = config('faq_pages');

        if (is_array($pages) && $pages !== []) {
            return $pages;
        }

        return [
            'home' => 'Home',
            'services' => 'Services',
            'service-detail' => 'Service detail page',
            'about-us' => 'About Us',
            'locations' => 'Locations',
            'contact' => 'Contact',
            'policies' => 'Policies',
            'faqs' => 'FAQs page (full list)',
        ];
    }

    public static function pageLabel(?string $pageKey): string
    {
        $options = self::pageOptions();

        return $options[$pageKey] ?? ($pageKey ?: '—');
    }

    /** Admin table / show: page + service name when applicable. */
    public function displayPageLabel(): string
    {
        $label = self::pageLabel($this->page_key);

        if ($this->page_key === self::PAGE_SERVICE_DETAIL && $this->service_id) {
            $name = $this->relationLoaded('service')
                ? ($this->service?->heading)
                : Services::query()->whereKey($this->service_id)->value('heading');

            if ($name) {
                return $label . ' — ' . $name;
            }
        }

        return $label;
    }

    /** Title for a FAQ group on the public /faqs page. */
    public static function groupSectionTitle(string $groupKey, Collection $faqs): string
    {
        $first = $faqs->first();
        if (! $first) {
            return self::pageLabel($groupKey);
        }

        if ($first->page_key === self::PAGE_SERVICE_DETAIL && $first->service_id) {
            $name = $first->relationLoaded('service')
                ? ($first->service?->heading)
                : Services::query()->whereKey($first->service_id)->value('heading');

            return 'Service: ' . ($name ?: 'Unknown service');
        }

        return self::pageLabel($first->page_key);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->whereIn('status', [1, '1']);
    }

    public static function forPage(string $pageKey, ?int $serviceId = null): Builder
    {
        $query = static::query()
            ->active()
            ->where('page_key', $pageKey);

        if ($pageKey === self::PAGE_SERVICE_DETAIL) {
            if ($serviceId) {
                $query->where('service_id', $serviceId);
            } else {
                $query->whereNull('service_id');
            }
        } else {
            $query->whereNull('service_id');
        }

        return $query->orderBy('sort_order')->orderBy('id');
    }

    /**
     * FAQs for public /faqs page, grouped by page (service-detail split per service).
     *
     * @return Collection<string, Collection<int, self>>
     */
    public static function groupedForPublicIndex(): Collection
    {
        $faqs = static::query()
            ->active()
            ->with('service')
            ->orderBy('page_key')
            ->orderBy('service_id')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $groups = [];

        foreach ($faqs as $faq) {
            $key = $faq->page_key === self::PAGE_SERVICE_DETAIL && $faq->service_id
                ? self::PAGE_SERVICE_DETAIL . ':' . $faq->service_id
                : $faq->page_key;

            if (! isset($groups[$key])) {
                $groups[$key] = collect();
            }
            $groups[$key]->push($faq);
        }

        return collect($groups);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Services::class, 'service_id');
    }

    public function hasCreatedBy()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
}
