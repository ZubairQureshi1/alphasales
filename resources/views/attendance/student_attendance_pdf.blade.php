<html>
<body style="font-family: &quot;Open Sans&quot;, sans-serif;line-height: 1.25;">
	<header style="overflow: auto;">
		<section style="text-align: center;">
			<img src="pwwb/pdflogo.png" alt="logo" style="float: left; height: 60px;">
			{{-- <img src="pwwb/logoo.png" style="height: 130px; margin-top: -1em; float: left;"> --}}
			<h2 style="font-size: 2.3em; margin-top: -0.1em; font-family: Gentona; margin-right: 2em;">Attendance Sheet</h2>
		</section>
		<br><br>
		<section style="float: left">
			<b style="font-size: 0.8em;">Campus:</b> <u style="font-size: 0.8em;">{{ App\Models\OrganizationCampus::find(\Illuminate\Support\Facades\Session::get('organization_campus_id'))->name ?? null}}</u>
		</section>	

		<section style="float: right">
			<b style="font-size: 0.8em;">Session: </b><u style="font-size: 0.8em;">{{App\Models\Session::find(\Illuminate\Support\Facades\Session::get('selected_session_id'))->session_name ?? null}}</u>
		</section>
		<br><br>
		<section style="float: left;">
			<b style="font-size: 0.8em;">Course Code:</b> <u style="font-size: 0.8em;"> {{$attendance->subject_code ?? '---'}}
	        </u>
		</section>

		<section style="float: right;">
			<b style="font-size: 0.8em;">Section:</b> <u style="font-size: 0.8em;">{{$attendance->section_name ?? '---'}}</u>
		</section>
		<br><br>
		<section style="float: none; width: 100%;"></section>

		<section style="float: left;">
			<b style="font-size: 0.8em;"> Course Title:</b> <u style="font-size: 0.8em;">{{$attendance->title ?? '---'}}</u>
		</section>

		<section style="float: right;">
			<b style="font-size: 0.8em;">Date & Time:</b> <u style="font-size: 0.8em;">{{$attendance->date_time ?? '---'}}</u>
		</section>
		<br><br>
		<section style="float: none; width: 100%;"></section>

		<section style="float: left;">
			<b style="font-size: 0.8em;">Room:</b> <u style="font-size: 0.8em;">{{$attendance->room_name ?? '---'}}</u>
		</section>

		<section style="float: right;">
			<b style="font-size: 0.8em;">Teacher:</b> <u style="font-size: 0.8em;">{{$attendance->user_name ?? '---'}}</u>
		</section>

	</header>
<br><br><br>
	<table style="border: 1px solid #000;margin: 2em 0 0 0;padding: 0;width: 100%;table-layout: fixed;">
		<caption style="font-size: 1.5em;margin: .5em 0 .75em;"></caption>
		<thead>
			<tr style="background-color: #afafaf;border: 1px solid #000;">
				<th scope="col" style="padding: .625em;text-align: center;font-size: 0.5em;letter-spacing: .1em;text-transform: uppercase;">Sr.</th>
				<th scope="col" style="padding: .625em;text-align: center;font-size: 0.5em;letter-spacing: .1em;text-transform: uppercase; width: 25%;">Roll No</th>
				<th scope="col" style="padding: .625em;text-align: center;font-size: 0.5em;letter-spacing: .1em;text-transform: uppercase; width: 20%;">Name</th>
				<th scope="col" style="padding: .625em;text-align: center;font-size: 0.5em;letter-spacing: .1em;text-transform: uppercase;">T. A</th>
				<th scope="col" style="padding: .625em;text-align: center;font-size: 0.5em;letter-spacing: .1em;text-transform: uppercase;">T. Lt</th>
				<th scope="col" style="padding: .625em;text-align: center;font-size: 0.5em;letter-spacing: .1em;text-transform: uppercase;">P</th>
				<th scope="col" style="padding: .625em;text-align: center;font-size: 0.5em;letter-spacing: .1em;text-transform: uppercase;">A</th>
				<th scope="col" style="padding: .625em;text-align: center;font-size: 0.5em;letter-spacing: .1em;text-transform: uppercase;">L</th>
				<th scope="col" style="padding: .625em;text-align: center;font-size: 0.5em;letter-spacing: .1em;text-transform: uppercase;width: 15%;">Remarks</th>
			</tr>
		</thead>
		<tbody>
			@foreach($attendance->attendanceDetails as $key => $detail)
			<tr style="background-color: #f8f8f8;border: 1px solid #000;padding: .35em;">
				<td data-label="Sr No" style="padding: .625em; font-size: 0.6em;text-align: center;">{{++$key}}</td>
				<td data-label="Roll No" style="padding: .625em; font-size: 0.6em;text-align: center;width: 25%;">{{$detail->student->roll_no ?? '---'}}</td>
				<td data-label="Student Name" style="padding: .625em; font-size: 0.6em;text-align: center;width: 20%;">{{$detail->student->student_name ?? '---'}}</td>
				<td data-label="Present" style="padding: .625em; font-size: 0.6em;text-align: center;">{{ App\Models\StudentAttendanceDetail::where('student_id', $detail->student_id)->where('status_id', 0)->get()->count() }}</td>
				<td data-label="Present" style="padding: .625em; font-size: 0.6em;text-align: center;">{{ App\Models\StudentAttendanceDetail::where('student_id', $detail->student_id)->where('status_id', 4)->get()->count() }}</td>
				<td data-label="Present" style="padding: .625em; font-size: 0.6em;text-align: center;"></td>
				<td data-label="Absent" style="padding: .625em; font-size: 0.6em;text-align: center;"></td>
				<td data-label="Leave" style="padding: .625em; font-size: 0.6em;text-align: center;"></td>
				<td data-label="Remarks" style="padding: .625em; font-size: 0.6em;text-align: center;width: 15%;"></td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<br><br><br>
	{{-- <section style="float: left;">
			<b style="">Teacher:</b> <u style="font-size: 0.8em;">{{$userName->name ?? '---'}}</u>
		</section> --}}

		<section style="float: left;">
			<b style="font-size: 0.8em;">Entered By:</b> <u style="font-size: 0.8em;"></u>
		</section>
</body>
</html>
