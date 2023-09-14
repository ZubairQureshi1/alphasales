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
                <form name="updateFacultySubject" method="post" action="../updateFacultySubject/{{ $teacher_subject->id }}">
                    @csrf
                    <div class="row">
                        <div class="form-group col-sm-4">
                            {!! Form::label('teacher', 'Teacher:') !!}
                                <select class="form-control" name="user_id">
                                    <option>-------- Select Teacher --------</option>
                                    @foreach($users as $user)
                                        @if($user->roles[0]->id==4)
                                        @if($user->id==$teacher_subject->user_id)
                                            <option value="{{$user->id}}" selected>{{$user->name}}</option>
                                            @else
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endif
                                        @endif
                                    @endforeach
                            </select>
                        </div>
                            <div class="form-group col-sm-4">
                                {!! Form::label('subject','Subject')!!}
                                {!! Form::select('subject_id', $subjects,$teacher_subject->subject_id, ['id' => 'subject_id', 'class' => 'form-control select2-multiple', 'placeholder' => '------ Select Subject ------']) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                            {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                </form>
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
@include('includes/footer_end')