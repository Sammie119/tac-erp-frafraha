<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">Attendance for {{ $att_details->first()->month }} {{ $att_details->first()->year }}</h3>
    </div> <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Staff Name</th>
                    <th>Date</th>
                    <th>Checkin</th>
                    <th>Checkout</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($att_details as $key => $attendance)
                    <tr class="align-middle">
                        <td>{{ ++$key }}</td>
                        <td>{{ $attendance->staff }}</td>
                        <td>{{ $attendance->attendance_date }}</td>
                        <td>{{ getDateFormat($attendance->checkin_time) }}</td>
                        <td>{{ getDateFormat($attendance->departure_time) }}</td>
                    </tr>
                @empty
                    <tr class="align-middle">
                        <td colspan="10">No Data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div> <!-- /.card-body -->
</div> <!-- /.card -->
