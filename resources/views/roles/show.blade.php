@include('includes/header_start')
    <link href="{{ asset('css/custom/accordian.css') }}" rel="stylesheet" type="text/css" />
@include('includes/header_end')
        <!-- Page title -->
        <ul class="list-inline menu-left mb-0">
            <li class="list-inline-item">
                <button type="button" class="button-menu-mobile open-left waves-effect">
                <i class="ion-navicon"></i>
                </button>
            </li>
            <li class="hide-phone list-inline-item app-search">
                <h3 class="page-title">Role Details</h3>
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
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-header card-custom-header">
                        <h5 class="card-title font-weight-bold">{{ $role->display_name }} Role</h5>
                    </div>
                    <div class="card-body">
                    @include('roles.show_fields')
                    <a href="{!! route('roles.index') !!}" class="btn btn-primary">Back</a>
                 </div>
                </div>
             </div>
        </div>
    </div>
</div>
@include('includes/footer_start')
@include('alertify::alertify')
@include('includes/footer_end')