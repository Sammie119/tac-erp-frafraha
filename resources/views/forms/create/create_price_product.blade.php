<form method="POST" action="price_product_store">
    @csrf
    @isset($price)
        @method('put')
        <input type="hidden" name="id" value="{{ $price->price_id }}">
    @endisset

    <div class="col-md-12">
        @empty($price)
            <div class="row ">
                <div class="form-group col-md-9">
                    <label for="recipient-name" class="control-label">Enter Product</label>
                    <x-input-datalist :options="$items" :placeholder="'Enter Product'" class="product" :list="'datalistOptions'" autofocus/>
                </div>
                <div class="form-group col-md-3">
                    <label for="recipient-name" class="control-label">Action</label>
                    <a class="form-control btn btn-success addProduct">Add</a>
                </div>
            </div>
        @endempty
    </div>

    <hr>

    <div class="col-md-12">
        <div class="row ">
            <div class="col-md-7">
                <label for="recipient-name" class="control-label">Product Name</label>
            </div>
            <div class="col-md-2">
                <label for="recipient-name" class="control-label">New Cost</label>
            </div>
            <div class="col-md-2">
                <label for="recipient-name" class="control-label">New Price</label>
            </div>
            <div class="col-md-1">
                <label for="recipient-name" class="control-label">Action</label>
            </div>
        </div>
    </div>
    <div class="col-md-12 form_field_outer p-0">
        @isset($price)
            <div class="col-md-12 mt-2">
                <div class="row mb-2">
                    <div class="form-group col-7">
                        <select class="form-control bg-white" name="product_id" ><option value="{{$price->product_id}}" selected>{{ $price->product_name->name }}</option></select>
                    </div>
                    <div class="form-group col-2">
                        <input type="number" min="0" step="0.01" class="form-control bg-white" name="new_cost" value="{{ $price->new_cost }}" required>
                    </div>
                    <div class="form-group col-2">
                        <input type="number" min="0" step="0.01" class="form-control bg-white" name="new_price" value="{{ $price->new_price }}" required>
                    </div>
                    <div class="form-group col-1">
                        <button type="button" class="btn btn-danger btn-sm" style="padding-top: 8px; padding-bottom: 8px;"><i class="bi bi-trash"></i></button>
                    </div>
                </div>
            </div>
        @else
            <div class="col-md-12 mt-2" id="contentProduct">
                <div class="show_data">No Data Found</div>
            </div>
        @endisset
    </div>

    {{-- Buttons --}}
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

