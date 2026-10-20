<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'excerpt',
        'body',
        'category',
        'cover_image',
        'reading_minutes',
        'is_featured',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderByDesc('published_at');
    }

    public function coverSrc(): ?string
    {
        if (! $this->cover_image) {
            return null;
        }

        if (str_starts_with($this->cover_image, 'http://') || str_starts_with($this->cover_image, 'https://') || str_starts_with($this->cover_image, '/')) {
            return $this->cover_image;
        }

        return Storage::disk('public')->url($this->cover_image);
    }

    public function formattedDate(): string
    {
        if (! $this->published_at) {
            return '';
        }

        $months = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
            5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu',
            9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des',
        ];

        return $this->published_at->day.' '.$months[(int) $this->published_at->month].' '.$this->published_at->year;
    }

    public function metaLabel(): string
    {
        return $this->category.' · '.$this->reading_minutes.' menit';
    }
}
