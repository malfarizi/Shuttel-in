<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function __invoke(Request $request)
    {
        $path   = public_path("/json/cities.json");   
        //decode to get data json
        $cities = json_decode(file_get_contents($path));
    
        if ($request->has('search')) {
            $data = \DB::table('payments')
                        ->join('bookings', 'bookings.id', '=', 'payments.booking_id')
                        ->join('users', 'users.id', '=', 'bookings.user_id')
                        ->join('schedules', 'schedules.id', '=', 'bookings.schedule_id')
                        ->join('routes', 'routes.id', '=', 'schedules.route_id')
                        ->select('payments.status','users.name', 'payments.booking_id', 'routes.depature', 'routes.arrival')
                        ->where('bookings.id', $request->search)
                        ->first();
            
            return empty($data) 
                ? view('customer.landingpage', compact('cities'))->withEmpty('Oops Reservasi Yang Kamu Cari Tidak Ada')
                : view('customer.landingpage', compact('data', 'cities'));
        }
        return view('customer.landingpage', compact('cities'));    
    }
}
