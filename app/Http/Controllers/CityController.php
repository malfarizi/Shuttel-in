<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CityController extends Controller
{
    public function __invoke()
    {    
        //get File json
        $path = public_path() . "/json/cities.json";   
        //decode to get data json
        $cities_json = json_decode(file_get_contents($path), true); 
        return $cities_json;
    } 
}
