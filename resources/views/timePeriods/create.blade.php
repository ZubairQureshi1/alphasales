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
                <h3 class="page-title"> Add Time Period</h3>
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
                    <div class="card-body">

                        @include('flash::message')

                        <div class="clearfix"></div>
                        <div class="box box-primary">
                            <div class="box-body">
                                    @include('timePeriods.add_shift')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('includes/footer_start')

<script type="text/javascript" src="{{ asset('js/timePeriod/shift-steps.js')  }}"></script>
    @include('alertify::alertify')
<script type="text/javascript">
        // $('.select2').select2();
    </script>
@include('includes/footer_end')
