<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shuttle;
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
        return view('admin.shuttle', [
            'title'    => 'Data Shuttle',
            'shuttles' => Shuttle::all()
        ]);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shuttle  $shuttle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shuttle $shuttle)
    {
        $shuttle->delete();
        return back()->withSuccess('Data berhasil dihapus');
    }
}
