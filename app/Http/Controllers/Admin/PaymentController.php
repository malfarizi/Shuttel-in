<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Payment;
use App\Exports\PaymentsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PaymentController extends Controller
{
    public function index()
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

    public function export(Request $request)
    {
        $request->validate([
            'month'     => 'required',
            'year'      => 'required',
            'extension' => 'required'
        ]);
        
        $payments = Payment::with(['booking.user', 'booking.schedule.route.shuttle'])
                        ->whereYear('created_at', $request->year)
                        ->whereMonth('created_at', $request->month)
                        //->latest()
                        ->get();

        if ($payments) {
            $name_file = 'Laporan Penjualan.'.$request->extension;
        
            return (new PaymentsExport($request->year, $request->month))->download($name_file);
        }
        
        return back()->with('error', 'Maaf data kosong');
    }
}