@extends('layouts.master')

@section('title', 'TAC PRESS | Returned Products')

@section('content')

    <x-breadcrumb>Returned Products</x-breadcrumb>

    <div class="app-content">
        <div class="container-fluid">

            <x-error-notification :errors="$errors->all()"/>

            <div class="col-md-12">
                <div class="card mb-4">

                    <x-datatable.card-header :icon="'list'" :title="'Returned Products'">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Add Returned Products" data-bs-url="form_create/createReturnedProduct" data-bs-size="modal-xl"> <i class="bi bi-plus-lg"></i> Add Returned Products</button>
                    </x-datatable.card-header>

                    @php
                        $checkData = 1;
                        if(empty($products->toArray()))
                            $checkData = 0;
                    @endphp

                    <div class="card-body p-0 mb-3">
                        <x-datatable.datatable :checkData="$checkData" :headers="[
                            ['name' => '#', 'width' => '5%'],
                            'Invoice No.',
                            'Product Name',
                            'Reason',
                            'Date',
                            ['name' => 'Quantity', 'nowrap' => 'nowrap', 'width' => '9%'],
                            ['name' => 'Rate', 'nowrap' => 'nowrap', 'width' => '9%'],
                            ['name' => 'Amount', 'nowrap' => 'nowrap', 'width' => '9%'],
                            ['name' => 'Action', 'width' => '5%', 'classes' => 'no-sort']
                        ]">

                            @forelse ($products as $key => $product)
                                <tr class="align-middle">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $product->invoice_no}}</td>
                                    <td>{{ get_product_name($product->product_id) }}</td>
                                    <td>{{ $product->reason }}</td>
                                    <td>{{ $product->returned_date }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ $product->unit_price }}</td>
                                    <td>{{ $product->amount }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Confirm Returned Product Deletion" data-bs-url="form_delete/deleteReturnedProduct/{{ $product->id }}" data-bs-size="" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-trash"></i></button>
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

