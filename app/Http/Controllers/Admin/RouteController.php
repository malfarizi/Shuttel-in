<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RouteRequest;

use App\Models\Route;
use App\Models\Shuttle;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get File json
        $path = public_path("/json/cities.json");   
        //decode to get data json
        $cities = json_decode(file_get_contents($path));

        $routes = Route::latest()->get();
        
        return view('admin.route', [
            'title'    => 'Data Rute',
            'routes'   => $routes->load('shuttle'),
            'shuttles' => Shuttle::activeStatus()->get(),
            'cities'   => $cities 
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\RouteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RouteRequest $request)
    {
        Route::create($request->validated());
        return back()->withSuccess('Data berhasil ditambahkan');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\RouteRequest  $request
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function update(RouteRequest $request, Route $route)
    {
        $route->update($request->validated());
        return back()->withSuccess('Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function destroy(Route $route)
    {
        try {
            $route->delete();
            return back()->withSuccess('Data berhasil dihapus');
        } catch(\Throwable $th) {
            return back()->withError('Data gagal dihapus karena berketergantungan dengan tabel lain');
        }
    }
}
