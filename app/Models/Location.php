<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Location extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'welcome_paragraphs' => 'array',
        'welcome_highlights' => 'array',
        'welcome_services' => 'array',
        'process_items' => 'array',
    ];

    public function scopePublished(Builder $query): Builder
    {
        return $query->whereIn('status', [1, '1']);
    }

    /** @return array<string, array<string, mixed>> slug => page data for listing */
    public static function pagesForPublicIndex(): array
    {
        if (! self::tableExists()) {
            return collect(config('location_pages', []))
                ->except(['welcome', 'process'])
                ->filter(fn ($page) => is_array($page) && isset($page['hero']))
                ->all();
        }

        $pages = self::query()
            ->published()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get()
            ->mapWithKeys(fn (self $location) => [$location->slug => $location->toPageArray()])
            ->all();

        return $pages !== [] ? $pages : collect(config('location_pages', []))
            ->except(['welcome', 'process'])
            ->filter(fn ($page) => is_array($page) && isset($page['hero']))
            ->all();
    }

    public static function findPublishedPageBySlug(string $slug): ?array
    {
        if (self::tableExists()) {
            $location = self::query()->published()->where('slug', $slug)->first();
            if ($location) {
                return $location->toPageArray();
            }
        }

        $page = config("location_pages.{$slug}");

        return is_array($page) && isset($page['hero']) ? $page : null;
    }

    /** @return array<int, array{slug: string, label: string}> */
    public static function navItems(): array
    {
        if (self::tableExists()) {
            $items = self::query()
                ->published()
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get(['slug', 'name'])
                ->map(fn (self $location) => [
                    'slug' => $location->slug,
                    'label' => $location->name,
                ])
                ->all();

            if ($items !== []) {
                return $items;
            }
        }

        return collect(config('nav_menus.locations.items', []))
            ->filter(fn ($item) => ! empty($item['slug']))
            ->values()
            ->all();
    }

    /** Same shape as config/location_pages.php entries for Blade views. */
    public function toPageArray(): array
    {
        return [
            'name' => $this->name,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'hero' => [
                'eyebrow' => $this->hero_eyebrow,
                'title_main' => $this->hero_title,
                'lead' => $this->hero_lead,
            ],
            'welcome' => [
                'label' => $this->welcome_label,
                'title' => $this->welcome_title,
                'paragraphs' => self::cleanList($this->welcome_paragraphs),
                'highlights' => self::cleanList($this->welcome_highlights),
                'services' => self::cleanPairs($this->welcome_services),
            ],
            'process' => [
                'label' => $this->process_label,
                'title' => $this->process_title,
                'items' => self::cleanPairs($this->process_items),
            ],
        ];
    }

    public static function listItemsForForm($value, ?array $oldInput = null): array
    {
        if (is_array($oldInput)) {
            $filtered = array_values(array_filter(array_map(
                fn ($v) => is_string($v) ? trim($v) : '',
                $oldInput
            ), fn ($v) => $v !== ''));

            return count($filtered) ? $filtered : [''];
        }

        if (is_array($value)) {
            $filtered = array_values(array_filter(array_map('trim', $value), fn ($v) => $v !== ''));

            return count($filtered) ? $filtered : [''];
        }

        return [''];
    }

    /** @return array<int, array{title: string, text: string}> */
    public static function pairsForForm($value, ?array $oldInput = null): array
    {
        $source = is_array($oldInput) ? $oldInput : (is_array($value) ? $value : []);
        $pairs = [];

        foreach ($source as $item) {
            if (! is_array($item)) {
                continue;
            }
            $title = trim((string) ($item['title'] ?? ''));
            $text = trim((string) ($item['text'] ?? ''));
            if ($title === '' && $text === '') {
                continue;
            }
            $pairs[] = ['title' => $title, 'text' => $text];
        }

        return $pairs !== [] ? $pairs : [['title' => '', 'text' => '']];
    }

    public static function normalizeList(?array $items): array
    {
        return array_values(array_filter(array_map(
            fn ($item) => is_string($item) ? trim($item) : '',
            $items ?? []
        ), fn ($item) => $item !== ''));
    }

    /** @param  array<int, array<string, mixed>>|null  $items */
    public static function normalizePairs(?array $items): array
    {
        $pairs = [];

        foreach ($items ?? [] as $item) {
            if (! is_array($item)) {
                continue;
            }
            $title = trim((string) ($item['title'] ?? ''));
            $text = trim((string) ($item['text'] ?? ''));
            if ($title === '' || $text === '') {
                continue;
            }
            $pairs[] = ['title' => $title, 'text' => $text];
        }

        return $pairs;
    }

    public static function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($name) ?: 'location';
        $slug = $base;
        $counter = 2;

        while (
            self::query()
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = $base . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    public function publicUrl(): string
    {
        return url('/' . ltrim($this->slug, '/'));
    }

    public function cardImageUrl(): string
    {
        if ($this->image) {
            return asset('admin/assets/images/locations/' . $this->image);
        }

        return asset('assets/website/images/hero-wellness.jpg');
    }

    /** @param  mixed  $list */
    private static function cleanList($list): array
    {
        return self::normalizeList(is_array($list) ? $list : []);
    }

    /** @param  mixed  $pairs */
    private static function cleanPairs($pairs): array
    {
        return self::normalizePairs(is_array($pairs) ? $pairs : []);
    }

    private static function tableExists(): bool
    {
        try {
            return \Illuminate\Support\Facades\Schema::hasTable('locations');
        } catch (\Throwable) {
            return false;
        }
    }
}
