@php use Illuminate\Support\Facades\DB; @endphp
@extends('layouts.master')

@section('title', 'TAC PRESS | Permissions')

@section('content')

    <x-breadcrumb>Permissions</x-breadcrumb>

    <div class="app-content">
        <div class="container-fluid">

            <x-error-notification :errors="$errors->all()"/>

            <div class="col-md-12">
                <div class="card mb-4">

                    <x-datatable.card-header :icon="'list'" :title="'Permissions'">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Add New Permission" data-bs-url="form_create/createPermission" data-bs-size="modal-lg"> <i class="bi bi-plus-lg"></i> Add Permission</button>
                    </x-datatable.card-header>

                    <div class="card-body p-0">
                        <x-datatable.datatable :headers="[
                            ['name' => '#', 'width' => '5%'],
                            'Name',
                            ['name' => 'Action', 'width' => '17%', 'classes' => 'no-sort']
                       ]">
                            @forelse ($permissions as $key => $permission)
                                <tr class="align-middle">
                                    <td>{{  ++$key }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Edit Permission" data-bs-url="form_edit/editPermission/{{ $permission->id }}" data-bs-size="modal-lg"> <i class="bi bi-pencil-square"></i></button>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Confirm Permission Deletion" data-bs-url="form_delete/deletePermission/{{ $permission->id }}" data-bs-size=""> <i class="bi bi-trash"></i></button>
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

@endsection

<x-ajax-call-search :url="'search_permissions'" />

