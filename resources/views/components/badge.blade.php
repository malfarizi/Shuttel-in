@if(in_array($status, ['capture', 'settlement']))
    <div class="badge badge-success">
        {{ $status }}
    </div>
@endif

@if(in_array($status, ['cancel', 'deny']))
    <div class="badge badge-danger">
        {{ $status }}
    </div>
@endif

@if($status === 'pending')
    <div class="badge badge-warning text-dark">
        {{ $status }}
    </div>
@endif