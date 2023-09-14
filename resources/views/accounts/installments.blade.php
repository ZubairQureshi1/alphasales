<link href="{{ asset('css/accounts/instalment.css') }}" rel="stylesheet" type="text/css" />
<div class="tabcontent" id="installments" role="tabpanel" style="display:none">
    <div class="row m-b-10">
        <div class="col-md-3">
             <strong>
                Net total:
            </strong>
            {{$fee_package!=null?$fee_package['net_total']:''}}
        </div>
        <div class="col-md-9">

            @can('create_accounts')
                <button class="btn btn-sm btn-secondary waves-effect waves-light pull-right" data-target=".create_custom_model" data-toggle="modal"  type="button"  onclick="netTotal()">
                    Make Custom Installments
                </button>
            @endcan
        </div>
    </div>

    @if($fee_instalments!=null && !empty($fee_instalments) && count($fee_instalments)!=0)
        @foreach($fee_instalments as $index => $instalment)
            <div class="row">
                <div class="col-12">
                    <div id="accordion">
                        <div class="custom-accordion padding-10" id="headingOne">
                            <div class="row">
                                <div class="col-md-8">
                                    <a href="#collapse_{{$index+1}}" class="collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="collapse_{{$index+1}}">
                                        <div class="row">
                                            <div class="col-md-6 margin-top-5">
                                                <h6 class="m-0">Instalment No - {{$index+1}}</h6>
                                            </div>
                                            <div class="col-md-6 margin-top-5">
                                                <h6 class="m-0">Status: {{ $instalment['status_name'] }}</h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <div class="btn-group ml-2 acount_instalment">
                                        <button type="button" class="btn btn-sm btn-primary waves-light waves-effect dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            More
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            
                                            <form action="{{route('accounts.deleteInstalment')}}" method="POST">
                                                @csrf
                                                <input name="instalment_id" required="" type="hidden" value="{{ $instalment['id'] }}">

                                                <button name="" type="submit" class="dropdown-item">Delete</button>
                                            </form> 
                                            @if($instalment['status_id'] != 1) 
                                                <button class="dropdown-item" data-target="#{{$instalment['id']}}" data-toggle="modal"  type="button" onclick="set({{$instalment['id']}})">
                                                Make A Payment
                                                </button> 
                                            @endif
                                            @if($instalment['status_id'] != 0 && $instalment['payment_verification'] != true)
                                             
                                            <form action="{{route('accounts.verifyPayments')}}" method="POST">
                                                @csrf
                                                <input name="instalment_id" required="" type="hidden" value="{{ $instalment['id'] }}">
                                                <input name="payment_type" required="" type="hidden" value="instalment">
                                                {!! Form::button('Verify Payment', ['class' => 'dropdown-item']) !!}
                                            </form> 
                                            @endif

                                            {{-- @if(($instalment['status_id'] == 1 && $instalment['late_fee_fine_voucher_code'] == '') || ($instalment['status_id'] == 2 && $instalment['r_b_late_fee_fine_voucher_code'] == ''))
                                                @if ($instalment['status_id'] == 1 && $instalment['late_fee_fine'] != 0)
                                                    <button class="btn btn-success accounts_mobile_btn btn-sm waves-effect waves-light  margin-left-5" data-target="#{{$index+1}}_payInstalmentFineModel" data-toggle="modal"  type="button" onclick="set({{$instalment['id']}})">
                                                    Pay Fine
                                                    </button>
                                                @elseif ($instalment['status_id'] == 2)
                                                    @if ($instalment['late_fee_fine'] != 0 || $instalment['lateFine'] != 0)
                                                        <button class="btn btn-success accounts_mobile_btn   btn-sm waves-effect waves-light  margin-left-5" data-target="#{{$index+1}}_payInstalmentFineModel" data-toggle="modal"  type="button" onclick="set({{$instalment['id']}})">
                                                            Pay Fine
                                                        </button>
                                                    @endif
                                                @endif
                                            @endif --}}

                                            @if(($instalment['late_fee_fine_voucher_code'] == '' || $instalment['r_b_late_fee_fine_voucher_code'] == ''))
                                                <button class="dropdown-item" data-target="#{{$index+1}}_payInstalmentFineModel" data-toggle="modal"  type="button" onclick="set({{$instalment['id']}})">
                                                Pay Fine
                                                </button>
                                            @endif 
                                            @can('edit_accounts')
                                                @if($instalment['status_id'] == 0 || $instalment['status_id'] == 1)
                                                 
                                                    <button class="dropdown-item" data-target="#{{$index+1}}" data-toggle="modal"  type="button">
                                                        Edit Instalment
                                                    </button> 
                                                @endif
                                            @endcan

                                            <form action="{{route('accounts.invoice')}}" method="POST">
                                                @csrf
                                                <input name="installment_id" type="hidden" value="{{$instalment['id']}}">
                                                <input name="student_id" type="hidden" value="{{$student['id']}}">
        
                                                <input name="count" type="hidden" value="{{$index+1}}">
                                                {!! Form::submit('Print Voucher', ['class' => 'dropdown-item']) !!}
                                                <!-- </input>
                                                </input>
                                                </input> -->
                                            </form>  
                                        </div>

                                    </div>

                                    <div class=" margin-top-5  acount_instalment ">
                                            <div class="badge badge-pill  {{$instalment['is_verified']==true?'badge-success':'badge-danger'}}">
                                                    <span class="{{$instalment['is_verified']==true?'verification_success_bg':'verification_danger_bg'}}  "> <i class="mdi mdi-checkbox-blank-circle {{$instalment['is_verified']==true?'ion-checkmark':'ion-information'}}"></i></span>
                                                <!-- <i class="mdi mdi-checkbox-blank-circle  {{$instalment['is_verified']==true?'text-success':'text-danger'}} "></i> <span class=" {{$instalment['is_verified']==true?'text-success':'text-danger'}}"> -->
                                                    {{$instalment['is_verified']==true?'Verified':'Un-Verified'}}
                                                <!-- </span>  -->
                                                </div>
                                            <!-- <strong class="badge badge-pill {{$instalment['is_verified']==true?'badge-success':'badge-danger'}}  "  style="position: relative;padding-top: 7px; padding-right: 10px; padding-bottom: 7px; padding-left: 23px;">{{$instalment['is_verified']==true?'Verified':'Un-Verified'}}</strong>

                                        <strong class="{{$instalment['is_verified']==true?'badge-round-success':'badge-round-danger'}}  "><i class="{{$instalment['is_verified']==true?'ion-checkmark':'ion-information'}}"></i></strong> -->
                                    </div>
                                    @if($instalment['status_id']!=0)
                                        <div class="margin-top-5  acount_instalment ">
                                            <!-- <strong class="badge badge-pill {{$instalment['payment_verification']==true?'badge-success':'badge-danger'}}  "  style="position: relative;padding-top: 7px; padding-right: 10px; padding-bottom: 7px; padding-left: 23px;">{{$instalment['payment_verification']==true?'Payment Verified':'Payment Un-Verified'}}</strong> -->
                                            <div class=" badge badge-pill  {{$instalment['payment_verification']==true?'badge-success':'badge-danger'}}">
                                                   <span class="{{$instalment['payment_verification']==true?'verification_success_bg':'verification_danger_bg'}} "><i class="mdi mdi-checkbox-blank-circle {{$instalment['payment_verification']==true?'ion-checkmark':'ion-information'}} "></i> </span> 
                                                    {{$instalment['payment_verification']==true?'Payment Verified':'Payment Un-Verified'}}
                                            </div>       
                                            <!-- <i class="mdi mdi-checkbox-blank-circle  {{$instalment['payment_verification']==true?'text-success':'text-danger'}} "></i> <span class=" {{$instalment['payment_verification']==true?'text-success':'text-danger'}}">{{$instalment['payment_verification']==true?'Payment Verified':'Payment Un-Verified'}}</span>  -->
                                            
                                        </div>
                                    @endif  
                                </div>
                            </div>
                        </div>

                        <div id="collapse_{{$index+1}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion" style="">
                            <div class="card-body div-border margin-bottom-5">
                                <div class="row">
                                    <div class="col-6">
                                        <strong>Labels</strong>
                                    </div>
                                    <div class="col-6 pull-right">
                                        <strong>Details</strong>
                                    </div>
                                </div>
                                <div class="margin-5">
                                    @if ($instalment['carry_forward'] != null && $instalment['carry_forward'] != '')
                                        <div class="row nth-bg">
                                            <div class="col-6">
                                                <strong>Carry Forwarded</strong>
                                            </div>
                                            <div class="col-6 pull-right">
                                                <input type="text" readonly class="form-control input-no-bg" id="{{$instalment['id']}}carry_forward" value="Rs {{$instalment['carry_forward']}}/-">
        
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row nth-bg">
                                        <div class="col-6">
                                            <strong>Instalment Status</strong>
                                        </div>
                                        <div class="col-6 pull-right">
                                            <input type="text" readonly class="form-control input-no-bg" id="{{$instalment['id']}}status" value="{{$instalment['status_name']}}">
                                             <input type="hidden" readonly  id="{{$instalment['id']}}statusId" value="{{$instalment['status_id']}}">
        
                                        </div>
                                    </div>
                                    <div class="row nth-bg">
                                        <div class="col-6">
                                            <strong >Instalment Amount Due</strong>
                                        </div>
                                        <div class="col-6 pull-right">
                                           <input type="text" readonly class="form-control input-no-bg"  value="Rs {{$instalment['amount_per_installment']}}/-">
                                        </div>
                                    </div>
                                    <div class="row nth-bg">
                                        <div class="col-6">
                                            <strong>Instalment Due Date</strong>
                                        </div>
                                        <div class="col-6 pull-right">
                                              <input type="text" readonly class="form-control input-no-bg"  id="{{$instalment['id']}}due_date"  value="{{$instalment['due_date']}}">
                                        </div>
                                    </div>
                                    <div class="row nth-bg">
                                        <div class="col-6">
                                            <strong>Payment Date</strong>
                                        </div>
                                        <div class="col-6 pull-right">
                                           <input type="text" readonly class="form-control input-no-bg"  value="{{$instalment['paid_date']!=''?$instalment['paid_date']: '--/--/----' }}">
                                        </div>
                                    </div>
                                    @if(count($instalment->feeVoucher()->get()->toArray()) != 0)
                                        <div class="row nth-bg">
                                            <div class="col-6">
                                                <strong>Voucher No:</strong>
                                            </div>
                                            <div class="col-6 pull-right">
                                                <input type="text" readonly class="form-control input-no-bg"  value="{{$instalment->feeVoucher()->get()->first()->voucher_code}} (Voucher No)">
                                            </div>
                                        </div>
                                    @endif
                                    @if ($instalment['late_fee_fine'] != null && $instalment['late_fee_fine'] != '')
                                        <div class="row nth-bg">
                                            <div class="col-6">
                                                <strong>Instalment Late Fee Fine</strong>
                                            </div>
                                            <div class="col-6 pull-right">
                                                <input type="text" readonly class="form-control input-no-bg"  value="Rs {{$instalment['late_fee_fine']==''?$instalment['lateFine']:$instalment['late_fee_fine']}}/-">
                                            </div>
                                        </div>
                                    @endif
                                    @if ($instalment['amount_with_fine'] != null && $instalment['amount_with_fine'] != '')
                                        <div class="row nth-bg">
                                            <div class="col-6">
                                                <strong>Instalment Amount Due With Fine</strong>
                                            </div>
                                            <div class="col-6 pull-right">
                                                  <input type="text" readonly class="form-control input-no-bg"  value="Rs {{$instalment['amount_with_fine']}}/-">
                                            </div>
                                        </div>
                                    @endif
                                        <div class="row nth-bg">
                                            <div class="col-6">
                                                <strong>Instalment Fine Waived</strong>
                                            </div>
                                            <div class="col-6 pull-right">
                                                @if ($instalment['fine_waived'] != null && $instalment['fine_waived'] != '')
                                                    <input type="text" readonly class="form-control input-no-bg"  value="Rs {{$instalment['fine_waived']}}/-">
                                                @else
                                                    <input type="text" readonly class="form-control input-no-bg"  value="---">
                                                @endif
                                            </div>
                                        </div>
                                    @if ($instalment['fine_waived'] != null && $instalment['fine_waived'] != '')
                                        <div class="row nth-bg">
                                            <div class="col-6">
                                                <strong>Instalment Amount (After Waived)</strong>
                                            </div>
                                            <div class="col-6 pull-right">
                                                  <input type="text" readonly class="form-control input-no-bg"  value="Rs {{$instalment['amount_with_fine'] - $instalment['fine_waived'] }}/-">
                                            </div>
                                        </div>
                                    @endif
                                    @if ($instalment['paid_amount'] != null && $instalment['paid_amount'] != '')
                                        <div class="row nth-bg">
                                            <div class="col-6">
                                                <strong>Instalment Amount Paid</strong>
                                            </div>
                                            <div class="col-6 pull-right">
                                                  <input type="text" readonly class="form-control input-no-bg" id="{{$instalment}}amount_paid"  value="Rs {{$instalment['paid_amount']}}/-">
                                            </div>
                                        </div>
                                    @endif
                                    @if ($instalment['remaining_balance_voucher_id'] != null && $instalment['remaining_balance_voucher_id'] != '')
                                        <div class="row nth-bg">
                                            <div class="col-6">
                                                <strong>Instalment Voucher No</strong>
                                            </div>
                                            <div class="col-6 pull-right">
                                                  <input type="text" readonly class="form-control input-no-bg" id="{{$instalment['id']}}remaining_balance_voucher_id" value="{{$instalment['remaining_balance_voucher_id']}} (Voucher No)">
                                            </div>
                                        </div>
                                    @endif
                                    @if ($instalment['remaining_balance'] != null && $instalment['remaining_balance'] != '')
                                        <div class="row nth-bg">
                                         <div class="col-6">
                                                <strong>Instalment Remaining Balance</strong>
                                            </div>
                                            <div class="col-6 pull-right">
                                                  <input type="text" readonly class="form-control input-no-bg"  value="Rs {{$instalment['remaining_balance']}}/-">
                                            </div>
                                        </div>
                                    @endif
                                    @if ($instalment['remaining_balance_late_fine'] != null && $instalment['remaining_balance_late_fine'] != '')
                                        <div class="row nth-bg">
                                            <div class="col-6">
                                                <strong>Late Fee Fine Remaining Balance</strong>
                                            </div>
                                            <div class="col-6 pull-right">
                                                  <input type="text" readonly class="form-control input-no-bg" id="{{$instalment['id']}}remaining_balance_late_fee_fine" value="Rs {{$instalment['remaining_balance_late_fine']}}/-">
                                            </div>
                                        </div>
                                    @endif
        
                                    @if ($instalment['total_remaining_balance'] != null && $instalment['total_remaining_balance'] != '')
                                        <div class="row nth-bg">
                                            <div class="col-6">
                                                <strong>Total Remaining Balance</strong>
                                            </div>
                                            <div class="col-6 pull-right">
                                                  <input type="text" readonly class="form-control input-no-bg" id="{{$instalment['id']}}total_remaining_balance" value="Rs {{$instalment['total_remaining_balance']}}/-">
                                            </div>
                                        </div>
                                    @endif
        
                                    @if ($instalment['remaining_balance_paid_date'] != null && $instalment['remaining_balance_paid_date'] != '')
                                        <div class="row nth-bg">
                                            <div class="col-6">
                                                <strong>Payment Date</strong>
                                            </div>
                                            <div class="col-6 pull-right">
                                                  <input type="text" readonly class="form-control input-no-bg" id="{{$instalment['id']}}remaining_balance_paiddate" value="{{$instalment['remaining_balance_paid_date']!=''?$instalment['remaining_balance_paid_date']: '--/--/----'}}">
                                            </div>
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade create_payment_model" id="{{$instalment['id']}}" role="dialog" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0">
                                Make
                                <strong>
                                  Payment
                                </strong>
                            </h5>
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                                ×
                            </button>
                        </div>
                            <div class="modal-body">
                                <form action="{{route('accounts.installment_paid')}}" class="" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-12">
                                                <label>
                                                    Instalment Voucher Code:
                                                </label>
                                                <input class="form-control" id="voucher_code" name="voucher_code"  type="text">
                                            </div>
                                            <div class="col-6">
                                                <label>
                                                    Due Date:
                                                </label>
                                                <input class="form-control" data-date-format="YYYY-MM-DD" disabled="disabled" data-parsley-type="due_date" id="{{$instalment['id']}}due_date" name="due_date" value="{{$instalment['due_date']}}" type="date"/>
                                            </div>
                                            <div class="col-6">
                                                <label>
                                                    Paid Date:
                                                </label>
                                                <input class="form-control" data-date-format="YYYY-MM-DD" onchange="fineCalculator()" data-parsley-type="paid_date" id="{{$instalment['id']}}paid_date" name="paid_date" required type="date"/>
                                            </div>
                                            <div class="col-6">
                                                <label>
                                                    Late Fee Fine:
                                                </label>
                                                <input type="text"  class="form-control" name = "lateFine" id="{{$instalment['id']}}lateFine" value="{{$instalment['lateFine']}}">
                                            </div>
                                            <div class="col-6">
                                                <label>
                                                    Days for Fine:
                                                </label>
                                                <input type="text"  class="form-control" disabled="disabled" name ="fine_days" id="{{$instalment['id']}}fine_days" placeholder="Total number of days">
                                            </div>
                                            <div class="col-6">
                                                <label>
                                                    Fine Waived By H.A:
                                                </label>
                                                <input type="text"  class="form-control" name = "fine_waived" id="{{$instalment['id']}}fine_waived" max="{{ $instalment['lateFine']}}"  onchange="fineWaived()" value="0" >
                                            </div>
                                            <div class="col-6">
                                                <label>
                                                    Late Fee Fine Voucher Code:
                                                </label>
                                                <input type="text"  class="form-control" name = "late_fee_fine_voucher_code" id="{{$instalment['id']}}late_fee_fine_voucher_code" placeholder="Fine Voucher No.">
                                            </div>
                                            <div class="col-6">
                                                <label>
                                                    Amount per Installment:
                                                </label>
                                                <input type="text" readonly  name="amount_per_installment" class="form-control" id="{{$instalment['id']}}amount_per_installment" value="{{$instalment['status_id']=='2'?$instalment['remaining_balance']:$instalment['amount_per_installment']}}">
                                            </div>
                                            <div class="col-6">
                                                <label>
                                                  Amount with Fine:
                                                </label>
                                                <input type="text" readonly name="total_amount" class="form-control" id="{{$instalment['id']}}total_amount">
                                            </div>
                                            <div class="col-6">
                                                <label>
                                                    Paid Amount:
                                                </label>
                                                <input type="number" name="amount_paid" class="form-control" id="{{$instalment['id']}}amount_paid" onkeyup="calculateRemainingAmount('{{ $instalment['id'] }}')">
                                            </div>
                                            <div class="col-6">
                                                <label>
                                                     Remaning Balance:
                                                </label>
                                                <input type="text" class="form-control" id="{{$instalment['id']}}remaining_balance2">
                                                <span id="{{$instalment['id']}}message"></span>
                                            </div>

                                            <input type="hidden" readonly name="carry_forward" class="form-control" id="{{$instalment['id']}}carry_forward2" >
                                            <input type="hidden" readonly name="is_carry_forward" class="form-control" id="{{$instalment['id']}}is_carry_forward" value="false" >
                                            <input name="status_id" type="hidden" value="1">
                                            <input name="status_name" type="hidden" value="{{config('constants.payment_statuses')[1]}}">
                                            <input name="instalment_id" id="paid" type="hidden" value="{{$instalment['id']}}">
                                            <input name="student_id" id="student_id" type="hidden" value="{{$student['id']}}">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary" onclick="" type="submit">
                                            Save
                                        </button>
                                        <button class="btn btn-secondary" data-dismiss="modal" type="button">
                                            Close
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div aria-hidden="true" aria-labelledby="payInstalmentFineModel" id="{{$index+1}}_payInstalmentFineModel" class="modal fade payInstalmentFineModel" role="dialog" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title mt-0">
                                    Fine For
                                    <strong>
                                      (Instalment No - {{$index+1}})
                                    </strong>
                                </h5>
                                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                                    ×
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('accounts.payInstalmentFine')}}" class="" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label>
                                            Instalment Fine Amount:
                                        </label>
                                        @if ($instalment['status_id'] == 1)
                                            @if ($instalment['late_fee_fine'] != 0 && $instalment['late_fee_fine_voucher_code'] == '')
                                                <input class="form-control p-1 mb-2" id="instalment_fine_amount" value="{{$instalment['late_fee_fine']}}"  name="amount_per_installment"  type="text">
                                                <label>
                                                    Voucher Code:
                                                </label>
                                                <input type="text"  class="form-control" name = "late_fee_fine_voucher_code" id="{{$instalment['id']}}late_fee_fine_voucher_code" placeholder="Fine Voucher No.">
                                                <label>
                                                    Fine Waived:
                                                </label>
                                                <input type="text"  class="form-control" name = "fine_waived" id="{{$instalment['id']}}fine_waived" placeholder="Fine Waived">
                                                <label>
                                                    Paid Date:
                                                </label>
                                                <input type="date"  data-date-format="YYYY-MM-DD" class="form-control" name = "fine_paid_date" id="{{$instalment['id']}}late_fee_fine_voucher_code" placeholder="Fine Voucher No.">
                                            @endif
                                            @if ($instalment['remaining_balance'] != 0 && $instalment['r_b_late_fee_fine_voucher_code'] == '')
                                                <input  class="form-control p-1 mb-2" id="instalment_fine_amount" value="{{$instalment['remaining_balance_late_fine']}}"  name="amount_per_installment"  type="text">
                                                <label>
                                                    Voucher Code:
                                                </label>
                                                <input type="text"  class="form-control" name = "r_b_late_fee_fine_voucher_code" id="{{$instalment['id']}}late_fee_fine_voucher_code" placeholder="Fine Voucher No.">
                                                <label>
                                                    Fine Waived:
                                                </label>
                                                <input type="text"  class="form-control" name = "remaining_balance_fine_waived" id="{{$instalment['id']}}remaining_balance_fine_waived" placeholder="Fine Waived">
                                                <label>
                                                    Paid Date:
                                                </label>

                                                <input type="date"  data-date-format="YYYY-MM-DD" class="form-control" name = "remaining_balance_fine_paid_date" id="{{$instalment['id']}}late_fee_fine_voucher_code" placeholder="Fine Voucher No.">
                                            @endif
                                        @endif
                                        @if ($instalment['status_id'] == 2)
                                            @if ($instalment['late_fee_fine'] != 0 && $instalment['late_fee_fine_voucher_code'] == '')
                                                <input class="form-control p-1 mb-2" id="instalment_fine_amount" value="{{$instalment['late_fee_fine']}}"  name="amount_per_installment"  type="text">
                                                <label>
                                                    Voucher Code:
                                                </label>
                                                <input type="text"  class="form-control" name = "late_fee_fine_voucher_code" id="{{$instalment['id']}}late_fee_fine_voucher_code" placeholder="Fine Voucher No.">
                                                <label>
                                                    Fine Waived:
                                                </label>
                                                <input type="text"  class="form-control" name = "fine_waived" id="{{$instalment['id']}}remaining_balance_fine_waived" placeholder="Fine Waived">
                                                <label>
                                                    Paid Date:
                                                </label>
                                                <input type="date"  data-date-format="YYYY-MM-DD" class="form-control" name = "fine_paid_date" id="{{$instalment['id']}}late_fee_fine_voucher_code" placeholder="Fine Voucher No.">
                                            @endif
                                        @endif
                                        <input type="text" hidden="" class="form-control" name="instalment_id" value="{{ $instalment['id'] }}">
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary"  type="submit">
                                            Save
                                        </button>
                                        <button class="btn btn-secondary" data-dismiss="modal" type="button">
                                            Close
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div aria-hidden="true" aria-labelledby="mySmallModalLabel" id="{{$index+1}}_edit_instalment" class="modal fade create_paymentE_model" role="dialog" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title mt-0">
                                    Edit
                                    <strong>
                                      (Instalment No - {{$index+1}})
                                    </strong>
                                </h5>
                                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                                    ×
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('accounts.edit_installment')}}" class="" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label>
                                            Amount per Installment:
                                        </label>
                                        <input  class="form-control p-1 mb-2" id="amount_per_installment" value="{{$instalment['amount_per_installment']}}"  name="amount_per_installment"  type="text">
                                         <label>
                                            Due Date:
                                        </label>
                                        <input  class="form-control p-1 mb-2" data-date-format="YYYY-MM-DD" id="due_date" value="{{$instalment['due_date']}}" name="due_date"  type="date">
                                        <input name="id" id="edit" type="hidden" value="{{$instalment['id']}}">
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary"  type="submit">
                                            Save
                                        </button>
                                        <button class="btn btn-secondary" data-dismiss="modal" type="button">
                                            Close
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
@include('accounts.custom_model')
