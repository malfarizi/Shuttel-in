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
                  
                  @foreach ($routes as $item)
                    <option value="{{$item->depature}}">{{$item->depature}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group mt-2">
                <select class="select2-single-placeholder form-control" 
                  name="arrival" id="depature" style="width: 100%" required>
                  <option value="">Pilih Tujuan</option>
                  
                  @foreach ($routes as $item)
                    <option value="{{$item->arrival}}">{{$item->arrival}}</option>
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
              <a href="{{ route('tiket.download', $data->booking_id) }}" 
                  target="_blank" class="btn btn-sm btn-primary btn-icon">
                  <span>Cetak Tiket</span> <i class="bi bi-printer"></i>
              </a>
            @endif
          </div>
        </div>
      </div>
    </section>
    @else
    <section id="services" class="services">
      <div class="row gy-4">
        <div class="col-lg-12 col-md-12" data-aos="fade-up" data-aos-delay="200">
          <div class="service-box blue text-center">
            <h1>Oops Reservasi Yang Kamu Cari Tidak Ada</h1>
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

@push('js')

<script type="text/javascript">
  $(document).ready(function () {
    // Select2 Single  with Placeholder
      $('#depature').select2({
        placeholder: 'This is my placeholder',
        allowClear: true
      });

      $('#arrival').select2({
        placeholder: 'This is my placeholder',
        allowClear: true
      });
  });
  url = '/';
  var search = document.getElementById('search');
        search.addEventListener('click', function () {
          $.ajax({
          type: 'GET',
          url: url,
          data: {query: query},
          dataType: 'json', 
          success: function(data) {
            console.log(data);
          }
        });
    });
</script>
@endpush