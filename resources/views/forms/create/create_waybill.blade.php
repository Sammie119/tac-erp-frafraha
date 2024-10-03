<form method="POST" action="waybill_store">
    @csrf
    @isset($waybill)
        @method('put')
        <input type="hidden" name="id" value="{{ $waybill->bill_id }}">
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
            <div class="col-md-5">
                <label for="recipient-name" class="control-label">Product Name</label>
            </div>
            <div class="col-md-2">
                <label for="recipient-name" class="control-label">Quantity</label>
            </div>
            <div class="col-md-4">
                <label for="recipient-name" class="control-label">Remarks</label>
            </div>
            <div class="col-md-1">
                <label for="recipient-name" class="control-label">Action</label>
            </div>
        </div>
    </div>
    <div class="col-md-12 form_field_outer p-0">
        <div class="col-md-12 mt-2" id="contentProduct">
            @isset($waybill)
                @foreach($waybill_details as $waybill_detail)
                    <div class="col-md-12 mt-2">
                        <div class="row mb-2">
                            <div class="form-group col-5">
                                <select class="form-control bg-white" name="product_id[]" ><option value="{{$waybill_detail->product_id}}" selected>{{ $waybill_detail->product_name->name }}</option></select>
                            </div>
                            <div class="form-group col-2">
                                <input type="number" min="0" step="1" placeholder="0" class="form-control bg-white" name="quantity[]" value="{{ $waybill_detail->quantity }}" required>
                            </div>
                            <div class="form-group col-4">
                                <input type="text" placeholder="Remarks" class="form-control bg-white" name="remarks[]" value="{{ $waybill_detail->remarks }}" required>
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
    </div>

    <hr>

    <div class="row">
        <div class="col-6">
            <div class="mb-3 row">
                <label for="recipient-name" class="col-sm-3 col-form-label">Customer:</label>
                <div class="col-sm-9">
                    <x-input-datalist :options="$customers" :placeholder="'Select Project'" :value="isset($waybill) ? $waybill->customer_name->name : ''" :list="'customerOptions'" name="customer"/>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="" class="col-sm-3 col-form-label">Job:</label>
                <div class="col-sm-9">
                    <x-input-datalist :options="$projects" :placeholder="'Select Project'" :value="isset($waybill) ? $waybill->job : ''" :list="'datalistProjects'" name="job"/>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="" class="col-sm-3 col-form-label">Vehicle No.:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control cusInput" name="vehicle_no" value="{{ (isset($waybill)) ? $waybill->vehicle_no : "" }}" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="" class="col-sm-3 col-form-label">Driver's Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="driver_name" value="{{ (isset($waybill)) ? $waybill->driver_name : "" }}" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="" class="col-sm-3 col-form-label">Date</label>
                <div class="col-sm-9">
                    <input type="date" class="form-control" max="{{ date('Y-m-d') }}" name="bill_date" value="{{ (isset($waybill)) ? $waybill->bill_date : date('Y-m-d') }}" required>
                </div>
            </div>
        </div>
        <div class="col-6">

        </div>
    </div>

    {{-- Buttons --}}
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

