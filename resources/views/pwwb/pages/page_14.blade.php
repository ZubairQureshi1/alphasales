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
    input{
        text-transform: capitalize;
    }
</style>
<div id="page_14">
    <h1>Provisional Letter Status / Claim Status<span class="float-right">Page # 10</span></h1><br>
    <form id="page_14_form">
        <div class="card shadow p-3 w-100">
            <div class="card-body ">
                <div class="form-row">
                    <div class="form-group  col-md-4">
                        <label>Status:<span style="color: red;">*</span></label>
                        <select id="status_page10" onchange="setStatusDateDisplay()" name="status" class="form-control">
                            <option value="" selected>--select--</option>
                            @foreach(\Config::get('constants.status') as $key => $value)
                                <option value="{{$key}}" {{ $data ? $data['provisional_claim_details']['status'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3" id="status_div_page10" style="display: none">
                        <label>Date:<span style="color: red;">*</span></label>
                        <input type="text" id="provisional_issued_1" class="form-control text-center datepicker" name="provisional_letter_date" placeholder="Enter Date"
                        value="{{$data && $data['provisional_claim_details']['provisional_letter_date']? date('d/m/Y',strtotime($data['provisional_claim_details']['provisional_letter_date'])) : ''}}">
                    </div>
                    <div class="form-group  col-md-4">
                        <label>Scrutiny Committee  meeting date:<span style="color: red;">*</span></label>
                        <input type="text" id="scrutiny_committee" class="form-control text-center datepicker" name="scrutiny_committee" placeholder="Enter Scrutiny Committee  meating date"
                               value="{{$data && $data['provisional_claim_details']['scrutiny_committee']? date('d/m/Y',strtotime($data['provisional_claim_details']['scrutiny_committee'])) : ''}}">
                    </div>
                </div>
                <div class="form-row ">
                    <div class="form-group  col-md-4">
                    <label>Batch number:<span style="color: red;">*</span></label>
                    <input type="text" id="bactch_number" class="form-control text-center" name="bactch_number" placeholder="Enter Batch Number"
                           value="{{$data && $data['provisional_claim_details']['bactch_number']? $data['provisional_claim_details']['bactch_number'] : ''}}">
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
                    @if($data && isset($data['claims']) && count($data['claims']))
                        @php $i = 1; @endphp
                        @foreach($data['claims'] as $claims)
                        @if($claims['page_number'] == 14)
                         <tr>
                             <th scope="row">{{ $i++ }}</th>
                             <td><input name="claim_head_default_{{$i-1}}_page_14" id="claim_head_default_{{$i-1}}_page_14" readonly style="border: none" class="form-control text-center" value="{{$claims['claim_head_default']}}" ></td>
                             <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFourteen();" onkeyup="calculteTotalForClaimsPageFourteen();" value="{{$claims['claim_amount_due_default']}}" placeholder="0" name="claim_amount_due_default_{{$i-1}}_page_14" id="claim_amount_due_default_{{$i-1}}_page_14"></td>
                         </tr>
                         @endif
                        @endforeach
                         <tr>
                          <th scope="row">Total</th>
                          <td></td>
                          <th><input readonly style="border: none;" class="form-control text-center" name="claim_amount_due_default_page_14" value="{{$data && $data['claims']['0']['total_amount_due_default']? $data['claims']['0']['total_amount_due_default'] : ''}}" id="claim_amount_due_default_page_14"></th>
                        </tr>
                    @else
                    <tr>
                      <th scope="row">1</th>
                      <td><input name="claim_head_default_1_page_14" id="claim_head_default_1_page_14" readonly style="border: none" class="form-control text-center" value="Admission Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFourteen();" onkeyup="calculteTotalForClaimsPageFourteen();" value="0" placeholder="0" name="claim_amount_due_default_1_page_14" id="claim_amount_due_default_1_page_14"></td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td><input name="claim_head_default_2_page_14" id="claim_head_default_2_page_14" readonly style="border: none" class="form-control text-center" value="Registration Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFourteen();" onkeyup="calculteTotalForClaimsPageFourteen();" value="0" placeholder="0" name="claim_amount_due_default_2_page_14" id="claim_amount_due_default_2_page_14"></td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td><input name="claim_head_default_3_page_14" id="claim_head_default_3_page_14" readonly style="border: none" class="form-control text-center" value="Tuition Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFourteen();" onkeyup="calculteTotalForClaimsPageFourteen();" value="0" placeholder="0" name="claim_amount_due_default_3_page_14" id="claim_amount_due_default_3_page_14"></td>
                    </tr>
                    <tr>
                      <th scope="row">4</th>
                      <td><input name="claim_head_default_4_page_14" id="claim_head_default_4_page_14" readonly style="border: none" class="form-control text-center" value="Lab Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFourteen();" onkeyup="calculteTotalForClaimsPageFourteen();" value="0" placeholder="0" name="claim_amount_due_default_4_page_14" id="claim_amount_due_default_4_page_14"></td>
                    </tr>
                    <tr>
                      <th scope="row">5</th>
                      <td><input name="claim_head_default_5_page_14" id="claim_head_default_5_page_14" readonly style="border: none" class="form-control text-center" value="Library Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFourteen();" onkeyup="calculteTotalForClaimsPageFourteen();" value="0" placeholder="0" name="claim_amount_due_default_5_page_14" id="claim_amount_due_default_5_page_14"></td>
                    </tr>
                    <tr>
                      <th scope="row">6</th>
                      <td><input name="claim_head_default_6_page_14" id="claim_head_default_6_page_14" readonly style="border: none" class="form-control text-center" value="Exam Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFourteen();" onkeyup="calculteTotalForClaimsPageFourteen();" value="0" placeholder="0" name="claim_amount_due_default_6_page_14" id="claim_amount_due_default_6_page_14"></td>
                    </tr>
                    <tr>
                      <th scope="row">7</th>
                      <td><input name="claim_head_default_7_page_14" id="claim_head_default_7_page_14" readonly style="border: none" class="form-control text-center" value="Transport Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFourteen();" onkeyup="calculteTotalForClaimsPageFourteen();" value="0" placeholder="0" name="claim_amount_due_default_7_page_14" id="claim_amount_due_default_7_page_14"></td>
                     </tr>
                     <tr>
                      <th scope="row">8</th>
                      <td><input name="claim_head_default_8_page_14" id="claim_head_default_8_page_14" readonly style="border: none" class="form-control text-center" value="Hostel Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFourteen();" onkeyup="calculteTotalForClaimsPageFourteen();" value="0" placeholder="0" name="claim_amount_due_default_8_page_14" id="claim_amount_due_default_8_page_14"></td>
                     </tr>
                    <tr>
                      <th scope="row">Total</th>
                      <td></td>
                      <th><input readonly style="border: none;" class="form-control text-center" name="claim_amount_due_default_page_14" value="0" id="claim_amount_due_default_page_14"></th>
                                          
                    </tr>
                    @endif
                  </tbody>
                </table>
            </div>
        </div>
        <br>
        {{-- new Claim Fields end --}}
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>Amount of Claim Due:<span style="color: red;">*</span></label>
                        <input type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center" name="claim_due_page_14" id="claim_due_page_14" placeholder="Enter Claim Due" value="{{$data && isset($data['claims']['0']['claim_due'])? $data['claims']['0']['claim_due'] : ''}}">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Status Of Claim:<span style="color: red;">*</span></label>
                        <select onchange="setDisplayForClaimReceivedPage14()" id="claim_status_page_14" name="claim_status_page_14" class="form-control">
                            <option value="" selected>--select--</option>
                            @foreach(\Config::get('constants.claim_status') as $key => $value)
                                <option value="{{$key}}" @if(isset($data['claims'][0])) {{ $data ? $data['claims']['0']['claim_status'] == $key ? 'selected' : '' : ''}} @endif>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3" id="reason_div_page_14">
                        <label>Reason:<span style="color: red;">*</span></label>
                        <input type="text" class="form-control text-center" name="reason_page_14" id="reason_page_14" placeholder="Enter Reason" value="@if(isset($data['claims'][0])) {{$data && $data['claims']['0']['reason']? $data['claims']['0']['reason'] : ''}} @endif">
                    </div>

                     <div class="form-group col-md-3" id="outstanding_cfe_fee_div_page_14" style="display: none;">
                        <label>Outstanding CFE Fee:<span style="color: red;">*</span></label>
                        <input type="number" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center" name="outstanding_cfe_fee_page_14" id="outstanding_cfe_fee_page_14" placeholder="Enter Fee" value="{{$data && isset($data['claims']['0']['outstanding_cfe_fee'])? $data['claims']['0']['outstanding_cfe_fee'] : ''}}">
                    </div>
                    <div class="form-group col-md-3" id="recovered_amount_div_page_14" style="display: none;">
                        <label>Recovered Amount From Student:<span style="color: red;">*</span></label>
                        <input type="number" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center" name="recovered_amount_page_14" id="recovered_amount_page_14" placeholder="Enter Recovered Amount" value="{{$data && isset($data['claims']['0']['recovered_amount'])? $data['claims']['0']['recovered_amount'] : ''}}">
                    </div>
                </div>
            </div>
        </div>
        <div style="margin-top: 50px;" class="card shadow p-3 w-100" id="claims_statuses_table_page_14">
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
                    @if($data && isset($data['claims'][0]) && count($data['claims']))
                        @php $i = 1; @endphp
                        @foreach($data['claims'] as $claims)
                        @if($claims['page_number'] == 14)
                         <tr>
                             <th scope="row">{{ $i++ }}</th>
                             <td><input name="type_of_claim_{{$i-1}}_page_14" id="type_of_claim_{{$i-1}}_page_14" readonly style="border: none" class="form-control text-center" value="{{$claims['claim_head']}}" ></td>
                             <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFourteen();" onkeyup="calculteTotalForClaimsPageFourteen();" value="{{$claims['amount_due']}}" placeholder="0" readonly="" name="amount_due_{{$i-1}}_page_14" id="amount_due_{{$i-1}}_page_14"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFourteen();" onkeyup="calculteTotalForClaimsPageFourteen();" value="{{$claims['amount_received']}}" placeholder="0" name="amount_received_{{$i-1}}_page_14" id="amount_received_{{$i-1}}_page_14"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFourteen();" onkeyup="calculteTotalForClaimsPageFourteen();" value="{{$claims['amount_balance']}}" placeholder="0" readonly name="balance_due_{{$i-1}}_page_14" id="balance_due_{{$i-1}}_page_14"></td>
                         </tr>
                         @endif
                        @endforeach
                         <tr>
                          <th scope="row">Total</th>
                          <td></td>
                          <th><input readonly style="border: none;" class="form-control text-center" name="amount_due_page_14" value="{{$data && $data['claims']['0']['total_amount_due']? $data['claims']['0']['total_amount_due'] : ''}}" id="amount_due_page_14"></th>
                          <th><input readonly style="border: none;" class="form-control text-center" name="amount_received_page_14" value="{{$data && $data['claims']['0']['total_amount_received']? $data['claims']['0']['total_amount_received'] : ''}}" id="amount_received_page_14"></th>
                          <th><input readonly style="border: none;" class="form-control text-center" name="balance_due_page_14" value="{{$data && $data['claims']['0']['total_amount_balance']? $data['claims']['0']['total_amount_balance'] : ''}}" id="balance_due_page_14"></th>                      
                        </tr>
                    @else
                    <tr>
                      <th scope="row">1</th>
                      <td><input name="type_of_claim_1_page_14" id="type_of_claim_1_page_14" readonly style="border: none" class="form-control text-center" value="Admission Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFourteen();" onkeyup="calculteTotalForClaimsPageFourteen();" value="0" placeholder="0"  readonly name="amount_due_1_page_14" id="amount_due_1_page_14"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFourteen();" onkeyup="calculteTotalForClaimsPageFourteen();" value="0" placeholder="0" name="amount_received_1_page_14" id="amount_received_1_page_14"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFourteen();" onkeyup="calculteTotalForClaimsPageFourteen();" value="0" placeholder="0" readonly name="balance_due_1_page_14" id="balance_due_1_page_14"></td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td><input name="type_of_claim_2_page_14" id="type_of_claim_2_page_14" readonly style="border: none" class="form-control text-center" value="Registration Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFourteen();" onkeyup="calculteTotalForClaimsPageFourteen();" value="0" placeholder="0"  readonly name="amount_due_2_page_14" id="amount_due_2_page_14"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFourteen();" onkeyup="calculteTotalForClaimsPageFourteen();" value="0" placeholder="0" name="amount_received_2_page_14" id="amount_received_2_page_14"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFourteen();" onkeyup="calculteTotalForClaimsPageFourteen();" value="0" placeholder="0" readonly name="balance_due_2_page_14" id="balance_due_2_page_14"></td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td><input name="type_of_claim_3_page_14" id="type_of_claim_3_page_14" readonly style="border: none" class="form-control text-center" value="Tuition Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFourteen();" onkeyup="calculteTotalForClaimsPageFourteen();" value="0" placeholder="0" readonly name="amount_due_3_page_14"  id="amount_due_3_page_14"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFourteen();" onkeyup="calculteTotalForClaimsPageFourteen();" value="0" placeholder="0" name="amount_received_3_page_14" id="amount_received_3_page_14"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFourteen();" onkeyup="calculteTotalForClaimsPageFourteen();" value="0" placeholder="0" readonly name="balance_due_3_page_14" id="balance_due_3_page_14"></td>
                    </tr>
                    <tr>
                      <th scope="row">4</th>
                      <td><input name="type_of_claim_4_page_14" id="type_of_claim_4_page_14" readonly style="border: none" class="form-control text-center" value="Lab Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFourteen();" onkeyup="calculteTotalForClaimsPageFourteen();" value="0" placeholder="0" readonly name="amount_due_4_page_14"  id="amount_due_4_page_14"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFourteen();" onkeyup="calculteTotalForClaimsPageFourteen();" value="0" placeholder="0" name="amount_received_4_page_14" id="amount_received_4_page_14"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFourteen();" onkeyup="calculteTotalForClaimsPageFourteen();" value="0" placeholder="0" readonly name="balance_due_4_page_14" id="balance_due_4_page_14"></td>
                    </tr>
                    <tr>
                      <th scope="row">5</th>
                      <td><input name="type_of_claim_5_page_14" id="type_of_claim_5_page_14" readonly style="border: none" class="form-control text-center" value="Library Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFourteen();" onkeyup="calculteTotalForClaimsPageFourteen();" value="0" placeholder="0" readonly name="amount_due_5_page_14"  id="amount_due_5_page_14"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFourteen();" onkeyup="calculteTotalForClaimsPageFourteen();" value="0" placeholder="0" name="amount_received_5_page_14" id="amount_received_5_page_14"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFourteen();" onkeyup="calculteTotalForClaimsPageFourteen();" value="0" placeholder="0" readonly name="balance_due_5_page_14" id="balance_due_5_page_14"></td>
                    </tr>
                    <tr>
                      <th scope="row">6</th>
                      <td><input name="type_of_claim_6_page_14" id="type_of_claim_6_page_14" readonly style="border: none" class="form-control text-center" value="Exam Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFourteen();" onkeyup="calculteTotalForClaimsPageFourteen();" value="0" placeholder="0" readonly name="amount_due_6_page_14"  id="amount_due_6_page_14"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFourteen();" onkeyup="calculteTotalForClaimsPageFourteen();" value="0" placeholder="0" name="amount_received_6_page_14" id="amount_received_6_page_14"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFourteen();" onkeyup="calculteTotalForClaimsPageFourteen();" value="0" placeholder="0" readonly name="balance_due_6_page_14" id="balance_due_6_page_14"></td>
                    </tr>
                    <tr>
                      <th scope="row">7</th>
                      <td><input name="type_of_claim_7_page_14" id="type_of_claim_7_page_14" readonly style="border: none" class="form-control text-center" value="Transport Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFourteen();" onkeyup="calculteTotalForClaimsPageFourteen();" value="0" placeholder="0" readonly name="amount_due_7_page_14"  id="amount_due_7_page_14"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFourteen();" onkeyup="calculteTotalForClaimsPageFourteen();" value="0" placeholder="0" name="amount_received_7_page_14" id="amount_received_7_page_14"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFourteen();" onkeyup="calculteTotalForClaimsPageFourteen();" value="0" placeholder="0" readonly name="balance_due_7_page_14" id="balance_due_7_page_14"></td>
                    </tr>
                    <tr>
                      <th scope="row">8</th>
                      <td><input name="type_of_claim_8_page_14" id="type_of_claim_8_page_14" readonly style="border: none" class="form-control text-center" value="Hostel Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFourteen();" onkeyup="calculteTotalForClaimsPageFourteen();" value="0" placeholder="0" readonly name="amount_due_8_page_14"  id="amount_due_8_page_14"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFourteen();" onkeyup="calculteTotalForClaimsPageFourteen();" value="0" placeholder="0" name="amount_received_8_page_14" id="amount_received_8_page_14"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageFourteen();" onkeyup="calculteTotalForClaimsPageFourteen();" value="0" placeholder="0" readonly name="balance_due_8_page_14" id="balance_due_8_page_14"></td>
                    </tr>
                    <tr>
                      <th scope="row">Total</th>
                      <td></td>
                      <th><input readonly style="border: none;" class="form-control text-center" name="amount_due_page_14" value="0" id="amount_due_page_14"></th>
                      <th><input readonly style="border: none;" class="form-control text-center" name="amount_received_page_14" value="0" id="amount_received_page_14"></th>
                      <th><input readonly style="border: none;" class="form-control text-center" name="balance_due_page_14" value="0" id="balance_due_page_14"></th>                      
                    </tr>
                    @endif
                  </tbody>
                </table>
            </div>
        </div>
        {{-- new Claim Fields end --}}

        {{-- new Claim Fields Start --}}
      <div style="margin-top: 50px; display: none;" class="card shadow p-3 w-100" id="provisional_claim_last">
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
                    @if($data && isset($data['claims'][0]) && count($data['claims']))
                        @php $i = 1; @endphp
                        @foreach($data['claims'] as $claims)
                        @if($loop->first)
                        @if($claims['page_number'] == 14)
                         <tr>
                             <td><input name="amount_received_last_page_14" id="amount_received_last_page_14" onblur="calculteTotalForClaimsPageFourteen();" onkeyup="calculteTotalForClaimsPageFourteen();" readonly class="form-control text-center" value="{{$data && $data['claims']['0']['amount_received_last']? $data['claims']['0']['amount_received_last'] : ''}}" ></td>
                             <td><input type="number" name="total_amount_cheque_page_14" id="total_amount_cheque_page_14" class="form-control text-center" value="{{$data && $data['claims']['0']['total_amount_cheque']? $data['claims']['0']['total_amount_cheque'] : ''}}" ></td>
                             <td><input type="date" name="cheque_date_page_14" id="cheque_date_page_14" class="form-control text-center" value="{{$data && $data['claims']['0']['cheque_date']? $data['claims']['0']['cheque_date'] : ''}}" ></td>
                             <td><input type="number" name="cheque_no_page_14" id="cheque_no_page_14" class="form-control text-center" value="{{$data && $data['claims']['0']['cheque_no']? $data['claims']['0']['cheque_no'] : ''}}" ></td>
                             <td><input type="text" name="bank_name_page_14" id="bank_name_page_14" class="form-control text-center" value="{{$data && $data['claims']['0']['bank_name']? $data['claims']['0']['bank_name'] : ''}}" ></td>
                             <td><input type="text" name="reason_remarks_page_14" id="reason_remarks_page_14" class="form-control text-center" value="{{$data && $data['claims']['0']['reason_remarks']? $data['claims']['0']['reason_remarks'] : ''}}" ></td>
                         </tr>
                         @endif
                         @endif
                        @endforeach
                    @else
                    <tr>
                      <td><input class="form-control text-center" type="number" readonly min="0" onblur="calculteTotalForClaimsPageFourteen();" onkeyup="calculteTotalForClaimsPageFourteen();" value="0" placeholder="0" name="amount_received_last_page_14" id="amount_received_last_page_14"></td>
                      <td><input class="form-control text-center" type="number" min="0" value="0" placeholder="0" name="total_amount_cheque_page_14" id="total_amount_cheque_page_14"></td>
                      <td><input class="form-control" type="date" style="text-transform: lowercase;" data-date-format="YYYY-MM-DD" name="cheque_date_page_14" id="cheque_date_page_14"></td>
                      <td><input class="form-control text-center" type="number" min="0" value="0" placeholder="0" name="cheque_no_page_14" id="cheque_no_page_14"></td>
                      <td><input class="form-control text-center" type="text" placeholder="Enter Bank Name" onkeypress="return lettersOnly(event)" name="bank_name_page_14" id="bank_name_page_14"></td>
                      <td><input class="form-control text-center" type="text" placeholder="Enter Remarks" name="reason_remarks_page_14" id="reason_remarks_page_14"></td>
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
    </form>
</div>
@section('script_page_14')
    <script>
         $('select[name="type_of_claim[]"').each(function (index,value) {
            if($(value).val() == 'other')
                $(value).parent().next().show();
            else
                $(value).parent().next().hide();
        });
          $('select[name="status"').each(function (index,value) {
            if($(value).val() == 'issued')
                $(value).parent().next().show();
            else
                $(value).parent().next().hide();
        });
        $('select[name="claim_status[]"').each(function (index,value) {
            if($(value).val() == 'received'){
                // $('#amount_page14').fadeIn();
                // $('#date_page14').fadeIn();
                // $('#reason_page14').fadeOut();
                // $('#fee_page14').fadeOut();
                // $('#recovery_page14').fadeOut();


                $(value).parent().next($('#amount_page14')).fadeIn();
                $(value).parent().next().next($('#date_page14')).fadeIn();
                $(value).parent().next().next().next($('#reason_page14')).fadeOut();
                $(value).parent().next().next().next().next($('#fee_page14')).fadeOut();
                $(value).parent().next().next().next().next().next($('#recovery_page14')).fadeOut();


            }
            else if($(value).val() == 'rejected'){
                // $('#amount_page14').fadeOut();
                // $('#date_page14').fadeOut();
                // $('#reason_page14').fadeIn();
                // $('#fee_page14').fadeIn();
                // $('#recovery_page14').fadeIn();

                $(value).parent().next($('#amount_page14')).fadeOut();
                $(value).parent().next().next($('#date_page14')).fadeOut();
                $(value).parent().next().next().next($('#reason_page14')).fadeIn();
                $(value).parent().next().next().next().next($('#fee_page14')).fadeIn();
                $(value).parent().next().next().next().next().next($('#recovery_page14')).fadeIn();
            }
            else if($(value).val() == 'notReceived'){
                // $('#amount_page14').fadeOut();
                // $('#date_page14').fadeOut();
                // $('#reason_page14').fadeIn();
                // $('#fee_page14').fadeOut();
                // $('#recovery_page14').fadeOut();

                $(value).parent().next($('#amount_page14')).fadeOut();
                $(value).parent().next().next($('#date_page14')).fadeOut();
                $(value).parent().next().next().next($('#reason_page14')).fadeIn();
                $(value).parent().next().next().next().next($('#fee_page14')).fadeOut();
                $(value).parent().next().next().next().next().next($('#recovery_page14')).fadeOut();
            }
            else if($(value).val() == 'cancelled'){
                // $('#amount_page14').fadeOut();
                // $('#date_page14').fadeOut();
                // $('#reason_page14').fadeIn();
                // $('#fee_page14').fadeOut();
                // $('#recovery_page14').fadeOut();

                $(value).parent().next($('#amount_page14')).fadeOut();
                $(value).parent().next().next($('#date_page14')).fadeOut();
                $(value).parent().next().next().next($('#reason_page14')).fadeIn();
                $(value).parent().next().next().next().next($('#fee_page14')).fadeOut();
                $(value).parent().next().next().next().next().next($('#recovery_page14')).fadeOut();
            }
            else{
                // $('#amount_page14').fadeOut();
                // $('#date_page14').fadeOut();
                // $('#reason_page14').fadeOut();
                // $('#fee_page14').fadeOut();
                // $('#recovery_page14').fadeOut();

                $(value).parent().next($('#amount_page14')).fadeOut();
                $(value).parent().next().next($('#date_page14')).fadeOut();
                $(value).parent().next().next().next($('#reason_page14')).fadeOut();
                $(value).parent().next().next().next().next($('#fee_page14')).fadeOut();
                $(value).parent().next().next().next().next().next($('#recovery_page14')).fadeOut();
            }
        });
        setDisplayForClaimReceivedPage14();
        setStatusDateDisplay();
        setClaimOthersField();
        // setDisplayForClaimReceivedPage14_Edit();
        // function setDisplayForClaimReceivedPage14_Edit() {
        //     let selected = $('#claim_received_page14').val();
        //     if(selected == 'received'){
        //         $('#amount_page14').fadeIn();
        //         $('#date_page14').fadeIn();
        //         $('#reason_page14').fadeOut();
        //         $('#fee_page14').fadeOut();
        //         $('#recovery_page14').fadeOut();
        //     }
        //     else if(selected == 'rejected'){
        //         $('#amount_page14').fadeOut();
        //         $('#date_page14').fadeOut();
        //         $('#reason_page14').fadeIn();
        //         $('#fee_page14').fadeIn();
        //         $('#recovery_page14').fadeIn();
        //     }
        //     else if(selected == 'notReceived'){
        //         $('#amount_page14').fadeOut();
        //         $('#date_page14').fadeOut();
        //         $('#reason_page14').fadeIn();
        //         $('#fee_page14').fadeOut();
        //         $('#recovery_page14').fadeOut();
        //     }
        //     else if(selected == 'cancelled'){
        //         $('#amount_page14').fadeOut();
        //         $('#date_page14').fadeOut();
        //         $('#reason_page14').fadeIn();
        //         $('#fee_page14').fadeOut();
        //         $('#recovery_page14').fadeOut();
        //     }
        //     else{
        //         $('#amount_page14').fadeOut();
        //         $('#date_page14').fadeOut();
        //         $('#reason_page14').fadeOut();
        //         $('#fee_page14').fadeOut();
        //         $('#recovery_page14').fadeOut();
        //     }
        // }

          function setDisplayForClaimReceivedPage14() {
            if($('#claim_status_page_14').val() == 'received'){
                for (var i = 1; i <= 8; i++) {
                  $(`#amount_due_${i}_page_14`).val($(`#claim_amount_due_default_${i}_page_14`).val());
                  calculteTotalForClaimsPageFourteen();
                }
                $('#recovered_amount_div_page_14').fadeOut();
                $('#outstanding_cfe_fee_div_page_14').fadeOut();
                $('#reason_div_page_14').fadeOut();            
                $('#claims_statuses_table_page_14').fadeIn();
                $('#provisional_claim_last').fadeIn();
            }
            else if($('#claim_status_page_14').val() == 'rejected'){
              $('#recovered_amount_div_page_14').fadeIn();
                $('#outstanding_cfe_fee_div_page_14').fadeIn();
                $('#reason_div_page_14').fadeIn();
                $('#claims_statuses_table_page_14').fadeOut();
                $('#provisional_claim_last').fadeOut();
            }
            else if($('#claim_status_page_14').val() == 'notReceived'){
              $('#recovered_amount_div_page_14').fadeOut();
                $('#outstanding_cfe_fee_div_page_14').fadeOut();
                $('#reason_div_page_14').fadeIn();
                $('#claims_statuses_table_page_14').fadeOut();
                $('#provisional_claim_last').fadeOut();
            }
            else if($('#claim_status_page_14').val() == 'cancelled'){
              $('#recovered_amount_div_page_14').fadeOut();
                $('#outstanding_cfe_fee_div_page_14').fadeOut();
                $('#reason_div_page_14').fadeIn();
                $('#claims_statuses_table_page_14').fadeOut();
                $('#provisional_claim_last').fadeOut();
            }
            else{
              $('#recovered_amount_div_page_14').fadeOut();
                $('#outstanding_cfe_fee_div_page_14').fadeOut();
                $('#reason_div_page_14').fadeOut();
                $('#claims_statuses_table_page_14').fadeOut();
                $('#provisional_claim_last').fadeOut();
            }
        }

        function setStatusDateDisplay() {
            if($('#status_page10').val() == 'issued'){
                $('#provisional_issued_1').val('');
                $('#status_div_page10').fadeIn();
            }
            else{
                $('#status_div_page10').fadeOut();
            }
        }
        function numericOnly(event) {
            let value = $(event.target).val();
            let length  = value.length;
            let regex = new RegExp("^[0-9]+$");
            let str = value.substr(length-1,1);
            if (!regex.test(str)) {
                $(e.target).val(value.substring(0,length-1));
            }
        }
        function provisionalLetterDate(event) {
           var value = String.fromCharCode(event.which);
           var pattern = new RegExp(/[a-zåäö ]/i);
           return pattern.test(value);
        }

        function cloneProvisionalLetter(){

            let clone = $('#provisional_letter').clone();

            clone.find('input:text').val('');
            $('#provisional_letter_parent').append(clone);
            let button = clone.find('#removeProvisionalLetterButton').removeAttr('disabled');
            clone.find('#provisional_letter_serial_no').val($('#provisional_letter input[name="serial_no[]"').length);
            $('input[name="claim_due[]"]').each(function (index,value) {
                $(value);
            });
            clone.find('.datepicker').datepicker({
                format:'dd/mm/yyyy',
                endDate: new Date(),
                autoclose: true
            });
             }
        function removeProvisionalLetterField(event) {
            if(index_id) {
                let csrf_token = $('meta[name="csrf-token"]').attr('content');
                let request = $.ajax({
                    url: '/provisional-letter-delete',
                    method: "POST",
                    data: {
                        'index_id' : index_id,
                        'serial_no' : $(event.target).parent().parent().find('#provisional_letter_serial_no').val()
                    },
                    headers:{
                        'X-CSRF-TOKEN':csrf_token
                    }
                });

                request.done(function (response) {
                });

                request.fail(function (jqXHR, textStatus) {
                    // alert("Request failed: " + textStatus);
                });
            }
            $(event.target).parent().parent().remove();
            $('#provisional_letter input[name="serial_no[]"').each(function (index,value) {
                $(value).val(index+1);
            });
        }

        $('#reason').bind('keypress', provisionalLetterDate);

        //Others Type
        function setClaimOthersField(e) {
            if(e.target.value == 'other'){
                // $('#provisional_claim_type_01').val('');
                $(e.target).parent().next().show();/$('#studentrelationship').show()/;
            }
            else{
                $(e.target).parent().next().hide();
                $(e.target).parent().next().find('#provisional_claim_type_01').val('');
                // $('#studentrelationship').hide();
            }
        }

        function calculteTotalForClaimsPageFourteen(){
            var claim_amount_due_default_page_14 = 0;
            var amount_due_page_14 = 0;
            var amount_received_page_14 = 0;
            var balance_due_page_14 = 0;

            for (var i = 1; i <= 8; i++) {
              $(`#amount_due_${i}_page_14`).val($(`#claim_amount_due_default_${i}_page_14`).val());
            }

            for(var i = 1; i <= 8; i++){
                var total_balance = 0;
                claim_amount_due_default_page_14 = parseFloat(claim_amount_due_default_page_14) + parseFloat($('#claim_amount_due_default_'+i+'_page_14').val());
                if($('#claim_amount_due_default_'+i+'_page_14').val() == ""){
                      $('#claim_amount_due_default_'+i+'_page_14').val('0');
                  }
                amount_due_page_14 = parseFloat(amount_due_page_14) + parseFloat($('#amount_due_'+i+'_page_14').val());
                if($('#amount_due_'+i+'_page_14').val() == ""){
                      $('#amount_due_'+i+'_page_14').val('0');
                  }
                amount_received_page_14 = parseFloat(amount_received_page_14) + parseFloat($('#amount_received_'+i+'_page_14').val());
                if($('#amount_received_'+i+'_page_14').val() == ""){
                      $('#amount_received_'+i+'_page_14').val('0');
                  }

                  if (parseFloat($('#amount_received_'+i+'_page_14').val()) > parseFloat($('#amount_due_'+i+'_page_14').val())) {
                  $('#amount_received_'+i+'_page_14').val('0');
                  $.notify('Amount Due cannot be less than Amount Received!');
                  }

               balance_due_page_14 = parseFloat(balance_due_page_14) + parseFloat($('#balance_due_'+i+'_page_14').val());
                if(amount_due_page_14 < amount_received_page_14){
                    // alert("Amount Received Cannot Be Higher Then Amount Due");
                    $('#amount_received_'+i+'_page_14').val()
                    // return false;
                }    
                if($('#amount_due_'+i+'_page_14').val() != "0" || $('#amount_received_'+i+'_page_14').val() != "0"){
                    total_balance = parseFloat($('#amount_due_'+i+'_page_14').val()) - parseFloat($('#amount_received_'+i+'_page_14').val());
                    $('#balance_due_'+i+'_page_14').val(total_balance);
                }              
            }
            
            $('#claim_amount_due_default_page_14').val(claim_amount_due_default_page_14);
            $('#amount_due_page_14').val(amount_due_page_14);
            $('#amount_received_page_14').val(amount_received_page_14);
            $('#balance_due_page_14').val(balance_due_page_14);
            $('#claim_due_page_14').val(claim_amount_due_default_page_14);
            $('#amount_received_last_page_14').val(amount_received_page_14);

        }
       </script>
@endsection
