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
                    <div class="card-header" style="background:#0171c3; color:white;font-size: 16px;">
                       <span>
                         Enquiry by agent
                       </span> 
                        <span>
                        <select class="float-right selectstatus" id="enq_byagnt">
                            <option value="0" selected>Select</option>
                            @foreach($userAgents as $user)
                            <option value="{{$user->tot}}">{{$user->name}}</option>
                            @endforeach
                        </select>  
                       </span> 
                    </div>

                    <div class="card-body"> 
                         <span id="enq_byagnt_span">0</span>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header" style="background:#0171c3; color:white;font-size: 16px;">
                       <span>
                        Enquiry by priority
                       </span> 
                        <span>
                        <select class="float-right selectstatus" id="enq_prior">
                            <option value="0" selected>Select</option>
                            @foreach($rankwiseEnq as $enq)
                            <option value="{{$enq['tot']}}">{{$enq['interst']}}</option>
                            @endforeach
                        </select>  
                       </span> 
                    </div>

                    <div class="card-body"> 
                         <span id="enq_prior_span">0</span>
                    </div>
                </div>
            </div>
            <div class="col-6 mt-1">
                <div class="card">
                    <div class="card-header" style="background: #0171c3; color:white;font-size: 16px;">
                    <span>
                        Enquiry by status
                    </span> 
                    <span>
                    <select class="float-right selectstatus" id="enq_status">
                        <option value="0" selected>Select</option>
                        @foreach($statuswiseEnq as $enst)
                        <option value="{{$enst['tot']}}">{{$enst['status']}}</option>
                        @endforeach
                    </select>  
                   </span>
                    </div>
                    <div class="card-body"> 
                        <span id="enq_status_span">0</span>
                    </div>
                </div>
            </div>
            <div class="col-6 mt-1">
                <div class="card">
                    <div class="card-header" style="background: #0171c3; color:white;font-size: 16px;">
                        <span>
                        Enquiry by time
                        </span> 
                        <span>
                        <select class="float-right selectstatus" id="enq_time">
                            <option value="0" selected>Select</option>
                            @foreach($followuprequired as $followupre)
                            <option value="{{$followupre['tot']}}">{{$followupre['dur']}}</option>
                            @endforeach
                        </select>  
                       </span>
                    </div>
                    <div class="card-body"> 
                        <span id="enq_time_span">0</span>
                    </div>
                </div>
            </div>
            <div class="col-6 mt-1">
                <div class="card">
                    <div class="card-header" style="background: #0171c3; color:white;font-size: 16px;">  
                        Overdue Follow-up
                    </div>
                    <div class="card-body"> 
                        <span id="enq_time_span">{{ $overDue }}</span>
                    </div>
                </div>
            </div>
            <div class="col-6 mt-1">
                <div class="card">
                    <div class="card-header" style="background: #0171c3; color:white;font-size: 16px;">  
                        Unassigned Follow-up 
                    </div>
                    <div class="card-body"> 
                        <span id="enq_time_span">{{ $unassigned }}</span>
                    </div>
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
