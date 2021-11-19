@extends('admin.templates.index')

@section('content')
<div class="main-content">
    <section class="section">
        @include('components.breadcrumbs', ['menu' => 'Data Booking'])
        <div class="section-body">
            <!-- DataTable with Hover -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-success" data-toggle="modal"
                                data-target="#exampleModal" id="#myBtn">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus"></i>
                                </span>
                                <span class="text">Cetak Booking</span>
                            </button>
                        </div>
                        
                        <div class="card-body">
                            @include('components.alert')
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Customer</th>
                                            <th>Jadwal Keberangkatan</th> 
                                            <th>Snap Token</th>
                                            <th>Booking Code</th>
                                            <th>Status</th>
                                            <th>Total harga</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>
                                    <tfoot class="text-center">
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Customer</th>
                                            <th>Jadwal Keberangkatan</th>
                                            <th>Snap Token</th>
                                            <th>Booking Code</th>
                                            <th>Status</th>
                                            <th>Total harga</th>
                                            <th>Detail</th>
                                        </tr>
                                    </tfoot>
                                    <tbody class="text-center">
                                        @forelse($payments as $payment)
                                            <tr>
                                                <td class="text-left">
                                                    {{ ++$i }}.
                                                </td>
                                                <td>{{ $payment->booking->user->name }}</td>
                                                <td>
                                                    @date($payment->booking->schedule->date_of_depature) - 
                                                    {{ $payment->booking->schedule->depature_time }}
                                                </td> 
                                                <td>{{ $payment->snap_token ?? '-' }}</td>
                                                <td>{{ $payment->booking_code ?? '-' }}</td>
                                                <td>
                                                    @include('components.badge', ['status' => $payment->status])
                                                </td>
                                                <td>@money($payment->total)</td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-md" 
                                                    data-toggle="modal" data-target="#modaldetail-{{$payment->id}}">
                                                    Detail
                                                </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">
                                                    Belum ada data booking
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Row-->
            </div>
        </div>
    </section>
</div>


{{-- Modal Detail --}}
@foreach ($payments as $payment)
<div class="modal fade" id="modaldetail-{{$payment->id}}" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Detail Booking
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-5">
                            {{ $payment->booking->user->name }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-7 col-form-label">Jadwal Keberangkatan</label>
                        <div class="col-sm-12">
                            @date($payment->booking->schedule->date_of_depature) - 
                            {{ $payment->booking->schedule->depature_time }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-7 col-form-label">Nomor Kursi Yang Dipesan</label>
                        <div class="col-sm-5">
                            @foreach ($payment->booking->bookingDetails as $booking)
                                {{ $booking->seat_number }}
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-7 col-form-label">Rute</label>
                        <div class="col-sm-5">
                            {{ $payment->booking->schedule->route->depature }} - 
                            {{ $payment->booking->schedule->route->arrival }} 
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-7 col-form-label">Shuttle</label>
                        <div class="col-sm-5">
                            {{ $payment->booking->schedule->route->shuttle->nopol }} 
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">
                        Tutup
                    </button>
                    
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
{{-- Akhir dari Modal Detail --}}
@endsection