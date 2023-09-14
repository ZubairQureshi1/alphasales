<style type="text/css">
    label{
        color: black;
         font-family: 'Roboto', sans-serif;
         font-size: 18px;
         text-transform: capitalize;
    }
    h1{
        font-weight: bold;
        text-align: center;
        font-family: 'Balsamiq Sans', cursive;
        background: #17202A;
        color: white;
        padding: 15px;
        position: relative;
        }
    input{
        text-transform: capitalize;
    }
    .styling{
        font-weight: bold;
        font-size: 22px;
    }
</style>
<br>
@if(isset($data['second_annual_part_details']['receipt_status']) != null )
    <div class="card shadow p-3 w-100">
          <br>
<div class="col-md-12">
            <h1>Continue 1(Annual Part 2)</h1>
            </div><br>
        <div class="card-body ">
            <div class="card shadow p-3 w-100">
                <div class="card-body">
                    <div class="col-md-12 mt-4">
                        <label for="" class="styling">Annual Part 2 File Received in CFE Cell:</label>
                    </div>
                    <div class="card shadow p-3 w-100">
                        <div class="card-body ">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label @if( !$data['second_annual_part_details']['receipt_status']) class="text-danger" @endif><strong>Receipt Status:</strong></label>
                                    <label>
                                        {{$data && $data['second_annual_part_details']['receipt_status'] ? $data['second_annual_part_details']['receipt_status'] : '--'}}
                                    </label>
                                </div>
                                <div class="form-group col-md-3">
                                    <label @if( !$data['second_annual_part_details']['second_part_date']) class="text-danger" @endif><strong>Date:</strong></label>
                                    <label>
                                        {{$data && $data['second_annual_part_details']['second_part_date'] ? $data['second_annual_part_details']['second_part_date'] : '--'}}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-4">
                <label for="" class="styling">Field Submitted in PWWB:</label>
            </div>
            <div class="card shadow p-3 mt-1 w-100">
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label @if( !$data['second_annual_part_details']['pwwb_status']) class="text-danger" @endif><strong>Status:</strong></label>
                            <label>
                                {{$data && $data['second_annual_part_details']['pwwb_status'] ? $data['second_annual_part_details']['pwwb_status'] : '--'}}
                            </label>
                        </div>
                        <div class="form-group col-md-3">
                            <label @if( !$data['second_annual_part_details']['pwwb_date']) class="text-danger" @endif><strong>Date:</strong></label>
                            <label>
                                {{$data && $data['second_annual_part_details']['pwwb_date'] ? $data['second_annual_part_details']['pwwb_date'] : '--'}}
                            </label>
                        </div>
                        <div class="form-group col-md-3">
                            <label @if( !$data['second_annual_part_details']['diary_pwwb']) class="text-danger" @endif><strong>Diary No. in PWWB:</strong></label>
                            <label>
                                {{$data && $data['second_annual_part_details']['diary_pwwb'] ? $data['second_annual_part_details']['diary_pwwb'] : '--'}}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
           {{--  <div class="col-md-12 mt-4">
                <label for="">Claimed Received From PWWB:</label>
            </div>
            <div class="card shadow p-3 mt-1 w-100">
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label @if( !$data['second_annual_part_details']['amount_claim_due']) class="text-danger" @endif><strong>Amount of Claim Due:</strong></label>
                            <label>
                                {{$data && $data['second_annual_part_details']['amount_claim_due'] ? $data['second_annual_part_details']['amount_claim_due'] : '--'}}
                            </label>
                        </div>
                        <div class="form-group col-md-3">
                            <label @if( !$data['second_annual_part_details']['claim_status']) class="text-danger" @endif><strong>Status of Claimed Received:</strong></label>
                            <label>
                                {{$data && $data['second_annual_part_details']['claim_status'] ? $data['second_annual_part_details']['claim_status'] : '--'}}
                            </label>
                        </div>
                        <div class="form-group col-md-3">
                            <label @if( !$data['second_annual_part_details']['amount_received']) class="text-danger" @endif><strong>Amount Received:</strong></label>
                            <label>
                                {{$data && $data['second_annual_part_details']['amount_received'] ? $data['second_annual_part_details']['amount_received'] : '--'}}
                            </label>
                        </div>
                        <div class="form-group col-md-3">
                            <label @if( !$data['second_annual_part_details']['claim_date']) class="text-danger" @endif><strong>Date:</strong></label>
                            <label>
                                {{$data && $data['second_annual_part_details']['claim_date'] ? $data['second_annual_part_details']['claim_date'] : '--'}}
                            </label>
                        </div>
                    </div>
                </div>
            </div> --}}

 {{-- start  --}}
                <div class="col-md-12 mt-2">
        <label for="" class="styling">Claim From PWWB:</label>
    </div>
    <div class="col-md-12 mt-4">
        <label for="" class="styling">Claim Head:</label>
    </div>
    <div class="card shadow p-3 w-100">
        <div class="card-body">
            @if($data['claims'])
                    @foreach($data['claims'] as $claims)
                    @if($claims['page_number'] == 16)
            <div class="form-row">
                <div class="form-group col-md-2">
                    {{-- <label><strong>Serial No:</strong></label> --}}
                    <label @if( !$claims['serial_no']) @endif><strong>Serial No:</strong></label>
                    <label>
                        {{$claims['serial_no']? $claims['serial_no'] : '--'}}
                        </label>
                </div>
                <div class="form-group col-md-2">
                    {{-- <label><strong>Amount of Claim Due:</strong></label> --}}
                    <label @if( !$claims['claim_head_default']) @endif><strong>Claim Head:</strong></label>
                    <label>
                        {{$claims['claim_head_default']? $claims['claim_head_default'] : '--'}}
                    </label>
                </div>
                <div class="form-group col-md-2">
                    <label><strong>{{-- Type of Claim --}}</strong></label>
                    <label @if( !$claims['claim_amount_due_default']) @endif><strong>Amount Due:</strong></label>
                    <label>
                       {{$claims['claim_amount_due_default']? $claims['claim_amount_due_default'] : '0'}}
                    </label>
                </div>
                
            </div>
            <div style="border-bottom:  1px solid black;"></div><br>
            @endif
            @endforeach
            <div class="form-row">
                <div class="form-group col-md-2">
                    {{-- <label><strong>Serial No:</strong></label> --}}
                    <label><strong>Total:</strong></label>
                    {{-- <label>
                        {{ 'Total' }}
                        </label> --}}
                </div>
                
                <div class="form-group col-md-2"></div>
                 <div class="form-group col-md-2">
                    <label><strong>{{-- Type of Claim --}}</strong></label>
                    <label @if( !$claims['total_amount_due_default']) @endif><strong>Amount Due:</strong></label>
                    <label>
                       {{$claims['total_amount_due_default']? $claims['total_amount_due_default'] : '0'}}
                    </label>
                </div>
                
            </div>
                @endif
        </div>
    </div>

    <div class="card shadow p-3 w-100">
        <div class="card-body ">
            <div class="form-row">
                <div class="form-group  col-md-2">
                    <label @if( !$data['claims'][16]['claim_due']) class="text-danger" @endif><strong>Claim Due:</strong></label>
                    <label>
                        {{$data && $data['claims'][16]['claim_due'] ? $data['claims'][16]['claim_due'] : '--'}}
                    </label>
                </div>
                <div class="form-group  col-md-2">
                    <label @if( !$data['claims'][16]['claim_status']) class="text-danger" @endif><strong>Claim Status:</strong></label>
                    <label>
                        {{$data && $data['claims'][16]['claim_status'] ? $data['claims'][16]['claim_status'] : '--'}}
                    </label>
                </div>
                <div class="form-group  col-md-2">
                    <label @if( !$data['claims'][16]['reason']) class="text-danger" @endif><strong>Reason:</strong></label>
                    <label>
                        {{$data && $data['claims'][16]['reason'] ? $data['claims'][16]['reason'] : '--'}}
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-4">
        <label for="" class="styling">Claim Status:</label>
    </div>
    <div class="card shadow p-3 w-100">
        <div class="card-body">
            @if($data['claims'])
                    @foreach($data['claims'] as $claims)
                    @if($claims['page_number'] == 16)
            <div class="form-row">
                <div class="form-group col-md-2">
                    {{-- <label><strong>Serial No:</strong></label> --}}
                    <label @if( !$claims['serial_no']) @endif><strong>Serial No:</strong></label>
                    <label>
                        {{$claims['serial_no']? $claims['serial_no'] : '--'}}
                        </label>
                </div>
                <div class="form-group col-md-2">
                    {{-- <label><strong>Amount of Claim Due:</strong></label> --}}
                    <label @if( !$claims['claim_head']) @endif><strong>Claim Head:</strong></label>
                    <label>
                        {{$claims['claim_head']? $claims['claim_head'] : '--'}}
                    </label>
                </div>
                 <div class="form-group col-md-2">
                    <label><strong>{{-- Type of Claim --}}</strong></label>
                    <label @if( !$claims['amount_due']) @endif><strong>Amount Due:</strong></label>
                    <label>
                       {{$claims['amount_due']? $claims['amount_due'] : '0'}}
                    </label>
                </div>
                 <div class="form-group col-md-2">
                    {{-- <label><strong>Claim Type:</strong></label> --}}
                    <label @if( !$claims['amount_received']) @endif><strong>Amount Received:</strong></label>
                    <label>
                       {{$claims['amount_received']? $claims['amount_received'] : '0'}}
                    </label>
                </div>
                <div class="form-group col-md-2">
                    {{-- <label><strong>Status of Claim Received:</strong></label> --}}
                    <label @if( !$claims['amount_balance']) @endif><strong>Amount Balance:</strong></label>
                    <label>
                       {{$claims['amount_balance']? $claims['amount_balance'] : '0'}}
                    </label>
                </div>
                
            </div>
            <div style="border-bottom:  1px solid black;"></div><br>
            @endif
            @endforeach
            <div class="form-row">
                <div class="form-group col-md-2">
                    {{-- <label><strong>Serial No:</strong></label> --}}
                    <label><strong>Total:</strong></label>
                    {{-- <label>
                        {{ 'Total' }}
                        </label> --}}
                </div>
                
                <div class="form-group col-md-2"></div>
                 <div class="form-group col-md-2">
                    <label><strong>{{-- Type of Claim --}}</strong></label>
                    <label @if( !$data['claims'][16]['total_amount_due']) @endif><strong>Amount Due:</strong></label>
                    <label>
                       {{$data['claims'][16]['total_amount_due']? $data['claims'][16]['total_amount_due'] : '0'}}
                    </label>
                </div>
                 <div class="form-group col-md-2">
                    {{-- <label><strong>Claim Type:</strong></label> --}}
                    <label @if( !$data['claims'][16]['total_amount_received']) @endif><strong>Total Received:</strong></label>
                    <label>
                       {{$data['claims'][16]['total_amount_received']? $data['claims'][16]['total_amount_received'] : '0'}}
                    </label>
                </div>
                <div class="form-group col-md-2">
                    {{-- <label><strong>Status of Claim Received:</strong></label> --}}
                    <label @if( !$data['claims'][16]['total_amount_balance']) @endif><strong>Total Balance:</strong></label>
                    <label>
                       {{$data['claims'][16]['total_amount_balance']? $data['claims'][16]['total_amount_balance'] : '0'}}
                    </label>
                </div>
                
            </div>
                @endif
        </div>
    </div>
    <br>
    <div class="card shadow p-3 w-100">
        <div class="card-body">
            @if($data['claims'])
            <div class="form-row">
                <div class="form-group col-md-2">
                    {{-- <label><strong>Amount of Claim Due:</strong></label> --}}
                    <label @if( !$claims['amount_received_last']) @endif><strong>Amount Received:</strong></label>
                    <label>
                        {{$claims['amount_received_last']? $claims['amount_received_last'] : '--'}}
                    </label>
                </div>
                 <div class="form-group col-md-2">
                    <label><strong>{{-- Type of Claim --}}</strong></label>
                    <label @if( !$claims['total_amount_cheque']) @endif><strong>Total Amount Cheque:</strong></label>
                    <label>
                       {{$claims['total_amount_cheque']? $claims['total_amount_cheque'] : '0'}}
                    </label>
                </div>
                 <div class="form-group col-md-2">
                    {{-- <label><strong>Claim Type:</strong></label> --}}
                    <label @if( !$claims['cheque_date']) @endif><strong>Cheque Date:</strong></label>
                    <label>
                       {{$claims['cheque_date']? $claims['cheque_date'] : '0'}}
                    </label>
                </div>
                <div class="form-group col-md-2">
                    {{-- <label><strong>Status of Claim Received:</strong></label> --}}
                    <label @if( !$claims['cheque_no']) @endif><strong>Cheque No:</strong></label>
                    <label>
                       {{$claims['cheque_no']? $claims['cheque_no'] : '0'}}
                    </label>
                </div>
                <div class="form-group col-md-2">
                    {{-- <label><strong>Status of Claim Received:</strong></label> --}}
                    <label @if( !$claims['bank_name']) @endif><strong>Bank Name:</strong></label>
                    <label>
                       {{$claims['bank_name']? $claims['bank_name'] : '0'}}
                    </label>
                </div>
                <div class="form-group col-md-2">
                    {{-- <label><strong>Status of Claim Received:</strong></label> --}}
                    <label @if( !$claims['reason_remarks']) @endif><strong>Reason / Remarks:</strong></label>
                    <label>
                       {{$claims['reason_remarks']? $claims['reason_remarks'] : '0'}}
                    </label>
                </div>
                
            </div>
            <div style="border-bottom:  1px solid black;"></div><br>
                @endif
        </div>
    </div>

                    {{-- end --}}

            <div class="col-md-12 mt-4">
                <label for="" class="styling">Examination Status in Affiliated Body:</label>
            </div>
            <div class="card shadow p-3 mt-1 w-100">
                <div class="card-body" id="result_status_annual_part_two_parent">
                    <div class="col-md-12 mt-4">
                        <label for="">Exam Fee:</label>
                    </div>
                    <div class="card shadow p-3 mt-1 w-100">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label @if( !$data['second_annual_part_details']['exam_status']) class="text-danger" @endif><strong>Status:</strong></label>
                                    <label>
                                        {{$data && $data['second_annual_part_details']['exam_status'] ? $data['second_annual_part_details']['exam_status'] : '--'}}
                                    </label>
                                </div>
                                <div class="form-group col-md-3">
                                    <label @if( !$data['second_annual_part_details']['exam_date']) class="text-danger" @endif><strong>Date:</strong></label>
                                    <label>
                                        {{$data && $data['second_annual_part_details']['exam_date'] ? $data['second_annual_part_details']['exam_date'] : '--'}}
                                    </label>
                                </div>
                                <div class="form-group col-md-3">
                                    <label @if( !$data['second_annual_part_details']['exam_amount']) class="text-danger" @endif><strong>Amount:</strong></label>
                                    <label>
                                        {{$data && $data['second_annual_part_details']['exam_amount'] ? $data['second_annual_part_details']['exam_amount'] : '--'}}
                                    </label>
                                </div>

                                <div class="form-group col-md-3">
                                    <label @if( !$data['roll_no']) class="text-danger" @endif><strong>Board / University Roll No:</strong></label>
                                    <label>
                                        {{-- {{$data && $data['second_annual_part_details']['roll_no'] ? $data['second_annual_part_details']['roll_no'] : '--'}} --}}
                                        {{$data ? $data['roll_no'] : '---'}}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row mt-4">
                        <div class="col-md-1 text-center">
                            <label><strong>Result:</strong></label>
                        </div>
                        <div class="form-row col-md-10 ml-0" id="result_status_annual_part_two_pass_headers" >
                            <div class="col-md-2 text-center">
                                <label><strong>Fail:</strong></label>
                            </div>
                            <div class="col-md-3 text-center">
                                <label><strong>Chance of next Appearance:</strong></label>
                            </div>
                            <div class="col-md-2 text-center">
                                <label><strong>Next Appearance Date:</strong></label>
                            </div>
                            <div class="col-md-2 text-center">
                                <label><strong>Last Chance Date:</strong></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 text-center" style="float: right; margin-top: -32px; ">
                                        <label style="position: relative; right: 80px;"><strong>Passing Date:</strong></label>
                                    </div>
                    <!-- result status -->
                    @if($data && isset($data['second_annual_result_status_details']))
                        @if(count($data['second_annual_result_status_details'])>0)
                            @foreach($data['second_annual_result_status_details'] as $secondAnnualResultStatusDetails)
                                <div class="form-row mt-2" id="result_status_annual_part_two_div">
                                    <div class="col-md-1 p-0">
                                        <label id="checkpassorfail_16" style="margin-left: 40px;">
                                            {{$secondAnnualResultStatusDetails['result'] ? $secondAnnualResultStatusDetails['result'] : ''}}
                                        </label>
                                    </div>
                                    <div id="fail_16" class="col-md-10 form-row m-0" id="result_status_annual_part_two_pass_values" style="display: none">
                                        <div class="col-md-2 p-0">
                                            <label style="margin-left: 40px;">
                                                {{$secondAnnualResultStatusDetails['fail'] ? $secondAnnualResultStatusDetails['fail'] : ''}}
                                            </label>
                                        </div>
                                        <div class="col-md-3 p-0">
                                            <label style="margin-left: 40px;">
                                                {{$secondAnnualResultStatusDetails['next_appearance'] ? $secondAnnualResultStatusDetails['next_appearance'] : ''}}
                                            </label>
                                        </div>
                                        <div class="col-md-2 p-0">
                                            <label style="margin-left: 40px;">
                                                {{$secondAnnualResultStatusDetails['next_appearance_date'] ? $secondAnnualResultStatusDetails['next_appearance_date'] : ''}}
                                            </label>
                                        </div>
                                        <div class="col-md-2 p-0">
                                            <label style="margin-left: 40px;">
                                                {{$secondAnnualResultStatusDetails['last_chance_date'] ? $secondAnnualResultStatusDetails['last_chance_date'] : ''}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 p-0" style="float: right; margin-top: -32px;">
                                            <label>
                                                {{$secondAnnualResultStatusDetails['passing_date'] ? $secondAnnualResultStatusDetails['passing_date'] : ''}}
                                            </label>
                                        </div>
                            @endforeach
                        @else
                            <div class="form-row mt-2" id="result_status_annual_part_two_div">
                                <div class="col-md-2 ml-2 p-0">
                                    <label>
                                        No Record Found
                                    </label>
                                </div>
                            </div>
                        @endif
                    @endif
                    <div class="col-md-12 mt-4">
                        <label for="" class="styling">Readmission</label>
                    </div>
                    <div class="card shadow p-3 w-100">
                        <div class="card-body ">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label @if( !$data['second_annual_part_details']['readmissionparttwo']) class="text-danger" @endif><strong>Readmission:</strong></label>
                                    <label>
                                        {{$data && $data['second_annual_part_details']['readmissionparttwo'] ? $data['second_annual_part_details']['readmissionparttwo'] : '--'}}
                                    </label>
                                </div>
                                <div class="form-group col-md-4">
                                    <label @if( !$data['second_annual_part_details']['same_course']) class="text-danger" @endif><strong>Same Course:</strong></label>
                                    <label>
                                        {{$data && $data['second_annual_part_details']['same_course'] ? $data['second_annual_part_details']['same_course'] : '--'}}
                                    </label>
                                </div>
                                <div class="form-group col-md-4">
                                    <label @if( !$data['second_annual_part_details']['changed_course']) class="text-danger" @endif><strong>Changed Course:</strong></label>
                                    <label>
                                        {{$data && $data['second_annual_part_details']['changed_course'] ? $data['second_annual_part_details']['changed_course'] : '--'}}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>

<script>
    $( document ).ready(function() {
       var checkpassorfail = $('#checkpassorfail_16').text();
       checkpassorfail = checkpassorfail.trim();
       console.log(checkpassorfail);
       if (checkpassorfail == 'pass') {

            $('#fail_16').hide();

       }
       else if(checkpassorfail == 'fail'){

            $('#fail_16').show();

       }
    });
</script>
