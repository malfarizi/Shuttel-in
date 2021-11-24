@extends('admin.templates.index')

@section('content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-stats">
                        <div class="card-stats-title"> Reservasi -
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
                                    {{ $pending_reservation }}
                                </div>
                                <div class="card-stats-item-label">Pending</div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">
                                    {{ $cancel_reservation }}
                                </div>
                                <div class="card-stats-item-label">Cancel</div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">
                                    {{ $success_reservation }}
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
                            {{ $total_reservation }}
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
                                <tr>
                                    <th>ID Booking</th>
                                    <th>Customer</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                                @forelse ($payments as $payment)
                                    <tr>
                                        <td>
                                            {{ $payment->booking_id }}
                                        </td>
                                        <td class="font-weight-600">
                                            {{ $payment->booking->user->name }}
                                        </td>
                                        <td>
                                            @include('components.badge', ['status' => $payment->status ])
                                        </td>
                                        <td>{{ $payment->total }}</td>
                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-icon icon-left btn-primary" 
                                                data-toggle="modal" data-target="#exampleModal">
                                                <i class="fas fa-info-circle"></i> Detail
                                            </button>    
                                            <!-- Modal -->
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

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Modal title
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="sumbit" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection
