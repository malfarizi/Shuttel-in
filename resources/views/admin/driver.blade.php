@extends('admin.templates.index')

@section('content')
<div class="main-content">
    <section class="section">
        @include('admin.templates.components.breadcrumbs', ['menu' => 'Data Driver'])
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
                                <span class="text">Tambah Driver</span>
                            </button>
                        </div>
                        
                        <div class="card-body">
                            @include('admin.templates.components.alert')
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Driver</th>
                                            <th>Status Driver</th>
                                            <th>No Telephone</th>
                                            <th>Alamat</th>
                                            <th>Foto</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Driver</th>
                                            <th>Status Driver</th>
                                            <th>No Telephone</th>
                                            <th>Alamat</th>
                                            <th>Foto</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($drivers as $driver)
                                            <tr>
                                                <td>{{ ++$i }}.</td>
                                                <td>{{ $driver->driver_name }}</td>
                                                <td>{{ $driver->driver_status }}</td>
                                                <td>{{ $driver->number_phone }}</td>
                                                <td>{{ $driver->address }}</td>
                                                <td><img src="{{ url('images/driver_photos/'.$driver->photo) }}"
                                                    style="width: 75px; height: 75px;">
                                                </td>
                                               
                                                <td>
                                                    <div class="input-group">
                                                        <button type="button" class="btn btn-primary btn-md" 
                                                            data-toggle="modal" data-target="#edit-data-{{$driver->id}}">
                                                            <i class="fas fa-user-edit"></i>
                                                        </button>
                                                        <form 
                                                            action="{{route('admin.drivers.destroy', $driver->id)}}" 
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-md delete">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
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

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
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

<!--Modal tambah-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Tambah Driver
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{route('admin.drivers.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Driver</label>
                        <input type="text" class="form-control" name="driver_name"
                            placeholder="Masukan nama Driver">
                    </div>

                    <div class="form-group">
                        <label for="">No Telephone</label>
                        <input type="text" class="form-control" name="number_phone" 
                            placeholder="Masukan No Telephone">
                    </div>

                    <div class="form-group">
                        <label for="">Alamat</label>
                        <textarea class="form-control" name="address" placeholder="Masukan Alamat"></textarea>   
                    </div>

                    <div class="form-group">
                        <label for="">Foto</label>
                        <input type="file" class="form-control" name="photo">
                    </div>

                    <div class="form-group">
                        <label for="">Pilih Status Driver</label>
                        <select name="driver_status" class="form-control">
                            <option value="">Pilih Status Driver</option>
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
@foreach($drivers as $driver)
<div class="modal fade" id="edit-data-{{$driver->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Edit Driver
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{route('admin.drivers.update', $driver)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="modal-body">    
                    <div class="form-group">
                        <label for="">Nama Driver</label>
                        <input type="text" class="form-control" name="driver_name"
                            value="{{$driver->driver_name}}">
                    </div>

                    <div class="form-group">
                        <label for="">No Telephone</label>
                        <input type="text" class="form-control" name="number_phone" 
                            value="{{$driver->number_phone}}">
                    </div>

                    <div class="form-group">
                        <label for="">Alamat</label>
                        <input type="text" class="form-control" name="address" value="{{$driver->address}}">
                        
                    </div>

                    <div class="form-group">
                        <label for="">Foto</label>
                        <br>
                        <img src="{{ url('images/driver_photos/'.$driver->photo) }}"
                            style="width: 75px; height: 75px;">
                        <input type="file" class="form-control" name="photo"
                            value="Masukan Foto Driver">
                    </div>


                    <div class="form-group">
                        <label for="">Pilih Status Driver</label>
                        <select name="driver_status" class="form-control">
                            <option 
                                value="Aktif" 
                                {{$driver->driver_status === 'Aktif' ? 'selected' : '' }}
                            >
                                Aktif
                            </option>
                            <option 
                                value="Tidak Aktif"
                                {{$driver->driver_status === 'Tidak Aktif' ? 'selected' : '' }}
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