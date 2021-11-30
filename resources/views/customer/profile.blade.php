@extends('customer.template')

@section('content')

<section id="contact" class="contact">

    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card border-0 shadow rounded-3 my-5">
                    <div class="card-body p-4 p-sm-5">
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            
                            <h6><i class="fas fa-check"></i><b> Berhasil!</b></h6>
                            {{ session('success') }}
                        </div>
                        @endif

                        @if($errors->any())
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif


                        <h5 class="card-title text-center mb-5 fw-light fs-5">Profile</h5>
                        <form action="{{route('profile.update', $user->id)}}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="name" id="floatingInput"
                                    value="{{$user->name}}">
                                <label for="floatingInput">Nama</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="phone_number" id="floatingInput"
                                    value="{{$user->phone_number}}">
                                <label for="floatingInput">Nomor Telephone</label>
                            </div>

                            <div class="form-floating mb-3">
                                <textarea input type="text" class="form-control" name="address"
                                    id="floatingInput">{{$user->address}}</textarea>
                                <label for="floatingInput">Alamat</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" name="email" id="floatingInput"
                                    value="{{$user->email}}">
                                <label for="floatingInput">Email</label>
                            </div>

                            {{-- <div class="form-floating mb-3">
                                <input type="password" class="form-control" name="password" id="floatingPassword"
                                    placeholder="Password">
                                <label for="floatingPassword">Password</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" name="" id="floatingPassword"
                                    placeholder="Password">
                                <label for="floatingPassword">Konfirmasi Password</label>
                            </div> --}}

                            <div class="d-grid">
                                <button class="btn btn-primary text-uppercase fw-bold" type="submit">
                                    Ubah Data
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section><!-- End Contact Section -->
@endsection
