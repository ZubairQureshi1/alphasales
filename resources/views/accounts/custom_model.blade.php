<div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade create_custom_model" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">
                    Make
                    <strong>
                      Custom Installments
                    </strong>
                </h5>
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('accounts.custom_installment')}}" class="" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>
                          Remaining Amount:
                        </label>
                         <input class="form-control p-1 mb-2 bg-light text-dark " id="net_total" name="net_total" readonly="" type="text" value="{{$amount_for_installment}}">
                        <label>
                            Instalment Due Date:
                        </label>
                        <input class="form-control" data-date-format="YYYY-MM-DD" data-parsley-type="due_date" id="due_date" name="due_date" required="" type="date"/>
                          <!--   <label>
                            Voucher Code :
                        </label>
                        <input  class="form-control p-1 mb-2 bg-light text-dark " id="voucher_code" name="voucher_code"  type="text"> -->
                        <label>
                            Amount/Installment:
                        </label>
                        <input  class="form-control p-1 mb-2 bg-light text-dark " id="amount_per_installment" name="amount_per_installment"  type="text">
                        <input name="package_id" type="hidden" value="{{$fee_package['id']}}">
                        <input name="student_id" type="hidden" value="{{$student['id']}}">
                        <input name="status_id" type="hidden" value="0">
                        <input name="status_name" type="hidden" value="{{config('constants.payment_statuses')[0]}}">
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
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
