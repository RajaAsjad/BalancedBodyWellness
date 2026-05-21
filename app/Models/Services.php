<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class Services extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];

    protected $casts = [
        'questions' => 'array',
        'benefits' => 'array',
    ];

    /**
     * Normalize stored list (JSON array or legacy plain string) for forms.
     */
    public static function listItemsForForm($value, ?array $oldInput = null): array
    {
        if (is_array($oldInput)) {
            $filtered = array_values(array_filter(array_map(
                fn ($v) => is_string($v) ? trim($v) : '',
                $oldInput
            ), fn ($v) => $v !== ''));

            return count($filtered) ? $filtered : [''];
        }

        if (is_array($value)) {
            $filtered = array_values(array_filter(array_map('trim', $value), fn ($v) => $v !== ''));

            return count($filtered) ? $filtered : [''];
        }

        if (is_string($value) && $value !== '') {
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $filtered = array_values(array_filter(array_map('trim', $decoded), fn ($v) => $v !== ''));

                return count($filtered) ? $filtered : [''];
            }

            return [trim($value)];
        }

        return [''];
    }

    /** Items for public display (no empty placeholder row). */
    public function displayList(string $attribute): array
    {
        return array_values(array_filter(
            self::listItemsForForm($this->{$attribute}),
            fn ($item) => trim((string) $item) !== ''
        ));
    }

    /** Short preview for admin tables. */
    public function listPreview(string $attribute, int $limit = 60): string
    {
        $value = $this->{$attribute};
        if (is_array($value)) {
            $text = implode(' · ', $value);
        } else {
            $text = (string) $value;
        }

        return \Illuminate\Support\Str::limit(strip_tags($text), $limit);
    }

    public static function imagePlaceholderUrl(): string
    {
        return asset('assets/website/images/hero-wellness.jpg');
    }

    public function imageUrl(?string $column): string
    {
        $file = trim((string) ($this->{$column} ?? ''));

        if ($file !== '') {
            return asset('assets/website/images/services/' . $file);
        }

        return self::imagePlaceholderUrl();
    }

    public function hasCreatedBy()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
}
