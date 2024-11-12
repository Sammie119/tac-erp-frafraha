@extends('layouts.master')

@section('title', 'TAC PRESS | Customers')

@section('content')

    <x-breadcrumb>Customer Management</x-breadcrumb>

    <div class="app-content">
        <div class="container-fluid">

            <x-error-notification :errors="$errors->all()"/>

            <div class="col-md-12">
                <div class="card mb-4">

                    <x-datatable.card-header :icon="'staff'" :title="'Customers List'">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Add New Customer" data-bs-url="form_create/createCustomer" data-bs-size="modal-lg"> <i class="bi bi-plus-lg"></i> Add Customer</button>
                    </x-datatable.card-header>

                    @php
                        $checkData = 1;
                        if(empty($customers->toArray()))
                            $checkData = 0;
                    @endphp

                    <div class="card-body p-0 mb-3">
                        <x-datatable.datatable :checkData="$checkData" :headers="[
                            ['name' => '#', 'width' => '5%'],
                            'Name',
                            'Mobile',
                            'Email',
                            'Location',
                            ['name' => 'Action', 'width' => '18%', 'classes' => 'no-sort']
                        ]">

                            @forelse ($customers as $key => $customer)
                                <tr class="align-middle">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->location }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="View Customer Detail" data-bs-url="form_view/viewCustomer/{{ $customer->id }}" data-bs-size="modal-lg"> View Customer</button>
                                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Edit Customer Details" data-bs-url="form_edit/editCustomer/{{ $customer->id }}" data-bs-size="modal-lg" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-pencil-square"></i></button>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Confirm Customer Deletion" data-bs-url="form_delete/deleteCustomer/{{ $customer->id }}" data-bs-size="" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-trash"></i></button>
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


