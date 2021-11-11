<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\ShuttleController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\RouteController;
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

Route::get('/', [UserController::class, 'dashboard'])->name('dashboard');
Route::get('/login', [UserController::class,'login']);

//Shuttle
Route::get('shuttle', [ShuttleController::class,'index']);

//Driver
Route::get('driver', [DriverController::class,'index']);

//Route
Route::get('route', [RouteController::class,'routeadmin']);

//Schedule
Route::get('schedule', [ScheduleController::class,'scheduleadmin']);
