<form method="POST" action="user_roles">
    @csrf

    <input type="hidden" value="{{ $user }}" name="id" />

    <div class="row" style="margin-left: 5%">
        @foreach($roles as $role)
            <div class="col-md-4 mb-3">
                <div class="form-check form-switch">
                    <input class="form-check-input" {{ in_array($role, $permissions) ? 'checked' : '' }} type="checkbox" name="roles[]" value="{{ $role }}" role="switch" id="flexSwitchCheckChecked" >
                    <label class="form-check-label" for="flexSwitchCheckChecked" style="margin-left: 5px">{{ $role }}</label>
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


