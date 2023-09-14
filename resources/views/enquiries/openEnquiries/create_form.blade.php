<div class="form-row">
    @csrf
    <div class="form-group col-md-2">
        {!! Form::label('organization_campus', 'Organization Campus:') !!}<span style="color: red">*</span>
        {{ Form::select('organization_campus_id', $organization_campuses, null, ['class' => 'form-control select2 item-required','id' => 'organization_campus_id','placeholder' => '--- Select Organization Campus ---','onchange' => 'putOrganizationCampusToSession()','errorLabel' => 'Organization Campus']) }}
    </div>
    <div class="form-group col-md-2" id="session_div">
        {!! Form::label('session', 'Session:') !!}<span style="color: red">*</span>
        {{ Form::select('session_id', $sessions, null, ['class' => 'form-control select2 item-required','id' => 'session_id','placeholder' => '--- Select Session ---','onchange' => 'getCoursesBySession()','errorLabel' => 'Session']) }}
    </div>
    <div class="form-group col-md-2">
        {!! Form::label('enquiry by', 'Enquiry By:') !!}<span style="color: red">*</span>
        <select class="form-control select2 item-required" id="user_id" errorLabel="Enquiry By" name="user_id">
            <option value="">-------- Select CSO --------</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-2">
        {!! Form::label('enquiry_type', 'Enquiry Type:') !!}<span style="color: red">*</span>
        {!! Form::select('enquiry_type', array_slice(config('constants.enquiry_types'), 4, 5, true), null, ['id' => 'enquiry_type', 'class' => 'form-control select2 item-required', 'placeholder' => '--- Select Type ---', 'errorLabel' => 'Enquiry Type']) !!}
    </div>
    <div class="form-group col-md-2">
        <label>Enquiry Category:<span style="color: red">*</span></label>
        {!! Form::select('student_category_id', config('constants.student_categories'), null, ['id' => 'student_category_id', 'onchange' => 'onWorkerSelect()', 'class' => 'form-control select2 item-required', 'placeholder' => '------ Select ------', 'errorLabel' => 'Enquiry Category']) !!}
    </div>
    <div class="form-group col-md-2">
        <label>Enquiry Date:<span style="color: red">*</span></label>
        <input class="form-control item-required" errorLabel="Enquiry Date" max="{{ date('Y-m-d') }}"
            data-parsley-type="enquiry_date" id="enquiry_date" value="{{ date('Y-m-d') }}" type="date" required />
    </div>
