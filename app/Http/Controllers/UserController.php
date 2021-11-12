<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        return view('admin.customer', [
            'title'     => 'Data Customer',
            'customers' => User::where('role', 'Customer')->get()
        ]);
    }
    public function login()
    {
        return view('loginadmin');
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

    public function logincustomer()
    {
        return view('logincustomer');
    }

    public function register()
    {
        return view('register');
    }
}
