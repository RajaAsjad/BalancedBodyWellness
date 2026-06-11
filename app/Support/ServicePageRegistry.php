<?php

namespace App\Support;

use App\Models\Services;
use Illuminate\Support\Str;

class ServicePageRegistry
{
    /** @return list<string> */
    public static function publishedSlugs(): array
    {
        $slugs = [];

        foreach (array_keys(config('service_pages', [])) as $slug) {
            if (is_string($slug) && $slug !== '') {
                $slugs[$slug] = true;
            }
        }

        foreach (config('nav_menus.services.items', []) as $item) {
            $slug = $item['slug'] ?? '';
            if (is_string($slug) && $slug !== '') {
                $slugs[$slug] = true;
            }
        }

        Services::query()
            ->whereIn('status', [1, '1'])
            ->orderBy('id')
            ->pluck('heading')
            ->each(function ($heading) use (&$slugs) {
                $slug = Str::slug((string) $heading);
                if ($slug !== '') {
                    $slugs[$slug] = true;
                }
            });

        return array_values(array_keys($slugs));
    }

    /** @param  list<string>  $slugs */
    public static function routePattern(array $slugs): string
    {
        return implode('|', array_map('preg_quote', $slugs));
    }
}
