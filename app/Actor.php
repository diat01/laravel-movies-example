<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Actor extends Model
{
    public $incrementing = false;

    public function casts(): HasMany
    {
        return $this->hasMany(MovieCast::class);
    }
}
