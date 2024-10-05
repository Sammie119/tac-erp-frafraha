<form method="POST" action="supplier_store">
    @csrf
    @isset($supplier)
        @method('put')
        <input type="hidden" name="id" value="{{ $supplier->supplier_id }}">
    @endisset

    <div class="row">
        <div class="col-12 mb-3">
            <label for="supplier_name" class="form-label">{{ __('Supplier Name') }}</label>
            <input type="text" name="supplier_name" class="form-control" value="{{ isset($supplier) ? $supplier->supplier_name : "" }}" id="supplier_name" placeholder="{{ __('Supplier Name') }}" required>
        </div>
        <div class="col-12 mb-3">
            <label for="supplier_address" class="form-label">{{ __('Supplier Address') }}</label>
            @isset($supplier)
                <textarea name="supplier_address" id="supplier_address" rows="2" class="form-control" required>{{ $supplier->supplier_address }}</textarea>
            @else
                <textarea name="supplier_address" id="supplier_address" rows="2" class="form-control" required></textarea>
            @endisset
        </div>

        <div class="col-6 mb-3">
            <label for="supplier_phone" class="form-label">{{ __('Supplier Phone') }}</label>
            <input type="number" name="supplier_phone" class="form-control" value="{{ isset($supplier) ? $supplier->supplier_phone : "" }}" id="supplier_phone" placeholder="{{ __('Supplier Phone') }}">
        </div>
        <div class="col-6 mb-3">
            <label for="supplier_email" class="form-label">{{ __('Supplier Email') }}</label>
            <input type="email" name="supplier_email" class="form-control" value="{{ isset($supplier) ? $supplier->supplier_email: "" }}" id="supplier_email" placeholder="{{ __('Supplier Email') }}" >
        </div>


        <div class="col-12 mb-3">
            <label for="contact_name" class="form-label">{{ __('Contact Person\'s Name') }}</label>
            <input type="text" name="contact_name" class="form-control" value="@isset($supplier) {{ $supplier->contact_name }} @endisset" id="contact_name" placeholder="{{ __('Contact Person\'s Name') }}" required>
        </div>

        <div class="col-6 mb-3">
            <label for="contact_phone" class="form-label">{{ __('Contact Person Phone') }}</label>
            <input type="number" name="contact_phone" class="form-control" value="{{ isset($supplier) ? $supplier->contact_phone : "" }}" id="contact_phone" placeholder="{{ __('Contact Person Phone') }}">
        </div>
        <div class="col-6 mb-3">
            <label for="contact_email" class="form-label">{{ __('Contact Person Email') }}</label>
            <input type="email" name="contact_email" class="form-control" value="{{ isset($supplier) ? $supplier->contact_email: "" }}" id="contact_email" placeholder="{{ __('Contact Person Email') }}" >
        </div>

        <div class="col-12 mb-3">
            <label for="supplier_tin_number" class="form-label">{{ __('Contact Person\'s Name') }}</label>
            <input type="text" name="supplier_tin_number" class="form-control" value="@isset($supplier) {{ $supplier->supplier_tin_number }} @endisset" id="supplier_tin_number" placeholder="{{ __('Supplier TIN Number') }}" required>
        </div>
    </div>

    {{-- Buttons --}}
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

