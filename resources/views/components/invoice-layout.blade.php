@props(['transaction', 'transaction_details', 'downloadable', 'payment', 'type'])

<div id = "main">
    @php
        $shop = getShopSettings();
    @endphp
    @if (get_logged_user_division_id() !== 42)
        @if($downloadable == 0)
            <div class="row">
                <div class="col-6">
                    <img src="{{ asset('/storage/'.getShopSettings()->text_logo) }}" alt="logo" width="150">
                </div>
                <div class="col-6">
                    @if($type == 'invoice')
                        <div class="row">
                            <div class="col-12 pt-4 pb-2"><img src="{{ asset('/dist/assets/img/invoice.png') }}" alt="invoice" width="200" style="float: right"></div>
                            <div class="col-12"><h5 style="float: right"># {{ $transaction->invoice_no }}</h5></div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-12 pt-4 pb-2"><img src="{{ asset('/dist/assets/img/receipt.png') }}" alt="receipt" width="200" style="float: right"></div>
                            <div class="col-12"><h5 style="float: right; padding-right: 15px"># {{ $payment->receipt_no }}</h5></div>
                        </div>
                    @endif
                </div>
            </div>
        @else
            <table class="table table-bordered">
                @if($type == 'invoice')
                    <tr>
                        <td rowspan="2" style="text-align: left; padding: 0">
                            <img src="{{ public_path('/storage/'.getShopSettings()->text_logo) }}" alt="logo" width="150">
                        </td>
                        <td style="text-align: left; padding-right: 0"><img src="{{ public_path('/dist/assets/img/invoice.png') }}" alt="invoice" width="200" style="float: right"></td>
                    </tr>
                    <tr>
                        <td style="text-align: right; padding-right: 20px;"><h5># {{ $transaction->invoice_no}}</h5></td>
                    </tr>
                @else
                    <tr>
                        <td rowspan="2" style="text-align: left; padding: 0">
                            <img src="{{ public_path('/storage/'.getShopSettings()->text_logo) }}" alt="logo" width="150">
                        </td>
                        <td style="text-align: left; padding-right: 0"><img src="{{ public_path('/dist/assets/img/receipt.png') }}" alt="receipt" width="200" style="float: right"></td>
                    </tr>
                    <tr>
                        <td style="text-align: right; padding-right: 20px;"><h5># {{ $payment->receipt_no}}</h5></td>
                    </tr>
                @endif
            </table>
        @endif

        <div>
            <div><b>{{ $shop->display_name }}</b><br>
                {{ $shop->address }} <br>
                {{ $shop->phone1 }} <br>
                @if(!empty($shop->phone2))
                    {{ $shop->phone2 }} <br>
                @endif
                {{ $shop->email }}
            </div>
        </div>
        <br>
        <div>
            <label>Bill To</label>
            <label style="float: right">Date {{ $transaction->transaction_date }}</label>

            <div><b>{{ $transaction->customer_name->name }}</b><br>
                {{ $transaction->customer_name->address }} <br>
                {{ $transaction->customer_name->location }} <br>
                {{ $transaction->customer_name->phone }} <br>
                {{ $transaction->customer_name->email }}
            </div>
        </div>
    @else
        @php
            $payment = \App\Models\TransactionPayment::where('transaction_id', $transaction->transaction_id)->first();
        @endphp
        <div style="text-align: center">
            <img src="{{ asset('/storage/'.getShopSettings()->text_logo) }}" alt="logo" width="60">
        </div>
        <div style="text-align: center">
            <label style="font-weight: bolder; font-size: 20px">THE APOSTOLIC CHURCH-GHANA</label><br>
            <label>{{ $shop->display_name }}</label><br>
            <label>{{ $shop->address }} | Tel: {{ $shop->phone1 }} | Email: {{ $shop->email }}</label>
        </div>
        <div style="float: left;">
            <label style="font-weight: bolder; font-size: 30px; visibility: hidden">Receipt</label><br>
            <label>Date: {{ ($type == 'invoice') ? $transaction->transaction_date : $payment->payment_date }}</label><br>
            <label><b>Customer Name:</b> {{ ($transaction->customer_name->name == 'Cash Customer') ? $transaction->customer_name_store : $transaction->customer_name->name }}</label>
        </div>
        <div style="float: right;">
            @if($type == 'invoice')
                <label style="font-weight: bolder; font-size: 30px">Invoice</label><br>
                <label>{{ $transaction->invoice_no }}</label><br>
            @else
                <label style="font-weight: bolder; font-size: 30px">Receipt</label><br>
                <label>{{ $payment->receipt_no }}</label><br>
                <label><b>Payment Mode:</b> {{ \App\Models\SystemLOV::find($payment->payment_method)->name }}</label>
            @endif
        </div>

    @endif

    <div>
        <div>
            <table width="100%">
                <thead>
                <tr style="background: #002E69; color: #fff;">
                    <th width = "3%" style="padding: 10px;">#</th>
                    <th width = "60%">Description</th>
                    <th width = "7%" style = "text-align: center;">Qty</th>
                    <th width = "10%" class="mov-right">Rate</th>
                    <th width = "20%" class="mov-right" style="padding: 10px;">Amt</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($transaction_details as $key => $trans )
                    <tr style = "padding-top: 5px; padding-bottom: 5px;">
                        <td style = "padding-left: 10px; vertical-align: text-top;">{{ ++$key }}.</td>
                        <td style = "text-align: left; padding-left: 3px;">{{ $trans->product_name->name }} <br> {{ $trans->product_description  }}</td>
                        <td style = "text-align: center; vertical-align: text-top;">{{ $trans->quantity }}</td>
                        <td style = "text-align: right; vertical-align: text-top;">{{  number_format($trans->unit_price, 2) }}</td>
                        <td style = "text-align: right; padding-right: 10px; vertical-align: text-top;">{{ number_format($trans->amount, 2) }}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                    @if($transaction->discount > 0)
                        <tr>
                            <th class="mov-right" colspan = "4" style="font-weight: bolder">Discount: GH&cent;</th>
                            <th class="mov-right" style="padding-right: 10px; font-weight: bolder" >({{ number_format($transaction->discount, 2) }})</th>
                        </tr>
                    @endif
                    @if($transaction->taxable == 1)
                        <tr>
                            <th class="mov-right" colspan = "4" style="font-weight: bolder">Total: GH&cent;</th>
                            <th class="mov-right" style="padding-right: 10px; font-weight: bolder" >{{ number_format($amount = $transaction->without_tax_amount, 2) }}</th>
                        </tr>
                        <tr>
                            <th class="mov-right" colspan = "4" >NHIL({{ $shop->nhil }}%): GH&cent;</th>
                            <th class="mov-right" style="padding-right: 10px;">{{ number_format($nhil = $transaction->nhil, 2) }}</th>
                        </tr>
                        <tr>
                            <th class="mov-right" colspan = "4" >GEHL({{ $shop->gehl }}%): GH&cent;</th>
                            <th class="mov-right" style="padding-right: 10px;">{{ number_format($gehl = $transaction->gehl, 2) }}</th>
                        </tr>
                        <tr>
                            <th class="mov-right" colspan = "4" >CoVID-19({{ $shop->covid19 }}%): GH&cent;</th>
                            <th class="mov-right" style="padding-right: 10px;">{{ number_format($covid = $transaction->covid19, 2) }}</th>
                        </tr>
                        <tr  style="background: #C6C6C6;">
                            <th class="mov-right" colspan = "4" style="font-weight: bolder">Sub Total: GH&cent;</th>
                            <th class="mov-right" style="padding-right: 10px; font-weight: bolder">{{ number_format($sub_total = $amount + $nhil + $gehl + $covid, 2) }}</th>
                        </tr>
                        <tr>
                            <th class="mov-right" colspan = "4" >VAT({{ $shop->vat }}%): GH&cent;</th>
                            <th class="mov-right" style="padding-right: 10px;">{{ number_format($vat = $transaction->vat, 2) }}</th>
                        </tr>
                        <tr  style="background: #C6C6C6;">
                            <th class="mov-right" colspan = "4" style="font-weight: bolder" >Grand Total: GH&cent;</th>
                            <th class="mov-right" style="padding-right: 10px; font-weight: bolder">{{ number_format($transaction->transaction_amount, 2) }}</th>
                        </tr>
                    @else
                        <tr>
                            <th class="mov-right" colspan = "4" style="font-weight: bolder">Total: GH&cent;</th>
                            <th class="mov-right" style="padding-right: 10px; font-weight: bolder">{{ number_format($amount = $transaction->transaction_amount, 2) }}</th>
                        </tr>
                        <tr>
                            <th class="mov-right" colspan = "4" >Tax: GH&cent;</th>
                            <th class="mov-right" style="padding-right: 10px;">0.00</th>
                        </tr>
                        <tr  style="background: #C6C6C6;">
                            <th class="mov-right" colspan = "4" style="font-weight: bolder">Sub Total: GH&cent;</th>
                            <th class="mov-right" style="padding-right: 10px; font-weight: bolder">{{ number_format($amount, 2) }}</th>
                        </tr>
                        <tr style="background: #C6C6C6;">
                            <th class="mov-right" colspan = "4" style="color: black; font-weight: bolder">Grand Total: GH&cent;</th>
                            <th class="mov-right" style="padding-right: 10px; font-weight: bolder">{{ number_format($amount, 2) }}</th>
                        </tr>
                    @endif
                    @isset($payment)
                        <tr>
                            <th class="mov-right" colspan = "4" style="color: black; font-weight: bolder">Amount Paid: GH&cent;</th>
                            <th class="mov-right" style="padding-right: 10px; font-weight: bolder">{{ number_format(($transaction->transaction_amount - $payment->balance), 2) }}</th>
                        </tr>
                        <tr>
                            <th class="mov-right" colspan = "4" style="color: black; font-weight: bolder">Amount Received: GH&cent;</th>
                            <th class="mov-right" style="padding-right: 10px; font-weight: bolder ">{{ number_format($payment->amount_paid, 2) }}</th>
                        </tr>
                        <tr>
                            <th class="mov-right" colspan = "4" style="color: black; font-weight: bolder">Balance: GH&cent;</th>
                            <th class="mov-right" style="padding-right: 10px; font-weight: bolder">{{ number_format($payment->balance, 2) }}</th>
                        </tr>
                    @endisset
                </tfoot>
            </table>
        </div>

        @if (get_logged_user_division_id() === 42)
            <p><b>Cashier:</b> {{ get_logged_staff_name($transaction->updated_by_id) }}</p>
        @endif

    </div>
</div>
