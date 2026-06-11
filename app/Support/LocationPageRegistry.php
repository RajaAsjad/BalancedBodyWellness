<?php

namespace App\Support;

use App\Models\Location;
use Illuminate\Support\Facades\Schema;

class LocationPageRegistry
{
    /** @return list<string> */
    public static function publishedSlugs(): array
    {
        try {
            if (Schema::hasTable('locations')) {
                $fromDb = Location::query()
                    ->published()
                    ->orderBy('sort_order')
                    ->orderBy('name')
                    ->pluck('slug')
                    ->filter()
                    ->values()
                    ->all();

                if ($fromDb !== []) {
                    return $fromDb;
                }
            }
        } catch (\Throwable) {
        }

        return self::configSlugs();
    }

    /** @return list<string> */
    public static function configSlugs(): array
    {
        return collect(array_keys(config('location_pages', [])))
            ->reject(fn ($slug) => in_array($slug, ['welcome', 'process'], true))
            ->filter(fn ($slug) => is_array(config("location_pages.{$slug}")) && isset(config("location_pages.{$slug}")['hero']))
            ->values()
            ->all();
    }

    /** @param  list<string>  $slugs */
    public static function routePattern(array $slugs): string
    {
        return implode('|', array_map('preg_quote', $slugs));
    }
}
