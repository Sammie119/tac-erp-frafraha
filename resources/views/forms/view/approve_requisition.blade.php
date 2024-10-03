{{-- {{ $requisition->req_id }}--}}
<form method="POST" action="approve_requisition">
    @csrf
    @empty(!$requisition_details[0]->remarks)
        <input type="hidden" name="update" value="update">
    @endempty
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">Approve the Request of {{ get_logged_staff_name($requisition->createdBy->staff_id) }}</h3>
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
                    <input type="hidden" name="req_id" value="{{ $requisition->req_id }}">
                    @foreach($requisition_details as $key => $requisition_detail)
                        <input type="hidden" name="id[]" value="{{ $requisition_detail->id }}">
                        <tr class="align-middle">
                            <td>{{ ++$key }}</td>
                            <td nowrap>{{ $requisition_detail->product_name->name }}</td>
                            <td>{{ $requisition_detail->product_name->description }}</td>
                            <td>{!! getStatus(($requisition_detail->remarks == 'Cancelled') ? 3 : $requisition->status) !!}</td>
                            <td>{{ $requisition_detail->req_quantity }}</td>
                            <td><input type="number" step="1" min="0" id="issued_quantity" name="issued_quantity[]" value="{{ empty(!$requisition_detail->remarks) ? $requisition_detail->issued_quantity : "" }}" class="form-control" required></td>
                            <td>
                                <select id="remarks" name="remarks[]" class="form-control" required>
                                    <option selected disabled>--Remarks--</option>
                                    <option @if(empty(!$requisition_detail->remarks) && $requisition_detail->remarks == 'Approved') selected @endif>Approved</option>
                                    <option @if(empty(!$requisition_detail->remarks) && $requisition_detail->remarks == 'Cancelled') selected @endif>Cancelled</option>
                                </select>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div> <!-- /.card-body -->
    </div> <!-- /.card -->


    {{-- Buttons --}}
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>



