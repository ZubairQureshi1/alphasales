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
                <h3 class="page-title">Create Announcement</h3>
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
                 {!! Form::open(['route' => 'announcements.store']) !!}
                    <div class="row m-t-10">
                        <div class="form-group col-md-4">
                            {!! Form::label('title', 'Title:') !!}
                            {!! Form::text('title',null, ['id' => 'title_id','class' => 'form-control', 'placeholder' => 'Title']) !!}
                        </div>
                        <div class="form-group col-md-4">
                            {!! Form::label('description', 'Description:') !!}
                            {!! Form::text('description',null, ['id' => 'description_id','class' => 'form-control', 'placeholder' => 'Description']) !!}
                        </div>
                        <div class="form-group col-sm-4">
                                {!! Form::label('part', 'Part:') !!}
                              <select name="part" id="part_id" class="form-control">
                                <option>Select Part</option>
                                <option value="1">Part-I</option>
                                <option value="2">Part-II</option>
                              </select>
                        </div>
                        <div class="form-group col-md-4">
                        {!! Form::label('subject', 'Subject:') !!}
                        {!! Form::select('subject_id', $subjects, null, ['id' => 'subject_id', 'class' => 'form-control', 'placeholder' => '------ Select Subject ------']) !!}
                        </div>
                        <div class="form-group col-md-4">
                        {!! Form::label('course', 'Course:') !!}
                        {!! Form::select('course_id', $courses, null, ['id' => 'course_id', 'class' => 'form-control', 'placeholder' => '------ Select Course ------']) !!}
                        </div>
                        <div class="form-group col-md-2" style="padding-top:2%;">
                            
                            {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <table class="table table-bordered">
                <thead>
                    <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Part</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Course</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($announcements as $value)
                    <tr>
                    <td>{{$value->title}}</td>
                    <td>{{$value->description}}</td>
                    <td>{{$value->part_id}}</td>
                    <td>{{$value->subject_name}}</td>
                    <td>{{$value->course_name}}</td>
                    <td>
                    <a href="edit_announcement/{{$value['id']}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <a href="delete_announcement/{{$value['id']}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                    </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
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