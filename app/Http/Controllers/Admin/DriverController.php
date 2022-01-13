<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drivers = Driver::latest()->get();
        return view('admin.driver', compact('drivers'))->withTitle('Data Driver');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data                   = new Driver();
    	$data->driver_name      = $request->driver_name;
    	$data->driver_status    = $request->driver_status ? 'Aktif' : 'Tidak Aktif';
        $data->address          = $request->address;
        $data->phone_number     = $request->phone_number;
        
        if ($request->has('photo')) {
            $data->photo = $request->file('photo')->store('images/driver_photos');
        }
        
        $data->save();
        return back()->withSuccess('Data berhasil ditambahkan');;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $driver)
    {
        $data                   = Driver::findOrFail($driver);
    	$data->driver_name      = $request->driver_name;
    	$data->driver_status    = $request->driver_status ? 'Aktif' : 'Tidak Aktif';
        $data->address          = $request->address;
        $data->phone_number     = $request->phone_number;
        
        if ($request->has('photo')) {
            if ($data->photo) {
                Storage::delete($data->photo);
            } 
            //Storage::move($data->photo, $request->photo);
            $data->photo = $request->file('photo')->store('images/driver_photos');
        }

        $data->save();
        return back()->withSuccess('Data berhasil diubah');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Driver $driver)
    {
        try {
            if ($driver->photo) {
                Storage::delete($data->photo);
            }
            $driver->delete();
            return back()->withSuccess('Data berhasil dihapus');
        } catch(\Throwable $th) {
            return back()->withError('Data gagal dihapus karena berketergantungan dengan tabel lain');
        }
    }
}
