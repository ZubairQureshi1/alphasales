$(document).ready(function() {
    getCoursesBySession();
    addContact();
});

var contact_count = 0;
var deleted_contact_count = 0;

$("#add_contact").click(function() {
    addContact();
});

function addContact() {

    // var add_row = "<script type=\"text/javascript\">  $('#multiple_drops').multiselect();</script>";
    var contact = {};
    var add_row = "<tr>"
    add_row += "<td><input id='contact_no_" + contact_count + "' type='text' placeholder='XXXX-XXXXXXX' data-mask='9999-9999999' class='form-control item-required' errorLabel='Contact No. ( Row " + (contact_count + 1) + " )'></td>";
    add_row += "<td>";
    add_row += "<select id='contact_type_" + contact_count + "' onchange='onContactRelationshipSelect(" + contact_count + ")' class='form-control item-required' errorLabel='Contact Type ( Row " + (contact_count + 1) + " )'>";
    jQuery.each(constants.contact_types, function(key, type) {
        add_row += "<option value='" + key + "'>" + type + "</option>";
    });
    add_row += "</select></td>";
    add_row += "<td><input id='other_name_" + contact_count + "' type='text' class='form-control' disabled errorLabel='Other Name ( Row " + (contact_count + 1) + " )'></td>";
    add_row += "<td class='text-center'><div row_index='" + contact_count + "' class='deleteRowButton btn btn-danger btn-sm waves-effect'><i class='mdi mdi-delete'></i> | Delete</div></td>";
    add_row += "<input type='hidden' name='contact_row_state_" + contact_count + "' id='contact_row_state_" + contact_count + "' value='unchanged'></input>";
    add_row += "</tr>";
    $("#contact_table_body").append(add_row);
    removeRowClickEvent();
    if ($('#combo').attr('name') == "edit_combo") {
        $("#row_state_" + contact_count).val('edited');
    }
    contact_count++;
}

function onContactRelationshipSelect(contact_count) {
    if (document.getElementById('contact_type_' + contact_count).value == 6) {
        document.getElementById('other_name_' + contact_count).disabled = false;
    } else {
        document.getElementById('other_name_' + contact_count).disabled = true;
    }
}

function removeRowClickEvent() {

    $('#contact_table_body').off('click', '.deleteRowButton').on('click', '.deleteRowButton', deleteContactTableRow);
}

function deleteContactTableRow(table_name) {
    if ((contact_count - deleted_contact_count) > 1) {
        var cat_index = $(this).attr('row_index');
        $(this).parents('tr').first().hide();
        document.getElementById('contact_no_' + cat_index).hidden = true;
        document.getElementById('contact_type_' + cat_index).hidden = true;
        document.getElementById('other_name_' + cat_index).hidden = true;
        $("#contact_row_state_" + cat_index).val('deleted');
        deleted_contact_count++;
    } else {
        $.notify('Minimum 1 contact detail is mendatory to save the form.', "error");
    }
}

function onCitySelect() {

    var city_name = document.getElementById('city_id').options[document.getElementById('city_id').options.selectedIndex].innerText;
    if (city_name == 'Other') {
        document.getElementById('city_other_name').hidden = false;
    } else {
        document.getElementById('city_other_name').hidden = true;
    }
}

function onEnquirySelect() {
    var city_name = document.getElementById('enquiry_type').options[document.getElementById('enquiry_type').options.selectedIndex].innerText;
    if (city_name == 'Other') {
        document.getElementById('other_enquiry_type').hidden = false;
    } else {
        document.getElementById('other_enquiry_type').hidden = true;
    }
}

function delete_enquiry(id) {
    swal({
        title: 'Do you want to delete this enquiry?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        confirmButtonClass: 'btn btn-success',
        showLoaderOnConfirm: true,
        cancelButtonClass: 'btn btn-danger',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            swal('Please wait ...', 'your request is in processing', 'info')
            $.ajax({
                url: "/enquiries/" + id + '/delete',
                // dataType: "json",
                method: "GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    swal({
                        position: 'top-end',
                        type: 'success',
                        title: 'Enquiry deleted successfully.',
                        showConfirmButton: false,
                        timer: 1000
                    }).then(result => {
                        if (result.dismiss === swal.DismissReason.timer) {
                            window.location = '/enquiries';
                        }
                    })
                },
                error: function(data) {
                    swal('Something went wrong!', data.statusText, 'error')
                }
            });
        } else if (
            // Read more about handling dismissals
            result.dismiss === swal.DismissReason.cancel) {
            swal('Cancelled', 'Enquiry deletion cancelled successfully', 'error')
        }
    });
}
var selected_course;
var selected_course_id;

function getAffiliatedBodySessions() {
    selected_affiliated_body_id = document.getElementById('affiliated_body_id').value;
    if (selected_affiliated_body_id) {
        document.getElementById('report_loading').hidden = false;

        $.ajax({
            url: "/getAffiliatedBodySessions",
            // dataType: "json",
            type: "POST",
            data: {
                _token: $("input[name='_token']").val(),
                id: selected_affiliated_body_id
            },
            success: function(data) {
                document.getElementById('report_loading').hidden = true;
                var session_select = "<div><strong>Sessions:<span class='required-span'>*</span></strong>";
                session_select += "<select id='session_id' class='form-control' onchange='getCoursesBySession()'>";
                session_select += "<option value=''>--- Select Session ---</option>";
                jQuery.each(data.sessions, function(index, value) {
                    session_select += "<option value='" + value.session_id + "'>" + value.session_name + "</option>";
                });
                session_select += "</select></div>";
                $("#session_div").html(session_select);
            },
            error: function(data) {
                document.getElementById('report_loading').hidden = true;
                swal.showValidationError(
                    `Request failed: ${data}`
                )
                alertify.error('Something went wrong.')
            }
        });
    }

}

