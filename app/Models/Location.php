<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Location extends Model
{
    protected $fillable = [
        'name'
    ];

    public function concerts(): HasMany
    {
        return $this->hasMany(Concerts::class);
    }

}
