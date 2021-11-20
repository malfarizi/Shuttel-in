<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function generateAccountAdmin() {
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'address' => 'Bandung',
            'phone_number' => '0898779821',
            'role' => 'Admin',
            'password' => bcrypt('password'), // password
            'remember_token' => 'efsdgsgs',
        ]);
        
        return response()->json([
            'status' => 'berhasil',
            'admin'  => $admin
        ]);
    }

    public function register(Request $request) 
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'password' => bcrypt($request->password)
        ]);

        return redirect();
    }

    public function login() 
    {
        return view('auth.logincustomer');    
    }

    public function authenticate(Request $request) 
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);


        $customer = User::where('email', $request->email)->value('role');

        //$remember = $request->remember ? true : false;
        
        if($customer === 'Customer') {
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                //return redirect()->intended('/landingpage');
                return redirect('/landingpage');
            }
        }

        return redirect()->back()->with('error', 'Email  password anda salah');
    }

    public function registerPage() 
    {
        return view('auth.register');
    }

    public function landingpage()
    {
        return view('customer.landingpage');
    }

    public function logout()
    {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/landingpage');
    }
}