function getCoursesBySession() {
    selected_session_id = document.getElementById('session_id').value;
    if (selected_session_id) {

        $.ajax({
            url: "/courses/getCoursesBySession/" + selected_session_id,
            // dataType: "json",
            type: "GET",
            success: function(data) {
                document.getElementById('course_information_div').hidden = false;
                var course_select = "<div><strong>Courses:<span class='required-span'>*</span></strong>";
                course_select += "<select id='course_id' class='form-control select2 item-required' errorLabel='Course' onchange='getAffiliatedBodiesByCourse()'>";
                course_select += "<option value=''>--- Select Course ---</option>";
                jQuery.each(data.courses, function(index, value) {
                    course_select += "<option value='" + value.course_id + "'>" + value.course_name + "</option>";
                });
                course_select += "</select><span id='course_msg' hidden='hidden' style='color: red'>Course Required</span></div>";
                $("#course_div").html(course_select);
                $('.select2').select2();
            },
            error: function(data) {
                document.getElementById('course_information_div').hidden = true;
                swal.showValidationError(
                    `Request failed: ${data}`
                )
                alertify.error('Something went wrong.')
            }
        });
    }

}

function getCoursesBySessionForProspect(count) {
    selected_session_id = document.getElementById('session_id').value;
    if (selected_session_id) {

        $.ajax({
            url: "/courses/getCoursesBySession/" + selected_session_id,
            // dataType: "json",
            type: "GET",
            success: function(data) {

                var prospect_course_select = "<div><strong>Courses:<span class='required-span'>*</span></strong>";
                prospect_course_select += "<select id='prospect_course_" + count + "' class='form-control select2 item-required' errorLabel='Prospect Course " + (count + 1) + "' onchange='getAffiliatedBodiesByCourseForProspect(" + count + ")'>";
                prospect_course_select += "<option value=''>--- Select Course ---</option>";
                jQuery.each(data.courses, function(index, value) {
                    prospect_course_select += "<option value='" + value.course_id + "'>" + value.course_name + "</option>";
                });
                $("#prospect_course_div_" + count).html(prospect_course_select);
                $('.select2').select2();
            },
            error: function(data) {
                swal.showValidationError(
                    `Request failed: ${data}`
                )
                alertify.error('Something went wrong.')
            }
        });
    }

}

function getAffiliatedBodiesByCourse() {
    selected_session_id = document.getElementById('session_id').value;
    selected_course_id = document.getElementById('course_id').value;
    if (selected_course_id && selected_session_id) {
        document.getElementById('report_loading').hidden = false;

        $.ajax({
            url: "/api/getAffiliatedBodiesByCourse?session_id=" + selected_session_id + '&course_id=' + selected_course_id,
            // dataType: "json",
            type: "GET",
            success: function(data) {
                document.getElementById('report_loading').hidden = true;
                var affiliated_body_select = "<div><strong>Affiliated Body:<span class='required-span'>*</span></strong>";
                affiliated_body_select += "<select id='affiliated_body_id' class='form-control select2 item-required' errorLabel='Affiliated Body' onchange='getDegreeTypesByBody()'>";
                affiliated_body_select += "<option value=''>--- Select Affiliated Body ---</option>";
                jQuery.each(data.affiliated_bodies, function(index, value) {
                    affiliated_body_select += "<option value='" + value.affiliated_body_id + "'>" + value.affiliated_body_name + "</option>";
                });
                affiliated_body_select += "</select></div>";
                $("#affiliated_body_div").html(affiliated_body_select);
                $('.select2').select2();
            },
            error: function(data) {
                document.getElementById('report_loading').hidden = true;
                swal.showValidationError(
                    `Request failed: ${data}`
                )
                alertify.error('Something went wrong.')
            }
        });
    }
}

function getAffiliatedBodiesByCourseForProspect(count) {
    selected_session_id = document.getElementById('session_id').value;
    selected_course_id = document.getElementById('prospect_course_' + count).value;
    if (selected_course_id && selected_session_id) {
        document.getElementById('report_loading').hidden = false;

        $.ajax({
            url: "/api/getAffiliatedBodiesByCourse?session_id=" + selected_session_id + '&course_id=' + selected_course_id,
            // dataType: "json",
            type: "GET",
            success: function(data) {
                document.getElementById('report_loading').hidden = true;
                var affiliated_body_select = "<div><strong>Affiliated Body:<span class='required-span'>*</span></strong>";
                affiliated_body_select += "<select id='prospect_affiliated_body_id_" + count + "' class='form-control select2 item-required' errorLabel='Affiliated Body (" + (count + 1) + ")' onchange='getDegreeTypesByBodyForProspect(" + count + ")'>";
                affiliated_body_select += "<option value=''>--- Select Affiliated Body ---</option>";
                jQuery.each(data.affiliated_bodies, function(index, value) {
                    affiliated_body_select += "<option value='" + value.affiliated_body_id + "'>" + value.affiliated_body_name + "</option>";
                });
                affiliated_body_select += "</select></div>";
                $("#prospect_affiliated_body_div_" + count).html(affiliated_body_select);
                $('.select2').select2();
            },
            error: function(data) {
                document.getElementById('report_loading').hidden = true;
                swal.showValidationError(
                    `Request failed: ${data}`
                )
                alertify.error('Something went wrong.')
            }
        });
    }
}

function getDegreeTypesByBody() {
    selected_session_id = document.getElementById('session_id').value;
    selected_course_id = document.getElementById('course_id').value;
    selected_affiliated_body_id = document.getElementById('affiliated_body_id').value;
    if (selected_course_id && selected_session_id && selected_affiliated_body_id) {
        document.getElementById('report_loading').hidden = false;

        $.ajax({
            url: "/api/getDegreeTypesByBody?session_id=" + selected_session_id + '&course_id=' + selected_course_id + '&affiliated_body_id=' + selected_affiliated_body_id,
            // dataType: "json",
            type: "GET",
            success: function(data) {
                document.getElementById('report_loading').hidden = true;
                var academic_term_select = "<div><strong>Degree Type:<span class='required-span'>*</span></strong>";
                academic_term_select += "<select id='academic_term_id' class='form-control select2 item-required' errorLabel='Degree Type'>";
                academic_term_select += "<option value=''>--- Select Degree Type ---</option>";
                jQuery.each(data.academic_terms, function(index, value) {
                    academic_term_select += "<option value='" + value.academic_term_id + "'>" + value.academic_term_name + "</option>";
                });
                academic_term_select += "</select></div>";
                $("#academic_term_div").html(academic_term_select);
                $('.select2').select2();
            },
            error: function(data) {
                document.getElementById('report_loading').hidden = true;
                swal.showValidationError(
                    `Request failed: ${data}`
                )
                alertify.error('Something went wrong.')
            }
        });
    }
}

