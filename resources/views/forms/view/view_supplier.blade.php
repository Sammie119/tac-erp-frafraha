{{-- {{ $supplier }}--}}
<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">Details of {{ $supplier->supplier_name }}</h3>
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
                    <td>{{__('Supplier\'s name')}}</td>
                    <td>{{ $supplier->supplier_name }}</td>
                    <td></td>
                </tr>
                <tr class="align-middle">
                    <td>2.</td>
                    <td>{{__('Supplier Address')}}</td>
                    <td>{{ $supplier->supplier_address }}</td>
                    <td></td>
                </tr>
                <tr class="align-middle">
                    <td>3.</td>
                    <td>{{__('Supplier Phone')}}</td>
                    <td>{{ $supplier->supplier_phone }}</td>
                    <td></td>
                </tr>
                <tr class="align-middle">
                    <td>4.</td>
                    <td>{{__('Supplier Email')}}</td>
                    <td>{{ $supplier->supplier_email }}</td>
                    <td></td>
                </tr>
                <tr class="align-middle">
                    <td>5.</td>
                    <td>{{__('Contact Person\'s Name')}}</td>
                    <td>{{ $supplier->contact_name }}</td>
                    <td></td>
                </tr>
                <tr class="align-middle">
                    <td>6.</td>
                    <td>{{__('Contact Person\'s Phone')}}</td>
                    <td>{{ $supplier->contact_phone }}</td>
                    <td></td>
                </tr>
                <tr class="align-middle">
                    <td>7.</td>
                    <td>{{__('Contact Person\'s Email')}}</td>
                    <td>{{ $supplier->contact_email }}</td>
                    <td></td>
                </tr>
                <tr class="align-middle">
                    <td>8.</td>
                    <td>{{__('Supplier\'s TIN Number')}}</td>
                    <td>{{ $supplier->supplier_tin_number }}</td>
                    <td></td>
                </tr>
                <tr class="align-middle">
                    <td>10.</td>
                    <td>{{__('Created By')}}</td>
                    <td>{{ get_logged_staff_name($supplier->updated_by_id) }}</td>
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


