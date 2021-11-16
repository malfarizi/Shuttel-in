@extends('admin.templates.index')

@section('content')
<div class="main-content">
    <section class="section">
        @include('admin.templates.components.breadcrumbs', ['menu' => 'Data Jadwal'])
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
                                <span class="text">Tambah Jadwal</span>
                            </button>
                        </div>

                        <div class="card-body">
                            @include('admin.templates.components.alert')
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tanggal Keberangkatan</th>
                                            <th width="10">Waktu Keberangkatan</th>
                                            <th>Kapasitas Kursi</th>
                                            <th>Status Jadwal</th>
                                            <th>Rute</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tanggal Keberangkatan</th>
                                            <th>Waktu Keberangkatan</th>
                                            <th>Kapasitas Kursi</th>
                                            <th>Status Jadwal</th>
                                            <th>Rute</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($schedules as $schedule)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>@date($schedule->date_of_depature)</td>
                                            <td>{{ $schedule->depature_time }}</td>
                                            <td>{{ $schedule->seat_capacity }}</td>
                                            <td>{{ $schedule->schedule_status }}</td>
                                            <td>
                                                {{ $schedule->route->depature.' - ' .$schedule->route->arrival}}
                                            </td>
                                            <td>
                                                <button type="button" 
                                                    class="btn btn-primary" 
                                                    data-toggle="modal"
                                                    data-target="#edit-data-{{ $schedule->id }}"
                                                >
                                                    <i class="fas fa-user-edit"></i>
                                                </button>
                                                <form action="{{route('admin.schedules.destroy', $schedule)}}" 
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
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

<!--Modal tambah-->
<div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Tambah Jadwal
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.schedules.store')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Tanggal Keberangkatan</label>
                        <input type="date" class="form-control" name="date_of_depature">
                    </div>

                    <div class="form-group">
                        <label for="">Waktu Keberangkatan</label>
                        <input type="time" class="form-control" name="depature_time">
                    </div>

                    <div class="form-group">
                        <label for="">Pilih Rute</label>
                        <select name="route_id" class="select2 form-control">
                            <option value="" disabled selected>
                                Pilih Rute
                            </option>
                            @foreach ($routes as $route)
                                <option value="{{ $route->id }}">
                                    {{ $route->depature. '-' .$route->arrival}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Pilih Status Jadwal</label>
                        <select name="schedule_status" class="form-control">
                            <option value="" disabled selected>
                                Pilih Status Jadwal
                            </option>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="sumbit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Modal Edit-->
@foreach($schedules as $schedule)
<div class="modal fade" id="edit-data-{{$schedule->id}}" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Edit Jadwal
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.schedules.update', $schedule)}}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Tanggal Keberangkatan</label>
                        <input 
                            type="date" 
                            class="form-control" 
                            name="date_of_depature" 
                            value="{{ $schedule->date_of_depature }}"
                        >
                    </div>
    
                    <div class="form-group">
                        <label for="">Waktu Keberangkatan</label>
                        <input 
                            type="time" 
                            class="form-control" 
                            name="depature_time"
                            value="{{ $schedule->depature_time }}">
                    </div>
    
                    <div class="form-group">
                        <label for=""> Kapasitas Kursi</label>
                        <input 
                            type="number" 
                            min="1" 
                            max="7" 
                            class="form-control" 
                            name="seat_capacity"
                            value="{{ $schedule->seat_capacity }}">
                    </div>
    
                    <div class="form-group">
                        <label for="">Pilih Rute</label>
                        <select name="route_id" class="form-control">
                            @foreach ($routes as $route)
                                @if($schedule->route_id != $route->id)
                                    <option value="{{ $route->id }}">
                                        {{ $route->depature. '-' .$route->arrival}}
                                    </option>
                                @else
                                    <option value="{{ $route->id }}" selected>
                                        {{ $route->depature. '-' .$route->arrival}}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
    
                    <div class="form-group">
                        <select name="schedule_status" class="form-control">
                            <option 
                                value="Aktif" 
                                {{$schedule->schedule_status === 'Aktif' ? 'selected' : '' }}
                            >
                                Aktif
                            </option>
                            <option 
                                value="Tidak Aktif"
                                {{$schedule->schedule_status === 'Tidak Aktif' ? 'selected' : '' }}
                            >
                                Tidak Aktif
                            </option>
                        </select>
                    </div>
    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="sumbit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection

@push('styles')
    <link rel="stylesheet" href="{{asset('/assets/css/select2.min.css')}}"> 
@endpush

@push('scripts')
    <script src="{{asset('/assets/js/select2.full.min.js')}}"></script> 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>   
        $('.select2').select2({
            dropdownParent: $('#exampleModal')
        });

        $('.delete').on('click', function(e){
            e.preventDefault();
            var form =  $(this).closest("form");
            Swal.fire({
                title: 'Apakah kamu yakin hapus data ini?',
                text: "Data yang sudah dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus saja!'
                }).then((result.value) => {
                    if (result) {
                        form.submit();
                    }
            })
        });
    </script>
@endpush