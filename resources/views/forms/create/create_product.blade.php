<form method="POST" action="product_store">
    @csrf
    @isset($product)
        @method('put')
        <input type="hidden" name="id" value="{{ $product->product_id }}">
    @endisset

    <div class="row mb-3">
        <label for="name" class="col-sm-2 col-form-label">{{ __('Product Type') }}</label>
        <div class="col-sm-10">
            <x-input-select :options="$type" :selected="isset($product) ? $product->type : 0" name="type" required />
        </div>
    </div>
    <div class="row mb-3">
        <label for="name" class="col-sm-2 col-form-label">{{ __('Product Name') }}</label>
        <div class="col-sm-10">
            <input type="text" id="name" name="name" value="@isset($product) {{ $product->name }} @endisset" class="form-control" required>
        </div>
    </div>
    <div class="row mb-3">
        <label for="description" class="col-sm-2 col-form-label">{{ __('Description') }}</label>
        <div class="col-sm-10">
            <input type="text" name="description" id="description" class="form-control" value="@isset($product) {{ $product->description }} @endisset" required autocomplete="description">
        </div>
    </div>

    {{-- Buttons --}}
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

