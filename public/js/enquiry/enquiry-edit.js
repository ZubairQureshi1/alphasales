$(document).ready(function() {

   

    onEnquirySelect()
    getCoursesBySession();
    removeRowClickEvent();
    onFileReceivedStatusSelect();

    $('.select2').select2();
    var _source_info_id = document.getElementById('source_info_id').value;
    if (_source_info_id == 19) {
        document.getElementById('ex_student_wing_type_id_div').hidden = false;
    } else if (_source_info_id == 7) {
        document.getElementById('social_media_type_id_div').hidden = false;
    }
});
var contact_count = contactCount;
var deleted_contact_count = 0;
// console.log(document.getElementById('is_domicile').value);
// contact field functions
$("#add_contact").click(function() {
    addContact();
});

function onEnquirySelect() {

    var city_name = document.getElementById('enquiry_type').options[document.getElementById('enquiry_type').options.selectedIndex].innerText;
   // alert(city_name);
    if (city_name == 'Others') {
        document.getElementById('other_enquiry_type').hidden = false;
    } else {
        document.getElementById('other_enquiry_type').hidden = true;
    }
}
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
// city function
function onCitySelect() {

    var city_name = document.getElementById('city_id').options[document.getElementById('city_id').options.selectedIndex].innerText;
    if (city_name == 'Other') {
        document.getElementById('city_other_name').hidden = false;
    } else {
        document.getElementById('city_other_name').hidden = true;
    }
}

function onFileReceivedStatusSelect() {
    var file_received_status = document.getElementById('file_received_status_id').value;
    if (file_received_status == 0) { // If no
        document.getElementById('file_received_number_div').hidden = true;
        document.getElementById('module_number_div').hidden = true;
    } else if(file_received_status == 1) { // if yes
        document.getElementById('file_received_number_div').hidden = false;
        document.getElementById('module_number_div').hidden = false;
    }
}

var selected_course;
var selected_course_id;

function getAffiliatedBodySessions() {
    selected_affiliated_body_id = document.getElementById('affiliated_body_id').value;
    if (selected_affiliated_body_id) {
        document.getElementById('report_loading').hidden = false;
        $.ajax({
            url: $('.appUrl').val()+"/getAffiliatedBodySessions",
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
                swal.showValidationError(`Request failed: ${data}`)
                alertify.error('Something went wrong.')
            }
        });
    }
}



function getCoursesBySession() {
    selected_session_id = document.getElementById('global_session_id').value;
    if (selected_session_id) {
        $.ajax({
            url: $('.appUrl').val()+"/courses/getCoursesBySession/" + selected_session_id,
            // dataType: "json",
            type: "GET",
            success: function(data) {
                document.getElementById('course_information_div').hidden = false;
                var course_select = "<div><strong>Courses:<span class='required-span'>*</span></strong>";
                course_select += "<select id='course_id' class='form-control select2' onchange='getAffiliatedBodiesByCourse()'>";
                course_select += "<option value=''>--- Select Course ---</option>";
                jQuery.each(data.courses, function(index, value) {
                    course_select += "<option value='" + value.course_id + "'>" + value.course_name + "</option>";
                });
                course_select += "</select><span id='course_msg' hidden='hidden' style='color: red'>Course Required</span></div>";
                $("#course_div").html(course_select);
                document.getElementById('course_id').value = enquiry.course_id != null ? enquiry.course_id : ''  ;
                $('#course_id').change();
            },
            error: function(data) {
                document.getElementById('course_information_div').hidden = true;
                swal.showValidationError(`Request failed: ${data}`)
                alertify.error('Something went wrong.')
            }
        });
    }
}

