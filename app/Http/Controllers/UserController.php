<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    public function generateAccountAdmin() {
        $admin = \App\Models\User::create([
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
}
