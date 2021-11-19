<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __invoke()
    {
        $payments = Payment::with([
                        'booking.user', 'booking.schedule.route.shuttle'
                    ])
                    ->latest()
                    ->get();
    
        return view('admin.payment', [
            'title'    => 'Data Booking',
            'payments' => $payments,
        ])->with('i');
    }
}