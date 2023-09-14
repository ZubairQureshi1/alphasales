<div class="form-row row-{{ $day }}">
	<div class="col-md-1 my-auto">
		<h6 class="border border-primary p-1 text-center text-primary">{{ $day }}</h6>
	</div>
	<div class="col-md-4 my-auto">
        <div class="select-with-button">
			{!! Form::select('time_slot_id['.$id.']', $timeSlots, null, ['id' => 'time_slot_id_'.$id, 'class' => 'form-control select2', 'placeholder' => '--- Select Time Slot ---']) !!}
			<span class="btn btn-secondary btn-sm waves-effect waves-light" onclick="refreshTimeSlots({{ $id }})">
				<i id="time_slot_refresh_{{ $id }}" class="ion-loop"></i>
			</span>
		</div>
	</div>
</div>