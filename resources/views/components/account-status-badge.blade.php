@if ($status == 1)
<span class="badge badge-success badge-pill  p-1">
    {{ __('Active') }}
</span>
@elseif ($status == 0)
<span class="badge badge-danger badge-pill  p-1">
    {{ __('Suspended') }}
</span>
@else
<span class="badge badge-warning badge-pill  p-1">
    {{ __('Pending') }}
</span>
@endif