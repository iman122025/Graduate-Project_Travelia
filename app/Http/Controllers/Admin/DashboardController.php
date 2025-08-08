<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Hotel;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $bookings = Booking::all();

        $customers = User::where('role', 2)->get();

        $hotels = Hotel::all();

        return view('admin.dashboard',compact('bookings','customers','hotels'));
    }
}
