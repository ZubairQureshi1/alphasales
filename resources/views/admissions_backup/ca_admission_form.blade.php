<div class="m-b-10">
    <strong>Courses\Degree:</strong>
    <div class="m-t-10 div-border-rad" style="">
        <div class="margin-10">
            <div class="form-group">
                <div class="row" id="course_div">
                    <div class="col-2" id="session_div">
                        <strong>Session:</strong>
                        {{ Form::select('session_id', \Auth::user()->userAllowedSessions()->get()->pluck('session_name', 'session_id'), \Auth::user()->userAllowedSessions()->count()>0?Illuminate\Support\Facades\Session::get('selected_session_id'):null, ['class' => 'form-control select2 item-required', 'id' => 'session_id', 'placeholder' => '--- Select Session ---', 'onchange' => 'getCoursesBySession()',  'errorLabel' => 'Session', 'disabled']) }}
                    </div>
                    <div id="course_select">
                        
                    </div>
                    <div id="course_affiliated_body">
                        
                    </div>
                    <div id="section_select">
                            <span id="section_message"></span>
                    </div>
                    <div id="session_select">
                            <span id="session_message"></span>
                    </div>
                    <div id="view_books_div" class="element-flex-end" hidden="hidden">
                        <button type="button" class="btn btn-secondary waves-effect waves-light"  data-toggle="modal" data-target="#course_subjects">View Books</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admissions/courses_model')

@include('layouts/loading')


<div id="admission_message" hidden="hidden">
    <div class="row text-white" style="margin-left: 2px; background: #ff3a3a; padding: 10px; margin-right: 2px; margin-bottom: 20px;">
        <div class="col-4"></div>
        <div class="col-4 text-center">
            <a><i class="mdi mdi-information-outline"></i> No quota is remaining for this session. </a>
        </div>
        <div class="col-4"></div>
    </div>
</div>

