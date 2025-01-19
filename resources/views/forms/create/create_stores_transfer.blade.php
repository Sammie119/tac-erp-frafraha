<form method="POST" action="stores_transfer_store">
    @csrf
    @isset($transfers)
        @method('put')
        <input type="hidden" name="id" value="{{ $transfers->req_id }}">
    @endisset
    <div class="col-md-12">
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
    </div>

    <hr>

    <div class="col-md-12">
        <div class="row ">
            <div class="col-md-4">
                <label for="recipient-name" class="control-label">Product Name</label>
            </div>
            <div class="col-md-1">
                <label for="recipient-name" class="control-label">In Stock</label>
            </div>
            <div class="col-md-2">
                <label for="recipient-name" class="control-label">Transfer Quantity</label>
            </div>
            <div class="col-md-2">
                <label for="recipient-name" class="control-label">Approved Quantity</label>
            </div>
            <div class="col-md-2">
                <label for="recipient-name" class="control-label">Remarks</label>
            </div>
            <div class="col-md-1">
                <label for="recipient-name" class="control-label">Action</label>
            </div>
        </div>
    </div>
    <div class="col-md-12 form_field_outer p-0">
        <div class="col-md-12 mt-2" id="contentProduct">
            @isset($requisition)
                @foreach($requisition_details as $requisition_detail)
                    <div class="col-md-12 mt-2">
                        <div class="row mb-2">
                            <div class="form-group col-4">
                                <select class="form-control bg-white" name="product_id[]" ><option value="{{$requisition_detail->product_id}}" selected>{{ $requisition_detail->product_name->name }}</option></select>
                            </div>
                            <div class="form-group col-2">
                                <select class="form-control bg-white" name="stock[]"><option selected>{{ $requisition_detail->product_name->stock_in }}</option></select>
                            </div>
                            <div class="form-group col-2">
                                <input type="number" min="0" step="1" placeholder="0" class="form-control bg-white" name="quantity[]" value="{{ $requisition_detail->req_quantity }}" required>
                            </div>
                            <div class="form-group col-1">
                                <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)" style="padding-top: 8px; padding-bottom: 8px;"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="show_data"></div>
            @else
                <div class="show_data">No Data Found</div>
            @endisset
        </div>
        <hr>
        <div class="row mb-2">
            <div class="form-group col-2 mb-2">
                <label for="transfer_date" class="form-label">{{ __('Date') }}</label>
                <input type="date" value="{{ date('Y-m-d') }}" class="form-control bg-white" name="transfer_date" required>
            </div>
            <div class="form-group col-5 mb-2">
                <label for="from_store_id" class="form-label">{{ __('Transfer Source') }}</label>
                <x-input-select :options="$shops" :selected="isset($transfers) ? $transfers->from_store_id : 0" name="from_store_id" />
            </div>
            <div class="form-group col-5 mb-2">
                <label for="to_store_id" class="form-label">{{ __('Transfer Destination') }}</label>
                <x-input-select :options="$shops" :selected="isset($transfers) ? $transfers->from_store_id : 0" name="to_store_id" />
            </div>
        </div>
    </div>

    {{-- Buttons --}}
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

