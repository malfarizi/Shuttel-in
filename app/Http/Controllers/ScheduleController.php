<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Route;

use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
            $routes   = Route::all();
            $routesid = Route::where('depature', 'LIKE', '%'.$request->depature.'%')
                            ->where('arrival', 'LIKE', '%'.$request->arrival.'%')
                            ->value('id');
            //dd($routesid);
            if(empty($routesid)){
                $schedules = [];
            }else{
                $schedules = Schedule::with('route')
                                ->where('route_id', $routesid)
                                ->where('date_of_depature', '<', today())
                                ->paginate(8);
            }
            
            if(empty($request->depature) && empty($request->arrival)){
                $schedules = Schedule::with('route')
                                ->where('date_of_depature', '<', today())
                                ->paginate(8);
            }

            return view('customer.jadwal', compact('schedules','routes'));
    }
}