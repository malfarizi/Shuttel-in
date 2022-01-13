<?php

namespace App\Http\Controllers;

use DB;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Notifications\EmailTokenRegistration;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(UserRequest $request) 
    {
        $user  = User::create($request->validated());
        $token = Str::random(64);
        
        $user->verify()->create(compact('token'));

        $user->notify(new EmailTokenRegistration($user->name, $token));

        return redirect('/login');
    }

    public function registerPage() 
    {
        return view('auth.register');
    }

    public function edit(User $user)
    {
        return view('customer.profile', compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        $user->update($request->validated());
        return back()->with('success', 'Data berhasil diubah');
    }
}
