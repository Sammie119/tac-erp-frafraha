<form method="POST" action="project_store">
    @csrf
    @isset($project)
        @method('put')
        <input type="hidden" name="id" value="{{ $project->project_id }}">
    @endisset

    <div class="row mb-3">
        <label for="name" class="col-sm-2 col-form-label">{{ __('Project Name') }}</label>
        <div class="col-sm-10">
            <input type="text" id="name" name="name" value="@isset($project) {{ $project->name }} @endisset" class="form-control" required>
        </div>
    </div>
    <div class="row mb-3">
        <label for="description" class="col-sm-2 col-form-label">{{ __('Description') }}</label>
        <div class="col-sm-10">
            @isset($project)
                <textarea name="description" id="description" rows="3" class="form-control" required>{{ $project->description }}</textarea>
            @else
                <textarea name="description" id="description" rows="3" class="form-control" required></textarea>
            @endisset

        </div>
    </div>
    <div class="row mb-3">
        <label for="due_date" class="col-sm-2 col-form-label">{{ __('Due Date') }}</label>
        <div class="col-sm-10">
            <input type="date" @empty($project) min="{{ date('Y-m-d') }}" @endempty id="due_date" name="due_date" value="{{ isset($project) ? $project->due_date : date('Y-m-d') }}" class="form-control" required>
        </div>
    </div>

    @isset($project)
        <div class="row mb-3">
            <label for="status" class="col-sm-2 col-form-label">{{ __('Status') }}</label>
            <div class="col-sm-10">
                <select id="status" name="status" class="form-control">
                    <option value="0" @if($project->status == 0) selected @endif>Pending</option>
                    <option value="1" @if($project->status == 1) selected @endif>In Progress</option>
                    <option value="2" @if($project->status == 2) selected @endif>Completed</option>
                </select>
            </div>
        </div>
    @endisset

    {{-- Buttons --}}
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

