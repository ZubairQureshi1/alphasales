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
                <h3 class="page-title">Sitting Plan</h3>
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
        <div class="card">
            <div class="card-body">
                <div class="m-b-10">
                    <div class="m-t-10 div-border-rad">
                        <div class="margin-10">
                            <div class="row">
                            <div class="form-group col-md-4">
                            {!!Form ::label('datesheet','Date Sheets')!!}
                            {!! Form::select('datesheet_id', $datesheets, null, ['id' => 'datesheet_id', 'onChange' =>'onDateSheetSelect()', 'class' => 'form-control select2-multiple', 'placeholder' => '------ Select DateSheet ------']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
        <div class="card m-t-10">
            <div class="card-body">
                <div class="m-b-10">
                    <div class="m-t-10 div-border-rad">
                        <div class="margin-10">
                            <strong>Date Sheet Sections</strong>
                            <div class="sitting_plan_schedule">
                            
                          </div>
                            <div class="selecetd_rooms">

                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
        {!! Form::button('save',['onclick' => 'saveSitting()', 'class'=> 'btn btn-primary'])!!}
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