function getDegreeTypesByBodyForProspect(count) {
    selected_session_id = document.getElementById('session_id').value;
    selected_course_id = document.getElementById('prospect_course_' + count).value;
    selected_affiliated_body_id = document.getElementById('prospect_affiliated_body_id_' + count).value;
    if (selected_course_id && selected_session_id && selected_affiliated_body_id) {
        document.getElementById('report_loading').hidden = false;

        $.ajax({
            url: "/courses/getDegreeTypesByBody?session_id=" + selected_session_id + '&course_id=' + selected_course_id + '&affiliated_body_id=' + selected_affiliated_body_id,
            // dataType: "json",
            type: "GET",
            success: function(data) {
                document.getElementById('report_loading').hidden = true;
                var academic_term_select = "<div><strong>Degree Type:<span class='required-span'>*</span></strong>";
                academic_term_select += "<select id='prospect_academic_term_id_" + count + "' class='form-control select2 item-required' errorLabel='Degree Type (" + (count + 1) + ")'>";
                academic_term_select += "<option value=''>--- Select Degree Type ---</option>";
                jQuery.each(data.academic_terms, function(index, value) {
                    academic_term_select += "<option value='" + value.academic_term_id + "'>" + value.academic_term_name + "</option>";
                });
                academic_term_select += "</select></div>";
                $("#prospect_degree_type_div_" + count).html(academic_term_select);
                $('.select2').select2();
            },
            error: function(data) {
                document.getElementById('report_loading').hidden = true;
                swal.showValidationError(
                    `Request failed: ${data}`
                )
                alertify.error('Something went wrong.')
            }
        });
    }
}


var selected_worker_id;
var selected_worker;

function onWorkerSelect() {
    selected_worker = document.getElementById('student_category_id').options[document.getElementById('student_category_id').options.selectedIndex].innerText;
    selected_worker_id = document.getElementById('student_category_id').value;
    if (selected_worker_id == 0) {
        document.getElementById('worker_div').hidden = false;
        document.getElementById('prospects_id').classList.add('item-required');
        addWorkerSection();

    }
    if (selected_worker_id == 1) {
        document.getElementById('worker_div').hidden = true;
        document.getElementById('prospects_id').classList.remove('item-required');
        $("#worker_details").html("");
    }
}

function showProspectDiv() {
    prospect_id = document.getElementById('prospects_id').value;
    if (prospect_id == 0) {
        document.getElementById('prospect_details').hidden = false;
        addProspectDetail();

    }
    if (prospect_id == 1) {
        document.getElementById('prospect_details').hidden = true;
        $("#prospect_details_div").html("");
    }
}
var worker_section_count = 0;
var prospect_count = 0;

var deleted_worker_section_count = 0;
var deleted_prospect_count = 0;

function workerSectionDelete(index) {
    if ((worker_section_count - deleted_worker_section_count) > 1) {
        $("#worker_section_" + index).attr('row_state', 'DELETED');
        $("#factory_name_" + index).attr('hidden', 'hidden');
        $("#worker_experience_in_years_" + index).attr('hidden', 'hidden');
        $("#worker_experience_in_months_" + index).attr('hidden', 'hidden');
        $("#worker_designation_" + index).attr('hidden', 'hidden');
        $("#eobi_ssc_id_" + index).attr('hidden', 'hidden');
        $("#is_factory_registered_" + index).attr('hidden', 'hidden');
        $("#worker_section_" + index).attr('hidden', 'hidden');
        deleted_worker_section_count++;
    } else {
        $.notify('Minimum 1 worker factory detail is mendatory to save the form.', "error");
    }
}

function workerProspectDelete(index) {
    if ((prospect_count - deleted_prospect_count) > 1) {
        $("#prospect_section_" + index).attr('row_state', 'DELETED');
        $("#prospect_section_" + index).attr('hidden', 'hidden');

        $("#prospect_name_" + index).attr('hidden', 'hidden');
        $("#prospect_relationship_" + index).attr('hidden', 'hidden');
        $("#prospect_course_" + index).attr('hidden', 'hidden');
        $("#prospect_affiliated_body_id_" + index).attr('hidden', 'hidden');
        $("#prospect_academic_term_id_" + index).attr('hidden', 'hidden');
        $("#prospect_followup_date_" + index).attr('hidden', 'hidden');
        $("#prospect_followup_status_id_" + index).attr('hidden', 'hidden');

        $("#prospect_father_name_" + index).attr('hidden', 'hidden');
        $("#prospect_shift_id_" + index).attr('hidden', 'hidden');
        $("#prospect_contact_number_" + index).attr('hidden', 'hidden');
        $("#prospect_is_transport_" + index).attr('hidden', 'hidden');
        $("#prospect_transport_stop_" + index).attr('hidden', 'hidden');
        deleted_prospect_count++;
    } else {
        $.notify('Minimum 1 prospect detail is mendatory to save the form.', "error");
    }
}

