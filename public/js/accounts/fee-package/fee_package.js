$(document).ready(function() {
    onTransportSelect();
    $('.transport-has-multiplies').change();
});
$('#discount').change(function() {
    var discount = document.getElementById("discount").value;
    var tuition = document.getElementById("tuition_fee").value;
    var net = (tuition - discount);
    var percent = (discount / tuition) * 100;
    var package = net;
    document.getElementById("net_tuition_fee").value = net;
    document.getElementById("discount_percentage").value = percent.toFixed(1)
    $('.has-sum').change();
});
$('#discount_status_id').change(function() {
    var discount_status = document.getElementById('discount_status_id').value;
    if (discount_status == 3) {
        document.getElementById('cfe_admission_fee').value = 0;
        document.getElementById('registration_fee').value = 0;
        document.getElementById('total_admission_registration_fee').value = 0;
        document.getElementById('tuition_fee').value = 0;
        document.getElementById('miscellaneous_charges').value = 0;
        document.getElementById('net_tuition_fee').value = 0;
        alertify.success("Dual Degree Applied Successfully!");
    }
    // update
    $('.has-sum').change();
    $('.admission-has-sum').change();
});
$('#discount_percentage').change(function() {
    var discount_percentage = document.getElementById("discount_percentage").value;
    var tuition = document.getElementById("tuition_fee").value;
    var amount_after_discount = (discount_percentage / 100) * tuition;
    var net = (tuition - amount_after_discount);
    var package = net;
    document.getElementById("net_tuition_fee").value = net;
    document.getElementById("discount").value = amount_after_discount;
    $('.has-sum').change();
});
$('.admission-has-sum').change(function() {
    var fields = document.getElementsByClassName('admission-has-sum');
    var total_admission_fee = 0;
    $.each(fields, function(i, field) {
        total_admission_fee = parseInt(total_admission_fee) + parseInt(field.value);
    });
    document.getElementById("total_admission_registration_fee").value = total_admission_fee;
    $('.has-sum').change();
});
$('.transport-has-multiplies').change(function() {
    var no_of_months = document.getElementById("transport_month_count").value;
    var transport_monthly_amount = document.getElementById("transport_monthly_amount").value;
    document.getElementById("total_transport_charges").value = no_of_months * transport_monthly_amount;
    $('.has-sum').change();
});
// Change event on selecting Payment Type
function showHideDueDateOrInstallment() {
    var fee_structure_type_id = document.getElementById('fee_structure_type_id').value;
    if (fee_structure_type_id == 0) {
        document.getElementById('due_date_div').hidden = false;
        document.getElementById('installment_div').hidden = true;
    } else {
        document.getElementById('installment_div').hidden = false;
        document.getElementById('due_date_div').hidden = true;
    }
}
// Other Fee Charges
function otherFeeCharges(event) {
    event.preventDefault();
    let field = '';
    field += '<div class="form-row div-border p-2 mb-2" id="otherCharge_' + other_count + '">';
    field += '<div class="form-group col-6 text-left">';
    field += '<label>Reason</label>';
    field += '<input type="text" class="form-control editable-other-charges" id="otherFeeChargeReason_' + other_count + '" name="other_fee_charges_reasons[]" placeholder="Enter Reason" required>';
    field += '</div>';
    field += '<div class="form-group col-5">';
    field += '<label>Amount</label>';
    field += '<input type="number" onkeypress="return numericOnly(event)" onkeyup="validateNumberByMin(event)" id="otherFeeChargeAmount_' + other_count + '" class="form-control text-right has-other-charges-sum editable-other-charges" min="0" max="99999" row_count="' + other_count + '" value="0" required name="other_fee_charges_amounts[]" required/>';
    field += '</div>';
    field += '<div class="form-group my-auto pt-2"><button class="btn btn-outline-danger btn-sm editable-other-charges" onclick="removeOtherFeeCharges(' + other_count + ')"><i class="fa fa-times fa-fw"></i></button></div>';
    field += '</div>';
    $('#otherChargesDiv').append(field);
    other_count++;
}
// Remove Other Fee Charges 
function removeOtherFeeCharges(count) {
    event.preventDefault();
    $('#otherFeeChargeAmount_' + count).prop('hidden', true);
    document.getElementById("total_other_charges").value = parseInt(document.getElementById("total_other_charges").value) - parseInt($('#otherFeeChargeAmount_' + count).val());
    $('#otherCharge_' + count).remove();
    $('.has-sum').change();
    // $('#otherCharge_'+count).prop('hidden', true);
}
// Remove Other Fee Charges IN EDIT  
function removeOtherFeeChargesOnEdit(count) {
    event.preventDefault();
    $('#otherFeeChargeAmount_' + count).val(0);
    $('#otherCharge_' + count).prop('hidden', true);
    $('#otherCharge_' + count).prop('hidden', true);
    // $('#otherCharge_'+count).prop('hidden', true);
    $('.has-other-charges-sum').change();
}
var total_fee_while_installment_generation = 0;
// Generating installment rows
function generateInstallmentRows() {
    if (document.getElementById('admission_registration_voucher_code').value != "" && document.getElementById("admission_registration_paid_date").value != "") {
        if (document.getElementById('installment_count').value != '') {
            $('#installment_rows').html('');
            var no_of_installments = document.getElementById('installment_count').value;
            var admission_registration_paid_date = document.getElementById('admission_registration_paid_date').value;
            var admission_registration_paid_date_object = new Date(admission_registration_paid_date);
            var total_fee = document.getElementById("total_package").value;
            this.total_fee_while_installment_generation = total_fee;
            var per_installment_amount = Number((total_fee / no_of_installments).toFixed(0));
            var calculated_total_fee = per_installment_amount * no_of_installments;
            var difference = total_fee - calculated_total_fee;
            var adjusted_total_fee = per_installment_amount + difference;
            for (var i = 0; i < document.getElementById('installment_count').value; i++) {
                if (no_of_installments == i + 1) {
                    per_installment_amount = adjusted_total_fee;
                }
                admission_registration_paid_date_object.setMonth(admission_registration_paid_date_object.getMonth() + 1)
                admission_registration_paid_date_object.setDate(10);
                var add_row = "<div class='row margin-top-10'>";
                add_row += "<div class='col-3'>";
                add_row += "<strong>Installment No. " + (i + 1) + "</strong>";
                add_row += "</div>";
                add_row += "<div class='col-3'>";
                add_row += "<input class='form-control text-right' type='number' onchange='installmentsAdjustment()' required name='amount_per_installment[]' value='" + per_installment_amount + "' id='amount_per_installment-" + i + "' />";
                add_row += "</div>";
                add_row += "<div class='col-3'>";
                add_row += "<input class='form-control text-right' value='" + admission_registration_paid_date_object.toISOString().slice(0, 10) + "' data-date-format='YYYY-MM-DD' required type='date' min='" + admission_registration_paid_date + "' name='installment_due_date[]' id='installment_due_date_" + i + "' />";
                add_row += "</div>";
                add_row += "</div>";
                $('#installment_rows').append(add_row);
            }
        } else {
            alertify.error("Please enter number of installments.");
        }
    } else {
        alertify.error("Admission/ Registration Fee payment date is needed to process this request.");
    }
}

