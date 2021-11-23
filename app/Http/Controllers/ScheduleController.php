<?php

namespace App\Http\Controllers;

use App\Models\Schedule;

class ScheduleController extends Controller
{
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