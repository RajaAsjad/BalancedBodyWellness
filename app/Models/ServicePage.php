<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class ServicePage extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'hero' => 'array',
        'overview' => 'array',
        'drip_menu' => 'array',
        'supports' => 'array',
        'show_in_nav' => 'boolean',
        'is_legacy' => 'boolean',
    ];

    public function scopePublished(Builder $query): Builder
    {
        return $query->whereIn('status', [1, '1']);
    }

    public function scopeVisibleInNav(Builder $query): Builder
    {
        return $query->where('show_in_nav', true);
    }

    /** @return array<int, array{slug: string, label: string}> */
    public static function navItems(): array
    {
        if (self::tableExists()) {
            return self::query()
                ->published()
                ->visibleInNav()
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get(['slug', 'nav_label', 'name'])
                ->map(fn (self $page) => [
                    'slug' => $page->slug,
                    'label' => $page->nav_label ?: $page->name,
                ])
                ->all();
        }

        return collect(config('nav_menus.services.items', []))
            ->filter(fn ($item) => ! empty($item['slug']))
            ->values()
            ->all();
    }

    public static function findPublishedPageBySlug(string $slug): ?array
    {
        if (! self::tableExists()) {
            return null;
        }

        $page = self::query()->published()->where('slug', $slug)->first();

        return $page ? $page->toPageArray() : null;
    }

    public static function findBySlug(string $slug): ?self
    {
        if (! self::tableExists()) {
            return null;
        }

        return self::query()->where('slug', $slug)->first();
    }

    /** Same shape as config/service_pages.php entries for Blade views. */
    public function toPageArray(): array
    {
        $page = [
            'name' => $this->name,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
        ];

        if (is_array($this->hero) && $this->hero !== []) {
            $page['hero'] = $this->hero;
        }

        if (is_array($this->overview) && $this->overview !== []) {
            $page['overview'] = $this->overview;
        }

        if (is_array($this->drip_menu) && $this->drip_menu !== []) {
            $page['drip_menu'] = $this->drip_menu;
        }

        if (is_array($this->supports) && $this->supports !== []) {
            $page['supports'] = $this->supports;
        }

        return $page;
    }

    public static function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($name) ?: 'service';
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

    /** @return array<int, array{value: string, label: string, serif: bool}> */
    public static function statsForForm($value, ?array $oldInput = null): array
    {
        $source = is_array($oldInput) ? $oldInput : (is_array($value) ? $value : []);
        $stats = [];

        foreach ($source as $item) {
            if (! is_array($item)) {
                continue;
            }
            $statValue = trim((string) ($item['value'] ?? ''));
            $label = trim((string) ($item['label'] ?? ''));
            if ($statValue === '' && $label === '') {
                continue;
            }
            $stats[] = [
                'value' => $statValue,
                'label' => $label,
                'serif' => ! empty($item['serif']),
            ];
        }

        return $stats !== [] ? $stats : [['value' => '', 'label' => '', 'serif' => false]];
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

    /** @param  array<int, array<string, mixed>>|null  $items */
    public static function normalizeStats(?array $items): array
    {
        $stats = [];

        foreach ($items ?? [] as $item) {
            if (! is_array($item)) {
                continue;
            }
            $value = trim((string) ($item['value'] ?? ''));
            $label = trim((string) ($item['label'] ?? ''));
            if ($value === '' || $label === '') {
                continue;
            }
            $stat = ['value' => $value, 'label' => $label];
            if (! empty($item['serif'])) {
                $stat['serif'] = true;
            }
            $stats[] = $stat;
        }

        return $stats;
    }

    /** @param  array<string, mixed>  $input */
    public static function buildHeroFromInput(array $input): array
    {
        $style = trim((string) ($input['hero_title_style'] ?? ''));
        $hero = array_filter([
            'eyebrow' => trim((string) ($input['hero_eyebrow'] ?? '')),
            'title_style' => $style !== '' && $style !== 'standard' ? $style : null,
            'title_prefix' => trim((string) ($input['hero_title_prefix'] ?? '')),
            'title_main' => trim((string) ($input['hero_title_main'] ?? '')),
            'title_accent' => trim((string) ($input['hero_title_accent'] ?? '')),
            'title_suffix' => trim((string) ($input['hero_title_suffix'] ?? '')),
            'lead' => trim((string) ($input['hero_lead'] ?? '')),
        ], fn ($v) => $v !== '');

        return $hero;
    }

    /** @param  array<string, mixed>  $input */
    public static function buildOverviewFromInput(array $input): array
    {
        $overview = [];

        $label = trim((string) ($input['overview_label'] ?? ''));
        $title = trim((string) ($input['overview_title'] ?? ''));
        if ($label !== '') {
            $overview['label'] = $label;
        }
        if ($title !== '') {
            $overview['title'] = $title;
        }

        $paragraphs = self::normalizeList($input['overview_paragraphs'] ?? []);
        if ($paragraphs !== []) {
            $overview['paragraphs'] = $paragraphs;
        }

        $features = self::normalizePairs($input['overview_features'] ?? []);
        if ($features !== []) {
            $overview['features'] = $features;
        }

        return $overview;
    }

    /** @param  array<string, mixed>  $input */
    public static function buildDripMenuFromInput(array $input): ?array
    {
        $title = trim((string) ($input['drip_menu_title'] ?? ''));
        $items = self::normalizePairs($input['drip_menu_items'] ?? []);

        if ($title === '' && $items === []) {
            return null;
        }

        $menu = [];
        if ($title !== '') {
            $menu['title'] = $title;
        }
        if ($items !== []) {
            $menu['items'] = $items;
        }

        return $menu;
    }

    /** @param  array<string, mixed>  $input */
    public static function buildSupportsFromInput(array $input): array
    {
        $supports = [];

        foreach (['supports_label' => 'label', 'supports_title' => 'title', 'supports_lead' => 'lead'] as $key => $field) {
            $value = trim((string) ($input[$key] ?? ''));
            if ($value !== '') {
                $supports[$field] = $value;
            }
        }

        $items = self::normalizePairs($input['supports_items'] ?? []);
        if ($items !== []) {
            $supports['items'] = $items;
        }

        $stats = self::normalizeStats($input['supports_stats'] ?? []);
        if ($stats !== []) {
            $supports['stats'] = $stats;
        }

        return $supports;
    }

    public static function tableExists(): bool
    {
        try {
            return Schema::hasTable('service_pages');
        } catch (\Throwable) {
            return false;
        }
    }
}
