<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ForgetPasswordController extends Controller
{
    /**
     * Display page forget password
     *
     * @return
     */
    public function index()
    {
        return view('auth.forgetPassword');
    }
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function forgetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
  
        $token = Str::random(64);
  
        \DB::table('password_resets')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => now()
        ]);
  
        \Mail::send('auth.sendEmailForget', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });
  
        return back()->with('message', 'We have e-mailed your password reset link!');
    }
}