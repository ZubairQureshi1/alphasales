$(window).on("load", function() {
    onWorkerSelect();
    getCoursesBySession();
    if (document.getElementById('is_transport') != "" && document.getElementById('is_transport').value == 0) {
        onTransportSelect();
    }
});

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
var selected_worker_id;
var selected_worker;
var academic_count = academicRecord;
$("#add_academic").click(function() {
    addAcademic();
});

function addAcademic(called_for_enquiry) {
    // var add_row = "<script type=\"text/javascript\">  $('#multiple_drops').multiselect();</script>";
    $('.records-alert').remove();
    var academic = {};
    var add_row = "<div class='form-row div-border p-2 mb-2'>";
    add_row += "<div class='form-group col-md-4'>";
    add_row += "<input type='hidden' name='records[" + academic_count + "][id]' value=''>";
    add_row += "<label for='academic_type_" + academic_count + "'>Academic Type</label>";
    add_row += "<select name='records[" + academic_count + "][type_id]' id='academic_type_" + academic_count + "' class='form-control' onchange='otherDegreeType()' row_count='" + academic_count + "'>";
    jQuery.each(constants.previous_degrees, function(key, type) {
        add_row += "<option value='" + key + "'>" + type + "</option>";
    });
    add_row += "</select></div>";
    add_row += "<div class='form-group col-md-4' id='academic_other_degree_div_" + academic_count + "' hidden='true'><label for='academic_other_degree_" + academic_count + "'>Other Degree Name:</label><input id='academic_other_degree_" + academic_count + "' type='text' name='records[" + academic_count + "][other_degree_name]' placeholder='Enter Other Degree Name' class='form-control'></div>"
    add_row += "<div class='form-group col-md-2'><label for='academic_year_" + academic_count + "'>Academic Year:</label><input name='records[" + academic_count + "][years]' id='academic_year_" + academic_count + "' type='text' placeholder='YYYY' data-mask='9999' class='form-control'></div>"
    add_row += "<div class='form-group col-md-2'><label for='academic_roll_no_" + academic_count + "'>Roll Number:</label><input name='records[" + academic_count + "][rollNumbers]' id='academic_roll_no_" + academic_count + "' type='text' placeholder='Roll No.' class='form-control'></div>"
    add_row += "<div class='form-group col-md-2'><label for='academic_marks_" + academic_count + "'>Marks Obtained:</label><input name='records[" + academic_count + "][marks]' id='academic_marks_" + academic_count + "' type='number' min='0'  placeholder='Marks Obtained' class='form-control'></div>"
    add_row += "<div class='form-group col-md-2'><label for='academic_total_marks_" + academic_count + "'>Total Marks:</label><input name='records[" + academic_count + "][totalMarks]' id='academic_total_marks_" + academic_count + "' onchange='validateMarks(" + academic_count + ")' onmouseup='validateMarks(" + academic_count + ")' type='number' placeholder='Total Marks' class='form-control'></div>"
    add_row += "<div class='form-group col-md-2'><label for='academic_percentage_" + academic_count + "'>Percentage:</label><input name='records[" + academic_count + "][percentages]' id='academic_percentage_" + academic_count + "' type='number' placeholder='Percentage' class='form-control' readonly></div>"
    add_row += "<div class='form-group col-md-2'><label for='academic_grade_" + academic_count + "'>Grade:</label><input name='records[" + academic_count + "][grades]' id='academic_grade_" + academic_count + "' type='text' placeholder='Grades' class='form-control'></div>"
    add_row += "<div class='form-group col-md-3'><label for='academic_school_" + academic_count + "'>School/College:</label><input name='records[" + academic_count + "][schools]' id='academic_school_" + academic_count + "' type='text' placeholder='School/College' class='form-control'></div>"
    add_row += "<div class='form-group col-md-4'><label for='academic_board_uni_" + academic_count + "'>Board/University:</label><input name='records[" + academic_count + "][boards]' id='academic_board_uni_" + academic_count + "' type='text' placeholder='Board/University' class='form-control'></div>"
    add_row += "<div class='my-auto pt-2'><button type='button' onclick='deleteStudentAcademicRecord()' class='btn btn-sm btn-danger mr-1'><i class='mdi mdi-delete'></i></button>";
    // add_row += "<button type='button' row_index='" + academic_count + "' id='academic_attachment_btn_" + academic_count + "' class='btn btn-sm btn-primary rounded-0' onclick='selectAcademicAttachmentFile()'>Attach File</button></div>";
    // add_row += "<input type='file' data-target='attachment_input_" + academic_count + "' row_index='" + academic_count + "' class='d-none' name='records['"+academic_count+"'][attachments]' id='academic_attachment_url_" + academic_count + "' onchange='showAcademicAttachmentFile()' value=''/>";
    add_row += "</div>";
    $("#academic_table_body").append(add_row);
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

function deleteStudentAcademicRecord(id = null) {
    event.preventDefault();
    if (id !== null) {
        let btn = event;
        let _this = event;
        // fire swal
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
                // fire ajax call
                $.ajax({
                    url: '/students/deleteAcademicRecords/' + id,
                    type: 'get',
                    success: function(resp) {
                        if (resp) {
                            // remove current row
                            Swal.fire('Action Status', resp, 'success');
                            window.location.reload(history.back());
                        }
                    },
                    error: function(err) {
                        Swal.fire('Error!', `${error}`, 'error')
                    }
                }) // ajax call
            } // if check
        }) // then promise
    } else {
        $(event.target).parent().closest('.form-row').remove();
    }
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

