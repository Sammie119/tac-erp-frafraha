<form method="POST" action="setup_store" enctype="multipart/form-data">
    @csrf
    @isset($setup)
        @method('put')
        <input type="hidden" name="id" value="{{ $setup->id }}">
    @endisset

    <div class="row mb-3">
        <label for="division" class="col-sm-2 col-form-label">{{ __('Division') }}</label>
        <div class="col-sm-10">
            <x-input-select :options="$division" :selected="isset($setup) ? $setup->division : 0" name="division" required />
        </div>
    </div>
    <div class="row mb-3">
        <label for="display_name" class="col-sm-2 col-form-label">{{ __('Division Name') }}</label>
        <div class="col-sm-10">
            <input type="text" id="display_name" name="display_name" value="@isset($setup) {{ $setup->display_name }} @endisset" class="form-control" required>
        </div>
    </div>
    <div class="row mb-3">
        <label for="address" class="col-sm-2 col-form-label">{{ __('Address') }}</label>
        <div class="col-sm-10">
            <input type="text" name="address" id="address" class="form-control" value="@isset($setup) {{ $setup->address }} @endisset" required>
        </div>
    </div>
    <div class="row mb-3">
        <label for="phone1" class="col-sm-2 col-form-label">{{ __('Phone One') }}</label>
        <div class="col-sm-10">
            <input type="number" name="phone1" id="phone1" class="form-control" value="{{ isset($setup) ? $setup->phone1 : "" }}" required>
        </div>
    </div>
    <div class="row mb-3">
        <label for="phone2" class="col-sm-2 col-form-label">{{ __('Phone Two') }}</label>
        <div class="col-sm-10">
            <input type="number" name="phone2" id="phone2" class="form-control" value="{{ isset($setup) ? $setup->phone2 : "" }}">
        </div>
    </div>
    <div class="row mb-3">
        <label for="email" class="col-sm-2 col-form-label">{{ __('Email') }}</label>
        <div class="col-sm-10">
            <input type="email" name="email" id="email" class="form-control" value="@isset($setup) {{ $setup->email }} @endisset">
        </div>
    </div>
    <div class="row mb-3">
        <label for="facebook" class="col-sm-2 col-form-label">{{ __('Facebook') }}</label>
        <div class="col-sm-10">
            <input type="text" name="facebook" id="facebook" class="form-control" value="@isset($setup) {{ $setup->facebook }} @endisset">
        </div>
    </div>

    <div class="row mb-3">
        <label for="facebook" class="col-sm-2 col-form-label">{{ __('NHIL (%)') }}</label>
        <div class="col-sm-10">
            <div class="input-group">
                <input type="number" min="1" step="0.01" name="nhil" id="nhil" class="form-control" value="{{ isset($setup) ? $setup->nhil : "" }}" required>
                <span class="input-group-text">{{ __('GEHL (%)') }}</span>
                <input type="number" min="1" step="0.01" name="gehl" id="gehl" class="form-control" value="{{ isset($setup) ? $setup->gehl : "" }}" required>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <label for="facebook" class="col-sm-2 col-form-label">{{ __('COVID 19 (%)') }}</label>
        <div class="col-sm-10">
            <div class="input-group">
                <input type="number" min="1" step="0.01" name="covid19" id="covid19" class="form-control" value="{{ isset($setup) ? $setup->covid19 : "" }}" required>
                <span class="input-group-text">{{ __('VAT (%)') }}</span>
                <input type="number" min="1" step="0.01" name="vat" id="vat" class="form-control" value="{{ isset($setup) ? $setup->vat : "" }}" required>
            </div>
        </div>
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text">{{ __('Logo') }}</span>
        <input type="file" name="text_logo" id="text_logo" class="form-control">
    </div>
    <div class="input-group mb-1">
        @isset($setup)
            <img src="/storage/{{ $setup->text_logo }}" alt="logo" width="150">
        @endisset
    </div>

    {{-- Buttons --}}
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

