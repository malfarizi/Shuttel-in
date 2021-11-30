<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

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
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'          => 'required',
            'phone_number'  => 'required|numeric|max:13',
            'address'       => 'required'
        ]);

        $user->update($request->only('name', 'phone_number', 'address'));
        return back()->withSuccess('Data berhasil diubah');
    }
}
