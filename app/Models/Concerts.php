<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Concerts extends Model
{
    protected $fillable = [
        'artist',
        'location_id'
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function shows(): HasMany
    {
        return $this->hasMany(Show::class, 'concerts_id');
    }

}
