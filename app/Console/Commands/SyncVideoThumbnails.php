<?php

namespace App\Console\Commands;

use App\Models\Video;
use App\Services\VideoThumbnailResolver;
use Illuminate\Console\Command;

class SyncVideoThumbnails extends Command
{
    protected $signature = 'video:sync-thumbnails';

    protected $description = 'Set thumbnail_url from each video_url (YouTube / FieldLevel). Run once for old records.';

    public function handle(VideoThumbnailResolver $resolver): int
    {
        $n = 0;
        Video::query()->orderBy('id')->each(function (Video $video) use ($resolver, &$n) {
            $thumb = $resolver->resolve($video->video_url);
            if ($thumb && $video->thumbnail_url !== $thumb) {
                $video->thumbnail_url = $thumb;
                $video->saveQuietly();
                $n++;
            }
        });

        $this->info("Updated {$n} video(s).");

        return self::SUCCESS;
    }
}
