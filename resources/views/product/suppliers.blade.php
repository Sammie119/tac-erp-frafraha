@extends('layouts.master')

@section('title', 'TAC PRESS | Suppliers')

@section('content')

    <x-breadcrumb>Suppliers</x-breadcrumb>

    <div class="app-content">
        <div class="container-fluid">

            <x-error-notification :errors="$errors->all()"/>

            <div class="col-md-12">
                <div class="card mb-4">

                    <x-datatable.card-header :icon="'list'" :title="'Suppliers'">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Add Supplier" data-bs-url="form_create/createSupplier" data-bs-size="modal-lg"> <i class="bi bi-plus-lg"></i> Add Supplier</button>
                    </x-datatable.card-header>

                    @php
                        $checkData = 1;
                        if(empty($suppliers->toArray()))
                            $checkData = 0;
                    @endphp

                    <div class="card-body p-0 mb-3">
                        <x-datatable.datatable :checkData="$checkData" :headers="[
                            ['name' => '#', 'width' => '5%'],
                            'Supplier Name',
                            ['name' => 'Supplier Contact', 'width' => '12%', 'nowrap' => 'nowrap'],
                            'Contact Person',
                            ['name' => 'Contact', 'width' => '12%'],
                            ['name' => 'Action', 'width' => '17%', 'classes' => 'no-sort']
                        ]">

                            @forelse ($suppliers as $key => $supplier)
                                <tr class="align-middle">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $supplier->supplier_name }}</td>
                                    <td>{{ $supplier->supplier_phone }}</td>
                                    <td>{{ $supplier->contact_name }}</td>
                                    <td>{{ $supplier->contact_phone }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="View Supplier Detail - {{ $supplier->supplier_name }}" data-bs-url="form_view/viewSupplier/{{ $supplier->supplier_id }}" data-bs-size="modal-lg"> View Supplier</button>
                                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Edit Supplier Details" data-bs-url="form_edit/editSupplier/{{ $supplier->supplier_id }}" data-bs-size="modal-lg" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-pencil-square"></i></button>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Confirm Supplier Deletion" data-bs-url="form_delete/deleteSupplier/{{ $supplier->supplier_id }}" data-bs-size="" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-trash"></i></button>
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

