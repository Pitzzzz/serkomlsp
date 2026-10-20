<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class AdminReply extends Model
{
    protected $fillable = [
        'recipient',
        'subject',
        'body',
        'sent_at',
    ];

    protected function casts(): array
    {
        return [
            'sent_at' => 'datetime',
        ];
    }

    public function replyable(): MorphTo
    {
        return $this->morphTo();
    }
}
