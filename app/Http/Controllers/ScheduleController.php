<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\Schedule;

use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function __invoke(Request $request)
    {
        $path       = public_path("/json/cities.json");   
        $cities     = json_decode(file_get_contents($path));
        
        $depature   = $request->depature;
        $arrival    = $request->arrival;

        $routesid   = Route::where(compact('depature', 'arrival'))->value('id');    
        
        $schedules  = Schedule::query()
                        ->where('date_of_depature', '>', today())
                        ->when($request->has(['depature', 'arrival']), function($query) use($routesid) {
                            return $query->where('route_id', $routesid);
                        })
                        ->paginate(8)
                        ->withQueryString();

        return view('customer.jadwal', compact('schedules','cities','depature','arrival'));
    }
}