<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleRequest;

use App\Models\Route;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules  = Schedule::with('route')->latest()->get();
        $routes     = Route::all();
        return view('admin.schedule', compact('schedules', 'routes'))->withTitle('Data Jadwal');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ScheduleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ScheduleRequest $request)
    {
        Schedule::create($request->validated());

        return back()->withSuccess('Data berhasil ditambahkan');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ScheduleRequest  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(ScheduleRequest $request, Schedule $schedule)
    {
        $schedule->update($request->validated());

        return back()->withSuccess('Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        try {
            $schedule->delete();
            return back()->withSuccess('Data berhasil dihapus');
        } catch (\Throwable $th) {
            return back()->withError('Data gagal dihapus karena berketergantungan dengan tabel lain');
        }
    }
}
