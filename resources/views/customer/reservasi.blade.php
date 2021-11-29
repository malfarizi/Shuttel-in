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
                        
                        <h5>{{ $schedule->date_of_depature ?? '16 November 2021' }}</h5>
                        <h5>{{ $schedule->route->depature ?? 'Indramayu' }} 
                            <i class="bi bi-arrow-right-square"></i> 
                            {{ $schedule->route->arrival ?? 'Bandung' }}
                        </h5>
                        <h5>Tersedia 
                            <strong>{{ $schedule->seat_capacity ?? '6' }} dari 7</strong> Kursi
                        </h5>
                        <h5 id="price">{{ $schedule->route->price_rupiah ?? 'Rp.140.000' }}</h5>
                    </div>
                </div>
            </div>

        </header>


        <div class="row gy-4 mt-4" data-aos="fade-left">
            <div class="col-lg-7 col-md-3" data-aos="zoom-in" data-aos-delay="100">
                <div class="table-responsive table-borderless">
                    <table class="table">
                        <tr>
                            <td>
                                @if(in_array('1', $exists_seat))
                                    <p class="text-success"> 1 </p>
                                @else
                                    <a id="seat_number1" href="javascript:void(0)" class="text-black">
                                        1
                                    </a>
                                @endif
                            </td>
                            <td></td>
                            <td></td>
                            <td><i class="bi bi-person-circle"></i></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                @if(in_array('2', $exists_seat))
                                    <p class="text-success"> 2 </p>
                                @else
                                    <a id="seat_number2" href="javascript:void(0)" class="text-black">
                                        2
                                    </a>
                                @endif
                            </td>
                            <td></td>
                            <td>
                                @if(in_array('3', $exists_seat))
                                    <p class="text-success"> 3 </p>
                                @else
                                    <a id="seat_number3" href="javascript:void(0)" class="text-black">
                                        3
                                    </a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @if(in_array('4', $exists_seat))
                                    <p class="text-success"> 4 </p>
                                @else
                                    <a id="seat_number4" href="javascript:void(0)" class="text-black">
                                        4
                                    </a>
                                @endif
                            </td>
                            <td></td>
                            <td></td>
                            <td>
                                @if(in_array('5', $exists_seat))
                                    <p class="text-success"> 5 </p>
                                @else
                                    <a id="seat_number5" href="javascript:void(0)" class="text-black">
                                        5
                                    </a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @if(in_array('6', $exists_seat))
                                    <p class="text-success"> 6 </p>
                                @else
                                    <a id="seat_number6" href="javascript:void(0)" class="text-black">
                                        6
                                    </a>
                                @endif
                            </td>
                            <td></td>
                            <td></td>
                            <td>
                                @if(in_array('7', $exists_seat))
                                    <p class="text-success"> 7 </p>
                                @else
                                    <a id="seat_number7" href="javascript:void(0)" class="text-black">
                                        7
                                    </a>
                                @endif
                            </td>
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
                                <input type="text" class="form-control"
                                    readonly value="{{ auth()->user()->name }}">
                                <label for="name">Nama</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control"
                                    value="{{ auth()->user()->phone_number }}" readonly>
                                <label for="number_phone">Nomer Telepon</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="seats" id="seat_number" readonly>
                                <label for="seat_number">Nomer Kursi Yang Dipesan</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="total" readonly>
                                <label for="gross_amount">Total</label>
                            </div>
                            <button type="submit" id="pay-button"
                                class="btn btn-primary btn-block mt-4 float-right">
                                Bayar Sekarang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section><!-- End Pricing Section -->

@endsection

@push('scripts')
<!-- MIDTRANS -->
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{env('MIDTRANS_CLIENT_KEY')}}"></script>

