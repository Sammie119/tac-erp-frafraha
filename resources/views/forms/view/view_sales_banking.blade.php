{{-- {{ $supplier }}--}}
<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">Details of Banking Sales from {{ $sales->start_date }} to {{ $sales->end_date }}</h3>
    </div> <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table">
            <thead>
                <tr>
                    <th>Amount Received</th>
                    <th>Amount Banked</th>
                    <th>Status</th>
                </tr>
                <tr>
                    <td>{{ $sales->amount_received }}</td>
                    <td>{{ $sales->amount_banked }}</td>
                    <td>{!! getStatus($sales->status, 1) !!}</td>
                </tr>
            </thead>
            <tbody>
                <tr class="align-middle">
                    <td>Remark</td>
                    <td colspan="2">{{ $sales->remarks }}</td>
                </tr>

                <tr class="align-middle">
                    <td>Entered By</td>
                    <td colspan="2">{{ get_logged_staff_name($sales->updated_by_id) }}</td>
                </tr>
            </tbody>
        </table>
        <br>
        <img src="/storage/{{ $sales->image_url }}" alt="Image" width="100%">
    </div> <!-- /.card-body -->
</div> <!-- /.card -->


{{-- Buttons --}}
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>


