<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rows extends Model
{
    protected $fillable = [
        'name'
    ];

    public function seats(): HasMany
    {
        return $this->hasMany(Seats::class);
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Tickets::class);
    }

}
