<style type="text/css">
    @media print {
        .page-break {page-break-before: always;}
        .on-print {
            display: block !important;
        }
        .before-print{
            display: none !important;
        }
    }
</style>
<div class="row before-print">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body div-border-rad">
                <div class="box box-primary">
                    <div class="box-body">
                        <strong class="card-title">Attendance Summary For</strong>
                        <hr>
                        <div class="swap-for-content">
                            <div class="row">
                                <div class="col-md-2">
                                    <label>
                                        Summary Type:
                                    </label>
                                    <div>
                                        {!! Form::select('summary_type_id', ['Individual', 'Overall'], 0, ['id' => 'summary_type_id', 'class' => 'form-control select2 select2', 'placeholder' => '--- Select Type ---', 'onchange' => 'onSummaryTypeSelect()']) !!}
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label>
                                        Session:
                                    </label>
                                    <div>
                                        {!! Form::select('session_id', App\Models\Session::get()->pluck('session_name', 'id'), null, ['id' => 'session_id', 'class' => 'form-control select2 select2', 'placeholder' => '--- Select Session ---']) !!}
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label>
                                        Courses:
                                    </label>
                                    <div>
                                        {!! Form::select('course_id', App\Models\Course::get()->pluck('name', 'id'), null, ['id' => 'course_id', 'class' => 'form-control select2 select2', 'placeholder' => '--- Select Course ---']) !!}
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label>
                                        Part:
                                    </label>
                                    <div>
                                        {!! Form::select('part_id', ['1' => 1, '2' => 2], null, ['id' => 'part_id', 'class' => 'form-control select2 select2', 'placeholder' => '--- Select Part ---']) !!}
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label>
                                        Section:
                                    </label>
                                    <div>
                                        {!! Form::select('section_id', App\Models\Section::get()->pluck('name', 'id'), null, ['id' => 'section_id', 'class' => 'form-control select2 select2', 'placeholder' => '--- Select Section ---']) !!}
                                    </div>
                                </div>
                                <div class="col-md-2" id="student_select" hidden="hidden">
                                    <label>
                                        Student:<span class="required-span">*</span>
                                    </label>
                                    <div>
                                        {!! Form::select('student_id', [], null, ['id' => 'student_id', 'onchange' => 'setTitleForSummary()', 'class' => 'form-control select2 select2', 'placeholder' => '--- Select Student ---']) !!}
                                    </div>
                                    <span id="student_id_message"></span>
                                </div>
                                <div class="col-md-2" id="start_select" hidden="hidden">
                                    <label>
                                        Start Date:<span class="required-span">*</span>
                                    </label>
                                    <div>
                                        {!! Form::date('start_date', null, ['id' => 'start_date', 'data-date-format' => 'YYYY-MM-DD', 'class' => 'form-control select2 select2']) !!}
                                    </div>
                                    <span id="start_date_message"></span>
                                </div>
                                <div class="col-md-2" id="end_select" hidden="hidden">
                                    <label>
                                        End Date:<span class="required-span">*</span>
                                    </label>
                                    <div>
                                        {!! Form::date('end_date', null, ['id' => 'end_date', 'data-date-format' => 'YYYY-MM-DD', 'class' => 'form-control select2 select2']) !!}
                                    </div>
                                    <span id="end_date_message"></span>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-12 text-center">
                                    <button class="btn btn-success" id="filter_button" hidden="hidden" onclick="getFilteredStudents('{{ route('attendance.getFilteredStudents') }}')"><i class="ion ion-android-sort"> Filter</i></button>
                                    <button class="btn btn-info"  id="summary_button" hidden="hidden" onclick="generateAttendanceSummary('{{ route('attendance.generateAttendanceSummary') }}')"><i class="ion ion-clipboard"> Generate Summary</i></button>
                                </div>
                            </div>
                            @include('layouts/loading')

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
            <div class="card-body div-border-rad">
                <div class="box box-primary">
                    <div class="box-body" id="summary_box_body">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>