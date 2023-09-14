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
                                    <input type="date" name="start_date" id="start_date" data-date-format="YYYY-MM-DD" value="<?php echo date("Y-m-d"); ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    End Date:
                                </label>
                                <div>
                                    <input type="date" name="end_date" id="end_date" data-date-format="YYYY-MM-DD" value="<?php echo date("Y-m-d"); ?>" class="form-control">
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
                            <button class="btn btn-success" onclick="getFilteredData()">
                                <i class="mdi mdi-filter">
                                </i>
                                Filter
                            </button>
                            <a class="btn btn-secondary" href="{{route('followups.index')}}">
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
        <div class="card m-b-30">
            <div class="card-body">
                <div class="padding-10 div-border">
                    <div class="row">
                            
                        <div class="col-3 btn-group" role="group">
                            <h6 class="letter-capitalize" id='followup_count'></h6>
                        </div> 
                        <div class="col-1">
                        </div> 
                        <div class="col-4"></div>
                        <div class="col-4">
                            <button onclick="exportCourseEnquiryReportToExcel()" id="emp_attendance_export" class="btn btn-info btn-sm waves-effect pull-right margin-left-5">
                                 <i class="mdi mdi-file-excel"></i> Export To Excel
                            </button>
                        </div> 
                    </div>
                    <table cellspacing="0" class="table table-striped table-bordered" id="course_wise_report_table" isdefault="true" width="100%">
                        <thead>
                            <tr>
                                <th>
                                    Date
                                </th>
                                <th>
                                   Admitted
                                </th>
                                <th>
                                    Interested
                                </th>
                                <th>
                                 Not Interested
                                </th>
                              
                            </tr>
                        </thead>
                        <tbody id="course_wise_report">
                        </tbody>
                    </table>
                </div>
              
            </div>
        </div>
    </div>
</div>
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('js/enquiry/filters.js')}}"></script>

