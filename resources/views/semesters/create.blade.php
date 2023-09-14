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
        <h3 class="page-title">Degree Semesters</h3>
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
                                <form name="semester_form" method="post" action="{{url('semester')}}">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-sm-3">
                                            {!! Form::label('course', 'Course:') !!}
                                            @if(count($courses)!=0)
                                            {!! Form::select('course_id', $courses, null, ['id' => 'course_id', 'onchange' => 'onCourseSelect()', 'class' => 'form-control select2-multiple', 'placeholder' => '------ Select Course ------']) !!}
                                            @else
                                            @include('includes/not_found')
                                            @endif
                                        </div>
                                        <div class="form-group col-sm-3">
                                            {!! Form::label('session', 'Session:') !!}
                                            {!! Form::select('session_id', $sessions, null, ['id' => 'session_id', 'class' => 'form-control select2-multiple', 'placeholder' => '------ Select Session ------']) !!}
                                        </div>  
                                        <div class="form-group col-sm-3">
                                            {!! Form::label('semester','Semester') !!}
                                            {!! Form::text('semester',null,['id' => 'semester_id','class' => 'form-control', 'placeholder' => 'Enter Semester no'])!!}
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label>Minumum Discount</label>
                                            <input type="number" class="form-control text-right" required="" min="0" max="100" name="min_discount">
                                            <span style="color: red;">Note: Above entered value will be consider in <b>Percentages</b></span>
                                        </div>

                                        <div class="form-group col-sm-3">
                                            <label>Maximum Discount</label>
                                            <input type="number" class="form-control text-right" required="" min="0" max="100" name="max_discount"><span style="color: red;">Note: Above entered value will be consider in <b>Percentages</b></span>
                                        </div>
 
                                        <div class="form-group col-sm-3">
                                            <label>Minumum Installments</label>
                                            <input type="number" class="form-control text-right" required="" min="0" max="12" name="min_installments">
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label>Maximum Installments</label>
                                            <input type="number" class="form-control text-right" required="" min="0" max="12" name="max_installments">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-3">
                                            {!! Form::submit('Save',['class' => 'btn btn-primary']) !!}
                                        </div>

                                    </div>
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

        @include('includes/footer_end')