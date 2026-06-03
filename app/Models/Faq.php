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

    public const PAGE_LOCATION_DETAIL = 'location-detail';

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
            'location-detail' => 'Location page',
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

        if ($this->page_key === self::PAGE_SERVICE_DETAIL) {
            if ($this->service_slug) {
                $name = self::landingPageLabel($this->service_slug);
                if ($name) {
                    return $label . ' — ' . $name;
                }
            }

            if ($this->service_id) {
                $name = $this->relationLoaded('service')
                    ? ($this->service?->heading)
                    : Services::query()->whereKey($this->service_id)->value('heading');

                if ($name) {
                    return $label . ' — ' . $name;
                }
            }
        }

        if ($this->page_key === self::PAGE_LOCATION_DETAIL && $this->location_slug) {
            $name = self::locationLandingPageLabel($this->location_slug);
            if ($name) {
                return $label . ' — ' . $name;
            }
        }

        return $label;
    }

    /** Label for a config / nav service landing page slug. */
    public static function landingPageLabel(?string $slug): ?string
    {
        if (! $slug) {
            return null;
        }

        $fromNav = collect(config('nav_menus.services.items', []))->firstWhere('slug', $slug);
        if ($fromNav && ! empty($fromNav['label'])) {
            return $fromNav['label'];
        }

        $page = config("service_pages.{$slug}");

        return $page['name'] ?? null;
    }

    /** @return array<int, array{slug: string, label: string}> */
    public static function serviceLandingPagesForPicker(): array
    {
        $items = [];

        foreach (config('nav_menus.services.items', []) as $item) {
            if (empty($item['slug'])) {
                continue;
            }
            $items[] = [
                'slug' => $item['slug'],
                'label' => $item['label'] ?? $item['slug'],
            ];
        }

        foreach (config('service_pages', []) as $slug => $page) {
            if (collect($items)->contains('slug', $slug)) {
                continue;
            }
            $items[] = [
                'slug' => $slug,
                'label' => $page['name'] ?? $slug,
            ];
        }

        return $items;
    }

    public static function locationLandingPageLabel(?string $slug): ?string
    {
        if (! $slug) {
            return null;
        }

        try {
            $location = \App\Models\Location::query()->where('slug', $slug)->first();
            if ($location) {
                return $location->name;
            }
        } catch (\Throwable) {
        }

        $fromNav = collect(config('nav_menus.locations.items', []))->firstWhere('slug', $slug);
        if ($fromNav && ! empty($fromNav['label'])) {
            return $fromNav['label'];
        }

        $page = config("location_pages.{$slug}");

        return $page['name'] ?? null;
    }

    /** @return array<int, array{slug: string, label: string}> */
    public static function locationLandingPagesForPicker(): array
    {
        try {
            $fromDb = \App\Models\Location::query()
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get(['slug', 'name']);

            if ($fromDb->isNotEmpty()) {
                return $fromDb->map(fn ($location) => [
                    'slug' => $location->slug,
                    'label' => $location->name,
                ])->all();
            }
        } catch (\Throwable) {
        }

        $items = [];

        foreach (config('nav_menus.locations.items', []) as $item) {
            if (empty($item['slug'])) {
                continue;
            }
            $items[] = [
                'slug' => $item['slug'],
                'label' => $item['label'] ?? $item['slug'],
            ];
        }

        foreach (config('location_pages', []) as $slug => $page) {
            if (in_array($slug, ['welcome', 'process'], true)) {
                continue;
            }
            if (collect($items)->contains('slug', $slug)) {
                continue;
            }
            if (! is_array($page) || ! isset($page['hero'])) {
                continue;
            }
            $items[] = [
                'slug' => $slug,
                'label' => $page['name'] ?? $slug,
            ];
        }

        return $items;
    }

    /** Title for a FAQ group on the public /faqs page. */
    public static function groupSectionTitle(string $groupKey, Collection $faqs): string
    {
        $first = $faqs->first();
        if (! $first) {
            return self::pageLabel($groupKey);
        }

        if ($first->page_key === self::PAGE_SERVICE_DETAIL) {
            if ($first->service_slug) {
                $name = self::landingPageLabel($first->service_slug);

                return 'Service: ' . ($name ?: $first->service_slug);
            }

            if ($first->service_id) {
                $name = $first->relationLoaded('service')
                    ? ($first->service?->heading)
                    : Services::query()->whereKey($first->service_id)->value('heading');

                return 'Service: ' . ($name ?: 'Unknown service');
            }
        }

        if ($first->page_key === self::PAGE_LOCATION_DETAIL && $first->location_slug) {
            $name = self::locationLandingPageLabel($first->location_slug);

            return 'Location: ' . ($name ?: $first->location_slug);
        }

        return self::pageLabel($first->page_key);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->whereIn('status', [1, '1']);
    }

    public static function forPage(
        string $pageKey,
        ?int $serviceId = null,
        ?string $serviceSlug = null,
        ?string $locationSlug = null
    ): Builder {
        $query = static::query()
            ->active()
            ->where('page_key', $pageKey);

        if ($pageKey === self::PAGE_SERVICE_DETAIL) {
            $slug = $serviceSlug ? trim($serviceSlug) : null;

            if ($slug !== null && $slug !== '') {
                $query->where(function (Builder $q) use ($slug, $serviceId) {
                    $q->where('service_slug', $slug);
                    if ($serviceId) {
                        $q->orWhere('service_id', $serviceId);
                    }
                });
            } elseif ($serviceId) {
                $query->where('service_id', $serviceId);
            } else {
                $query->whereNull('service_id')->whereNull('service_slug');
            }

            $query->whereNull('location_slug');
        } elseif ($pageKey === self::PAGE_LOCATION_DETAIL) {
            $slug = $locationSlug ? trim($locationSlug) : null;

            if ($slug !== null && $slug !== '') {
                $query->where('location_slug', $slug);
            } else {
                $query->whereNull('location_slug');
            }

            $query->whereNull('service_id')->whereNull('service_slug');
        } else {
            $query->whereNull('service_id')
                ->whereNull('service_slug')
                ->whereNull('location_slug');
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
            ->orderBy('location_slug')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $groups = [];

        foreach ($faqs as $faq) {
            $key = match (true) {
                $faq->page_key === self::PAGE_SERVICE_DETAIL && $faq->service_slug
                    => self::PAGE_SERVICE_DETAIL . ':' . $faq->service_slug,
                $faq->page_key === self::PAGE_SERVICE_DETAIL && $faq->service_id
                    => self::PAGE_SERVICE_DETAIL . ':' . $faq->service_id,
                $faq->page_key === self::PAGE_LOCATION_DETAIL && $faq->location_slug
                    => self::PAGE_LOCATION_DETAIL . ':' . $faq->location_slug,
                default => $faq->page_key,
            };

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
