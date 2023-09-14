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
                <h3 class="page-title">Course Weekly Content</h3>
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
        <form name="course_content_form" method="post" action="{{url('courseContent')}}">
            @csrf
        <div class="card">
            <div class="card-body">
                <div class="m-b-10">
                    <div class="m-t-10 div-border-rad">
                        <div class="margin-10">
                            <div class="row">
                                <div class="form-group col-sm-4">
                                {!! Form::label('course', 'Course:') !!}
                                    @if(count($courses)!=0)
                                        {!! Form::select('course_id', $courses, null, ['id' => 'course_id', 'class' => 'form-control select2-multiple', 'placeholder' => '------ Select Course ------']) !!}
                                    @else
                                        @include('includes/not_found')
                                    @endif
                                </div>
                                <div class="form-group col-sm-4"> 
                                {!! Form::label('semester','Semester')!!}
                                {!! Form::select('semesters', config('constants.semesters_years'), null, ['id' => 'semester_id', 'onchange' => 'onSemesterSelect()', 'class' => 'form-control select2-multiple', 'placeholder' => '--- Semester/Year No ---']) !!}
                                </div>
                                <div class="form-group col-sm-4"> 
                                {!! Form::label('subject','Subject')!!}
                                <div id="course_semester_subjects">
                                
                                </div>
                                </div>
                                <div class="form-group col-sm-4"> 
                                {!! Form::label('lecture days','Lecture Days')!!}
                                {!! Form::text('lecture_days',null,['id' => 'lecture_days_id','class' => 'form-control','placeholder' => '----- Enter Lecture Days -----'])!!}
                                </div>
                             </div>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
        <div class="card" style="margin-top:3%;">
            <div class="card-body">
                <div class="m-b-10">
                    <div class="m-t-10 div-border-rad">
                        <div class="margin-10">
                            <div class="row">
                                <div class="col-sm-12 text-center"> 
                                    <h4>Course Completion Report</h4>
                                </div>
                                <div class="col-sm-12"> 
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                            <th scope="col">Weeks</th>
                                            <th scope="col">Planned Contents</th>
                                            <th scope="col">Planned Activities</th>
                                            <th scope="col">Date of Lecture Held</th>
                                            <th scope="col">Covered/Completed</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @for($i=1;$i<=18;$i++)
                                            <tr>
                                                <td>
                                                    <select name="week_{{$i}}" id="week_id" class="form-control">
                                                    <option value="">--- Select Week ---</option>
                                                        @for($index=1;$index<=18;$index++)
                                                        <option value="{{$index}}">week {{$index}}</option>
                                                        @endfor
                                                    </select>
                                                </td>
                                                <td>
                                                {!! Form::text('planned_contents'.$i,null,['id' => 'planned_content_id','class' => 'form-control','placeholder' => 'Enter Content'])!!}
                                                </td>
                                                <td>
                                                {!! Form::text('planned_activities'.$i,null,['id' => 'planned_activities_id','class' => 'form-control','placeholder' => 'Enter Activities'])!!}
                                                </td>
                                                <td>
                                                {!! Form::date('date'.$i,null,['id' => 'date_id','class' => 'form-control'])!!}
                                                </td>
                                                <td>
                                                {!!Form::text('status'.$i,null,['id' => 'status_id','class' => 'form-control','placeholder' => 'Enter Status'])!!}
                                                </td>
                                            </tr>
                                        @endfor                                            
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-sm-12 text-right">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                             </div>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
        </form>
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
<script src="{{ asset('js/studyscheme/course_content.js') }}"></script>
@include('includes/footer_end')