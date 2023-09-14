<link href="{{ asset('assets/plugins/select2/css/select2.css') }}" rel="stylesheet" type="text/css" />
 <form name="session_inputs" class="" method="POST" action="{{ route('userShifts.store') }}" aria-label="{{ ('User Shift Create') }}">
    @csrf
    <div class="row">
		<div class="col-md-3 singleShiftTimeSlot">
	        <label>Select Time Slot For Shift:</label>
	        <div class="select-with-button mb-3">
				{!! Form::select('time_slot_id', $timeSlots, null, ['id' => 'time_slot_id_0', 'class' => 'form-control select2', 'aria-describedby' => 'basic-addon2', 'placeholder' => '--- Select Time Slot ---']) !!}
				<span class="btn btn-secondary btn-sm waves-effect waves-light" onclick="refreshTimeSlots(0)"><i id="time_slot_refresh_0" class="ion-loop"></i></span>
			</div>
		</div>
		<div class="col-md-3">
	        <label>Apply On:</label>
			{!! Form::select('users[]', $users, null, ['id' => 'users', 'class' => 'form-control select2 select2-multiple', 'multiple', 'data-placeholder' => '--- Select User ---']) !!}
		</div>	
		<div class="col-md-3">
	        <label>Start Date:</label>
	        <div>
	            <input class="form-control" type="date" name="start_date" data-date-format="yyyy-mm-dd"  required="true" id="start_date">
	        </div>
		</div>
		<div class="col-md-3"></div>
		<div class="col-md-12 m-t-10">
			<div class="custom-control custom-checkbox">
	            <input type="checkbox" name="is_repeat" class="custom-control-input" id="is_repeat">
	            <label class="custom-control-label" for="is_repeat">Is Repeat</label>
	        </div>
		</div>
	</div>
	<div class="row is_repeat_section m-t-10" hidden="hidden">
		<div class="col-md-3">
	        <label>End Date:</label>
	        <div>
	            <input class="form-control" type="date" name="end_date" data-date-format="yyyy-mm-dd" id="end_date">
	        </div>
		</div>	
		<div class="col-md-3">
	        <label>Shift Working Days:</label>
	        <div>
				{!! Form::select('selected_days[]', config('constants.week_days'), null, ['id' => 'selected_days', 'class' => 'form-control select2 select2-multiple', 'multiple', 'data-placeholder' => '--- Select Working Days ---']) !!}
	        </div>
		</div>		
		<div class="col-md-3">
	        <label>Shift Off Days:</label>
	        <div>
				{!! Form::select('selected_off_days[]', config('constants.week_days'), null, ['id' => 'selected_off_days', 'class' => 'form-control select2 select2-multiple', 'multiple', 'data-placeholder' => '--- Select Off Days ---']) !!}
	        </div>
		</div>

	</div>
	{{-- Working Day Time Slots --}}
	<div id="workingDayTimeSlots" hidden="true" class="mt-3">
		<h6 class="font-weight-bold">Time Slots Per Day:</h6>
	</div>
	<div class="row m-t-10">
		<div class="col-md-3">
		    <button type="button" class="btn btn-light active btn-sm"><i class="fa fa-remove fa-fw text-danger"></i> Cancel</button>
			<button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> | Create Shifts</button>
		</div>
	</div>
</form>
    <script src="{{ asset('assets/plugins/select2/js/select2.js')  }}"></script>
