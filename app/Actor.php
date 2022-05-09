<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Actor extends Model implements HasMedia
{
    use InteractsWithMedia;

    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'gender'
    ];

    public function casts(): HasMany
    {
        return $this->hasMany(MovieCast::class);
    }
}
