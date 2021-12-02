<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Route;

use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {

        $path = public_path("/json/cities.json");   
        //decode to get data json
        $cities = json_decode(file_get_contents($path));

            $routesid = Route::where('depature', $request->depature)
                            ->where('arrival', $request->arrival)
                            ->value('id');
            $depature = $request->depature;
            $arrival = $request->arrival;
            if(empty($routesid)){
                $schedules = [];
            }else{
                $schedules = Schedule::with('route')
                                ->where('route_id', $routesid)
                                ->where('date_of_depature', '>', today())
                                ->paginate(8)
                                ->withQueryString();
            }
            
            if(empty($request->all())){
                $schedules = Schedule::with('route')
                                ->where('date_of_depature', '>', today())
                                ->paginate(8)
                                ->withQueryString();
            }

            return view('customer.jadwal', compact('schedules','cities','depature','arrival'))->withTitle('Daftar Jadwal');
    }
}