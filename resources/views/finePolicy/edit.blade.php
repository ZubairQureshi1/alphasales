@include('includes/header_start')
<style type="text/css">
	input::-webkit-outer-spin-button,
      input::-webkit-inner-spin-button {
      /* display: none; <- Crashes Chrome on hover */
      -webkit-appearance: none;
      margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
      }
      input[type=number] {
      -moz-appearance:textfield; /* Firefox */
      }
</style>
@include('includes/header_end')

<!-- Page title -->
<ul class="list-inline menu-left mb-0">
    <li class="list-inline-item">
        <button type="button" class="button-menu-mobile open-left waves-effect">
            <i class="ion-navicon"></i>
        </button>
    </li>
    <li class="hide-phone list-inline-item app-search">
        <h3 class="page-title">Fine Policy</h3>
    </li>
</ul>

</nav>

</div>
<!-- Top Bar End -->
<div class="page-content-wrapper">

    <div class="container-fluid">
       
       <!-- ==================
                         PAGE CONTENT START
                         ================== -->

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card m-b-20">
                                        <div class="card-body">
            							    <form class="" action="#">
                                                <div class="form-group row">
								                    <div class="col-md-4">
								                      <label class="h5">Academic Wing:</label>
								                      {!! Form::select('wing_id', App\Models\Wing::get()->pluck('name', 'id'), $policy->wing_id, ['id' => 'wing_id', 'class' => 'form-control select2', 'placeholder' => 'Select Academic Wing', 'onchange' => 'editAcademicWing()', 'disabled']) !!}
								                      <input type="hidden" value="{{ $policy->id }}" id="policy_id">
								                 </div>
								               </div>
								               <br>
								               <div class="form-group row">
								                    <div class="col-md-4">
								                      <label class="h6">Per Absent Fine:</label>
								                      <div>
								                      <input type="number" value="{{$policy->absent_fine}}" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" min="0" id="absent_fine" class="form-control" placeholder="XXXX">
								                  </div>
								                 </div>
								                 <div class="col-md-4">
								                      <label class="h6">Initial Fine:</label>
								                      <div>
								                      <input type="number" value="{{$policy->absent_initial_fine}}" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" min="0" id="absent_initial_fine" class="form-control" placeholder="XXXX">
								                  </div>
								                 </div>
								                 <div class="col-md-4">
								                      <label class="h6">Maximum Fine:</label>
								                      <div>
								                      <input type="number" value="{{$policy->absent_maximum_fine}}" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" min="0" id="absent_maximum_fine" class="form-control" placeholder="XXXX">
								                  </div>
								                 </div>
								               </div>
								               <br>
								               <div class="form-group row">
								                    <div class="col-md-4">
								                      <label class="h6">Late Fine:</label>
								                      <div>
								                      <input type="number" value="{{$policy->late_fine}}" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" min="0" id="late_fine" class="form-control" placeholder="XXXX">
								                  </div>
								                 </div>
								                 <div class="col-md-4">
								                      <label class="h6">Initial Fine:</label>
								                      <div>
								                      <input type="number" value="{{$policy->late_initial_fine}}" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" min="0" id="late_initial_fine" class="form-control" placeholder="XXXX">
								                  </div>
								                 </div>
								                 <div class="col-md-4">
								                      <label class="h6">Maximum Fine:</label>
								                      <div>
								                      <input type="number" value="{{$policy->late_maximum_fine}}" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" min="0" id="late_maximum_fine" class="form-control" placeholder="XXXX">
								                  </div>
								                 </div>
								               </div>
								               <br>
								               <div class="form-group row">
								                    <div class="col-md-4">
								                      <label class="h6">Leave Quota:</label>
								                      <div>
								                      <input type="number" value="{{$policy->leave_quota}}" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" min="0" id="leave_quota" class="form-control" placeholder="XXXX">
								                  </div>
								                 </div>
								              </div>
								              <br>
								              <div class="form-group row">
								                    <div class="col-md-4">
								                      <label class="h6">Apply Absent Fine When X No. of Lates:</label>
								                      <div>
								                      <input type="number" value="{{$policy->apply_absent}}" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" min="0" id="apply_absent" class="form-control" placeholder="XXXX">
								                  </div>
								                 </div>
								              </div>
								              <br><br>
								              <div id="cs_table" hidden="true">
								              <div class="card-header clearfix">
								                  <h5 class="card-title float-left font-weight-bold">Grouped:</h5>
								              </div><br>
								               @if($policy->wing_id == 2)
								              <div class="form-group row">
								              	    <div class="col-md-4">
								                      <label class="h6">Struck off Limit:</label>
								                      <div>
								                      <input type="number" name="struck_off_limit[]" value="{{$policy->studentAttendancePolicyDetails()->first()->struck_off_limit}}" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" min="0" id="struck_off_limit" class="form-control" placeholder="XXXX">
								                  </div>
								                 </div>
								              </div>
								              @endif
								          </div>
								          <div id="ims_table" hidden="true">
								          	<div class="card-header clearfix">
								                  <h5 class="card-title float-left font-weight-bold">Credit:</h5>
								                  <button class="btn btn-dark btn-sm mb-3 float-right" onclick="editCredit(event)">
								                  <i class="fa fa-plus"></i> | Add Details
								                  </button>
								              </div>
								              <div class="table-responsive">
								              <table class="table table-striped border-hover table-bordered" id="editTableCreditCourse">
							                      <thead>
							                        <tr>
							                          <th>Credit Hour:</th>
							                          <th>Struck off Limit:</th>
							                          <th>Action</th>
							                        </tr>
							                      </thead>
							                      <tbody>
							                      	@forelse($policy->studentAttendancePolicyDetails as $key => $detail)
							                        <tr id="editCreditCourse_{{ $key }}" row_status="unchanged">
							                          <td>
							                          	<input type="number" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" min="0" id="credit_hour_{{ $key }}" name="credit_hour[]" class="form-control" placeholder="XXXX" value="{{ $detail->credit_hour }}">
							                          </td>
							                          <td>
							                            <input type="number" name="struck_off_limit[]" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" min="0" id="struck_off_limit_{{ $key }}" class="form-control" placeholder="XXXX" value="{{ $detail->struck_off_limit }}" >
							                          </td>
							                          <td>
							                            <button type="button" row_index="{{ $key }}" class="btn btn-danger btn-sm editDeleteCreditCourseButton"><i class="fa fa-times fa-fw"></i> | Delete</button>
							                          </td>
							                        </tr>
							                        @empty
							                        <tr id="editCreditCourse_0" row_status="unchanged">
							                          <td>
							                          	<input type="number" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" min="0" id="credit_hour_0" name="credit_hour[]" class="form-control" placeholder="XXXX">
							                          </td>
							                          <td>
							                            <input type="number" name="struck_off_limit[]" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" min="0" id="struck_off_limit_0" class="form-control" placeholder="XXXX">
							                          </td>
							                          <td>
							                            <button type="button" row_index="0" class="btn btn-danger btn-sm editDeleteCreditCourseButton"><i class="fa fa-times fa-fw"></i> | Delete</button>
							                          </td>
							                        </tr>
							                        @endforelse
							                      </tbody>
							                    </table>
							                </div>
								         </div>
								         <button id="editButtonTest" class="btn btn-primary" type="button"> Update </button>
            
                                                {{-- <div class="form-group">
                                                    <div>
                                                        <button type="submit" class="btn btn-pink waves-effect waves-light">
                                                            Submit
                                                        </button>
                                                        <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                                            Cancel
                                                        </button>
                                                    </div>
                                                </div> --}}
                                            </form>
            
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
            

                        </div><!-- container -->

                    </div> <!-- Page content Wrapper -->


@include('includes/footer_start')
<script>
	var detail_count = {{ count($policy->studentAttendancePolicyDetails) }};
</script>
<script type="text/javascript" src="{{asset('js/finePolicy/editFinePolicy.js')}}"></script>
<script type="text/javascript" src="{{asset('js/finePolicy/finePolicyUpdate.js')}}"></script>
@include('includes/footer_end')