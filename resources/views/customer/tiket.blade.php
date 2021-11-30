<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Tiket</title>
	<link rel="stylesheet" href="{{asset('assets/css/my-ticket.css')}}">
</head>

<body>
	<table class="tg">
		<thead>
			<tr>
				<th class="tg-zv4m" colspan="3">
					<img src="{{asset('assets/img/logo_shuttle.png')}}" width="200" height="50">
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="tg-xaus" colspan="3">TIKET SHUTTLE-IN</td>
			</tr>
			<tr>
				<td class="tg-zv4m" colspan="3">
					Kode Reservasi - {{ $payment->booking_id }}
				</td>
			</tr>
			<tr>
				<td class="tg-yj3z">
					{{ $payment->booking->schedule->route->depature }}
				</td>
				<td class="tg-50pj" style="padding-left: 50px">
					{{-- 
						Ini gak ada asset gambar panah nya tolong tambahin  
						<img src="images/panah.png" alt=""> 
					--}}
				<td class="tg-292r">
					{{ $payment->booking->schedule->route->arrival }}
				</td>
			</tr>
			<tr>
				<td class="tg-8jgo" colspan="3">
					{{--
						Ini juga sama
						<img src="{{asset('images/barcode.png')}}" alt="" width="330px">
					--}}
				</td>
			</tr>
			<tr>
				<td class="tg-zv41m">Detail Reservasi</td>
				<td class="tg-zv4m"></td>
				<td class="tg-zv4m"></td>
			</tr>
			<tr>
				<td class="tg-zv4m">Pemesan</td>
				<td class="tg-zv4m"></td>
				<td class="tg-zv41m">
					{{ $payment->booking->user->name }}
				</td>
			</tr>
			<tr>
				<td class="tg-zv4m">Tanggal Keberangkatan</td>
				<td class="tg-zv4m"></td>
				<td class="tg-zv4m">
					{{ $payment->booking->schedule->date_of_depature }}
				</td>
			</tr>
			<tr>
				<td class="tg-zv4m">Waktu Keberangkatan</td>
				<td class="tg-zv4m"></td>
				<td class="tg-zv4m">
					{{ $payment->booking->schedule->depature_time }}
				</td>
			</tr>
			<tr>
				<td class="tg-zv4m">No Kursi</td>
				<td class="tg-zv4m"></td>
				<td class="tg-zv4m">
					@foreach($payment->booking->bookingDetails as $booking)
						{{ $booking->seat_number }}
					@endforeach
				</td>

			</tr>
			<tr>
				<td class="tg-zv41m">Invoice</td>
				<td class="tg-zv4m"></td>
				<td class="tg-zv4m"></td>
			</tr>
			<tr>
				<td class="tg-zv4m">
					{{-- 
						ini juga
					<img src="{{asset('images/wallet.png')}}" alt="">
					--}}
				</td>
				<td class="tg-zv4m">
					PSN-31314
				</td>
				<td class="tg-zv4m"></td>
			</tr>
			<tr>
				<td class="tg-zv41m">
					{{ $payment->booking->user->name }}
				</td>
				<td class="tg-zv4m"></td>
				<td class="tg-zv4m"></td>
			</tr>
			<tr>
				<td class="tg-zv4m">Jumlah Kursi</td>
				<td class="tg-8jgo"> 
					{{ $payment->booking->bookingDetails->count() }} 
				</td>
				<td class="tg-zv4m">
					{{ $payment->booking->schedule->route->price_rupiah }}
				</td>
			</tr>
			<tr>
				<td class="tg-km2t">Total</td>
				<td class="tg-zv4m"></td>
				<td class="tg-zv4m">
					{{ $payment->total }}
				</td>
			</tr>
			<tr>
				<td class="tg-78fz" colspan="3">
					Terima Kasih
				</td>
			</tr>
		</tbody>
	</table>
</body>
</html>