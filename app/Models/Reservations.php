<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Reservations extends Model
{
    protected $fillable = [
        'token',
        'show_id'
    ];

    public function show(): BelongsTo
    {
        return $this->belongsTo(Show::class);
    }

    public function seats(): BelongsToMany
    {
        return $this->belongsToMany(Seats::class, 'reservation_seat');
    }

}
