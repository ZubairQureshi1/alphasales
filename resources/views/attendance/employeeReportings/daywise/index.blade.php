@include('includes/header_start')

        <!-- DataTables -->
        <link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

@include('includes/header_end')

             <!-- Page title -->
                            <ul class="list-inline menu-left mb-0">
                                <li class="list-inline-item">
                                    <button type="button" class="button-menu-mobile open-left waves-effect">
                                        <i class="ion-navicon"></i>
                                    </button>
                                </li>
                                <li class="hide-phone list-inline-item app-search">
                                    <h3 class="page-title">Day-Wise Overall Reporting</h3>
                                </li>
                            </ul>
                        @include('alertify::alertify')

                            <div class="clearfix"></div>
                        </nav>

                    </div>

                    <div class="page-content-wrapper">

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-3 btn-group" role="group">
                                    <button type="button" id="date_prev" onclick="getPreviousDayWiseAttendances()" class="btn btn-dark margin-left-5 m-b-10 m-t-15-negative">&#8249;</button>
                                    <input class="form-control margin-left-5 m-b-10 m-t-15-negative" disabled="disabled" id="date_filtered_for" name="date_filtered_for" value="{{ \date('Y-m-d') }}" type="date"/>
                                    <button type="button"  id="date_next" disabled="disabled" onclick="getNextDayWiseAttendances()" class="btn btn-dark margin-left-5 m-b-10 m-t-15-negative">&#8250;</button>
                                </div> 
                                <div class="col-1">
                                </div> 
                                <div class="col-4"></div>
                                <div class="col-4">
                                    <button onclick="exportDayWiseReportingToExcel()" id="emp_attendance_export" class="btn btn-info waves-effect pull-right margin-left-5 m-b-10 m-t-15-negative">
                                         <i class="mdi mdi-file-excel"></i> Export To Excel
                                    </button>
                                </div> 
                            </div>
                            
                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            @include('attendance/employeeReportings/daywise/table')
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                            @include('includes/footer_start')

        <!-- Required datatable js -->
        <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
        <script src="assets/plugins/datatables/jszip.min.js"></script>
        <script src="assets/plugins/datatables/pdfmake.min.js"></script>
        <script src="assets/plugins/datatables/vfs_fonts.js"></script>
        <script src="assets/plugins/datatables/buttons.html5.min.js"></script>
        <script src="assets/plugins/datatables/buttons.print.min.js"></script>
        <script src="assets/plugins/datatables/buttons.colVis.min.js"></script>
        <!-- Responsive examples -->
        <script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="assets/plugins/datatables/responsive.bootstrap4.min.js"></script>
        <script src="{{ asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')  }}"></script>
        <script src="assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
<script type="text/javascript">
        $('.select2').select2();
    </script>
        <!-- Datatable init js -->
        <script src="assets/pages/datatables.init.js"></script>
        <script src="{{ asset('js/attendance/daywise/daywise.js')  }}"></script>

@include('includes/footer_end')