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
                                            <th>Nopol Shuttle</th>
                                            <th>Status Shuttle</th>
                                            <th>Driver</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nopol Shuttle</th>
                                            <th>Status Shuttle</th>
                                            <th>Driver</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <tr>
                                            <td>Tiger Nixon</td>
                                            <td>System Architect</td>
                                            <td>Edinburgh</td>
                                            <td>
                                                <button type="button" class="btn btn-primary" 
                                                    data-toggle="modal" data-target="#edit-data">
                                                    <i class="fas fa-user-edit"></i>
                                                </button>
                                                <form action="" method="POST"
                                                    class="d-inline">
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Nopol Shuttle</label>
                    <input type="text" class="form-control" id="" name="nopol"
                        placeholder="Masukan Nopol Shuttle">
                </div>

                <div class="form-group">
                    <label for="">Pilih Status Shuttle</label>
                    <select name="shuttle_status" id="" class="form-control">
                        <option>Pilih Status Shuttle</option>
                       
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                        
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Pilih Driver</label>
                    <select name="driver_id" id="" class="form-control">
                        <option>Pilih Driver</option>
                        <option value="">Nama Driver</option>                
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
                    Edit Shuttle
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
             
                <div class="form-group">
                    <label for="">Nopol Shuttle</label>
                    <input type="text" class="form-control" id="" name="nopol"
                        placeholder="Masukan Nopol Shuttle">
                </div>

                <div class="form-group">
                    <label for="">Pilih Status Shuttle</label>
                    <select name="shuttle_status" id="" class="form-control">
                        <option>Pilih Status Shuttle</option>
                       
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                        
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Pilih Driver</label>
                    <select name="driver_id" id="" class="form-control">
                        <option>Pilih Driver</option>
                       
                        <option value="">Nama Driver</option>
                        
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