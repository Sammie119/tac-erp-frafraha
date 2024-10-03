<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TAC PRESS | Invoice</title>

    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.css') }}">
{{--    <link rel="stylesheet" href="{{ public_path('dist/css/adminlte.css') }}">--}}
</head>
<style type="text/css">
    body{
        width: 750px;
        font-size: 13px;
        background-color: #fbfcfc
    }

    table {
        font-size: 13px;
    }
    tfoot {
        border-top: solid thin;
        border-bottom: solid thin;
    }

    th {
        font-weight: normal;
        padding-top: 5px;
        padding-bottom: 5px;
    }

    hr {
        border-color: #000;
    }

    .mov-right {
        text-align: right
    }

    @media print {
        .noprint{
            visibility: hidden;
        }
    }
</style>

<script type="text/javascript">
    function print_1(){
        window.print();
        //window.print();
        window.close();
    }

</script>

<body>
    <main>
        @switch($type)
            @case('invoice')
                <x-invoice-layout :transaction="$transaction" :transaction_details="$transaction_details" :downloadable="0" :type="$type"/>
                @break

            @case('receipt')
                <x-invoice-layout :transaction="$transaction" :transaction_details="$transaction_details" :payment="$payment" :downloadable="0" :type="$type"/>
                @break

            @case('waybill')
                <x-waybill-print :waybill="$waybill" :waybill_details="$waybill_details" :downloadable="0"/>
                @break

            @default
                No Print out
        @endswitch

        <div class = "noprint mt-2 mb-4 float-end">
            <button class="btn btn-dark" onClick = "print_1()" style="border-radius: 0 !important;"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                    <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
                    <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1"/>
                </svg> Print</button>

            @switch($type)
                @case('invoice')
                    <a href="{{ route('invoice_pdf', [$transaction->transaction_id, $location, $type]) }}" class="btn btn-secondary" style="border-radius: 0 !important;"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                            <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
                        </svg> Download</a>
                    @break

                @case('receipt')
                    <a href="{{ route('invoice_pdf', [$payment->id, $location, $type]) }}" class="btn btn-secondary" style="border-radius: 0 !important;"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                            <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
                        </svg> Download</a>
                    @break

{{--                @case('waybill')--}}
{{--                    <a href="{{ route('invoice_pdf', [$payment->id, $location, $type]) }}" class="btn btn-secondary" style="border-radius: 0 !important;"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">--}}
{{--                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>--}}
{{--                            <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>--}}
{{--                        </svg> Download</a>--}}
{{--                    @break--}}

                @default

            @endswitch
        </div>

    </main>
</body>

</html>


