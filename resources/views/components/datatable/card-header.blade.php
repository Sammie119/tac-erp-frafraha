@props(['title' => '', 'icon' => '', 'export_url' => ''])

@php

    $classes = [
        'staff' => 'bi-people',
        'products' => 'bi-diagram-3',
        'list' => 'bi-list',
        'cash' => 'bi-cash-coin',
        'gear' => 'bi-gear',
        ][$icon] ?? 'bi-list';

@endphp

<div class="card-header">
    <div class="row">
        <div class="col-4" style="padding-top: 4px;">
            <h3 class="card-title" style="font-size: 1.5rem;"><strong><i class="bi {{ $classes }}"></i> {{ $title }}</strong></h3>
        </div>
        <div class="col-4">
            <div class="input-group float-end">
                <input type="search" id="mySearchField" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" autofocus/>
            </div>
        </div>
        <div class="col-4">
            <div class="card-tools float-end">
                {{ $slot }}

                <a href="/{{ $export_url }}" class="btn btn-info" style="margin-left: 7px"><strong> <i class="bi bi-download"></i> Export</strong></a>
            </div>
        </div>
    </div>



</div> <!-- /.card-header -->

