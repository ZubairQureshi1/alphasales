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
@if(isset($data['fourth_semester_details']['cell_status']) != null )
    <div class="card shadow p-3 w-100">
         <div class="col-md-12">
            <h1>Continue 3(Fourth Semester)</h1>
            </div><br>
        <div class="card-body ">
            <div class="card shadow p-3 w-100">
                <div class="card-body">
                    <div class="col-md-12 mt-4">
                        <label for="" class="styling">4th Semester File Received in CFE Cell:</label>
                    </div>
                    <div class="card shadow p-3 w-100">
                        <div class="card-body ">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label @if( !$data['fourth_semester_details']['cell_status']) class="text-danger" @endif><strong>Status:</strong></label>
                                    <label>
                                        {{$data && $data['fourth_semester_details']['cell_status'] ? $data['fourth_semester_details']['cell_status'] : '--'}}
                                    </label>
                                </div>
                                <div class="form-group col-md-3">
                                    <label @if( !$data['fourth_semester_details']['cell_date']) class="text-danger" @endif><strong>Date:</strong></label>
                                    <label>
                                        {{$data && $data['fourth_semester_details']['cell_date'] ? $data['fourth_semester_details']['cell_date'] : '--'}}
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
                            <label @if( !$data['fourth_semester_details']['pwwb_status']) class="text-danger" @endif><strong>Status:</strong></label>
                            <label>
                                {{$data && $data['fourth_semester_details']['pwwb_status'] ? $data['fourth_semester_details']['pwwb_status'] : '--'}}
                            </label>
                        </div>
                        <div class="form-group col-md-3">
                            <label @if( !$data['fourth_semester_details']['pwwb_date']) class="text-danger" @endif><strong>Date:</strong></label>
                            <label>
                                {{$data && $data['fourth_semester_details']['pwwb_date'] ? $data['fourth_semester_details']['pwwb_date'] : '--'}}
                            </label>
                        </div>
                        <div class="form-group col-md-3">
                            <label @if( !$data['fourth_semester_details']['diary_pwwb']) class="text-danger" @endif><strong>Diary No. in PWWB:</strong></label>
                            <label>
                                {{$data && $data['fourth_semester_details']['diary_pwwb'] ? $data['fourth_semester_details']['diary_pwwb'] : '--'}}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
           {{--  <div class="col-md-12 mt-4">
                <label for="" class="styling">Claimed Received From PWWB:</label>
            </div>
            <div class="card shadow p-3 mt-1 w-100">
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label @if( !$data['fourth_semester_details']['amount_claim_due']) class="text-danger" @endif><strong>Amount of Claim Due:</strong></label>
                            <label>
                                {{$data && $data['fourth_semester_details']['amount_claim_due'] ? $data['fourth_semester_details']['amount_claim_due'] : '--'}}
                            </label>
                        </div>
                        <div class="form-group col-md-3">
                            <label @if( !$data['fourth_semester_details']['claim_status']) class="text-danger" @endif><strong>Status of Claimed Received:</strong></label>
                            <label>
                                {{$data && $data['fourth_semester_details']['claim_status'] ? $data['fourth_semester_details']['claim_status'] : '--'}}
                            </label>
                        </div>
                        <div class="form-group col-md-3">
                            <label @if( !$data['fourth_semester_details']['amount_received']) class="text-danger" @endif><strong>Amount Received:</strong></label>
                            <label>
                                {{$data && $data['fourth_semester_details']['amount_received'] ? $data['fourth_semester_details']['amount_received'] : '--'}}
                            </label>
                        </div>
                        <div class="form-group col-md-3">
                            <label @if( !$data['fourth_semester_details']['claim_date']) class="text-danger" @endif><strong>Date:</strong></label>
                            <label>
                                {{$data && $data['fourth_semester_details']['claim_date'] ? $data['fourth_semester_details']['claim_date'] : '--'}}
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
                    @if($claims['page_number'] == 20)
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
                    <label @if( !$data['claims'][32]['claim_due']) class="text-danger" @endif><strong>Claim Due:</strong></label>
                    <label>
                        {{$data && $data['claims'][32]['claim_due'] ? $data['claims'][32]['claim_due'] : '--'}}
                    </label>
                </div>
                <div class="form-group  col-md-2">
                    <label @if( !$data['claims'][32]['claim_status']) class="text-danger" @endif><strong>Claim Status:</strong></label>
                    <label>
                        {{$data && $data['claims'][32]['claim_status'] ? $data['claims'][32]['claim_status'] : '--'}}
                    </label>
                </div>
                <div class="form-group  col-md-2">
                    <label @if( !$data['claims'][32]['reason']) class="text-danger" @endif><strong>Reason:</strong></label>
                    <label>
                        {{$data && $data['claims'][32]['reason'] ? $data['claims'][32]['reason'] : '--'}}
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
                    @if($claims['page_number'] == 20)
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
                    <label @if( !$data['claims'][32]['total_amount_due']) @endif><strong>Amount Due:</strong></label>
                    <label>
                       {{$data['claims'][32]['total_amount_due']? $data['claims'][32]['total_amount_due'] : '0'}}
                    </label>
                </div>
                 <div class="form-group col-md-2">
                    {{-- <label><strong>Claim Type:</strong></label> --}}
                    <label @if( !$data['claims'][32]['total_amount_received']) @endif><strong>Total Received:</strong></label>
                    <label>
                       {{$data['claims'][32]['total_amount_received']? $data['claims'][32]['total_amount_received'] : '0'}}
                    </label>
                </div>
                <div class="form-group col-md-2">
                    {{-- <label><strong>Status of Claim Received:</strong></label> --}}
                    <label @if( !$data['claims'][32]['total_amount_balance']) @endif><strong>Total Balance:</strong></label>
                    <label>
                       {{$data['claims'][32]['total_amount_balance']? $data['claims'][32]['total_amount_balance'] : '0'}}
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
                <div class="card-body" id="result_status_second_semester_parent">
                    <div class="col-md-12 mt-4">
                        <label for="" class="styling">Exam Fee:</label>
                    </div>
                    <div class="card shadow p-3 mt-1 w-100">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label @if( !$data['fourth_semester_details']['exam_status']) class="text-danger" @endif><strong>Status:</strong></label>
                                    <label>
                                        {{$data && $data['fourth_semester_details']['exam_status'] ? $data['fourth_semester_details']['exam_status'] : '--'}}
                                    </label>
                                </div>
                                <div class="form-group col-md-3">
                                    <label @if( !$data['fourth_semester_details']['exam_date']) class="text-danger" @endif><strong>Date:</strong></label>
                                    <label>
                                        {{$data && $data['fourth_semester_details']['exam_date'] ? $data['fourth_semester_details']['exam_date'] : '--'}}
                                    </label>
                                </div>
                                <div class="form-group col-md-3">
                                    <label @if( !$data['fourth_semester_details']['amount']) class="text-danger" @endif><strong>Amount:</strong></label>
                                    <label>
                                        {{$data && $data['fourth_semester_details']['amount'] ? $data['fourth_semester_details']['amount'] : '--'}}
                                    </label>
                                </div>
                                <div class="form-group col-md-3">
                                    <label @if( !$data['roll_no']) class="text-danger" @endif><strong>Board / University Roll No:</strong></label>
                                    <label>
                                        {{-- {{$data && $data['fourth_semester_details']['roll_no'] ? $data['fourth_semester_details']['roll_no'] : '--'}} --}}
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
                    <div class="form-row pt-2">
                        <div class="col-md-1 text-center">
                            <label><strong>Result:</strong></label>
                        </div>
                        <div class="form-row col-md-1 ml-0" id="result_status_second_semester_pass_headers>
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
                         <div class="col-md-2 text-center" style="float: right; margin-top: -32px; ">
                                        <label style="position: relative; right: 80px;"><strong>Passing Date:</strong></label>
                                    </div>
                    @if($data && isset($data['fourth_semester_result_status_details']) && count($data['fourth_semester_result_status_details']))
                        @foreach($data['fourth_semester_result_status_details'] as $fourthSemesterResultStatusDetails)
                            <div class="form-row mt-2" id="result_status_second_semester_div">
                                <input type="hidden" value="{{$fourthSemesterResultStatusDetails['id']}}" id="result_status_second_semester_delete_id">
                                <div class="col-md-1 p-0">
                                    <label id="checkpassorfail_20" style="margin-left: 40px;">
                                        {{$fourthSemesterResultStatusDetails['result'] ? $fourthSemesterResultStatusDetails['result'] : ''}}
                                    </label>
                                </div>
                                <div id="fail_20" class="col-md-10 form-row m-0" id="result_status_second_semester_pass_values" style="display: none">
                                    <div class="col-md-2 p-0">
                                        <label>
                                            {{$fourthSemesterResultStatusDetails['fail'] ? $fourthSemesterResultStatusDetails['fail'] : ''}}
                                        </label>
                                    </div>
                                    <div class="col-md-3 p-0">
                                        <label style="margin-left: 30px;">
                                            {{$fourthSemesterResultStatusDetails['next_appearance'] ? $fourthSemesterResultStatusDetails['next_appearance'] : ''}}
                                        </label>
                                    </div>
                                    <div class="col-md-2 p-0">
                                        <label style="margin-left: 30px;">
                                            {{$fourthSemesterResultStatusDetails['next_appearance_date'] ? $fourthSemesterResultStatusDetails['next_appearance_date'] : ''}}
                                        </label>
                                    </div>
                                    <div class="col-md-2 p-0">
                                        <label style="margin-left: 80px;">
                                            {{$fourthSemesterResultStatusDetails['last_chance_date'] ? $fourthSemesterResultStatusDetails['last_chance_date'] : ''}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                              <div class="col-md-2 p-0" style="float: right; margin-top: -32px;">
                                        <label>
                                            {{$fourthSemesterResultStatusDetails['passing_date'] ? $fourthSemesterResultStatusDetails['passing_date'] : ''}}
                                        </label>
                                    </div>
                        @endforeach
                    @else
                        <div class="form-row mt-2 ml-4" id="result_status_second_semester_div">
                            <div class="col-md-2 p-0">
                                No Data Found
                            </div>
                        </div>
                    @endif
                <div class="col-md-12 mt-4">
                    <label for="" class="styling">Readmission</label>
                </div>
                <div class="card shadow p-3 w-100">
                    <div class="card-body ">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label @if( !$data['fourth_semester_details']['readmissionfourth']) class="text-danger" @endif><strong>Readmission:</strong></label>
                                <label>
                                    {{$data && $data['fourth_semester_details']['readmissionfourth'] ? $data['fourth_semester_details']['readmissionfourth'] : '--'}}
                                </label>
                            </div>
                            <div class="form-group col-md-4">
                                <label @if( !$data['fourth_semester_details']['same_course']) class="text-danger" @endif><strong>Same Course:</strong></label>
                                <label>
                                    {{$data && $data['fourth_semester_details']['same_course'] ? $data['fourth_semester_details']['same_course'] : '--'}}
                                </label>
                            </div>
                            <div class="form-group col-md-4">
                                <label @if( !$data['fourth_semester_details']['changed_course']) class="text-danger" @endif><strong>Changed Course:</strong></label>
                                <label>
                                    {{$data && $data['fourth_semester_details']['changed_course'] ? $data['fourth_semester_details']['changed_course'] : '--'}}
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
       var checkpassorfail = $('#checkpassorfail_20').text();
       checkpassorfail = checkpassorfail.trim();
       console.log(checkpassorfail);
       if (checkpassorfail == 'pass') {

            $('#fail_20').hide();

       }
       else if(checkpassorfail == 'fail'){

            $('#fail_20').show();

       }
    });
</script>
