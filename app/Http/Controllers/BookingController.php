<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Route;

use Illuminate\Http\Request;
use DB;

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
    public function index()
    {
        return view('admin.booking', [
            'title'    => 'Data Booking',
            'bookings' => DB::table('bookings')
                ->join('users', 'users.id', '=', 'bookings.user_id')
                ->join('schedules', 'schedules.id', '=', 'bookings.schedule_id')
                ->join('booking_details', 'booking_details.booking_id', '=', 'bookings.id')
                ->join('routes', 'routes.id', '=', 'schedules.route_id')
                ->join('shuttles', 'shuttles.id', '=', 'routes.shuttle_id')
                ->select('users.*', 'bookings.*', 'schedules.*', 'booking_details.*', 
                         'routes.*', 'shuttles.*')
                ->get()
        ])->with('i');
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
                'user_id'     => '1',
                'schedule_id' => '1',
            ]);
      
            $payload = [
                'customer_details' => [
                    'first_name' => 'TEST',
                ],
                'transaction_details' => [
                    'order_id' => 'ORDER-101',
                    'gross_amount' => 10000
                ],
            ];
                        
            $snapToken = \Midtrans\Snap::getSnapToken($payload);
            $cretae->snap_token = $snapToken;
            $cretae->save();
                
            $this->response['snap_token'] = $snapToken;
            //dd($snapToken);
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
