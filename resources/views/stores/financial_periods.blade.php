@extends('layouts.master')

@section('title', 'TAC PRESS | Financial Periods')

@section('content')

    <x-breadcrumb>Financial Periods</x-breadcrumb>

    <div class="app-content">
        <div class="container-fluid">

            <x-error-notification :errors="$errors->all()"/>

            <div class="col-md-12">
                <div class="card mb-4">

                    <x-datatable.card-header :icon="'list'" :title="'Financial Periods'">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Add Financial Period" data-bs-url="form_create/createFinancialPeriod" data-bs-size=""> <i class="bi bi-plus-lg"></i> Add Financial Period</button>
                    </x-datatable.card-header>

                    @php
                        $checkData = 1;
                        if(empty($periods->toArray()))
                            $checkData = 0;
                    @endphp

                    <div class="card-body p-0 mb-3">
                        <x-datatable.datatable :checkData="$checkData" :headers="[
                            ['name' => '#', 'width' => '5%'],
                            'Name',
                            'Description',
                            ['name' => 'Start Date', 'nowrap' => 'nowrap', 'width' => '10%'],
                            ['name' => 'End Date', 'nowrap' => 'nowrap', 'width' => '10%'],
                            ['name' => 'Status', 'width' => '9%'],
                            ['name' => 'Action', 'width' => '16%', 'classes' => 'no-sort']
                        ]">

                            @forelse ($periods as $key => $period)
                                <tr class="align-middle">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $period->name}}</td>
                                    <td>{{ $period->description }}</td>
                                    <td>{{ $period->start_date }}</td>
                                    <td>{{ $period->end_date }}</td>
                                    <td>{!! getOrderStatus($period->status) !!}</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="View Purchase Order Detail - {{ $period->order_name }}" data-bs-url="form_view/viewFinancialPeriod/{{ $period->period_id }}" data-bs-size="modal-lg"> View Details</button>
                                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Edit Purchase Order Details" data-bs-url="form_edit/editFinancialPeriod/{{ $period->period_id }}" data-bs-size="modal-lg" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-pencil-square"></i></button>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Confirm Purchase Order Deletion" data-bs-url="form_delete/deleteFinancialPeriod/{{ $period->period_id }}" data-bs-size="" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-trash"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr class="align-middle">
                                    <td colspan="10">No Data</td>
                                </tr>
                            @endforelse

                        </x-datatable.datatable>

                    </div> <!-- /.card-body -->

                </div> <!-- /.card -->
            </div>
        </div> <!-- /.container-fluid -->
    </div> <!--end::App Content-->

    <x-call-modal />

@endsection

