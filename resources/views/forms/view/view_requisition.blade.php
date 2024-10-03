{{-- {{ $requisition }}--}}
<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">Request Details of {{ get_logged_staff_name($requisition->createdBy->staff_id) }}</h3>
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
                <td>{{__('Request Date')}}</td>
                <td>{{ $requisition->request_date }}</td>
            </tr>
            <tr class="align-middle">
                <td>2.</td>
                <td>{{__('Request By')}}</td>
                <td>{{ get_logged_staff_name($requisition->createdBy->staff_id) }}</td>
            </tr>
            <tr class="align-middle">
                <td>3.</td>
                <td>{{__('Approved By')}}</td>
                <td>{{ (!empty($requisition->approved_date)) ? get_logged_staff_name($requisition->approvedBy->staff_id) : "N/A" }}</td>
            </tr>
            <tr class="align-middle">
                <td>4.</td>
                <td>{{__('App. Date')}}</td>
                <td>{{ (!empty($requisition->approved_date)) ? $requisition->approved_date : "N/A" }}</td>
            </tr>
            <tr class="align-middle">
                <td>5.</td>
                <td>{{__('Status')}}</td>
                <td>{!! getStatus($requisition->status) !!}</td>
            </tr>

            </tbody>
        </table>
    </div> <!-- /.card-body -->
</div> <!-- /.card -->

<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">Details of requested Products</h3>
    </div> <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table">
            <thead>
            <tr>
                <th style="width: 20px">#</th>
                <th>Product</th>
                <th>Description</th>
                <th>Status</th>
                <th>Req. Quantity</th>
                <th>App. Quantity</th>
                <th>Remarks</th>
            </tr>
            </thead>
            <tbody>
            @foreach($requisition_details as $key => $requisition_detail)
                <tr class="align-middle">
                    <td>{{ ++$key }}</td>
                    <td nowrap>{{ $requisition_detail->product_name->name }}</td>
                    <td>{{ $requisition_detail->product_name->description }}</td>
                    <td>{!! getStatus(($requisition_detail->remarks == 'Cancelled') ? 3 : $requisition->status) !!}</td>
                    <td>{{ $requisition_detail->req_quantity }}</td>
                    <td>{{ $requisition_detail->issued_quantity }}</td>
                    <td>{{ $requisition_detail->remarks }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div> <!-- /.card-body -->
</div> <!-- /.card -->


{{-- Buttons --}}
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>


