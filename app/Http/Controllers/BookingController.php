<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Route;
use App\Models\Payment;
use App\Models\Booking;
use App\Models\Schedule;
use App\Models\BookingDetail;

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
    public function reservasi(Schedule $schedule)
    {
        return view('customer.reservasi', [
            'title'     => 'Reservasi', 
            'schedule'  => $schedule
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function riwayat()
    {
        return view('customer.riwayat');
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
                'id'          => 'SANBOX-'.uniqid(),
                'user_id'     => auth()->user()->id ?? 1,
                'schedule_id' => $request->schedule_id,
            ]);

            $seat_number_array = explode(',',$request->seat_number);
           
            for ($i = 0; $i < sizeof($seat_number_array); $i++) { 
                BookingDetail::create([
                    'booking_id'   => $booking->id,
                    'subtotal'     => $booking->schedule->route->price,
                    'seat_number'  => $seat_number_array[$i]
                ]);    
            }
            
            $payment = Payment::create([
                'booking_id'    => $booking->id,
                'total'         => $request->total
            ]);
            
            $payload = [
                'customer_details' => [
                    'first_name' => auth()->user()->name ?? 'Farhan',
                ],
                'transaction_details' => [
                    'order_id' => $booking->id,
                    'gross_amount' => floatval($request->total)
                ],
            ];
            
            $snapToken = \Midtrans\Snap::getSnapToken($payload);
            $booking->snap_token = $snapToken;
            $booking->save();
                
            $this->response['snap_token'] = $snapToken;
        });
        
        return response()->json($this->response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
