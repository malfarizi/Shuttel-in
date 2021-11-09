<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login()
    {
        return  view('loginadmin');
    }
    public function dashboard()
    {
        return view('admin.dashboard', [
            'title' => 'Dashboard'
        ]);
    }
    
    public function landingpage()
    {
        return view('customer.landingpage');
    }
}
