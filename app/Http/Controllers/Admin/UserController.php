<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function index() 
    {
        $customers = User::whereRole('Customer')->get();
        return view('admin.customer', compact('customers'))->withTitle('Data Customer');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.profile', compact('user'))->withTitle('Halaman Ubah Akun');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $user->update($request->validated());
        return back()->withSuccess('Data berhasil diubah');
    }
}
