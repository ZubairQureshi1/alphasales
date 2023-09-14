<form class="" id="myForm" method="POST" action="{{ route('enquiries.store') }}" novalidate enctype="multipart/form-data">

    @csrf
    <div class="row">
        {{-- <h6 class="col-md-3" id="form_code" value="Form Code: {{ $form_code }}">
        Form Code: {{ $form_code }}
    </h6> --}}
        <div class="col-md-3" id="session_div" hidden>
            {!! Form::label('year_of_est', 'Year of Est:') !!}
            {{ Form::select('session_id',\Auth::user()->userAllowedSessions()->get()->pluck('session_name', 'session_id'),\Auth::user()->userAllowedSessions()->count() > 0? Illuminate\Support\Facades\Session::get('selected_session_id'): null,['class' => 'form-control select2 ','id' => 'session_id','placeholder' => '--- Select Year of Est ---','onchange' => 'getCoursesBySession()','never-bypass' => false,'errorLabel' => 'Year of Est','disabled','hidden']) }}
        </div>
        <div class="form-group col-md-3">
        <span style="color: red;">* </span>{!! Form::label('enquiry by', 'Enquiry By:') !!}

            <select class="form-control select2 item-required" id="user_id" errorLabel="Enquiry By" name="user_id" required>
                <!-- <option value="" selected disabled>--- Select CSO ---</option> -->
                @foreach (App\User::permission('view_enquiries_management')->get() as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-3">
           {!! Form::label('entry_by', 'Enquiry Entered By:') !!}

            <input class="form-control letter_capitalize item-required" readonly never-bypass
                onkeypress="return alphabaticOnly(event)" placeholder="Enter Name" required errorLabel="Name"
                value="{{ \Auth::user()->display_name }}" type="text" />
            {!! Form::select('entry_by', App\User::permission('create_enquiries_management')->pluck('name', 'id'), \Auth::id(), ['id' => 'entry_by', 'class' => 'form-control item-required', 'placeholder' => '--- Select Entry By ---', 'errorLabel' => 'Enquiry Entry Type', 'hidden']) !!}
        </div>
        <div class="form-group col-md-3">
            {!! Form::label('enquiry_type', 'Enquiry Type:') !!}
            {!! Form::select('enquiry_type', array_slice(config('constants.enquiry_types'), 1, 6, true), null, ['id' => 'enquiry_type', 'class' => 'form-control select2 item-required', 'placeholder' => '--- Select Type ---', 'never-bypass' => true, 'errorLabel' => 'Enquiry Type', 'onchange' => 'onEnquirySelect()']) !!}
        </div>

        <div class="form-group col-md-3" id="other_enquiry_type" hidden="true">
            <label>
                Other Enquiry Type:
            </label>
            <input class="form-control letter_capitalize" onkeypress="return alphabaticOnly(event)"
                data-parsley-type="name_other_enquiry_type" id="name_other_enquiry_type" name="name_other_enquiry_type"
                placeholder="Enter Other Enquiry Type" type="text" />
        </div>

        <div class="form-group col-md-3">
            {!! Form::label('income_range', 'Income Range:') !!}
            {!! Form::select('income_range', array_slice(config('constants.income_range'), 0, 4, true), null, ['id' => 'income_range', 'class' => 'form-control select2 item-required', 'placeholder' => '--- Select Income Range ---', 'never-bypass' => true, 'errorLabel' => 'Income Range']) !!}
        </div>
        {{-- <div class="form-group col-md-3">
        {!! Form::label('customer_social_class', 'Customer Social Class:') !!}
        {!! Form::select('customer_social_class', array_slice(config('constants.customer_social_class'), 0, 6, true), null, ['id' => 'customer_social_class', 'class' => 'form-control select2 item-required', 'placeholder' => '--- Select Class ---', 'never-bypass' => true, 'errorLabel' => 'Customer Social Class']) !!}
    </div> --}}

        {{-- <div class="col-md-3"> --}}
        {{-- <label>Enquiry Category:</label> --}}
        <input class="form-control text-right" required="" value="PAID" type="hidden" />

        {{-- </div> --}}
        <div class="col-md-3">
            <label>Enquiry Date:</label>
            <input class="form-control item-required" errorLabel="Enquiry Date" max="{{ date('Y-m-d') }}"
                value="{{ date('Y-m-d') }}" data-parsley-type="enquiry_date" id="enquiry_date" required type="date"
                name="enquiry_date" />
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 m-b-10">
            <strong>
                Customer’s Information:
            </strong>
            <div class="m-t-10 div-border">
                <div class="margin-10">
                    <div class="row">
                        <div class="col-md-3">
                            <label>
                                *Name:
                            </label>
                            <input class="form-control letter_capitalize item-required" never-bypass
                                onkeypress="return alphabaticOnly(event)" data-parsley-type="name" id="name" name="name"
                                placeholder="Enter Name" required="" errorLabel="Name" type="text" required />
                        </div>
                        {{-- <div class="col-md-3">
                        <label>
                            Introduced By:
                        </label>
                        <input class="form-control text-right" min="0" data-parsley-type="introduced_by" maxlength="13"
                            id="introduced_by" onkeypress="return alphabaticOnly(event)"
                            placeholder="Enter Introduced By" required="" type="text" />
                    </div> --}}
                        <div class="col-md-3">
                            <label>
                                CNIC:
                            </label>
                            {{-- <input class="form-control text-left" min="0" data-parsley-type="student_cnic_no"
                                maxlength="13" id="student_cnic_no" onkeypress="return numericOnly(event)"
                                placeholder="Enter CNIC" type="text" name="student_cnic_no" /> --}}
                                <!-- pattern="03[0-9]{2}-(?!1234567)(?!1111111)(?!7654321)[0-9]{7}" -->
                                <!-- data-inputmask="'mask': '99999-9999999-9'" -->
                                <input class="mt-1 form-control text-left" type="text" data-role="input, input-mask" data-mask="**** ******** *" required data-mask-placeholder="*" data-parsley-type="student_cnic_no"
                                id="student_cnic_no" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==15) return false;"  name="student_cnic_no">
                           {{--  <input class="form-control text-left"   placeholder="Enter CNIC" required=""
                                type="number"  />
 --}}
                            {{-- <input type="text" pattern="03[0-9]{2}-(?!1234567)(?!1111111)(?!7654321)[0-9]{7}"
                                name="mobile_number" placeholder="Mobile Number" required> <input type="text"
                                data-inputmask="'mask': '99999-9999999-9'" placeholder="XXXXX-XXXXXXX-X" name="cnic"
                                required="" class="form-control text-left"> --}}


                        </div>
                        <div class="col-md-3">
                            <label>
                                D.O.B:
                            </label>
                            <input class="form-control" required max="{{ date('Y-m-d') }}" data-parsley-type="dob" id="dob"
                                name="dob" type="date" value="1900-01-01" />
                        </div>
                        <div class="col-md-3">
                            <label>
                                E-mail Address:
                            </label>
                            <input class="form-control" data-parsley-type="email" placeholder="Enter Customer Email"
                                id="email" type="email" name="email" />
                        </div>
                        <div class="col-md-3">
                            <label>
                                Father's Name:
                            </label>
                            <input class="form-control letter_capitalize item-required" required errorLabel="Father Name"
                                onkeypress="return alphabaticOnly(event)" data-parsley-type="father_name"
                                id="father_name" name="father_name" placeholder="Enter Father's Name"
                                type="text" />
                        </div>


                        <div class="col-md-3">
                            <label>
                                Gender:
                            </label>
                            {!! Form::select('gender_id', config('constants.genders'), null, ['id' => 'gender_id', 'class' => 'form-control select2 item-required', 'placeholder' => '--- Select Gender ---', 'errorLabel' => 'Gender']) !!}
                        </div>
                        <div class="form-group col-md-3">
                            <label>
                                City:
                            </label>
                            {!! Form::select('city_id', $cities, null, ['id' => 'city_id', 'class' => 'form-control select2 item-required', 'placeholder' => '----- Select -----', 'onchange' => 'onCitySelect()']) !!}
                        </div>
                        <div class="form-group col-md-3" id="city_other_name" hidden="true">
                            <label>
                                Other City Name:
                            </label>
                            <input class="form-control letter_capitalize" onkeypress="return alphabaticOnly(event)"
                                data-parsley-type="other_city_name" id="other_city_name"
                                placeholder="Enter Other City Name" type="text" />
                        </div>
                        {{-- <div class="form-group col-md-3">
                        <label>Address:</label>
                        <input class="form-control letter_capitalize item-required" errorLabel="Area" id="area"
                            name="area" placeholder="Add Area" type="text">
                        </input>
                    </div> --}}
                        <div class="form-group col-md-3">
                            <label>Present Address:</label>
                            <input class="form-control letter_capitalize" required errorLabel="Present Address"
                                id="present_address" name="present_address" placeholder="Complete Present Address"
                                type="text">
                            </input>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Permanent Address:</label>
                            <input class="form-control letter_capitalize" required id="permanent_address"
                                name="permanent_address" placeholder="Complete Permanent Address" type="text">
                            </input>
                        </div>


                        <div class="form-group col-md-3">
                            {!! Form::label('mobile_1', 'Mobile 1:') !!}
                            <input required id="phone1" class="form-control" type="tel" name="phone1" />
                        </div>

                        <div class="form-group col-md-3">
                            {!! Form::label('mobile_2', 'Mobile 2:') !!}
                            <input required id="phone2" class="form-control" type="tel" name="phone2" />
                        </div>

                        <div class="form-group col-md-3">
                            {!! Form::label('landline', 'Landline:') !!}
                            <input required id="landline" class="form-control" type="tel"
                                onkeypress="return numericOnly(event)" placeholder="Enter Landline Number"
                                name="landline" maxlength="11" />
                        </div>

                        


                        {{-- Domicile --}}
                        {{-- <div class="form-group  col-md-3">
                        <div class="custom-control custom-checkbox margin-top-30">
                            <input type="checkbox" class="custom-control-input" id="is_domicile">
                            <label class="custom-control-label" for="is_domicile">Domicile</label>
                        </div>
                    </div> --}}
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-md-12 m-b-10" hidden="hidden" id="worker_div">
            <strong>Worker's Factory Information:</strong>
            <div class="div-border padding-10">
                <div class="row">
                    <div class="col-2">
                        <label>Prospects: </label>
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
                        <strong>Prospect's Details:</strong>
                        <button class="btn btn-dark btn-sm waves-effect waves-light pull-right" style="margin-top: -5px"
                            onclick="addProspectDetail()"><i class="fa fa-plus"></i> | Add New</button>
                        <div id="prospect_details_div">
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        {{-- <div class="col-md-12 m-b-10">
        <strong>Contact Information:</strong>
        <button type="button" id="add_contact" name="add_contact"
            class="btn btn-dark btn-sm waves-effect m-l-5 m-b-10 pull-right"><i class="fa fa-plus"></i> | Add
            Contact</button>
        <div class="m-t-20 div-border">
            <div class="margin-10">
                <table class="table table-bordered" id="contact_table_body">
                <table class="table table-bordered" id="">
                    <thead>
                        <tr>
                            <th width="35%" class="text-center">Contact No</th>
                            <th width="35%" class="text-center">Relationship</th>
                            <th width="35%" class="text-center">Other Name</th>
                            <th width="30%" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <td> <input id="phone" type="tel" name="phone" />

                        </td>
                        <td> <input type="submit" class="btn" value="Verify" />

                        </td>

                    </tbody>
                </table>
            </div>
        </div>
    </div> --}}
        {{-- <div class="col-md-12 m-b-10">
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
                        <input class="form-control text-right" min="0" id="marks_obtained" onchange="validateMarks()"
                            onmouseup="validateMarks()" name="marks_obtained" placeholder="Marks Obtained" required
                            type="number">
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
    </div> --}}
    </div>
    {{-- <div class="m-b-10" id="course_information_div" hidden="hidden">
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
    </div> --}}

    <div class="m-b-10">
        <strong>
            Product Information:
        </strong>
        <div class="m-t-10 div-border">
            <div class="margin-10">
                <div class="row">
                    
                   
                    <div class="form-group col-md-3">
                        <label>
                        <span style="color: red;">* </span>Project:
                        </label>
                        <div>
                            <select class="form-control select2 item-required" id="project_id" errorLabel="Project"
                                name="project_id">
                                <!-- <option value="" selected disabled>--- Select Project ---</option> -->
                                @foreach (App\Models\Wing::select('name', 'id')->orderBy('name')->get()
    as $project)
                                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group col-md-3">
                        <label>
                        <span style="color: red;">* </span>Product:
                        </label>
                        <div>
                            <select class="form-control select2 item-required" id="product_id" errorLabel="Product"
                                name="product_id" required>
                                <!-- <option value="" selected disabled>--- Select Product ---</option> -->
                                {{-- @foreach (App\Models\Course::select('name', 'id')->orderBy('name')->get()
    as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                    </div>
                     <div class="form-group col-md-3">
                        <label>
                        <span style="color: red;">* </span>Developer:
                        </label>
                        <div>
                            <select class="form-control select2 item-required" id="developer_id" errorLabel="Developer"
                                name="developer_id" required>
                                <!-- <option value="" selected disabled>--- Select Developer ---</option> -->
                                {{-- @foreach (App\Models\AffiliatedBody::select('name', 'id')->orderBy('name')->get()
    as $developer)
                                    <option value="{{ $developer->id }}">{{ $developer->name }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Price Offered:</label>
                        <input class="form-control letter_capitalize" id="price_offer" name="price_offer"
                            placeholder="Enter Price Offered" type="text">
                        </input>
                    </div>
                    
                    <div class="form-group col-md-3">
                            {!! Form::label('address', 'Property Address:') !!}
                            <input required  class="form-control" type="text"
                                 placeholder="Enter Address"
                                name="address"  />
                        </div>
                    <div class="form-group col-md-3">
                            {!! Form::label('image', 'Image:') !!}
                            <input required id="image" class="form-control" type="file"
                                placeholder="Select image"
                                name="image" />
                        </div>

                </div>
            </div>
        </div>
    </div>
    <div class="m-b-10">
        {{-- <strong>
        Reference:
    </strong> --}}
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

                    <div class="col-md-3" hidden="true" id="refer_name_div">
                        <label>
                            Referred By:
                        </label>
                        <input class="form-control text-left" min="0" data-parsley-type="introduced_by"
                            id="introduced_by" name="introduced_by" onkeypress="return alphabaticOnly(event)"
                            placeholder="Enter Referred By" required="" type="text" />
                    </div>

                    {{-- <div class="form-group col-md-3" hidden="true" id="marketer_name_div">
                        {!! Form::label('marketer_name', 'Marketer Name:') !!}
                        <input class="form-control letter_capitalize" id="marketer_name" name="marketer_name"
                            placeholder="Enter Marketer Name" type="text" />
                    </div>
                    <div class="form-group col-md-3" hidden="true" id="faculty_member_name_div">
                        {!! Form::label('faculty_member_name', 'Faculty Member Name:') !!}
                        <input class="form-control letter_capitalize" id="faculty_member_name"
                            name="faculty_member_name" placeholder="Enter Faculty Member Name" type="text" />
                    </div>
                    <div class="form-group col-md-3" hidden="true" id="academy_school_name_div">
                        {!! Form::label('academy_school_name', 'Academy/ School Name:') !!}
                        <input class="form-control letter_capitalize" id="academy_school_name"
                            name="academy_school_name" placeholder="Enter Academy/ School Name" type="text" />
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
                    </div> --}}
                    <div class="form-group col-md-3" hidden="true" id="other_source_of_info_div">
                        {!! Form::label('other_source_of_info', 'Other (Source of Information):') !!}
                        <input class="form-control letter_capitalize" id="other_source_of_info"
                            name="other_source_of_info" placeholder="Enter Other (Source of Information)" type="text" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="m-b-10">
        <strong>Follow Up Information:</strong>
        <div class="m-t-10 div-border">
            <div class="margin-10">
                <div class="row">
                    <div class="form-group col-md-3">
                        <label>
                            Enquiry Status:
                        </label>
                        {!! Form::select('followup_status_id', array_slice(config('constants.followup_statuses'), 0, 3, true), null, ['id' => 'followup_status_id', 'class' => 'form-control select2 item-required', 'onchange' => 'onFollowupStatusSelect()', 'placeholder' => '--- Select Status ---', 'never-bypass' => true, 'errorLabel' => 'Enquiry Status']) !!}
                    </div>
                    <div class="form-group col-md-3" id="followup_interested_level_div" hidden="hidden">
                        <label>
                            Enquiry Ranking:
                        </label>
                        {!! Form::select('follow_up_interested_level_id', config('constants.follow_up_interested_levels'), null, ['id' => 'follow_up_interested_level_id', 'class' => 'form-control select2 item-required', 'placeholder' => '--- Select ---', 'never-bypass' => true, 'hidden' => true, 'errorLabel' => 'Enquiry Ranking']) !!}
                    </div>
                    <div class="form-group col-md-3" id="followup_date_div" hidden="hidden">
                        <label>
                            Next Follow-Up Date:
                        </label>
                        <input class="form-control item-required" errorLabel="Next Followup Date" never-bypass hidden
                            id="next_followup_date_id" name="next_followup_date" type="date"
                            onchange="validateFollowupDate()">
                        </input>
                    </div>
                    <div class="form-group col-md-12" id="followup_auto_msg_div" hidden="hidden">
                        {{-- <div class="row" style="margin-left: 2px;
                        background: #ecf6ff;
                        padding: 10px 0px 10px 0px;
                        margin-right: 2px;">
                        <div class="col-12">
                            <a><i class="mdi mdi-information-outline"></i> <b>Note:</b> Follow-Up for this enquiry will
                                be <u>auto-generated</u> to defined date.</a>
                        </div>
                    </div> --}}
                    </div>
                </div>
                {{-- <div class="m-b-10 pwwbFileInformationDiv" id="pwwbFileInformationDiv" hidden="hidden">
                    <strong>Pwwb File Information:</strong>
                    <div class="m-t-10 div-border">
                        <div class="margin-10">
                            <div class="form-row">
                                <div class="col-4 form-group">
                                    <label>File Recieved</label>
                                    {!! Form::select('file_received_status', config('constants.file_received_status'), null, ['id' => 'file_received_status_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Status ---', 'errorLabel' => 'File Recieved Status', 'onchange' => 'onFileReceivedStatusSelect()']) !!}
                                </div>
                                {{-- R number --}}
                <div class="col-4 form-group" id="file_received_number_div" hidden="hidden">
                    <label>File Recieved Number</label>
                    <input type="text" name="file_received_number" id="file_received_number_id" class="form-control"
                        placeholder="Enter File R-Number" onkeypress="appendSDashForR(event, 'R-')">
                </div>
                {{-- M number --}}
                {{-- <div class="col-4 form-group" id="module_number_div" hidden="hidden">
                    <label>Module Number</label>
                    <input type="text" name="file_module_number" id="module_number_id" class="form-control"
                        placeholder="Enter File M-Number" onkeypress="appendSDashForR(event, 'M-')" readonly>
                </div>
            </div>
        </div>
    </div>
    </div> --}}
            </div>
        </div>
    </div>

    <div class="form-group">
        <label>
            Remarks:
        </label>
        <div>
            <textarea class="form-control item-required" id="remarks" errorLabel="Remarks" name="remarks"
                required="" rows="5"></textarea>
        </div>
    </div>
    <div class="form-group">
        <div>
            {{-- <button class="btn btn-primary waves-effect waves-light" onclick="validateForm()" type="button">
                Submit
            </button> --}}
            <button type="submit" class="btn btn-primary">Submit</button>

            <a href="{{ route('enquiries.index') }}" class="btn btn-secondary waves-effect m-l-5" type="reset">
                Cancel
            </a>
        </div>
    </div>
</form>
<script type="text/javascript">
    const product = document.getElementById('product_id')
    const developer = document.getElementById('developer_id')
    const form = document.getElementById('myForm')
    form.addEventListener('submit', (e)=>{
        if(product.value === "" || product.value === null || developer.value === "" || developer.value === null){
            e.preventDefault()
            alert("Product and Developer are not selected")
        }
    })

</script>
