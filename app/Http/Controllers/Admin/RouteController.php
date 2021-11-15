<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Route;
use App\Models\Shuttle;
use Illuminate\Http\Request;

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
            'shuttles' => Shuttle::isActiveStatus()->get(),
            'cities'   => $cities 
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
            'depature'   => 'required',
            'arrival'    => 'required',
            'price'      => 'required|numeric',
            'shuttle_id' => 'required'
        ]);

        $requests = $request->only('depature', 'arrival', 'price', 'shuttle_id');
        Route::create($requests);
        return back()->withSuccess('Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function show(Route $route)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function edit(Route $route)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Route $route)
    {
        $request->validate([
            'depature'   => 'required',
            'arrival'    => 'required',
            'price'      => 'required|numeric',
            'shuttle_id' => 'required'
        ]);

        $requests = $request->only('depature', 'arrival', 'price', 'shuttle_id');
        $route->update($requests);
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