function addProspectDetail() {
    var add_prospect_row = "";
    add_prospect_row += "<div class='div-border m-t-10 m-b-10 padding-10' id='prospect_section_" + prospect_count + "'>";
    add_prospect_row += "<div class='row'>";

    add_prospect_row += "<div class='col-3'>";
    add_prospect_row += "<label>Name:<span style='color: red'>*</span></label>";
    add_prospect_row += "<input type='text' name='prospect_name' id='prospect_name_" + prospect_count + "' class='form-control letter_capitalize item-required' placeholder='Name' onkeypress='return alphabaticOnly(event)' errorLabel='Prospect Name (Row " + (prospect_count + 1) + ")'>";
    add_prospect_row += "</div>";

    add_prospect_row += "<div class='col-3'>";
    add_prospect_row += "<label>Father's Name:<span style='color: red'>*</span></label>";
    add_prospect_row += "<input type='text' name='prospect_father_name' id='prospect_father_name_" + prospect_count + "' class='form-control letter_capitalize item-required' placeholder='Father Name' onkeypress='return alphabaticOnly(event)' errorLabel='Prospect Father Name (Row " + (prospect_count + 1) + ")'>";
    add_prospect_row += "</div>";

    add_prospect_row += "<div class='col-3'>";
    add_prospect_row += "<label>Shift:<span style='color: red'>*</span></label>";
    add_prospect_row += "<select id='prospect_shift_id_" + prospect_count + "' class='form-control select2 item-required' errorLabel='Prospect Shift (Row " + (prospect_count + 1) + ")'>";
    add_prospect_row += "<option value=''>----- Select Shift -----</option>";
    jQuery.each(constants.shifts, function(index, value) {
        add_prospect_row += "<option value='" + index + "'>" + value + "</option>";
    });
    add_prospect_row += "</select>";
    add_prospect_row += "</div>";

    add_prospect_row += "<div class='col-3'>";
    add_prospect_row += "<label>Contact No.:<span style='color: red'>*</span></label>";
    add_prospect_row += "<input type='text' name='prospect_contact_number' id='prospect_contact_number_" + prospect_count + "' class='form-control letter_capitalize item-required' maxlength='11'  errorLabel='Prospect Contact No. (Row " + (prospect_count + 1) + ")' placeholder='Prospect Contact No.' onkeypress='return numericOnly(event)'>";
    add_prospect_row += "</div>";

    add_prospect_row += "<div class='col-3'>";
    add_prospect_row += "<label>Transport Facility:<span style='color: red'>*</span></label>";
    add_prospect_row += "<select id='prospect_is_transport_" + prospect_count + "' class='form-control select2 item-required' errorLabel='Prospect Transport Facility (Row " + (prospect_count + 1) + ")' onchange='onProspectTransportSelect(" + prospect_count + ")'>";
    add_prospect_row += "<option value=''>----- Select Prospect Transport -----</option>";
    jQuery.each(constants.is_transport, function(index, value) {
        add_prospect_row += "<option value='" + index + "'>" + value + "</option>";
    });
    add_prospect_row += "</select>";
    add_prospect_row += "</div>";

    add_prospect_row += "<div class='col-3' id='prospect_transport_stop_div_" + prospect_count + "' hidden>";
    add_prospect_row += "<label>Transport Stop:<span style='color: red'>*</span></label>";
    add_prospect_row += "<input type='text' name='prospect_transport_stop' id='prospect_transport_stop_" + prospect_count + "' class='form-control letter_capitalize' placeholder='Prospect Transport Stop' errorLabel='Prospect Transport Stop (Row " + (prospect_count + 1) + ")' onkeypress='return alphabaticOnly(event)'>";
    add_prospect_row += "</div>";

    add_prospect_row += "<div class='col-3'>";
    add_prospect_row += "<label>Relationship:<span style='color: red'>*</span></label>";
    add_prospect_row += "<input type='text' name='prospect_relationship' id='prospect_relationship_" + prospect_count + "' class='form-control letter_capitalize item-required' placeholder='Prospect Relationship' errorLabel='Prospect Relationship (Row " + (prospect_count + 1) + ")' onkeypress='return alphabaticOnly(event)'>";
    add_prospect_row += "</div>";

    // add_prospect_row += "<div class='col-3'>";
    // add_prospect_row += "<label>Prospect Course:<span style='color: red'>*</span></label>";
    // add_prospect_row += "<input type='text' name='prospect_course' id='prospect_course_" + prospect_count + "' class='form-control letter_capitalize item-required' placeholder='Prospect Course' errorLabel='Prospect Course (Row " + (prospect_count + 1) + ")' onkeypress='return alphabaticOnly(event)'>";
    // add_prospect_row += "</div>";
    add_prospect_row += "<div class='col-3'>";
    add_prospect_row += "<label>Enquiry Status:<span style='color: red'>*</span></label>";
    add_prospect_row += "<select id='prospect_followup_status_id_" + prospect_count + "' class='form-control select2 item-required' errorLabel='Prospect Enquiry Status (Row " + (prospect_count + 1) + ")' onchange='onProspectFollowupStatusSelect(" + prospect_count + ")'>";
    add_prospect_row += "<option value=''>----- Select Enquiry Status -----</option>";
    jQuery.each(constants.followup_statuses, function(index, value) {
        add_prospect_row += "<option value='" + index + "'>" + value + "</option>";
    });
    add_prospect_row += "</select>";
    add_prospect_row += "</div>";

    add_prospect_row += "<div class='col-3' id='prospect_followup_date_div_" + prospect_count + "' hidden>";
    add_prospect_row += "<label>Followup Date:<span style='color: red'>*</span></label>";
    add_prospect_row += "<input type='date' name='prospect_followup_date' id='prospect_followup_date_" + prospect_count + "' hidden class='form-control item-required' onchange='validateProspectFollowupDate(" + prospect_count + ")' placeholder='Prospect Followup Date' errorLabel='Prospect Followup Date (Row " + (prospect_count + 1) + ")'>";
    add_prospect_row += "</div>";

    add_prospect_row += "<div class='col-12' id='prospect_course_section_" + prospect_count + "'>";
    add_prospect_row += "<div class='div-border m-t-10 m-b-10 padding-10'>";
    add_prospect_row += "<div class='row'>";
    add_prospect_row += "<div class='col-4' id='prospect_course_div_" + prospect_count + "'>";

    add_prospect_row += "</div>";
    add_prospect_row += "<div class='col-4' id='prospect_affiliated_body_div_" + prospect_count + "'>";

    add_prospect_row += "</div>";
    add_prospect_row += "<div class='col-4' id='prospect_degree_type_div_" + prospect_count + "'>";

    add_prospect_row += "</div>";
    add_prospect_row += "</div>";
    add_prospect_row += "</div>";

    add_prospect_row += "<div class='col-3 pl-5 pt-3 element-flex-end'>";
    add_prospect_row += "<button class='btn btn-danger btn-sm waves-effect waves-light element-flex-end' onclick='workerProspectDelete(" + prospect_count + ")'><i class='mdi mdi-delete'></i> | Delete</button>";
    add_prospect_row += "</div>";
    $("#prospect_details_div").append(add_prospect_row);
    getCoursesBySessionForProspect(prospect_count);
    prospect_count++;
}

function onProspectFollowupStatusSelect(count) {
    selected_status_id = document.getElementById('prospect_followup_status_id_' + count).value;
    if (selected_status_id == 0) {
        document.getElementById('prospect_followup_date_div_' + count).hidden = false;
        document.getElementById('prospect_followup_date_' + count).hidden = false;

    } else if (selected_status_id == 1) {
        document.getElementById('prospect_followup_date_div_' + count).hidden = false;
        document.getElementById('prospect_followup_date_' + count).hidden = false;


    } else if (selected_status_id == 3) {
        document.getElementById('prospect_followup_date_div_' + count).hidden = true;
        document.getElementById('prospect_followup_date_' + count).hidden = true;


    } else if (selected_status_id == "") {

        document.getElementById('prospect_followup_date_div_' + count).hidden = true;
        document.getElementById('prospect_followup_date_' + count).hidden = true;


    } else {
        document.getElementById('prospect_followup_date_div_' + count).hidden = true;
        document.getElementById('prospect_followup_date_' + count).hidden = true;


    }
}

