<div>
    <div class="m-b-10">
        <strong>Courses\Degree:</strong>
        <div class="m-t-10 div-border-rad" style="">
            <div class="margin-10">
                <div class="form-group">
                    <div class="row" id="course_div">
                        <div class="col-3" id="session_div">
                            <strong>Session</strong>
                            {{ Form::select('session_id', App\Models\Session::pluck('session_name', 'id'), $student['session_id'], ['class' => 'form-control select2', 'id' => 'session_id', 'placeholder' => '--- Select Session ---', 'disabled', 'onchange' => 'getCoursesBySession()']) }}
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
                    </div>
                    @include('layouts/loading')
                </div>
            </div>
        </div>
    </div>
    
    <?php if (isset($enquiry)): ?>
        <input name="enquiry_id" id="enquiry_id" hidden type="text" class="form-control" value="{!! $enquiry['enquiry_id'] !!}">
    <?php endif?>
    <div class="m-b-10">
        <strong>Student Information:</strong>
        <div class="m-t-10 div-border-rad">
            <div class="margin-10">
                <div class="form-row">
                    <div class="form-group col-md-4 col-sm-12 mb-3">
                        <label>Admission Form Type:</label>
                        {!! Form::select('student_category_id', config('constants.student_categories'), $student['student_category_id'], ['id' => 'student_category_id', 'class' => 'form-control select2-multiple', 'disabled', 'placeholder' => '--- Admission Type ---']) !!}
                    </div>

                    @if($student['student_category_id'] == 0)
                        {{-- File Registration ID --}}
                        <div class="form-group col-md-4 col-sm-12 mb-3">
                            <label>File Receive Number:</label>
                            <input type="text" value="{{ $admission->file_received_number ?? '---' }}" class="form-control" placeholder="File Receive Number" readonly>
                        </div>
                        {{-- File Module Number --}}
                        <div class="form-group col-md-4 col-sm-12 mb-3">
                            <label>File Module Number:</label>
                            <input type="text" value="{{ $admission->file_module_number ?? '---' }}" class="form-control" placeholder="File Receive Number" readonly>
                        </div>
                    @endif

                    <div class="form-group col-md-4 col-sm-12 mb-3">
                        <label>Student Admission Date:</label>
                        <input type="date" class="form-control" value="{{ $student['admission_date'] }}" name="admission_date" id="admission_date" readonly/>
                    </div>

                    <div class="form-group col-md-4 col-sm-12 mb-3">
                        <label>Registered:</label>
                         {!! Form::select('is_registered', config('constants.is_transport'), $student['is_registered'], ['id' => 'is_registered', 'class' => 'form-control select2', 'placeholder' => '--- Select Registration Status ---', 'disabled']) !!}
                    </div>

                    <div class="form-group col-md-4 col-sm-12 ">
                        <label>Student Name:</label>
                        <input type="text" class="form-control" value="{{ $student['student_name'] }}" name="student_name" id="student_name" placeholder="Enter Student Name" readonly/>
                    </div>
                    
                    <div class="form-group col-md-3 col-sm-12">
                        <label>Student CNIC:</label>
                        <input name="student_cnic_no" id="student_cnic_no" value="{{ $student['student_cnic_no'] }}" type="text" placeholder="XXXXX-XXXXXXX-X" data-mask="99999-9999999-9" class="form-control" readonly>
                    </div>
                
                    <div class="form-group col-md-3 col-sm-12">
                        <label>D.O.B:</label>
                        <input type="date" class="form-control" value="{{ $student['d_o_b'] }}" name="d_o_b" id="d_o_b" readonly/>
                    </div>

                    <div class="form-group col-md-3 col-sm-12">
                        <label>Email:</label>
                        <input name="email" id="email" type="email" value="{{ $student['email'] }}" placeholder="xyz@abc.com" class="form-control" readonly>
                    </div>
                    
                    <div class="form-group col-md-3 col-sm-12">
                        <label>Student Cell No:</label>
                        <input name="student_cell_no" id="student_cell_no" value="{{ $student['student_cell_no'] }}" type="text"  data-mask="9999-9999999" placeholder="XXXX-XXXXXXX" class="form-control" readonly>
                    </div>

                    <div class="form-group col-md-3 col-sm-12">
                        <label>Semester/Year:</label>
                        {!! Form::select('semester_id', config('constants.semesters_years'), $student['semester_id'], ['id' => 'semester_id', 'class' => 'form-control select2-multiple', 'placeholder' => '--- Semester/Year No ---', 'disabled']) !!}
                    </div>

                    <div class="form-group col-md-3 col-sm-12">
                        <label>Gender:</label>
                        {!! Form::select('gender_id', config('constants.genders'), null, ['id' => 'gender_id', 'class' => 'form-control select2-multiple', 'placeholder' => '--- Select Gender ---', 'disabled']) !!}
                        <span id="gender_id"></span>
                    </div>

                    <div class="form-group col-md-3 col-sm-12">
                        <label>Shift:</label>
                        {!! Form::select('shift_id', config('constants.shifts'), null, ['id' => 'shift_id', 'class' => 'form-control select2-multiple', 'placeholder' => '--- Select Shift ---', 'disabled']) !!}
                            <span id="shift_id"></span>
                    </div>        

                    <div class="form-group col-md-3 col-sm-12">
                        <label>Transport Facility:</label>
                        {!! Form::select('is_transport', config('constants.is_transport'), $student['is_transport'], ['id' => 'is_transport', 'onchange'=>'onTransportSelect()','class' => 'form-control select2', 'placeholder' => '--- Select Transport Status ---', 'disabled']) !!}
                    </div>

                    <div class="form-group col-md-3" id="transport_stop" hidden>
                        <label>Transport Stop:</label>
                        <input name="transport_stop" id="transport_stop"  value="{{ $student['transport_stop'] }}" type="text" placeholder="Add Transport Stop" class="form-control" readonly>
                    </div>

                    <div class="form-group col-md-3">
                        <label>Hostel Facility:</label>
                        {!! Form::select('edit_hostel', config('constants.is_transport'), $student['is_hostel'], ['id' => 'is_hostel', 'class' => 'form-control select2', 'placeholder' => '--- Select Hostel Status ---', 'disabled']) !!}
                    </div>

                    <div class="col-md-3">
                        <label>Occupation/ Organization Name:</label>
                        <textarea class="form-control letter_capitalize" id="student_occupation" name="student_occupation" rows="2" readonly>{{ $student['student_occupation'] }}</textarea>
                    </div>

                    <div class="col-md-3">
                        <label>Workplace Address:</label>
                        <textarea class="form-control letter_capitalize" name="student_work_address" id="student_work_address" rows="2" readonly>{{ $student['student_work_address'] }}</textarea>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- ADDRESS INFORMATION --}}
    <div class="m-b-10">
        <strong>Addresses:</strong>
        <div class="m-t-10 div-border-rad">
            <div class="margin-10">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Town/ City:</label>
                        {!! Form::select('city_id', App\Models\City::orderBy('name')->pluck('name', 'id'), $student['city_id'], ['id' => 'city_id', 'class' => 'form-control select2', 'placeholder' => '----- Select City -----', 'onchange' => 'onCitySelect()', 'disabled']) !!}                            
                    </div>
                    <div class="form-group col-md-3" id="city_other_name" {{ $student['city_id'] == 128 ? '' : 'hidden="true"' }}>
                        <label>Other City Name:</label>
                        <input class="form-control letter_capitalize" name="other_city_name" value= "{{ $student['other_city_name'] }}" onkeypress="return alphabaticOnly(event)" placeholder="Enter Other City Name" type="text" readonly />
                    </div>
                    <div class="form-group col-md-4">
                        <label>Area:</label>
                        <input class="form-control letter_capitalize item-required" value= "{{ $student['area'] }}" errorLabel="Area" id="area" name="area" placeholder="Add Area" type="text" readonly>
                        </input>
                    </div>
                    <div class="col-md-6">
                        <label>Present Address:</label>
                        <textarea type="text"
                               class="form-control item-required letter_capitalize" errorLabel="Present Address"
                               name="present_address" id="present_address"
                               {{-- onkeypress="return alphabaticOnly(event)" --}}
                               placeholder="Enter Present Address" readonly>{{ $student['present_address'] }}</textarea>
                        <span id="present_address_message"></span>
                    </div>
                    <div class="col-md-6">
                        <label>Permanent Address:</label>
                        <textarea type="text"
                               class="form-control letter_capitalize"
                               name="permanent_address" id="permanent_address" 
                               {{-- onkeypress="return alphabaticOnly(event)" --}}
                               placeholder="Enter Permanent Address" readonly>{{ $student['permanent_address'] }}</textarea>
                        <span id="permanent_address_message"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- FATHER INFORMATION --}}
    <div class="m-b-10">
        <strong>Father Details:</strong>
        <div class="m-t-10 div-border-rad">
            <div class="margin-10">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Father Name:</label>
                        <input type="text" class="form-control" name="father_name" id="father_name" value="{{ $student['father_name'] }}" placeholder="Enter Student Name" readonly/>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Father CNIC:</label>
                        <input name="father_cnic_no" id="father_cnic_no" value="{{ $student['father_cnic_no'] }}" type="text" placeholder="XXXXX-XXXXXXX-X" data-mask="99999-9999999-9" class="form-control" readonly>
                    </div>  

                    <div class="col-md-6">
                        <label>Occupation/ Organization Name:</label>
                        <textarea class="form-control letter_capitalize" id="father_occupation" name="father_occupation" rows="2" readonly>{{ $student['father_occupation'] }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label>Workplace Address:</label>
                        <textarea class="form-control letter_capitalize" id="father_work_address" name="father_work_address" rows="2" readonly>{{ $student['father_work_address'] }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- GUARDING DETAILS --}}
    <div class="m-b-10">
        <strong>Gaurdian Detail:</strong>
        <div class="m-t-10 div-border-rad">
            <div class="margin-10">
                <div class="form-row">
                    <div class="col-md-3">
                        <label>Gaurdian Name:</label>
                        <input type="text" class="form-control" value="{{ $student['gaurdian_name'] }}" name="gaurdian_name" id="gaurdian_name" placeholder="Enter Gaurdian Name" readonly/>
                    </div>
                    
                    <div class="col-md-3">
                        <label>Gaurdian Cell No:</label>
                        <input name="gaurdian_cell_no" id="gaurdian_cell_no" value="{{ $student['gaurdian_cell_no'] }}" type="text"  data-mask="9999-9999999" placeholder="XXXX-XXXXXXX" class="form-control" readonly>
                    </div>
                    
                    <div class="col-md-3">
                        <label>Gaurdian CNIC:</label>
                        <input name="guardian_cnic" id="guardian_cnic" type="text" value="{{ $student['guardian_cnic'] }}" placeholder="XXXXX-XXXXXXX-X" data-mask="99999-9999999-9" class="form-control" errorLabel="Gaurdian CNIC" readonly/>
                    </div>

                    <div class="col-md-3">
                        <label>Gaurdian Relationship:</label>
                        <input type="text" class="form-control" value="{{ $student['gaurdian_relationship'] }}" name="gaurdian_relationship" id="gaurdian_relationship" placeholder="Enter Gaurdian Relationship" readonly/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- CONTACT INFORMATION --}}
    <div class=" m-b-10">
        <strong>Contact Information:</strong>
        <div class="m-t-20 div-border">
            <div class="margin-10">
                <table class="table table-bordered" id="contact_table_body">
                    <thead>
                        <tr>
                            <th width="35%" class="text-center">Contact No</th>
                            <th width="35%" class="text-center">Relationship</th>
                            <th width="35%" class="text-center">Other Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contactInfos as $key => $contactInfo)
                        <tr>
                            <td>
                                <input name="contact_nos[]" id='contact_no_{{ $key }}' type='text' placeholder='XXXX-XXXXXXX' data-mask='9999-9999999' class='form-control item-required' errorLabel='Contact No. ( Row {{ $key }} )' value="{{ $contactInfo->contact_no }}" readonly>
                            </td>
                            <td>
                                {!! Form::select('contact_info_types[]', config('constants.contact_types'), $contactInfo->contact_type_id, [
                                    'class'      => "form-control item-required", 
                                    'errorLabel' => "Contact Type ( Row {{ $key }} )", 
                                    'onchange'   => "onContactRelationshipSelect({{ $key }})",
                                    "id"         => "contact_type_{{ $key }}",
                                    'disabled'
                                ]) !!}
                            </td>
                            <td>
                                <input name="contact_other_names[]" id='other_name_{{ $key }}' type='text' class='form-control' errorLabel='Other Name ( Row {{ $key }} )' value="{{ $contactInfo->contact_type_other_name }}" readonly>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- REGISTRATION STATUS --}}
    <div class="m-b-10">
        <strong>Registration Status</strong>
        <div class="m-t-10 div-border-rad">
            <div class="margin-10">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            @if ($student['is_end_of_reg'] == true)
                                <input type="checkbox" id="is_end_of_reg" name="is_end_of_reg"  onclick="show('reason')" checked disabled>
                            @else
                                <input type="checkbox" id="is_end_of_reg" name="is_end_of_reg"  onclick="show('reason')" disabled>
                            @endif     
                            <label class="form-check-label">End of Registration</label>
                            <div id="reason" style="display:none;">
                                <div class="form-group">
                                    <label>Reason:</label>
                                    {!! Form::select('reason_end_of_reg_id', config('constants.drop_statuses'), $student['reason_end_of_reg_id'], ['id' => 'reason_end_of_reg_id', 'class' => 'form-control', 'placeholder' => '--- Select Reason ---', 'disabled']) !!}
                                </div>
                                <div class="form-group">
                                    <label>Remarks:</label>
                                    <textarea type="text" class="form-control" name="remark_end_of_reg" id="reason" placeholder="Enter Reason..." readonly>
                                        {{ $student['remark_end_of_reg'] }}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="m-b-10" hidden="hidden">
        <strong>Is Worker:</strong>
        <div class="m-t-10 div-border-rad">
            <div class="margin-10">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2">
                        {!! Form::select('student_category_id', config('constants.student_categories'), null, ['id' => 'student_category_id', 'onchange' => 'onWorkerSelect()', 'class' => 'form-control select2-multiple', 'placeholder' => '------ Select ------', 'disabled']) !!}
                        </div>
                    </div>
                    <div class="row" id="worker_details">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
