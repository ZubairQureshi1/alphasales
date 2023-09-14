<div class="table-responsive">
	<table class="table table-hover table-striped table-bordered" id="dataTable">
		<thead class="thead-dark text-center">
			<th>No.</th>
			<th>Student Name</th>
			<th>Roll Number</th>
			@foreach($subjects as $key => $subject)
			<th>{{ $subject }}</th>
			@endforeach
		</thead>

		<tbody class="text-center">
			@foreach ($students as $key => $student)
			<tr>
				<td>{{ ++$key }}</td>
				<td class="text-capitalize">{{ $student->student_name }}</td>
				<td>{{ $student->roll_no }}</td>
				@foreach($subjects as $key => $subject)
					<td>
						@php
							$sectionSubjectDetails = App\Models\SectionSubjectDetail::where('subject_id', $key)->whereHas('section', function($query) use ($gender_id) {
								return $query->where('gender_id', $gender_id);
							})->get()
						@endphp
						@foreach($sectionSubjectDetails as $section)
							{{ \Log::info($section) }}
							@if(!empty($student->studentAcademicHistories()->where('is_promoted', false)->get()->last()->studentBooks()->where('subject_id', $key)->where('section_subject_detail_id', $section->id)->first()))
								<b class="badge badge-pill badge-success">{{ $section->section_name }}</b>
							@else
								<b class="badge badge-pill badge-secondary">{{ $section->section_name }}</b>
							@endif
						@endforeach
					</td> 
				@endforeach
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

@isset($sectionDetails)
	<div class="col-12 mt-5">
		<table class="table table-striped table-hover table-bordered">
			<thead class="thead-dark text-center">
				<th>Section Name</th>
				<th>Section Code</th>
				<th>Section Strength</th>
				<th>Student Alloted</th>
			</thead>
			<tbody class="text-center">
				@foreach($sectionDetails as $sectionDetail)
					<tr>
						<td>{{ $sectionDetail->section_name ?? '---' }}</td>
						<td>{{ $sectionDetail->section_code ?? '---' }}</td>
						<td>{{ $sectionDetail->section_strength ?? '---' }}</td>
						<td>{{ $sectionDetail->studentBooks()->groupBy('subject_id')->count() ?? 0 }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@else
	<div class="alert alert-warning bg-primary text-white mt-3 py-3 mx-3" role="alert">
        <strong><i class="fa fa-exclamation-circle" aria-hidden="true"></i>  No student section details found.</strong>
    </div>
@endisset