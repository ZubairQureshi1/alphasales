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
<div id="page_16">
    <form id="page_16_form">
        <div class="card shadow p-3 w-100">
           <div class="col-md-12">
                <h1>Continue 1(Annual Part 2)<span class="float-right">Page # 12</span></h1><br>
            </div>
            <div class="card-body ">
                <div class="card shadow p-3 w-100">
                    <div class="card-body">
                        <div class="col-md-12 mt-4">
                            <label for="" style="font-size: 20px;">Annual Part 2 File Received in CFE Cell:</label>
                        </div>
                        <div class="card shadow p-3 w-100">
                            <div class="card-body ">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label>Receipt Status:<span style="color: red;">*</span></label>
                                        <select id="receipt_status_cfe_cell_page16" onchange="setFileReceivedInCFECell()" name="receipt_status" class="form-control">
                                            <option value="" selected>--select--</option>
                                            @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                                <option value="{{$key}}" {{ $data ? $data['second_annual_part_details'] != null ? $data['second_annual_part_details']['receipt_status'] == $key ? 'selected' : '' : '' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3" id="date_div_page16">
                                        <label>Date:<span style="color: red;">*</span></label>
                                        <input type="text" class="form-control text-center datepicker" name="second_part_date"
                                               placeholder="Enter Date"
                                               value="{{$data && isset($data['second_annual_part_details']) ?  date('d/m/Y',strtotime($data['second_annual_part_details']['second_part_date'])) : ''}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-4">
                    <label for="" style="font-size: 20px;">File Submitted in PWWB:</label>
                </div>
                <div class="card shadow p-3 mt-1 w-100">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>Status:<span style="color: red;">*</span></label>
                                <select id="pwwb_status_page16" onchange="setFileSubmittedStatusPage16()" name="pwwb_status" class="form-control">
                                    <option value="" selected>--select--</option>
                                    @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                        <option value="{{$key}}" {{ $data ? $data['second_annual_part_details'] != null ? $data['second_annual_part_details']['pwwb_status'] == $key ? 'selected' : '' : '' : ''}}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3" id="pwwb_date_div_page16">
                                <label>Date:<span style="color: red;">*</span></label>
                                <input type="text" class="form-control text-center datepicker" name="pwwb_date"
                                       placeholder="Enter Date"
                                       value="{{$data && isset($data['second_annual_part_details']) ?  date('d/m/Y',strtotime($data['second_annual_part_details']['pwwb_date'])) : ''}}">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Diary No. in PWWB:<span style="color: red;">*</span></label>
                                <input type="text" class="form-control text-center" name="diary_pwwb" placeholder="XXXXX"
                                       value="{{$data && isset($data['second_annual_part_details']) ? $data['second_annual_part_details']['diary_pwwb'] : ''}}">
                            </div>
                        </div>
                    </div>
                </div>
               {{--  <div class="col-md-12 mt-4">
                    <label for="" style="font-size: 20px;">Claimed Received From PWWB:</label>
                </div>
                <div class="card shadow p-3 mt-1 w-100">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>Amount of Claim Due:<span style="color: red;">*</span></label>
                                <input onkeyup="numericOnly(event)" type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center" name="amount_claim_due"
                                       placeholder="Enter Amount"
                                       value="{{$data && isset($data['second_annual_part_details']) ? $data['second_annual_part_details']['amount_claim_due'] : ''}}">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Status of Claimed Received:<span style="color: red;">*</span></label>
                                <select id="claim_status_page16" onchange="setStatusClaimReceivedPage16()"  name="claim_status" class="form-control">
                                    <option value="" selected>--select--</option>
                                    @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                        <option value="{{$key}}" {{ $data ? $data['second_annual_part_details'] != null ? $data['second_annual_part_details']['claim_status'] == $key ? 'selected' : '' : '' : ''}}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3" id="amount_div_claim_page16">
                                <label>Amount Received:<span style="color: red;">*</span></label>
                                <input onkeyup="numericOnly(event)" type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center" name="amount_received"
                                       placeholder="Enter Amount"
                                       value="{{$data && isset($data['second_annual_part_details']) ? $data['second_annual_part_details']['amount_received'] : ''}}">
                            </div>
                            <div class="form-group col-md-3" id="date_div_claim_page16">
                                <label>Date:<span style="color: red;">*</span></label>
                                <input type="text" class="form-control text-center datepicker" name="claim_date"
                                       placeholder="Enter Date"
                                       value="{{$data && isset($data['second_annual_part_details']) ?  date('d/m/Y',strtotime($data['second_annual_part_details']['claim_date'])) : ''}}">
                            </div>
                        </div>
                    </div>
                </div> --}}

                 {{-- new Claim Fields Start --}}
        <div style="margin-top: 50px;" class="card shadow p-3 w-100">
            <div class="card-body" id="provisional_letter_parent">
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
                    @if($data && isset($data['claims'][16]) && count($data['claims'][16]))
                        @php $i = 1; @endphp
                        @foreach($data['claims'] as $claims)
                        @if($claims['page_number'] == 16)
                         <tr>
                             <th scope="row">{{ $i++ }}</th>
                             <td><input name="claim_head_default_{{$i-1}}_page_16" id="claim_head_default_{{$i-1}}_page_16" readonly style="border: none" class="form-control text-center" value="{{$claims['claim_head_default']}}" ></td>
                             <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagesixteen();" onkeyup="calculteTotalForClaimsPagesixteen();" value="{{$claims['claim_amount_due_default']}}" placeholder="0" name="claim_amount_due_default_{{$i-1}}_page_16" id="claim_amount_due_default_{{$i-1}}_page_16"></td>
                         </tr>
                         @endif
                        @endforeach
                         <tr>
                          <th scope="row">Total</th>
                          <td></td>
                          <th><input readonly style="border: none;" class="form-control text-center" name="claim_amount_due_default_page_16" value="{{$data && $data['claims']['16']['total_amount_due_default']? $data['claims']['16']['total_amount_due_default'] : ''}}" id="claim_amount_due_default_page_16"></th>
                        </tr>
                    @else
                    <tr>
                      <th scope="row">1</th>
                      <td><input name="claim_head_default_1_page_16" id="claim_head_default_1_page_16" readonly style="border: none" class="form-control text-center" value="Admission Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagesixteen();" onkeyup="calculteTotalForClaimsPagesixteen();" value="0" placeholder="0" name="claim_amount_due_default_1_page_16" id="claim_amount_due_default_1_page_16"></td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td><input name="claim_head_default_2_page_16" id="claim_head_default_2_page_16" readonly style="border: none" class="form-control text-center" value="Registration Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagesixteen();" onkeyup="calculteTotalForClaimsPagesixteen();" value="0" placeholder="0" name="claim_amount_due_default_2_page_16" id="claim_amount_due_default_2_page_16"></td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td><input name="claim_head_default_3_page_16" id="claim_head_default_3_page_16" readonly style="border: none" class="form-control text-center" value="Tuition Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagesixteen();" onkeyup="calculteTotalForClaimsPagesixteen();" value="0" placeholder="0" name="claim_amount_due_default_3_page_16" id="claim_amount_due_default_3_page_16"></td>
                    </tr>
                    <tr>
                      <th scope="row">4</th>
                      <td><input name="claim_head_default_4_page_16" id="claim_head_default_4_page_16" readonly style="border: none" class="form-control text-center" value="Lab Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagesixteen();" onkeyup="calculteTotalForClaimsPagesixteen();" value="0" placeholder="0" name="claim_amount_due_default_4_page_16" id="claim_amount_due_default_4_page_16"></td>
                    </tr>
                    <tr>
                      <th scope="row">5</th>
                      <td><input name="claim_head_default_5_page_16" id="claim_head_default_5_page_16" readonly style="border: none" class="form-control text-center" value="Library Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagesixteen();" onkeyup="calculteTotalForClaimsPagesixteen();" value="0" placeholder="0" name="claim_amount_due_default_5_page_16" id="claim_amount_due_default_5_page_16"></td>
                    </tr>
                    <tr>
                      <th scope="row">6</th>
                      <td><input name="claim_head_default_6_page_16" id="claim_head_default_6_page_16" readonly style="border: none" class="form-control text-center" value="Exam Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagesixteen();" onkeyup="calculteTotalForClaimsPagesixteen();" value="0" placeholder="0" name="claim_amount_due_default_6_page_16" id="claim_amount_due_default_6_page_16"></td>
                    </tr>
                    <tr>
                      <th scope="row">7</th>
                      <td><input name="claim_head_default_7_page_16" id="claim_head_default_7_page_16" readonly style="border: none" class="form-control text-center" value="Transport Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagesixteen();" onkeyup="calculteTotalForClaimsPagesixteen();" value="0" placeholder="0" name="claim_amount_due_default_7_page_16" id="claim_amount_due_default_7_page_16"></td>
                     </tr>
                     <tr>
                      <th scope="row">8</th>
                      <td><input name="claim_head_default_8_page_16" id="claim_head_default_8_page_16" readonly style="border: none" class="form-control text-center" value="Hostel Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagesixteen();" onkeyup="calculteTotalForClaimsPagesixteen();" value="0" placeholder="0" name="claim_amount_due_default_8_page_16" id="claim_amount_due_default_8_page_16"></td>
                     </tr>
                    <tr>
                      <th scope="row">Total</th>
                      <td></td>
                      <th><input readonly style="border: none;" class="form-control text-center" name="claim_amount_due_default_page_16" value="0" id="claim_amount_due_default_page_16"></th>
                                          
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
                        <input type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center" name="claim_due_page_16" id="claim_due_page_16" placeholder="Enter Claim Due" value="{{$data && isset($data['claims']['16']['claim_due'])? $data['claims']['16']['claim_due'] : ''}}">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Status Of Claim:<span style="color: red;">*</span></label>
                        <select onchange="setDisplayForClaimReceivedPage16()" id="claim_status_page_16" name="claim_status_page_16" class="form-control">
                            <option value="" selected>--select--</option>
                            @foreach(\Config::get('constants.claim_status') as $key => $value)
                                <option value="{{$key}}" @if(isset($data['claims'][16])) {{ $data ? $data['claims']['16']['claim_status'] == $key ? 'selected' : '' : ''}} @endif>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3" id="reason_div_page_16">
                        <label>Reason:<span style="color: red;">*</span></label>
                        <input type="text" class="form-control text-center" name="reason_page_16" id="reason_page_16" placeholder="Enter Reason" value="@if(isset($data['claims'][16])) {{$data && $data['claims']['16']['reason']? $data['claims']['16']['reason'] : ''}} @endif">
                    </div>
                    <div class="form-group col-md-3" id="outstanding_cfe_fee_div_page_16">
                        <label>Outstanding CFE Fee:<span style="color: red;">*</span></label>
                        <input type="number" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center" name="outstanding_cfe_fee_page_16" id="outstanding_cfe_fee_page_16" placeholder="Enter Fee" value="{{$data && isset($data['claims']['16']['outstanding_cfe_fee'])? $data['claims']['16']['outstanding_cfe_fee'] : ''}}">
                    </div>
                    <div class="form-group col-md-3" id="recovered_amount_div_page_16">
                        <label>Recovered Amount From Student:<span style="color: red;">*</span></label>
                        <input type="number" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center" name="recovered_amount_page_16" id="recovered_amount_page_16" placeholder="Enter Recovered Amount" value="{{$data && isset($data['claims']['16']['recovered_amount'])? $data['claims']['16']['recovered_amount'] : ''}}">
                    </div>
                </div>
            </div>
        </div>
        <div style="margin-top: 50px;" class="card shadow p-3 w-100" id="claims_statuses_table_page_16">
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
                    @if($data && isset($data['claims'][16]) && count($data['claims'][16]))
                        @php $i = 1; @endphp
                        @foreach($data['claims'] as $claims)
                        @if($claims['page_number'] == 16)
                         <tr>
                             <th scope="row">{{ $i++ }}</th>
                             <td><input name="type_of_claim_{{$i-1}}_page_16" id="type_of_claim_{{$i-1}}_page_16" readonly style="border: none" class="form-control text-center" value="{{$claims['claim_head']}}" ></td>
                             <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagesixteen();" onkeyup="calculteTotalForClaimsPagesixteen();" value="{{$claims['amount_due']}}" placeholder="0" readonly="" name="amount_due_{{$i-1}}_page_16" id="amount_due_{{$i-1}}_page_16"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagesixteen();" onkeyup="calculteTotalForClaimsPagesixteen();" value="{{$claims['amount_received']}}" placeholder="0" name="amount_received_{{$i-1}}_page_16" id="amount_received_{{$i-1}}_page_16"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagesixteen();" onkeyup="calculteTotalForClaimsPagesixteen();" value="{{$claims['amount_balance']}}" placeholder="0" readonly name="balance_due_{{$i-1}}_page_16" id="balance_due_{{$i-1}}_page_16"></td>
                         </tr>
                         @endif
                        @endforeach
                         <tr>
                          <th scope="row">Total</th>
                          <td></td>
                          <th><input readonly style="border: none;" class="form-control text-center" name="amount_due_page_16" value="{{$data && $data['claims']['16']['total_amount_due']? $data['claims']['16']['total_amount_due'] : ''}}" id="amount_due_page_16"></th>
                          <th><input readonly style="border: none;" class="form-control text-center" name="amount_received_page_16" value="{{$data && $data['claims']['16']['total_amount_received']? $data['claims']['16']['total_amount_received'] : ''}}" id="amount_received_page_16"></th>
                          <th><input readonly style="border: none;" class="form-control text-center" name="balance_due_page_16" value="{{$data && $data['claims']['16']['total_amount_balance']? $data['claims']['16']['total_amount_balance'] : ''}}" id="balance_due_page_16"></th>                      
                        </tr>
                    @else
                    <tr>
                      <th scope="row">1</th>
                      <td><input name="type_of_claim_1_page_16" id="type_of_claim_1_page_16" readonly style="border: none" class="form-control text-center" value="Admission Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagesixteen();" onkeyup="calculteTotalForClaimsPagesixteen();" value="0" placeholder="0" readonly name="amount_due_1_page_16" id="amount_due_1_page_16"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagesixteen();" onkeyup="calculteTotalForClaimsPagesixteen();" value="0" placeholder="0" name="amount_received_1_page_16" id="amount_received_1_page_16"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagesixteen();" onkeyup="calculteTotalForClaimsPagesixteen();" value="0" placeholder="0" readonly name="balance_due_1_page_16" id="balance_due_1_page_16"></td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td><input name="type_of_claim_2_page_16" id="type_of_claim_2_page_16" readonly style="border: none" class="form-control text-center" value="Registration Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagesixteen();" onkeyup="calculteTotalForClaimsPagesixteen();" value="0" placeholder="0" readonly name="amount_due_2_page_16" id="amount_due_2_page_16"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagesixteen();" onkeyup="calculteTotalForClaimsPagesixteen();" value="0" placeholder="0" name="amount_received_2_page_16" id="amount_received_2_page_16"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagesixteen();" onkeyup="calculteTotalForClaimsPagesixteen();" value="0" placeholder="0" readonly name="balance_due_2_page_16" id="balance_due_2_page_16"></td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td><input name="type_of_claim_3_page_16" id="type_of_claim_3_page_16" readonly style="border: none" class="form-control text-center" value="Tuition Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagesixteen();" onkeyup="calculteTotalForClaimsPagesixteen();" value="0" placeholder="0" readonly name="amount_due_3_page_16" id="amount_due_3_page_16"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagesixteen();" onkeyup="calculteTotalForClaimsPagesixteen();" value="0" placeholder="0" name="amount_received_3_page_16" id="amount_received_3_page_16"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagesixteen();" onkeyup="calculteTotalForClaimsPagesixteen();" value="0" placeholder="0" readonly name="balance_due_3_page_16" id="balance_due_3_page_16"></td>
                    </tr>
                    <tr>
                      <th scope="row">4</th>
                      <td><input name="type_of_claim_4_page_16" id="type_of_claim_4_page_16" readonly style="border: none" class="form-control text-center" value="Lab Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagesixteen();" onkeyup="calculteTotalForClaimsPagesixteen();" value="0" placeholder="0" readonly name="amount_due_4_page_16" id="amount_due_4_page_16"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagesixteen();" onkeyup="calculteTotalForClaimsPagesixteen();" value="0" placeholder="0" name="amount_received_4_page_16" id="amount_received_4_page_16"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagesixteen();" onkeyup="calculteTotalForClaimsPagesixteen();" value="0" placeholder="0" readonly name="balance_due_4_page_16" id="balance_due_4_page_16"></td>
                    </tr>
                    <tr>
                      <th scope="row">5</th>
                      <td><input name="type_of_claim_5_page_16" id="type_of_claim_5_page_16" readonly style="border: none" class="form-control text-center" value="Library Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagesixteen();" onkeyup="calculteTotalForClaimsPagesixteen();" value="0" placeholder="0" readonly name="amount_due_5_page_16" id="amount_due_5_page_16"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagesixteen();" onkeyup="calculteTotalForClaimsPagesixteen();" value="0" placeholder="0" name="amount_received_5_page_16" id="amount_received_5_page_16"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagesixteen();" onkeyup="calculteTotalForClaimsPagesixteen();" value="0" placeholder="0" readonly name="balance_due_5_page_16" id="balance_due_5_page_16"></td>
                    </tr>
                    <tr>
                      <th scope="row">6</th>
                      <td><input name="type_of_claim_6_page_16" id="type_of_claim_6_page_16" readonly style="border: none" class="form-control text-center" value="Exam Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagesixteen();" onkeyup="calculteTotalForClaimsPagesixteen();" value="0" placeholder="0" readonly name="amount_due_6_page_16" id="amount_due_6_page_16"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagesixteen();" onkeyup="calculteTotalForClaimsPagesixteen();" value="0" placeholder="0" name="amount_received_6_page_16" id="amount_received_6_page_16"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagesixteen();" onkeyup="calculteTotalForClaimsPagesixteen();" value="0" placeholder="0" readonly name="balance_due_6_page_16" id="balance_due_6_page_16"></td>
                    </tr>
                    <tr>
                      <th scope="row">7</th>
                      <td><input name="type_of_claim_7_page_16" id="type_of_claim_7_page_16" readonly style="border: none" class="form-control text-center" value="Transport Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagesixteen();" onkeyup="calculteTotalForClaimsPagesixteen();" value="0" placeholder="0" readonly name="amount_due_7_page_16" id="amount_due_7_page_16"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagesixteen();" onkeyup="calculteTotalForClaimsPagesixteen();" value="0" placeholder="0" name="amount_received_7_page_16" id="amount_received_7_page_16"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagesixteen();" onkeyup="calculteTotalForClaimsPagesixteen();" value="0" placeholder="0" readonly name="balance_due_7_page_16" id="balance_due_7_page_16"></td>
                    </tr>
                    <tr>
                      <th scope="row">8</th>
                      <td><input name="type_of_claim_8_page_16" id="type_of_claim_8_page_16" readonly style="border: none" class="form-control text-center" value="Hostel Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagesixteen();" onkeyup="calculteTotalForClaimsPagesixteen();" value="0" placeholder="0" readonly name="amount_due_8_page_16" id="amount_due_8_page_16"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagesixteen();" onkeyup="calculteTotalForClaimsPagesixteen();" value="0" placeholder="0" name="amount_received_8_page_16" id="amount_received_8_page_16"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagesixteen();" onkeyup="calculteTotalForClaimsPagesixteen();" value="0" placeholder="0" readonly name="balance_due_8_page_16" id="balance_due_8_page_16"></td>
                    </tr>
                    <tr>
                      <th scope="row">Total</th>
                      <td></td>
                      <th><input readonly style="border: none;" class="form-control text-center" name="amount_due_page_16" value="0" id="amount_due_page_16"></th>
                      <th><input readonly style="border: none;" class="form-control text-center" name="amount_received_page_16" value="0" id="amount_received_page_16"></th>
                      <th><input readonly style="border: none;" class="form-control text-center" name="balance_due_page_16" value="0" id="balance_due_page_16"></th>                      
                    </tr>
                    @endif
                  </tbody>
                </table>
            </div>
        </div>
        {{-- new Claim Fields end --}}
        {{-- new Claim Fields Start --}}
      <div style="margin-top: 50px; display: none;" class="card shadow p-3 w-100" id="provisional_claim_last_page_16">
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
                    @if($data && isset($data['claims'][16]) && count($data['claims'][16]))
                        @php $i = 1; @endphp
                        {{-- @if($claims['page_number'] == 15) --}}
                         <tr>
                             <td><input name="amount_received_last_page_16" id="amount_received_last_page_16" onblur="calculteTotalForClaimsPagesixteen();" onkeyup="calculteTotalForClaimsPagesixteen();" readonly class="form-control text-center" value="{{$data && $data['claims']['16']['amount_received_last']? $data['claims']['16']['amount_received_last'] : ''}}" ></td>
                             <td><input type="number" name="total_amount_cheque_page_16" id="total_amount_cheque_page_16" class="form-control text-center" value="{{$data && $data['claims']['16']['total_amount_cheque']? $data['claims']['16']['total_amount_cheque'] : ''}}" ></td>
                             <td><input type="date" name="cheque_date_page_16" id="cheque_date_page_16" class="form-control text-center" value="{{$data && $data['claims']['16']['cheque_date']? $data['claims']['16']['cheque_date'] : ''}}" ></td>
                             <td><input type="number" name="cheque_no_page_16" id="cheque_no_page_16" class="form-control text-center" value="{{$data && $data['claims']['16']['cheque_no']? $data['claims']['16']['cheque_no'] : ''}}" ></td>
                             <td><input type="text" name="bank_name_page_16" id="bank_name_page_16" class="form-control text-center" value="{{$data && $data['claims']['16']['bank_name']? $data['claims']['16']['bank_name'] : ''}}" ></td>
                             <td><input type="text" name="reason_remarks_page_16" id="reason_remarks_page_16" class="form-control text-center" value="{{$data && $data['claims']['16']['reason_remarks']? $data['claims']['16']['reason_remarks'] : ''}}" ></td>
                         </tr>
                         {{-- @endif --}}
                    @else
                    <tr>
                      <td><input class="form-control text-center" type="number" readonly min="0" onblur="calculteTotalForClaimsPagesixteen();" onkeyup="calculteTotalForClaimsPagesixteen();" value="0" placeholder="0" name="amount_received_last_page_16" id="amount_received_last_page_16"></td>
                      <td><input class="form-control text-center" type="number" min="0" value="0" placeholder="0" name="total_amount_cheque_page_16" id="total_amount_cheque_page_16"></td>
                      <td><input class="form-control" type="date" style="text-transform: lowercase;" data-date-format="YYYY-MM-DD" name="cheque_date_page_16" id="cheque_date_page_16"></td>
                      <td><input class="form-control text-center" type="number" min="0" value="0" placeholder="0" name="cheque_no_page_16" id="cheque_no_page_16"></td>
                      <td><input class="form-control text-center" type="text" placeholder="Enter Bank Name" onkeypress="return lettersOnly(event)" name="bank_name_page_16" id="bank_name_page_16"></td>
                      <td><input class="form-control text-center" type="text" placeholder="Enter Remarks" name="reason_remarks_page_16" id="reason_remarks_page_16"></td>
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
                <div class="col-md-12 mt-4">
                    <label for="" style="font-size: 20px;">Examination Status in Affiliated Body:</label>
                </div>
                <div class="card shadow p-3 mt-1 w-100">
                    <div class="card-body" id="result_status_annual_part_two_parent">
                        <div class="col-md-12 mt-4">
                            <label for="">Exam Fee:<span style="color: red;">*</span></label>
                        </div>
                        <div class="card shadow p-3 mt-1 w-100">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label>Status:<span style="color: red;">*</span></label>
                                        <select id="exam_fee_status_page16" onchange="setExamFeeStatusPage16()" name="exam_status" class="form-control">
                                            <option value="" selected>--select--</option>
                                            @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                                <option value="{{$key}}" {{ $data ? $data['second_annual_part_details'] != null ? $data['second_annual_part_details']['exam_status'] == $key ? 'selected' : '' : '' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3" id="date_div_exam_page16">
                                        <label>Date:<span style="color: red;">*</span></label>
                                        <input type="text" class="form-control text-center datepicker" name="exam_date"
                                               placeholder="Enter Date"
                                               value="{{$data && isset($data['second_annual_part_details']) ?  date('d/m/Y',strtotime($data['second_annual_part_details']['exam_date'])) : ''}}">
                                    </div>
                                    <div class="form-group col-md-3" id="amount_div_exam_page16">
                                        <label>Amount:<span style="color: red;">*</span></label>
                                        <input onkeyup="numericOnly(event)" type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center" name="exam_amount"
                                               placeholder="Enter Amount"
                                               value="{{$data && isset($data['second_annual_part_details']) ? $data['second_annual_part_details']['exam_amount'] : ''}}">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Roll No:<span style="color: red;">*</span></label>
                                        <input readonly type="text" class="form-control text-center" name="roll_no"
                                               placeholder="Enter Roll No" value="{{$data ? $data['roll_no'] : ''}}"
                                               >
                                               {{-- value="{{$data && isset($data['second_annual_part_details']) ? $data['second_annual_part_details']['roll_no'] : ''}}" --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row mt-4">
                            <div class="col-md-1 text-center">
                                <label>Result:<span style="color: red;">*</span></label>
                            </div>
                            <div class="form-row col-md-8 ml-0" id="result_status_annual_part_two_pass_headers">
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
                            <div class="col-md-2 text-center" id="result_status_annual_part_two_pass_header_passing">
                                <label>Passing Date:<span style="color: red;">*</span></label>
                            </div>
                            <div class="float-right ml-auto mr-2">
                                <button type="button" class="btn btn-primary float-right" onclick="cloneResultStatusAnnualPartTwo()">
                                    <strong>+</strong></button>
                            </div>
                        </div>
                        <!-- result status -->
                        @if($data && isset($data['second_annual_result_status_details']) && count($data['second_annual_result_status_details']))
                            @foreach($data['second_annual_result_status_details'] as $secondAnnualResultStatusDetails)
                                <div class="form-row mt-2" id="result_status_annual_part_two_div">
                                    <input type="hidden" value="{{$secondAnnualResultStatusDetails['id']}}" id="result_status_annual_part_two_delete_id">
                                    <div class="col-md-1 p-0">
                                        <select id="result_field_for_annual_part_two" name="result[]" class="form-control result_annual_part_two" onchange="resultChangedForAnnualPartTwo(event)">
                                            <option value="" selected>--select--</option>
                                            <option value="pass" {{ $secondAnnualResultStatusDetails['result'] == 'pass' ? 'selected' : ''}}>Pass</option>
                                            <option value="fail" {{ $secondAnnualResultStatusDetails['result'] == 'fail' ? 'selected' : ''}}>Fail</option>
                                        </select>
                                    </div>
                                    <div class="col-md-8 form-row m-0" id="result_status_annual_part_two_pass_values_replacement" style="display: none"></div>
                                    <div class="col-md-8 form-row m-0" id="result_status_annual_part_two_pass_values" style="display: none">
                                        <div class="col-md-3 p-0">
                                            <select name="fail[]" class="form-control promotion_annual_part_two">
                                                <option value="promoted" {{ $secondAnnualResultStatusDetails['fail'] == 'promoted' ? 'selected' : ''}}>Promoted</option>
                                                <option value="notPromoted" {{ $secondAnnualResultStatusDetails['fail'] == 'notPromoted' ? 'selected' : ''}}>Not Promoted</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 p-0">
                                            <select name="next_appearance[]" id="next_appearance_16" class="form-control" onchange="nextAppearanceChangedForAnnualPartOneCont(event)">
                                                <option value="yes" {{ $secondAnnualResultStatusDetails['next_appearance'] == 'yes' ? 'selected' : ''}}>Yes</option>
                                                <option value="no" {{ $secondAnnualResultStatusDetails['next_appearance'] == 'no' ? 'selected' : ''}}>No</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 p-0">
                                            <input type="text" class="form-control text-center datepickerAll nextAppearanceContCheck"
                                                   name="next_appearance_date[]" id="next_appearance_date_16" placeholder="Enter Date" value="{{ $secondAnnualResultStatusDetails['next_appearance_date'] ? date('d/m/Y',strtotime($secondAnnualResultStatusDetails['next_appearance_date'])) : ''}}">
                                        </div>
                                        <div class="col-md-3 p-0">
                                            <input type="text" class="form-control text-center datepickerAll nextAppearanceContCheck"
                                                   name="last_chance_date[]" id="last_chance_date_16" placeholder="Enter Date" value="{{ $secondAnnualResultStatusDetails['last_chance_date'] ? date('d/m/Y',strtotime($secondAnnualResultStatusDetails['last_chance_date'])) : ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-2 p-0" id="result_status_annual_part_two_pass_value_passing" style="display: none">
                                        <input type="text" class="form-control text-center datepicker" id="passing_date_16" name="passing_date[]"
                                               placeholder="Enter Date" value="{{ $secondAnnualResultStatusDetails['passing_date'] ? date('d/m/Y',strtotime($secondAnnualResultStatusDetails['passing_date'])) : ''}}">
                                    </div>
                                    <div class="col-md-1">
                                        <button id="removeResultStatusAnnualPartTwoButton" type="button" class="btn btn-danger"
                                                onclick="removeResultStatusAnnualPartTwo(event)" @if ($secondAnnualResultStatusDetails == reset($data['second_annual_result_status_details'])) {{'disabled'}} @endif>-
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="form-row mt-2" id="result_status_annual_part_two_div">
                                <div class="col-md-1 p-0">
                                    <select id="result_field_for_annual_part_two" name="result[]" class="form-control result_annual_part_two" onchange="resultChangedForAnnualPartTwo(event)">
                                        <option value="" selected>--select--</option>
                                        <option value="pass">Pass</option>
                                        <option value="fail">Fail</option>
                                    </select>
                                </div>
                                <div class="col-md-8 form-row m-0" id="result_status_annual_part_two_pass_values_replacement" style="display: none"></div>
                                <div class="col-md-8 form-row m-0" id="result_status_annual_part_two_pass_values" style="display: none">
                                    <div class="col-md-3 p-0">
                                        <select name="fail[]" class="form-control promotion_annual_part_two">
                                            <option value="promoted">Promoted</option>
                                            <option value="notPromoted" selected>Not Promoted</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 p-0">
                                        <select name="next_appearance[]" id="next_appearance_16" class="form-control" onchange="nextAppearanceChangedForAnnualPartOneCont(event)">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 p-0">
                                        <input type="text" class="form-control text-center datepickerAll nextAppearanceContCheck"
                                               name="next_appearance_date[]" id="next_appearance_date_16" placeholder="Enter Date">
                                    </div>
                                    <div class="col-md-3 p-0">
                                        <input type="text" class="form-control text-center datepickerAll nextAppearanceContCheck"
                                               name="last_chance_date[]" id="last_chance_date_16" placeholder="Enter Date">
                                    </div>
                                </div>
                                <div class="col-md-2 p-0" id="result_status_annual_part_two_pass_value_passing" style="display: none">
                                    <input type="text" class="form-control text-center datepicker" id="passing_date_16" name="passing_date[]"
                                           placeholder="Enter Date">
                                </div>
                                <div class="col-md-1">
                                    <button id="removeResultStatusAnnualPartTwoButton" type="button" class="btn btn-danger"
                                            onclick="removeResultStatusAnnualPartTwo(event)" disabled>-
                                    </button>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-12 mt-4">
                            <label for="" style="font-size: 20px;">Readmission:</label>
                        </div>
                        <div class="card shadow p-3 w-100">
                            <div class="card-body ">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Readmission:<span style="color: red;">*</span></label>
                                        <select name="readmissionparttwo" id="setreadmission" class="form-control text-center" onchange="setReadmissionSecond(event)">
                                            <option value="" selected>--select--</option>
                                            @foreach(\Config::get('constants.general_yes_no') as $key => $general_yes_no)
                                                @if(isset($data['second_annual_part_details']['readmissionparttwo']))
                                                    <option value="{{$key}}" {{ $data ? $data['second_annual_part_details']['readmissionparttwo'] == $key ? 'selected' : '' : ''}}>{{$general_yes_no}}</option>
                                                @else
                                                    <option value="{{$key}}">{{$general_yes_no}}</option>
                                                @endif
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="form-group col-md-4" id="same_course_page_16" style="display: none;">
                                        <label>Same Course:<span style="color: red;">*</span></label>
                                        <select  name="same_course" class="form-control" id="same_course_16">
                                            <option value="" selected>--select--</option>
                                            @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                                <option value="{{$key}}" {{ $data ? $data['second_annual_part_details'] != null ? $data['second_annual_part_details']['same_course'] == $key ? 'selected' : '' : '' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4" id="change_course_page_16" style="display: none;">
                                        <label>Changed Course:<span style="color: red;">*</span></label>
                                        <select  name="changed_course" class="form-control" id="change_course_16">
                                            <option value="" selected>--select--</option>
                                            @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                                <option value="{{$key}}" {{ $data ? $data['second_annual_part_details'] != null ? $data['second_annual_part_details']['changed_course'] == $key ? 'selected' : '' : '' : ''}}>{{$value}}</option>
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
@section('script_page_16')
    <script>
        setResultHeaderAnnualPartTwoDisplay();
        setFileReceivedInCFECell();
        setFileSubmittedStatusPage16();
        setStatusClaimReceivedPage16();
        setExamFeeStatusPage16();
        setReadmissionSecond();
        function cloneResultStatusAnnualPartTwo() {
            let clone = $('#result_status_annual_part_two_div').clone();
            clone.find('input:text').val('');
            $('#result_status_annual_part_two_parent').append(clone);
            let button = clone.find('#removeResultStatusAnnualPartTwoButton').removeAttr('disabled');
            // let dropdown = $(clone.find('#result_field_for_annual_part_one').parent().siblings()[0]).hide();
            setResultHeaderAnnualPartTwoDisplay();
            clone.find('.datepicker').each(function (index, pick) {
                let picker = $(pick).datepicker({
                    format: 'dd/mm/yyyy'
                }).on('changeDate', function (ev) {
                    setAccumulatedYears();
                    picker.hide();
                }).data('datepicker');
            });
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

        function setResultHeaderAnnualPartTwoDisplay() {
            $('.result_annual_part_two').each(function (index,value) {
                if($(value).val() == 'fail'){
                    $(value).parent().parent().find('#result_status_annual_part_two_pass_values').show();
                    $(value).parent().parent().find('#result_status_annual_part_two_pass_values_replacement').hide();
                    $(value).parent().parent().find('#result_status_annual_part_two_pass_value_passing').hide();
                }
                else if($(value).val() == 'pass'){
                    $(value).parent().parent().find('#result_status_annual_part_two_pass_values').hide();
                    $(value).parent().parent().find('#result_status_annual_part_two_pass_values_replacement').show();
                    $(value).parent().parent().find('#result_status_annual_part_two_pass_value_passing').show();
                }
                else{
                    $(value).parent().parent().find('#result_status_annual_part_two_pass_values').hide();
                    $(value).parent().parent().find('#result_status_annual_part_two_pass_values_replacement').hide();
                    $(value).parent().parent().find('#result_status_annual_part_two_pass_value_passing').hide();
                }
            });
        }

        function resultChangedForAnnualPartTwo(event) {
            setResultHeaderAnnualPartTwoDisplay();
            if($(event.target).val() == 'fail'){
                $('#passing_date_16').val('');
                $(event.target).parent().parent().find('#result_status_annual_part_two_pass_values').fadeIn();
                $(event.target).parent().parent().find('#result_status_annual_part_two_pass_values_replacement').fadeOut();
                $(event.target).parent().parent().find('#result_status_annual_part_two_pass_value_passing').fadeOut();
            }
            else if($(event.target).val() == 'pass'){
                 $('#last_chance_date_16').val('');
                $('#next_appearance_16').val('no');
                $('#next_appearance_date_16').val('');
                // $('#v-pills-page_25').addClass('active');
                $(event.target).parent().parent().find('#result_status_annual_part_two_pass_values').fadeOut();
                $(event.target).parent().parent().find('#result_status_annual_part_two_pass_values_replacement').fadeIn();
                $(event.target).parent().parent().find('#result_status_annual_part_two_pass_value_passing').fadeIn();
            }
            else{
                $(event.target).parent().parent().find('#result_status_annual_part_two_pass_values').fadeOut();
                $(event.target).parent().parent().find('#result_status_annual_part_two_pass_values_replacement').fadeOut();
                $(event.target).parent().parent().find('#result_status_annual_part_two_pass_value_passing').fadeOut();
            }
        }

        function removeResultStatusAnnualPartTwo(event) {
            if(index_id) {
                let csrf_token = $('meta[name="csrf-token"]').attr('content');
                let request = $.ajax({
                    url: '/annual-part-two-delete',
                    method: "POST",
                    data: {
                        'index_id' : index_id,
                        'id' : $(event.target).parent().parent().find('#result_status_annual_part_two_delete_id').val()
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
        }

        function setFileReceivedInCFECell() {
            if($('#receipt_status_cfe_cell_page16').val() == 'yes'){
                $('#date_div_page16').fadeIn();
            }
            else{
                $('#date_div_page16').fadeOut();
            }
        }

        function setFileSubmittedStatusPage16() {
            if($('#pwwb_status_page16').val() == 'yes'){
                $('#pwwb_date_div_page16').fadeIn();
            }
            else{
                $('#pwwb_date_div_page16').fadeOut();
            }
        }

        function setStatusClaimReceivedPage16() {
            if($('#claim_status_page16').val() == 'yes'){
                $('#amount_div_claim_page16').fadeIn();
                $('#date_div_claim_page16').fadeIn();
            }
            else{
                $('#amount_div_claim_page16').fadeOut();
                $('#date_div_claim_page16').fadeOut();
            }
        }

        function setExamFeeStatusPage16() {
            if($('#exam_fee_status_page16').val() == 'yes'){
                $('#date_div_exam_page16').fadeIn();
                $('#amount_div_exam_page16').fadeIn();
            }
            else{
                $('#amount_div_exam_page16').fadeOut();
                $('#date_div_exam_page16').fadeOut();
            }
        }
        function nextAppearanceChangedForAnnualPartOneCont(event) {
            if($(event.target).val() == 'no'){
                $(event.target).parent().parent().find('.nextAppearanceContCheck').fadeOut();
            }
            else if($(event.target).val() == 'yes'){
                $(event.target).parent().parent().find('.nextAppearanceContCheck').fadeIn();
            }
        }
        function setReadmissionSecond(e) {
            let selected = $('select[name="readmissionparttwo"]').val();
            if(selected == 'yes'){
                $('#same_course_page_16').show();
                $('#change_course_page_16').show();

            }
            else{
                if(!index_id){
                    $('#same_course_16').val('');
                    $('#change_course_16').val('');
                }
                $('#same_course_page_16').hide();
                $('#change_course_page_16').hide();
            }
        }

        setDisplayForClaimReceivedPage16();
        function setDisplayForClaimReceivedPage16() {
            if($('#claim_status_page_16').val() == 'received'){
                for (var i = 1; i <= 8; i++) {
                  $(`#amount_due_${i}_page_16`).val($(`#claim_amount_due_default_${i}_page_16`).val());
                  calculteTotalForClaimsPagesixteen();
                }
                $('#recovered_amount_div_page_16').fadeOut();
                $('#outstanding_cfe_fee_div_page_16').fadeOut();
                $('#reason_div_page_16').fadeOut();            
                $('#claims_statuses_table_page_16').fadeIn();
                $('#provisional_claim_last_page_16').fadeIn();
            }
            else if($('#claim_status_page_16').val() == 'rejected'){
              $('#recovered_amount_div_page_16').fadeIn();
                $('#outstanding_cfe_fee_div_page_16').fadeIn();
                $('#reason_div_page_16').fadeIn();
                $('#claims_statuses_table_page_16').fadeOut();
                $('#provisional_claim_last_page_16').fadeOut();
            }
            else if($('#claim_status_page_16').val() == 'notReceived'){
              $('#recovered_amount_div_page_16').fadeOut();
                $('#outstanding_cfe_fee_div_page_16').fadeOut();
                $('#reason_div_page_16').fadeIn();
                $('#claims_statuses_table_page_16').fadeOut();
                $('#provisional_claim_last_page_16').fadeOut();
            }
            else if($('#claim_status_page_16').val() == 'cancelled'){
              $('#recovered_amount_div_page_16').fadeOut();
                $('#outstanding_cfe_fee_div_page_16').fadeOut();
                $('#reason_div_page_16').fadeIn();
                $('#claims_statuses_table_page_16').fadeOut();
                $('#provisional_claim_last_page_16').fadeOut();
            }
            else{
              $('#recovered_amount_div_page_16').fadeOut();
                $('#outstanding_cfe_fee_div_page_16').fadeOut();
                $('#reason_div_page_16').fadeOut();
                $('#claims_statuses_table_page_16').fadeOut();
                $('#provisional_claim_last_page_16').fadeOut();
            }
        }

        function calculteTotalForClaimsPagesixteen(){
            var claim_amount_due_default_page_16 = 0;
            var amount_due_page_16 = 0;
            var amount_received_page_16 = 0;
            var balance_due_page_16 = 0;

            for (var i = 1; i <= 8; i++) {
              $(`#amount_due_${i}_page_16`).val($(`#claim_amount_due_default_${i}_page_16`).val());
            }

            for(var i = 1; i <= 8; i++){
                var total_balance = 0;
                claim_amount_due_default_page_16 = parseFloat(claim_amount_due_default_page_16) + parseFloat($('#claim_amount_due_default_'+i+'_page_16').val());
                if($('#claim_amount_due_default_'+i+'_page_16').val() == ""){
                      $('#claim_amount_due_default_'+i+'_page_16').val('0');
                  }
                amount_due_page_16 = parseFloat(amount_due_page_16) + parseFloat($('#amount_due_'+i+'_page_16').val());
                if($('#amount_due_'+i+'_page_16').val() == ""){
                      $('#amount_due_'+i+'_page_16').val('0');
                  }
                amount_received_page_16 = parseFloat(amount_received_page_16) + parseFloat($('#amount_received_'+i+'_page_16').val());
                if($('#amount_received_'+i+'_page_16').val() == ""){
                      $('#amount_received_'+i+'_page_16').val('0');
                  }

                  if (parseFloat($('#amount_received_'+i+'_page_16').val()) > parseFloat($('#amount_due_'+i+'_page_16').val())) {
                  $('#amount_received_'+i+'_page_16').val('0');
                  $.notify('Amount Due cannot be less than Amount Received!');
                  }

               balance_due_page_16 = parseFloat(balance_due_page_16) + parseFloat($('#balance_due_'+i+'_page_16').val());
                if(amount_due_page_16 < amount_received_page_16){
                    // alert("Amount Received Cannot Be Higher Then Amount Due");
                    $('#amount_received_'+i+'_page_16').val()
                    // return false;
                }    
                if($('#amount_due_'+i+'_page_16').val() != "0" || $('#amount_received_'+i+'_page_16').val() != "0"){
                    total_balance = parseFloat($('#amount_due_'+i+'_page_16').val()) - parseFloat($('#amount_received_'+i+'_page_16').val());
                    $('#balance_due_'+i+'_page_16').val(total_balance);
                }              
            }
            
            $('#claim_amount_due_default_page_16').val(claim_amount_due_default_page_16);
            $('#amount_due_page_16').val(amount_due_page_16);
            $('#amount_received_page_16').val(amount_received_page_16);
            $('#balance_due_page_16').val(balance_due_page_16);
            $('#claim_due_page_16').val(claim_amount_due_default_page_16);
            $('#amount_received_last_page_16').val(amount_received_page_16);
        }
    </script>
@endsection
