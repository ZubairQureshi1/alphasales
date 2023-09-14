@include('includes/header_start')
    <!-- DataTables -->
    <link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/timeslot/slot-tab.css') }}" rel="stylesheet" type="text/css" />
@include('includes/header_end')

        <!-- Page title -->
        <ul class="list-inline menu-left mb-0">
            <li class="list-inline-item">
                <button type="button" class="button-menu-mobile open-left waves-effect">
                <i class="ion-navicon"></i>
                </button>
            </li>
            <li class="hide-phone list-inline-item app-search">
                <h3 class="page-title">Time Slots</h3>
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
        <div class="row">
            <div class="col-6">
                <nav class="tabs m-b-10 m-t-15-negative">
                    <div class="selector">
                    </div>
                    @foreach ($groupByTimeSlots as $key => $timeslots)
                        <a aria-controls="{{$key}}" class="tablinks" data-toggle="tab" href="#{{$key}}" onclick="opentab(event, '{{$key}}')" role="tab">
                            {{$key}}
                        </a>
                    @endforeach
                </nav>
            </div>
            <div class="col-6 text-right">
                <button type="button" id="add" class="btn btn-dark btn-sm waves-effect waves-light"  data-toggle="modal" data-target=".add_slot">
                    <i class="fa fa-plus fa-fw"></i> | Add Time Slot
                </button>
                @if (!empty($groupByTimeSlots))
                    <a href="{{ route('timeslots.exportExcel') }}" class="btn btn-success btn-sm waves-effect">
                         <i class="mdi mdi-file-excel"></i> | Export To Excel
                    </a>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                       
                        @include('flash::message')

                        <div class="clearfix"></div>
                        <div class="box box-primary">
                            <div class="box-body">
                                @include('timeslot.add_slot')
                                @if (empty($groupByTimeSlots))
                                    @include('includes.not_found')
                                @else
                                    @include('timeslot.table')
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('includes/footer_start')
    @include('alertify::alertify')
    <!-- Required datatable js -->
    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
    <script src="assets/plugins/datatables/jszip.min.js"></script>
    <script src="assets/plugins/datatables/pdfmake.min.js"></script>
    <script src="assets/plugins/datatables/vfs_fonts.js"></script>
    <script src="assets/plugins/datatables/buttons.html5.min.js"></script>
    <script src="assets/plugins/datatables/buttons.print.min.js"></script>
    <script src="assets/plugins/datatables/buttons.colVis.min.js"></script>
    <!-- Responsive examples -->
    <script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="assets/plugins/datatables/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')  }}"></script>
    <!-- Datatable init js -->
    <script src="assets/pages/datatables.init.js"></script>
    <script type="text/javascript" src="{{ asset('js/timeslot/slot-tab.js')  }}"></script>
@include('includes/footer_end')


