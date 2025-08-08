<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //protected $guard = 'web';

    protected $fillable = [
        'type',
        'rooms_no',
        'adults_no',
        'children_no',
        'arrival_date',
        'departure_date',
        'notes',
        'user_id',
        'hotel_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function days()
    {
        return $this->belongsToMany(Day::class, 'booking_day')->withTimestamps();;

        // OR

        // return $this->belongsToMany(Day::class, 'booking_day', 'booking_id', 'day_id')->withTimestamps();;

    }

}
