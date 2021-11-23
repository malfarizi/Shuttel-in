<?php

namespace App\Http\Controllers;

use Mail;
use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
            'password' => 'password',
            'remember_token' => 'efsdgsgs',
        ]);
        
        return response()->json([
            'status' => 'berhasil',
            'admin'  => $admin
        ]);
    }

    public function register(Request $request) 
    {
        $request->validate([
            'name'         => 'required',
            'email'        => 'required',
            'phone_number' => 'required|numeric',
            'password'     => 'required|confirmed|min:8',
        ]);

        $user = User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'address'       => $request->address,
            'phone_number'  => $request->phone_number,
            'password'      => $request->password
        ]);

        $token = Str::random(64);

        UserVerify::create([
            'user_id' => $user->id, 
            'token' => $token
        ]);

        Mail::send('auth.verify', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Email Verification Account Shuttle In');
        });

        return redirect('/login');
    }

    public function login() 
    {
        return view('auth.logincustomer');    
    }

    public function authenticate(Request $request) 
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials = array_merge($request->only('email', 'password'), ['role' => 'Customer']);

        //$remember = $request->remember ? true : false;
        //dd(Auth::attempt($credentials));
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            //return redirect()->intended('/landingpage');
            return redirect('/landingpage');
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

    public function edit(User $user)
    {
        return view('customer.profile', [
            'title' => 'Halaman Ubah Akun',
            'user'  => $user
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'          => 'required',
            'phone_number'  => 'required|numeric',
            'address'       => 'required'
        ]);

        $user->update($request->only('name', 'phone_number', 'address'));
        return redirect()->back()->with('success', 'Data berhasil didubah');
    }

    public function logout()
    {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/landingpage');
    }
}
