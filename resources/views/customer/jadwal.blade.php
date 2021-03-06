@extends('customer.template')

@section('content')

<!-- ======= Jadwal Section ======= -->
<section id="jadwal" class="jadwal">

    <div class="container" data-aos="fade-up">
        <header class="section-header-jadwal">
            <div class="box mt-5">
                <div class="row">
                    <div class="col-lg-6 col-md-3">
                        @if (!empty($depature))
                        <h1><i class="bi bi-geo-alt"></i> {{$depature}} <i class="bi bi-arrow-right-square"></i>
                            {{$arrival}}
                        </h1>
                        @endif
                    </div>
                    <div class="col-lg-6 col-md-3">
                        <form action="{{url('/jadwal')}}" method="GET">
                            <div class="form-group">
                                <select class="select2-single-placeholder form-control" name="depature" id="depature"
                                    style="width: 100%">
                                    <option value="">Pilih keberangkatan</option>
                                    @foreach ($cities as $city)
                                    <option value="{{ $city->type. ' ' .$city->city_name }}">
                                        {{ $city->type. ' ' .$city->city_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mt-2">
                                <select class="select2-single-placeholder form-control" name="arrival" id="arrival"
                                    style="width: 100%">
                                    <option value="">Pilih Tujuan</option>
                                    @foreach ($cities as $city)
                                    <option value="{{ $city->type. ' ' .$city->city_name }}">
                                        {{ $city->type. ' ' .$city->city_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg btn-block mt-5">Cari
                                Jadwal</button>
                        </form>
                    </div>
                </div>
            </div>

        </header>

        <div class="row gy-4 mt-4" data-aos="fade-left">
            @forelse ($schedules as $schedule)
            <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                <div class="box">
                    <img src="assets-flexstart/img/pricing-free.png" class="img-fluid" alt="">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            Tanggal : {{ $schedule->date_of_depature }}
                        </li>
                        <li class="list-group-item">
                            Jam : {{ $schedule->depature_time }}
                        </li>
                        <li class="list-group-item">
                            Sisa Kursi : <strong>{{ $schedule->seat_capacity }}</strong> dari 7 Kursi
                        </li>
                        <li class="list-group-item">
                            Harga : {{ $schedule->route->price_rupiah }}
                        </li>
                    </ul>
                    @if ($schedule->seat_capacity > 0)
                    <a href="{{route('reservasi', $schedule)}}" class="btn-reservasi">
                        Pesan Sekarang
                    </a>
                    @else
                    <a class="btn-reservasi-disabled" disabled>Tidak Tersedia</a>
                    @endif
                </div>
            </div>
            @empty
            <h3>Maaf Tidak Tersedia</h3>
            @endforelse
        </div>
        @if (!empty($schedules))
        <div class="d-flex justify-content-center mt-5">
            {!! $schedules->links() !!}
        </div>
        @endif
    </div>

</section><!-- End Pricing Section -->

@endsection

@push('js')
<script>
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
</script>
@endpush