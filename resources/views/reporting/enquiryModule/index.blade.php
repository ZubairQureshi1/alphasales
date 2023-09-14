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
                                    <h3 class="page-title">Enquiries Reporting</h3>
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
                                <div class="col-2">
                                    <div class="card m-b-30">
                                        <div class="card-body padding-5">
                                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                <a class="nav-link active" id="enquiry_type_wise_tab" data-toggle="pill" href="#enquiry_type_wise" role="tab" aria-controls="enquiry_type_wise" aria-selected="true">Enquiry Type Wise</a>
                                                <a class="nav-link" id="enquiry_employee_wise_tab" data-toggle="pill" href="#enquiry_employee_wise" role="tab" aria-controls="enquiry_employee_wise" aria-selected="true">Enquiry CSO Report</a>
                                                <a class="nav-link" id="enquiry_deo_wise_tab" data-toggle="pill" href="#enquiry_deo_wise" role="tab" aria-controls="enquiry_deo_wise" aria-selected="true">Enquiry Entered By Report</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-10">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <div class="tab-content" id="v-pills-tabContent">
                                                <div class="tab-pane fade show active" id="enquiry_type_wise" role="tabpanel" aria-labelledby="enquiry_type_wise_tab">
                                                    @include('reporting.enquiryModule.enquiryTypeWise.index')
                                                </div>
                                                {{-- CSO WISE ENQUIRY --}}
                                                <div class="tab-pane fade show" id="enquiry_employee_wise" role="tabpanel" aria-labelledby="enquiry_employee_wise_tab">
                                                    @include('reporting.enquiryModule.enquiryEmployeeWise.index')
                                                </div>
                                                {{-- EMPLOYEE WISE ENQUIRY --}}
                                                <div class="tab-pane fade show" id="enquiry_deo_wise" role="tabpanel" aria-labelledby="enquiry_deo_wise_tab">
                                                    @include('reporting.enquiryModule.enquiryEntryByReport.index')
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
@include('includes/footer_start')
@include('includes/footer_end')
