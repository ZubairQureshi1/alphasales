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
                <h3 class="page-title">Result Reporting</h3>
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
        <div class="m-b-10">
            <div class="margin-10">
                <div class="card">
                    <div class="card-body">
                        <div class="m-b-10 datesheet_section_student">
                            <div class="m-t-10 div-border-rad">
                                <div class="margin-10">
                                    <div class="row">
                                        <div class="form-group col-sm-3">
                                            {!!Form ::label('datesheet','Date Sheets')!!}
                                            {!! Form::select('datesheet_id', $date_sheets, null, ['id' => 'datesheet_id', 'onChange' =>'onDateSheetSelect()', 'class' => 'form-control select2-multiple', 'placeholder' => '------ Select DateSheet ------']) !!}
                                        </div>
                                        <div class="form-group col-sm-3" >
                                        {!!Form ::label('sections','Sections')!!}
                                            <div id="sections">
                                            
                                            </div>
                                        </div>
                                        <!-- <div class="form-group col-sm-3" >
                                        {!!Form ::label('subjects','Subjects')!!}
                                            <div id="date_sheet_books">
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="m-b-10">
            <div class="margin-10">
                <div class="card">
                    <div class="card-body">
                        <div class="m-b-10 datesheet_section_student">
                            <div class="m-t-10 div-border-rad">
                                <div class="margin-10">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">Student</th>
                                                <th scope="col">Subject</th>
                                                <th scope="col">Total Marks</th>
                                                <th scope="col">Obtain Marks</th>
                                                <th scope="col">Percentage</th>
                                                <th scope="col">Grade</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="result_reporting_table">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</div>
@include('includes/footer_start')

<!-- Required datatable js -->
    <script src="{{ asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')  }}"></script>
<!-- Datatable init js -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsleyjs/parsley.min.js')  }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')  }}"></script>
    <script src="{{ asset('assets/plugins/RWD-Table-Patterns/dist/js/rwd-table.min.js')  }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
<script src="{{ asset('js/result/result_reporting_view.js')  }}"></script>
@include('includes/footer_end')