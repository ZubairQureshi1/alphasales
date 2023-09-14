$(document).ready(function() {
    calculateTotalFeeByAdmissionTuition();
});
var id;
var tabs = $('.tabs');
var items = $('.tabs').find('a').length;
var selector = $(".tabs").find(".selector");
var activeItem = tabs.find('.active');
var activeWidth = activeItem.innerWidth();
$(".selector").css({
    "left": activeItem.position.left + "px",
    "width": activeWidth + "px"
});
$(".tabs").on("click", "a", function() {
    $('.tabs a').removeClass("active");
    $(this).addClass('active');
    var activeWidth = $(this).innerWidth();
    var itemPos = $(this).position();
    $(".selector").css({
        "left": itemPos.left + "px",
        "width": activeWidth + "px"
    });
});

function openCity(evt, name) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(name).style.display = "block";
    evt.currentTarget.className += " active";
}

function editable($id) {
    var x = document.getElementsByClassName($id);
    document.getElementById($id).hidden = false;
    document.getElementById('package_form').hidden = false;
    for (var i = 0; i < x.length; i++) {
        x[i].disabled = false;
    }
}

function headsDiscount(id) {
    var amount = document.getElementById("heads_amount_" + id).value;
    var discount_obj = document.getElementById("heads_discount_" + id);
    var discount = document.getElementById("heads_discount_" + id).value;
    discount_obj.max = document.getElementById("heads_amount_" + id).value;
    var amount_after_discount = Math.round(amount - discount);
    var discount_percentage = Math.round((discount / amount) * 100);
    if (discount_obj.validity.rangeOverflow) {
        $('#heads_discount_message_' + id).html('<strong>Note: </strong>Amount should be less than ' + amount).css('color', 'red');
        document.getElementById("heads_discount_percentage_" + id).value = 0;
        document.getElementById("heads_amount_after_discount_" + id).value = 0;
        document.getElementById("head_modal_submit").disabled = true;
    } else {
        $('#heads_discount_message_' + id).html('');
        document.getElementById("heads_discount_percentage_" + id).value = Math.round(discount_percentage);
        document.getElementById("heads_amount_after_discount_" + id).value = amount_after_discount;
        document.getElementById("head_modal_submit").disabled = false;
    }
};

function enableHeadRow(index) {
    var head_checked = $("#head_" + index).is(":checked");
    if (head_checked) {
        document.getElementById("heads_amount_" + index).disabled = false;
        document.getElementById("heads_discount_" + index).disabled = false;
        document.getElementById("heads_discount_percentage_" + index).disabled = false;
        document.getElementById("heads_amount_after_discount_" + index).disabled = false;
        document.getElementById("due_date_" + index).disabled = false;
    } else {
        document.getElementById("heads_amount_" + index).disabled = true;
        document.getElementById("heads_discount_" + index).disabled = true;
        document.getElementById("heads_discount_percentage_" + index).disabled = true;
        document.getElementById("heads_amount_after_discount_" + index).disabled = true;
        document.getElementById("due_date_" + index).disabled = true;
    }
}
$('#installment_interval').change(function() {
    var inst = document.getElementById("installment_interval").value;
    var installments = document.getElementById("duration_per_semester").value / inst;
    var amount = Math.round(document.getElementById("net_total").value / installments);
    document.getElementById("no_of_installments").value = installments;
    document.getElementById("amount_per_installment").value = amount;
})
$('#tution_fee').change(calculateTotalFeeByAdmissionTuition());

function calculateTotalFeeByAdmissionTuition() {
    var adm = parseInt(document.getElementById("admission_fee") != null ? document.getElementById("admission_fee").value : '0');
    var tution = parseInt(document.getElementById("tution_fee").value);
    var total = adm + tution;
    document.getElementById("total_tution_fee").value = total;
}
$('.check_modal').change(function() {
    var x = document.getElementsByClassName("check_modal");
    var count = 0;
    for (var i = 0; i < x.length; i++) {
        if (x[i].checked == true) {
            document.getElementById('head_modal').hidden = false;
            count++;
        } else if (count == 0) {
            document.getElementById('head_modal').hidden = true;
        }
    }
})

function disable() {
    document.getElementById("a1").disabled = true;
    window.alert("done");
}

function deleteRow(r) {
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById("invoiceTable").deleteRow(i);
    invoice();
}

