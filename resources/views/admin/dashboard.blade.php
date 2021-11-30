@extends('admin.templates.index')

@section('content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-stats">
                        <div class="card-stats-title"> Reservasi
                            {{-- <div class="dropdown d-inline">
                                <a class="font-weight-600 dropdown-toggle" 
                                    data-toggle="dropdown" href="#" id="orders-month">
                                    October
                                </a>
                                <ul class="dropdown-menu dropdown-menu-sm">
                                    <li class="dropdown-title">Select Month</li>
                                    <li><a href="#" class="dropdown-item">January</a></li>
                                    <li><a href="#" class="dropdown-item">February</a></li>
                                    <li><a href="#" class="dropdown-item">March</a></li>
                                    <li><a href="#" class="dropdown-item">April</a></li>
                                    <li><a href="#" class="dropdown-item">May</a></li>
                                    <li><a href="#" class="dropdown-item">June</a></li>
                                    <li><a href="#" class="dropdown-item">July</a></li>
                                    <li><a href="#" class="dropdown-item">August</a></li>
                                    <li><a href="#" class="dropdown-item">September</a></li>
                                    <li><a href="#" class="dropdown-item">October</a></li>
                                    <li><a href="#" class="dropdown-item">November</a></li>
                                    <li><a href="#" class="dropdown-item">December</a></li>
                                </ul>
                            </div> --}}
                        </div>
                        <div class="card-stats-items">
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">
                                    {{ $count_status->get('pending') }}
                                </div>
                                <div class="card-stats-item-label">Pending</div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">
                                    {{ $count_status->get('failed') }}
                                </div>
                                <div class="card-stats-item-label">Failed</div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">
                                    {{ $count_status->get('success') }}
                                </div>
                                <div class="card-stats-item-label">Completed</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-archive"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Reservasi</h4>
                        </div>
                        <div class="card-body">
                            {{ $payments->count() }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-stats">
                        <div class="card-stats-title">Lainnya</div>
                        <div class="card-stats-items">
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">
                                    {{ $active_driver_count }}
                                </div>
                                <div class="card-stats-item-label">Driver</div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">
                                    {{ $active_shuttle_count }}
                                </div>
                                <div class="card-stats-item-label">Shuttle</div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">
                                    {{ $customer_count }}
                                </div>
                                <div class="card-stats-item-label">Customer</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header"></div>
                        <div class="card-body"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Penjualan</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_income }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Penjualan</h4>
                        <div class="card-header-action">
                            <a href="{{route('admin.payments')}}" class="btn btn-danger">
                                View More <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive table-invoice">
                            <table class="table table-striped">
                                <tr class="text-center">
                                    <th>Booking Code</th>
                                    <th>Customer</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>

                                @forelse ($payments->take(5) as $payment)
                                    <tr class="text-center">
                                        <td >
                                            {{ $payment->booking->booking_code ?? '-' }}
                                        </td>
                                        <td class="font-weight-600">
                                            {{ $payment->booking->user->name }}
                                        </td>
                                        <td>
                                            @include('components.badge', ['status' => $payment->status ])
                                        </td>
                                        <td>{{ $payment->total_rupiah }}</td>
                                        <td>
                                            <button 
                                                type="button" 
                                                class="btn btn-icon icon-left btn-primary" 
                                                data-toggle="modal" 
                                                data-target="#modaldetail-{{ $payment->id }}"
                                            >
                                                <i class="fas fa-info-circle"></i> Detail
                                            </button>
                                        </td>
                                    </tr>    
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            Belum ada data
                                        </td>
                                    </tr>
                                @endforelse
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@foreach ($payments->take(5) as $payment)
<div class="modal fade" id="modaldetail-{{$payment->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <label for="name" class="col-sm-7 col-form-label">
                        Jadwal Keberangkatan
                    </label>
                    <div class="col-sm-12">
                        {{ $payment->booking->schedule->dateTimeDepature }}
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="col-sm-7 col-form-label">
                        Nomor Kursi Yang Dipesan
                    </label>
                    <div class="col-sm-5">
                        @foreach ($payment->booking->bookingDetails as $booking)
                            {{ $booking->seat_number }}
                        @endforeach
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="col-sm-7 col-form-label">Rute</label>
                    <div class="col-sm-12">
                        {{ $payment->booking->schedule->route->depature_arrival }}
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="col-sm-7 col-form-label">Shuttle</label>
                    <div class="col-sm-5">
                        {{ $payment->booking->schedule->route->shuttle->nopol }} 
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="col-sm-7 col-form-label">Nama Driver</label>
                    <div class="col-sm-5">
                        {{ $payment->booking->schedule->route->shuttle->driver->driver_name }} 
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="col-sm-7 col-form-label">Nomor Telepon Driver</label>
                    <div class="col-sm-5">
                        {{ $payment->booking->schedule->route->shuttle->driver->phone_number }} 
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
