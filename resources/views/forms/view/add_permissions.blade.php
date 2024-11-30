<form method="POST" action="permissions_store">
    @csrf
    @method('put')

    <input type="hidden" value="{{ $role }}" name="id" />

        <div class="row" style="margin-left: 5%">
            <ul class="nav nav-tabs mb-3">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page"><b>Create</b></a>
                </li>
            </ul>
            @foreach($permissions as $permission)
                @if(strpos($permission, 'Create'))
                    <div class="col-md-4 mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" {{ in_array($permission->id, $get_permissions) ? 'checked' : '' }} type="checkbox" name="permissions[]" value="{{ $permission->name }}" role="switch" id="flexSwitchCheckChecked" >
                            <label class="form-check-label" for="flexSwitchCheckChecked" style="margin-left: 5px">{{ $permission->name }}</label>
                        </div>
                    </div>
                @endif
            @endforeach

            <ul class="nav nav-tabs mb-3">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page"><b>Update</b></a>
                </li>
            </ul>
            @foreach($permissions as $permission)
                @if(strpos($permission, 'Update'))
                    <div class="col-md-4 mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" {{ in_array($permission->id, $get_permissions) ? 'checked' : '' }} type="checkbox" name="permissions[]" value="{{ $permission->name }}" role="switch" id="flexSwitchCheckChecked" >
                            <label class="form-check-label" for="flexSwitchCheckChecked" style="margin-left: 5px">{{ $permission->name }}</label>
                        </div>
                    </div>
                @endif
            @endforeach

            <ul class="nav nav-tabs mb-3">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page"><b>View</b></a>
                </li>
            </ul>
            @foreach($permissions as $permission)
                @if(strpos($permission, 'View'))
                    <div class="col-md-4 mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" {{ in_array($permission->id, $get_permissions) ? 'checked' : '' }} type="checkbox" name="permissions[]" value="{{ $permission->name }}" role="switch" id="flexSwitchCheckChecked" >
                            <label class="form-check-label" for="flexSwitchCheckChecked" style="margin-left: 5px">{{ $permission->name }}</label>
                        </div>
                    </div>
                @endif
            @endforeach

            <ul class="nav nav-tabs mb-3">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page"><b>Delete</b></a>
                </li>
            </ul>
            @foreach($permissions as $permission)
                @if(strpos($permission, 'Delete'))
                    <div class="col-md-4 mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" {{ in_array($permission->id, $get_permissions) ? 'checked' : '' }} type="checkbox" name="permissions[]" value="{{ $permission->name }}" role="switch" id="flexSwitchCheckChecked" >
                            <label class="form-check-label" for="flexSwitchCheckChecked" style="margin-left: 5px">{{ $permission->name }}</label>
                        </div>
                    </div>
                @endif
            @endforeach

            <ul class="nav nav-tabs mb-3">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page"><b>Others</b></a>
                </li>
            </ul>
            @foreach($permissions as $permission)
                @if(!strpos($permission, 'Create') && !strpos($permission, 'Update') && !strpos($permission, 'View') && !strpos($permission, 'Delete'))
                    <div class="col-md-4 mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" {{ in_array($permission->id, $get_permissions) ? 'checked' : '' }} type="checkbox" name="permissions[]" value="{{ $permission->name }}" role="switch" id="flexSwitchCheckChecked" >
                            <label class="form-check-label" for="flexSwitchCheckChecked" style="margin-left: 5px">{{ $permission->name }}</label>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

    {{-- Buttons --}}
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>