function onWorkerSelect() {
    selected_worker = document.getElementById('student_category_id').options[document.getElementById('student_category_id').options.selectedIndex].innerText;
    selected_worker_id = document.getElementById('student_category_id').value;
    if (selected_worker_id == 0) {
        $("#worker_details").html("");
        var add_worker_detail_row = '';
        add_worker_detail_row += "<div class='col-md-3'>";
        add_worker_detail_row += "<label>CFE File No.</label>";
        add_worker_detail_row += "<input type='text' name='cfe_file_no' value='" + student.cfe_file_no + "' id='cfe_file_no' class='form-control' placeholder='CFE File No'>";
        add_worker_detail_row += "</div>";
        add_worker_detail_row += "<div class='col-md-3'>";
        add_worker_detail_row += "<label>Dairy No</label>";
        add_worker_detail_row += "<input type='text' name='dairy_no' id='dairy_no' value='" + student.dairy_no + "' class='form-control' placeholder='Dairy No'>";
        add_worker_detail_row += "</div>";
        add_worker_detail_row += "<div class='col-md-3'>";
        add_worker_detail_row += "<label>Experience</label>";
        add_worker_detail_row += "<input type='text' name='experience' id='experience' value='" + student.experience + "' class='form-control' placeholder='Experience'>";
        add_worker_detail_row += "</div>";
        add_worker_detail_row += "<div class='col-md-3'>";
        add_worker_detail_row += "<label>Designation</label>";
        add_worker_detail_row += "<input type='text' name='designation' id='designation' value='" + student.designation + "' class='form-control' placeholder='Designation'>";
        add_worker_detail_row += "</div>";
        add_worker_detail_row += "<div class='col-md-3'>";
        add_worker_detail_row += "<label>EOBI</label>";
        add_worker_detail_row += "<input type='text' name='eobi' id='eobi' value='" + student.eobi + "' class='form-control' placeholder='EOBI'>";
        add_worker_detail_row += "</div>";
        add_worker_detail_row += "<div class='col-md-3'>";
        add_worker_detail_row += "<label>S.S.C</label>";
        add_worker_detail_row += "<input type='text' name='ssc' id='ssc' value='" + student.ssc + "' class='form-control' placeholder='S.S.C'>";
        add_worker_detail_row += "</div>";
        add_worker_detail_row += "<div class='col-md-3'>";
        add_worker_detail_row += "<label>Factory Name</label>";
        add_worker_detail_row += "<input type='text' name='factory_name' id='factory_name' value='" + student.factory_name + "' class='form-control' placeholder='Factory Name'>";
        add_worker_detail_row += "</div>";
        add_worker_detail_row += "<div class='col-md-3'>";
        add_worker_detail_row += "<label>Factory City</label>";
        add_worker_detail_row += "<input type='text' name='factory_city' id='factory_city' value='" + student.factory_city + "' class='form-control' placeholder='Factory City'>";
        add_worker_detail_row += "</div>";
        add_worker_detail_row += "<div class='col-md-3'>";
        add_worker_detail_row += "<label>R-8-/D 5</label>";
        add_worker_detail_row += "<input type='text' name='r_eight' id='r_eight' value='" + student.r_eight + "' class='form-control' placeholder='R-8'>";
        add_worker_detail_row += "</div>";
        add_worker_detail_row += "<div class='col-md-3'>";
        add_worker_detail_row += "<label>Factory Registration No.</label>";
        add_worker_detail_row += "<input type='text' name='factory_reg_no' id='factory_reg_no' value='" + student.factory_reg_no + "' class='form-control' placeholder='Factory Registration No'>";
        add_worker_detail_row += "</div>";
        add_worker_detail_row += "<div class='col-md-3'>";
        add_worker_detail_row += "<label>Is Hostel</label>";
        add_worker_detail_row += "<select name='is_hostel' id='is_hostel' class='form-control'>";
        add_worker_detail_row += "<option>----- Select -----</option>";
        jQuery.each(constants.is_hostel, function(i, val) {
            if (i == student.is_hostel) {
                add_worker_detail_row += "<option value='" + i + "' selected>" + val + "</option>";
            } else {
                add_worker_detail_row += "<option value='" + i + "'>" + val + "</option>";
            }
        });
        add_worker_detail_row += "</select>";
        add_worker_detail_row += "</div>";
        add_worker_detail_row += "<div class='col-md-2 pl-5' style='margin-top:3.5%;'>";
        if (student.is_provisional_letter == 1) {
            add_worker_detail_row += "<input type='checkbox' checked name='is_provisional_letter' id='is_provisional_letter' class='form-check-input checkbox-style'>";
            add_worker_detail_row += "<label style=''>Provisional Letter</label>";
        } else {
            add_worker_detail_row += "<input type='checkbox' name='is_provisional_letter' id='is_provisional_letter' class='form-check-input checkbox-style'>";
            add_worker_detail_row += "<label>Provisional Letter</label>";
        }
        add_worker_detail_row += "</div>";
        add_worker_detail_row += "<div class='col-md-2 pl-5 pt-3'>";
        if (student.self_worker == 1) {
            add_worker_detail_row += "<input type='checkbox' checked name='self_worker' id='self_worker' class='form-check-input checkbox-style'>";
            add_worker_detail_row += "<label style=''>Self Worker</label>";
        } else {
            add_worker_detail_row += "<input type='checkbox' name='self_worker' id='self_worker' class='form-check-input checkbox-style'>";
            add_worker_detail_row += "<label>Self Worker</label>";
        }
        add_worker_detail_row += "</div>";
        $("#worker_details").append(add_worker_detail_row);
    }
    if (selected_worker_id == 1) {
        $("#worker_details").html("");
    }
}
var selected_transport_id;
var selected_transport;

