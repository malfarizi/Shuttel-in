<?php

namespace App\Http\Controllers;

use DB;
use PDF;
use App\Models\Booking;
use App\Models\Payment;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function __construct() {
          // Set your Merchant Server Key
          \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
          // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
          \Midtrans\Config::$isProduction = false;
          // Set sanitization on (default)
          \Midtrans\Config::$isSanitized = true;
          // Set 3DS transaction for credit card to true
          \Midtrans\Config::$is3ds = true;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reservasi(\App\Models\Schedule $schedule)
    {   
        $exists_seat = DB::table('booking_details')
                            ->join('bookings', 'bookings.id', 'booking_details.booking_id')
                            ->where('bookings.schedule_id', $schedule->id)
                            ->pluck('seat_number')
                            ->toArray();

        return view('customer.reservasi', compact('schedule', 'exists_seat'))
                ->withTitle('Daftar Jadwal');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function riwayat()
    {
         $payments = Payment::with([
                            'booking.user', 
                            'booking.schedule.route.shuttle', 
                            'booking.bookingDetails'
                        ])
                        ->whereHas('booking.user', function($query) {
                            $query->where('id', auth()->user()->id);
                        })
                        ->latest()
                        ->get();

        return view('customer.riwayat', [
            'title'     => 'Data Riwayat Pemesanan',
            'payments'  => $payments,
        ]);
    }

    public function downloadTicket($id) 
    {
        $payment =  Payment::with([
                        'booking.user', 
                        'booking.schedule.route.shuttle', 
                        'booking.bookingDetails'
                    ])
                    ->where('booking_id', $id)
                    ->first();
        $customPaper = array(0,0,390,620);
        $pdf = PDF::loadView('customer.tiket', compact('payment'))->setPaper($customPaper);
  
        return $pdf->stream($payment->booking_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::transaction(function () use($request) {
            $booking = Booking::create([
                'id'          => 'Shuttle-'.uniqid(),
                'user_id'     => auth()->user()->id,
                'schedule_id' => $request->schedule_id,
            ]);

            $seat_number_array  = explode(',',$request->seat_number);
            $count_seat_booking = count($seat_number_array);
           
            for ($i = 0; $i < $count_seat_booking; $i++) { 
                DB::table('booking_details')->insert([
                    'booking_id'   => $booking->id,
                    'subtotal'     => $booking->schedule->route->price,
                    'seat_number'  => $seat_number_array[$i]
                ]);    
            }

            $booking->schedule->decrement('seat_capacity', $count_seat_booking);

            $booking->payment()->create($request->only('total'));
            
            $payload = [
                'customer_details' => [
                    'first_name' => auth()->user()->name,
                ],
                'transaction_details' => [
                    'order_id'      => $booking->id,
                    'gross_amount'  => floatval($request->total)
                ],
            ];
            
            $snapToken           = \Midtrans\Snap::getSnapToken($payload);
            $booking->snap_token = $snapToken;
            $booking->save();
                
            $this->response['snap_token'] = $snapToken;
        });
        
        return response()->json($this->response);
    }
}
