{!! Form::model($fee_package, ['route' => ['accounts.updateFeePackage', $fee_package->id], 'method' => 'post']) !!}
    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th colspan="2" class="">Student Accounts
                    <div class="pull-right">
                        @can(['update_fee_package', 'create_fee_package'])
                            @if($fee_package->fee_structure_type_id == 0 && $fee_package->status_id == 0)
                                <button class="btn btn-sm btn-primary rounded-0" type="button" data-toggle="modal" data-target="#myModal">
                                    <i class="fa fa-money fa-fw"></i> | Fee Package Payment
                                </button>
                            {{-- @elseif($fee_package->fee_structure_type_id == 0 && $fee_package->status_id == 1 && $fee_package->is_verified == 0)
                                <a href="{{ route('accounts.verifyFeePackagePayment', $fee_package->id) }}" class="btn btn-sm btn-primary rounded-0">
                                    <i class="fa fa-money fa-fw"></i> | Verify Payment
                                </a> --}}
                            @endif
                        @endcan
                        @can('update_fee_package')
                            <button class="btn btn-sm btn-outline-dark rounded-0" type="button" onclick="editPackage()"><i class="mdi mdi-pencil"></i> | Edit Fee Package</button>
                        @endcan
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="padding-0">
                <td><strong>Admission/ Registration Fee</strong></td>
                <td>
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th colspan="2" class="text-right">Rs.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="padding-0">
                                <td>CFE Admission Fee</td>
                                <td>
                                    <input type="number" onkeypress="return numericOnly(event)" disabled onkeyup="validateNumberByMin(event)" class="form-control text-right admission-has-sum" id="cfe_admission_fee" onchange="" min="0" max="99999" value="{{ $fee_package->cfe_admission_fee }}" name="cfe_admission_fee" value="{{ old('cfe_admission_fee') }}"/>
                                </td>
                            </tr>
                            <tr class="padding-0">
                                <td>Marketer Incentive</td>
                                <td>
                                    <input type="number" onkeypress="return numericOnly(event)" disabled onkeyup="validateNumberByMin(event)" class="form-control text-right admission-has-sum" id="marketer_incentive" onchange="" min="0" max="99999" value="{{ $fee_package->marketer_incentive }}" name="marketer_incentive" value="{{ old('marketer_incentive') }}"/>
                                </td>
                            </tr>
                            <tr class="padding-0">
                                <td>Registration Fee</td>
                                <td>
                                    <input type="number" onkeypress="return numericOnly(event)" disabled onkeyup="validateNumberByMin(event)" class="form-control text-right admission-has-sum" id="registration_fee" onchange="" min="0" max="9999999" value="{{ $fee_package->registration_fee }}" name="registration_fee" value="{{ old('registration_fee') }}"/>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot class="table-footer-light">
                            <tr>
                                <td><strong>Total</strong></td>
                                <td>
                                    <input class="form-control fee text-right" id="total_admission_registration_fee" name="total_admission_registration_fee" value="{{ $fee_package->total_admission_registration_fee }}" type="number" onkeypress="return numericOnly(event)" onkeyup="validateNumberByMin(event)" disabled="true">
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Voucher Number</strong></td>
                                <td>
                                    <input class="form-control text-right" id="admission_registration_voucher_code" disabled name="admission_registration_voucher_code" value="{{ $fee_package->admission_registration_voucher_code }}" type="text" onkeypress="return numericOnly(event)" onkeyup="validateNumberByMin(event)" value="{{ old('admission_registration_voucher_code') }}">
                                </td>
                            </tr>
                            <tr>
                                <td>Paid Date</td>
                                <td>
                                    <input class="form-control text-right" data-date-format="YYYY-MM-DD" disabled id="admission_registration_paid_date" value="{{ $fee_package->admission_registration_paid_date }}" name="admission_registration_paid_date" type="date" value="{{ old('admission_registration_paid_date') }}">
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </td>
            </tr> 
            <tr class="padding-0">
                <td>
                    <strong>Tuition Fee</strong>
                </td>
                <td>
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th colspan="2" class="text-right">Rs.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="padding-0">
                                <td>Tuition Fee</td>
                                <td>
                                    <input class="form-control text-right" id="tuition_fee" disabled name="tuition_fee" disabled="true" value="{{ $fee_package->tuition_fee }}" type="number" onkeypress="return numericOnly(event)" onkeyup="validateNumberByMin(event)" value="{{ old('tuition_fee') }}">
                                </td>
                            </tr>
                            <tr class="padding-0">
                                <td>
                                    Discount Status
                                </td>
                                <td>
                                    {!! Form::select('discount_status_id', array_slice(config('constants.discount_statuses'), 21, 23, true), $fee_package->discount_status_id, ['id' => 'discount_status_id', 'class' => 'form-control select2-multiple '.($fee_package->fee_structure_type_id == 0 ? "editable" : ""), 'placeholder' => 'Select Scholarship','name' => 'discount_status_id'  , 'disabled',]) !!}
                                </td>
                            </tr> 
                            <tr class="padding-0">
                                <td>
                                    Discount (In Rupee)
                                </td>
                                <td>
                                    <input class="form-control text-right {{ $fee_package->fee_structure_type_id == 0 ? "editable" : "" }}" disabled value="{{ $fee_package->discount }}" id="discount" name="discount" type="number" onkeypress="return numericOnly(event)" min="0" onkeyup="validateNumberByMin(event)" placeholder="Discount (In Rupee)" value="{{ old('discount') }}">
                                </td>
                            </tr>  
                            <tr class="padding-0">
                                <td>
                                    Discount (In Percentage)
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input class="form-control text-right {{ $fee_package->fee_structure_type_id == 0 ? "editable" : "" }}" disabled value="{{ $fee_package->discount_percentage }}" step=".01" min="0" max="100" id="discount_percentage" name="discount_percentage" type="number" onkeypress="return numericOnly(event)" onkeyup="validateNumberByMin(event)" placeholder="Discount (In Percentage)" value="{{ old('discount_percentage') }}">
                                        <div class='input-group-append'>
                                            <span class='input-group-text'>%</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>  
                        </tbody>
                        <tfoot class="table-footer-light">
                            <tr>
                                <td><strong>Net Tuition Fee</strong></td>
                                <td>
                                    <input class="form-control text-right has-sum" id="net_tuition_fee" value="{{ $fee_package->net_tuition_fee }}" name="net_tuition_fee" readonly="readonly" type="number" onkeypress="return numericOnly(event)" onkeyup="validateNumberByMin(event)">
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </td>
            </tr>

            <tr id="transport_charges_row" hidden="true">
                <td>Transport Charges</td>
                <td>
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th colspan="2" class="text-right">Rs.</th>
                            </tr>
                        </thead>
                        <tbody> 
                            <tr class="padding-0">
                                <td width="35%">
                                    <label>No. of Months</label>
                                    <input type="number" onkeypress="return numericOnly(event)" onkeyup="validateNumberByMin(event)" class="form-control text-right transport-has-multiplies {{ $fee_package->fee_structure_type_id == 0 ? "editable" : "" }}" disabled="true" id="transport_month_count" onchange="" min="0" max="99999" value="{{ $fee_package->transport_month_count }}" name="transport_month_count" value="{{ old('transport_month_count') }}"/>
                                </td>
                                <td width="35%">
                                    <label>Amount per Month</label>
                                    <input type="number" onkeypress="return numericOnly(event)" onkeyup="validateNumberByMin(event)" class="form-control text-right transport-has-multiplies {{ $fee_package->fee_structure_type_id == 0 ? "editable" : "" }}" disabled="true" id="transport_monthly_amount" onchange="" min="0" max="99999" value="{{ $fee_package->transport_monthly_amount }}" name="transport_monthly_amount" value="{{ old('transport_monthly_amount') }}"/>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot class="table-footer-light">
                            <tr>
                                <td><strong>Total</strong><br><span class="text-danger">(No. of Months x Amount per Month)</span></td>
                                <td>
                                    <input type="number" onkeypress="return numericOnly(event)" onkeyup="validateNumberByMin(event)" class="form-control text-right has-sum" min="0" max="99999" readonly="true" value="{{ $fee_package->total_transport_charges }}" name="total_transport_charges" id="total_transport_charges" placeholder=""/>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </td>
            </tr>
            <tr>
                <td>Stationary/ Miscellaneous</td>
                <td>
                    <input type="number" onkeypress="return numericOnly(event)" onkeyup="validateNumberByMin(event)" class="form-control text-right has-sum {{ $fee_package->fee_structure_type_id == 0 ? "editable" : "" }}" min="0" max="99999" disabled="true" value="{{ $fee_package->miscellaneous_charges }}" name="miscellaneous_charges" id="miscellaneous_charges" value="{{ old('miscellaneous_charges') }}"/>
                </td>
            </tr> 
            <tr>
                <td>Others</td>
                <td>
                    <div class="text-right">
                        <button class="btn btn-dark btn-sm editable-other-charges-button" onclick="otherFeeCharges(event)" hidden="true">
                            <i class="fa fa-plus fa-fw"></i> <b>|</b> Add Other Charges
                        </button>
                    </div>
                    <div class="mt-3" id="otherChargesDiv">
                        @foreach($fee_package->feeOtherCharges as $key => $feeOtherCharge)
                        <div class="form-row div-border p-2 mb-2" id="otherCharge_{{ $key }}">
                            <div class="form-group col-6 text-left">
                                <label>Reason</label>
                                <input type="text" class="form-control" id="otherFeeChargeReason_{{ $key }}" name="other_fee_charges_reasons[]" placeholder="Enter Reason" value="{{ $feeOtherCharge->reason }}" disabled="true" />
                            </div>
                            <div class="form-group col-5">
                                <label>Amount</label>
                                <input type="number" onkeypress="return numericOnly(event)" onkeyup="validateNumberByMin(event)" id="otherFeeChargeAmount_{{ $key }}" class="form-control text-right has-other-charges-sum" min="0" max="99999" value="{{ $feeOtherCharge->amount }}" required name="other_fee_charges_amounts[]" disabled="true"/>
                            </div>
                            <div class="form-group my-auto pt-2">
                                <button type="button" class="btn btn-outline-danger btn-sm editable-other-charges-button" data-toggle="tooltip"
                                        onclick="deleteOtherFeePackageCharges({{ $feeOtherCharge->id }})" 
                                        @if(optional($feeOtherCharge->feeInstallment)->status_id == 1)
                                        title="Charges Already Paid So, other charges cannot be removed!"
                                        disabled="true" 
                                        @endif
                                        hidden="true">
                                    <i class="fa fa-times fa-fw"></i>
                                </button>
                            </div>
                        </div>
                        @endforeach                        
                    </div>
                    <div class="row">
                        <div class="col-md-6 my-auto">
                            <strong>Total Other Charges</strong>
                        </div>
                        <div class="col-md-6">
                            <input class="form-control text-right has-sum" id="total_other_charges" value="{{ $fee_package->feeOtherCharges->sum('amount') }}" readonly type="number">
                        </div>
                    </div>
                </td>
            </tr>     
        </tbody>
        <tfoot class="table-footer-light">
            <tr class="">
                <td><strong>Total Package @if(($fee_package->fee_structure_type_id == 0 && $fee_package->status_id == 1)) <span class="badge badge-success"><i class="fa fa-check fa-fw"></i> Fee Package Paid</span> @endif</strong></td>
                <td>
                    <input class="form-control text-right" id="total_package" name="total_package" readonly="true" type="number" onkeypress="return numericOnly(event)" onkeyup="validateNumberByMin(event)" value="{{ $fee_package->total_package }}">
                </td>
            </tr>
            <tr>
                <td>Payment Type</td>
                <td>
                    {!! Form::select('fee_structure_type_id', config('constants.fee_structure_types'), $fee_package->fee_structure_type_id, ['id' => 'fee_structure_type_id', 'class' => 'form-control select2-multiple '.($fee_package->fee_structure_type_id == 1 && $fee_package->status_id == 0 ? '' : 'editable') , 'placeholder' => 'Select Type', 'onchange' => 'showHideDueDateOrInstallment()', 'disabled'] ) !!}
                </td>
            </tr>

            <tr id="due_date_div" hidden="hidden">
                <td>Due Date</td>
                <td>
                    <input class="form-control editable" data-date-format="YYYY-MM-DD" id="due_date" name="due_date" value="{{ $fee_package->due_date }}" disabled="true" type="date">
                </td>
            </tr>
        </tfoot>
    </table>
    <div class="m-b-10" id="installment_div" hidden="hidden">
        <strong>Installment Plan and Creation:</strong>
        <div class="m-t-10 div-border-rad" style="">
            <div class="margin-10">
                <div class="form-group">
                    <div class="row" id="course_div">
                        <div class="col-3">
                            <input type="number" onkeypress="return numericOnly(event)" onkeyup="validateNumberByMin(event)" class="form-control" name="installment_count" id="installment_count">
                        </div>
                        <div id="view_books_div" class="element-flex-end col-6">
                            <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light mr-2" onclick="generateInstallmentRows()" id="generate_installments_rows">
                                <i class="fa fa-plus fa-fw"></i> | Create Installment Rows
                            </button> 
                            <span class="text-danger">(Click here again if you update any value while generating installments)</span>

                        </div>
                    </div>
                    <div id="installment_rows">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="" id="save_div" hidden="true">
        <a href="{!! url()->current() !!}" class="btn btn-light mr-1"><i class="fa fa-times fa-fw text-danger"></i> Cancel</a>
        <button class="btn btn-dark btn-sm"><i class="typcn typcn-cloud-storage fa-lg fa-fw"></i> <b>|</b> Save Changes</button>
    </div>
    <input type="text" hidden name="student_id" value="{{ $fee_package->student_id }}">
    <input type="text" hidden name="academic_history_id" value="{{ $fee_package->academic_history_id }}">
{!! Form::close() !!}


