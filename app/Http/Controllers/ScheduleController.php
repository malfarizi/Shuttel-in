<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Route;

use Illuminate\Http\Request;

class ScheduleController extends Controller
{

    public function index(Request $request)
    {
           
         if ($request->has('depature') && $request->has('arrival') ) {
            $routes = Route::all();
            $routesid = Route::where('depature', $request->depature)
            ->where('arrival',$request->arrival)
            ->pluck('id');
            dd($routesid);
            $schedules =Schedule::with('route')
                        ->where('route_id', $routesid)
                        ->where('date_of_depature', '<', today())
                        ->paginate(8);

            return view('customer.jadwal', compact('schedules','routes','routeselected'));
         } else {
            $routes = Route::all();
            $schedules =Schedule::with('route')
            ->where('date_of_depature', '<', today())
            ->paginate(8);
            return view('customer.jadwal', compact('schedules','routes'));
         }
         
       
    }
    public function __invoke()
    {
        return view('customer.jadwal', [
            'title'     => 'Daftar Jadwal',
            'schedules' => Schedule::with('route')
                            ->where('date_of_depature', '<', today())
                            ->paginate(8)
        ]);
    }
}