<div id="admission_form" hidden="hidden"> 
    <?php if (isset($enquiry)): ?>
        <input name="enquiry_id" id="enquiry_id" hidden type="text" class="form-control" value="{!! $enquiry['id'] !!}">
    <?php endif?>
    <div class="m-b-10" hidden="hidden">
        <input type="checkbox" onclick="showCASection()" name="ca_section_show" id="is_ca">
        <label class="" for="is_ca"> Is CA/ACCA/AFD</label>
    </div>
    <div class="m-b-10">
        <strong>Form Information:<span class="required-span">*</span></strong>
        <div class="m-t-10 div-border-rad">
            <div class="margin-10">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Admission Category:<span class="required-span">*</span></label>
                            {!! Form::select('student_category_id', config('constants.student_categories'), (isset($enquiry)&&$enquiry!=null)?$enquiry['student_category_id']:1, ['id' => 'student_category_id', 'onchange' => 'onWorkerSelect()', 'class' => 'form-control select2-multiple item-required', 'errorLabel' => 'Admission Category', 'placeholder' => '------ Select ------']) !!}
                        </div>
                        <div class="col-md-3">
                            <label>Counseling By:<span class="required-span">*</span></label>
                            <div>
                                <input name="counselor_by" id="counselor_by" onkeypress="return alphabaticOnly(event)"   
                                <?php if (isset($enquiry)): ?>
                                   value= "{!! ucfirst($enquiry['user_name']) !!}"
                               <?php endif?>  required type="text" placeholder="Counseling By" class="form-control item-required letter_capitalize" errorLabel="Counseling By">
                            </div>
                        </div>
                    </div>
                    <div class="row" id="worker_details">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="m-b-10">
        <strong>Student's Information:</strong>
        <div class="m-t-10 div-border-rad">
            <div class="margin-10">
                <div class="form-group">
                    <div class="row">
                        {{-- profile image --}}
                        <div class="col-md-3 text-center element-flex-center">
                            <div class="form-group div-border p-2">
                                <img src="{{ asset('assets/images/avatar.png') }}" class="img-fluid rounded-circle profile-image d-block mx-auto" style="width: 15vh; height: 15vh; object-fit: cover;" title="Student Profile Image" alt="Profile Image">
                                <button class="btn btn-primary btn-sm rounded-0 mt-3" onclick="selectProfileImage()">
                                    <i class="typcn typcn-image fa-fw"></i> | Select Profile
                                </button>
                                <input type="file" name="profile_image" id="profile_image" class="d-none profile-input" value="" onchange="readURL(this, '.profile-image')">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Name:<span class="required-span">*</span></label>
                                    <div>
                                        <input data-parsley-type="name" type="text"
                                               class="form-control item-required letter_capitalize" required
                                               <?php if (isset($enquiry)): ?>
                                                   value= "{!! $enquiry['name'] !!}"
                                               <?php endif?>
                                               name="student_name" id="student_name" onkeypress="return alphabaticOnly(event)"
                                               placeholder="Enter Student Name" errorLabel="Student Name"/>
                                        <span id="student_name_message"></span>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>CNIC:<span class="required-span">*</span></label>
                                    <div>
                                        <input name="student_cnic_no" id="student_cnic_no" required  
                                        <?php if (isset($enquiry)): ?>
                                           value= "{!! $enquiry['student_cnic_no'] !!}"
                                       <?php endif?> 
                                       type="text" placeholder="XXXXX-XXXXXXX-X" errorLabel="Student CNIC" data-mask="99999-9999999-9" class="form-control item-required">
                                        <span id="student_cnic_no_message"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Admission Date:<span class="required-span">*</span></label>
                                    <div>
                                        <input type="date"
                                               class="form-control item-required" required errorLabel="Admission Date"
                                               name="admission_date" id="admission_date" value="{{ date('Y-m-d') }}" onmousewheel="return false" max="{{ date('Y-m-d') }}"/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Email:<span class="required-span">*</span></label>
                                    <div>
                                        <input name="email" id="email" required type="email"  
                                         placeholder="xyz@abc.com" onchange="validateEmail()" class="form-control item-required" errorLabel="Email">
                                        <span id="email_message"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Gender:<span class="required-span">*</span></label>
                                    <div>
                                        {!! Form::select('gender_id', config('constants.genders'), isset($enquiry)?$enquiry['gender_id']:null, ['id' => 'gender_id', 'class' => 'form-control select2-multiple item-required', 'errorLabel'=>'Gender', 'placeholder' => '--- Select Gender ---']) !!}
                                        <span id="gender_id"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>D.O.B:<span class="required-span">*</span></label>
                                    <div>
                                        <input name="d_o_b" id="d_o_b" required type="date" value="1990-01-01"   
                                        <?php if (isset($enquiry)): ?>
                                           value= "{!! $enquiry['dob'] !!}"
                                       <?php endif?>  data-date-format="YYYY-MM-DD" max="{{ date('Y-m-d') }}" class="form-control item-required" errorLabel="Date of Birth" />
                                        <span id="d_o_b_message"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Shift:<span class="required-span">*</span></label>
                                    <div>
                                        {!! Form::select('shift_id', config('constants.shifts'), isset($enquiry)?$enquiry['shift_id']:null, ['id' => 'shift_id', 'class' => 'form-control select2-multiple item-required', 'errorLabel'=>'Shift', 'placeholder' => '--- Select Shift ---']) !!}
                                        <span id="shift_id"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Semester/Year:<span class="required-span">*</span></label>
                                    <div>
                                        {!! Form::select('semester_id', config('constants.semesters_years'), 0, ['id' => 'semester_id', 'class' => 'form-control select2-multiple item-required', 'errorLabel'=>'Semester/ Year', 'placeholder' => '--- Semester/Year No ---', 'onchange' => 'onSemesterSelect()']) !!}
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>
                                        Transport Facility:<span class="required-span">*</span>
                                    </label>
                                     {!! Form::select('is_transport', config('constants.is_transport'), isset($enquiry)?$enquiry['is_transport']:null, ['id' => 'is_transport', 'onchange'=>'onTransportSelect()','class' => 'form-control select2 item-required', 'errorLabel'=>'Transport Facility', 'placeholder' => '--- Select Transport Status ---']) !!}
                                </div>
                                <div class="col-md-3" id='transport_stop_div' hidden="true">
                                    <label>Transport Stop:<span class="required-span">*</span></label>
                                    <div>
                                        <input name="transport_stop" 
                                        <?php if (isset($enquiry)): ?>
                                           value= "{!! $enquiry['transport_stop'] !!}"
                                       <?php endif?> id="transport_stop" hidden="true" required type="text" placeholder="Add Transport Stop" class="form-control item-required" errorLabel="Transport Stop."/>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>
                                        Hostel Facility:<span class="required-span">*</span>
                                    </label>
                                     {!! Form::select('is_hostel', config('constants.is_transport'), null, ['id' => 'is_hostel', 'class' => 'form-control select2 item-required', 'errorLabel'=>'Hostel Facility', 'placeholder' => '--- Select Hostel Status ---']) !!}
                                </div>
                                <div class="col-md-3">
                                    <label>
                                        Occupation/ Organization Name:
                                    </label>
                                    <textarea class="form-control letter_capitalize" id="student_occupation" required="" rows="2"><?php if (isset($enquiry)): ?>{!! $enquiry['student_occupation'] !!}<?php endif?> </textarea>
                                </div>

                                <div class="col-md-3">
                                    <label>
                                        Workplace Address:
                                    </label>
                                    <textarea class="form-control letter_capitalize" id="student_work_address" required="" rows="2"><?php if (isset($enquiry)): ?>{!! $enquiry['student_work_address'] !!}<?php endif?> </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="m-b-10">
        <strong>Addresses:</strong>
        <div class="m-t-10 div-border-rad">
            <div class="margin-10">
                <div class="form-group">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>
                                Town/ City:
                            </label>
                            {!! Form::select('city_id', $cities, isset($enquiry)?$enquiry['city_id']:null, ['id' => 'city_id', 'class' => 'form-control select2', 'placeholder' => '----- Select -----', 'onchange' => 'onCitySelect()']) !!}                            
                        </div>
                        <div class="form-group col-md-3" id="city_other_name" hidden="true">
                            <label>
                                Other City Name:
                            </label>
                            <input class="form-control letter_capitalize"
                                <?php if (isset($enquiry)): ?>
                                   value= "{!! $enquiry['other_city_name'] !!}"
                               <?php endif?>  onkeypress="return alphabaticOnly(event)" data-parsley-type="other_city_name" id="other_city_name" placeholder="Enter Other City Name" required="" type="text"/>
                        </div>
                        <div class="form-group col-md-3">
                            <label>
                                Area:<span style="color: red">*</span>
                            </label>
                            <input class="form-control letter_capitalize item-required" 
                                <?php if (isset($enquiry)): ?>
                                   value= "{!! $enquiry['area'] !!}"
                               <?php endif?> errorLabel="Area" id="area" name="area" placeholder="Add Area" type="text">
                            </input>
                        </div>
                        <div class="col-md-3">
                            <label>Present Address:<span class="required-span">*</span></label>
                            <div>
                                <textarea data-parsley-type="present_address" type="text"
                                       class="form-control item-required letter_capitalize" errorLabel="Present Address" required
                                       name="present_address" id="present_address"
                                       placeholder="Enter Present Address"><?php if (isset($enquiry)): ?>{!! $enquiry['present_address']!=null?$enquiry['present_address']:'' !!}<?php endif?></textarea>
                                <span id="present_address_message"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Permanent Address:</label>
                            <div>
                                <textarea data-parsley-type="permanent_address" type="text"
                                       class="form-control letter_capitalize" required
                                       name="permanent_address" id="permanent_address"
                                       placeholder="Enter Permanent Address"><?php if (isset($enquiry)): ?>{!! $enquiry['permanent_address']!=null?$enquiry['permanent_address']:'' !!}<?php endif?></textarea>
                                <span id="permanent_address_message"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="m-b-10">
        <strong>Father's Information:</strong>
        <div class="m-t-10 div-border-rad">
            <div class="margin-10">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Name:<span class="required-span">*</span></label>
                            <div>
                                <input data-parsley-type="name" type="text"
                                       class="form-control item-required letter_capitalize" required
                                       name="father_name" id="father_name"
                                       <?php if (isset($enquiry)): ?>
                                           value= "{!! $enquiry['father_name'] !!}"
                                       <?php endif?>
                                       placeholder="Enter Father Name" onkeypress="return alphabaticOnly(event)" errorLabel="Father Name"/>
                                <span id="father_name_message"></span>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>CNIC:<span class="required-span">*</span></label>
                            <div>
                                <input name="father_cnic_no" id="father_cnic_no"  
                                <?php if (isset($enquiry)): ?>
                                   value= "{!! $enquiry['father_cnic_no'] !!}"
                                <?php endif?>  required type="text" placeholder="XXXXX-XXXXXXX-X" data-mask="99999-9999999-9" class="form-control item-required" errorLabel="Father CNIC" />
                                <span id="father_cnic_no_message"></span>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <label>
                                Occupation/ Organization Name:
                            </label>
                            <textarea class="form-control letter_capitalize" id="father_occupation" required rows="2"><?php if (isset($enquiry)): ?>{!! $enquiry['father_occupation'] !!}<?php endif?> </textarea>
                        </div>
                        <div class="col-md-3">
                            <label>Workplace Address:{{-- <span class="required-span">*</span> --}}</label>
                            <div>
                                <textarea data-parsley-type="father_work_address" type="text"
                                       class="form-control letter_capitalize"
                                       name="father_work_address" id="father_work_address"
                                       placeholder="Enter Father Work Address"></textarea>
                                <span id="father_work_address_message"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="m-b-10">
        <strong>Guardian's Information:</strong>
        <div class="m-t-10 div-border-rad">
            <div class="margin-10">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Name:</label>
                            <div>
                                <input data-parsley-type="name" type="text"
                                       class="form-control letter_capitalize" required
                                       name="gaurdian_name" id="gaurdian_name"  
                                <?php if (isset($enquiry)): ?>
                                   value= "{!! $enquiry['father_name'] !!}"
                               <?php endif?>  
                                       placeholder="Enter Guardian Name" onkeypress="return alphabaticOnly(event)"/>
                                <span id="gaurdian_name_message"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Relationship:</label>
                            <div>
                                <input data-parsley-type="name" type="text"
                                       class="form-control letter_capitalize" required
                                       name="gaurdian_relationship" id="gaurdian_relationship"
                                       placeholder="Enter Guardian Relationship" onkeypress="return alphabaticOnly(event)"/>
                                <span id="gaurdian_relationship_message"></span>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <label>CNIC:</label>
                            <div>
                                <input name="guardian_cnic" id="guardian_cnic"  
                                 type="text" placeholder="XXXXX-XXXXXXX-X" data-mask="99999-9999999-9" class="form-control" errorLabel="Father CNIC" />
                                <span id="father_cnic_no_message"></span>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class=" m-b-10">
        <strong>Contact Information:</strong>
        <button type="button" id="add_contact" name="add_contact" class="btn btn-dark btn-sm waves-effect m-l-5 m-b-10 pull-right"><i class="fa fa-plus fa-fw"></i> | Add Contact</button>
        <div class="m-t-20 div-border">
            <div class="margin-10">
                <table class="table table-bordered" id="contact_table_body">
                    <thead>
                        <tr>
                            <th width="35%" class="text-center">Contact No<span style="color: red">*</span></th>
                            <th width="35%" class="text-center">Relationship<span style="color: red">*</span></th>
                            <th width="35%" class="text-center">Other Name</th>
                            <th width="30%" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="m-b-10">
        <strong>Reference Information:</strong>
        <div class="m-t-10 div-border-rad">
            <div class="margin-10">
                <div class="form-group">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>Source of Information:</label>
                            <div>
                                {!! Form::select('source_info_id', config('constants.information_sources'), isset($enquiry)?$enquiry['source_info_id']:null, ['id' => 'source_info_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Source ---', 'onchange' => 'onSourceOfInformationSelect()']) !!}
                            </div>
                        </div>
                        <div class="form-group col-md-3" hidden="true" id="marketer_name_div">
                            {!! Form::label('marketer_name', 'Marketer Name:') !!}
                            <input class="form-control letter_capitalize" 
                                <?php if (isset($enquiry)): ?>
                                   value= "{!! $enquiry['marketer_name'] !!}"
                               <?php endif?> id="marketer_name" name="marketer_name" onkeypress="return alphabaticOnly(event)" placeholder="Enter Marketer Name" type="text"/>
                        </div>
                        <div class="form-group col-md-3" hidden="true" id="faculty_member_name_div">
                            {!! Form::label('faculty_member_name', 'Faculty Member Name:') !!}
                            <input class="form-control letter_capitalize" onkeypress="return alphabaticOnly(event)" 
                                <?php if (isset($enquiry)): ?>
                                   value= "{!! $enquiry['faculty_member_name'] !!}"
                               <?php endif?> id="faculty_member_name" name="faculty_member_name" placeholder="Enter Faculty Member Name" type="text"/>
                        </div>
                        <div class="form-group col-md-3" hidden="true" id="academy_school_name_div">
                            {!! Form::label('academy_school_name', 'Academy/ School Name:') !!}
                            <input class="form-control letter_capitalize" 
                                <?php if (isset($enquiry)): ?>
                                   value= "{!! $enquiry['academy_school_name'] !!}"
                               <?php endif?> id="academy_school_name" name="academy_school_name" placeholder="Enter Academy/ School Name" type="text"/>
                        </div>
                        <div class="form-group col-md-3" hidden="true" id="social_media_type_id_div">
                            <label>Social Media:</label>
                            <div>
                                {!! Form::select('social_media_type_id', config('constants.social_media_types'), isset($enquiry)?$enquiry['social_media_type_id']:null, ['id' => 'social_media_type_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Social Media ---', 'onchange' => 'onSocialMediaSelect()']) !!}
                            </div>
                        </div>
                        <div class="form-group col-md-3" hidden="true" id="other_social_media_name_div">
                            {!! Form::label('other_social_media', 'Other (Social Media):') !!}
                            <input class="form-control letter_capitalize" 
                                <?php if (isset($enquiry)): ?>
                                   value= "{!! $enquiry['other_social_media_name'] !!}"
                               <?php endif?> id="other_social_media_name" name="other_social_media_name" placeholder="Enter Other Source" type="text"/>
                        </div>
                        <div class="form-group col-md-3" hidden="true" id="ex_student_wing_type_id_div">
                            <label>Student's/ Ex-Student's Wing:</label>
                            <div>
                                {!! Form::select('ex_student_wing_type_id', App\Models\Wing::pluck('name', 'id'), isset($enquiry)?$enquiry['ex_student_wing_type_id']:null, ['id' => 'ex_student_wing_type_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Wing ---']) !!}
                            </div>
                        </div>
                        <div class="form-group col-md-3" hidden="true" id="ex_student_name_div">
                            {!! Form::label('ex_student_name', 'Student\''.'s/ Ex-Student\''.'s Name:') !!}
                            <input class="form-control letter_capitalize" onkeypress="return alphabaticOnly(event)" 
                                <?php if (isset($enquiry)): ?>
                                   value= "{!! $enquiry['ex_student_name'] !!}"
                               <?php endif?> id="ex_student_name" name="ex_student_name" placeholder="Enter Student/ Ex-Student Name" type="text"/>
                        </div>
                        <div class="form-group col-md-3" hidden="true" id="friend_name_div">
                            {!! Form::label('friend_name', 'Friend\''.'s Name:') !!}
                            <input class="form-control letter_capitalize" onkeypress="return alphabaticOnly(event)" 
                                <?php if (isset($enquiry)): ?>
                                   value= "{!! $enquiry['friend_name'] !!}"
                               <?php endif?> id="friend_name" name="friend_name" placeholder="Enter Friend Name" type="text"/>
                        </div>
                        <div class="form-group col-md-3" hidden="true" id="other_source_of_info_div">
                            {!! Form::label('other_source_of_info', 'Other (Source of Information):') !!}
                            <input class="form-control letter_capitalize" 
                                <?php if (isset($enquiry)): ?>
                                   value= "{!! $enquiry['other_source_of_info'] !!}"
                               <?php endif?> id="other_source_of_info" name="other_source_of_info" placeholder="Enter Other (Source of Information)" type="text"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="m-b-10">
        <strong>Academic Records:</strong>
        <button type="button" id="add_academic" name="add_academic" class="btn btn-dark btn-sm waves-effect m-l-5 m-b-10 pull-right">
            <i class="fa fa-plus fa-fw"></i> | Add Record
        </button>
        <div class="m-t-20">
            <div class="margin-10">
                <div class="form-group">
                    <div class="row">
                        <div id="academic_table_body" class="container-fluid"></div>

                        <div class="form-group margin-top-10"></div>

                        <span id="academic_record_message"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div>
        <button type="button" id="add_attachment" onclick="AddAttachment()" name="add_attachment" class="btn btn-dark btn-sm waves-effect m-l-5 m-t-10 m-b-10 pull-right"><i class="fa fa-plus"></i> | Add Attachment</button>
        <div class="form-group">
            <div class="table-rep-plugin">
                <div class="table-responsive b-0">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Attachment</th>
                                <th>Attachment Type</th>
                                <th class="text-center" style="width: 6%;">Action</th>
                            </tr>
                        </thead>
                        <tbody id="attachment_table_body">

                        </tbody>
                    </table>
                    <div class="form-group margin-top-10">

                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="m-b-10" id="ca_section" hidden="true">
        <strong>CA History (For CA Students):</strong>
        <div class="m-t-10 div-border-rad" style="">
            <div class="margin-10">
                <div class="form-group">
                    <div class="row" id="course_div">
                        <div class="col-md-4">
                            <label>AFC/CAF/CFAP/MSA:</label>
                            <div>
                                <textarea data-parsley-type="ca_subject" type="text"
                                       class="form-control letter_capitalize" required
                                       name="ca_subject" id="ca_subject"
                                       placeholder="Enter Subject"></textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Status:</label>
                            <div>
                                {!! Form::select('ca_status', config('constants.academic_statuses'), (isset($enquiry)&&$enquiry!=null)?$enquiry['ca_status_id']:null, ['id' => 'ca_status', 'class' => 'form-control select2', 'placeholder' => '--- Select Status ---']) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>RAET/Institution:</label>
                            <div>
                                <input name="raet_institution" id="raet_institution" required type="text" placeholder="Enter RAET/Institution" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>ICAP CRN:</label>
                            <div>
                                <input name="icap_crn" id="icap_crn" required type="number" placeholder="Enter ICAP CRN" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>ICAP Roll No:</label>
                            <div>
                                <input name="icap_roll_no" id="icap_roll_no" required type="number" placeholder="Enter ICAP Roll No" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="m-b-10" id="ab_checklists">
        <strong>Affiliated Body Checklist:</strong>
        <div id="checklists"></div>
    </div>


    <div class="">
        <button type="button" onclick="validateAdmissionForm()" class="btn btn-primary btn-sm"><i class="fa fa-money"></i> | Proceed to Accounts</button>
        <a class="btn btn-secondary btn-sm" href="{{ route('admissions.index') }}">Close</a>
    </div>
</div>

