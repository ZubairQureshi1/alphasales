<div class="row filters-on-print">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="form-group">
                    <input name="isFilteredRequest" type="hidden" value="true">
                        <div class="row">
                            <div class="col-md-3">
                                <label>
                                    Start Date:
                                </label>
                                <div>
                                    <input type="month" name="start_date" id="employee_start_date" data-date-format="MM-DD" value="{{ date('yyyy-MM') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    End Date:
                                </label>
                                <div>
                                    <input type="month" name="end_date" id="employee_end_date" data-date-format="MM-DD" value="{{ date('m-Y') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    Session:
                                </label>
                                <div>   
                                    {{ Form::select('session_id', App\Models\Session::pluck('session_name','id'), null, ['class' => 'form-control select2', 'id' => 'employee_session_id']) }}
                                </div>
                            </div>
                        </div>
                    </input>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4 text-center">
                            {{-- <button class="btn btn-info" onclick="exportReportingToExcel('../accounts/exportReportingToExcel')">
                                <i class="mdi mdi-filter">
                                </i>
                                Export
                            </button> --}}
                            <button class="btn btn-success" onclick="getEmployeeFilteredData()">
                                <i class="mdi mdi-filter">
                                </i>
                                Filter
                            </button>
                            <a class="btn btn-secondary" href="{{ url()->current() }}">
                                <i class="mdi mdi-recycle">
                                </i>
                                Clear Filter
                            </a>
                        </div>
                        <div class="col-md-4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card m-b-30">{{-- 
            <div class="card-header card-custom-header">
                <div class="clearfix">
                    <div class="float-left">
                        <h6 class="card-title text-center font-weight-Light"></h6>
                    </div>
                </div>
            </div> --}}
            <div class="card-body">
                <div class="padding-10 div-border">
                    <div class="row">
                            
                        <div class="col-3 btn-group" role="group">
                            <h6 class="letter-capitalize">Enquiry CSO Wise Report</h6>
                        </div> 
                        <div class="col-1">
                        </div> 
                        <div class="col-4"></div>
                        <div class="col-4">
                            <button onclick="exportEmployeeEnquiryReportToExcel()" id="emp_attendance_export" class="btn btn-info btn-sm waves-effect pull-right margin-left-5">
                                 <i class="mdi mdi-file-excel"></i> Export To Excel
                            </button>
                        </div> 
                    </div>
                    @include('layouts/loading')
                    <div id="employee_table_div"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('js/reporting/enquiryModule/enquiry_employee_wise.js')}}"></script>

