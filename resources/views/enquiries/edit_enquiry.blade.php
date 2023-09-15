<form id="myForm" method="post" action="{{ url('/') }}/enquiries/{{ $enquiry->id }}" novalidate enctype="multipart/form-data">
    {{ method_field('PATCH') }}
    @csrf
    {{-- BASIC INFORMATION --}}
    <div class="row">
        <div class="form-group col-md-3" id="session_div" hidden>
            {!! Form::label('year_of_est', 'Year of Est:') !!}
            {{ Form::select('session_id',\Auth::user()->userAllowedSessions()->get()->pluck('session_name', 'session_id'),\Auth::user()->userAllowedSessions()->count() > 0? Illuminate\Support\Facades\Session::get('selected_session_id'): null,['class' => 'form-control select2 ','id' => 'session_id','placeholder' => '--- Select Year of Est ---','onchange' => 'getCoursesBySession()','never-bypass' => false,'errorLabel' => 'Year of Est','disabled']) }}
        </div>
        <input type="hidden" name="id" id="enquiry_id" value="{{ $enquiry->id }}">
        <div class="form-group col-md-3">
        <span style="color: red;">* </span>{!! Form::label('enquiry by', 'Enquiry By:') !!}
            <select class="form-control select2" id="user_id" name="user_id">
                <option>-------- Select CSO --------</option>
                @foreach (App\User::permission('view_enquiries_management')->get() as $user)
                    <option {{ $enquiry->user_id == $user->id ? 'selected' : '' }} value="{{ $user->id }}">
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-md-3">
            {!! Form::label('entry_by', 'Enquiry Entered By:') !!}

            {!! Form::select('entry_by', App\User::permission('create_enquiries_management')->pluck('name', 'id'),$enquiry->entry_by, ['id' => 'entry_by', 'class' => 'form-control select2 item-required', 'placeholder' => '--- Select Entry By ---', 'errorLabel' => 'Enquiry Entry Type' , 'disabled' => 'disabled']) !!}
        </div>

        <div class="form-group col-md-3">
            {!! Form::label('enquiry_type', 'Enquiry Type:') !!}
            {!! Form::select('enquiry_type', array_slice(config('constants.enquiry_types'), 1, 6, true), $enquiry->enquiry_type, ['id' => 'enquiry_type', 'class' => 'form-control select2', 'placeholder' => '--- Select Type ---', 'onchange' => 'onEnquirySelect()']) !!}
        </div>

        <div class="form-group col-md-3" id="other_enquiry_type" hidden="true">
            <label>
                Other Enquiry Type:
            </label>
            <input class="form-control letter_capitalize" onkeypress="return alphabaticOnly(event)"
                data-parsley-type="name_other_enquiry_type" id="name_other_enquiry_type" name="name_other_enquiry_type"
                placeholder="Enter Other Enquiry Type" value="{{ $enquiry->name_other_enquiry_type }}" type="text" />
        </div>

        <div class="form-group col-md-3">
            {!! Form::label('income_range', 'Income Range:') !!}
            {!! Form::select('income_range', array_slice(config('constants.income_range'), 0, 4, true), $enquiry->income_range, ['id' => 'income_range', 'class' => 'form-control select2 item-required', 'placeholder' => '--- Select Income Range ---', 'never-bypass' => true, 'errorLabel' => 'Income Range']) !!}
        </div>

        {{-- <div class="form-group col-md-3">
            <label>Enquiry Category </label>
            {!! Form::select('student_category_id', config('constants.student_categories'), $enquiry->student_category_id, ['id' => 'student_category_id', 'class' => 'form-control select2', 'placeholder' => '------ Select ------', 'disabled' => true]) !!}
        </div> --}}
        <div class="form-group col-md-3">
            <label>Enquiry Date</label>
            <input class="form-control item-required" errorLabel="Enquiry Date" max="{{ date('Y-m-d') }}"
                value="{{ $enquiry->enquiry_date }}" data-parsley-type="enquiry_date" id="enquiry_date" required
                type="date" name="enquiry_date" />
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 m-b-10">
            <strong>Customer’s Information:</strong>
            <div class="m-t-10 div-border">
                <div class="margin-10">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label>
                                Name:
                            </label> <input class="form-control letter_capitalize item-required"
                                onkeypress="return alphabaticOnly(event)" data-parsley-type="name" id="name" name="name"
                                placeholder="Enter Name" required="" errorLabel="Name" type="text"
                                value="{{ $enquiry->name }}" />
                        </div>

                        {{-- <div class="col-md-3">
                            <label>
                                Introduced By:
                            </label>
                            <input class="form-control text-right" min="0" data-parsley-type="introduced_by"
                                maxlength="13" id="introduced_by" onkeypress="return alphabaticOnly(event)"
                                placeholder="Enter Introduced By" required="" type="text"
                                value="{{ $enquiry->introduced_by }}" />
                        </div> --}}

                        <div class="form-group col-md-3">
                            <label>CNIC:</label>
                            <input class="mt-1 form-control text-left" type="text" data-role="input, input-mask" data-mask="**** ******** *" data-mask-placeholder="*" data-parsley-type="student_cnic_no"
                                id="student_cnic_no student_cnic_no_eidt" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==15) return false;" value="{{ $enquiry->student_cnic_no }}"  name="student_cnic_no">

                           {{--  <input class="form-control text-left" data-parsley-type="student_cnic_no"
                                id="student_cnic_no" pattern="03[0-9]{2}-(?!1234567)(?!1111111)(?!7654321)[0-9]{7}"
                                data-inputmask="'mask': '99999-9999999-9'" placeholder="Enter CNIC" required=""
                                type="text" name="student_cnic_no" value="{{ $enquiry->student_cnic_no }}" /> --}}
                        </div>
                        <div class="form-group col-md-3">
                            <label>D.O.B:</label>
                            <input class="form-control" max="{{ date('Y-m-d') }}" data-parsley-type="dob" id="dob"
                                required="" type="date" value="{{ $enquiry->dob }}" name="dob" />
                        </div>
                        <div class="form-group col-md-3">
                            <label>E-mail Address:</label>
                            <input class="form-control" data-parsley-type="email" placeholder="Enter Student Email"
                                id="email" type="email" value="{{ $enquiry->email }}" name="email" />
                            <span id="email_message"></span>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Father's Name:</label>
                            <input class="form-control letter_capitalize item-required" errorLabel="Father Name"
                                onkeypress="return alphabaticOnly(event)" data-parsley-type="father_name"
                                id="father_name" name="father_name" placeholder="Enter Father's Name" required=""
                                type="text" value="{{ $enquiry->father_name }}" />
                        </div>

                        <div class="form-group col-md-3">
                            <label>Gender:</label>
                            {!! Form::select('gender_id', config('constants.genders'), $enquiry->gender_id, ['id' => 'gender_id', 'class' => 'form-control select2 item-required',  'errorLabel' => 'Gender']) !!}
                            <span id="gender_msg" hidden="hidden" style="color: red" required>Gender Required</span>
                        </div>
                        <div class="form-group col-md-3">
                            <label>City:</label>
                            {!! Form::select('city_id', $cities, $enquiry->city_id, ['id' => 'city_id', 'class' => 'form-control select2', 'onchange' => 'onCitySelect()']) !!}
                        </div>
                        <div class="form-group col-md-3" id="city_other_name"
                            {{ $enquiry->city_id == 128 ? '' : 'hidden="true"' }}>
                            <label>Other City Name:</label>
                            <input class="form-control letter_capitalize" onkeypress="return alphabaticOnly(event)"
                                data-parsley-type="other_city_name" id="other_city_name"
                                placeholder="Enter Other City Name" required type="text"
                                value="{{ $enquiry->other_city_name }}" />
                        </div>

                        <div class="form-group col-md-3">
                            <label>Present Address:</label>
                            <input class="form-control letter_capitalize" value="{{ $enquiry->present_address }}"
                                id="present_address" name="present_address" placeholder="Present Address" type="text">
                            <span id="present_address_msg" hidden="hidden" style="color: red">Address Required</span>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Permanent Address:</label>
                            <input class="form-control letter_capitalize" value="{{ $enquiry->permanent_address }}"
                                id="permanent_address" name="permanent_address" placeholder="Permanent Address"
                                type="text">
                        </div>

                        <div class="form-group col-md-3">
                            {!! Form::label('mobile_1', 'Mobile 1:') !!}
                            <input required id="phone1" class="form-control" type="tel" name="phone1"
                                value="{{ $enquiry->phone1 }}" />
                        </div>

                        <div class="form-group col-md-3">
                            {!! Form::label('mobile_2', 'Mobile 2:') !!}
                            <input required id="phone2" class="form-control" type="tel" name="phone2"
                                value="{{ $enquiry->phone2 }}" />
                        </div>

                        <div class="form-group col-md-3">
                            {!! Form::label('landline', 'PTCL/Landline:') !!}
                            <input required id="landline" class="form-control" type="tel"
                                placeholder="Enter PTCL / Landline Number" name="landline"
                                value="{{ $enquiry->landline }}" />
                        </div>
                        
                        {{-- <div class="form-group col-md-3">
                            <label>Father's Occupation:</label>
                            <textarea class="form-control letter_capitalize" name="father_occupation"
                                id="father_occupation" placeholder="Enter Father's Occupation" rows="2"
                                required>{{ $enquiry->father_occupation }}</textarea>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Transport Facility:</label>
                            {!! Form::select('is_transport', config('constants.is_transport'), $enquiry->is_transport, ['id' => 'is_transport', 'onchange' => 'onTransportSelect()', 'class' => 'form-control select2 item-required', 'placeholder' => '--- Select Transport Status ---']) !!}
                        </div>
                        <div class="form-group col-md-3" id='transport_route'
                            {{ $enquiry->is_transport !== '0' ? 'hidden' : '' }}>
                            @if ($enquiry->is_transport == '0')
                                <label>Transport Stop:<span style='color: red'>*</span></label>
                                <input type='text' name='transport_stop' value="{{ $enquiry->transport_stop }}"
                                    errorLabel='Transport Stop' id='transport_stop' class='form-control item-required'
                                    placeholder='Enter Bus Stop'>
                            @endif
                        </div> --}}
                        {{-- provisional letter recieved column --}}
                        {{-- <div class="form-group col-md-3">
                            <label>Provisional Letter Application Recieved:</label>
                            {!! Form::select('provisional_letter_application_recieved', config('constants.enquiry_general_options'), $enquiry->provisional_letter_application_recieved, ['id' => 'provisional_letter_application_recieved', 'class' => 'form-control select2 item-required', 'placeholder' => '--- Select Status ---', 'errorLabel' => 'Provisional Letter Application Recieved']) !!}
                        </div> --}}
                        {{-- stamp paper filled --}}
                        {{-- <div class="col-md-3">
                            <label>Stamp Paper Filled:</label>
                            {!! Form::select('stamp_paper_filled', config('constants.enquiry_general_options'), $enquiry->stamp_paper_filled, ['id' => 'stamp_paper_filled', 'class' => 'form-control select2 item-required', 'placeholder' => '--- Select Status ---', 'errorLabel' => 'Stamp Paper Filled']) !!}
                        </div> --}}
                        {{-- Domicile --}}
                        {{-- <div class="col-md-3 form-group">
                            <div class="custom-control custom-checkbox margin-top-30">
                                <input type="checkbox" class="custom-control-input"
                                    {{ $enquiry->is_domicile == 1 ? 'checked' : '' }} name="is_domicile"
                                    id="is_domicile">
                                <label class="custom-control-label" for="is_domicile">Domicile</label>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- FACTORY INFORMATION --}}
    <div class="row">
        <div class="col-md-12 m-b-10" id="worker_div">
            @if ($enquiry->student_category_id == '0')
                <strong>Factory Worker's Information:</strong>
                <div class="div-border padding-10 m-t-10">
                    <div class="row">
                        <div class="col-2">
                            <label>Prospects:</label>
                            {!! Form::select('prospects_id', ['Yes', 'No'], $enquiry->parent_id == null && App\Models\Enquiry::where('parent_id', $enquiry->id)->count() > 0 ? 0 : ($enquiry->parent_id != null ? 0 : 1), [
    'id' => 'prospects_id',
    'class' => 'form-control select2',
    'placeholder' => '--- Select Prospect Status ---',
    'errorLabel' => 'Prospects',
    'disabled' => true,
]) !!}
                        </div>
                        <div class="col-10 pull-right">
                            <button class="btn btn-dark btn-sm waves-effect waves-light pull-right"
                                onclick="addWorkerSection()" type="button"><i class="fa fa-plus"></i> | Add
                                New</button>
                        </div>
                    </div>
                    <div id="worker_details">
                        @foreach ($enquiry->enquiryWorkers as $key => $detail)
                            <div class="m-t-15 div-border padding-10" id="worker_section_{{ $key }}">
                                <div class="form-row">
                                    <div class="col-md-3 form-group">
                                        <label>Factory Name:</label>
                                        <input type="text" name="factory_name"
                                            errorlabel="Worker Factory ( Row {{ $key }} )"
                                            onkeypress="return alphabaticOnly(event)"
                                            id="factory_name_{{ $key }}"
                                            class="form-control letter_capitalize item-required"
                                            placeholder="Factory Name" value="{{ $detail->factory_name }}">
                                        <span id="factory_name_msg_{{ $key }}" hidden="hidden"
                                            style="color: red">Factory Name Required</span>
                                    </div>
                                    <div class='col-md-3'>
                                        <label>Worker Name:<span style='color: red'>*</span></label>
                                        <input type='text' name='worker_name'
                                            errorLabel='Worker Name ( Row " + ({{ $key + 1 }}) + " )'
                                            onkeypress='return alphabaticOnly(event)'
                                            id='worker_name_{{ $key }}'
                                            class='form-control letter_capitalize item-required'
                                            placeholder='Worker Name' value="{{ $detail->worker_name }}">
                                        <span id='worker_name_msg_{{ $key }}' hidden='hidden'
                                            style='color: red'>Worker Name Required</span>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label>Work Type:</label>
                                        <select name="worker_work_type_id" id="worker_work_type_id_{{ $key }}"
                                            errorlabel="Work Type ( Row {{ $key }} )"
                                            class="form-control item-required">
                                            <option value="">----- Select -----</option>
                                            <option value="0"
                                                {{ $detail->worker_work_type_id == 0 ? 'selected' : '' }}>Permanent/
                                                Regular</option>
                                            <option value="1"
                                                {{ $detail->worker_work_type_id == 1 ? 'selected' : '' }}>Through
                                                Contractor</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label>Service Experience:</label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="experience" onkeypress="return numericOnly(event)"
                                                errorlabel="Experience In Years ( Row {{ $key }} )"
                                                id="worker_experience_in_years_{{ $key }}"
                                                class="form-control item-required" placeholder="Experience"
                                                value="{{ $detail->worker_experience_in_years }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Years</span>
                                            </div>
                                            <input type="text" name="experience" onkeypress="return numericOnly(event)"
                                                errorlabel="Experience In Months ( Row {{ $key }} )"
                                                id="worker_experience_in_months_{{ $key }}"
                                                class="form-control item-required" placeholder="Experience"
                                                onkeyup="validateMonthNumber(0)"
                                                value="{{ $detail->worker_experience_in_months }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Months</span>
                                            </div>
                                        </div>
                                        <span id="experience_msg_{{ $key }}" hidden="hidden"
                                            style="color: red">Experience Required</span>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label>Designation:</label>
                                        <input type="text" name="designation" onkeypress="return alphabaticOnly(event)"
                                            errorlabel="Designation ( Row {{ $key }} )"
                                            id="worker_designation_{{ $key }}"
                                            class="form-control letter_capitalize item-required"
                                            placeholder="Designation" value="{{ $detail->worker_designation }}">
                                        <span id="designation_msg_{{ $key }}" hidden="hidden"
                                            style="color: red">Designation Required</span>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label>EOBI/ SSC:</label>
                                        <select name="eobi_ssc" id="eobi_ssc_id_{{ $key }}"
                                            errorlabel="EOBI/ SSC ( Row {{ $key }} )"
                                            class="form-control item-required">
                                            <option value="">----- Select -----</option>
                                            <option value="0" {{ $detail->is_eobi == 0 ? 'selected' : '' }}>Yes
                                            </option>
                                            <option value="1" {{ $detail->is_eobi == 1 ? 'selected' : '' }}>No
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label>Factory Registered:</label>
                                        <select name="is_frc" id="is_factory_registered_{{ $key }}"
                                            class="form-control item-required"
                                            errorlabel="Factory Registered ( Row {{ $key }} )">
                                            <option value="">----- Select -----</option>
                                            <option value="0" {{ $detail->is_frc == 0 ? 'selected' : '' }}>Yes
                                            </option>
                                            <option value="1" {{ $detail->is_frc == 1 ? 'selected' : '' }}>Not Clear
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 form-group mt-4 ml-5 element-flex-end">
                                        <button class="btn btn-danger btn-sm waves-effect waves-light element-flex-end"
                                            onclick="workerSectionDelete({{ $key }})" type="button">
                                            <i class="mdi mdi-delete"></i> | Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
    {{-- CONTACT INFORMATION --}}
    {{-- <div class="row">
        <div class="col-md-12 m-b-10">
            <strong>Contact Information:</strong>
            <button type="button" id="add_contact" name="add_contact"
                class="btn btn-dark btn-sm waves-effect m-l-5 m-b-10 pull-right"><i class="fa fa-plus"></i> | Add
                Contact</button>
            <div class="m-t-10 div-border">
                <div class="margin-10">
                    <table class="table table-bordered" id="contact_table_body">
                        <thead>
                            <tr>
                                <th width="35%" class="text-center">Contact No</th>
                                <th width="35%" class="text-center">Relationship
                                </th>
                                <th width="35%" class="text-center">Other Name</th>
                                <th width="30%" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($enquiry->enquiryContactInfos->count() > 0)
                                @foreach ($enquiry->enquiryContactInfos as $key => $contact_info)
                                    <tr>
                                        <td>
                                            <input id="contact_no_{{ $key }}"
                                                value="{{ $contact_info->phone_no }}" type="text"
                                                placeholder="XXXX-XXXXXXX" data-mask="9999-9999999"
                                                class="form-control">
                                        </td>
                                        <td>
                                            <select id="contact_type_{{ $key }}"
                                                onchange='onContactRelationshipSelect("{{ $key }}")'
                                                class='form-control item-required'
                                                errorLabel='Contact Type ( Row " {{ $key }} " )'>
                                                @foreach (config('constants.contact_types') as $contact_type_key => $contact_types)
                                                    <option
                                                        {{ $contact_info->contact_type_id == $contact_type_key ? 'selected' : '' }}
                                                        value="{{ $contact_type_key }}">{{ $contact_types }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input id='other_name_{{ $key }}' type='text' class='form-control'
                                                {{ $contact_info->contact_type_id == 6 ? '' : 'disabled' }}
                                                errorLabel='Other Name ( Row " .{{ $key }}. " )'
                                                value="{{ $contact_info->other_name }}">
                                        </td>
                                        <td class="text-center">
                                            <div row_index="{{ $key }}"
                                                class="deleteRowButton btn btn-danger btn-sm waves-effect"><i
                                                    class="mdi mdi-delete"></i> | Delete</div>
                                        </td>
                                        <input type="hidden" name="contact_row_state_{{ $key }}"
                                            id="contact_row_state_{{ $key }}" value="unchanged"></input>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- ACADEMIC INFORMATION --}}
    {{-- <div class="row">
        <div class="col-md-12 m-b-10">
            <strong>Academic Information:</strong>
            <div class="m-t-10 div-border">
                <div class="margin-10">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label>Previous Degree:</label>
                            {!! Form::select('previous_degree_id', config('constants.previous_degrees'), $enquiry->previous_degree_id, ['id' => 'previous_degree_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Previous Degree ---', 'onchange' => 'onPreviousDegreeSelect()']) !!}
                        </div>
                        <div class="form-group col-md-3" id="other_case_div"
                            {{ $enquiry->previous_degree_id == 12 ? '' : 'hidden="true"' }}>
                            <label>Degree Name (Other):</label>
                            <input class="form-control letter_capitalize" id="degree_name_other"
                                onkeypress="return alphabaticOnly(event)" name="degree_name_other"
                                placeholder="Add Degree Name" type="text" value="{{ $enquiry->degree_name_other }}">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Previous Degree Affiliated Body:</label>
                            <input class="form-control letter_capitalize" id="previous_degree_body"
                                name="previous_degree_body" placeholder="Previous Body" type="text"
                                value="{{ $enquiry->previous_degree_body }}">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Passing Year:</label>
                            <input class="form-control" id="passing_year" value="{{ $enquiry->passing_year }}"
                                onkeypress="return numericOnly(event)" name="passing_year" placeholder="Passing Year"
                                required="" type="text" data-mask="9999">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Marks Obtained:</label>
                            <input class="form-control text-right" min="0" id="marks_obtained" name="marks_obtained"
                                placeholder="Marks Obtained" required="" type="number"
                                value="{{ $enquiry->marks_obtained }}" />
                        </div>
                        <div class="form-group col-md-3">
                            <label>Total Marks:</label>
                            <input class="form-control text-right" min="0" id="total_marks" onchange="validateMarks()"
                                onmouseup="validateMarks()" name="total_marks" placeholder="Total Marks" type="number"
                                value="{{ $enquiry->total_marks }}" />
                        </div>
                        <div class="col-md-3">
                            <label>Percentage:</label>
                            <div class="input-group mb-3">
                                <input class="form-control" id="percentage" min="0" max="100" name="percentage"
                                    readonly placeholder="Percentage" value="{{ $enquiry->percentage }}"
                                    type="number">
                                <div class='input-group-append'>
                                    <span class='input-group-text'>%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- COURSE INFORMATION --}}
    <div class="row">
        <div class="m-b-10 col-md-12" id="course_information_div" hidden="hidden">
            <strong>Course Information:</strong>
            <div class="m-t-10 div-border">
                <div class="margin-10">
                    <div class="row">
                        <div class="col-md-3" id="course_div"></div>
                        <div class="col-md-3" id="affiliated_body_div"></div>
                        <div class="col-md-3" id="academic_term_div"></div>
                    </div>
                </div>
                @include('layouts/loading')
            </div>
        </div>
    </div>
    {{-- REFERENCES INFORMATION --}}
    <div class="m-b-10">
        <strong>
            Product Information:
        </strong>
        <div class="m-t-10 div-border">
            <div class="margin-10">
                <div class="row">
                

@if($enquiry->father_occupation =='SHEET' && $enquiry->developer_name == NULL)         
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
@else
<div class="form-group col-md-3">
                        <label>
                            <span style="color: red;">* </span>Project:
                        </label>
                        <div>
                            <select class="form-control select2 item-required" id="project_id1" errorLabel="Project"
                                name="project_id" disabled>

                                <option value="" selected disabled>--- Select Project ---</option>
                                @foreach (App\Models\Wing::select('name', 'id')->orderBy('name')->get()
    as $project)
                                    <option value="{{ $project->id }}"
                                        {{ $project->id == $enquiry->project_id ? 'selected' : '' }}>
                                        {{ $project->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <input type="hidden" class="form-control-file" name="project_id" value="{{ $enquiry->project_id }}">
                    <div class="form-group col-md-3">
                        <label>
                        <span style="color: red;">* </span>Product:
                        </label>
                        <div>
                            <select class="form-control select2 item-required" id="product_id1" errorLabel="Product"
                                name="product_id" disabled>
                                {{-- <option value="" selected disabled>--- Select Product ---</option> --}}
                                <option value="{{ $enquiry->product_id }}">{{ $enquiry->product_name }}</option>
                                {{-- @foreach (App\Models\Course::select('name', 'id')->orderBy('name')->get()
    as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                    </div>
                    <input type="hidden" class="form-control-file" name="product_id" value="{{ $enquiry->product_id }}">
                    <div class="form-group col-md-3">
                        <label>
                        <span style="color: red;">* </span>Developer:
                        </label>
                        <div>
                            <select class="form-control select2 item-required" id="developer_id1" errorLabel="Developer"
                                name="developer_id" disabled>
                                {{-- <option value="" selected disabled>--- Select Developer ---</option> --}}
                                <option value="{{ $enquiry->developer_id }}">{{ $enquiry->developer_name }}
                                </option>
                                {{-- @foreach (App\Models\AffiliatedBody::select('name', 'id')->orderBy('name')->get()
    as $developer)
                                    <option value="{{ $developer->id }}">{{ $developer->name }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                    </div>
                    <input type="hidden" class="form-control-file" name="developer_id" value="{{ $enquiry->developer_id }}">
@endif
                   


                    

                    

                    <div class="form-group col-md-3">
                        <label>Price Offered:</label>
                        <input class="form-control letter_capitalize" id="price_offer" name="price_offer"
                            placeholder="Enter Price Offered" type="text" value="{{ $enquiry->price_offer }}">
                        </input>
                    </div>

                    <div class="form-group col-md-3">
                            {!! Form::label('address', 'Property Address:') !!}
                            <input required  class="form-control" type="text"
                                 placeholder="Enter Address"
                                 value="{{ $enquiry->address }}"
                                name="address"  />
                        </div>
                        <div class="form-group col-md-3">
                            {!! Form::label('image', 'Image:') !!}
                            <input required id="image" class="form-control" type="file"
                                placeholder="Select image"
                                name="image" />
                                @if(!empty($enquiry->image))
                                <a href="{{ asset('assets/images/') }}/{{ $enquiry->image }}" target='_blank'>
                            <img src="{{ asset('assets/images/') }}/{{ $enquiry->image }}" width="100">
                            </a>
                            @endif
                        </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="m-b-10 col-md-12">
            <strong>Reference:</strong>
            <div class="m-t-10 div-border">
                <div class="margin-10">
                    <div class="row">
                        <div class="form-group col-md-3" hidden="true">
                            {!! Form::label('reference', 'Reference:') !!}
                            <input class="form-control letter_capitalize" id="reference_name" name="reference_name"
                                placeholder="Reference" type="text" value="{{ $enquiry->reference_name }}" />
                        </div>
                        <div class="form-group col-md-3">
                            <label>Source of Information:</label>
                            {!! Form::select('source_info_id', config('constants.information_sources'), $enquiry->source_info_id, ['id' => 'source_info_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Source ---', 'onchange' => 'onSourceOfInformationSelect()']) !!}
                        </div>
                        <div class="col-md-3" hidden="true" id="refer_name_div">
                            <label>
                                Referred By:
                            </label>
                            <input class="form-control text-left" min="0" data-parsley-type="introduced_by"
                                id="introduced_by" name="introduced_by" onkeypress="return alphabaticOnly(event)"
                                placeholder="Enter Referred By" required="" type="text"
                                value="{{ $enquiry->introduced_by }}" />
                        </div>

                        <div class="form-group col-md-3" {{ $enquiry->source_info_id == 17 ? '' : 'hidden="true"' }}
                            id="marketer_name_div">
                            {!! Form::label('marketer_name', 'Marketer Name:') !!}
                            <input class="form-control letter_capitalize" id="marketer_name" name="marketer_name"
                                placeholder="Enter Marketer Name" type="text"
                                value="{{ $enquiry->marketer_name }}" />
                        </div>
                        <div class="form-group col-md-3" {{ $enquiry->source_info_id == 3 ? '' : 'hidden="true"' }}
                            id="faculty_member_name_div">
                            {!! Form::label('faculty_member_name', 'Faculty Member Name:') !!}
                            <input class="form-control letter_capitalize" id="faculty_member_name"
                                name="faculty_member_name" placeholder="Enter Faculty Member Name" type="text"
                                value="{{ $enquiry->faculty_member_name }}" />
                        </div>
                        <div class="form-group col-md-3" {{ $enquiry->source_info_id == 5 ? '' : 'hidden="true"' }}
                            id="academy_school_name_div">
                            {!! Form::label('academy_school_name', 'Academy/ School Name:') !!}
                            <input class="form-control letter_capitalize" id="academy_school_name"
                                name="academy_school_name" placeholder="Enter Academy/ School Name" type="text"
                                value="{{ $enquiry->academy_school_name }}" />
                        </div>
                        <div class="form-group col-md-3" hidden="true" id="social_media_type_id_div">
                            <label>Social Media:</label>
                            {!! Form::select('social_media_type_id', config('constants.social_media_types'), $enquiry->social_media_type_id, ['id' => 'social_media_type_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Social Media ---', 'onchange' => 'onSocialMediaSelect()']) !!}
                        </div>
                        <div class="form-group col-md-3"
                            {{ $enquiry->social_media_type_id == 3 ? '' : 'hidden="true"' }}
                            id="other_social_media_name_div">
                            {!! Form::label('other_social_media', 'Other (Social Media):') !!}
                            <input class="form-control letter_capitalize" id="other_social_media_name"
                                name="other_social_media_name" placeholder="Enter Other Source" type="text"
                                value="{{ $enquiry->other_social_media_name }}" />
                        </div>
                        <div class="form-group col-md-3" hidden="true" id="ex_student_wing_type_id_div">
                            <label>Student's/ Ex-Student's Wing:</label>
                            {!! Form::select('ex_student_wing_type_id', App\Models\Wing::pluck('name', 'id'), $enquiry->ex_student_wing_type_id, ['id' => 'ex_student_wing_type_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Wing ---']) !!}
                        </div>
                        <div class="form-group col-md-3" {{ $enquiry->source_info_id == 19 ? '' : 'hidden="true"' }}
                            id="ex_student_name_div">
                            {!! Form::label('ex_student_name', 'Student\'' . 's/ Ex-Student\'' . 's Name:') !!}
                            <input class="form-control letter_capitalize" id="ex_student_name" name="ex_student_name"
                                placeholder="Enter Student/ Ex-Student Name" type="text"
                                value="{{ $enquiry->ex_student_name }}" />
                        </div>
                        <div class="form-group col-md-3" {{ $enquiry->source_info_id == 20 ? '' : 'hidden="true"' }}
                            id="friend_name_div">
                            {!! Form::label('friend_name', 'Friend\'' . 's Name:') !!}
                            <input class="form-control letter_capitalize" id="friend_name" name="friend_name"
                                placeholder="Enter Friend Name" type="text" value="{{ $enquiry->friend_name }}" />
                        </div>
                        <div class="form-group col-md-3" {{ $enquiry->source_info_id == 21 ? '' : 'hidden="true"' }}
                            id="other_source_of_info_div">
                            {!! Form::label('other_source_of_info', 'Other (Source of Information):') !!}
                            <input class="form-control letter_capitalize" id="other_source_of_info"
                                name="other_source_of_info" placeholder="Enter Other (Source of Information)"
                                value="{{ $enquiry->other_source_of_info }}" type="text" />
                        </div>
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
                        {!! Form::select('followup_status_idedit', array_slice(config('constants.followup_statuses'), 0, 3, true), $enquiry->status, ['id' => 'followup_status_idedit', 'class' => 'form-control select2 item-required', 'onchange' => 'onFollowupStatusSelectedit()', 'placeholder' => '--- Select Status ---', 'never-bypass' => true, 'errorLabel' => 'Enquiry Status']) !!}
                    </div>
                    <div class="form-group col-md-3" id="followup_interested_level_divedit" hidden="hidden">
                        <label>
                            Enquiry Ranking:
                        </label>

                        {!! Form::select('follow_up_interested_level_idedit', config('constants.follow_up_interested_levels'), $enquiry->follow_up_interested_level_id, ['id' => 'follow_up_interested_level_idedit', 'class' => 'form-control select2 item-required', 'placeholder' => '--- Select ---', 'never-bypass' => true, 'hidden' => true, 'errorLabel' => 'Enquiry Ranking']) !!}
                    </div>
                    <div class="form-group col-md-3" id="followup_date_divedit" hidden="hidden">
                        <label>
                            Next Follow-Up Date:
                        </label>
                        <input class="form-control item-required" errorLabel="Next Followup Date" never-bypass hidden
                            id="next_followup_date_idedit" name="next_followup_date" type="date" onchange="validateFollowupDate()" value={{isset($enquiry->enquiryFollowups[0]->next_date) ? $enquiry->enquiryFollowups[0]->next_date:null}} 
                            >
                        </input>
                    </div>
                    <div class="form-group col-md-12" id="followup_auto_msg_divedit" hidden="hidden">
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
                {{-- <div class="m-b-10 pwwbFileInformationDiv" id="pwwbFileInformationDivedit" hidden="hidden">
                    <strong>Pwwb File Information:</strong>
                    <div class="m-t-10 div-border">
                        <div class="margin-10">
                            <div class="form-row">
                                <div class="col-4 form-group">
                                    <label>File Recieved</label>
                                    {!! Form::select('file_received_statusedit', config('constants.file_received_status'), null, ['id' => 'file_received_status_idedit', 'class' => 'form-control select2', 'placeholder' => '--- Select Status ---', 'errorLabel' => 'File Recieved Status', 'onchange' => 'onFileReceivedStatusSelect()']) !!}
                                </div>
                                {{-- R number --}}
                <div class="col-4 form-group" id="file_received_number_divedit" hidden="hidden">
                    <label>File Recieved Number</label>
                    <input type="text" name="file_received_number" id="file_received_number_idedit" class="form-control"
                        placeholder="Enter File R-Number" onkeypress="appendSDashForR(event, 'R-')">
                </div>
                {{-- M number --}}
                {{-- <div class="col-4 form-group" id="module_number_divedit" hidden="hidden">
                    <label>Module Number</label>
                    <input type="text" name="file_module_number" id="module_number_idedit" class="form-control"
                        placeholder="Enter File M-Number" onkeypress="appendSDashForR(event, 'M-')" readonly>
                </div>
            </div>
        </div>
    </div>
    {{-- ACTION BUTTONS --}}
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <strong>Remarks:</strong>
                <textarea class="form-control letter_capitalize m-t-10" id="remarks" name="remarks" required
                    rows="5">{{ $enquiry->remarks }}</textarea>
                <span id="remarks_msg" hidden="hidden" style="color: red">Remarks Required</span>
            </div>
            <div class="form-group">
                <input type="hidden" id="enquiry_id" value="{{ $enquiry->id }}">
                <a class="btn btn-light btn-sm pr-2" href="{{ route('enquiries.index') }}">
                    <i class="fa fa-times fa-fw text-danger"></i> Cancel
                </a>
                <button type="submit" class="btn btn-dark btn-sm waves-effect waves-light rounded-0"><i
                        class="fa fa-cloud-upload fa-fw"></i> | Update Changes</button>
                {{-- <button class="btn btn-dark btn-sm waves-effect waves-light rounded-0" type="button"
                    onclick="checkNumberDuplicacy()">
                    <i class="fa fa-cloud-upload fa-fw"></i> | Update Changes
                </button> --}}
            </div>
        </div>
    </div>
    <script>
        
        const form = document.getElementById('myForm')
        form.addEventListener('submit', (e)=>{
        const product = document.getElementById('product_id')
        const developer = document.getElementById('developer_id')
        if(product.value === "" || product.value === null || developer.value === "" || developer.value === null){
            e.preventDefault()
            alert("Product and Developer are not selected")
        }
    })


        




        
    </script>
</form>


