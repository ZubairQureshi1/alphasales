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
    <!--Start Table-->
    <div class="container">
        <div class="card">
            <div class="card-header">
                <strong>Student Sitting Plan (CFE College of Science & Commerce)</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Invigilator</th>
                                    <th scope="col">Room</th>
                                    <th scope="col">Duty Days</th>
                                    <th scope="col">Start Time</th>
                                    <th scope="col">End Time</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($datesheet_sitting_plans as $value)
                                <tr>
                                    <td>{{$value->invigilator}}</td>
                                    <td>{{$value->selected_room_name}}</td>
                                    <td>{{$value->days}}</td>
                                    <td>{{$value->start_time->format('h:i-a')}}</td>
                                    <td>{{$value->end_time->format('h:i-a')}}</td>
                                </tr>
                               @endforeach
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="container">
        <div class="row justify-content-end">
            <div class="col-sm-4 text-right">
               <a href="../edit_sitting_plan/{{$datesheet['id']}}"> <button class="btn btn-primary">Edit</button></a>
            </div>
        </div>
    </div> --}}
    <!--end table-->
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