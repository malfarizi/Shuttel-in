<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Payment;
use App\Models\BookingDetail;
use App\Models\Booking;
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
        // $notif = new \Midtrans\Notification();
       //Shuttle-61a7cd2ef0ea6 gagal
       //Shuttle-61a7b787e0056 success
        $uri     = 'https://api.sandbox.midtrans.com/v2/Shuttle-61a7cd2ef0ea6/status';
        $headers = [ "Authorization" => "Basic U0ItTWlkLXNlcnZlci1sU1lLQ2UzRktjUmRFMEpXbFhJZjMwQ3I6" ];

        $notif = Http::withHeaders($headers)->get($uri)->json();
        
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
        $schedule = DB::table('bookings')->find($id);
        $booking = DB::table('booking_details')->whereBookingId($id)->count();
        //dd($booking);
        $jadwal = DB::table('schedules')->where('id',$schedule->schedule_id)->increment('seat_capacity' , $booking);
        $delete =  DB::table('booking_details')->where('booking_id',$id)->delete();
        //$jadwal->update(['seat_capacity' => $booking]);
        //$jadwal->increment('seat_capacity' , $booking);
        //$booking->increment('seat_capacity', $booking->count);
        // $payments = Payment::with([
        //     'booking.schedule', 
        //     'booking.bookingDetails'
        // ])
        // ->whereHas('booking.user', function($query) {
        //     $query->where('id', auth()->user()->id);
        // })
        // ->latest()
        // ->get();
        
    } 

    public function bookingCode($id)
    {
        
        $code = 'RSV-'.uniqid();
        $booking =  Booking::findorfail($id);
        $booking->booking_code = $code;
        $booking->save();
        //dd($booking);
    }
    public function getStatus() 
    {
        $uri     = 'https://api.sandbox.midtrans.com/v2/Shuttle-61a7b787e0056/status';
        $headers = [ "Authorization" => "Basic U0ItTWlkLXNlcnZlci1sU1lLQ2UzRktjUmRFMEpXbFhJZjMwQ3I6" ];

        $response = Http::withHeaders($headers)->get($uri);
        return $response->json();
    }
}