</div>
<div class="row">
    <div class="col-md-12 m-b-10">
        <strong>
            Student's Information:
        </strong>
        <div class="m-t-10 div-border">
            <div class="margin-10">
                <div class="row">
                    <div class="col-md-3">
                        <label>
                            Name:<span style="color: red">*</span>
                        </label>
                        <input class="form-control letter_capitalize item-required"
                            onkeypress="return alphabaticOnly(event)" data-parsley-type="name" id="name"
                            placeholder="Enter Name" required="" errorLabel="Name" type="text" />
                    </div>
                    <div class="col-md-3">
                        <label>
                            CNIC:
                        </label>
                        <input class="form-control text-right" min="0" data-parsley-type="student_cnic_no"
                            maxlength="13" id="student_cnic_no" onkeypress="return numericOnly(event)"
                            placeholder="Enter CNIC" required="" type="text" />
                    </div>
                    <div class="col-md-3">
                        <label>
                            D.O.B:
                        </label>
                        <input class="form-control" max="{{ date('Y-m-d') }}" data-parsley-type="dob" id="dob"
                            required="" type="date" />
                    </div>
                    <div class="col-md-3">
                        <label>
                            E-mail Address:
                        </label>
                        <input class="form-control" data-parsley-type="email" placeholder="Enter Student Email"
                            id="email" type="email" />
                    </div>
                    <div class="col-md-3">
                        <label>
                            Father's Name:<span style="color: red">*</span>
                        </label>
                        <input class="form-control letter_capitalize item-required" errorLabel="Father Name"
                            onkeypress="return alphabaticOnly(event)" data-parsley-type="father_name" id="father_name"
                            placeholder="Enter Father's Name" required="" type="text" />
                    </div>
                    <div class="col-md-3">
                        <label>
                            Father's CNIC:
                        </label>
                        <input class="form-control text-right" min="0" data-parsley-type="father_cnic_no" maxlength="13"
                            id="father_cnic_no" onkeypress="return numericOnly(event)" placeholder="Enter Father's CNIC"
                            required="" type="text" />
                    </div>
                    <div class="col-md-3">
                        <label>
                            Shift:<span style="color: red">*</span>
                        </label>
                        {!! Form::select('shift_id', config('constants.shifts'), null, ['id' => 'shift_id', 'class' => 'form-control select2 item-required', 'placeholder' => '--- Select Shift ---', 'errorLabel' => 'Shift']) !!}
                    </div>
                    <div class="col-md-3">
                        <label>
                            Gender:<span style="color: red">*</span>
                        </label>
                        {!! Form::select('gender_id', config('constants.genders'), null, ['id' => 'gender_id', 'class' => 'form-control select2 item-required', 'placeholder' => '--- Select Gender ---', 'errorLabel' => 'Gender']) !!}
                    </div>
                    <div class="form-group col-md-3">
                        <label>
                            Town / City:
                        </label>
                        {!! Form::select('city_id', $cities, null, ['id' => 'city_id', 'class' => 'form-control select2', 'placeholder' => '----- Select -----', 'onchange' => 'onCitySelect()']) !!}
                    </div>
                    <div class="form-group col-md-3" id="city_other_name" hidden="true">
                        <label>
                            Other City Name:
                        </label>
                        <input class="form-control letter_capitalize" onkeypress="return alphabaticOnly(event)"
                            data-parsley-type="other_city_name" id="other_city_name" placeholder="Enter Other City Name"
                            required="" type="text" />
                    </div>
                    <div class="form-group col-md-3">
                        <label>
                            Area:<span style="color: red">*</span>
                        </label>
                        <input class="form-control letter_capitalize item-required" errorLabel="Area" id="area"
                            name="area" placeholder="Add Area" type="text">
                        </input>
                    </div>
                    <div class="form-group col-md-3">
                        <label>
                            Present Address:
                        </label>
                        <input class="form-control letter_capitalize" errorLabel="Present Address" id="present_address"
                            name="present_address" placeholder="Present Address" type="text">
                        </input>
                    </div>
                    <div class="form-group col-md-3">
                        <label>
                            Permanent Address:
                        </label>
                        <input class="form-control letter_capitalize" id="permanent_address" name="permanent_address"
                            placeholder="Permanent Address" type="text">
                        </input>
                    </div>
                    <div class="col-md-3">
                        <label>
                            Father's Occupation:
                        </label>
                        <textarea class="form-control letter_capitalize" id="father_occupation" required=""
                            rows="2"></textarea>
                    </div>
                    <div class="col-md-3">
                        <div class="custom-control custom-checkbox margin-top-30">
                            <input type="checkbox" class="custom-control-input" id="is_domicile">
                            <label class="custom-control-label" for="is_domicile">Domicile</label>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label>
                            Transport Facility:<span style="color: red">*</span>
                        </label>
                        {!! Form::select('is_transport', config('constants.is_transport'), null, ['id' => 'is_transport', 'onchange' => 'onTransportSelect()', 'class' => 'form-control select2 item-required', 'placeholder' => '--- Select Transport Status ---', 'errorLabel' => 'Transport Facility']) !!}
                    </div>
                    <div class='col-md-3' id='transport_route'>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 m-b-10" hidden="hidden" id="worker_div">
        <strong>Worker's Factory Information:</strong>
        <div class="div-border padding-10">
            <div class="row">

                <div class="col-2">
                    <label>
                        Prospects:<span style="color: red">*</span>
                    </label>
                    {!! Form::select('prospects_id', ['Yes', 'No'], null, ['id' => 'prospects_id', 'onchange' => 'showProspectDiv()', 'class' => 'form-control select2', 'placeholder' => '--- Select Prospect Status ---', 'errorLabel' => 'Prospects']) !!}
                </div>
                <div class="col-10 pull-right">
                    <button class="btn btn-dark btn-sm waves-effect waves-light pull-right"
                        onclick="addWorkerSection()"><i class="fa fa-plus"></i> | Add New</button>
                </div>
            </div>
            <div id="worker_details">
            </div>
            <div id="prospect_details" hidden="hidden" class="m-t-10 m-b-10">
                <div class="div-border padding-10">
                    <strong>
                        Prospect's Details:
                    </strong>
                    <button class="btn btn-dark btn-sm waves-effect waves-light pull-right" style="margin-top: -5px"
                        onclick="addProspectDetail()"><i class="fa fa-plus"></i> | Add New</button>
                    <div id="prospect_details_div">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 m-b-10">
        <strong>
            Contact Information:
        </strong>
        <button type="button" id="add_contact" name="add_contact"
            class="btn btn-dark btn-sm waves-effect m-l-5 m-b-10 pull-right"><i class="fa fa-plus"></i> | Add
            Contact</button>
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
    <div class="col-md-12 m-b-10">
        <strong>
            Academic Information:
        </strong>
        <div class="m-t-10 div-border">
            <div class="margin-10">
                <div class="row">
                    <div class="form-group col-md-3">
                        <label>
                            Previous Degree:
                        </label>
                        {!! Form::select('previous_degree_id', config('constants.previous_degrees'), null, ['id' => 'previous_degree_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Previous Degree ---', 'onchange' => 'onPreviousDegreeSelect()']) !!}
                    </div>
                    <div class="form-group col-md-3" id="other_case_div" hidden>
                        <label>
                            Degree Name (Other):
                        </label>
                        <input class="form-control letter_capitalize" id="degree_name_other"
                            onkeypress="return alphabaticOnly(event)" name="degree_name_other"
                            placeholder="Add Degree Name" type="text">
                    </div>
                    <div class="form-group col-md-3">
                        <label>
                            Previous Degree Affiliated Body:
                        </label>
                        <input class="form-control letter_capitalize" id="previous_degree_body"
                            name="previous_degree_body" placeholder="Previous Body" type="text">
                    </div>
                    <div class="form-group col-md-3">
                        <label>
                            Passing Year:
                        </label>
                        <input class="form-control text-right" onkeypress="return numericOnly(event)" id="passing_year"
                            name="passing_year" placeholder="Passing Year" required="" type="text">
                        </input>
                    </div>
                    <div class="form-group col-md-3">
                        <label>
                            Marks Obtained:
                        </label>
                        <input class="form-control text-right" min="0" id="marks_obtained" name="marks_obtained"
                            placeholder="Marks Obtained" required="" type="number">
                        </input>
                    </div>
                    <div class="form-group col-md-3">
                        <label>
                            Total Marks:
                        </label>
                        <input class="form-control text-right" min="0" id="total_marks" onchange="validateMarks()"
                            onmouseup="validateMarks()" name="total_marks" placeholder="Total Marks" type="number">
                        </input>
                    </div>
                    <div class="form-group col-md-3">
                        <label>
                            Percentage:
                        </label>
                        <div class="input-group mb-3">
                            <input class="form-control text-right" id="percentage" min="0" max="100" name="percentage"
                                readonly="" placeholder="Percentage" type="number">
                            <div class='input-group-append'>
                                <span class='input-group-text'>%</span>
                            </div>
                        </div>
                        </input>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="m-b-10" id="course_information_div" hidden="hidden">
    <strong>
        Course Information:
    </strong>
    <div class="m-t-10 div-border">
        <div class="margin-10">
            <div class="row">
                <div class="col-md-3" id="course_div">

                </div>
                <div class="col-md-3" id="affiliated_body_div">
                </div>
                <div class="col-md-3" id="academic_term_div">
                </div>
            </div>
        </div>
        @include('layouts/loading')
    </div>
