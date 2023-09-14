<html>
<body style="font-family: &quot;Open Sans&quot;, sans-serif;line-height: 1.25;">
	<header style="overflow: auto;">
		<section style="text-align: center;">
			{{-- <img src="pwwb/pdflogo.png" alt="logo" style="float: left; margin-left:4em; height: 60px;"> --}}
			{{-- <img src="pwwb/logoo.png" style="height: 130px; margin-top: -1em; float: left;"> --}}
			<div style="font-size: 0.8em;margin-right: 4em; margin-top:3em" align="right">
				Dated: ____________
			</div>
		</section>

		<section style="margin-left:3.2em; margin-top: 2em; line-height: 1.2">
			<div align="left" style="font-size: 0.8em;">
				Mr / Mrs. <b>{{ ucfirst($students->studentPersonalDetail->name) ?? '--'}}</b>
			</div>
			<div align="left" style="font-size: 0.8em;">
				S/o {{ ucfirst($students->studentPersonalDetail->father_name) ?? '--'}}
			</div>
			<div align="left" style="font-size: 0.8em;">
				{{ ucfirst($students->studentPersonalDetail->present_address) ?? '--'}}
			</div>
			<div align="left" style="font-size: 0.8em;">

				Father’s Cell No. {{ $studentFatherContact->contact_no ?? '--'}}
			</div>
		</section>


	</header>
	<h2 style="font-size: 0.8em; font-family: Gentona; margin-left: 4em; line-height: 1.6em">Subject: <u>Admission Offer Letter</u></h2>	
	<section style="margin-left: 4.5em; margin-top: 0.8em; font-size: 0.7em">Dear Applicant,</section>
		<section style="float: left; margin-top: 0em">
			<p style="margin-left:4em; margin-right:4em;line-height:1.2; font-size: 0.8em;">We are pleased to inform you that the Admissions Committee has selected you for admission in <b><u>{{ $students->admissionPWWB->course_name ?? '--'}}</u></b> for <b><u>{{ $students->admissionPWWB->session_name ?? '--'}}</u></b> at CFE College of Commerce and Science (CFE Group of Colleges) Lahore.
			</p>
		</section>
		<h2 style="font-size: 0.8em; font-family: Gentona; margin-right: 5em;margin-left:4em;">Your admission is subject to fulfillment of the following requirements:</h2>
		<section style="float: left; margin-left: 2.5em">
			<li style="margin-left:2em; margin-right:3em; font-size: 0.8em;">Meeting eligibility criteria</li>
			<li style="margin-left:2em; font-size: 0.8em; margin-right:3em;line-height:1.2, margin-top: -1em">
				Submission of result card/certificate and other required documents within 2 weeks of issuance of this letter
			</li>
		</section>
		<h2 style="font-size: 0.8em; font-family: Gentona; margin-left: 4em; margin-right: 7em; ">The details of fees/ dues for first year are as under:</h2>
	<table style="font-size:0.8em;border: 1px solid #000;margin: 1em 0 0 0;padding: 0;width: 100%;table-layout: fixed; margin-left: 4em; margin-right: 5em">
		<caption style="font-size: 0.8em;margin: .5em 0 .75em;"></caption>
		<thead>
		</thead>
		<tbody>
			@foreach($claims as $claim)
				<tr style="background-color: #f8f8f8;border: 1px solid #000;padding: .35em;">
					<th scope="col" style="padding: .625em;text-align: left;font-size: 0.8em;letter-spacing: .1em; border-right: 1px solid black;">{{ $claim->claim_head  ?? '--'}}</th>
					<td  style="padding: .625em; font-size: 0.8em;text-align: right;">{{ $claim->amount_due ?? '--'}}</td>	
				</tr>
			@endforeach
		</tbody>
	</table>
	<section style="margin-top: 0em;">
		<p style="margin-left: 3.8em; margin-right: 4em; line-height: 1.2; font-size: 0.8em;">We look forward to your professional development under the guidance of highly qualified faculty and staff of CFE College of Commerce and Science.</p>
		<p style="margin-left: 3.8em; font-size: 0.8em;">With Best Wishes</p>
		<p style="margin-left: 3.8em; font-size: 0.8em;">Yours sincerely,</p>
		<p style="margin-left: 3.8em; font-size: 0.8em;"><b>Asim Amin</b><br>Principal</p>
	</section>
</body>
</html>
