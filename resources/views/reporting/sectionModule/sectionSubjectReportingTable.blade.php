<div class="table-responsive">
	<table class="table table-hover table-bordered table-lg" cellspacing="0" isdefault="true">
			<thead class="thead-dark text-lg-center">
				<th style="width: 15%; text-align: center;">Program</th>
				<th style="width: 20%; text-align: center;">Subjects</th>
				<th style="width: 25%; text-align: center;">Sections</th>
				<th style="width: 10%; text-align: center;">Strength</th>
				<th style="width: 10%; text-align: center;">Alloted Students</th>
			</thead>
		    <tbody class="text-center">
				<tr class="bg-success">
					<td class="text-white font-weight-bold" rowspan="{{ ($course->sessionCourseSubjects->count() + App\Models\SectionSubjectDetail::whereIn('subject_id', $course->sessionCourseSubjects->pluck('subject_id'))->count() * 2) + 1  }}">{{ App\Models\Course::find($course->course_id)->name }}</td>
					@foreach($course->sessionCourseSubjects()->where('annual_semester', $params['term_id'])->get() as $key => $subject)
					<tr class="@if($key % 2 == 0) table-secondary @else table-success @endif">
						<td data-id="{{ $subject->subject_id }}" rowspan="{{ $subject->sectionSubjectDetails->count() + 1 }}">{{ App\Models\Subject::find($subject->subject_id)->name ?? '---' }} <small>(annual/semester: {{ $subject->annual_semester ?? '---' }})</small></td>
					</tr>

						@foreach($subject->sectionSubjectDetails()->whereHas('section', function($q) use ($params){ return $q->where('annual_semester', $params['term_id']); })->orderBy('section_detail_id', 'ASC')->get() as $sectionSubjectDetail)
							<tr class="@if($key % 2 == 0) table-secondary @else table-success @endif">
								<td>{{ $sectionSubjectDetail->sectionDetail->section_name ?? '---'}}</td>
								<td>{{ $sectionSubjectDetail->sectionDetail->section_strength ?? '---'}}</td>
								<td>{{ $sectionSubjectDetail->sectionDetail->studentBooks->groupBy('student_academic_history_id')->count()
								 ?? '---'}}</td>
							</tr>

						@endforeach

					@endforeach
				</tr>
			</tbody>
	</table>
</div>