@props(['waybill', 'waybill_details', 'downloadable'])

<div id = "main">
    @if($downloadable == 0)
        <div class="row">
            <div class="col-6">
                <img src="{{ asset('/storage/'.getShopSettings()->text_logo) }}" alt="logo" width="150">
            </div>
            <div class="col-6 pt-2 float-end">
                <h4>WAYBILL</h4>
                <table class="table" style="border: 2px solid #000; width: 100%">
                    <tr style="padding-top: 10px;">
                        <td style="width: 50px">TO:</td>
                        <td>{{ $waybill->customer_name->name }}</td>
                    </tr>
                    <tr>
                        <td>JOB:</td>
                        <td>{{ $waybill->job }}</td>
                    </tr>
                </table>
            </div>
        </div>
    @else
{{--        <table class="table table-bordered">--}}
{{--            <tr>--}}
{{--                <td rowspan="2" style="text-align: left; padding: 0">--}}
{{--                    <img src="{{ public_path('/storage/'.getShopSettings()->text_logo) }}" alt="logo" width="150">--}}
{{--                </td>--}}
{{--                <td style="text-align: left; padding-right: 0"><img src="{{ public_path('/dist/assets/img/invoice.png') }}" alt="invoice" width="200" style="float: right"></td>--}}
{{--            </tr>--}}
{{--            <tr>--}}
{{--                <td style="text-align: right; padding-right: 20px;"><h5># {{ $transaction->invoice_no}}</h5></td>--}}
{{--            </tr>--}}
{{--        </table>--}}
    @endif

    <div>
        <label style="float: right">Date {{ $waybill->bill_date }}</label>
        @php
            $shop = getShopSettings();
        @endphp
        <div><b>{{ $shop->shop_name }}</b><br>
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
        {{-- <div align = "center"><u><b>Your Bill</b></u></div> --}}
        <div>
            <table class="table table-light">
                <tr>
                    <td>VEHICLE No: <strong>{{ $waybill->vehicle_no }}</strong></td>
                    <td>DRIVER'S NAME: <strong>{{ $waybill->driver_name }}</strong></td>
                </tr>
            </table>
            <br>
            <table width="100%">
                <thead>
                    <tr style="background: #002E69; color: #fff;">
                        <th width = "3%" style="padding: 10px;">#</th>
                        <th width = "7%" style = "text-align: center;">Qty</th>
                        <th width = "60%">Description</th>
                        <th width = "30%" >Remarks</th>
                    </tr>
                </thead>
                <tbody style="border-bottom: 2px solid">
                    @foreach ($waybill_details as $key => $waybill_detail )
                        <tr style = "padding-top: 5px; padding-bottom: 5px;">
                            <td style = "padding-left: 10px; vertical-align: text-top;">{{ ++$key }}.</td>
                            <td style = "text-align: center; vertical-align: text-top;">{{ $waybill_detail->quantity }}</td>
                            <td style = "text-align: left; padding-left: 3px;">{{ $waybill_detail->product_name->name }} <br> {{ $waybill_detail->product_name->description  }}</td>
                            <td style = "text-align: left; padding-right: 3px;">{{ $waybill_detail->remarks }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            <br>
            <table class="table table-light">
                <tr>
                    <td>Dispatched By:</td>
                    <td>Position:</td>
                </tr>
                <tr>
                    <td>Signature:</td>
                    <td>Date:</td>
                </tr>
                <tr><td><br></td><td><br></td></tr>
                <tr>
                    <td>Received By:</td>
                    <td>Position:</td>
                </tr>
                <tr>
                    <td>Signature:</td>
                    <td>Date:</td>
                </tr>
            </table>
        </div>
    </div>
</div>
