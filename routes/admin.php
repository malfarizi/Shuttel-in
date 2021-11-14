<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\ShuttleController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\RouteController;
use App\Http\Controllers\ScheduleController;
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
Route::get('shuttle', [ShuttleController::class, 'index']);

//Driver
Route::resource('drivers', DriverController::class);

//Route
Route::resource('routes', RouteController::class);

//Schedule
Route::get('schedule', [ScheduleController::class, 'scheduleadmin']);
