<form method="POST" action="purchase_order_store">
    @csrf
    @isset($purchase_order)
        @method('put')
        <input type="hidden" name="id" value="{{ $purchase_order->purchase_id }}">
    @endisset

    <div class="row">
        <div class="col-6 mb-3">
            <label for="supplier_name" class="form-label">{{ __('Supplier Name') }}</label>
            <x-input-datalist :options="$suppliers" name="supplier_name" :value="isset($purchase_order) ? $purchase_order->supplier->supplier_name : ''" :placeholder="'Enter Supplier Name'" :list="'datalistSupplier'"/>
        </div>
        <div class="col-6 mb-3">
            <label for="invoice_number" class="form-label">{{ __('Invoice Number') }}</label>
            <input type="text" name="invoice_number" class="form-control" value="{{ isset($purchase_order) ? $purchase_order->invoice_number : "" }}" id="invoice_number" placeholder="{{ __('Invoice Number') }}">
        </div>

        <div class="col-6 mb-3">
            <label for="order_date" class="form-label">{{ __('Order Date') }}</label>
            <input type="date" name="order_date" max="{{ date('Y-m-d') }}" class="form-control" value="{{ isset($purchase_order) ? $purchase_order->order_date : date('Y-m-d') }}" id="order_date" required>
        </div>
        <div class="col-6 mb-3">
            <label for="received_date" class="form-label">{{ __('Received Date') }}</label>
            <input type="date" name="received_date" max="{{ date('Y-m-d') }}" class="form-control" value="{{ isset($purchase_order) ? $purchase_order->received_date : "" }}" id="received_date">
        </div>

        <div class="col-6 mb-3">
            <label for="total_amount" class="form-label">{{ __('Total Amount') }}</label>
            <input type="number" name="total_amount" class="form-control" value="{{ isset($purchase_order) ? $purchase_order->total_amount : "" }}" id="total_amount" placeholder="{{ __('Total Amount') }}">
        </div>
        <div class="col-6 mb-3">
            <label for="status" class="form-label">{{ __('Status') }}</label>
            <x-input-select
                :options="['Pending', 'Received']"
                :selected="isset($purchase_order) ? $purchase_order->status : 3"
                :values="[0, 1]"
                :type="1"
                name="status"
                required
            />
        </div>
    </div>

    {{-- Buttons --}}
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