{{-- FEE PACKAGE PAYMENT --}}
<div class="modal fade" id="myModal">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header px-3 py-1">
        <h5 class="modal-title">Fee Package Payment</h5>
        <button type="button" class="close pt-4 text-danger" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="{{ route('accounts.payFeePackage', $fee_package->id) }}" method="post">
            @csrf
            <div class="form-row">
                {{-- Voucher Code --}}
                <div class="col-12 form-group">
                    <label>Voucher Code</label>
                    <input type="text" name="voucher_code" class="form-control" placeholder="Enter Voucher Code" required>
                </div>
                {{-- Due Date --}}
                <div class="col-6 form-group">
                    <label>Due Date</label>
                    <input type="date" class="form-control" value="{{ $fee_package->due_date }}" disabled>
                </div>
                {{-- Paid Date --}}
                <div class="col-6 form-group">
                    <label>Paid Date</label>
                    <input type="date" name="paid_date" class="form-control" max="{{ Date('Y-m-d') }}" value="{{ Date('Y-m-d') }}" required>
                </div>
                {{-- Submit --}}
                <div class="col-12">
                    <button type="button" class="btn btn-light active btn-sm rounded-0 mr-1" data-dismiss="modal"><i class="fa fa-remove fa-fw text-danger"></i> Cancel</button>
                    <button class="btn btn-primary btn-sm rounded-0" type="submit"><i class="fa fa-cloud-upload fa-fw"></i> | Make Payment</button>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>