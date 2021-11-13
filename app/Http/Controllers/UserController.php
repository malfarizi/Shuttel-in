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

    public function generateAccountAdmin() {
        $admin = \App\Models\User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'address' => 'Bandung',
            'number_phone' => '0898779821',
            'role' => 'Admin',
            'password' => bcrypt('password'), // password
            'remember_token' => Str::random(10),
        ]);
        
        return response()->json([
            'status' => 'berhasil',
            'admin'  => $admin
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
