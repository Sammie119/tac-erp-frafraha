<form method="POST" action="permission_store">
    @csrf
    @isset($permission)
        @method('put')
        <input type="hidden" name="id" value="{{ $permission->id }}">
    @endisset

    <div class="row mb-3">
        <label for="name" class="col-sm-3 col-form-label">{{ __('Permission Name') }}</label>
        <div class="col-sm-9">
            <input type="text" name="name" id="name" class="form-control" value="@isset($permission) {{ $permission->name }} @endisset" required autocomplete="name">
            <span class="text-sm-center">All more than one Permissions, separate with comma (,) and then save</span>
        </div>
    </div>

    {{-- Buttons --}}
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

