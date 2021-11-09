<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

<<<<<<< HEAD
Route::get('/generateAccount', function() {
    $admin = \App\Models\User::create([
        'name' => 'admin',
        'email' => 'admin@gmail.com',
        'email_verified_at' => now(),
        'address' => 'Bandung',
        'number_phone' => '0898779821',
        'role' => 'Admin',
        'password' => bcrypt('password'), // password
        'remember_token' => Str::random(10),
    ]);
    
    return response()->json([
        'status' => 'berhasil',
        'admin'  => $admin
    ]);
});

Route::get('booking', [BookingController::class, 'store']);
=======
Route::get('booking',[BookingController::class, 'store']);


// Landing Page
Route::get('/landingpage',[UserController::class,'landingpage']);
>>>>>>> 064dd2c0ee3220be7fce66044c13fb406bb67ab0
