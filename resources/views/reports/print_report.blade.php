<!DOCTYPE>
<html>

<title>ACTS | Report</title>
<link rel="shortcut icon" href="{{ asset('dist/assets/img/favicon.ico') }}" type="image/ico">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

<style type="text/css">
    #logo{
        text-align: center;
        border-bottom: 2px solid;
        width: 100%;
        margin-right: 14px;
    }

    tr {
        padding-top: 0px;
    }

    #logo-text {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 5px;
        margin-top: 0px;
        text-transform: uppercase;
    }

    button {
        float: right;
        padding-top: 10px;
        padding-bottom: 10px;
        padding-right: 20px;
        padding-left: 20px;
        font-weight: bolder;
        border: solid 1px;
        border-radius: 20px;
        position: relative;
        margin-right: 5%;
    }

    @media print {
        .noprint, #back{
            visibility: hidden;
        }

        #myheader_opd {
            position: fixed;
            top: 0;
            right: 0;
        }

        /* @page{
            size: landscape;
        } */

        /* tfoot{
            page-break-before: always;
        } */
    }

    @media screen {
        #myheader_opd{
            display: none;
        }

        /* br {
            display: none;
        } */
    }

    .center {
        display: block;
        margin-left: auto;
        margin-right: auto;
        margin-top: 0%;
    }
</style>

<script type="text/javascript">
    function print_1(){
        window.print();
        window.location = "{{ url()->previous() }}";
    }
</script>

</head>

<body style="width: 100%;" >

<div id="back"><a href="{{ url()->previous() }}">Back</a></div>
<header id="header">
    <img class="center" src="{{ asset('dist/assets/img/tacgh_logo.png') }}" width="100px" alt="TAC_logo">
    <div id="logo" style="padding-top: 10px">
        <h6 id="logo-text">{{ $header }}</h6>
        <p style="font-size: 16px; font-weight: bolder">Date Range: {{ $date['from'] }} - {{ $date['to'] }}</p>
    </div>
</header>

@switch($report)
    @case('Daily Income Report')
        <div class = "data">
            <table class="table border-secondary table-sm mt-2">
                <thead>
                    <tr>
                        <th colspan="7" style="text-align: center">Detailed Report</th>
                    </tr>
                    <tr>
                        <th>No.</th>
                        <th>Staff Name</th>
                        <th>Date</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Rate</th>
                        <th style="text-align: right;">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total_sales = 0;
                    @endphp
                    @foreach ($data as $key => $staff)
                        @php
                            $details = \App\Models\TransactionDetail::where('transaction_id', $staff->transaction_id)->get()
                        @endphp

                        @foreach($details as $detail)
                            @php
                                $total_sales += ($detail->quantity * $detail->unit_price);
                            @endphp
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ get_logged_staff_name($staff->updated_by_id) }}</td>
                                <td>{{ $staff->transaction_date }}</td>
                                <td>{{ $detail->product_name->name }}</td>
                                <td>{{ $detail->quantity }}</td>
                                <td>{{ $detail->unit_price }}</td>
                                <td style="text-align: right;">{{ number_format($detail->quantity * $detail->unit_price, 2) }}</td>
                            </tr>
                        @endforeach

                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="6" style="text-align: center">GRAND TOTAL</th>
                        <th style="text-align: right;">{{ number_format($total_sales, 2) }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class = "data">
            <table class="table border-secondary table-sm mt-2">
                <thead>
                <tr>
                    <th colspan="3" style="text-align: center">Summary Report</th>
                </tr>
                <tr>
                    <th>No.</th>
                    <th>Staff Name</th>
                    <th style="text-align: right;">Amount</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $total_sales = 0;
                @endphp
                @foreach ($data_payment as $key => $staff)

                    @php
                        $total_sales += $staff->amount;
                    @endphp
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ get_logged_staff_name($staff->updated_by_id) }}</td>
                        <td style="text-align: right;">{{ number_format($staff->amount, 2) }}</td>
                    </tr>

                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="2" style="text-align: center">GRAND TOTAL</th>
                    <th style="text-align: right;">{{ number_format($total_sales, 2) }}</th>
                </tr>
                </tfoot>
            </table>
        </div>
        @break

    @case('Receipt Report')
        <div class = "data">
            <table class="table border-secondary table-sm mt-2">
                <thead>
{{--                <tr>--}}
{{--                    <th colspan="7" style="text-align: center">Detailed Report</th>--}}
{{--                </tr>--}}
                <tr>
                    <th>No.</th>
                    <th>Invoice No</th>
                    <th>Receipt No</th>
                    <th>Customer</th>
                    <th>Amount</th>
                    <th>Paid</th>
                    <th>Balance</th>
                    <th>Status</th>
                    <th>Location</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $total_sales = 0;
                    $total_balance = 0;
                    $total_amount = 0;
                @endphp
                @foreach ($payments as $key => $payment)
                    @php
                        $total_sales += $payment->amount_paid;
                        $total_balance += $payment->balance;
                        $total_amount += $payment->paid_balance;
                    @endphp

                    <tr class="align-middle">
                        <td>{{ ++$key }}</td>
                        <td>{{ $payment->invoice_no }}</td>
                        <td>{{ $payment->receipt_no }}</td>
                        <td>{{ getCustomerName($payment->transaction_id) }}</td>
                        <td>{{ $payment->paid_balance }}</td>
                        <td>{{ $payment->amount_paid }}</td>
                        <td>{{ $payment->balance }}</td>
                        <td>{!! getPaymentStatus($payment->transaction->status) !!}</td>
                        <td>{{ get_division_name($payment->division) }}</td>
                        <td>{{ $payment->payment_date }}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="4" style="text-align: center">GRAND TOTAL</th>
                    <th>{{ number_format($total_amount, 2) }}</th>
                    <th>{{ number_format($total_sales, 2) }}</th>
                    <th>{{ number_format($total_balance, 2) }}</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </tfoot>
            </table>
        </div>
        @break

    @default
        <h5>No Report Select</h5>
@endswitch
{{--@switch($report)--}}

{{--    @case('Bankers')--}}
{{--        <a href="{{ route('exprt_to_bank', [$date['month'], $date['year']]) }}" class="noprint btn btn-outline-dark">Export</a>--}}
{{--        @break--}}

{{--    @default--}}

{{--@endswitch--}}
<button class="noprint btn btn-outline-dark" onclick="print_1()">Print</button>

</body>
</html>

