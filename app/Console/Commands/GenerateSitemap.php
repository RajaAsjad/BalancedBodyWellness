<?php

namespace App\Console\Commands;

use App\Support\SitemapBuilder;
use Illuminate\Console\Command;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate {--url= : Base site URL (defaults to APP_URL)}';

    protected $description = 'Optional: write a static copy to public/sitemap.xml (dynamic /sitemap.xml updates automatically)';

    public function handle(): int
    {
        $baseUrl = $this->option('url') ?: SitemapBuilder::baseUrl();
        $xml = SitemapBuilder::xml($baseUrl);
        $path = public_path('sitemap.xml');

        file_put_contents($path, $xml);

        $count = substr_count($xml, '<url>');
        $this->info("Sitemap written to {$path} ({$count} URLs, base: {$baseUrl})");

        return self::SUCCESS;
    }
}
