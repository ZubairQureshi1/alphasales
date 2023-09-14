@include('includes/header_start')

<!-- DataTables -->
<link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

@include('includes/header_end')

<!-- Page title -->
<ul class="list-inline menu-left mb-0">
    <li class="list-inline-item">
        <button type="button" class="button-menu-mobile open-left waves-effect">
            <i class="ion-navicon"></i>
        </button>
    </li>
    <li class="hide-phone list-inline-item app-search">
        <h3 class="page-title">Confirmed Admission</h3>
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
                                    @if(Session::get('errors'))
                                    <div class="col-12">
                                        <div class="alert alert-danger alert-dismissible fade show" style="background-color: #f8d7da;">
                                        {{ Session::get('errors')->first() }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">

                                          <!--   <h4 class="mt-0 header-title">Buttons example</h4>
                                            <p class="text-muted m-b-30 font-14">The Buttons extension for DataTables
                                                provides a common set of options, API methods and styling to display
                                                buttons on a page that will interact with a DataTable. The core library
                                                provides the based framework upon which plug-ins can built.
                                            </p> -->

                                            @include('admissionByEnquiryForm/table')
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div>
                        </div>
                    </div>
                    @include('includes/footer_start')

                    <!-- Required datatable js -->
                    <script src="{{  asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
                    <script src="{{  asset('assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
                    <!-- Buttons examples -->
                    <script src="{{  asset('assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
                    <script src="{{  asset('assets/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
                    <script src="{{  asset('assets/plugins/datatables/jszip.min.js') }}"></script>
                    <script src="{{  asset('assets/plugins/datatables/pdfmake.min.js') }}"></script>
                    <script src="{{  asset('assets/plugins/datatables/vfs_fonts.js') }}"></script>
                    <script src="{{  asset('assets/plugins/datatables/buttons.html5.min.js') }}"></script>
                    <script src="{{  asset('assets/plugins/datatables/buttons.print.min.js') }}"></script>
                    <script src="{{  asset('assets/plugins/datatables/buttons.colVis.min.js') }}"></script>
                    <!-- Responsive examples -->
                    <script src="{{  asset('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
                    <script src="{{  asset('assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
                    <script src="{{ asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')  }}"></script>

                    <!-- Datatable init js -->
                    <script src="assets/pages/datatables.init.js"></script>

                    @include('includes/footer_end')