@extends('admin.templates.index')

@section('content')
<div class="main-content">
  <section class="section">
      <div class="section-header">
          <h1>Data Shuttle</h1>
          <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item">Data Shuttle</div>
          </div>
      </div>

      <div class="section-body">

          {{-- <h2 class="section-title">DataTables</h2>
          <p class="section-lead">
              We use 'DataTables' made by @SpryMedia. You can check the full documentation <a
                  href="https://datatables.net/">here</a>.
          </p> --}}

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
                          <div class="table-responsive">
                              <table class="table table-striped" id="dataTable">
                                  <thead>

                                      <tr>
                                          <th>Nopol Shuttle</th>
                                          <th>Status Shuttel</th>
                                          <th>Driver</th>
                                          <th>Aksi</th>
                                      </tr>
                                  </thead>
                                  <tfoot>
                                      <tr>
                                        <th>Nopol Shuttle</th>
                                        <th>Status Shuttel</th>
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
                                              <button type="button" class="btn btn-primary" data-toggle="modal"
                                                  data-target="#edit-data">
                                                  <i class="fas fa-user-edit"></i>
                                              </button>
                                              <form action="" method="POST"
                                                  class="d-inline">
                                                  @csrf
                                                  @method('delete')
                                                  <button type="submit" class="btn btn-danger"><i
                                                          class="fas fa-trash"></i></button>
                                              </form>
                                          </td>
          
                                      </tr>
                
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
              <!--Row-->

          </div>
  </section>
</div>
<!--Modal tambah-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">
                  Modal title
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
          ...
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <button type="sumbit" class="btn btn-primary">Simpan</button>
          </div>
      </div>
  </div>
</div>
@endsection