<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() 
    {
        return view('auth.loginadmin');
    }

    public function authenticate(Request $request) 
    {
        $request->validate(
            [
                'email'     => 'required|email',
                'password'  => 'required',
            ]
        );

        $credentials = $request->only('email', 'password') + ['role' => 'Admin'];

        $remember = $request->remember ? true : false;
    
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('admin/dashboard');
        }

        return redirect()->back()->with('error', 'Email dan password anda salah');
    }

    public function logout()
    {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/admin/login');
    }
}