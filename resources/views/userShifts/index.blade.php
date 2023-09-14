@include('includes/header_start')
<link href="assets/plugins/fullcalendar/css/fullcalendar.min.css" rel="stylesheet" />
<link href="assets/plugins/fullcalendar-schedule/css/scheduler.min.css" rel="stylesheet" />
<link href="css/userShift/user-shift.css" rel="stylesheet" />
{{-- <script src="https://unpkg.com/tippy.js@3/dist/tippy.all.min.js"></script> --}}
@include('includes/header_end')

<!-- Page title -->
<ul class="list-inline menu-left mb-0">
    <li class="list-inline-item">
        <button type="button" class="button-menu-mobile open-left waves-effect">
            <i class="ion-navicon"></i>
        </button>
    </li>
    <li class="hide-phone list-inline-item app-search">
        <h3 class="page-title">User Shifts</h3>
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
            <div class="col-12 text-right mb-2">
                <a href="{{ route('userShifts.create') }}" id="add" class="btn btn-success waves-effect waves-light btn-sm"><i class="fa fa-plus fa-fw"></i> | Add New Shift</a>
                <a href="{{ route('userShifts.shiftSwap') }}" id="swap" class="btn btn-secondary waves-effect waves-light btn-sm"><i class="fa fa-arrows-h fa-fw"></i> Make A Swap</a>
            </div>
        </div>
        <div class="row" style="position: relative;">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        @include('userShifts.table')
                    </div>
                </div>
            </div>
        </div>
        @include('includes/footer_start')
        @include('alertify::alertify')
        <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="assets/plugins/moment/moment.js"></script>
        <script src='assets/plugins/fullcalendar/js/fullcalendar.min.js'></script>
        <script src='assets/plugins/fullcalendar-schedule/js/scheduler.min.js'></script>
        <script type="text/javascript" src="{{ asset('js/shift/shift.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/shift/shift-calendar.js') }}"></script>
        @include('includes/footer_end')