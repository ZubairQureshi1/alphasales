@include('includes/header_start')

            <!--Morris Chart CSS -->
            <link rel="stylesheet" href="assets/plugins/morris/morris.css">

@include('includes/header_end')
<style type="text/css">
    .selectstatus {
        width: 130px;
    }
</style>
<!-- Page title -->
        <ul class="list-inline menu-left mb-0">
            <li class="list-inline-item">
                <button type="button" class="button-menu-mobile open-left waves-effect">
                    <i class="ion-navicon"></i>
                </button>
            </li>
            <li class="hide-phone list-inline-item app-search">
                <h3 class="page-title">Dashboard</h3>
            </li>
        </ul>

        <div class="clearfix"></div>
    </nav>
</div>

<!-- Content start from here -->

                <div class="page-content-wrapper">
                    <div class="row justify-content-center">
                            <div class="col-6">
                                
                                <div class="card">
                                <a onclick="pageRedirect(1)">
                                    <div class="card-header" style="background:#0171c3; color:white;font-size: 16px;">
                                    <span>
                                        All Enquiries Report
                                    </span> 
                                    </div>
                                </a>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card">
                                <a onclick="pageRedirect(2)">

                                    <div class="card-header" style="background:#0171c3; color:white;font-size: 16px;">
                                    <span>
                                        All Follow-ups Report
                                    </span> 
                                    </div>
                                    </a>
                                
                                </div>
                            </div>
                            <div class="col-6 mt-4">
                                <div class="card">
                                <a onclick="pageRedirect(3)">

                                    <div class="card-header" style="background:#0171c3; color:white;font-size: 16px;">
                                    <span>
                                        Inbound Calls Not Received
                                    </span> 
                                    </div>
                                    </a>
                                
                                </div>
                            </div>
                            <!-- <div class="col-6 mt-4">
                                <div class="card">
                                <a href="{{ url('http://localhost/Reports/LeadAssignment.php') }}">
                                    <div class="card-header" style="background:#0171c3; color:white;font-size: 16px;">
                                    <span>
                                    Enquiries Assignment Report
                                    </span> 
                                    </div>
                                    </a>
                                
                                </div>
                            </div> -->
                            <div class="col-6 mt-4">
                                <div class="card">
                                <a onclick="pageRedirect(4)">

                                    <div class="card-header" style="background:#0171c3; color:white;font-size: 16px;">
                                    <span>
                                     Overdue FollowUp
                                    </span> 
                                    </div>
                                    </a>
                                    <script>
                                        const pageRedirect = (e) => {
                                            if(e === 1){

                                                window.location.replace(`http://${window.location.host}/Reports/Enquiry.php`);
                                            }else if(e === 2){
                                                window.location.replace(`http://${window.location.host}/Reports/FollowUp.php`);

                                            }else if(e === 3){
                                                window.location.replace(`http://${window.location.host}/Reports/InBoundCallsNotReceived.php`);

                                            }else if (e ===4){
                                                window.location.replace(`http://${window.location.host}/Reports/OverDueFollowUp.php`);

                                            }else{
                                                window.location.reload();

                                            }
                                        }
                                        </script>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@include('includes/footer_start')

        <!--Morris Chart-->
        <script src="assets/plugins/morris/morris.min.js"></script>
        <script src="assets/plugins/raphael/raphael-min.js"></script>
        <script src="assets/pages/dashborad.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#enq_byagnt').on("change", function(){
                    $("#enq_byagnt_span").text(this.value);
                });
                $('#enq_prior').on("change", function(){
                    $("#enq_prior_span").text(this.value);
                });
                $('#enq_status').on("change", function(){
                    $("#enq_status_span").text(this.value);
                });
                $('#enq_time').on("change", function(){
                    $("#enq_time_span").text(this.value);
                });
                
            });
        </script>
@include('includes/footer_end')
