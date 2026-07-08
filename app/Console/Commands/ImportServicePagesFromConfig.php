<?php

namespace App\Console\Commands;

use App\Models\ServicePage;
use App\Support\ServicePageRegistry;
use Illuminate\Console\Command;

class ImportServicePagesFromConfig extends Command
{
    protected $signature = 'service-pages:import-config {--force : Overwrite existing service page records}';

    protected $description = 'Import service landing pages from config/service_pages.php into the database';

    public function handle(): int
    {
        $navLabels = collect(config('nav_menus.services.items', []))
            ->pluck('label', 'slug');

        $imported = 0;

        foreach (ServicePageRegistry::configSlugs() as $index => $slug) {
            $page = config("service_pages.{$slug}");
            if (! is_array($page)) {
                continue;
            }

            $existing = ServicePage::where('slug', $slug)->first();
            if ($existing && ! $this->option('force')) {
                $this->line("Skipped (exists): {$slug}");
                continue;
            }

            ServicePage::updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $page['name'] ?? ($navLabels[$slug] ?? $slug),
                    'nav_label' => $navLabels[$slug] ?? null,
                    'meta_title' => $page['meta_title'] ?? null,
                    'meta_description' => $page['meta_description'] ?? null,
                    'hero' => $page['hero'] ?? [],
                    'overview' => $page['overview'] ?? [],
                    'drip_menu' => $page['drip_menu'] ?? null,
                    'supports' => $page['supports'] ?? [],
                    'sort_order' => $index + 1,
                    'show_in_nav' => true,
                    'is_legacy' => true,
                    'status' => 1,
                ]
            );

            $imported++;
            $this->info("Imported: {$slug}");
        }

        $this->info("Done. {$imported} service page(s) imported.");

        return self::SUCCESS;
    }
}