function onTransportSelect() {
    selected_transport = document.getElementById('is_transport').options[document.getElementById('is_transport').options.selectedIndex].innerText;
    selected_transport_id = document.getElementById('is_transport').value;
    if (selected_transport_id != "" && selected_transport_id == 0) {
        document.getElementById('transport_stop').hidden = false;
        $("#transport_charges_row").prop('hidden', false);
    } else {
        document.getElementById('transport_stop').hidden = true;
        $("#transport_charges_row").prop('hidden', true);
        document.getElementById('transport_month_count').value = 0;
        document.getElementById('transport_monthly_amount').value = 0;
        $(".transport-has-multiplies").change();
    }
}
$(document).ready(function() {
    show('reason');
});

function show(id) {
    var checkedValue = $("#is_end_of_reg").is(":checked");
    if (checkedValue) {
        document.getElementById(id).style.display = 'block';
    } else {
        document.getElementById(id).style.display = 'none';
    }
}

function profilechange($id) {
    var i = document.getElementById($id);
    var btn = document.getElementById('upload_btn');
    if (i.hidden == true) {
        i.hidden = false;
        btn.hidden = true;
    } else {
        i.hidden = true;
        btn.hidden = false;
    }
}

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
                course_select += "<select id='course_id' name='course_id' class='form-control select2' onchange='onCourseSelect()' disabled>";
                course_select += "<option value=''>--- Select Course ---</option>";
                jQuery.each(data.courses, function(index, value) {
                    if (value.course_id == student.course_id) {
                        course_select += "<option selected value='" + value.course_id + "'>" + value.course_name + "</option>";
                    } else {
                        course_select += "<option value='" + value.course_id + "'>" + value.course_name + "</option>";
                    }
                });
                course_select += "</select></div>";
                document.getElementById('course_select').classList.add('col-3');
                $("#course_select").html(course_select);
                $('.select2').select2();
                onCourseSelect();
            },
            error: function(data) {
                document.getElementById('report_loading').hidden = true;
                swal.showValidationError(`Request failed: ${data}`)
                alertify.error('Something went wrong.')
            }
        });
    }
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
                $("#section_select").html('');
                // $('#course_subjects').modal();
                if (data.sections.length == 0) {
                    $("#section_select").html('');
                } else {
                    var section_select = "<div><strong>Sections (Gender-Code):<span class='required-span'>*</span></strong>";
                    section_select += "<select id='section_id' disabled class='form-control select2' disabled>";
                    jQuery.each(data.sections, function(index, value) {
                        if (value.section_id == student.section_id) {
                            section_select += "<option selected value='" + value.section_id + "'>" + value.section_name + "</option>";
                        } else {
                            section_select += "<option value='" + value.section_id + "'>" + value.section_name + "</option>";
                        }
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
                course_affiliated_body += "<select id='affiliated_body_id' class='form-control select2' disabled>";
                course_affiliated_body += "<option value=''>--- Select Affiliated Body ---</option>";
                jQuery.each(data.affiliated_bodies, function(index, value) {
                    course_affiliated_body += "<optgroup label='" + constants.academic_terms[value.academic_term_id] + "'>";
                    if (value.affiliated_body_id == student.affiliated_body_id) {
                        course_affiliated_body += "<option selected value='" + value.affiliated_body_id + "' body_academic_term='" + value.academic_term_id + "'>" + value.affiliated_body_name + "</option>";
                    } else {
                        course_affiliated_body += "<option value='" + value.affiliated_body_id + "' body_academic_term='" + value.academic_term_id + "'>" + value.affiliated_body_name + "</option>";
                    }
                    course_affiliated_body += "</optgroup>";
                });
                course_affiliated_body += "</select></div>";
                document.getElementById('course_affiliated_body').classList.add('col-3');
                $("#course_affiliated_body").html(course_affiliated_body);
                $('.select2').select2();
                // NOTE: Get course plan if not created
                // PARAM: isNewFeePackage - if not created then true else false
                if (isNewFeePackage) {
                    getCoursePlans();
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

function deletAttachment(id) {
    event.preventDefault();
    let btn = event;
    let _this = event;
    // fire swal
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
            // fire ajax call
            $.ajax({
                url: `/students/attachments/${id}/remove`,
                type: 'get',
                success: function(resp) {
                    if (resp.success) {
                        // remove current row
                        $(btn.target).parents('tr').first().fadeOut('slow');
                        Swal.fire('Action Status', 'Attachment Deleted Successfully!', 'success')
                    }
                },
                error: function(err) {
                    Swal.fire('Error!', `${error}`, 'error')
                }
            }) // ajax call
        } // if check
    }) // then promise
}

function uploadNewAcademicAttachment(id) {
    btn = $('#academic_attachment_btn_' + $(event.target).attr('row_index'));
    data = new FormData();
    data.append('attachment', $(event.target)[0].files[0]);
    $.ajax({
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        },
        url: '/students/uploadAcademicAttachment/' + id,
        type: 'POST',
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        beforeSend: function() {
            btn.html('<i class="fa fa-refresh fa-spin"></i> | Uploading...');
        },
        success: function(resp) {
            btn.removeClass('btn-primary').addClass('btn-success');
            btn.html('<i class="fa fa-check fa-fw"></i> | Uploaded Successfully');
        },
        error: function(error) {
            btn.removeClass('btn-primary').addClass('btn-danger');
            btn.html('<i class="fa fa-times fa-fw"></i> | Error');
            alertify.error('Something Went Wrong!');
        }
    })
}
$("#add_contact").click(function() {
    addContact();
});

