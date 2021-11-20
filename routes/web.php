<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\LoginController;

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

//login admin
Route::get('/admin/login', [LoginController::class, 'index'])
    ->name('admin.loginpage')
    ->middleware('guest');

Route::post('/admin/login', [LoginController::class, 'authenticate'])->name('admin.login');
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');
 
Route::get('/login', [UserController::class, 'login'])->middleware('guest');
Route::post('/login', [UserController::class, 'authenticate'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/register', [UserController::class, 'registerPage'])->middleware('guest');
Route::post('/register', [UserController::class, 'register'])->name('register');

Route::get('/landingpage', [UserController::class, 'landingpage'])->name('landingpage');
Route::get('/jadwal', [UserController::class, 'jadwal']);

//Booking
Route::get('/reservasi', [BookingController::class, 'reservasi']);
Route::get('/riwayat', [UserController::class, 'riwayat']);

Route::middleware('auth')->group(function(){
    //customer
});
