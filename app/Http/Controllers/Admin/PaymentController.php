<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Payment;
use App\Exports\PaymentsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::with([
                        'booking.user', 
                        'booking.schedule.route.shuttle', 
                        'booking.bookingDetails'
                    ])
                    ->take(200)
                    ->latest()
                    ->get();
    
        return view('admin.payment', [
            'title'    => 'Data Penjualan',
            'payments' => $payments,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function export(Request $request)
    {
        $request->validate([
            'month'     => 'required',
            'year'      => 'required',
            'extension' => 'required|in:csv,xlsx'
        ]);
        
        $payments = Payment::with(['booking.user', 'booking.schedule.route.shuttle.driver'])
                        ->whereYear('created_at', $request->year)
                        ->whereMonth('created_at', $request->month)
                        ->get();

        if ($payments) {
            $name_file = 'Laporan Penjualan.'.$request->extension;
        
            return (new PaymentsExport($request->year, $request->month))->download($name_file);
        }
        
        return back()->with('error', 'Maaf data kosong');
    }
}