function requestStudentEnrollement(argument) {
    if (form_validated) {
        if (document.getElementById('admission_registration_voucher_code').value != "" && document.getElementById("admission_registration_paid_date").value != "" || argument == 'pwwb') {
            if (document.getElementById("fee_structure_type_id").value != "" || argument == 'pwwb') {
                if (document.getElementById("fee_structure_type_id").value == 0 || parseInt(this.total_fee_while_installment_generation) == parseInt(document.getElementById('total_package').value)) {
                    var request_wait_msg = alertify.error('Please wait. System is working on your request.');
                    $.ajax({
                        headers: {
                            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                        },
                        url: "/admissions",
                        dataType: "json",
                        type: "POST",
                        contentType: false,
                        processData: false,
                        data: formdata,
                        success: function(data) {
                            alertify.success("Admission Process Completed Successfully.");
                            debugger;
                            if (data.student.student_category_id == 0) {
                                var text_message = 'Admission Form Code: ' + data.admission_form_no + '.\nStudent Roll No: ' + data.student.roll_no;
                                swal({
                                    title: 'Student enrollement process is successfully completed. Generated details are given below:',
                                    text: text_message,
                                    type: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Yes',
                                    confirmButtonClass: 'btn btn-success',
                                    showLoaderOnConfirm: true,
                                    reverseButtons: false
                                }).then((result) => {
                                    if (result.value) {
                                        window.location = document.referrer;
                                    }
                                });
                            } else {
                                setupStudentPackage(data.admission_form_no, data.student, data.academic_history_id);
                            }
                            // $('.nav-tabs a[href="#accounts_form"]').tab('show');
                            // $("#FormChange").html(data);
                            // window.location = '/admissions';
                        },
                        error: function(data) {
                            alertify.error(data.responseJSON.error);
                        }
                    });
                } else {
                    alertify.error('System has found variation in your package and installments amount!');
                }
            } else {
                alertify.error('Please select Payment Type to proceed!');
            }
        } else {
            alertify.error('System cannot process you request without admission/ registration payment.');
        }
    } else {
        alertify.error('System cannot process your request while mendatory fields are missing in Admission Form.');
    }
}

