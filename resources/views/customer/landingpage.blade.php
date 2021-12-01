@extends('customer.template')

@section('content')
<section id="hero" class="hero d-flex align-items-center">
  <div class="container elemen">
    <div class="row">
      <div class="col-lg-6 d-flex flex-column justify-content-center">
        <h1 data-aos="fade-up">Shuttle-In</h1>
        <h2 data-aos="fade-up" data-aos-delay="400">Travel antar kota Point to point dengan custom seat yang nyaman
          dan lega. Bisa langsung Booking Online lho..
        </h2>
        @guest
        <div data-aos="fade-up" data-aos-delay="600">
          <div class="text-center text-lg-start">
            <a href="/register" class="btn-get-started scrollto 
                d-inline-flex align-items-center justify-content-center align-self-center">
              <span>Daftar Sekarang</span>
              <i class="bi bi-arrow-right"></i>
            </a>
          </div>
        </div>
        @endguest
      </div>
      <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
        <div class="box">
          <h5>Cek Reservasi</h5>
          <div class="row">
            <form action="{{url('/')}}" method="GET">
              <div class="input-group ">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="bi bi-card-list"></i></span>
                </div>
                <input type="text" name="search" class="form-control">
                <button class="btn btn-outline-primary" id="search" type="submit">Cari</button>
              </div>
            </form>
          </div>
          <div class="row mt-4">
            <h5>Reservasi Online</h5>
            <form action="{{url('/jadwal')}}" method="GET">
              <div class="form-group">
                <select class="select2-single-placeholder form-control" name="depature" id="depature"
                  style="width: 100%" required>
                  <option value="">Pilih Kebarangkatan</option>

                  @foreach ($cities as $city)
                  <option value="{{ $city->type. ' ' .$city->city_name }}">
                    {{ $city->type. ' ' .$city->city_name }}
                  </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group mt-2">
                <select class="select2-single-placeholder form-control" name="arrival" id="arrival" style="width: 100%"
                  required>
                  <option value="">Pilih Tujuan</option>

                  @foreach ($cities as $city)
                  <option value="{{ $city->type. ' ' .$city->city_name }}">
                    {{ $city->type. ' ' .$city->city_name }}
                  </option>
                  @endforeach
                </select>
              </div>

              <button type="submit" class="btn btn-primary btn-lg btn-block mt-5">Cari Jadwal</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    @if (!empty($data))
    {{-- Hidden kalo ga ada yang nyari kode reservasi --}}
    <section id="services" class="services">
      <div class="row gy-4">
        <div class="col-lg-12 col-md-12" data-aos="fade-up" data-aos-delay="200">
          <div class="service-box blue">
            <h3>Detail Reservasi Kamu</h3>

            <ul class="list-group list-group-flush">
              <li class="list-group-item">{{$data->booking_id}}</li>
              <li class="list-group-item">{{$data->name}}</li>
              <li class="list-group-item">{{$data->depature}} - {{$data->arrival}}</li>
              <li class="list-group-item">{{$data->booking_id}}</li>
            </ul>
            @if ($data->status === 'success')
            <a href="{{ route('tiket.download', $data->booking_id) }}" target="_blank"
              class="btn btn-sm btn-primary btn-icon">
              <span>Cetak Tiket</span> <i class="bi bi-printer"></i>
            </a>
            @endif
          </div>
        </div>
      </div>
    </section>
    @endif

    @if(!empty($error))
    <section id="services" class="services">
      <div class="row gy-4">
        <div class="col-lg-12 col-md-12" data-aos="fade-up" data-aos-delay="200">
          <div class="service-box blue text-center">
            <h1>{{ $error }}</h1>
          </div>
        </div>
      </div>
    </section>
    @endif
  </div>
</section>
<!-- End Hero -->

<form id="logout-form" action="{{ route('logout')}}" method="POST" style="display: none;">
  @csrf
</form>
@endsection