function getAffiliatedBodiesByCourse() {
    selected_session_id = document.getElementById('global_session_id').value;
    selected_course_id = document.getElementById('course_id').value;
    if (selected_course_id && selected_session_id) {
        document.getElementById('report_loading').hidden = false;
        $.ajax({
            url: $('.appUrl').val()+"/courses/getAffiliatedBodiesByCourse?session_id=" + selected_session_id + '&course_id=' + selected_course_id,
            // dataType: "json",
            type: "GET",
            success: function(data) {
                document.getElementById('report_loading').hidden = true;
                var affiliated_body_select = "<div><strong>Affiliated Body:<span class='required-span'>*</span></strong>";
                affiliated_body_select += "<select id='affiliated_body_id' class='form-control select2' onchange='getDegreeTypesByBody()'>";
                affiliated_body_select += "<option value='' selected>--- Select Affiliated Body ---</option>";
                jQuery.each(data.affiliated_bodies, function(index, value) {
                    affiliated_body_select += "<option value='" + value.affiliated_body_id + "'>" + value.affiliated_body_name + "</option>";
                });
                affiliated_body_select += "</select></div>";
                $("#affiliated_body_div").html(affiliated_body_select);
                document.getElementById('affiliated_body_id').value = enquiry.affiliated_body_id != null ? enquiry.affiliated_body_id : '' ;
                $('#affiliated_body_id').change();
                $('#academic_term_div').empty();
            },
            error: function(data) {
                document.getElementById('report_loading').hidden = true;
                swal.showValidationError(`Request failed: ${data}`)
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
            url: $('.appUrl').val()+"/courses/getAffiliatedBodiesByCourse?session_id=" + selected_session_id + '&course_id=' + selected_course_id,
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
                swal.showValidationError(`Request failed: ${data}`)
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
            url: $('.appUrl').val()+"/courses/getDegreeTypesByBody?session_id=" + selected_session_id + '&course_id=' + selected_course_id + '&affiliated_body_id=' + selected_affiliated_body_id,
            // dataType: "json",
            type: "GET",
            success: function(data) {
                document.getElementById('report_loading').hidden = true;
                var academic_term_select = "<div><strong>Degree Type:<span class='required-span'>*</span></strong>";
                academic_term_select += "<select id='academic_term_id' class='form-control select2 item-required' errorLabel='Degree Type'>";
                academic_term_select += "<option value='' selected>--- Select Degree Type ---</option>";
                jQuery.each(data.academic_terms, function(index, value) {
                    academic_term_select += "<option value='" + value.academic_term_id + "'>" + value.academic_term_name + "</option>";
                });
                academic_term_select += "</select></div>";
                $("#academic_term_div").html(academic_term_select);
                $('.select2').select2();
                // $('#academic_term_id option[value="'+enquiry.academic_term_id+'"]').prop("selected",true);
                document.getElementById('academic_term_id').value = enquiry.academic_term_id != null ? enquiry.academic_term_id : '';
                $('#academic_term_id').change();
            },
            error: function(data) {
                document.getElementById('report_loading').hidden = true;
                swal.showValidationError(`Request failed: ${data}`)
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
            url: $('.appUrl').val()+"/courses/getDegreeTypesByBody?session_id=" + selected_session_id + '&course_id=' + selected_course_id + '&affiliated_body_id=' + selected_affiliated_body_id,
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
                swal.showValidationError(`Request failed: ${data}`)
                alertify.error('Something went wrong.')
            }
        });
    }
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
    // remove hidden
    selected_transport = document.getElementById('is_transport').options[document.getElementById('is_transport').options.selectedIndex].innerText;
    selected_transport_id = document.getElementById('is_transport').value;
    if (selected_transport_id == 0) {
        $("#transport_route").html("");
        $('#transport_route').prop('hidden', false);
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
        $('#transport_route').prop('hidden', true);
    }
}
/* FACTORY WORKER DETAILS UPDATE */
var worker_section_count = factoryCount;
var deleted_worker_section_count = 0;

function workerSectionDelete(index) {
    event.preventDefault();
    // check
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

function addWorkerSection() {
    event.preventDefault();
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
        add_worker_detail_row += "<option value='" + index + "'>" + value + "</option>";
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

function onSourceOfInformationSelect() {
    selected_source_info_id = document.getElementById('source_info_id').value;
    // document.getElementById('marketer_name_div').hidden = true;
    // document.getElementById('marketer_name').required = false;
    // document.getElementById('other_social_media_name_div').hidden = true;
    // document.getElementById('other_social_media_name').required = false;
    // document.getElementById('social_media_type_id_div').hidden = true;
    // document.getElementById('social_media_type_id').required = false;
    // document.getElementById('ex_student_wing_type_id_div').hidden = true;
    // document.getElementById('ex_student_wing_type_id').required = false;
    // document.getElementById('ex_student_name_div').hidden = true;
    // document.getElementById('ex_student_name').required = false;
    // document.getElementById('friend_name_div').hidden = true;
    // document.getElementById('friend_name').required = false;
    // document.getElementById('other_source_of_info_div').hidden = true;
    // document.getElementById('other_source_of_info').required = false;
    // document.getElementById('faculty_member_name_div').hidden = true;
    // document.getElementById('faculty_member_name').required = false;
    // document.getElementById('academy_school_name_div').hidden = true;
    // document.getElementById('faculty_member_name').required = false;
    if (selected_source_info_id == 'Referred By') {
        document.getElementById('refer_name_div').hidden = false;
        document.getElementById('other_source_of_info_div').hidden = true;
       // document.getElementById('faculty_member_name').required = true;
    }
    else if (selected_source_info_id == 'Other') {
        document.getElementById('other_source_of_info_div').hidden = false;
        document.getElementById('other_source_of_info').required = true;
        document.getElementById('refer_name_div').hidden = true;
    }
    else{
        document.getElementById('refer_name_div').hidden = true;
        document.getElementById('other_source_of_info_div').hidden = true;
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

function createFormObject(userConsent) {
    enquiry = {
        _token: $("input[name='_token']").val(),
    }

    enquiry.worker_details = [];
    enquiry.prospects = [];
    enquiry.name = document.getElementById('name') != null ? document.getElementById('name').value : '';
    enquiry.user_id = document.getElementById('user_id') != null ? document.getElementById('user_id').value : '';
    enquiry.entry_by = document.getElementById('entry_by') != null ? document.getElementById('entry_by').value : '';
    enquiry.enquiry_type = document.getElementById('enquiry_type') != null ? document.getElementById('enquiry_type').value : '';
    enquiry.name_other_enquiry_type = document.getElementById('name_other_enquiry_type') != null ? document.getElementById('name_other_enquiry_type').value : '';
    enquiry.income_range = document.getElementById('income_range') != null ? document.getElementById('income_range').value : '';
    enquiry.enquiry_date = document.getElementById('enquiry_date') != null ? document.getElementById('enquiry_date').value : '';
    enquiry.introduced_by = document.getElementById('introduced_by') != null ? document.getElementById('introduced_by').value : '';
    enquiry.student_cnic_no = document.getElementById('student_cnic_no') != null ? document.getElementById('student_cnic_no').value : '';
    enquiry.email = document.getElementById('email') != null ? document.getElementById('email').value : '';
    enquiry.dob = document.getElementById('dob') != null ? document.getElementById('dob').value : '';
    enquiry.father_name = document.getElementById('father_name') != null ? document.getElementById('father_name').value : '';
    enquiry.gender_id = document.getElementById('gender_id') != null ? document.getElementById('gender_id').value : '';
    enquiry.city_id = document.getElementById('city_id') != null ? document.getElementById('city_id').value : '';
    enquiry.other_city_name = document.getElementById('other_city_name') != null ? document.getElementById('other_city_name').value : '';
    enquiry.present_address = document.getElementById('present_address') != null ? document.getElementById('present_address').value : '';
    enquiry.permanent_address = document.getElementById('permanent_address') != null ? document.getElementById('permanent_address').value : '';
    enquiry.phone = document.getElementById('phone') != null ? document.getElementById('phone').value : '';
    enquiry.landline = document.getElementById('landline') != null ? document.getElementById('landline').value : '';
    enquiry.source_info_id = document.getElementById('source_info_id') != null ? document.getElementById('source_info_id').value : '';
    enquiry.followup_status_id = document.getElementById('followup_status_id') != null ? document.getElementById('followup_status_id').value : '';

    enquiry.remarks = document.getElementById('remarks') != null ? document.getElementById('remarks').value : '';



    // enquiry.worker_details    = [];
    // enquiry.prospects         = [];
    // enquiry.name              = document.getElementById('name') != null ? document.getElementById('name').value : '';
    // enquiry.user_id           = document.getElementById('user_id') != null ? document.getElementById('user_id').value : '';
    // enquiry.enquiry_type      = document.getElementById('enquiry_type') != null ? document.getElementById('enquiry_type').value : '';
    // enquiry.entry_by          = document.getElementById('entry_by') != null ? document.getElementById('entry_by').value : '';
    // enquiry.remarks           = document.getElementById('remarks') != null ? document.getElementById('remarks').value : '';
    // enquiry.father_name       = document.getElementById('father_name') != null ? document.getElementById('father_name').value : '';
    // enquiry.father_occupation = document.getElementById('father_occupation') != null ? document.getElementById('father_occupation').value : '';
    // enquiry.provisional_letter_application_recieved = document.getElementById('provisional_letter_application_recieved') != null ? document.getElementById('provisional_letter_application_recieved').value : '';
    // enquiry.stamp_paper_filled = document.getElementById('stamp_paper_filled') != null ? document.getElementById('stamp_paper_filled').value : '';

    // if ($('#is_domicile').is(":checked")) {
    //     enquiry.is_domicile = 1;
    // } else {
    //     enquiry.is_domicile = 0;
    // }
    // enquiry.passing_year = document.getElementById('passing_year') != null ? document.getElementById('passing_year').value : '';
    // enquiry.student_category_id = document.getElementById('student_category_id') != null ? document.getElementById('student_category_id').value : '';
    // enquiry.student_category_name = document.getElementById('student_category_id') != null ? document.getElementById('student_category_id').options[document.getElementById('student_category_id').options.selectedIndex].innerText : '';
    // IF STUDENT CATEGORY IS PWWB
    // if (document.getElementById('student_category_id') != null && document.getElementById('student_category_id').value == 0) {
    //     for (var i = 0; i < worker_section_count; i++) {
    //         if ($("#worker_section_" + i).attr('row_state') != 'DELETED') {

    //             var worker                          = {};
    //             worker.factory_name                 = document.getElementById('factory_name_' + i) != null ? document.getElementById('factory_name_' + i).value : '';
    //             worker.worker_name                  = document.getElementById('worker_name_' + i) != null ? document.getElementById('worker_name_' + i).value : '';
    //             worker.worker_experience_in_years   = document.getElementById('worker_experience_in_years_' + i) != null ? document.getElementById('worker_experience_in_years_' + i).value : '';
    //             worker.worker_work_type_id          = document.getElementById('worker_work_type_id_' + i) != null ? document.getElementById('worker_work_type_id_' + i).value : '';
    //             worker.worker_work_type             = document.getElementById('worker_work_type_id_' + i) != null ? document.getElementById('worker_work_type_id_' + i).options[document.getElementById('worker_work_type_id_' + i).options.selectedIndex].innerText : '';
    //             worker.worker_experience_in_months  = document.getElementById('worker_experience_in_months_' + i) != null ? document.getElementById('worker_experience_in_months_' + i).value : '';
    //             worker.worker_designation           = document.getElementById('worker_designation_' + i) != null ? document.getElementById('worker_designation_' + i).value : '';
    //             if (document.getElementById('eobi_ssc_id_' + i) != null && document.getElementById('eobi_ssc_id_' + i).value == "1") {
    //                 worker.is_eobi = document.getElementById('eobi_ssc_id_' + i).value;
    //                 worker.is_social_security = document.getElementById('eobi_ssc_id_' + i).value;
    //             } else {
    //                 worker.is_eobi = document.getElementById('eobi_ssc_id_' + i).value;
    //                 worker.is_social_security = document.getElementById('eobi_ssc_id_' + i).value;
    //             }
    //             worker.is_factory_registered = document.getElementById('is_factory_registered_' + i).value;
    //             enquiry.worker_details.push(worker);
    //         }
    //     }
    //     // save file status
    //     enquiry.file_received_status = document.getElementById('file_received_status_id') != null ? document.getElementById('file_received_status_id').value : '';
    //     if(document.getElementById('file_received_status_id').value == 0) {
    //         enquiry.file_received_number = '';
    //         enquiry.file_module_number   = '';
    //     }
    //     enquiry.file_received_number = document.getElementById('file_received_number_id') != null ? document.getElementById('file_received_number_id').value : '';
    //     enquiry.file_module_number   = document.getElementById('module_number_id') != null ? document.getElementById('module_number_id').value : '';
    // }
    // CONTACT INFORMATION
    // enquiry.contact_infos = [];
    // for (var i = 0; i < contact_count; i++) {
    //     var contact_info = {};
    //     // CHECK FOR DELETED FIELDS
    //     if ($("#contact_row_state_" + i).val() !== 'deleted') {
    //         contact_info.phone_no = document.getElementById('contact_no_' + i).value;
    //         contact_info.contact_type_id = document.getElementById('contact_type_' + i).value;
    //         contact_info.contact_type_name = document.getElementById('contact_type_' + i).options[document.getElementById('contact_type_' + i).options.selectedIndex].innerText;
    //         if (contact_info.contact_type_id == 6) {
    //             contact_info.other_name = document.getElementById('other_name_' + i).value;
    //         }
    //         enquiry.contact_infos[i] = contact_info;
    //     }
    // }
    // TRANSPORT INFORMATION
    // enquiry.is_transport = document.getElementById('is_transport') != null ? document.getElementById('is_transport').value : '';
    // if (enquiry.is_transport == "0") {
    //     // enquiry.transport_route_id = document.getElementById('transport_route_id')!= null ?document.getElementById('transport_route_id').value:'';
    //     enquiry.transport_stop = document.getElementById('transport_stop') != null ? document.getElementById('transport_stop').value : '';
    // }
    // enquiry.academic_term_id = document.getElementById('academic_term_id') != null ? document.getElementById('academic_term_id').value : '';
    // enquiry.previous_degree_id = document.getElementById('previous_degree_id').value;
    // enquiry.shift_id = document.getElementById('shift_id') != null ? document.getElementById('shift_id').value : '';
    // enquiry.gender_id = document.getElementById('gender_id') != null ? document.getElementById('gender_id').value : '';

    enquiry.source_info_id = document.getElementById('source_info_id') != null ? document.getElementById('source_info_id').value : '';
    // SOURCE INFORMATION
    if (enquiry.source_info_id == 7) {
        enquiry.social_media_type_id = document.getElementById('social_media_type_id') != null ? document.getElementById('social_media_type_id').value : '';
        if (enquiry.social_media_type_id == 3) {
            enquiry.other_social_media_name = document.getElementById('other_social_media_name') != null ? document.getElementById('other_social_media_name').value : '';
        }
    } else if (enquiry.source_info_id == 17) {
        enquiry.marketer_name = document.getElementById('marketer_name') != null ? document.getElementById('marketer_name').value : '';
    } else if (enquiry.source_info_id == 3) {
        enquiry.faculty_member_name = document.getElementById('faculty_member_name') != null ? document.getElementById('faculty_member_name').value : '';
    } else if (enquiry.source_info_id == 19) {
        enquiry.ex_student_wing_type_id = document.getElementById('ex_student_wing_type_id') != null ? document.getElementById('ex_student_wing_type_id').value : '';
        enquiry.ex_student_name = document.getElementById('ex_student_name') != null ? document.getElementById('ex_student_name').value : '';
    } else if (enquiry.source_info_id == 20) {
        enquiry.friend_name = document.getElementById('friend_name') != null ? document.getElementById('friend_name').value : '';
    } else if (enquiry.source_info_id == 21) {
        enquiry.other_source_of_info = document.getElementById('other_source_of_info') != null ? document.getElementById('other_source_of_info').value : '';
    } else if (enquiry.source_info_id == 5) {
        enquiry.academy_school_name = document.getElementById('academy_school_name') != null ? document.getElementById('academy_school_name').value : '';
    }
    // enquiry.affiliated_body_id = document.getElementById('affiliated_body_id') != null ? document.getElementById('affiliated_body_id').value : '';
    // enquiry.affiliated_body_name = document.getElementById('affiliated_body_id') != null ? document.getElementById('affiliated_body_id').options[document.getElementById('affiliated_body_id').options.selectedIndex].innerText : '';
    // enquiry.marks_obtained = document.getElementById('marks_obtained') != null ? document.getElementById('marks_obtained').value : '';
    // enquiry.total_marks = document.getElementById('total_marks') != null ? document.getElementById('total_marks').value : '';
    // enquiry.percentage = document.getElementById('percentage') != null ? document.getElementById('percentage').value : '';
    // enquiry.course_id = document.getElementById('course_id') != null ? document.getElementById('course_id').value : '';
    // enquiry.reference_name = document.getElementById('reference_name').value != null ? document.getElementById('reference_name').value : '';
    // enquiry.session_id = document.getElementById('session_id') != null ? document.getElementById('session_id').value : '';
    // enquiry.session_name = document.getElementById('session_id') != null ? document.getElementById('session_id').options[document.getElementById('session_id').options.selectedIndex].innerText : '';
    // enquiry.area = document.getElementById('area') != null ? document.getElementById('area').value : '';
    // enquiry.present_address = document.getElementById('present_address') != null ? document.getElementById('present_address').value : '';
    // enquiry.permanent_address = document.getElementById('permanent_address') != null ? document.getElementById('permanent_address').value : '';
    // enquiry.student_cnic_no = document.getElementById('student_cnic_no') != null ? document.getElementById('student_cnic_no').value : '';
    // enquiry.father_cnic_no = document.getElementById('father_cnic_no') != null ? document.getElementById('father_cnic_no').value : '';
    // enquiry.email = document.getElementById('email') != null ? document.getElementById('email').value : '';
    // enquiry.dob = document.getElementById('dob') != null ? document.getElementById('dob').value : '';
    // enquiry.enquiry_date = document.getElementById('enquiry_date') != null ? document.getElementById('enquiry_date').value : '';
    // enquiry.city_id = document.getElementById('city_id') != null ? document.getElementById('city_id').value : '';
    // enquiry.other_city_name = document.getElementById('other_city_name').value != null ? document.getElementById('other_city_name').value : '';
    // enquiry.previous_degree_id = document.getElementById('previous_degree_id').value !== null ? document.getElementById('previous_degree_id').value : '';
    // enquiry.previous_degree_name = document.getElementById('previous_degree_id') != null ? document.getElementById('previous_degree_id').options[document.getElementById('previous_degree_id').options.selectedIndex].innerText : '';
    // enquiry.degree_name_other = document.getElementById('degree_name_other') != null ? document.getElementById('degree_name_other').value : '';
    // enquiry.previous_degree_body = document.getElementById('previous_degree_body') != null ? document.getElementById('previous_degree_body').value : '';
    enquiry.status_id = 0;
    if (!userConsent) {
        swal({
            title: 'Do you want to update this enquiry?',
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
                console.log(enquiry);
                updateEnquiry();
            }
        });
    } else if (userConsent) {
        alertify.log("Please wait. Request is in processing.");
        updateEnquiry();
    } else {
        alertify.error("Some important fields are missing.");
    }
}
// update enquiry
function updateEnquiry(_enquiry) {
    let _id = $('#enquiry_id').val();
    $.ajax({
        url: $('.appUrl').val()+"/enquiries/" + _id + '/update',
        // dataType: "json",
        type: "POST",
        data: enquiry,
        success: function(data) {
            alertify.success("Enquiry updated successfully.");
            swal({
                title: 'Enquiry Updated Successfully.',
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

function checkNumberDuplicacy() {
    var notify = $.notify('Please wait! Verifying number uniqueness.', 'message', {
        clickToHide: true,
        arrowShow: true,
        autoHide: false,
    });
    enquiry = {
        _token: $("input[name='_token']").val(),
    }
    enquiry.contact_infos = [];
    // for (var i = 0; i < contact_count; i++) {
    //     // CHECK FOR DELETED FIELDS
    //     if ($("#contact_row_state_" + i).val() !== 'deleted') {
    //         var contact_info = {};
    //         contact_info.phone_no = document.getElementById('contact_no_' + i) != null ? document.getElementById('contact_no_' + i).value : '';
    //         contact_info.contact_type_id = document.getElementById('contact_type_' + i) != null ? document.getElementById('contact_type_' + i).value : '';
    //         contact_info.contact_type_name = document.getElementById('contact_type_' + i) != null ? document.getElementById('contact_type_' + i).options[document.getElementById('contact_type_' + i).options.selectedIndex].innerText : '';
    //         if (contact_info.contact_type_id == 6) {
    //             contact_info.other_name = document.getElementById('other_name_' + i) != null ? document.getElementById('other_name_' + i).value : '';
    //         }
    //         enquiry.contact_infos.push(contact_info);
    //     }
    // }
    enquiry.phone = document.getElementById('phone') != null ? document.getElementById('phone').value : '';

    // enquiry.student_cnic_no = document.getElementById('student_cnic_no') != null ? document.getElementById('student_cnic_no').value : '';
    if (enquiry.phone /* || (enquiry.student_cnic_no != null && enquiry.student_cnic_no != '')*/ ) {
        // alertify.log("Please wait. Request is in processing.");
        $.ajax({
            url: $('.appUrl').val()+"/enquiries/student/checkNumberDuplicacy",
            // dataType: "json",
            type: "POST",
            data: enquiry,
            success: function(data) {
                if (data.duplicate) {
                    swal({
                        title: data.duplicacy_message,
                        text: 'press cancel to prevent duplicate entry or press yes to procced',
                        type: 'error',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes',
                        confirmButtonClass: 'btn btn-success',
                        showLoaderOnConfirm: true,
                        reverseButtons: false
                    }).then((result) => {
                        if (result.value) {
                            createFormObject(result.value);
                        } else {
                            $.notify('Processing stopped successfully.', 'message');
                        }
                    });
                } else {
                    createFormObject(false, notify);
                }
            },
            error: function(data) {
                if (data.status == 0) {
                    $.notify('Internet connection failed.', 'error');
                } else {
                    swal('Something went wrong!', JSON.parse(data.responseText).error, 'error');
                }
            }
        });
    } else {
        document.getElementById('student_contact_msg').hidden = false;
        alertify.error('Student cell number is required.')
    }
}

function checkDuplicateStudentCellNo() {
    if (validateForm()) {
        createFormObject(false);
    }
}
