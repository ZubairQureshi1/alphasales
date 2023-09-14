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
@if(isset($data['first_annual_details']['fee_deposit_status']) != null )
    <div class="card shadow p-3 w-100 mt-4">
         <br>
<div class="col-md-12">
            <h1>Annual Part 1</h1>
            </div><br>
        <div class="card-body ">
            <div class="col-md-12 mt-3">
                <label for="" class="styling">Examination Status in Affiliated Body:</label>
            </div>
            <div class="card shadow p-3 w-100">
                <div class="card-body">
                    <div class="col-md-12 mt-4">
                        <label for="" class="styling">Exam Fee:</label>
                    </div>
                    <div class="card shadow p-3 w-100">
                        <div class="card-body ">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label @if( !$data['first_annual_details']['fee_deposit_status']) class="text-danger" @endif><strong>Exam Fee Deposit status:</strong></label>
                                    <label>
                                        {{$data && $data['first_annual_details']['fee_deposit_status'] ? $data['first_annual_details']['fee_deposit_status'] : '--'}}
                                    </label>
                                </div>
                                <div class="form-group col-md-3">
                                    <label @if( !$data['first_annual_details']['exam_fee_date']) class="text-danger" @endif><strong>Date:</strong></label>
                                    <label>
                                        {{$data && $data['first_annual_details']['exam_fee_date'] ? $data['first_annual_details']['exam_fee_date'] : '--'}}
                                    </label>
                                </div>
                                <div class="form-group  col-md-3">
                                    <label @if( !$data['first_annual_details']['amount']) class="text-danger" @endif><strong>Amount:</strong></label>
                                    <label>
                                        {{$data && $data['first_annual_details']['amount'] ? $data['first_annual_details']['amount'] : '--'}}
                                    </label>
                                </div>
                                <div class="form-group  col-md-3">
                                    <label @if( !$data['roll_no']) class="text-danger" @endif><strong>Board / University Roll No:</strong></label>
                                    <label>
                                        {{-- {{$data && $data['first_annual_details']['roll_no'] ? $data['first_annual_details']['roll_no'] : '--'}} --}}
                                        {{$data ? $data['roll_no'] : '---'}}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row mt-4">
                        <div class="ml-2">
                            <label for="" class="styling">Result Status:</label>
                        </div>
                    </div>
                    <!-- result status -->
                    <div class="card shadow mt-3 p-3 w-100" >
                        <div class="card-body" id="result_status_annual_part_one_parent">
                            <div class="form-row pt-2">
                                <div class="col-md-1 text-center">
                                    <label><strong>Result:</strong></label>
                                </div>
                                <div class="form-row col-md-10 ml-0" id="result_status_annual_part_one_pass_headers">
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
                            <!-- Result Status Edit Mode-->
                            @if($data['first_annual_result_status_details'])
                                @foreach($data['first_annual_result_status_details'] as $firstAnnualResultStatusDetails)
                                    <div class="form-row mt-2" id="result_status_annual_part_one_div">
                                        <input type="hidden" value="{{$firstAnnualResultStatusDetails['id']}}" id="result_status_annual_part_one_delete_id">
                                        <div class="col-md-1 p-0">
                                            <label id="checkpassorfail_15" style="margin-left: 40px;">
                                                {{$firstAnnualResultStatusDetails['result'] ? $firstAnnualResultStatusDetails['result'] : '--'}}
                                            </label>
                                        </div>
                                        <div id="fail_15" class="col-md-10 form-row m-0" id="result_status_annual_part_one_pass_values" style="display: none;">
                                            <div class="col-md-2 p-0">
                                                <label style="margin-left: 40px;">
                                                    {{$firstAnnualResultStatusDetails['fail'] ? $firstAnnualResultStatusDetails['fail'] : '--'}}
                                                </label>
                                            </div>
                                            <div class="col-md-3 p-0">
                                                <label style="margin-left: 40px;">
                                                    {{$firstAnnualResultStatusDetails['next_appearance'] ? $firstAnnualResultStatusDetails['next_appearance'] : '--'}}
                                                </label>
                                            </div>
                                            <div class="col-md-2 p-0">
                                                <label style="margin-left: 40px;">
                                                    {{$firstAnnualResultStatusDetails['next_appearance_date'] ? $firstAnnualResultStatusDetails['next_appearance_date'] : '--'}}
                                                </label>
                                            </div>
                                            <div class="col-md-2 p-0">
                                                <label style="margin-left: 40px;">
                                                    {{$firstAnnualResultStatusDetails['last_chance_date'] ? $firstAnnualResultStatusDetails['last_chance_date'] : '--'}}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-md-2 p-0" style="float: right; margin-top: -32px;">
                                                <label>
                                                    {{$firstAnnualResultStatusDetails['passing_date'] ? $firstAnnualResultStatusDetails['passing_date'] : '--'}}
                                                </label>
                                            </div>
                                @endforeach
                            @else
                                    <div class="form-row mt-2" id="result_status_annual_part_one_div">
                                        <div class="col-md-2 p-0">
                                            <label>
                                                No Record Found
                                            </label>
                                        </div>
                                        <div class="col-md-10 form-row m-0" id="result_status_annual_part_one_pass_values">
                                        </div>
                                    </div>
                            @endif
                        </div>
                    </div>

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
                    @if($claims['page_number'] == 15)
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
                    <label @if( !$data['claims'][8]['claim_due']) class="text-danger" @endif><strong>Claim Due:</strong></label>
                    <label>
                        {{$data && $data['claims'][8]['claim_due'] ? $data['claims'][8]['claim_due'] : '--'}}
                    </label>
                </div>
                <div class="form-group  col-md-2">
                    <label @if( !$data['claims'][8]['claim_status']) class="text-danger" @endif><strong>Claim Status:</strong></label>
                    <label>
                        {{$data && $data['claims'][8]['claim_status'] ? $data['claims'][8]['claim_status'] : '--'}}
                    </label>
                </div>
                <div class="form-group  col-md-2">
                    <label @if( !$data['claims'][8]['reason']) class="text-danger" @endif><strong>Reason:</strong></label>
                    <label>
                        {{$data && $data['claims'][8]['reason'] ? $data['claims'][8]['reason'] : '--'}}
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
                    @if($claims['page_number'] == 15)
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
                    <label @if( !$data['claims'][8]['total_amount_due']) @endif><strong>Amount Due:</strong></label>
                    <label>
                       {{$data['claims'][8]['total_amount_due']? $data['claims'][8]['total_amount_due'] : '0'}}
                    </label>
                </div>
                 <div class="form-group col-md-2">
                    {{-- <label><strong>Claim Type:</strong></label> --}}
                    <label @if( !$data['claims'][8]['total_amount_received']) @endif><strong>Total Received:</strong></label>
                    <label>
                       {{$data['claims'][8]['total_amount_received']? $data['claims'][8]['total_amount_received'] : '0'}}
                    </label>
                </div>
                <div class="form-group col-md-2">
                    {{-- <label><strong>Status of Claim Received:</strong></label> --}}
                    <label @if( !$data['claims'][8]['total_amount_balance']) @endif><strong>Total Balance:</strong></label>
                    <label>
                       {{$data['claims'][8]['total_amount_balance']? $data['claims'][8]['total_amount_balance'] : '0'}}
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
                        <label for="" class="styling">Readmission</label>
                    </div>
                    <div class="card shadow p-3 w-100">
                        <div class="card-body ">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label @if( !$data['first_annual_details']['readmission']) class="text-danger" @endif><strong>Readmission:</strong></label>
                                    <label>
                                        {{$data && $data['first_annual_details']['readmission'] ? $data['first_annual_details']['readmission'] : '--'}}
                                    </label>
                                </div>
                                <div class="form-group col-md-4">
                                    <label @if( !$data['first_annual_details']['same_course']) class="text-danger" @endif><strong>Same Course:</strong></label>
                                    <label>
                                        {{$data && $data['first_annual_details']['same_course'] ? $data['first_annual_details']['same_course'] : '--'}}
                                    </label>
                                </div>
                                <div class="form-group col-md-4">
                                    <label @if( !$data['first_annual_details']['changed_course']) class="text-danger" @endif><strong>Changed Course:</strong></label>
                                    <label>
                                        {{$data && $data['first_annual_details']['changed_course'] ? $data['first_annual_details']['changed_course'] : '--'}}
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
       var checkpassorfail = $('#checkpassorfail_15').text();
       checkpassorfail = checkpassorfail.trim();
       console.log(checkpassorfail);
       if (checkpassorfail == 'pass') {

            $('#fail_15').hide();

       }
       else if(checkpassorfail == 'fail'){

            $('#fail_15').show();

       }
    });
</script>
