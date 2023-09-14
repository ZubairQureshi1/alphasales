@include('includes/header_start')


@include('includes/header_end')

        <!-- Page title -->
        <ul class="list-inline menu-left mb-0">
            <li class="list-inline-item">
                <button type="button" class="button-menu-mobile open-left waves-effect">
                <i class="ion-navicon"></i>
                </button>
            </li>
            <li class="hide-phone list-inline-item app-search">
                <h3 class="page-title">Shift Swap</h3>
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
            
            @include('flash::message')

            <div class="clearfix"></div>
            @include('userShifts.swap_fields')
        </div>
    </div>
@include('includes/footer_start')

    @include('alertify::alertify')

    
    <script type="text/javascript">
        $('.select2').select2();
    </script>
        <script src="{{ asset('assets/pages/form-advanced.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/shift/shift.js') }}"></script>

@include('includes/footer_end')
