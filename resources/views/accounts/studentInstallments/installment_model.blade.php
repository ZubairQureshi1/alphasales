<div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade create_custom_model" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Make <strong>Custom Installments</strong></h5>
                <button aria-hidden="true" class="close text-danger" data-dismiss="modal" type="button">×</button>
            </div>
            <div class="modal-body">
                <form action="{{route('accounts.custom_installment')}}" class="" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Remaining Amount:</label>
                         <input class="form-control p-1 mb-2 bg-light text-dark " id="net_total" name="net_total" readonly="" type="text" value="{{ $fee_package->total_package - $fee_instalments->sum('amount_per_installment') }}">
                     </div>
                    <div class="form-group">
                        <label>Installment Due Date:</label>
                        <input class="form-control" data-date-format="YYYY-MM-DD" data-parsley-type="due_date" id="due_date" name="due_date" min="{{ $fee_package->student->admission_date }}" type="date" required/>
                    </div>
                    <div class="form-group">
                        <label>Amount/Installment:</label>
                        <input class="form-control p-1 mb-2 bg-light text-dark" type="number" id="amount_per_installment" name="amount_per_installment" min="0" max="{{ $fee_package->total_package - $fee_instalments->sum('amount_per_installment') }}" required/>
                        <div class="help-block">Amount must be between 0 to <b>{{ $fee_package->total_package - $fee_instalments->sum('amount_per_installment') }}</b></div>
                        <input name="package_id" type="hidden" value="{{$fee_package['id']}}">
                        <input name="student_id" type="hidden" value="{{$student['id']}}">
                        <input name="status_id" type="hidden" value="0">
                        <input name="status_name" type="hidden" value="{{config('constants.payment_statuses')[0]}}">
                    </div>
                    <div class="mt-4 text-right">
                        <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-cloud-upload fa-fw"></i> <b>|</b> Make Installment</button>
                        <button class="btn btn-default btn-sm" data-dismiss="modal" type="button">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
