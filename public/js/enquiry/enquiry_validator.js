function calculatePercentage() {
    var marks_obtained = document.getElementById('marks_obtained').value;
    var total_marks = document.getElementById('total_marks').value;
    var percentage = (marks_obtained / total_marks) * 100;
    if (percentage >= 0) {
        document.getElementById('percentage').value = percentage.toFixed(1);
    }
}

function validateMarks() {
    var marks_obtained = document.getElementById('marks_obtained').value;
    var total_marks = document.getElementById('total_marks').value;
    if (parseInt(total_marks) < parseInt(marks_obtained)) {
        alertify.error('Total marks cannot be less than obtained marks.');
        document.getElementById('total_marks').value = 0;
        calculatePercentage();
    } else {
        calculatePercentage();
    }
}


function validateMonthNumber(row) {
    var month_number = document.getElementById('worker_experience_in_months_' + row).value;
    if (parseInt(month_number) > 12) {
        alertify.error('Month cannot be greater than 12.');
        document.getElementById('worker_experience_in_months_' + row).value = "";
    }
}

function validateFollowupDate() {
    if (document.getElementById('enquiry_date').value != "") {
        var next_followup_date = new Date(document.getElementById('next_followup_date_id').value);
        var enquiry_date = new Date(document.getElementById('enquiry_date').value);
        if (next_followup_date < enquiry_date) {
            alertify.error('Followup date cannot be less than enquiry date.');
            document.getElementById('next_followup_date_id').valueAsDate = null;
        }
    } else {
        alertify.error('Select enquiry date first.');
        document.getElementById('next_followup_date_id').valueAsDate = null;
        document.getElementById('enquiry_date').focus();
    }
}

function validateProspectFollowupDate(row) {
    if (document.getElementById('enquiry_date').value != "") {
        var next_prospect_followup_date = new Date(document.getElementById('prospect_followup_date_' + row).value);
        var enquiry_date = new Date(document.getElementById('enquiry_date').value);
        if (next_prospect_followup_date < enquiry_date) {
            alertify.error('Prospect followup date cannot be less than enquiry date.');
            document.getElementById('prospect_followup_date_' + row).valueAsDate = null;
        }
    } else {
        alertify.error('Select enquiry date first.');
        document.getElementById('prospect_followup_date_' + row).valueAsDate = null;
        document.getElementById('enquiry_date').focus();
    }
}

function validateEmail() {
    var emailID = document.getElementById('email').value;
    atpos = emailID.indexOf("@");
    dotpos = emailID.lastIndexOf(".");

    if (atpos < 1 || (dotpos - atpos < 2)) {
        $('#email_message').removeClass('text-success');
        $('#email_message').html("Please enter correct email. Format should be abc@xyz.com").addClass('text-danger');
        document.getElementById('email').focus();
        alertify.error('Email format is incorrect.');
        return false;
    } else {
        $('#email_message').addClass('text-success');
        $('#email_message').removeClass('text-danger');
        $('#email_message').html("Email format is correct").addClass('text-danger');
    }
    return (true);
}

var form_bypassed = 0;

function validateForm() {
    var self = this;
    var form_validated = true;
    var can_show_bypass_message = true;
    var fields = document.getElementsByClassName('item-required');
    var message = "Note:Form cannot be saved. Following required fields are empty:"
    var bypass_message = "<strong class='text-danger'>Note:</strong> <u>Form cannot be saved. Following required fields are empty:</u><br>"
    $.each(fields, function(i, field) {
        if (!field.hidden && !field.value && !field.hasAttribute('never-bypass')) {
            bypass_message += "<br> --- \r\n" + field.attributes.errorlabel.value;
            form_validated = false;
        } else if (!field.hidden && !field.value && field.hasAttribute('never-bypass')) {
            form_validated = false;
            can_show_bypass_message = false;
            message += "\r\n" + field.attributes.errorlabel.value;
        }
    });
    /*if (!form_validated) {
        $.notify(message, "error");
    }
    return form_validated;*/
    if (form_validated) {
        self.form_bypassed = 0
        checkNumberDuplicacy();
    } else {
        if (can_show_bypass_message) {
            alertify.confirm(bypass_message + "<br><br><b class='text-danger'>Do you want to proceed without mandatory fields?</b>", function() {
                self.form_bypassed = 1
                checkNumberDuplicacy();
            }, function() {
                return form_validated;
            });
        } else {
            $.notify(message, "error");
        }
    }
}
