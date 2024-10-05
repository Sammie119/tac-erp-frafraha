@extends('layouts.master')

@section('title', 'TAC PRESS | Users')

@section('content')

    <x-breadcrumb>User Management</x-breadcrumb>

    <div class="app-content">
        <div class="container-fluid">

            <x-error-notification :errors="$errors->all()"/>

            <div class="col-md-12">
                <div class="card mb-4">

                    <x-datatable.card-header :icon="'staff'" :title="'Users List'">
                        @can(\App\Enums\PermissionsEnum::CREATEUSERS->value)
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Add New User" data-bs-url="form_create/createUser" data-bs-size="modal-lg"> <i class="bi bi-plus-lg"></i> Add User</button>
                        @endcan
                    </x-datatable.card-header>

                    @php
                        $checkData = 1;
                        if(empty($users->toArray()))
                            $checkData = 0;
                    @endphp

                    <div class="card-body p-0">
                        <x-datatable.datatable :checkData="$checkData" :headers="[
                            ['name' => '#', 'width' => '5%'],
                            'Name',
                            'Email',
                            'Division',
                            ['name' => 'Action', 'width' => '17%', 'classes' => 'no-sort']
                        ]">

                            @forelse ($users as $key => $user)
                                <tr class="align-middle">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $user->staff_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->division_name }}</td>
                                    <td>
                                        @can(\App\Enums\PermissionsEnum::ADDROLESTOUSERS->value)
                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Set User Roles - {{ $user->staff_name }}" data-bs-url="form_view/createUserRole/{{ $user->id }}" data-bs-size="modal-lg"> User Roles</button>
                                        @endcan
                                        @can(\App\Enums\PermissionsEnum::UPDATEUSERS->value)
                                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Edit User Details" data-bs-url="form_edit/editUser/{{ $user->id }}" data-bs-size="modal-lg" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-pencil-square"></i></button>
                                        @endcan
                                        @can(\App\Enums\PermissionsEnum::DELETEUSERS->value)
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Confirm User Deletion" data-bs-url="form_delete/deleteUser/{{ $user->id }}" data-bs-size="" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-trash"></i></button>
                                        @endcan
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

