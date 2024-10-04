@extends('layouts.master')

@section('title', 'TAC PRESS | Transactions')

@section('content')

    <x-breadcrumb>Transaction Management</x-breadcrumb>

    <div class="app-content">
        <div class="container-fluid">

            <x-error-notification :errors="$errors->all()"/>

            <div class="col-md-12">
                <div class="card mb-4">

                    <x-datatable.card-header :icon="'cash'" :title="'Transactions'">
                        @can(\App\Enums\PermissionsEnum::CREATEINVOICE->value)
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Add New Transaction" data-bs-url="form_create/createTransaction" data-bs-size="modal-xl"> <i class="bi bi-plus-lg"></i> Add Transaction</button>
                        @endcan
                    </x-datatable.card-header>

                    @php
                        $checkData = 1;
                        if(empty($transactions->toArray()))
                            $checkData = 0;
                    @endphp

                    <div class="card-body p-0 mb-3">
                        <x-datatable.datatable :checkData="$checkData" :headers="[
                            ['name' => '#', 'width' => '5%'],
                            'Invoice No',
                            'Customer',
                            'Amount',
                            'Discount',
                            'Paid',
                            'Balance',
                            'Status',
                            'Date',
                            ['name' => 'Action', 'width' => '17%', 'classes' => 'no-sort']
                        ]">

                            @forelse ($transactions as $key => $transaction)
                                <tr class="align-middle">
                                    <td>{{ ++$key }}</td>
                                    <td nowrap>{{ $transaction->invoice_no }}</td>
                                    <td>{{ $transaction->customer_name }}</td>
                                    <td nowrap>{{ $transaction->transaction_amount }}</td>
                                    <td nowrap>{{ $transaction->discount }}</td>
                                    <td nowrap>{{ $transaction->amount_paid }}</td>
                                    <td nowrap>{{ $transaction->balance }}</td>
                                    <td>{!! getPaymentStatus($transaction->status) !!}</td>
                                    <td nowrap>{{ $transaction->transaction_date }}</td>
                                    <td>
                                        @can(\App\Enums\PermissionsEnum::VIEWINVOICE->value)
                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="View Invoice - {{ $transaction->invoice_no }}" data-bs-url="form_view/viewInvoice/{{ $transaction->transaction_id }}" data-bs-size="modal-xl"> Invoice</button>
                                        @endcan
                                        @if($transaction->status !== 'Paid')
                                            @can(\App\Enums\PermissionsEnum::CREATEPAYMENT->value)
                                                <button class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Make Payment for - {{ $transaction->invoice_no }}" data-bs-url="form_edit/makeSinglePayment/{{ $transaction->transaction_id }}" data-bs-size="modal-xl" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-cash-stack"></i></button>
                                            @endcan
                                        @endif
                                        @can(\App\Enums\PermissionsEnum::UPDATEINVOICE->value)
                                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Edit Transaction Details for {{ $transaction->invoice_no }}" data-bs-url="form_edit/editTransaction/{{ $transaction->transaction_id }}" data-bs-size="modal-xl" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-pencil-square"></i></button>
                                        @endcan
                                        @can(\App\Enums\PermissionsEnum::DELETEINVOICE->value)
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Confirm Transaction Deletion" data-bs-url="form_delete/deleteTransaction/{{ $transaction->transaction_id }}" data-bs-size="" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-trash"></i></button>
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

    <x-ajax-call-input-fields :ajax_url="'get_search_product'" :form="'transactions.ajax_form.transaction_form'" />

@endsection


