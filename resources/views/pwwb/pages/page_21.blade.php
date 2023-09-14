<style type="text/css">
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
{{--@if(isset($data['fifth_semester_details']['exam_status']) != null )--}}
<div id="page_21">
    <form id="page_21_form">
        <div class="card shadow p-3 w-100">
            <div class="col-md-12">
               <h1>Continue 4(Fifth Semester)<span class="float-right">Page # 15</span></h1><br>
            </div>
            <div class="card-body ">
                <div class="card shadow p-3 w-100">
                    <div class="card-body">
                        <div class="col-md-12 mt-4">
                            <label for="" style="font-size: 20px;">5th Semester File Received in CFE Cell:</label>
                        </div>
                        <div class="card shadow p-3 w-100">
                            <div class="card-body ">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label>Status:<span style="color: red;">*</span></label>
                                        <select onchange="setStatusDatePage21()" id="status_page21" name="cell_status" class="form-control">
                                            <option value="" selected>--select--</option>
                                            @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                                <option value="{{$key}}" {{ $data ? $data['fifth_semester_details'] != null ? $data['fifth_semester_details']['cell_status'] == $key ? 'selected' : '' : '' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3" id="date_div_page21">
                                        <label>Date:<span style="color: red;">*</span></label>
                                        <input type="text" class="form-control text-center datepicker" name="cell_date"
                                               placeholder="Enter Date"
                                               value="{{$data && isset($data['fifth_semester_details']) ? date('d/m/Y',strtotime($data['fifth_semester_details']['cell_date'])) : ''}}">
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
                                <select onchange="setPwwbStatusPage21()" id="pwwb_status_page21" name="pwwb_status" class="form-control">
                                    <option value="" selected>--select--</option>
                                    @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                        <option value="{{$key}}" {{ $data ? $data['fifth_semester_details'] != null ? $data['fifth_semester_details']['pwwb_status'] == $key ? 'selected' : '' : '' : ''}}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3" id="date_div_pwwb_page21">
                                <label>Date:<span style="color: red;">*</span></label>
                                <input type="text" class="form-control text-center datepicker" name="pwwb_date"
                                       placeholder="Enter Date"
                                       value="{{$data && isset($data['fifth_semester_details']) ? date('d/m/Y',strtotime($data['fifth_semester_details']['pwwb_date'])) : ''}}">
                            </div>
                            <div class="form-group col-md-3" id="diary_no_pwwb_page21">
                                <label>Diary No. in PWWB:<span style="color: red;">*</span></label>
                                <input type="text" class="form-control text-center" name="diary_pwwb" placeholder="XXXXX"
                                       value="{{$data && isset($data['fifth_semester_details']) ? $data['fifth_semester_details']['diary_pwwb'] : ''}}">
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
                                <input type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center" name="amount_claim_due"
                                       placeholder="XXXXX"
                                       value="{{$data && isset($data['fifth_semester_details']) ? $data['fifth_semester_details']['amount_claim_due'] : ''}}">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Status of Claimed Received:<span style="color: red;">*</span></label>
                                <select onchange="setClaimStatusPage21()" id="claim_status_page21" name="claim_status" class="form-control">
                                    <option value="" selected>--select--</option>
                                    @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                        <option value="{{$key}}" {{ $data ? $data['fifth_semester_details'] != null ? $data['fifth_semester_details']['claim_status'] == $key ? 'selected' : '' : '' : ''}}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3" id="amount_claim_page21">
                                <label>Amount Received:<span style="color: red;">*</span></label>
                                <input type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center" name="amount_received"
                                       placeholder="Enter Amount"
                                       value="{{$data && isset($data['fifth_semester_details']) ? $data['fifth_semester_details']['amount_received'] : ''}}">
                            </div>
                            <div class="form-group col-md-3" id="date_div_claim_page21">
                                <label>Date:<span style="color: red;">*</span></label>
                                <input type="text" class="form-control text-center datepicker" name="claim_date"
                                       placeholder="Enter Date"
                                       value="{{$data && isset($data['fifth_semester_details']) ? date('d/m/Y',strtotime($data['fifth_semester_details']['claim_date'])) : ''}}">
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
                    @if($data && isset($data['claims'][40]) && count($data['claims'][40]))
                        @php $i = 1; @endphp
                        @foreach($data['claims'] as $claims)
                        @if($claims['page_number'] == 21)
                         <tr>
                             <th scope="row">{{ $i++ }}</th>
                             <td><input name="claim_head_default_{{$i-1}}_page_21" id="claim_head_default_{{$i-1}}_page_21" readonly style="border: none" class="form-control text-center" value="{{$claims['claim_head_default']}}" ></td>
                             <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyone();" onkeyup="calculteTotalForClaimsPagetwentyone();" value="{{$claims['claim_amount_due_default']}}" placeholder="0" name="claim_amount_due_default_{{$i-1}}_page_21" id="claim_amount_due_default_{{$i-1}}_page_21"></td>
                         </tr>
                         @endif
                        @endforeach
                         <tr>
                          <th scope="row">Total</th>
                          <td></td>
                          <th><input readonly style="border: none;" class="form-control text-center" name="claim_amount_due_default_page_21" value="{{$data && $data['claims']['40']['total_amount_due_default']? $data['claims']['40']['total_amount_due_default'] : ''}}" id="claim_amount_due_default_page_21"></th>
                        </tr>
                    @else
                    <tr>
                      <th scope="row">1</th>
                      <td><input name="claim_head_default_1_page_21" id="claim_head_default_1_page_21" readonly style="border: none" class="form-control text-center" value="Admission Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyone();" onkeyup="calculteTotalForClaimsPagetwentyone();" value="0" placeholder="0" name="claim_amount_due_default_1_page_21" id="claim_amount_due_default_1_page_21"></td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td><input name="claim_head_default_2_page_21" id="claim_head_default_2_page_21" readonly style="border: none" class="form-control text-center" value="Registration Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyone();" onkeyup="calculteTotalForClaimsPagetwentyone();" value="0" placeholder="0" name="claim_amount_due_default_2_page_21" id="claim_amount_due_default_2_page_21"></td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td><input name="claim_head_default_3_page_21" id="claim_head_default_3_page_21" readonly style="border: none" class="form-control text-center" value="Tuition Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyone();" onkeyup="calculteTotalForClaimsPagetwentyone();" value="0" placeholder="0" name="claim_amount_due_default_3_page_21" id="claim_amount_due_default_3_page_21"></td>
                    </tr>
                    <tr>
                      <th scope="row">4</th>
                      <td><input name="claim_head_default_4_page_21" id="claim_head_default_4_page_21" readonly style="border: none" class="form-control text-center" value="Lab Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyone();" onkeyup="calculteTotalForClaimsPagetwentyone();" value="0" placeholder="0" name="claim_amount_due_default_4_page_21" id="claim_amount_due_default_4_page_21"></td>
                    </tr>
                    <tr>
                      <th scope="row">5</th>
                      <td><input name="claim_head_default_5_page_21" id="claim_head_default_5_page_21" readonly style="border: none" class="form-control text-center" value="Library Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyone();" onkeyup="calculteTotalForClaimsPagetwentyone();" value="0" placeholder="0" name="claim_amount_due_default_5_page_21" id="claim_amount_due_default_5_page_21"></td>
                    </tr>
                    <tr>
                      <th scope="row">6</th>
                      <td><input name="claim_head_default_6_page_21" id="claim_head_default_6_page_21" readonly style="border: none" class="form-control text-center" value="Exam Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyone();" onkeyup="calculteTotalForClaimsPagetwentyone();" value="0" placeholder="0" name="claim_amount_due_default_6_page_21" id="claim_amount_due_default_6_page_21"></td>
                    </tr>
                    <tr>
                      <th scope="row">7</th>
                      <td><input name="claim_head_default_7_page_21" id="claim_head_default_7_page_21" readonly style="border: none" class="form-control text-center" value="Transport Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyone();" onkeyup="calculteTotalForClaimsPagetwentyone();" value="0" placeholder="0" name="claim_amount_due_default_7_page_21" id="claim_amount_due_default_7_page_21"></td>
                     </tr>
                     <tr>
                      <th scope="row">8</th>
                      <td><input name="claim_head_default_8_page_21" id="claim_head_default_8_page_21" readonly style="border: none" class="form-control text-center" value="Hostel Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyone();" onkeyup="calculteTotalForClaimsPagetwentyone();" value="0" placeholder="0" name="claim_amount_due_default_8_page_21" id="claim_amount_due_default_8_page_21"></td>
                     </tr>
                    <tr>
                      <th scope="row">Total</th>
                      <td></td>
                      <th><input readonly style="border: none;" class="form-control text-center" name="claim_amount_due_default_page_21" value="0" id="claim_amount_due_default_page_21"></th>
                                          
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
                        <input onkeyup="numericOnly(event)" type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center" name="claim_due_page_21" id="claim_due_page_21" placeholder="Enter Claim Due" value="{{$data && isset($data['claims']['40']['claim_due'])? $data['claims']['40']['claim_due'] : ''}}">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Status Of Claim:<span style="color: red;">*</span></label>
                        <select onchange="setDisplayForClaimReceivedPage21()" id="claim_status_page_21" name="claim_status_page_21" class="form-control">
                            <option value="" selected>--select--</option>
                            @foreach(\Config::get('constants.claim_status') as $key => $value)
                                <option value="{{$key}}" @if(isset($data['claims'][40])) {{ $data ? $data['claims']['40']['claim_status'] == $key ? 'selected' : '' : ''}} @endif>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3" id="reason_div_page_21">
                        <label>Reason:<span style="color: red;">*</span></label>
                        <input onkeyup="numericOnly(event)" type="text" class="form-control text-center" name="reason_page_21" id="reason_page_21" placeholder="Enter Reason" value="@if(isset($data['claims'][40])) {{$data && $data['claims']['40']['reason']? $data['claims']['40']['reason'] : ''}} @endif">
                    </div>
                    <div class="form-group col-md-3" id="outstanding_cfe_fee_div_page_21">
                        <label>Outstanding CFE Fee:<span style="color: red;">*</span></label>
                        <input type="number" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center" name="outstanding_cfe_fee_page_21" id="outstanding_cfe_fee_page_21" placeholder="Enter Fee" value="{{$data && isset($data['claims']['40']['outstanding_cfe_fee'])? $data['claims']['40']['outstanding_cfe_fee'] : ''}}">
                    </div>
                    <div class="form-group col-md-3" id="recovered_amount_div_page_21">
                        <label>Recovered Amount From Student:<span style="color: red;">*</span></label>
                        <input onkeyup="numericOnly(event)" type="number" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center" name="recovered_amount_page_21" id="recovered_amount_page_21" placeholder="Enter Recovered Amount" value="{{$data && isset($data['claims']['40']['recovered_amount'])? $data['claims']['40']['recovered_amount'] : ''}}">
                    </div>
                </div>
            </div>
        </div>
        <div style="margin-top: 50px;" class="card shadow p-3 w-100" id="claims_statuses_table_page_21">
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
                    @if($data && isset($data['claims'][40]) && count($data['claims'][40]))
                        @php $i = 1; @endphp
                        @foreach($data['claims'] as $claims)
                        @if($claims['page_number'] == 21)
                         <tr>
                             <th scope="row">{{ $i++ }}</th>
                             <td><input name="type_of_claim_{{$i-1}}_page_21" id="type_of_claim_{{$i-1}}_page_21" readonly style="border: none" class="form-control text-center" value="{{$claims['claim_head']}}" ></td>
                             <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyone();" onkeyup="calculteTotalForClaimsPagetwentyone();" value="{{$claims['amount_due']}}" placeholder="0" name="amount_due_{{$i-1}}_page_21" id="amount_due_{{$i-1}}_page_21"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyone();" onkeyup="calculteTotalForClaimsPagetwentyone();" value="{{$claims['amount_received']}}" placeholder="0" name="amount_received_{{$i-1}}_page_21" id="amount_received_{{$i-1}}_page_21"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyone();" onkeyup="calculteTotalForClaimsPagetwentyone();" value="{{$claims['amount_balance']}}" placeholder="0" readonly name="balance_due_{{$i-1}}_page_21" id="balance_due_{{$i-1}}_page_21"></td>
                         </tr>
                         @endif
                        @endforeach
                         <tr>
                          <th scope="row">Total</th>
                          <td></td>
                          <th><input readonly style="border: none;" class="form-control text-center" name="amount_due_page_21" value="{{$data && $data['claims']['40']['total_amount_due']? $data['claims']['40']['total_amount_due'] : ''}}" id="amount_due_page_21"></th>
                          <th><input readonly style="border: none;" class="form-control text-center" name="amount_received_page_21" value="{{$data && $data['claims']['40']['total_amount_received']? $data['claims']['40']['total_amount_received'] : ''}}" id="amount_received_page_21"></th>
                          <th><input readonly style="border: none;" class="form-control text-center" name="balance_due_page_21" value="{{$data && $data['claims']['40']['total_amount_balance']? $data['claims']['40']['total_amount_balance'] : ''}}" id="balance_due_page_21"></th>                      
                        </tr>
                    @else
                    <tr>
                      <th scope="row">1</th>
                      <td><input name="type_of_claim_1_page_21" id="type_of_claim_1_page_21" readonly style="border: none" class="form-control text-center" value="Admission Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyone();" onkeyup="calculteTotalForClaimsPagetwentyone();" value="0" placeholder="0" name="amount_due_1_page_21" id="amount_due_1_page_21"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyone();" onkeyup="calculteTotalForClaimsPagetwentyone();" value="0" placeholder="0" name="amount_received_1_page_21" id="amount_received_1_page_21"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyone();" onkeyup="calculteTotalForClaimsPagetwentyone();" value="0" placeholder="0" readonly name="balance_due_1_page_21" id="balance_due_1_page_21"></td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td><input name="type_of_claim_2_page_21" id="type_of_claim_2_page_21" readonly style="border: none" class="form-control text-center" value="Registration Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyone();" onkeyup="calculteTotalForClaimsPagetwentyone();" value="0" placeholder="0" name="amount_due_2_page_21" id="amount_due_2_page_21"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyone();" onkeyup="calculteTotalForClaimsPagetwentyone();" value="0" placeholder="0" name="amount_received_2_page_21" id="amount_received_2_page_21"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyone();" onkeyup="calculteTotalForClaimsPagetwentyone();" value="0" placeholder="0" readonly name="balance_due_2_page_21" id="balance_due_2_page_21"></td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td><input name="type_of_claim_3_page_21" id="type_of_claim_3_page_21" readonly style="border: none" class="form-control text-center" value="Tuition Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyone();" onkeyup="calculteTotalForClaimsPagetwentyone();" value="0" placeholder="0" name="amount_due_3_page_21" id="amount_due_3_page_21"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyone();" onkeyup="calculteTotalForClaimsPagetwentyone();" value="0" placeholder="0" name="amount_received_3_page_21" id="amount_received_3_page_21"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyone();" onkeyup="calculteTotalForClaimsPagetwentyone();" value="0" placeholder="0" readonly name="balance_due_3_page_21" id="balance_due_3_page_21"></td>
                    </tr>
                    <tr>
                      <th scope="row">4</th>
                      <td><input name="type_of_claim_4_page_21" id="type_of_claim_4_page_21" readonly style="border: none" class="form-control text-center" value="Lab Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyone();" onkeyup="calculteTotalForClaimsPagetwentyone();" value="0" placeholder="0" name="amount_due_4_page_21" id="amount_due_4_page_21"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyone();" onkeyup="calculteTotalForClaimsPagetwentyone();" value="0" placeholder="0" name="amount_received_4_page_21" id="amount_received_4_page_21"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyone();" onkeyup="calculteTotalForClaimsPagetwentyone();" value="0" placeholder="0" readonly name="balance_due_4_page_21" id="balance_due_4_page_21"></td>
                    </tr>
                    <tr>
                      <th scope="row">5</th>
                      <td><input name="type_of_claim_5_page_21" id="type_of_claim_5_page_21" readonly style="border: none" class="form-control text-center" value="Library Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyone();" onkeyup="calculteTotalForClaimsPagetwentyone();" value="0" placeholder="0" name="amount_due_5_page_21" id="amount_due_5_page_21"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyone();" onkeyup="calculteTotalForClaimsPagetwentyone();" value="0" placeholder="0" name="amount_received_5_page_21" id="amount_received_5_page_21"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyone();" onkeyup="calculteTotalForClaimsPagetwentyone();" value="0" placeholder="0" readonly name="balance_due_5_page_21" id="balance_due_5_page_21"></td>
                    </tr>
                    <tr>
                      <th scope="row">6</th>
                      <td><input name="type_of_claim_6_page_21" id="type_of_claim_6_page_21" readonly style="border: none" class="form-control text-center" value="Exam Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyone();" onkeyup="calculteTotalForClaimsPagetwentyone();" value="0" placeholder="0" name="amount_due_6_page_21" id="amount_due_6_page_21"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyone();" onkeyup="calculteTotalForClaimsPagetwentyone();" value="0" placeholder="0" name="amount_received_6_page_21" id="amount_received_6_page_21"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyone();" onkeyup="calculteTotalForClaimsPagetwentyone();" value="0" placeholder="0" readonly name="balance_due_6_page_21" id="balance_due_6_page_21"></td>
                    </tr>
                    <tr>
                      <th scope="row">7</th>
                      <td><input name="type_of_claim_7_page_21" id="type_of_claim_7_page_21" readonly style="border: none" class="form-control text-center" value="Transport Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyone();" onkeyup="calculteTotalForClaimsPagetwentyone();" value="0" placeholder="0" name="amount_due_7_page_21" id="amount_due_7_page_21"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyone();" onkeyup="calculteTotalForClaimsPagetwentyone();" value="0" placeholder="0" name="amount_received_7_page_21" id="amount_received_7_page_21"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyone();" onkeyup="calculteTotalForClaimsPagetwentyone();" value="0" placeholder="0" readonly name="balance_due_7_page_21" id="balance_due_7_page_21"></td>
                    </tr>
                    <tr>
                      <th scope="row">8</th>
                      <td><input name="type_of_claim_8_page_21" id="type_of_claim_8_page_21" readonly style="border: none" class="form-control text-center" value="Hostel Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyone();" onkeyup="calculteTotalForClaimsPagetwentyone();" value="0" placeholder="0" name="amount_due_8_page_21" id="amount_due_8_page_21"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyone();" onkeyup="calculteTotalForClaimsPagetwentyone();" value="0" placeholder="0" name="amount_received_8_page_21" id="amount_received_8_page_21"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyone();" onkeyup="calculteTotalForClaimsPagetwentyone();" value="0" placeholder="0" readonly name="balance_due_8_page_21" id="balance_due_8_page_21"></td>
                    </tr>
                    <tr>
                      <th scope="row">Total</th>
                      <td></td>
                      <th><input readonly style="border: none;" class="form-control text-center" name="amount_due_page_21" value="0" id="amount_due_page_21"></th>
                      <th><input readonly style="border: none;" class="form-control text-center" name="amount_received_page_21" value="0" id="amount_received_page_21"></th>
                      <th><input readonly style="border: none;" class="form-control text-center" name="balance_due_page_21" value="0" id="balance_due_page_21"></th>                      
                    </tr>
                    @endif
                  </tbody>
                </table>
            </div>
        </div>
        {{-- new Claim Fields end --}}
        {{-- new Claim Fields Start --}}
      <div style="margin-top: 50px; display: none;" class="card shadow p-3 w-100" id="provisional_claim_last_page_21">
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
                    @if($data && isset($data['claims'][40]) && count($data['claims'][40]))
                        @php $i = 1; @endphp
                        {{-- @if($claims['page_number'] == 15) --}}
                         <tr>
                             <td><input name="amount_received_last_page_21" id="amount_received_last_page_21" onblur="calculteTotalForClaimsPagetwentyone();" onkeyup="calculteTotalForClaimsPagetwentyone();" readonly class="form-control text-center" value="{{$data && $data['claims']['40']['amount_received_last']? $data['claims']['40']['amount_received_last'] : ''}}" ></td>
                             <td><input type="number" name="total_amount_cheque_page_21" id="total_amount_cheque_page_21" class="form-control text-center" value="{{$data && $data['claims']['40']['total_amount_cheque']? $data['claims']['40']['total_amount_cheque'] : ''}}" ></td>
                             <td><input type="date" name="cheque_date_page_21" id="cheque_date_page_21" class="form-control text-center" value="{{$data && $data['claims']['40']['cheque_date']? $data['claims']['40']['cheque_date'] : ''}}" ></td>
                             <td><input type="number" name="cheque_no_page_21" id="cheque_no_page_21" class="form-control text-center" value="{{$data && $data['claims']['40']['cheque_no']? $data['claims']['40']['cheque_no'] : ''}}" ></td>
                             <td><input type="text" name="bank_name_page_21" id="bank_name_page_21" class="form-control text-center" value="{{$data && $data['claims']['40']['bank_name']? $data['claims']['40']['bank_name'] : ''}}" ></td>
                             <td><input type="text" name="reason_remarks_page_21" id="reason_remarks_page_21" class="form-control text-center" value="{{$data && $data['claims']['40']['reason_remarks']? $data['claims']['40']['reason_remarks'] : ''}}" ></td>
                         </tr>
                         {{-- @endif --}}
                    @else
                    <tr>
                      <td><input class="form-control text-center" type="number" readonly min="0" onblur="calculteTotalForClaimsPagetwentyone();" onkeyup="calculteTotalForClaimsPagetwentyone();" value="0" placeholder="0" name="amount_received_last_page_21" id="amount_received_last_page_21"></td>
                      <td><input class="form-control text-center" type="number" min="0" value="0" placeholder="0" name="total_amount_cheque_page_21" id="total_amount_cheque_page_21"></td>
                      <td><input class="form-control" type="date" style="text-transform: lowercase;" data-date-format="YYYY-MM-DD" name="cheque_date_page_21" id="cheque_date_page_21"></td>
                      <td><input class="form-control text-center" type="number" min="0" value="0" placeholder="0" name="cheque_no_page_21" id="cheque_no_page_21"></td>
                      <td><input class="form-control text-center" type="text" placeholder="Enter Bank Name" onkeypress="return lettersOnly(event)" name="bank_name_page_21" id="bank_name_page_21"></td>
                      <td><input class="form-control text-center" type="text" placeholder="Enter Remarks" name="reason_remarks_page_21" id="reason_remarks_page_21"></td>
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
                    <div class="card-body" id="result_status_fifth_semester_parent">
                        <div class="col-md-12 mt-4">
                            <label for="">Exam Fee:<span style="color: red;">*</span></label>
                        </div>
                        <div class="card shadow p-3 mt-1 w-100">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label>Status:<span style="color: red;">*</span></label>
                                        <select onchange="setExamFeeStatusPage21()" id="exam_status_page21" name="exam_status" class="form-control">
                                            <option value="" selected>--select--</option>
                                            @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                                <option value="{{$key}}" {{ $data ? $data['fifth_semester_details'] != null ? $data['fifth_semester_details']['exam_status'] == $key ? 'selected' : '' : '' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3" id="date_div_exam_page21">
                                        <label>Date:<span style="color: red;">*</span></label>
                                        <input type="text" class="form-control text-center datepicker" name="exam_date"
                                               placeholder="Enter Date"
                                               value="{{$data && isset($data['fifth_semester_details']) ? date('d/m/Y',strtotime($data['fifth_semester_details']['exam_date'])) : ''}}">
                                    </div>
                                    <div class="form-group col-md-3" id="amount_div_exam_page21">
                                        <label>Amount:<span style="color: red;">*</span></label>
                                        <input type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center" name="amount"
                                               placeholder="Enter Amount"
                                               value="{{$data && isset($data['fifth_semester_details']) ? $data['fifth_semester_details']['amount'] : ''}}">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Roll No:<span style="color: red;">*</span></label>
                                        <input readonly="" type="text" class="form-control text-center" name="roll_no"
                                               placeholder="Enter Roll No" value="{{$data ? $data['roll_no'] : ''}}"
                                               >
                                               {{-- value="{{$data && isset($data['fifth_semester_details']) ? $data['fifth_semester_details']['roll_no'] : ''}}" --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row mt-4">
                            <div class="ml-2">
                                <label for="">Result Status:<span style="color: red;">*</span></label>
                            </div>
                            <div class="float-right ml-auto mr-2">
                                <button type="button" class="btn btn-primary float-right" onclick="cloneResultStatusFifthSemester()">
                                    <strong>+</strong></button>
                            </div>
                        </div>
                        <div class="form-row pt-2">
                            <div class="col-md-1 text-center">
                                <label>Result:<span style="color: red;">*</span></label>
                            </div>
                            <div class="form-row col-md-8 ml-0" id="result_status_fifth_semester_pass_headers">
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
                            <div class="col-md-2 text-center">
                                <label>Passing Date:<span style="color: red;">*</span></label>
                            </div>
                        </div>
                        @if($data && isset($data['fifth_semester_result_status_details']) && count($data['fifth_semester_result_status_details']))
                            @foreach($data['fifth_semester_result_status_details'] as $fifthSemesterResultStatusDetails)
                                <div class="form-row mt-2" id="result_status_fifth_semester_div">
                                    <input type="hidden" value="{{$fifthSemesterResultStatusDetails['id']}}" id="result_status_fifth_semester_delete_id">
                                    <div class="col-md-1 p-0">
                                        <select id="result_field_for_fifth_semester" name="result[]" class="form-control result_fifth_semester" onchange="resultChangedForFifthSemester(event)">
                                            <option value="pass" {{ $fifthSemesterResultStatusDetails['result'] == 'pass' ? 'selected' : ''}}>Pass</option>
                                            <option value="fail" {{ $fifthSemesterResultStatusDetails['result'] == 'fail' ? 'selected' : ''}}>Fail</option>
                                        </select>
                                    </div>
                                    <div class="col-md-8 form-row m-0" id="result_status_fifth_semester_pass_values_replacement" style="display: none"></div>
                                    <div class="col-md-8 form-row m-0" id="result_status_fifth_semester_pass_values" style="display: none">
                                        <div class="col-md-3 p-0">
                                            <select name="fail[]" class="form-control promotion_fifth_semester" onchange="setDisplayForSixthSemester()">
                                                <option value="promoted" {{ $fifthSemesterResultStatusDetails['fail'] == 'promoted' ? 'selected' : ''}}>Promoted</option>
                                                <option value="notPromoted" {{ $fifthSemesterResultStatusDetails['fail'] == 'notPromoted' ? 'selected' : ''}}>Not Promoted</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 p-0">
                                            <select name="next_appearance[]" id="next_appearance_5" class="form-control" onchange="nextAppearanceChangedForSemesterOne(event)">
                                                <option value="yes" {{ $fifthSemesterResultStatusDetails['next_appearance'] == 'yes' ? 'selected' : ''}}>Yes</option>
                                                <option value="no" {{ $fifthSemesterResultStatusDetails['next_appearance'] == 'no' ? 'selected' : ''}}>No</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 p-0">
                                            <input type="text" class="form-control text-center nextAppearanceSemesterCheck datepickerFail"
                                                   name="next_appearance_date[]" id="next_appearance_date_5" placeholder="Enter Date" value="{{ $fifthSemesterResultStatusDetails['next_appearance_date'] ? date('d/m/Y',strtotime($fifthSemesterResultStatusDetails['next_appearance_date'])) : ''}}">
                                        </div>
                                        <div class="col-md-3 p-0">
                                            <input type="text" class="form-control text-center nextAppearanceSemesterCheck datepickerFail"
                                                   name="last_chance_date[]" id="last_chance_date_5" placeholder="Enter Date" value="{{$fifthSemesterResultStatusDetails['last_chance_date'] ?  date('d/m/Y',strtotime($fifthSemesterResultStatusDetails['last_chance_date'])) : ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-2 p-0" id="result_status_fifth_semester_pass_value_passing" style="display: none">
                                        <input type="text" class="form-control text-center datepicker" id="passing_date_5" name="passing_date[]"
                                               placeholder="Enter Date" value="{{ $fifthSemesterResultStatusDetails['passing_date'] ? date('d/m/Y',strtotime($fifthSemesterResultStatusDetails['passing_date'])) : ''}}">
                                    </div>
                                    <div class="col-md-1">
                                        <button id="removeResultStatusFifthSemesterButton" type="button" class="btn btn-danger"
                                                onclick="removeResultStatusFifthSemester(event)" @if ($fifthSemesterResultStatusDetails == reset($data['fifth_semester_result_status_details'])) {{'disabled'}} @endif>-
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="form-row mt-2" id="result_status_fifth_semester_div">
                                <div class="col-md-1 p-0">
                                    <select id="result_field_for_fifth_semester" name="result[]" class="form-control result_fifth_semester" onchange="resultChangedForFifthSemester(event)">
                                        <option value="" selected disabled>--select--</option>
                                        <option value="pass">Pass</option>
                                        <option value="fail">Fail</option>
                                    </select>
                                </div>
                                <div class="col-md-8 form-row m-0" id="result_status_fifth_semester_pass_values_replacement" style="display: none"></div>
                                <div class="col-md-8 form-row m-0" id="result_status_fifth_semester_pass_values" style="display: none">
                                    <div class="col-md-3 p-0">
                                        <select name="fail[]" id="checkfail_21" class="form-control promotion_fifth_semester" onchange="setDisplayForSixthSemester()">
                                            <option value="promoted">Promoted</option>
                                            <option value="notPromoted" selected>Not Promoted</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 p-0">
                                        <select name="next_appearance[]" id="next_appearance_5" class="form-control" onchange="nextAppearanceChangedForSemesterOne(event)">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 p-0">
                                        <input type="text" class="form-control text-center nextAppearanceSemesterCheck datepickerFail"
                                               name="next_appearance_date[]" id="next_appearance_date_5" placeholder="Enter Date">
                                    </div>
                                    <div class="col-md-3 p-0">
                                        <input type="text" class="form-control text-center nextAppearanceSemesterCheck datepickerFail"
                                               name="last_chance_date[]" id="last_chance_date_5" placeholder="Enter Date">
                                    </div>
                                </div>
                                <div class="col-md-2 p-0" id="result_status_fifth_semester_pass_value_passing" style="display: none">
                                    <input type="text" class="form-control text-center datepicker" id="passing_date_5" name="passing_date[]"
                                           placeholder="Enter Date">
                                </div>
                                <div class="col-md-1">
                                    <button id="removeResultStatusFifthSemesterButton" type="button" class="btn btn-danger"
                                            onclick="removeResultStatusFifthSemester(event)" disabled>-
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
                                        <select name="readmissionfifth" id="setreadmission" class="form-control text-center" onchange="setReadmissionFive(event)">
                                            <option value="" selected>--select--</option>
                                            @foreach(\Config::get('constants.general_yes_no') as $key => $general_yes_no)
                                                @if(isset($data['fifth_semester_details']['readmissionfifth']))
                                                    <option value="{{$key}}" {{ $data ? $data['fifth_semester_details']['readmissionfifth'] == $key ? 'selected' : '' : ''}}>{{$general_yes_no}}</option>
                                                @else
                                                    <option value="{{$key}}">{{$general_yes_no}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4" id="same_course_page_21" style="display: none;">
                                        <label>Same Course:<span style="color: red;">*</span></label>
                                        <select  name="same_course" class="form-control" id="same_course_21">
                                            <option value="" selected>--select--</option>
                                            @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                                <option value="{{$key}}" {{ $data ? $data['fifth_semester_details'] != null ? $data['fifth_semester_details']['same_course'] == $key ? 'selected' : '' : '' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4" id="change_course_page_21" style="display: none;">
                                        <label>Changed Course:<span style="color: red;">*</span></label>
                                        <select  name="changed_course" class="form-control" id="change_course_21">
                                            <option value="" selected>--select--</option>
                                            @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                                <option value="{{$key}}" {{ $data ? $data['fifth_semester_details'] != null ? $data['fifth_semester_details']['changed_course'] == $key ? 'selected' : '' : '' : ''}}>{{$value}}</option>
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
{{--@endif--}}
@section('script_page_21')
    <script>
        if(index_id){
            // setDisplayForSixthSemester();
        }
        setDisplayForSixthSemester();
        setResultHeaderDisplayForFifthSemester();
        setStatusDatePage21();
        setPwwbStatusPage21();
        setClaimStatusPage21();
        setExamFeeStatusPage21();
        setReadmissionFive();
        function cloneResultStatusFifthSemester() {
            let clone = $('#result_status_fifth_semester_div').clone();
            $('#result_status_fifth_semester_parent').append(clone);
            let button = clone.find('#removeResultStatusFifthSemesterButton').removeAttr('disabled');
            // let dropdown = $(clone.find('#result_field_for_annual_part_one').parent().siblings()[0]).hide();
            setResultHeaderDisplayForFifthSemester();
            clone.find('.datepicker').each(function (index, pick) {
                let picker = $(pick).datepicker({
                    format: 'dd/mm/yyyy'
                }).on('changeDate', function (ev) {
                    setAccumulatedYears();
                    picker.hide();
                }).data('datepicker');
            });
            clone.find('.datepickerFail').datepicker({
                format:'dd/mm/yyyy',
                endDate: new Date(),
                autoclose: true
            });
            setDisplayForSixthSemester();
        }

        function removeResultStatusFifthSemester(event) {
            if(index_id) {
                let csrf_token = $('meta[name="csrf-token"]').attr('content');
                let request = $.ajax({
                    url: '/fifth-semester-delete',
                    method: "POST",
                    data: {
                        'index_id' : index_id,
                        'id' : $(event.target).parent().parent().find('#result_status_fifth_semester_delete_id').val()
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
            setDisplayForSixthSemester();
        }

        function resultChangedForFifthSemester(event) {
            setResultHeaderDisplayForFifthSemester();
            setDisplayForSixthSemester();
            if($(event.target).val() == 'fail'){
                $('#passing_date_5').val('');
                $('.semester-tab-conversion').remove();
                $('.semester-tab6').remove();
                $('#v-pills-tab').append('<a class="nav-link semester-tab semester-tab-conversion aa" id="v-pills-page_25-tab" data-toggle="pill" href="#v-pills-page_25" role="tab" aria-controls="v-pills-page_25" aria-selected="true">Conversion in Next Degree</a>');
                $(event.target).parent().parent().find('#result_status_fifth_semester_pass_values').fadeIn();
                $(event.target).parent().parent().find('#result_status_fifth_semester_pass_values_replacement').fadeOut();
                $(event.target).parent().parent().find('#result_status_fifth_semester_pass_value_passing').fadeOut();
            }
            else if($(event.target).val() == 'pass'){
                 $('#last_chance_date_5').val('');
                $('#next_appearance_5').val('no');
                $('#next_appearance_date_5').val('');
                $('.semester-tab-conversion').remove();
                if(total_sem_count > 5){
                    $('#v-pills-tab').append('<a class="nav-link semester-tab semester-tab6 aa" id="v-pills-page_22-tab" data-toggle="pill" href="#v-pills-page_22" role="tab" aria-controls="v-pills-page_22" aria-selected="true">Continue 5(Sixth Semester)</a><a class="nav-link semester-tab semester-tab-conversion aa" id="v-pills-page_25-tab" data-toggle="pill" href="#v-pills-page_25" role="tab" aria-controls="v-pills-page_25" aria-selected="true">Conversion in Next Degree</a>');
                }
                else{
                    $('#v-pills-tab').append('<a class="nav-link semester-tab semester-tab-conversion aa" id="v-pills-page_25-tab" data-toggle="pill" href="#v-pills-page_25" role="tab" aria-controls="v-pills-page_25" aria-selected="true">Conversion in Next Degree</a>');

                }

                $(event.target).parent().parent().find('#result_status_fifth_semester_pass_values').fadeOut();
                $(event.target).parent().parent().find('#result_status_fifth_semester_pass_values_replacement').fadeIn();
                $(event.target).parent().parent().find('#result_status_fifth_semester_pass_value_passing').fadeIn();
            }
            else{
                $(event.target).parent().parent().find('#result_status_fifth_semester_pass_values').fadeOut();
                $(event.target).parent().parent().find('#result_status_fifth_semester_pass_values_replacement').fadeOut();
                $(event.target).parent().parent().find('#result_status_fifth_semester_pass_value_passing').fadeOut();
            }
        }

        function setResultHeaderDisplayForFifthSemester() {
            $('.result_fifth_semester').each(function (index,value) {
                if($(value).val() == 'fail'){
                    $(value).parent().parent().find('#result_status_fifth_semester_pass_values').show();
                    $(value).parent().parent().find('#result_status_fifth_semester_pass_values_replacement').hide();
                    $(value).parent().parent().find('#result_status_fifth_semester_pass_value_passing').hide();
                }
                else if($(value).val() == 'pass'){
                    $(value).parent().parent().find('#result_status_fifth_semester_pass_values').hide();
                    $(value).parent().parent().find('#result_status_fifth_semester_pass_values_replacement').show();
                    $(value).parent().parent().find('#result_status_fifth_semester_pass_value_passing').show();
                }
                else{
                    $(value).parent().parent().find('#result_status_fifth_semester_pass_values').hide();
                    $(value).parent().parent().find('#result_status_fifth_semester_pass_values_replacement').hide();
                    $(value).parent().parent().find('#result_status_fifth_semester_pass_value_passing').hide();
                }
            });
        }

        // function setDisplayForSixthSemester(){
        //     let check = true;
        //     let term_array = {
        //         'cs': '#bise_academic_term',
        //         'ims': '#ims_academic_term',
        //         'af': '#af_academic_term',
        //         'vti': '#vti_scheme_of_study'
        //     };
        //     let parent = $('#cfe_wing_selection option:selected').val();
        //     let selectedTerm = $(term_array[parent]).val();
        //     if(selectedTerm == 'semester') {
        //         let allResults = $('.result_fifth_semester');
        //         let length = allResults.length;
        //         if ($(allResults[length - 1]).val() == 'pass') {
        //             container_array.splice(15, 0, '#page_22');
        //             api_url_array.splice(15, 0, '/sixth-semester');
        //         } else {
        //             let allPromotions = $('.promotion_fifth_semester');
        //             let lengthForPromotion = allPromotions.length;
        //             if ($(allPromotions[lengthForPromotion - 1]).val() == 'promoted') {
        //                 container_array.splice(15, 0, '#page_22');
        //                 api_url_array.splice(15, 0, '/sixth-semester');
        //                 $('.semester-tab-conversion').remove();
        //                 $('#v-pills-tab').append('<a class="nav-link semester-tab semester-tab6 aa" id="v-pills-page_22-tab" data-toggle="pill" href="#v-pills-page_22" role="tab" aria-controls="v-pills-page_22" aria-selected="true">Continue 5(Sixth Semester)</a><a class="nav-link semester-tab semester-tab-conversion aa" id="v-pills-page_25-tab" data-toggle="pill" href="#v-pills-page_25" role="tab" aria-controls="v-pills-page_25" aria-selected="true">Conversion in Next Degree</a>');
        //             } else {
        //                 container_array.splice(15, container_array.length - 15);
        //                 api_url_array.splice(15, api_url_array.length - 15);
        //                 container_no = 14;
        //                 $('.semester-tab-conversion').remove();
        //                 $('.semester-tab6').remove();
        //             }
        //         }
        //     }
        //     console.log('Here We Are');
        //     setDisplayForButtons();
        //
        // }

        function setDisplayForSixthSemester(){
            let check = true;
            let term_array = {
                '2': '#bise_academic_term',
                '3': '#ims_academic_term',
                '1': '#af_academic_term',
                '4': '#vti_scheme_of_study'
            };
            let parent = $('#cfe_wing_selection option:selected').val();
            let selectedTerm = $(term_array[parent]).val();
            if(selectedTerm == '1') {
                let allResults = $('.result_fifth_semester');
                let length = allResults.length;
                if ($(allResults[length - 1]).val() == 'pass') {
                    $('#page_22').show();

                    if(total_sem_count > 5){
                        container_array.splice(15, 0, '#page_22');
                        api_url_array.splice(15, 0, '/sixth-semester');
                        $('.semester-tab6').remove();
                        $('#checkfail_21').val('notPromoted');
                    }
                    else{
                        $('.semester-tab-conversion').remove();
                        $('.semester-tab6').remove();
                        $('#page_22').hide();
                        $('#v-pills-page_22-tab').remove();
                        $('#v-pills-tab').append('<a class="nav-link semester-tab semester-tab-conversion aa" id="v-pills-page_25-tab" data-toggle="pill" href="#v-pills-page_25" role="tab" aria-controls="v-pills-page_25" aria-selected="true">Conversion in Next Degree</a>');
                        // $('#v-pills-page_25').addClass('active');
                    }
                } else {
                    let allPromotions = $('.promotion_fifth_semester');
                    let lengthForPromotion = allPromotions.length;
                    if ($(allPromotions[lengthForPromotion - 1]).val() == 'promoted') {

                        $('#page_22').show();
                        if(total_sem_count > 5){
                            container_array.splice(15, 0, '#page_22');
                            api_url_array.splice(15, 0, '/sixth-semester');
                            $('.semester-tab-conversion').remove();
                            $('.semester-tab6').remove();
                            if (document.getElementById('v-pills-page_22-tab')) {
                                // alert('this record already exists');
                                $('#v-pills-tab').append('<a class="nav-link semester-tab semester-tab-conversion aa" id="v-pills-page_25-tab" data-toggle="pill" href="#v-pills-page_25" role="tab" aria-controls="v-pills-page_25" aria-selected="true">Conversion in Next Degree</a>');
                            } else {
                                $('#v-pills-tab').append('<a class="nav-link semester-tab semester-tab6 aa" id="v-pills-page_22-tab" data-toggle="pill" href="#v-pills-page_22" role="tab" aria-controls="v-pills-page_22" aria-selected="true">Continue 5(Sixth Semester)</a><a class="nav-link semester-tab semester-tab-conversion aa" id="v-pills-page_25-tab" data-toggle="pill" href="#v-pills-page_25" role="tab" aria-controls="v-pills-page_25" aria-selected="true">Conversion in Next Degree</a>');
                            }
                        }
                        else{
                            $('.semester-tab-conversion').remove();
                            $('.semester-tab6').remove();
                            $('#page_22').hide();
                            $('#v-pills-page_22-tab').remove();
                            $('#v-pills-tab').append('<a class="nav-link semester-tab semester-tab-conversion aa" id="v-pills-page_25-tab" data-toggle="pill" href="#v-pills-page_25" role="tab" aria-controls="v-pills-page_25" aria-selected="true">Conversion in Next Degree</a>');
                            // $('#v-pills-page_25').addClass('active');
                        }


                        // $('#v-pills-tab').append('<a class="nav-link semester-tab semester-tab6 aa" id="v-pills-page_22-tab" data-toggle="pill" href="#v-pills-page_22" role="tab" aria-controls="v-pills-page_22" aria-selected="true">Continue 5(Sixth Semester)</a><a class="nav-link semester-tab semester-tab-conversion aa" id="v-pills-page_25-tab" data-toggle="pill" href="#v-pills-page_25" role="tab" aria-controls="v-pills-page_25" aria-selected="true">Conversion in Next Degree</a>');
                    } else {
                        container_array.splice(15, container_array.length - 15);
                        api_url_array.splice(15, api_url_array.length - 15);
                        container_no = 14;
                        // $('.semester-tab-conversion').remove();
                        $('.semester-tab6').remove();
                        $('#page_22').hide();
                    }
                }
            }
            console.log('Here We Are');
            setDisplayForButtons();

        }
        function setReadmissionFive(e) {
            let selected = $('select[name="readmissionfifth"]').val();
            if(selected == 'yes'){
                $('#same_course_page_21').show();
                $('#change_course_page_21').show();

            }
            else{
                if(!index_id){
                    $('#same_course_21').val('');
                    $('#change_course_21').val('');
                }
                $('#same_course_page_21').hide();
                $('#change_course_page_21').hide();
            }
        }

        function setStatusDatePage21() {
            if($('#status_page21').val() == 'yes'){
                $('#date_div_page21').fadeIn();
            }
            else{
                $('#date_div_page21').fadeOut();
            }
        }

        function setPwwbStatusPage21() {
            if($('#pwwb_status_page21').val() == 'yes'){
                $('#diary_no_pwwb_page21').fadeIn();
                $('#date_div_pwwb_page21').fadeIn();
            }
            else{
                $('#date_div_pwwb_page21').fadeOut();
                $('#diary_no_pwwb_page21').fadeOut();
            }
        }

        function setClaimStatusPage21() {
            if($('#claim_status_page21').val() == 'yes'){
                $('#date_div_claim_page21').fadeIn();
                $('#amount_claim_page21').fadeIn();
            }
            else{
                $('#amount_claim_page21').fadeOut();
                $('#date_div_claim_page21').fadeOut();
            }
        }

        function setExamFeeStatusPage21() {
            if($('#exam_status_page21').val() == 'yes'){
                $('#date_div_exam_page21').fadeIn();
                $('#amount_div_exam_page21').fadeIn();
            }
            else{
                $('#amount_div_exam_page21').fadeOut();
                $('#date_div_exam_page21').fadeOut();
            }
        }
        function nextAppearanceChangedForSemesterOne(event) {
            if($(event.target).val() == 'no'){
                $(event.target).parent().parent().find('.nextAppearanceSemesterCheck').fadeOut();
            }
            else if($(event.target).val() == 'yes'){
                $(event.target).parent().parent().find('.nextAppearanceSemesterCheck').fadeIn();
            }
        }

        setDisplayForClaimReceivedPage21();
        function setDisplayForClaimReceivedPage21() {
            if($('#claim_status_page_21').val() == 'received'){
                for (var i = 1; i <= 8; i++) {
                  $(`#amount_due_${i}_page_21`).val($(`#claim_amount_due_default_${i}_page_21`).val());
                  calculteTotalForClaimsPagetwentyone();
                }
                $('#recovered_amount_div_page_21').fadeOut();
                $('#outstanding_cfe_fee_div_page_21').fadeOut();
                $('#reason_div_page_21').fadeOut();            
                $('#claims_statuses_table_page_21').fadeIn();
                $('#provisional_claim_last_page_21').fadeIn();
            }
            else if($('#claim_status_page_21').val() == 'rejected'){
              $('#recovered_amount_div_page_21').fadeIn();
                $('#outstanding_cfe_fee_div_page_21').fadeIn();
                $('#reason_div_page_21').fadeIn();
                $('#claims_statuses_table_page_21').fadeOut();
                $('#provisional_claim_last_page_21').fadeOut();
            }
            else if($('#claim_status_page_21').val() == 'notReceived'){
              $('#recovered_amount_div_page_21').fadeOut();
                $('#outstanding_cfe_fee_div_page_21').fadeOut();
                $('#reason_div_page_21').fadeIn();
                $('#claims_statuses_table_page_21').fadeOut();
                $('#provisional_claim_last_page_21').fadeOut();
            }
            else if($('#claim_status_page_21').val() == 'cancelled'){
              $('#recovered_amount_div_page_21').fadeOut();
                $('#outstanding_cfe_fee_div_page_21').fadeOut();
                $('#reason_div_page_21').fadeIn();
                $('#claims_statuses_table_page_21').fadeOut();
                $('#provisional_claim_last_page_21').fadeOut();
            }
            else{
              $('#recovered_amount_div_page_21').fadeOut();
                $('#outstanding_cfe_fee_div_page_21').fadeOut();
                $('#reason_div_page_21').fadeOut();
                $('#claims_statuses_table_page_21').fadeOut();
                $('#provisional_claim_last_page_21').fadeOut();
            }
        }

        function calculteTotalForClaimsPagetwentyone(){
            var claim_amount_due_default_page_21 = 0;
            var amount_due_page_21 = 0;
            var amount_received_page_21 = 0;
            var balance_due_page_21 = 0;

            for (var i = 1; i <= 8; i++) {
              $(`#amount_due_${i}_page_21`).val($(`#claim_amount_due_default_${i}_page_21`).val());
            }

            for(var i = 1; i <= 8; i++){
                var total_balance = 0;
                claim_amount_due_default_page_21 = parseFloat(claim_amount_due_default_page_21) + parseFloat($('#claim_amount_due_default_'+i+'_page_21').val());
                if($('#claim_amount_due_default_'+i+'_page_21').val() == ""){
                      $('#claim_amount_due_default_'+i+'_page_21').val('0');
                  }
                amount_due_page_21 = parseFloat(amount_due_page_21) + parseFloat($('#amount_due_'+i+'_page_21').val());
                if($('#amount_due_'+i+'_page_21').val() == ""){
                      $('#amount_due_'+i+'_page_21').val('0');
                  }
                amount_received_page_21 = parseFloat(amount_received_page_21) + parseFloat($('#amount_received_'+i+'_page_21').val());
                if($('#amount_received_'+i+'_page_21').val() == ""){
                      $('#amount_received_'+i+'_page_21').val('0');
                  }

                  if (parseFloat($('#amount_received_'+i+'_page_21').val()) > parseFloat($('#amount_due_'+i+'_page_21').val())) {
                  $('#amount_received_'+i+'_page_21').val('0');
                  $.notify('Amount Due cannot be less than Amount Received!');
                  }

               balance_due_page_21 = parseFloat(balance_due_page_21) + parseFloat($('#balance_due_'+i+'_page_21').val());
                if(amount_due_page_21 < amount_received_page_21){
                    // alert("Amount Received Cannot Be Higher Then Amount Due");
                    $('#amount_received_'+i+'_page_21').val()
                    // return false;
                }    
                if($('#amount_due_'+i+'_page_21').val() != "0" || $('#amount_received_'+i+'_page_21').val() != "0"){
                    total_balance = parseFloat($('#amount_due_'+i+'_page_21').val()) - parseFloat($('#amount_received_'+i+'_page_21').val());
                    $('#balance_due_'+i+'_page_21').val(total_balance);
                }              
            }
            
            $('#claim_amount_due_default_page_21').val(claim_amount_due_default_page_21);
            $('#amount_due_page_21').val(amount_due_page_21);
            $('#amount_received_page_21').val(amount_received_page_21);
            $('#balance_due_page_21').val(balance_due_page_21);
            $('#claim_due_page_21').val(claim_amount_due_default_page_21);
            $('#amount_received_last_page_21').val(amount_received_page_21);
        }

        $('.datepickerFail').datepicker({
            format:'dd/mm/yyyy',
            endDate: new Date(),
            autoclose: true
        });
    </script>
@endsection
