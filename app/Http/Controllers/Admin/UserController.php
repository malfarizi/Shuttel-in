<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Driver;
use App\Models\Shuttle;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        return view('admin.customer', [
            'title'     => 'Data Customer',
            'customers' => User::where('role', 'Customer')->get()
        ])->with('i');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.profile', [
            'title' => 'Halaman Ubah Akun',
            'user'  => $user
        ]);
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
            'phone_number'  => 'required|numeric',
            'address'       => 'required'
        ]);

        $user->update($request->only('name', 'phone_number', 'address'));
        return back()->withSuccess('Data berhasil diubah');
    }
}