</div>
<div class="m-b-10">
    <strong>
        Reference:
    </strong>
    <div class="m-t-10 div-border">
        <div class="margin-10">
            <div class="row">
                <div class="form-group col-md-3">
                    <label>
                        Source of Information:
                    </label>
                    <div>
                        {!! Form::select('source_info_id', config('constants.information_sources'), null, ['id' => 'source_info_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Source ---', 'onchange' => 'onSourceOfInformationSelect()']) !!}
                    </div>
                </div>
                <div class="form-group col-md-3" hidden="true" id="marketer_name_div">
                    {!! Form::label('marketer_name', 'Marketer Name:') !!}
                    <input class="form-control letter_capitalize" id="marketer_name" name="marketer_name"
                        placeholder="Enter Marketer Name" type="text" />
                </div>
                <div class="form-group col-md-3" hidden="true" id="faculty_member_name_div">
                    {!! Form::label('faculty_member_name', 'Faculty Member Name:') !!}
                    <input class="form-control letter_capitalize" id="faculty_member_name" name="faculty_member_name"
                        placeholder="Enter Faculty Member Name" type="text" />
                </div>
                <div class="form-group col-md-3" hidden="true" id="academy_school_name_div">
                    {!! Form::label('academy_school_name', 'Academy/ School Name:') !!}
                    <input class="form-control letter_capitalize" id="academy_school_name" name="academy_school_name"
                        placeholder="Enter Academy/ School Name" type="text" />
                </div>
                <div class="form-group col-md-3" hidden="true" id="social_media_type_id_div">
                    <label>
                        Social Media:
                    </label>
                    <div>
                        {!! Form::select('social_media_type_id', config('constants.social_media_types'), null, ['id' => 'social_media_type_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Social Media ---', 'onchange' => 'onSocialMediaSelect()']) !!}
                    </div>
                </div>
                <div class="form-group col-md-3" hidden="true" id="other_social_media_name_div">
                    {!! Form::label('other_social_media', 'Other (Social Media):') !!}
                    <input class="form-control letter_capitalize" id="other_social_media_name"
                        name="other_social_media_name" placeholder="Enter Other Source" type="text" />
                </div>
                <div class="form-group col-md-3" hidden="true" id="ex_student_wing_type_id_div">
                    <label>
                        Student's/ Ex-Student's Wing:
                    </label>
                    <div>
                        {!! Form::select('ex_student_wing_type_id', App\Models\Wing::pluck('name', 'id'), null, ['id' => 'ex_student_wing_type_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Wing ---']) !!}
                    </div>
                </div>
                <div class="form-group col-md-3" hidden="true" id="ex_student_name_div">
                    {!! Form::label('ex_student_name', 'Student\'' . 's/ Ex-Student\'' . 's Name:') !!}
                    <input class="form-control letter_capitalize" id="ex_student_name" name="ex_student_name"
                        placeholder="Enter Student/ Ex-Student Name" type="text" />
                </div>
                <div class="form-group col-md-3" hidden="true" id="friend_name_div">
                    {!! Form::label('friend_name', 'Friend\'' . 's Name:') !!}
                    <input class="form-control letter_capitalize" id="friend_name" name="friend_name"
                        placeholder="Enter Friend Name" type="text" />
                </div>
                <div class="form-group col-md-3" hidden="true" id="other_source_of_info_div">
                    {!! Form::label('other_source_of_info', 'Other (Source of Information):') !!}
                    <input class="form-control letter_capitalize" id="other_source_of_info" name="other_source_of_info"
                        placeholder="Enter Other (Source of Information)" type="text" />
                </div>
            </div>
        </div>
    </div>
