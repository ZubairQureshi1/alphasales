    <div aria-hidden="true" aria-labelledby="attendance_{{$key}}_fine_{{$fine_index+1}}" class="modal fade attendance_{{$key}}_fine_{{$fine_index+1}}" id="attendance_{{$key}}_fine_{{$fine_index+1}}" role="dialog" tabindex="-1">
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
                <form action="{{route('accounts.payAttendanceFine')}}" class="" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 form-group">
                                <label>
                                    Fine Voucher Code:
                                </label>
                                <input class="form-control" id="{{$node['id']}}fine_voucher_code" name="fine_voucher_code" type="text">
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
                                    Attendance Fee Fine:
                                </label>
                                <input class="form-control" id="{{$node['id']}}attendanceFine" name="attendanceFine" type="text" value="{{$node['amount']}}">
                                </input>
                            </div>
                            <div class="col-6 form-group">
                                <label>
                                    Fine Waived By H.A:
                                </label>
                                <input class="form-control" id="{{$node['id']}}atd_amount_waived" name="atd_amount_waived" onkeyup="attendancefee_fineWaived('{{$node['id']}}')" type="text" value="0">
                                </input>
                            </div>
                            <div class="col-6 form-group">
                                <label>
                                    Total Fine:
                                </label>
                                <input class="form-control" id="{{$node['id']}}atd_TotalFine" name="atd_TotalFine" type="text" value="{{$node['amount']}}">
                                </input>
                            </div>
                            <div class="col-6 form-group">
                                <label>
                                    Paid Amount:
                                </label>
                                <input class="form-control" id="{{$node['id']}}atd_amount_paid" name="amount_paid" onkeyup="attendancefeeFineCalculator('{{$node['id']}}')" type="number">
                                </input>
                            </div>
                            <div class="col-6 form-group">
                                <label>
                                    Remaning Balance:
                                </label>
                                <input class="form-control" id="{{$node['id']}}atd_remaining_balance" name="atd_remaining_balance" type="text">
                                </input>
                            </div>
                            <input id="student_id" name="student_id" type="hidden" value="{{$student['id']}}">
                                <input name="attendance_fine_id" type="hidden" value="{{$node['id']}}">
                                    </input>
                                </input>
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
