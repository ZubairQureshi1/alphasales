{{-- BASIC SESSION INFORMATION --}}
<div class="row">
    <div class="col-md-2" id="session_div">
        {!! Form::label('session', 'Session:') !!}
        {{ Form::select('session_id', \Auth::user()->userAllowedSessions()->get()->pluck('session_name', 'session_id'), \Auth::user()->userAllowedSessions()->count()>0?Illuminate\Support\Facades\Session::get('selected_session_id'):null, ['class' => 'form-control select2', 'id' => 'session_id', 'placeholder' => '--- Select Session ---', 'onchange' => 'getCoursesBySession()',  'errorLabel' => 'Session', 'disabled']) }}
    </div>
    <input type="hidden" name="id" id="enquiry_id" value="{{$enquiry->id}}">
    <div class="form-group col-md-3">
        {!! Form::label('enquiry by', 'Enquiry By:') !!}
        <select class="form-control select2" id="user_id" name="user_id" disabled>
            <option  value="{{$enquiry->user->id}}">{{$enquiry->user->name}}</option>
        </select>
    </div>
    <div class="form-group col-md-2">
        {!! Form::label('enquiry_type', 'Enquiry Type:') !!}
        <select class="form-control select2" id="enquiry_type" name="enquiry_type" disabled>
            <option>{{ucwords($enquiry->enquiry_type)}}</option>
        </select>
    </div>
    <div class="col-md-2">
        <label>Enquiry Category</label>
        {!! Form::select('student_category_id', config('constants.student_categories'), $enquiry->student_category_id, ['id' => 'student_category_id', 'onchange' => 'onWorkerSelect()', 'class' => 'form-control select2', 'placeholder' => '------ Select ------', 'disabled' => true]) !!}
    </div>
    <div class="col-md-3">
        <label>Enquiry Date</label>
        <input class="form-control" name="enquiry_date" id="enquiry_date" value="{{$enquiry->enquiry_date}}" required type="date" readonly />
    </div>
</div>
{{-- STUDENT INFORMATION --}}
<div class="row">
    <div class="col-md-12 m-b-10">
        <strong>Student's Information:</strong>
        <div class="m-t-10 div-border">
            <div class="margin-10">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>Name:</label>
                        <input class="form-control letter_capitalize" data-parsley-type="name" id="name" name="name" type="text" value="{{$enquiry->name}}" readonly/>
                    </div>
                    <div class="form-group col-md-3">
                        <label>CNIC:</label>
                        <input class="form-control" name="student_cnic_no" id="student_cnic_no" value="{{$enquiry->student_cnic_no}}" placeholder="------" type="text" readonly/>
                    </div>
                    <div class="form-group col-md-3">
                        <label>D.O.B:</label>
                        <input class="form-control" value="{{$enquiry->dob}}" name="dob" id="dob" type="date" readonly/>
                    </div>
                    <div class="form-group col-md-3">
                        <label>E-mail Address:</label>
                        <input class="form-control" name="email" value="{{$enquiry->email}}" id="email" placeholder="------" type="email" readonly/>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Father's Name:</label>
                        <input class="form-control letter_capitalize" name="father_name" id="father_name" value="{{$enquiry->father_name}}" placeholder="------" type="text" readonly/>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Father's CNIC:</label>
                        <input class="form-control" value="{{$enquiry->father_cnic_no}}" name="father_cnic_no" type="text" placeholder="------" readonly/>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Shift:</label>
                        {!! Form::select('shift_id', config('constants.shifts'), $enquiry->shift_id, ['id' => 'shift_id', 'class' => 'form-control select2', 'placeholder' => '-----', 'disabled' => true]) !!}
                    </div>
                    <div class="form-group col-md-3">
                        <label>Gender:</label>
                        {!! Form::select('gender_id', config('constants.genders'), $enquiry->gender_id, ['id' => 'gender_id', 'class' => 'form-control select2', 'placeholder' => '-----', 'disabled' => true]) !!}
                    </div>
                    <div class="form-group col-md-3">
                        <label>Town / City:</label>
                        {!! Form::select('city_id', $cities, $enquiry->city_id, ['id' => 'city_id', 'class' => 'form-control select2', 'placeholder' => '-----', 'onchange' => 'onCitySelect()', 'disabled' => true]) !!}
                    </div>
                    <div class="form-group col-md-3" id="city_other_name" {{ $enquiry->city_id == 128 ? '' : 'hidden="true"'}}>
                        <label>Other City Name:</label>
                        <input class="form-control letter_capitalize" onkeypress="return alphabaticOnly(event)" data-parsley-type="other_city_name" id="other_city_name" placeholder="Enter Other City Name" required type="text" value="{{ $enquiry->other_city_name }}" readonly />
                    </div>
                    <div class="form-group col-md-3">
                        <label>Area:</label>
                        <input class="form-control letter_capitalize" errorLabel="Area" value="{{$enquiry->area}}" id="area" name="area" placeholder="------" type="text" readonly />
                    </div>
                    <div class="form-group col-md-3">
                        <label>Present Address:</label>
                        <input class="form-control letter_capitalize" value="{{$enquiry->present_address}}" id="present_address" name="present_address" placeholder="------" type="text" readonly/>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Permanent Address:</label>
                        <input class="form-control letter_capitalize" value="{{$enquiry->permanent_address}}" id="permanent_address" name="permanent_address" placeholder="------" type="text" readonly />
                    </div>
                    <div class="col-md-3 form-group">
                        <label>Fathers Occupation:</label>
                        <input class="form-control letter_capitalize" name="father_occupation" placeholder="------" value="{{$enquiry->father_occupation}}" rows="2" readonly />
                    </div>
                    <div class="form-group col-md-3">
                        <label>Transport Facility:</label>
                        {!! Form::select('is_transport', config('constants.is_transport'), $enquiry->is_transport, ['id' => 'is_transport', 'onchange'=>'onTransportSelect()','class' => 'form-control select2', 'placeholder' => '-----', 'disabled' => true]) !!}
                    </div>
                    <div class='col-md-3' id='transport_route'>
                        @if($enquiry->is_transport == '0')
                        <label>Transport Stop:<span style='color: red'>*</span></label>
                        <input type='text' name='transport_stop' value="{{$enquiry->transport_stop}}" errorLabel='Transport Stop' id='transport_stop' class='form-control' placeholder="------" readonly>
                        @endif
                    </div>
                    <div class="col-md-3 form-group">
                        <div class="custom-control custom-checkbox margin-top-30">
                            <input type="checkbox" class="custom-control-input" {{$enquiry->is_domicile == 1 ? 'checked' : '' }} value="1" name="is_domicile" id="is_domicile" disabled>
                            <label class="custom-control-label" for="is_domicile">Domicile</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- PROPECT INORMATION --}}
