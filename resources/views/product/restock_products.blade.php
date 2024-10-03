@extends('layouts.master')

@section('title', 'TAC PRESS | Restock Products')

@section('content')

    <x-breadcrumb>Restock Products</x-breadcrumb>

    <div class="app-content">
        <div class="container-fluid">

            <x-error-notification :errors="$errors->all()"/>

            <div class="col-md-12">
                <div class="card mb-4">

                    <x-datatable.card-header :icon="'products'" :title="'Restock Products History'">
                        @can(\App\Enums\PermissionsEnum::CREATEPRODUCT->value)
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Restock Products" data-bs-url="form_create/createRestockProducts" data-bs-size="modal-lg"> <i class="bi bi-plus-lg"></i> Restock Products</button>
                        @endcan
                    </x-datatable.card-header>

                    <div class="card-body p-0 mb-3">
                        <x-datatable.datatable :headers="[
                            ['name' => '#', 'width' => '5%'],
                            'Product Name',
                            'Old Qty',
                            'Old Stock',
                            'Old Sold',
                            'New Qty',
                            'Date Time',
                            ['name' => 'Action', 'width' => '17%', 'classes' => 'no-sort']
                        ]">

                            @forelse ($products as $key => $product)
                                <tr class="align-middle">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $product->product_name->name }}</td>
                                    <td>{{ $product->old_quantity }}</td>
                                    <td>{{ $product->old_stock }}</td>
                                    <td>{{ $product->old_sold }}</td>
                                    <td>{{ $product->new_quantity }}</td>
                                    <td>{{ $product->updated_at }}</td>
                                    <td>
                                        @can(\App\Enums\PermissionsEnum::VIEWPRODUCT->value)
                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="View Products Detail - {{ $product->product_name->name }}" data-bs-url="form_view/viewProduct/{{ $product->product_id }}" data-bs-size="modal-lg"> View Product</button>
                                        @endcan
                                        @can(\App\Enums\PermissionsEnum::UPDATEPRODUCT->value)
                                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Edit Restock Details" data-bs-url="form_edit/editRestockProduct/{{ $product->restock_id }}" data-bs-size="modal-lg" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-pencil-square"></i></button>
                                        @endcan
                                        @can(\App\Enums\PermissionsEnum::DELETEPRODUCT->value)
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Confirm Restock Deletion" data-bs-url="form_delete/deleteRestockProduct/{{ $product->restock_id }}" data-bs-size="" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-trash"></i></button>
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

    <x-ajax-call-input-fields :ajax_url="'get_search_product'" :form="'product.ajax_form.restock_form'" />

@endsection

{{-- {{ $url = 'search_users' }} --}}
<x-ajax-call-search :url="'search_restock'" />

