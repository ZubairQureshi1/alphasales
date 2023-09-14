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
                <h3 class="page-title">Pwwb Confirmed Admission</h3>
            </li>
        </ul>
    </nav>
</div>

<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            {{-- SHOW ERRORS --}}
            @if(Session::get('errors'))
                <div class="col-12">
                    <div class="alert alert-danger alert-dismissible fade show" style="background-color: #f8d7da;">
                        <i class="fa fa-exclamation-triangle fa-fw"></i> {{ Session::get('errors')->first() }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif
            {{-- /.SHOW ERRORS --}}
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <div class="clearfix">
                            <div class="float-left">
                                <div class="float-left">
                                    <h5 class="card-title mb-1"><b>Admission Confirmation By PWWB File</b></h5>
                                    <span class="text-muted"><i class="fa fa-circle fa-fw" aria-hidden="true"></i> Total Files: {{ count($pwwbForms) ?? '---' }}</span>
                                    {{-- Date filter --}}
                                    <form action="{{ route('admissionByPwwbForm.index') }}" method="GET">
                                        <div class="form-row mt-2">
                                            <div class="col-5">
                                                <label>From Date</label>
                                                <input type="date" class="form-control" value="{{ request('from_date') ?? Date('Y-m-d') }}" name="from_date">
                                            </div>
                                            <div class="col-5">
                                                <label>To Date</label>
                                                <input type="date" class="form-control" value="{{ request('to_date') ?? Date('Y-m-d') }}" name="to_date">
                                            </div>
                                            <div class="col-2 my-auto pt-4">
                                                <div class="btn-group btn-group-sm">
                                                    <button type="submit" class="btn btn-dark"><i class="fa fa-calendar fa-fw"></i> Filter</button>
                                                    @if(!empty(request('from_date')))
                                                        <a href="{{ route('admissionByPwwbForm.index') }}" class="btn btn-outline-dark"><i class="fa fa-remove fa-fw"></i> Clear Filter</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('admissionByPwwbForm/table')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('includes/footer_start')
    <!-- Required datatable js -->
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/buttons.colVis.min.js') }}"></script>
    <!-- Responsive examples -->
    <script src="{{ asset('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')  }}"></script>
    <!-- Datatable init js -->
    <script src="{{ asset('assets/pages/datatables.init.js') }}"></script>
@include('includes/footer_end')