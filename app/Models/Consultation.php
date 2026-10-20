<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Consultation extends Model
{
    protected $fillable = [
        'nama',
        'perusahaan',
        'email',
        'telepon',
        'product_id',
        'layanan',
        'anggaran',
        'kebutuhan',
        'is_read',
    ];

    protected function casts(): array
    {
        return [
            'is_read' => 'boolean',
        ];
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function replies(): MorphMany
    {
        return $this->morphMany(AdminReply::class, 'replyable')->latest('sent_at');
    }
}
