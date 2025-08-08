<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Hotel extends Model
{
    //protected $guard = 'web';

    protected $fillable = [
        'name',
        'star_no',
        'main_image',
        'description',
        'price',
        'city_id',
    ];

    public function city() //: BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function images()
{
    return $this->hasMany(Image::class);
}
}
