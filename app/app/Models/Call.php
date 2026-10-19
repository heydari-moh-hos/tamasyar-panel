<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    protected $fillable = [
        'source_call_id',
        'caller_number',
        'extension',
        'direction',
        'status',
        'duration',
        'started_at',
    ];

    protected function casts(): array
    {
        return ['started_at' => 'datetime'];
    }
}
