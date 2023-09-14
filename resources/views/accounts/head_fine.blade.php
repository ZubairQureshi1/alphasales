<div class="tabcontent" id="head_fine" role="tabpanel" style="display:none">
    <div class="row m-b-10">
        <div class="col-12">
            <label>
                <strong>
                    Summary
                </strong>
            </label>
            @can('create_accounts')
                <button class="btn btn-secondary btn-sm waves-effect waves-light pull-right" data-target=".create_head_fine_model" data-toggle="modal" id="adds" type="button">
                    Add Head
                </button>
            @endcan
        </div>
    </div>
    @if(count($headstudents)!=0)
        @foreach ($headstudents as $index => $headstudent)
            <div class="row">
                <div class="col-12">
                    <div id="accordion">
                        <div class="custom-accordion padding-10" id="headingOne">
                            <div class="row">
                                <div class="col-md-8">
                                    <a href="#collaps_{{$index+1}}" class="collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="collaps_{{$index+1}}">
                                        <div class="row">
                                            <div class="col-md-6 margin-top-5">
                                                <h6 class="m-0">Head No - {{$index+1}} <i>({{ !$headstudent->headFine()->get()->isEmpty()?$headstudent->headFine()->get()->first()->name: '---' }})</i></h6>
                                            </div>
                                            <div class="col-md-6 margin-top-5">
                                                <h6 class="m-0">Status: {{ $headstudent['status_name'] }}</h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <div class="pull-right">
                                        <div class="btn-group ml-2 acount_instalment">
                                            <button type="button" class="btn btn-sm btn-primary waves-light waves-effect dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                More
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                {{-- For Editing a specific object/row --}}
                                                <form action="{{route('accounts.invoiceHead')}}" method="POST">
                                                    <input name="id" type="hidden" value="{{$headstudent['id']}}">
                                                        <input name="student_id" type="hidden" value="{{$headstudent['student_id']}}">
                                                            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                                                            <button class=" dropdown-item" type="submit">
                                                                Print Voucher
                                                            </button>
                                                            <!-- {!! Form::submit('', ['class' => 'btn btn-primary btn-sm fa fa-print']) !!} -->
                                                        </input>
                                                    </input>
                                                </form>
    
                                                @if ($headstudent->status_id != 1)
                                                    <button class=" dropdown-item  " data-target="#head_pay_{{$headstudent['id']}}" onclick="set({{$headstudent['id']}})" data-toggle="modal" type="button">
                                                        Make A Payment
                                                    </button>
                                                @endif
                                                    @can('delete_accounts')
                                                        {!! Form::open(['route' => ['accounts.destroy', $headstudent['id']], 'method' => 'delete']) !!}
                                                            <button class=" dropdown-item" type="submit">
                                                            Delete
                                                            </button>
                                                        {!! Form::close() !!}
                                                    @endcan
                                                @if (!$headstudent->is_order_placed)
                                                    <a class="dropdown-item btn btn-sm" href="{{ route('accounts.placeOrder', $headstudent->id) }}" type="button">
                                                    Place Order
                                                    </a>
                                                @elseif($headstudent->is_order_placed && ($headstudent->date_of_order_delivered == null || $headstudent->date_of_order_delivered == ''))
                                                    <button class=" dropdown-item" data-target="#{{$index+1}}delivered" data-toggle="modal" type="button">Delivered</button>
                                                @endif
                                                @if($headstudent['status_id'] != 0 && $headstudent['payment_verification'] != true)
                                                    <form action="{{route('accounts.verifyPayments')}}" method="POST">
                                                        @csrf
                                                        <input name="head_student_id" required="" type="hidden" value="{{ $headstudent['id'] }}">
                                                        <input name="payment_type" required="" type="hidden" value="heads">
                                                        {!! Form::button('Verify Payment', ['class' => ' dropdown-item  ']) !!}
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="margin-top-5 acount_instalment">
                                            <div class="badge badge-pill  {{$headstudent['is_verified']==true?'badge-success':'badge-danger'}}">
                                                <span class="{{$headstudent['is_verified']==true?'verification_success_bg':'verification_danger_bg'}}  "> 
                                                <i class="mdi mdi-checkbox-blank-circle {{$headstudent['is_verified']==true?'ion-checkmark':'ion-information'}}"></i></span>
                                                {{$headstudent['is_verified']==true?'Verified':'Un-Verified'}} 
                                            </div> 
                                        </div>
                                        
                                        @if($headstudent['status_id']!=0)
                                            <div class="margin-top-5 acount_instalment">
                                                    <div class=" badge badge-pill  {{$headstudent['payment_verification']==true?'badge-success':'badge-danger'}}">
                                                        <span class="{{$headstudent['payment_verification']==true?'verification_success_bg':'verification_danger_bg'}} "><i class="mdi mdi-checkbox-blank-circle {{$headstudent['payment_verification']==true?'ion-checkmark':'ion-information'}} "></i> </span> 
                                                        {{$headstudent['payment_verification']==true?'Payment Verified':'Payment Un-Verified'}}
                                                    </div>   
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="collaps_{{$index+1}}" class="collapse" aria-labelledby="headFines" data-parent="#accordion" style="">
                            <div class="card-body">
                                    <div class="row">
                                            <div class="col-6">
                                                <strong>Labels</strong>
                                            </div>
                                            <div class="col-6 pull-right">
                                                <strong>Details</strong>
                                            </div>
                                        </div>
                                        <div class="margin-10">
                                                
                                            @if ($headstudent['carry_forward'] != null && $headstudent['carry_forward'] != '')
                                                <div class="row nth-bg">
                                                    <div class="col-6">
                                                        <strong>Carry Forwarded</strong>
                                                    </div>
                                                    <div class="col-6 pull-right">
                                                        <input type="text" readonly class="form-control input-no-bg" id="{{$headstudent['id']}}carry_forward" value="Rs {{$headstudent['carry_forward']}}/-">
                
                                                    </div>
                                                </div> 
                                            @endif
                                            <div class="row nth-bg">
                                                <div class="col-6">
                                                    <strong>Head Name</strong>
                                                </div>
                                                <div class="col-6 pull-right">
                                                    <input type="text" readonly class="form-control input-no-bg" value="{{ !$headstudent->headFine()->get()->isEmpty()?$headstudent->headFine()->get()->first()->name:'---'}}">
                
                                                </div>
                                            </div>
                                            <div class="row nth-bg">
                                                <div class="col-6">
                                                    <strong>Head Status</strong>
                                                </div>
                                                <div class="col-6 pull-right">
                                                    <input type="text" readonly class="form-control input-no-bg" id="{{$headstudent['id']}}status" value="{{$headstudent['status_name']}}">
                                                     <input type="hidden" readonly  id="{{$headstudent['id']}}statusId" value="{{$headstudent['status_id']}}">
                
                                                </div>
                                            </div>
                                            <div class="row nth-bg">
                                                <div class="col-6">
                                                    <strong>Head Amount Due</strong>
                                                </div>
                                                <div class="col-6 pull-right">
                                                   <input type="text" readonly class="form-control input-no-bg"  value="Rs {{$headstudent['head_amount']!=null?$headstudent['head_amount']: (!$headstudent->headFine()->get()->isEmpty()?$headstudent->headFine()->get()->first()->amount:0)}}/-">
                                                </div>
                                            </div>
                                            <div class="row nth-bg">
                                                <div class="col-6">
                                                    <strong>Head Due Date</strong>
                                                </div>
                                                <div class="col-6 pull-right">
                                                      <input type="text" readonly class="form-control input-no-bg"  id="{{$headstudent['id']}}due_date"  value="{{$headstudent['due_date']}}">
                                                </div>
                                            </div>
                                            <div class="row nth-bg">
                                                <div class="col-6">
                                                    <strong>Head Payment Date</strong>
                                                </div>
                                                <div class="col-6 pull-right">
                                                   <input type="text" readonly class="form-control input-no-bg"  value="{{$headstudent['paid_date']!=''?$headstudent['paid_date']: '--/--/----' }}">
                                                </div>
                                            </div>
                                            @if ($headstudent['late_fee_fine'] != null && $headstudent['late_fee_fine'] != '')
                                                <div class="row nth-bg">
                                                    <div class="col-6">
                                                        <strong>Head Late Fee Fine</strong>
                                                    </div>
                                                    <div class="col-6 pull-right">
                                                        <input type="text" readonly class="form-control input-no-bg"  value="Rs {{$headstudent['late_fee_fine']==''?$headstudent['lateFine']:$headstudent['late_fee_fine']}}/-">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($headstudent['amount_with_fine'] != null && $headstudent['amount_with_fine'] != '')
                                                <div class="row nth-bg">
                                                    <div class="col-6">
                                                        <strong>Head Amount Due With Fine</strong>
                                                    </div>
                                                    <div class="col-6 pull-right">
                                                          <input type="text" readonly class="form-control input-no-bg"  value="Rs {{$headstudent['amount_with_fine']}}/-">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($headstudent['paid_amount'] != null && $headstudent['paid_amount'] != '')
                                                <div class="row nth-bg">
                                                    <div class="col-6">
                                                        <strong>Head Amount Paid</strong>
                                                    </div>
                                                    <div class="col-6 pull-right">
                                                          <input type="text" readonly class="form-control input-no-bg" id="{{$headstudent}}amount_paid"  value="Rs {{$headstudent['paid_amount']}}/-">
                                                    </div>
                                                </div>
                                            @endif
                                            @if($headstudent['voucher_code'] != null && $headstudent['voucher_code'] != '')
                                                <div class="row nth-bg">
                                                    <div class="col-6">
                                                        <strong>Voucher No:</strong>
                                                    </div>
                                                    <div class="col-6 pull-right">
                                                        <input type="text" readonly class="form-control input-no-bg"  value="{{$headstudent['voucher_code']}} (Voucher No)">
                                                    </div>
                                                </div>
                                            @endif
                                           
                                            @if ($headstudent['remaining_balance'] != null && $headstudent['remaining_balance'] != '')
                                                <div class="row nth-bg">
                                                 <div class="col-6">
                                                        <strong>Head Remaining Balance</strong>
                                                    </div>
                                                    <div class="col-6 pull-right">
                                                          <input type="text" readonly class="form-control input-no-bg"  value="Rs {{$headstudent['remaining_balance']}}/-">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($headstudent['remaining_balance_late_fine'] != null && $headstudent['remaining_balance_late_fine'] != '')
                                                <div class="row nth-bg">
                                                    <div class="col-6">
                                                        <strong>Late Fee Fine Remaining Balance</strong>
                                                    </div>
                                                    <div class="col-6 pull-right">
                                                          <input type="text" readonly class="form-control input-no-bg" id="{{$headstudent['id']}}remaining_balance_late_fee_fine" value="Rs {{$headstudent['remaining_balance_late_fine']}}/-">
                                                    </div>
                                                </div>
                                            @endif
                
                                            @if ($headstudent['total_remaining_balance'] != null && $headstudent['total_remaining_balance'] != '')
                                                <div class="row nth-bg">
                                                    <div class="col-6">
                                                        <strong>Total Remaining Balance</strong>
                                                    </div>
                                                    <div class="col-6 pull-right">
                                                          <input type="text" readonly class="form-control input-no-bg" id="{{$headstudent['id']}}total_remaining_balance" value="Rs {{$headstudent['total_remaining_balance']}}/-">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($headstudent['remaining_balance_voucher_id'] != null && $headstudent['remaining_balance_voucher_id'] != '')
                                                <div class="row nth-bg">
                                                    <div class="col-6">
                                                        <strong>Head Voucher No</strong>
                                                    </div>
                                                    <div class="col-6 pull-right">
                                                          <input type="text" readonly class="form-control input-no-bg" id="{{$headstudent['id']}}remaining_balance_voucher_id" value="{{$headstudent['remaining_balance_voucher_id']}} (Voucher No)">
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($headstudent['remaining_balance_paid_date'] != null && $headstudent['remaining_balance_paid_date'] != '')
                                                <div class="row nth-bg">
                                                    <div class="col-6">
                                                        <strong>Payment Date</strong>
                                                    </div>
                                                    <div class="col-6 pull-right">
                                                          <input type="text" readonly class="form-control input-no-bg" id="{{$headstudent['id']}}remaining_balance_paiddate" value="{{$headstudent['remaining_balance_paid_date']!=''?$headstudent['remaining_balance_paid_date']: '--/--/----'}}">
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                            </div>
                        </div>
                     
                    </div>
                </div>
        
                <div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade delivered_model" id="{{$index+1}}delivered" role="dialog" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title mt-0">
                                    Add 
                                    <strong>
                                        Delivered 
                                    </strong>
                                    Date
                                </h5>
                                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                                    X
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('accounts.delivered')}}" class="" method="POST">
                                    @csrf
                                    <div class="form-group">    
                                        <input class="form-control" data-parsley-type="student_head_id" id="student_head_id" name="student_head_id" value="{{$headstudent->id}}" hidden type="text"/>
                                        <label>
                                            Date of Delivery:
                                        </label>
                                        <input class="form-control" data-date-format="YYYY-MM-DD" data-parsley-type="date_of_order_delivered" id="date_of_order_delivered" name="date_of_order_delivered" required="" type="date"/>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary" type="submit">
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

                <div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade create_payment_model" id="head_pay_{{$headstudent['id']}}" role="dialog" tabindex="-1">
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
                                <form action="{{route('accounts.head_paid', $headstudent->id)}}" class="" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-12">
                                                <label>
                                                    Voucher Code:
                                                </label>
                                                <input class="form-control" id="voucher_code" name="voucher_code"  type="text">
                                            </div>
                                            <div class="col-6">
                                                <label>
                                                    Due Date:
                                                </label>
                                                <input class="form-control" data-date-format="YYYY-MM-DD" disabled="disabled" data-parsley-type="due_date" id="{{$headstudent['id']}}due_date" name="due_date" value="{{$headstudent['due_date']}}" type="date"/>
                                            </div>
                                            <div class="col-6">
                                                <label>
                                                    Paid Date:
                                                </label>
                                                <input class="form-control" data-date-format="YYYY-MM-DD" onchange="headFineCalculator('{{ $headstudent['status_id'] }}')" data-parsley-type="paid_date" id="{{$headstudent['id']}}paid_date" name="paid_date" required type="date"/>
                                            </div>
                                            <div class="col-6">
                                                <label>
                                                    Late Fee Fine:
                                                </label>
                                                <input type="text"  class="form-control" name = "lateFine" id="{{$headstudent['id']}}lateFine" value="{{$headstudent['lateFine']}}">
                                            </div>
                                            <div class="col-6">
                                                <label>
                                                    Days for Fine:
                                                </label>
                                                <input type="text"  class="form-control" disabled="disabled" name ="fine_days" id="{{$headstudent['id']}}fine_days" placeholder="Total number of days">
                                            </div>
                                            <div class="col-6">
                                                <label>
                                                    Amount:
                                                </label>
                                                @if ($headstudent['amount_after_discount']==null)
                                                    <input type="text" readonly  name="amount_after_discount" class="form-control" id="{{$headstudent['id']}}amount_after_discount" value="{{$headstudent['status_id']=='2'?$headstudent['remaining_balance']:(!$headstudent->headFine()->get()->isEmpty()?$headstudent->headFine()->get()->first()->amount:0)}}">
                                                @else
                                                <input type="text" readonly  name="amount_after_discount" class="form-control" id="{{$headstudent['id']}}amount_after_discount" value="{{$headstudent['status_id']=='2'?$headstudent['remaining_balance']:$headstudent['amount_after_discount']}}">
                                                @endif
                                            </div>
                                            <div class="col-6">
                                                <label>
                                                  Amount with Fine:
                                                </label>
                                                <input type="text" readonly name="total_amount" class="form-control" id="{{$headstudent['id']}}total_amount">
                                            </div>
                                            <div class="col-6">
                                                <label>
                                                    Paid Amount:
                                                </label>
                                                <input type="number" name="amount_paid" class="form-control" id="{{$headstudent['id']}}amount_paid" onkeyup="calculateRemainingHeadAmount('{{ $headstudent['id'] }}')"> 
                                            </div>
                                            <div class="col-6">
                                                <label>
                                                     Remaning Balance:
                                                </label>
                                                <input type="text" class="form-control" id="{{$headstudent['id']}}remaining_balance2">
                                                <span id="{{$headstudent['id']}}message"></span>
                                            </div>

                                            <input type="hidden" readonly name="carry_forward" class="form-control" id="{{$headstudent['id']}}carry_forward2" >
                                            <input type="hidden" readonly name="is_carry_forward" class="form-control" id="{{$headstudent['id']}}is_carry_forward" value="false" >
                                            <input name="status_id" type="hidden" value="1">
                                            <input name="status_name" type="hidden" value="{{config('constants.payment_statuses')[1]}}">
                                            <input name="headstudent_id" id="paid" type="hidden" value="{{$headstudent['id']}}">
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
       
                <div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade create_paymentH_model" id="{{$headstudent['id']}}" role="dialog" tabindex="-1">
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
                                            <form action="{{route('accounts.head_paid', $headstudent->id)}}" class="" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label>
                                                        Payment Date:
                                                    </label>
                                                    <input class="form-control" data-date-format="YYYY-MM-DD" data-parsley-type="paid_date" id="paid_date" name="paid_date" required="" type="date"/>
                                                    <label>
                                                        Voucher Code:
                                                    </label>
                                                    <input class="form-control p-1 mb-2" id="voucher_code" name="voucher_code" type="text"/>
                                                        <!--  <label>
                                                                    Amount per Installment :
                                                                </label>
                                                                <input  class="form-control p-1 mb-2 bg-light text-dark " id="amount_per_installment" name="amount_per_installment"  type="text"> -->
                                                        <input name="status_id" type="hidden" value="1"/>
                                                        <input name="status_name" type="hidden" value="{{config('constants.payment_statuses')[1]}}"/>
                                                        <input id="head_edit_model" name="id" type="hidden" value=""/>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-primary" type="submit">
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
            
    @else
        No Courses found
    @endif
</div>
@include('accounts.head_fine_model')
