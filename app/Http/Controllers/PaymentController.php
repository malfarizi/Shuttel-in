<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
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

    public function notification()
    {
        $notif = new \Midtrans\Notification();

        DB::transaction(function () use($notif) {
            $transaction = $notif->transaction_status;
            $orderId     = $notif->order_id;
            $fraud       = $notif->fraud_status;
            $type        = $notification->payment_type;
            $payment     = Payment::where('booking_id', $orderId)->first();
                
            if ($transaction == 'capture') {
                if ($type == 'credit_card') {
                    $fraud == 'challenge'
                        ? $payment->setStatusPending()
                        : $payment->setStatusSuccess();
                }

            } elseif ($transaction == 'settlement') {
                $payment->setStatusSuccess();
            
            } elseif($transaction == 'pending'){
                $payment->setStatusPending();
            
            } elseif (in_array($transaction, ['deny', 'cancel'])) {
                $payment->setStatusFailed();                
                $this->countSeatNumber($payment->booking_id);

            } elseif ($transaction == 'expire') {
                $payment->setStatusExpired();
                $this->countSeatNumber($payment->booking_id);
            }

        });
        
        return;
    }

    public function countSeatNumber($id) 
    {
        $booking = DB::table('booking_details')->whereBookingId($id);
        $booking->decrement('seat_number', $booking->count);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
       //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
