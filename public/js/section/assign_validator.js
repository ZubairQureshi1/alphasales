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
        assignSectionToStudents();
    }
}