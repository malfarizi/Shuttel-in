<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\ShuttleController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\RouteController;
use App\Http\Controllers\Admin\ScheduleController;
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

//User
Route::get('/', [UserController::class, 'dashboard'])->name('dashboard');
Route::get('/customers', [UserController::class, 'index'])->name('customers');

Route::get('/login', [UserController::class, 'login']);

//Shuttle
Route::resource('shuttles', ShuttleController::class);

//Driver
Route::resource('drivers', DriverController::class);

//Route
Route::resource('routes', RouteController::class);

//Schedule
Route::resource('schedules', ScheduleController::class);

//Booking
Route::get('/booking', [BookingController::class, 'index'])->name('booking');

//Profile
Route::get('/profile/{user}/edit', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('profile.edit');
Route::put('/profile/{user}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('profile.update');