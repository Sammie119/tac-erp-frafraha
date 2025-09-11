@extends('layouts.master')

@section('title', 'TAC PRESS | Receivables')

@section('content')

    <x-breadcrumb>Receivables</x-breadcrumb>

    <div class="app-content">
        <div class="container-fluid">

            <x-error-notification :errors="$errors->all()"/>

            <div class="col-md-12">
                <div class="card mb-4">

                    <x-datatable.card-header :icon="'list'" :title="'Receivables'">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Add Receivable" data-bs-url="form_create/createReceivables" data-bs-size="modal-xl"> <i class="bi bi-plus-lg"></i> Add Receivable</button>
                    </x-datatable.card-header>

                    @php
                        $checkData = 1;
                        if(empty($receivables->toArray()))
                            $checkData = 0;
                    @endphp

                    <div class="card-body p-0 mb-3">
                        <x-datatable.datatable :checkData="$checkData" :headers="[
                            ['name' => '#', 'width' => '5%'],
                            'Supplier',
                            'Product Name',
                            'Description',
                            ['name' => 'Quantity', 'nowrap' => 'nowrap', 'width' => '9%'],
                            ['name' => 'Rate', 'nowrap' => 'nowrap', 'width' => '9%'],
                            ['name' => 'Amount', 'nowrap' => 'nowrap', 'width' => '9%'],
                            ['name' => 'Action', 'width' => '5%', 'classes' => 'no-sort']
                        ]">

                            @forelse ($receivables as $key => $receivable)
                                <tr class="align-middle">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $receivable->supplier->supplier_name}}</td>
                                    <td>{{ get_product_name($receivable->product_id) }}</td>
                                    <td>{{ $receivable->description }}</td>
                                    <td>{{ $receivable->quantity }}</td>
                                    <td>{{ $receivable->unit_price }}</td>
                                    <td>{{ $receivable->amount }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Confirm Receivable Deletion" data-bs-url="form_delete/deleteReceivable/{{ $receivable->id }}" data-bs-size="" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-trash"></i></button>
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

