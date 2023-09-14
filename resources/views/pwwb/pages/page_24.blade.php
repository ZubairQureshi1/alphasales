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
{{--@if(isset($data['eighth_semester_details']['exam_status']) != null )--}}
<div id="page_24">
    <form id="page_24_form">
        <div class="card shadow p-3 w-100">
            <div class="col-md-12">
                <h1>Continue 7(Eight Semester)<span class="float-right">Page # 18</span></h1><br>
            </div>
            <div class="card-body ">
                <div class="card shadow p-3 w-100">
                    <div class="card-body">
                        <div class="col-md-12 mt-4">
                            <label for="" style="font-size: 20px;">8th Semester File Received in CFE Cell:</label>
                        </div>
                        <div class="card shadow p-3 w-100">
                            <div class="card-body ">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label>Status:<span style="color: red;">*</span></label>
                                        <select onchange="setStatusDatePage24()" id="status_page24" name="cell_status" class="form-control">
                                            <option value="" selected>--select--</option>
                                            @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                                <option value="{{$key}}" {{ $data ? $data['eighth_semester_details'] != null ? $data['eighth_semester_details']['cell_status'] == $key ? 'selected' : '' : '' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3" id="date_div_page24">
                                        <label>Date:<span style="color: red;">*</span></label>
                                        <input type="text" class="form-control text-center datepicker" name="cell_date"
                                               placeholder="Enter Date"
                                               value="{{$data && isset($data['eighth_semester_details']) ? date('d/m/Y',strtotime($data['eighth_semester_details']['cell_date'])) : ''}}">
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
                                <select onchange="setPwwbStatusPage24()" id="pwwb_status_page24" name="pwwb_status" class="form-control">
                                    <option value="" selected>--select--</option>
                                    @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                        <option value="{{$key}}" {{ $data ? $data['eighth_semester_details'] != null ? $data['eighth_semester_details']['pwwb_status'] == $key ? 'selected' : '' : '' : ''}}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3" id="date_div_pwwb_page24">
                                <label>Date:<span style="color: red;">*</span></label>
                                <input type="text" class="form-control text-center datepicker" name="pwwb_date"
                                       placeholder="Enter Date"
                                       value="{{$data && isset($data['eighth_semester_details']) ? date('d/m/Y',strtotime($data['eighth_semester_details']['pwwb_date'])) : ''}}">
                            </div>
                            <div class="form-group col-md-3" id="diary_no_pwwb_page24">
                                <label>Diary No. in PWWB:<span style="color: red;">*</span></label>
                                <input type="text" class="form-control text-center" name="diary_pwwb" placeholder="XXXXX"
                                       value="{{$data && isset($data['eighth_semester_details']) ? $data['eighth_semester_details']['diary_pwwb'] : ''}}">
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
                                       value="{{$data && isset($data['eighth_semester_details']) ? $data['eighth_semester_details']['amount_claim_due'] : ''}}">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Status of Claimed Received:<span style="color: red;">*</span></label>
                                <select onchange="setClaimStatusPage24()" id="claim_status_page24" name="claim_status" class="form-control">
                                    <option value="" selected>--select--</option>
                                    @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                        <option value="{{$key}}" {{ $data ? $data['eighth_semester_details'] != null ? $data['eighth_semester_details']['claim_status'] == $key ? 'selected' : '' : '' : ''}}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3" id="amount_claim_page24">
                                <label>Amount Received:<span style="color: red;">*</span></label>
                                <input type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center" name="amount_received"
                                       placeholder="Enter Amount"
                                       value="{{$data && isset($data['eighth_semester_details']) ? $data['eighth_semester_details']['amount_received'] : ''}}">
                            </div>
                            <div class="form-group col-md-3" id="date_div_claim_page24">
                                <label>Date:<span style="color: red;">*</span></label>
                                <input type="text" class="form-control text-center datepicker" name="claim_date"
                                       placeholder="Enter Date"
                                       value="{{$data && isset($data['eighth_semester_details']) ? date('d/m/Y',strtotime($data['eighth_semester_details']['claim_date'])) : ''}}">
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
                    @if($data && isset($data['claims'][64]) && count($data['claims'][64]))
                        @php $i = 1; @endphp
                        @foreach($data['claims'] as $claims)
                        @if($claims['page_number'] == 24)
                         <tr>
                             <th scope="row">{{ $i++ }}</th>
                             <td><input name="claim_head_default_{{$i-1}}_page_24" id="claim_head_default_{{$i-1}}_page_24" readonly style="border: none" class="form-control text-center" value="{{$claims['claim_head_default']}}" ></td>
                             <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyfour();" onkeyup="calculteTotalForClaimsPagetwentyfour();" value="{{$claims['claim_amount_due_default']}}" placeholder="0" name="claim_amount_due_default_{{$i-1}}_page_24" id="claim_amount_due_default_{{$i-1}}_page_24"></td>
                         </tr>
                         @endif
                        @endforeach
                         <tr>
                          <th scope="row">Total</th>
                          <td></td>
                          <th><input readonly style="border: none;" class="form-control text-center" name="claim_amount_due_default_page_24" value="{{$data && $data['claims']['64']['total_amount_due_default']? $data['claims']['64']['total_amount_due_default'] : ''}}" id="claim_amount_due_default_page_24"></th>
                        </tr>
                    @else
                    <tr>
                      <th scope="row">1</th>
                      <td><input name="claim_head_default_1_page_24" id="claim_head_default_1_page_24" readonly style="border: none" class="form-control text-center" value="Admission Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyfour();" onkeyup="calculteTotalForClaimsPagetwentyfour();" value="0" placeholder="0" name="claim_amount_due_default_1_page_24" id="claim_amount_due_default_1_page_24"></td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td><input name="claim_head_default_2_page_24" id="claim_head_default_2_page_24" readonly style="border: none" class="form-control text-center" value="Registration Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyfour();" onkeyup="calculteTotalForClaimsPagetwentyfour();" value="0" placeholder="0" name="claim_amount_due_default_2_page_24" id="claim_amount_due_default_2_page_24"></td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td><input name="claim_head_default_3_page_24" id="claim_head_default_3_page_24" readonly style="border: none" class="form-control text-center" value="Tuition Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyfour();" onkeyup="calculteTotalForClaimsPagetwentyfour();" value="0" placeholder="0" name="claim_amount_due_default_3_page_24" id="claim_amount_due_default_3_page_24"></td>
                    </tr>
                    <tr>
                      <th scope="row">4</th>
                      <td><input name="claim_head_default_4_page_24" id="claim_head_default_4_page_24" readonly style="border: none" class="form-control text-center" value="Lab Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyfour();" onkeyup="calculteTotalForClaimsPagetwentyfour();" value="0" placeholder="0" name="claim_amount_due_default_4_page_24" id="claim_amount_due_default_4_page_24"></td>
                    </tr>
                    <tr>
                      <th scope="row">5</th>
                      <td><input name="claim_head_default_5_page_24" id="claim_head_default_5_page_24" readonly style="border: none" class="form-control text-center" value="Library Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyfour();" onkeyup="calculteTotalForClaimsPagetwentyfour();" value="0" placeholder="0" name="claim_amount_due_default_5_page_24" id="claim_amount_due_default_5_page_24"></td>
                    </tr>
                    <tr>
                      <th scope="row">6</th>
                      <td><input name="claim_head_default_6_page_24" id="claim_head_default_6_page_24" readonly style="border: none" class="form-control text-center" value="Exam Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyfour();" onkeyup="calculteTotalForClaimsPagetwentyfour();" value="0" placeholder="0" name="claim_amount_due_default_6_page_24" id="claim_amount_due_default_6_page_24"></td>
                    </tr>
                    <tr>
                      <th scope="row">7</th>
                      <td><input name="claim_head_default_7_page_24" id="claim_head_default_7_page_24" readonly style="border: none" class="form-control text-center" value="Transport Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyfour();" onkeyup="calculteTotalForClaimsPagetwentyfour();" value="0" placeholder="0" name="claim_amount_due_default_7_page_24" id="claim_amount_due_default_7_page_24"></td>
                     </tr>
                     <tr>
                      <th scope="row">8</th>
                      <td><input name="claim_head_default_8_page_24" id="claim_head_default_8_page_24" readonly style="border: none" class="form-control text-center" value="Hostel Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyfour();" onkeyup="calculteTotalForClaimsPagetwentyfour();" value="0" placeholder="0" name="claim_amount_due_default_8_page_24" id="claim_amount_due_default_8_page_24"></td>
                     </tr>
                    <tr>
                      <th scope="row">Total</th>
                      <td></td>
                      <th><input readonly style="border: none;" class="form-control text-center" name="claim_amount_due_default_page_24" value="0" id="claim_amount_due_default_page_24"></th>
                                          
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
                        <input onkeyup="numericOnly(event)" type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center" name="claim_due_page_24" id="claim_due_page_24" placeholder="Enter Claim Due" value="{{$data && isset($data['claims']['64']['claim_due'])? $data['claims']['64']['claim_due'] : ''}}">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Status Of Claim:<span style="color: red;">*</span></label>
                        <select onchange="setDisplayForClaimReceivedPage24()" id="claim_status_page_24" name="claim_status_page_24" class="form-control">
                            <option value="" selected>--select--</option>
                            @foreach(\Config::get('constants.claim_status') as $key => $value)
                                <option value="{{$key}}" @if(isset($data['claims'][64])) {{ $data ? $data['claims']['64']['claim_status'] == $key ? 'selected' : '' : ''}} @endif>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3" id="reason_div_page_24">
                        <label>Reason:<span style="color: red;">*</span></label>
                        <input onkeyup="numericOnly(event)" type="text" class="form-control text-center" name="reason_page_24" id="reason_page_24" placeholder="Enter Reason" value="@if(isset($data['claims'][64])) {{$data && $data['claims']['64']['reason']? $data['claims']['64']['reason'] : ''}} @endif">
                    </div>
                    <div class="form-group col-md-3" id="outstanding_cfe_fee_div_page_24">
                        <label>Outstanding CFE Fee:<span style="color: red;">*</span></label>
                        <input onkeyup="numericOnly(event)" type="number" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center" name="outstanding_cfe_fee_page_24" id="outstanding_cfe_fee_page_24" placeholder="Enter Fee" value="{{$data && isset($data['claims']['64']['outstanding_cfe_fee'])? $data['claims']['64']['outstanding_cfe_fee'] : ''}}">
                    </div>
                    <div class="form-group col-md-3" id="recovered_amount_div_page_24">
                        <label>Recovered Amount From Student:<span style="color: red;">*</span></label>
                        <input onkeyup="numericOnly(event)" type="number" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center" name="recovered_amount_page_24" id="recovered_amount_page_24" placeholder="Enter Recovered Amount" value="{{$data && isset($data['claims']['64']['recovered_amount'])? $data['claims']['64']['recovered_amount'] : ''}}">
                    </div>
                </div>
            </div>
        </div>
        <div style="margin-top: 50px;" class="card shadow p-3 w-100" id="claims_statuses_table_page_24">
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
                    @if($data && isset($data['claims'][64]) && count($data['claims'][64]))
                        @php $i = 1; @endphp
                        @foreach($data['claims'] as $claims)
                        @if($claims['page_number'] == 24)
                         <tr>
                             <th scope="row">{{ $i++ }}</th>
                             <td><input name="type_of_claim_{{$i-1}}_page_24" id="type_of_claim_{{$i-1}}_page_24" readonly style="border: none" class="form-control text-center" value="{{$claims['claim_head']}}" ></td>
                             <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyfour();" onkeyup="calculteTotalForClaimsPagetwentyfour();" value="{{$claims['amount_due']}}" placeholder="0" name="amount_due_{{$i-1}}_page_24" id="amount_due_{{$i-1}}_page_24"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyfour();" onkeyup="calculteTotalForClaimsPagetwentyfour();" value="{{$claims['amount_received']}}" placeholder="0" name="amount_received_{{$i-1}}_page_24" id="amount_received_{{$i-1}}_page_24"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyfour();" onkeyup="calculteTotalForClaimsPagetwentyfour();" value="{{$claims['amount_balance']}}" placeholder="0" readonly name="balance_due_{{$i-1}}_page_24" id="balance_due_{{$i-1}}_page_24"></td>
                         </tr>
                         @endif
                        @endforeach
                         <tr>
                          <th scope="row">Total</th>
                          <td></td>
                          <th><input readonly style="border: none;" class="form-control text-center" name="amount_due_page_24" value="{{$data && $data['claims']['64']['total_amount_due']? $data['claims']['64']['total_amount_due'] : ''}}" id="amount_due_page_24"></th>
                          <th><input readonly style="border: none;" class="form-control text-center" name="amount_received_page_24" value="{{$data && $data['claims']['64']['total_amount_received']? $data['claims']['64']['total_amount_received'] : ''}}" id="amount_received_page_24"></th>
                          <th><input readonly style="border: none;" class="form-control text-center" name="balance_due_page_24" value="{{$data && $data['claims']['64']['total_amount_balance']? $data['claims']['64']['total_amount_balance'] : ''}}" id="balance_due_page_24"></th>                      
                        </tr>
                    @else
                    <tr>
                      <th scope="row">1</th>
                      <td><input name="type_of_claim_1_page_24" id="type_of_claim_1_page_24" readonly style="border: none" class="form-control text-center" value="Admission Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyfour();" onkeyup="calculteTotalForClaimsPagetwentyfour();" value="0" placeholder="0" name="amount_due_1_page_24" id="amount_due_1_page_24"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyfour();" onkeyup="calculteTotalForClaimsPagetwentyfour();" value="0" placeholder="0" name="amount_received_1_page_24" id="amount_received_1_page_24"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyfour();" onkeyup="calculteTotalForClaimsPagetwentyfour();" value="0" placeholder="0" readonly name="balance_due_1_page_24" id="balance_due_1_page_24"></td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td><input name="type_of_claim_2_page_24" id="type_of_claim_2_page_24" readonly style="border: none" class="form-control text-center" value="Registration Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyfour();" onkeyup="calculteTotalForClaimsPagetwentyfour();" value="0" placeholder="0" name="amount_due_2_page_24" id="amount_due_2_page_24"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyfour();" onkeyup="calculteTotalForClaimsPagetwentyfour();" value="0" placeholder="0" name="amount_received_2_page_24" id="amount_received_2_page_24"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyfour();" onkeyup="calculteTotalForClaimsPagetwentyfour();" value="0" placeholder="0" readonly name="balance_due_2_page_24" id="balance_due_2_page_24"></td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td><input name="type_of_claim_3_page_24" id="type_of_claim_3_page_24" readonly style="border: none" class="form-control text-center" value="Tuition Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyfour();" onkeyup="calculteTotalForClaimsPagetwentyfour();" value="0" placeholder="0" name="amount_due_3_page_24" id="amount_due_3_page_24"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyfour();" onkeyup="calculteTotalForClaimsPagetwentyfour();" value="0" placeholder="0" name="amount_received_3_page_24" id="amount_received_3_page_24"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyfour();" onkeyup="calculteTotalForClaimsPagetwentyfour();" value="0" placeholder="0" readonly name="balance_due_3_page_24" id="balance_due_3_page_24"></td>
                    </tr>
                    <tr>
                      <th scope="row">4</th>
                      <td><input name="type_of_claim_4_page_24" id="type_of_claim_4_page_24" readonly style="border: none" class="form-control text-center" value="Lab Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyfour();" onkeyup="calculteTotalForClaimsPagetwentyfour();" value="0" placeholder="0" name="amount_due_4_page_24" id="amount_due_4_page_24"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyfour();" onkeyup="calculteTotalForClaimsPagetwentyfour();" value="0" placeholder="0" name="amount_received_4_page_24" id="amount_received_4_page_24"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyfour();" onkeyup="calculteTotalForClaimsPagetwentyfour();" value="0" placeholder="0" readonly name="balance_due_4_page_24" id="balance_due_4_page_24"></td>
                    </tr>
                    <tr>
                      <th scope="row">5</th>
                      <td><input name="type_of_claim_5_page_24" id="type_of_claim_5_page_24" readonly style="border: none" class="form-control text-center" value="Library Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyfour();" onkeyup="calculteTotalForClaimsPagetwentyfour();" value="0" placeholder="0" name="amount_due_5_page_24" id="amount_due_5_page_24"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyfour();" onkeyup="calculteTotalForClaimsPagetwentyfour();" value="0" placeholder="0" name="amount_received_5_page_24" id="amount_received_5_page_24"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyfour();" onkeyup="calculteTotalForClaimsPagetwentyfour();" value="0" placeholder="0" readonly name="balance_due_5_page_24" id="balance_due_5_page_24"></td>
                    </tr>
                    <tr>
                      <th scope="row">6</th>
                      <td><input name="type_of_claim_6_page_24" id="type_of_claim_6_page_24" readonly style="border: none" class="form-control text-center" value="Exam Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyfour();" onkeyup="calculteTotalForClaimsPagetwentyfour();" value="0" placeholder="0" name="amount_due_6_page_24" id="amount_due_6_page_24"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyfour();" onkeyup="calculteTotalForClaimsPagetwentyfour();" value="0" placeholder="0" name="amount_received_6_page_24" id="amount_received_6_page_24"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyfour();" onkeyup="calculteTotalForClaimsPagetwentyfour();" value="0" placeholder="0" readonly name="balance_due_6_page_24" id="balance_due_6_page_24"></td>
                    </tr>
                    <tr>
                      <th scope="row">7</th>
                      <td><input name="type_of_claim_7_page_24" id="type_of_claim_7_page_24" readonly style="border: none" class="form-control text-center" value="Transport Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyfour();" onkeyup="calculteTotalForClaimsPagetwentyfour();" value="0" placeholder="0" name="amount_due_7_page_24" id="amount_due_7_page_24"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyfour();" onkeyup="calculteTotalForClaimsPagetwentyfour();" value="0" placeholder="0" name="amount_received_7_page_24" id="amount_received_7_page_24"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyfour();" onkeyup="calculteTotalForClaimsPagetwentyfour();" value="0" placeholder="0" readonly name="balance_due_7_page_24" id="balance_due_7_page_24"></td>
                    </tr>
                    <tr>
                      <th scope="row">8</th>
                      <td><input name="type_of_claim_8_page_24" id="type_of_claim_8_page_24" readonly style="border: none" class="form-control text-center" value="Hostel Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyfour();" onkeyup="calculteTotalForClaimsPagetwentyfour();" value="0" placeholder="0" name="amount_due_8_page_24" id="amount_due_8_page_24"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyfour();" onkeyup="calculteTotalForClaimsPagetwentyfour();" value="0" placeholder="0" name="amount_received_8_page_24" id="amount_received_8_page_24"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPagetwentyfour();" onkeyup="calculteTotalForClaimsPagetwentyfour();" value="0" placeholder="0" readonly name="balance_due_8_page_24" id="balance_due_8_page_24"></td>
                    </tr>
                    <tr>
                      <th scope="row">Total</th>
                      <td></td>
                      <th><input readonly style="border: none;" class="form-control text-center" name="amount_due_page_24" value="0" id="amount_due_page_24"></th>
                      <th><input readonly style="border: none;" class="form-control text-center" name="amount_received_page_24" value="0" id="amount_received_page_24"></th>
                      <th><input readonly style="border: none;" class="form-control text-center" name="balance_due_page_24" value="0" id="balance_due_page_24"></th>                      
                    </tr>
                    @endif
                  </tbody>
                </table>
            </div>
        </div>
        {{-- new Claim Fields end --}}
        {{-- new Claim Fields Start --}}
      <div style="margin-top: 50px; display: none;" class="card shadow p-3 w-100" id="provisional_claim_last_page_24">
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
                    @if($data && isset($data['claims'][64]) && count($data['claims'][64]))
                        @php $i = 1; @endphp
                        {{-- @if($claims['page_number'] == 15) --}}
                         <tr>
                             <td><input name="amount_received_last_page_24" id="amount_received_last_page_24" onblur="calculteTotalForClaimsPagetwentyfour();" onkeyup="calculteTotalForClaimsPagetwentyfour();" readonly class="form-control text-center" value="{{$data && $data['claims']['64']['amount_received_last']? $data['claims']['64']['amount_received_last'] : ''}}" ></td>
                             <td><input type="number" name="total_amount_cheque_page_24" id="total_amount_cheque_page_24" class="form-control text-center" value="{{$data && $data['claims']['64']['total_amount_cheque']? $data['claims']['64']['total_amount_cheque'] : ''}}" ></td>
                             <td><input type="date" name="cheque_date_page_24" id="cheque_date_page_24" class="form-control text-center" value="{{$data && $data['claims']['64']['cheque_date']? $data['claims']['64']['cheque_date'] : ''}}" ></td>
                             <td><input type="number" name="cheque_no_page_24" id="cheque_no_page_24" class="form-control text-center" value="{{$data && $data['claims']['64']['cheque_no']? $data['claims']['64']['cheque_no'] : ''}}" ></td>
                             <td><input type="text" name="bank_name_page_24" id="bank_name_page_24" class="form-control text-center" value="{{$data && $data['claims']['64']['bank_name']? $data['claims']['64']['bank_name'] : ''}}" ></td>
                             <td><input type="text" name="reason_remarks_page_24" id="reason_remarks_page_24" class="form-control text-center" value="{{$data && $data['claims']['64']['reason_remarks']? $data['claims']['64']['reason_remarks'] : ''}}" ></td>
                         </tr>
                         {{-- @endif --}}
                    @else
                    <tr>
                      <td><input class="form-control text-center" type="number" readonly min="0" onblur="calculteTotalForClaimsPagetwentyfour();" onkeyup="calculteTotalForClaimsPagetwentyfour();" value="0" placeholder="0" name="amount_received_last_page_24" id="amount_received_last_page_24"></td>
                      <td><input class="form-control text-center" type="number" min="0" value="0" placeholder="0" name="total_amount_cheque_page_24" id="total_amount_cheque_page_24"></td>
                      <td><input class="form-control" type="date" style="text-transform: lowercase;" data-date-format="YYYY-MM-DD" name="cheque_date_page_24" id="cheque_date_page_24"></td>
                      <td><input class="form-control text-center" type="number" min="0" value="0" placeholder="0" name="cheque_no_page_24" id="cheque_no_page_24"></td>
                      <td><input class="form-control text-center" type="text" placeholder="Enter Bank Name" onkeypress="return lettersOnly(event)" name="bank_name_page_24" id="bank_name_page_24"></td>
                      <td><input class="form-control text-center" type="text" placeholder="Enter Remarks" name="reason_remarks_page_24" id="reason_remarks_page_24"></td>
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
                    <div class="card-body" id="result_status_eighth_semester_parent">
                        <div class="col-md-12 mt-4">
                            <label for="">Exam Fee:<span style="color: red;">*</span></label>
                        </div>
                        <div class="card shadow p-3 mt-1 w-100">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label>Status:<span style="color: red;">*</span></label>
                                        <select onchange="setExamFeeStatusPage24()" id="exam_status_page24" name="exam_status" class="form-control">
                                            <option value="" selected>--select--</option>
                                            @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                                <option value="{{$key}}" {{ $data ? $data['eighth_semester_details'] != null ? $data['eighth_semester_details']['exam_status'] == $key ? 'selected' : '' : '' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3" id="date_div_exam_page24">
                                        <label>Date:<span style="color: red;">*</span></label>
                                        <input type="text" class="form-control text-center datepicker" name="exam_date"
                                               placeholder="Enter Date"
                                               value="{{$data && isset($data['eighth_semester_details']) ? date('d/m/Y',strtotime($data['eighth_semester_details']['exam_date'])) : ''}}">
                                    </div>
                                    <div class="form-group col-md-3" id="amount_div_exam_page24">
                                        <label>Amount:<span style="color: red;">*</span></label>
                                        <input type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center" name="amount"
                                               placeholder="Enter Amount"
                                               value="{{$data && isset($data['eighth_semester_details']) ? $data['eighth_semester_details']['amount'] : ''}}">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Roll No:<span style="color: red;">*</span></label>
                                        <input readonly type="text" class="form-control text-center" name="roll_no"
                                               placeholder="Enter Roll No" value="{{$data ? $data['roll_no'] : ''}}"
                                               >
                                               {{-- value="{{$data && isset($data['eighth_semester_details']) ? $data['eighth_semester_details']['roll_no'] : ''}}" --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row mt-4">
                            <div class="ml-2">
                                <label for="">Result Status:<span style="color: red;">*</span></label>
                            </div>
                            <div class="float-right ml-auto mr-2">
                                <button type="button" class="btn btn-primary float-right" onclick="cloneResultStatusEighthSemester()">
                                    <strong>+</strong></button>
                            </div>
                        </div>
                        <div class="form-row pt-2">
                            <div class="col-md-1 text-center">
                                <label>Result:<span style="color: red;">*</span></label>
                            </div>
                            <div class="form-row col-md-8 ml-0" id="result_status_eighth_semester_pass_headers">
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
                        @if($data && isset($data['eighth_semester_result_status_details']) && count($data['eighth_semester_result_status_details']))
                            @foreach($data['eighth_semester_result_status_details'] as $eighthSemesterResultStatusDetails)
                                <div class="form-row mt-2" id="result_status_eighth_semester_div">
                                    <input type="hidden" value="{{$eighthSemesterResultStatusDetails['id']}}" id="result_status_eighth_semester_delete_id">
                                    <div class="col-md-1 p-0">
                                        <select id="result_field_for_eighth_semester" name="result[]" class="form-control result_eighth_semester" onchange="resultChangedForEighthSemester(event)">
                                            <option value="pass" {{ $eighthSemesterResultStatusDetails['result'] == 'pass' ? 'selected' : ''}}>Pass</option>
                                            <option value="fail" {{ $eighthSemesterResultStatusDetails['result'] == 'fail' ? 'selected' : ''}}>Fail</option>
                                        </select>
                                    </div>
                                    <div class="col-md-8 form-row m-0" id="result_status_eighth_semester_pass_values_replacement" style="display: none"></div>
                                    <div class="col-md-8 form-row m-0" id="result_status_eighth_semester_pass_values" style="display: none">
                                        <div class="col-md-3 p-0">
                                            <select name="fail[]" class="form-control promotion_eighth_semester">
                                                <option value="promoted" {{ $eighthSemesterResultStatusDetails['fail'] == 'promoted' ? 'selected' : ''}}>Promoted</option>
                                                <option value="notPromoted" {{ $eighthSemesterResultStatusDetails['fail'] == 'notPromoted' ? 'selected' : ''}}>Not Promoted</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 p-0">
                                            <select name="next_appearance[]" id="next_appearance_8" class="form-control" onchange="nextAppearanceChangedForSemesterOne(event)">
                                                <option value="yes" {{ $eighthSemesterResultStatusDetails['next_appearance'] == 'yes' ? 'selected' : ''}}>Yes</option>
                                                <option value="no" {{ $eighthSemesterResultStatusDetails['next_appearance'] == 'no' ? 'selected' : ''}}>No</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 p-0">
                                            <input type="text" class="form-control text-center nextAppearanceSemesterCheck datepickerFail"
                                                   name="next_appearance_date[]" id="next_appearance_date_8" placeholder="Enter Date" value="{{$eighthSemesterResultStatusDetails['next_appearance_date'] ? date('d/m/Y',strtotime($eighthSemesterResultStatusDetails['next_appearance_date'])):''}}">
                                        </div>
                                        <div class="col-md-3 p-0">
                                            <input type="text" class="form-control text-center nextAppearanceSemesterCheck datepickerFail"
                                                   name="last_chance_date[]" id="last_chance_date_8" placeholder="Enter Date" value="{{$eighthSemesterResultStatusDetails['last_chance_date'] ? date('d/m/Y',strtotime($eighthSemesterResultStatusDetails['last_chance_date'])):''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-2 p-0" id="result_status_eighth_semester_pass_value_passing" style="display: none">
                                        <input type="text" class="form-control text-center datepicker" id="passing_date_8" name="passing_date[]"
                                               placeholder="Enter Date" value="{{$eighthSemesterResultStatusDetails['passing_date'] ? date('d/m/Y',strtotime($eighthSemesterResultStatusDetails['passing_date'])):''}}">
                                    </div>
                                    <div class="col-md-1">
                                        <button id="removeResultStatusEighthSemesterButton" type="button" class="btn btn-danger"
                                                onclick="removeResultStatusEighthSemester(event)" @if ($eighthSemesterResultStatusDetails == reset($data['eighth_semester_result_status_details'])) {{'disabled'}} @endif>-
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="form-row mt-2" id="result_status_eighth_semester_div">
                                <div class="col-md-1 p-0">
                                    <select id="result_field_for_eighth_semester" name="result[]" class="form-control result_eighth_semester" onchange="resultChangedForEighthSemester(event)">
                                        <option value="pass" selected>Pass</option>
                                        <option value="fail">Fail</option>
                                    </select>
                                </div>
                                <div class="col-md-8 form-row m-0" id="result_status_eighth_semester_pass_values_replacement" style="display: none"></div>
                                <div class="col-md-8 form-row m-0" id="result_status_eighth_semester_pass_values" style="display: none">
                                    <div class="col-md-3 p-0">
                                        <select name="fail[]" class="form-control promotion_eighth_semester">
                                            <option value="promoted">Promoted</option>
                                            <option value="notPromoted" selected>Not Promoted</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 p-0">
                                        <select name="next_appearance[]" id="next_appearance_8" class="form-control" onchange="nextAppearanceChangedForSemesterOne(event)">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 p-0">
                                        <input type="text" class="form-control text-center nextAppearanceSemesterCheck datepickerFail"
                                               name="next_appearance_date[]" id="next_appearance_date_8" placeholder="Enter Date">
                                    </div>
                                    <div class="col-md-3 p-0">
                                        <input type="text" class="form-control text-center nextAppearanceSemesterCheck datepickerFail"
                                               name="last_chance_date[]" id="last_chance_date_8" placeholder="Enter Date">
                                    </div>
                                </div>
                                <div class="col-md-2 p-0" id="result_status_eighth_semester_pass_value_passing" style="display:none;">
                                    <input type="text" class="form-control text-center datepicker" id="passing_date_8" name="passing_date[]"
                                           placeholder="Enter Date">
                                </div>
                                <div class="col-md-1">
                                    <button id="removeResultStatusEighthSemesterButton" type="button" class="btn btn-danger"
                                            onclick="removeResultStatusEighthSemester(event)" disabled>-
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
                                        <select name="readmissioneight" id="setreadmission" class="form-control text-center" onchange="setReadmissionEight(event)">
                                            <option value="" selected>--select--</option>
                                            @foreach(\Config::get('constants.general_yes_no') as $key => $general_yes_no)
                                                @if(isset($data['eighth_semester_details']['readmissioneight']))
                                                    <option value="{{$key}}" {{ $data ? $data['eighth_semester_details']['readmissioneight'] == $key ? 'selected' : '' : ''}}>{{$general_yes_no}}</option>
                                                @else
                                                    <option value="{{$key}}">{{$general_yes_no}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4" id="same_course_page_24" style="display: none;">
                                        <label>Same Course:<span style="color: red;">*</span></label>
                                        <select  name="same_course" class="form-control" id="same_course_24">
                                            <option value="" selected>--select--</option>
                                            @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                                <option value="{{$key}}" {{ $data ? $data['eighth_semester_details'] != null ? $data['eighth_semester_details']['same_course'] == $key ? 'selected' : '' : '' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4" id="change_course_page_24" style="display: none;">
                                        <label>Changed Course:<span style="color: red;">*</span></label>
                                        <select  name="changed_course" class="form-control" id="change_course_24">
                                            <option value="" selected>--select--</option>
                                            @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                                <option value="{{$key}}" {{ $data ? $data['eighth_semester_details'] != null ? $data['eighth_semester_details']['changed_course'] == $key ? 'selected' : '' : '' : ''}}>{{$value}}</option>
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
@section('script_page_24')
    <script>
        setResultHeaderDisplayForEighthSemester();
        setStatusDatePage24();
        setPwwbStatusPage24();
        setClaimStatusPage24();
        setExamFeeStatusPage24();
        setReadmissionEight();
        function cloneResultStatusEighthSemester() {
            let clone = $('#result_status_eighth_semester_div').clone();
            $('#result_status_eighth_semester_parent').append(clone);
            let button = clone.find('#removeResultStatusEighthSemesterButton').removeAttr('disabled');
            // let dropdown = $(clone.find('#result_field_for_annual_part_one').parent().siblings()[0]).hide();
            setResultHeaderDisplayForEighthSemester();
            clone.find('.datepicker').each(function (index, pick) {
                let picker = $(pick).datepicker({
                    format: 'dd/mm/yyyy'
                }).on('changeDate', function (ev) {
                    setAccumulatedYears();
                    picker.hide();
                }).data('datepicker');
            });
        }

        function removeResultStatusEighthSemester(event) {
            if(index_id) {
                let csrf_token = $('meta[name="csrf-token"]').attr('content');
                let request = $.ajax({
                    url: '/eighth-semester-delete',
                    method: "POST",
                    data: {
                        'index_id' : index_id,
                        'id' : $(event.target).parent().parent().find('#result_status_eighth_semester_delete_id').val()
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

        function resultChangedForEighthSemester(event) {
            setResultHeaderDisplayForEighthSemester();
            if($(event.target).val() == 'fail'){
                $('#passing_date_8').val('');
                $(event.target).parent().parent().find('#result_status_eighth_semester_pass_values').fadeIn();
                $(event.target).parent().parent().find('#result_status_eighth_semester_pass_values_replacement').fadeOut();
                $(event.target).parent().parent().find('#result_status_eighth_semester_pass_value_passing').fadeOut();
            }
            else if($(event.target).val() == 'pass'){
                 $('#last_chance_date_8').val('');
                $('#next_appearance_8').val('no');
                $('#next_appearance_date_8').val('');
                $(event.target).parent().parent().find('#result_status_eighth_semester_pass_values').fadeOut();
                $(event.target).parent().parent().find('#result_status_eighth_semester_pass_values_replacement').fadeIn();
                $(event.target).parent().parent().find('#result_status_eighth_semester_pass_value_passing').fadeIn();
            }
            else{
                $(event.target).parent().parent().find('#result_status_eighth_semester_pass_values').fadeOut();
                $(event.target).parent().parent().find('#result_status_eighth_semester_pass_values_replacement').fadeOut();
                $(event.target).parent().parent().find('#result_status_eighth_semester_pass_value_passing').fadeOut();
            }
        }

        function setResultHeaderDisplayForEighthSemester() {
            $('.result_eighth_semester').each(function (index,value) {
                if($(value).val() == 'fail'){
                    $(value).parent().parent().find('#result_status_eighth_semester_pass_values').show();
                    $(value).parent().parent().find('#result_status_eighth_semester_pass_values_replacement').hide();
                    $(value).parent().parent().find('#result_status_eighth_semester_pass_value_passing').hide();
                }
                else if($(value).val() == 'pass'){
                    $(value).parent().parent().find('#result_status_eighth_semester_pass_values').hide();
                    $(value).parent().parent().find('#result_status_eighth_semester_pass_values_replacement').show();
                    $(value).parent().parent().find('#result_status_eighth_semester_pass_value_passing').show();
                }
                else{
                    $(value).parent().parent().find('#result_status_eighth_semester_pass_values').hide();
                    $(value).parent().parent().find('#result_status_eighth_semester_pass_values_replacement').hide();
                    $(value).parent().parent().find('#result_status_eighth_semester_pass_value_passing').hide();
                }
            });
        }
        function setStatusDatePage24() {
            if($('#status_page24').val() == 'yes'){
                $('#date_div_page24').fadeIn();
            }
            else{
                $('#date_div_page24').fadeOut();
            }
        }

        function setPwwbStatusPage24() {
            if($('#pwwb_status_page24').val() == 'yes'){
                $('#diary_no_pwwb_page24').fadeIn();
                $('#date_div_pwwb_page24').fadeIn();
            }
            else{
                $('#date_div_pwwb_page24').fadeOut();
                $('#diary_no_pwwb_page24').fadeOut();
            }
        }

        function setClaimStatusPage24() {
            if($('#claim_status_page24').val() == 'yes'){
                $('#date_div_claim_page24').fadeIn();
                $('#amount_claim_page24').fadeIn();
            }
            else{
                $('#amount_claim_page24').fadeOut();
                $('#date_div_claim_page24').fadeOut();
            }
        }
        function setReadmissionEight(e) {
            let selected = $('select[name="readmissioneight"]').val();
            if(selected == 'yes'){
                $('#same_course_page_24').show();
                $('#change_course_page_24').show();

            }
            else{
                if(!index_id){
                    $('#same_course_24').val('');
                    $('#change_course_24').val('');
                }
                $('#same_course_page_24').hide();
                $('#change_course_page_24').hide();
            }
        }

        function setExamFeeStatusPage24() {
            if($('#exam_status_page24').val() == 'yes'){
                $('#date_div_exam_page24').fadeIn();
                $('#amount_div_exam_page24').fadeIn();
            }
            else{
                $('#amount_div_exam_page24').fadeOut();
                $('#date_div_exam_page24').fadeOut();
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

        setDisplayForClaimReceivedPage24();
        function setDisplayForClaimReceivedPage24() {
            if($('#claim_status_page_24').val() == 'received'){
                for (var i = 1; i <= 8; i++) {
                  $(`#amount_due_${i}_page_24`).val($(`#claim_amount_due_default_${i}_page_24`).val());
                  calculteTotalForClaimsPagetwentyfour();
                }
                $('#recovered_amount_div_page_24').fadeOut();
                $('#outstanding_cfe_fee_div_page_24').fadeOut();
                $('#reason_div_page_24').fadeOut();            
                $('#claims_statuses_table_page_24').fadeIn();
                $('#provisional_claim_last_page_24').fadeIn();
            }
            else if($('#claim_status_page_24').val() == 'rejected'){
              $('#recovered_amount_div_page_24').fadeIn();
                $('#outstanding_cfe_fee_div_page_24').fadeIn();
                $('#reason_div_page_24').fadeIn();
                $('#claims_statuses_table_page_24').fadeOut();
                $('#provisional_claim_last_page_24').fadeOut();
            }
            else if($('#claim_status_page_24').val() == 'notReceived'){
              $('#recovered_amount_div_page_24').fadeOut();
                $('#outstanding_cfe_fee_div_page_24').fadeOut();
                $('#reason_div_page_24').fadeIn();
                $('#claims_statuses_table_page_24').fadeOut();
                $('#provisional_claim_last_page_24').fadeOut();
            }
            else if($('#claim_status_page_24').val() == 'cancelled'){
              $('#recovered_amount_div_page_24').fadeOut();
                $('#outstanding_cfe_fee_div_page_24').fadeOut();
                $('#reason_div_page_24').fadeIn();
                $('#claims_statuses_table_page_24').fadeOut();
                $('#provisional_claim_last_page_24').fadeOut();
            }
            else{
              $('#recovered_amount_div_page_24').fadeOut();
                $('#outstanding_cfe_fee_div_page_24').fadeOut();
                $('#reason_div_page_24').fadeOut();
                $('#claims_statuses_table_page_24').fadeOut();
                $('#provisional_claim_last_page_24').fadeOut();
            }
        }

        function calculteTotalForClaimsPagetwentyfour(){
            var claim_amount_due_default_page_24 = 0;
            var amount_due_page_24 = 0;
            var amount_received_page_24 = 0;
            var balance_due_page_24 = 0;

            for (var i = 1; i <= 8; i++) {
              $(`#amount_due_${i}_page_24`).val($(`#claim_amount_due_default_${i}_page_24`).val());
            }

            for(var i = 1; i <= 8; i++){
                var total_balance = 0;
                claim_amount_due_default_page_24 = parseFloat(claim_amount_due_default_page_24) + parseFloat($('#claim_amount_due_default_'+i+'_page_24').val());
                if($('#claim_amount_due_default_'+i+'_page_24').val() == ""){
                      $('#claim_amount_due_default_'+i+'_page_24').val('0');
                  }
                amount_due_page_24 = parseFloat(amount_due_page_24) + parseFloat($('#amount_due_'+i+'_page_24').val());
                if($('#amount_due_'+i+'_page_24').val() == ""){
                      $('#amount_due_'+i+'_page_24').val('0');
                  }
                amount_received_page_24 = parseFloat(amount_received_page_24) + parseFloat($('#amount_received_'+i+'_page_24').val());
                if($('#amount_received_'+i+'_page_24').val() == ""){
                      $('#amount_received_'+i+'_page_24').val('0');
                  }

                  if (parseFloat($('#amount_received_'+i+'_page_24').val()) > parseFloat($('#amount_due_'+i+'_page_24').val())) {
                  $('#amount_received_'+i+'_page_24').val('0');
                  $.notify('Amount Due cannot be less than Amount Received!');
                  }

               balance_due_page_24 = parseFloat(balance_due_page_24) + parseFloat($('#balance_due_'+i+'_page_24').val());
                if(amount_due_page_24 < amount_received_page_24){
                    // alert("Amount Received Cannot Be Higher Then Amount Due");
                    $('#amount_received_'+i+'_page_24').val()
                    // return false;
                }    
                if($('#amount_due_'+i+'_page_24').val() != "0" || $('#amount_received_'+i+'_page_24').val() != "0"){
                    total_balance = parseFloat($('#amount_due_'+i+'_page_24').val()) - parseFloat($('#amount_received_'+i+'_page_24').val());
                    $('#balance_due_'+i+'_page_24').val(total_balance);
                }              
            }
            
            $('#claim_amount_due_default_page_24').val(claim_amount_due_default_page_24);
            $('#amount_due_page_24').val(amount_due_page_24);
            $('#amount_received_page_24').val(amount_received_page_24);
            $('#balance_due_page_24').val(balance_due_page_24);
            $('#claim_due_page_24').val(claim_amount_due_default_page_24);
            $('#amount_received_last_page_24').val(amount_received_page_24);
        }

        $('.datepickerFail').datepicker({
            format:'dd/mm/yyyy',
            endDate: new Date(),
            autoclose: true
        });
    </script>
@endsection
