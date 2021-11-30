<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
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
			background-color: #fe0000;
			border-color: #fe0000;
			color: #ffffff;
			text-align: center;
			vertical-align: top
		}

		.tg .tg-292r {
			background-color: #fe0000;
			border-color: #fe0000;
			color: #ffffff;
			text-align: left;
			vertical-align: middle
		}

		.tg .tg-xaus {
			background-color: #fe0000;
			border-color: #ffffff;
			color: #ffffff;
			text-align: center;
			vertical-align: top
		}

		.tg .tg-yj3z {
			background-color: #fe0000;
			border-color: #fe0000;
			color: #ffffff;
			text-align: center;
			vertical-align: middle
		}

		.tg .tg-50pj {
			background-color: #fe0000;
			border-color: #fe0000;
			text-align: left;
			vertical-align: top
		}
	</style>
	<table class="tg">
		<thead>
		  <tr>
			<th class="tg-zv4m" colspan="3"><img src="{{asset('assets/img/logo shuttle.png')}}" width="200" height="50"></th>
		  </tr>
		</thead>
		{{-- @foreach($datas as $data) --}}
		<tbody>
		  <tr>
			<td class="tg-xaus" colspan="3">TIKET SHUTTLE-IN</td>
		  </tr>
		  {{-- <tr>
			<td class="tg-zv4m" colspan="3">Kode Reservasi - {{$data->id}}</td>
		  </tr>
		  <tr>
			<td class="tg-yj3z">{{$data->depature}}</td>
			<td class="tg-50pj" style="padding-left: 50px"><img src="images/panah.png" alt="">
			<td class="tg-292r">{{$data->arrival}}</td>
		  </tr>
		  <tr>
			<td class="tg-8jgo" colspan="3"><img src="images/barcode.png" alt="" width="330px"></td>
		  </tr> --}}
		  <tr>
			<td class="tg-zv41m">Detail Reservasi</td>
			<td class="tg-zv4m"></td>
			<td class="tg-zv4m"></td>
		  </tr>
		  <tr>
			<td class="tg-zv4m">Kode Reservasi</td>
			<td class="tg-zv4m"></td>
			<td class="tg-zv41m">{{$datas->id}}</td>
		  </tr>
		  <tr>
			<td class="tg-zv4m">Rute</td>
			<td class="tg-zv4m"></td>
			<td class="tg-zv41m">{{$datas->depature}} - {{$datas->arrival}}</td>
		  </tr>
		  <tr>
			<td class="tg-zv4m">Pemesan</td>
			<td class="tg-zv4m"></td>
			<td class="tg-zv41m">{{$datas->name}}</td>
		  </tr>
		  <tr>
			<td class="tg-zv4m">Tanggal Keberangkatan</td>
			<td class="tg-zv4m"></td>
			<td class="tg-zv4m">{{$datas->date_of_depature}}</td>
		  </tr>
		  <tr>
			<td class="tg-zv4m">Waktu Keberangkatan</td>
			<td class="tg-zv4m"></td>
			<td class="tg-zv4m">{{$datas->depature_time}}</td>
		  </tr>
		  <tr>
			<td class="tg-zv4m">Nomor Kursi Yang Dipesan</td>
			<td class="tg-zv4m"></td>
			<td class="tg-zv4m">{{$datas->seat_number}}</td>
		  </tr>
		  <tr>
			<td class="tg-km2t">Total</td>
			<td class="tg-zv4m"></td>
			<td class="tg-zv4m">{{$datas->total}}</td>
		  </tr>
		  <tr>
			<td class="tg-78fz" colspan="3">Terima Kasih</td>
		  </tr>
		</tbody>
		{{-- @endforeach --}}
		</table>
</body>

</html>