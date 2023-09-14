var teacher_type_id;

function onTeacherTypeSelect() {
    teacher_type_id = document.getElementById('faculty_type').value;
    if (teacher_type_id == 1) {
        document.getElementById('hourly_rate_range_field').hidden = true;
        $("#experience_level").html("");
        var add_drop_down_experience_level = '';
        add_drop_down_experience_level += "<label>Experience Level</label>";
        add_drop_down_experience_level += "<select class='form-control' name='experience_level' id='experience_level_id' onchange='onExperienceLevelSelect()'>";
        add_drop_down_experience_level += "<option value=''>--- Select Experience Level ---</option>";
        jQuery.each(constants.hourly_rates, function(index, value) {
            add_drop_down_experience_level += "<option value='" + index + "'>" + value.name + "</option>";
        });
        add_drop_down_experience_level += "</select>";
        $("#experience_level").append(add_drop_down_experience_level);
    } else if (teacher_type_id == 0) {
        document.getElementById('hourly_rate_range_field').hidden = true;
        $("#experience_level").html("");
        $("#hourly_rate_range_field").html("");
        var add_fixed_payment_field = '';
        add_fixed_payment_field += "<label>Fixed Salary</label>";
        add_fixed_payment_field += "<input type='text' name='fixed_salary' id='fixed_salary_id' class='form-control' placeholder='Enter Fixed Salary'>";
        $("#experience_level").append(add_fixed_payment_field);
    }
}

var experience_level_id;

function onExperienceLevelSelect() {
    document.getElementById('hourly_rate_range_field').hidden = false;
    experience_level_id = document.getElementById('experience_level_id').value;
    $("#hourly_rate_range_field").html("");
    var add_hourly_rate_range_fields = '';
    add_hourly_rate_range_fields += "<label>Hourly Rate</label>";
    add_hourly_rate_range_fields += "<input type='number' name='hourly_salary_rate' id='hourly_rate_id' class='form-control' placeholder='Enter Hourly Rate'>";
    $("#hourly_rate_range_field").append(add_hourly_rate_range_fields);
}

$('#campus_id').on("select2:select", function(e) {
    $.ajax({
        url: base_url + "/users/addUserCampusDetails/" + e.params.data.id,
        // dataType: "json",
        type: "GET",
        success: function(data) {
            $('#campuses_div').append(data);
            $('.select2').select2();
        },
        error: function(data) {
            swal.showValidationError(`Request failed: ${data}`)
            alertify.error('Something went wrong.')
        }
    });
});

$('#campus_id').on("select2:unselect", function(e) {
    $('.' + e.params.data.text.replace(/\s/g, '')).html('');
});
$('#campus_id').on("select2:unselecting", function(e) {
    if ($('.' + e.params.args.data.text.replace(/\s/g, '')).attr('fromDatabase')) {
        $.notify('You cannot delete a campus once assigned. Please Uncheck the Working checkbox to restrict the user from access.', 'error');
        e.preventDefault();
    }
});

function calculateAge() {
    var current = new Date();
    var dob = new Date(document.getElementById('d_o_b').value);
    var age = current.getFullYear() - dob.getFullYear();
    document.getElementById('age').value = age;
}

function getDesignationDepartments(e) {
    document.getElementById(e.target.attributes.name_for_ids.value + '_department_div').hidden = true;
    let campus_id = e.target.getAttribute('data-campus-id');
    $.ajax({
        url: base_url + "/departments/getDesignationDepartments/" + e.target.selectedOptions[0].value + "/" + campus_id,
        // dataType: "json",
        type: "GET",
        success: function(data) {
            if (data.length == 0) {
                $('#' + e.target.attributes.name_for_ids.value + '_department').html($('<option></option>').html('--- No Department Found ---'));
            } else {
                $('#' + e.target.attributes.name_for_ids.value + '_department').html($('<option></option>').val('').html('--- Select Designation ---'));
                $.each(data, function(index, value) {
                    $('#' + e.target.attributes.name_for_ids.value + '_department').append($('<option value="' + index + '">' + value + '</option>'));
                });
            }
            document.getElementById(e.target.attributes.name_for_ids.value + '_department_div').hidden = false;
        },
        error: function(data) {
            swal.showValidationError(`Request failed: ${data}`)
            alertify.error('Something went wrong.')
        }
    });
}
// function getDepartmentDesignations(e) {
//     document.getElementById(e.target.attributes.name_for_ids.value + '_designation_div').hidden = true;
//     $.ajax({
//         url: base_url + "/departments/getDepartmentDesignations/" + e.target.selectedOptions[0].value,
//         // dataType: "json",
//         type: "GET",
//         success: function(data) {
//             console.log(e.target.attributes.name_for_ids.value);
//             $.each(data.data.designations, function(index, value) {
//                 if (index == 0) {
//                     $('#' + e.target.attributes.name_for_ids.value + '_designation').html($('<option></option>').val('').html('--- Select Designation ---'));
//                     $('#' + e.target.attributes.name_for_ids.value + '_designation').append($('<option></option>').val(value.id).html(value.name));
//                 } else {
//                     $('#' + e.target.attributes.name_for_ids.value + '_designation').append($('<option></option>').val(value.id).html(value.name));
//                 }
//             });
//             if (data.data.designations.length == 0) {
//                 $('#' + e.target.attributes.name_for_ids.value + '_designation').html($('<option></option>').html('--- No Designation Found ---'));
//             }
//             document.getElementById(e.target.attributes.name_for_ids.value + '_designation_div').hidden = false;
//         },
//         error: function(data) {
//             swal.showValidationError(`Request failed: ${data}`)
//             alertify.error('Something went wrong.')
//         }
//     });
// }
function checkEmailDuplicacy() {
    if (validateEmail()) {
        $.ajax({
            url: base_url + "/users/checkEmailDuplicacy",
            // dataType: "json",
            type: "POST",
            data: {
                _token: $("input[name='_token']").val(),
                email: document.getElementById('email').value,
            },
            success: function(data) {
                if (data.success) {
                    $('#email_message').removeClass('text-success');
                    $('#email_message').html(data.message).addClass('text-danger');
                } else {
                    $('#email_message').removeClass('text-danger');
                    $('#email_message').html(data.message).addClass('text-success');
                }
            },
            error: function(data) {
                swal.showValidationError(`Request failed: ${data}`)
                alertify.error('Something went wrong.')
            }
        });
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
        return false;
    }
    return (true);
}