<div class="row">
    <div class="col-md-12 m-b-10" id="worker_div">
        @if($enquiry->student_category_id == '0')
        <strong>Factory Worker's Information:</strong>
        <div class="div-border padding-10 m-t-10">
            <div id="worker_details">
                @foreach ($enquiry->enquiryWorkers as $detail)
                <div class="div-border padding-10 mb-3">
                    <div class="form-row">
                        <div class="col-md-3 form-group">
                            <label>Factory Name:</label>
                            <input type="text" name="factory_name" id="factory_name_0" class="form-control letter_capitalize" placeholder="-------" value="{{ $detail->factory_name }}" readonly>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Work Type:</label>
                            <select name="worker_work_type_id" id="worker_work_type_id_0" class="form-control" disabled>
                                <option disabled>No Type Select</option>
                                <option value="0" {{ $detail->worker_work_type_id == 0 ? 'selected' : '' }}>Permanent/ Regular</option>
                                <option value="1" {{ $detail->worker_work_type_id == 1 ? 'selected' : '' }}>Through Contractor</option>
                            </select>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Service Experience:</label>
                            <div class="input-group mb-3">
                                <input type="text" name="experience" id="worker_experience_in_years_0" class="form-control text-center" placeholder="------" value="{{ $detail->worker_experience_in_years }}" readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text">Years</span>
                                </div>
                                <input type="text" name="experience" id="worker_experience_in_months_0" class="form-control text-center" placeholder="------" value="{{ $detail->worker_experience_in_months }}" readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text">Months</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Designation:</label>
                            <input type="text" name="designation" id="worker_designation_0" class="form-control letter_capitalize" placeholder="-------" value="{{ $detail->worker_designation }}" readonly />
                        </div>
                        <div class="col-md-3 form-group">
                            <label>EOBI/ SSC:</label>
                            <select name="eobi_ssc" id="eobi_ssc_id_0" class="form-control" disabled>
                                <option value="">No Value Selected</option>
                                <option value="0" {{ $detail->is_eobi == 0 ? 'selected' : '' }}>Yes</option>
                                <option value="1" {{ $detail->is_eobi == 1 ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Factory Registered:</label>
                            <select name="is_frc" id="is_factory_registered_0" class="form-control" disabled>
                                <option value="">No Value Selected</option>
                                <option value="0" {{ $detail->is_frc == 0 ? 'selected' : '' }}>Yes</option>
                                <option value="1" {{ $detail->is_frc == 1 ? 'selected' : '' }}>Not Clear</option>
                            </select>
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
<div class="row">
    <div class="col-md-12 m-b-10">
        <strong>Contact Information:</strong>
        <div class="m-t-10 div-border">
            <div class="margin-11">
                <table class="table table-bordered" id="contact_table_body">
                    <thead>
                        <tr>
                            <th width="35%" class="text-center">Contact No</th>
                            <th width="35%" class="text-center">Relationship</th>
                            <th width="35%" class="text-center">Other Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($enquiry->enquiryContactInfos->count() > 0)
                        @foreach($enquiry->enquiryContactInfos as $key => $contact_info)
                        <tr>
                            <td>
                                <input id="contact_no_{{$key}}" value="{{$contact_info->phone_no}}" type="text" placeholder="XXXX-XXXXXXX" data-mask="9999-9999999" class="form-control" readonly>
                            </td>
                            <td>
                                <select id="contact_type_{{$key}}" onchange='onContactRelationshipSelect("{{$key}}")' class='form-control' errorLabel='Contact Type ( Row " {{ $key }} " )' disabled>
                                    @foreach(config('constants.contact_types') as $contact_type_key=> $contact_types)
                                    <option {{$contact_info->contact_type_id == $contact_type_key ? 'selected' : ''}} value="{{$contact_type_key}}">{{$contact_types}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input id='other_name_{{ $key }}' type='text' class='form-control' value="{{$contact_info->other_name}}" placeholder="-------" disabled>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
{{-- ACADEMIC INFORATION --}}
<div class="row">
    <div class="col-md-12 m-b-10">
        <strong>Academic Information:</strong>
        <div class="m-t-10 div-border">
            <div class="margin-10">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>Previous Degree:</label>
                        {!! Form::select('previous_degree_id', config('constants.previous_degrees'), $enquiry->previous_degree_id, ['id' => 'previous_degree_id','class' => 'form-control select2', 'placeholder' => '--- Select Previous Degree ---', 'onchange' => 'onPreviousDegreeSelect()', 'disabled' => true]) !!}
                    </div>
                    <div class="form-group col-md-3" id="other_case_div" {{!empty($enquiry->degree_name_other) ? '' : 'hidden="true"'}}>
                        <label>Degree Name (Other):</label>
                        <input class="form-control letter_capitalize" id="degree_name_other" name="degree_name_other" placeholder="------" value="{{$enquiry->degree_name_other}}" type="text" readonly>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Previous Degree Affiliated Body:</label>
                        <input class="form-control letter_capitalize" id="previous_degree_body" name="previous_degree_body" placeholder="------" type="text" value="{{ $enquiry->previous_degree_body }}" readonly>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Passing Year:</label>
                        <input class="form-control" id="passing_year" value="{{$enquiry->passing_year}}" name="passing_year" placeholder="------" type="text" readonly>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Marks Obtained:</label>
                        <input class="form-control" id="marks_obtained" name="marks_obtained" placeholder="------" onkeyup="calculatePercentage()" value="{{$enquiry->marks_obtained}}" type="number" readonly />
                    </div>
                    <div class="form-group col-md-3">
                        <label>Total Marks:</label>
                        <input class="form-control" id="total_marks" name="total_marks" onkeyup="calculatePercentage()" value="{{$enquiry->total_marks}}" placeholder="------" type="number" readonly />
                    </div>
                    <div class="col-md-3">
                        <label>Percentage:</label>
                        <div class="input-group mb-3">
                            <input class="form-control" name="percentage" placeholder="------" value="{{$enquiry->percentage}}" type="number" readonly />
                            <div class='input-group-append'>
                                <span class='input-group-text'>%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- COURSE INFORMATION --}}
<div class="row">
    <div class="col-md-12 m-b-10">
        <strong>Course Information:</strong>
        <div class="m-t-10 div-border">
            <div class="margin-10">
                <div class="form-row">
                    <div class="col-md-3">
                        <label>Course:</label>
                        <select class="form-control" disabled>
                            <option>{{ isset($enquiry->course->name) ? $enquiry->course->name : '-----' }}</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Affiliated Body:</label>
                        <select class="form-control" disabled>
                            <option>{{ $enquiry->affiliatedBody }}</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Degree Type:</label>
                        {!! Form::select('degree_type', config('constants.academic_terms'), $enquiry->academic_term_id, ['id' => 'degree_type','class' => 'form-control select2', 'placeholder' => '-----', 'disabled' => true]) !!}
                    </div>
                </div>
            </div>
            @include('layouts/loading')
        </div>
    </div>
</div>
{{-- REFERENCES INFORMATION --}}
<div class="row">
    <div class="col-md-12 m-b-10">
        <strong>Reference:</strong>
        <div class="m-t-10 div-border">
            <div class="margin-10">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        {!! Form::label('reference', 'Reference:') !!}
                        <input class="form-control letter_capitalize" id="reference_name" name="reference_name" placeholder="Reference" type="text" value="{{ $enquiry->reference_name }}" readonly/>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Source of Information:</label>
                        {!! Form::select('source_info_id', config('constants.information_sources'), $enquiry->source_info_id, ['id' => 'source_info_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Source ---', 'onchange' => 'onSourceOfInformationSelect()', 'disabled' => true]) !!}
                    </div>
                    <div class="form-group col-md-3" {{ $enquiry->source_info_id == 17 ? '' : 'hidden="true"' }} id="marketer_name_div">
                        {!! Form::label('marketer_name', 'Marketer Name:') !!}
                        <input class="form-control letter_capitalize" id="marketer_name" name="marketer_name" placeholder="Enter Marketer Name" type="text" value="{{ $enquiry->marketer_name }}" readonly />
                    </div>
                    {{--  faculty member --}}
                    <div class="form-group col-md-3" {{ $enquiry->source_info_id == 3 ? '' : 'hidden="true"' }} id="faculty_member_name_div">
                        {!! Form::label('faculty_member_name', 'Faculty Member Name:') !!}
                        <input class="form-control letter_capitalize" id="faculty_member_name" name="faculty_member_name" placeholder="Enter Faculty Member Name" type="text" value="{{ $enquiry->faculty_member_name }}" readonly/>
                    </div>
                    {{-- academy / school name --}}
                    <div class="form-group col-md-3" {{ $enquiry->source_info_id == 5 ? '' : 'hidden="true"' }} id="academy_school_name_div">
                        {!! Form::label('academy_school_name', 'Academy/ School Name:') !!}
                        <input class="form-control letter_capitalize" id="academy_school_name" name="academy_school_name" placeholder="Enter Academy/ School Name" type="text" value="{{ $enquiry->academy_school_name }}" readonly/>
                    </div>
                    <div class="form-group col-md-3" hidden="true" id="social_media_type_id_div">
                        <label>Social Media:</label>
                        {!! Form::select('social_media_type_id', config('constants.social_media_types'), $enquiry->social_media_type_id, ['id' => 'social_media_type_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Social Media ---', 'onchange' => 'onSocialMediaSelect()', 'disabled' => true]) !!}
                    </div>
                    <div class="form-group col-md-3" {{ $enquiry->social_media_type_id == 2 ? '' : 'hidden="true"' }} id="other_social_media_name_div">
                        {!! Form::label('other_social_media', 'Other (Social Media):') !!}
                        <input class="form-control letter_capitalize" id="other_social_media_name" name="other_social_media_name" placeholder="Enter Other Source" type="text" value="{{ $enquiry->other_social_media_name }}" readonly/>
                    </div>
                    <div class="form-group col-md-3" hidden="true" id="ex_student_wing_type_id_div">
                        <label>Student's/ Ex-Student's Wing:</label>
                        {!! Form::select('ex_student_wing_type_id', App\Models\Wing::pluck('name', 'id'), $enquiry->ex_student_wing_type_id , ['id' => 'ex_student_wing_type_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Wing ---', 'disabled' => true]) !!}
                    </div>
                    <div class="form-group col-md-3" {{ $enquiry->source_info_id == 19 ? '' : 'hidden="true"' }} id="ex_student_name_div">
                        {!! Form::label('ex_student_name', 'Student\''.'s/ Ex-Student\''.'s Name:') !!}
                        <input class="form-control letter_capitalize" id="ex_student_name" name="ex_student_name" placeholder="Enter Student/ Ex-Student Name" type="text" value="{{ $enquiry->ex_student_name }}" readonly/>
                    </div>
                    <div class="form-group col-md-3" {{ $enquiry->source_info_id == 20 ? '' : 'hidden="true"' }} id="friend_name_div">
                        {!! Form::label('friend_name', 'Friend\''.'s Name:') !!}
                        <input class="form-control letter_capitalize" id="friend_name" name="friend_name" placeholder="Enter Friend Name" type="text" value="{{$enquiry->friend_name}}" readonly/>
                    </div>
                    <div class="form-group col-md-3" {{ $enquiry->source_info_id == 21 ? '' : 'hidden="true"' }} id="other_source_of_info_div">
                        {!! Form::label('other_source_of_info', 'Other (Source of Information):') !!}
                        <input class="form-control letter_capitalize" id="other_source_of_info" name="other_source_of_info" placeholder="Enter Other (Source of Information)" value="{{ $enquiry->other_source_of_info }}" type="text" readonly/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- REMARKS INFORMATION --}}
<div class="row">
    <div class="col-md-12 m-b-10">
        <div class="form-group">
            <label>Remarks:</label>
            <div>
                <textarea class="form-control letter_capitalize" id="remarks" placeholder="------" name="remarks" rows="5" readonly>{{$enquiry->remarks}}
                </textarea>
            </div>
            <input type="hidden" id="enquiry_id" value="{{ $enquiry->id }}">
        </div>
    </div>
</div>