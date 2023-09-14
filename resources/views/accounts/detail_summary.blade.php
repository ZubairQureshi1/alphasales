<style type="text/css">
	@media print {
		.page-break	{ display: block; page-break-before: always; }

		.footer-print{
			display: block;
		    position: fixed;
		    bottom: 0;
		    left:25%;
		}
	
		
		.footer-font-size{
			font: message-box;
		}

		.pull-upward{
			margin-top: -10%
		}
	}
</style>

<div>
	<div class="row pull-upward" id="section_info">

	    <div class="col-12">
	        <div class="card m-b-20">
	            <div class="card-body div-border-black">
	            	<div class="row">
		            	<div class="col-3">
	            			<strong>Student Category: </strong><label>{{config('constants.student_categories')[$student->student_category_id] }}</label><br>
	            			<strong>Admission Date: </strong> <label>{{$student->admission_date}}</label><br>
	            			<strong>Student Status: </strong> <label>{{$student->is_end_of_reg==true?'Dropped At('. $student->reason_end_of_reg . ')':'Active'}}</label><br>
	            			<strong>Shift: </strong> <label>---</label><br>
	            			<strong>Student #: </strong> <label>---</label><br>
	            			<strong>Guardian #: </strong> <label>---</label><br>
	            			<strong>Father #: </strong> <label>---</label><br>
		            	</div>

			           	<div class="col-6">
		            		<div class="text-center" style="">
			            		<h4>CFE College of Commerce & Sciences</h4>
			            		<div>
				            		<h6 style="max-width: 35%;margin: 0 auto;padding: 10px;margin-bottom: 0.5%;text-transform: uppercase;" class="div-border-black">Clearance Slip</h6>
			            		</div>
			            		<strong style="margin-top: -50px;">As On: {{ $clearance_date }}</strong><br>
		                        <strong>Name: {{$student->student_name}} </strong><br>
		            			<strong>Father's Name: {{$student->father_name}} </strong>
		            		</div>
		            	</div>
		            	<div class="col-3">
	            			<strong>Session: </strong> <label>{{$student->session_name}}</label><br>    
	            			<strong>N. Roll #: </strong> <label>{{$student->roll_no}}</label><br>
	            			<strong>O. Roll #: </strong> <label>{{$student->old_roll_no}}</label><br>
	            			<strong>Course: </strong> <label>{{$student->course_name}}</label><br>
	            			<strong>Section: </strong> <label>{{$student->section_name}}</label><br>
		            	</div>
	            	</div>
	            </div>
	        </div>
	    </div> <!-- end col -->
	</div> <!-- end row -->

	@if (!empty($fee_package->toArray()))
		<div class="row" id="section_package">
		    @if($student->student_category_id != 2)
			    <div class="col-12">
			    	<div class="row">
			            <div class="col-6">
					        <div class="card m-b-20">
					            <div class="card-body div-border-black">
					            	<div class="padding-10">
					            		<div class="row">
					            			<div class="col-12" id="package_summary">
							            		<h4>Fee Package Detail: <label class="pull-right" style="margin-right: 14px;">Part-{{ $year_count }}</label></h4>
								            	<div class="row">
								            		<div class="col-9">
								            			
								            		</div>
								            		<div class="col-3 div-border-black text-center">
									            			<strong>Amount</strong><br><label>Rs.</label>
								            		</div>
								            	</div>
								            	@if ($year_count == 2)
									            	<div class="row div-border-black">
									            		<div class="col-9 div-border-black">
									            			<label>Previous Year Outstanding Balance</label>
									            		</div>
									            		<div class="col-3 div-border-black text-right">
									            			<label class="">{{ isset($outstanding_clearance_section->outstanding_balance)?number_format($outstanding_clearance_section->outstanding_balance): '---' }}</label>
									            		</div>
									        		</div>
									            	<div class="row div-border-black">
									            		<div class="col-9 div-border-black">
									            			<label>Admission Fee</label>
									            		</div>
									            		<div class="col-3 div-border-black text-right">
									            			<label class="">{{ isset($fee_package->admission_fee)?number_format($fee_package->admission_fee): '---' }}</label>
									            		</div>
									            	</div>
								            	@endif
								            	<div class="row div-border-black">
								            		<div class="col-9 div-border-black">
								            			<label>Tution Fee</label>
								            		</div>
								            		<div class="col-3 div-border-black text-right">
								            			<label class="">{{ isset($fee_package->tution_fee)?number_format($fee_package->tution_fee): '---' }}</label>
								            		</div>
								            	</div>
								            	<div class="row div-border-black">
								            		<div class="col-9 div-border-black">
								            			<label>Gross Fee Package</label>
								            		</div>
								            		<div class="col-3 div-border-black text-right">
								            			<label class="">{{ isset($fee_package->tution_fee)?number_format((int)$fee_package->tution_fee): '---' }}</label>
								            		</div>
								            	</div>
								            	<div class="row div-border-black">
								            		<div class="col-9 div-border-black">
								            			<label>Discount (In Amount)</label>
								            		</div>
								            		<div class="col-3 div-border-black text-right">
								            			<label class="">{{ isset($fee_package->discount)?number_format($fee_package->discount): '---' }}</label>
								            		</div>
								            	</div>
								            	<div class="row div-border-black">
								            		<div class="col-9 div-border-black">
								            			<label>Net Fee Package (After Discount)</label>
								            		</div>
								            		<div class="col-3 div-border-black text-right">
								            			<label class="">{{ isset($fee_package->net_total)?number_format($fee_package->net_total): '---' }}</label>
								            		</div>
								            	</div>
								            	<div class="row div-border-black">
								            		<div class="col-9 div-border-black">
								            			<label>Fee Received</label>
								            		</div>
								            		<div class="col-3 div-border-black text-right">
								            			<label class="">{{ isset($outstanding_clearance_section->tution_fee_received)?number_format($outstanding_clearance_section->tution_fee_received): '---' }}</label>
								            		</div>
								            	</div>
								            	<div class="row div-border-black">
							            			<div class="col-9 div-border-black">
								            			<label>Net Fee Receivable</label>
								            		</div>
							            			<div class="col-3 div-border-black text-right">
								            			<label class="">{{ number_format((isset($outstanding_clearance_section->current_tution_fee)?$outstanding_clearance_section->current_tution_fee:0) - (isset($outstanding_clearance_section->tution_fee_received)?$outstanding_clearance_section->tution_fee_received: 0)) }}</label>
								            		</div>
							            		</div>
					            			</div>
					            		</div>
					            	</div>
					            </div>
					        </div>
			            </div>
			            <div class="col-6">
					        <div class="card m-b-20">
					            <div class="card-body div-border-black">
					            	<div class="padding-10">
					            		<div class="row">
					            			<div class="col-12" id="overall_summary">
							            		<h4 style="margin-bottom: 0px;padding-bottom: 0px;line-height: 0px;">Over-All Summary:</h4><br><label>(Till {{ $clearance_date }})</label>
								            	<div class="row">
								            		<div class="col-9 div-border-black text-center">
								            			<strong>Description</strong>
								            		</div>
								            		<div class="col-3 div-border-black text-center">
									            		{{-- <strong>Due Amount</strong><br> --}}<label>Rs.</label>
								            		</div>
								            	</div>
								            	
								            	<div class="row div-border-black">
							            			<div class="col-9 div-border-black">
								            			<label>Fee Package Balance{{-- <br>(Till {{ $clearance_date }}) --}}</label>
								            		</div>
							            			<div class="col-3 div-border-black text-right">
								            			<label class="">{{ isset($outstanding_clearance_section->over_due_till_today)?number_format($outstanding_clearance_section->over_due_till_today): '---' }}</label>
								            		</div>
							            		</div>
							            		@if($student->student_category_id != 2)
									            	<div class="row div-border-black">
								            			<div class="col-9 div-border-black">
									            			<label>Overall Fine{{-- <br>(Till {{ $clearance_date }}) --}}</label>
									            		</div>
								            			<div class="col-3 div-border-black text-right">
									            			<label class="">{{ number_format(((isset($outstanding_clearance_section->total_fine_on_instalment)?$outstanding_clearance_section->total_fine_on_instalment:0) - ((isset($outstanding_clearance_section->total_installment_fine_paid)?$outstanding_clearance_section->total_installment_fine_paid:0) + (isset($outstanding_clearance_section->total_fine_adjustment_on_instalment)?$outstanding_clearance_section->total_fine_adjustment_on_instalment:0))) + (isset($outstanding_clearance_section->total_absent_fine_remaining)?$outstanding_clearance_section->total_absent_fine_remaining:0) + (isset($outstanding_clearance_section->total_exam_fail_fine)?$outstanding_clearance_section->total_exam_fail_fine:0) ) }}</label>
									            		</div>
								            		</div>
							            		@endif
								            	<div class="row div-border-black">
							            			<div class="col-9 div-border-black">
								            			<label>Transport Fee{{-- <br>(Till {{ $clearance_date }}) --}}</label>
								            		</div>
							            			<div class="col-3 div-border-black text-right">
								            			<label class="">{{ number_format((isset($outstanding_clearance_section->over_due_transport_till_today)?$outstanding_clearance_section->over_due_transport_till_today:0)) }}</label>
								            		</div>
							            		</div>
				        	            		@if($student->student_category_id != 2)
									            	<div class="row div-border-black">
								            			<div class="col-9 div-border-black">
									            			<label>Other Heads{{-- <br>(Till {{ $clearance_date }}) --}}</label>
									            		</div>
								            			<div class="col-3 div-border-black text-right">
									            			<label class="">{{ isset($outstanding_clearance_section->over_due_heads_till_today)?number_format($outstanding_clearance_section->over_due_heads_till_today): '---' }}</label>
									            		</div>
								            		</div>
								            	
									            	<div class="row div-border-black">
								            			<div class="col-9 div-border-black">
									            			<label>Total Due Amount{{-- <br>(Till {{ $clearance_date }}) --}}</label>
									            		</div>
								            			<div class="col-3 div-border-black text-right">
									            			<label class="">{{ number_format( ( isset($outstanding_clearance_section->over_due_till_today)?$outstanding_clearance_section->over_due_till_today: 0) + (isset($outstanding_clearance_section->over_due_heads_till_today)?$outstanding_clearance_section->over_due_heads_till_today: 0) + (isset($outstanding_clearance_section->over_due_transport_till_today)?$outstanding_clearance_section->over_due_transport_till_today: 0) + ((isset($outstanding_clearance_section->total_fine_on_instalment)?$outstanding_clearance_section->total_fine_on_instalment:0) - ((isset($outstanding_clearance_section->total_installment_fine_paid)?$outstanding_clearance_section->total_installment_fine_paid:0) + (isset($outstanding_clearance_section->total_fine_adjustment_on_instalment)?$outstanding_clearance_section->total_fine_adjustment_on_instalment:0))) + (isset($outstanding_clearance_section->total_absent_fine_remaining)?$outstanding_clearance_section->total_absent_fine_remaining:0) + (isset($outstanding_clearance_section->total_exam_fail_fine)?$outstanding_clearance_section->total_exam_fail_fine:0) ) }}</label>
									            		</div>
								            		</div>
							            		@endif
					            			</div>
					            		</div>
					            	</div>
					            </div>
					        </div>
			            </div>
			        </div>
			    </div>
            @endif
		</div>
		<script src="{{asset('assets/js/jquery.min.js')}}"></script>
		<script type="text/javascript">
			var height= $("#package_summary").height();
			$("#notes_border_div").css({height: (height - 32)});

		</script>
		@if($student->student_category_id != 2)
			<div class="row" id="section_instalment">
			    <div class="col-12">
			        <div class="card m-b-20">
			            <div class="card-body div-border-black">
			            	<div class="padding-10">
			            		<h4 class="margin-top-20 margin-bottom-20">Net Fee Installment Detail:</h4>
				            	<div class="row div-border-black margin-top-10 text-center">
				            		<div class="col-1 div-border-black">
				            			<strong>No.</strong>
				            		</div>
				            		<div class="col-1 div-border-black">
				            			<strong>Due Inst.</strong> <br><label>Rs.</label>
				            		</div>
				            		<div class="col-2 div-border-black">
				            			<strong>Due Date</strong>
				            		</div>
				            		<div class="col-1 div-border-black">
				            			<strong>Paid Inst.</strong> <br><label>Rs.</label>
				            		</div>
				            		<div class="col-2 div-border-black">
				            			<strong>Paid Date</strong>
				            		</div>
				            		<div class="col-1 div-border-black">
				            			<strong>V-No.</strong>
				            		</div>
				            		<div class="col-1 div-border-black">
				            			<strong>Bal. Due</strong> <br><label>Rs.</label>
				            		</div>
				            		<div class="col-2 div-border-black">
				            			<strong>Paid Date</strong>
				            		</div>
				            		<div class="col-1 div-border-black">
				            			<strong>V-No.</strong>
				            		</div>
				            	</div>
				            	@foreach($fee_package->feePackageInstallments()->get() as $key => $instalment)
					            	<div class="row div-border-black text-center">
					            		<div class="col-1 div-border-black">
					            			<label>{{$key+1}}</label>
					            		</div>
					            		<div class="col-1 div-border-black text-right">
					            			<label>{{ $instalment->amount_per_installment!=''?number_format($instalment->amount_per_installment): '---' }}</label>
					            		</div>
					            		<div class="col-2 div-border-black">
					            			<label>{{ $instalment->due_date!=''? date('d-M-Y', strtotime($instalment->due_date)): '---' }}</label>
					            		</div>
					            		<div class="col-1 div-border-black text-right">
					            			<label>{{ $instalment->paid_amount != '' ? ($instalment->fine_paid_date==''&&$instalment->late_fee_fine_voucher_code!=''?number_format(($instalment->paid_amount - $instalment->late_fee_fine)): $instalment->paid_amount) : '---' }}</label>
					            		</div>
					            		<div class="col-2 div-border-black">
					            			<label>{{ $instalment->paid_date!=''? date('d-M-Y', strtotime($instalment->paid_date)): '---' }}</label>
					            		</div>
					            		<div class="col-1 div-border-black">
					            			<label>{{ $instalment->voucher_code!=''?$instalment->voucher_code: '---' }}</label>
					            		</div>
					            		<div class="col-1 div-border-black text-right">
					            			<label>{{ $instalment->remaining_balance!=''?number_format($instalment->remaining_balance): '---' }}</label>
					            		</div>
					            		<div class="col-2 div-border-black">
					            			<label>{{ $instalment->remaining_balance_paid_date!=''?date('d-M-Y', strtotime($instalment->remaining_balance_paid_date)): '---' }}</label>
					            		</div>
					            		<div class="col-1 div-border-black">
					            			<label>{{ $instalment->remaining_balance_voucher_id!=''?$instalment->remaining_balance_voucher_id: '---' }}</label>
					            		</div>
					            	</div>
				            	@endforeach
			            	</div>
			            </div>
			        </div>
			        <div class="card m-b-20">
			            <div class="card-body div-border-black">
			            	<div class="padding-10">
				            	<div class="row">
								    <div class="col-6 ">
								        <h4 class="m-b-5 m-t-10">Other Heads Detail:</h4>
								        <table width="100%" border="1" cellpadding="0" cellspacing="1" bgcolor="#F2F2F2">
								          <thead>
								            <tr>
								              <th class="text-center">Name</th>
								              <th class="text-center">Due Amount</th>
								              {{-- <th class="text-center">Due Date</th> --}}
								              <th class="text-center">Paid Amount</th>
								              {{-- <th class="text-center">Paid Date</th> --}}
								            </tr>
								          </thead>
								          <tbody>
								            <tr>
								              <td class="text-center">Uniform</td>
								              <td class="text-center">{{ $student_heads->where('head_id', '=', 3)->sum('head_amount') + $student_heads->where('head_id', '=', 12)->sum('head_amount') + $student_heads->where('head_id', '=', 38)->sum('head_amount') + $student_heads->where('head_id', '=', 50)->sum('head_amount') }}</td>
								              {{-- <td class="text-center">20-jul-2019</td> --}}
								              <td class="text-center">{{ ($student_heads->where('head_id', '=', 3)->where('status_id', '=', 1)->sum('head_amount') + $student_heads->where('head_id', '=', 3)->where('status_id', '=', 2)->sum('paid_amount')) + ($student_heads->where('head_id', '=', 12)->where('status_id', '=', 1)->sum('head_amount') + $student_heads->where('head_id', '=', 12)->where('status_id', '=', 2)->sum('paid_amount')) + ($student_heads->where('head_id', '=', 38)->where('status_id', '=', 1)->sum('head_amount') + $student_heads->where('head_id', '=', 38)->where('status_id', '=', 2)->sum('paid_amount')) + ($student_heads->where('head_id', '=', 50)->where('status_id', '=', 1)->sum('head_amount') + $student_heads->where('head_id', '=', 50)->where('status_id', '=', 2)->sum('paid_amount')) }}</td>
								              {{-- <td class="text-center">20-jul-2019</td> --}}
								            </tr>
								            <tr>
								              <td class="text-center">Books</td>
								              <td class="text-center">{{ $student_heads->where('head_id', '=', 51)->sum('head_amount') }}</td>
								              {{-- <td class="text-center">20-jul-2019</td> --}}
								              <td class="text-center">{{ ($student_heads->where('head_id', '=', 51)->where('status_id', '=', 1)->sum('head_amount') + $student_heads->where('head_id', '=', 51)->where('status_id', '=', 2)->sum('paid_amount')) }}</td>
								              {{-- <td class="text-center">20-jul-2019</td> --}}
								            </tr>
								            <tr>
								              <td class="text-center">Stationary</td>
								              <td class="text-center">{{ $student_heads->where('head_id', '=', 7)->sum('head_amount') }}</td>
								              {{-- <td class="text-center">20-jul-2019</td> --}}
								              <td class="text-center">{{ ($student_heads->where('head_id', '=', 7)->where('status_id', '=', 1)->sum('head_amount') + $student_heads->where('head_id', '=', 7)->where('status_id', '=', 2)->sum('paid_amount')) }}</td>
								              {{-- <td class="text-center">20-jul-2019</td> --}}

								            </tr>
								            <tr>
								              <td class="text-center">Cards </td>
								              <td class="text-center">{{ $student_heads->where('head_id', '=', 4)->sum('head_amount') + $student_heads->where('head_id', '=', 49)->sum('head_amount') }}</td>
								              {{-- <td class="text-center">20-jul-2019</td> --}}
								              <td class="text-center">{{ ($student_heads->where('head_id', '=', 4)->where('status_id', '=', 1)->sum('head_amount') + $student_heads->where('head_id', '=', 4)->where('status_id', '=', 2)->sum('paid_amount')) + ($student_heads->where('head_id', '=', 49)->where('status_id', '=', 1)->sum('head_amount') + $student_heads->where('head_id', '=', 49)->where('status_id', '=', 2)->sum('paid_amount')) }}</td>
								              {{-- <td class="text-center">20-jul-2019</td> --}}

								            </tr>
								            <tr>
								              <td class="text-center">Adm & Reg </td>
								              <td class="text-center">{{ $student_heads->where('head_id', '=', 46)->sum('head_amount') + $student_heads->where('head_id', '=', 52)->sum('head_amount') }}</td>
								              {{-- <td class="text-center">20-jul-2019</td> --}}
								              <td class="text-center">{{ ($student_heads->where('head_id', '=', 46)->where('status_id', '=', 1)->sum('head_amount') + $student_heads->where('head_id', '=', 46)->where('status_id', '=', 2)->sum('paid_amount')) + ($student_heads->where('head_id', '=', 52)->where('status_id', '=', 1)->sum('head_amount') + $student_heads->where('head_id', '=', 52)->where('status_id', '=', 2)->sum('paid_amount')) }}</td>
								              {{-- <td class="text-center">20-jul-2019</td> --}}
								            </tr>
								            <tr>
								              <td class="text-center">Others </td>
								              <td class="text-center">{{ $student_heads->where('head_id', '!=', 3)->where('head_id', '!=', 12)->where('head_id', '!=', 38)->where('head_id', '!=', 50)->where('head_id', '!=', 51)->where('head_id', '!=', 7)->where('head_id', '!=', 4)->where('head_id', '!=', 49)->where('head_id', '!=', 46)->where('head_id', '!=', 52)->where('head_id', '!=', 6)->where('head_id', '!=', 48)->sum('head_amount') }}</td>
								              {{-- <td class="text-center">20-jul-2019</td> --}}
								              <td class="text-center">{{ ($student_heads->where('head_id', '!=', 3)->where('head_id', '!=', 12)->where('head_id', '!=', 38)->where('head_id', '!=', 50)->where('head_id', '!=', 51)->where('head_id', '!=', 7)->where('head_id', '!=', 4)->where('head_id', '!=', 49)->where('head_id', '!=', 46)->where('head_id', '!=', 52)->where('head_id', '!=', 6)->where('head_id', '!=', 48)->where('status_id', '=', 1)->sum('head_amount') + $student_heads->where('head_id', '!=', 3)->where('head_id', '!=', 12)->where('head_id', '!=', 38)->where('head_id', '!=', 50)->where('head_id', '!=', 51)->where('head_id', '!=', 7)->where('head_id', '!=', 4)->where('head_id', '!=', 49)->where('head_id', '!=', 46)->where('head_id', '!=', 52)->where('head_id', '!=', 6)->where('head_id', '!=', 48)->where('status_id', '=', 2)->sum('paid_amount')) }}</td>
								              {{-- <td class="text-center">20-jul-2019</td> --}}
								            </tr>
								          </tbody>
								        </table>
							        </div>
								    <div class="col-6 m-t-0 right"> 
								        <h4 class="m-b-5 m-t-10"> Transport And Fine Detail:</h4>
								        <table width="100%" border="1" cellpadding="0" cellspacing="1" bgcolor="#F2F2F2">
								          <thead>
								            <tr>
								              <th class="text-center">Name</th>
								              <th class="text-center">Due Amount</th>
								              {{-- <th class="text-center">Due Date</th> --}}
								              <th class="text-center">Paid Amount</th>
								              {{-- <th class="text-center">Paid Date</th> --}}
								            </tr>
								          </thead>
								          <tbody>
								            <tr>
								              <td class="text-center">Transport</td>
								              <td class="text-center">{{ isset($outstanding_clearance_section->total_transport_till_today)?number_format($outstanding_clearance_section->total_transport_till_today): 0 }}</td>
								              {{-- <td class="text-center">20-jul-2019</td> --}}
								              <td class="text-center">{{ isset($outstanding_clearance_section->total_transport_paid_till_today)?number_format($outstanding_clearance_section->total_transport_paid_till_today): 0 }}</td>
								              {{-- <td class="text-center">20-jul-2019</td> --}}
								            </tr>
								            <tr>
								              <td class="text-center">Late Fee Fine</td>
								              <td class="text-center">{{ isset($outstanding_clearance_section->total_fine_on_instalment)?number_format($outstanding_clearance_section->total_fine_on_instalment): 0 }}</td>
								              {{-- <td class="text-center">20-jul-2019</td> --}}
								              <td class="text-center">{{ isset($outstanding_clearance_section->total_installment_fine_paid)?number_format($outstanding_clearance_section->total_installment_fine_paid): 0 }}</td>
								              {{-- <td class="text-center">20-jul-2019</td> --}}
								            </tr>
								            <tr>
								              <td class="text-center">Exam Fine</td>
								              <td class="text-center">0</td>
								              {{-- <td class="text-center">20-jul-2019</td> --}}
								              <td class="text-center">0</td>
								              {{-- <td class="text-center">20-jul-2019</td> --}}
								            </tr>
								            <tr class="last_row_transport_detail" rowspan="2">
								              <td class="text-center">Absent Fine </td>
								              <td class="text-center">{{ isset($outstanding_clearance_section->total_absent_days_fine)?number_format($outstanding_clearance_section->total_absent_days_fine): 0 }}</td>
								              {{-- <td class="text-center">20-jul-2019</td> --}}
								              <td class="text-center">{{ number_format((isset($outstanding_clearance_section->total_absent_days_fine)?$outstanding_clearance_section->total_absent_days_fine: 0) - (isset($outstanding_clearance_section->total_absent_fine_remaining)?$outstanding_clearance_section->total_absent_fine_remaining: 0)) }}</td>
								              {{-- <td class="text-center">20-jul-2019</td> --}}
								            </tr>
								          </tbody>
								        </table>
								    </div>
							    </div>

			            	</div>
			            </div>
			        </div>
			    </div> <!-- end col -->
			</div> <!-- end row -->

			<div class="row  page-break" id="section_fine" style="margin-top: 2%;">
			    <div class="col-12">
			    	<div class="">
			        <div class="card m-b-20">
			            <div class="card-body div-border-black">
			            	<div class="padding-10">
			            		<h4>Late Net Fee Installment Fine Detail: <strong class="pull-right margin-bottom-30" style="font-size: 14px;">(Fine Per Day = 25)</strong></h4><br>

				            	<div class="row div-border-black text-center">
				            		<div class="col-2 div-border-black">
				            			<strong>Fine For <br>Inst. No.</strong>
				            		</div>
				            		<div class="col-1 div-border-black">
				            			<strong>No. of Days</strong>
				            		</div>
				            		<div class="col-2 div-border-black">
				            			<strong>Inst. Fine <br><label>Rs.</label></strong>
				            		</div>
				            		<div class="col-1 div-border-black">
				            			<strong>Adj. <br><label>Rs.</label></strong>
				            		</div>
				            		<div class="col-1 div-border-black">
				            			<strong>Paid Fine <br><label>Rs.</label></strong>
				            		</div>
				            		<div class="col-2 div-border-black">
				            			<strong>Paid Date</strong>
				            		</div>
				            		<div class="col-2 div-border-black">
				            			<strong>V-No.</strong>
				            		</div>
				            		<div class="col-1 div-border-black">
				            			<strong>Bal.<br>Inst. Fine <br><label>Rs.</label></strong>
				            		</div>{{-- 
				            		<div class="col-1 div-border-black">
				            			<strong>No. of Days</strong>
				            		</div>
				            		<div class="col-1 div-border-black">
				            			<strong>Adj. <br><label>Rs.</label></strong>
				            		</div>
				            		<div class="col-1 div-border-black">
				            			<strong>Paid Date</strong>
				            		</div>
				            		<div class="col-1 div-border-black">
				            			<strong>V-No.</strong>
				            		</div> --}}{{-- 
				            		<div class="col-1 div-border-black">
				            			<strong>Total Fine</strong>
				            		</div>
				            		<div class="col-1 div-border-black">
				            			<strong>Total Adjustment</strong>
				            		</div> --}}
				            	</div>
				            	@foreach($instalments as $key => $instalment)
				            		@if ($instalment->feeFines()->get()->count() > 0)
						            	@foreach($instalment->feeFines()->get() as $fine_count => $fee_fine)
							            	<div class="row {{$fine_count==0?'div-border-black': ''}} text-center" style="margin-top: 2px;margin-bottom: 2px;">
							            		<div class="col-2 {{$fine_count==0?'div-border-black': ''}} ">
							            			<label>{{ $fine_count==0?$key+1 : ''}}</label>
							            		</div>
							            		<div class="col-1 {{$fine_count==0?'div-border-black': ''}} ">
							            			<label>{{ $fine_count==0?($instalment->late_fine_days_for!=''?number_format($instalment->late_fine_days_for): '---'): '' }}</label>
							            		</div>
							            		<div class="col-2 div-border-black text-right">
							            			<label>{{ $fee_fine->amount!=''?number_format($fee_fine->amount): '---' }}</label>
							            		</div>
							            		<div class="col-1 div-border-black text-right">
							            			<label>{{ $fee_fine->amount_waived != '' ? number_format($fee_fine->amount_waived) : '---' }}</label>
							            		</div>
							            		<div class="col-1 div-border-black text-right">
							            			<label>{{ $fee_fine->paid_amount != '' ? number_format($fee_fine->paid_amount) : '---' }}</label>
							            		</div>
							            		<div class="col-2 div-border-black">
							            			<label>{{ $fee_fine->paid_date != ''? date('M Y', strtotime($fee_fine->paid_date)): '---' }}</label>
							            		</div>
							            		<div class="col-2 div-border-black">
							            			<label>{{ $fee_fine->voucher_number != '' ? $fee_fine->voucher_number : '---' }}</label>
							            		</div>
							            		<div class="col-1 div-border-black text-right">
							            			<label>{{ $fee_fine->balance != '' ? number_format($fee_fine->balance) : '---' }}</label>
							            			{{-- <label>{{ $instalment->late_fee_fine + $instalment->remaining_balance_late_fine }}</label> --}}
							            		</div>{{-- 
							            		<div class="col-1 div-border-black">
							            			<label>{{ $instalment->remaining_balance_late_fine_days_for != '' ? number_format($instalment->remaining_balance_late_fine_days_for): '---' }}</label>
							            		</div>
							            		<div class="col-1 div-border-black text-right">
							            			<label>{{ $instalment->remaining_balance_fine_waived != '' ? number_format($instalment->remaining_balance_fine_waived) : '---' }}</label>
							            		</div>
							            		<div class="col-1 div-border-black">
							            			<label>{{ $instalment->r_b_late_fee_fine_voucher_code != '' ? date('d-M-Y', strtotime($instalment->remaining_balance_paid_date)) : '---' }}</label>
							            		</div>
							            		<div class="col-1 div-border-black">
							            			<label>{{ $instalment->r_b_late_fee_fine_voucher_code != '' ? $instalment->r_b_late_fee_fine_voucher_code : '---' }}</label>
							            		</div> --}}
							            	</div>
						            	@endforeach
				            		@else
				            			@if ($instalment->status_id == '0')
				            				<div class="row div-border-black text-center">
							            		<div class="col-2 div-border-black">
							            			<label>{{$key+1}}</label>
							            		</div>
							            		<div class="col-1 div-border-black">
							            			<label>{{ $instalment->late_fine_days_for!=''?number_format($instalment->late_fine_days_for): '---' }}</label>
							            		</div>
							            		<div class="col-2 div-border-black text-right">
							            			<label>{{ $instalment->late_fee_fine!=''?number_format($instalment->late_fee_fine): '---' }}</label>
							            		</div>
							            		<div class="col-1 div-border-black text-right">
							            			<label>{{ '---' }}</label>
							            		</div>
							            		<div class="col-1 div-border-black text-right">
							            			<label>{{ '---' }}</label>
							            		</div>
							            		<div class="col-2 div-border-black">
							            			<label>{{ '---' }}</label>
							            		</div>
							            		<div class="col-2 div-border-black">
							            			<label>{{ '---' }}</label>
							            		</div>
							            		<div class="col-1 div-border-black text-right">
							            			<label>{{ '---' }}</label>
							            			{{-- <label>{{ $instalment->late_fee_fine + $instalment->remaining_balance_late_fine }}</label> --}}
							            		</div>
							            	</div>
				            			@elseif ($instalment->status_id == '1')
							            	<div class="row div-border-black text-center">
							            		<div class="col-2 div-border-black">
							            			<label>{{$key+1}}</label>
							            		</div>
							            		<div class="col-1 div-border-black">
							            			<label>{{ '---' }}</label>
							            		</div>
							            		<div class="col-2 div-border-black text-right">
							            			<label>{{ '---' }}</label>
							            		</div>
							            		<div class="col-1 div-border-black text-right">
							            			<label>{{ '---' }}</label>
							            		</div>
							            		<div class="col-1 div-border-black text-right">
							            			<label>{{ '---' }}</label>
							            		</div>
							            		<div class="col-2 div-border-black">
							            			<label>{{ '---' }}</label>
							            		</div>
							            		<div class="col-2 div-border-black">
							            			<label>{{ '---' }}</label>
							            		</div>
							            		<div class="col-1 div-border-black text-right">
							            			<label>{{ '---' }}</label>
							            			{{-- <label>{{ $instalment->late_fee_fine + $instalment->remaining_balance_late_fine }}</label> --}}
							            		</div>
							            	</div>
				            			@elseif ($instalment->status_id == '2')
				            				<div class="row div-border-black text-center">
							            		<div class="col-2 div-border-black">
							            			<label>{{$key+1}}</label>
							            		</div>
							            		<div class="col-1 div-border-black">
							            			<label>{{ $instalment->remaining_balance_late_fine_days_for!=''?number_format($instalment->remaining_balance_late_fine_days_for): '---' }}</label>
							            		</div>
							            		<div class="col-2 div-border-black text-right">
							            			<label>{{ $instalment->remaining_balance_late_fine!=''?number_format($instalment->remaining_balance_late_fine): '---' }}</label>
							            		</div>
							            		<div class="col-1 div-border-black text-right">
							            			<label>{{ '---' }}</label>
							            		</div>
							            		<div class="col-1 div-border-black text-right">
							            			<label>{{ '---' }}</label>
							            		</div>
							            		<div class="col-2 div-border-black">
							            			<label>{{ '---' }}</label>
							            		</div>
							            		<div class="col-2 div-border-black">
							            			<label>{{ '---' }}</label>
							            		</div>
							            		<div class="col-1 div-border-black text-right">
							            			<label>{{ '---' }}</label>
							            			{{-- <label>{{ $instalment->late_fee_fine + $instalment->remaining_balance_late_fine }}</label> --}}
							            		</div>
							            	</div>
				            			@endif
				            		@endif
				            	@endforeach
				            	<div class="row margin-top-10">
				            		<div class="col-12 text-right">
				            			<strong>Total Fine (Till {{ $clearance_date }})</strong>
				            			Rs.
				            			<label>{{ isset($outstanding_clearance_section->total_fine_on_instalment)?number_format($outstanding_clearance_section->total_fine_on_instalment): '---' }}</label>
				            			-
				            			<strong>Previous Total Adjustment</strong>
				            			Rs.
				            			<label>{{ isset($outstanding_clearance_section->total_fine_adjustment_on_instalment)?number_format($outstanding_clearance_section->total_fine_adjustment_on_instalment): '---' }}</label>
				            			=
				            			<strong>Actual Fine Receivable</strong>
				            			Rs.
				            			@if ($outstanding_clearance_section->total_fine_on_instalment!=0)
					            			<label>{{ number_format((isset($outstanding_clearance_section->total_fine_on_instalment)?$outstanding_clearance_section->total_fine_on_instalment:0) - (isset($outstanding_clearance_section->total_fine_adjustment_on_instalment)?$outstanding_clearance_section->total_fine_adjustment_on_instalment: 0)) }}</label>
				            			@else
				            			<label>0</label>
				            			@endif
				            		</div>
				            	</div>
			            	</div>
			            </div>
			        </div>
			    </div> <!-- end col -->
			    </div> <!-- end positioning Class -->
			</div> <!-- end row -->

		@endif
		<div class="row">
		    <div class="col-12">
		        <div class="card m-b-20">
		            <div class="card-body div-border-black">
		            	<div class="padding-10">
		            		<h4>Absent Fine Detail: <strong class="pull-right margin-bottom-30" style="font-size: 14px;">(Fine Per Day = 200)</strong></h4><br>
	                        <div class="card-content">
	                        	<div class="row div-border-black text-center">
				            		<div class="col-2 div-border-black">
				            			<strong>Month</strong>
				            		</div>
				            		<div class="col-2 div-border-black">
				            			<strong>Absent Dates</strong>
				            		</div>
				            		<div class="col-1 div-border-black">
				            			<strong>Absent Days</strong>
				            		</div>
				            		<div class="col-1 div-border-black">
			            			<strong>Fine <br><label>Rs.</label></strong>
				            		</div>
				            		<div class="col-1 div-border-black">
				            			<strong>Adj. <br><label>Rs.</label></strong>
				            		</div>
				            		<div class="col-1 div-border-black">
				            			<strong>Paid. <br><label>Rs.</label></strong>
				            		</div>
				            		<div class="col-2 div-border-black">
				            			<strong>Paid Date</strong>
				            		</div>
				            		<div class="col-1 div-border-black">
				            			<strong>V-No.</strong>
				            		</div>
				            		<div class="col-1 div-border-black">
				            			<strong>Balance</strong>
				            		</div>
				            	</div>

	                            @foreach ($student->attendance_fines as $key => $array)
	                            	@foreach ($array['fine_nodes'] as $node_key => $node)
			                        	<div class="row div-border-black text-center">
						            		<div class="col-2 {{ $node_key==0?'div-border-black':'' }}">
						            			<label>{{ $node_key==0?$array['month_of']:'' }}</label>
						            		</div>
						            		<div class="col-2 {{ $node_key==0?'div-border-black':'' }}">
						            			@if ($node_key==0)
							            			<label>
							            				@foreach ($node->absent_days as $value)
								            				@if (date('M', strtotime($node->from_date)) == date('M', strtotime($node->to_date)))
										            			{{ date('d', strtotime($value['date'])) }},
										            		@else
										            			{{ date('M d', strtotime($value['date'])) }},
									            			@endif
			                                            @endforeach
			                                        </label>
		                                        @else
		                                        	{{''}}
						            			@endif
						            		</div>
						            		<div class="col-1 {{ $node_key==0?'div-border-black':'' }}">
						            			@if ($node_key==0)
							            			<label>{{ $node->absent_count }}</label>
		                                        @else
		                                        	{{''}}
						            			@endif
						            		</div>
						            		<div class="col-1 div-border-black">
						            			<label>{{ number_format($node->amount) }}   </label>
						            		</div>
						            		<div class="col-1 div-border-black">
						            			<label>{{ number_format($node->amount_waived) }}</label>
						            		</div>
						            		<div class="col-1 div-border-black">
						            			<label>{{ number_format($node->paid_amount) }}</label>
						            		</div>
						            		<div class="col-2 div-border-black">
						            			<label>{{ $node->paid_date!=null?date('d-M-Y', strtotime($node->paid_date)):'---' }}</label>
						            		</div>
						            		<div class="col-1 div-border-black">
						            			<label>{{ $node->paid_date!=null?$node->voucher_number:'---' }}</label>
						            		</div>
						            		<div class="col-1 div-border-black">
						            			<label>{{ number_format($node->balance) }}</label>
						            		</div>
					            		</div>
	                            	@endforeach
			            		@endforeach
				            	<div class="row margin-top-10">
				            		<div class="col-12 text-right">
				            			<strong>Total Absent Days (Till {{ $clearance_date }}): </strong>
				            			
				            			<label>{{ isset($outstanding_clearance_section->total_absent_days)?number_format($outstanding_clearance_section->total_absent_days): '---' }}</label> Days
				            			<br>
				            			<strong>Total Absent Fine: </strong>
				            	
				            			<label>Rs. {{ isset($outstanding_clearance_section->total_absent_days_fine)?number_format($outstanding_clearance_section->total_absent_days_fine): '---' }}</label>
				            			<br>

				            			<strong>Total Absent Fine Remaining: </strong>
				            	
				            			<label>Rs. {{ isset($outstanding_clearance_section->total_absent_fine_remaining)?number_format($outstanding_clearance_section->total_absent_fine_remaining): '---' }}</label>
				            		</div>
				            	</div>
	                        </div>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
		<div class="row {{ $student->student_category_id!=2?'page-break':'' }}">
		    <div class="col-12">
		        <div class="card m-b-20">
		            <div class="card-body div-border-black">
		            	<div class="padding-10">
		            		<h4>Exam Fine Detail: <strong class="pull-right margin-bottom-30" style="font-size: 14px;">(Fine Per Subject = 200)</strong></h4><br>
	                        <div class="card-content">
	                        	<div class="row div-border-black text-center">
				            		<div class="col-2 div-border-black">
				            			<strong>Exam-Types</strong>
				            		</div>
				            		<div class="col-2 div-border-black">
				            			<strong>Failure Subjects</strong>
				            		</div>
				            		<div class="col-1 div-border-black">
				            			<strong>No. of Subjects Fail</strong>
				            		</div>
				            		<div class="col-2 div-border-black">
			            			<strong>Fine <br><label>Rs.</label></strong>
				            		</div>
				            		<div class="col-1 div-border-black">
				            			<strong>Adj. <br><label>Rs.</label></strong>
				            		</div>
				            		<div class="col-2 div-border-black">
				            			<strong>Paid. <br><label>Rs.</label></strong>
				            		</div>
				            		<div class="col-1 div-border-black">
				            			<strong>Paid Date</strong>
				            		</div>
				            		<div class="col-1 div-border-black">
				            			<strong>Balance<br><label>Rs.</label></strong>
				            		</div>
				            	</div>

	                            @foreach ($student->exam_fines  as $key => $data)
		                            @foreach ($data['failure_fine_details']  as $fine_key => $detail)
			                            @foreach ($detail['fine_nodes']  as $fine_node_key => $fine)
				                        	<div class="row div-border-black text-center">
							            		<div class="col-2  {{$fine_node_key==0?'div-border-black': ''}} ">
								            		@if ($fine_node_key==0)
								            			<label> {{$data['exam_type_name']}}</label>
							            			@endif
							            		</div>
							            		<div class="col-2   {{$fine_node_key==0?'div-border-black': ''}} ">
								            		@if ($fine_node_key==0)
								            			<label>
								            				@foreach ($data['failure_subjects'] as $value)
				                                                {{ ucfirst($value['subject_name']) }},
				                                            @endforeach
				                                        </label>
									            	@else
									            		{{''}}
								            		@endif
							            		</div>
							            		<div class="col-1   {{$fine_node_key==0?'div-border-black': ''}} ">
								            		@if($fine_node_key==0)
								            			<label>{{ count($data['failure_subjects']) }}</label>
								            		@else
									            		{{''}}
								            		@endif
							            		</div>
							            		<div class="col-2 div-border-black">
								            			<label>{{ number_format($fine['amount']) }}   </label>
							            		</div>
							            		<div class="col-1 div-border-black">
							            			<label>{{ $fine['amount_waived']!=null?number_format($fine['amount_waived']):'---' }}</label>
							            		</div>
							            		<div class="col-2 div-border-black">
							            			<label>{{ $fine['paid_amount']!=null?number_format($fine['paid_amount']):'---' }}</label>
							            		</div>
							            		<div class="col-1 div-border-black">
							            			<label>{{ $fine['paid_date']!=null?date('d-M-Y', strtotime($fine['paid_date'])):'---' }}</label>
							            		</div>
							            		<div class="col-1 div-border-black">
							            			<label>{{ $fine['balance']!=null?number_format($fine['balance']):'---' }}</label>
							            		</div>
						            		</div>
					            		@endforeach
				            		@endforeach
			            		@endforeach
				            	<div class="row margin-top-10">
				            		<div class="col-12 text-right">
				            			<strong>Total Failure Subjects: </strong>
				            			
				            			<label>{{ isset($outstanding_clearance_section->total_subject_fail)?number_format($outstanding_clearance_section->total_subject_fail): '---' }}</label> Subjects
				            			<br>
				            			<strong>Total Exam Fine: </strong>
				            	
				            			<label>Rs. {{ isset($outstanding_clearance_section->total_exam_fail_fine)?number_format($outstanding_clearance_section->total_exam_fail_fine): '---' }}</label>
				            		</div>
				            	</div>
	                        </div>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
		@if($student->student_category_id != 2)
			<div class="row  {{ $student->student_category_id==2?'page-break':'' }}" id="section_heads" style="margin-top: 2%;">
			    <div class="col-12">
			        <div class="card m-b-20">
			            <div class="card-body div-border-black">
			        		<div class="padding-10">
				        		<h4>Other Heads Detail:</h4><br>
				            	<div class="row div-border-black text-center">
				            		<div class="col-1 div-border-black">
				            			<strong>No.</strong>
				            		</div>
				            		<div class="col-3 div-border-black">
				            			<strong>Head Name</strong>
				            		</div>
				            		<div class="col-1 div-border-black">
				            			<strong>Due <br><label>Rs.</label></strong>
				            		</div>
				            		<div class="col-1 div-border-black">
				            			<strong>Due Date</strong>
				            		</div>
				            		<div class="col-1 div-border-black">
				            			<strong>Paid <br><label>Rs.</label></strong>
				            		</div>
				            		<div class="col-1 div-border-black">
				            			<strong>Paid Date</strong>
				            		</div>
				            		<div class="col-1 div-border-black">
				            			<strong>V-No.</strong>
				            		</div>
				            		<div class="col-1 div-border-black">
				            			<strong>Balance <br><label>Rs.</label></strong>
				            		</div>
				            		<div class="col-1 div-border-black">
				            			<strong>Paid Date</strong>
				            		</div>
				            		<div class="col-1 div-border-black">
				            			<strong>V-No.</strong>
				            		</div>
				            	</div>
				            	@foreach($student_heads as $key => $head_fine)
					            	<div class="row div-border-black text-center">
					            		<div class="col-1 div-border-black">
					            			{{ $key+1 }}
					            		</div>
					            		<div class="col-3 div-border-black text-left">
					            			{{ !$head_fine->headFine()->get()->isEmpty()?$head_fine->headFine()->get()->first()->name:'---' }}
					            		</div>
					            		<div class="col-1 div-border-black text-right">
					            			<label>{{ $head_fine->head_amount!=''?number_format($head_fine->head_amount): number_format(!$head_fine->headFine()->get()->isEmpty()?$head_fine->headFine()->get()->first()->amount:0) }}</label>
					            		</div>
					            		<div class="col-1 div-border-black">
					            			<label>{{ $head_fine->due_date!=''? date('d-M-Y', strtotime($head_fine->due_date)): '---' }}</label>
					            		</div>
					            		<div class="col-1 div-border-black text-right">
					            			<label>{{ $head_fine->status_id!=0&&$head_fine->paid_amount==''?number_format(!$head_fine->headFine()->get()->isEmpty()?$head_fine->headFine()->get()->first()->amount:0): ($head_fine->paid_amount!=''?number_format($head_fine->paid_amount): '---') }}</label>
					            		</div>
					            		<div class="col-1 div-border-black">
					            			<label>{{ $head_fine->paid_date!=''? date('d-M-Y', strtotime($head_fine->paid_date)): '---' }}</label>
					            		</div>
					            		<div class="col-1 div-border-black">
					            			<label>{{ $head_fine->voucher_code!=''&&$head_fine->status_id!=0?$head_fine->voucher_code: '---' }}</label>
					            		</div>
					            		<div class="col-1 div-border-black text-right">
					            			<label>{{ $head_fine->remaining_balance!=''?number_format($head_fine->remaining_balance): '---' }}</label>
					            		</div>
					            		<div class="col-1 div-border-black">
					            			<label>{{ $head_fine->remaining_balance_paid_date!=''? date('d-M-Y', strtotime($head_fine->remaining_balance_paid_date)): '---' }}</label>
					            		</div>
					            		<div class="col-1 div-border-black">
					            			<label>{{ $head_fine->remaining_balance_voucher_id!=''?$head_fine->remaining_balance_voucher_id: '---' }}</label>
					            		</div>
					            	</div>
					            @endforeach
				            </div>
			            </div>
			        </div>
			    </div> <!-- end col -->
			</div> <!-- end row -->
		@endif
	@else
		@include('includes.not_found_red')
	@endif
	<div class="row footer-print" id="section_footer">
	    <div class="col-12">
	        <div class="card m-b-20">
	            <div class="card-body">
		           <div class="text-center padding-10">
	        			<p class="footer-font-size">
	        			<strong>Note: </strong>This is a computer-generated <strong>Clearance Slip</strong>. No signature is required.<br>
	        			For Any Querry Please Visit <strong>Operations Office</strong>.<br>
	            		<strong>Address: </strong>5 - Babar Block, New Garden Town, Lahore, Punjab<br>
			            <strong>Ph: </strong>042 - 35858400 , 35858500</strong></p>

		           </div>
	            </div>
	        </div>
	    </div> <!-- end col -->
	</div> <!-- end row -->
</div>
<script src="{{asset('js/accounts/summary.js')}}"></script>