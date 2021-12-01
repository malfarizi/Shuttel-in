@if($status === 'success')
<div class="badge {{ empty($isBootstrap5) ? 'badge-success' : 'bg-success' }}">
    {{ $status }}
</div>
@endif

@if(in_array($status, ['failed', 'expired']))
<div class="badge {{ empty($isBootstrap5) ? 'badge-danger' : 'bg-danger' }}">
    {{ $status }}
</div>
@endif

@if($status === 'pending')
<div class="badge {{ empty($isBootstrap5) ? 'badge-warning' : 'bg-warning' }} text-dark">
    {{ $status }}
</div>
@endif