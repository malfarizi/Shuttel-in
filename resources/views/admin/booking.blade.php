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
                                            <th>Detail</th>
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
                                            <th>Detail</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @forelse($bookings as $booking)
                                            <tr>
                                                <td>{{ ++$i }}.</td>
                                                <td>{{ $booking->name }}</td>
                                                <td>{{ $booking->date_of_depature }} - {{$booking->depature_time }}</td>
                                                <td>{{ $booking->snap_token }}</td>
                                                <td>{{ $booking->booking_code }}</td>
                                                <td>{{ $booking->seat_number }}</td>
                                                <td>{{ $booking->booking_code }}</td>
                                                <td><button type="button" class="btn btn-success btn-md" 
                                                    data-toggle="modal" data-target="#modaldetail-{{$booking->id}}">
                                                    Detail
                                                </button></td>
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


{{-- Modal Detail --}}
@foreach ($bookings as $booking)
<div class="modal fade" id="modaldetail-{{$booking->id}}" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            {{ $booking->name }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-7 col-form-label">Jadwal Keberangkatan</label>
                        <div class="col-sm-5">
                            {{ $booking->date_of_depature }} - {{$booking->depature_time }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-7 col-form-label">Nomor Kursi Yang Dipesan</label>
                        <div class="col-sm-5">
                            {{ $booking->seat_number }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-7 col-form-label">Rute</label>
                        <div class="col-sm-5">
                            {{ $booking->depature }} - {{ $booking->arrival }} 
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-7 col-form-label">Shuttle</label>
                        <div class="col-sm-5">
                            {{ $booking->nopol }} 
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