function setupStudentPackage(admission_form_no, student, academic_history_id) {
    var fee_package = {};
    fee_package.installment_count = document.getElementById('installment_count').value;
    fee_package.student_id = student.id;
    fee_package.academic_history_id = academic_history_id;
    // admission fee
    fee_package.cfe_admission_fee = document.getElementById('cfe_admission_fee').value;
    fee_package.marketer_incentive = document.getElementById('marketer_incentive').value;
    fee_package.registration_fee = document.getElementById('registration_fee').value;
    fee_package.total_admission_registration_fee = document.getElementById('total_admission_registration_fee').value;
    fee_package.admission_registration_voucher_code = document.getElementById('admission_registration_voucher_code').value;
    fee_package.admission_registration_paid_date = document.getElementById('admission_registration_paid_date').value;
    // tuition fee setup
    fee_package.tuition_fee = document.getElementById('tuition_fee').value;
    fee_package.discount_status_id = document.getElementById('discount_status_id').value;
    fee_package.discount = document.getElementById('discount').value;
    fee_package.discount_percentage = document.getElementById('discount_percentage').value;
    fee_package.net_tuition_fee = document.getElementById('net_tuition_fee').value;
    if (document.getElementById('is_transport').value == 0) {
        fee_package.transport_month_count = document.getElementById('transport_month_count').value;
        fee_package.transport_monthly_amount = document.getElementById('transport_monthly_amount').value;
        fee_package.total_transport_charges = document.getElementById('total_transport_charges').value;
    }
    fee_package.miscellaneous_charges = document.getElementById('miscellaneous_charges').value;
    // other fee charges
    fee_package.other_charges = [];
    $.each($('.has-other-charges-sum'), function(index, field) {
        fee_package.other_charges[index] = {
            'amount': field.value,
            'reason': $('#otherFeeChargeReason_' + field.attributes.row_count.value).val()
        };
    })
    debugger;
    fee_package.total_package = document.getElementById('total_package').value;
    fee_package.fee_structure_type_id = document.getElementById('fee_structure_type_id').value;
    fee_package.due_date = document.getElementById('due_date').value;
    fee_package.amount_per_installment = [];
    fee_package.installment_due_date = [];
    for (var i = 0; i < document.getElementById('installment_count').value; i++) {
        fee_package.amount_per_installment[i] = document.getElementById('amount_per_installment-' + i).value;
        fee_package.installment_due_date[i] = document.getElementById('installment_due_date_' + i).value;
    }
    var request_wait_msg = alertify.error('Processing student account details. Please wait.');
    $.ajax({
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        },
        url: "/accounts/createFeePackage",
        // dataType: "json",
        type: "POST",
        data: fee_package,
        success: function(data) {
            var text_message = 'Admission Form Code: ' + admission_form_no + '.\nStudent Roll No: ' + student.roll_no;
            swal({
                title: 'Student enrollement process is successfully completed. Generated details are given below:',
                text: text_message,
                type: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                confirmButtonClass: 'btn btn-success',
                showLoaderOnConfirm: true,
                reverseButtons: false
            }).then((result) => {
                debugger;
                if (result.value) {
                    window.history.back();
                }
            });
            // $('.nav-tabs a[href="#accounts_form"]').tab('show');
            // $("#FormChange").html(data);
            // window.location = '/admissions';
        },
        error: function(data) {
            alertify.error(data.responseJSON.error);
        }
    });
}

