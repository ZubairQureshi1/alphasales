<div class="table-responsive">
	<table class="table table-hover table-striped table-bordered" id="dataTable">
		<thead class="thead-dark text-center">
			<th>No.</th>
			<th>Roll Number</th>
			<th>Student Name</th>	
			<th>Father Name</th>
			<th>Student Number</th>
			<th>Father Number</th>
			@isset($section->sectionDetails)
				<th>Section</th>
				@foreach($subjects as $key => $subject)
					<th>{{ $subject }}</th>
				@endforeach
			@endisset
		</thead>

		<tbody class="text-center">
			@foreach ($students as $key => $student)
			<tr>
				<td>{{ ++$key }}</td>
				<td>{{ $student->roll_no }}</td>
				<td class="text-capitalize">{{ $student->student_name }}</td>
				<td class="text-capitalize">{{ $student->father_name }}</td>
				<td>
					{{ $student->studentCellNo }}
				</td>
				<td>
					{{ $student->fatherCellNo }}
				</td>
				@isset($section->sectionDetails)
					@php
						$sectionDetail = $sectionDetails
										->where('id', $student->studentAcademicHistories()->where('is_promoted', false)
										->get()
										->last()
										->studentBooks()
										->whereIn('section_detail_id', $sectionDetails->pluck('id'))
										->get()
										->last()->section_detail_id ?? null)
										->first()
					@endphp
					@isset($sectionDetail)
						<td>
							{{ ucwords($sectionDetail->section_name) ?? '---'}}
						</td>
					
						@foreach($subjects as $key => $subject)
							<td>
								@php
									$sectionSubjectDetails = App\Models\SectionSubjectDetail::where(['subject_id' => $key, 'section_id' => $section->id, 'section_detail_id' => $sectionDetail->id])->first()->sectionTeachers()->first()->user_name;
								@endphp
								{{ ucwords($sectionSubjectDetails) ?? '---'}}
							</td> 
						@endforeach
					@endisset
				@endisset
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