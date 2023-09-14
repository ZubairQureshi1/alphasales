<div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade create_payment_model" id="{{$instalment['id']}}" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title mt-0">Make <strong>Payment</strong></h5>
        <button aria-hidden="true" class="close text-danger" data-dismiss="modal" type="button">×</button>
      </div>
      <div class="modal-body">
        <form action="{{route('accounts.instalmentPayment', $instalment['id'])}}" method="POST">
          @csrf
          <div class="form-row">
            <div class="form-group col-12">
              <label>Instalment Voucher Code:</label>
              <input class="form-control" id="voucher_code" name="voucher_code" placeholder="Enter Voucher Code" type="text" required />
            </div>
            <div class="form-group col-6">
              <label>Due Date:</label>  
              <input class="form-control" data-date-format="YYYY-MM-DD" disabled="disabled" data-parsley-type="due_date" id="{{$instalment['id']}}due_date" name="due_date" value="{{$instalment['due_date']}}" type="date"/>
            </div>
            <div class="form-group col-6">
              <label>Paid Date:</label>
              <input class="form-control" data-date-format="YYYY-MM-DD" onchange="fineCalculator()" max="{{ date('Y-m-d') }}" data-parsley-type="paid_date" id="{{$instalment['id']}}paid_date" name="paid_date" type="date" required/>
            </div>
            <div class="form-group col-6">
              <label>Amount per Installment:</label>
              <input type="text" readonly name="amount_per_installment" class="form-control" id="{{$instalment['id']}}amount_per_installment" value="{{ $instalment['status_id']=='2'?$instalment['remaining_balance']:$instalment['amount_per_installment'] }}">
            </div>
            <div class="form-group col-6">
              <label>Paid Amount:</label>
              <input type="number" name="amount_paid" class="form-control" id="{{$instalment['id']}}amount_paid" min="{{ $instalment['status_id']=='2'?$instalment['remaining_balance']:$instalment['amount_per_installment'] }}" max="{{ $instalment['status_id']=='2'?$instalment['remaining_balance']:$instalment['amount_per_installment'] }}" required>
            </div>
          </div>
          <div class="text-right mt-3 mb-2">
            <button class="btn btn-primary btn-sm rounded-0" type="submit"><i class="fa fa-money fa-fw"></i> <b>|</b> Make Payment</button>
            <button class="btn btn-defualt btn-sm rounded-0" data-dismiss="modal" type="button">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>