function addWorkerSection() {
    var add_worker_detail_row = '';
    add_worker_detail_row += "<div class='m-t-15 div-border padding-10' id='worker_section_" + worker_section_count + "'>";
    add_worker_detail_row += "<div class='row'>";
    add_worker_detail_row += "<div class='col-md-3'>";
    add_worker_detail_row += "<label>Factory Name:<span style='color: red'>*</span></label>";
    add_worker_detail_row += "<input type='text' name='factory_name' errorLabel='Worker Factory ( Row " + (worker_section_count + 1) + " )' onkeypress='return alphabaticOnly(event)' id='factory_name_" + worker_section_count + "' class='form-control letter_capitalize item-required' placeholder='Factory Name'>";
    add_worker_detail_row += "<span id='factory_name_msg_" + worker_section_count + "' hidden='hidden' style='color: red'>Factory Name Required</span>";
    add_worker_detail_row += "</div>";

    add_worker_detail_row += "<div class='col-md-3'>";
    add_worker_detail_row += "<label>Work Type:<span style='color: red'>*</span></label>";
    add_worker_detail_row += "<select name='worker_work_type_id' id='worker_work_type_id_" + worker_section_count + "' errorLabel='Work Type ( Row " + (worker_section_count + 1) + " )' class='form-control item-required'>";
    add_worker_detail_row += "<option value=''>----- Select -----</option>";
    jQuery.each(constants.work_types, function(index, value) {
        add_worker_detail_row += "<option value='"+index+"'>"+value+"</option>";
    });
    add_worker_detail_row += "</select>";
    add_worker_detail_row += "</div>";

    add_worker_detail_row += "<div class='col-md-3'>";
    add_worker_detail_row += "<label>Service Experience:<span style='color: red'>*</span></label>";
    add_worker_detail_row += "<div class='input-group mb-3'>";
    add_worker_detail_row += "<input type='text' name='experience' onkeypress='return numericOnly(event)' errorLabel='Experience In Years ( Row " + (worker_section_count + 1) + " )' id='worker_experience_in_years_" + worker_section_count + "' class='form-control item-required' placeholder='Experience'>";
    add_worker_detail_row += "<div class='input-group-append'>";
    add_worker_detail_row += "<span class='input-group-text'>Years</span>";
    add_worker_detail_row += "</div>";
    add_worker_detail_row += "<input type='text' name='experience' onkeypress='return numericOnly(event)' errorLabel='Experience In Months ( Row " + (worker_section_count + 1) + " )' id='worker_experience_in_months_" + worker_section_count + "' class='form-control item-required' placeholder='Experience' onkeyup='validateMonthNumber(" + worker_section_count + ")'>";
    add_worker_detail_row += "<div class='input-group-append'>";
    add_worker_detail_row += "<span class='input-group-text'>Months</span>";
    add_worker_detail_row += "</div>";
    add_worker_detail_row += "</div>";
    add_worker_detail_row += "<span id='experience_msg_" + worker_section_count + "' hidden='hidden' style='color: red'>Experience Required</span>";
    add_worker_detail_row += "</div>";

    add_worker_detail_row += "<div class='col-md-3'>";
    add_worker_detail_row += "<label>Designation:<span style='color: red'>*</span></label>";
    add_worker_detail_row += "<input type='text' name='designation' onkeypress='return alphabaticOnly(event)' errorLabel='Designation ( Row " + (worker_section_count + 1) + " )' id='worker_designation_" + worker_section_count + "' class='form-control letter_capitalize item-required' placeholder='Designation'>";
    add_worker_detail_row += "<span id='designation_msg_" + worker_section_count + "' hidden='hidden' style='color: red'>Designation Required</span>";
    add_worker_detail_row += "</div>";

    // add_worker_detail_row += "<div class='col-md-3 pl-5 pt-3'>";
    // add_worker_detail_row += "<input type='checkbox' name='is_eobi' id='is_eobi_" + worker_section_count + "' class='form-check-input'>";
    // add_worker_detail_row += "<label>EOBI</label>";
    // add_worker_detail_row += "</div>";
    // add_worker_detail_row += "<div class='col-md-3 pl-5 pt-3'>";
    // add_worker_detail_row += "<input type='checkbox' name='is_ssc' id='is_social_security_" + worker_section_count + "' class='form-check-input'>";
    // add_worker_detail_row += "<label>S.S.C</label>";
    // add_worker_detail_row += "</div>";

    add_worker_detail_row += "<div class='col-md-3'>";
    add_worker_detail_row += "<label>EOBI/ SSC:<span style='color: red'>*</span></label>";
    add_worker_detail_row += "<select name='eobi_ssc' id='eobi_ssc_id_" + worker_section_count + "' errorLabel='EOBI/ SSC ( Row " + (worker_section_count + 1) + " )' class='form-control item-required'>";
    add_worker_detail_row += "<option value=''>----- Select -----</option>";
    add_worker_detail_row += "<option value='0'>Yes</option>";
    add_worker_detail_row += "<option value='1'>No</option>";
    add_worker_detail_row += "</select>";
    add_worker_detail_row += "</div>";

    // add_worker_detail_row += "<div class='col-md-3 pl-5 pt-3'>";
    // add_worker_detail_row += "<input type='checkbox' name='is_frc' errorLabel='Factory Registered Checkbox ( Row " + (worker_section_count + 1) + " )' id='is_factory_registered_" + worker_section_count + "' class='form-check-input item-required'>";
    // add_worker_detail_row += "<label>Factory Registered<span style='color: red'>*</span></label>";
    // add_worker_detail_row += "<span id='frc_msg_" + worker_section_count + "' hidden='hidden' style='color: red'>Factory Registration Required</span>";
    // add_worker_detail_row += "</div>";

    add_worker_detail_row += "<div class='col-md-3'>";
    add_worker_detail_row += "<label>Factory Registered:<span style='color: red'>*</span></label>";
    add_worker_detail_row += "<select name='is_frc' id='is_factory_registered_" + worker_section_count + "' class='form-control item-required' errorLabel='Factory Registered ( Row " + (worker_section_count + 1) + " )'>";
    add_worker_detail_row += "<option value=''>----- Select -----</option>";
    add_worker_detail_row += "<option value='0'>Yes</option>";
    add_worker_detail_row += "<option value='1'>Not Clear</option>";
    add_worker_detail_row += "</select>";
    add_worker_detail_row += "</div>";

    add_worker_detail_row += "<div class='col-md-3 pl-5 pt-3 element-flex-end'>";
    add_worker_detail_row += "<button class='btn btn-danger btn-sm waves-effect waves-light element-flex-end' onclick='workerSectionDelete(" + worker_section_count + ")'><i class='mdi mdi-delete'></i> | Delete</button>";
    add_worker_detail_row += "</div>";

    add_worker_detail_row += "</div>"; // row ends here

    add_worker_detail_row += "</div>"; // worker complete section ends here
    $("#worker_details").append(add_worker_detail_row);
    worker_section_count++;
}

