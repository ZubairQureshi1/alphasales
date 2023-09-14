<!-- Name Field -->
<!-- Student Personel Information: -->
<div class="m-b-10">
    <strong> <i class="fa fa-user" aria-hidden="true"></i> User Personal Information:</strong>
    <div class="m-t-10 div-border-rad">
        <div class="margin-10">
            <div class="row">
                <div class="form-group col-sm-3">
                    {!! Form::label('name', 'Name:') !!}<span style="color: red">*</span>
                    {!! Form::text('name', null, ['class' => 'form-control letter_capitalize', 'onkeypress' => 'return alphabaticOnly(event)', 'placeholder' => 'Enter Full Name', 'value' => old('name'), 'required']) !!}
                </div>
                <div class="form-group col-sm-3">
                    {!! Form::label('father_name', 'Father Name:') !!}<span style="color: red">*</span>
                    {!! Form::text('father_name', null, ['class' => 'form-control letter_capitalize', 'onkeypress' => 'return alphabaticOnly(event)', 'placeholder' => 'Enter Father Name', 'value' => old('father_name'), 'required']) !!}
                </div>
                <div class="form-group col-sm-3">
                    {!! Form::label('gender', 'Gender:') !!}<span style="color: red">*</span>
                    {!! Form::select('gender_id', config('constants.genders'), null, ['id' => 'gender_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Gender ---', 'value' => old('gender_id'), 'required']) !!}
                </div>
                <div class="form-group col-sm-3">
                    {!! Form::label('d_o_b', 'DOB:') !!}
                    {!! Form::date('d_o_b', null, ['id' => 'd_o_b', 'class' => 'form-control', 'onchange' => 'calculateAge()', 'data-date-format' => 'YYYY-MM-DD', 'max' => date('Y-m-d'), 'value' => old('d_o_b')]) !!}
                </div>
                <div class="form-group col-sm-3">
                    {!! Form::label('age', 'Age:') !!}
                    {!! Form::number('age', null, ['id' => 'age', 'class' => 'form-control', 'readonly', 'value' => old('age')]) !!}
                </div>
                <div class="form-group col-sm-3">
                    {!! Form::label('religion', 'Religion:') !!}<span style="color: red">*</span>
                    {!! Form::select('religion_id', config('constants.religions'), null, ['id' => 'religion_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Religion ---', 'value' => old('religion_id'), 'required']) !!}
                </div>
                <div class="form-group col-sm-3">
                    {!! Form::label('martialstatus', 'Marital Status:') !!}<span style="color: red">*</span>
                    {!! Form::select('martial_status_id', config('constants.martial_status'), null, ['id' => 'martisal_status_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Marital Status ---', 'value' => old('martial_status_id'), 'required']) !!}
                </div>
                <div class="form-group col-sm-3">
                    {!! Form::label('blood_group', 'Blood Group:') !!}
                    {!! Form::select('blood_group_id', config('constants.blood_groups'), null, ['id' => 'blood_group_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Blood Group ---', 'value' => old('blood_group_id')]) !!}
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
                    {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Enter Username', 'value' => old('username'), 'required']) !!}
                </div>
                <!-- Price Field -->
                <div class="form-group col-sm-3">
                    {!! Form::label('email', 'Email:') !!}<span style="color: red">*</span>
                    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'abc@xyz.com', 'value' => old('email'), 'required', 'onchange' => 'checkEmailDuplicacy()']) !!}
                    <span id="email_message"></span>
                </div>
                <div class="form-group col-sm-3">
                    {!! Form::label('password', 'Password:') !!}<span style="color: red">*</span>
                    <br>
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Enter Password', 'minlength' => '6', 'required']) !!}
                </div>

               <!-- {{--  <div class="form-group col-sm-3">
                    {!! Form::label('session', 'Sessions Allowed:') !!}<span style="color: red">*</span>
                    {!! Form::select('allowed_sessions[]', App\Models\Session::pluck('session_name', 'id'), null, ['id' => 'allowed_sessions', 'class' => 'form-control select2', 'data-placeholder' => '--- Select Session ---', 'value' => old('allowed_sessions[]'), 'multiple' => 'multiple', 'required']) !!}
                </div> --}} -->
                <!-- {{-- <div class="form-group col-sm-3">
                    {!! Form::label('permanent/ visiting', 'Permanent / Visiting') !!}<span style="color: red">*</span>
                    <select class="form-control" id="faculty_type" name="faculty_type" required=""
                        value="{{ old('faculty_type') }}" onchange="onTeacherTypeSelect()">
                        <option value="">---- Select ----</option>
                        @foreach (\Config::get('constants.faculty_types') as $key => $faculty_type)
                            <option value="{{ $key }}">{{ $faculty_type }}</option>
                        @endforeach
                    </select>
                </div> --}} -->
                <div class="form-group col-sm-3" id="experience_level">

                </div>
                <div class="form-group col-sm-3" id="hourly_rate_range_field">
                </div>

            </div>
            <div class="row">
                <div class="col-12">
                    <strong>Organization Details:</strong>
                    <div class="margin-10 div-border-rad">
                        <div class="row padding-10">
                            <div class="col-3">
                                {!! Form::label('organization', 'Organization:') !!}<span style="color: red">*</span>
                                {!! Form::select(
                                    'organization_id',
                                    App\Models\Organization::pluck('name', 'id'),
                                    array_key_first(App\Models\Organization::pluck('name', 'id')->toArray()),
                                    [
                                        'id' => 'organization_id',
                                        'required' => 'required', // Added 'required' attribute here
                                        'class' => 'form-control select2',
                                        'placeholder' => '--- Select Organization ---',
                                        'value' => old('organization_id')
                                    ]
                                ) !!}

                            </div>
                            <div class="col-3">
                                {!! Form::label('office_location', 'Office Location(s):') !!}<span style="color: red">*</span>
                                {!! Form::select(
                                    'campus_ids[]',
                                    App\Models\OrganizationCampus::pluck('name', 'id'),
                                    null,
                                    [
                                        'id' => 'campus_id',
                                        'class' => 'form-control select2',
                                        'multiple' => 'multiple', // Add 'multiple' attribute
                                        'data-placeholder' => '--- Select Campuses ---',
                                        'required' => 'required', // Add 'required' attribute
                                        'value' => old('campus_ids[]')
                                    ]
                                ) !!}

                            </div>
                             <div class="col-3">
                                {!! Form::label('roles', 'Roles:') !!}<span style="color: red">*</span>
                                {!! Form::select(
                                        'role',
                                        $roles,
                                        null,
                                        [
                                            'id' => 'role_id',
                                            'class' => 'form-control select2',
                                            'data-placeholder' => '--- Select Roles ---',
                                            'required' => 'required', // Add 'required' attribute here
                                            'value' => old('role_id[]')
                                        ]
                                    ) !!}
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
                    {!! Form::label('mobile_no', 'Mobile no:') !!}<span style="color: red">*</span>
                    {!! Form::tel('mobile_no', null, ['class' => 'form-control', 'pattern' => '[0-9]{4}[0-9]{7}', 'onkeypress' => 'return numericOnly(event)', 'maxlength' => '11', 'placeholder' => 'Enter Mobile No.', 'value' => old('mobile_no'), 'required']) !!}
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
                    {!! Form::label('cnic_no', 'CNIC No:') !!}<span style="color: red">*</span>
                    {!! Form::text('cnic_no', null, ['class' => 'form-control', 'pattern' => '[0-9]{5}-[0-9]{7}-[0-9]{1}', 'onkeypress' => 'return numericOnly(event)', 'maxlength' => '15', 'placeholder' => 'Enter CNIC No.', 'value' => old('cnic_no'), 'required']) !!}
                    <span class="text-danger">Format should be like 35202-1234567-8</span>
                </div>
                <!-- <div class="form-group col-sm-4">
        {!! Form::label('attachment', 'Attachment:') !!}
        {!! Form::file('attachment', null, ['class' => 'form-control']) !!}
    </div> -->
                <!-- Price Field -->{{-- <div class="form-group col-sm-4">
        {!! Form::label('cnic_expiry', 'CNIC Expiry:') !!}
        {!! Form::date('cnic_expiry', null, ['class' => 'form-control', 'min' => date('Y-m-d'), 'value' => old('cnic_expiry') ]) !!}
    </div> --}}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('users.index') !!}" class="btn btn-secondary">Back</a>
    </div>
</div>
