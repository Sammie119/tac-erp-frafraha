<form method="POST" @isset($transaction) action="make_single_payment"  @else action="make_payment" @endisset>
    @csrf
    @isset($payment)
        @method('put')
        <input type="hidden" name="id" value="{{ $payment->id }}">
    @endisset

    <div class="col-md-12">
        <div class="row ">
            <div class="form-group col-md-6">
                <label for="recipient-name" class="control-label mb-2">Enter Invoice</label>
                <x-input-datalist :options="$invoices" :placeholder="'Enter Invoice'" class="product" :list="'datalistOptions'" autofocus/>
            </div>
            <div class="form-group col-md-2">
                @if(empty($payment) && empty($transaction))
                    <label for="recipient-name" class="control-label mb-2">Action</label>
                    <a class="form-control btn btn-success addProduct">Add</a>
                @endif
            </div>

            <div class="form-group col-md-4 px-5 ">
                <label for="position" class="form-label">{{ __('Payment Method') }}</label>
                <x-input-select :options="$payment_methods" :selected="isset($payment) ? $payment->payment_method : 25" name="payment_method" required />
            </div>

        </div>
    </div>

    <hr>

    <div class="col-md-12">
        <div class="row ">
            <div class="col-md-2">
                <label for="recipient-name" class="control-label">Invoice No</label>
            </div>
            <div class="col-md-5">
                <label for="recipient-name" class="control-label">Customer Name</label>
            </div>
            <div class="col-md-2">
                <label for="recipient-name" class="control-label">Amount Due</label>
            </div>
            <div class="col-md-2">
                <label for="recipient-name" class="control-label">Paid Amount</label>
            </div>
            <div class="col-md-1">
                <label for="recipient-name" class="control-label">Action</label>
            </div>
        </div>
    </div>

    <div class="col-md-12 form_field_outer p-0">
        <div class="col-md-12 mt-2 getTotalAmount" id="contentProduct">
            @if(isset($payment) || isset($transaction))
                <div class="row mb-2">
                    <div class="form-group col-2">
                        <select class="form-control bg-white" name="transaction_id" ><option value="{{ $transaction->transaction_id }}" selected>{{ $transaction->invoice_no }}</option></select>
                    </div>
                    <div class="form-group col-5">
                        <select class="form-control bg-white"><option selected>{{ $transaction->customer_name }}</option></select>
                    </div>
                    <div class="form-group col-2">
                        <input type="number" min="0" step="1" placeholder="0" class="form-control bg-white" value="{{ (isset($payment)) ? $transaction->transaction_amount : (($transaction->amount_paid == 0.00) ? $transaction->transaction_amount : floatval($transaction->transaction_amount - $transaction->amount_paid)) }}" readonly>
                    </div>
                    <div class="form-group col-2">
                        <input type="number" min="1" step="0.01" placeholder="0" class="form-control bg-white paid_amount" value="{{ (isset($payment)) ? $payment->amount_paid : "" }}" name="paid_amount" required>
                        <input type="hidden" class="sub_total">
                    </div>
                    <div class="form-group col-1">
                        <button type="button" class="btn btn-danger btn-sm" style="padding-top: 8px; padding-bottom: 8px;"><i class="bi bi-trash"></i></button>
                    </div>
                </div>
            @else
                <div class="show_data">No Data Found</div>
            @endif
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-6">

        </div>
        <div class="col-6">
            <table class="table table-borderless">
                <tr>
                    <th style="text-align: right; padding-right: 10px;">Total Amount:</th>
                    <td style="width: 40%"><input type="number" name="total_amount" step="0.01" value="{{ isset($payment) ? $payment->amount_paid : '' }}" min="0" class="form-control bg-white total_amount" placeholder="0.00" style="text-align: right" id="inputEmail4" readonly></td>
                </tr>
                @can(\App\Enums\PermissionsEnum::CREATEFINANCIAL->value)
                <tr>
                    <th style="text-align: right; padding-right: 10px;">Unit/Department</th>
                    <td style="width: 40%"><x-input-select :options="$department" :selected="isset($financial) ? $financial->division : get_logged_user_division_id()" name="division" required /></td>
                </tr>
                @endcan
            </table>
        </div>
    </div>

    {{-- Buttons --}}
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

{{--@push('scripts')--}}
    <script>
        // window.onload = function(){
        $(document).ready(function () {

            function TotalAmount(){
                var totalAmount = 0;

                $('.paid_amount').each(function(i, e){
                    var s_total = $(this).val() - 0;
                    totalAmount += s_total;
                });

                // $('.total_amount').val(subTotal);
                $('.total_amount').val(totalAmount.toFixed(2));
            }

            $('.getTotalAmount').delegate('.paid_amount', 'keyup', function(){
                var div = $(this).parent().parent();
                var total = div.find('.paid_amount').val() - 0;
                div.find('.sub_total').val(total.toFixed(2));
                TotalAmount();
            });

            // delete row and subtract from total amount
            $('.getTotalAmount').delegate('.bottn_delete', 'click', function(){
                var div = $(this).parent().parent();
                var sub_total = div.find('.sub_total').val() - 0;
                var total_amount = $('.total_amount').val() - 0;

                var new_total = total_amount - sub_total;

                $('.total_amount').val(new_total.toFixed(2));
                //  alert(price);

                div.remove();
            });

            $(document).on('keypress',function(e) {
                // if(('.product').val() != ''){
                if(e.which == 13) {
                    // alert($('.product').val());
                    e.preventDefault();
                }
                // }
            });

        });
    </script>
{{--@endpush--}}

