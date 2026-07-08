<?php

namespace App\Support;

use App\Models\ServicePage;
use App\Models\Services;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class ServicePageRegistry
{
    /** @return list<string> */
    public static function publishedSlugs(): array
    {
        $slugs = [];

        try {
            if (Schema::hasTable('service_pages')) {
                foreach (
                    ServicePage::query()
                        ->published()
                        ->orderBy('sort_order')
                        ->orderBy('name')
                        ->pluck('slug') as $slug
                ) {
                    if (is_string($slug) && $slug !== '') {
                        $slugs[$slug] = true;
                    }
                }
            }
        } catch (\Throwable) {
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

    /** @return list<string> Slugs from config/service_pages.php (import command only). */
    public static function configSlugs(): array
    {
        return collect(array_keys(config('service_pages', [])))
            ->filter(fn ($slug) => is_string($slug) && $slug !== '' && is_array(config("service_pages.{$slug}")))
            ->values()
            ->all();
    }

    /** @param  list<string>  $slugs */
    public static function routePattern(array $slugs): string
    {
        return implode('|', array_map('preg_quote', $slugs));
    }
}
