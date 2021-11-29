<?php

namespace App\Http\Controllers;

use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function __invoke()
    {
        $schedules = Schedule::with('route')
                        ->where('date_of_depature', '<', today())
                        ->paginate(8)
                        ->withQueryString();

        return view('customer.jadwal', compact('schedules'))->withTitle('Daftar Jadwal');
    }
}