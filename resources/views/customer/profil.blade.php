@extends('customer.template')

@section('content')

<section id="contact" class="contact">


    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card border-0 shadow rounded-3 my-5">
                    <div class="card-body p-4 p-sm-5">
                        <h5 class="card-title text-center mb-5 fw-light fs-5">Profile</h5>
                        <form>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="name" id="floatingInput"
                                    placeholder="Nama Anda">
                                <label for="floatingInput">Nama</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="number_phone" id="floatingInput"
                                    placeholder="Nomor Telephone">
                                <label for="floatingInput">Nomor Telephone</label>
                            </div>

                            <div class="form-floating mb-3">
                                <textarea input type="text" class="form-control" name="address" id="floatingInput"
                                    placeholder="Alamat"></textarea>
                                <label for="floatingInput">Alamat</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" name="email" id="floatingInput"
                                    placeholder="Email">
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
                                <button class="btn btn-primary text-uppercase fw-bold"
                                    type="submit">Ubah Data</button>
                            </div>
                           

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section><!-- End Contact Section -->
@endsection