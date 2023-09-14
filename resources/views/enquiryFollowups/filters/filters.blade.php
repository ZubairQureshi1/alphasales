<div class="row filters-on-print">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="form-group">
                    <input name="isFilteredRequest" type="hidden" value="true">
                        <div class="row">
                            <div class="col-md-2">
                                <label>
                                    Sessions:
                                </label>
                                <div>
                                    {!! Form::select('session_id', \Auth::user()->userAllowedSessions()->get()->pluck('session_name', 'session_id'), Illuminate\Support\Facades\Session::get('selected_session_id'), ['id' => 'session_id', 'class' => 'form-control select2-multiple', 'placeholder' => '--- Select Session ---']) !!}
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label>
                                    Student Type:
                                </label>
                                <div>
                                    {!! Form::select('student_category_id', config('constants.student_categories'), null, ['id' => 'student_category_id', 'class' => 'form-control select2-multiple', 'placeholder' => '--- Select Student Type ---']) !!}
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label>
                                    Followup Status:
                                </label>
                                <div>
                                    {!! Form::select('followup_status_id', config('constants.followup_statuses'), null, ['id' => 'followup_status_id', 'class' => 'form-control select2 data-filters', 'data-placeholder' => '--- Select Followup Status ---']) !!}
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label>
                                    Start Date:
                                </label>
                                <div>
                                    <input type="date" name="start_date" id="start_date" data-date-format="YYYY-MM-DD" value="<?php echo date("Y-m-d"); ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
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
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('js/followup/filter.js')}}"></script>

