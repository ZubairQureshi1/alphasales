<div class="table-responsive">
	<table class="table table-hover table-striped table-bordered" id="datatable" isDefault="true">
		<thead>
			<td>No.</td>
			<td>Student Name</td>
			<td>Student Roll Number</td>
			<td>Student Course</td>	
		</thead>

		<tbody>
			@foreach ($students as $key => $student)
			<tr>
				<td>{{ ++$key }}</td>
				<td>{{ $student->student_name }}</td>
				<td>{{ $student->roll_no }}</td>
				<td>{{ $student->course_name }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>