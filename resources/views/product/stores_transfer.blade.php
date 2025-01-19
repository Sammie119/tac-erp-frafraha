@extends('layouts.master')

@section('title', 'TAC PRESS | Stores Transfer')

@section('content')

    <x-breadcrumb>Stock Transfer</x-breadcrumb>

    <div class="app-content">
        <div class="container-fluid">

            <x-error-notification :errors="$errors->all()"/>

            <div class="col-md-12">
                <div class="card mb-4">

                    <x-datatable.card-header :icon="'cash'" :title="'Stock Transfer'">
                        @can(\App\Enums\PermissionsEnum::CREATESTORESTRANSFER->value)
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Add New Stock Transfer Entry" data-bs-url="form_create/createStoresTransfer" data-bs-size="modal-xl"> <i class="bi bi-plus-lg"></i> Add New Entry</button>
                        @endcan
                    </x-datatable.card-header>

                    @php
                        $checkData = 1;
                        if(empty($transfers->toArray()))
                            $checkData = 0;
                    @endphp

                    <div class="card-body p-0 mb-3">
                        <x-datatable.datatable :checkData="$checkData" :headers="[
                            ['name' => '#', 'width' => '5%'],
                            'Date',
                            'Source Shop',
                            'Destination Shop',
                            'Status',
                            'Requested By',
                            ['name' => 'Action', 'width' => '14%', 'classes' => 'no-sort']
                        ]">

                            @forelse ($transfers as $key => $transfer)
                                <tr class="align-middle">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $transfer->transfer_date }}</td>
                                    <td nowrap>{{ get_logged_user_division($transfer->from_store_id) }}</td>
                                    <td nowrap>{{ get_logged_user_division($transfer->to_store_id) }}</td>
                                    <td nowrap>{!! getStatus($transfer->status, 1) !!}</td>
                                    <td nowrap>{{ get_logged_staff_name($transfer->created_by_id) }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="View Details" data-bs-url="form_view/viewSalesBanking/{{ $transfer->id }}" data-bs-size="modal-xl"> Details</button>
                                        @can(\App\Enums\PermissionsEnum::APPROVESTORESTRANSFER->value)
                                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Edit/Approve Stock Transfer Details" data-bs-url="form_edit/editStoresTransfer/{{ $transfer->id }}" data-bs-size="" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-pencil-square"></i></button>
                                        @endcan
                                        @can(\App\Enums\PermissionsEnum::DELETESTORESTRANSFER->value)
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Confirm Deletion" data-bs-url="form_delete/deleteStoresTransfer/{{ $transfer->id }}" data-bs-size="" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-trash"></i></button>
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

    <x-ajax-call-input-fields :ajax_url="'get_search_product'" :form="'product.ajax_form.stores_transfer_form'" />

@endsection



