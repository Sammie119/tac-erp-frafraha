@extends('layouts.master')

@section('title', 'TAC PRESS | Staff')

@section('content')

    <x-breadcrumb>Staff Management</x-breadcrumb>

    <div class="app-content">
        <div class="container-fluid">

            <x-error-notification :errors="$errors->all()"/>

            <div class="col-md-12">
                <div class="card mb-4">

                    <x-datatable.card-header :icon="'staff'" :title="'Staff List'">
                        @can(\App\Enums\PermissionsEnum::CREATESTAFF->value)
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Add New Staff" data-bs-url="form_create/createStaff" data-bs-size="modal-xl"> <i class="bi bi-plus-lg"></i> Add Staff</button>
                        @endcan
                    </x-datatable.card-header>

                    @php
                        $checkData = 1;
                        if(empty($staff->toArray()))
                            $checkData = 0;
                    @endphp

                    <div class="card-body p-0 mb-3">
                        <x-datatable.datatable :checkData="$checkData" :headers="[
                            ['name' => '#', 'width' => '5%'],
                            'Name',
                            'Gender',
                            'DOB',
                            'Mobile',
                            'Email',
                            'Position',
                            ['name' => 'Action', 'width' => '15%', 'classes' => 'no-sort']
                        ]">

                            @forelse ($staff as $key => $staf)
                                <tr class="align-middle">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $staf->full_name }}</td>
                                    <td>{{ $staf->gender_name }}</td>
                                    <td>{{ $staf->date_of_birth }}</td>
                                    <td>{{ $staf->phone }}</td>
                                    <td>{{ $staf->email }}</td>
                                    <td>{{ $staf->position_name }}</td>
                                    <td>
                                        @can(\App\Enums\PermissionsEnum::VIEWSTAFF->value)
                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="View Staff Detail" data-bs-url="form_view/viewStaff/{{ $staf->staff_id }}" data-bs-size="modal-xl"> View Staff</button>
                                        @endcan
                                        @can(\App\Enums\PermissionsEnum::UPDATESTAFF->value)
                                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Edit Staff Details" data-bs-url="form_edit/editStaff/{{ $staf->staff_id }}" data-bs-size="modal-xl" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-pencil-square"></i></button>
                                        @endcan
                                        @can(\App\Enums\PermissionsEnum::DELETESTAFF->value)
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Confirm Staff Deletion" data-bs-url="form_delete/deleteStaff/{{ $staf->staff_id }}" data-bs-size="" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-trash"></i></button>
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


