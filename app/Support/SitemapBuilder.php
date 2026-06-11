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

        foreach (ServicePageRegistry::publishedSlugs() as $slug) {
            $urls[] = self::entry(
                self::absoluteUrl($baseUrl, route('service.detail', ['slug' => $slug], false)),
                [
                    'priority' => '0.85',
                    'changefreq' => 'monthly',
                    'lastmod' => self::serviceLastmod($slug),
                ]
            );
        }

        foreach (self::locationSlugs() as $slug) {
            $urls[] = self::entry(self::absoluteUrl($baseUrl, route('service.detail', ['slug' => $slug], false)), [
                'priority' => '0.8',
                'changefreq' => 'monthly',
            ]);
        }

        return self::dedupe($urls);
    }

    private static function serviceLastmod(string $slug): ?string
    {
        $service = Services::query()
            ->whereIn('status', [1, '1'])
            ->get(['heading', 'updated_at'])
            ->first(fn (Services $item) => Str::slug((string) $item->heading) === $slug);

        return $service?->updated_at?->toAtomString();
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
        $url = rtrim((string) config('seo.canonical_url', config('app.url')), '/');

        if ($url === '') {
            $url = 'https://balancedbodyivwellness.com';
        }

        if (app()->environment('production') && str_starts_with($url, 'http://')) {
            $url = 'https://'.(parse_url($url, PHP_URL_HOST) ?: 'balancedbodyivwellness.com');
        }

        return self::withoutWwwHost($url);
    }

    private static function withoutWwwHost(string $url): string
    {
        $parts = parse_url($url);
        if (! is_array($parts) || empty($parts['host'])) {
            return preg_replace('#(https?://)www\.#i', '$1', $url) ?: $url;
        }

        $scheme = app()->environment('production') ? 'https' : ($parts['scheme'] ?? 'https');
        $host = preg_replace('/^www\./i', '', $parts['host']);
        $port = isset($parts['port']) ? ':'.$parts['port'] : '';

        return $scheme.'://'.$host.$port;
    }

    private static function normalizeLoc(string $loc): string
    {
        return self::withoutWwwHost($loc);
    }

    /**
     * @param  array<string, string>  $meta
     * @return array{loc: string, lastmod: string, changefreq: string, priority: string}
     */
    private static function entry(string $loc, array $meta): array
    {
        return [
            'loc' => self::normalizeLoc($loc),
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
