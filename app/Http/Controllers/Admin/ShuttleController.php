<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Shuttle;
use App\Models\Driver;
use Illuminate\Http\Request;

class ShuttleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function index()
    {
        $shuttles = Shuttle::all();
        return view('admin.shuttle', [
            'title'    => 'Data Shuttle',
            'shuttles' => $shuttles->load('driver'),
            'drivers'  => Driver::all()
        ])->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * Display the specified resource.
     *
     * @param  \App\Models\Shuttle  $shuttle
     * @return \Illuminate\Http\Response
     */
    public function show(Shuttle $shuttle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shuttle  $shuttle
     * @return \Illuminate\Http\Response
     */
    public function edit(Shuttle $shuttle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shuttle  $shuttle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shuttle $shuttle)
    {

        $request->validate([
            'nopol'             => 'required',
            'shuttle_status'    => 'required',
            'driver_id'         => 'required',
        ]);

        $data = $request->only('nopol', 'shuttle_status', 'driver_id');

        $shuttle->update($data);
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
