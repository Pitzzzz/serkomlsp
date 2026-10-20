<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class GalleryItem extends Model
{
    protected $fillable = [
        'title',
        'category',
        'image_url',
        'span',
        'aspect',
        'sort_order',
    ];

    public function imageSrc(): string
    {
        return $this->resolveMediaUrl($this->image_url);
    }

    public static function resolveMediaUrl(?string $path): string
    {
        if (! $path) {
            return '';
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '/')) {
            return $path;
        }

        return Storage::disk('public')->url($path);
    }
}
