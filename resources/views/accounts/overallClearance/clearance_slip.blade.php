
  <div class="pdf-header-wrapper">
    <div class="headerleft m-t-10">
      <h5 class="m-0">Father's Name:<span class="headervalue">{{ $student->father_name }}</span></h5>
      <h5 class="m-0">Student Category:<span class="headervalue">{{ config('constants.student_categories')[$student->student_category_id] }}</span></h5>
      <h5 class="m-0">Admission Date:<span class="headervalue">{{ $student->admission_date }}</span></h5>
      
      <h5 class="m-0">Student Status:<span class="headervalue"> {{$student->is_end_of_reg==true?'Dropped At('. $student->reason_end_of_reg . ')':'Active'}}</span></h5>
      <h5 class="m-0">Shift:<span class="headervalue">{{ $student->shift }}</span></h5>
      <h5 class="m-0">Student Cell #:<span class="headervalue"> {{$student->student_cell_no }}</span></h5>
          <h5 class="m-0">Father Cell #:<span class="headervalue">{{ $student->father_cell_no }}</span></h5>
    </div>
    <div class="headercenter m-t-10"> 
      <h3 class="m-0">CFE College of Commerce & Sciences</h3>
      <div class="clearenceslip">
        <h4 class="m-0">CLEARANCE SLIP</h4>
      </div>
      <strong class="m-0" style="margin-top: -50px;">As On: {{ $clearance_date }}</strong>
      <h3 class="m-0">{{ $student->student_name }}</h3>
    </div>
    <div class="headerright m-t-10">
        <h5 class="m-0">Session:<span class="headervalue">{{ $student->session_name }}</span></h5>
        <h5 class="m-0">New Roll No:<span class="headervalue"> {{ $student->roll_no }}</span></h5>
        <h5 class="m-0">Old Roll No:<span class="headervalue">{{ $student->old_roll_no }}</span></h5>
        <h5 class="m-0">Course Name:<span class="headervalue">{{ $student->course_name }}</span></h5>
        <h5 class="m-0">Section:<span class="headervalue">{{ $student->section_name }}</span></h5>
    </div>
  </div>
  <div class="studentDetailBody">
    <div class="feepackageDetail left">
      <h4 class="m-b-10 m-t-0">Fee Package Detail (Part 1):</h4>
      <table class="fee_package_tbl" width="100%" border="1" cellpadding="0" cellspacing="1" bgcolor="#F2F2F2">
        <thead>
          <tr>
            <th align="left">Description</th>
            <th align="left">RS</th>
          </tr>
        </thead>
        <tbody>
        	@if ($year_count == 2)
	          <tr>
	            <td>Previous Year Outstanding Balance</td>
	            <td>{{ isset($outstanding_clearance_section->outstanding_balance)?number_format($outstanding_clearance_section->outstanding_balance): '---' }}</td>
	          </tr>
	          <tr>
	            <td>Admission Fee</td>
	            <td>{{ isset($fee_package->admission_fee)?number_format($fee_package->admission_fee): '---' }}</td>
	          </tr>
        	@endif

	          <tr>
	            <td>Tution Fee</td>
	            <td>{{ isset($fee_package->tution_fee)?number_format($fee_package->tution_fee): '---' }}</td>
	          </tr>
	          <tr>
	            <td>Gross Fee Package</td>
	            <td>{{ isset($fee_package->tution_fee)?number_format((int)$fee_package->tution_fee): '---' }}</td>
	          </tr>
	          <tr>
	            <td>Discount (In Amount)</td>
	            <td>{{ isset($fee_package->discount)?number_format($fee_package->discount): '---' }}</td>
	          </tr>
	          <tr>
	            <td>Net Fee Package (After Discount)</td>
	            <td>{{ isset($fee_package->net_total)?number_format($fee_package->net_total): '---' }}</td>
	          </tr>
	          <tr>
	            <td>Fee Received</td>
	            <td>{{ isset($outstanding_clearance_section->tution_fee_received)?number_format($outstanding_clearance_section->tution_fee_received): '---' }}</td>
	          </tr>
	          <tr>
	            <td>Net Fee Receivable </td>
	            <td>{{ number_format((isset($outstanding_clearance_section->current_tution_fee)?$outstanding_clearance_section->current_tution_fee:0) - (isset($outstanding_clearance_section->tution_fee_received)?$outstanding_clearance_section->tution_fee_received: 0)) }}</td>
	          </tr>
        </tbody>
      </table>
    </div>
    <div class="overallSummary right">
      <h4 class="m-0">Over-All Summary:</h4>
      <div class="headervalue m-b-5 m-t-0"> (Till Saturday 07-Dce-2019)</div>
      <table width="100%" border="1" cellpadding="0" cellspacing="1" bgcolor="#F2F2F2">
        <thead>
          <tr>
            <th align="left">Description</th>
            <th align="left">RS</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Fee Package Balanace</td>
            <td>{{ isset($outstanding_clearance_section->over_due_till_today)?number_format($outstanding_clearance_section->over_due_till_today): '---' }}</td>
          </tr>
          <tr>
            <td>Overall Fine</td>
            <td>{{ number_format(((isset($outstanding_clearance_section->total_fine_on_instalment)?$outstanding_clearance_section->total_fine_on_instalment:0) - ((isset($outstanding_clearance_section->total_installment_fine_paid)?$outstanding_clearance_section->total_installment_fine_paid:0) + (isset($outstanding_clearance_section->total_fine_adjustment_on_instalment)?$outstanding_clearance_section->total_fine_adjustment_on_instalment:0))) + (isset($outstanding_clearance_section->total_absent_fine_remaining)?$outstanding_clearance_section->total_absent_fine_remaining:0) + (isset($outstanding_clearance_section->total_exam_fail_fine)?$outstanding_clearance_section->total_exam_fail_fine:0) ) }}</td>
          </tr>
          <tr>
            <td>Transport Fee</td>
            <td>{{ number_format((isset($outstanding_clearance_section->over_due_transport_till_today)?$outstanding_clearance_section->over_due_transport_till_today:0)) }}</td>
          </tr>
          <tr>
            <td>Other Heads</td>
            <td>{{ isset($outstanding_clearance_section->over_due_heads_till_today)?number_format($outstanding_clearance_section->over_due_heads_till_today): '---' }}</td>
          </tr>
          <tr class="last_row">
            <td> Total Due Amount </td>
            <td>{{ number_format( ( isset($outstanding_clearance_section->over_due_till_today)?$outstanding_clearance_section->over_due_till_today: 0) + (isset($outstanding_clearance_section->over_due_heads_till_today)?$outstanding_clearance_section->over_due_heads_till_today: 0) + (isset($outstanding_clearance_section->over_due_transport_till_today)?$outstanding_clearance_section->over_due_transport_till_today: 0) + ((isset($outstanding_clearance_section->total_fine_on_instalment)?$outstanding_clearance_section->total_fine_on_instalment:0) - ((isset($outstanding_clearance_section->total_installment_fine_paid)?$outstanding_clearance_section->total_installment_fine_paid:0) + (isset($outstanding_clearance_section->total_fine_adjustment_on_instalment)?$outstanding_clearance_section->total_fine_adjustment_on_instalment:0))) + (isset($outstanding_clearance_section->total_absent_fine_remaining)?$outstanding_clearance_section->total_absent_fine_remaining:0) + (isset($outstanding_clearance_section->total_exam_fail_fine)?$outstanding_clearance_section->total_exam_fail_fine:0) ) }}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="netFeeIns m-t-10">
      <h4 class="m-0 m-b-10">Net Fee Installment Detail:</h4>
      <table width="100%" border="1" cellpadding="0" cellspacing="1" bgcolor="#F2F2F2">
        <thead>
          <tr>
            <th align="center">No.</th>
            <th align="center">Due Inst. <br>Rs.</th>
            <th align="center">Due Date</th>
            <th align="center">Paid Inst. <br>Rs.</th>
            <th align="center">Paid Date</th>
            <th align="center">V-No.</th>
            <th align="center">Bal. Due<br>Rs.</th>
            <th align="center">Paid Date</th>
            <th align="center">V-No.</th>
          </tr>
        </thead>
        <tbody>
        	@foreach($instalments as $key => $instalment)
	          <tr>
	            <td>{{$key+1}}</td>
	            <td>{{ $instalment->amount_per_installment!=''?number_format($instalment->amount_per_installment): '---' }}</td>
	            <td>{{ $instalment->due_date!=''? date('d-M-Y', strtotime($instalment->due_date)): '---' }}</td>
	            <td>{{ $instalment->paid_amount != '' ? ($instalment->fine_paid_date==''&&$instalment->late_fee_fine_voucher_code!=''?number_format(($instalment->paid_amount - $instalment->late_fee_fine)): $instalment->paid_amount) : '---' }}</td>
	            <td>{{ $instalment->paid_date!=''? date('d-M-Y', strtotime($instalment->paid_date)): '---' }}</td>
	            <td>{{ $instalment->voucher_code!=''?$instalment->voucher_code: '---' }}</td>
	            <td>{{ $instalment->remaining_balance!=''?number_format($instalment->remaining_balance): '---' }}</td>
	            <td>{{ $instalment->remaining_balance_paid_date!=''?date('d-M-Y', strtotime($instalment->remaining_balance_paid_date)): '---' }}</td>
	            <td>{{ $instalment->remaining_balance_voucher_id!=''?$instalment->remaining_balance_voucher_id: '---' }}</td>
	          </tr>
	          @endforeach
        </tbody>
      </table>
    </div>
    <div class="otherHeads">
      <div class="feepackageDetail m-t-0 left">
      <h4 class="m-b-5 m-t-10"> Other Heads Detail:</h4>
        <table width="100%" border="1" cellpadding="0" cellspacing="1" bgcolor="#F2F2F2">
          <thead>
            <tr>
              <th align="left">Name</th>
              <th align="left">Due Amount</th>
              {{-- <th align="left">Due Date</th> --}}
              <th align="left">Paid Amount</th>
              {{-- <th align="left">Paid Date</th> --}}
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Uniform</td>
              <td>{{ $student_heads->where('head_id', '=', 3)->sum('head_amount') + $student_heads->where('head_id', '=', 12)->sum('head_amount') + $student_heads->where('head_id', '=', 38)->sum('head_amount') + $student_heads->where('head_id', '=', 50)->sum('head_amount') }}</td>
              {{-- <td>20-jul-2019</td> --}}
              <td>{{ ($student_heads->where('head_id', '=', 3)->where('status_id', '=', 1)->sum('head_amount') + $student_heads->where('head_id', '=', 3)->where('status_id', '=', 2)->sum('paid_amount')) + ($student_heads->where('head_id', '=', 12)->where('status_id', '=', 1)->sum('head_amount') + $student_heads->where('head_id', '=', 12)->where('status_id', '=', 2)->sum('paid_amount')) + ($student_heads->where('head_id', '=', 38)->where('status_id', '=', 1)->sum('head_amount') + $student_heads->where('head_id', '=', 38)->where('status_id', '=', 2)->sum('paid_amount')) + ($student_heads->where('head_id', '=', 50)->where('status_id', '=', 1)->sum('head_amount') + $student_heads->where('head_id', '=', 50)->where('status_id', '=', 2)->sum('paid_amount')) }}</td>
              {{-- <td>20-jul-2019</td> --}}
            </tr>
            <tr>
              <td>Books</td>
              <td>{{ $student_heads->where('head_id', '=', 51)->sum('head_amount') }}</td>
              {{-- <td>20-jul-2019</td> --}}
              <td>{{ ($student_heads->where('head_id', '=', 51)->where('status_id', '=', 1)->sum('head_amount') + $student_heads->where('head_id', '=', 51)->where('status_id', '=', 2)->sum('paid_amount')) }}</td>
              {{-- <td>20-jul-2019</td> --}}
            </tr>
            <tr>
              <td>Stationary</td>
              <td>{{ $student_heads->where('head_id', '=', 7)->sum('head_amount') }}</td>
              {{-- <td>20-jul-2019</td> --}}
              <td>{{ ($student_heads->where('head_id', '=', 7)->where('status_id', '=', 1)->sum('head_amount') + $student_heads->where('head_id', '=', 7)->where('status_id', '=', 2)->sum('paid_amount')) }}</td>
              {{-- <td>20-jul-2019</td> --}}

            </tr>
            <tr>
              <td>Cards </td>
              <td>{{ $student_heads->where('head_id', '=', 4)->sum('head_amount') + $student_heads->where('head_id', '=', 49)->sum('head_amount') }}</td>
              {{-- <td>20-jul-2019</td> --}}
              <td>{{ ($student_heads->where('head_id', '=', 4)->where('status_id', '=', 1)->sum('head_amount') + $student_heads->where('head_id', '=', 4)->where('status_id', '=', 2)->sum('paid_amount')) + ($student_heads->where('head_id', '=', 49)->where('status_id', '=', 1)->sum('head_amount') + $student_heads->where('head_id', '=', 49)->where('status_id', '=', 2)->sum('paid_amount')) }}</td>
              {{-- <td>20-jul-2019</td> --}}

            </tr>
            <tr>
              <td>Adm & Reg </td>
              <td>{{ $student_heads->where('head_id', '=', 46)->sum('head_amount') + $student_heads->where('head_id', '=', 52)->sum('head_amount') }}</td>
              {{-- <td>20-jul-2019</td> --}}
              <td>{{ ($student_heads->where('head_id', '=', 46)->where('status_id', '=', 1)->sum('head_amount') + $student_heads->where('head_id', '=', 46)->where('status_id', '=', 2)->sum('paid_amount')) + ($student_heads->where('head_id', '=', 52)->where('status_id', '=', 1)->sum('head_amount') + $student_heads->where('head_id', '=', 52)->where('status_id', '=', 2)->sum('paid_amount')) }}</td>
              {{-- <td>20-jul-2019</td> --}}
            </tr>
            <tr>
              <td>Others </td>
              <td>{{ $student_heads->where('head_id', '!=', 3)->where('head_id', '!=', 12)->where('head_id', '!=', 38)->where('head_id', '!=', 50)->where('head_id', '!=', 51)->where('head_id', '!=', 7)->where('head_id', '!=', 4)->where('head_id', '!=', 49)->where('head_id', '!=', 46)->where('head_id', '!=', 52)->where('head_id', '!=', 6)->where('head_id', '!=', 48)->sum('head_amount') }}</td>
              {{-- <td>20-jul-2019</td> --}}
              <td>{{ ($student_heads->where('head_id', '!=', 3)->where('head_id', '!=', 12)->where('head_id', '!=', 38)->where('head_id', '!=', 50)->where('head_id', '!=', 51)->where('head_id', '!=', 7)->where('head_id', '!=', 4)->where('head_id', '!=', 49)->where('head_id', '!=', 46)->where('head_id', '!=', 52)->where('head_id', '!=', 6)->where('head_id', '!=', 48)->where('status_id', '=', 1)->sum('head_amount') + $student_heads->where('head_id', '!=', 3)->where('head_id', '!=', 12)->where('head_id', '!=', 38)->where('head_id', '!=', 50)->where('head_id', '!=', 51)->where('head_id', '!=', 7)->where('head_id', '!=', 4)->where('head_id', '!=', 49)->where('head_id', '!=', 46)->where('head_id', '!=', 52)->where('head_id', '!=', 6)->where('head_id', '!=', 48)->where('status_id', '=', 2)->sum('paid_amount')) }}</td>
              {{-- <td>20-jul-2019</td> --}}
            </tr>
          </tbody>
        </table>
      </div>
      <div class="overallSummary m-t-0 right"> 
      <h4 class="m-b-5 m-t-10"> Transport And Fine Detail:</h4>
        <table width="100%" border="1" cellpadding="0" cellspacing="1" bgcolor="#F2F2F2">
          <thead>
            <tr>
              <th align="left">Name</th>
              <th align="left">Due Amount</th>
              {{-- <th align="left">Due Date</th> --}}
              <th align="left">Paid Amount</th>
              {{-- <th align="left">Paid Date</th> --}}
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Transport</td>
              <td>{{ isset($outstanding_clearance_section->total_transport_till_today)?number_format($outstanding_clearance_section->total_transport_till_today): 0 }}</td>
              {{-- <td>20-jul-2019</td> --}}
              <td>{{ isset($outstanding_clearance_section->total_transport_paid_till_today)?number_format($outstanding_clearance_section->total_transport_paid_till_today): 0 }}</td>
              {{-- <td>20-jul-2019</td> --}}
            </tr>
            <tr>
              <td>Late Fee Fine</td>
              <td>{{ isset($outstanding_clearance_section->total_fine_on_instalment)?number_format($outstanding_clearance_section->total_fine_on_instalment): 0 }}</td>
              {{-- <td>20-jul-2019</td> --}}
              <td>{{ isset($outstanding_clearance_section->total_installment_fine_paid)?number_format($outstanding_clearance_section->total_installment_fine_paid): 0 }}</td>
              {{-- <td>20-jul-2019</td> --}}
            </tr>
            <tr>
              <td>Exam Fine</td>
              <td>0</td>
              {{-- <td>20-jul-2019</td> --}}
              <td>0</td>
              {{-- <td>20-jul-2019</td> --}}
            </tr>
            <tr class="last_row_transport_detail">
              <td>Absent Fine </td>
              <td>{{ isset($outstanding_clearance_section->total_absent_days_fine)?number_format($outstanding_clearance_section->total_absent_days_fine): 0 }}</td>
              {{-- <td>20-jul-2019</td> --}}
              <td>{{ number_format((isset($outstanding_clearance_section->total_absent_days_fine)?$outstanding_clearance_section->total_absent_days_fine: 0) - (isset($outstanding_clearance_section->total_absent_fine_remaining)?$outstanding_clearance_section->total_absent_fine_remaining: 0)) }}</td>
              {{-- <td>20-jul-2019</td> --}}
            </tr>
          </tbody>
        </table>
      </div>
    </div>

  </div>
  <div class="footer page-break-after">
    <div class="footerDeatail m-t-10">
      <table width="100%" border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td align="center" valign="top">
            <h4 class="m-0 font-200">For Any Query Please Visit <b class="font-bold">Operation Office</b> </h4>
            <h4 class="m-0 font-200"><b class="font-bold">Note:</b>This is a Computer generated <b
                class="font-bold">Clearance Slip</b>. No signature is required. </h4>
            <h4 class="m-0">Address: 5- Baber Block, New Garden Town, Lahore, Punjab</h4>
            <h4 class="m-0">Ph: 042 - 35858400 , 35858500</h4>
          </td>
        </tr>
      </table>
    </div>
  </div>