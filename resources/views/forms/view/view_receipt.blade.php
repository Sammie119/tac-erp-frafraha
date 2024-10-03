{{-- {{ $transaction }}--}}
<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">Invoice for {{ $transaction->customer_name }}</h3>
    </div> <!-- /.card-header -->
    <div class="card-body p-0">

        <table class="table">
            <thead>
            <tr>
                <th style="width: 20px">#</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Amount</th>
            </tr>
            </thead>
            <tbody>
                @foreach($details as $key => $detail)
                    <tr class="align-middle">
                        <td>{{ ++$key }}</td>
                        <td>{{ $detail->product_name->name }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>{{ number_format($detail->unit_price, 2) }}</td>
                        <td>{{ number_format($detail->amount, 2) }}</td>
                    </tr>
                @endforeach
                @if($transaction->discount > 0)
                    <tr class="align-middle">
                        <td></td>
                        <td></td>
                        <td></td>
                        <th>Discount</th>
                        <th>({{ number_format($transaction->discount, 2) }})</th>
                    </tr>
                @endif
                <tr class="align-middle">
                    <td></td>
                    <td></td>
                    <td></td>
                    <th>Total</th>
                    <th>{{ number_format($total = $transaction->without_tax_amount, 2) }}</th>
                </tr>
            </tbody>
            <tfoot>
                @if($transaction->taxable == 1)
                    <tr class="align-middle" style="border-top: solid 2px #000">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>NHIL ({{ getTaxValue('nhil') }} %)</td>
                        <td>{{ number_format( $nhil = $transaction->nhil, 2) }}</td>
                    </tr>
                    <tr class="align-middle">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>GEHL ({{ getTaxValue('gehl') }} %)</td>
                        <td>{{ number_format( $gehl = $transaction->gehl, 2) }}</td>
                    </tr>
                    <tr class="align-middle">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Covid 19 ({{ getTaxValue('covid19') }} %)</td>
                        <td>{{ number_format( $covid19 = $transaction->covid19, 2) }}</td>
                    </tr>
                    <tr class="align-middle">
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Sub Total</th>
                        <th>{{ number_format($total + $nhil + $gehl + $covid19, 2) }}</th>
                    </tr>
                    <tr class="align-middle">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>VAT ({{ getTaxValue('vat') }} %)</td>
                        <td>{{ number_format($transaction->vat, 2) }}</td>
                    </tr>
                    <tr class="align-middle" style="border-bottom: solid 2px #000">
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Amount Due</th>
                        <th>{{ number_format($transaction->transaction_amount, 2) }}</th>
                    </tr>
                @else
                    <tr class="align-middle" style="border-top: solid 2px #000">
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Amount Due</th>
                        <th>{{ number_format($transaction->transaction_amount, 2) }}</th>
                    </tr>
                @endif
                <tr class="align-middle">
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Amount Paid</th>
                    <th>{{ number_format(($transaction->transaction_amount - $payment->balance), 2) }}</th>
                </tr>
                <tr class="align-middle">
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Amount Received</th>
                    <th>{{ number_format($payment->amount_paid, 2) }}</th>
                </tr>
                <tr class="align-middle">
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Balance</th>
                    <th>{{ number_format($payment->balance, 2) }}</th>
                </tr>
            </tfoot>
        </table>
    </div> <!-- /.card-body -->
</div> <!-- /.card -->

{{--{{ $payment }}--}}


    {{-- Buttons --}}
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <a href="{{ route('print', [$payment->id, 'payments'], ) }}" type="button" class="btn btn-primary"> <i class="bi bi-printer"></i> Print</a>
</div>


