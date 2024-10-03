@extends('layouts.master')

@section('title', 'TAC PRESS | Transactions Report')

@section('content')

    <x-breadcrumb>Transactions Report</x-breadcrumb>

    <div class="app-content">
        <div class="app-content"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Row-->

                <x-error-notification :errors="$errors->all()"/>

                <div class="row"> <!--begin::Col-->

                    <div class="col-lg-4 col-6"> <!--begin::Small Box Widget 1-->
                        <x-card-button
                            modal_title="Invoice Report"
                            modal_url="form_report/invoiceReport"
                            modal_size=""
                            button_title="Invoice Report"
                            button_description="Transactions Report"
                            button_color="text-bg-primary"
                        >
                            <i class="bi bi-bar-chart-line-fill"></i>
                        </x-card-button>
                    </div>

                    <div class="col-lg-4 col-6"> <!--begin::Small Box Widget 1-->
                        <x-card-button
                            modal_title="Receipt Report"
                            modal_url="form_report/invoiceReport"
                            modal_size="modal-xl"
                            button_title="Receipt Report"
                            button_description="Transactions Report"
                            button_color="text-bg-success"
                        >
                            <i class="bi bi-bar-chart-line-fill"></i>
                        </x-card-button>
                    </div>

                    <div class="col-lg-4 col-6"> <!--begin::Small Box Widget 1-->
                        <x-card-button
                            modal_title="Income Report"
                            modal_url="form_report/invoiceReport"
                            modal_size="modal-xl"
                            button_title="Income Report"
                            button_description="Transactions Report"
                            button_color="text-bg-info"
                        >
                            <i class="bi bi-bar-chart"></i>
                        </x-card-button>
                    </div>

                    <div class="col-lg-4 col-6"> <!--begin::Small Box Widget 1-->
                        <x-card-button
                            modal_title="Bank Report"
                            modal_url="form_report/invoiceReport"
                            modal_size="modal-xl"
                            button_title="Bank Report"
                            button_description="Transactions Report"
                            button_color="text-bg-danger"
                        >
                            <i class="bi bi-bar-chart"></i>
                        </x-card-button>
                    </div>
                </div> <!--end::Row-->

            </div> <!--end::Container-->
        </div> <!--end::App Content-->
    </div> <!--end::App Content-->

    <x-call-modal />

@endsection




