{{-- {{ $financial }}--}}
<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">Details of {{ $financial->transaction_id }}</h3>
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
                <td>{{__('Transaction ID')}}</td>
                <td>{{ $financial->transaction_id }}</td>
                <td></td>
            </tr>
            <tr class="align-middle">
                <td>2.</td>
                <td>{{__('Transaction')}}</td>
                <td>{{ $financial->name }}</td>
                <td></td>
            </tr>
            <tr class="align-middle">
                <td>3.</td>
                <td>{{__('Description')}}</td>
                <td>{{ $financial->description }}</td>
                <td></td>
            </tr>
            <tr class="align-middle">
                <td>4.</td>
                <td>{{__('Mode')}}</td>
                <td>{{ $financial->mode_name->name }}</td>
                <td></td>
            </tr>
            <tr class="align-middle">
                <td>5.</td>
                <td>{{__('Type')}}</td>
                <td>{{ $financial->type_name->name }}</td>
                <td></td>
            </tr>
            <tr class="align-middle">
                <td>6.</td>
                <td>{{__('Source')}}</td>
                <td>{{ $financial->source_name->name }}</td>
                <td></td>
            </tr>
            <tr class="align-middle">
                <td>7.</td>
                <td>{{__('Amount')}}</td>
                <td>{{ $financial->amount }}</td>
                <td></td>
            </tr>
            <tr class="align-middle">
                <td>8.</td>
                <td>{{__('Unit')}}</td>
                <td>{{ $financial->division_name->name }}</td>
                <td></td>
            </tr>
            <tr class="align-middle">
                <td>9.</td>
                <td>{{__('Date')}}</td>
                <td>{{ $financial->transaction_date }}</td>
                <td></td>
            </tr>
            <tr class="align-middle">
                <td>10.</td>
                <td>{{__('Paid By')}}</td>
                <td>{{ $financial->amount_paid_by }}</td>
                <td></td>
            </tr>
            <tr class="align-middle">
                <td>11.</td>
                <td>{{__('Created By')}}</td>
                <td>{{ get_logged_staff_name($financial->created_by->staff_id) }}</td>
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


