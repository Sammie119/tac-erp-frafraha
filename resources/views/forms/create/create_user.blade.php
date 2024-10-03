<form method="POST" action="register">
    @csrf
    @isset($user)
        @method('put')
        <input type="hidden" name="id" value="{{ $user->id }}">
    @endisset

    <div class="row mb-3">
        <label for="name" class="col-sm-2 col-form-label">{{ __('Staff Name') }}</label>
        <div class="col-sm-10">
            <x-input-select :options="$staff" :selected="isset($user) ? $user->staff_id : 0" name="staff_id" required />
        </div>
    </div>
    <div class="row mb-3">
        <label for="name" class="col-sm-2 col-form-label">{{ __('Division') }}</label>
        <div class="col-sm-10">
            @if(get_logged_in_user_id() === 1)
                <x-input-select :options="$division" :selected="isset($user) ? $user->division : 0" name="division" required />
            @else
                <x-input-select :options="$division" :selected="get_logged_user_division_id()" name="division" disabled required />
            @endif
        </div>
    </div>
    <div class="row mb-3">
        <label for="email" class="col-sm-2 col-form-label">{{ __('Email') }}</label>
        <div class="col-sm-10">
            <input type="email" id="email" name="email" value="@isset($user) {{ $user->email }} @endisset" class="form-control" required>
        </div>
    </div>
    <div class="row mb-3">
        <label for="password" class="col-sm-2 col-form-label">{{ __('Password') }}</label>
        <div class="col-sm-10">
            <input type="password" name="password" class="form-control" id="password" @empty($user) required @endempty>
        </div>
    </div>
    <div class="row mb-3">
        <label for="password_confirmation" class="col-sm-2 col-form-label">{{ __('Confirm Password') }}</label>
        <div class="col-sm-10">
            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" @empty($user) required @endempty>
        </div>
    </div>

    {{-- Buttons --}}
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

