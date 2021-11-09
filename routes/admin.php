<?php

use Illuminate\Support\Facades\Route;
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
Route::get('/', [UserController::class, 'dashboard'])->name('dashboard');

=======
Route::get('/',[UserController::class,'dashboard']);
Route::get('/login',[UserController::class,'login']);
>>>>>>> 064dd2c0ee3220be7fce66044c13fb406bb67ab0