function addContact() {
    console.log(contact_count);
    var contact = {};
    var add_row = ""
    add_row += "<tr>"
    add_row += "<td><input name='contact_nos[]' id='contact_no_" + contact_count + "' type='text' placeholder='XXXX-XXXXXXX' data-mask='9999-9999999' class='form-control item-required' errorLabel='Contact No. ( Row " + (contact_count) + " )'></td>";
    add_row += "<td>";
    add_row += "<select name='contact_info_types[]' id='contact_type_" + contact_count + "' onchange='onContactRelationshipSelect(" + contact_count + ")' class='form-control item-required' errorLabel='Contact Type ( Row " + (contact_count) + " )'>";
    jQuery.each(constants.contact_types, function(key, type) {
        add_row += "<option value='" + key + "'>" + type + "</option>";
    });
    add_row += "</select></td>";
    add_row += "<td><input name='contact_other_names[]' id='other_name_" + contact_count + "' type='text' class='form-control' readonly errorLabel='Other Name ( Row " + (contact_count) + " )'></td>";
    add_row += "<td class='text-center'><button type='button' onclick='deleteContactTableRow(" + contact_count + ")' class='btn btn-danger btn-sm waves-effect'><i class='mdi mdi-delete'></i> | Delete</button></td>";
    add_row += "</tr>";
    $("#contact_table_body").append(add_row);
    contact_count++;
}

