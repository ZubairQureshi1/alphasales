@if ($is_edit_mode == 'false')
	<div id="sessionDetailRow{{$row_count}}">
		<div class="row p-t-10">
			<div class="col-md-10">
				<u class="text-danger"><b>Note:</b> Any empty field will be considered as unlimited. Degree having "0" no. of seats will not be considered.</u>
			</div>
			<div class="col-md-2">
				<button type="button" class="btn btn-sm btn-danger pull-right" onclick="deleteSessionDetail({{$row_count}})"><span class="fa fa-trash"></span></button>
			</div>
		</div>
		<div class="padding-10 margin-top-10 div-border-rad">
			<div class="row">
				<div class="col-md-2 form-group">
					<label>Wings</label>
					{{ Form::select('wing_ids[]', App\Models\Wing::pluck('name', 'id'), null, ['class' => 'form-control select2', 'id' => 'wingId'.$row_count, 'onchange' => 'getWingCampuses('.$row_count.')', 'placeholder' => '--- Select Wing ---', 'required']) }}
				</div>
				<div class="col-md-2 form-group">
					<label>Affiliated Body</label>
					<div id="course_affiliated_body_div{{$row_count}}">
						{{ Form::select('affiliated_body_ids[]', App\Models\AffiliatedBody::pluck('name', 'id'), null, ['class' => 'form-control select2', 'id' => 'affiliated_body'.$row_count, 'onchange' => 'clearSearchedCourse('.$row_count.')', 'placeholder' => '--- Select Affiliated Body ---', 'required']) }}
					</div>
				</div>
				<div class="col-md-2 form-group">
					<label>Degree</label>
					<div>
						<input type="text" name="course_names[]" autocomplete="off" id="courseName{{$row_count}}" onkeyup="autoCompleteCourseName({{$row_count}})" required="required" class="form-control course_name">
						<div id="courseNameSuggestions{{$row_count}}"></div>
						<input type="hidden" name="course_ids[]" id="courseId{{$row_count}}">
					</div>
				</div>
				<div class="col-md-2 form-group">
					<label>Academic Term</label>
					<div>
						<select name="academic_term_ids[]" class="form-control select2" required onchange="createRoadMap({{$row_count}})" id="academicTerm{{$row_count}}">
							<option selected="" value="">--- Select Academic Term ---</option>
							@foreach(config('constants.academic_terms') as $key=> $academic_term)
							<option value="{{$key}}">{{$academic_term}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-md-2 form-group">
					<label>Degree Code <small class="text-danger">Only for new degree</small></label>
					<div>
						<input type="text" name="course_codes[]" id="courseCode{{$row_count}}" class="form-control">
					</div>
				</div>
				<div class="col-md-2 form-group">
					<label>Session Start Date</label>
					<div>
						<input name="session_start_dates[]" id="sessionStartDate{{$row_count}}" onchange="checkBackDate({{$row_count}}), createRoadMap({{$row_count}})" required type="month" data-date-format="YYYY-MM-DD" class="form-control">
					</div>
				</div>
				<div class="col-md-2 form-group">
					<label>Session End Date</label>
					<div>
						<input name="session_end_dates[]" id="sessionEndDate{{$row_count}}" onchange="checkBackDate({{$row_count}}), createRoadMap({{$row_count}})" required type="month" data-date-format="YYYY-MM-DD" class="form-control">
					</div>
				</div>
				<div class="col-md-2 form-group">
					<label>Tuition Fee</label>
					<div>
						<input type="number" class="form-control text-right" min="0" required max="999999" name="tuition_fees[]" placeholder=""/>
					</div>
				</div>
				<!--<div class="col-md-2 form-group">
					<label>Min Installments</label>
					<div>
						<input type="number" class="form-control text-right" name="min_installments[]" placeholder=""/>
					</div>
				</div>-->
				<div class="col-md-2 form-group">
					<label>CFE Admission Fee</label>
					<div>
						<input type="number" class="form-control text-right" id="cfe_admission_fee-{{$row_count}}" onchange="calculateAdmissionRegistrationFee({{$row_count}})" min="0" max="99999" required value="0" name="cfe_admission_fees[]" placeholder=""/>
					</div>
				</div>
				<div class="col-md-2 form-group">
					<label>Marketer Incentive</label>
					<div>
						<input type="number" class="form-control text-right" id="marketer_incentive-{{$row_count}}" onchange="calculateAdmissionRegistrationFee({{$row_count}})" min="0" max="99999" required value="0" name="marketer_incentives[]" placeholder=""/>
					</div>
				</div>
				<div class="col-md-2 form-group">
					<label>Registration Fee</label>
					<div>
						<input type="number" class="form-control text-right" id="registration_fee-{{$row_count}}" onchange="calculateAdmissionRegistrationFee({{$row_count}})" min="0" max="9999999" required value="0" name="registration_fees[]" placeholder=""/>
					</div>
				</div>
				<div class="col-md-2 form-group">
					<label>Admission/Registration Fee</label>
					<div>
						<input type="number" readonly="" class="form-control text-right" id="admission_registration_fee-{{$row_count}}" min="0" max="99999" required value="0" name="admission_registration_fees[]" placeholder=""/>
					</div>
				</div>
				<div class="col-md-2 form-group">
					<label>Transport Charges</label>
					<div>
						<input type="number" class="form-control text-right" min="0" max="99999" value="0" required name="transport_charges[]" placeholder=""/>
					</div>
				</div>
				<div class="col-md-2 form-group">
					<label>Miscellaneous</label>
					<div>
						<input type="number" class="form-control text-right" min="0" max="99999" value="0" required name="miscellaneous[]" placeholder=""/>
					</div>
				</div>
				<div class="col-md-2 form-group">
					<label>Exam Fee</label>
					<div>
						<input type="number" class="form-control text-right" min="0" max="99999" value="0" required name="exam_fees[]" placeholder=""/>
					</div>
				</div>
				<div class="col-md-2 form-group">
					<label>Exam Stationary</label>
					<div>
						<input type="number" class="form-control text-right" min="0" max="99999" value="0" required name="exam_stationeries[]" placeholder=""/>
					</div>
				</div>
				<!-- <div class="col-md-2 form-group">
					<label>CFE Publication</label>
					<div>
						<input type="number" class="form-control text-right" min="0" max="99999" value="0" required name="cfe_publications[]" placeholder=""/>
					</div>
				</div>
				<div class="col-md-2 form-group">
					<label>Student Card Fee</label>
					<div>
						<input type="number" class="form-control text-right" min="0" max="99999" value="0" required name="student_card_fees[]" placeholder=""/>
					</div>
				</div>
				<div class="col-md-2 form-group">
					<label>Trasnport Card Fee</label>
					<div>
						<input type="number" class="form-control text-right" min="0" max="99999" value="0" required name="trasnport_card_fees[]" placeholder=""/>
					</div>
				</div>
				<div class="col-md-2 form-group">
					<label>Uniform Charges</label>
					<div>
						<input type="number" class="form-control text-right" min="0" max="99999" value="0" required name="uniform_charges[]" placeholder=""/>
					</div>
				</div>
				<div class="col-md-2 form-group">
					<label>Library Card Fee</label>
					<div>
						<input type="number" class="form-control text-right" min="0" max="99999" value="0" required name="library_card_fees[]" placeholder=""/>
					</div>
				</div> -->
			</div>
			<input type="hidden" class="form-control text-right" name="row_counts[]" value="{{ $row_count }}" />
			<div id="campusDetails{{$row_count}}">
			</div>
		</div>
		<div id="roadMap{{$row_count}}"></div>
	</div>
@else
<div id="sessionDetailRow{{$row_count}}">
	<form id="session_form_{{ $row_count }}" method="POST" action="{{ route('sessions.update', isset($session)?$session->id:0)}}">
	    @csrf
		<div class="row p-t-10">
			<div class="col-md-10">
				<u class="text-danger"><b>Note:</b> Any empty field will be considered as unlimited. Degree having "0" no. of seats will not be considered.</u>
			</div>
			<div class="col-md-2">
				<button type="button" class="btn btn-sm btn-danger pull-right" onclick="deleteSessionDetail({{$row_count}})"><span class="fa fa-trash"></span></button>
			</div>
		</div>
		<div class="padding-10 margin-top-10 div-border-rad">
			<div class="row">
				<div class="col-md-2 form-group">
					<label>Wings</label>
					{{ Form::select('wing_id', App\Models\Wing::pluck('name', 'id'), null, ['class' => 'form-control select2', 'id' => 'wingId'.$row_count, 'onchange' => 'getWingCampuses('.$row_count.')', 'placeholder' => '--- Select Wing ---', 'required']) }}
				</div>
				<div class="col-md-2 form-group">
					<label>Affiliated Body</label>
					<div id="course_affiliated_body_div{{$row_count}}">
						{{ Form::select('affiliated_body_id', App\Models\AffiliatedBody::pluck('name', 'id'), null, ['class' => 'form-control select2', 'id' => 'affiliated_body'.$row_count, 'onchange' => 'clearSearchedCourse('.$row_count.')', 'placeholder' => '--- Select Affiliated Body ---', 'required']) }}
					</div>
				</div>
				<div class="col-md-2 form-group">
					<label>Degree</label>
					<div>
						<input type="text" name="course_name" autocomplete="off" id="courseName{{$row_count}}" onkeyup="autoCompleteCourseName({{$row_count}})" required="required" class="form-control course_name">
						<div id="courseNameSuggestions{{$row_count}}"></div>
						<input type="hidden" name="course_id" id="courseId{{$row_count}}">
					</div>
				</div>
				<div class="col-md-2 form-group">
					<label>Academic Term</label>
					<div>
						<select name="academic_term_id" class="form-control select2" required onchange="createRoadMap({{$row_count}}, true)" id="academicTerm{{$row_count}}">
							<option selected="" value="">--- Select Academic Term ---</option>
							@foreach(config('constants.academic_terms') as $key=> $academic_term)
							<option value="{{$key}}">{{$academic_term}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-md-2 form-group">
					<label>Degree Code <small class="text-danger">Only for new degree</small></label>
					<div>
						<input type="text" name="course_code" id="courseCode{{$row_count}}" class="form-control">
					</div>
				</div>
				<div class="col-md-2 form-group">
					<label>Session Start Date</label>
					<div>
						<input name="session_start_date" id="sessionStartDate{{$row_count}}" onchange="checkBackDate({{$row_count}}), createRoadMap({{$row_count}}, true)" required type="month" data-date-format="YYYY-MM-DD" class="form-control">
					</div>
				</div>
				<div class="col-md-2 form-group">
					<label>Session End Date</label>
					<div>
						<input name="session_end_date" id="sessionEndDate{{$row_count}}" onchange="checkBackDate({{$row_count}}), createRoadMap({{$row_count}}, true)" required type="month" data-date-format="YYYY-MM-DD" class="form-control">
					</div>
				</div>
				<div class="col-md-2 form-group">
					<label>Tuition Fee</label>
					<div>
						<input type="number" class="form-control text-right" min="0" required max="999999" name="tuition_fee" placeholder=""/>
					</div>
				</div>
				<!--<div class="col-md-2 form-group">
					<label>Min Installments</label>
					<div>
						<input type="number" class="form-control text-right" name="min_installment" placeholder=""/>
					</div>
				</div>-->
				<div class="col-md-2 form-group">
					<label>CFE Admission Fee</label>
					<div>
						<input type="number" class="form-control text-right" id="cfe_admission_fee-{{$row_count}}" onchange="calculateAdmissionRegistrationFee({{$row_count}})" min="0" max="99999" required value="0" name="cfe_admission_fee" placeholder=""/>
					</div>
				</div>
				<div class="col-md-2 form-group">
					<label>Marketer Incentive</label>
					<div>
						<input type="number" class="form-control text-right" id="marketer_incentive-{{$row_count}}" onchange="calculateAdmissionRegistrationFee({{$row_count}})" min="0" max="99999" required value="0" name="marketer_incentive" placeholder=""/>
					</div>
				</div>
				<div class="col-md-2 form-group">
					<label>Registration Fee</label>
					<div>
						<input type="number" class="form-control text-right" id="registration_fee-{{$row_count}}" onchange="calculateAdmissionRegistrationFee({{$row_count}})" min="0" max="9999999" required value="0" name="registration_fee" placeholder=""/>
					</div>
				</div>
				<div class="col-md-2 form-group">
					<label>Admission/Registration Fee</label>
					<div>
						<input type="number" readonly="" class="form-control text-right" id="admission_registration_fee-{{$row_count}}" min="0" max="99999" required value="0" name="admission_registration_fee" placeholder=""/>
					</div>
				</div>
				<div class="col-md-2 form-group">
					<label>Transport Charges</label>
					<div>
						<input type="number" class="form-control text-right" min="0" max="99999" value="0" required name="transport_charge" placeholder=""/>
					</div>
				</div>
				<div class="col-md-2 form-group">
					<label>Miscellaneous</label>
					<div>
						<input type="number" class="form-control text-right" min="0" max="99999" value="0" required name="miscellaneou" placeholder=""/>
					</div>
				</div>
				<div class="col-md-2 form-group">
					<label>Exam Fee</label>
					<div>
						<input type="number" class="form-control text-right" min="0" max="99999" value="0" required name="exam_fee" placeholder=""/>
					</div>
				</div>
				<div class="col-md-2 form-group">
					<label>Exam Stationary</label>
					<div>
						<input type="number" class="form-control text-right" min="0" max="99999" value="0" required name="exam_stationerie" placeholder=""/>
					</div>
				</div>
				<!-- <div class="col-md-2 form-group">
					<label>CFE Publication</label>
					<div>
						<input type="number" class="form-control text-right" min="0" max="99999" value="0" required name="cfe_publication" placeholder=""/>
					</div>
				</div>
				<div class="col-md-2 form-group">
					<label>Student Card Fee</label>
					<div>
						<input type="number" class="form-control text-right" min="0" max="99999" value="0" required name="student_card_fee" placeholder=""/>
					</div>
				</div>
				<div class="col-md-2 form-group">
					<label>Trasnport Card Fee</label>
					<div>
						<input type="number" class="form-control text-right" min="0" max="99999" value="0" required name="trasnport_card_fee" placeholder=""/>
					</div>
				</div>
				<div class="col-md-2 form-group">
					<label>Uniform Charges</label>
					<div>
						<input type="number" class="form-control text-right" min="0" max="99999" value="0" required name="uniform_charge" placeholder=""/>
					</div>
				</div>
				<div class="col-md-2 form-group">
					<label>Library Card Fee</label>
					<div>
						<input type="number" class="form-control text-right" min="0" max="99999" value="0" required name="library_card_fee" placeholder=""/>
					</div>
				</div> -->
			</div>
			<input type="hidden" class="form-control text-right" name="row_count" value="{{ $row_count }}" />
			<div id="campusDetails{{$row_count}}">
			</div>
		</div>
		<div id="roadMap{{$row_count}}"></div>
		
		<div class="modal-footer">
	        <button type="button" class="btn btn-primary" onclick="updateDegreeInSession(event, {{ $row_count }})" id="session_submit">Save</button>
	        <a class="btn btn-secondary" href="{{ route('sessions.index') }}">Close</a>
	    </div>
	</form>
</div>

@endif

<script type="text/javascript">
	
	$('.select2').select2();
	var count = {!! json_encode($row_count) !!};
</script>