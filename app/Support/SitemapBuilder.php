<?php

namespace App\Support;

use App\Models\Services;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class SitemapBuilder
{
    /**
     * @return list<array{loc: string, lastmod: string, changefreq: string, priority: string}>
     */
    public static function urls(?string $baseUrl = null): array
    {
        $urls = [];
        $baseUrl = rtrim($baseUrl ?: self::baseUrl(), '/');

        foreach (config('seo.sitemap_routes', []) as $routeName => $meta) {
            if (! Route::has($routeName)) {
                continue;
            }

            $urls[] = self::entry(self::absoluteUrl($baseUrl, route($routeName, [], false)), $meta);
        }

        foreach (self::serviceSlugs() as $slug => $lastmod) {
            $urls[] = self::entry(
                self::absoluteUrl($baseUrl, route('service.detail', ['slug' => $slug], false)),
                [
                    'priority' => '0.85',
                    'changefreq' => 'monthly',
                    'lastmod' => $lastmod,
                ]
            );
        }

        foreach (self::locationSlugs() as $slug) {
            $urls[] = self::entry(self::absoluteUrl($baseUrl, route('location.page', ['slug' => $slug], false)), [
                'priority' => '0.8',
                'changefreq' => 'monthly',
            ]);
        }

        return self::dedupe($urls);
    }

    /**
     * Service page slugs => optional lastmod (from admin DB record).
     *
     * @return array<string, string|null>
     */
    private static function serviceSlugs(): array
    {
        $slugs = [];

        foreach (array_keys(config('service_pages', [])) as $slug) {
            if ($slug !== '') {
                $slugs[$slug] = null;
            }
        }

        foreach (config('nav_menus.services.items', []) as $item) {
            $slug = $item['slug'] ?? '';
            if ($slug !== '') {
                $slugs[$slug] = null;
            }
        }

        Services::query()
            ->whereIn('status', [1, '1'])
            ->orderBy('id')
            ->get(['heading', 'updated_at'])
            ->each(function (Services $service) use (&$slugs) {
                $slug = Str::slug((string) $service->heading);
                if ($slug === '') {
                    return;
                }

                $lastmod = $service->updated_at?->toAtomString();
                if (! isset($slugs[$slug]) || $lastmod !== null) {
                    $slugs[$slug] = $lastmod ?? ($slugs[$slug] ?? null);
                }
            });

        return $slugs;
    }

    /** @return list<string> */
    private static function locationSlugs(): array
    {
        return LocationPageRegistry::publishedSlugs();
    }

    public static function xml(?string $baseUrl = null): string
    {
        return view('sitemap.index', [
            'urls' => self::urls($baseUrl),
        ])->render();
    }

    public static function baseUrl(): string
    {
        $url = rtrim((string) config('app.url'), '/');

        if ($url === '') {
            $url = 'https://balancedbodyivwellness.com';
        }

        if (app()->environment('production') && str_starts_with($url, 'http://')) {
            $url = 'https://'.(parse_url($url, PHP_URL_HOST) ?: 'balancedbodyivwellness.com');
        }

        return $url;
    }

    /**
     * @param  array<string, string>  $meta
     * @return array{loc: string, lastmod: string, changefreq: string, priority: string}
     */
    private static function entry(string $loc, array $meta): array
    {
        return [
            'loc' => $loc,
            'lastmod' => $meta['lastmod'] ?? now()->toAtomString(),
            'changefreq' => $meta['changefreq'] ?? 'monthly',
            'priority' => $meta['priority'] ?? '0.5',
        ];
    }

    private static function absoluteUrl(string $baseUrl, string $path): string
    {
        if ($path === '' || $path === '/') {
            return $baseUrl.'/';
        }

        return $baseUrl.'/'.ltrim($path, '/');
    }

    /**
     * @param  list<array{loc: string, lastmod: string, changefreq: string, priority: string}>  $urls
     * @return list<array{loc: string, lastmod: string, changefreq: string, priority: string}>
     */
    private static function dedupe(array $urls): array
    {
        $seen = [];
        $unique = [];

        foreach ($urls as $url) {
            $loc = rtrim($url['loc'], '/');

            if (isset($seen[$loc])) {
                continue;
            }

            $seen[$loc] = true;
            $unique[] = $url;
        }

        return $unique;
    }
}
