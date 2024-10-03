@extends('layouts.master')

@section('title', 'TAC PRESS | Products')

@section('content')

    <x-breadcrumb>Product Management</x-breadcrumb>

    <div class="app-content">
        <div class="container-fluid">

            <x-error-notification :errors="$errors->all()"/>

            <div class="col-md-12">
                <div class="card mb-4">

                    <x-datatable.card-header :icon="'products'" :title="'Products List'">
                        @can(\App\Enums\PermissionsEnum::CREATEPRODUCT->value)
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Add New Product" data-bs-url="form_create/createProduct" data-bs-size="modal-lg"> <i class="bi bi-plus-lg"></i> Add Product</button>
                        @endcan
                    </x-datatable.card-header>

                    <div class="card-body p-0 mb-3">
                        <x-datatable.datatable :headers="[
                            ['name' => '#', 'width' => '5%'],
                            'Name',
                            'Type',
                            'Stock',
                            ['name' => 'Action', 'width' => '17%', 'classes' => 'no-sort']
                        ]">

                            @forelse ($products as $key => $product)
                                <tr class="align-middle">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->type_name->name }}</td>
                                    <td>{{ $product->stock_in }}</td>
                                    <td>
                                        @can(\App\Enums\PermissionsEnum::VIEWPRODUCT->value)
                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="View Products Detail - {{ $product->name }}" data-bs-url="form_view/viewProduct/{{ $product->product_id }}" data-bs-size="modal-lg"> View Product</button>
                                        @endcan
                                        @can(\App\Enums\PermissionsEnum::UPDATEPRODUCT->value)
                                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Edit Product Details" data-bs-url="form_edit/editProduct/{{ $product->product_id }}" data-bs-size="modal-lg" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-pencil-square"></i></button>
                                        @endcan
                                        @can(\App\Enums\PermissionsEnum::DELETEPRODUCT->value)
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Confirm Product Deletion" data-bs-url="form_delete/deleteProduct/{{ $product->product_id }}" data-bs-size="" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-trash"></i></button>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr class="align-middle">
                                    <td colspan="5">No Data</td>
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

{{-- {{ $url = 'search_users' }} --}}
<x-ajax-call-search :url="'search_products'" />

