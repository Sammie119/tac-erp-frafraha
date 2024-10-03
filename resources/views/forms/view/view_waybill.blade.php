{{-- {{ $waybill }}--}}
<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">Waybill Details for {{ $waybill->customer_name->name }}</h3>
    </div> <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table">
            <thead>
            <tr>
                <th style="width: 20px">#</th>
                <th style="width: 130px">Item</th>
                <th>Information</th>
            </tr>
            </thead>
            <tbody>
                <tr class="align-middle">
                    <td>1.</td>
                    <td>{{__('Customer')}}</td>
                    <td>{{ $waybill->customer_name->name }}</td>
                </tr>
                <tr class="align-middle">
                    <td>2.</td>
                    <td>{{__('Job')}}</td>
                    <td>{{ $waybill->job }}</td>
                </tr>
                <tr class="align-middle">
                    <td>3.</td>
                    <td>{{__('Vehicle #')}}</td>
                    <td>{{ $waybill->vehicle_no }}</td>
                </tr>
                <tr class="align-middle">
                    <td>4.</td>
                    <td>Driver's Name</td>
                    <td>{{ $waybill->driver_name }}</td>
                </tr>
                <tr class="align-middle">
                    <td>5.</td>
                    <td>{{__('Date')}}</td>
                    <td>{{ $waybill->bill_date }}</td>
                </tr>
            </tbody>
        </table>
    </div> <!-- /.card-body -->
</div> <!-- /.card -->

<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">Waybill Details</h3>
    </div> <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table">
            <thead>
            <tr>
                <th style="width: 20px">#</th>
                <th>Product</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Remarks</th>
            </tr>
            </thead>
            <tbody>
            @foreach($waybill_details as $key => $waybill_detail)
                <tr class="align-middle">
                    <td>{{ ++$key }}</td>
                    <td nowrap>{{ $waybill_detail->product_name->name }}</td>
                    <td>{{ $waybill_detail->product_name->description }}</td>
                    <td>{{ $waybill_detail->quantity }}</td>
                    <td>{{ $waybill_detail->remarks }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div> <!-- /.card-body -->
</div> <!-- /.card -->


{{-- Buttons --}}
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <a href="{{ route('print', [$waybill->bill_id, 'waybills'], ) }}" type="button" class="btn btn-primary"> <i class="bi bi-printer"></i> Print</a>
</div>


