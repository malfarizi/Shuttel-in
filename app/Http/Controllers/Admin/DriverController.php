<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.driver', [
            'title'   => 'Data Driver',
            'drivers' => Driver::latest()->get()
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
        $data = new Driver();
    	$data->driver_name = $request->driver_name;
    	$data->driver_status = $request->driver_status;
        $data->address = $request->address;
        $data->number_phone = $request->number_phone;

        $image      = $request->file('photo');
        $imageName  = time() . "_" . $image->getClientOriginalName();
        $image->move(public_path('images/driver_photos/'), $imageName);
        $data->photo = $imageName;
        
        $data->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
        dd($driver->driver_name);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function edit(Driver $driver)
    {
        //
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
        $data = Driver::findOrFail($driver);
    	$data->driver_name = $request->driver_name;
    	$data->driver_status = $request->driver_status;
        $data->address = $request->address;
        $data->number_phone = $request->number_phone;
        
        
        if (empty($request->file('photo')))
        {
            $data->photo = $data->photo;
        }
        else{
            unlink('images/driver_photos/'.$data->photo); //menghapus file lama
            $photo = $request->file('photo');
            $ext = $photo->getClientOriginalExtension();
            $newName = rand(100000,1001238912).".".$ext;
            $photo->move('images/driver_photos/',$newName);
            $data->photo = $newName;
        }
        $data->save();
        return redirect()->back();

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
            $driver->delete();
            return back()->withSuccess('Data berhasil dihapus');
        } catch(\Throwable $th) {
            return back()->withError('Data gagal dihapus karena berketergantungan dengan tabel lain');
        }
    }
}
