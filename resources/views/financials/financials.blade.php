@extends('layouts.master')

@section('title', 'TAC PRESS | Financials')

@section('content')

    <x-breadcrumb>Financials</x-breadcrumb>

    <div class="app-content">
        <div class="container-fluid">

            <x-error-notification :errors="$errors->all()"/>

            <div class="col-md-12">
                <div class="card mb-4">

                    <x-datatable.card-header :icon="'cash'" :title="'Financial Entries'">
                        @can(\App\Enums\PermissionsEnum::CREATEFINANCIAL->value)
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Add New Financial Entry" data-bs-url="form_create/createFinancial" data-bs-size="modal-lg"> <i class="bi bi-plus-lg"></i> Add New Entry</button>
                        @endcan
                    </x-datatable.card-header>

                    <div class="card-body p-0 mb-3">
                        <x-datatable.datatable :headers="[
                            ['name' => '#', 'width' => '5%'],
                            'Transaction',
                            'Mode',
                            'Type',
                            'Source',
                            'Amount',
                            'Unit',
                            'Date',
                            'Paid By',
                            ['name' => 'Action', 'width' => '14%', 'classes' => 'no-sort']
                        ]">

                            @forelse ($financials as $key => $financial)
                                <tr class="align-middle">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $financial->name }}</td>
                                    <td nowrap>{{ $financial->mode_name->name }}</td>
                                    <td nowrap>{{ $financial->type_name->name }}</td>
                                    <td nowrap>{{ $financial->source_name->name }}</td>
                                    <td nowrap>{{ $financial->amount }}</td>
                                    <td nowrap>{{ $financial->division_name->name }}</td>
                                    <td nowrap>{{ $financial->transaction_date }}</td>
                                    <td nowrap>{{ $financial->amount_paid_by }}</td>
                                    <td>
                                        @can(\App\Enums\PermissionsEnum::VIEWFINANCIAL->value)
                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="View Details - {{ $financial->transaction_id }}" data-bs-url="form_view/viewFinancial/{{ $financial->financial_id }}" data-bs-size="modal-lg"> Details</button>
                                        @endcan
                                        @can(\App\Enums\PermissionsEnum::UPDATEFINANCIAL->value)
                                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Edit Financial Details for {{ $financial->invoice_no }}" data-bs-url="form_edit/editFinancial/{{ $financial->financial_id }}" data-bs-size="modal-lg" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-pencil-square"></i></button>
                                        @endcan
                                        @can(\App\Enums\PermissionsEnum::DELETEFINANCIAL->value)
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Confirm Financial Deletion" data-bs-url="form_delete/deleteFinancial/{{ $financial->financial_id }}" data-bs-size="" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-trash"></i></button>
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

<x-ajax-call-search :url="'search_financials'" />


