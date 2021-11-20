@if($status === 'capture' || $status === 'settlement')
    <div class="badge badge-success">
        {{ $status }}
    </div>
@endif

@if($status === 'deny' || $status === 'cancel')
    <div class="badge badge-danger">
        {{ $status }}
    </div>
@endif

@if($status === 'pending')
    <div class="badge badge-warning text-dark">
        {{ $status }}
    </div>
@endif