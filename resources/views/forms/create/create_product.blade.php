<form method="POST" action="product_store" enctype="multipart/form-data">
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
    @can(\App\Enums\PermissionsEnum::CREATESTORESPRODUCTS->value)
        @isset($product)
            <div class="row mb-3">
                <label for="category" class="col-sm-2 col-form-label">{{ __('Product Category') }}</label>
                <div class="col-sm-10">
                    <input type="text" name="category" id="category" class="form-control" value=" {{ getCategoryName($product->category) }}" readonly>
                </div>
            </div>
        @endisset
        <div class="row mb-3">
            <label for="sub_category" class="col-sm-2 col-form-label">{{ __('Product Sub Category') }}</label>
            <div class="col-sm-10">
                <x-input-select :options="$sub_categories" :selected="isset($product) ? $product->sub_category : 0" name="sub_category" required />
            </div>
        </div>
        <div class="row mb-3">
            <label for="reorder_level" class="col-sm-2 col-form-label">{{ __('Reorder Level') }}</label>
            <div class="col-sm-10">
                <input type="number" step="1" min="1" id="reorder_level" name="reorder_level" value="{{ isset($product) ? $product->reorder_level : "" }}" class="form-control" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="image" class="col-sm-2 col-form-label">{{ __('Product Image') }}</label>
            <div class="col-sm-10">
                <input type="file" id="image" name="image" class="form-control" required>
            </div>
        </div>
        <div class="input-group mb-1">
            @isset($product->image_url)
                <img src="/storage/{{ $product->image_url }}" alt="Image" width="150">
            @endisset
        </div>
    @endcan
    {{-- Buttons --}}
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

