<form method="POST" action="staff_store">
    @csrf
    @isset($staff)
        @method('put')
        <input type="hidden" name="id" value="{{ $staff->staff_id }}">
    @endisset

    <div class="row">
        <div class="col-2 mb-3">
            <label for="staff_number" class="form-label">{{ __('Staff ID') }}</label>
            <input type="text" name="staff_number" class="form-control" value="@isset($staff) {{ $staff->staff_number }} @endisset" id="staff_number" placeholder="{{ __('Staff ID') }}" required>
        </div>
        <div class="col-2 mb-3">
            <label for="title" class="form-label">{{ __('Title') }}</label>
            <x-input-select :options="$title" :selected="isset($staff) ? $staff->title : 0" name="title" />
        </div>
        <div class="col-4 mb-3">
            <label for="firstname" class="form-label">{{ __('First Name') }}</label>
            <input type="text" name="firstname" class="form-control" value="@isset($staff) {{ $staff->firstname }} @endisset" id="firstname" placeholder="{{ __('First Name') }}" required>
        </div>
        <div class="col-4 mb-3">
            <label for="othernames" class="form-label">{{ __('Other Names') }}</label>
            <input type="text" name="othernames" class="form-control" value="@isset($staff) {{ $staff->othernames }} @endisset" id="othernames" placeholder="{{ __('Other Names') }}" required>
        </div>

        <div class="col-2 mb-3">
            <label for="position" class="form-label">{{ __('Gender') }}</label>
            <x-input-select :options="$gender" :selected="isset($staff) ? $staff->gender : 0" name="gender" required />
        </div>
        <div class="col-3 mb-3">
            <label for="date_of_birth" class="form-label">{{ __('Date of Birth') }}</label>
            <input type="date" name="date_of_birth" class="form-control" value="{{ isset($staff) ? $staff->date_of_birth : date('Y-m-d') }}" max="{{ date('Y-m-d') }}" id="date_of_birth" placeholder="{{ __('Date of Birth') }}" required>
        </div>
        <div class="col-3 mb-3">
            <label for="phone" class="form-label">{{ __('Mobile Number') }}</label>
            <input type="number" name="phone" class="form-control" value="{{ isset($staff) ? $staff->phone : "" }}" id="phone" placeholder="{{ __('Mobile Number') }}" required>
        </div>
        <div class="col-4 mb-3">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input type="email" name="email" class="form-control" value="@isset($staff) {{ $staff->email }} @endisset" id="email" placeholder="{{ __('Email') }}">
        </div>

        <div class="col-4 mb-3">
            <label for="position" class="form-label">{{ __('Marital Status') }}</label>
            <x-input-select :options="$married" :selected="isset($staff) ? $staff->married : 0" name="married" required />
        </div>
        <div class="col-4 mb-3">
            <label for="address" class="form-label">{{ __('Residential Address') }}</label>
            <input type="text" name="address" class="form-control" value="@isset($staff) {{ $staff->address }} @endisset" id="address" placeholder="{{ __('Residential Address') }}" required>
        </div>

        <div class="col-4 mb-3">
            <label for="position" class="form-label">{{ __('Position') }}</label>
            <x-input-select :options="$position" :selected="isset($staff) ? $staff->position : 0" name="position" required />
            {{-- <input type="text" name="position" class="form-control" value="@isset($staff) {{ $staff->position }} @endisset" id="position" placeholder="{{ __('Position') }}" required> --}}
        </div>
        <div class="col-4 mb-3">
            <label for="banker" class="form-label">{{ __('Banker') }}</label>
            <input type="text" name="banker" class="form-control" value="@isset($staff) {{ $staff->banker }} @endisset" id="banker" placeholder="{{ __('Banker') }}">
        </div>
        <div class="col-4 mb-3">
            <label for="bank_account" class="form-label">{{ __('Bank Account') }}</label>
            <input type="number" name="bank_account" class="form-control" value="{{ isset($staff) ? $staff->bank_account : "" }}" id="bank_account" placeholder="{{ __('Bank Account') }}" required>
        </div>

        <div class="col-4 mb-3">
            <label for="bank_branch" class="form-label">{{ __('Bank Branch') }}</label>
            <input type="text" name="bank_branch" class="form-control" value="@isset($staff) {{ $staff->bank_branch }} @endisset" id="bank_branch" placeholder="{{ __('Bank Branch') }}" required>
        </div>
        <div class="col-4 mb-3">
            <label for="bank_sort_code" class="form-label">{{ __('Bank Sort Code') }}</label>
            <input type="number" name="bank_sort_code" class="form-control" value="{{ isset($staff) ? $staff->bank_sort_code : "" }}" id="bank_sort_code" placeholder="{{ __('Bank Sort Code') }}">
        </div>
        <div class="col-4 mb-3">
            <label for="ghana_card" class="form-label">{{ __('Ghana Card Number') }}</label>
            <input type="text" name="ghana_card" class="form-control" value="@isset($staff) {{ $staff->ghana_card }} @endisset" id="ghana_card" placeholder="{{ __('Ghana Card Number') }}">
        </div>

        <div class="col-4 mb-3">
            <label for="ssnit_number" class="form-label">{{ __('SSNIT Number') }}</label>
            <input type="text" name="ssnit_number" class="form-control" value="@isset($staff) {{ $staff->ssnit_number }} @endisset" id="ssnit_number" placeholder="{{ __('SSNIT Number') }}">
        </div>
        <div class="col-4 mb-3">
            <label for="employment_date" class="form-label">{{ __('Employment Date') }}</label>
            <input type="date" max="{{ date('Y-m-d') }}" name="employment_date" class="form-control" value="{{ isset($staff) ? $staff->employment_date : "" }}" id="employment_date" placeholder="{{ __('Employment Date') }}">
        </div>
        <div class="col-4 mb-3">
            <label for="salary_grade" class="form-label">{{ __('Salary Grade') }}</label>
            <input type="text" name="salary_grade" class="form-control" value="@isset($staff) {{ $staff->salary_grade }} @endisset" id="salary_grade" placeholder="{{ __('Salary Grade') }}">
        </div>

        <div class="col-4 mb-3">
            <label for="entry_qualification" class="form-label">{{ __('Entry Qualification') }}</label>
            <input type="text" name="entry_qualification" class="form-control" value="@isset($staff) {{ $staff->entry_qualification }} @endisset" id="entry_qualification" placeholder="{{ __('Entry Qualification') }}">
        </div>
        <div class="col-4 mb-3">
            <label for="current_qualification" class="form-label">{{ __('Current Qualification') }}</label>
            <input type="text" name="current_qualification" class="form-control" value="@isset($staff) {{ $staff->current_qualification }} @endisset" id="current_qualification" placeholder="{{ __('Current Qualification') }}">
        </div>
        <div class="col-4 mb-3">
            <label for="emergency_person" class="form-label">{{ __('Emergency Person') }}</label>
            <input type="text" name="emergency_person" class="form-control" value="@isset($staff) {{ $staff->emergency_person }} @endisset" id="emergency_person" placeholder="{{ __('Emergency Person') }}">
        </div>

        <div class="col-4 mb-3">
            <label for="emergency_contact" class="form-label">{{ __('Emergency Contact') }}</label>
            <input type="text" name="emergency_contact" class="form-control" value="@isset($staff) {{ $staff->emergency_contact }} @endisset" id="emergency_contact" placeholder="{{ __('Emergency Contact') }}">
        </div>
    </div>

    {{-- Buttons --}}
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

