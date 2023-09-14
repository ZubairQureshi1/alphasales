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
                <h3 class="page-title">{{ ucfirst($user->display_name) }}</h3>
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
            @if(Auth::user()->isSuperAdmin())
                <div class="col-12 margin-bottom-10">
                    <a type="button" class="btn btn-dark pull-right btn-sm m-r-5" href="{{ route('admin.activityLogs', [$user->id]) }}"> <i class="mdi mdi-file-tree" aria-hidden="true"></i> | Activity Logs</a>
                </div>
            @endif
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        @include('users.show_fields')
                        <a href="{!! route('users.index') !!}" class="btn btn-primary" style="height: 0%;margin-top: 7%;margin-left: 14%;">Back</a>
                    </div>
                </div>
             </div>
        </div>
    </div>
</div>
@include('includes/footer_start')
    @include('alertify::alertify')

    <!-- Required datatable js -->
    <script src="assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
    <script src="assets/plugins/datatables/vfs_fonts.js"></script>
    <!-- Responsive examples -->
    <script src="{{ asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')  }}"></script>

    <!-- Datatable init js -->
    <script src="assets/pages/datatables.init.js"></script>
    <script type="text/javascript" src="{{ asset('js/enquiry/enquiry.js') }}"></script>

@include('includes/footer_end')


