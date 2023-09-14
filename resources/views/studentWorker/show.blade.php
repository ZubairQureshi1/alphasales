@include('includes/header_start')
  <link href="{{asset('css/accounts/account.css')}}" rel="stylesheet" type="text/css"/>

@include('includes/header_end')
    <!-- Page title -->
    <ul class="list-inline menu-left mb-0">
        <li class="list-inline-item">
            <button class="button-menu-mobile open-left waves-effect" type="button">
                <i class="ion-navicon">
                </i>
            </button>
        </li>
        <li class="hide-phone list-inline-item app-search">
            <h3 class="page-title">
                PWWB STATUS
            </h3>
        </li>
    </ul>
    <div class="clearfix">
    </div>
 </nav>

</div>

<!-- Top Bar End -->
<!-- ==================
     PAGE CONTENT START
     ================== -->
<div class="page-content-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <div class="card m-b-20">
                    <div class="card-body div-border-rad">
                      <div class="row">
                        <div class="col-md-3">
                          <label>Name: </label> {{$student['student_name']}}
                        </div>
                        <div class="col-md-3">
                          <label>Roll no: </label> {{$student['roll_no']}}
                        </div>
                        <div class="col-md-3">
                          <label>Course Name:</label> {{$student['course_name']}}
                        </div>
                        <div class="col-md-3">
                          <label>Session Name: </label> {{$student['session_name']}}
                        </div>
                      </div>
                        <div class="row">
                        <div class="col-md-3">
                          <label>cnic: </label> {{$student['student_cninc_no']}}
                        </div>
                          <div class="col-md-3">
                          <label>Father Name: </label> {{$student['father_name']}}
                        </div>
                         <div class="col-md-3">
                          <label>Father Work Address: </label> {{$student['father_work_Address']}}
                        </div>
                          <div class="col-md-3">
                          <label>EOBI: </label>

                          @if(isset($student['eobi']))
                           {{$student['eobi']}}
                          @else

                          <label class="badge" style="background-color: red;color:white">?</label>
                          @endif
                        </div>
                      </div>
                       <div class="row">
                         <div class="col-md-3">
                          <label>SSC: </label>

                          @if(isset($student['ssc']))
                           {{$student['ssc']}}
                          @else

                          <label class="badge" style="background-color: red;color:white">?</label>
                          @endif
                        </div>
                         <div class="col-md-3">
                          <label>Factory City: </label>
                           @if(isset($student['factory_city']))
                           {{$student['factory_city']}}
                          @else

                          <label class="badge" style="background-color: red;color:white">?</label>
                          @endif
                        </div>
                         <div class="col-md-3">
                          <label>Factory reg#: </label>
                          @if(isset($student['factory_reg_no']))
                           {{$student['factory_reg_no']}}
                          @else

                          <label class="badge" style="background-color: red;color:white">?</label>
                          @endif

                        </div>
                         <div class="col-md-3">
                          <label>Transport: </label>
                          @if($student['is_transport']==0)

                            YES

                          @elseif($student['is_transport']==1)

                            no
                             @else

                          <label class="badge" style="background-color: red;color:white">?</label>

                          @endif
                        </div>
                      </div>
                       <div class="row">
                        <div class="col-md-3">
                          <label>Hostel: </label>

                          @if($student['is_hostel']==0)

                            YES

                          @elseif($student['is_hostel']==1)

                            no
                             @else

                          <label class="badge" style="background-color: red;color:white">?</label>

                          @endif
                        </div>
                         <div class="col-md-3">
                          <label>Provisional Letter: </label>
                          @if($student['is_provisional_letter']==0)

                            YES

                          @elseif($student['is_provisional_letter']==1)

                            no
                             @else

                          <label class="badge" style="background-color: red;color:white">?</label>

                          @endif
                        </div>
                        <div class="col-md-3">
                          <label>cfe file no.: </label>

                           @if(isset($student['cfe_file_no']))
                           {{$student['cfe_file_no']}}
                          @else

                          <label class="badge" style="background-color: red;color:white">?</label>
                          @endif
                        </div>
                         <div class="col-md-3">
                          <label>Diary no.: </label>

                           @if(isset($student['dairy_no']))
                           {{$student['dairy_no']}}
                          @else

                          <label class="badge" style="background-color: red;color:white">?</label>
                          @endif
                        </div>
                      </div>
                       <div class="row">
                            <div class="col-md-3">
                          <label>Self Worker: </label>
                            @if($student['self_worker']==0)

                            YES

                          @elseif($student['self_worker']==1)

                            no
                            @else
                          <label class="badge" style="background-color: red;color:white">?</label>


                          @endif



                        </div>
                         <div class="col-md-3">
                          <label>Factory Name: </label>

                           @if(isset($student['factory_name']))
                           {{$student['factory_name']}}
                          @else

                          <label class="badge" style="background-color: red;color:white">?</label>
                          @endif
                        </div>
                          <div class="col-md-3">
                          <label>R-8-/D 5 : </label>
                           @if(isset($student['r_eight']))
                           {{$student['r_eight']}}
                          @else

                          <label class="badge" style="background-color: red;color:white">?</label>
                          @endif
                        </div>





                      </div>

                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>

            <!-- end col -->
        </div>

        @if($check)
     <div class="row" style="    margin-left: 2px;
    background: #ff3a3a;
    padding: 10px;
    color: white;
    margin-right: 2px;
    margin-bottom: 20px;">
  <div class="col-4"></div>
  <div class="col-4" style="text-align:  center;">
    <a><i class="mdi mdi-information-outline"></i> Please fill the above missing fields to continue</a>
  </div>
  <div class="col-4"></div>
</div>
@endif




    </div>

</div>





@include('includes/footer_start')

<script src="{{ asset('assets/plugins/parsleyjs/parsley.min.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/plugins/RWD-Table-Patterns/dist/js/rwd-table.min.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}" type="text/javascript">
</script>
<script src="{{ asset('js/studentWorkers/studentWorker.js')  }}"></script>
@include('includes/footer_end')
