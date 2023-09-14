<!-- Name Field -->
<!-- Student Personel Information: -->
<div class="m-b-10">
    <strong> <i class="fa fa-user" aria-hidden="true"></i> User Personal Information:</strong>
    <div class="m-t-10 div-border-rad">
        <div class="margin-10">
            <div class="row">
                <div class="form-group col-sm-3">
                    {!! Form::label('name', 'Name:') !!}<span style="color: red">*</span>
                    {!! Form::text('name', $user->name, ['class' => 'form-control letter_capitalize', 'onkeypress'=> 'return alphabaticOnly(event)', 'placeholder' => 'Enter Full Name', 'value' => old('name'), 'required' ]) !!}
                </div>
                <div class="form-group col-sm-3">
                    {!! Form::label('father_name', 'Father Name:') !!}<span style="color: red">*</span>
                    {!! Form::text('father_name', $user->father_name, ['class' => 'form-control letter_capitalize', 'onkeypress'=> 'return alphabaticOnly(event)', 'placeholder' => 'Enter Father Name', 'value' => old('father_name'), 'required' ]) !!}
                </div>
                <div class="form-group col-sm-3">
                    {!! Form::label('gender', 'Gender:') !!}<span style="color: red">*</span>
                    {!! Form::select('gender_id', config('constants.genders'), $user->gender, ['id' => 'gender_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Gender ---', 'value' => old('gender_id'), 'required']) !!}
                </div>
                <div class="form-group col-sm-3">
                    {!! Form::label('d_o_b', 'DOB:') !!}
                    {!! Form::date('d_o_b', strftime('%Y-%m-%d', strtotime($user->d_o_b)), ['id' => 'd_o_b' ,'class' => 'form-control', 'onchange'=>'calculateAge()', 'data-date-format'=>'YYYY-MM-DD', 'max' => date('Y-m-d'), 'value' => old('d_o_b') ]) !!}
                </div>
                <div class="form-group col-sm-3">
                    {!! Form::label('age', 'Age:') !!}
                    {!! Form::number('age', $user->age, ['id' => 'age' ,'class' => 'form-control', 'readonly', 'value' => old('age') ]) !!}
                </div>
                
                <div class="form-group col-sm-3">
                    {!! Form::label('religion', 'Religion:') !!}<span style="color: red">*</span>
                    {!! Form::select('religion_id', config('constants.religions'), $user->religion_id, ['id' => 'religion_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Religion ---', 'value' => old('religion_id'), 'required' ]) !!}
                </div>
                <div class="form-group col-sm-3">
                    {!! Form::label('martialstatus', 'Martial Status:') !!}<span style="color: red">*</span>
                    {!! Form::select('martial_status_id', config('constants.martial_status'), $user->martial_status_id, ['id' => 'martisal_status_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Marital Status ---', 'value' => old('martial_status_id'), 'required']) !!}
                </div>
                <div class="form-group col-sm-3">
                    {!! Form::label('blood_group', 'Blood Group:') !!}
                    {!! Form::select('blood_group_id',config('constants.blood_groups'),$user->blood_group_id,['id' => 'blood_group_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Blood Group ---', 'value' => old('blood_group_id') ]) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- User Account Information: -->
<div class="m-b-10">
    <strong> <i class="fa fa-user-secret" aria-hidden="true"></i> User Account Information:</strong>
    <div class="m-t-10 div-border-rad">
        <div class="margin-10">
            <div class="row">
                <div class="form-group col-sm-3">
                    {!! Form::label('username', 'User Name:') !!}<span style="color: red">*</span>
                    {!! Form::text('username', $user->username, ['class' => 'form-control', 'placeholder' => 'Enter Username', 'value' => old('username'), 'required' ]) !!}
                </div>
                <!-- Price Field -->
                <div class="form-group col-sm-3">
                    {!! Form::label('email', 'Email:') !!}<span style="color: red">*</span>
                    {!! Form::email('email', $user->email, ['class' => 'form-control', 'placeholder' => 'abc@xyz.com', 'value' => old('email'), 'required',  'onchange'=>'checkEmailDuplicacy()']) !!}
                    <span id="email_message"></span>
                </div>
                <!-- <div class="form-group col-sm-3">
                    {!! Form::label('password', 'Password:') !!}
                    <br>
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Enter New Password', 'minlength' => '6']) !!}
                </div> -->
              <!-- {{--   <div class="form-group col-sm-3">
                    {!! Form::label('session', 'Sessions Allowed:') !!}<span style="color: red">*</span>
                    {!! Form::select('allowed_sessions[]', App\Models\Session::pluck('session_name', 'id'), $user->userAllowedSessions->pluck('session_id'), ['session_id' => 'allowed_sessions', 'class' => 'form-control select2', 'data-placeholder' => '--- Select Session ---', 'value' => old('allowed_sessions[]'), 'multiple' => 'multiple', 'required' ]) !!}
                </div> --}} -->
                <!-- {{-- <div class="form-group col-sm-3">
                    {!! Form::label('permanent/ visiting','Permanent / Visiting') !!}<span style="color: red">*</span>
                    <select class="form-control" id="faculty_type" name="faculty_type" value="{{ old('faculty_type') }}" required onchange="onTeacherTypeSelect()">
                        <option {{$user->faculty_type == null ? 'selected' : ''}} value="">---- Select ----</option>
                        @foreach(\Config::get('constants.faculty_types') as $key => $faculty_type)
                        <option {{$key === $user->faculty_type ? 'selected' : ''}} value="{{$key}}">{{$faculty_type}}</option>
                        @endforeach
                    </select>
                </div> --}} -->
                @if($user->faculty_type == '1')
                {{-- <div class="form-group col-sm-3" id="experience_level">
                    <label>Experience Level</label>
                    <select class="form-control" name="experience_level" id="experience_level_id" onchange="onExperienceLevelSelect()">
                        <option value="">--- Select Experience Level ---</option>
                        @foreach(\Config::get('constants.hourly_rates') as $key => $hourly_rate)
                        <option {{$user->experience_level == $key ? 'selected' : ''}} value="{{$key}}">{{$hourly_rate["name"]}}</option>
                        @endforeach
                    </select>
                </div> --}}
                @elseif($user->faculty_type == '0')
                {{-- <div class="form-group col-sm-3" id="experience_level">
                    <label>Fixed Salary</label>
                    <input type='text' name='fixed_salary' id='fixed_salary_id' value="{{$user->fixed_salary}}" class='form-control' placeholder='Enter Fixed Salary'>
                </div> --}}
                @endif
{{-- 
                <div class="form-group col-sm-3" id="hourly_rate_range_field" {{ $user->faculty_type == '1' ? '' : 'hidden="true"' }}>
                    <label>Hourly Rate</label>
                    <input type='number' name='hourly_salary_rate' value="{{$user->hourly_salary_rate}}" id='hourly_rate_id' class='form-control' placeholder='Enter Hourly Rate'>
                </div> --}}
             
            </div>
            <div class="row">
                <div class="col-12">
                    <strong>Organization Details:</strong>
                    <div class="margin-10 div-border-rad">
                       <div class="row padding-10">
                            <div class="col-3">
                                {!! Form::label('organization', 'Organization:') !!}<span style="color: red">*</span>

                                {!! Form::select('organization_id', App\Models\Organization::pluck('name', 'id'), $user->campusDetails != null and isset($user->campusDetails->first()->organization_id) ? $user->campusDetails->first()->organization_id : null, ['id' => 'organization_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Organization ---', 'required', 'value' => old('organization_id') ]) !!}
                            </div>
                            <div class="col-3">
                                {!! Form::label('campuses', 'Offices:') !!}<span style="color: red">*</span>
                                {!! Form::select('campus_ids[]', App\Models\OrganizationCampus::pluck('name', 'id'), $user->campusDetails != null ? $user->campusDetails->pluck('organization_campus_id') : null, ['id' => 'campus_id', 'class' => 'form-control select2', 'multiple'=>'multiple', 'data-placeholder' => '--- Select Office ---', 'required', 'value' => old('campus_ids[]') ]) !!}
                            </div>
                            <div class="col-3">
                                {!! Form::label('roles', 'Roles:') !!}
                                <select class="form-control select2" id="role_id" name="role">
                                    @foreach ($roles as $role)
                                        <option {{ $user['user_role']['name'] == $role->name ? 'selected' : '' }} value="{{ $role->name }}">
                                            {{ $role->display_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- <div class="col-12" id="campuses_div">
                                @if($user->campusDetails->count() > 0)
                                    @foreach($user->campusDetails as $campusDetail)
                                        @php
                                            $designations = App\Models\Designation::where('organization_id', $campusDetail->organization_id)->get();
                                            $newDesignations = [];

                                            foreach ($designations as $key => $designation) {
                                                if ($designation->campuses()->where('organization_campus_id', $campusDetail->organization_campus_id)->exists()) {
                                                    $newDesignations[] = $designation;
                                                }
                                            }
                                        @endphp
                                        <div class="row {{$campusDetail->campus->name_for_ids}}" id="{{$campusDetail->campus->name_for_ids}}" fromDatabase="true">
                                            <div class="col-12">
                                                <label class="margin-top-5 padding-5">{{ $campusDetail->organization_campus_name }}</label>
                                                <div class="div-border-rad padding-10">
                                                    <div class="row">
                                                        <div class="form-group col-sm-3">
                                                            <input type="hidden" name="{{ $campusDetail->campus->name_for_ids.'[campus_detail_id]' }}" value="{{ $campusDetail->id }}">
                                                            {!! Form::label('designation', 'Designation:') !!}<span style="color: red">*</span><br>
                                                            {!! Form::select($campusDetail->campus->name_for_ids.'[designation_id]', collect($newDesignations)->pluck('name', 'id') , $campusDetail->designation->id, ['id' => $campusDetail->campus->name_for_ids.'designation_select', 'class' => 'form-control  select2', 'placeholder' => '--- Select Designation---', 'required', 'name_for_ids' => $campusDetail->campus->name_for_ids, 'onchange'=>'getDesignationDepartments(event)', 'data-campus-id' => $campusDetail->campus->id ]) !!}
                                                        </div>

                                                        <div class="form-group col-sm-3" id="{{$campusDetail->campus->name_for_ids.'_department_div'}}">
                                                            {!! Form::label('department', 'Department:') !!}<span style="color: red">*</span><br>
                                                            {!! Form::select($campusDetail->campus->name_for_ids.'[department_ids][]', App\Models\DesignationDepartment::where('designation_id', $campusDetail->designation_id)->get()->pluck('department_name', 'department_id'), $campusDetail->userDepartments->pluck('department_id') , ['id' => $campusDetail->campus->name_for_ids.'_department', 'class' => 'form-control select2', 'data-placeholder' => '--- Select Department ---', 'required', 'multiple']) !!}
                                                        </div>

                                                        <div class="form-group col-sm-3">
                                                            {!! Form::label('role', 'Role:') !!}<br>
                                                            {!! Form::select($campusDetail->campus->name_for_ids.'[role]', Spatie\Permission\Models\Role::pluck('display_name', 'id'), $campusDetail->role->id, [ 'id' => 'roles_select', 'class' => 'form-control  select2', 'placeholder' => '--- Select Role ---', 'required']) !!}
                                                        </div> 
                                                        <div class="form-group col-sm-3">
                                                            {!! Form::label('job_title', 'Job Title:') !!}<br>
                                                            {!! Form::select($campusDetail->campus->name_for_ids.'[job_title]', App\Models\JobTitle::pluck('name','id') , $campusDetail->job_title_id, ['id' => 'roles_select', 'class' => 'form-control  select2', 'placeholder' => '--- Select Job Title ---', 'required']) !!}
                                                        </div>
                                                        <!-- <div class="col-md-2 form-group text-center">
                                                            <label>Working(Active)</label><br>
                                                            <div class="custom-control custom-checkbox">
                                                               <input type="checkbox" class="custom-control-input" name="{{$campusDetail->campus->name_for_ids.'[is_working]' }}" id="{{$campusDetail->campus->name_for_ids.'[is_working]' }}" {{$campusDetail->is_working == 1 ? 'checked' : ''}} >
                                                               <label class="custom-control-label" for="{{$campusDetail->campus->name_for_ids}}[is_working]"></label>
                                                            </div>
                                                        </div> -->
                                                        <!-- <div class="col-md-2 form-group text-center">
                                                            <label>Primary Employee Code</label><br>
                                                            <div class="custom-control custom-checkbox">
                                                               <input type="checkbox" class="custom-control-input chk" name="{{$campusDetail->campus->name_for_ids.'[is_primary_emp_code]' }}" id="{{$campusDetail->campus->name_for_ids.'[is_primary_emp_code]' }}" {{$campusDetail->is_primary_emp_code == 1 ? 'checked' : ''}} >
                                                               <label class="custom-control-label" for="{{$campusDetail->campus->name_for_ids}}[is_primary_emp_code]"></label>
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div> --}}
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Quick Contact-->
<div class="m-b-10">
    <strong> <i class="fa fa-phone-square" aria-hidden="true"></i> Quick Contact:</strong>
    <div class="m-t-10 div-border-rad">
        <div class="margin-10">
            <div class="row">
                <div class="form-group col-sm-4">
                    {!! Form::label('mobile_no', 'Mobile no:') !!}<span style="color: red">*</span>
                    {!! Form::tel('mobile_no', $user->mobile_no, ['class' => 'form-control', 'pattern' => '[0-9]{4}[0-9]{7}', 'onkeypress'=> 'return numericOnly(event)', 'maxlength' => '11', 'placeholder' => 'Enter Mobile No.', 'value' => old('mobile_no'), 'required']) !!}
                    <span class="text-danger">Format should be like 03001234567</span>
                </div>
                <div class="form-group col-sm-4">
                    {!! Form::label('landline', 'Land Line:') !!}
                    {!! Form::tel('landline_no', null, ['class' => 'form-control', 'onkeypress' => 'return numericOnly(event)', 'maxlength' => '13', 'placeholder' => 'Enter Landline No.', 'pattern' => '[0-9]{4}[0-9]{7}', 'title' => 'Please enter a valid landline number in the format XXX-XXXX-XXXX', 'value' => old('landline_no')]) !!}
                    <span class="text-danger">Format should be like 04231234567</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!--CNIC-->
<div class="m-b-10">
    <strong> <i class="fa fa-id-card" aria-hidden="true"></i> CNIC Details:</strong>
    <div class="m-t-10 div-border-rad">
        <div class="margin-10">
            <div class="row">
                <div class="form-group col-sm-4">
                    {!! Form::label('cnic_no', 'CNIC no:') !!}<span style="color: red">*</span>
                    {!! Form::text('cnic_no', $user->cnic_no, ['class' => 'form-control', 'pattern' => '[0-9]{5}-[0-9]{7}-[0-9]{1}', 'onkeypress'=> 'return numericOnly(event)', 'maxlength' => '15', 'placeholder' => 'Enter CNIC No.', 'value' => old('cnic_no'), 'required']) !!}
                    <span class="text-danger">Format should be like 35202-1234567-8</span>
                </div>
                <!-- <div class="form-group col-sm-4">
                    {!! Form::label('attachment', 'Attachment:') !!}
                    {!! Form::file('attachment', null, ['class' => 'form-control']) !!}
                </div> -->
                <!-- Price Field -->
                <!-- <div class="form-group col-sm-4">
                    {!! Form::label('cnic_expiry', 'CNIC Expiry:') !!}
                    {!! Form::date('cnic_expiry', $user->cnic_expiry, ['class' => 'form-control']) !!}
                </div> -->
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4 mt-3">
        <a href="{!! route('users.index') !!}" class="btn btn-light btn-sm active rounded-0"><i class="fa fa-remove fa-fw text-danger"></i> Cancel</a>
        {!! Form::submit("Update Information", ['class' => 'btn btn-dark btn-sm rounded-0']) !!}
    </div>
</div>