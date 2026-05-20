<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $routes = config('seo.sitemap_routes', []);
        $urls = [];

        foreach ($routes as $routeName => $meta) {
            if (! \Illuminate\Support\Facades\Route::has($routeName)) {
                continue;
            }
            $urls[] = [
                'loc' => route($routeName),
                'lastmod' => now()->toAtomString(),
                'changefreq' => $meta['changefreq'] ?? 'monthly',
                'priority' => $meta['priority'] ?? '0.5',
            ];
        }

        return response()
            ->view('sitemap.index', compact('urls'))
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}