function onContactRelationshipSelect(count) {
    if ($('#contact_type_' + count).val() == 6) {
        $('#other_name_' + count).prop("readonly", false);
    } else {
        $('#other_name_' + count).prop("readonly", true);
    }
}

function deleteContactTableRow(count) {
    if ($('#contact_table_body tbody tr').length > 1) {
        $(event.target).parents('tr').first().remove();
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
// TODO: get course plan if creating a new fee package
function getCoursePlans() {
    selected_session_id = document.getElementById('session_id').value;
    selected_body_academic_term_id = document.getElementById('affiliated_body_id').options[document.getElementById('affiliated_body_id').options.selectedIndex].getAttribute('body_academic_term');
    selected_affiliated_body_id = document.getElementById('student_affiliated_body_id').value;
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
                affiliated_body_id: selected_affiliated_body_id,
                body_academic_term_id: selected_body_academic_term_id,
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

function requestStudentEnrollement(argument) {
    if (document.getElementById('admission_registration_voucher_code').value != "" && document.getElementById("admission_registration_paid_date").value != "") {
        setupStudentPackage(student, academic_history_id);
    } else {
        alertify.error('System cannot process your request without admission/ registration payment.');
    }
}

function setupStudentPackage(student, academic_history_id) {
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
            swal({
                title: 'Fee Package created successfully!',
                type: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Success',
                confirmButtonClass: 'btn btn-success',
                showLoaderOnConfirm: true,
                reverseButtons: false
            }).then((result) => {
                if (result.value) {
                    window.location.reload(history.back());
                }
            });
        },
        error: function(data) {
            alertify.error(data.responseJSON.error);
        }
    });
}
// function end
