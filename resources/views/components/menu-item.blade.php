@props(['route' => '', 'icon' => 'arrow'])

@php
    $setIcon = [
        'arrow' => 'bi-arrow-right-short',
        'speedometer' => 'bi-speedometer',
    ][$icon] ?? 'arrow';
@endphp

<li class="nav-item"> <a href="{{ route($route) }}" class="nav-link {{ request()->is($route) ? 'active' : '' }}"> <i class="nav-icon bi {{ $setIcon }}" style="font-size: 20px"></i>
        <p>{{ $slot }}</p>
    </a>
</li>
