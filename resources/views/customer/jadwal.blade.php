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
                        <p><i class="bi bi-calendar3"></i> 16 November 2021</p>
                    </div>
                    <div class="col-lg-6 col-md-3">
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

                        <h6>Tanggal Keberangkatan</h6>
                        <div class="input-group ">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="validatedInputGroupPrepend"><i
                                        class="bi bi-calendar3"></i></span>
                            </div>
                            <input type="date" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mt-4 float-right">Cari
                            Jadwal</button>

                        </form>
                    </div>
                </div>
            </div>

        </header>


        <div class="row gy-4 mt-4" data-aos="fade-left">
            <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                <div class="box">
                    <img src="assets-flexstart/img/pricing-free.png" class="img-fluid" alt="">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">jam : 19:00</li>
                        <li class="list-group-item">Sisa Kursi : 7 dari 7 Kursi</li>
                        <li class="list-group-item">Harga : Rp.140,000 </li>
                    </ul>
                    <a href="/reservasi" class="btn-reservasi">Pesan Sekarang</a>
                </div>
            </div>
        </div>
    </div>

</section><!-- End Pricing Section -->

@endsection