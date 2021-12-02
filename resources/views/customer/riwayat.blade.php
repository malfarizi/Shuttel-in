@extends('customer.template')

@section('content')

<!-- ======= riwayat Section ======= -->
<section id="jadwal" class="jadwal">

    <div class="container mt-5" data-aos="fade-up">
        <div class="box table table-responsive">
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Kode Reservasi</th>
                        <th scope="col" width="20%">Rute</th>
                        <th scope="col" width="18%">Jadwal Keberangkatan</th>
                        <th scope="col" width="10%">Nomor Kursi Yang Dipesan</th>
                        <th scope="col">Total</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $payment)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}.</th>

                        <td>{{ $payment->booking->booking_code }}</td>
                        <td>{{ $payment->booking->schedule->route->depature_arrival }}</td>
                        <td>{{ $payment->booking->schedule->dateTimeDepature }}</td>
                        <td>
                            @foreach($payment->booking->bookingDetails as $booking)
                            {{ $booking->seat_number ?? '-' }}
                            @endforeach
                        </td>
                        <td>{{$payment->total_rupiah}}</td>
                        <td>
                            @include('components.badge', [
                            'status' => $payment->status,
                            'isBootstrap5' => 1
                            ])
                        </td>
                        <td>
                            @if ($payment->status === 'success')
                            <a href="{{ route('tiket.download', $payment->booking_id) }}" target="_blank"
                                class="btn btn-sm btn-primary btn-icon">
                                <i class="bi bi-printer">&nbsp; Cetak</i>
                            </a>
                            @endif

                            @if ($payment->status === 'pending')
                            <button type="button" class="btn btn-sm btn-warning btn-icon"
                                onclick="snap.pay('{{$payment->snap_token}}')">
                                <i class="bi bi-cash">&nbsp; Bayar</i>
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

@push('scripts')
<!-- MIDTRANS -->
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{env('MIDTRANS_CLIENT_KEY')}}"></script>
<script type="text/javascript">
    // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
          // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
          window.snap.pay('snap_token');
          // customer will be redirected after completing payment pop-up
        });
</script>
@endpush