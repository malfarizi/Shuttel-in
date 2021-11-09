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
        return view('admin.dashboard');
    }
    
    public function landingpage()
    {
        return view('customer.landingpage');
    }
}
