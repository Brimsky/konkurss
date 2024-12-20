<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Show extends Model
{
    protected $fillable = [
        'concert_id',
        'start',
        'end'
    ];

    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime'
    ];

    public function concert(): BelongsTo
    {
        return $this->belongsTo(Concerts::class);
    }

}
