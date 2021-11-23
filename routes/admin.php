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

//Shuttles
Route::resource('shuttles', ShuttleController::class)->except(['create', 'show', 'edit']);

//Drivers
Route::resource('drivers', DriverController::class)->except(['create', 'show', 'edit']);

//Routes
Route::resource('routes', RouteController::class)->except(['create', 'show', 'edit']);

//Schedules
Route::resource('schedules', ScheduleController::class)->except(['create', 'show', 'edit']);

//Customers
Route::get('/customers', [UserController::class, 'index'])->name('customers');

//Profile
Route::get('/profile/{user}/edit', [UserController::class, 'edit'])->name('profile.edit');
Route::put('/profile/{user}', [UserController::class, 'update'])->name('profile.update');

//Bookings
Route::get('/payments', [PaymentController::class, 'index'])->name('payments');

//Export Laporan
Route::get('/payments/export-laporan', [PaymentController::class, 'export'])->name('payments.export');