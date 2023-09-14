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
                <h3 class="page-title">Create Date-Sheet</h3>
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
<!-- Name Field -->
<!-- Student Personel Information: -->
<div class="m-b-10">
<strong> <i class="fa fa-table" aria-hidden="true"></i> Student-DateSheet:</strong>
<div class="m-t-10 div-border-rad">
<div class="margin-10">
{!! Form::open(['route' => 'datesheet.store']) !!}
<div class="row">

<div class="form-group col-sm-4">
        {!! Form::label('examtype', 'Exam Type:') !!}
        {!! Form::select('exam_type_id', $examtypes, null, ['id' => 'exam_type_id', 'class' => 'form-control select2-multiple', 'placeholder' => '------ Select ExamType ------']) !!}
    </div>
    <div class="form-group col-sm-4">
        {!! Form::label('session', 'Session:') !!}
        {!! Form::select('session_id', $sessions, null, ['id' => 'session_id', 'class' => 'form-control select2-multiple', 'placeholder' => '------ Select Session ------']) !!}
    </div>
    <div class="form-group col-sm-4">
                            <strong>Courses:</strong>
                            @if(count($courses)!=0)
                                {!! Form::select('course_id[]', $courses, null, ['id' => 'course_id', 'onChange' => 'onCourseSelect()', 'class' => 'form-control select2 select2-multiple', 'multiple', 'data-placeholder' => '------ Select Course ------']) !!}
                            @else
                                @include('includes/not_found')
                            @endif
 
                        </div>  
    <div class="form-group col-sm-4">
        {!! Form::label('section', 'Section:') !!}
        {!! Form::select('sections[]', $sections, null, ['id' => 'sections', 'onChange' => 'onSectionSelect()','class' => 'form-control select2 select2-multiple reset_section', 'multiple', 'data-placeholder' => '------ Select Section ------']) !!}
    </div>
    <div class="form-group col-sm-4">
        {!! Form::label('Rooms', 'Rooms:') !!}
        {!! Form::select('rooms[]', $rooms, null, ['id' => 'rooms', 'class' => 'form-control select2 select2-multiple reset_section', 'multiple']) !!}
    </div>
    <div class="form-group col-sm-4">
        {!! Form::label('student_quantity', 'Student Quantity:') !!}
        {!! Form::number('student_quantity', null, ['id' => 'student_quantity','class' => 'form-control reset_section','disabled' => 'true']) !!}
    </div>
</div>
</div>
</div>
<div class="row" style="padding-top:2%;">
    <div class="col-md-4">
        {!! Form::reset('Reset', ['id'=>'SectionResetbtn','class' => 'btn btn-primary'])!!}
        {!! Form::button('Save', ['onclick' => 'saveDatesheet()','class' => 'btn btn-primary']) !!}
    </div>
</div>
<div class="row" style="padding-top:5%;">
    <div class="col-md-12">
    <div id="course_subject" class="form-group">
            
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
        var room_details = '{{json_encode($rooms_data)}}';
        var rooms_array = JSON.parse(room_details.replace(/&quot;/g,'"'));
    </script>
    <script type="text/javascript">
        $('.select2').select2();
    </script>
    <script src="{{ asset('js/datesheet/datesheet.js')  }}"></script>

@include('includes/footer_end')