function invoice() {
    var length = document.getElementById("invoiceTable").rows.length;
    var count = 0;
    var sum = 0;
    var t = 0;
    for (var i = 1; i < length - 2; i++) {
        t = parseInt(document.getElementById("invoiceTable").rows[i].cells[2].innerHTML);
        sum = sum + t;
        count++;
    }
    for (var i = count + 1; i < length; i++) {
        document.getElementById("invoiceTable").rows[i].cells[3].innerHTML = sum;
    }
}

function setModel(id, value) {
    var x = document.getElementsByClassName($id);
}

function set(no) {
    id = no;
    //  window.alert(id);
}
//$('#'+id+'lateFine').focusin(fineCalculator())
function fineCalculator() {
    var due_date_id = id + "due_date";
    var paid_date_id = id + "paid_date";
    var due_date = document.getElementById(due_date_id).value;
    var paid_date = document.getElementById(paid_date_id).value;
    var parts1 = due_date.split("-");
    var parts2 = paid_date.split("-");
    due_date = new Date(parts1[0], parts1[1] - 1, parts1[2]);
    paid_date = new Date(parts2[0], parts2[1] - 1, parts2[2]);
    var timeDiff = paid_date.getTime() - due_date.getTime();
    var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
    var fine = 0;
    var amount = parseInt(document.getElementById((id + "amount_per_installment")).value);
    var amount_paid = parseInt(document.getElementById((id + "amount_paid")).value);
    if (paid_date.getTime() > due_date.getTime() && amount > 1000) {
        fine = diffDays * 25;
        document.getElementById((id + "lateFine")).value = fine;
        document.getElementById((id + "fine_days")).value = diffDays;
        document.getElementById((id + "total_amount")).value = amount + fine;
    } else {
        document.getElementById((id + "lateFine")).value = fine;
        document.getElementById((id + "fine_days")).value = 0;
        document.getElementById((id + "total_amount")).value = amount;
    }
    var status = document.getElementById((id + "statusId")).value;
    document.getElementById(id + 'fine_waived').max = parseInt(document.getElementById((id + "lateFine")).value);
    if (status == "2") {
        // document.getElementById(id + 'amount_paid').min = parseInt(document.getElementById(id + 'total_amount').value);
        document.getElementById(id + 'amount_paid').min = amount;
    } else {
        document.getElementById(id + 'amount_paid').min = 0;
    }
    // fine = parseInt(document.getElementById((id + "lateFine")).value);
    // document.getElementById((id + "amount_paid")).readOnly = true
    // document.getElementById((id + "amount_paid")).value = amount + fine;
    //window.alert(fine);
}

function fineWaived() {
    var fineWaived = parseInt(document.getElementById(id + 'fine_waived').value);
    var fine_after_waived = parseInt(document.getElementById((id + "lateFine")).value) - fineWaived
    if (fine_after_waived < 0) {
        fine_after_waived = 0;
    }
    document.getElementById((id + "total_amount")).value = Math.round(parseInt(document.getElementById((id + "amount_per_installment")).value) + parseInt(fine_after_waived));
    document.getElementById(id + 'amount_paid').min = parseInt(document.getElementById(id + 'total_amount').value);
}

function headFineCalculator(status_id) {
    var due_date_id = id + "due_date";
    var paid_date_id = id + "paid_date";
    var due_date = document.getElementById(due_date_id).value;
    var paid_date = document.getElementById(paid_date_id).value;
    var parts1 = due_date.split("-");
    var parts2 = paid_date.split("-");
    due_date = new Date(parts1[0], parts1[1] - 1, parts1[2]);
    paid_date = new Date(parts2[0], parts2[1] - 1, parts2[2]);
    var timeDiff = paid_date.getTime() - due_date.getTime();
    var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
    var fine = 0;
    var amount = parseInt(document.getElementById((id + "amount_after_discount")).value);
    var amount_paid = parseInt(document.getElementById((id + "amount_paid")).value);
    if (paid_date.getTime() > due_date.getTime() && amount > 1000) {
        // fine = diffDays * 25;
        document.getElementById((id + "lateFine")).value = 0;
        // document.getElementById((id + "lateFine")).value = fine;
        // document.getElementById((id + "fine_days")).value = diffDays;
        document.getElementById((id + "fine_days")).value = 0;
        // document.getElementById((id + "total_amount")).value = amount + fine;
        document.getElementById((id + "total_amount")).value = amount + 0;
    } else {
        document.getElementById((id + "lateFine")).value = fine;
        document.getElementById((id + "fine_days")).value = 0;
        document.getElementById((id + "total_amount")).value = amount;
    }
    var status = status_id;
    if (status == "2") {
        document.getElementById(id + 'amount_paid').min = parseInt(document.getElementById(id + 'total_amount').value);
    } else {
        document.getElementById(id + 'amount_paid').min = 0;
    }
    // fine = parseInt(document.getElementById((id + "lateFine")).value);
    // document.getElementById((id + "amount_paid")).readOnly = true
    // document.getElementById((id + "amount_paid")).value = amount + fine;
    //window.alert(fine);
}

