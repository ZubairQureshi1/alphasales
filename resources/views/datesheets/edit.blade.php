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
                <h3 class="page-title">Edit Date-Sheet</h3>
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
<form name="userform" method="post" action="../update/{{ $datesheets['id'] }}">
@csrf
<div class="row">
<div class="form-group col-md-3">
        {!! Form::label('examtype', 'Exam Type:') !!}
        {!!  Form::select('exam_type_id', $examtypes, $datesheets->exam_type_id, ['id' => 'exam_type_id', 'class' => 'form-control select2-multiple', 'placeholder' => '------ Select ExamType ------']) !!}
    </div>
    <div class="form-group col-md-3">
        {!! Form::label('session', 'Session:') !!}
        {!! Form::select('session_id', $sessions, $datesheets->session_id, ['id' => 'session_id', 'class' => 'form-control select2-multiple', 'placeholder' => '------ Select Session ------']) !!}
    </div>
    <div class="form-group col-md-3">
                            {!! Form::label('courses', 'Courses:') !!}
                <select name="course_id[]" onChange="onCourseSelect()" id="course_id" multiple="multiple"  class="form-control select2 select2-multiple">
            @foreach($courses as $course)
                @foreach($date_sheet_courses as $date_sheet_course)
                    @if($course->id == $date_sheet_course['course_id'])
                        <option value="{{$course->id}}" selected>
                            {{$course->name}}
                        </option>
                        @else
                            <option value="{{$course->id}}">
                            {{$course->name}}
                            </option>
                    @endif
                @endforeach
            @endforeach
            </select>
                            <!-- {!! Form::label('courses', 'Courses:') !!}
                            @if(count($courses)!=0)
                                {!! Form::select('course_id', $courses, $datesheets->course_id , ['id' => 'course_id', 'onChange' => 'onCourseSelect()', 'class' => 'form-control select2-multiple', 'placeholder' => '--- Select Course ---']) !!}
                            @else
                                @include('includes/not_found')
                            @endif -->

    </div>
    <div class="form-group col-md-3">
    {!! Form::label('books', 'Books:') !!}<br>
    {!! Form::button('Selected Books', ['id' => 'viewbooks' , 'class' => 'btn btn-dark btn-block']) !!}
    </div> 
    <div class="form-group col-md-3">
    {!! Form::label('sections', 'Sections:') !!}
        <select name="sections[]" multiple="multiple"  class="form-control select2 select2-multiple">
            @foreach($sections as $index => $section)
                @foreach($date_sheet_sections as $date_sheet_section)
                    @if($index == $date_sheet_section['section_id'])
                        <option value="{{$index}}" selected>
                                        {{$section}}
                                        </option>
                                         @else
                                    <option value="{{$index}}">
                                {{$section}}
                            </option>
                        @endif
                @endforeach
            @endforeach
        </select>
    </div>
</div>
</div>
</div>
</div>
<div class="row">
    <div class="col-md-4">
        {!! Form::submit('Update Date-Sheet', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
<div class="row" style="padding-top:3%;"> 
    <div class="col-md-12">
    <div id="course_subject" class="form-group" style="display:none;">
                @foreach($date_sheet_books as $subject)
                                    <div class="row">
                                        <div class="col-sm-2">
                                            {{$subject->subject_name}}
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="date"  name = "date[]"  class="form-control" value="{{$subject->date_formated}}">      
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="time" name="start_time[]" class="form-control" value="{{$subject->start_time_formated}}">         
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="time" name="end_time[]" class="form-control" value="{{$subject->end_time_formated}}">
                                        </div>
                                        <div class="col-sm-3">
                                            <textarea  name="syllabus[]" class="form-control">{{$subject->syllabus}}</textarea>
                                        </div>
                                        @if($subject->isChecked)
                                        <div class="col-sm-1">
                                                <input name="subject[]" type="checkbox" id="{{ $subject['subject_id'] }}" switch="bool" checked value="{{ $subject['subject_id'] }}"/>
                                                    <label for="{{ $subject['subject_id'] }}" data-on-label="Yes" data-off-label="No"></label>
                                        </div>
                                        @else
                                        <div class="col-sm-1">
                                                <input name="subject[]" type="checkbox" id="{{ $subject['subject_id'] }}" switch="bool"  value="{{ $subject['subject_id'] }}"/>
                                                    <label for="{{ $subject['subject_id'] }}" data-on-label="Yes" data-off-label="No"></label>
                                        </div>    
                                        @endif
                                    </div>
                                    @endforeach
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
    <script src="{{ asset('js/datesheet/datesheet_edit.js')  }}"></script>

@include('includes/footer_end')