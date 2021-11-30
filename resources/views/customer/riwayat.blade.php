@extends('customer.template')

@section('content')

<!-- ======= riwayat Section ======= -->
<section id="jadwal" class="jadwal">

    <div class="container mt-5" data-aos="fade-up">
        <div class="box">
            <table class=" table table-responsive table-borderless">
                <thead c>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Kode Reservasi</th>
                        <th scope="col">Rute</th>
                        <th scope="col">Jadwal Keberangkatan</th>
                        <th scope="col">Nomor Kursi Yang Dipesan</th>
                        <th scope="col">Total</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($payments as $payment)
                    <tr>
                        <th scope="row">{{$loop->iteration}}.</th>
                        
                        <td>{{$payment->booking_id}}</td>
                        <td>{{$payment->depature}} - {{$payment->arrival}}</td>
                        <td>{{$payment->date_of_depature}} - {{$payment->depature_time}}</td>
                        <td>{{$payment->seat_number}}</td>
                        <td>{{$payment->total}}</td>
                        <td>{{$payment->status}}</td>
                        <td>
                            {{-- <button type="button" class="btn btn-sm btn-success btn-icon"><i
                                    class="bi bi-eye"></i></button> --}}
                        @if($payment->status == 'capture')
                            <a 
                                href="{{ route('tiket.download', $payment->booking_id) }}" 
                                target="_blank"
                                class="btn btn-sm btn-primary btn-icon"                            >
                            <i class="bi bi-printer"></i>
                            </a>
                        @elseif($payment->status == "pending")
                        <button type="button" class="btn btn-sm btn-warning btn-icon">
                            <i class="bi bi-cash"></i>
                        </button>
                        @endif
                            
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section><!-- End Pricing Section -->
@endsection