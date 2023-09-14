<div class="table-rep-plugin">
    <a href="" class="btn btn-success btn-sm mb-2" id="emp_attendance_export" hidden>
        <i class="fa fa-file fa-fw"></i> | Export User Attendance
    </a>
    <div class="table-responsive b-0">
        <table hidden id="single_emp_attendances_reporting_table" isDefault="true" class="table table-bordered table-striped tablet table-hover" cellspacing="0">
            <thead class="thead-dark">
                <tr>
                    <th>Date</th>
                    <th>Employee Code</th>
                    <th>Employee Name</th>
                    <th>Job Title</th>
                    <th>Mobile No</th>
                    <th>Checkin Time</th>
                    <th>Checkout Time</th>
                    <th>Working Hours</th>
                    <th>Time Slot</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>
            <tbody id="single_emp_attendances_reporting_body">
                
            </tbody>
        </table>

        <table hidden id="overall_attendances_reporting_table" isDefault="true" class="table table-bordered table-striped table-hover tablet" cellspacing="0">
            <thead class="thead-dark">
                <tr>
                    <th>Month</th>
                    <th>Employee Name</th>
                    <th>Employee Code</th>
                    <th>Job Title</th>
                    <th>Department</th>
                    <th>Mobile No</th>
                    <th style="width: 20%;">Absent Dates</th>
                    <th>Late Arrivals</th>
                    <th>Absents</th>
                    <th>Missing Checkouts</th>
                </tr>
            </thead>
            <tbody id="overall_attendances_reporting_body">
                
            </tbody>
        </table>
    </div>
</div>
@include('layouts/loading')
