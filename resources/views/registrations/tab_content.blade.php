@if(empty($studentRegistration))
	@can('create_student_registration')
		<form action="{{ route('studentRegistration.store', $student['id']) }}" method="POST">
			@csrf
			<div class="form-group">
				<label>Platform:</label>
				{!! Form::select('registration_platform_id', config('constants.registration_platforms'), null, ['id' => 'student_category_id', 'onchange' => 'getPlatformTypes()', 'class' => 'form-control', 'placeholder' => '--- Select Registration Platform ---']) !!}
			</div>
			{{-- DYNAMIC FORM --}}
			<div id="platform"></div>
			<div id="registration"></div>
			{{-- FOOTER --}}
			<div class="col-12 mt-4">
{{-- 				<a href="{{ url()->current() }}" class="btn btn-light active btn-sm">
					<i class="fa fa-remove fa-fw text-danger"></i> Cancel
				</a> --}}
				<button type="submit" class="btn btn-outline-dark btn-sm">
					<i class="fa fa-cloud-upload fa-fw"></i> | Save Registration
				</button>
			</div>
		</form>
	@else
		<h5 class="text-center p-5"><i class="fa fa-ban fa-fw fa-lg text-danger"></i> You Don't Have Permission To Create Registration.</h5>
	@endcan
@else
	<div class="card">
		{{-- CARD HEADER --}}
		<div class="card-header clearfix">
			<div class="float-left">
				<h5 class="card-title mb-1">Student Registration</h5>
				<span class="text-muted">
					<i class="fa fa-clock-o fa-fw"></i> Created: {{ $studentRegistration->created_at->format('F dS Y') }}
				</span>
			</div>
			@can('update_student_registration')
				<div class="float-right mt-3">
					<button class="btn btn-sm btn-outline-dark pull-right" type="button" onclick="editRegistration()">
						<i class="mdi mdi-pencil"></i> | Edit Student Registration
					</button>
				</div>
			@endcan
		</div>
		{{-- CARD BODY --}}
		<div class="card-body">
			<form action="{{ route('studentRegistration.update', $studentRegistration->id) }}" method="POST">
				@csrf
				@method('PATCH')
				{{-- PLATFORM --}}
				<div class="form-group">
					<label>Registration Platform:</label>
					{!! Form::select('registration_platform_id', config('constants.registration_platforms'), $studentRegistration->registration_platform_id , ['class' => 'custom-select registration_editable', 'disabled' => true, 'onchange' => 'getPlatformTypes()']) !!}
				</div>
				{{-- PLATFORM --}}
				<div id="platform">
					{{-- CFE PLATFORMS --}}
					@if($studentRegistration->registration_platform_id == 0)
						<div class="form-group">
							<label>CFE Platform:</label>
							{!! Form::select('registration_type_id', config('constants.cfe_platforms'), $studentRegistration->registration_type_id , ['class' => 'custom-select registration_editable', 'id' => 'registration_type_id', 'disabled' => true]) !!}
						</div>
					@endif
					{{-- REGISTRATION STATUSES --}}
					<div class="form-group">
						<label>Status:</label>
						{!! Form::select('registration_status_id', config('constants.registration_statuses'), $studentRegistration->registration_status_id , ['class' => 'custom-select registration_editable', 'onchange' => 'checkForRegistrationStatus()', 'disabled' => true]) !!}
					</div>
				</div>
				{{-- REGISTERED --}}
				<div id="registration">
					@if($studentRegistration->registration_status_id == 1)
						<div class="form-group">
							<label>Registration No.</label>
							<input type="text" name="registration_no" class="form-control registration_editable" value="{{ $studentRegistration->registration_no }}" disabled="true">
						</div>

						<div class="form-group">
							<label>Card Received Status</label>
							{!! Form::select('registration_card_received_id', config('constants.registration_card_received'), $studentRegistration->registration_card_received_id , ['class' => 'custom-select registration_editable', 'disabled' => true]) !!}
						</div>
					@endif
				</div>
				{{-- FOOTER --}}
				<div class="mt-3">
					<a href="{{ url()->current() }}" class="btn btn-light mr-1 registration_editable-button" hidden="true">
						<i class="fa fa-times fa-fw text-danger"></i> Cancel
					</a>
					<button type="submit" class="btn btn-dark btn-sm registration_editable-button" hidden="true">
						<i class="fa fa-cloud-upload fa-fw"></i> | Save Changes
					</button>
				</div>
			</form>
		</div>
	</div>
@endif 
