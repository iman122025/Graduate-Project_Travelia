<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Booking_day;
use App\Models\Hotel;
use Illuminate\Http\Request;

class BookingsController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['hotel', 'user'])->get();

        return view('admin.bookings.index', compact('bookings'));
    }

    public function details($id)
    {

        $booking = Booking::with(['hotel', 'user', 'days'])->findOrFail($id);

        return view('admin.bookings.details', [
            'booking' => $booking,
        ]);


    }


}
