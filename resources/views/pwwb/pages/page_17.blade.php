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
     h1{
        font-weight: bold;
        text-align: center;
        font-family: 'Balsamiq Sans', cursive;
        background: #17202A;
        color: white;
        padding: 15px;
        position: relative;
        }
</style>
{{--@if(isset($data['first_semester_details']['exam_status']) != null )--}}
<div id="page_17">
    <form id="page_17_form">
        <div class="card shadow p-3 mt-4 w-100">
            <div class="col-md-12">
            <h1>First Semester<span class="float-right">Page # 11</span></h1>
            </div>
            <div class="card-body ">
                <div class="col-md-12 mt-4">
                    <label for="">Examination Status in Affiliated Body:</label>
                </div>
                <div class="card shadow p-3 mt-1 w-100">
                    <div class="card-body">
                        <div class="col-md-12 mt-4">
                            <label for="">Exam Fee:</label>
                        </div>
                        <div class="card shadow p-3 mt-1 w-100">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label>Status:</label>
                                        <select id="exam_fee_status_page17" onchange="setExamFeeStatusPage17()" name="exam_status" class="form-control">
                                            <option value="" selected>--select--</option>
                                            @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                                <option value="{{$key}}" {{ $data ? $data['first_semester_details'] != null ? $data['first_semester_details']['exam_status'] == $key ? 'selected' : '' : '' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3" id="date_div_exam_page17">
                                        <label>Date:</label>
                                        <input type="text" class="form-control text-center datepicker" name="exam_date"
                                               placeholder="Enter Date"
                                               value="{{$data && isset($data['first_semester_details']) ? date('d/m/Y',strtotime($data['first_semester_details']['exam_date'])) : ''}}">
                                    </div>
                                    <div class="form-group col-md-3" id="amount_div_exam_page17">
                                        <label>Amount:</label>
                                        <input type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center" name="amount"
                                               placeholder="Enter Amount"
                                               value="{{$data && isset($data['first_semester_details']) ? $data['first_semester_details']['amount'] : ''}}">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Roll No:</label>
                                        <input readonly type="text" class="form-control text-center" name="roll_no"
                                               placeholder="XXXXX" value="{{$data ? $data['roll_no'] : ''}}"
                                               >
                                               {{-- value="{{$data && isset($data['first_semester_details']) ? $data['first_semester_details']['roll_no'] : ''}}" --}}
                                    </div>
                                </div>
                            </div>
                        </div>

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
                    @if($data && isset($data['claims'][8]) && count($data['claims'][8]))
                        @php $i = 1; @endphp
                        @foreach($data['claims'] as $claims)
                        @if($claims['page_number'] == 17)
                         <tr>
                             <th scope="row">{{ $i++ }}</th>
                             <td><input name="claim_head_default_{{$i-1}}_page_17" id="claim_head_default_{{$i-1}}_page_17" readonly style="border: none" class="form-control text-center" value="{{$claims['claim_head_default']}}" ></td>
                             <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageseventeen();" onkeyup="calculteTotalForClaimsPageseventeen();" value="{{$claims['claim_amount_due_default']}}" placeholder="0" name="claim_amount_due_default_{{$i-1}}_page_17" id="claim_amount_due_default_{{$i-1}}_page_17"></td>
                         </tr>
                         @endif
                        @endforeach
                         <tr>
                          <th scope="row">Total</th>
                          <td></td>
                          <th><input readonly style="border: none;" class="form-control text-center" name="claim_amount_due_default_page_17" value="{{$data && $data['claims']['8']['total_amount_due_default']? $data['claims']['8']['total_amount_due_default'] : ''}}" id="claim_amount_due_default_page_17"></th>
                        </tr>
                    @else
                    <tr>
                      <th scope="row">1</th>
                      <td><input name="claim_head_default_1_page_17" id="claim_head_default_1_page_17" readonly style="border: none" class="form-control text-center" value="Admission Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageseventeen();" onkeyup="calculteTotalForClaimsPageseventeen();" value="0" placeholder="0" name="claim_amount_due_default_1_page_17" id="claim_amount_due_default_1_page_17"></td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td><input name="claim_head_default_2_page_17" id="claim_head_default_2_page_17" readonly style="border: none" class="form-control text-center" value="Registration Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageseventeen();" onkeyup="calculteTotalForClaimsPageseventeen();" value="0" placeholder="0" name="claim_amount_due_default_2_page_17" id="claim_amount_due_default_2_page_17"></td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td><input name="claim_head_default_3_page_17" id="claim_head_default_3_page_17" readonly style="border: none" class="form-control text-center" value="Tuition Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageseventeen();" onkeyup="calculteTotalForClaimsPageseventeen();" value="0" placeholder="0" name="claim_amount_due_default_3_page_17" id="claim_amount_due_default_3_page_17"></td>
                    </tr>
                    <tr>
                      <th scope="row">4</th>
                      <td><input name="claim_head_default_4_page_17" id="claim_head_default_4_page_17" readonly style="border: none" class="form-control text-center" value="Lab Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageseventeen();" onkeyup="calculteTotalForClaimsPageseventeen();" value="0" placeholder="0" name="claim_amount_due_default_4_page_17" id="claim_amount_due_default_4_page_17"></td>
                    </tr>
                    <tr>
                      <th scope="row">5</th>
                      <td><input name="claim_head_default_5_page_17" id="claim_head_default_5_page_17" readonly style="border: none" class="form-control text-center" value="Library Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageseventeen();" onkeyup="calculteTotalForClaimsPageseventeen();" value="0" placeholder="0" name="claim_amount_due_default_5_page_17" id="claim_amount_due_default_5_page_17"></td>
                    </tr>
                    <tr>
                      <th scope="row">6</th>
                      <td><input name="claim_head_default_6_page_17" id="claim_head_default_6_page_17" readonly style="border: none" class="form-control text-center" value="Exam Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageseventeen();" onkeyup="calculteTotalForClaimsPageseventeen();" value="0" placeholder="0" name="claim_amount_due_default_6_page_17" id="claim_amount_due_default_6_page_17"></td>
                    </tr>
                    <tr>
                      <th scope="row">7</th>
                      <td><input name="claim_head_default_7_page_17" id="claim_head_default_7_page_17" readonly style="border: none" class="form-control text-center" value="Transport Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageseventeen();" onkeyup="calculteTotalForClaimsPageseventeen();" value="0" placeholder="0" name="claim_amount_due_default_7_page_17" id="claim_amount_due_default_7_page_17"></td>
                     </tr>
                     <tr>
                      <th scope="row">8</th>
                      <td><input name="claim_head_default_8_page_17" id="claim_head_default_8_page_17" readonly style="border: none" class="form-control text-center" value="Hostel Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageseventeen();" onkeyup="calculteTotalForClaimsPageseventeen();" value="0" placeholder="0" name="claim_amount_due_default_8_page_17" id="claim_amount_due_default_8_page_17"></td>
                     </tr>
                    <tr>
                      <th scope="row">Total</th>
                      <td></td>
                      <th><input readonly style="border: none;" class="form-control text-center" name="claim_amount_due_default_page_17" value="0" id="claim_amount_due_default_page_17"></th>
                                          
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
                        <input onkeyup="numericOnly(event)" type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center" name="claim_due_page_17" id="claim_due_page_17" placeholder="Enter Claim Due" value="{{$data && isset($data['claims']['8']['claim_due'])? $data['claims']['8']['claim_due'] : ''}}">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Status Of Claim:<span style="color: red;">*</span></label>
                        <select onchange="setDisplayForClaimReceivedPage17()" id="claim_status_page_17" name="claim_status_page_17" class="form-control">
                            <option value="" selected>--select--</option>
                            @foreach(\Config::get('constants.claim_status') as $key => $value)
                                <option value="{{$key}}" @if(isset($data['claims'][8])) {{ $data ? $data['claims']['8']['claim_status'] == $key ? 'selected' : '' : ''}} @endif>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3" id="reason_div_page_17">
                        <label>Reason:<span style="color: red;">*</span></label>
                        <input onkeyup="numericOnly(event)" type="text" class="form-control text-center" name="reason_page_17" id="reason_page_17" placeholder="Enter Reason" value="@if(isset($data['claims'][8])) {{$data && $data['claims']['8']['reason']? $data['claims']['8']['reason'] : ''}} @endif">
                    </div>
                    <div class="form-group col-md-3" id="outstanding_cfe_fee_div_page_17">
                        <label>Outstanding CFE Fee:<span style="color: red;">*</span></label>
                        <input type="number" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center" name="outstanding_cfe_fee_page_17" id="outstanding_cfe_fee_page_17" placeholder="Enter Fee" value="{{$data && isset($data['claims']['8']['outstanding_cfe_fee'])? $data['claims']['8']['outstanding_cfe_fee'] : ''}}">
                    </div>
                    <div class="form-group col-md-3" id="recovered_amount_div_page_17">
                        <label>Recovered Amount From Student:<span style="color: red;">*</span></label>
                        <input type="number" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center" name="recovered_amount_page_17" id="recovered_amount_page_17" placeholder="Enter Recovered Amount" value="{{$data && isset($data['claims']['8']['recovered_amount'])? $data['claims']['8']['recovered_amount'] : ''}}">
                    </div>
                </div>
            </div>
        </div>
        <div style="margin-top: 50px;" class="card shadow p-3 w-100" id="claims_statuses_table_page_17">
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
                        @if($claims['page_number'] == 17)
                         <tr>
                             <th scope="row">{{ $i++ }}</th>
                             <td><input name="type_of_claim_{{$i-1}}_page_17" id="type_of_claim_{{$i-1}}_page_17" readonly style="border: none" class="form-control text-center" value="{{$claims['claim_head']}}" ></td>
                             <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageseventeen();" onkeyup="calculteTotalForClaimsPageseventeen();" value="{{$claims['amount_due']}}" placeholder="0" readonly="" name="amount_due_{{$i-1}}_page_17" id="amount_due_{{$i-1}}_page_17"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageseventeen();" onkeyup="calculteTotalForClaimsPageseventeen();" value="{{$claims['amount_received']}}" placeholder="0" name="amount_received_{{$i-1}}_page_17" id="amount_received_{{$i-1}}_page_17"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageseventeen();" onkeyup="calculteTotalForClaimsPageseventeen();" value="{{$claims['amount_balance']}}" placeholder="0" readonly name="balance_due_{{$i-1}}_page_17" id="balance_due_{{$i-1}}_page_17"></td>
                         </tr>
                         @endif
                        @endforeach
                         <tr>
                          <th scope="row">Total</th>
                          <td></td>
                          <th><input readonly style="border: none;" class="form-control text-center" name="amount_due_page_17" value="{{$data && $data['claims']['8']['total_amount_due']? $data['claims']['8']['total_amount_due'] : ''}}" id="amount_due_page_17"></th>
                          <th><input readonly style="border: none;" class="form-control text-center" name="amount_received_page_17" value="{{$data && $data['claims']['8']['total_amount_received']? $data['claims']['8']['total_amount_received'] : ''}}" id="amount_received_page_17"></th>
                          <th><input readonly style="border: none;" class="form-control text-center" name="balance_due_page_17" value="{{$data && $data['claims']['8']['total_amount_balance']? $data['claims']['8']['total_amount_balance'] : ''}}" id="balance_due_page_17"></th>                      
                        </tr>
                    @else
                    <tr>
                      <th scope="row">1</th>
                      <td><input name="type_of_claim_1_page_17" id="type_of_claim_1_page_17" readonly style="border: none" class="form-control text-center" value="Admission Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageseventeen();" onkeyup="calculteTotalForClaimsPageseventeen();" value="0" placeholder="0" readonly name="amount_due_1_page_17" id="amount_due_1_page_17"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageseventeen();" onkeyup="calculteTotalForClaimsPageseventeen();" value="0" placeholder="0" name="amount_received_1_page_17" id="amount_received_1_page_17"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageseventeen();" onkeyup="calculteTotalForClaimsPageseventeen();" value="0" placeholder="0" readonly name="balance_due_1_page_17" id="balance_due_1_page_17"></td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td><input name="type_of_claim_2_page_17" id="type_of_claim_2_page_17" readonly style="border: none" class="form-control text-center" value="Registration Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageseventeen();" onkeyup="calculteTotalForClaimsPageseventeen();" value="0" placeholder="0" readonly name="amount_due_2_page_17" id="amount_due_2_page_17"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageseventeen();" onkeyup="calculteTotalForClaimsPageseventeen();" value="0" placeholder="0" name="amount_received_2_page_17" id="amount_received_2_page_17"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageseventeen();" onkeyup="calculteTotalForClaimsPageseventeen();" value="0" placeholder="0" readonly name="balance_due_2_page_17" id="balance_due_2_page_17"></td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td><input name="type_of_claim_3_page_17" id="type_of_claim_3_page_17" readonly style="border: none" class="form-control text-center" value="Tuition Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageseventeen();" onkeyup="calculteTotalForClaimsPageseventeen();" value="0" placeholder="0" readonly name="amount_due_3_page_17" id="amount_due_3_page_17"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageseventeen();" onkeyup="calculteTotalForClaimsPageseventeen();" value="0" placeholder="0" name="amount_received_3_page_17" id="amount_received_3_page_17"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageseventeen();" onkeyup="calculteTotalForClaimsPageseventeen();" value="0" placeholder="0" readonly name="balance_due_3_page_17" id="balance_due_3_page_17"></td>
                    </tr>
                    <tr>
                      <th scope="row">4</th>
                      <td><input name="type_of_claim_4_page_17" id="type_of_claim_4_page_17" readonly style="border: none" class="form-control text-center" value="Lab Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageseventeen();" onkeyup="calculteTotalForClaimsPageseventeen();" value="0" placeholder="0" readonly name="amount_due_4_page_17" id="amount_due_4_page_17"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageseventeen();" onkeyup="calculteTotalForClaimsPageseventeen();" value="0" placeholder="0" name="amount_received_4_page_17" id="amount_received_4_page_17"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageseventeen();" onkeyup="calculteTotalForClaimsPageseventeen();" value="0" placeholder="0" readonly name="balance_due_4_page_17" id="balance_due_4_page_17"></td>
                    </tr>
                    <tr>
                      <th scope="row">5</th>
                      <td><input name="type_of_claim_5_page_17" id="type_of_claim_5_page_17" readonly style="border: none" class="form-control text-center" value="Library Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageseventeen();" onkeyup="calculteTotalForClaimsPageseventeen();" value="0" placeholder="0" readonly name="amount_due_5_page_17" id="amount_due_5_page_17"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageseventeen();" onkeyup="calculteTotalForClaimsPageseventeen();" value="0" placeholder="0" name="amount_received_5_page_17" id="amount_received_5_page_17"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageseventeen();" onkeyup="calculteTotalForClaimsPageseventeen();" value="0" placeholder="0" readonly name="balance_due_5_page_17" id="balance_due_5_page_17"></td>
                    </tr>
                    <tr>
                      <th scope="row">6</th>
                      <td><input name="type_of_claim_6_page_17" id="type_of_claim_6_page_17" readonly style="border: none" class="form-control text-center" value="Exam Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageseventeen();" onkeyup="calculteTotalForClaimsPageseventeen();" value="0" placeholder="0" readonly name="amount_due_6_page_17" id="amount_due_6_page_17"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageseventeen();" onkeyup="calculteTotalForClaimsPageseventeen();" value="0" placeholder="0" name="amount_received_6_page_17" id="amount_received_6_page_17"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageseventeen();" onkeyup="calculteTotalForClaimsPageseventeen();" value="0" placeholder="0" readonly name="balance_due_6_page_17" id="balance_due_6_page_17"></td>
                    </tr>
                    <tr>
                      <th scope="row">7</th>
                      <td><input name="type_of_claim_7_page_17" id="type_of_claim_7_page_17" readonly style="border: none" class="form-control text-center" value="Transport Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageseventeen();" onkeyup="calculteTotalForClaimsPageseventeen();" value="0" placeholder="0" readonly name="amount_due_7_page_17" id="amount_due_7_page_17"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageseventeen();" onkeyup="calculteTotalForClaimsPageseventeen();" value="0" placeholder="0" name="amount_received_7_page_17" id="amount_received_7_page_17"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageseventeen();" onkeyup="calculteTotalForClaimsPageseventeen();" value="0" placeholder="0" readonly name="balance_due_7_page_17" id="balance_due_7_page_17"></td>
                    </tr>
                    <tr>
                      <th scope="row">8</th>
                      <td><input name="type_of_claim_8_page_17" id="type_of_claim_8_page_17" readonly style="border: none" class="form-control text-center" value="Hostel Fee" ></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageseventeen();" onkeyup="calculteTotalForClaimsPageseventeen();" value="0" placeholder="0" readonly name="amount_due_8_page_17" id="amount_due_8_page_17"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageseventeen();" onkeyup="calculteTotalForClaimsPageseventeen();" value="0" placeholder="0" name="amount_received_8_page_17" id="amount_received_8_page_17"></td>
                      <td><input class="form-control text-center" type="number" min="0" onblur="calculteTotalForClaimsPageseventeen();" onkeyup="calculteTotalForClaimsPageseventeen();" value="0" placeholder="0" readonly name="balance_due_8_page_17" id="balance_due_8_page_17"></td>
                    </tr>
                    <tr>
                      <th scope="row">Total</th>
                      <td></td>
                      <th><input readonly style="border: none;" class="form-control text-center" name="amount_due_page_17" value="0" id="amount_due_page_17"></th>
                      <th><input readonly style="border: none;" class="form-control text-center" name="amount_received_page_17" value="0" id="amount_received_page_17"></th>
                      <th><input readonly style="border: none;" class="form-control text-center" name="balance_due_page_17" value="0" id="balance_due_page_17"></th>                      
                    </tr>
                    @endif
                  </tbody>
                </table>
            </div>
        </div>
        {{-- new Claim Fields end --}}
        {{-- new Claim Fields Start --}}
      <div style="margin-top: 50px; display: none;" class="card shadow p-3 w-100" id="provisional_claim_last_page_17">
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
                             <td><input name="amount_received_last_page_17" id="amount_received_last_page_17" onblur="calculteTotalForClaimsPageseventeen();" onkeyup="calculteTotalForClaimsPageseventeen();" readonly class="form-control text-center" value="{{$data && $data['claims']['8']['amount_received_last']? $data['claims']['8']['amount_received_last'] : ''}}" ></td>
                             <td><input type="number" name="total_amount_cheque_page_17" id="total_amount_cheque_page_17" class="form-control text-center" value="{{$data && $data['claims']['8']['total_amount_cheque']? $data['claims']['8']['total_amount_cheque'] : ''}}" ></td>
                             <td><input type="date" name="cheque_date_page_17" id="cheque_date_page_17" class="form-control text-center" value="{{$data && $data['claims']['8']['cheque_date']? $data['claims']['8']['cheque_date'] : ''}}" ></td>
                             <td><input type="number" name="cheque_no_page_17" id="cheque_no_page_17" class="form-control text-center" value="{{$data && $data['claims']['8']['cheque_no']? $data['claims']['8']['cheque_no'] : ''}}" ></td>
                             <td><input type="text" name="bank_name_page_17" id="bank_name_page_17" class="form-control text-center" value="{{$data && $data['claims']['8']['bank_name']? $data['claims']['8']['bank_name'] : ''}}" ></td>
                             <td><input type="text" name="reason_remarks_page_17" id="reason_remarks_page_17" class="form-control text-center" value="{{$data && $data['claims']['8']['reason_remarks']? $data['claims']['8']['reason_remarks'] : ''}}" ></td>
                         </tr>
                         {{-- @endif --}}
                    @else
                    <tr>
                      <td><input class="form-control text-center" type="number" readonly min="0" onblur="calculteTotalForClaimsPageseventeen();" onkeyup="calculteTotalForClaimsPageseventeen();" value="0" placeholder="0" name="amount_received_last_page_17" id="amount_received_last_page_17"></td>
                      <td><input class="form-control text-center" type="number" min="0" value="0" placeholder="0" name="total_amount_cheque_page_17" id="total_amount_cheque_page_17"></td>
                      <td><input class="form-control" type="date" style="text-transform: lowercase;" data-date-format="YYYY-MM-DD" name="cheque_date_page_17" id="cheque_date_page_17"></td>
                      <td><input class="form-control text-center" type="number" min="0" value="0" placeholder="0" name="cheque_no_page_17" id="cheque_no_page_17"></td>
                      <td><input class="form-control text-center" type="text" placeholder="Enter Bank Name" onkeypress="return lettersOnly(event)" name="bank_name_page_17" id="bank_name_page_17"></td>
                      <td><input class="form-control text-center" type="text" placeholder="Enter Remarks" name="reason_remarks_page_17" id="reason_remarks_page_17"></td>
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
                                <label for="">Result Status:</label>
                            </div>
                            <div class="float-right ml-auto mr-2">
                                <button type="button" class="btn btn-primary float-right" onclick="cloneResultStatusFirstSemester()">
                                    <strong>+</strong></button>
                            </div>
                        </div>
                        <!-- result status -->
                        <div class="card shadow mt-3 p-3 w-100">
                            <div class="card-body" id="result_status_first_semester_parent">
                                <div class="form-row pt-2">
                                    <div class="col-md-1 text-center">
                                        <label>Result:</label>
                                    </div>
                                    <div class="form-row col-md-8 ml-0" id="result_status_first_semester_pass_headers">
                                        <div class="col-md-2 text-center">
                                            <label>Fail:</label>
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <label>Chance of next Appearance:</label>
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <label>Next Appearance Date:</label>
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <label>Last Chance Date:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <label>Passing Date:</label>
                                    </div>
                                </div>
                                @if($data && isset($data['first_semester_result_status_details']) && count($data['first_semester_result_status_details']))
                                    @foreach($data['first_semester_result_status_details'] as $firstSemesterResultStatusDetails)
                                        <div class="form-row mt-2" id="result_status_first_semester_div">
                                            <input type="hidden" value="{{$firstSemesterResultStatusDetails['id']}}" id="result_status_first_semester_delete_id">
                                            <div class="col-md-1 p-0">
                                                <select id="result_field_for_first_semester" name="result[]" class="form-control result_first_semester" onchange="resultChangedForFirstSemester(event)">
                                                    <option value="pass" {{ $firstSemesterResultStatusDetails['result'] == 'pass' ? 'selected' : ''}}>Pass</option>
                                                    <option value="fail" {{ $firstSemesterResultStatusDetails['result'] == 'fail' ? 'selected' : ''}}>Fail</option>
                                                </select>
                                            </div>
                                            <div class="col-md-8 form-row m-0" id="result_status_first_semester_pass_values_replacement" style="display: none"></div>
                                            <div class="col-md-8 form-row m-0" id="result_status_first_semester_pass_values" style="display: none">
                                                <div class="col-md-3 p-0">
                                                    <select name="fail[]" class="form-control promotion_first_semester" onchange="setDisplayForSecondSemester()">
                                                        <option value="promoted" {{ $firstSemesterResultStatusDetails['fail'] == 'promoted' ? 'selected' : ''}}>Promoted</option>
                                                        <option value="notPromoted" {{ $firstSemesterResultStatusDetails['fail'] == 'notPromoted' ? 'selected' : ''}}>Not Promoted</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3 p-0">
                                                    <select name="next_appearance[]" id="next_appearance_1" class="form-control" onchange="nextAppearanceChangedForSemesterOne(event)">
                                                        <option value="yes" {{ $firstSemesterResultStatusDetails['next_appearance'] == 'yes' ? 'selected' : ''}}>Yes</option>
                                                        <option value="no" {{ $firstSemesterResultStatusDetails['next_appearance'] == 'no' ? 'selected' : ''}}>No</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3 p-0">
                                                    <input type="text" class="form-control text-center nextAppearanceSemesterCheck datepickerFail"
                                                           name="next_appearance_date[]" id="next_appearance_date_1" placeholder="Enter Date" value="{{ $firstSemesterResultStatusDetails['next_appearance_date'] ? date('d/m/Y',strtotime($firstSemesterResultStatusDetails['next_appearance_date'])) : ''}}">
                                                </div>
                                                <div class="col-md-3 p-0">
                                                    <input type="text" class="form-control text-center nextAppearanceSemesterCheck datepickerFail"
                                                           name="last_chance_date[]" id="last_chance_date_1" placeholder="Enter Date" value="{{$firstSemesterResultStatusDetails['last_chance_date'] ? date('d/m/Y',strtotime($firstSemesterResultStatusDetails['last_chance_date'])) : ''}}">
                                                </div>
                                            </div>
                                            <div class="col-md-2 p-0" id="result_status_first_semester_pass_value_passing" style="display: none">
                                                <input type="text" class="form-control text-center datepicker" id="passing_date_1" name="passing_date[]"
                                                       placeholder="Enter Date" value="{{$firstSemesterResultStatusDetails['passing_date'] ? date('d/m/Y',strtotime($firstSemesterResultStatusDetails['passing_date'] )) : ''}}">
                                            </div>
                                            <div class="col-md-1">
                                                <button id="removeResultStatusFirstSemesterButton" type="button" class="btn btn-danger"
                                                        onclick="removeResultStatusFirstSemester(event)" @if ($firstSemesterResultStatusDetails == reset($data['first_semester_result_status_details'])) {{'disabled'}} @endif>-
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="form-row mt-2" id="result_status_first_semester_div">
                                        <div class="col-md-1 p-0">
                                            <select id="result_field_for_first_semester" name="result[]" class="form-control result_first_semester" onchange="resultChangedForFirstSemester(event)">
                                                <option value="" selected>--select--</option>
                                                <option value="pass" >Pass</option>
                                                <option value="fail">Fail</option>
                                            </select>
                                        </div>
                                        <div class="col-md-8 form-row m-0" id="result_status_first_semester_pass_values_replacement" style="display: none"></div>
                                        <div class="col-md-8 form-row m-0" id="result_status_first_semester_pass_values" style="display: none">
                                            <div class="col-md-3 p-0">
                                                <select name="fail[]" id="checkfail" class="form-control promotion_first_semester" onchange="setDisplayForSecondSemester()">
                                                    <option value="promoted">Promoted</option>
                                                    <option value="notPromoted" selected>Not Promoted</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 p-0">
                                                <select name="next_appearance[]" id="next_appearance_1" class="form-control" onchange="nextAppearanceChangedForSemesterOne(event)">
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 p-0">
                                                <input type="text" class="form-control text-center nextAppearanceSemesterCheck datepickerFail"
                                                       name="next_appearance_date[]" id="next_appearance_date_1" placeholder="Enter Date">
                                            </div>
                                            <div class="col-md-3 p-0">
                                                <input type="text" class="form-control text-center nextAppearanceSemesterCheck datepickerFail"
                                                       name="last_chance_date[]" id="last_chance_date_1" placeholder="Enter Date">
                                            </div>
                                        </div>
                                        <div class="col-md-2 p-0" id="result_status_first_semester_pass_value_passing" style="display:none;">
                                            <input type="text" class="form-control text-center datepicker" id="passing_date_1" name="passing_date[]"
                                                   placeholder="Enter Date">
                                        </div>
                                        <div class="col-md-1">
                                            <button id="removeResultStatusFirstSemesterButton" type="button" class="btn btn-danger"
                                                    onclick="removeResultStatusFirstSemester(event)" disabled>-
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
                                        <select name="readmissionfirst" id="setreadmission" class="form-control text-center" onchange="setReadmissionFirst(event)">
                                            <option value="" selected>--select--</option>
                                            @foreach(\Config::get('constants.general_yes_no') as $key => $general_yes_no)
                                                @if(isset($data['first_semester_details']['readmissionfirst']))
                                                    <option value="{{$key}}" {{ $data ? $data['first_semester_details']['readmissionfirst'] == $key ? 'selected' : '' : ''}}>{{$general_yes_no}}</option>
                                                @else
                                                    <option value="{{$key}}">{{$general_yes_no}}</option>
                                                @endif
                                            @endforeach


                                        </select>
                                    </div>
                                    <div class="form-group col-md-4" id="same_course_page_17" style="display: none;">
                                        <label>Same Course:<span style="color: red;">*</span></label>
                                        <select  name="same_course" class="form-control" id="same_course_17">
                                            <option value="" selected>--select--</option>
                                            @foreach(\Config::get('constants.general_yes_no') as $key => $value)

                                                <option value="{{$key}}" {{ $data ? $data['first_semester_details'] != null ? $data['first_semester_details']['same_course'] == $key ? 'selected' : '' : '' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4" id="change_course_page_17" style="display: none;">
                                        <label>Changed Course:<span style="color: red;">*</span></label>
                                        <select  name="changed_course" class="form-control" id="change_course_17">
                                            <option value="" selected>--select--</option>
                                            @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                                <option value="{{$key}}" {{ $data ? $data['first_semester_details'] != null ? $data['first_semester_details']['changed_course'] == $key ? 'selected' : '' : '' : ''}}>{{$value}}</option>
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
@section('script_page_17')
    <script>
        //if(index_id){
            setDisplayForSecondSemester();
        //}


        setResultHeaderDisplayForFirstSemester();
        setExamFeeStatusPage17();
        setReadmissionFirst();
        function cloneResultStatusFirstSemester() {
            let clone = $('#result_status_first_semester_div').clone();
            $('#result_status_first_semester_parent').append(clone);
            let button = clone.find('#removeResultStatusFirstSemesterButton').removeAttr('disabled');
            // let dropdown = $(clone.find('#result_field_for_annual_part_one').parent().siblings()[0]).hide();
            setResultHeaderDisplayForFirstSemester();
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
            setDisplayForSecondSemester();
        }

        function removeResultStatusFirstSemester(event) {
            if(index_id) {
                let csrf_token = $('meta[name="csrf-token"]').attr('content');
                let request = $.ajax({
                    url: '/first-semester-delete',
                    method: "POST",
                    data: {
                        'index_id' : index_id,
                        'id' : $(event.target).parent().parent().find('#result_status_first_semester_delete_id').val()
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
            setDisplayForSecondSemester();
        }

        function resultChangedForFirstSemester(event) {
            setResultHeaderDisplayForFirstSemester();
            setDisplayForSecondSemester();
            if($(event.target).val() == 'fail'){
                $('#passing_date_1').val('');
                $('.semester-tab-conversion').remove();
                $('.semester-tab2').remove();
                $('#v-pills-tab').append('<a class="nav-link semester-tab semester-tab-conversion aa" id="v-pills-page_25-tab" data-toggle="pill" href="#v-pills-page_25" role="tab" aria-controls="v-pills-page_25" aria-selected="true">Conversion in Next Degree</a>');
                $(event.target).parent().parent().find('#result_status_first_semester_pass_values').fadeIn();
                $(event.target).parent().parent().find('#result_status_first_semester_pass_values_replacement').fadeOut();
                $(event.target).parent().parent().find('#result_status_first_semester_pass_value_passing').fadeOut();

            }
            else if($(event.target).val() == 'pass'){
                $('#last_chance_date_1').val('');
                $('#next_appearance_1').val('no');
                $('#next_appearance_date_1').val('');
                $('.semester-tab-conversion').remove();
                $('#v-pills-tab').append('<a class="nav-link semester-tab semester-tab2 aa" id="v-pills-page_18-tab" data-toggle="pill" href="#v-pills-page_18" role="tab" aria-controls="v-pills-page_18" aria-selected="true">Continue 1(Second Semester)</a><a class="nav-link semester-tab semester-tab-conversion aa" id="v-pills-page_25-tab" data-toggle="pill" href="#v-pills-page_25" role="tab" aria-controls="v-pills-page_25" aria-selected="true">Conversion in Next Degree</a>');
                $(event.target).parent().parent().find('#result_status_second_semester_pass_values').fadeOut();
                $(event.target).parent().parent().find('#result_status_second_semester_pass_values_replacement').fadeIn();
                $(event.target).parent().parent().find('#result_status_first_semester_pass_value_passing').fadeIn();
            }
            else{
                $(event.target).parent().parent().find('#result_status_first_semester_pass_values').fadeOut();
                $(event.target).parent().parent().find('#result_status_first_semester_pass_values_replacement').fadeOut();
                $(event.target).parent().parent().find('#result_status_first_semester_pass_value_passing').fadeOut();
            }
        }

        function setResultHeaderDisplayForFirstSemester() {
            $('.result_first_semester').each(function (index,value) {
                if($(value).val() == 'fail'){
                    $(value).parent().parent().find('#result_status_first_semester_pass_values').show();
                    $(value).parent().parent().find('#result_status_first_semester_pass_values_replacement').hide();
                    $(value).parent().parent().find('#result_status_first_semester_pass_value_passing').hide();
                }
                else if($(value).val() == 'pass'){
                    $(value).parent().parent().find('#result_status_first_semester_pass_values').hide();
                    $(value).parent().parent().find('#result_status_first_semester_pass_values_replacement').show();
                    $(value).parent().parent().find('#result_status_first_semester_pass_value_passing').show();
                }
                else{
                    $(value).parent().parent().find('#result_status_first_semester_pass_values').hide();
                    $(value).parent().parent().find('#result_status_first_semester_pass_values_replacement').hide();
                    $(value).parent().parent().find('#result_status_first_semester_pass_value_passing').hide();
                }
            });
        }



        function setDisplayForSecondSemester(){
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
                let allResults = $('.result_first_semester');
                let length = allResults.length;
                if ($(allResults[length - 1]).val() == 'pass') {
                    // container_array.splice(11, 0, '#page_18');
                    // api_url_array.splice(11, 0, '/second-semester');
                    // $('.semester-tab2').remove();
                    // $('#checkfail').val('notPromoted');
                    $('#page_18').show();
                    if(total_sem_count > 1){
                        container_array.splice(11, 0, '#page_18');
                        api_url_array.splice(11, 0, '/second-semester');
                        $('.semester-tab2').remove();
                        $('#checkfail').val('notPromoted');
                    }
                    else{
                        $('.semester-tab-conversion').remove();
                        $('.semester-tab2').remove();
                        $('#page_18').hide();
                        $('#v-pills-page_18-tab').remove();
                        $('#v-pills-tab').append('<a class="nav-link semester-tab semester-tab-conversion aa" id="v-pills-page_25-tab" data-toggle="pill" href="#v-pills-page_25" role="tab" aria-controls="v-pills-page_25" aria-selected="true">Conversion in Next Degree</a>');
                        // $('#v-pills-page_25').addClass('active');
                    }

                } else {
                    let allPromotions = $('.promotion_first_semester');
                    let lengthForPromotion = allPromotions.length;
                    if ($(allPromotions[lengthForPromotion - 1]).val() == 'promoted') {
                        // container_array.splice(11, 0, '#page_18');
                        // api_url_array.splice(11, 0, '/second-semester');
                        // $('.semester-tab-conversion').remove();
                        // $('.semester-tab2').remove();
                        // if (document.getElementById('v-pills-page_18-tab')) {
                        //       // alert('this record already exists');
                        //       $('#v-pills-tab').append('<a class="nav-link semester-tab semester-tab-conversion aa" id="v-pills-page_25-tab" data-toggle="pill" href="#v-pills-page_25" role="tab" aria-controls="v-pills-page_25" aria-selected="true">Conversion in Next Degree</a>');
                        // } else {
                        //
                        //      $('#v-pills-tab').append('<a class="nav-link semester-tab semester-tab2 aa" id="v-pills-page_18-tab" data-toggle="pill" href="#v-pills-page_18" role="tab" aria-controls="v-pills-page_18" aria-selected="true">Continue 1(Second Semester)</a><a class="nav-link semester-tab semester-tab-conversion aa" id="v-pills-page_25-tab" data-toggle="pill" href="#v-pills-page_25" role="tab" aria-controls="v-pills-page_25" aria-selected="true">Conversion in Next Degree</a>');
                        // }
                        $('#page_18').show();
                        if(total_sem_count > 1){
                            container_array.splice(11, 0, '#page_18');
                            api_url_array.splice(11, 0, '/second-semester');
                            $('.semester-tab-conversion').remove();
                            $('.semester-tab2').remove();
                            if (document.getElementById('v-pills-page_18-tab')) {
                                // alert('this record already exists');
                                $('#v-pills-tab').append('<a class="nav-link semester-tab semester-tab-conversion aa" id="v-pills-page_25-tab" data-toggle="pill" href="#v-pills-page_25" role="tab" aria-controls="v-pills-page_25" aria-selected="true">Conversion in Next Degree</a>');
                            } else {

                                $('#v-pills-tab').append('<a class="nav-link semester-tab semester-tab2 aa" id="v-pills-page_18-tab" data-toggle="pill" href="#v-pills-page_18" role="tab" aria-controls="v-pills-page_18" aria-selected="true">Continue 1(Second Semester)</a><a class="nav-link semester-tab semester-tab-conversion aa" id="v-pills-page_25-tab" data-toggle="pill" href="#v-pills-page_25" role="tab" aria-controls="v-pills-page_25" aria-selected="true">Conversion in Next Degree</a>');
                            }
                        }
                        else{
                            $('.semester-tab-conversion').remove();
                            $('.semester-tab2').remove();
                            $('#page_18').hide();
                            $('#v-pills-page_18-tab').remove();
                            $('#v-pills-tab').append('<a class="nav-link semester-tab semester-tab-conversion aa" id="v-pills-page_25-tab" data-toggle="pill" href="#v-pills-page_25" role="tab" aria-controls="v-pills-page_25" aria-selected="true">Conversion in Next Degree</a>');
                            // $('#v-pills-page_25').addClass('active');
                        }

                        // $('#v-pills-tab').append('<a class="nav-link semester-tab semester-tab2 aa" id="v-pills-page_18-tab" data-toggle="pill" href="#v-pills-page_18" role="tab" aria-controls="v-pills-page_18" aria-selected="true">Continue 1(Second Semester)</a><a class="nav-link semester-tab semester-tab-conversion aa" id="v-pills-page_25-tab" data-toggle="pill" href="#v-pills-page_25" role="tab" aria-controls="v-pills-page_25" aria-selected="true">Conversion in Next Degree</a>');
                    } else {
                        container_array.splice(11, container_array.length - 11);
                        api_url_array.splice(11, api_url_array.length - 11);
                        container_no = 10;
                        // $('.semester-tab-conversion').remove();
                        $('.semester-tab2').remove();
                        $('#page_18').hide();
                        // $('#v-pills-page_25').addClass('active');
                        // $('#v-pills-page_17').addClass('active');

                    }
                }
            }
            setDisplayForButtons();

        }
        function setReadmissionFirst(e) {
            let selected = $('select[name="readmissionfirst"]').val();
            if(selected == 'yes'){
                $('#same_course_page_17').show();
                $('#change_course_page_17').show();

            }
            else{
                if(!index_id){
                    $('#same_course_17').val('');
                    $('#change_course_17').val('');
                }
                $('#same_course_page_17').hide();
                $('#change_course_page_17').hide();
            }
        }
        function setExamFeeStatusPage17() {
            if($('#exam_fee_status_page17').val() == 'yes'){
                $('#date_div_exam_page17').fadeIn();
                $('#amount_div_exam_page17').fadeIn();
            }
            else{
                $('#amount_div_exam_page17').fadeOut();
                $('#date_div_exam_page17').fadeOut();
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

        setDisplayForClaimReceivedPage17();
         function setDisplayForClaimReceivedPage17() {
            if($('#claim_status_page_17').val() == 'received'){
                for (var i = 1; i <= 8; i++) {
                  $(`#amount_due_${i}_page_17`).val($(`#claim_amount_due_default_${i}_page_17`).val());
                  calculteTotalForClaimsPageseventeen();
                }
                $('#recovered_amount_div_page_17').fadeOut();
                $('#outstanding_cfe_fee_div_page_17').fadeOut();
                $('#reason_div_page_17').fadeOut();            
                $('#claims_statuses_table_page_17').fadeIn();
                $('#provisional_claim_last_page_17').fadeIn();
            }
            else if($('#claim_status_page_17').val() == 'rejected'){
              $('#recovered_amount_div_page_17').fadeIn();
                $('#outstanding_cfe_fee_div_page_17').fadeIn();
                $('#reason_div_page_17').fadeIn();
                $('#claims_statuses_table_page_17').fadeOut();
                $('#provisional_claim_last_page_17').fadeOut();
            }
            else if($('#claim_status_page_17').val() == 'notReceived'){
              $('#recovered_amount_div_page_17').fadeOut();
                $('#outstanding_cfe_fee_div_page_17').fadeOut();
                $('#reason_div_page_17').fadeIn();
                $('#claims_statuses_table_page_17').fadeOut();
                $('#provisional_claim_last_page_17').fadeOut();
            }
            else if($('#claim_status_page_17').val() == 'cancelled'){
              $('#recovered_amount_div_page_17').fadeOut();
                $('#outstanding_cfe_fee_div_page_17').fadeOut();
                $('#reason_div_page_17').fadeIn();
                $('#claims_statuses_table_page_17').fadeOut();
                $('#provisional_claim_last_page_17').fadeOut();
            }
            else{
              $('#recovered_amount_div_page_17').fadeOut();
                $('#outstanding_cfe_fee_div_page_17').fadeOut();
                $('#reason_div_page_17').fadeOut();
                $('#claims_statuses_table_page_17').fadeOut();
                $('#provisional_claim_last_page_17').fadeOut();
            }
        }

        function calculteTotalForClaimsPageseventeen(){
           var claim_amount_due_default_page_17 = 0;
            var amount_due_page_17 = 0;
            var amount_received_page_17 = 0;
            var balance_due_page_17 = 0;

            for (var i = 1; i <= 8; i++) {
              $(`#amount_due_${i}_page_17`).val($(`#claim_amount_due_default_${i}_page_17`).val());
            }

            for(var i = 1; i <= 8; i++){
                var total_balance = 0;
                claim_amount_due_default_page_17 = parseFloat(claim_amount_due_default_page_17) + parseFloat($('#claim_amount_due_default_'+i+'_page_17').val());
                if($('#claim_amount_due_default_'+i+'_page_17').val() == ""){
                      $('#claim_amount_due_default_'+i+'_page_17').val('0');
                  }
                amount_due_page_17 = parseFloat(amount_due_page_17) + parseFloat($('#amount_due_'+i+'_page_17').val());
                if($('#amount_due_'+i+'_page_17').val() == ""){
                      $('#amount_due_'+i+'_page_17').val('0');
                  }
                amount_received_page_17 = parseFloat(amount_received_page_17) + parseFloat($('#amount_received_'+i+'_page_17').val());
                if($('#amount_received_'+i+'_page_17').val() == ""){
                      $('#amount_received_'+i+'_page_17').val('0');
                  }

                  if (parseFloat($('#amount_received_'+i+'_page_17').val()) > parseFloat($('#amount_due_'+i+'_page_17').val())) {
                  $('#amount_received_'+i+'_page_17').val('0');
                  $.notify('Amount Due cannot be less than Amount Received!');
                  }

               balance_due_page_17 = parseFloat(balance_due_page_17) + parseFloat($('#balance_due_'+i+'_page_17').val());
                if(amount_due_page_17 < amount_received_page_17){
                    // alert("Amount Received Cannot Be Higher Then Amount Due");
                    $('#amount_received_'+i+'_page_17').val()
                    // return false;
                }    
                if($('#amount_due_'+i+'_page_17').val() != "0" || $('#amount_received_'+i+'_page_17').val() != "0"){
                    total_balance = parseFloat($('#amount_due_'+i+'_page_17').val()) - parseFloat($('#amount_received_'+i+'_page_17').val());
                    $('#balance_due_'+i+'_page_17').val(total_balance);
                }              
            }
            
            $('#claim_amount_due_default_page_17').val(claim_amount_due_default_page_17);
            $('#amount_due_page_17').val(amount_due_page_17);
            $('#amount_received_page_17').val(amount_received_page_17);
            $('#balance_due_page_17').val(balance_due_page_17);
            $('#claim_due_page_17').val(claim_amount_due_default_page_17);
            $('#amount_received_last_page_17').val(amount_received_page_17);
        }

        clone.find('.datepickerFail').datepicker({
                format:'dd/mm/yyyy',
                endDate: new Date(),
                autoclose: true
            });
    </script>
@endsection
