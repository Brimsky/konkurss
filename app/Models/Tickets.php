<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tickets extends Model
{
    protected $fillable = [
        'code',
        'booking_id',
        'name',
        'address',
        'city',
        'zip',
        'country',
        'show_id',
        'row_id',
        'seat_number'
    ];

    public function show(): BelongsTo
    {
        return $this->belongsTo(Show::class);
    }

    public function row(): BelongsTo
    {
        return $this->belongsTo(Rows::class);
    }

}
