@extends('admin.templates.index')

@section('content')
<div class="main-content">
    <section class="section">
        @include('admin.templates.components.breadcrumbs', ['menu' => 'Data Booking'])
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
                            @include('admin.templates.components.alert')
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Customer</th>
                                            <th>Jadwal Keberangkatan</th>
                                            <th>Snap Token</th>
                                            <th>Booking Code</th>
                                            <th>Nomor kursi yang dipesan</th>
                                            <th>Total harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Customer</th>
                                            <th>Jadwal Keberangkatan</th>
                                            <th>Snap Token</th>
                                            <th>Booking Code</th>
                                            <th>Nomor kursi yang dipesan</th>
                                            <th>Total harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @forelse($bookings as $booking)
                                            <tr>
                                                <td>{{ ++$i }}.</td>
                                                <td>{{ $booking->customer->name }}</td>
                                                <td>{{ $booking->schedule_id }}</td>
                                                <td>{{ $booking->snap_token }}</td>
                                                <td>{{ $booking->booking_code }}</td>
                                                <td>{{ $booking->booking_code }}</td>
                                                <td>{{ $booking->booking_code }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-md" 
                                                        data-toggle="modal" data-target="#edit-data">
                                                        <i class="fas fa-user-edit"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <td colspan="8" class="text-center">
                                                Belum ada data booking
                                            </td>
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
@endsection