<style type="text/css">
    label{
        font-weight: bold;
        color: black;
        font-family: 'Balsamiq Sans', cursive;
    }
    h1{
        font-weight: bold;
        text-align: center;
        font-family: 'Balsamiq Sans', cursive;
        background: #17202A;
        color: white;
        padding: 15px;
        position: relative;
        top: -20px;
    }
    .aa{
        font-size: 14px;
        font-weight: bold;
        color: #D0D3D4;
        font-family: 'Balsamiq Sans', cursive;
        border-bottom: 1px solid white;
        margin-top: 10px;
        padding-left: 3px;
        padding-right: 0px;
    }
    input{
        text-transform: capitalize;
    }
</style>
<div id="page_15">
    <form id="page_15_form">
        <div class="card shadow p-3 w-100">
            <div class="col-md-12">
                <h1>Annual Part 1<span class="float-right">Page # 11</span></h1><br>
            </div>
            <div class="card-body ">
                <div class="col-md-12 mt-3">
                    <label for="" style="font-size: 20px;">Examination Status in Affiliated Body:</label>
                </div>
                <div class="card shadow p-3 w-100">
                    <div class="card-body">
                        <div class="col-md-12 mt-4">
                            <label for="">Exam Fee:<span style="color: red;">*</span></label>
                        </div>
                        <div class="card shadow p-3 w-100">
                            <div class="card-body ">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label>Exam Fee Deposit status:<span style="color: red;">*</span></label>
                                        <select id="fee_deposit_status_page15" onchange="setFeeDepositStatus()" name="fee_deposit_status" class="form-control">
                                            <option value="" selected disabled>--select--</option>
                                            @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                                <option value="{{$key}}" {{ $data ? $data['first_annual_details'] != null ? $data['first_annual_details']['fee_deposit_status'] == $key ? 'selected' : '' : '' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3" id="date_div_page15" style="display: none">
                                        <label>Date:<span style="color: red;">*</span></label>
                                        <input type="text" class="form-control text-center datepicker" name="exam_fee_date"
                                               placeholder="Enter Date"
                                               value="{{ $data ? $data['first_annual_details'] != null && $data['first_annual_details']['exam_fee_date'] ? date('d/m/Y',strtotime($data['first_annual_details']['exam_fee_date'])) : '' : ''}}">
                                    </div>
                                    <div class="form-group  col-md-3" id="amount_div_page15" style="display:none;">
                                        <label>Amount:<span style="color: red;">*</span></label>
                                        <input onkeyup="numericOnly(event)" type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center" name="amount"
                                               placeholder="Enter Amount"
                                               value="{{ $data ? $data['first_annual_details'] != null ? $data['first_annual_details']['amount'] : '' : ''}}">
                                    </div>
                                    <div class="form-group  col-md-3">
                                        <label>Roll No:<span style="color: red;">*</span></label>
                                        <input readonly type="text" class="form-control text-center" name="roll_no"
                                               placeholder="Enter Roll No" value="{{$data ? $data['roll_no'] : ''}}"
                                               >
                                               {{-- value="{{$data ? $data['first_annual_details'] != null ? $data['first_annual_details']['roll_no'] : '': ''}}" --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- new Claim Fields Start --}}
        <div style="margin-top: 50px;" class="card shadow p-3 w-100">
            <div class="card-body">
                <div class="form-row">
                    <div class="">
                        <label style="font-size: 20px;">Claim From PWWB:</label>
                    </div>
                </div>
                <div style="margin-top: 50px;" class="card shadow p-3 w-100">
            <div class="card-body">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Sr. No</th>
                      <th scope="col">Claim Head</th>
                      <th scope="col">Claim Amount Due</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($data && isset($data['claims'][8]) && count($data['claims'][8]))
                        @php $i = 1; @endphp
                        @foreach($data['claims'] as $claims)
                        @if($claims['page_number'] == 15)
                         <tr>
                             <th scope="row">{{ $i++ }}</th>
                             <td><input name="claim_head_default_{{$i-1}}_page_15" id="claim_head_default_{{$i-1}}_page_15" readonly style="border: none" class="form-control text-center" value="{{$claims['claim_head_default']}}" ></td>
                             <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFifteen();" onkeyup="calculteTotalForClaimsPageFifteen();" value="{{$claims['claim_amount_due_default']}}" placeholder="0" name="claim_amount_due_default_{{$i-1}}_page_15" id="claim_amount_due_default_{{$i-1}}_page_15"></td>
                         </tr>
                         @endif
                        @endforeach
                         <tr>
                          <th scope="row">Total</th>
                          <td></td>
                          <th><input readonly style="border: none;" class="form-control text-center" name="claim_amount_due_default_page_15" value="{{$data && $data['claims']['8']['total_amount_due_default']? $data['claims']['8']['total_amount_due_default'] : ''}}" id="claim_amount_due_default_page_15"></th>
                        </tr>
                    @else
                    <tr>
                      <th scope="row">1</th>
                      <td><input name="claim_head_default_1_page_15" id="claim_head_default_1_page_15" readonly style="border: none" class="form-control text-center" value="Admission Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFifteen();" onkeyup="calculteTotalForClaimsPageFifteen();" value="0" placeholder="0" name="claim_amount_due_default_1_page_15" id="claim_amount_due_default_1_page_15"></td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td><input name="claim_head_default_2_page_15" id="claim_head_default_2_page_15" readonly style="border: none" class="form-control text-center" value="Registration Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFifteen();" onkeyup="calculteTotalForClaimsPageFifteen();" value="0" placeholder="0" name="claim_amount_due_default_2_page_15" id="claim_amount_due_default_2_page_15"></td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td><input name="claim_head_default_3_page_15" id="claim_head_default_3_page_15" readonly style="border: none" class="form-control text-center" value="Tuition Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFifteen();" onkeyup="calculteTotalForClaimsPageFifteen();" value="0" placeholder="0" name="claim_amount_due_default_3_page_15" id="claim_amount_due_default_3_page_15"></td>
                    </tr>
                    <tr>
                      <th scope="row">4</th>
                      <td><input name="claim_head_default_4_page_15" id="claim_head_default_4_page_15" readonly style="border: none" class="form-control text-center" value="Lab Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFifteen();" onkeyup="calculteTotalForClaimsPageFifteen();" value="0" placeholder="0" name="claim_amount_due_default_4_page_15" id="claim_amount_due_default_4_page_15"></td>
                    </tr>
                    <tr>
                      <th scope="row">5</th>
                      <td><input name="claim_head_default_5_page_15" id="claim_head_default_5_page_15" readonly style="border: none" class="form-control text-center" value="Library Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFifteen();" onkeyup="calculteTotalForClaimsPageFifteen();" value="0" placeholder="0" name="claim_amount_due_default_5_page_15" id="claim_amount_due_default_5_page_15"></td>
                    </tr>
                    <tr>
                      <th scope="row">6</th>
                      <td><input name="claim_head_default_6_page_15" id="claim_head_default_6_page_15" readonly style="border: none" class="form-control text-center" value="Exam Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFifteen();" onkeyup="calculteTotalForClaimsPageFifteen();" value="0" placeholder="0" name="claim_amount_due_default_6_page_15" id="claim_amount_due_default_6_page_15"></td>
                    </tr>
                    <tr>
                      <th scope="row">7</th>
                      <td><input name="claim_head_default_7_page_15" id="claim_head_default_7_page_15" readonly style="border: none" class="form-control text-center" value="Transport Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFifteen();" onkeyup="calculteTotalForClaimsPageFifteen();" value="0" placeholder="0" name="claim_amount_due_default_7_page_15" id="claim_amount_due_default_7_page_15"></td>
                     </tr>
                     <tr>
                      <th scope="row">8</th>
                      <td><input name="claim_head_default_8_page_15" id="claim_head_default_8_page_15" readonly style="border: none" class="form-control text-center" value="Hostel Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFifteen();" onkeyup="calculteTotalForClaimsPageFifteen();" value="0" placeholder="0" name="claim_amount_due_default_8_page_15" id="claim_amount_due_default_8_page_15"></td>
                     </tr>
                    <tr>
                      <th scope="row">Total</th>
                      <td></td>
                      <th><input readonly style="border: none;" class="form-control text-center" name="claim_amount_due_default_page_15" value="0" id="claim_amount_due_default_page_15"></th>
                                          
                    </tr>
                    @endif
                  </tbody>
                </table>
            </div>
        </div>
        <br>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>Amount of Claim Due:<span style="color: red;">*</span></label>
                        <input type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center" name="claim_due_page_15" id="claim_due_page_15" placeholder="Enter Claim Due" value="{{$data && isset($data['claims']['8']['claim_due'])? $data['claims']['8']['claim_due'] : ''}}">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Status Of Claim:<span style="color: red;">*</span></label>
                        <select onchange="setDisplayForClaimReceivedPage15()" id="claim_status_page_15" name="claim_status_page_15" class="form-control">
                            <option value="" selected>--select--</option>
                            @foreach(\Config::get('constants.claim_status') as $key => $value)
                                <option value="{{$key}}" @if(isset($data['claims'][8])) {{ $data ? $data['claims']['8']['claim_status'] == $key ? 'selected' : '' : ''}} @endif>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3" id="reason_div_page_15">
                        <label>Reason:<span style="color: red;">*</span></label>
                        <input type="text" class="form-control text-center" name="reason_page_15" id="reason_page_15" placeholder="Enter Reason" value="@if(isset($data['claims'][8])) {{$data && $data['claims']['8']['reason']? $data['claims']['8']['reason'] : ''}} @endif">
                    </div>

                     <div class="form-group col-md-3" id="outstanding_cfe_fee_div_page_15">
                        <label>Outstanding CFE Fee:<span style="color: red;">*</span></label>
                        <input type="number" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center" name="outstanding_cfe_fee_page_15" id="outstanding_cfe_fee_page_15" placeholder="Enter Fee" value="{{$data && isset($data['claims']['8']['outstanding_cfe_fee'])? $data['claims']['8']['outstanding_cfe_fee'] : ''}}">
                    </div>
                    <div class="form-group col-md-3" id="recovered_amount_div_page_15">
                        <label>Recovered Amount From Student:<span style="color: red;">*</span></label>
                        <input type="number" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center" name="recovered_amount_page_15" id="recovered_amount_page_15" placeholder="Enter Recovered Amount" value="{{$data && isset($data['claims']['8']['recovered_amount'])? $data['claims']['8']['recovered_amount'] : ''}}">
                    </div>
                </div>
            </div>
        </div>
        <div style="margin-top: 50px;" class="card shadow p-3 w-100" id="claims_statuses_table_page_15">
            <div class="card-body" id="provisional_letter_parent">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Sr#</th>
                      <th scope="col">Claim Head</th>
                      <th scope="col">Amount Due</th>
                      <th scope="col">Amount Received</th>
                      <th scope="col">Balance</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($data && isset($data['claims'][8]) && count($data['claims'][8]))
                        @php $i = 1; @endphp
                        @foreach($data['claims'] as $claims)
                        @if($claims['page_number'] == 15)
                         <tr>
                             <th scope="row">{{ $i++ }}</th>
                             <td><input name="type_of_claim_{{$i-1}}_page_15" id="type_of_claim_{{$i-1}}_page_15" readonly style="border: none" class="form-control text-center" value="{{$claims['claim_head']}}" ></td>
                             <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFifteen();" onkeyup="calculteTotalForClaimsPageFifteen();" value="{{$claims['amount_due']}}" readonly="" placeholder="0" name="amount_due_{{$i-1}}_page_15" id="amount_due_{{$i-1}}_page_15"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFifteen();" onkeyup="calculteTotalForClaimsPageFifteen();" value="{{$claims['amount_received']}}" placeholder="0" name="amount_received_{{$i-1}}_page_15" id="amount_received_{{$i-1}}_page_15"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFifteen();" onkeyup="calculteTotalForClaimsPageFifteen();" value="{{$claims['amount_balance']}}" placeholder="0" readonly name="balance_due_{{$i-1}}_page_15" id="balance_due_{{$i-1}}_page_15"></td>
                         </tr>
                         @endif
                        @endforeach
                         <tr>
                          <th scope="row">Total</th>
                          <td></td>
                          <th><input readonly style="border: none;" class="form-control text-center" name="amount_due_page_15" value="{{$data && $data['claims']['8']['total_amount_due']? $data['claims']['8']['total_amount_due'] : ''}}" id="amount_due_page_15"></th>
                          <th><input readonly style="border: none;" class="form-control text-center" name="amount_received_page_15" value="{{$data && $data['claims']['8']['total_amount_received']? $data['claims']['8']['total_amount_received'] : ''}}" id="amount_received_page_15"></th>
                          <th><input readonly style="border: none;" class="form-control text-center" name="balance_due_page_15" value="{{$data && $data['claims']['8']['total_amount_balance']? $data['claims']['8']['total_amount_balance'] : ''}}" id="balance_due_page_15"></th>                      
                        </tr>
                    @else
                    <tr>
                      <th scope="row">1</th>
                      <td><input name="type_of_claim_1_page_15" id="type_of_claim_1_page_15" readonly style="border: none" class="form-control text-center" value="Admission Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFifteen();" onkeyup="calculteTotalForClaimsPageFifteen();" value="0" placeholder="0" readonly name="amount_due_1_page_15" id="amount_due_1_page_15"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFifteen();" onkeyup="calculteTotalForClaimsPageFifteen();" value="0" placeholder="0" name="amount_received_1_page_15" id="amount_received_1_page_15"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFifteen();" onkeyup="calculteTotalForClaimsPageFifteen();" value="0" placeholder="0" readonly name="balance_due_1_page_15" id="balance_due_1_page_15"></td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td><input name="type_of_claim_2_page_15" id="type_of_claim_2_page_15" readonly style="border: none" class="form-control text-center" value="Registration Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFifteen();" onkeyup="calculteTotalForClaimsPageFifteen();" value="0" placeholder="0" readonly name="amount_due_2_page_15" id="amount_due_2_page_15"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFifteen();" onkeyup="calculteTotalForClaimsPageFifteen();" value="0" placeholder="0" name="amount_received_2_page_15" id="amount_received_2_page_15"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFifteen();" onkeyup="calculteTotalForClaimsPageFifteen();" value="0" placeholder="0" readonly name="balance_due_2_page_15" id="balance_due_2_page_15"></td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td><input name="type_of_claim_3_page_15" id="type_of_claim_3_page_15" readonly style="border: none" class="form-control text-center" value="Tuition Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFifteen();" onkeyup="calculteTotalForClaimsPageFifteen();" value="0" placeholder="0" readonly name="amount_due_3_page_15" id="amount_due_3_page_15"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFifteen();" onkeyup="calculteTotalForClaimsPageFifteen();" value="0" placeholder="0" name="amount_received_3_page_15" id="amount_received_3_page_15"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFifteen();" onkeyup="calculteTotalForClaimsPageFifteen();" value="0" placeholder="0" readonly name="balance_due_3_page_15" id="balance_due_3_page_15"></td>
                    </tr>
                    <tr>
                      <th scope="row">4</th>
                      <td><input name="type_of_claim_4_page_15" id="type_of_claim_4_page_15" readonly style="border: none" class="form-control text-center" value="Lab Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFifteen();" onkeyup="calculteTotalForClaimsPageFifteen();" value="0" placeholder="0" readonly name="amount_due_4_page_15" id="amount_due_4_page_15"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFifteen();" onkeyup="calculteTotalForClaimsPageFifteen();" value="0" placeholder="0" name="amount_received_4_page_15" id="amount_received_4_page_15"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFifteen();" onkeyup="calculteTotalForClaimsPageFifteen();" value="0" placeholder="0" readonly name="balance_due_4_page_15" id="balance_due_4_page_15"></td>
                    </tr>
                    <tr>
                      <th scope="row">5</th>
                      <td><input name="type_of_claim_5_page_15" id="type_of_claim_5_page_15" readonly style="border: none" class="form-control text-center" value="Library Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFifteen();" onkeyup="calculteTotalForClaimsPageFifteen();" value="0" placeholder="0" readonly name="amount_due_5_page_15" id="amount_due_5_page_15"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFifteen();" onkeyup="calculteTotalForClaimsPageFifteen();" value="0" placeholder="0" name="amount_received_5_page_15" id="amount_received_5_page_15"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFifteen();" onkeyup="calculteTotalForClaimsPageFifteen();" value="0" placeholder="0" readonly name="balance_due_5_page_15" id="balance_due_5_page_15"></td>
                    </tr>
                    <tr>
                      <th scope="row">6</th>
                      <td><input name="type_of_claim_6_page_15" id="type_of_claim_6_page_15" readonly style="border: none" class="form-control text-center" value="Exam Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFifteen();" onkeyup="calculteTotalForClaimsPageFifteen();" value="0" placeholder="0" readonly name="amount_due_6_page_15" id="amount_due_6_page_15"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFifteen();" onkeyup="calculteTotalForClaimsPageFifteen();" value="0" placeholder="0" name="amount_received_6_page_15" id="amount_received_6_page_15"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFifteen();" onkeyup="calculteTotalForClaimsPageFifteen();" value="0" placeholder="0" readonly name="balance_due_6_page_15" id="balance_due_6_page_15"></td>
                    </tr>
                    <tr>
                      <th scope="row">7</th>
                      <td><input name="type_of_claim_7_page_15" id="type_of_claim_7_page_15" readonly style="border: none" class="form-control text-center" value="Transport Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFifteen();" onkeyup="calculteTotalForClaimsPageFifteen();" value="0" placeholder="0" readonly name="amount_due_7_page_15" id="amount_due_7_page_15"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFifteen();" onkeyup="calculteTotalForClaimsPageFifteen();" value="0" placeholder="0" name="amount_received_7_page_15" id="amount_received_7_page_15"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFifteen();" onkeyup="calculteTotalForClaimsPageFifteen();" value="0" placeholder="0" readonly name="balance_due_7_page_15" id="balance_due_7_page_15"></td>
                    </tr>
                    <tr>
                      <th scope="row">8</th>
                      <td><input name="type_of_claim_8_page_15" id="type_of_claim_8_page_15" readonly style="border: none" class="form-control text-center" value="Hostel Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFifteen();" onkeyup="calculteTotalForClaimsPageFifteen();" value="0" placeholder="0" readonly name="amount_due_8_page_15" id="amount_due_8_page_15"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFifteen();" onkeyup="calculteTotalForClaimsPageFifteen();" value="0" placeholder="0" name="amount_received_8_page_15" id="amount_received_8_page_15"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFifteen();" onkeyup="calculteTotalForClaimsPageFifteen();" value="0" placeholder="0" readonly name="balance_due_8_page_15" id="balance_due_8_page_15"></td>
                    </tr>
                    <tr>
                      <th scope="row">Total</th>
                      <td></td>
                      <th><input readonly style="border: none;" class="form-control text-center" name="amount_due_page_15" value="0" id="amount_due_page_15"></th>
                      <th><input readonly style="border: none;" class="form-control text-center" name="amount_received_page_15" value="0" id="amount_received_page_15"></th>
                      <th><input readonly style="border: none;" class="form-control text-center" name="balance_due_page_15" value="0" id="balance_due_page_15"></th>                      
                    </tr>
                    @endif
                  </tbody>
                </table>
            </div>
        </div>
        {{-- new Claim Fields end --}}
        {{-- new Claim Fields Start --}}
      <div style="margin-top: 50px; display: none;" class="card shadow p-3 w-100" id="provisional_claim_last_page_15">
        <div class="card-body">
          <div style="margin-top: 50px;" class="card shadow p-3 w-100">
            <div class="card-body">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Amount Received</th>
                      <th scope="col">Total Amount of Cheque</th>
                      <th scope="col">Cheque Date</th>
                      <th scope="col">Cheque no</th>
                      <th scope="col">Name of Bank</th>
                      <th scope="col">Reason / Remarks</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($data && isset($data['claims'][8]) && count($data['claims'][8]))
                        @php $i = 1; @endphp
                        {{-- @if($claims['page_number'] == 15) --}}
                         <tr>
                             <td><input name="amount_received_last_page_15" id="amount_received_last_page_15" onblur="calculteTotalForClaimsPageFifteen();" onkeyup="calculteTotalForClaimsPageFifteen();" readonly class="form-control text-center" value="{{$data && $data['claims']['8']['amount_received_last']? $data['claims']['8']['amount_received_last'] : ''}}" ></td>
                             <td><input type="number" name="total_amount_cheque_page_15" id="total_amount_cheque_page_15" class="form-control text-center" value="{{$data && $data['claims']['8']['total_amount_cheque']? $data['claims']['8']['total_amount_cheque'] : ''}}" ></td>
                             <td><input type="date" name="cheque_date_page_15" id="cheque_date_page_15" class="form-control text-center" value="{{$data && $data['claims']['8']['cheque_date']? $data['claims']['8']['cheque_date'] : ''}}" ></td>
                             <td><input type="number" name="cheque_no_page_15" id="cheque_no_page_15" class="form-control text-center" value="{{$data && $data['claims']['8']['cheque_no']? $data['claims']['8']['cheque_no'] : ''}}" ></td>
                             <td><input type="text" name="bank_name_page_15" id="bank_name_page_15" class="form-control text-center" value="{{$data && $data['claims']['8']['bank_name']? $data['claims']['8']['bank_name'] : ''}}" ></td>
                             <td><input type="text" name="reason_remarks_page_15" id="reason_remarks_page_15" class="form-control text-center" value="{{$data && $data['claims']['8']['reason_remarks']? $data['claims']['8']['reason_remarks'] : ''}}" ></td>
                         </tr>
                         {{-- @endif --}}
                    @else
                    <tr>
                      <td><input class="form-control text-center" type="number" readonly min="0" onblur="calculteTotalForClaimsPageFifteen();" onkeyup="calculteTotalForClaimsPageFifteen();" value="0" placeholder="0" name="amount_received_last_page_15" id="amount_received_last_page_15"></td>
                      <td><input class="form-control text-center" type="number" min="0" value="0" placeholder="0" name="total_amount_cheque_page_15" id="total_amount_cheque_page_15"></td>
                      <td><input class="form-control" type="date" style="text-transform: lowercase;" data-date-format="YYYY-MM-DD" name="cheque_date_page_15" id="cheque_date_page_15"></td>
                      <td><input class="form-control text-center" type="number" min="0" value="0" placeholder="0" name="cheque_no_page_15" id="cheque_no_page_15"></td>
                      <td><input class="form-control text-center" type="text" placeholder="Enter Bank Name" onkeypress="return lettersOnly(event)" name="bank_name_page_15" id="bank_name_page_15"></td>
                      <td><input class="form-control text-center" type="text" placeholder="Enter Remarks" name="reason_remarks_page_15" id="reason_remarks_page_15"></td>
                    </tr>
                    @endif
                  </tbody>
                </table>
            </div>
        </div>
      </div>
    </div>
        <br>
        {{-- new Claim Fields end --}}

                        <div class="form-row mt-4">
                            <div class="ml-2">
                                <label for="">Result Status:<span style="color: red;">*</span></label>
                            </div>
                            <div class="float-right ml-auto mr-2">
                                <button type="button" class="btn btn-primary float-right" onclick="cloneResultStatusAnnualPartOne()">
                                    <strong>+</strong></button>
                            </div>
                        </div>
                        <!-- result status -->
                        <div class="card shadow mt-3 p-3 w-100" >
                            <div class="card-body" id="result_status_annual_part_one_parent">
                                <div class="form-row pt-2">
                                    <div class="col-md-1 text-center">
                                        <label>Result:<span style="color: red;">*</span></label>
                                    </div>
                                    <div class="col-md-8 form-row ml-0" id="result_status_annual_part_one_pass_headers">
                                        <div class="col-md-3 text-center">
                                            <label>Fail:<span style="color: red;">*</span></label>
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <label>Chance of next Appearance:<span style="color: red;">*</span></label>
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <label>Next Appearance Date:<span style="color: red;">*</span></label>
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <label>Last Chance Date:<span style="color: red;">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center" id="result_status_annual_part_one_pass_header_passing">
                                        <label>Passing Date:<span style="color: red;">*</span></label>
                                    </div>
                                </div>
                                <!-- Result Status Edit Mode-->
                                @if($data && isset($data['first_annual_result_status_details']) && count($data['first_annual_result_status_details']))
                                    @foreach($data['first_annual_result_status_details'] as $firstAnnualResultStatusDetails)
                                        <div class="form-row mt-2" id="result_status_annual_part_one_div">
                                            <input type="hidden" value="{{$firstAnnualResultStatusDetails['id']}}" id="result_status_annual_part_one_delete_id">
                                            <div class="col-md-1 p-0">
                                                <select id="result_field_for_annual_part_one" name="result[]" class="form-control result_annual_part_one" onchange="resultChangedForAnnualPartOne(event)">
                                                    <option value="pass" {{ $firstAnnualResultStatusDetails['result'] == 'pass' ? 'selected' : ''}}>Pass</option>
                                                    <option value="fail" {{ $firstAnnualResultStatusDetails['result'] == 'fail' ? 'selected' : ''}}>Fail</option>
                                                </select>
                                            </div>
                                            <div class="col-md-8 form-row m-0" id="result_status_annual_part_one_pass_values_replacement" style="display: none"></div>
                                            <div class="col-md-8 form-row m-0" id="result_status_annual_part_one_pass_values" style="display: none">
                                                <div class="col-md-3 p-0">
                                                    <select name="fail[]" class="form-control promotion_annual_part_one" onchange="setDisplayForAnnualPartTwo()">
                                                        <option value="promoted" {{ $firstAnnualResultStatusDetails['fail'] == 'promoted' ? 'selected' : ''}}>Promoted</option>
                                                        <option value="notPromoted" {{ $firstAnnualResultStatusDetails['fail'] == 'notPromoted' ? 'selected' : ''}}>Not Promoted</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3 p-0">
                                                    <select name="next_appearance[]" id="next_appearance_15" class="form-control" onchange="nextAppearanceChangedForAnnualPartOne(event)">
                                                        <option value="yes" {{ $firstAnnualResultStatusDetails['next_appearance'] == 'yes' ? 'selected' : ''}}>Yes</option>
                                                        <option value="no" {{ $firstAnnualResultStatusDetails['next_appearance'] == 'no' ? 'selected' : ''}}>No</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3 p-0">
                                                    <input type="text" class="form-control text-center datepickerAll"
                                                           name="next_appearance_date[]" id="next_appearance_date_15" placeholder="Enter Date" value="{{$firstAnnualResultStatusDetails['next_appearance_date'] ?  date('d/m/Y',strtotime($firstAnnualResultStatusDetails['next_appearance_date'])) : ''}}">
                                                </div>
                                                <div class="col-md-3 p-0">
                                                    <input type="text" class="form-control text-center datepickerAll"
                                                           name="last_chance_date[]" id="last_chance_date_15" placeholder="Enter Date" value="{{ $firstAnnualResultStatusDetails['last_chance_date'] ? date('d/m/Y',strtotime($firstAnnualResultStatusDetails['last_chance_date'])) : ''}}">
                                                </div>
                                            </div>
                                            <div class="col-md-2 p-0" id="result_status_annual_part_one_pass_value_passing" style="display:none;">
                                                <input type="text" class="form-control text-center datepicker" id="passing_date_15" name="passing_date[]"
                                                       placeholder="Enter Date" value="{{ $firstAnnualResultStatusDetails['passing_date'] ? date('d/m/Y',strtotime($firstAnnualResultStatusDetails['passing_date'])) : ''}}">
                                            </div>
                                            <div class="col-md-1">
                                                <button id="removeResultStatusAnnualPartOneButton" type="button" class="btn btn-danger"
                                                        onclick="removeResultStatusAnnualPartOne(event)" @if ($firstAnnualResultStatusDetails == reset($data['first_annual_result_status_details'])) {{'disabled'}} @endif>-
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="form-row mt-2" id="result_status_annual_part_one_div">
                                        <div class="col-md-1 p-0">
                                            <select id="result_field_for_annual_part_one" name="result[]" class="form-control result_annual_part_one" onchange="resultChangedForAnnualPartOne(event)">
                                                <option value="" selected>--select--</option>
                                                <option value="pass">Pass</option>
                                                <option value="fail">Fail</option>
                                            </select>
                                        </div>
                                        <div class="col-md-8 form-row m-0" id="result_status_annual_part_one_pass_values_replacement" style="display: none"></div>
                                        <div class="col-md-8 form-row m-0" id="result_status_annual_part_one_pass_values" style="display: none">
                                            <div class="col-md-3 p-0">
                                                <select name="fail[]" class="form-control promotion_annual_part_one" onchange="setDisplayForAnnualPartTwo()">
                                                    <option value="promoted">Promoted</option>
                                                    <option value="notPromoted" selected>Not Promoted</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 p-0">
                                                <select name="next_appearance[]" id="next_appearance_15" class="form-control" onchange="nextAppearanceChangedForAnnualPartOne(event)">
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 p-0 nextAppearanceCheck">
                                                <input type="text" class="form-control text-center datepickerAll"
                                                       name="next_appearance_date[]" id="next_appearance_date_15" placeholder="Enter Date">
                                            </div>
                                            <div class="col-md-3 p-0 nextAppearanceCheck">
                                                <input type="text" class="form-control text-center datepickerAll"
                                                       name="last_chance_date[]" id="last_chance_date_15" placeholder="Enter Date">
                                            </div>
                                        </div>
                                        <div class="col-md-2 p-0" id="result_status_annual_part_one_pass_value_passing" style="display: none">
                                            <input type="text" class="form-control text-center datepicker" id="passing_date_15" name="passing_date[]"
                                                   placeholder="Enter Date">
                                        </div>
                                        <div class="col-md-1">
                                            <button id="removeResultStatusAnnualPartOneButton" type="button" class="btn btn-danger"
                                                    onclick="removeResultStatusAnnualPartOne(event)" disabled>-
                                            </button>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 mt-4">
                            <label for="" style="font-size: 20px;">Readmission:</label>
                        </div>
                        <div class="card shadow p-3 w-100">
                            <div class="card-body ">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Readmission:<span style="color: red;">*</span></label>
                                        <select name="readmission" id="setreadmission" class="form-control text-center" onchange="setReadmission(event)">
                                            <option value="" selected>--select--</option>
                                            @foreach(\Config::get('constants.general_yes_no') as $key => $general_yes_no)
                                                @if(isset($data['first_annual_details']['readmission']))
                                                    <option value="{{$key}}" {{ $data ? $data['first_annual_details']['readmission'] == $key ? 'selected' : '' : ''}}>{{$general_yes_no}}</option>
                                                @else
                                                    <option value="{{$key}}">{{$general_yes_no}}</option>
                                                @endif

                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="form-group col-md-4" id="same_course_page_15" style="display: none;">
                                        <label>Same Course:<span style="color: red;">*</span></label>
                                        <select id="same_course_15"  name="same_course" class="form-control">
                                            <option value="" selected>--select--</option>
                                            @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                                <option value="{{$key}}" {{ $data ? $data['first_annual_details'] != null ? $data['first_annual_details']['same_course'] == $key ? 'selected' : '' : '' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4" id="change_course_page_15" style="display: none;">
                                        <label>Changed Course:<span style="color: red;">*</span></label>
                                        <select id="change_course_15"  name="changed_course" class="form-control">
                                            <option value="" selected>--select--</option>
                                            @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                                <option value="{{$key}}" {{ $data ? $data['first_annual_details'] != null ? $data['first_annual_details']['changed_course'] == $key ? 'selected' : '' : '' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@section('script_page_15')
    <script>
        setDisplayForAnnualPartTwo();
        setResultHeaderDisplay();
        setFeeDepositStatus();
        setReadmission();
        function cloneResultStatusAnnualPartOne() {
            let clone = $('#result_status_annual_part_one_div').clone();
            clone.find('input:text').val('');
            $('#result_status_annual_part_one_parent').append(clone);
            let button = clone.find('#removeResultStatusAnnualPartOneButton').removeAttr('disabled');
            // let dropdown = $(clone.find('#result_field_for_annual_part_one').parent().siblings()[0]).hide();
            setResultHeaderDisplay();
            clone.find('.datepicker').each(function (index, pick) {
                let picker = $(pick).datepicker({
                    format: 'dd/mm/yyyy'
                }).on('changeDate', function (ev) {
                    setAccumulatedYears();
                    picker.hide();
                }).data('datepicker');
            });
            setDisplayForAnnualPartTwo();
        }

        function removeResultStatusAnnualPartOne(event) {
            if(index_id) {
                let csrf_token = $('meta[name="csrf-token"]').attr('content');
                let request = $.ajax({
                    url: '/annual-part-one-delete',
                    method: "POST",
                    data: {
                        'index_id' : index_id,
                        'id' : $(event.target).parent().parent().find('#result_status_annual_part_one_delete_id').val()
                    },
                    headers:{
                        'X-CSRF-TOKEN':csrf_token
                    }
                });

                request.done(function (response) {
                });

                request.fail(function (jqXHR, textStatus) {
                    alert("Request failed: " + textStatus);
                });
            }
            $(event.target).parent().parent().remove();
            setDisplayForAnnualPartTwo();
        }

        function resultChangedForAnnualPartOne(event) {
            setResultHeaderDisplay();
            if($(event.target).val() == 'fail'){
                $('#passing_date_15').val('');
                $('.annual-tab-conversion').remove();
                $('.annual-tab2').remove();
                $('#v-pills-tab').append('<a onclick="enableSave();" class="nav-link annual-tab annual-tab-conversion aa" id="v-pills-page_25-tab" data-toggle="pill" href="#v-pills-page_25" role="tab" aria-controls="v-pills-page_25" aria-selected="true">Conversion in Next Degree</a>');
                $(event.target).parent().parent().find('#result_status_annual_part_one_pass_values').fadeIn();
                $(event.target).parent().parent().find('#result_status_annual_part_one_pass_values_replacement').fadeOut();
                $(event.target).parent().parent().find('#result_status_annual_part_one_pass_value_passing').fadeOut();
            }
            else if($(event.target).val() == 'pass'){
                $('#last_chance_date_15').val('');
                $('#next_appearance_15').val('no');
                $('#next_appearance_date_15').val('');
                $('.annual-tab-conversion').remove();
                $('#v-pills-tab').append('<a class="nav-link annual-tab annual-tab2 aa" id="v-pills-page_16-tab" data-toggle="pill" href="#v-pills-page_16" role="tab" aria-controls="v-pills-page_16" aria-selected="true">Continue 1(Annual Part 2)</a><a onclick="enableSave();" class="nav-link annual-tab annual-tab-conversion aa" id="v-pills-page_25-tab" data-toggle="pill" href="#v-pills-page_25" role="tab" aria-controls="v-pills-page_25" aria-selected="true">Conversion in Next Degree</a>');

                $(event.target).parent().parent().find('#result_status_annual_part_one_pass_values').fadeOut();
                $(event.target).parent().parent().find('#result_status_annual_part_one_pass_values_replacement').fadeIn();
                $(event.target).parent().parent().find('#result_status_annual_part_one_pass_value_passing').fadeIn();
            }
            else{
                $(event.target).parent().parent().find('#result_status_annual_part_one_pass_values').fadeOut();
                $(event.target).parent().parent().find('#result_status_annual_part_one_pass_values_replacement').fadeOut();
                $(event.target).parent().parent().find('#result_status_annual_part_one_pass_value_passing').fadeOut();
            }
            setDisplayForAnnualPartTwo();
        }

        function nextAppearanceChangedForAnnualPartOne(event) {
            if($(event.target).val() == 'no'){
                $(event.target).parent().parent().find('.nextAppearanceCheck').fadeOut();
            }
            else if($(event.target).val() == 'yes'){
                $(event.target).parent().parent().find('.nextAppearanceCheck').fadeIn();
            }
        }

        function setResultHeaderDisplay() {
            $('.result_annual_part_one').each(function (index,value) {
                if($(value).val() == 'fail'){
                    $(value).parent().parent().find('#result_status_annual_part_one_pass_values').show();
                    $(value).parent().parent().find('#result_status_annual_part_one_pass_values_replacement').hide();
                    $(value).parent().parent().find('#result_status_annual_part_one_pass_value_passing').hide();
                }
                else if($(value).val() == 'pass'){
                    $(value).parent().parent().find('#result_status_annual_part_one_pass_values').hide();
                    $(value).parent().parent().find('#result_status_annual_part_one_pass_values_replacement').show();
                    $(value).parent().parent().find('#result_status_annual_part_one_pass_value_passing').show();
                }
                else{
                    $(value).parent().parent().find('#result_status_annual_part_one_pass_values').hide();
                    $(value).parent().parent().find('#result_status_annual_part_one_pass_values_replacement').hide();
                    $(value).parent().parent().find('#result_status_annual_part_one_pass_value_passing').hide();
                }
            });
        }

        function setDisplayForAnnualPartTwo(){
            let check = true;
            let term_array = {
                '2': '#bise_academic_term',
                '3': '#ims_academic_term',
                '1': '#af_academic_term',
                '4': '#vti_scheme_of_study'
            };
            let parent = $('#cfe_wing_selection option:selected').val();
            // if(parent == 'vti'){
            //     return;
            // }
            let selectedTerm = $(term_array[parent]).val();
            if(selectedTerm == '0') {
                let allResults = $('.result_annual_part_one');
                let length = allResults.length;
                if ($(allResults[length - 1]).val() == 'pass') {
                    $('#page_16').show();

                    if(total_sem_count > 1){
                        container_array.splice(11, 0, '#page_16');
                        api_url_array.splice(11, 0, '/annual-part-two');
                        $('.annual-tab-conversion').remove();
                        $('.annual-tab2').remove();
                        $('#v-pills-tab').append('<a class="nav-link annual-tab annual-tab2 aa" id="v-pills-page_16-tab" data-toggle="pill" href="#v-pills-page_16" role="tab" aria-controls="v-pills-page_16" aria-selected="true">Continue 1(Annual Part 2)</a><a onclick="enableSave();" class="nav-link annual-tab annual-tab-conversion aa" id="v-pills-page_25-tab" data-toggle="pill" href="#v-pills-page_25" role="tab" aria-controls="v-pills-page_25" aria-selected="true">Conversion in Next Degree</a>');
                    }
                    else{
                        $('.annual-tab-conversion').remove();
                        $('.annual-tab2').remove();
                        $('#page_16').hide();
                        $('#v-pills-page_16-tab').remove();
                        $('#v-pills-tab').append('<a onclick="enableSave();" class="nav-link annual-tab annual-tab-conversion aa" id="v-pills-page_25-tab" data-toggle="pill" href="#v-pills-page_25" role="tab" aria-controls="v-pills-page_25" aria-selected="true">Conversion in Next Degree</a>');
                        // $('#v-pills-page_25').addClass('active');
                    }
                    // $('.annual-tab2').remove();
                    // $('#v-pills-tab').append('<a class="nav-link annual-tab annual-tab2 aa" id="v-pills-page_16-tab" data-toggle="pill" href="#v-pills-page_16" role="tab" aria-controls="v-pills-page_16" aria-selected="true">Continue 1(Annual Part 2)</a><a class="nav-link annual-tab annual-tab-conversion aa" id="v-pills-page_25-tab" data-toggle="pill" href="#v-pills-page_25" role="tab" aria-controls="v-pills-page_25" aria-selected="true">Conversion in Next Degree</a>');

                }else {
                    let allPromotions = $('.promotion_annual_part_one');
                    let lengthForPromotion = allPromotions.length;
                    if ($(allPromotions[lengthForPromotion - 1]).val() == 'promoted') {
                        $('#page_16').show();
                        if(total_sem_count > 1){
                            container_array.splice(11, 0, '#page_16');
                            api_url_array.splice(11, 0, '/annual-part-two');
                            $('.annual-tab-conversion').remove();
                            $('.annual-tab2').remove();
                            $('#v-pills-tab').append('<a class="nav-link annual-tab annual-tab2 aa" id="v-pills-page_16-tab" data-toggle="pill" href="#v-pills-page_16" role="tab" aria-controls="v-pills-page_16" aria-selected="true">Continue 1(Annual Part 2)</a><a onclick="enableSave();"  class="nav-link annual-tab annual-tab-conversion aa" id="v-pills-page_25-tab" data-toggle="pill" href="#v-pills-page_25" role="tab" aria-controls="v-pills-page_25" aria-selected="true">Conversion in Next Degree</a>');
                        }
                        else{
                            $('.annual-tab-conversion').remove();
                            $('.annual-tab2').remove();
                            $('#page_16').hide();
                            $('#v-pills-page_16-tab').remove();
                            $('#v-pills-tab').append('<a onclick="enableSave();" class="nav-link annual-tab annual-tab-conversion aa" id="v-pills-page_25-tab" data-toggle="pill" href="#v-pills-page_25" role="tab" aria-controls="v-pills-page_25" aria-selected="true">Conversion in Next Degree</a>');
                            // $('#v-pills-page_25').addClass('active');
                        }
                        // $('.annual-tab2').remove();
                        // $('#v-pills-tab').append('<a class="nav-link annual-tab annual-tab2 aa" id="v-pills-page_16-tab" data-toggle="pill" href="#v-pills-page_16" role="tab" aria-controls="v-pills-page_16" aria-selected="true">Continue 1(Annual Part 2)</a><a class="nav-link annual-tab annual-tab-conversion aa" id="v-pills-page_25-tab" data-toggle="pill" href="#v-pills-page_25" role="tab" aria-controls="v-pills-page_25" aria-selected="true">Conversion in Next Degree</a>');

                    } else {
                        container_array.splice(11, container_array.length - 11);
                        api_url_array.splice(11, api_url_array.length - 11);
                        container_no = 10;
                        $('#page_16').hide();
                        // $('.annual-tab-conversion').remove();
                        $('#v-pills-page_16-tab').remove();
                        $('.annual-tab2').remove();
                    }
                }
            }
            setDisplayForButtons();
            $('input[name="next_appearance_date[]"').datepicker({
                format:'dd/mm/yyyy',
                // startDate: new Date(),
                autoclose: true
            });
            $('input[name="last_chance_date[]"').datepicker({
                format:'dd/mm/yyyy',
                // startDate: new Date(),
                autoclose: true
            });
        }

        function setFeeDepositStatus() {
            if($('#fee_deposit_status_page15').val() == 'yes'){
                $('#date_div_page15').fadeIn();
                $('#amount_div_page15').fadeIn();
            }
            else{
                $('#date_div_page15').fadeOut();
                $('#amount_div_page15').fadeOut();
            }
        }
        function setReadmission(e) {
            let selected = $('select[name="readmission"]').val();
            if(selected == 'yes'){
                $('#same_course_page_15').show();
                $('#change_course_page_15').show();

            }
            else{
                if(!index_id){
                    $('#same_course_15').val('');
                    $('#change_course_15').val('');
                }
                $('#same_course_page_15').hide();
                $('#change_course_page_15').hide();
                // $('#same_course_15').val('');
                // $('#change_course_15').val('');
            }
        }
        setDisplayForClaimReceivedPage15();
         function setDisplayForClaimReceivedPage15() {
            if($('#claim_status_page_15').val() == 'received'){
                for (var i = 1; i <= 8; i++) {
                  $(`#amount_due_${i}_page_15`).val($(`#claim_amount_due_default_${i}_page_15`).val());
                  calculteTotalForClaimsPageFifteen();
                }
                $('#recovered_amount_div_page_15').fadeOut();
                $('#outstanding_cfe_fee_div_page_15').fadeOut();
                $('#reason_div_page_15').fadeOut();            
                $('#claims_statuses_table_page_15').fadeIn();
                $('#provisional_claim_last_page_15').fadeIn();
            }
            else if($('#claim_status_page_15').val() == 'rejected'){
              $('#recovered_amount_div_page_15').fadeIn();
                $('#outstanding_cfe_fee_div_page_15').fadeIn();
                $('#reason_div_page_15').fadeIn();
                $('#claims_statuses_table_page_15').fadeOut();
                $('#provisional_claim_last_page_15').fadeOut();
            }
            else if($('#claim_status_page_15').val() == 'notReceived'){
              $('#recovered_amount_div_page_15').fadeOut();
                $('#outstanding_cfe_fee_div_page_15').fadeOut();
                $('#reason_div_page_15').fadeIn();
                $('#claims_statuses_table_page_15').fadeOut();
                $('#provisional_claim_last_page_15').fadeOut();
            }
            else if($('#claim_status_page_15').val() == 'cancelled'){
              $('#recovered_amount_div_page_15').fadeOut();
                $('#outstanding_cfe_fee_div_page_15').fadeOut();
                $('#reason_div_page_15').fadeIn();
                $('#claims_statuses_table_page_15').fadeOut();
                $('#provisional_claim_last_page_15').fadeOut();
            }
            else{
              $('#recovered_amount_div_page_15').fadeOut();
                $('#outstanding_cfe_fee_div_page_15').fadeOut();
                $('#reason_div_page_15').fadeOut();
                $('#claims_statuses_table_page_15').fadeOut();
                $('#provisional_claim_last_page_15').fadeOut();
            }
        }

        function calculteTotalForClaimsPageFifteen(){
            var claim_amount_due_default_page_15 = 0;
            var amount_due_page_15 = 0;
            var amount_received_page_15 = 0;
            var balance_due_page_15 = 0;

            for (var i = 1; i <= 8; i++) {
              $(`#amount_due_${i}_page_15`).val($(`#claim_amount_due_default_${i}_page_15`).val());
            }

            for(var i = 1; i <= 8; i++){
                var total_balance = 0;
                claim_amount_due_default_page_15 = parseFloat(claim_amount_due_default_page_15) + parseFloat($('#claim_amount_due_default_'+i+'_page_15').val());
                if($('#claim_amount_due_default_'+i+'_page_15').val() == ""){
                      $('#claim_amount_due_default_'+i+'_page_15').val('0');
                  }
                amount_due_page_15 = parseFloat(amount_due_page_15) + parseFloat($('#amount_due_'+i+'_page_15').val());
                if($('#amount_due_'+i+'_page_15').val() == ""){
                      $('#amount_due_'+i+'_page_15').val('0');
                  }
                amount_received_page_15 = parseFloat(amount_received_page_15) + parseFloat($('#amount_received_'+i+'_page_15').val());
                if($('#amount_received_'+i+'_page_15').val() == ""){
                      $('#amount_received_'+i+'_page_15').val('0');
                  }

                  if (parseFloat($('#amount_received_'+i+'_page_15').val()) > parseFloat($('#amount_due_'+i+'_page_15').val())) {
                  $('#amount_received_'+i+'_page_15').val('0');
                  $.notify('Amount Due cannot be less than Amount Received!');
                  }

               balance_due_page_15 = parseFloat(balance_due_page_15) + parseFloat($('#balance_due_'+i+'_page_15').val());
                if(amount_due_page_15 < amount_received_page_15){
                    // alert("Amount Received Cannot Be Higher Then Amount Due");
                    $('#amount_received_'+i+'_page_15').val()
                    // return false;
                }    
                if($('#amount_due_'+i+'_page_15').val() != "0" || $('#amount_received_'+i+'_page_15').val() != "0"){
                    total_balance = parseFloat($('#amount_due_'+i+'_page_15').val()) - parseFloat($('#amount_received_'+i+'_page_15').val());
                    $('#balance_due_'+i+'_page_15').val(total_balance);
                }              
            }
            
            $('#claim_amount_due_default_page_15').val(claim_amount_due_default_page_15);
            $('#amount_due_page_15').val(amount_due_page_15);
            $('#amount_received_page_15').val(amount_received_page_15);
            $('#balance_due_page_15').val(balance_due_page_15);
            $('#claim_due_page_15').val(claim_amount_due_default_page_15);
            $('#amount_received_last_page_15').val(amount_received_page_15);
        }
       </script>
    </script>
@endsection
