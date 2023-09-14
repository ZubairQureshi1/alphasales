<div class="card">
	{{-- CARD HEADER --}}
	<div class="card-header clearfix">
		<div class="float-left">
			<h5 class="card-title mb-1">Update Student Course</h5>
			{{-- <span class="text-muted">
				<i class="fa fa-clock-o fa-fw"></i> Created: {{ $studentRegistration->created_at->format('F dS Y') }}
			</span> --}}
		</div>
{{-- 		<div class="float-right mt-3">
			<button class="btn btn-sm btn-outline-dark pull-right" type="button" onclick="editRegistration()">
				<i class="mdi mdi-pencil"></i> | Edit Student Registration
			</button>
		</div> --}}
	</div>
	{{-- CARD BODY --}}
	<div class="card-body">
		<form id="course_change_form" action="{{ route('students.updateStudentCourse', $student['id']) }}" method="POST">
			@csrf
			@method('patch')
			<div class="form-group">
				<div class="row" id="course_div">
					<div class="col-3" id="student_session_div">
						<strong>Session</strong>
						{{ Form::select('session_id', App\Models\Session::pluck('session_name', 'id'), $student['session_id'], ['class' => 'form-control select2', 'id' => 'student_session_id', 'placeholder' => '--- Select Session ---','disabled']) }}
					</div>
					<div class="col-3" id="student_session_div">
						<strong>Campus</strong>
						{{ Form::select('organization_campus_id', \Auth::user()->campusDetails()->get()->pluck('organization_campus_name', 'organization_campus_id'), $student['organization_campus_id'], ['class' => 'form-control select2', 'id' => 'organization_campus_id', 'placeholder' => '--- Select Campus ---', 'onchange' => 'getStudentCoursesBySession()']) }}
					</div>
					{{-- <input type="hidden" name="organization_campus_id" value="{{ $student['organization_campus_id'] }}"> --}}
					<input type="hidden" name="academic_term_id" value="{{ $student['academic_term_id'] }}">
					<div id="student_course_select">

					</div>
					{{-- GET COURSE AFFILIATED BODY --}}
					<div id="student_course_affiliated_body">
					</div>
					{{-- GET SECTION --}}
					<div id="student_section_select">
						<span id="section_message"></span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<strong>Courses Subjects:</strong>
				{{-- GET COURSE SUBJECTS --}}
				<div id="course_subjects" class="mt-2">
					
				</div>
			</div>	
			@can('update_program_change')
				<div class="form-group mt-5">
					<a href="{{ url()->previous() }}" class="btn btn-light btn-sm active rounded-0 mr-1"><i class="fa fa-remove fa-fw text-danger"></i> Cancel</a>
					<button type="button" onclick="submitForm()" class="btn btn-dark btn-sm rounded-0"><i class="fa fa-cloud-upload fa-fw"></i> | Update Course</button>
				</div>
			@endcan
		</form>
		@include('layouts/loading', ['id' => 'course_change_loader'])
	</div>
</div>

@push('javascript')
<script type="text/javascript" src="{{ asset('js/student/student_course_update.js') }}"></script>
@endpush