<script type="text/javascript">
    $(document).ready(function(){
        
        function remove(arr, num){
            return arr.filter(el => el !== num);
        }

        let seats = [];
        $('#seat_number1').click(function(){
            if($(this).hasClass('text-black')){
                $(this).removeClass('text-black').addClass('text-danger');
                seats.push("1");
            }else{
                $(this).removeClass('text-danger').addClass('text-black');
                seats = remove(seats, "1")
            }
            
            let price = "{{ $schedule->route->price }}";
            let total = parseInt(seats.length) * parseInt(price);
            $('#total').val(total);
            $('#seat_number').val(seats);
        });
        $('#seat_number2').click(function(){
            if($(this).hasClass('text-black')){
                $(this).removeClass('text-black').addClass('text-danger');
                seats.push("2");
            }else{
                $(this).removeClass('text-danger').addClass('text-black');
                seats = remove(seats, "2")
            }

            let price = "{{ $schedule->route->price }}";
            let total = parseInt(seats.length) * parseInt(price);
            $('#total').val(total);
            $('#seat_number').val(seats);
        });
        $('#seat_number3').click(function(){
            if($(this).hasClass('text-black')){
                $(this).removeClass('text-black').addClass('text-danger');
                seats.push("3");
            }else{
                $(this).removeClass('text-danger').addClass('text-black');
                seats = remove(seats, "3")
            }

            let price = "{{ $schedule->route->price }}";
            let total = parseInt(seats.length) * parseInt(price);
            $('#total').val(total);
            $('#seat_number').val(seats);
        });
        $('#seat_number4').click(function(){
            if($(this).hasClass('text-black')){
                $(this).removeClass('text-black').addClass('text-danger');
                seats.push("4");
            }else{
                $(this).removeClass('text-danger').addClass('text-black');
                seats = remove(seats, "4")
            }

            let price = "{{ $schedule->route->price }}";
            let total = parseInt(seats.length) * parseInt(price);
            $('#total').val(total);
            $('#seat_number').val(seats);
        });
        $('#seat_number5').click(function(){
            if($(this).hasClass('text-black')){
                $(this).removeClass('text-black').addClass('text-danger');
                seats.push("5");
            }else{
                $(this).removeClass('text-danger').addClass('text-black');
                seats = remove(seats, "5")
            }

            let price = "{{ $schedule->route->price }}";
            let total = parseInt(seats.length) * parseInt(price);
            $('#total').val(total);
            $('#seat_number').val(seats);
        });
        $('#seat_number6').click(function(){
            if($(this).hasClass('text-black')){
                $(this).removeClass('text-black').addClass('text-danger');
                seats.push("6");
            }else{
                $(this).removeClass('text-danger').addClass('text-black');
                seats = remove(seats, "6")
            }

            let price = "{{ $schedule->route->price }}";
            let total = parseInt(seats.length) * parseInt(price);
            $('#total').val(total);
            $('#seat_number').val(seats);
        });
        $('#seat_number7').click(function(){
            if($(this).hasClass('text-black')){
                $(this).removeClass('text-black').addClass('text-danger');
                seats.push("7");
            }else{
                $(this).removeClass('text-danger').addClass('text-black');
                seats = remove(seats, "7")
            }

            let price = "{{ $schedule->route->price }}";
            let total = parseInt(seats.length) * parseInt(price);
            $('#total').val(total);
            $('#seat_number').val(seats);
        });
    }); 

    $("#reservasi_form").submit(function (event) {
        event.preventDefault();
            $.post("{{url('booking')}}",{
            _method: 'POST',
            _token : '{{ csrf_token() }}',
            schedule_id: '{{ $schedule->id }}',
            seat_number: $('#seat_number').val(),
            total: parseInt($('#total').val())
        },
        function (data, status) {
            console.log(data);
            snap.pay(data.snap_token, {
                // Optional
                onSuccess: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log(result);
                },
                // Optional
                onPending: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log(result);
                },
                // Optional
                onError: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log(result);
                },
            });
            return false;
        });
    });
</script>    
@endpush