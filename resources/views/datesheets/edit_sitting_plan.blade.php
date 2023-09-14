@include('includes/header_start')

        <!-- DataTables -->
        <link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/custom/admission.css') }}" rel="stylesheet" type="text/css" />
        <style>
            .section_list{display:block;}
        @media print{
            .section_list{display:none;}
        }
        </style>
@include('includes/header_end')

             <!-- Page title -->
        <ul class="list-inline menu-left mb-0">
            <li class="list-inline-item">
                <button type="button" class="button-menu-mobile open-left waves-effect">
                    <i class="ion-navicon"></i>
                </button>
                </li>
            <li class="hide-phone list-inline-item app-search">
                <h3 class="page-title">Edit Sitting Plan</h3>
            </li>
        </ul>

        <div class="clearfix"></div>
    </nav>
</div>
<!-- Top Bar End -->

<!-- ==================
     PAGE CONTENT START
     ================== -->
     <div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="m-b-10">
            <div class="m-t-10 div-border-rad">
                <div class="margin-10">
                    <div class="row">
                            <div class="form-group col-md-2">
                            {!!Form ::label('datesheet','Date Sheets')!!}
                            {!! Form::text('datesheet_id',$datesheet->id, ['id' => 'datesheet_id','class' => 'form-control','disabled'=>'true']) !!}
                            </div>
                            <div class="form-group col-md-4">
                            {!!Form::label('sections','Sections')!!}
                            @foreach($datesheet_sections as $value)
                            <br>
                            {{$value->selected_section_name}}
                            <br>
                            @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
        <div class="m-b-10">
            <div class="m-t-10 div-border-rad">
                <div class="margin-10">
                <form name="sittingform" method="post" action="../update_sitting_plan/{{ $datesheet['id'] }}">
                {{ csrf_field() }}
                @foreach($datesheet_sitting_plans as $datesheet_sitting_plan)
                    <div class="row">
                            <div class="form-group col-md-2">
                            {!!Form::label('room','Room')!!}<br>
                            <label>{{$datesheet_sitting_plan->selected_room_name}}</label>
                            </div>
                            <div class="form-group col-md-3">
                            {!!Form::label('invigilator','Invigilator')!!}
                            {!!Form::text('invigilator[]',$datesheet_sitting_plan->invigilator,['id'=>'invigilator','class'=>'form-control'])!!}        
                            </div>
                            <div class="form-group col-md-2">
                            {!!Form::label('days','Days')!!}
                            {!!Form::text('days[]',$datesheet_sitting_plan->days,['id'=>'days_id','class'=>'form-control'])!!}    
                            </div>
                            <div class="form-group col-md-2">
                            {!!Form::label('start_time','Start Time')!!}
                            {!!Form::time('start_time[]',$datesheet_sitting_plan->start_time,['id'=>'start_time_id','class'=>'form-control'])!!}
                            </div>
                            <div class="form-group col-md-2">
                                {!!Form::label('end_time','End Time')!!}
                                {!!Form::time('end_time[]',$datesheet_sitting_plan->end_time,['id'=>'end_time_id','class'=>'form-control'])!!}
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
        {!! Form::submit('Update',['class'=> 'btn btn-primary'])!!}
    </div>
</div> <!--End page-content-wrapper-->






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
    <script src="{{ asset('js/datesheet/date_sheet_sitting_plan.js')  }}"></script>
@include('includes/footer_end')