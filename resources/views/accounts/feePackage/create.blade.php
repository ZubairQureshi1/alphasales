<table class="table table-bordered">
    <thead class="thead-light">
        <tr>
            <th colspan="2" class="text-center">Student Accounts</th>
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
                                <input type="number" onkeypress="return numericOnly(event)" onkeyup="validateNumberByMin(event)" class="form-control text-right admission-has-sum" id="cfe_admission_fee" onchange="" min="0" max="99999" required value="0" name="cfe_admission_fee" placeholder=""/>
                            </td>
                        </tr>
                        <tr class="padding-0">
                            <td>Marketer Incentive</td>
                            <td>
                                <input type="number" onkeypress="return numericOnly(event)" onkeyup="validateNumberByMin(event)" class="form-control text-right admission-has-sum" id="marketer_incentive" onchange="" min="0" max="99999" required value="0" name="marketer_incentive" placeholder=""/>
                            </td>
                        </tr>
                        <tr class="padding-0">
                            <td>Affiliated Body Registration Fee</td>
                            <td>
                                <input type="number" onkeypress="return numericOnly(event)" onkeyup="validateNumberByMin(event)" class="form-control text-right admission-has-sum" id="registration_fee" onchange="" min="0" max="9999999" required value="0" name="registration_fee" placeholder=""/>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot class="table-footer-light">
                        <tr>
                            <td><strong>Total</strong></td>
                            <td>
                                <input class="form-control fee text-right" id="total_admission_registration_fee" name="total_admission_registration_fee" required="" value="0" type="number" onkeypress="return numericOnly(event)" onkeyup="validateNumberByMin(event)" readonly="readonly">
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Voucher Number</strong></td>
                            <td>
                                <input class="form-control fee text-right" id="admission_registration_voucher_code" name="admission_registration_voucher_code" required="" type="text" onkeypress="return numericOnly(event)" onkeyup="validateNumberByMin(event)">
                            </td>
                        </tr>
                        <tr>
                            <td>Paid Date</td>
                            <td>
                                <input class="form-control p-1 mb-2 bg-light text-dark fee" data-date-format="YYYY-MM-DD" id="admission_registration_paid_date" name="admission_registration_paid_date" required="" type="date">
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
                                <input class="form-control text-right" id="tuition_fee" name="tuition_fee" readonly="readonly" value="0" required type="number" onkeypress="return numericOnly(event)" onkeyup="validateNumberByMin(event)">
                            </td>
                        </tr>
                        <tr class="padding-0">
                            <td>
                                Discount Status
                            </td>
                            <td>
                                {!! Form::select('discount_status_id', array_slice(config('constants.discount_statuses'), 21, isset($pwwb) ? 24 : 23), null, ['id' => 'discount_status_id', 'class' => 'form-control select2-multiple', 'placeholder' => 'Select Scholarship','name' => 'discount_status_id' , 'required']) !!}
                            </td>
                        </tr> 
                        <tr class="padding-0">
                            <td>
                                Discount (In Rupee)
                            </td>
                            <td>
                                <input class="form-control text-right" value="0" id="discount" name="discount" required="" type="number" onkeypress="return numericOnly(event)" min="0" onkeyup="validateNumberByMin(event)" placeholder="Discount (In Rupee)">
                            </td>
                        </tr>  
                        <tr class="padding-0">
                            <td>
                                Discount (In Percentage)
                            </td>
                            <td>
                                <div class="input-group">
                                    <input class="form-control text-right" value="0" min="0" max="100" id="discount_percentage" name="discount_percentage" required="" type="number" onkeypress="return numericOnly(event)" onkeyup="validateNumberByMin(event)" placeholder="Discount (In Percentage)" >
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
                                <input class="form-control text-right has-sum" id="net_tuition_fee" value="0" name="net_tuition_fee" readonly="" required="" type="number" onkeypress="return numericOnly(event)" onkeyup="validateNumberByMin(event)">
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
                                <input type="number" onkeypress="return numericOnly(event)" onkeyup="validateNumberByMin(event)" class="form-control text-right transport-has-multiplies" id="transport_month_count" onchange="" min="0" max="99999" required value="0" name="transport_month_count" placeholder="" />
                            </td>
                            <td width="35%">
                                <label>Amount per Month</label>
                                <input type="number" onkeypress="return numericOnly(event)" onkeyup="validateNumberByMin(event)" class="form-control text-right transport-has-multiplies" id="transport_monthly_amount" onchange="" min="0" max="99999" required value="0" name="transport_monthly_amount" placeholder="" />
                            </td>
                        </tr>
                    </tbody>
                    <tfoot class="table-footer-light">
                        <tr>
                            <td><strong>Total</strong><br><span class="text-danger">(No. of Months x Amount per Month)</span></td>
                            <td>
                                <input type="number" onkeypress="return numericOnly(event)" onkeyup="validateNumberByMin(event)" class="form-control text-right has-sum" min="0" max="99999" value="0" required name="total_transport_charges" readonly="readonly" id="total_transport_charges" placeholder=""/>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </td>
        </tr>
        <tr>
            <td>Stationery/ Miscellaneous</td>
            <td>
                <input type="number" onkeypress="return numericOnly(event)" onkeyup="validateNumberByMin(event)" class="form-control text-right has-sum" min="0" max="99999" value="0" required name="miscellaneous_charges" id="miscellaneous_charges" placeholder=""/>
            </td>
        </tr> 
        <tr>
            <td>Others</td>
            <td>
                <div class="text-right">
                    <button class="btn btn-dark btn-sm" onclick="otherFeeCharges(event)"><i class="fa fa-plus fa-fw"></i><b>|</b> Add Other Charges</button>
                </div>
                <div class="mt-3" id="otherChargesDiv"></div>
                <div class="row">
                    <div class="col-md-6 my-auto">
                        <strong>Total Other Charges</strong>
                    </div>
                    <div class="col-md-6">
                        <input class="form-control text-right has-sum" id="total_other_charges" value="0" name="total_other_charges" readonly type="number">
                    </div>
                </div>
            </td>
        </tr>     
    </tbody>
    <tfoot class="table-footer-light">
        <tr class="">
            <td><strong>Total Package</strong></td>
            <td>
                <input class="form-control text-right" id="total_package" name="total_package" readonly="" required="" type="number" onkeypress="return numericOnly(event)" onkeyup="validateNumberByMin(event)" value="0">
            </td>
        </tr>
        <tr class="">
            <td>Payment Type</td>
            <td>
                {!! Form::select('fee_structure_type_id', config('constants.fee_structure_types'), null, ['id' => 'fee_structure_type_id', 'class' => 'form-control select2-multiple', 'placeholder' => 'Select Type', 'required', 'onchange' => 'showHideDueDateOrInstallment()',] ) !!}
            </td>
        </tr>
        <tr id="due_date_div" hidden="hidden">
            <td>Due Date</td>
            <td>
                <input class="form-control p-1 mb-2 bg-light text-dark fee" data-date-format="YYYY-MM-DD" id="due_date" name="due_date" value="{{ date('Y-m-d') }}" required="" type="date">
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
                        <input type="number" onkeypress="return numericOnly(event)" onkeyup="validateNumberByMin(event)" required class="form-control" name="installment_count" id="installment_count">
                    </div>
                    <div id="view_books_div" class="element-flex-end col-3">
                        <button type="button" class="btn btn-secondary waves-effect waves-light pull-right" onclick="generateInstallmentRows()" id="generate_installments_rows">Create Installment Rows</button>
                    </div>
                </div>
                <div id="installment_rows">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="">
    @can('create_fee_package')
    <a class="btn btn-light active btn-sm" href="{{ route('admissions.index') }}"><i class="fa fa-remove fa-fw text-danger"></i> Cancel</a>
    <button type="button" onclick="requestStudentEnrollement()" class="btn btn-dark btn-sm"><i class="fa fa-money"></i> | Save Admission</button>
    @endcan
</div>