var selected_transport_id;
var selected_transport;

function onPreviousDegreeSelect() {
    if (document.getElementById('previous_degree_id').value == "12") {
        document.getElementById('other_case_div').hidden = false;
    } else {
        document.getElementById('other_case_div').hidden = true;
    }
}

function onTransportSelect() {
    selected_transport = document.getElementById('is_transport').options[document.getElementById('is_transport').options.selectedIndex].innerText;
    selected_transport_id = document.getElementById('is_transport').value;
    if (selected_transport_id == 0) {
        $("#transport_route").html("");
        var add_transport_route = '';
        // add_transport_route += "<label>Transport Route</label>";
        // add_transport_route += "<select name='transport_route_id' id='transport_route_id' class='form-control item-required'>";
        // add_transport_route += "<option>----- Select -----</option>";
        // jQuery.each(constants.transport_routes, function(index, value) {
        //     add_transport_route += "<option value='" + index + "'>" + value + "</option>";
        // });
        // add_transport_route += "</select>";
        add_transport_route += "<label>Transport Stop:<span style='color: red'>*</span></label>";
        add_transport_route += "<input type='text' name='transport_stop' errorLabel='Transport Stop' id='transport_stop' class='form-control item-required' placeholder='Enter Bus Stop'>";
        add_transport_route += "";
        $("#transport_route").append(add_transport_route);
    } else {
        $("#transport_route").html("");
    }
}

function onProspectTransportSelect(row_index) {
    selected_transport_id = document.getElementById('prospect_is_transport_' + row_index).value;
    if (selected_transport_id == 0) {
        document.getElementById('prospect_transport_stop_div_' + row_index).hidden = false;
        document.getElementById('prospect_transport_stop_' + row_index).classList.add('item-required');
    } else {
        document.getElementById('prospect_transport_stop_div_' + row_index).hidden = true;
        document.getElementById('prospect_transport_stop_' + row_index).classList.remove('item-required');
    }
}
var move_to_followup = false;
var move_to_confirmed_admission = false;

function onFollowupStatusSelect() {
    selected_status_id = document.getElementById('followup_status_id').value;
    if (selected_status_id == 0) {
        document.getElementById('followup_date_div').hidden = false;
        document.getElementById('followup_auto_msg_div').hidden = false;
        document.getElementById('followup_interested_level_div').hidden = true;

        document.getElementById('next_followup_date_id').hidden = false;
        document.getElementById('follow_up_interested_level_id').hidden = true;

        move_to_followup = true;
    } else if (selected_status_id == 1) {
        document.getElementById('followup_date_div').hidden = false;
        document.getElementById('followup_auto_msg_div').hidden = false;
        document.getElementById('followup_interested_level_div').hidden = false;


        document.getElementById('next_followup_date_id').hidden = false;
        document.getElementById('follow_up_interested_level_id').hidden = false;

        move_to_followup = true;
    } else if (selected_status_id == 3) {
        move_to_confirmed_admission = true;
        document.getElementById('followup_date_div').hidden = true;
        document.getElementById('followup_auto_msg_div').hidden = true;
        document.getElementById('followup_interested_level_div').hidden = true;


        document.getElementById('next_followup_date_id').hidden = true;
        document.getElementById('follow_up_interested_level_id').hidden = true;

    } else if (selected_status_id == "") {
        document.getElementById('followup_date_div').hidden = true;
        document.getElementById('followup_auto_msg_div').hidden = true;
        document.getElementById('followup_interested_level_div').hidden = true;

        document.getElementById('next_followup_date_id').hidden = true;
        document.getElementById('follow_up_interested_level_id').hidden = true;

        move_to_followup = false;
    } else {
        document.getElementById('followup_date_div').hidden = true;
        document.getElementById('followup_auto_msg_div').hidden = true;
        document.getElementById('followup_interested_level_div').hidden = true;


        document.getElementById('next_followup_date_id').hidden = true;
        document.getElementById('follow_up_interested_level_id').hidden = true;

        move_to_followup = false;
    }
}

function onSourceOfInformationSelect() {
    selected_source_info_id = document.getElementById('source_info_id').value;

    document.getElementById('marketer_name_div').hidden = true;
    document.getElementById('marketer_name').required = false;

    document.getElementById('other_social_media_name_div').hidden = true;
    document.getElementById('other_social_media_name').required = false;

    document.getElementById('social_media_type_id_div').hidden = true;
    document.getElementById('social_media_type_id').required = false;

    document.getElementById('ex_student_wing_type_id_div').hidden = true;
    document.getElementById('ex_student_wing_type_id').required = false;
    document.getElementById('ex_student_name_div').hidden = true;
    document.getElementById('ex_student_name').required = false;

    document.getElementById('friend_name_div').hidden = true;
    document.getElementById('friend_name').required = false;

    document.getElementById('other_source_of_info_div').hidden = true;
    document.getElementById('other_source_of_info').required = false;

    document.getElementById('faculty_member_name_div').hidden = true;
    document.getElementById('faculty_member_name').required = false;

    document.getElementById('academy_school_name_div').hidden = true;
    document.getElementById('academy_school_name').required = false;



    if (selected_source_info_id == 3) {
        document.getElementById('faculty_member_name_div').hidden = false;
        document.getElementById('faculty_member_name').required = true;

    } else if (selected_source_info_id == 5) {
        document.getElementById('academy_school_name_div').hidden = false;
        document.getElementById('academy_school_name').required = true;

    } else if (selected_source_info_id == 7) {
        document.getElementById('social_media_type_id_div').hidden = false;
        document.getElementById('social_media_type_id').required = true;

    } else if (selected_source_info_id == 17) {
        document.getElementById('marketer_name_div').hidden = false;
        document.getElementById('marketer_name').required = true;
    } else if (selected_source_info_id == 19) {
        document.getElementById('ex_student_wing_type_id_div').hidden = false;
        document.getElementById('ex_student_wing_type_id').required = true;
        document.getElementById('ex_student_name_div').hidden = false;
        document.getElementById('ex_student_name').required = true;

    } else if (selected_source_info_id == 20) {
        document.getElementById('friend_name_div').hidden = false;
        document.getElementById('friend_name').required = true;
    } else if (selected_source_info_id == 21) {
        document.getElementById('other_source_of_info_div').hidden = false;
        document.getElementById('other_source_of_info').required = true;
    }
}

