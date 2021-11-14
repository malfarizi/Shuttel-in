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

//User
Route::get('/', [UserController::class, 'dashboard'])->name('dashboard');
Route::get('/customers', [UserController::class, 'index'])->name('customers');

Route::get('/login', [UserController::class, 'login']);

//Shuttle
Route::get('shuttle', [ShuttleController::class, 'index']);

//Driver
Route::resource('drivers', DriverController::class);

//Route
Route::get('route', [RouteController::class, 'routeadmin']);
Route::post('routes', [RouteController::class, 'store'])->name('routes.store');
Route::put('routes/{route}', [RouteController::class, 'update'])->name('routes.update');
Route::delete('routes/{route}', [RouteController::class, 'destroy'])->name('routes.destroy');

//Schedule
Route::get('schedule', [ScheduleController::class, 'scheduleadmin']);
