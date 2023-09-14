@include('includes/header_start')

        <!-- DataTables -->
        <link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/custom/admission.css') }}" rel="stylesheet" type="text/css" />

@include('includes/header_end')

             <!-- Page title -->
        <ul class="list-inline menu-left mb-0">
            <li class="list-inline-item">
                <button type="button" class="button-menu-mobile open-left waves-effect">
                    <i class="ion-navicon"></i>
                </button>
            </li>
            <li class="hide-phone list-inline-item app-search">
                <h3 class="page-title">Lecture Attendance View</h3>
            </li>
        </ul>

        <div class="clearfix"></div>
    </nav>

</div>
<!-- Top Bar End -->

<!-- ==================
     PAGE CONTENT START
     ================== -->

<div class="page-content-wrapper" id="sessions">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="m-b-10">
                    <div class="m-t-10 div-border-rad">
                        <div class="margin-10">
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    {!! Form::label('course', 'Course:') !!}
                                    @if(count($courses)!=0)
                                        {!! Form::select('course_id', $courses, null, ['id' => 'course_id', 'onchange' => 'onCourseSelect()', 'class' => 'form-control select2-multiple', 'placeholder' => '------ Select Course ------']) !!}
                                    @else
                                        @include('includes/not_found')
                                    @endif
                                    <label id="course_validation" style="color:red;"></label>
                                </div>
                                <div class="form-group col-sm-4">
                                    {!! Form::label('part', 'Part:') !!}
                                    <select name="part" id="part_id" class="form-control">
                                        <option value="" disabled selected>------ Select Part ------</option>
                                        <option value="1">Part-I</option>
                                        <option value="2">Part-II</option>
                                    </select>
                                    <label id="part_validation" style="color:red;"></label>
                                </div>
                                <div class="form-group col-sm-4">
                                    {!! Form::label('session', 'Session:') !!}
                                    {!! Form::select('session_id', $sessions, null, ['id' => 'session_id', 'class' => 'form-control select2-multiple', 'placeholder' => '------ Select Session ------']) !!}
                                    <label id="session_validation" style="color:red;"></label>
                                </div>
                                <div class="form-group col-sm-4">
                                    {!! Form::label('date', 'Date:') !!}
                                    {!! Form::date('date', null, ['id' => 'date', 'class' => 'form-control']) !!}
                                    <label id="date_validation" style="color:red;"></label>
                                </div>
                                <div class="form-group col-sm-4">
                                    {!! Form::label('subject', 'Subject:') !!}
                                    <div id="subjects">
  
                                    </div>
                                    <label id="subject_validation" style="color:red;"></label>  
                                </div> 
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12 text-center">
                                    <button class="btn btn-success" onclick="FilterLectureAttendance()"> <i class="fa fa-filter" aria-hidden="true"></i> Filter Attendance</button>
                                </div>
                            </div>
                        </div>          
                    </div>
                </div>
            </div>
        </div>
        <div class="card" style="margin-top:2%;">
            <div class="card-body">
                <div class="m-b-10">
                    <div class="m-t-10 div-border-rad">
                        <div class="margin-10">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                    <th scope="col">Student</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Attendance Status</th>
                                    <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="lecture_attendance_list">

                                </tbody>
                            </table>
                        </div>          
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('includes/footer_start')

<!-- Required datatable js -->
    <script src="{{ asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')  }}"></script>
<!-- Datatable init js -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsleyjs/parsley.min.js')  }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')  }}"></script>
    <script src="{{ asset('assets/plugins/RWD-Table-Patterns/dist/js/rwd-table.min.js')  }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('form').parsley();
        });
        var template = '{{json_encode(config('constants'))}}';
        var constants = JSON.parse(template.replace(/&quot;/g,'"'));

    </script>
    <script type="text/javascript">
        $('.select2').select2();
    </script>
<script src="{{ asset('js/attendance/lecture_attendace_view.js') }}"></script>
@include('includes/footer_end')