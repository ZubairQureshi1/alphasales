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
                                    <h3 class="page-title">FollowUps Reporting</h3>
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
                            @include('enquiryFollowups/reportings/reporting_body')
                        </div>
                    </div>
@include('includes/footer_start')
        <script type="text/javascript" src="{{ asset('js/followup/reporting.js') }}"></script>

@include('includes/footer_end')