function installmentsAdjustment() {
    var total_installments_amount = 0;
    var last_installment = 0;
    var no_of_installments = document.getElementById('installment_count').value;
    var total_fee = document.getElementById("total_package").value;
    for (var i = 0; i < no_of_installments; i++) {
        total_installments_amount += parseInt($('#amount_per_installment-' + i).val());
        if (no_of_installments == i + 1) {
            var last_installment = parseInt($('#amount_per_installment-' + i).val());
        }
    }
    var difference = parseInt(total_installments_amount - total_fee);
    if (difference < 0) {
        $('#amount_per_installment-' + (i - 1)).val(Math.abs(parseInt(difference - last_installment)));
    } else {
        $('#amount_per_installment-' + (i - 1)).val(parseInt(last_installment - difference));
    }
}
// -------------------------------------------- EDIT MODULE JS -----------------------------------------------------
function editPackage() {
    // change button on selection
    $(event.target).toggleClass('active');
    var fields = document.getElementsByClassName('editable');
    $.each(fields, function(i, field) {
        document.getElementById(field.attributes.id.value).disabled = !document.getElementById(field.attributes.id.value).disabled;
    });
    $.each($('.editable-other-charges'), function(i, field) {
        $(field).prop('disabled') ? $(field).prop('disabled', false) : $(field).prop('disabled', true);
    });
    let editable_btn = $('.editable-other-charges-button');
    editable_btn.prop('hidden') ? editable_btn.prop('hidden', false) : editable_btn.prop('hidden', true);
    document.getElementById('discount_status_id').focus();
    document.getElementById('save_div').hidden = !document.getElementById('save_div').hidden;
}

function deleteOtherFeePackageCharges(package_id) {
    event.preventDefault();
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            // send ajax request
            $.ajax({
                url: '/accounts/deleteOtherFeePackageCharges/' + package_id,
                type: 'GET',
                success: function(resp) {
                    if (resp.success) {
                        swal({
                            title: resp.message,
                            type: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes',
                            confirmButtonClass: 'btn btn-success',
                            showLoaderOnConfirm: true,
                            reverseButtons: false
                        }).then((result) => {
                            if (result.value) {
                                location.reload();
                            }
                        });
                    }
                },
                error: function(error) {
                    Swal.fire('Error!', 'There was some error.', 'error')
                }
            })
        }
    })
}
$(function() {
    'use strict';
    // COUNT TOTAL OTHER CHARGES FOR EDIT PAGE
    $(document).on('change', '.has-other-charges-sum', function(event) {
        // event.preventDefault();
        var fields = document.getElementsByClassName('has-other-charges-sum');
        var total_package = 0;
        $.each(fields, function(i, field) {
            total_package = parseInt(total_package) + parseInt(field.value);
        });
        document.getElementById("total_other_charges").value = total_package;
        $('.has-sum').change();
    });
})
// Package calculation function below
$('.has-sum').change(function() {
    var fields = document.getElementsByClassName('has-sum');
    var total_package = 0;
    $.each(fields, function(i, field) {
        total_package = parseInt(total_package) + parseInt(field.value);
    });
    document.getElementById("total_package").value = total_package;
});