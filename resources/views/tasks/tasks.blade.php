@extends('layouts.master')

@section('title', 'TAC PRESS | Tasks')

@section('content')

    <x-breadcrumb>Task Management</x-breadcrumb>

    <div class="app-content">
        <div class="container-fluid">

            <x-error-notification :errors="$errors->all()"/>

            <div class="col-md-12">
                <div class="card mb-4">

                    <x-datatable.card-header :icon="'products'" :title="'Tasks List'">
                        @can(\App\Enums\PermissionsEnum::CREATETASK->value)
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Add New Task" data-bs-url="form_create/createTask" data-bs-size="modal-lg"> <i class="bi bi-plus-lg"></i> Add Task</button>
                        @endcan
                    </x-datatable.card-header>

                    <div class="card-body p-0 mb-3">
                        <x-datatable.datatable :headers="[
                            ['name' => '#', 'width' => '5%'],
                            'Name',
                            'Project',
                            'Description',
                            ['name' => 'Due Date', 'nowrap' => 'nowrap'],
                            'Status',
                            'Priority',
                            'Assigned Staff',
                            ['name' => 'Action', 'width' => '17%', 'classes' => 'no-sort']
                        ]">

                            @forelse ($tasks as $key => $task)
                                <tr class="align-middle">
                                    <td>{{ ++$key }}</td>
                                    <td nowrap>{{ $task->name }}</td>
                                    <td nowrap>{{ $task->project->name }}</td>
                                    <td>{{ $task->description }}</td>
                                    <td nowrap>{{ $task->due_date }}</td>
                                    <td nowrap>{!! getStatus($task->status) !!}</td>
                                    <td nowrap>{!! getPriority($task->priority) !!}</td>
                                    <td nowrap>{{ $task->assignedStaff->full_name }}</td>
                                    <td>
                                        @can(\App\Enums\PermissionsEnum::VIEWTASK->value)
                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="View Tasks Detail - {{ $task->name }}" data-bs-url="form_view/viewTask/{{ $task->task_id }}" data-bs-size="modal-xl"> View Task</button>
                                        @endcan
                                        @can(\App\Enums\PermissionsEnum::UPDATETASK->value)
                                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Edit Task Details" data-bs-url="form_edit/editTask/{{ $task->task_id }}" data-bs-size="modal-lg" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-pencil-square"></i></button>
                                        @endcan
                                        @can(\App\Enums\PermissionsEnum::DELETETASK->value)
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Confirm Task Deletion" data-bs-url="form_delete/deleteTask/{{ $task->task_id }}" data-bs-size="" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-trash"></i></button>
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

{{-- {{ $url = 'search_users' }} --}}
<x-ajax-call-search :url="'search_tasks'" />

