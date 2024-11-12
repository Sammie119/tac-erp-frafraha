<form method="POST" action="customer_store">
    @csrf
    @isset($customer)
        @method('put')
        <input type="hidden" name="id" value="{{ $customer->id }}">
    @endisset

    <div class="mb-3 row">
        <label for="" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control cusInput" name="name" value="@isset($customer) {{ $customer->name }} @endisset" required>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="" class="col-sm-2 col-form-label">Address</label>
        <div class="col-sm-10">
            <input type="text" class="form-control cusInput" name="address" value="@isset($customer) {{ $customer->address }} @endisset" required>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" name="email" value="@isset($customer) {{ $customer->email }} @endisset">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="" class="col-sm-2 col-form-label">Phone</label>
        <div class="col-sm-10">
            <input type="number" min="1" step="1" class="form-control cusInput" name="phone" value="{{ isset($customer) ? $customer->phone : "" }}" required>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="" class="col-sm-2 col-form-label">City/Town</label>
        <div class="col-sm-10">
            <input type="text" class="form-control cusInput" name="location" value="@isset($customer) {{ $customer->location }} @endisset" required>
        </div>
    </div>

    {{-- Buttons --}}
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