function calculateRemainingAmount(id) {
    var amount_per_installment = document.getElementById(id + 'amount_per_installment').value;
    var late_fee_fine_voucher_code = document.getElementById(id + 'late_fee_fine_voucher_code').value;
    var total_amount = document.getElementById(id + 'total_amount').value;
    var amount_paid = document.getElementById(id + 'amount_paid').value;
    var status = document.getElementById((id + "statusId")).value;
    if (amount_paid != '') {
        var total_remaining;
        if (late_fee_fine_voucher_code != '') {
            total_remaining = amount_paid - total_amount;
        } else {
            total_remaining = amount_paid - amount_per_installment;
        }
        if (total_remaining < 0) {
            document.getElementById((id + "remaining_balance2")).value = Math.abs(total_remaining);
            if (status == '2') {
                $('#' + id + 'message').html('<strong>Note: </strong>' + 'Amount is less than already break amount and will not be break any further. If you proceed, system will ajust the installment itself.').css('color', 'red');
            } else {
                $('#' + id + 'message').html('<strong>Note: </strong>' + Math.abs(total_remaining) + '/- remains from current installment. Fine will be applicable per day as per SOP').css('color', 'red');
            }
            document.getElementById((id + "carry_forward2")).value = 0;
            document.getElementById((id + "is_carry_forward")).value = "false";
        } else if (total_remaining == 0) {
            document.getElementById((id + "remaining_balance2")).value = Math.abs(total_remaining);
            $('#' + id + 'message').html('<strong>Note: </strong>' + Math.abs(total_remaining) + '/- remains. Instalment Clear').css('color', 'green');
            document.getElementById((id + "carry_forward2")).value = 0;
            document.getElementById((id + "is_carry_forward")).value = "false";
        } else {
            document.getElementById((id + "remaining_balance2")).value = Math.abs(total_remaining);
            $('#' + id + 'message').html('<strong>Note: </strong>' + 'Remaining ' + Math.abs(total_remaining) + '/- amount will be carry forwarded to next installment.').css('color', 'red');
            document.getElementById((id + "carry_forward2")).value = Math.abs(total_remaining);
            document.getElementById((id + "is_carry_forward")).value = "true";
        }
    } else {
        $('#message').html('');
        document.getElementById((id + "remaining_balance2")).value = 0;
    }
};

