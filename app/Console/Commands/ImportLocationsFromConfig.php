<?php

namespace App\Console\Commands;

use App\Models\Location;
use App\Support\LocationPageRegistry;
use Illuminate\Console\Command;

class ImportLocationsFromConfig extends Command
{
    protected $signature = 'locations:import-config {--force : Overwrite existing location records}';

    protected $description = 'Import location landing pages from config/location_pages.php into the database';

    public function handle(): int
    {
        $navOrder = collect(config('nav_menus.locations.items', []))
            ->pluck('label', 'slug');

        $imported = 0;

        foreach (LocationPageRegistry::configSlugs() as $index => $slug) {
            $page = config("location_pages.{$slug}");
            if (! is_array($page)) {
                continue;
            }

            $existing = Location::where('slug', $slug)->first();
            if ($existing && ! $this->option('force')) {
                $this->line("Skipped (exists): {$slug}");
                continue;
            }

            $hero = $page['hero'] ?? [];
            $welcome = $page['welcome'] ?? [];
            $process = $page['process'] ?? [];

            Location::updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $page['name'] ?? ($navOrder[$slug] ?? $slug),
                    'meta_title' => $page['meta_title'] ?? null,
                    'meta_description' => $page['meta_description'] ?? null,
                    'hero_eyebrow' => $hero['eyebrow'] ?? null,
                    'hero_title' => $hero['title_main'] ?? null,
                    'hero_lead' => $hero['lead'] ?? null,
                    'welcome_label' => $welcome['label'] ?? null,
                    'welcome_title' => $welcome['title'] ?? null,
                    'welcome_paragraphs' => $welcome['paragraphs'] ?? [],
                    'welcome_highlights' => $welcome['highlights'] ?? [],
                    'welcome_services' => $welcome['services'] ?? [],
                    'process_label' => $process['label'] ?? null,
                    'process_title' => $process['title'] ?? null,
                    'process_items' => $process['items'] ?? [],
                    'sort_order' => $index + 1,
                    'status' => 1,
                ]
            );

            $imported++;
            $this->info("Imported: {$slug}");
        }

        $this->info("Done. {$imported} location page(s) imported.");

        return self::SUCCESS;
    }
}
