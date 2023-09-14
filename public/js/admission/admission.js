$(document).ready(function() {
    getCoursesBySession();
    onSourceOfInformationSelect();
    onCitySelect();
    if (typeof enquiry !== 'undefined' && enquiry.previous_degree_id != null) {
        addAcademic('enquiry'); // called for enquiry
    } else if (typeof pwwb !== 'undefined') {
        addAcademic('pwwb'); // called for pwwb
    }
    if (typeof enquiry !== 'undefined' && enquiry.previous_degree_id != null) {
        $.each(enquiry.enquiry_contact_infos, function(key, value) {
            addContact(true);
        });
    } else if (typeof pwwb !== 'undefined') {
        $.each(pwwb.student_contact_number, function(key, value) {
            addContact(true);
        });
    } else {
        addContact(false);
    }
    onSocialMediaSelect();
    onTransportSelect();
});
var contact_count = 0;
var deleted_contact_count = 0;
$("#add_contact").click(function() {
    addContact();
});

function capitalizeFirstLetter(string) {
    if (string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }
}

function addContact(called_for_enquiry) {
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
    add_row += "<td><input id='other_name_" + contact_count + "' type='text' class='form-control' disabled onkeypress='return alphabaticOnly(event)' errorLabel='Other Name ( Row " + (contact_count + 1) + " )'></td>";
    add_row += "<td class='text-center'><div row_index='" + contact_count + "' class='deleteContactRowButton btn btn-danger btn-sm waves-effect'><i class='mdi mdi-delete'></i> | Delete</div></td>";
    add_row += "<input type='hidden' name='contact_row_state_" + contact_count + "' id='contact_row_state_" + contact_count + "' value='unchanged'></input>";
    add_row += "</tr>";
    $("#contact_table_body").append(add_row);
    removeContactRowClickEvent();
    if (called_for_enquiry) {
        if (typeof enquiry !== 'undefined' && enquiry.previous_degree_id != null) {
            document.getElementById('contact_no_' + contact_count).value = enquiry.enquiry_contact_infos[contact_count].phone_no;
            document.getElementById('contact_type_' + contact_count).value = enquiry.enquiry_contact_infos[contact_count].contact_type_id;
            if (enquiry.enquiry_contact_infos[contact_count].contact_type_id == 6) {
                document.getElementById('other_name_' + contact_count).value = enquiry.enquiry_contact_infos[contact_count].other_name;
                document.getElementById('other_name_' + contact_count).disabled = false;
            }
        } else if (typeof pwwb !== 'undefined') {
            document.getElementById('contact_no_' + contact_count).value = pwwb.student_contact_number[contact_count].contact_no;
            const pwwb_relation = Object.entries(constants.contact_types).reduce((obj, [key, value]) => ({ ...obj,
                [value]: key
            }), {});
            const relation_value = pwwb_relation[capitalizeFirstLetter(pwwb.student_contact_number[contact_count].student_contact_relationship)];
            document.getElementById('contact_type_' + contact_count).value = typeof relation_value !== 'undefined' ? relation_value : 0;
            if (pwwb.student_contact_number[contact_count].specify_relationship !== null) {
                document.getElementById('other_name_' + contact_count).value = pwwb.student_contact_number[contact_count].specify_relationship;
                document.getElementById('other_name_' + contact_count).disabled = false;
            }
        }
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

function removeContactRowClickEvent() {
    $('#contact_table_body').off('click', '.deleteContactRowButton').on('click', '.deleteContactRowButton', deleteContactTableRow);
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
var academic_count = 0;
$("#add_academic").click(function() {
    addAcademic();
});
var ca_section_show = false;

function showCASection() {
    ca_section_show = $('#is_ca').is(':checked'); // retrieve the value
    if (ca_section_show) {
        $('#ca_section').removeAttr('hidden');
    } else {
        $('#ca_section').attr('hidden', 'hidden');
    }
}

function addAcademic(called_for_enquiry) {
    // var add_row = "<script type=\"text/javascript\">  $('#multiple_drops').multiselect();</script>";
    var academic = {};
    var add_row = "<div class='form-row div-border p-2 mb-2'>";
    add_row += "<div class='form-group col-md-4'>";
    add_row += "<label for='academic_type_" + academic_count + "'>Academic Type</label>";
    add_row += "<select id='academic_type_" + academic_count + "' class='form-control' onchange='otherDegreeType()' row_count='" + academic_count + "'>";
    jQuery.each(constants.previous_degrees, function(key, type) {
        add_row += "<option value='" + key + "'>" + type + "</option>";
    });
    add_row += "</select></div>";
    add_row += "<div class='form-group col-md-4' id='academic_other_degree_div_" + academic_count + "' hidden='true'><label for='academic_other_degree_" + academic_count + "'>Other Degree Name:</label><input id='academic_other_degree_" + academic_count + "' type='text' placeholder='Enter Other Degree Name' class='form-control'></div>"
    add_row += "<div class='form-group col-md-2'><label for='academic_year_" + academic_count + "'>Academic Year:</label><input id='academic_year_" + academic_count + "' type='text' placeholder='YYYY' data-mask='9999' class='form-control'></div>"
    add_row += "<div class='form-group col-md-2'><label for='academic_roll_no_" + academic_count + "'>Roll Number:</label><input id='academic_roll_no_" + academic_count + "' type='text' placeholder='Roll No.' class='form-control'></div>"
    add_row += "<div class='form-group col-md-2'><label for='academic_marks_" + academic_count + "'>Marks Obtained:</label><input id='academic_marks_" + academic_count + "' type='number' min='0'  placeholder='Marks Obtained' class='form-control'></div>"
    add_row += "<div class='form-group col-md-2'><label for='academic_total_marks_" + academic_count + "'>Total Marks:</label><input id='academic_total_marks_" + academic_count + "' onchange='validateMarks(" + academic_count + ")' onmouseup='validateMarks(" + academic_count + ")' type='number' placeholder='Total Marks' class='form-control'></div>"
    add_row += "<div class='form-group col-md-2'><label for='academic_percentage_" + academic_count + "'>Percentage:</label><input id='academic_percentage_" + academic_count + "' type='number' placeholder='Percentage' class='form-control' readonly></div>"
    add_row += "<div class='form-group col-md-2'><label for='academic_grade_" + academic_count + "'>Grade:</label><input id='academic_grade_" + academic_count + "' type='text' placeholder='Grades' class='form-control'></div>"
    add_row += "<div class='form-group col-md-3'><label for='academic_school_" + academic_count + "'>School/College:</label><input id='academic_school_" + academic_count + "' type='text' placeholder='School/College' class='form-control'></div>"
    add_row += "<div class='form-group col-md-4'><label for='academic_board_uni_" + academic_count + "'>Board/University:</label><input id='academic_board_uni_" + academic_count + "' type='text' placeholder='Board/University' class='form-control'></div>"
    add_row += "<div class='my-auto pt-2'><button type='button' row_index='" + academic_count + "' class='btn btn-sm btn-danger deleteRowButton mr-2'><i class='mdi mdi-delete'></i></button>";
    add_row += "<button type='button' row_index='" + academic_count + "' id='academic_attachment_btn_" + academic_count + "' class='btn btn-sm btn-primary rounded-0' onclick='selectAcademicAttachmentFile()'>Attach File</button></div>";
    add_row += "<input type='file' data-target='attachment_input_" + academic_count + "' row_index='" + academic_count + "' class='d-none' name='academic_attachment_url_" + academic_count + "' id='academic_attachment_url_" + academic_count + "' onchange='showAcademicAttachmentFile()' value=''/>";
    add_row += "<input type='hidden' name='academic_row_state_" + academic_count + "' id='academic_row_state_" + academic_count + "' value='unchanged' />";
    add_row += "</div>";
    $("#academic_table_body").append(add_row);
    removeRowClickEvent();
    if ($('#combo').attr('name') == "edit_combo") {
        $("#row_state_" + academic_count).val('edited');
    }
    if (called_for_enquiry == 'enquiry') {
        document.getElementById('academic_type_' + academic_count).value = enquiry.previous_degree_id;
        document.getElementById('academic_year_' + academic_count).value = enquiry.passing_year;
        document.getElementById('academic_marks_' + academic_count).value = enquiry.marks_obtained;
        document.getElementById('academic_total_marks_' + academic_count).value = enquiry.total_marks;
        document.getElementById('academic_percentage_' + academic_count).value = enquiry.percentage;
        document.getElementById('academic_school_' + academic_count).value = enquiry.academy_school_name;
    } else if (called_for_enquiry == 'pwwb') {
        if (pwwb.previous_degree.previous_course) {
            document.getElementById('academic_type_' + academic_count).value = 12
            document.getElementById('academic_other_degree_div_' + academic_count).hidden = false;
            document.getElementById('academic_other_degree_' + academic_count).value = pwwb.previous_degree.previous_course;
            document.getElementById('academic_year_' + academic_count).value = pwwb.previous_degree.previous_passing_date;
            document.getElementById('academic_roll_no_' + academic_count).value = pwwb.previous_degree.previous_roll_no;
            document.getElementById('academic_marks_' + academic_count).value = pwwb.previous_degree.previous_marks_obtained;
            document.getElementById('academic_total_marks_' + academic_count).value = pwwb.previous_degree.previous_total_marks;
            document.getElementById('academic_percentage_' + academic_count).value = pwwb.previous_degree.previous_percentage;
            document.getElementById('academic_board_uni_' + academic_count).value = pwwb.previous_degree.board_university;
            document.getElementById('academic_grade_' + academic_count).value = pwwb.previous_degree.previous_cgpa;
        }
    }
    academic_count++;
}

function otherDegreeType() {
    let id = $(event.target).val();
    let count = $(event.target).attr('row_count');
    // check if course is other
    if (id == 12) {
        document.getElementById('academic_other_degree_div_' + count).hidden = false;
    } else {
        document.getElementById('academic_other_degree_div_' + count).hidden = true;
    }
}

function courseSelect() {
    console.log('select called');
}

function removeRowClickEvent() {
    $('#academic_table_body').off('click', '.deleteRowButton').on('click', '.deleteRowButton', deleteAcademicTableRow);
}

function deleteAcademicTableRow(table_name) {
    $(this).parent().closest('.form-row').hide();
    var cat_index = $(this).attr('row_index');
    $("#academic_row_state_" + cat_index).val('deleted');
}

function selectAcademicAttachmentFile() {
    let count = event.target.getAttribute('row_index');
    if ($('#academic_attachment_url_' + count).attr('row-status') == 'deleted') {
        $('#academic_attachment_url_' + count).attr('row-status', 'edited');
    }
    $('#academic_attachment_url_' + count).trigger('click');
}

function showAcademicAttachmentFile() {
    let count = event.target.getAttribute('row_index');
    $('#academic_attachment_btn_' + count).prop('disabled', true).after('<span class="btn btn-primary btn-sm rounded-0" onclick="removeAcademicAttachedFile(' + count + ')" style="cursor: pointer;">X</span>');
}

function removeAcademicAttachedFile(count) {
    let file = $("academic_attachment_url_" + count);
    file.attr('row-status', 'deleted');
    file.prop('disabled', false);
    $(event.target).remove();
}

function delete_admission(id) {
    swal({
        title: 'Do you want to delete this admission form?',
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
            $.ajax({
                url: "/enquiries/" + id + '/delete',
                // dataType: "json",
                method: "GET",
                success: function(data) {
                    orderIndexTable()
                },
                error: function(data) {
                    swal('Something went wrong!', data.statusText, 'error')
                }
            });
        } else if (
            // Read more about handling dismissals
            result.dismiss === swal.DismissReason.cancel) {
            swal('Cancelled', 'Admission form deletion cancelled successfully', 'error')
        }
    });
}
var selected_course_id;
var selected_course;
var admission = {};
var selected_degree_level_id;

function getCoursesBySession() {
    selected_session_id = document.getElementById('session_id').value;
    if (selected_session_id != '') {
        document.getElementById('report_loading').hidden = false;
        $.ajax({
            url: "/courses/getCoursesBySession/" + selected_session_id,
            // dataType: "json",
            type: "GET",
            success: function(data) {
                document.getElementById('report_loading').hidden = true;
                var course_select = "<div><strong>Courses:<span class='required-span'>*</span></strong>";
                course_select += "<select id='course_id' class='form-control select2' onchange='onCourseSelect()'>";
                course_select += "<option value=''>--- Select Course ---</option>";
                jQuery.each(data.courses, function(index, value) {
                    course_select += "<option value='" + value.course_id + "'>" + value.course_name + "</option>";
                });
                course_select += "</select></div>";
                document.getElementById('course_select').classList.add('col-3');
                $("#course_select").html(course_select);
                $('.select2').select2();
                if (typeof enquiry !== 'undefined') {
                    document.getElementById('course_id').value = enquiry.course_id != null ? enquiry.course_id : '';
                    $('#course_id').change();
                } else if (typeof pwwb !== 'undefined') {
                    document.getElementById('course_id').value = pwwb.course_id != null ? pwwb.course_id : '';
                    $('#course_id').change();
                }
            },
            error: function(data) {
                document.getElementById('report_loading').hidden = true;
                swal.showValidationError(`Request failed: ${data}`)
                alertify.error('Something went wrong.')
            }
        });
    }
}
var courseSubjects = [];

function onSemesterSelect() {
    admission.courseBooks = [];
    $("#course_subject").html("");
    selected_semester_id = document.getElementById('semester_id').value;
    jQuery.each(courseSubjects, function(index, value) {
        if (value.annual_semester == constants.semesters_years[selected_semester_id]) {
            var add_row = "<div class='row'><div class='col-sm-6'>";
            add_row += "<strong>Subject Name: </strong>";
            add_row += "<label>" + value.subject_name + "</label></div>";
            add_row += "<div class='col-sm-6'><div class='text-center '><input name='course_id' type='checkbox' checked id='" + value.subject_id + "' onclick='onBooksSelect(" + value.subject_id + ")' switch='bool' value='" + value.subject_name + "'></input>"
            add_row += "<label for='" + value.subject_id + "' data-on-label='Yes' data-off-label='No'></label></div></div>";
            add_row += "</div>";
            $("#course_subject").append(add_row);
            onBooksSelect(value.subject_id);
        }
    });
    console.log(admission.courseBooks);
}

function onCourseSelect() {
    selected_session_id = document.getElementById('session_id').value;
    selected_course_id = document.getElementById('course_id').value;
    selected_semester_id = document.getElementById('semester_id').value;
    selected_course = document.getElementById('course_id').options[document.getElementById('course_id').options.selectedIndex].innerText;
    if (selected_course_id) {
        document.getElementById('report_loading').hidden = false;
        $.ajax({
            url: "/getCourseDetails",
            // dataType: "json",
            type: "POST",
            data: {
                _token: $("input[name='_token']").val(),
                id: selected_course_id,
                session_id: selected_session_id
            },
            success: function(data) {
                document.getElementById('report_loading').hidden = true;
                $('#student_category_id').change();
                $("#section_select").html('');
                $("#course_subject").html("");
                courseSubjects = data.subjects;
                jQuery.each(data.subjects, function(index, value) {
                    if (value.annual_semester == constants.semesters_years[selected_semester_id]) {
                        var add_row = "<div class='row'><div class='col-sm-6'>";
                        add_row += "<strong>Subject Name: </strong>";
                        add_row += "<label>" + value.subject_name + "</label></div>";
                        add_row += "<div class='col-sm-6'><div class='text-center '><input name='course_id' type='checkbox' checked id='" + value.subject_id + "' onclick='onBooksSelect(" + value.subject_id + ")' switch='bool' value='" + value.subject_name + "'></input>"
                        add_row += "<label for='" + value.subject_id + "' data-on-label='Yes' data-off-label='No'></label></div></div>";
                        add_row += "</div>";
                        $("#course_subject").append(add_row);
                        onBooksSelect(value.subject_id);
                    }
                });
                // $('#course_subjects').modal();
                if (data.sections.length == 0) {
                    $("#section_select").html('');
                } else {
                    var section_select = "<div><strong>Sections (Gender-Code):<span class='required-span'>*</span></strong>";
                    section_select += "<select id='section_id' class='form-control select2'>";
                    jQuery.each(data.sections, function(index, value) {
                        section_select += "<option value='" + value.section_id + "'>" + value.section_name + "</option>";
                    });
                    section_select += "</select></div>";
                    document.getElementById('section_select').classList.add('col-3');
                    $("#section_select").html(section_select);
                    $('.select2').select2();
                }
            },
            error: function(data) {
                document.getElementById('report_loading').hidden = true;
                swal.showValidationError(`Request failed: ${data}`)
                alertify.error('Something went wrong.')
            }
        });
        $.ajax({
            url: "/courses/getAffiliatedBodiesByCourse?session_id=" + selected_session_id + '&course_id=' + selected_course_id,
            // dataType: "json",
            type: "GET",
            success: function(data) {
                document.getElementById('report_loading').hidden = true;
                $("#course_affiliated_body").html("");
                var course_affiliated_body = "<div><strong>Affiliated Body:<span class='required-span'>*</span></strong>";
                course_affiliated_body += "<select id='affiliated_body_id' class='form-control select2' onchange='getCoursePlans()'>";
                course_affiliated_body += "<option value=''>--- Select Affiliated Body ---</option>";
                jQuery.each(data.affiliated_bodies, function(index, value) {
                    course_affiliated_body += "<optgroup label='" + constants.academic_terms[value.academic_term_id] + "'>";
                    course_affiliated_body += "<option value='" + value.affiliated_body_id + "' body_academic_term='" + value.academic_term_id + "'>" + value.affiliated_body_name + "</option>";
                    course_affiliated_body += "</optgroup>";
                });
                course_affiliated_body += "</select></div>";
                document.getElementById('course_affiliated_body').classList.add('col-3');
                $("#course_affiliated_body").html(course_affiliated_body);
                $('.select2').select2();
                if (typeof enquiry !== 'undefined') {
                    $('#affiliated_body_id option[value="' + enquiry.affiliated_body_id + '"]').prop('selected', true);
                    $('#affiliated_body_id').change();
                } else if (typeof pwwb !== 'undefined') {
                    $('#affiliated_body_id option[value="' + pwwb.affiliated_body_id + '"]').prop('selected', true);
                    $('#affiliated_body_id').change();
                }
            },
            error: function(data) {
                document.getElementById('report_loading').hidden = true;
                swal.showValidationError(`Request failed: ${data}`)
                alertify.error('Something went wrong.')
            }
        });
    }
}
// function getAffiliatedBodySessions() {
//     selected_affiliated_body_id = document.getElementById('affiliated_body_id').value;
//     if (selected_affiliated_body_id) {
//         document.getElementById('report_loading').hidden = false;
//         $.ajax({
//             url: "/getAffiliatedBodySessions",
//             // dataType: "json",
//             type: "POST",
//             data: {
//                 _token: $("input[name='_token']").val(),
//                 id: selected_affiliated_body_id
//             },
//             success: function(data) {
//                 document.getElementById('report_loading').hidden = true;
//                 var session_select = "<div><strong>Sessions:<span class='required-span'>*</span></strong>";
//                 session_select += "<select id='session_id' class='form-control' onchange='getCoursePlans()'>";
//                 session_select += "<option value=''>--- Select Session ---</option>";
//                 jQuery.each(data.sessions, function(index, value) {
//                     session_select += "<option value='" + value.id + "'>" + value.session_name + "</option>";
//                 });
//                 session_select += "</select></div>";
//                 document.getElementById('session_select').classList.add('col-3');
//                 $("#session_select").html(session_select);
//             },
//             error: function(data) {
//                 document.getElementById('report_loading').hidden = true;
//                 swal.showValidationError(
//                     `Request failed: ${data}`
//                 )
//                 alertify.error('Something went wrong.')
//             }
//         });
//     }
// }
function getCoursePlans() {
    selected_session_id = document.getElementById('session_id').value;
    selected_body_academic_term_id = document.getElementById('affiliated_body_id').options[document.getElementById('affiliated_body_id').options.selectedIndex].getAttribute('body_academic_term');
    selected_affiliated_body_id = document.getElementById('affiliated_body_id').value;
    selected_course_id = document.getElementById('course_id').value;
    if (selected_body_academic_term_id) {
        document.getElementById('report_loading').hidden = false;
        $.ajax({
            url: "/getCoursePlans",
            // dataType: "json",
            type: "POST",
            data: {
                _token: $("input[name='_token']").val(),
                session_id: selected_session_id,
                body_academic_term_id: selected_body_academic_term_id,
                affiliated_body_id: selected_affiliated_body_id,
                course_id: selected_course_id,
            },
            success: function(data) {
                document.getElementById('report_loading').hidden = true;
                if (data.success) {
                    document.getElementById('report_loading').hidden = true;
                    $('#admission_form').prop('hidden', !data.form_display);
                    $('#admission_message').prop('hidden', data.form_display);
                    document.getElementById('cfe_admission_fee').value = data.sessionCourse.cfe_admission_fee != null ? data.sessionCourse.cfe_admission_fee : 0;
                    document.getElementById('marketer_incentive').value = data.sessionCourse.marketer_incentive != null ? data.sessionCourse.marketer_incentive : 0;
                    document.getElementById('registration_fee').value = data.sessionCourse.registration_fee != null ? data.sessionCourse.registration_fee : 0;
                    $('.admission-has-sum').change();
                    document.getElementById('tuition_fee').value = data.sessionCourse.tuition_fee != null ? data.sessionCourse.tuition_fee : 0;
                    document.getElementById('discount').max = document.getElementById('tuition_fee').value;
                    document.getElementById('net_tuition_fee').value = data.sessionCourse.tuition_fee != null ? data.sessionCourse.tuition_fee : 0;
                    document.getElementById('miscellaneous_charges').value = data.sessionCourse.miscellaneous != null ? data.sessionCourse.miscellaneous : 0;
                    $('.has-sum').change();
                    // call affiliated checklist function
                    getAffiliatedBodyCheckLists(document.getElementById('affiliated_body_id').value);
                } else {
                    alertify.error(data.message);
                    $('#admission_form').prop('hidden', true);
                    $('#admission_message').prop('hidden', false);
                }
            },
            error: function(data) {
                document.getElementById('report_loading').hidden = true;
                swal.showValidationError(`Request failed: ${data}`)
                alertify.error('Something went wrong.')
            }
        });
    } else {
        alertify.error('Select affiliated body to proceed.');
    }
}

function onBooksSelect(bookInput) {
    name = document.getElementById(bookInput).value;
    if (!admission.courseBooks) {
        admission.courseBooks = [];
    }
    if (!admission.courseBooks.includes(name)) {
        admission.courseBooks.push(name);
    } else {
        index = admission.courseBooks.indexOf(name);
        admission.courseBooks.splice(index, 1);
    }
}
var selected_worker_id;
var selected_worker;
// function onWorkerSelect() {
//     selected_worker = document.getElementById('student_category_id').options[document.getElementById('student_category_id').options.selectedIndex].innerText;
//     selected_worker_id = document.getElementById('student_category_id').value;
//     if (selected_worker_id == 0) {
//         $("#worker_details").html("");
//         var add_worker_detail_row = '';
//         add_worker_detail_row += "<div class='col-md-3'>";
//         add_worker_detail_row += "<label>CFE File No.</label>";
//         add_worker_detail_row += "<input type='text' name='cfe_file_no' id='cfe_file_no' class='form-control' placeholder='CFE File No' value='"+pwwb.file_received_number+"'>";
//         add_worker_detail_row += "</div>";
//         add_worker_detail_row += "<div class='col-md-3'>";
//         add_worker_detail_row += "<label>Dairy No</label>";
//         add_worker_detail_row += "<input type='text' name='dairy_no' id='dairy_no' class='form-control' placeholder='Dairy No' value='"+pwwb.pwwb_diary_number+"'>";
//         add_worker_detail_row += "</div>";
//         add_worker_detail_row += "<div class='col-md-3'>";
//         add_worker_detail_row += "<label>Experience</label>";
//         add_worker_detail_row += "<input type='text' name='experience' id='experience' class='form-control' placeholder='Experience' value='"+sum(pwwb.service_detail)+"'>";
//         add_worker_detail_row += "</div>";
//         add_worker_detail_row += "<div class='col-md-3'>";
//         add_worker_detail_row += "<label>Joining Date</label>";
//         add_worker_detail_row += "<input type='date' name='worker_joining_date' id='worker_joining_date' class='form-control' placeholder='Joining Date' value='"+calculateJoiningDate()+"'>";
//         add_worker_detail_row += "</div>";
//         add_worker_detail_row += "<div class='col-md-3'>";
//         add_worker_detail_row += "<label>Designation</label>";
//         add_worker_detail_row += "<input type='text' name='designation' id='designation' class='form-control' placeholder='Designation' value='"+pwwb.worker_personal_detail.pwwb_scholarship_form+"'>";
//         add_worker_detail_row += "</div>";
//         add_worker_detail_row += "<div class='col-md-3'>";
//         add_worker_detail_row += "<label>EOBI</label>";
//         add_worker_detail_row += "<input type='text' name='eobi' id='eobi' class='form-control' placeholder='EOBI' value='"+pwwb.worker_bank_security_detail.eobi_number+"'>";
//         add_worker_detail_row += "</div>";
//         add_worker_detail_row += "<div class='col-md-3'>";
//         add_worker_detail_row += "<label>S.S.C</label>";
//         add_worker_detail_row += "<input type='text' name='ssc' id='ssc' class='form-control' placeholder='S.S.C' value='"+pwwb.worker_bank_security_detail.social_security+"'>";
//         add_worker_detail_row += "</div>";
//         add_worker_detail_row += "<div class='col-md-3'>";
//         add_worker_detail_row += "<label>Factory Name</label>";
//         add_worker_detail_row += "<input type='text' name='factory_name' id='factory_name' class='form-control' placeholder='Factory Name' value='"+pwwb.factory_detail.factory_name+"'>";
//         add_worker_detail_row += "</div>";
//         add_worker_detail_row += "<div class='col-md-3'>";
//         add_worker_detail_row += "<label>Factory City</label>";
//         add_worker_detail_row += "<input type='text' name='factory_city' id='factory_city' class='form-control' placeholder='Factory City' value='"+pwwb.factory_detail.factory_address+"'>";
//         add_worker_detail_row += "</div>";
//         add_worker_detail_row += "<div class='col-md-3'>";
//         add_worker_detail_row += "<label>R-8-/D 5</label>";
//         add_worker_detail_row += "<input type='text' name='r_eight' id='r_eight' class='form-control' placeholder='R-8'>";
//         add_worker_detail_row += "</div>";
//         add_worker_detail_row += "<div class='col-md-3'>";
//         add_worker_detail_row += "<label>Factory Registration No.</label>";
//         add_worker_detail_row += "<input type='text' name='factory_reg_no' id='factory_reg_no' class='form-control' placeholder='Factory Registration No' value='"+pwwb.factory_detail.factory_registration_number+"'>";
//         add_worker_detail_row += "</div>";
//         add_worker_detail_row += "<div class='col-md-2 pl-5 pt-3'>";
//         add_worker_detail_row += "<input type='checkbox' name='self_worker' id='self_worker' class='form-check-input'>";
//         add_worker_detail_row += "<label>Self Worker</label>";
//         add_worker_detail_row += "</div>";
//         add_worker_detail_row += "<div class='col-md-2 pl-5 pt-3'>";
//         add_worker_detail_row += '<input type="checkbox" name="is_provisional_letter" id="is_provisional_letter" class="form-check-input" ';
//         add_worker_detail_row += (pwwb.provisional_claim_detail.status !== null && pwwb.provisional_claim_detail.status !== 'no') ? 'checked' : '';
//         add_worker_detail_row += '/>';
//         add_worker_detail_row += "<label for='is_provisional_letter'>Provisional Letter</label>";
//         add_worker_detail_row += "</div>";
//         $("#worker_details").append(add_worker_detail_row);
//     } else {
//         $("#worker_details").html("");
//     }
// }
function onCitySelect() {

    var city_name = document.getElementById('city_id').options[document.getElementById('city_id').options.selectedIndex].innerText;
    if (city_name == 'Other') {
        document.getElementById('city_other_name').hidden = false;
    } else {
        document.getElementById('city_other_name').hidden = true;
    }
}
var selected_transport_id;
var selected_transport;

function onTransportSelect() {
    selected_transport = document.getElementById('is_transport').options[document.getElementById('is_transport').options.selectedIndex].innerText;
    selected_transport_id = document.getElementById('is_transport').value;
    if (selected_transport_id == "0") {
        $("#transport_stop_div").prop('hidden', false);
        $("#transport_stop").prop('hidden', false);
        $("#transport_charges_row").prop('hidden', false);
    } else {
        $("#transport_stop_div").prop('hidden', true);
        $("#transport_stop").prop('hidden', true);
        $("#transport_charges_row").prop('hidden', true);
        document.getElementById('transport_month_count').value = 0;
        document.getElementById('transport_monthly_amount').value = 0;
        $(".transport-has-multiplies").change();
    }
}
var countAttachment = 0;

function AddAttachment() {
    var add_attachment_row = '';
    add_attachment_row += "<tr>";
    add_attachment_row += "<td>";
    add_attachment_row += "<input type='file' name='attachment' id='attachment" + countAttachment + "' class='form-control-file'>";
    add_attachment_row += "</td>";
    add_attachment_row += "<td>";
    add_attachment_row += "<select id='attachment_type_id" + countAttachment + "' name='attachment_type_id' class='form-control'>";
    add_attachment_row += "<option value=''>-- Select Attachment Type --</option>";
    jQuery.each(constants.attachment_types, function(key, attachmentType) {
        add_attachment_row += "<option value='" + key + "'>" + attachmentType + "</option>";
    });
    add_attachment_row += "</select>";
    add_attachment_row += "</td>";
    add_attachment_row += "<td class='text-center'>";
    add_attachment_row += "<div row_id ='" + countAttachment + "' class='deleteRowButton btn btn-danger btn-sm'><i class='fa fa-trash remove-attachment-row' aria-hidden='true'></i></div>";
    add_attachment_row += "</td>";
    add_attachment_row += "<input type='hidden' name='attachment_row_state_" + countAttachment + "' id='attachment_row_state_" + countAttachment + "' value='unchanged'></input>";
    add_attachment_row += "</tr>";
    $("#attachment_table_body").append(add_attachment_row);
    removeRowEvent();
    if ($('#combo').attr('name') == "edit_combo") {
        $("#row_state_" + countAttachment).val('edited');
    }
    countAttachment++;
}

function removeRowEvent() {
    $('#attachment_table_body').off('click', '.deleteRowButton').on('click', '.deleteRowButton', deleteAttachmentTableRow);
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
    document.getElementById('other_social_media_name_div').hidden = true;
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

function deleteAttachmentTableRow(table_name) {
    $(this).parents('tr').first().hide();
    var index = $(this).attr('row_id');
    $("#attachment_row_state_" + index).val('deleted');
}
var formdata = new FormData();
var form_validated = false;

function validateAdmissionForm() {
    var self = this;
    alertify.confirm("Are you sure to proceed?", function(ev) {
        ev.preventDefault();
        if (validateForm()) {
            if (validateDates()) {
                admission._token = $("input[name='_token']").val();
                if (typeof enquiry !== 'undefined') {
                    admission.enquiry_id = enquiry.id;
                } else if (typeof pwwb !== 'undefined') {
                    admission.pwwb_id = pwwb.id;
                }
                admission.student_name = document.getElementById('student_name').value;
                admission.student_cnic_no = document.getElementById('student_cnic_no').value;
                admission.admission_date = document.getElementById('admission_date').value;
                admission.father_name = document.getElementById('father_name').value;
                admission.father_cnic_no = document.getElementById('father_cnic_no').value;
                admission.affiliated_body_id = document.getElementById('affiliated_body_id').value;
                admission.academic_term_id = document.getElementById('affiliated_body_id').options[document.getElementById('affiliated_body_id').options.selectedIndex].getAttribute('body_academic_term');
                admission.counselor_by = document.getElementById('counselor_by').value;
                admission.d_o_b = document.getElementById('d_o_b').value;
                admission.email = document.getElementById('email').value;
                admission.gaurdian_name = document.getElementById('gaurdian_name').value;
                admission.student_occupation = document.getElementById('student_occupation').value;
                admission.father_occupation = document.getElementById('father_occupation').value;
                admission.city_id = document.getElementById('city_id').value;
                admission.other_city_name = document.getElementById('other_city_name').value;
                admission.area = document.getElementById('area').value;
                admission.gaurdian_relationship = document.getElementById('gaurdian_relationship').value;
                admission.present_address = document.getElementById('present_address').value;
                admission.permanent_address = document.getElementById('permanent_address').value;
                admission.father_work_address = document.getElementById('father_work_address').value;
                admission.student_work_address = document.getElementById('student_work_address').value;
                admission.gender_id = document.getElementById('gender_id').value;
                admission.gender = document.getElementById('gender_id').options[document.getElementById('gender_id').options.selectedIndex].innerText;
                admission.shift_id = document.getElementById('shift_id').value;
                admission.shift = document.getElementById('shift_id').options[document.getElementById('shift_id').options.selectedIndex].innerText;
                admission.semester_id = document.getElementById('semester_id').value;
                admission.semester = document.getElementById('semester_id').options[document.getElementById('semester_id').options.selectedIndex].innerText;
                admission.course_name = document.getElementById('course_id').options[document.getElementById('course_id').options.selectedIndex].innerText;
                admission.course_id = document.getElementById('course_id').value;
                admission.guardian_cnic = document.getElementById('guardian_cnic').value;
                section_id = document.getElementById('section_id') != null ? document.getElementById('section_id').value : '';
                admission.section_id = section_id;
                session_id = document.getElementById('session_id').value;
                admission.session_id = session_id;
                session_name = document.getElementById('session_id').options[document.getElementById('session_id').options.selectedIndex].innerText;
                admission.source_info_id = document.getElementById('source_info_id').value;
                if (admission.source_info_id == 7) {
                    admission.social_media_type_id = document.getElementById('social_media_type_id').value;
                    if (admission.social_media_type_id == 3) {
                        admission.other_social_media_name = document.getElementById('other_social_media_name').value;
                    }
                } else if (admission.source_info_id == 3) {
                    admission.faculty_member_name = document.getElementById('faculty_member_name').value;
                } else if (admission.source_info_id == 5) {
                    admission.academy_school_name = document.getElementById('academy_school_name').value;
                } else if (admission.source_info_id == 17) {
                    admission.marketer_name = document.getElementById('marketer_name').value;
                } else if (admission.source_info_id == 19) {
                    admission.ex_student_wing_type_id = document.getElementById('ex_student_wing_type_id').value;
                    admission.ex_student_name = document.getElementById('ex_student_name').value;
                } else if (admission.source_info_id == 20) {
                    admission.friend_name = document.getElementById('friend_name').value;
                } else if (admission.source_info_id == 21) {
                    admission.other_source_of_info = document.getElementById('other_source_of_info').value;
                }
                if (document.getElementById('is_transport').value == 0) {
                    admission.transport_stop = document.getElementById('transport_stop').value;
                }
                admission.is_transport = document.getElementById('is_transport').value;
                admission.is_hostel = document.getElementById('is_hostel').value;
                worker_id = document.getElementById('student_category_id').value;
                admission.student_category_id = worker_id;
                admission.student_category_name = document.getElementById('student_category_id').options[document.getElementById('student_category_id').options.selectedIndex].innerText;
                // if (worker_id == 0) {
                //     admission.self_worker = $('#self_worker').is(":checked");
                //     admission.is_provisional_letter = $('#is_provisional_letter').is(":checked");
                //     admission.cfe_file_no = document.getElementById('cfe_file_no').value;
                //     admission.dairy_no = document.getElementById('dairy_no').value;
                //     admission.experience = document.getElementById('experience').value;
                //     admission.worker_joining_date = document.getElementById('worker_joining_date').value;
                //     admission.designation = document.getElementById('designation').value;
                //     admission.eobi = document.getElementById('eobi').value;
                //     admission.ssc = document.getElementById('ssc').value;
                //     admission.factory_name = document.getElementById('factory_name').value;
                //     admission.factory_city = document.getElementById('factory_city').value;
                //     admission.factory_reg_no = document.getElementById('factory_reg_no').value;
                //     admission.r_eight = document.getElementById('r_eight').value;
                // }
                if (document.getElementById('enquiry_id') && document.getElementById('enquiry_id').value) {
                    admission.enquiry_id = document.getElementById('enquiry_id').value;
                }
                admission.attachmentData = [];
                if (countAttachment > 0) {
                    for (var i = 0; i < countAttachment; i++) {
                        var files = $('#attachment' + i)[0].files[0];
                        if (document.getElementById('attachment_row_state_' + i).value !== 'deleted') {
                            var attachment = document.getElementById('attachment_type_id' + i).value;
                            formdata.append('files[]', files);
                            admission.attachmentData[i] = attachment;
                        }
                    }
                }
                // save contact infos
                admission.contact_infos = [];
                for (var i = 0; i < contact_count; i++) {
                    // CHECK FOR DELETED FIELDS
                    if ($("#contact_row_state_" + i).val() !== 'deleted') {
                        var contact_info = {};
                        contact_info.contact_no = document.getElementById('contact_no_' + i) != null ? document.getElementById('contact_no_' + i).value : '';
                        contact_info.contact_type_id = document.getElementById('contact_type_' + i) != null ? document.getElementById('contact_type_' + i).value : '';
                        contact_info.contact_type_name = document.getElementById('contact_type_' + i) != null ? document.getElementById('contact_type_' + i).options[document.getElementById('contact_type_' + i).options.selectedIndex].innerText : '';
                        if (contact_info.contact_type_id == 6) {
                            contact_info.contact_type_other_name = document.getElementById('other_name_' + i) != null ? document.getElementById('other_name_' + i).value : '';
                        }
                        admission.contact_infos[i] = contact_info;
                    }
                }
                if ($('#profile_image').val() !== "") {
                    let profile_image = $('#profile_image')[0].files[0];
                    formdata.append('profile_image', profile_image);
                }
                // save affiliated bodies checklist
                admission.checklist = [];
                if (affiliated_body_checklist) {
                    for (var i = 0; i < affiliated_body_checklist.length; i++) {
                        admission.checklist[i] = {
                            'id': $('#checklistCheckBox_' + i).val(),
                            'status': $('#checklistCheckBox_' + i).is(':checked') ? true : false
                        };
                    }
                }
                admission.acadmicRecords = [];
                if (academic_count > 0) {
                    for (var i = 0; i < academic_count; i++) {
                        if (document.getElementById('academic_row_state_' + i).value != 'deleted') {
                            var record = {
                                type_name: constants.previous_degrees[document.getElementById('academic_type_' + i).value],
                                type_id: document.getElementById('academic_type_' + i).value,
                                other_degree_name: document.getElementById('academic_other_degree_' + i).value,
                                year: document.getElementById('academic_year_' + i).value,
                                grade: document.getElementById('academic_grade_' + i).value,
                                marks: document.getElementById('academic_marks_' + i).value,
                                total_marks: document.getElementById('academic_total_marks_' + i).value,
                                percentage: document.getElementById('academic_percentage_' + i).value,
                                roll_no: document.getElementById('academic_roll_no_' + i).value,
                                school_college: document.getElementById('academic_school_' + i).value,
                                board_uni: document.getElementById('academic_board_uni_' + i).value,
                                attachment_url: $('academic_attachment_url_' + i).attr('data-target')
                            }
                            if ($('#academic_attachment_url_' + i)[0].files[0] && $('#academic_attachment_url_' + i).attr('row-status') !== 'deleted') {
                                formdata.append('academic_attachments[' + record.type_id + ']', $('#academic_attachment_url_' + i)[0].files[0]);
                            }
                            admission.acadmicRecords[i] = record;
                        }
                    }
                } else {
                    // $('#academic_record_message').html('Atleast One Academic Record Required').css('color', 'red');
                    // isException = true;
                }
                // formdata.append('file', $('#attachment')[0].files[0]);
                self.formdata.append('data', JSON.stringify(admission));
                self.form_validated = true;
                debugger;
                if (worker_id == 0) {
                    requestStudentEnrollement('pwwb');
                } else {
                    $('.nav-tabs a[href="#accounts_form"]').tab('show');
                }
            }
        }
    }, function(ev) {
        ev.preventDefault();
        alertify.error("Admission Process Cancelled Successfully.");
    });
}

function selectProfileImage() {
    event.preventDefault();
    $('.profile-input').trigger("click");
}

function readURL(input, target) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $(target).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
var affiliated_body_checklist;

function getAffiliatedBodyCheckLists(ab_id) {
    let field = '';
    $.ajax({
        url: '/admissions/getAffiliatedBodyCheckLists/' + ab_id,
        type: 'get',
        success: function(resp) {
            $('#checklists').empty();
            if (resp.length > 0) {
                affiliated_body_checklist = resp;
                field += '<div class="list-group my-3">';
                $.each(resp, function(index, el) {
                    field += '<input type="checkbox" name="checklists" value="' + el.id + '" id="checklistCheckBox_' + index + '" />';
                    field += '<label class="list-group-item" for="checklistCheckBox_' + index + '">' + el.description + '</label>';
                })
                field += '</div>';
            } else {
                field += '<div class="text-danger py-3"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> No Check List Added!</div>';
            }
            // response
            $('#checklists').append(field);
        }
    })
}
