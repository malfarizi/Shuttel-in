<?php

namespace App\Http\Controllers;

use Mail;
use DB;
use App\Models\User;
use App\Models\Route;
use App\Models\UserVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
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

        $credentials = $request->only('email', 'password') + ['role' => 'Customer'];
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            //return redirect()->intended('/landingpage');
            return redirect('/');
        }

        return redirect()->back()->with('error', 'Email  password anda salah');
    }

    public function registerPage() 
    {
        return view('auth.register');
    }

    public function landingpage(Request $request)
    {
            $routes = Route::all();
            $data   = DB::table('payments')
                        ->join('bookings', 'bookings.id', '=', 'payments.booking_id')
                        ->join('users', 'users.id', '=', 'bookings.user_id')
                        ->join('schedules', 'schedules.id', '=', 'bookings.schedule_id')
                        ->join('booking_details', 'booking_details.booking_id', '=', 'bookings.id')
                        ->join('routes', 'routes.id', '=', 'schedules.route_id')
                        ->join('shuttles', 'shuttles.id', '=', 'routes.shuttle_id')
                        ->select('users.*', 'payments.*', 'schedules.*', 'booking_details.*', 
                                'routes.*', 'shuttles.*','bookings.*')
                        ->where('bookings.id',$request->search)
                        ->first();
            
            return view('customer.landingpage',compact('data','routes'));        
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
        return redirect('/');
    }
}