function calculateRemainingHeadAmount(id) {
    var total_amount = document.getElementById(id + 'total_amount').value;
    var amount_paid = document.getElementById(id + 'amount_paid').value;
    if (amount_paid != '') {
        total_remaining = amount_paid - total_amount;
        if (total_remaining < 0) {
            document.getElementById((id + "remaining_balance2")).value = Math.abs(total_remaining);
            $('#' + id + 'message').html('<strong>Note: </strong>' + Math.abs(total_remaining) + '/- remains from current installment. Fine will be applicable per day as per SOP').css('color', 'red');
            document.getElementById((id + "carry_forward2")).value = 0;
            document.getElementById((id + "is_carry_forward")).value = "false";
        } else if (total_remaining == 0) {
            document.getElementById((id + "remaining_balance2")).value = Math.abs(total_remaining);
            $('#' + id + 'message').html('<strong>Note: </strong>' + Math.abs(total_remaining) + '/- remains. Instalment Clear').css('color', 'green');
            document.getElementById((id + "carry_forward2")).value = 0;
            document.getElementById((id + "is_carry_forward")).value = "false";
        } else {
            document.getElementById((id + "remaining_balance2")).value = Math.abs(total_remaining);
            $('#' + id + 'message').html('<strong>Note: </strong>' + 'Remaining ' + Math.abs(total_remaining) + '/- amount will be carry forwarded to next installment.').css('color', 'red');
            document.getElementById((id + "carry_forward2")).value = Math.abs(total_remaining);
            document.getElementById((id + "is_carry_forward")).value = "true";
        }
    } else {
        $('#message').html('');
        document.getElementById((id + "remaining_balance2")).value = 0;
    }
};
$('.verifyPackage tbody').on('click', '.verifyPlan', function() {
    var page_name = $(this).attr('page_name');
    if (page_name == 'packages') {
        var id = $(this).attr('package_id');
        var table = $('.verifyPackage').DataTable();
        var context = this;
        $.ajax({
            url: "../updatePackageVerification",
            dataType: "json",
            type: "POST",
            data: {
                _token: $("input[name='_token']").val(),
                id: id,
            },
            success: function(data) {
                alertify.success(data.message);
                table.row($(context).parents('tr')).remove().draw();
            },
            error: function(data) {
                console.log(data);
                alertify.error(data.message);
            }
        });
    }
    if (page_name == 'instalments') {
        var id = $(this).attr('instalment_id');
        var table = $('.verifyPackage').DataTable();
        var context = this;
        $.ajax({
            url: "../updateInstalmentVerification",
            dataType: "json",
            type: "POST",
            data: {
                _token: $("input[name='_token']").val(),
                id: id,
            },
            success: function(data) {
                alertify.success(data.message);
                table.row($(context).parents('tr')).remove().draw();
            },
            error: function(data) {
                console.log(data);
                alertify.error(data.message);
            }
        });
    }
});

function fee_fineWaived(fee_id) {
    var fineWaived = parseInt(document.getElementById(fee_id + 'amount_waived').value);
    var fine_after_waived = parseInt(document.getElementById((fee_id + "lateFeeFine")).value) - fineWaived
    if (fine_after_waived < 0) {
        fine_after_waived = 0;
    }
    if (fine_after_waived == 0) {
        document.getElementById((fee_id + "TotalFine")).value = 0;
    } else {
        document.getElementById((fee_id + "TotalFine")).value = Math.round(parseInt(fine_after_waived));
    }
    document.getElementById((fee_id + "TotalFine")).value = Math.round(parseInt(fine_after_waived));
}

function feeFineCalculator(fee_id) {
    var total = parseInt(document.getElementById(fee_id + "TotalFine").value);
    var paid = parseInt(document.getElementById(fee_id + "amount_paid").value);
    if (isNaN(paid) || paid == '' || paid == 0) {
        document.getElementById(fee_id + "remaining_balance").value = total;
    } else {
        document.getElementById(fee_id + "remaining_balance").value = total - paid;
    }
}

function attendanceFine(student_id) {
    var from_date = document.getElementById("from_date").value;
    var to_date = document.getElementById("to_date").value;
    $.ajax({
        url: "../attendanceFine",
        dataType: "json",
        type: "POST",
        data: {
            _token: $("input[name='_token']").val(),
            student_id: student_id,
            from_date: from_date,
            academic_history_id: document.getElementById('academic_history_id').value,
            to_date: to_date,
        },
        success: function(data) {
            window.location.reload();
        },
        error: function(data) {
            debugger;
            alertify.error(data.message);
        }
    });
}

function attendancefee_fineWaived(atd_id) {
    var fineWaived = parseInt(document.getElementById(atd_id + 'atd_amount_waived').value);
    if (isNaN(fineWaived) || fineWaived == '') {
        fineWaived = 0;
    }
    var fine_after_waived = parseInt(document.getElementById((atd_id + "attendanceFine")).value) - fineWaived;
    if (fine_after_waived < 0) {
        fine_after_waived = 0;
    }
    if (fine_after_waived == '' || fine_after_waived == 0) {
        document.getElementById((atd_id + "atd_TotalFine")).value = 0;
    } else {
        document.getElementById((atd_id + "atd_TotalFine")).value = Math.round(parseInt(fine_after_waived));
    }
}

function attendancefeeFineCalculator(atd_id) {
    var total = parseInt(document.getElementById(atd_id + "atd_TotalFine").value);
    var paid = parseInt(document.getElementById(atd_id + "atd_amount_paid").value);
    if (isNaN(paid) || paid == '' || paid == 0) {
        document.getElementById(atd_id + "atd_remaining_balance").value = total;
    } else {
        document.getElementById(atd_id + "atd_remaining_balance").value = total - paid;
    }
}

