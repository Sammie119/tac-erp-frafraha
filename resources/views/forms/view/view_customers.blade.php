{{-- {{ $customer }}--}}
<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">Details of {{ $customer->name }}</h3>
    </div> <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table">
            <thead>
            <tr>
                <th style="width: 20px">#</th>
                <th>Item</th>
                <th>Information</th>
                <th style="width: 40px"></th>
            </tr>
            </thead>
            <tbody>
            <tr class="align-middle">
                <td>1.</td>
                <td>{{__('Customer Name')}}</td>
                <td>{{ $customer->name }}</td>
                <td></td>
            </tr>
            <tr class="align-middle">
                <td>2.</td>
                <td>{{__('Customer Address')}}</td>
                <td>{{ $customer->address }}</td>
                <td></td>
            </tr>
            <tr class="align-middle">
                <td>3.</td>
                <td>{{__('Customer Phone')}}</td>
                <td>{{ $customer->phone }}</td>
                <td></td>
            </tr>
            <tr class="align-middle">
                <td>4.</td>
                <td>{{__('Customer Email')}}</td>
                <td>{{ $customer->email }}</td>
                <td></td>
            </tr>
            <tr class="align-middle">
                <td>5.</td>
                <td>{{__('Contact Location')}}</td>
                <td>{{ $customer->location }}</td>
                <td></td>
            </tr>
            <tr class="align-middle">
                <td>10.</td>
                <td>{{__('Created By')}}</td>
                <td>{{ get_logged_staff_name($customer->updated_by_id) }}</td>
                <td></td>
            </tr>
            </tbody>
        </table>
    </div> <!-- /.card-body -->
</div> <!-- /.card -->


{{-- Buttons --}}
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>


