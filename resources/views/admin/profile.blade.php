@extends('../admin/templates/index')

@section('content')
<div class="main-content">
    <section class="section">
        @include('admin.templates.components.breadcrumbs', ['menu' => 'Edit Profile'])

        <div class="section-body">
            <!-- DataTable with Hover -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                           <h2>Edit Profile</h2>
                        </div>
                        <form action="{{'admin.profile.update', $user->id}}" method="POST">
                            @csrf
                            @method('PUT')  
                        <div class="card-body">
                         

                            <div class="form-group">
                                <label for="name" class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name" id="" value="{{$user->name}}">
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="phone_number" class="col-sm-3 col-form-label">No Telephone</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="phone_number" id="" value="{{$user->phone_number}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="address" class="col-sm-3 col-form-label">Alamat</label>
                                <div class="col-sm-5">
                                   <input type="text" class="form-control" name="address" id="" value="{{$user->address}}">
                                </div>
                            </div>

                        </div>
                        <div class="card-footer text-center">
                            <button class="btn btn-primary mr-1" type="submit">Ubah Data</button>
                          </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
