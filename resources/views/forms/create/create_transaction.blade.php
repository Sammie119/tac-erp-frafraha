<form method="POST" action="transaction_store">
    @csrf
    @isset($transaction)
        @method('put')
        <input type="hidden" name="id" value="{{ $transaction->transaction_id }}">
    @endisset

    <div class="col-md-12">
        <div class="row ">
            <div class="form-group col-md-6">
                <label for="recipient-name" class="control-label">Enter Product</label>
                <x-input-datalist :options="$products" :placeholder="'Enter Product'" class="product" :list="'datalistOptions'" autofocus/>
            </div>
            <div class="form-group col-md-2">
                <label for="recipient-name" class="control-label">Action</label>
                <a class="form-control btn btn-success addProduct">Add</a>
            </div>

            <div class="form-group col-md-4 px-5 ">
                @if(get_logged_user_division_id() !== 42)
                    <label for="recipient-name" class="control-label mb-2">Invoice Type</label>
                    <div class="row">
                        <div class="form-check col-md-6">
                            <input class="form-check-input" type="radio" name="taxable" value="1" id="taxable" {{ isset($transaction) ? (($transaction->taxable == 1) ? 'checked' : '') : 'checked' }}>
                            <label class="form-check-label" for="taxable">Taxable</label>
                        </div>
                        <div class="form-check col-md-6">
                            <input class="form-check-input" type="radio" name="taxable" value="0" id="non_taxable" {{ isset($transaction) ? (($transaction->taxable == 0) ? 'checked' : '') : '' }}>
                            <label class="form-check-label" for="non_taxable">Non Taxable</label>
                        </div>
                    </div>
                @else
                    <input class="form-check-input" type="hidden" name="taxable" value="0" id="non_taxable"  checked>
                    <div class="row">
                        <div class="form-group col-md-8">
                            <label for="position" class="form-label mb-2">{{ __('Payment Method') }}</label>
                            <x-input-select :options="$payment_methods" :selected="isset($payment) ? $payment->payment_method : 32" name="payment_method" required />
                        </div>
                        <div class="form-check col-md-4">
                            <div class="mt-4">
                                <label class="form-check-label" for="non_taxable">Invoice</label>
                                <input class="form-check-input" type="checkbox" name="checkbox" value="1" id="non_taxable">
                            </div>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>

    <hr>

    <div class="col-md-12">
        <div class="row ">
            <div class="col-md-6">
                <label for="recipient-name" class="control-label">Brand - Product (Description)</label>
            </div>
            <div class="col-md-2">
                <label for="recipient-name" class="control-label">Quantity</label>
            </div>
            <div class="col-md-1">
                <label for="recipient-name" class="control-label">Rate</label>
            </div>
            <div class="col-md-2">
                <label for="recipient-name" class="control-label">Amount</label>
            </div>
            <div class="col-md-1">
                <label for="recipient-name" class="control-label">Action</label>
            </div>
        </div>
    </div>

    <div class="col-md-12 form_field_outer p-0">
        <div class="col-md-12 mt-2 getTotalAmount" id="contentProduct">
            @isset($transaction)
                @foreach($transaction_details as $transaction_detail)
                    <div class="row mb-2">
                        <div class="form-group col-6">
                            <select class="form-control bg-white mb-1" name="product_id[]"><option value="{{ $transaction_detail->product_id }}" selected>{{ $transaction_detail->product_name->name }}</option></select>
                            @if(get_logged_user_division_id() === 14)
                                <input type="text" class="form-control bg-white" name="product_description[]" placeholder="Enter Product Description" value="{{ $transaction_detail->product_description }}">
                            @endif
                        </div>
                        <div class="form-group col-2">
                            <input type="number" class="form-control bg-white px-0 quantity" name="quantity[]" value="{{ $transaction_detail->quantity }}" style="text-align: center;" required>
                        </div>
                        <div class="form-group col-1">
                            <select class="form-control bg-white px-0 price" name="unit_price[]" style="text-align: center;"><option selected>{{ $transaction_detail->unit_price }}</option></select>
                        </div>
                        <div class="form-group col-2">
                            <input type="number" min="0" step="0.01" class="form-control bg-white sub_total" value="{{ $transaction_detail->amount }}" name="amount[]" readonly>
                        </div>
                        <div class="form-group col-1">
                            <button type="button" class="btn btn-danger btn-sm bottn_delete" style="padding-top: 8px; padding-bottom: 8px;"><i class="bi bi-trash"></i></button>
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
            <label for="recipient-name" class="control-label">Customer</label>
            <input type="text" name="customer" value="{{ isset($transaction) ? $transaction->customer_name->name : '' }}" class="form-control form-control-border customer mb-3" list="customerOptions" placeholder="Select Customer" required>
            <datalist id="customerOptions">
                @forelse ( $customers as $cus)
                    <option value="{{ $cus->name }}">
                @empty
                    <option value="No Data Found">
                @endforelse
                <option value="Add Customer">
            </datalist>
            <div style="display: none" id="displayCashCustomerInput">
                <div class="mb-3 row">
                    <label for="" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control cashInput" name="customer_name">
                    </div>
                </div>
            </div>
            <div style="display: none" id="displayCustomerInput">
                <div class="mb-3 row">
                    <label for="" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control cusInput" name="name">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control cusInput" name="address">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="email">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                        <input type="number" min="1" step="1" class="form-control cusInput" name="phone">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="" class="col-sm-2 col-form-label">City/Town</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control cusInput" name="location">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <table class="table table-borderless">
                <tr>
                    <th style="text-align: right; padding-right: 10px;">Total Amount:</th>
                    <td style="width: 40%"><input type="number" name="total_amount" step="0.01" value="{{ isset($transaction) ? $transaction->transaction_amount : '' }}" min="0" class="form-control bg-white total_amount" placeholder="0.00" style="text-align: right" id="inputEmail4" readonly></td>
                </tr>
                <tr>
                    <th style="text-align: right; padding-right: 10px;">Discount:</th>
                    <td style="width: 40%"><input type="number" name="discount" step="0.01" value="{{ isset($transaction) ? $transaction->discount : '0.00' }}" min="0" class="form-control bg-white" placeholder="0.00" style="text-align: right" id="inputEmail4"></td>
                </tr>
                <input type="hidden" value="{{ isset($transaction) ? $transaction->nhil : 0.00 }}" name="nhil" id="nhil"/>
                <input type="hidden" value="{{ isset($transaction) ? $transaction->gehl : 0.00 }}" name="gehl" id="gehl"/>
                <input type="hidden" value="{{ isset($transaction) ? $transaction->covid19 : 0.00 }}" name="covid19" id="covid19"/>
                <input type="hidden" value="{{ isset($transaction) ? $transaction->vat : 0.00 }}" name="vat" id="vat"/>
                <input type="hidden" value="{{ isset($transaction) ? $transaction->without_tax_amount : 0.00 }}" name="without_tax_amount" id="without_tax_amount"/>

                {{-- <tr>
                    <th style="text-align: right; padding-right: 10px;">Amount Given:</th>
                    <td style="width: 23%"><input type="number" step="0.01" value="" min="0" class="form-control bg-white" style="text-align: right" placeholder="0.00" id="amount_given"></td>
                </tr>
                <tr>
                    <th style="text-align: right; padding-right: 10px;">Change:</th>
                    <td style="width: 23%"><input type="number" class="form-control bg-white" style="text-align: right" id="change" placeholder="0.00" readonly></td>
                </tr> --}}
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

            function addTax(taxable, nontaxable){
                let total;
                if($("#taxable").is(':checked')) {
                    total = taxable;
                } else {
                    total = nontaxable;
                }

                return total;
            }

            let nhil = +<?php echo getTaxValue('nhil') ?>;
            let gehl = +<?php echo getTaxValue('gehl') ?>;
            let covid19 = +<?php echo getTaxValue('covid19') ?>;
            let vat = +<?php echo getTaxValue('vat') ?>;

            function TotalAmount(){
                var totalAmount = 0;

                $('.sub_total').each(function(i, e){
                    var s_total = $(this).val() - 0;
                    totalAmount += s_total;
                });

                let subTotal = totalAmount + (totalAmount * (nhil / 100)) + (totalAmount * (gehl / 100)) + (totalAmount * (covid19 / 100));

                const total = addTax(subTotal + ((subTotal * (vat / 100))), totalAmount);

                // $('.total_amount').val(subTotal);
                $('.total_amount').val(total.toFixed(2));

                $('#nhil').val(totalAmount * (nhil / 100));
                $('#gehl').val(totalAmount * (gehl / 100));
                $('#covid19').val(totalAmount * (covid19 / 100));
                $('#vat').val(subTotal * (vat / 100));
                $('#without_tax_amount').val(totalAmount.toFixed(2));
            }

            $('.getTotalAmount').delegate('.quantity', 'keyup', function(){
                var div = $(this).parent().parent();
                var qty = div.find('.quantity').val() - 0;
                var price = div.find('.price').val() - 0;
                var total = qty * price;
                div.find('.sub_total').val(total.toFixed(2));
                TotalAmount();
            });

            // Checking quantity with stock
            /*$('.getTotalAmount').delegate('.quantity', 'keyup', function(){
                var div = $(this).parent().parent();
                var qty = div.find('.quantity').val() - 0;
                var stock = div.find('.stock').val() - 0;
                if(stock < qty){
                    alert('Quantity Entered is Greater than Quantity in Stock!!');
                    div.find('.quantity').val('');
                    div.find('.quantity').focus;
                }
                else if(qty == 0){
                    alert('Quantity Entered should not be Zero (0)!!');
                    div.find('.quantity').val('');
                    div.find('.quantity').focus;
                }
            }); */

            // delete row and subtract from total amount
            $('.getTotalAmount').delegate('.bottn_delete', 'click', function(){
                var div = $(this).parent().parent();
                var sub_total = div.find('.sub_total').val() - 0;
                var total_amount = $('.total_amount').val() - 0;

                let subTotal = sub_total + (sub_total * (nhil / 100)) + (sub_total * (gehl / 100)) + (sub_total * (covid19 / 100));

                const total = addTax(subTotal + ((subTotal * (vat / 100))), sub_total);

                var new_total = total_amount - total;

                $('.total_amount').val(new_total.toFixed(2));
                //  alert(price);
                $('#nhil').val(sub_total * (nhil / 100));
                $('#gehl').val(sub_total * (gehl / 100));
                $('#covid19').val(sub_total * (covid19 / 100));
                $('#vat').val(subTotal * (vat / 100));
                $('#without_tax_amount').val(sub_total);

                div.remove();
            });

            // Change Calculator
            // $("#amount_given").keyup(function(){
            //     var total = $('.total_amount').val();
            //     var amount_given = $('#amount_given').val();
            //
            //     $('#change').val((amount_given - total).toFixed(2));
            // });

            // Transaction ID
            // $("#non_taxable").change(function(){
            //     // $("#transac").css("display","block")
            //     $("#transaction_id").attr("required", true);
            //     $("#transaction_id").attr("readonly", false);
            // });
            //
            // $("#taxable").change(function(){
            //     // $("#transac").css("display","none");
            //     $("#transaction_id").attr("readonly", true);
            // });

            // Customer
            $(".customer").change(function(){
                var cus = $('.customer').val();
                if(cus === 'Add Customer'){
                    $("#displayCustomerInput").css("display","block");
                    $(".cusInput").attr("required", true);
                } else if(cus === 'Cash Customer'){
                    $("#displayCashCustomerInput").css("display","block");
                    $(".cashInput").attr("required", true);
                }
                else {
                    $("#displayCustomerInput").css("display","none");
                    $(".cusInput").attr("required", false);

                    $("#displayCashCustomerInput").css("display","none");
                    $(".cashInput").attr("required", false);
                }

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

