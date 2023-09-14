<html>
<body style="font-family: &quot;Open Sans&quot;, sans-serif;line-height: 1.25;">
	<br><br><br>
	<header style="overflow: auto;">
		<section style="text-align: center;">
			<!-- <img src="pwwb/pdflogo.png" alt="logo" style="float: left; margin-left:4em; height: 60px;"> -->
			{{-- <img src="pwwb/logoo.png" style="height: 80px; margin-top: -1em; float: left;"> --}}
			<div style="margin-right: 3em; font-size: 0.8em;" align="right">
				Ref: ___<u style="font-size: 0.8em;">{{ $students->file_module_number ?? '--' }} / {{ $students->admissionPWWB->session_name ?? '--' }}</u>___
			</div>
			<div style="margin-right: 3.4em; margin-top: 1.2em;font-size: 0.8em;" align="right">
				Date: ____________	
			</div>
		</section>

		<section style="text-align: center; margin-left:4em; margin-top: 1em; line-height: 1.2; font-size: 0.8em;">
			<div align="left">
				To,
			</div>
			<div align="left">
				Incharge ICT Cell
			</div>
			<div align="left">
				F-A/1, Khyber Block, Allama Iqbal Town
				PWWB, Lahore
			</div>
		</section>


	</header>
	<section style="margin-left: 4em; margin-top: 0.8em; font-size: 0.8em">Dear Sir,</section>
	<h2 style="font-size: 0.8em; font-family: Gentona; margin-left: 4em;">Subject: <u>Claim Letter for Talent Scholarship of PWWB Session {{$students->admissionPWWB->session_name ?? '--'}}.</u></h2>	
		<section style="float: left; margin-top: -1em">
			<p style="margin-left:4em; margin-right:4em;line-height:1.2; text-align: justify; font-size: 0.8em">
				It is stated that CFE College has granted admission to the following student, in <b><u>{{$students->course_name ?? '--'}}</u></b> session <b><u>{{$students->admissionPWWB->session_name ?? '--'}}</u></b>. You are now requested to accept our claim and give our payment through cross Cheque in the name of CFE College of Commerce and Science (CFE Group of Colleges) Lahore.
			</p>
		</section>
		<h2 style="font-size: 0.8em; font-family: Gentona; margin-left: 4em;">Following is the detail of annual dues / charges of CFE College:</h2>		
		<table style="font-size:0.8em;border: 1px solid #000;margin: 2em 0 0 0;padding: 0;width: 100%;table-layout: fixed; margin-left: 4em; margin-right: 5em">
			<caption style="font-size: 0.8em;margin: .5em 0 .75em;"></caption>
			<thead>
			</thead>
			<tbody>
					<tr style="background-color: #f8f8f8;border: 1px solid #000;padding: .35em;">
						<th  scope="col" style="padding: .625em;text-align: left;font-size: 0.8em;letter-spacing: .1em; border-bottom: 1px solid black;border-right: 1px solid black;">Name, %age, Course, Address of Student</th>
						<th  scope="col" style="padding: .625em;text-align: right;font-size: 0.8em;letter-spacing: .1em; border-bottom: 1px solid black;border-right: 1px solid black;"><b>{{ ucfirst($students->studentPersonalDetail->name) ?? '--'}}</b>
						S/o {{ ucfirst($students->studentPersonalDetail->father_name) ?? '--'}}
						({{ ucfirst($students->course_name) ?? '--'}})
						{{ ucfirst($students->studentPersonalDetail->present_address) ?? '--'}}</th>
					</tr>
					<tr style="background-color: #f8f8f8;border: 1px solid #000;padding: .35em;">
						<th  scope="col" style="padding: .625em;text-align: left;font-size: 0.8em;letter-spacing: .1em; border-bottom: 1px solid black;border-right: 1px solid black;">Factory. / Industry</th>
						<th  scope="col" style="padding: .625em;text-align: right;font-size: 0.8em;letter-spacing: .1em; border-bottom: 1px solid black;border-right: 1px solid black;">{{ucfirst($factoryName->factory_name ?? '--')}}</th>
					</tr>
				@foreach($claims as $claim)
					<tr style="background-color: #f8f8f8;border: 1px solid #000;padding: .35em;">
						<th scope="col" style="padding: .625em;text-align: left;font-size: 0.8em;letter-spacing: .1em; border-bottom: 1px solid black;border-right: 1px solid black;">{{ $claim->claim_head  ?? '--'}}</th>
						<td  style="padding: .625em; font-size: 0.8em;text-align: right; border-bottom: 1px solid black;border-right: 1px solid black;">{{ $claim->amount_due ?? '--'}}</td>	
					</tr>
				@endforeach
				@foreach($claims as $claim)
					<th  scope="col" style="padding: .625em;text-align: left;font-size: 0.8em;letter-spacing: .1em; border-right: 1px solid black;">Total: </th>
					<th  scope="col" style="padding: .625em;text-align: right;font-size: 0.8em;letter-spacing: .1em; border-right: 1px solid black;">{{$claim->total_amount_due}}</th>
					@php break; @endphp
				@endforeach
			</tbody>
		</table>

		<!-- <tbody>
			<tr style="background-color: #f8f8f8;border: 1px solid #000;padding: .35em;">
				<th scope="col" style="padding: .625em;text-align: left;font-size: 0.8em;letter-spacing: .1em; border-right: 1px solid black;">Sr. No</th>

				<td data-label="Admission Fee" style="padding: .625em; font-size: 0.8em;text-align: left;">1</td>
			</tr>
			<tr style="background-color: #f8f8f8;border: 1px solid #000;padding: .35em;">
				<th scope="col" style="padding: .625em;text-align: left;font-size: 0.8em;letter-spacing: .1em; border-right: 1px solid black;">Name, %age, Course, Address of Student</th>
				<td data-label="Admission Fee" style="padding: .625em; font-size: 0.8em;text-align: left;">{{ $students->admissionPWWB->student_name ?? '--'}}<br>S/o {{ $students->admissionPWWB->father_name ?? '--'}}<br>
					{{ $students->admissionPWWB->course_name ?? '--'}}<br>{{ $students->admissionPWWB->permanent_address ?? '--'}}</td>
			</tr>
			<tr style="background-color: #f8f8f8;border: 1px solid #000;padding: .35em;">
				<th scope="col" style="padding: .625em;text-align: left;font-size: 0.8em;letter-spacing: .1em; border-right: 1px solid black;">Factory / Industry</th>
				<td data-label="Admission Fee" style="padding: .625em; font-size: 0.8em;text-align: left;">{{ $students->admissionPWWB->factory_name ?? '--'}}</td>
			</tr>
			@foreach($students->claims as $claim)
			<tr style="background-color: #f8f8f8;border: 1px solid #000;padding: .35em;">
				<th scope="col" style="padding: .625em;text-align: left;font-size: 0.8em;letter-spacing: .1em; border-right: 1px solid black;">{{ $claim->claim_head ?? '--' }}</th>
				<td data-label="Admission Fee" style="padding: .625em; font-size: 0.8em;text-align: left;">{{ $claim->claim_due ?? '--'}}</td>
			</tr>
			@endforeach
		</tbody> -->
	</table>
	<section style="margin-top: 0.5em; font-size: 0.8em">
		<p style="margin-left: 4.2em; margin-right: 4em; line-height: 1.2em">We look forward to your cooperation and hope for an early and positive response.</p>
		<p style="margin-left: 4.2em;line-height: 1.2em">With Best Wishes</p>
		<p style="margin-left: 4.2em;line-height: 1.2em">Yours sincerely,</p>
		<p style="margin-left: 4.2em;line-height: 1.2em"><b>Asim Amin</b><br>Principal</p>
	</section>
</body>
</html>
