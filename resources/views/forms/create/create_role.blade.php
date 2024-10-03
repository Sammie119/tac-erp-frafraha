<form method="POST" action="role_store">
    @csrf
    @isset($role)
        @method('put')
        <input type="hidden" name="id" value="{{ $role->id }}">
    @endisset

    <div class="row mb-3">
        <label for="name" class="col-sm-2 col-form-label">{{ __('Role Name') }}</label>
        <div class="col-sm-10">
            <input type="text" name="name" id="name" class="form-control" value="@isset($role) {{ $role->name }} @endisset" required autocomplete="name">
        </div>
    </div>

    {{-- Buttons --}}
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

