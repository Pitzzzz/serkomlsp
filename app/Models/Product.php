<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'slug',
        'name',
        'label',
        'description',
        'features',
        'price_from',
        'budget_range',
        'is_highlighted',
        'highlight_note',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'features' => 'array',
            'is_highlighted' => 'boolean',
            'price_from' => 'integer',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function formattedPrice(): string
    {
        return 'Rp '.number_format($this->price_from, 0, ',', '.');
    }

    public function consultationUrl(): string
    {
        return route('konsultasi', ['paket' => $this->slug]);
    }
}
