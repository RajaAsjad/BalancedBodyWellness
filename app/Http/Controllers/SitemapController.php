<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $urls = [];

        foreach (config('seo.sitemap_routes', []) as $routeName => $meta) {
            if (! Route::has($routeName)) {
                continue;
            }
            $urls[] = $this->urlEntry(route($routeName), $meta);
        }

        foreach (config('nav_menus.services.items', []) as $item) {
            if (empty($item['slug'])) {
                continue;
            }
            $urls[] = $this->urlEntry(route('service.detail', $item['slug']), [
                'priority' => '0.85',
                'changefreq' => 'monthly',
            ]);
        }

        foreach (array_keys(config('location_pages', [])) as $slug) {
            $urls[] = $this->urlEntry(route('location.page', ['slug' => $slug]), [
                'priority' => '0.8',
                'changefreq' => 'monthly',
            ]);
        }

        return response()
            ->view('sitemap.index', compact('urls'))
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    /**
     * @param  array<string, string>  $meta
     * @return array<string, string>
     */
    private function urlEntry(string $loc, array $meta): array
    {
        return [
            'loc' => $loc,
            'lastmod' => now()->toAtomString(),
            'changefreq' => $meta['changefreq'] ?? 'monthly',
            'priority' => $meta['priority'] ?? '0.5',
        ];
    }
}
