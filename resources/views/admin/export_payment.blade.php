<table>
    <thead>
        <tr>
            <th>Nama Customer</th>
            <th>Jadwal Keberangkatan</th> 
            <th>Snap Token</th>
            <th>Booking Code</th>
            <th>Status</th>
            <th>Total harga</th>
        </tr>
    </thead>
    <tbody>
        @foreach($payments as $payment)
            <tr>
                <td>{{ $payment->booking->user->name }}</td>
                <td>
                    {{ $payment->booking->schedule->date_of_depature }}
                    {{ $payment->booking->schedule->depature_time }}
                </td> 
                <td>{{ $payment->snap_token ?? '-' }}</td>
                <td>{{ $payment->booking_code ?? '-' }}</td>
                <td>{{ $payment->status }}</td>
                <td>@money($payment->total)</td>
            </tr>
        @endforeach
    </tbody>
</table>