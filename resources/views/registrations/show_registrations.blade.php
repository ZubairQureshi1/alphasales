@if(empty($studentRegistration))
	<h5 class="text-center p-5"><i class="fa fa-remove fa-fw fa-lg text-danger"></i> No Registration.</h5>
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
			</form>
		</div>
	</div>
@endif 
