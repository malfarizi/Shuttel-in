@extends('admin.templates.index')

@section('content')
<div class="main-content">
    <section class="section">
        @include('components.breadcrumbs', ['menu' => 'Data Driver'])
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
                            @include('components.alert')
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
                                        @forelse ($drivers as $driver)
                                            <tr>
                                                <td>{{ ++$i }}.</td>
                                                <td>{{ $driver->driver_name }}</td>
                                                <td>{{ $driver->driver_status }}</td>
                                                <td>{{ $driver->number_phone }}</td>
                                                <td width="15">{{ $driver->address }}</td>
                                                <td>
                                                    @if($driver->photo)
                                                        <img src="{{ url('images/driver_photos/'.$driver->photo) }}"
                                                        style="width: 75px; height: 75px;">
                                                    @else
                                                        <img src="https://via.placeholder.com/80">
                                                    @endif
                                                </td>
                                               
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-md" 
                                                        data-toggle="modal" data-target="#edit-data-{{$driver->id}}">
                                                        <i class="fas fa-user-edit"></i>
                                                    </button>
                                                    <form 
                                                        action="{{route('admin.drivers.destroy', $driver->id)}}" 
                                                        method="POST" 
                                                        class="d-inline"
                                                    >
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-md delete">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">
                                                    Belum ada data
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
                        <input type="text" class="form-control integerInput" name="driver_name"
                            placeholder="Masukan nama Driver">
                    </div>

                    <div class="form-group">
                        <label for="">No Telephone</label>
                        <input type="text" class="form-control" name="number_phone" 
                            placeholder="Masukan No Telephone">
                    </div>

                    <div class="form-group">
                        <label for="">Alamat</label>
                        <textarea class="form-control h-25" rows="5" 
                            name="address" placeholder="Masukan Alamat"></textarea>   
                    </div>

                    <div class="form-group">
                        <label for="">Foto</label>
                        <input type="file" class="form-control" name="photo">
                    </div>

                    <div class="form-group">
                        <label for="">Pilih Status Driver</label>
                        <select name="driver_status" class="form-control">
                            <option value="" disabled selected>
                                Pilih Status Driver
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
                        <input type="text" class="form-control integerInput" name="number_phone" 
                            value="{{$driver->number_phone}}">
                    </div>

                    <div class="form-group">
                        <label for="">Alamat</label>
                        <textarea class="form-control h-25" rows="5" 
                            name="address">{{$driver->address}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Foto</label>
                        <br>
                        @if($driver->photo)
                            <img src="{{ url('images/driver_photos/'.$driver->photo) }}"
                                style="width: 75px; height: 75px;">
                        @endif
                        <input type="file" class="form-control" name="photo">
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
    
    {{-- Sweetalert JS Libraries --}}
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

        $(function() {
            $('.integerInput').on('input', function() {
                // numbers and decimals only
                this.value = this.value.replace(/[^\d]/g, '');
            });
        });
    </script>
@endpush