{{-- {{ $project }}--}}
<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">Details of {{ $task->project->name }}</h3>
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
                    <td>{{ $task->project->name }}</td>
                </tr>
                <tr class="align-middle">
                    <td>1.</td>
                    <td>{{__('Task Name')}}</td>
                    <td>{{ $task->name }}</td>
                </tr>
                <tr class="align-middle">
                    <td>2.</td>
                    <td>{{__('Description')}}</td>
                    <td>{{ $task->description }}</td>
                </tr>
                <tr class="align-middle">
                    <td>3.</td>
                    <td>{{__('Due Date')}}</td>
                    <td>{{ $task->due_date }}</td>
                </tr>
                <tr class="align-middle">
                    <td>4.</td>
                    <td>{{__('Status')}}</td>
                    <td>{!! getStatus($task->status) !!}</td>
                </tr>
                <tr class="align-middle">
                    <td>4.</td>
                    <td>{{__('Priority')}}</td>
                    <td>{!! getPriority($task->priority) !!}</td>
                </tr>
                <tr class="align-middle">
                    <td>5.</td>
                    <td>{{__('Assigned Staff')}}</td>
                    <td>{{ $task->assignedStaff->full_name }}</td>
                </tr>

            </tbody>
        </table>
    </div> <!-- /.card-body -->
</div> <!-- /.card -->


    {{-- Buttons --}}
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>


