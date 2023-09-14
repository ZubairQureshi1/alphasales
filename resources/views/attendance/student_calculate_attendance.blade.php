<div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade calculate_attendance" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title mt-0">Calculate <strong>Attendance</strong></h5>
				<button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
			</div>
			<div class="modal-body">
				<form action="{{ route('attendance.calculateStudentAttendance') }}" id="calculateStudentAttendance" method="POST">
					@csrf
					<div class="form-row">
						<div class="form-group col-md-4">
							<label>Academic Wing:<span style="color: red">*</span></label>
							@if(count($wings)!=0)
							{!! Form::select('wing_id', $wings, null, ['id' => 'calculation_wing_id', 'onChange' => 'onWingSelect()', 'class' => 'form-control select2 item-required', 'errorLabel' => 'Academic Wing', 'placeholder' => '--- Select Wing ---']) !!}
							@else
							@include('includes/not_found')
							@endif
						</div>
						{{-- COURSE --}}
						<div class="form-group col-md-4">
							<label>Course:<span style="color: red">*</span></label>
							<select onchange="onCourseSelect();" id="calculation_course_id" name="course_id" class="form-control select2 item-required" data-placeholder="---Select Course---" errorLabel="Course">
							</select>
						</div>
						{{-- AFFILIATED BODY --}}
						<div id="affiliated_body_id_div" class="form-group col-md-4">
							<label>Affiliated Body:<span style="color: red">*</span></label>
							<select id="calculation_affiliated_body_id" class="form-control select2 item-required" name="affiliated_body_id" onchange="onAffiliatedBodySelect()" data-placeholder="--- Select Affiliated Body ---" errorLabel="Affiliated Body">
							</select>
						</div>
						{{-- Annaul / Year --}}
						<div class="form-group col-md-4">
							<label>Annaul / Year:<span style="color: red">*</span></label>
							<select id="calculation_term_id" name="term_id" class="form-control select2 item-required" data-placeholder="--- Select Term  / Year---" errorLabel="Academic Term / Year">
							</select>
						</div>
						{{-- SHIFT --}}
						<div id="shift_id_div" class="form-group col-md-4">
							<label>Shift:<span style="color: red">*</span></label>
							{{ Form::select('shift_id', config('constants.shifts'), null ,[ 'id' => 'calculation_shift_id', 'class' => 'form-control select2 item-required', 'placeholder' => '--- Select Shift ---', 'errorLabel' => 'Shift', 'onchange' => 'onShiftSelect()']) }}
						</div>
						{{-- section --}}
						<div id="shift_id_div" class="form-group col-md-4">
							<label>Section:<span style="color: red">*</span></label>
							<select id="calculation_section_id" name="section_id" class="form-control select2 item-required" data-placeholder="--- Select Section ---" errorLabel="Section">
							</select>
						</div>
						{{-- dates --}}
						<div id="shift_id_div" class="form-group col-6">
							<label>From Date:<span style="color: red">*</span></label>
							<input type="date" class="form-control item-required" id="calculation_from_date" name="start_date" value="{{ date('Y-m-d') }}">
						</div>

						<div id="shift_id_div" class="form-group col-6">
							<label>To Date:<span style="color: red">*</span></label>
							<input type="date" class="form-control item-required" id="calculation_from_date" name="end_date" value="{{ date('Y-m-d') }}">
						</div>
					</div>
					<div class="mt-3">
						<button class="btn btn-light active btn-sm" data-dismiss="modal" type="button"><i class="fa fa-remove fa-fw text-danger"></i> Cancel</button>
						<button class="btn btn-success btn-sm" type="button" onclick="validateForm()"><i class="fa fa-cloud-upload fa-fw"></i> | Calculate Attendance</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
