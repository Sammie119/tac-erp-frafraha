<form method="POST" action="task_progress_store">
    @csrf

    <input type="hidden" value="{{ $project }}" name="id" />

    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th nowrap>Task</th>
                <th style="width: 100px; text-align: center">Pending</th>
                <th style="width: 100px; text-align: center">In Progress</th>
                <th style="width: 100px; text-align: center">Completed</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tasks as $key => $task)
                @php
                    $get_task = \App\Models\TaskProgress::where('task_id', $task->task_id)->first();
                @endphp
                <input type="hidden" name="task_id[]" value="{{ $task->task_id }}">
                <tr class="align-middle">
                    <td>{{ ++$key }}</td>
                    <td>{{ $task->name }}</td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="pending[]" value="1" role="switch" id="pending" checked>
                        </div>
                    </td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="in_progress[]" value="1" role="switch"
                                   id="in_progress"
                                    {{ (isset($get_task) && ($get_task->in_progress == 1)) ? 'checked' : ''}}
                            >
                        </div>
                    </td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="completed[]" value="1" role="switch"
                                   id="completed"
                                    {{ (isset($get_task) && ($get_task->completed == 1)) ? 'checked' : ''}}
                            >
                        </div>
                    </td>
                    <td>
                        <input type="text" class="form-control" value="{{ (isset($get_task)) ? $get_task->remarks : '' }}" name="remarks[]">
                    </td>
                </tr>
            @empty
                <tr class="align-middle">
                    <td colspan="10">No Task is Created for this Project</td>
                </tr>
            @endforelse
        </tbody>
    </table>
{{--    {{ in_array($permission->id, $get_permissions) ? 'checked' : '' }}--}}

    {{-- Buttons --}}
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>



