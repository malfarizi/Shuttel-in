<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Payment;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function __invoke()
    {
        return view('admin.booking', [
            'title'    => 'Data Booking',
            'bookings' => \DB::table('bookings')
                ->join('users', 'users.id', '=', 'bookings.user_id')
                ->join('schedules', 'schedules.id', '=', 'bookings.schedule_id')
                ->join('booking_details', 'booking_details.booking_id', '=', 'bookings.id')
                ->join('routes', 'routes.id', '=', 'schedules.route_id')
                ->join('shuttles', 'shuttles.id', '=', 'routes.shuttle_id')
                ->select('users.*', 'bookings.*', 'schedules.*', 'booking_details.*', 
                         'routes.*', 'shuttles.*')
                ->get()
        ])->with('i');
    }
}