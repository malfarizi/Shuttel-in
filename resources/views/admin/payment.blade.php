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
                        <form action="{{route('admin.export.payment')}}" method="GET">
                            @csrf           
                            <div class="card-header">
                                <div class="form-group mr-3">
                                    <select name="month" 
                                        class="form-control @error('month') is-invalid @enderror">
                                        <option value="">Pilih Bulan</option>
                                        <option value="01">Januari</option>
                                        <option value="02">Februari</option>
                                        <option value="03">Maret</option>
                                        <option value="04">April</option>
                                        <option value="05">Mei</option>
                                        <option value="06">Juni</option>
                                        <option value="07">Juli</option>
                                        <option value="08">Agustus</option>
                                        <option value="09">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                    
                                    @error('month')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mr-3">
                                    <select name="year" 
                                        class="form-control @error('year') is-invalid @enderror">
                                        <option value="">Pilih Tahun</option>
                                        @foreach ($payments->unique('created_at') as $payment)
                                            <option value="{{ $payment->created_at->format('Y') }}">
                                                {{ $payment->created_at->format('Y') }}
                                            </option>
                                        @endforeach
                                    </select>
                                    
                                    @error('year')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mr-3">
                                    <select name="extension" 
                                        class="form-control @error('extension') is-invalid @enderror">
                                        <option value="">Pilih Format</option>
                                        <option value="csv">CSV</option>
                                        <option value="xlsx">XLSX</option>
                                    </select>
                                    
                                    @error('extension')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-print"></i>
                                        </span>
                                        <span class="text">
                                            Cetak Booking
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </form>
                        
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
                                                    {{ $loop->iteration }}.
                                                </td>
                                                <td>
                                                    {{ $payment->booking->user->name }}
                                                </td>
                                                <td>
                                                    {{ $payment->booking->schedule->dateTimeDepature }}
                                                </td> 
                                                <td>{{ $payment->snap_token ?? '-' }}</td>
                                                <td>{{ $payment->booking_code ?? '-' }}</td>
                                                <td>
                                                    @include('components.badge', ['status' => $payment->status])
                                                </td>
                                                <td>{{ $payment->total }}</td>
                                                <td>
                                                    <button 
                                                        type="button" 
                                                        class="btn btn-success btn-md" 
                                                        data-toggle="modal" 
                                                        data-target="#modaldetail-{{ $payment->id }}"
                                                    >
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
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
@endforeach
{{-- Akhir dari Modal Detail --}}
@endsection

@push('styles')
    {{-- Datatable CSS Libraries --}}
    <link rel="stylesheet" href="{{ asset('assets/css/datatables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/datatables/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/datatables/select.bootstrap4.min.css')}}">
@endpush

@push('scripts')
    {{-- Datatable JS Libraries --}}
    <script src="{{asset('assets/js/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.select.min.js')}}"></script>
    <!-- Page Specific JS File -->
    <script src="{{asset('assets/js/page/modules-datatables.js')}}"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js" type="text/javascript"></script>
@endpush