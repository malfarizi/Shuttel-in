<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
                        : $payment->setStatusSuccess(); $this->bookingCode($payment->booking_id);
                }

            } elseif ($transaction == 'settlement') {
                $payment->setStatusSuccess();
                $this->bookingCode($payment->booking_id);
            
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
        $booking->decrement('seat_number', $booking->count());
    }
    public function bookingCode($id)
    {
        $booking = DB::table('bookings')->id($id);
        $code = 'RSV-'.uniqid();
        $booking->uptade('booking_code', $code);
    }
}
