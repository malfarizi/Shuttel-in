@extends('admin.templates.index')

@section('content')
<div class="main-content">
  <section class="section">
        @include('admin.templates.components.breadcrumbs', ['menu' => 'Data Shuttle'])
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
                                <span class="text">Tambah Shuttle</span>
                            </button>
                        </div>

                        <div class="card-body">
                            @include('admin.templates.components.alert')
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nopol Shuttle</th>
                                            <th>Status Shuttle</th>
                                            <th>Driver</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nopol Shuttle</th>
                                            <th>Status Shuttle</th>
                                            <th>Driver</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($shuttles as $shuttle)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{$shuttle->nopol}}</td>
                                            <td>{{$shuttle->shuttle_status}}</td>
                                            <td>{{$shuttle->driver->driver_name}}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary" 
                                                    data-toggle="modal" data-target="#edit-data-{{$shuttle->id}}">
                                                    <i class="fas fa-user-edit"></i>
                                                </button>
                                                
                                                <form action="{{route('admin.shuttles.destroy', $shuttle->id)}}" 
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
                    Tambah Shuttle
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{route('admin.shuttles.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nopol Shuttle</label>
                        <input type="text" class="form-control" id="" name="nopol"
                            value="Masukan Nopol Shuttle">
                    </div>

                    <div class="form-group">
                        <label for="">Pilih Status Shuttle</label>
                        <select name="shuttle_status" class="form-control">
                            <option value="">Pilih Status Shuttle</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                            
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Pilih Driver</label>
                        <select class="select2 form-control" name="driver_id">
                            <option value="">Pilih Driver</option>
                            @foreach ($drivers as $driver)
                                @if ($driver->driver_status === "Aktif")
                                    <option value="{{ $driver->id }}">
                                        {{ $driver->driver_name }}
                                    </option>    
                                @endif
                            @endforeach
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

@foreach ($shuttles as $shuttle)
<!--Modal Edit-->
<div class="modal fade" id="edit-data-{{$shuttle->id}}" 
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('admin.shuttles.update', $shuttle)}}" method="POST">
                @csrf
                @method('PUT')   
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Edit Shuttle
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nopol Shuttle</label>
                        <input type="text" class="form-control" name="nopol"
                            value="{{ $shuttle->nopol }}">
                    </div>

                    <div class="form-group">
                        <label for="">Pilih Status Shuttle</label>
                        <select name="shuttle_status" class="form-control">
                            <option value="">Pilih Status Shuttle</option>
                            <option 
                                value="Aktif"
                                {{$shuttle->shuttle_status === 'Aktif' ? 'selected' : ''}}
                            >
                                Aktif
                            </option>
                            <option 
                                value="Tidak Aktif"
                                {{$shuttle->shuttle_status === 'Tidak Aktif' ? 'selected' : ''}}
                            >
                                Tidak Aktif
                            </option>
                            
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Pilih Driver</label>
                        <select class="select2 form-control" name="driver_id">
                            <option value="{{$shuttle->driver_id}}">
                                {{ $shuttle->driver->driver_name }}
                            </option>
                            @foreach ($drivers as $driver)
                                @if ($driver->driver_status === "Aktif" && $shuttle->driver_id != $driver->id )
                                    <option value="{{ $driver->id }}">
                                        {{ $driver->driver_name }}
                                    </option>    
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
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
                }).then((result) => {
                    if (result.value) {
                        form.submit();
                    }
            })
        });
    </script>
@endpush