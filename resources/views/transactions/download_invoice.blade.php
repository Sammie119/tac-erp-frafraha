<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TAC PRESS | Invoice</title>
{{--    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.css') }}">--}}
        <link rel="stylesheet" href="{{ public_path('dist/css/adminlte.css') }}">
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">--}}

</head>
<style type="text/css">
    body{
        width: 700px;
        font-size: 13px;
        /*background-color: #fbfcfc*/
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
</style>
<body>
    <main>
        @if($type == 'invoice')
            <x-invoice-layout :transaction="$transaction" :transaction_details="$transaction_details" :downloadable="1" :type="$type"/>
        @else
            <x-invoice-layout :transaction="$transaction" :transaction_details="$transaction_details" :payment="$payment" :downloadable="1" :type="$type"/>
        @endif
    </main>
</body>

</html>