function examfee_fineWaived(atd_id) {
    var fineWaived = parseInt(document.getElementById(atd_id + 'ex_amount_waived').value);
    if (isNaN(fineWaived) || fineWaived == '') {
        fineWaived = 0;
    }
    var fine_after_waived = parseInt(document.getElementById((atd_id + "examFine")).value) - fineWaived;
    if (fine_after_waived < 0) {
        fine_after_waived = 0;
    }
    if (fine_after_waived == 0) {
        document.getElementById((atd_id + "ex_TotalFine")).value = 0;
    } else {
        document.getElementById((atd_id + "ex_TotalFine")).value = Math.round(parseInt(fine_after_waived));
    }
}

function examfeeFineCalculator(atd_id) {
    var total = parseInt(document.getElementById(atd_id + "ex_TotalFine").value);
    var paid = parseInt(document.getElementById(atd_id + "amount_paid").value);
    if (isNaN(paid)) {
        document.getElementById(atd_id + "ex_remaining_balance").value = total;
    } else {
        document.getElementById(atd_id + "ex_remaining_balance").value = total - paid;
    }
}
// $('#session_id').change(function() {
//   var own_value = document.getElementById('session_id').value;
//   var value = document.getElementById('exam_type_id').value;
//   if (!own_value) {
//     document.getElementById('session_message').innerHTML = 'Please Select Session.';
//     hideFilterDivExam();
//   } else if (value) {
//     document.getElementById('exam_type_message').innerHTML = '';
//     document.getElementById('session_message').innerHTML = '';
//     showFilterDivExam();
//   } else {
//     document.getElementById('exam_type_message').innerHTML = 'Please Select Exam Type.';
//   }
// })
// $('#exam_type_id').change(function() {
// var own_value = document.getElementById('exam_type_id').value;
// var value = document.getElementById('session_id').value;
// if (!own_value) {
//   document.getElementById('exam_type_message').innerHTML = 'Please Select Exam Type.';
//   hideFilterDivExam();
// } else {
//   showFilterDivExam();
// }
// else if (value) {
//   document.getElementById('exam_type_message').innerHTML = '';
//   document.getElementById('session_message').innerHTML = '';
//   showFilterDivExam();
// } else {
//   document.getElementById('session_message').innerHTML = 'Please Select Session.';
// }
// })
function hideFilterDivExam() {
    document.getElementById('filter_div').hidden = true;
}

function hideCalculateDivExam() {
    document.getElementById('calculate_div').hidden = true;
}

function showFilterDivExam() {
    document.getElementById('filter_div').hidden = false;
}

function showCalculateDivExam() {
    document.getElementById('calculate_div').hidden = false;
}

function getDateSheets(session_id, course_id, section_id) {
    var own_value = document.getElementById('exam_type_id').value;
    if (own_value) {
        $.ajax({
            url: "../ExamFine/getDateSheets",
            dataType: "json",
            type: "POST",
            data: {
                _token: $("input[name='_token']").val(),
                exam_type_id: document.getElementById('exam_type_id').value,
                session_id: session_id,
                course_id: course_id,
                section_id: section_id,
            },
            success: function(data) {
                document.getElementById('calculate_div').hidden = false;
                document.getElementById('date_sheet_div_exam').hidden = false;
                var date_sheets = data.data.date_sheets;
                $('#date_sheet_id').html('');
                $.each(date_sheets, function(index, value) {
                    $('#date_sheet_id').append($('<option>', {
                        value: value.id,
                        text: value.date_sheet_name
                    }));
                });
            },
            error: function(data) {}
        });
    }
}

function calculateExamFine(student_id) {
    var exam_type_id = document.getElementById('exam_type_id').value;
    var date_sheet_id = document.getElementById('date_sheet_id').value;
    $.ajax({
        url: "../ExamFine/calculateExamFine",
        dataType: "json",
        type: "POST",
        data: {
            _token: $("input[name='_token']").val(),
            exam_type_id: exam_type_id,
            date_sheet_id: date_sheet_id,
            student_id: student_id,
            academic_history_id: document.getElementById('academic_history_id').value,
        },
        success: function(data) {
            window.location.reload();
        },
        error: function(data) {
            alertify.error(data.message);
        }
    });
}
window.onload = invoice();