<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index() 
    {
        return view('auth.loginadmin');
    }

    public function authenticate(Request $request) 
    {
        $auth = auth()->guard('admin');

        $credentials = $request->only('email', 'password');

        $validator = Validator::make($request->all(),
            [
                'email'  => 'required|string|exists:users',
                'password'  => 'required|string',
            ], 
            [
                'email.exists'    => 'Akun tidak terdaftar',   
                'email.required'  => 'Email tidak boleh kosong',
                'password.required'  => 'Password tidak boleh kosong'
            ],
        );

        $is_admin = User::where('email', $request->email)->value('role');

        //$remember = $request->remember ? true : false;
        
        if($is_admin === 'Admin') {
            if ($auth->attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('admin/dashboard');
            }
        }

        return redirect()->back()->with('error', 'Email  password anda salah');
    }

    public function logout()
    {
        auth()->guard('admin')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/admin/login');
    }
}