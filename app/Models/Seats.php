<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Seats extends Model
{
    protected $fillable = [
        'row_id',
        'number'
    ];

    public function row(): BelongsTo
    {
        return $this->belongsTo(Rows::class);
    }

    public function reservations()
    {
        return $this->belongsToMany(Reservations::class, 'reservation_seat');
    }

}
