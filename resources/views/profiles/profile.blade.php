
<!-- Name Field -->
<!-- Student Personel Information: -->
 
{!! Form::model($user, ['route' => ['users.changePassword', $user->id], 'method' => 'patch']) !!}

  <div class="modal fade change_password" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title mt-0">Change<strong> Password</strong></h5>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
          New Password:
          {!! Form::password('password', ['id' => 'password', 'class' => 'form-control']) !!}<br>
          Confirm New Password:
          {!! Form::password('confirm_password', ['id' => 'confirm_password', 'class' => 'form-control']) !!}
          <span id="message"></span>

        </div>
        <div class="modal-footer">
          {!! Form::submit('Save', ['class' => 'btn btn-primary submit_password', 'disabled' => '']) !!}
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
{!! Form::close() !!}

<div class="m-b-10">
    <div class="row">
        <div class="col-lg-12">

            <button type="button" class="btn btn-primary pull-right btn-sm" onclick="editable('savebtn','editable')"> <i class="mdi mdi-pencil" aria-hidden="true"></i> | Edit Profile</button>
            
            <button type="button" id="add" class="btn btn-dark pull-right btn-sm m-r-5"  data-toggle="modal" data-target=".change_password"><i class="fa fa-unlock-alt fa-fw"></i> | Change Password</button>
            
          {{--   @if(Auth::user()->isSuperAdmin())
            <a type="button" class="btn btn-dark pull-right btn-sm m-r-5" href="{{ route('admin.activityLogs', [$user->id]) }}"> <i class="mdi mdi-file-tree" aria-hidden="true"></i> | Activity Logs</a>
            @endif --}}
        </div>
    </div>
    <strong> <i class="fa fa-user" aria-hidden="true"></i> User Personal Information:</strong>
    <div class="m-t-10 div-border-rad">
        <div class="margin-10">

            <form name="userform" method="post" action="{{ route('profiles.update_details') }}">
                @csrf
                <div class="row">
                    <div class="form-group col-sm-4">
                        {!! Form::label('name', 'Name:') !!}
                        {!! Form::text('name', $user->display_name, ['class' => 'form-control editable' ,'disabled' => 'true']) !!}
                    </div>
                    <div class="form-group col-sm-4">
                        {!! Form::label('father_name', 'Father Name:') !!}
                        {!! Form::text('father_name', $user->father_name, ['class' => 'form-control editable' ,'disabled' => 'true']) !!}
                    </div>
                    <div class="form-group col-sm-4">
                        {!! Form::label('gender', 'Gender:') !!}
                        {!! Form::select('gender_id', config('constants.genders'), $user->gender, ['id' => 'gender_id', 'class' => 'form-control select2-multiple editable', 'disabled' => 'true', 'placeholder' => '--- Select Gender ---']) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-4">
                        {!! Form::label('age', 'Age:') !!}
                        {!! Form::number('age', $user->age, ['class' => 'form-control editable', 'disabled' => 'true']) !!}
                    </div>    

                    <div class="form-group col-sm-4">
                        {!! Form::label('religion', 'Religion:') !!}
                        {!! Form::select('religion_id', config('constants.religions'), $user->religion_id, ['id' => 'religion_id', 'class' => 'form-control select2-multiple editable', 'disabled' => 'true' ,'placeholder' => '--- Select Religion ---']) !!}
                    </div>

                    <div class="form-group col-sm-4">
                        {!! Form::label('d_o_b', 'DOB:') !!}
                        {!! Form::date('d_o_b', $user->d_o_b, ['class' => 'form-control editable' ,'disabled' => 'true']) !!}
                    </div>

                </div>
                <div class="row">
                    <div class="form-group col-sm-4">
                        {!! Form::label('martialstatus', 'Martial Status:') !!}
                        {!! Form::select('martial_status_id', config('constants.martial_status'), $user->martial_status_id, ['id' => 'martisal_status_id', 'class' => 'form-control select2-multiple editable', 'disabled' => 'true', 'placeholder' => '--- Select Martial Status ---']) !!}
                    </div>
                    <div class="form-group col-sm-4">
                        {!! Form::label('blood_group', 'Blood Group:') !!}
                        {!! Form::select('blood_group_id',config('constants.blood_groups'),$user->blood_group_id,['id' => 'blood_group_id', 'class' => 'form-control select2-multiple editable', 'disabled' => 'true' ,'placeholder' => '--- Select Blood Group ---']) !!}
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
                    <div class="form-group col-sm-6">
                        {!! Form::label('username', 'User Name:') !!}
                        {!! Form::text('username', $user->username, ['class' => 'form-control editable', 'disabled' => 'true']) !!}
                    </div>
                  <!-- {{--   
                    <div class="form-group col-sm-6">
                        {!! Form::label('session', 'Sessions Allowed:') !!}
                        {!! Form::select('allowed_sessions[]', App\Models\Session::pluck('session_name', 'id'), $user->userAllowedSessions->pluck('session_id'), ['session_id' => 'allowed_sessions', 'class' => 'form-control select2', 'data-placeholder' => '------', 'multiple' => 'multiple', 'disabled' ]) !!}
                    </div>
 --}} -->
                   <!-- {{--  <div class="form-group col-sm-3">
                        {!! Form::label('permanent/ visiting','Permanent / Visiting') !!}
                        <select class="form-control" id="faculty_type" onchange="onTeacherTypeSelect()" disabled>
                            <option {{$user->faculty_type == null ? 'selected' : ''}} value="">------</option>
                            @foreach(\Config::get('constants.faculty_types') as $key => $faculty_type)
                            <option {{$key === $user->faculty_type ? 'selected' : ''}} value="{{$key}}">{{$faculty_type}}</option>
                            @endforeach
                        </select>
                    </div>
 --}} -->
                   {{--  @if($user->faculty_type == '1')
                        <div class="form-group col-sm-3" id="experience_level">
                            <label>Experience Level</label>
                            <select class="form-control" id="experience_level_id" onchange="onExperienceLevelSelect()" disabled>
                                <option value="">------</option>
                                @foreach(\Config::get('constants.hourly_rates') as $key => $hourly_rate)
                                <option {{$user->experience_level == $key ? 'selected' : ''}} value="{{$key}}">{{$hourly_rate["name"]}}</option>
                                @endforeach
                            </select>
                        </div>
                    @elseif($user->faculty_type == '0')
                        <div class="form-group col-sm-3" id="experience_level">
                            <label>Fixed Salary</label>
                            <input type='text' id='fixed_salary_id' value="{{$user->fixed_salary}}" class='form-control' placeholder='-----' disabled>
                        </div>
                    @endif --}}

                {{--     <div class="form-group col-sm-3" id="hourly_rate_range_field" {{ $user->faculty_type == '1' ? '' : 'hidden="true"' }}>
                        <label>Hourly Rate</label>
                        <input type='number' name='hourly_salary_rate' value="{{$user->hourly_salary_rate}}" id='hourly_rate_id' class='form-control' placeholder='-----' readonly>
                    </div> --}}

                </div>

                {{-- organization details --}}
                <div class="row">
                    <div class="col-12">
                        <strong>Organization Details:</strong>
                        <div class="margin-10 div-border-rad">
                           <div class="row padding-10">
                                
                                <div class="col-3">
                                    {!! Form::label('organization', 'Organization:') !!}
                                    {!! Form::select('organization_id', App\Models\Organization::pluck('name', 'id'), $user->campusDetails->first() != null ? $user->campusDetails->first()->organization_id : null, ['id' => 'organization_id', 'class' => 'form-control select2', 'placeholder' => '------', 'disabled' ]) !!}
                                </div>
                                
                                <div class="col-3">
                                    {!! Form::label('campuses', 'Office:') !!}
                                    {!! Form::select('campus_ids[]', App\Models\OrganizationCampus::pluck('name', 'id'), $user->campusDetails->pluck('organization_campus_id'), ['id' => 'campus_id', 'class' => 'form-control select2', 'multiple'=>'multiple', 'data-placeholder' => '------', 'disabled' ]) !!}
                                </div>

                              {{--   <div class="col-12" id="campuses_div">
                                    @if($user->campusDetails->count() > 0)
                                        @foreach($user->campusDetails as $campusDetail)
                                            <div class="row {{$campusDetail->campus->name_for_ids}}" id="{{$campusDetail->campus->name_for_ids}}" fromDatabase="true">
                                                <div class="col-12">
                                                    <label class="margin-top-5 padding-5">{{ $campusDetail->organization_campus_name }}</label>
                                                    <div class="div-border-rad padding-10">
                                                        <div class="row">
                                                            <div class="form-group col-sm-3">
                                                                {!! Form::label('designation', 'Designation:') !!}<br>
                                                                {!! Form::select($campusDetail->campus->name_for_ids.'[designation_id]', App\Models\Designation::where('organization_campus_id', $campusDetail->organization_campus_id)->pluck('name', 'id'), $campusDetail->designation->id, ['id' => $campusDetail->campus->name_for_ids.'designation_select', 'class' => 'form-control  select2', 'placeholder' => '------', 'name_for_ids' => $campusDetail->campus->name_for_ids, 'onchange'=>'getDesignationDepartments(event)' , 'disabled']) !!}
                                                            </div>

                                                            <div class="form-group col-sm-3" id="{{$campusDetail->campus->name_for_ids.'_department_div'}}">
                                                                {!! Form::label('department', 'Department:') !!}<br>
                                                                {!! Form::select($campusDetail->campus->name_for_ids.'[department_ids][]', App\Models\DesignationDepartment::where('designation_id', $campusDetail->designation_id)->get()->pluck('department_name', 'department_id'), $campusDetail->userDepartments->pluck('department_id') , ['id' => $campusDetail->campus->name_for_ids.'_department', 'class' => 'form-control select2', 'data-placeholder' => '------', 'disabled' , 'multiple']) !!}
                                                            </div>

                                                            <div class="form-group col-sm-3">
                                                                {!! Form::label('role', 'Role:') !!}<br>
                                                                {!! Form::select($campusDetail->campus->name_for_ids.'[role]', Spatie\Permission\Models\Role::pluck('name', 'id'), $campusDetail->role->id, ['onChange' => 'getSelectedRole()', 'id' => 'roles_select', 'class' => 'form-control  select2', 'placeholder' => '------', 'disabled']) !!}
                                                            </div> 
                                                            <div class="form-group col-sm-3">
                                                                {!! Form::label('job_title', 'Job Title:') !!}<br>
                                                                {!! Form::select($campusDetail->campus->name_for_ids.'[job_title]', App\Models\JobTitle::pluck('name','id') , $campusDetail->job_title_id, ['id' => 'roles_select', 'class' => 'form-control  select2', 'placeholder' => '------', 'disabled']) !!}
                                                            </div>
                                                            <!-- <div class="col-md-3 form-group text-center">
                                                                <label>Working(Active)</label><br>
                                                                <div class="custom-control custom-checkbox">
                                                                   <input type="checkbox" class="custom-control-input" value="{{$campusDetail->is_working}}" name="{{$campusDetail->campus->name_for_ids.'[is_working]' }}" id="{{$campusDetail->campus->name_for_ids.'[is_working]' }}" {{$campusDetail->is_working == 1 ? 'checked' : ''}} disabled >
                                                                   <label class="custom-control-label" for="{{$campusDetail->campus->name_for_ids}}[is_working]"></label>
                                                                </div>
                                                            </div> -->
                                                            <!-- <div class="col-md-3 form-group text-center">
                                                                <label>Primary Employee Code</label><br>
                                                                <div class="custom-control custom-checkbox">
                                                                   <input type="checkbox" class="custom-control-input chk" value="{{$campusDetail->is_primary_emp_code}}" name="{{$campusDetail->campus->name_for_ids.'[is_primary_emp_code]' }}" id="{{$campusDetail->campus->name_for_ids.'[is_primary_emp_code]' }}" {{$campusDetail->is_primary_emp_code == 1 ? 'checked' : ''}} disabled>
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
                        {!! Form::label('mobile_no', 'Mobile no:') !!}
                        {!! Form::tel('mobile_no', $user->mobile_no, ['class' => 'form-control editable', 'disabled' => 'true']) !!}
                    </div>
                    <div class="form-group col-sm-4">
                        {!! Form::label('landline', 'Land Line:') !!}
                        {!! Form::tel('landline_no', $user->landline_no, ['class' => 'form-control editable', 'disabled' => 'true']) !!}
                    </div>
                    <!-- Price Field -->
                    <div class="form-group col-sm-4">
                        {!! Form::label('email', 'Email:') !!}
                        {!! Form::email('email', $user->email, ['class' => 'form-control editable', 'disabled' => 'true']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--CNIC-->
    <div class="m-b-10">
        <strong> <i class="fa fa-id-card" aria-hidden="true"></i> CNIC:</strong>
        <div class="m-t-10 div-border-rad">
            <div class="margin-10">
                <div class="row">
                    <div class="form-group col-sm-4">
                        {!! Form::label('cnic_no', 'CNIC no:') !!}
                        {!! Form::text('cnic_no', $user->cnic_no, ['class' => 'form-control editable', 'disabled' => 'true']) !!}
                    </div>
    <!-- <div class="form-group col-sm-4">
        {!! Form::label('attachment', 'Attachment:') !!}
        {!! Form::file('attachment', null, ['class' => 'form-control editable']) !!}
    </div> -->
    <!-- Price Field -->
  {{--   <div class="form-group col-sm-4">
        {!! Form::label('cnic_expiry', 'CNIC Expiry:') !!}
        {!! Form::date('cnic_expiry', $user->cnic_expiry, ['class' => 'form-control editable', 'disabled' => 'true']) !!}
    </div> --}}
</div>
</div>
</div>
</div>
<div class="row">
    <div class="form-group col-sm-2">
        {!! Form::submit('Save', ['class' => 'form-control btn btn-primary','id' => 'savebtn' ,'hidden' => 'hidden']) !!}
    </div>
</div>
</form>
