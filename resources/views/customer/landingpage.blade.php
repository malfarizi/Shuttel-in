@extends('customer.template')

@section('content')
<section id="hero" class="hero d-flex align-items-center">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 d-flex flex-column justify-content-center">
        <h1 data-aos="fade-up">Shuttle-In</h1>
        <h2 data-aos="fade-up" data-aos-delay="400">Travel antar kota Point to point dengan custom seat yang nyaman
          dan lega. Bisa langsung Booking Online lho..
        </h2>
        <div data-aos="fade-up" data-aos-delay="600">
          <div class="text-center text-lg-start">
            <a href="#about" class="btn-get-started scrollto 
              d-inline-flex align-items-center justify-content-center align-self-center">
              <span>Daftar Sekarang</span>
              <i class="bi bi-arrow-right"></i>
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
        <div class="box">
          <h5>Cek Reservasi</h5>
          <div class="row">
            <form>
              <div class="input-group ">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="validatedInputGroupPrepend"><i class="bi bi-card-list"></i></span>
                </div>
                <input type="text" class="form-control">
                <button class="btn btn-outline-primary" type="submit">Cari</button>
              </div>
            </form>
          </div>
          <div class="row mt-4">
            <h5>Reservasi Online</h5>
            <form>
              <div class="input-group ">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="validatedInputGroupPrepend"><i
                      class="bi bi-arrow-up-right-square"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Cari Keberangkatan">
              </div>
              <div class="input-group mt-2">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="validatedInputGroupPrepend"><i
                      class="bi bi-arrow-down-right-square"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Cari Tujuan">
              </div>
              <h5 class="mt-4">Tanggal Keberangkatan</h5>
              <div class="input-group ">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="validatedInputGroupPrepend"><i class="bi bi-calendar3"></i></span>
                </div>
                <input type="date" class="form-control">
              </div>
              {{-- <button type="submit" class="btn btn-primary btn-lg btn-block mt-5">Cari Jadwal</button> --}}
              <a href="/jadwal" class="btn btn-primary btn-lg btn-block mt-5">Cari Jadwal</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section><!-- End Hero -->
@endsection