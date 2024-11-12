<form method="POST" action="task_store">
    @csrf
    @isset($task)
        @method('put')
        <input type="hidden" name="id" value="{{ $task->task_id }}">
    @endisset

    <div class="row mb-3">
        <label for="name" class="col-sm-2 col-form-label">{{ __('Project Name') }}</label>
        <div class="col-sm-10">
            <x-input-datalist :options="$projects" name="project" :value="isset($task) ? $task->project->name : ''" :placeholder="'Enter Project'" :list="'datalistProjects'"/>
        </div>
    </div>
    <div class="row mb-3">
        <label for="name" class="col-sm-2 col-form-label">{{ __('Task Name') }}</label>
        <div class="col-sm-10">
            <input type="text" id="name" name="name" value="@isset($task) {{ $task->name }} @endisset" class="form-control" required>
        </div>
    </div>
    <div class="row mb-3">
        <label for="description" class="col-sm-2 col-form-label">{{ __('Description') }}</label>
        <div class="col-sm-10">
            @isset($task)
                <textarea name="description" id="description" rows="3" class="form-control" required>{{ $task->description }}</textarea>
            @else
                <textarea name="description" id="description" rows="3" class="form-control" required></textarea>
            @endisset

        </div>
    </div>
    <div class="row mb-3">
        <label for="priority" class="col-sm-2 col-form-label">{{ __('Task Priority') }}</label>
        <div class="col-sm-10">
            <x-input-select
                :options="['Low', 'Medium', 'High']"
                :selected="isset($task) ? $task->priority : 0"
                :values="[0, 1, 2]"
                :type="1"
                name="priority"
                required
            />
        </div>
    </div>
    <div class="row mb-3">
        <label for="due_date" class="col-sm-2 col-form-label">{{ __('Due Date') }}</label>
        <div class="col-sm-10">
            <input type="date" min="{{ date('Y-m-d') }}" id="due_date" name="due_date" value="{{ isset($task) ? $task->due_date : date('Y-m-d') }}" class="form-control" required>
        </div>
    </div>
    <div class="row mb-3">
        <label for="name" class="col-sm-2 col-form-label">{{ __('Assigned Staff') }}</label>
        <div class="col-sm-10">
            <x-input-datalist :options="$staffs" name="assigned_staff" :value="isset($task) ? $task->assignedStaff->full_name : ''" :placeholder="'Enter Staff Name'" :list="'datalistStaff'" />
        </div>
    </div>

    {{-- Buttons --}}
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

