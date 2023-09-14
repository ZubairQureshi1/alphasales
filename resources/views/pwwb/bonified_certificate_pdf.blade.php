<html>
<body style="font-family: &quot;Open Sans&quot;, sans-serif;line-height: 1.25;">
		<br><br><br><br>
	<header style="overflow: auto;">
		<section style="text-align: center;">
			<!-- <img src="pwwb/pdflogo.png" alt="logo" style="float: left; margin-left:4em; height: 60px;"> -->
			{{-- <img src="pwwb/logoo.png" style="height: 80px; margin-top: -1em; float: left;"> --}}
			<div style="margin-right: 4em; font-size: 0.86em;" align="right">
				Ref: ___<u style="font-size: 0.7em;">{{ $studentData->file_module_number ?? '--' }} / {{ $studentData->admissionPWWB->session_name ?? '--' }}</u>___
			</div>
			<div style="margin-right: 4em; margin-top: 1.4em;font-size: 0.86em;" align="right">
				Date: ____________
			</div>
		</section>
		<br><br>
		

	</header>
	<br><br><br>
	<h2 style="font-size: 1.3em; margin-top: -0.1em; font-family: Gentona; text-align: center;">BONAFIDE CERTIFICATE</h2>	
	<br><br><br>
	{{-- <section style="float: left;">
			<b style="">Teacher:</b> <u style="font-size: 0.8em;">{{$userName->name ?? '---'}}</u>
		</section> --}}

		<section style="float: left;">
			{{-- <b style="font-size: 0.8em;">Entered By:</b> <u style="font-size: 0.8em;"></u> --}}
			<p style="margin-left:4em; margin-right:4em;line-height:2; text-align: justify;">
				It is certified that Mr. / Mrs. <b><u>{{ $studentData->studentPersonalDetail->name ?? '--' }}</u></b> S/o <b><u>{{ $studentData->studentPersonalDetail->father_name ?? '--' }}</u></b> is a regular student of CFE College of Commerce and Science (CFE Group of Colleges) Lahore for Boys in Class <b><u>{{ $studentData->admissionPWWB->course_name ?? '--' }}</u></b> under Roll No. <b><u>{{ $studentData->roll_no ?? '--'}}</u></b> during the session <b><u>{{ $studentData->admissionPWWB->session_name ?? '--'}}</u></b>. 
				He is bonafide student and bears good moral character.

			</p>
		</section>
		<section style="float: right;margin-right:6em; margin-top: 25em; font-weight: bold; ">
			Principal
		</section>
</body>
</html>
