function validateForm() {
    var forn_validated = true;
    var fields = document.getElementsByClassName('item-required');
    var message = "Form cannot be saved. Following required fields are empty:"
    $.each(fields, function(i, field) {
        if (!field.hidden && !field.value) {
            message += "\r\n" + field.attributes.errorlabel.value;
            forn_validated = false;
        }
    });
    if (!forn_validated) {
        $.notify(message, "error");
    }
    return forn_validated;
}

function validateDates() {
    var admission_date = new Date(document.getElementById('admission_date').value);
    var current_date = new Date();
    if (admission_date > current_date) {
        alertify.error('Admission date cannot be greater than current date.');
        return false;
    }
    var date_of_birth = new Date(document.getElementById('d_o_b').value);
    if (date_of_birth > admission_date) {
        alertify.error('Date of birth cannot be greater than admission date.');
        return false;
    }
    return true;
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

function calculatePercentage(count) {
    var marks_obtained = document.getElementById('academic_marks_' + count).value;
    var total_marks = document.getElementById('academic_total_marks_' + count).value;
    var percentage = (marks_obtained / total_marks) * 100;
    if (percentage >= 0) {
        document.getElementById('academic_percentage_' + count).value = percentage.toFixed(1);
    }
}

function validateMarks(count) {
    var marks_obtained = document.getElementById('academic_marks_' + count).value;
    var total_marks = document.getElementById('academic_total_marks_' + count).value;
    if (parseInt(total_marks) < parseInt(marks_obtained)) {
        alertify.error('Total marks cannot be less than obtained marks.');
        document.getElementById('academic_total_marks_' + count).value = 0;
        calculatePercentage(count);
    } else {
        calculatePercentage(count);
    }
}