@if(in_array($status, ['capture', 'settlement', 'success']))
<div class="badge bg-success">
    {{ $status }}
</div>
@endif

@if(in_array($status, ['cancel', 'deny','expire', 'failed']))
<div class="badge bg-danger">
    {{ $status }}
</div>
@endif

@if($status === 'pending')
<div class="badge bg-warning text-dark">
    {{ $status }}
</div>
@endif