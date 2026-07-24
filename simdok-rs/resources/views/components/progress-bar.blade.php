@php
    $value = max(0, min(100, (int) $value));
    $color = $value >= 100 ? 'bar-teal' : ($value >= 50 ? 'bar-amber' : 'bar-rose');
@endphp
<div class="progress-wrap">
    <div class="progress-label"><span>Progress</span><span>{{ $value }}%</span></div>
    <div class="progress-track"><div class="progress-fill {{ $color }}" style="width:{{ $value }}%"></div></div>
</div>
