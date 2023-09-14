@include('includes/header_start')

        <!-- DataTables -->
        <link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/custom/admission.css') }}" rel="stylesheet" type="text/css" />
        <style>
             @media print {
         .datesheet_section_student{
             display:none;
         }
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
                <div class="m-b-10 datesheet_section_student">
                    <strong> <i class="fa fa-table" aria-hidden="true"></i> DateSheet Result:</strong>
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
                                <div class="form-group col-sm-3" >
                                {!!Form ::label('students','Students')!!}
                                    <div id="students">
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card" style="border:1px solid #000000;margin-top:3%;">
        <div class="card-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-3">
                        <img src="{{ asset('assets/images/rollno_slip_profille.jpg') }}" style="padding:.25rem;border-radius:.25rem;border: 1px solid #dee2e6;width:100px;height:100px;">
                    </div>
                    <div class="col-sm-6 text-center">
                        <h4>CFE College of Commerce and Science</h4>
                        <p><label style="border:1px solid #000000;padding:0px 8px;"><b>Result Card</b></label></p>
                            <div id="result_card_exam_type">

                            </div>
                    </div>
                    <div class="col-sm-3 text-right" style="padding-left:3%;">
                        <img src="{{ asset('assets/images/logo_dark.png') }}" style="padding:.50rem;border-radius:.25rem;border: 1px solid #dee2e6;width: 150px;height: 75px;">
                    </div>
                </div>  
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="m-b-10">
                            <div class="m-t-10 div-border-rad">
                                <div class="margin-10">
                                    <div class="student_detail">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div><!--card body End-->
    </div><!--card End-->
        <div class="card m-t-30" style="border:1px solid #000000;">
            <div class="card-body">
                 <div class="m-b-10">
                        <strong> <i class="fa fa-table" aria-hidden="true"></i> Student result:</strong>
                    <div class="m-t-10 div-border-rad">
                        <div class="margin-10">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                <th scope="col">Subject</th>
                                <th scope="col">Total Marks</th>
                                <th scope="col">Obtain Marks</th>
                                <th scope="col">Percentage</th>
                                <th scope="col">Grade</th>
                                <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody id="result_detail">
        
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card m-t-30" style="border:1px solid #000000;">
            <div class="card-body">
                 <div class="m-b-10">
                        <strong><i class="fa fa-bar-chart" aria-hidden="true"></i> Graph Report:</strong>
                    <div class="m-t-10 div-border-rad">
                        <div class="margin-10">
                            <canvas id="myChart"></canvas>
                            <div id="chart_section">

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    <script src="{{ asset('js/result/result_view.js')  }}"></script>

@include('includes/footer_end')