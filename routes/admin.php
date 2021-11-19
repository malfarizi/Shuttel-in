<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RouteController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ShuttleController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\DashboardController;
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

//Dashboard
Route::get('/dashboard', DashboardController::class)->name('dashboard');

//Customers
Route::get('/customers', [UserController::class, 'index'])->name('customers');

//Shuttles
Route::resource('shuttles', ShuttleController::class);

//Drivers
Route::resource('drivers', DriverController::class);

//Routes
Route::resource('routes', RouteController::class);

//Schedules
Route::resource('schedules', ScheduleController::class);

//Bookings
Route::get('/bookings', PaymentController::class)->name('bookings');

//Profile
Route::get('/profile/{user}/edit', [UserController::class, 'edit'])->name('profile.edit');
Route::put('/profile/{user}', [UserController::class, 'update'])->name('profile.update');