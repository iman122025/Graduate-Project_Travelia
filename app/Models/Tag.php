<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    protected $fillable = [
        'name',
        'image',
    ];

    public function days()
    {
        return $this->hasMany(Day::class);
    }

}
