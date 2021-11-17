<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;

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

Route::get('/generateAccount', [UserController::class, 'generateAccountAdmin']);

Route::get('booking', [BookingController::class, 'store']);

Route::get('/register', function() {
    return view('auth.logincustomer');
});

//login page
Route::get('/admin/login', function(){
    return view('auth.loginadmin');
});

Route::get('/login', function() {
    return view('auth.logincustomer');
});

Route::get('/landingpage', [UserController::class, 'landingpage']);
Route::get('/jadwal', [UserController::class, 'jadwal']);
Route::get('/reservasi', [BookingController::class, 'reservasi']);
Route::get('/riwayat', [UserController::class, 'riwayat']);

Route::middleware('auth')->group(function(){
    //customer
});