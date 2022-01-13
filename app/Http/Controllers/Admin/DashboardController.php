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
        $customer_count       = User::whereRole('Customer')->count();
        $active_driver_count  = Driver::activeStatus()->count();
        $active_shuttle_count = Shuttle::activeStatus()->count();
        $payments             = Payment::with([
                                    'booking.user', 
                                    'booking.schedule.route.shuttle.driver', 
                                    'booking.bookingDetails'
                                ])
                                ->latest()
                                ->get();

        $count_status = $payments->groupBy('status')->map->count()->except('expired');
        
        $total_income = $payments->where('status', 'success')->sum('total');
        $total_income = "Rp. ".number_format($total_income, 0, ',', '.');
        
        return view('admin.dashboard', [
            'title'                 => 'Dashboard',
            'customer_count'        => $customer_count,
            'active_driver_count'   => $active_driver_count,
            'active_shuttle_count'  => $active_shuttle_count,
            'count_status'          => $count_status,
            'total_income'          => $total_income,
            'payments'              => $payments
        ]);
    }
}