<form method="post" action="{{url('/')}}/enquiries/{{$enquiry->id}}">
	{{method_field('PATCH')}}
	@csrf
	{{-- BASIC INFORMATION --}}
	<div class="row">
		<div class="form-group col-md-2" id="session_div">
			{!! Form::label('session', 'Session:') !!}<span style="color: red">*</span>
			{{ Form::select('session_id', \Auth::user()->userAllowedSessions()->get()->pluck('session_name', 'session_id'), \Auth::user()->userAllowedSessions()->count()>0?Illuminate\Support\Facades\Session::get('selected_session_id'):null, ['class' => 'form-control select2 item-required', 'id' => 'session_id', 'placeholder' => '--- Select Session ---', 'onchange' => 'getCoursesBySession()',  'errorLabel' => 'Session']) }}
		</div>
		<input type="hidden" name="id" id="enquiry_id" value="{{$enquiry->id}}">
		<div class="form-group col-md-3">
			{!! Form::label('enquiry by', 'Enquiry By:') !!}<span style="color: red">*</span>
			<select class="form-control select2" id="user_id" name="user_id">
				<option>-------- Select CSO --------</option>
				@foreach($users as $user)
				<option {{$enquiry->user_id == $user->id ? 'selected' : ''}} value="{{$user->id}}">
					{{$user->name}}
				</option>
				@endforeach
			</select>
		</div>
		<div class="form-group col-md-2">
			{!! Form::label('enquiry_type', 'Enquiry Type:') !!}<span style="color: red">*</span>
			{!! Form::select('enquiry_type', config('constants.enquiry_types'), $enquiry->enquiry_type, ['id' => 'enquiry_type', 'class' => 'form-control select2', 'placeholder' => '--- Select Type ---']) !!}
		</div>
		<div class="form-group col-md-2">
			<label>Enquiry Category<span style="color: red">*</span></label>
			{!! Form::select('student_category_id', config('constants.student_categories'), $enquiry->student_category_id, ['id' => 'student_category_id', 'class' => 'form-control select2', 'placeholder' => '------ Select ------', 'disabled' => true]) !!}
		</div>
		<div class="form-group col-md-3">
			<label>Enquiry Date<span style="color: red">*</span></label>
			<input class="form-control" name="enquiry_date" id="enquiry_date" value="{{$enquiry->enquiry_date}}" required type="date"/>
		</div>
	</div>
	{{-- STUDENt INFORMATION --}}
	<div class="row">
		<div class="col-md-12 m-b-10">
			<strong>Student's Information:</strong>
			<div class="m-t-10 div-border">
				<div class="margin-10">
					<div class="form-row">
						<div class="form-group col-md-3">
							<label>Name:<span style="color: red">*</span></label>
							<input class="form-control letter_capitalize" data-parsley-type="name" id="name" placeholder="Enter Name" required="" name="name" type="text" value="{{$enquiry->name}}" />
							<span id="student_name_msg" hidden="hidden" style="color: red">Student Name Required</span>
						</div>
						<div class="form-group col-md-3">
							<label>CNIC:</label>
							<input class="form-control" name="student_cnic_no" id="student_cnic_no" value="{{$enquiry->student_cnic_no}}" placeholder="Enter Student Cnic" required type="text"/>
						</div>
						<div class="form-group col-md-3">
							<label>D.O.B:</label>
							<input class="form-control" value="{{$enquiry->dob}}" name="dob" id="dob" required type="date"/>
						</div>
						<div class="form-group col-md-3">
							<label>E-mail Address:</label>
							<input class="form-control" name="email" value="{{$enquiry->email}}" placeholder="Enter Student Email" id="email" type="email"/>
						</div>
						<div class="form-group col-md-3">
							<label>Father's Name:<span style="color: red">*</span></label>
							<input class="form-control letter_capitalize" name="father_name" id="father_name" placeholder="Enter Father's Name" value="{{$enquiry->father_name}}" required type="text"/>
							<span id="father_name_msg" hidden="hidden"  style="color: red">Father Name Required</span>
						</div>
						<div class="form-group col-md-3">
							<label>Father's CNIC:</label>
							<input class="form-control" value="{{$enquiry->father_cnic_no}}" name="father_cnic_no" id="father_cnic_no" placeholder="Enter Father's Cnic" required type="text"/>
						</div>
						<div class="form-group col-md-3">
							<label>Shift:<span style="color: red">*</span></label>
							{!! Form::select('shift_id', config('constants.shifts'), $enquiry->shift_id, ['id' => 'shift_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Shift ---']) !!}
							<span id="shift_msg" hidden="hidden"  style="color: red">Shift Required</span>
						</div>
						<div class="form-group col-md-3">
							<label>Gender:<span style="color: red">*</span></label>
							{!! Form::select('gender_id', config('constants.genders'), $enquiry->gender_id, ['id' => 'gender_id', 'class' => 'form-control select2 item-required', 'placeholder' => '--- Select Gender ---',  'errorLabel' => 'Gender']) !!}
							<span id="gender_msg" hidden="hidden"  style="color: red">Gender Required</span>
						</div>
						<div class="form-group col-md-3">
							<label>Town / City:</label>
							{!! Form::select('city_id', $cities, $enquiry->city_id, ['id' => 'city_id', 'class' => 'form-control select2', 'placeholder' => '----- Select City -----', 'onchange' => 'onCitySelect()']) !!}
						</div>
						<div class="form-group col-md-3" id="city_other_name" {{ $enquiry->city_id == 128 ? '' : 'hidden="true"'}}>
							<label>Other City Name:</label>
							<input class="form-control letter_capitalize" onkeypress="return alphabaticOnly(event)" data-parsley-type="other_city_name" id="other_city_name" placeholder="Enter Other City Name" required type="text" value="{{ $enquiry->other_city_name }}"/>
						</div>
						<div class="form-group col-md-3">
							<label>Area:<span style="color: red">*</span></label>
							<input class="form-control letter_capitalize item-required" errorLabel="Area" value="{{$enquiry->area}}" id="area" name="area" placeholder="Add Area" type="text">
							<span id="area_msg" hidden="hidden"  style="color: red">Area Required</span>
						</div>
						<div class="form-group col-md-3">
							<label>Present Address:<span style="color: red">*</span></label>
							<input class="form-control letter_capitalize" value="{{$enquiry->present_address}}" id="present_address" name="present_address" placeholder="Present Address" type="text">
							<span id="present_address_msg" hidden="hidden"  style="color: red">Address Required</span>
						</div>
						<div class="form-group col-md-3">
							<label>Permanent Address:</label>
							<input class="form-control letter_capitalize" value="{{$enquiry->permanent_address}}" id="permanent_address" name="permanent_address" placeholder="Permanent Address" type="text">
						</div>
						<div class="form-group col-md-3">
							<label>Fathers Occupation:</label>
							<textarea class="form-control letter_capitalize" name="father_occupation" id="father_occupation" placeholder="Enter Father's Occupation" rows="2" required>{{$enquiry->father_occupation}}</textarea>
						</div>
						<div class="form-group col-md-3">
							<label>Transport Facility:<span style="color: red">*</span></label>
							{!! Form::select('is_transport', config('constants.is_transport'), $enquiry->is_transport, ['id' => 'is_transport', 'onchange'=>'onTransportSelect()','class' => 'form-control select2 item-required', 'placeholder' => '--- Select Transport Status ---']) !!}
						</div>
						<div class="form-group col-md-3" id='transport_route'>
							@if($enquiry->is_transport == '0')
								<label>Transport Stop:<span style='color: red'>*</span></label>
								<input type='text' name='transport_stop' value="{{$enquiry->transport_stop}}" errorLabel='Transport Stop' id='transport_stop' class='form-control item-required' placeholder='Enter Bus Stop'>
							@endif
						</div>
						<div class="col-md-3 form-group">
							<div class="custom-control custom-checkbox margin-top-30">
								<input type="checkbox" class="custom-control-input" {{$enquiry->is_domicile == 1 ? 'checked' : '' }} name="is_domicile" id="is_domicile">
								<label class="custom-control-label" for="is_domicile">Domicile</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	{{-- FACTORY INFORMATION --}}
	<div class="row">
		<div class="col-md-12 m-b-10" id="worker_div">
		@if($enquiry->student_category_id == '0')
			<strong>Factory Worker's Information:</strong>
			<div class="div-border padding-10 m-t-10">
				<div class="row">
					<div class="col-2">
						<label>Prospects:</label>
						{!! Form::select('prospects_id', 
							['Yes', 'No'], 
							($enquiry->parent_id == null && App\Models\Enquiry::where('parent_id', $enquiry->id)->count()>0)?0:($enquiry->parent_id != null?0:1) ,
							[
								'id' => 'prospects_id', 
								'class' => 'form-control select2', 
								'placeholder' => '--- Select Prospect Status ---', 
								'errorLabel' => 'Prospects', 
								'disabled' => true
							]) 
						!!}
					</div>
					<div class="col-10 pull-right">
						<button class="btn btn-dark btn-sm waves-effect waves-light pull-right" onclick="addWorkerSection()" type="button"><i class="fa fa-plus"></i> | Add New</button>
					</div>
				</div>
				<div id="worker_details">
					@foreach ($enquiry->enquiryWorkers as $key => $detail)				
					<div class="m-t-15 div-border padding-10" id="worker_section_{{$key}}">
						<div class="form-row">
							<div class="col-md-3 form-group">
								<label>Factory Name:<span style="color: red">*</span></label>
								<input type="text" name="factory_name" errorlabel="Worker Factory ( Row {{$key}} )" onkeypress="return alphabaticOnly(event)" id="factory_name_{{$key}}" class="form-control letter_capitalize item-required" placeholder="Factory Name" value="{{ $detail->factory_name }}">
								<span id="factory_name_msg_{{$key}}" hidden="hidden" style="color: red">Factory Name Required</span>
							</div>
							<div class="col-md-3 form-group">
								<label>Work Type:<span style="color: red">*</span></label>
								<select name="worker_work_type_id" id="worker_work_type_id_{{$key}}" errorlabel="Work Type ( Row {{$key}} )" class="form-control item-required">
									<option value="">----- Select -----</option>
									<option value="0" {{ $detail->worker_work_type_id == 0 ? 'selected' : '' }}>Permanent/ Regular</option>
									<option value="1" {{ $detail->worker_work_type_id == 1 ? 'selected' : '' }}>Through Contractor</option>
								</select>
							</div>
							<div class="col-md-3 form-group">
								<label>Service Experience:<span style="color: red">*</span></label>
								<div class="input-group mb-3">
									<input type="text" name="experience" onkeypress="return numericOnly(event)" errorlabel="Experience In Years ( Row {{$key}} )" id="worker_experience_in_years_{{$key}}" class="form-control item-required" placeholder="Experience" value="{{ $detail->worker_experience_in_years }}">
									<div class="input-group-append">
										<span class="input-group-text">Years</span>
									</div>
									<input type="text" name="experience" onkeypress="return numericOnly(event)" errorlabel="Experience In Months ( Row {{$key}} )" id="worker_experience_in_months_{{$key}}" class="form-control item-required" placeholder="Experience" onkeyup="validateMonthNumber(0)" value="{{ $detail->worker_experience_in_months }}">
									<div class="input-group-append">
										<span class="input-group-text">Months</span>
									</div>
								</div>
								<span id="experience_msg_{{$key}}" hidden="hidden" style="color: red">Experience Required</span>
							</div>
							<div class="col-md-3 form-group">
								<label>Designation:<span style="color: red">*</span></label>
								<input type="text" name="designation" onkeypress="return alphabaticOnly(event)" errorlabel="Designation ( Row {{$key}} )" id="worker_designation_{{$key}}" class="form-control letter_capitalize item-required" placeholder="Designation" value="{{ $detail->worker_designation }}">
								<span id="designation_msg_{{$key}}" hidden="hidden" style="color: red">Designation Required</span>
							</div>
							<div class="col-md-3 form-group">
								<label>EOBI/ SSC:<span style="color: red">*</span></label>
								<select name="eobi_ssc" id="eobi_ssc_id_{{$key}}" errorlabel="EOBI/ SSC ( Row {{$key}} )" class="form-control item-required">
									<option value="">----- Select -----</option>
									<option value="0" {{ $detail->is_eobi == 0 ? 'selected' : '' }}>Yes</option>
									<option value="1" {{ $detail->is_eobi == 1 ? 'selected' : '' }}>No</option>
								</select>
							</div>
							<div class="col-md-3 form-group">
								<label>Factory Registered:<span style="color: red">*</span></label>
								<select name="is_frc" id="is_factory_registered_{{$key}}" class="form-control item-required" errorlabel="Factory Registered ( Row {{$key}} )">
									<option value="">----- Select -----</option>
									<option value="0" {{ $detail->is_frc == 0 ? 'selected' : '' }}>Yes</option>
									<option value="1" {{ $detail->is_frc == 1 ? 'selected' : '' }}>Not Clear</option>
								</select>
							</div>
							<div class="col-md-3 form-group mt-4 ml-5 element-flex-end">
								<button class="btn btn-danger btn-sm waves-effect waves-light element-flex-end" onclick="workerSectionDelete({{$key}})" type="button">
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
	<div class="row">
		<div class="col-md-12 m-b-10">
			<strong>Contact Information:</strong>
			<button type="button" id="add_contact" name="add_contact" class="btn btn-dark btn-sm waves-effect m-l-5 m-b-10 pull-right"><i class="fa fa-plus"></i> | Add Contact</button>
			<div class="m-t-10 div-border">
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
							@if($enquiry->enquiryContactInfos->count() > 0)
							@foreach($enquiry->enquiryContactInfos as $key => $contact_info)
							<tr>
								<td>
									<input id="contact_no_{{$key}}" value="{{$contact_info->phone_no}}" type="text" placeholder="XXXX-XXXXXXX" data-mask="9999-9999999" class="form-control">
								</td>
								<td>
									<select id="contact_type_{{$key}}" onchange='onContactRelationshipSelect("{{$key}}")' class='form-control item-required' errorLabel='Contact Type ( Row " {{ $key }} " )'>
										@foreach(config('constants.contact_types') as $contact_type_key=> $contact_types)
										<option {{$contact_info->contact_type_id == $contact_type_key ? 'selected' : ''}} value="{{$contact_type_key}}">{{$contact_types}}</option>
										@endforeach
									</select>
								</td>
								<td>
									<input id='other_name_{{ $key }}' type='text' class='form-control' {{ $contact_info->contact_type_id == 6 ? '' : 'disabled' }} errorLabel='Other Name ( Row " .{{ $key }}. " )' value="{{$contact_info->other_name}}">
								</td>
								<td class="text-center">
									<div row_index="{{$key}}" class="deleteRowButton btn btn-danger btn-sm waves-effect"><i class="mdi mdi-delete"></i> | Delete</div>
								</td>
								<input type="hidden" name="contact_row_state_{{$key}}" id="contact_row_state_{{$key}}" value="unchanged"></input>
							</tr>
							@endforeach
							@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	{{-- ACADEMIC INFORMATION --}}
	<div class="row">
		<div class="col-md-12 m-b-10">
			<strong>Academic Information:</strong>
			<div class="m-t-10 div-border">
				<div class="margin-10">
					<div class="form-row">
						<div class="form-group col-md-3">
							<label>Previous Degree:</label>
							{!! Form::select('previous_degree_id', config('constants.previous_degrees'), $enquiry->previous_degree_id, ['id' => 'previous_degree_id','class' => 'form-control select2', 'placeholder' => '--- Select Previous Degree ---', 'onchange' => 'onPreviousDegreeSelect()']) !!}
						</div>
						<div class="form-group col-md-3" id="other_case_div" {{ $enquiry->previous_degree_id == 12 ? '' : 'hidden="true"' }}>
							<label>Degree Name (Other):</label>
							<input class="form-control letter_capitalize" id="degree_name_other" onkeypress="return alphabaticOnly(event)" name="degree_name_other" placeholder="Add Degree Name" type="text" value="{{ $enquiry->degree_name_other }}">
						</div>
						<div class="form-group col-md-3">
							<label>Previous Degree Affiliated Body:</label>
							<input class="form-control letter_capitalize" id="previous_degree_body" name="previous_degree_body" placeholder="Previous Body" type="text" value="{{ $enquiry->previous_degree_body }}">
						</div>
						<div class="form-group col-md-3">
							<label>Passing Year:</label>
							<input class="form-control" id="passing_year" value="{{$enquiry->passing_year}}" name="passing_year" placeholder="Passing Year" required="" type="text">
						</div>
						<div class="form-group col-md-3">
							<label>Marks Obtained:</label>
							<input class="form-control" id="marks_obtained" name="marks_obtained" placeholder="Marks Obtained" onkeyup="calculatePercentage()" value="{{$enquiry->marks_obtained}}" required="" type="number">
						</div>
						<div class="form-group col-md-3">
							<label>Total Marks:</label>
							<input class="form-control" id="total_marks" name="total_marks" onkeyup="calculatePercentage()" value="{{$enquiry->total_marks}}" placeholder="Total Marks" type="number" />
						</div>
						<div class="col-md-3">
							<label>Percentage:</label>
							<div class="input-group mb-3">
		                        <input class="form-control" id="percentage" min="0" max="100" name="percentage" readonly placeholder="Percentage" value="{{$enquiry->percentage}}"  type="number">
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
	<div class="row">
		<div class="m-b-10 col-md-12">
			<strong>Reference:</strong>
			<div class="m-t-10 div-border">
				<div class="margin-10">
					<div class="row">
						<div class="form-group col-md-3">
							{!! Form::label('reference', 'Reference:') !!}
							<input class="form-control letter_capitalize" id="reference_name" name="reference_name" placeholder="Reference" type="text" value="{{ $enquiry->reference_name }}" />
						</div>
						<div class="form-group col-md-3">
							<label>Source of Information:</label>
							{!! Form::select('source_info_id', config('constants.information_sources'), $enquiry->source_info_id, ['id' => 'source_info_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Source ---', 'onchange' => 'onSourceOfInformationSelect()']) !!}
						</div>
						<div class="form-group col-md-3" {{ $enquiry->source_info_id == 17 ? '' : 'hidden="true"' }} id="marketer_name_div">
							{!! Form::label('marketer_name', 'Marketer Name:') !!}
							<input class="form-control letter_capitalize" id="marketer_name" name="marketer_name" placeholder="Enter Marketer Name" type="text" value="{{ $enquiry->marketer_name }}" />
						</div>
						{{--  faculty member --}}
						<div class="form-group col-md-3" {{ $enquiry->source_info_id == 3 ? '' : 'hidden="true"' }} id="faculty_member_name_div">
							{!! Form::label('faculty_member_name', 'Faculty Member Name:') !!}
							<input class="form-control letter_capitalize" id="faculty_member_name" name="faculty_member_name" placeholder="Enter Faculty Member Name" type="text" value="{{ $enquiry->faculty_member_name }}" />
						</div>
						{{-- academy / school name --}}
						<div class="form-group col-md-3" {{ $enquiry->source_info_id == 5 ? '' : 'hidden="true"' }} id="academy_school_name_div">
							{!! Form::label('academy_school_name', 'Academy/ School Name:') !!}
							<input class="form-control letter_capitalize" id="academy_school_name" name="academy_school_name" placeholder="Enter Academy/ School Name" type="text" value="{{ $enquiry->academy_school_name }}" />
						</div>
						<div class="form-group col-md-3" hidden="true" id="social_media_type_id_div">
							<label>Social Media:</label>
							{!! Form::select('social_media_type_id', config('constants.social_media_types'), $enquiry->social_media_type_id, ['id' => 'social_media_type_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Social Media ---', 'onchange' => 'onSocialMediaSelect()']) !!}
						</div>
						<div class="form-group col-md-3" {{ $enquiry->social_media_type_id == 3 ? '' : 'hidden="true"' }} id="other_social_media_name_div">
							{!! Form::label('other_social_media', 'Other (Social Media):') !!}
							<input class="form-control letter_capitalize" id="other_social_media_name" name="other_social_media_name" placeholder="Enter Other Source" type="text" value="{{ $enquiry->other_social_media_name }}" />
						</div>
						<div class="form-group col-md-3" hidden="true" id="ex_student_wing_type_id_div">
							<label>Student's/ Ex-Student's Wing:</label>
							{!! Form::select('ex_student_wing_type_id', App\Models\Wing::pluck('name', 'id'), $enquiry->ex_student_wing_type_id , ['id' => 'ex_student_wing_type_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Wing ---']) !!}
						</div>
						<div class="form-group col-md-3" {{ $enquiry->source_info_id == 19 ? '' : 'hidden="true"' }} id="ex_student_name_div">
							{!! Form::label('ex_student_name', 'Student\''.'s/ Ex-Student\''.'s Name:') !!}
							<input class="form-control letter_capitalize" id="ex_student_name" name="ex_student_name" placeholder="Enter Student/ Ex-Student Name" type="text" value="{{ $enquiry->ex_student_name }}" />
						</div>
						<div class="form-group col-md-3" {{ $enquiry->source_info_id == 20 ? '' : 'hidden="true"' }} id="friend_name_div">
							{!! Form::label('friend_name', 'Friend\''.'s Name:') !!}
							<input class="form-control letter_capitalize" id="friend_name" name="friend_name" placeholder="Enter Friend Name" type="text" value="{{$enquiry->friend_name}}" />
						</div>
						<div class="form-group col-md-3" {{ $enquiry->source_info_id == 21 ? '' : 'hidden="true"' }} id="other_source_of_info_div">
							{!! Form::label('other_source_of_info', 'Other (Source of Information):') !!}
							<input class="form-control letter_capitalize" id="other_source_of_info" name="other_source_of_info" placeholder="Enter Other (Source of Information)" value="{{ $enquiry->other_source_of_info }}" type="text"/>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	{{-- ACTION BUTTONS --}}
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<strong>Remarks:<span style="color: red">*</span></strong>
				<textarea class="form-control m-t-10" id="remarks" name="remarks" required="" rows="5">{{$enquiry->remarks}}
					</textarea>
				<span id="remarks_msg" hidden="hidden"  style="color: red">Remarks Required</span>
			</div>
			<input type="hidden" id="global_session_id" value="{{ session()->get('selected_session_id') }}">
			<div class="form-group">
				<input type="hidden" id="enquiry_id" value="{{ $enquiry->id }}">
				<button class="btn btn-primary waves-effect waves-light" type="button" onclick="checkDuplicateStudentCellNo()">
					Update Changes
				</button>
				<button class="btn btn-secondary waves-effect m-l-5" type="reset">Cancel</button>
			</div>
		</div>
	</div>
</form>
