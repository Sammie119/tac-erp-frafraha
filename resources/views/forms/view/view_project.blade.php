{{-- {{ $project }}--}}
<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">Details of {{ $project->name }}</h3>
    </div> <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table">
            <thead>
            <tr>
                <th style="width: 20px">#</th>
                <th style="width: 130px">Item</th>
                <th>Information</th>
            </tr>
            </thead>
            <tbody>
                <tr class="align-middle">
                    <td>1.</td>
                    <td>{{__('Project Name')}}</td>
                    <td>{{ $project->name }}</td>
                </tr>
                <tr class="align-middle">
                    <td>2.</td>
                    <td>{{__('Description')}}</td>
                    <td>{{ $project->description }}</td>
                </tr>
                <tr class="align-middle">
                    <td>3.</td>
                    <td>{{__('Due Date')}}</td>
                    <td>{{ $project->due_date }}</td>
                </tr>
                <tr class="align-middle">
                    <td>4.</td>
                    <td>{{__('Status')}}</td>
                    <td>{!! getStatus($project->status) !!}</td>
                </tr>
                <tr class="align-middle">
                    <td>5.</td>
                    <td>{{__('Created By')}}</td>
                    <td>{{ get_logged_staff_name($id = $project->createdBy->id) }}</td>
                </tr>

            </tbody>
        </table>
    </div> <!-- /.card-body -->
</div> <!-- /.card -->

<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">Tasks under {{ $project->name }} Project</h3>
    </div> <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table">
            <thead>
            <tr>
                <th style="width: 20px">#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Due Date</th>
                <th>Assigned Staff</th>
            </tr>
            </thead>
            <tbody>
                @foreach($tasks as $key => $task)
                    <tr class="align-middle">
                        <td>{{ ++$key }}</td>
                        <td nowrap>{{ $task->name }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{!! getStatus($task->status) !!}</td>
                        <td>{!! getPriority($task->priority) !!}</td>
                        <td nowrap>{{ $task->due_date }}</td>
                        <td nowrap>{{ $task->assignedStaff->full_name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div> <!-- /.card-body -->
</div> <!-- /.card -->


    {{-- Buttons --}}
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>


