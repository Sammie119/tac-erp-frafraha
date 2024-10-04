@extends('layouts.master')

@section('title', 'TAC PRESS | Tasks')

@section('content')

    <x-breadcrumb>My Tasks</x-breadcrumb>

    <div class="app-content">
        <div class="container-fluid">

            <x-error-notification :errors="$errors->all()"/>

            <div class="col-md-12">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="to_dos-tab" data-bs-toggle="tab" data-bs-target="#to_dos-tab-pane" type="button" role="tab" aria-controls="to_dos-tab-pane" aria-selected="true"> <i class="bi bi-bell"></i> My Todos</button>
                    </li>
{{--                    <li class="nav-item" role="presentation">--}}
{{--                        <button class="nav-link" id="all_tasks-tab" data-bs-toggle="tab" data-bs-target="#all_tasks-tab-pane" type="button" role="tab" aria-controls="all_tasks-tab-pane" aria-selected="false"> <i class="bi bi-list"></i> All Tasks</button>--}}
{{--                    </li>--}}
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed-tab-pane" type="button" role="tab" aria-controls="completed-tab-pane" aria-selected="false"> <i class="bi bi-list-check"></i> Completed</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="to_dos-tab-pane" role="tabpanel" aria-labelledby="to_dos-tab" tabindex="0">
                        @include('.tasks/todos')
                    </div>

{{--                    <div class="tab-pane fade" id="all_tasks-tab-pane" role="tabpanel" aria-labelledby="all_tasks-tab" tabindex="0">Profile</div>--}}
                    <div class="tab-pane fade" id="completed-tab-pane" role="tabpanel" aria-labelledby="completed-tab" tabindex="0">
                        @include('.tasks/completed_tasks')
                    </div>
                </div>
            </div>
        </div> <!-- /.container-fluid -->
    </div> <!--end::App Content-->

{{--    {{ dd($project->tasks->name) }}--}}

    <x-call-modal />

@endsection

