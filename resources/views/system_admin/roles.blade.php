@php use Illuminate\Support\Facades\DB; @endphp
@extends('layouts.master')

@section('title', 'TAC PRESS | Roles')

@section('content')

    <x-breadcrumb>Roles</x-breadcrumb>

    <div class="app-content">
        <div class="container-fluid">

            <x-error-notification :errors="$errors->all()"/>

            <div class="col-md-12">
                <div class="card mb-4">

                    <x-datatable.card-header :icon="'list'" :title="'Roles'">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Add New Role" data-bs-url="form_create/createRole" data-bs-size="modal-lg"> <i class="bi bi-plus-lg"></i> Add Role</button>
                    </x-datatable.card-header>

                    @php
                        $checkData = 1;
                        if(empty($roles->toArray()))
                            $checkData = 0;
                    @endphp

                    <div class="card-body p-0 mb-3">
                        <x-datatable.datatable :checkData="$checkData" :headers="[
                            ['name' => '#', 'width' => '5%'],
                            'Name',
                            'Permissions',
                            ['name' => 'Action', 'width' => '20%', 'classes' => 'no-sort']
                        ]">

                            @forelse ($roles as $key => $role)
                                @php
                                    $permissions = DB::table('role_has_permissions')->where('role_id', $role->id)->limit(5)->pluck('permission_id')->toArray();
                                @endphp
                                <tr class="align-middle">
                                    <td>{{ ++$key }}</td>
                                    <td nowrap>{{ $role->name }}</td>
                                    <td>
                                        @forelse($permissions as $permission)
                                            <span class="badge rounded-pill text-bg-dark">{{ get_permission_name($permission) }}</span>
                                        @empty
                                            {{ null }}
                                        @endforelse
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Add Permissions to {{ $role->name }} Role" data-bs-url="form_view/addPermissions/{{ $role->id }}" data-bs-size="modal-lg"> View Permissions</button>
                                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Edit Role Details" data-bs-url="form_edit/editRole/{{ $role->id }}" data-bs-size="modal-lg" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-pencil-square"></i></button>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Confirm Role Deletion" data-bs-url="form_delete/deleteRole/{{ $role->id }}" data-bs-size="" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-trash"></i></button>
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