function onSocialMediaSelect() {
    selected_social_media_type_id = document.getElementById('social_media_type_id').value;

    document.getElementById('other_social_media_name_div').hidden = true;
    document.getElementById('other_social_media_name').required = false;

    if (selected_social_media_type_id == 3) {

        document.getElementById('other_social_media_name_div').hidden = false;
        document.getElementById('other_social_media_name').required = true;
    }
}

var enquiry;

function createFormObject(userConsent) {
    enquiry = {
        _token: $("input[name='_token']").val(),
    }
    enquiry.worker_details = [];
    enquiry.prospects = [];
    enquiry.name = document.getElementById('name').value;
    enquiry.user_id = document.getElementById('user_id').value;
    enquiry.enquiry_type = document.getElementById('enquiry_type').value;
    enquiry.father_name = document.getElementById('father_name').value;
    enquiry.father_occupation = document.getElementById('father_occupation').value;
    enquiry.is_domicile = document.getElementById('is_domicile').value;
    enquiry.passing_year = document.getElementById('passing_year').value;
    enquiry.remarks = document.getElementById('remarks').value;
    enquiry.student_category_id = document.getElementById('student_category_id').value;
    enquiry.student_category_name = document.getElementById('student_category_id').options[document.getElementById('student_category_id').options.selectedIndex].innerText;

    if (document.getElementById('student_category_id').value == 0) {
        for (var i = 0; i < worker_section_count; i++) {
            if ($("#worker_section_" + i).attr('row_state') != 'DELETED') {
                var worker = {};
                worker.factory_name = document.getElementById('factory_name_' + i).value;
                worker.worker_experience_in_years = document.getElementById('worker_experience_in_years_' + i).value;
                worker.worker_work_type_id = document.getElementById('worker_work_type_id_' + i).value;
                worker.worker_work_type = document.getElementById('worker_work_type_id_' + i).options[document.getElementById('worker_work_type_id_' + i).options.selectedIndex].innerText;
                worker.worker_experience_in_months = document.getElementById('worker_experience_in_months_' + i).value;
                worker.worker_designation = document.getElementById('worker_designation_' + i).value;

                if (document.getElementById('eobi_ssc_id_' + i).value == "1") {
                    worker.is_eobi = true;
                    worker.is_social_security = true;
                } else {
                    worker.is_eobi = false;
                    worker.is_social_security = false;
                }
                worker.is_factory_registered = $('#is_factory_registered_' + i).val();
                enquiry.worker_details.push(worker);
            }

        }

    }
    if (document.getElementById('prospects_id').value == 0) {
        for (var i = 0; i < prospect_count; i++) {
            if ($("#prospect_section_" + i).attr('row_state') != 'DELETED') {
                var prospect = {};
                prospect.prospect_name = document.getElementById('prospect_name_' + i).value;
                prospect.prospect_relationship = document.getElementById('prospect_relationship_' + i).value;
                prospect.prospect_course = document.getElementById('prospect_course_' + i).value;
                prospect.prospect_affiliated_body_id = document.getElementById('prospect_affiliated_body_id_' + i).value;
                prospect.prospect_affiliated_body_name = document.getElementById('prospect_affiliated_body_id_' + i).options[document.getElementById('prospect_affiliated_body_id_' + i).options.selectedIndex].innerText;
                prospect.prospect_followup_status_id = document.getElementById('prospect_followup_status_id_' + i).value;
                prospect.prospect_academic_term_id = document.getElementById('prospect_academic_term_id_' + i).value;
                prospect.prospect_followup_date = $('#prospect_followup_date_' + i).val();
                prospect.prospect_father_name = $('#prospect_father_name_' + i).val();
                prospect.prospect_shift_id = $('#prospect_shift_id_' + i).val();
                prospect.prospect_is_transport = $('#prospect_is_transport_' + i).val();
                prospect.prospect_contact_number = $('#prospect_contact_number_' + i).val();
                if (prospect.prospect_is_transport != "1") {
                    prospect.prospect_transport_stop = $('#prospect_transport_stop_' + i).val();
                }
                enquiry.prospects.push(prospect);
            }

        }

    }
    enquiry.contact_infos = [];
    for (var i = 0; i < contact_count; i++) {
        // CHECK FOR DELETED FIELDS
        if ($("#contact_row_state_" + i).val() !== 'deleted') {
            var contact_info = {};
            contact_info.phone_no           = document.getElementById('contact_no_' + i).value;
            contact_info.contact_type_id    = document.getElementById('contact_type_' + i).value;
            contact_info.contact_type_name  = document.getElementById('contact_type_' + i).options[document.getElementById('contact_type_' + i).options.selectedIndex].innerText;
            if (contact_info.contact_type_id == 6) {
                contact_info.other_name     = document.getElementById('other_name_' + i).value;
            }

            enquiry.contact_infos[i] = contact_info;
        }
    }
    enquiry.is_transport = document.getElementById('is_transport').value;
    if (enquiry.is_transport == "0") {
        // enquiry.transport_route_id = document.getElementById('transport_route_id').value;
        enquiry.transport_stop = document.getElementById('transport_stop').value;
    }
    enquiry.academic_term_id = document.getElementById('academic_term_id').value;
    enquiry.previous_degree_body = document.getElementById('previous_degree_body').value;
    enquiry.shift_id = document.getElementById('shift_id').value;
    enquiry.gender_id = document.getElementById('gender_id').value;

    enquiry.source_info_id = document.getElementById('source_info_id').value;
    if (enquiry.source_info_id == 7) {
        enquiry.social_media_type_id = document.getElementById('social_media_type_id').value;
        if (enquiry.social_media_type_id == 3) {
            enquiry.other_social_media_name = document.getElementById('other_social_media_name').value;
        }
    } else if (enquiry.source_info_id == 17) {
        enquiry.marketer_name = document.getElementById('marketer_name').value;
    } else if (enquiry.source_info_id == 19) {
        enquiry.ex_student_wing_type_id = document.getElementById('ex_student_wing_type_id').value;
        enquiry.ex_student_name = document.getElementById('ex_student_name').value;
    } else if (enquiry.source_info_id == 20) {
        enquiry.friend_name = document.getElementById('friend_name').value;
    } else if (enquiry.source_info_id == 21) {
        enquiry.other_source_of_info = document.getElementById('other_source_of_info').value;
    }

    enquiry.affiliated_body_id = document.getElementById('affiliated_body_id').value;
    enquiry.affiliated_body_name = document.getElementById('affiliated_body_id').options[document.getElementById('affiliated_body_id').options.selectedIndex].innerText;
    enquiry.followup_status_id = document.getElementById('followup_status_id').value;
    enquiry.marks_obtained = document.getElementById('marks_obtained').value;
    enquiry.total_marks = document.getElementById('total_marks').value;
    enquiry.percentage = document.getElementById('percentage').value;

    enquiry.move_to_follow_up = move_to_followup;
    enquiry.move_to_confirmed_admission = move_to_confirmed_admission;
    // enquiry.student_cell_no = document.getElementById('student_cell_no').value;
    // enquiry.father_cell_no = document.getElementById('father_cell_no').value;
    // enquiry.gaurdian_cell_no = document.getElementById('gaurdian_cell_no').value;
    // enquiry.other_cell_no = document.getElementById('other_cell_no').value;
    enquiry.course_id = document.getElementById('course_id').value;
    enquiry.session_id = document.getElementById('session_id').value;
    enquiry.session_name = document.getElementById('session_id').options[document.getElementById('session_id').options.selectedIndex].innerText;
    enquiry.area = document.getElementById('area').value;
    enquiry.present_address = document.getElementById('present_address').value;
    enquiry.permanent_address = document.getElementById('permanent_address').value;
    enquiry.student_cnic_no = document.getElementById('student_cnic_no').value;
    enquiry.father_cnic_no = document.getElementById('father_cnic_no').value;
    enquiry.email = document.getElementById('email').value;
    enquiry.dob = document.getElementById('dob').value;
    enquiry.enquiry_date = document.getElementById('enquiry_date').value;
    enquiry.city_id = document.getElementById('city_id').value;
    enquiry.other_city_name = document.getElementById('other_city_name').value;
    enquiry.previous_degree_id = document.getElementById('previous_degree_id').value;
    enquiry.previous_degree_name = document.getElementById('previous_degree_id').options[document.getElementById('previous_degree_id').options.selectedIndex].innerText;
    enquiry.degree_name_other = document.getElementById('degree_name_other').value;
    if (move_to_followup) {
        if (!document.getElementById('follow_up_interested_level_id').hidden) {
            enquiry.follow_up_interested_level_id = document.getElementById('follow_up_interested_level_id').value;
        }
        enquiry.next_followup_date_id = document.getElementById('next_followup_date_id').value;
    }

    enquiry.status = statuses[0];
    enquiry.status_id = 0;
    if (!userConsent) {
        swal({
            title: 'Do you want to create this enquiry?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-success',
            showLoaderOnConfirm: true,
            cancelButtonClass: 'btn btn-danger',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                alertify.log("Please wait. Request is in processing.");
                saveEnquiry();
            }
        });
    } else if (userConsent) {
        alertify.log("Please wait. Request is in processing.");
        saveEnquiry();
    } else {
        alertify.error("Some important fields are missing.");
    }

}



