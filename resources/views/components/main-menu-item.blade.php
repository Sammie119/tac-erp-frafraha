@props(['menu_open' => [], 'icon' => 'people', 'title' => ''])

@php
    $setIcon = [
        'people' => 'bi-people',
        'seam' => 'bi-box-seam-fill',
        'cash' => 'bi-cash-coin',
        'display' => 'bi-pc-display',
        'person' => 'bi-person',
        'house' => 'bi-house-door',
    ][$icon] ?? 'people';
@endphp

<li class="nav-item
<?php
    foreach ($menu_open as $menu){
        echo request()->is($menu) ? 'menu-open' : '';
    }
?>
"> <a href="#" class="nav-link"> <i class="nav-icon bi {{ $setIcon }}" style="font-size: 20px"></i>
        <p>
            {{ $title }}
            <i class="nav-arrow bi bi-chevron-right"></i>
        </p>
    </a>
    {{ $slot }}
</li>
