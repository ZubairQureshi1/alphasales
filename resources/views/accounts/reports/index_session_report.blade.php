@include('includes/header_start')
    <link href="{{ asset('assets/plugins/select2/css/select2.css') }}" rel="stylesheet" type="text/css" />
     <!-- DataTables -->
    <link href="../assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="../assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@include('includes/header_end')

             <!-- Page title -->
                            <ul class="list-inline menu-left mb-0">
                                <li class="list-inline-item">
                                    <button type="button" class="button-menu-mobile open-left waves-effect">
                                        <i class="ion-navicon"></i>
                                    </button>
                                </li>
                                <li class="hide-phone list-inline-item app-search">
                                    <h3 class="page-title">Session Report</h3>
                                </li>
                            </ul>
                        @include('alertify::alertify')

                            <div class="clearfix"></div>
                        </nav>

                    </div>
                    <!-- Top Bar End -->

                    <!-- ==================
                         PAGE CONTENT START
                         ================== -->

                    <div class="page-content-wrapper">

                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label>
                                                        Sessions:<span class="text-danger">*</span>
                                                    </label>
                                                    <div>
                                                        {!! Form::select('session_id', App\Models\Session::get()->pluck('session_name', 'id'), null, ['id' => 'session_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Session ---']) !!}
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label>
                                                        Course:<span class="text-danger">*</span>
                                                    </label>
                                                    <div>
                                                        {!! Form::select('course_id', App\Models\Course::pluck('name', 'id'), null, ['id' => 'course_id', 'class' => 'form-control select2-multiple', 'onchange' => 'onCourseSelect()', 'placeholder' => '--- Select Course ---']) !!}
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label>
                                                        Part:<span class="text-danger">*</span>
                                                    </label>
                                                    <div>
                                                        {!! Form::select('semester_year_id', config('constants.semesters_years'), null, ['id' => 'semester_year_id', 'class' => 'form-control select2-multiple', 'placeholder' => '--- Select Part ---']) !!}
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label>
                                                        Student Category:
                                                    </label>
                                                    <div>
                                                        {!! Form::select('student_category_id', config('constants.student_categories'), null, ['id' => 'student_category_id', 'class' => 'form-control select2-multiple', 'placeholder' => '--- Select Category ---']) !!}
                                                    </div>
                                                </div>
                                                <div id="section_select">
                                                    
                                                </div>
                                                <div class="col-md-2">
                                                    <label>
                                                        Start Month:
                                                    </label>
                                                    <div>
                                                        <input type="month" name="start_month" id="start_month" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label>
                                                        End Month:
                                                    </label>
                                                    <div>
                                                        <input type="month" name="end_month" id="end_month" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-md-2 element-flex-end">
                                                    <button onclick="filterReport()" class="btn btn-success"><i  id="generate_report" class="ion-loop"></i> Filter</button>
                                                </div>
                                            </div>
                                            <div class="row" id="report_loading" hidden style="margin-left: 2px;
                                                background: #b1b1b1;
                                                padding: 10px;
                                                color: white;
                                                margin-top: 5px;
                                                margin-right: 2px;">
                                                <div class="col-4"></div>
                                                <div class="col-4" style="text-align:  center;">
                                                    <a><i class="ion-loop fa-spin"></i> Please Wait!</a>
                                                </div>
                                                <div class="col-4"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <div id="report_div">
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                
                            </div>

                        </div>
                    </div>
@include('includes/footer_start')
    @include('alertify::alertify')

    <!-- Required datatable js -->
    <script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="../assets/plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="../assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
    <script src="../assets/plugins/datatables/jszip.min.js"></script>
    <script src="../assets/plugins/datatables/pdfmake.min.js"></script>
    <script src="../assets/plugins/datatables/vfs_fonts.js"></script>
    <script src="../assets/plugins/datatables/buttons.html5.min.js"></script>
    <script src="../assets/plugins/datatables/buttons.print.min.js"></script>
    <script src="../assets/plugins/datatables/buttons.colVis.min.js"></script>
    <!-- Responsive examples -->
    <script src="../assets/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="../assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

    <!-- Datatable init js -->
    <script src="../assets/pages/datatables.init.js"></script>

    <script type="text/javascript" src="{{asset('js/accounts/sessionReport.js')}}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.js')  }}"></script>

@include('includes/footer_end') 
