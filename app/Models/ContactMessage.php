<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class ContactMessage extends Model
{
    protected $fillable = [
        'nama',
        'email',
        'telepon',
        'perusahaan',
        'topik',
        'pesan',
        'is_read',
    ];

    protected function casts(): array
    {
        return [
            'is_read' => 'boolean',
        ];
    }

    public function replies(): MorphMany
    {
        return $this->morphMany(AdminReply::class, 'replyable')->latest('sent_at');
    }
}
