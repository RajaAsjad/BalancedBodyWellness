<?php

namespace App\Services;

use App\Models\Video;
use Illuminate\Support\Facades\Http;

class VideoThumbnailResolver
{
    /**
     * Best thumbnail URL for a video page link (YouTube CDN or FieldLevel og:image).
     */
    public function resolve(?string $videoUrl): ?string
    {
        $videoUrl = trim((string) $videoUrl);
        if ($videoUrl === '') {
            return null;
        }

        $temp = new Video;
        $temp->setAttribute('video_url', $videoUrl);
        $youtubeId = $temp->youtube_video_id;
        if ($youtubeId) {
            return 'https://i.ytimg.com/vi/'.$youtubeId.'/mqdefault.jpg';
        }

        if (stripos($videoUrl, 'fieldlevel.com') !== false) {
            return $this->resolveFieldLevelOgImage($videoUrl);
        }

        return null;
    }

    public function resolveFieldLevelOgImage(string $url): ?string
    {
        try {
            $response = Http::timeout(25)
                ->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',
                    'Accept' => 'text/html,application/xhtml+xml;q=0.9,*/*;q=0.8',
                    'Accept-Language' => 'en-US,en;q=0.9',
                ])
                ->get($url);

            if (! $response->successful()) {
                return null;
            }

            $html = $response->body();
            if (preg_match('/<meta\s+property=["\']og:image["\']\s+content=["\']([^"\']+)["\']/i', $html, $m)) {
                return html_entity_decode($m[1], ENT_QUOTES | ENT_HTML5);
            }
            if (preg_match('/<meta\s+content=["\']([^"\']+)["\']\s+property=["\']og:image["\']/i', $html, $m)) {
                return html_entity_decode($m[1], ENT_QUOTES | ENT_HTML5);
            }
        } catch (\Throwable) {
            return null;
        }

        return null;
    }
}
