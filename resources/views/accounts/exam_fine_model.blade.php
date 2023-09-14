<div aria-hidden="true" aria-labelledby="exam_fine_{{$fine_index+1}}" class="modal fade exam_fine_{{$fine_index+1}}" id="exam_fine_{{$fine_index+1}}" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">
                    Pay For
                    <strong>
                        (Fine - {{$fine_index+1}})
                    </strong>
                </h5>
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('accounts.payExamFine')}}" class="" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <input class="form-control" hidden name="exam_type_id" value="{{ $fine['exam_type_id'] }}" type="text">
                            <input class="form-control" hidden name="exam_fine_id" value="{{$fine['id']}}" type="text">
                            <input class="form-control" hidden name="date_sheet_id"  value="{{ $fine['date_sheet_id'] }}" type="text">
                            <div class="col-12 form-group">
                                <label>
                                    Fine Voucher Code:
                                </label>
                                <input class="form-control" id="{{$fine['id']}}fine_voucher_code" name="fine_voucher_code" type="text">
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
                                    Exam Fine:
                                </label>
                                <input class="form-control" id="{{$fine['id']}}examFine" name="examFine" type="text" value="{{$fine['amount']}}">
                                </input>
                            </div>
                            <div class="col-6 form-group">
                                <label>
                                    Fine Waived By H.A:
                                </label>
                                <input class="form-control" id="{{$fine['id']}}ex_amount_waived" name="ex_amount_waived" onkeyup="examfee_fineWaived('{{$fine['id']}}')" type="text" value="0">
                                </input>
                            </div>
                            <div class="col-6 form-group">
                                <label>
                                    Total Fine:
                                </label>
                                <input class="form-control" id="{{$fine['id']}}ex_TotalFine" name="ex_TotalFine" type="text" value="{{$fine['amount']}}">
                                </input>
                            </div>
                            <div class="col-6 form-group">
                                <label>
                                    Paid Amount:
                                </label>
                                <input class="form-control" id="{{$fine['id']}}amount_paid" name="amount_paid" onkeyup="examfeeFineCalculator('{{$fine['id']}}')" type="number">
                                </input>
                            </div>
                            <div class="col-6 form-group">
                                <label>
                                    Remaning Balance:
                                </label>
                                <input class="form-control" id="{{$fine['id']}}ex_remaining_balance" name="ex_remaining_balance" type="text">
                                </input>
                            </div>
                            <input id="student_id" name="student_id" type="hidden" value="{{$student['id']}}">
                                
                            </input>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="pull-right btn btn-primary" onclick="" type="submit">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
