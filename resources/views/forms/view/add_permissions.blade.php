<form method="POST" action="permissions_store">
    @csrf
    @method('put')

    <input type="hidden" value="{{ $role }}" name="id" />

        <div class="row" style="margin-left: 5%">
            @foreach($permissions as $permission)
                <div class="col-md-4 mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" {{ in_array($permission->id, $get_permissions) ? 'checked' : '' }} type="checkbox" name="permissions[]" value="{{ $permission->name }}" role="switch" id="flexSwitchCheckChecked" >
                        <label class="form-check-label" for="flexSwitchCheckChecked" style="margin-left: 5px">{{ $permission->name }}</label>
                    </div>
                </div>
            @endforeach
        </div>

    {{-- Buttons --}}
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>


