<div class="row">
    {{-- <h6 class="col-md-3" id="form_code" value="Form Code: {{ $form_code }}">
        Form Code: {{ $form_code }}
    </h6> --}}
    <div style="display:none" class="col-md-3" id="session_div">
        {!! Form::label('session', 'Session:') !!}<span style="color: red">*</span>
        {{ Form::select('session_id', \Auth::user()->userAllowedSessions()->get()->pluck('session_name', 'session_id'), \Auth::user()->userAllowedSessions()->count()>0?Illuminate\Support\Facades\Session::get('selected_session_id'):null, ['class' => 'form-control select2 item-required', 'id' => 'session_id', 'placeholder' => '--- Select Session ---', 'onchange' => 'getCoursesBySession()', 'never-bypass' => true, 'errorLabel' => 'Session', 'disabled']) }}
    </div>
    
</div>
<div class="row">
    <div class="col-md-12 m-b-10">
        <strong>Assign Section:</strong>
        <div class="m-t-10 div-border">
            <div class="margin-10">
                <div class="row">
                     <div class="col-md-3">
                        <label>Academic Wing:<span style="color: red">*</span></label>
                        @if(count($wings)!=0)
                            {!! Form::select('wing_id', $wings, null, ['id' => 'wing_id', 'onChange' => 'onWingSelect()', 'class' => 'form-control select2 item-required', 'placeholder' => '--- Select Academic Wing ---', 'errorLabel' => 'Academic Wing']) !!}
                        @else
                            @include('includes/not_found')
                        @endif
                    </div>
                    <div class="col-md-3">
                        <label>Course:<span style="color: red">*</span></label>
                        <select onchange="onSeclectCourse()" id="course_id" class="form-control select2 item-required" data-placeholder="---Select Course---" errorLabel="Course">
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Affiliated Body:<span style="color: red">*</span></label>
                        <select onchange="onAffiliatedBodySelect()" id="affiliated_body_id" class="form-control select2 item-required" data-placeholder="---Select Affiliated Body---"  errorLabel="Affiliated Body">
                        </select>
                    </div>
                    {{-- Annaul / Year --}}
                    <div class="form-group col-md-3">
                        <label>Annaul / Year:<span style="color: red">*</span></label>
                        <select id="term_id" class="form-control select2 item-required header-required" data-placeholder="--- Select Term  / Year---" errorLabel="Academic Term / Year">
                        </select>
                    </div>
                    {{-- SHIFT --}}
                    <div id="shift_id_div" class="form-group col-3">
                      <label>Shift:<span style="color: red">*</span></label>
                      {{ Form::select('shift_id', config('constants.shifts'), null ,[ 'id' => 'shift_id', 'class' => 'form-control select2 item-required header-required', 'placeholder' => '--- Select Shift ---', 'errorLabel' => 'Shift']) }}
                    </div>
                    {{-- GENDER --}}
                    <div id="gender_id_div" class="form-group col-md-3" hidden="true">
                      <label>Gender:<span style="color: red">*</span></label>
                      {!! Form::select('gender_id', array_slice(config('constants.genders'), 0, 2, true), null, ['id' => 'gender_id', 'class' => 'form-control select2 item-required header-required', 'errorLabel' => 'Gender', 'placeholder' => '--- Select Gender ---']) !!}
                    </div>
                </div>
            </div>
        </div>
        @include('layouts/loading')
    </div>
</div>
<div class="row">
    <div class="col-md-12 m-b-10">
        <div class="form-group">
            <div class="text-right">
                <h5 class="font-weight-bold">
                    <span>Total Students:</span>
                    <label id="totalStudents">{{ '0' }}</label>
                </h5>
                <button class="btn btn-outline-dark btn-sm waves-effect waves-light" onclick="checkForStudentCount()" type="button">
                    <i class="fa fa-search fa-fw"></i> | Check Students
                </button>
                <button class="btn btn-success btn-sm waves-effect waves-light" onclick="validateForm()" type="button">
                    <i class="fa fa-cloud-upload fa-fw"></i> | Assign Section
                </button>
            </div>
        </div>  
    </div>
    {{-- STUDENTS COUNT --}}
    <div class="col-md-12">
        <div id="alloted_students_list"></div>
    </div>
</div>