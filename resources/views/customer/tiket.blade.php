<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Tiket-{{ $payment->booking_id }}</title>
</head>

<body>
	<style type="text/css">
		.tg {
			border-collapse: collapse;
			border-spacing: 0;
		}

		.tg td {
			border-color: black;
			border-style: solid;
			border-width: 1px;
			font-family: Arial, sans-serif;
			font-size: 14px;
			overflow: hidden;
			padding: 10px 5px;
			word-break: normal;
		}

		.tg th {
			border-color: black;
			border-style: solid;
			border-width: 1px;
			font-family: Arial, sans-serif;
			font-size: 14px;
			font-weight: normal;
			overflow: hidden;
			padding: 10px 5px;
			word-break: normal;
		}

		.tg .tg-km2t {
			border-color: #ffffff;
			color: #003049;
			font-weight: bold;
			text-align: left;
			vertical-align: top
		}

		.tg .tg-zv41m {
			border-color: #ffffff;
			color: #003049;
			font-weight: bold;
			text-align: left;
			vertical-align: top
		}

		.tg .tg-zv4m {
			border-color: #ffffff;
			color: #003049;
			text-align: left;
			vertical-align: top
		}

		.tg .tg-8jgo {
			border-color: #ffffff;
			color: #003049;
			text-align: center;
			vertical-align: top
		}

		.tg .tg-78fz {
			background-color: #003049;
			border-color: #003049;
			color: #ffffff;
			text-align: center;
			vertical-align: top
		}

		.tg .tg-292r {
			background-color: #003049;
			border-color: #003049;
			color: #ffffff;
			text-align: left;
			vertical-align: middle
		}

		.tg .tg-xaus {
			background-color: #003049;
			border-color: #ffffff;
			color: #ffffff;
			text-align: center;
			vertical-align: top
		}

		.tg .tg-yj3z {
			background-color: #003049;
			border-color: #003049;
			color: #ffffff;
			text-align: center;
			vertical-align: middle
		}

		.tg .tg-50pj {
			background-color: #003049;
			border-color: #003049;
			text-align: left;
			vertical-align: top
		}
	</style>
	<table class="tg">
		<thead>
			<tr>
				<th class="tg-zv4m" colspan="3">
					<img src="{{asset('images/logo_shuttle.png')}}" width="200" height="50">
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="tg-xaus" colspan="3">TIKET SHUTTLE-IN</td>
			</tr>
			<tr>
				<td class="tg-zv4m" colspan="3">
					Kode Reservasi - {{ $payment->booking->booking_code }}
				</td>
			</tr>
			<tr>
				<td class="tg-yj3z">{{ $payment->booking->schedule->route->depature }}</td>
				<td class="tg-50pj" style="padding-left: 50px"><img src="images/panah.png" alt="">
				<td class="tg-292r">{{ $payment->booking->schedule->route->arrival }}</td>
			</tr>
			<tr>
				<td class="tg-8jgo" colspan="3">
					<img src="{{ asset('images/barcode.png') }}" alt="" width="330px">
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
				<td class="tg-zv41m">{{ $payment->booking->user->name }}</td>
			</tr>
			<tr>
				<td class="tg-zv4m">Tanggal Keberangkatan</td>
				<td class="tg-zv4m"></td>
				<td class="tg-zv4m">{{ $payment->booking->schedule->date_of_depature }}</td>
			</tr>
			<tr>
				<td class="tg-zv4m">Waktu Keberangkatan</td>
				<td class="tg-zv4m"></td>
				<td class="tg-zv4m"> {{ $payment->booking->schedule->depature_time }}</td>
			</tr>
			<tr>
				<td class="tg-zv4m">No Kursi</td>
				<td class="tg-zv4m"></td>
				<td class="tg-zv4m">
					@foreach($payment->booking->bookingDetails as $booking)
						{{ $booking->seat_number }} @if(!$loop->last) , @endif
					@endforeach
				</td>

			</tr>
			<tr>
				<td class="tg-zv41m">Invoice</td>
				<td class="tg-zv4m"></td>
				<td class="tg-zv4m"></td>
			</tr>
			<tr>
				<td class="tg-zv4m"><img src="{{ asset('images/wallet.png') }}" alt=""></td>
				<td class="tg-zv4m">{{ $payment->booking_id }}</td>
				<td class="tg-zv4m"></td>
			</tr>
			<tr>
				<td class="tg-zv41m">Firman</td>
				<td class="tg-zv4m"></td>
				<td class="tg-zv4m"></td>
			</tr>
			<tr>
				<td class="tg-zv4m">Jumlah Kursi</td>
				<td class="tg-8jgo">{{ $payment->booking->booking_details_count }} </td>
				<td class="tg-zv4m">@money($payment->booking->schedule->route->price)</td>
			</tr>
			<tr>
				<td class="tg-km2t">Total</td>
				<td class="tg-zv4m"></td>
				<td class="tg-zv4m">@money($payment->total)</td>
			</tr>
			<tr>
				<td class="tg-78fz" colspan="3">Terima Kasih</td>
			</tr>
		</tbody>
	</table>
</body>
</html>