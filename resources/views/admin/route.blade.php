@extends('admin.templates.index')

@section('content')
<div class="main-content">
    <section class="section">
        @include('components.breadcrumbs', ['menu' => 'Data Rute'])

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
                                <span class="text">Tambah Rute</span>
                            </button>
                        </div>

                        <div class="card-body">
                            @include('components.alert')
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Keberangkatan</th>
                                            <th>Kedatangan</th>
                                            <th>Harga</th>
                                            <th>Nopol Shuttle</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>Keberangkatan</th>
                                            <th>Kedatangan</th>
                                            <th>Harga</th>
                                            <th>Nopol Shuttle</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @forelse ($routes as $route)
                                        <tr>
                                            <td>{{ ++$i }}.</td>
                                            <td>{{ $route->depature }}</td>
                                            <td>{{ $route->arrival }}</td>
                                            <td>@money($route->price)</td>
                                            <td>{{ $route->shuttle->nopol }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary" 
                                                    data-toggle="modal" 
                                                    data-target="#edit-data-{{ $route->id }}">
                                                    <i class="fas fa-user-edit"></i>
                                                </button>
                                                <form action="{{route('admin.routes.destroy', $route->id)}}" 
                                                    method="POST" 
                                                    class="d-inline"
                                                >
                                                    @csrf
                                                    @method('DELETE')
                                                    <button 
                                                        type="submit" 
                                                        class="btn btn-danger delete"
                                                    >
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">
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
            </div>
        </div>
    </section>
</div>

<!--Modal tambah-->
<div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('admin.routes.store')}}" method="POST">
                @csrf 
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Tambah Rute
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Keberangkatan</label>
                        <select class="select2 form-control" name="depature">
                            <option value="" disabled selected>
                                Pilih kota keberangkatan
                            </option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->type. ' - ' .$city->city_name }}">
                                    {{ $city->type. ' - ' .$city->city_name }}
                                </option>    
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Kedatangan</label>
                        <select class="select2 form-control" name="arrival">
                            <option value="" disabled selected>
                                Pilih kota tujuan
                            </option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->type. ' - ' .$city->city_name }}">
                                    {{ $city->type. ' - ' .$city->city_name }}
                                </option>    
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Harga</label>
                        <input type="text" name="price"
                            class="form-control integerInput" placeholder="Masukan harga">
                    </div>

                    <div class="form-group">
                        <label for="">Pilih Shuttle</label>
                        <select name="shuttle_id" class="select2 form-control">
                            <option value="" disabled selected>
                                Pilih Shuttle
                            </option>
                            @foreach ($shuttles as $shuttle)
                                <option value="{{ $shuttle->id }}">
                                    {{ $shuttle->nopol }}
                                </option>
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

@foreach ($routes as $route)
<!--Modal Edit-->
<div class="modal fade" id="edit-data-{{$route->id}}" 
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('admin.routes.update', $route)}}" method="POST">
                @csrf
                @method('PUT')   
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Edit Rute
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>Keberangkatan</label>
                        <select class="select2 form-control" name="depature">
                            @foreach ($cities as $city)
                                @php
                                    $city_n_type = $city->type. ' - ' .$city->city_name;
                                @endphp
                                {{-- Kalo udah dihapus dummy ganti $city->city_name jadi $city_n_type --}}
                                @if($route->depature === $city->city_name)
                                    <option value="{{$city_n_type}}" selected>
                                        {{ $city_n_type }}
                                    </option>
                                @else 
                                    <option value="{{$city_n_type}}">
                                        {{ $city_n_type }}
                                    </option>
                                @endif   
                            @endforeach
                        </select>
                    </div>
            
                    <div class="form-group">
                        <label for="">Kedatangan</label>
                        <select class="select2 form-control" name="arrival">
                            @foreach ($cities as $city)
                                @php
                                    $city_n_type = $city->type. ' - ' .$city->city_name;
                                @endphp
                                {{-- Kalo udah dihapus dummy ganti $city->city_name jadi $city_n_type --}}
                                @if($route->arrival === $city->city_name)
                                    <option value="{{$city_n_type}}" selected>
                                        {{ $city_n_type }}
                                    </option>
                                @else 
                                    <option value="{{$city_n_type}}">
                                        {{ $city_n_type }}
                                    </option>
                                @endif   
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="">Harga</label>
                        <input type="text" name="price" 
                            class="form-control integerInput" value="{{ $route->price }}">
                    </div>
                    
                    <div class="form-group">
                        <label for="">Pilih Shuttle</label>
                        <select name="shuttle_id" class="select2 form-control">
                            @foreach ($shuttles as $shuttle)
                                @if($route->shuttle_id === $shuttle->id)
                                    <option value="{{ $shuttle->id }}" selected>
                                        {{ $shuttle->nopol }}
                                    </option>
                                @else 
                                    <option value="{{ $shuttle->id }}">
                                        {{ $shuttle->nopol }}
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
                    <button type="sumbit" class="btn btn-primary">
                        Simpan
                    </button>
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

        $(function() {
            $('.integerInput').on('input', function() {
                // numbers and decimals only
                this.value = this.value.replace(/[^\d]/g, '');
            });
        });
    </script>
@endpush