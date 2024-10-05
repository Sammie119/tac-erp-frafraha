@extends('layouts.master')

@section('title', 'TAC PRESS | Staff Attendance')

@section('content')

    <x-breadcrumb>Staff Attendance</x-breadcrumb>

    <div class="app-content">
        <div class="container-fluid">

            <x-error-notification :errors="$errors->all()"/>

            <div class="col-md-12">
                <div class="card mb-4">

                    <x-datatable.card-header :icon="'staff'" :title="'Staff Attendance'" :export_url="'attendance_export'">
                        @can(\App\Enums\PermissionsEnum::STAFFATTENDANCE->value)
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Upload Attendance" data-bs-url="form_create/createAttendance" data-bs-size=""> <i class="bi bi-upload"></i> Upload Attendance</button>
                        @endcan
                    </x-datatable.card-header>

                    @php
                        $checkData = 1;
                        if(empty($attendances->toArray()))
                            $checkData = 0;
                    @endphp

                    <div class="card-body p-0 mb-3">
                        <x-datatable.datatable :checkData="$checkData" :headers="[
                            ['name' => '#', 'width' => '5%'],
                            'Month',
                            'Year',
                            'Date',
                            'Unit',
                            'Created By',
                            ['name' => 'Action', 'width' => '15%', 'classes' => 'no-sort']
                        ]">

                            @forelse ($attendances as $key => $attendance)
                                <tr class="align-middle">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $attendance->month }}</td>
                                    <td>{{ $attendance->year }}</td>
                                    <td>{{ $attendance->created_at }}</td>
                                    <td>{{ $attendance->division_name }}</td>
                                    <td>{{ get_logged_staff_name($attendance->updatedBy->staff_id) }}</td>
                                    <td>
                                        @can(\App\Enums\PermissionsEnum::STAFFATTENDANCE->value)
                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="View Attendance - {{ $attendance->month }} {{ $attendance->year }}" data-bs-url="form_view/viewAttendance/{{ $attendance->attendance_id }}" data-bs-size="modal-xl"> View Attendance</button>
                                        @endcan
                                        @can(\App\Enums\PermissionsEnum::DELETEATTENDANCE->value)
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Confirm Attendance Deletion" data-bs-url="form_delete/deleteAttendance/{{ $attendance->attendance_id }}" data-bs-size="" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-trash"></i></button>
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

