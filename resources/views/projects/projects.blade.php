@extends('layouts.master')

@section('title', 'TAC PRESS | Projects')

@section('content')

    <x-breadcrumb>Project Management</x-breadcrumb>

    <div class="app-content">
        <div class="container-fluid">

            <x-error-notification :errors="$errors->all()"/>

            <div class="col-md-12">
                <div class="card mb-4">

                    <x-datatable.card-header :icon="'products'" :title="'Projects List'">
                        @can(\App\Enums\PermissionsEnum::CREATEPROJECT->value)
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Add New Project" data-bs-url="form_create/createProject" data-bs-size="modal-lg"> <i class="bi bi-plus-lg"></i> Add Project</button>
                        @endcan
                    </x-datatable.card-header>

                    @php
                        $checkData = 1;
                        if(empty($projects->toArray()))
                            $checkData = 0;
                    @endphp

                    <div class="card-body p-0 mb-3">
                        <x-datatable.datatable :checkData="$checkData" :headers="[
                            ['name' => '#', 'width' => '5%'],
                            'Name',
                            'Description',
                            ['name' => 'Due Date', 'nowrap' => 'nowrap'],
                            'Status',
                            'Progress',
                            'Created By',
                            ['name' => 'Action', 'width' => '17%', 'classes' => 'no-sort']
                        ]">

                            @forelse ($projects as $key => $project)
                                @php
                                    $percent = 0;
                                    if($project->task_count >= 1){
                                        $percent =  ($project->task_count_completed / $project->task_count) * 100;
                                    }
                                @endphp
                                <tr class="align-middle">
                                    <td>{{ ++$key }}</td>
                                    <td nowrap>{{ $project->name }}</td>
                                    <td>{{ $project->description }}</td>
                                    <td nowrap>{{ $project->due_date }}</td>
                                    <td nowrap>{!! getStatus($project->status) !!}</td>

                                    <td>
                                        <div class="progress rounded" role="progressbar" aria-label="Danger striped example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="height: 22px">
                                            <div class="progress-bar progress-bar-striped bg-danger" style="width: {{ $percent }}%">{{ $percent }}%</div>
                                        </div>
                                    </td>
                                    <td nowrap>{{ get_logged_staff_name($project->createdBy->id) }}</td>
                                    <td>
                                        @can(\App\Enums\PermissionsEnum::VIEWPROJECT->value)
                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="View Projects Detail - {{ $project->name }}" data-bs-url="form_view/viewProject/{{ $project->project_id }}" data-bs-size="modal-xl"> View Project</button>
                                        @endcan
                                        @can(\App\Enums\PermissionsEnum::UPDATEPROJECT->value)
                                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Edit Project Details" data-bs-url="form_edit/editProject/{{ $project->project_id }}" data-bs-size="modal-lg" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-pencil-square"></i></button>
                                        @endcan
                                        @can(\App\Enums\PermissionsEnum::DELETEPROJECT->value)
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Confirm Project Deletion" data-bs-url="form_delete/deleteProject/{{ $project->project_id }}" data-bs-size="" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-trash"></i></button>
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

