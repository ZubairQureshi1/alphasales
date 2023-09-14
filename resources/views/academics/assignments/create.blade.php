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
                <h3 class="page-title">Create Assignment</h3>
            </li>
        </ul>

        <div class="clearfix"></div>
    </nav>

</div>
<!-- Top Bar End -->

<!-- ==================
     PAGE CONTENT START
     ================== -->
     <!-- <strong> <i class="fa fa-table" aria-hidden="true"></i> Student-Assignment:</strong> -->
<div class="page-content-wrapper" id="sessions">
    <div class="container-fluid">
        <div class="m-b-10">
            <div class="m-t-10 div-border-rad">
                <div class="margin-10">
                 {!! Form::open(['route' => 'assignments.store','files'=>true]) !!}
                    <div class="row">
                        <div class="form-group col-sm-4">
                              {!! Form::label('title', 'Title:') !!}
                              {!! Form::text('title',null, ['id' => 'title_id','class' => 'form-control', 'placeholder' => 'Assignment Title']) !!}
                        </div>
                        <div class="form-group col-sm-4">
                              {!! Form::label('topic', 'Topic:') !!}
                              {!! Form::text('topic',null, ['id' => 'topic_id','class' => 'form-control', 'placeholder' => 'Assignment Topic']) !!}
                        </div>
                        <div class="form-group col-sm-4">
                        {!! Form::label('course', 'Course:') !!}
                            @if(count($courses)!=0)
                                {!! Form::select('courses[]', $courses, null, ['id' => 'course_id','class' => 'form-control select2 select2-multiple', 'multiple', 'data-placeholder' => '------ Select Course ------']) !!}
                            @else
                                @include('includes/not_found')
                            @endif
 
                        </div>  
                        <div class="form-group col-sm-4">
                        {!! Form::label('part', 'Part:') !!}
                              <select name="part" id="part_id" class="form-control">
                                <option>Select Part</option>
                                <option value="1">Part-I</option>
                                <option value="2">Part-II</option>
                              </select>
                        </div>
                        <div class="form-group col-sm-4">
                              {!! Form::label('section', 'Section:') !!}
                              {!! Form::select('sections[]', $sections, null, ['id' => 'section_id','class' => 'form-control select2 select2-multiple reset_section', 'multiple', 'data-placeholder' => '------ Select Section ------']) !!}
                        </div>
                        <div class="form-group col-sm-4">
                              {!! Form::label('subject', 'Subject:') !!}
                              {!! Form::select('subject', $subjects, null, ['id' => 'subject_id','class' => 'form-control','placeholder' => '------ Select Section ------']) !!}
                        </div>
                        <div class="form-group col-sm-4">      
                            <input type="file" name="assignment_file" id="assigment_file">
                        </div>
                        <div class="form-group col-sm-4">
                        {!! Form::button('Filter Students', ['onclick' => 'onCourseSelect()','class' => 'btn btn-success']) !!}
                        {!! Form::button('Save', ['onclick' => 'saveAssignment()','class' => 'btn btn-primary']) !!}                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="m-b-10">
            <div class="m-t-10 div-border-rad">
                <div class="margin-10">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                            <th scope="col">Student Roll no</th>
                            <th scope="col">Student Name</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="selected_course_student">
                            
                        </tbody>
                    </table>
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
    <script src="{{ asset('js/assignments/assignment.js')  }}"></script>

@include('includes/footer_end')