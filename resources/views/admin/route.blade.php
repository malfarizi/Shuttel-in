@extends('admin.templates.index')

@section('content')
<div class="main-content">
    <section class="section">
        @include('admin.templates.components.breadcrumbs', ['menu' => 'Data Rute'])

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
                            @include('admin.templates.components.alert')
                            
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>Keberangkatan</th>
                                            <th>Kedatangan</th>
                                            <th>Harga</th>
                                            <th>Shuttle</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Keberangkatan</th>
                                            <th>Kedatangan</th>
                                            <th>Harga</th>
                                            <th>Shuttle</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <tr>
                                            <td>Tiger Nixon</td>
                                            <td>System Architect</td>
                                            <td>Edinburgh</td>
                                            <td>61</td>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#edit-data">
                                                    <i class="fas fa-user-edit"></i>
                                                </button>
                                                <form action="" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
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
                    Tambah Rute
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Keberangkatan</label>
                    <select class="select2 form-control">
                        <option>Option 1</option>
                        <option>Option 2</option>
                        <option>Option 3</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Kedatangan</label>
                    <select class="form-control city" name="arrival">
                        @foreach ($cities as $city)
                            <option value="{{ $city->type. ' - ' .$city->city_name }}">
                                {{ $city->type. ' - ' .$city->city_name }}
                            </option>    
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Harga</label>
                    <input type="text" class="form-control" id="" name="price" placeholder="Masukan Harga">
                </div>

                <div class="form-group">
                    <label for="">Pilih Shuttle</label>
                    <select name="id_shuttle" id="" class="form-control">
                        <option>Pilih Shuttle</option>
                       
                        <option value="">ID - Nopol</option>
                        
                    </select>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="sumbit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!--Modal Edit-->
<div class="modal fade" id="edit-data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
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
                    <label for="">Keberangkatan</label>
                    <input type="text" class="form-control" id="" name="departure"
                        placeholder="Masukan Keberangkatan">
                </div>

                <div class="form-group">
                    <label for="">Kedatangan</label>
                    <input type="text" class="form-control" id="" name="arrival" placeholder="Masukan Kedatangan">
                </div>

                <div class="form-group">
                    <label for="">Harga</label>
                    <input type="text" class="form-control" id="" name="price" placeholder="Masukan Harga">
                </div>

                <div class="form-group">
                    <label for="">Pilih Shuttle</label>
                    <select name="id_shuttle" id="" class="form-control">
                        <option>Pilih Shuttle</option>
                       
                        <option value="">ID - Nopol</option>
                        
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="sumbit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{asset('/assets/css/select2.min.css')}}"> 
@endpush

@push('scripts')
    <script src="{{asset('/assets/js/select2.full.min.js')}}"></script> 
    <script src="{{asset('/assets/js/jquery.selectrict.min.js')}}"></script>
    
    <script>   
    $('.select2').select2({
        dropdownParent: $('#exampleModal')
    });
    </script>
  
@endpush