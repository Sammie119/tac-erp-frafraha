{{-- {{ dd($setup) }}--}}
<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">Details of {{ $setup->display_name }}</h3>
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
                    <td>{{__('Name')}}</td>
                    <td>{{ $setup->display_name }}</td>
                    <td></td>
                </tr>
                <tr class="align-middle">
                    <td>2.</td>
                    <td>{{__('Address')}}</td>
                    <td>{{ $setup->address }}</td>
                    <td></td>
                </tr>
                <tr class="align-middle">
                    <td>3.</td>
                    <td>{{__('Phone One')}}</td>
                    <td>{{ $setup->phone1 }}</td>
                    <td></td>
                </tr>
                <tr class="align-middle">
                    <td>4.</td>
                    <td>{{__('Phone Two')}}</td>
                    <td>{{ $setup->phone2 }}</td>
                    <td></td>
                </tr>
                <tr class="align-middle">
                    <td>5.</td>
                    <td>{{__('Email')}}</td>
                    <td>{{ $setup->email }}</td>
                    <td></td>
                </tr>
                <tr class="align-middle">
                    <td>6.</td>
                    <td>{{__('Facebook')}}</td>
                    <td>{{ $setup->facebook }}</td>
                    <td></td>
                </tr>
                <tr class="align-middle">
                    <td>7.</td>
                    <td>{{__('Division')}}</td>
                    <td>{{ $setup->division_name->name  }}</td>
                    <td></td>
                </tr>
                <tr class="align-middle">
                    <td>8.</td>
                    <td>{{__('NHIL (%)')}}</td>
                    <td>{{ $setup->nhil }}</td>
                    <td></td>
                </tr>
                <tr class="align-middle">
                    <td>9.</td>
                    <td>{{__('GEHL (%)')}}</td>
                    <td>{{ $setup->gehl }}</td>
                    <td></td>
                </tr>
                <tr class="align-middle">
                    <td>10.</td>
                    <td>{{__('COVID 19 (%)')}}</td>
                    <td>{{ $setup->covid19 }}</td>
                    <td></td>
                </tr>
                <tr class="align-middle">
                    <td>11.</td>
                    <td>{{__('Logo')}}</td>
                    <td colspan="5">
                        <img src="/storage/{{ $setup->text_logo }}" alt="logo" width="150">
                    </td>
                </tr>
            </tbody>
        </table>
    </div> <!-- /.card-body -->
</div> <!-- /.card -->


    {{-- Buttons --}}
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>


