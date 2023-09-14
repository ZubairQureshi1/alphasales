<div aria-hidden="true" aria-labelledby="installment_{{$index+1}}_fine_{{$fine_index+1}}" class="modal fade installment_{{$index+1}}_fine_{{$fine_index+1}}" id="installment_{{$index+1}}_fine_{{$fine_index+1}}" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">
                    Pay For
                    <strong>
                        (Installment No - {{$index+1}} - Fine - {{$fine_index+1}})
                    </strong>
                </h5>
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('accounts.pay_fine')}}" class="" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            {!! Form::text('fee_fine_id', $fee_fine['id'], ['class' => 'form-control', 'hidden'=>'hidden']) !!}

                            <div class="col-12 form-group">
                                <label>
                                    Fine Voucher Code:
                                </label>
                                <input class="form-control" id="fine_voucher_code" name="fine_voucher_code" type="text">
                                </input>
                            </div>
                            <div class="col-6 form-group">
                                <label>
                                    Paid Date:
                                </label>
                                <input class="form-control" data-date-format="YYYY-MM-DD" data-parsley-type="paid_date" id="paid_date" name="paid_date" onchange="" required="" type="date"/>
                            </div>
                            <div class="col-6 form-group">
                                <label>
                                    Late Fee Fine:
                                </label>
                                <input class="form-control" id="{{$fee_fine['id']}}lateFeeFine" name="lateFeeFine" type="text" value="{{$fee_fine['amount']}}">
                                </input>
                            </div>
                            <div class="col-6 form-group">
                                <label>
                                    Fine Waived By H.A:
                                </label>
                                <input class="form-control" id="{{$fee_fine['id']}}amount_waived" max="{{ $fee_fine['amount']}}" name="amount_waived" onkeyup="fee_fineWaived('{{$fee_fine['id']}}')" type="text" value="0">
                                </input>
                            </div>
                            <div class="col-6 form-group">
                                <label>
                                    Total Fine:
                                </label>
                                <input class="form-control" id="{{$fee_fine['id']}}TotalFine" name="TotalFine" type="text" value="{{$fee_fine['amount']}}">
                                </input>
                            </div>
                            <div class="col-6 form-group">
                                <label>
                                    Paid Amount:
                                </label>
                                <input class="form-control" id="{{$fee_fine['id']}}amount_paid" name="amount_paid" onkeyup="feeFineCalculator('{{$fee_fine['id']}}')" type="number">
                                </input>
                            </div>
                            <div class="col-6 form-group">
                                <label>
                                    Remaning Balance:
                                </label>
                                <input class="form-control" id="{{$fee_fine['id']}}remaining_balance" name="remaining_balance" type="text">
                                </input>
                            </div>
                            <input name="installment_id" type="hidden" value="{{$instalment['id']}}">
                            </input>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="pull-right btn btn-primary" onclick="" type="submit">
                            Save
                        </button>
                        <div class="clearfix">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
