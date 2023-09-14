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
                Accounts
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
          <div class="col-lg-2"></div>
          <div class="col-lg-8 mobile_account_tab text-center m-t-20-negative m-b-20">
            <nav class="tabs accounts-detail-tabs">
              <div class="selector">
              </div>
              <a aria-controls="feePackage" class="active tablinks" data-toggle="tab" href="#feePackage" onclick="openCity(event, 'feePackage')" role="tab">
                  FEE PACKAGE
              </a>
              <a aria-controls="installments" class="tablinks" data-toggle="tab" href="#installments" onclick="openCity(event, 'installments')" role="tab">
                  INSTALMENTS
              </a>

              <a aria-controls="head_fine" class="tablinks" data-toggle="tab" href="#head_fine" onclick="openCity(event, 'head_fine')" role="tab">
                  HEAD FINES
              </a>
               <a aria-controls="fee_fine" class="tablinks" data-toggle="tab" href="#fee_fine" onclick="openCity(event, 'fee_fine')" role="tab">
                  FEE FINE
              </a>
              <a aria-controls="attendance_fine" class="tablinks" data-toggle="tab" href="#attendance_fine" onclick="openCity(event, 'attendance_fine')" role="tab">
                  Attendance FINE
              </a>
              <a aria-controls="exam_fine" class="tablinks" data-toggle="tab" href="#exam_fine" onclick="openCity(event, 'exam_fine')" role="tab">
                  EXAM FINE
              </a>
            </nav>
          </div>
          <div class="col-lg-2">
              <form action="{{route('accounts.verifyStudentAccount')}}" method="POST">
                  @csrf
                  <input name="student_id" required="" type="hidden" value="{{ $student['id'] }}">
                  <button type="submit" class="btn btn-sm btn-success waves-effect waves-light  m-b-20 pull-right m-t-15-negative"><i class="ion-checkmark"></i> Verifiy All</button>
              </form>
          </div>
        </div>
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

                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card m-b-20">
                    <div class="card-body">
                      <div class="tab-content">
                        @include('accounts.fee_package')
                        @if ($fee_package!=null&&!empty($fee_package))
                          @if($fee_package['status_id']!=1)
                            @include('accounts.installments')
                          @endif
                          {{-- @include('accounts.summary') --}}
                          {{-- @include('accounts.miscellaneous') --}}
                          @include('accounts.head_fine')
                          @include('accounts.fee_fine')
                          @include('accounts.attendance_fine')
                          @include('accounts.exam_fine')
                        @endif
                      </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
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
<script src="{{ asset('js/accounts/account.js')  }}"></script>
@include('includes/footer_end')
