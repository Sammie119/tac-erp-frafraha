@extends('layouts.master')

@section('title', 'TAC PRESS | Sales Banking')

@section('content')

    <x-breadcrumb>Sales Banking</x-breadcrumb>

    <div class="app-content">
        <div class="container-fluid">

            <x-error-notification :errors="$errors->all()"/>

            <div class="col-md-12">
                <div class="card mb-4">

                    <x-datatable.card-header :icon="'cash'" :title="'Sales Banking'">
                        @can(\App\Enums\PermissionsEnum::CREATESALESBANKING->value)
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Add New Sales Banking Entry" data-bs-url="form_create/createSalesBanking" data-bs-size=""> <i class="bi bi-plus-lg"></i> Add New Entry</button>
                        @endcan
                    </x-datatable.card-header>

                    @php
                        $checkData = 1;
                        if(empty($sales->toArray()))
                            $checkData = 0;
                    @endphp

                    <div class="card-body p-0 mb-3">
                        <x-datatable.datatable :checkData="$checkData" :headers="[
                            ['name' => '#', 'width' => '5%'],
                            'Date Range',
                            'Amount Received',
                            'Amount Banked',
                            'Status',
                            'Entry By',
                            ['name' => 'Action', 'width' => '14%', 'classes' => 'no-sort']
                        ]">

                            @forelse ($sales as $key => $sale)
                                <tr class="align-middle">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $sale->start_date }} to {{ $sale->end_date }}</td>
                                    <td nowrap>{{ $sale->amount_received }}</td>
                                    <td nowrap>{{ $sale->amount_banked }}</td>
                                    <td nowrap>{!! getStatus($sale->status, 1) !!}</td>
                                    <td nowrap>{{ get_logged_staff_name($sale->created_by_id) }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="View Details" data-bs-url="form_view/viewSalesBanking/{{ $sale->id }}" data-bs-size="modal-xl"> Details</button>
                                        @can(\App\Enums\PermissionsEnum::APPROVESALESBANKING->value)
                                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Edit/Approve Sales Banking Details" data-bs-url="form_edit/editSalesBanking/{{ $sale->id }}" data-bs-size="" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-pencil-square"></i></button>
                                        @endcan
                                        @can(\App\Enums\PermissionsEnum::DELETESALESBANKING->value)
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Confirm Financial Deletion" data-bs-url="form_delete/deleteSalesBanking/{{ $sale->id }}" data-bs-size="" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-trash"></i></button>
                                        @endcan
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



