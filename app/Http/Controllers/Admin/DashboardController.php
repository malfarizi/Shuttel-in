<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Driver;
use App\Models\Shuttle;
use App\Models\Payment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        //customer count
        $customer_count = User::where('role', 'Customer')->count();

        //Driver count
        $active_driver_count = Driver::activeStatus()->count();
        
        //Shuttle count
        $active_shuttle_count = Shuttle::activeStatus()->count();

        //Reservation count
        $pending_reservation  = Payment::status('pending')->count();
        $failed_reservation   = Payment::status('failed')->count();
        $success_reservation  = Payment::status('success')->count(); 
        $total_reservation    = Payment::count();

        $total_income         = Payment::totalIncome();
        $payments             = Payment::with('booking')
                                    ->latest()
                                    ->take(5)
                                    ->get();
     
        return view('admin.dashboard', [
            'title'                     => 'Dashboard',
            'customer_count'            => $customer_count,
            'active_driver_count'       => $active_driver_count,
            'active_shuttle_count'      => $active_shuttle_count,      
            'pending_reservation'       => $pending_reservation,  
            'failed_reservation'        => $failed_reservation,   
            'success_reservation'       => $success_reservation,
            'total_reservation'         => $total_reservation,
            'total_income'              => $total_income,
            'payments'                  => $payments
        ]);
    }
}