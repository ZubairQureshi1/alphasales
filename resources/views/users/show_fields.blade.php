<!-- Name Field -->
<!-- Student Personel Information: -->
<div class="m-b-10">
   <strong> <i class="fa fa-user" aria-hidden="true"></i> User Personal Information:</strong>
   <div class="m-t-10 div-border-rad">
      <div class="margin-10">
         <div class="row">
            <div class="form-group col-sm-3">
               {!! Form::label('name', 'Name:') !!}
               {!! Form::text('name', $user->name, ['class' => 'form-control letter_capitalize', 'onkeypress'=> 'return alphabaticOnly(event)', 'placeholder' => 'Enter Full Name', 'value' => old('name'),'readonly' => true ]) !!}
            </div>
            <div class="form-group col-sm-3">
               {!! Form::label('father_name', 'Father Name:') !!}
               {!! Form::text('father_name', $user->father_name, ['class' => 'form-control letter_capitalize', 'onkeypress'=> 'return alphabaticOnly(event)', 'placeholder' => 'Enter Father Name', 'value' => old('father_name') ,'readonly' => true ]) !!}
            </div>
            <div class="form-group col-sm-3">
               {!! Form::label('gender', 'Gender:') !!}
               {!! Form::select('gender_id', config('constants.genders'), $user->gender_id, ['id' => 'gender_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Gender ---', 'value' => old('gender_id'), 'disabled' => true ]) !!}
            </div>
            <div class="form-group col-sm-3">
               {!! Form::label('d_o_b', 'DOB:') !!}
               {!! Form::date('d_o_b', strftime('%Y-%m-%d', strtotime($user->d_o_b)), [ 'id' => 'd_o_b', 'class' => 'form-control', 'data-date-format' => 'YYYY-MM-DD', 'readonly' => true ]) !!}
            </div>
            <div class="form-group col-sm-3">
               {!! Form::label('age', 'Age:') !!}
               {!! Form::number('age', $user->age, ['id' => 'age' ,'class' => 'form-control', 'readonly', 'value' => old('age') ]) !!}
            </div>
            <div class="form-group col-sm-3">
               {!! Form::label('religion', 'Religion:') !!}
               {!! Form::select('religion_id', config('constants.religions'), $user->religion_id, ['id' => 'religion_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Religion ---', 'value' => old('religion_id'), 'disabled' => true ]) !!}
            </div>
            <div class="form-group col-sm-3">
               {!! Form::label('martialstatus', 'Martial Status:') !!}
               {!! Form::select('martial_status_id', config('constants.martial_status'), $user->martial_status_id, ['id' => 'martisal_status_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Marital Status ---', 'value' => old('martial_status_id'), 'disabled']) !!}
            </div>
            <div class="form-group col-sm-3">
               {!! Form::label('blood_group', 'Blood Group:') !!}
               {!! Form::select('blood_group_id',config('constants.blood_groups'),$user->blood_group_id,['id' => 'blood_group_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Blood Group ---', 'value' => old('blood_group_id') , 'disabled']) !!}
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
               {!! Form::label('username', 'User Name:') !!}
               {!! Form::text('username', $user->username, ['class' => 'form-control', 'placeholder' => 'Enter Username', 'value' => old('username'), 'readonly' ]) !!}
            </div>
            <!-- Price Field -->
            <div class="form-group col-sm-3">
               {!! Form::label('email', 'Email:') !!}
               {!! Form::email('email', $user->email, ['class' => 'form-control', 'placeholder' => 'abc@xyz.com', 'value' => old('email'), 'readonly' ]) !!}
               <span id="email_message"></span>
            </div>
            <!-- <div class="form-group col-sm-3">
               {!! Form::label('session', 'Sessions Allowed:') !!}
               {!! Form::select('allowed_sessions[]', App\Models\Session::pluck('session_name', 'id'), $user->userAllowedSessions->pluck('session_id'), ['session_id' => 'allowed_sessions', 'class' => 'form-control select2', 'data-placeholder' => '--- Select Session ---', 'value' => old('allowed_sessions[]'), 'multiple' => 'multiple', 'disabled' ]) !!}
            </div> -->
            <!-- <div class="form-group col-sm-3">
               {!! Form::label('permanent/ visiting','Permanent / Visiting') !!}
               <select class="form-control" id="faculty_type" name="faculty_type" value="{{ old('faculty_type') }}" disabled>
                  <option {{$user->faculty_type == null ? 'selected' : ''}} value="">---- Select ----</option>
                  @foreach(\Config::get('constants.faculty_types') as $key => $faculty_type)
                  <option {{$key === $user->faculty_type ? 'selected' : ''}} value="{{$key}}">{{$faculty_type}}</option>
                  @endforeach
               </select>
            </div> -->
            @if($user->faculty_type == '1')
            <div class="form-group col-sm-3" id="experience_level">
               <label>Experience Level</label>
               <select class="form-control" name="experience_level" id="experience_level_id" disabled>
                  <option value="">--- Select Experience Level ---</option>
                  @foreach(\Config::get('constants.hourly_rates') as $key => $hourly_rate)
                  <option {{$user->experience_level == $key ? 'selected' : ''}} value="{{$key}}">{{$hourly_rate["name"]}}</option>
                  @endforeach
               </select>
            </div>
            <div class="form-group col-sm-3" id="hourly_rate_range_field">
               <label>Hourly Rate</label>
               <input type='number' name='hourly_salary_rate' value="{{$user->hourly_salary_rate}}" id='hourly_rate_id' class='form-control' placeholder='Enter Hourly Rate' readonly>
            </div>
            @elseif($user->faculty_type == '0')
            <div class="form-group col-sm-3" id="experience_level">
               <label>Fixed Salary</label>
               <input type='text' name='fixed_salary' id='fixed_salary_id' value="{{$user->fixed_salary}}" class='form-control' placeholder='Enter Fixed Salary' disabled>
            </div>
            @endif
         </div>
         <div class="row">
            <div class="col-12">
               <strong>Organization Details:</strong>
               <div class="margin-10 div-border-rad">
                  <div class="row padding-10">
                     <div class="col-3">
                        {!! Form::label('organization', 'Organization:') !!}
                        {!! Form::select('organization_id', App\Models\Organization::pluck('name', 'id'), $user->campusDetails->first() != null ? $user->campusDetails->first()->organization_id : null, ['id' => 'organization_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Organization ---', 'required', 'value' => old('organization_id'), 'disabled' ]) !!}
                     </div>
                     <div class="col-3">
                        {!! Form::label('campuses', 'Campuses:') !!}
                        {!! Form::select('campus_ids[]', App\Models\OrganizationCampus::pluck('name', 'id'), $user->campusDetails->pluck('organization_campus_id'), ['id' => 'campus_id', 'class' => 'form-control select2', 'multiple'=>'multiple', 'data-placeholder' => '--- Select Campuses ---', 'disabled', 'value' => old('campus_ids[]') ]) !!}
                     </div>
                     <div class="col-12" id="campuses_div">
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
                        
                        <!-- <div class="row {{$campusDetail->campus->name_for_ids}}" id="{{$campusDetail->campus->name_for_ids}}" fromDatabase="true">
                         <div class="col-12">
                           <label class="margin-top-5 padding-5">{{ $campusDetail->organization_campus_name }}</label>
                           <div class="div-border-rad padding-10">
                             <div class="row">
                              <div class="form-group col-sm-3">
                                 {!! Form::label('designation', 'Designation:') !!}<span style="color: red">*</span><br>
                                 
                                 @if(isset($campusDetail->campus->name_for_ids) && isset($campusDetail->designation->id))
                                 {!! Form::select($campusDetail->campus->name_for_ids.'[designation_id]', collect($newDesignations)->pluck('name', 'id'), $campusDetail->designation->id, ['id' => $campusDetail->campus->name_for_ids.'designation_select', 'class' => 'form-control  select2', 'placeholder' => '--- Select Designation---', 'required', 'name_for_ids' => $campusDetail->campus->name_for_ids, 'disabled']) !!}
                                 @endif
                              </div>

                              <div class="form-group col-sm-3" id="{{$campusDetail->campus->name_for_ids.'_department_div'}}">
                                 {!! Form::label('department', 'Department:') !!}<span style="color: red">*</span><br>
                                 
                                 {!! Form::select($campusDetail->campus->name_for_ids.'[department_ids][]', App\Models\DesignationDepartment::where('designation_id', $campusDetail->designation_id)->get()->pluck('department_name', 'department_id'), $campusDetail->userDepartments->pluck('department_id') , ['id' => $campusDetail->campus->name_for_ids.'_department', 'class' => 'form-control select2', 'data-placeholder' => '--- Select Department ---', 'multiple', 'disabled']) !!}
                              </div>

                              <div class="form-group col-sm-3">
                                 {!! Form::label('role', 'Role:') !!}<br>
                                 @if(isset($campusDetail->role->id))
                                 {!! Form::select($campusDetail->campus->name_for_ids.'[role]', Spatie\Permission\Models\Role::pluck('name', 'id'), $campusDetail->role->id, ['onChange' => 'getSelectedRole()', 'id' => 'roles_select', 'class' => 'form-control  select2', 'placeholder' => '--- Select Role ---', 'disabled']) !!}
                                 @endif
                              </div> -->
                              <?
                              continue;
                              ?>
                              <!-- <div class="form-group col-sm-3">
                                 {!! Form::label('job_title', 'Job Title:') !!}<br>
                                 {!! Form::select($campusDetail->campus->name_for_ids.'[job_title]', App\Models\JobTitle::pluck('name','id') , $campusDetail->job_title_id, ['id' => 'roles_select', 'class' => 'form-control  select2', 'placeholder' => '--- Select Job Title ---', 'disabled']) !!}
                              </div> -->
                              <!-- <div class="col-md-2 form-group text-center">
                                 <label>Working(Active)</label><br>
                                 <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" value="{{$campusDetail->is_working}}" name="{{$campusDetail->campus->name_for_ids.'[is_working]' }}" id="{{$campusDetail->campus->name_for_ids.'[is_working]' }}" {{$campusDetail->is_working == 1 ? 'checked' : ''}} disabled>
                                    <label class="custom-control-label" for="{{$campusDetail->campus->name_for_ids}}[is_working]"></label>
                                 </div>
                              </div> -->
                              <!-- <div class="col-md-2 form-group text-center">
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
               </div>
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
               {!! Form::tel('mobile_no', $user->mobile_no, ['class' => 'form-control', 'pattern' => '[0-9]{4}[0-9]{7}', 'onkeypress'=> 'return numericOnly(event)', 'maxlength' => '11', 'placeholder' => 'Enter Mobile No.', 'value' => old('mobile_no'), 'readonly']) !!}
            </div>
            <div class="form-group col-sm-4">
               {!! Form::label('landline', 'Land Line:') !!}
               {!! Form::tel('landline_no', $user->landline_no, ['class' => 'form-control', 'pattern' => '[0-9]{3}-[0-9]{1}-[0-9]{7}', 'onkeypress'=> 'return numericOnly(event)', 'maxlength' => '13', 'placeholder' => 'Enter Landline No.', 'value' => old('landline_no'), 'readonly']) !!}
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
            <div class="form-group col-sm-12">
               {!! Form::label('cnic_no', 'CNIC no:') !!}
               {!! Form::text('cnic_no', $user->cnic_no, ['class' => 'form-control', 'pattern' => '[0-9]{5}-[0-9]{7}-[0-9]{1}', 'onkeypress'=> 'return numericOnly(event)', 'maxlength' => '15', 'placeholder' => 'Enter CNIC No.', 'value' => old('cnic_no'), 'readonly']) !!}
            </div>
         </div>
      </div>
   </div>
</div>