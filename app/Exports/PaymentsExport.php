<?php

namespace App\Exports;

use App\Models\Payment;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PaymentsExport implements FromView, ShouldAutoSize
{
    use Exportable;

    public function __construct(int $year, int $month)
    {
        $this->year  = $year;
        $this->month = $month;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $payments = Payment::with(['booking.user', 'booking.schedule.route.shuttle'])
                        ->whereYear('created_at', $this->year)
                        ->whereMonth('created_at', $this->month)
                        //->latest()
                        ->get();
        
        return view('admin.export_payment', compact('payments'));
        
    }
}
