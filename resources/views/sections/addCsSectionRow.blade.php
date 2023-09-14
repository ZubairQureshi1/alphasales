<div class="mb-5 div-border px-2 sectionRow" id="sectionDiv_{{ $count }}" row-status="division">
	<div class="margin-10">
		<div class="text-center">
			<h4 class="font-weight-bold my-4">Section Row</h4>
		</div>
		<div class="form-row">
			<div class="col-4 form-group">
				<label>Section Name:<span style="color: red">*</span></label>
				<input type="text" id="section_name_{{ $count }}" class="form-control" placeholder="Section Name">
			</div>
			<div class="col-4 form-group">
				<label class="mr-1">Section Strength:<span class="text-danger">*</span></label>
				<input type="number" min="0" id="section_strength_{{ $count }}" class="form-control rounded-0 item-required" placeholder="Section Strength" errorLabel="Section ({{ $count }}) Strength">
			</div>
			<div class="col-4 form-group">
				<label class="mr-1">Section Code:<span class="text-danger">*</span></label>
				<input type="text" id="section_code_{{ $count }}" class="form-control rounded-0 item-required" placeholder="Section Code" errorLabel="Section ({{ $count }}) Code">
				<input type="hidden" id="count_subjects" value="{{ count($subjects) ?? 0 }}">
			</div>
		</div>
		{{-- Subjects rows --}}
		<div class="mt-3">
			@foreach($subjects as $key => $subject)
			<div class="form-row hvr-underline-reveal section-subject-row">
				{{-- SUBJECTS --}}
				<div class="form-group col-4">
					<label>Subject {{ $key+1 }}:<span style="color: red">*</span></label>
					<input type="text" class="form-control bg-light" value="{{ $subject->subject_name }}" readonly>
					<input type="hidden" id="subject_{{ $count.'_'.$key }}" value="{{ $subject->subject_id }}">
				</div>
				{{-- TEACHER --}}
				<div class="form-group col-4">
					<label>Teacher For:<span style="color: red">*</span></label>
					{{ Form::select('teacher_id', App\User::whereHas('roles', function($q){$q->where('id', '4')->orWhere('id', '16')->orWhere('id', '17');})->get()->pluck('name', 'id'), null ,[ 'id' =>
					'teacher_'.$count.'_'.$key, 'class' => 'form-control select2 item-required', 'placeholder' => '--- Select Teacher ---', 'errorLabel' => 'Section ('.$count.') & Subject ('. $subject->subject_name .') Teacher']) }}
				</div>
				{{-- HELPER TEACHER --}}
				@if($wing_id != 2)
				<div class="form-group col-4">
					<label>Helper Teacher For:<span style="color: red">*</span></label>
					{{ Form::select('helper_teacher_ids[]', App\User::whereHas('roles', function($q){$q->where('id', '4');})->get()->pluck('name', 'id'), null ,[ 'id' =>
					'helper_teachers_'.$count.'_'.$key, 'class' => 'form-control select2 select2-multiple item-required', 'multiple','data-placeholder' => '--- Select Helper Teacher ---', 'errorLabel' => 'Section ('.$count.') & Subject ('. $subject->subject_name .') Helper Teacher']) }}
				</div>
				@endif
			</div>
			@endforeach
		</div>
		{{-- DELETE --}}
		<button class="btn btn-danger btn-sm" onclick="deleteSectionRow({{ $count }})" data-section="empty">
			<i class="mdi mdi-delete"></i> | Delete
		</button>
	</div>
</div>