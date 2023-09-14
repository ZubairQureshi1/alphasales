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