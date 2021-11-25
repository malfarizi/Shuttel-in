@extends('customer.template')

@section('content')

<!-- ======= Jadwal Section ======= -->
<section id="jadwal" class="jadwal">

    <div class="container" data-aos="fade-up">
        <header class="section-header-jadwal">
            <div class="box mt-5">
                <div class="row">
                    <div class="col-lg-6 col-md-3">
                        <h1><i class="bi bi-geo-alt"></i> Indramayu <i class="bi bi-arrow-right-square"></i> Bandung
                        </h1>
                    </div>
                    <div class="col-lg-6 col-md-3">
                        <div class="input-group ">
                            <select class="select2-single-placeholder form-control" id="depature">
                                <option value="Bandung">Bandung</option>
                                <option value="Indramayu">Indramayu</option>
                                <option value="Cirebon">Cirebon</option>
                            </select>
                        </div>
                        <div class="input-group mt-2">
                            <select class="select2-single-placeholder form-control" id="arrival">
                                <option value="Bandung">Bandung</option>
                                <option value="Indramayu">Indramayu</option>
                                <option value="Cirebon">Cirebon</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mt-4 float-right">Cari
                            Jadwal</button>

                        </form>
                    </div>
                </div>
            </div>

        </header>

        <div class="row gy-4 mt-4" data-aos="fade-left">
            @foreach($schedules as $schedule)
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
                            Harga : {{ $schedule->route->price }}
                        </li>
                    </ul>
                    <a href="{{route('reservasi', $schedule)}}" class="btn-reservasi">
                        Pesan Sekarang
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-5">
            {!! $schedules->links() !!}
        </div>
    </div>

</section><!-- End Pricing Section -->

@endsection