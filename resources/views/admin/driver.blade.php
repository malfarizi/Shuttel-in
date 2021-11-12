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
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
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
                                                <td>{{ $driver->driver_name }}</td>
                                                <td>{{ $driver->driver_status }}</td>
                                                <td>{{ $driver->number_phone }}</td>
                                                <td>{{ $driver->address }}</td>
                                                <td>
                                                    <img src='https://via.placeholder.com/75'>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <button type="button" class="btn btn-primary btn-md" 
                                                            data-toggle="modal" data-target="#edit-data">
                                                            <i class="fas fa-user-edit"></i>
                                                        </button>
                                                        <form action="" method="POST">
                                                            @csrf
                                                            <button class="btn btn-danger btn-md">
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
            <div class="modal-body">
            
                <div class="form-group">
                    <label for="">Nama Driver</label>
                    <input type="text" class="form-control" id="" name="driver_name"
                        placeholder="Masukan nama Driver">
                </div>

                <div class="form-group">
                    <label for="">No Telephone</label>
                    <input type="text" class="form-control" id="" name="phone_number" 
                        placeholder="Masukan No Telephone">
                </div>

                <div class="form-group">
                    <label for="">Alamat</label>
                    <textarea input type="text" class="form-control" id="" name="address" placeholder="Masukan Alamat">
                    </textarea>   
                </div>

                <div class="form-group">
                    <label for="">Foto</label>
                    <input type="file" class="form-control" id="" name="photo"
                        placeholder="Masukan Foto Driver">
                </div>


                <div class="form-group">
                    <label for="">Pilih Status Driver</label>
                    <select name="driver_status" id="" class="form-control">
                        <option>Pilih Status Driver</option>
                       
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                        
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
                    Edit Driver
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
             
                <div class="form-group">
                    <label for="">Nama Driver</label>
                    <input type="text" class="form-control" id="" name="driver_name"
                        placeholder="Masukan nama Driver">
                </div>

                <div class="form-group">
                    <label for="">No Telephone</label>
                    <input type="text" class="form-control" id="" name="phone_number" 
                        placeholder="Masukan No Telephone">
                </div>

                <div class="form-group">
                    <label for="">Alamat</label>
                    <textarea input type="text" class="form-control" id="" name="address" placeholder="Masukan Alamat">
                    </textarea>   
                </div>

                <div class="form-group">
                    <label for="">Foto</label>
                    <input type="file" class="form-control" id="" name="photo"
                        placeholder="Masukan Foto Driver">
                </div>


                <div class="form-group">
                    <label for="">Pilih Status Driver</label>
                    <select name="driver_status" id="" class="form-control">
                        <option>Pilih Status Driver</option>
                       
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                        
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
