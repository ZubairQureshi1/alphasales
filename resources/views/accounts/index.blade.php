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
                                    <h3 class="page-title">Accounts</h3>
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

                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    @include('layouts/test_filters')
                                </div>
                            </div>

                             <div class="row">
                                <div class="col-6 pull-right">
                                    {{ $data->links() }}
                                </div>
                                <div class="col-6 pull-right">
                                    {!! Form::open(['route' => 'accounts.getFilteredData']) !!}
                                        <div class="form-group pull-right">
                                            {!! Form::label('name', 'Old Roll Number:') !!}
                                            {!! Form::text('old_roll_no', null, ['class' => 'form-control']) !!}
                                        </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    @include('accounts/table_students')
                                </div> <!-- end col -->
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

@include('includes/footer_end') -->
