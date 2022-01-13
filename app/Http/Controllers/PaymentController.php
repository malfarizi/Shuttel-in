<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{   
    private $uri;
    private $header;

    public function __construct() 
    {
        $this->uri      = config('midtrans.api_url');
        $this->header   = ['Authorization' => "Basic ". config('midtrans.authorize')];
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true; 
    }

    public function notification($id)
    {
        $notif = Http::withHeaders($this->header)->get("$this->uri/$id/status")->json();
        
        DB::transaction(function () use($notif) {
            $transaction = $notif['transaction_status'];
            $orderId     = $notif['order_id'];
            $fraud       = $notif['fraud_status'];
            $type        = $notif['payment_type'];
            $payment     = Payment::where('booking_id', $orderId)->first();
            if ($transaction == 'capture') {
                if ($type == 'credit_card') {
                    $fraud == 'challenge'
                        ? $payment->setStatusPending()
                        : $payment->setStatusSuccess(); $this->bookingCode($payment->booking_id);
                }
            } elseif ($transaction == 'settlement') {
                $payment->setStatusSuccess();
                $payment->bookingCode($orderId);
            } elseif ($transaction == 'pending') {
                $payment->setStatusPending();
            } elseif (in_array($transaction, ['deny', 'cancel', 'expire'])) {
                $transaction == 'expire' 
                    ? $payment->setStatusExpired() 
                    : $payment->setStatusFailed();                
                $this->backSeatCapacity($payment->booking_id);
            }
        });
        
        return;
    }

    public function backSeatCapacity($id) 
    {
        $booking            = DB::table('bookings')->findOrFail($id);
        $booking_detail     = DB::table('booking_details')->whereBookingId($id);
        $jadwal             = DB::table('schedules')
                                ->whereId($booking->schedule_id)
                                ->increment('seat_capacity', $booking_detail->count());
        $booking_detail->delete();
    } 

    public function bookingCode($id)
    {
        DB::table('bookings')->whereId($id)->update(['booking_code' => 'RSV-'.uniqid()]);
    }
}
