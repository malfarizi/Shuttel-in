@extends('customer.template')

@section('content')

<!-- ======= Jadwal Section ======= -->
<section id="jadwal" class="jadwal">

    <div class="container" data-aos="fade-up">
        <header class="section-header-jadwal">
            <div class="box mt-5">
                <div class="row">
                    <div class="col-1">
                        <h5><i class="bi bi-calendar-check"></i></h5>
                        <h5><i class="bi bi-geo-alt"></i></h5>
                        <h5><i class="bi bi-file-ruled"></i></h5>
                        <h5><i class="bi bi-cash"></i></h5>
                    </div>
                    <div class="col-11">
                        <h5>16 November 2021</h5>
                        <h5>Indramayu <i class="bi bi-arrow-right-square"></i> Bandung</h5>
                        <h5>Tersedia <strong>6 dari 7</strong> Kursi</h5>
                        <h5>Rp. 145.000</h5>
                    </div>
                </div>
            </div>

        </header>


        <div class="row gy-4 mt-4" data-aos="fade-left">
            <div class="col-lg-7 col-md-3" data-aos="zoom-in" data-aos-delay="100">
                <div class="table-responsive table-borderless">
                    <table class="table">
                        <tr>
                            <td>1</td>
                            <td></td>
                            <td></td>
                            <td><i class="bi bi-person-circle"></i></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>2</td>
                            <td></td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td></td>
                            <td></td>
                            <td>5</td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td></td>
                            <td></td>
                            <td>7</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-lg-5 col-md-3" data-aos="zoom-in" data-aos-delay="100">
                <div class="box">
                    <div class="row mt-4">
                        <h5>Data Pemesan</h5>
                        <form action="#" id="reservasi_form">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="name" id="user_id" placeholder="Nama Anda"
                                    value="1">
                                <label for="user_id">id user hidden</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="name" id="name" placeholder="Nama Anda"
                                    value="Farhan" readonly>
                                <label for="name">Nama</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="number_phone" id="number_phone"
                                    placeholder="Nama Anda" value="">
                                <label for="number_phone">Nomer Telepon</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="schedule_id" id="schedule_id"
                                    placeholder="Nomor Telephone" value="1">
                                <label for="schedule_id">id jadwal hidden</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="seat_number[]" id="seat_number"
                                    placeholder="Nama Anda" value="1" readonly>
                                <label for="seat_number">Nomer Kursi</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="gross_amount" id="gross_amount" value=""
                                    readonly>
                                <label for="gross_amount">Total</label>
                            </div>
                            <button type="submit" id="pay-button"
                                class="btn btn-primary btn-block mt-4 float-right">Bayar
                                Sekarang</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section><!-- End Pricing Section -->

@endsection