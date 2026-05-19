<?php

namespace App\Models;

use App\Services\VideoThumbnailResolver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Video extends Model
{
    /**
     * Get YouTube video ID from stored video_url (handles full URL or raw ID).
     */
    public function getYoutubeVideoIdAttribute(): ?string
    {
        $url = $this->attributes['video_url'] ?? '';
        if (empty($url)) {
            return null;
        }
        // Already just an ID (e.g. 11-char alphanumeric)
        if (preg_match('/^[a-zA-Z0-9_-]{10,12}$/', $url)) {
            return $url;
        }
        // youtube.com/watch?v=ID
        if (preg_match('/[?&]v=([a-zA-Z0-9_-]{10,12})/', $url, $m)) {
            return $m[1];
        }
        // youtube.com/embed/, youtu.be/, or /shorts/
        if (preg_match('#(?:youtube\.com/embed/|youtu\.be/|youtube\.com/shorts/)([a-zA-Z0-9_-]{10,12})#', $url, $m)) {
            return $m[1];
        }
        return null;
    }

    /**
     * Get YouTube embed URL for iframe (e.g. for modal).
     */
    public function getYoutubeEmbedUrlAttribute(): ?string
    {
        $id = $this->youtube_video_id;
        return $id ? 'https://www.youtube.com/embed/' . $id : null;
    }

    /**
     * Poster image for cards (admin + site): DB value after save, or cached resolve from video_url only.
     */
    public function thumbnailDisplayUrl(): ?string
    {
        $stored = trim((string) ($this->attributes['thumbnail_url'] ?? ''));
        if ($stored !== '') {
            return $stored;
        }

        $videoUrl = trim((string) ($this->attributes['video_url'] ?? ''));
        if ($videoUrl === '') {
            return null;
        }

        return Cache::remember('video_thumb_display_'.md5($videoUrl), 86400, function () use ($videoUrl) {
            return app(VideoThumbnailResolver::class)->resolve($videoUrl);
        });
    }
}
