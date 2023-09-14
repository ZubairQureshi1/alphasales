var form_bypassed = 0;
var form_bypassed_edit = 0;

function validateForm() {
    var form_validated = true;
    var fields = document.getElementsByClassName('item-required');
    var message = "Form cannot be saved. Following required fields are empty:"
    $.each(fields, function(i, field) {
        if (!field.hidden && !field.value && !field.parentElement.hidden) {
            message += "\r\n" + field.attributes.errorlabel.value;
            form_validated = false;
        }
    });
    if (!form_validated) {
        $.notify(message, "error");
    } else {
        form_validated = true;
        if ($('#section_details .sectionRow').length > 0 || $('#section_details .sectionRow').attr('row-status') !== 'deleted') {
            saveSection();
        } else {
            alertify.error('Please add at least one section to create a new section');
        }
    }
}


function editValidateForm() {
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
        self.form_bypassed_edit = 0
        editSaveSection();
    } else {
        if (can_show_bypass_message) {
            alertify.confirm(bypass_message + "<br><br><b class='text-danger'>Do you want to proceed without mandatory fields?</b>", function() {
                self.form_bypassed_edit = 1
                editSaveSection();
            }, function() {
                return form_validated;
            });
        } else {
            $.notify(message, "error");
        }
    }
}