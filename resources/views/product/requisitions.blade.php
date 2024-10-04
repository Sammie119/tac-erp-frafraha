@extends('layouts.master')

@section('title', 'TAC PRESS | Requisitions')

@section('content')

    <x-breadcrumb>Requisitions</x-breadcrumb>

    <div class="app-content">
        <div class="container-fluid">

            <x-error-notification :errors="$errors->all()"/>

            <div class="col-md-12">
                <div class="card mb-4">

                    <x-datatable.card-header :icon="'products'" :title="'Requisitions History'">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Requisitions" data-bs-url="form_create/createRequisition" data-bs-size="modal-lg"> <i class="bi bi-plus-lg"></i> New Requisitions</button>
                    </x-datatable.card-header>

                    @php
                        $checkData = 1;
                        if(empty($requisitions->toArray()))
                            $checkData = 0;
                    @endphp

                    <div class="card-body p-0 mb-3">
                        <x-datatable.datatable :checkData="$checkData" :headers="[
                            ['name' => '#', 'width' => '5%'],
                            'Req Date',
                            'Request By',
                            'Approved By',
                            'App. Date',
                            'Status',
                            ['name' => 'Action', 'width' => '23%', 'classes' => 'no-sort']
                        ]">

                            @forelse ($requisitions as $key => $requisition)
                                <tr class="align-middle">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $requisition->request_date }}</td>
                                    <td>{{ get_logged_staff_name($requisition->createdBy->staff_id) }}</td>
                                    <td>{{ (!empty($requisition->approved_date)) ? get_logged_staff_name($requisition->approvedBy->staff_id) : "N/A" }}</td>
                                    <td>{{ (!empty($requisition->approved_date)) ? $requisition->approved_date : "N/A" }}</td>
                                    <td>{!! getStatus($requisition->status) !!}</td>
                                    <td>
                                        @can(\App\Enums\PermissionsEnum::APPROVEREQUISITION->value)
                                            <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Approve Requisition" data-bs-url="form_view/approveRequisition/{{ $requisition->req_id }}" data-bs-size="modal-xl"> Approve Req</button>
                                        @endcan
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="View Requisition Detail" data-bs-url="form_view/viewRequisition/{{ $requisition->req_id }}" data-bs-size="modal-xl"> Requests</button>
                                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Edit Price Details" data-bs-url="form_edit/editRequisition/{{ $requisition->req_id }}" data-bs-size="modal-lg" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-pencil-square"></i></button>
                                        @can(\App\Enums\PermissionsEnum::DELETEREQUISITION->value)
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Confirm Price Deletion" data-bs-url="form_delete/deleteRequisition/{{ $requisition->req_id }}" data-bs-size="" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-trash"></i></button>
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

    <x-ajax-call-input-fields :ajax_url="'get_search_product'" :form="'product.ajax_form.requisition_form'" />

@endsection

