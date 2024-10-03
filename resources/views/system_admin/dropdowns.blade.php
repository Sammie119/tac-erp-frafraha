@extends('layouts.master')

@section('title', 'TAC PRESS | System LOVs')

@section('content')

    <x-breadcrumb>System List of Values</x-breadcrumb>

    <div class="app-content">
        <div class="container-fluid">

            <x-error-notification :errors="$errors->all()"/>

            <div class="col-md-12">
                <div class="card mb-4">

                    <x-datatable.card-header :icon="'list'" :title="'System List of Values'">
                        @can(\App\Enums\PermissionsEnum::CREATELOV->value)
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Add LOV Category" data-bs-url="form_create/createCategory" data-bs-size=""> <i class="bi bi-plus-lg"></i> Add Category</button>
                        @endcan
                    </x-datatable.card-header>

                    <div class="card-body p-0 mb-3">
                        <x-datatable.datatable :headers="[
                            ['name' => '#', 'width' => '5%'],
                            'Category Name',
                            ['name' => 'Action', 'width' => '20%', 'classes' => 'no-sort']
                        ]">

                            @forelse ($dropdowns as $key => $dropdown)
                                <tr class="align-middle">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $dropdown->category_name }}</td>
                                    <td>
                                        @can(\App\Enums\PermissionsEnum::CREATELOV->value)
                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Add List of Values - {{ $dropdown->category_name }}" data-bs-url="form_view/createListOfValues/{{ $dropdown->id }}" data-bs-size=""> Values</button>
                                        @endcan
                                        @can(\App\Enums\PermissionsEnum::UPDATELOV->value)
                                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Edit Category Detail" data-bs-url="form_edit/editCategory/{{ $dropdown->id }}" data-bs-size="" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-pencil-square"></i></button>
                                        @endcan
                                        @can(\App\Enums\PermissionsEnum::DELETELOV->value)
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Confirm Category Deletion" data-bs-url="form_delete/deleteCategory/{{ $dropdown->id }}" data-bs-size="" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-trash"></i></button>
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

    <x-call-modal-toggle />

@endsection

{{-- {{ $url = 'search_users' }} --}}
<x-ajax-call-search :url="'search_lov_category'" />

