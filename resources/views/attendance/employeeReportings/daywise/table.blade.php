<div class="table-rep-plugin">
    <div class="table-responsive b-0">
        <table id="attendances_daywise_reporting_table" isDefault="true" class="table table-bordered table-striped"  class="tablet" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Employee Code</th>
                    <th>Employee Name</th>
                    <th>Checkin Time</th>
                    <th>Checkout Time</th>
                    <th>Working Hours</th>
                    <th>Time Slot</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="attendances_daywise_reporting_table_body" >
                @foreach($late_attendances as $late_attendance)
                        <tr>
                            <td>{{ $late_attendance->date }}</td>
                            <td>{{ $late_attendance->emp_code }}</td>
                            <td>{{ $late_attendance->name }}</td>
                            <td>{{ $late_attendance->check_in_time }}</td>
                            <td>{{ $late_attendance->check_out_time }}</td>
                            <td>{{ $late_attendance->working_hours }}</td>
                            <td>{{ $late_attendance->time_slot_name }}</td>
                            <td>{{ $late_attendance->status }}</td>
                        </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@include('layouts/loading')
