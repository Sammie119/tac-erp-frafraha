@extends('layouts.master')

@section('title', 'TAC PRESS | Products Pricing')

@section('content')

    <x-breadcrumb>Price Products</x-breadcrumb>

    <div class="app-content">
        <div class="container-fluid">

            <x-error-notification :errors="$errors->all()"/>

            <div class="col-md-12">
                <div class="card mb-4">

                    <x-datatable.card-header :icon="'products'" :title="'Products Price History'">
                        @can(\App\Enums\PermissionsEnum::CREATEPRODUCT->value)
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Price Products" data-bs-url="form_create/createPriceProducts" data-bs-size="modal-lg"> <i class="bi bi-plus-lg"></i> Price Products</button>
                        @endcan
                    </x-datatable.card-header>

                    <div class="card-body p-0 mb-3">
                        <x-datatable.datatable :headers="[
                            ['name' => '#', 'width' => '5%'],
                            'Product Name',
                            'Old Cost',
                            'Old Price',
                            'New Cost',
                            'New Price',
                            'Date Time',
                            ['name' => 'Action', 'width' => '17%', 'classes' => 'no-sort']
                        ]">

                            @forelse ($prices as $key => $price)
                                <tr class="align-middle">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $price->product_name->name }}</td>
                                    <td>{{ $price->old_cost }}</td>
                                    <td>{{ $price->old_price }}</td>
                                    <td>{{ $price->new_cost }}</td>
                                    <td>{{ $price->new_price }}</td>
                                    <td>{{ $price->updated_at }}</td>
                                    <td>
                                        @can(\App\Enums\PermissionsEnum::VIEWPRODUCT->value)
                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="View Products Detail - {{ $price->product_name->name }}" data-bs-url="form_view/viewProduct/{{ $price->product_id }}" data-bs-size="modal-lg"> View Product</button>
                                        @endcan
                                        @can(\App\Enums\PermissionsEnum::UPDATEPRODUCT->value)
                                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Edit Price Details" data-bs-url="form_edit/editPriceProduct/{{ $price->price_id }}" data-bs-size="modal-lg" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-pencil-square"></i></button>
                                        @endcan
                                        @can(\App\Enums\PermissionsEnum::DELETEPRODUCT->value)
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Confirm Price Deletion" data-bs-url="form_delete/deletePriceProduct/{{ $price->price_id }}" data-bs-size="" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-trash"></i></button>
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

    <x-ajax-call-input-fields :ajax_url="'get_search_product'" :form="'product.ajax_form.price_form'" />

@endsection

{{-- {{ $url = 'search_users' }} --}}
<x-ajax-call-search :url="'search_prices'" />

