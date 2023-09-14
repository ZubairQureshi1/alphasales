<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
@if ($is_edit_mode == 'false')
	<div class="row" id="courseAddedRow{{$counters}}">
		@php
		$exploded_counters = explode('-', $counters);
		@endphp
		<div class="col-md-2 form-group">
			<label>Subjects / Courses </label>
			<input type="text" name="subject_names[{{$row_count}}][{{$exploded_counters[1]}}][]" id="subjectName{{$counters}}" autocomplete="off" onkeyup="autoCompleteSubjectName({{$exploded_counters[1]}},{{$exploded_counters[2]}} , {{$row_count}})" required="required" class="form-control">
			<div id="subjectNameSuggestions{{$counters}}"></div>
			<input type="hidden" name="subject_ids[{{$row_count}}][{{$exploded_counters[1]}}][]" id="subjectId{{$counters}}">
		</div>
		<div class="col-md-3 form-group">
			<label>Subject / Course Code <small class="text-danger">Only for new subjects</small></label>
			<input type="text" name="subject_codes[{{$row_count}}][{{$exploded_counters[1]}}][]" id="subjectCode{{$counters}}" class="form-control">
		</div>
		<div class="col-md-2 form-group">
			<label>Credit Hours</label>
			<input type="number" name="credit_hours[{{$row_count}}][{{$exploded_counters[1]}}][]" min="1" max="6" id="creditHour{{$counters}}" value="0" class="form-control text-right">
		</div>
		<div class="col-md-2 form-group" {{$exploded_counters[1]==0?'hidden': ''}}>
			<label>Prerequisite Subjects</label>
			{{ Form::select('prerequisite_subjects['.$row_count.']['.$exploded_counters[1].'][]', App\Models\Subject::pluck('name', 'id'), null, ['class' => 'form-control select2', 'id' => 'prerequisiteSubject'.$counters, 'placeholder' => '--- Select Prerequisite Subject ---']) }}
		</div>
		<div class="col-md-2">
			<button type="button" class="btn btn-sm btn-danger pull-right" onclick="removeCourseAddRow({{$exploded_counters[1]}},{{$exploded_counters[2]}} , {{$row_count}})"><span class="fa fa-trash"></span></button>
		</div>
	</div>
@else
	<div class="row" id="courseAddedRow{{$counters}}">
		@php
		$exploded_counters = explode('-', $counters);
		@endphp
		<div class="col-md-2 form-group">
			<label>Subjects / Courses </label>
			<input type="text" name="subject_names[{{$exploded_counters[1]}}][]" id="subjectName{{$counters}}" autocomplete="off" onkeyup="autoCompleteSubjectName({{$exploded_counters[1]}},{{$exploded_counters[2]}} , {{$row_count}})" required="required" class="form-control">
			<div id="subjectNameSuggestions{{$counters}}"></div>
			<input type="hidden" name="subject_ids[{{$exploded_counters[1]}}][]" id="subjectId{{$counters}}">
		</div>
		<div class="col-md-3 form-group">
			<label>Subject / Course Code <small class="text-danger">Only for new subjects</small></label>
			<input type="text" name="subject_codes[{{$exploded_counters[1]}}][]" id="subjectCode{{$counters}}" class="form-control">
		</div>
		<div class="col-md-2 form-group">
			<label>Credit Hours</label>
			<input type="number" name="credit_hours[{{$exploded_counters[1]}}][]" min="1" max="6" id="creditHour{{$counters}}" value="0" class="form-control text-right">
		</div>
		<div class="col-md-2 form-group" {{$exploded_counters[1]==0?'hidden': ''}}>
			<label>Prerequisite Subjects</label>
			{{ Form::select('prerequisite_subjects['.$exploded_counters[1].'][]', App\Models\Subject::pluck('name', 'id'), null, ['class' => 'form-control select2', 'id' => 'prerequisiteSubject'.$counters, 'placeholder' => '--- Select Prerequisite Subject ---']) }}
		</div>
		<div class="col-md-2">
			<button type="button" class="btn btn-sm btn-danger pull-right" onclick="removeCourseAddRow({{$exploded_counters[1]}},{{$exploded_counters[2]}} , {{$row_count}})"><span class="fa fa-trash"></span></button>
		</div>
	</div>
@endif
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<script type="text/javascript">
	
	$('#prerequisiteSubject' + {{$counters}}).select2();
</script>   