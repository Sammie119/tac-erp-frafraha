@extends('layouts.master')

@section('title', 'TAC PRESS | Purchase Orders')

@section('content')

    <x-breadcrumb>Purchase Orders</x-breadcrumb>

    <div class="app-content">
        <div class="container-fluid">

            <x-error-notification :errors="$errors->all()"/>

            <div class="col-md-12">
                <div class="card mb-4">

                    <x-datatable.card-header :icon="'list'" :title="'Purchase Orders'">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Add Purchase Order" data-bs-url="form_create/createPurchaseOrder" data-bs-size="modal-lg"> <i class="bi bi-plus-lg"></i> Add Purchase Order</button>
                    </x-datatable.card-header>

                    @php
                        $checkData = 1;
                        if(empty($purchase_orders->toArray()))
                            $checkData = 0;
                    @endphp

                    <div class="card-body p-0 mb-3">
                        <x-datatable.datatable :checkData="$checkData" :headers="[
                            ['name' => '#', 'width' => '5%'],
                            'Supplier Name',
                            ['name' => 'Invoice #', 'width' => '12%'],
                            ['name' => 'Order Date', 'nowrap' => 'nowrap', 'width' => '10%'],
                            ['name' => 'Received On', 'nowrap' => 'nowrap', 'width' => '10%'],
                            ['name' => 'Amount', 'width' => '10%'],
                            ['name' => 'Status', 'width' => '9%'],
                            ['name' => 'Action', 'width' => '9%', 'classes' => 'no-sort']
                        ]">

                            @forelse ($purchase_orders as $key => $order)
                                <tr class="align-middle">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $order->supplier->supplier_name}}</td>
                                    <td>{{ $order->invoice_number }}</td>
                                    <td>{{ $order->order_date }}</td>
                                    <td>{{ $order->received_date }}</td>
                                    <td>{{ number_format($order->total_amount, 2) }}</td>
                                    <td>{!! getOrderStatus($order->status) !!}</td>
                                    <td>
{{--                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="View Purchase Order Detail - {{ $order->order_name }}" data-bs-url="form_view/viewPurchaseOrder/{{ $order->purchase_id }}" data-bs-size="modal-lg"> View Supplier</button>--}}
                                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Edit Purchase Order Details" data-bs-url="form_edit/editPurchaseOrder/{{ $order->purchase_id }}" data-bs-size="modal-lg" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-pencil-square"></i></button>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Confirm Purchase Order Deletion" data-bs-url="form_delete/deletePurchaseOrder/{{ $order->purchase_id }}" data-bs-size="" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-trash"></i></button>
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