function saveEnquiry() {

    $.ajax({
        url: "/enquiries",
        // dataType: "json",
        type: "POST",
        data: enquiry,
        success: function(data) {
            alertify.success("Enquiry created successfully.");
            swal({
                title: 'Enquiry Saved Successfully and Generated Code is given below.',
                text: 'Enquiry Form Code: ' + data.enquiry_form_code,
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
        },
        error: function(data) {
            if (data.status == 0) {
                alertify.error("Internet connection failed.");
            } else {
                swal('Something went wrong!', JSON.parse(data.responseText).error, 'error');
            }
        }
    });

}

function checkDuplicateStudentCellNo() {
    if (validateForm()) {
        createFormObject(false);

        // var cell_no = document.getElementById('student_cell_no').value;
        // if (document.getElementById('student_cell_no') != null && document.getElementById('student_cell_no').value != '') {
        //     alertify.log("Please wait. Request is in processing.");
        //     $.ajax({
        //         url: "/enquiries/student/cell/no/check/" + cell_no,
        //         // dataType: "json",
        //         type: "GET",
        //         success: function(data) {
        //             if (data.duplicate == 1) {
        //                 swal({
        //                     title: 'Student cell number already exists',
        //                     text: 'press cancel to prevent duplicate entry or press yes to procced',
        //                     type: 'error',
        //                     showCancelButton: true,
        //                     confirmButtonColor: '#3085d6',
        //                     cancelButtonColor: '#d33',
        //                     confirmButtonText: 'Yes',
        //                     confirmButtonClass: 'btn btn-success',
        //                     showLoaderOnConfirm: true,
        //                     reverseButtons: false
        //                 }).then((result) => {
        //                     if (result.value) {
        //                         createFormObject(result.value);
        //                     }
        //                 });
        //             } else {
        //                 createFormObject(false);
        //             }
        //         },
        //         error: function(data) {
        //             if (data.status == 0) {
        //                 alertify.error("Internet connection failed.");
        //             } else {
        //                 swal('Something went wrong!', JSON.parse(data.responseText).error, 'error');
        //             }
        //         }

        //     });
        // } else {
        //     document.getElementById('student_contact_msg').hidden = false;
        //     alertify.error('Student cell number is required.')
        // }
    }
}
