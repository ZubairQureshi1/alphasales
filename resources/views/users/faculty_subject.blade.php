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
                <h3 class="page-title">Faculty Subjects</h3>
            </li>
        </ul>

        <div class="clearfix"></div>
    </nav>
</div>
<!-- Top Bar End -->

<!-- ==================
     PAGE CONTENT START
     ================== -->
<div class="page-content-wrapper" id="designations">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="margin-10">
                    {!! Form::open(['url' => 'SaveFacultySubjects']) !!}
                    <div class="row">
                        <div class="form-group col-sm-4">
                            {!! Form::label('teacher', 'Teacher:') !!}
                                <select class="form-control" name="user_id" id="teacher_id" onchange="onTeacherSelect()">
                                    <option>-------- Select Teacher --------</option>
                                    @foreach($users as $user)
                                        {{-- @if (count($user->roles)>0) --}}
                                            {{-- @if($user->roles[0]->id==7) --}}
                                                <option value="{{$user->id}}">{{$user->name}}
                                                    ({{isset($user->faculty_type) ? \Config::get('constants.faculty_types')[$user->faculty_type] : ''}})
                                                
                                                </option>
                                            {{-- @endif --}}
                                        {{-- @endif --}}
                                    @endforeach
                            </select>
                        </div>
                            <div class="form-group col-sm-4">
                                {!! Form::label('subject','Subject')!!}
                                {!! Form::select('subject_id[]', $subjects, null, ['id' => 'subject_id', 'class' => 'form-control select2 select2-multiple', 'multiple', 'data-placeholder' => '------ Select Subject ------']) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4" id="save-btn" style="display:block;">
                            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="card">
        <div class="card-body">
        
            @foreach($data as $key => $group_data)
                <div id="accordion" role="tablist">
                    <div class="card">

                        <div class="custom-accordion heading{!!str_replace(' ', '_', $key)!!}" role="tab" id="">
                            <h5 class="mb-0">
                                <a data-toggle="collapse" href=".collapse{!!str_replace(' ', '_', $key)!!}" aria-expanded="true" aria-controls="collapse{!!str_replace(' ', '_', $key)!!}">
                                    <div class='row'>
                                        <div class='col-md-4'>
                                            Teacher Name: {!! ucfirst($key) !!}
                                        </div>
                                        <div class='col-md-4'>
                                        <span id="is_visitor_teacher"></span>
                                            @if(count($group_data) > config('constants.system_configrations.subjects_limit'))
                                                <span style="color:red;">75% of Visiting Rate will be applied.</span>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            </h5>
                        </div>

                        <div id="collapse" class="collapse panel collapse{!!str_replace(' ', '_', $key)!!}" role="tabpanel" aria-labelledby="heading{!!str_replace(' ', '_', $key)!!}" data-parent="#accordion">
                            <div class="card-body">
                                @foreach($group_data as $value)
                                    <div class='row'>
                                        <div class='col-md-4'>
                                            <label>Book Name</label>
                                        </div>
                                        <div class='col-md-4'>
                                            <label>{{$value->subject_name}}</label>
                                        </div>
                                        <div class='col-md-4'>
                                            <a href="EditFacultySubject/{{$value['id']}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            <a href="deleteFacultySubject/{{$value['id']}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>    
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
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
    <script src="{{ asset('js/faculty/facultysubject.js') }}"></script>
@include('includes/footer_end')