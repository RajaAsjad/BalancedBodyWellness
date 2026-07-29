<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'slug',
        'meta_title',
        'meta_description',
        'name',
        'short_description',
        'description',
        'image',
        'status',
        'published_at',
    ];

    protected $casts = [
        'status' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function hasCreatedBy()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function hasBlogCategory()
    {
        return $this->hasOne(Blog_Categories::class, 'id', 'blog_category_id');
    }

    public function isScheduled(): bool
    {
        return (bool) $this->status
            && $this->published_at
            && $this->published_at->isFuture();
    }

    public function isVisibleOnSite(): bool
    {
        return (bool) $this->status
            && (! $this->published_at || $this->published_at->lte(now()));
    }

    public function scopeVisibleOnSite(Builder $query): Builder
    {
        return $query->where('status', 1)
            ->where(function (Builder $q) {
                $q->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            });
    }

    public function scopeInactive(Builder $query): Builder
    {
        return $query->where('status', 0);
    }

    public function scopeActivePublished(Builder $query): Builder
    {
        return $query->where('status', 1)
            ->where(function (Builder $q) {
                $q->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            });
    }

    public function scopeScheduled(Builder $query): Builder
    {
        return $query->where('status', 1)
            ->whereNotNull('published_at')
            ->where('published_at', '>', now());
    }

    public function imageUrl(): string
    {
        $file = trim((string) ($this->image ?? ''));

        if ($file === '') {
            return asset('assets/website/images/hero-wellness.jpg');
        }

        // New uploads: storage/app/public/blogs/...
        if (str_starts_with($file, 'blogs/')) {
            return asset('storage/'.$file);
        }

        if (\Illuminate\Support\Facades\Storage::disk('public')->exists('blogs/'.$file)) {
            return asset('storage/blogs/'.$file);
        }

        // Legacy uploads: public/admin/assets/images/blog/...
        if (is_file(public_path('admin/assets/images/blog/'.$file))) {
            return asset('admin/assets/images/blog/'.$file);
        }

        return asset('storage/blogs/'.$file);
    }

    public function excerpt(int $limit = 140): string
    {
        return \Illuminate\Support\Str::limit(strip_tags((string) $this->short_description), $limit);
    }

    public function displayDate(): ?\Carbon\Carbon
    {
        return $this->published_at ?? $this->created_at;
    }
}
