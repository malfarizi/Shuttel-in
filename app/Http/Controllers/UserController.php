<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Driver;
use App\Models\Shuttle;
use App\Models\Payment;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        return view('admin.customer', [
            'title'     => 'Data Customer',
            'customers' => User::where('role', 'Customer')->get()
        ])->with('i');
    }

    public function generateAccountAdmin() {
        $admin = \App\Models\User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'address' => 'Bandung',
            'number_phone' => '0898779821',
            'role' => 'Admin',
            'password' => bcrypt('password'), // password
            'remember_token' => Str::random(10),
        ]);
        
        return response()->json([
            'status' => 'berhasil',
            'admin'  => $admin
        ]);
    }

    public function login()
    {
        return view('loginadmin');
    }
    
    public function dashboard()
    {
        //customer count
        $customer_count = User::where('role', 'Customer')->count();

        //Driver count
        $active_driver_count     = Driver::isActiveStatus()->count();
        $non_active_driver_count = Driver::isActiveStatus('Tidak Aktif')->count();
        
        //Shuttle count
        $active_shuttle_count      = Shuttle::isActiveStatus()->count();
        $non_active_shuttle_count  = Shuttle::isActiveStatus('Tidak Aktif')->count();

        //Reservation count
        $pending_reservation  = Payment::status('pending')->count();
        $cancel_reservation   = Payment::status('cancel')->count();
        $success_reservation  = Payment::status('success')->count(); 
        $total_reservation    = Payment::count();

        $total_income         = Payment::status('success')->sum('total');

        return view('admin.dashboard', [
            'title'                     => 'Dashboard',
            'customer_count'            => $customer_count,
            'active_driver_count'       => $active_driver_count,
            'non_active_driver_count'   => $non_active_driver_count,   
            'active_shuttle_count'      => $active_shuttle_count,      
            'non_active_shuttle_count'  => $non_active_shuttle_count,  
            'pending_reservation'       => $pending_reservation,  
            'cancel_reservation'        => $cancel_reservation,   
            'success_reservation'       => $success_reservation,
            'total_reservation'         => $total_reservation,
            'total_income'              => $total_income
        ]);
    }
    
    public function landingpage()
    {
        return view('customer.landingpage');
    }

    public function logincustomer()
    {
        return view('logincustomer');
    }

    public function register()
    {
        return view('register');
    }
  
    public function jadwal()
    {
        return view('customer.jadwal');
    }
  
    public function reservasi()
    {
        return view('customer.reservasi');
    }
   
    public function riwayat()
    {
        return view('customer.riwayat');
    }
}
