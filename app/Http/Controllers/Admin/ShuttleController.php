<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Shuttle;
use App\Models\Driver;
use Illuminate\Http\Request;
use App\Http\Requests\ShuttleRequest;

class ShuttleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shuttles = Shuttle::with('driver')->latest()->get();
        $drivers  = Driver::activeStatus()->get();
        return view('admin.shuttle', compact('shuttles', 'drivers'))->withTitle('Data Shuttle');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nopol'   => 'required',
            'shuttle_status'    => 'required',
            'driver_id'      => 'required',
        ]);

        $data = new Shuttle();
    	$data->nopol = $request->nopol;
    	$data->shuttle_status = $request->shuttle_status;
        $data->driver_id = $request->driver_id;

        $data->save();

        return back()->withSuccess('Data berhasil ditambahkan');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ShuttleRequest  $request
     * @param  \App\Models\Shuttle  $shuttle
     * @return \Illuminate\Http\Response
     */
    public function update(ShuttleRequest $request, Shuttle $shuttle)
    {
        $shuttle->update($request->validated());
        return back()->withSuccess('Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shuttle  $shuttle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shuttle $shuttle)
    {
        try {
            $shuttle->delete();
            return back()->withSuccess('Data berhasil dihapus');
        } catch(\Throwable $th) {
            return back()->withError('Data gagal dihapus karena berketergantungan dengan tabel lain');
        }
    }
}
