@include('includes/header_start')

        <!-- DataTables -->
        <link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

@include('includes/header_end')

             <!-- Page title -->
                            <ul class="list-inline menu-left mb-0">
                                <li class="list-inline-item">
                                    <button type="button" class="button-menu-mobile open-left waves-effect">
                                        <i class="ion-navicon"></i>
                                    </button>
                                </li>
                                <li class="hide-phone list-inline-item app-search">
                                    <h3 class="page-title">Students</h3>
                                </li>
                            </ul>
                        @include('alertify::alertify')

                            <div class="clearfix"></div>
                        </nav>

                    </div>
                    <!-- Top Bar End -->

                    <!-- ==================
                         PAGE CONTENT START
                         ================== -->

                    <div class="page-content-wrapper">

                        <div class="container-fluid">


                            @include('layouts/test_filters')
                            <div class="row">
                                <div class="col-6 pull-right">
                                    {{ $data->links() }}
                                </div>
                                <div class="col-4 pull-right">
                                    {!! Form::open(['route' => 'students.getFilteredData']) !!}
                                        <div class="form-group pull-right">
                                            {!! Form::label('name', 'Old Roll Number:') !!}
                                            {!! Form::text('old_roll_no', null, ['class' => 'form-control']) !!}
                                        </div>
                                    {!! Form::close() !!}
                                </div>
                                <div class="col-md-2 pull-right">
                                    <a title="" data-placement="top" data-toggle="tooltip" style="margin-top: 30px;" class="tooltips btn btn-info btn-sm" href="{!! route('students.exportExcel') !!}" data-original-title="Export"><i class="fa fa-file"></i> Export</a>

                                    <!-- <form name="student_import" enctype="multipart/form-data" class="" method="POST" action="{{ route('students.import') }}">
                                        @csrf()
                                        <div class="form-group display-flex">
                                            <input type="file" class="filestyle" name="import" data-buttonname="btn-secondary">
                                            <button type="submit" class="btn btn-success margin-left-5">Import File</button>
                                           
                                        </div> 
                                    </form> -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    {{-- <div class="card m-b-30">
                                        <div class="card-body"> --}}
            
                                          <!--   <h4 class="mt-0 header-title">Buttons example</h4>
                                            <p class="text-muted m-b-30 font-14">The Buttons extension for DataTables
                                                provides a common set of options, API methods and styling to display
                                                buttons on a page that will interact with a DataTable. The core library
                                                provides the based framework upon which plug-ins can built.
                                            </p> -->
            
                                            @include('students/table_student')
            {{--                             </div>
                                    </div> --}}
                                </div> <!-- end col -->
                            </div>
                        </div>
                    </div>
                            @include('includes/footer_start')

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
        <script src="assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>

        <!-- Datatable init js -->
        <script src="assets/pages/datatables.init.js"></script>

@include('includes/footer_end')