<?php

namespace App\Console\Commands;

use App\Models\ServicePage;
use Illuminate\Console\Command;

class ImportServicePagesFromConfig extends Command
{
    protected $signature = 'service-pages:import-config {--force : Overwrite existing service page records}';

    protected $description = 'Import service landing pages from config/service_pages.php into the database';

    public function handle(): int
    {
        $pages = $this->configPages();
        $slugs = $this->pageSlugs($pages);

        if ($slugs === []) {
            $this->error('No service pages found in config/service_pages.php.');
            $this->line('');
            $this->line('Common fixes on live:');
            $this->line('  1. Upload config/service_pages.php to the server (full file with page data).');
            $this->line('  2. Run: php artisan config:clear');
            $this->line('  3. Re-run: php artisan service-pages:import-config --force');
            $this->line('');
            $this->line('Config path: ' . config_path('service_pages.php'));
            $this->line('File exists: ' . (is_file(config_path('service_pages.php')) ? 'yes' : 'no'));

            return self::FAILURE;
        }

        $navLabels = collect(config('nav_menus.services.items', []))
            ->pluck('label', 'slug');

        $imported = 0;

        foreach ($slugs as $index => $slug) {
            $page = $pages[$slug] ?? null;
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

    /** @return array<string, array<string, mixed>> */
    private function configPages(): array
    {
        $pages = config('service_pages', []);
        if (is_array($pages) && $pages !== []) {
            return $pages;
        }

        $path = config_path('service_pages.php');
        if (! is_file($path)) {
            return [];
        }

        $pages = require $path;

        return is_array($pages) ? $pages : [];
    }

    /** @param  array<string, mixed>  $pages */
    private function pageSlugs(array $pages): array
    {
        return collect(array_keys($pages))
            ->filter(fn ($slug) => is_string($slug) && $slug !== '' && is_array($pages[$slug]))
            ->values()
            ->all();
    }
}
