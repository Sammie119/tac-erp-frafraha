@extends('layouts.master')

@section('title', 'TAC PRESS | System Setups')

@section('content')

    <x-breadcrumb>System Setups</x-breadcrumb>

    <div class="app-content">
        <div class="container-fluid">

            <x-error-notification :errors="$errors->all()"/>

            <div class="col-md-12">
                <div class="card mb-4">

                    <x-datatable.card-header :icon="'gear'" :title="'System Setups'">
                        @if(get_logged_in_user_id() == 1)
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Add System Setup" data-bs-url="form_create/createSetup" data-bs-size="modal-lg"> <i class="bi bi-plus-lg"></i> Add System Setup</button>
                        @endif
                    </x-datatable.card-header>

                    <div class="card-body p-0 mb-3">
                        <x-datatable.datatable :headers="[
                            ['name' => '#', 'width' => '5%'],
                            'Division Name',
                            'Email',
                            'Telephone',
                            ['name' => 'Action', 'width' => '17%', 'classes' => 'no-sort']
                        ]">

                            @forelse ($setups as $key => $setup)
                                <tr class="align-middle">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $setup->display_name }}</td>
                                    <td>{{ $setup->email }}</td>
                                    <td>{{ $setup->phone1 }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="The Details of {{ $setup->display_name }}" data-bs-url="form_view/viewSetup/{{ $setup->id }}" data-bs-size="modal-lg"> View Details</button>
                                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Edit System Setup Detail" data-bs-url="form_edit/editSetup/{{ $setup->id }}" data-bs-size="modal-lg"> <i class="bi bi-pencil-square"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr class="align-middle">
                                    <td colspan="5">No Data</td>
                                </tr>
                            @endforelse
                        </x-datatable.datatable>

                    </div> <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-end">
{{--                            {{ $setups->links() }}--}}
                        </ul>
                    </div>
                </div> <!-- /.card -->
            </div>
        </div> <!-- /.container-fluid -->
    </div> <!--end::App Content-->

    <x-call-modal />

@endsection

{{-- {{ $url = 'search_users' }} --}}
{{--<x-ajax-call-search :url="'search_lov_category'" />--}}
