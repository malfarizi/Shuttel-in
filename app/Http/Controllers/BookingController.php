<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Route;
use App\Models\Payment;
use App\Models\Booking;
use App\Models\Schedule;

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
        $exists_seat = DB::table('booking_details')
                            ->join('bookings', 'bookings.id', 'booking_details.booking_id')
                            ->where('bookings.schedule_id', $schedule->id)
                            ->pluck('seat_number')
                            ->toArray();

        return view('customer.reservasi', [
            'title'         => 'Reservasi', 
            'schedule'      => $schedule,
            'exists_seat'   => $exists_seat
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function riwayat()
    {
         $id = auth()->user()->id;

        $payments = DB::table('payments')
                        ->join('bookings', 'bookings.id', '=', 'payments.booking_id')
                        ->join('users', 'users.id', '=', 'bookings.user_id')
                        ->join('schedules', 'schedules.id', '=', 'bookings.schedule_id')
                        ->join('booking_details', 'booking_details.booking_id', '=', 'bookings.id')
                        ->join('routes', 'routes.id', '=', 'schedules.route_id')
                        ->join('shuttles', 'shuttles.id', '=', 'routes.shuttle_id')
                        ->select('users.*', 'payments.*', 'schedules.*', 'booking_details.*', 
                                'routes.*', 'shuttles.*','bookings.*')
                        ->where('users.id', $id)
                        ->latest('schedules.created_at')
                        ->get();

        return view('customer.riwayat', [
            'title'     => 'Data Riwayat Pemesanan',
            'payments'  => $payments,
        ]);
    }

    public function downloadTicket($id) 
    {
        $data =  Payment::with([
                    'booking.user', 
                    'booking.schedule.route.shuttle', 
                    'booking.bookingDetails'
                ])
                ->where('booking_id', $id)
                ->first();
                
        $pdf  = new \Dompdf\Dompdf();
        $view = view('customer.tiket', compact('data'));
        $pdf->loadHtml($view);
        $pdf->setPaper('A4', 'landscape');
        
        // Render the HTML as PDF
        $pdf->render();

        // Output the generated PDF to Browser
        $pdf->stream();
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

            $seat_number_array  = explode(',',$request->seat_number);
            $count_seat_booking = count($seat_number_array);
           
            for ($i = 0; $i < $count_seat_booking; $i++) { 
                DB::table('booking_details')->insert([
                    'booking_id'   => $booking->id,
                    'subtotal'     => $booking->schedule->route->price,
                    'seat_number'  => $seat_number_array[$i]
                ]);    
            }
            
            Schedule::find($booking->schedule->id)->decrement('seat_number', $count_seat_booking);
            
            $payment = Payment::create([
                'booking_id'    => $booking->id,
                'total'         => $request->total
            ]);
            
            $payload = [
                'customer_details' => [
                    'first_name' => auth()->user()->name ?? 'Farhan',
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
