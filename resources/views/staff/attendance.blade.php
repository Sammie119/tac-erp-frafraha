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
                        @can(\App\Enums\PermissionsEnum::CREATESTAFF->value)
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Upload Attendance" data-bs-url="form_create/createAttendance" data-bs-size=""> <i class="bi bi-upload"></i> Upload Attendance</button>
                        @endcan
                    </x-datatable.card-header>

                    <div class="card-body p-0 mb-3">
                        <x-datatable.datatable :headers="[
                            ['name' => '#', 'width' => '5%'],
                            'Staff ID',
                            'Staff Name',
                            'Date',
                            'Arrival',
                            'Departure',
                            ['name' => 'Action', 'width' => '6%', 'classes' => 'no-sort']
                        ]">

                            @forelse ($attendances as $key => $attendance)
                                <tr class="align-middle">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $attendance->staff_number }}</td>
                                    <td>{{ $attendance->staff }}</td>
                                    <td>{{ $attendance->attendance_date }}</td>
                                    <td>{{ getDateFormat($attendance->checkin_time) }}</td>
                                    <td>{{ getDateFormat($attendance->departure_time) }}</td>
                                    <td>
                                        @can(\App\Enums\PermissionsEnum::DELETESTAFF->value)
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Confirm Staff Deletion" data-bs-url="form_delete/deleteStaff/{{ $attendance->attendancef_id }}" data-bs-size="" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-trash"></i></button>
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

