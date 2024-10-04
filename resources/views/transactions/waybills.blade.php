@extends('layouts.master')

@section('title', 'TAC PRESS | Waybills')

@section('content')

    <x-breadcrumb>Waybills</x-breadcrumb>

    <div class="app-content">
        <div class="container-fluid">

            <x-error-notification :errors="$errors->all()"/>

            <div class="col-md-12">
                <div class="card mb-4">

                    <x-datatable.card-header :icon="'products'" :title="'Waybills History'">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Waybills" data-bs-url="form_create/createWaybill" data-bs-size="modal-xl"> <i class="bi bi-plus-lg"></i> New Waybill</button>
                    </x-datatable.card-header>

                    @php
                        $checkData = 1;
                        if(empty($waybills->toArray()))
                            $checkData = 0;
                    @endphp

                    <div class="card-body p-0 mb-3">
                        <x-datatable.datatable :checkData="$checkData" :headers="[
                            ['name' => '#', 'width' => '5%'],
                            'Customer',
                            'Job',
                            'Vehicle #',
                            'Drivers Name',
                            'Date',
                            ['name' => 'Action', 'width' => '17%', 'classes' => 'no-sort']
                        ]">

                            @forelse ($waybills as $key => $waybill)
                                <tr class="align-middle">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $waybill->customer_name->name }}</td>
                                    <td>{{ $waybill->job }}</td>
                                    <td>{{ $waybill->vehicle_no }}</td>
                                    <td>{{ $waybill->driver_name }}</td>
                                    <td>{{ $waybill->bill_date }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="View Waybill Detail - {{ $waybill->customer_name->name }}" data-bs-url="form_view/viewWaybill/{{ $waybill->bill_id }}" data-bs-size="modal-lg"> View Details</button>
                                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Edit Price Details" data-bs-url="form_edit/editWaybill/{{ $waybill->bill_id }}" data-bs-size="modal-xl" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-pencil-square"></i></button>
                                        @can(\App\Enums\PermissionsEnum::DELETEWAYBILL->value)
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Confirm Price Deletion" data-bs-url="form_delete/deleteWaybill/{{ $waybill->bill_id }}" data-bs-size="" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-trash"></i></button>
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

    <x-ajax-call-input-fields :ajax_url="'get_search_product'" :form="'transactions.ajax_form.waybill_form'" />

@endsection