</div>
<div class="m-b-10">
    <strong>
        Follow Up Information:
    </strong>
    <div class="m-t-10 div-border">
        <div class="margin-10">
            <div class="row">

                <div class="form-group col-md-3">
                    <label>
                        Enquiry Status:<span style="color: red">*</span>
                    </label>
                    {!! Form::select('followup_status_id', array_slice(config('constants.followup_statuses'), 0, 3, true), null, ['id' => 'followup_status_id', 'class' => 'form-control select2 item-required', 'onchange' => 'onFollowupStatusSelect()', 'placeholder' => '--- Select Status ---', 'errorLabel' => 'Enquiry Status']) !!}
                </div>
                <div class="form-group col-md-3" id="followup_interested_level_div" hidden="hidden">
                    <label>
                        Enquiry Ranking:<span style="color: red">*</span>
                    </label>
                    {!! Form::select('follow_up_interested_level_id', config('constants.follow_up_interested_levels'), null, ['id' => 'follow_up_interested_level_id', 'class' => 'form-control select2 item-required', 'placeholder' => '--- Select ---', 'errorLabel' => 'Interested Level']) !!}
                </div>
                <div class="form-group col-md-3" id="followup_date_div" hidden="hidden">
                    <label>
                        Next Follow-Up Date:<span style="color: red">*</span>
                    </label>
                    <input class="form-control item-required" errorLabel="Next Followup Date"
                        id="next_followup_date_id" name="next_followup_date" type="date"
                        onchange="validateFollowupDate()">
                    </input>
                </div>
                <div class="form-group col-md-12" id="followup_auto_msg_div" hidden="hidden">
                    <div class="row" style="margin-left: 2px;
                        background: #ecf6ff;
                        padding: 10px 0px 10px 0px;
                        margin-right: 2px;">
                        <div class="col-12">
                            <a><i class="mdi mdi-information-outline"></i> <b>Note:</b> Follow-Up for this enquiry will
                                be <u>auto-generated</u> to defined date.</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <label>
        Remarks:<span style="color: red">*</span>
    </label>
    <div>
        <textarea class="form-control letter_capitalize item-required" id="remarks" errorLabel="Remarks" name="remarks"
            required="" rows="5"></textarea>
    </div>
</div>
<div class="form-group">
    <div>
        <button class="btn btn-primary waves-effect waves-light" onclick="checkDuplicateStudentCellNo()" type="button">
            Submit
        </button>
        <a href="{{ route('enquiries.index') }}" class="btn btn-secondary waves-effect m-l-5" type="reset">
            Cancel
        </a>
    </div>
</div>
