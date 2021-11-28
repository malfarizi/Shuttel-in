<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

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

// Generate Account Admin
Route::get('/generateAccount', [UserController::class, 'generateAccountAdmin']);

// Authenticate Login and Logout Customer
Route::get('/admin/login', [LoginController::class, 'index'])
    ->name('admin.loginpage')
    ->middleware('guest');

Route::post('/admin/login', [LoginController::class, 'authenticate'])->name('admin.login');
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');
 
// Authenticate Login and Logout Customer
Route::get('/login', [UserController::class, 'login'])->middleware('guest');
Route::post('/login', [UserController::class, 'authenticate'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// Register Customer
Route::get('/register', [UserController::class, 'registerPage'])->middleware('guest');
Route::post('/register', [UserController::class, 'register'])->name('register');

// Verification Email
Route::get('account/verify/{token}', [VerificationController::class, 'verifyAccount'])->name('user.verify'); 

// Forget Password
Route::get('forget-password', [ForgetPasswordController::class, 'index'])->name('forget.password.get');
Route::post('forget-password', [ForgetPasswordController::class, 'forgetPassword'])->name('forget.password');

// Reset Password
Route::get('reset-password/{token}', [ResetPasswordController::class, 'index'])->name('reset.password.get');
Route::post('reset-password', [ResetPasswordController::class, 'resetPassword'])->name('reset.password');

// Other Page
Route::get('/', [UserController::class, 'landingpage'])->name('landingpage');
Route::get('/jadwal', ScheduleController::class);

//Reservasi
Route::get('reservasi/{schedule}', [BookingController::class, 'reservasi'])->name('reservasi');

//Get Status Payment
Route::get('/api/midtrans/payments/getStatus/{id}', [PaymentController::class, 'getStatus'])->name('payments.status');

// Profil
Route::get('/profile/{user}/edit', [UserController::class, 'edit'])->name('profile.edit');
Route::put('/profile/{user}', [UserController::class, 'update'])->name('profile.update');

Route::middleware('auth')->group( function() {
    Route::post('booking', [BookingController::class, 'store']);
    Route::get('/riwayat', [BookingController::class, 'riwayat']);
    Route::get('/print-tiket', [BookingController::class, 'downloadTicket']);
});
