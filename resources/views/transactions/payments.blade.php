@extends('layouts.master')

@section('title', 'TAC PRESS | Payments')

@section('content')

    <x-breadcrumb>Payment Management</x-breadcrumb>

    <div class="app-content">
        <div class="container-fluid">

            <x-error-notification :errors="$errors->all()"/>

            <div class="col-md-12">
                <div class="card mb-4">

                    <x-datatable.card-header :icon="'cash'" :title="'Payments'">
                        @can(\App\Enums\PermissionsEnum::CREATEPAYMENT->value)
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Add New Payment" data-bs-url="form_create/createPayment" data-bs-size="modal-xl"> <i class="bi bi-plus-lg"></i> Add Payment</button>
                        @endcan
                    </x-datatable.card-header>

                    <div class="card-body p-0 mb-3">
                        <x-datatable.datatable :headers="[
                            ['name' => '#', 'width' => '5%'],
                            'Invoice No',
                            'Receipt No',
                            'Customer',
                            'Amount',
                            'Paid',
                            'Balance',
                            'Status',
                            'Date',
                            ['name' => 'Action', 'width' => '17%', 'classes' => 'no-sort']
                        ]">

                            @forelse ($payments as $key => $payment)
                                <tr class="align-middle">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $payment->invoice_no }}</td>
                                    <td>{{ $payment->receipt_no }}</td>
                                    <td>{{ $payment->transaction->customer_name }}</td>
                                    <td>{{ $payment->paid_balance }}</td>
                                    <td>{{ $payment->amount_paid }}</td>
                                    <td>{{ $payment->balance }}</td>
                                    <td>{!! getPaymentStatus($payment->transaction->status) !!}</td>
                                    <td>{{ $payment->payment_date }}</td>
                                    <td>
                                        @can(\App\Enums\PermissionsEnum::VIEWPAYMENT->value)
                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="View Receipt - {{ $payment->receipt_no }}" data-bs-url="form_view/viewReceipt/{{ $payment->id }}" data-bs-size="modal-xl"> Receipt</button>
                                        @endcan
                                        @if($payment->transaction->status !== 'Paid')
                                            @can(\App\Enums\PermissionsEnum::CREATEPAYMENT->value)
                                                <button class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Make Payment for - {{ $payment->invoice_no }}" data-bs-url="form_edit/makeSinglePayment/{{ $payment->transaction_id }}" data-bs-size="modal-xl" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-cash-stack"></i></button>
                                            @endcan
                                        @endif
                                        @can(\App\Enums\PermissionsEnum::UPDATEPAYMENT->value)
                                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Edit Payment Details for {{ $payment->receipt_no }}" data-bs-url="form_edit/editPayment/{{ $payment->id }}" data-bs-size="modal-xl" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-pencil-square"></i></button>
                                        @endcan
                                        @can(\App\Enums\PermissionsEnum::DELETEPAYMENT->value)
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Confirm Payment Deletion" data-bs-url="form_delete/deletePayment/{{ $payment->id }}" data-bs-size="" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-trash"></i></button>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr class="align-middle">
                                    <td colspan="15">No Data</td>
                                </tr>
                            @endforelse
                        </x-datatable.datatable>

                    </div> <!-- /.card-body -->
                </div> <!-- /.card -->
            </div>
        </div> <!-- /.container-fluid -->
    </div> <!--end::App Content-->

    <x-call-modal />

    <x-ajax-call-input-fields :ajax_url="'get_search_invoice'" :form="'transactions.ajax_form.payment_form'" />

@endsection

{{-- {{ $url = 'search_users' }} --}}
<x-ajax-call-search :url="'search_transactions'" />


