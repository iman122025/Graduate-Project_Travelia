<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    protected $fillable = [
        'title',
        'location',
        'activities',
        'image',
        'tag_id',
    ];

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function bookings()
    {
        return $this->belongsToMany(Booking::class, 'booking_day')->withTimestamps();;

        //OR

        // return $this->belongsToMany(Booking::class, 'booking_day', 'day_id', 'booking_id')->withTimestamps();;

    }

}
