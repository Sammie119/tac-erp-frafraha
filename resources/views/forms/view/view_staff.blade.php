{{-- {{ $staff }}--}}
<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">Details of {{ $staff->full_name }}</h3>
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
                    <td>{{__('Staff ID')}}</td>
                    <td>{{ $staff->staff_number }}</td>
                    <td></td>
                </tr>
                <tr class="align-middle">
                    <td>2.</td>
                    <td>{{__('Full Name')}}</td>
                    <td>{{ $staff->full_name }}</td>
                    <td></td>
                </tr>
                <tr class="align-middle">
                    <td>3.</td>
                    <td>{{__('Gender')}}</td>
                    <td>{{ $staff->gender_name }}</td>
                    <td></td>
                </tr>
                <tr class="align-middle">
                    <td>4.</td>
                    <td>{{__('Date of Birth')}}</td>
                    <td>{{ $staff->date_of_birth }} (Age: {{ $staff->age }})</td>
                    <td></td>
                </tr>
                <tr class="align-middle">
                    <td>5.</td>
                    <td>{{__('Mobile Number')}}</td>
                    <td>{{ $staff->phone }}</td>
                    <td></td>
                </tr>
                <tr class="align-middle">
                    <td>6.</td>
                    <td>{{__('Email')}}</td>
                    <td>{{ $staff->email }}</td>
                    <td></td>
                </tr>
                <tr class="align-middle">
                    <td>7.</td>
                    <td>{{__('Address')}}</td>
                    <td>{{ $staff->address }}</td>
                    <td></td>
                </tr>
                <tr class="align-middle">
                    <td>8.</td>
                    <td>{{__('Position')}}</td>
                    <td>{{ $staff->position_name }}</td>
                    <td></td>
                </tr>
                <tr class="align-middle">
                    <td>9.</td>
                    <td>{{__('Banker')}}</td>
                    <td>{{ $staff->banker }}</td>
                    <td></td>
                </tr>
                <tr class="align-middle">
                    <td>10.</td>
                    <td>{{__('Bank Account')}}</td>
                    <td>{{ $staff->bank_account }}</td>
                    <td></td>
                </tr>
                <tr class="align-middle">
                    <td>11.</td>
                    <td>{{__('Bank Branch')}}</td>
                    <td>{{ $staff->bank_branch }}</td>
                    <td></td>
                </tr>
                <tr class="align-middle">
                    <td>12.</td>
                    <td>{{__('Bank Sort Code')}}</td>
                    <td>{{ $staff->bank_sort_code }}</td>
                    <td></td>
                </tr>
                <tr class="align-middle">
                    <td>13.</td>
                    <td>{{__('Ghana Card')}}</td>
                    <td>{{ $staff->ghana_card }}</td>
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


