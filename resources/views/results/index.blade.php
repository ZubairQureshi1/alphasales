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
                <h3 class="page-title">Result Entry</h3>
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
                    <strong> <i class="fa fa-table" aria-hidden="true"></i> DateSheet Result:</strong>
                        <div class="m-t-10 div-border-rad">
                            <div class="margin-10">
                            <div class="row">
                                <div class="form-group col-sm-3">
                                    {!!Form ::label('datesheet','Date Sheets')!!}
                                    {!! Form::select('datesheet_id', $datesheets, null, ['id' => 'datesheet_id', 'onChange' =>'onDateSheetSelect()', 'class' => 'form-control select2-multiple', 'placeholder' => '------ Select DateSheet ------']) !!}
                                    <span id="datesheet_message" style="color: red;"></span>
                                </div>
                                <div class="form-group col-sm-3">
                                    {!!Form ::label('action_to_perform','Action To Perform:')!!}
                                    {!! Form::select('action_to_perform_id', config('constants.action_to_perform_results'), null, ['id' => 'action_to_perform_id', 'class' => 'form-control select2-multiple', 'placeholder' => '------ Select Action To Perform ------']) !!}
                                    <span id="action_to_perform_message" style="color: red;"></span>
                                </div>
                                <div class="form-group col-sm-3">
                                    {!!Form ::label('examtype','Exam Type')!!}
                                    {!! Form::text('exam_type_id',null,['id' => 'exam_type_id', 'class' => 'form-control', 'placeholder' => '-------- Exam Type --------', 'disabled' => 'true']) !!}
                                </div>
                                <div class="form-group col-sm-3">
                                    {!!Form ::label('session','Session')!!}
                                    {!! Form::text('session_id', null,['id' => 'session_id', 'class' => 'form-control', 'placeholder' => '--------- Session ---------', 'disabled' => 'true']) !!}
                                </div>
                                <div class="form-group col-sm-3">
                                    {!!Form ::label('section','Section')!!}
                                    {!! Form::text('section_id',null, ['id' => 'section_id', 'class' => 'form-control', 'placeholder' => '--------- Section ---------', 'disabled' => 'true']) !!}
                                </div>
                                <div class="form-group col-sm-3 subject_show" style="display:none;">
                                    {!!Form ::label('subjects','Subjects')!!}
                                    {!! Form::select('subject_id', $user_subjects, null, ['id' => 'subject_id', 'class' => 'form-control select2-multiple', 'placeholder' => '------ Select Subject ------']) !!}
                                        <span id="subject_message" style="color: red;"></span>
                                </div>
                                <div class="form-group col-sm-3 subject_show" style="display:none;">
                                    {!!Form ::label('total_marks','Total Marks')!!}
                                    {!! Form::text('default_total_marks', null, ['id' => 'default_total_marks', 'class' => 'form-control', 'placeholder' => '------ Enter Subject Total Marks ------']) !!}
                                        <span id="default_total_marks_message" style="color: red;"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">                                    
                                </div>
                                <div class="col-md-4">                                    
                                    {!! Form::button('Filter Students',['id' => 'subject_id', 'onclick' => 'onSubjectSelect()', 'class' => 'form-control waves-effect waves-light  btn btn-success btn-sm btn-flat']) !!}
                                </div>
                                <div class="col-md-4">                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card m-t-30">
            <div class="card-body">
                 <div class="m-b-10">
                        <strong> <i class="fa fa-table" aria-hidden="true"></i> Result Entry:</strong>
                    <div class="m-t-10">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                <th scope="col">Student Roll no</th>
                                <th scope="col">Student Name</th>
                                <th scope="col">Old Roll no</th>
                                <th scope="col">Section</th>
                                <th scope="col">Total Marks</th>
                                <th scope="col">Obtain Marks</th>
                                <th scope="col">Percentage</th>
                                <th scope="col">Grade</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="result_entry_section">
        
                            </tbody>
                        </table>
                        @include('layouts/loading')
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
    <script src="{{ asset('js/result/result.js')  }}"></script>

@include('includes/footer_end')