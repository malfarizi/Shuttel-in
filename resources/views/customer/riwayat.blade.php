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
                    @foreach ($payments as $payment)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}.</th>

                        <td>{{ $payment->booking_code }}</td>
                        <td>{{ $payment->schedule->route->getDepatureArrival() }}</td>
                        <td>{{ $payment->schedule->getDateTimeDepature() }}</td>
                        <td>
                            @foreach($payment->bookingDetails as $booking)
                                {{ $booking->seat_number ?? '-' }} @if(!$loop->last) , @endif
                            @endforeach
                        </td>
                        @isset($payment->payment)
                            <td>@money($payment->payment->total)</td>
                        
                            <td>
                                @include('components.badge', [
                                    'status'        => $payment->payment->status,
                                    'isBootstrap5'  => 1
                                ])
                            </td>
                            <td>
                                @if ($payment->payment->status == 'success')
                                    <a href="{{ route('tiket.download', $payment->id) }}" 
                                        target="_blank"
                                        class="btn btn-sm btn-primary btn-icon">
                                        <i class="bi bi-printer">&nbsp; Cetak</i>
                                    </a>
                                @endif

                                @if ($payment->payment->status == 'pending')
                                    <button type="button" class="btn btn-sm btn-warning btn-icon"
                                        onclick="snap.pay('{{ $payment->snap_token }}')">
                                        <i class="bi bi-cash">&nbsp; Bayar</i>
                                    </button>
                                @endif
                            </td>
                        @endisset
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
    data-client-key="{{config('midtrans.client_key')}}"></script>
<script type="text/javascript">
    // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
            window.snap.pay('snap_token');
        });
</script>
@endpush