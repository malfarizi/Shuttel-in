<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Route;
use App\Models\Booking;

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
    public function reservasi()
    {
        return view('customer.reservasi');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            $cretae = Booking::create([
                'id'     => 'SANBOX-'.uniqid(),
                'user_id'     => '1',
                'schedule_id' => '1',
            ]);
            $gross_amount = $request->kursi * 150000;
            $payload = [
                'customer_details' => [
                    'first_name' => $request->name,
                ],
                'transaction_details' => [
                    'order_id' => 'SANBOX-'.uniqid(),
                    'gross_amount' => floatval($gross_amount)
                ],
            ];
                        
            $snapToken = \Midtrans\Snap::getSnapToken($payload);
            $cretae->snap_token = $snapToken;
            $cretae->save();
                
            $this->response['snap_token'] = $snapToken;
            //dd($snapToken);
        });
        
        $respon = response()->json($this->response);
        dd($respon);
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
