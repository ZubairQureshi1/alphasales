<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
@if ($is_edit_mode == 'false')
	@for($i = 1; $i <= $academic_timespan; $i++)
		<div class="row p-t-10">
			<div class="col-md-12">
				<u><b>{{config('constants.academic_terms')[$academic_term_id]}} {{$i}}</b></u>
				<input type="hidden" name="academic_timespans[{{$row_count}}][]" value="{{$i}}">
			</div>
		</div>
		<div class="padding-10 margin-top-10 div-border-rad" id="newCourses{{$row_count}}-{{$i}}-0">
			<div class="row">
				<div class="col-md-2 form-group">
					<label>Subjects / Courses <small class="text-danger">Only for new subjects</small></label>
					<input type="text" name="subject_names[{{$row_count}}][{{$i}}][]" id="subjectName{{$row_count}}-{{$i}}-0" autocomplete="off" onkeyup="autoCompleteSubjectName({{$i}},0, {{$row_count}})" required="required" class="form-control">
					<div id="subjectNameSuggestions{{$row_count}}-{{$i}}-0"></div>
					<input type="hidden" name="subject_ids[{{$row_count}}][{{$i}}][]" id="subjectId{{$row_count}}-{{$i}}-0">
				</div>
				<div class="col-md-3 form-group">
					<label>Subject / Course Code</label>
					<input type="text" name="subject_codes[{{$row_count}}][{{$i}}][]" id="subjectCode{{$row_count}}-{{$i}}-0" class="form-control">
				</div>
				<div class="col-md-2 form-group">
					<label>Credit Hours</label>
					<input type="number" name="credit_hours[{{$row_count}}][{{$i}}][]" min="1" max="6" id="creditHour{{$row_count}}-{{$i}}-0" value="0" class="form-control text-right">
				</div>
				<div class="col-md-2 form-group" hidden="true">
					<label>Prerequisite Subjects</label>
					{{ Form::select('prerequisite_subjects['.$row_count.']['.$i.'][]', App\Models\Subject::pluck('name', 'id'), null, ['class' => 'form-control select2', 'id' => 'prerequisiteSubject'.$row_count.$i.'0', 'placeholder' => '--- Select Prerequisite Subject ---']) }}
				</div>
				<div class="col-md-2">
					<button type="button" class="btn btn-sm btn-info pull-right" onclick="addNewCourses(event, false, {{$i}}, 0, {{$row_count}})"><span class="fa fa-plus"></span> Courses</button>
					<!-- <button type="button" class="btn btn-sm btn-danger pull-right"><span class="fa fa-trash"></span></button> -->
				</div>
			</div>
		</div>
	@endfor
@else
	@for($i = 1; $i <= $academic_timespan; $i++)
		<div class="row p-t-10">
			<div class="col-md-12">
				<u><b>{{config('constants.academic_terms')[$academic_term_id]}} {{$i}}</b></u>
				<input type="hidden" name="academic_timespans[]" value="{{$i}}">
			</div>
		</div>
		<div class="padding-10 margin-top-10 div-border-rad" id="newCourses{{$row_count}}-{{$i}}-0">
			<div class="row">
				<div class="col-md-2 form-group">
					<label>Subjects / Courses <small class="text-danger">Only for new subjects</small></label>
					<input type="text" name="subject_names[{{$i}}][]" id="subjectName{{$row_count}}-{{$i}}-0" autocomplete="off" onkeyup="autoCompleteSubjectName({{$i}},0, {{$row_count}})" required="required" class="form-control">
					<div id="subjectNameSuggestions{{$row_count}}-{{$i}}-0"></div>
					<input type="hidden" name="subject_ids[{{$i}}][]" id="subjectId{{$row_count}}-{{$i}}-0">
				</div>
				<div class="col-md-3 form-group">
					<label>Subject / Course Code</label>
					<input type="text" name="subject_codes[{{$i}}][]" id="subjectCode{{$row_count}}-{{$i}}-0" class="form-control">
				</div>
				<div class="col-md-2 form-group">
					<label>Credit Hours</label>
					<input type="number" name="credit_hours[{{$i}}][]" min="1" max="6" id="creditHour{{$row_count}}-{{$i}}-0" value="0" class="form-control text-right">
				</div>
				<div class="col-md-2 form-group" hidden="true">
					<label>Prerequisite Subjects</label>
					{{ Form::select('prerequisite_subjects['.$i.'][]', App\Models\Subject::pluck('name', 'id'), null, ['class' => 'form-control select2', 'id' => 'prerequisiteSubject'.$row_count.$i.'0', 'placeholder' => '--- Select Prerequisite Subject ---']) }}
				</div>
				<div class="col-md-2">
					<button type="button" class="btn btn-sm btn-info pull-right" onclick="addNewCourses(event, true, {{$i}}, 0, {{$row_count}})"><span class="fa fa-plus"></span> Courses</button>
					<!-- <button type="button" class="btn btn-sm btn-danger pull-right"><span class="fa fa-trash"></span></button> -->
				</div>
			</div>
		</div>
	@endfor
@endif

<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

<script type="text/javascript">
	
	$('.select2').select2();
</script>