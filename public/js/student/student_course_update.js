$(() => {
    getStudentCoursesBySession();
});

function getStudentCoursesBySession() {
    selected_session_id = document.getElementById('student_session_id').value;
    if (selected_session_id != '') {
        document.getElementById('course_change_loader').hidden = false;
        $.ajax({
            url: "/courses/getCoursesBySession/" + selected_session_id + "?organization_campus=" + document.getElementById('organization_campus_id').value,
            // dataType: "json",
            type: "GET",
            success: function(data) {
                debugger;
                document.getElementById('course_change_loader').hidden = true;
                var course_select = "<div><strong>Courses:<span class='required-span'>*</span></strong>";
                course_select += "<select id='student_course_id' name='course_id' class='form-control select2' onchange='onStudentCourseSelect()' required>";
                course_select += "<option value=''>--- Select Course ---</option>";
                jQuery.each(data.courses, function(index, value) {
                    if (value.course_id == student.course_id) {
                        course_select += "<option selected value='" + value.course_id + "'>" + value.course_name + "</option>";
                    } else {
                        course_select += "<option value='" + value.course_id + "'>" + value.course_name + "</option>";
                    }
                });
                course_select += "</select></div>";
                document.getElementById('student_course_select').classList.add('col-3');
                $("#student_course_select").html(course_select);
                $('.select2').select2();
                onStudentCourseSelect();
            },
            error: function(data) {
                document.getElementById('course_change_loader').hidden = true;
                swal.showValidationError(`Request failed: ${data}`)
                alertify.error('Something went wrong.')
            }
        });
    }
}
var can_change_course;
var message;
// TODO: get course plan if creating a new fee package
function getCoursePlansOnCourseChange() {
    selected_session_id = document.getElementById('session_id').value;
    selected_body_academic_term_id = document.getElementById('student_affiliated_body_id').options[document.getElementById('student_affiliated_body_id').options.selectedIndex].getAttribute('body_academic_term');
    selected_affiliated_body_id = document.getElementById('student_affiliated_body_id').value;
    selected_course_id = document.getElementById('student_course_id').value;
    var self = this;
    if (selected_body_academic_term_id) {
        document.getElementById('course_change_loader').hidden = false;
        $.ajax({
            url: "/getCoursePlans",
            // dataType: "json",
            type: "POST",
            data: {
                _token: $("input[name='_token']").val(),
                session_id: selected_session_id,
                affiliated_body_id: selected_affiliated_body_id,
                body_academic_term_id: selected_body_academic_term_id,
                organization_campus_id: document.getElementById('organization_campus_id').value,
                course_id: selected_course_id,
            },
            beforeSend: function() {
                $('#course_subjects').empty();
                $('#course_subjects').html(`<button class="btn btn-primary btn-sm"><i class="fa fa-refresh fa-fw fa-spin" aria-hidden="true"></i> Fetching Details...</button>`);
            },
            success: function(data) {
                document.getElementById('course_change_loader').hidden = true;
                if (data.success) {
                    document.getElementById('course_change_loader').hidden = true;
                    getCourseSubjects(selected_course_id, student);
                    self.can_change_course = true;
                } else {
                    $('#course_subjects').empty();
                    self.can_change_course = false;
                    self.message = data.message;
                    alertify.error(data.message);
                }
            },
            error: function(data) {
                document.getElementById('course_change_loader').hidden = true;
                swal.showValidationError(`Request failed: ${data}`)
                alertify.error('Something went wrong.')
            }
        });
    } else {
        alertify.error('Select affiliated body to proceed.');
    }
}

function onStudentCourseSelect() {
    selected_session_id = document.getElementById('student_session_id').value;
    selected_course_id = document.getElementById('student_course_id').value;
    selected_semester_id = document.getElementById('semester_id').value;
    selected_course = document.getElementById('student_course_id').options[document.getElementById('student_course_id').options.selectedIndex].innerText;
    if (selected_course_id) {
        document.getElementById('course_change_loader').hidden = false;
        // NOTE: Call Subjects Function
        $.ajax({
            url: "/courses/getAffiliatedBodiesByCourse?session_id=" + selected_session_id + '&course_id=' + selected_course_id + '&organization_campus=' + document.getElementById('organization_campus_id').value,
            // dataType: "json",
            type: "GET",
            success: function(data) {
                document.getElementById('course_change_loader').hidden = true;
                $("#student_course_affiliated_body").html("");
                var course_affiliated_body = "<div><strong>Affiliated Body:<span class='required-span'>*</span></strong>";
                course_affiliated_body += "<select id='student_affiliated_body_id' name='affiliated_body_id' class='form-control select2' onchange='getCoursePlansOnCourseChange()' required>";
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
                document.getElementById('student_course_affiliated_body').classList.add('col-3');
                $("#student_course_affiliated_body").html(course_affiliated_body);
                $('.select2').select2();
                if (document.getElementById('student_affiliated_body_id').value != "") {
                    getCoursePlansOnCourseChange();
                }
            },
            error: function(data) {
                document.getElementById('course_change_loader').hidden = true;
                swal.showValidationError(`Request failed: ${data}`)
                alertify.error('Something went wrong.')
            }
        });
    }
}

function getCourseSubjects(course_id, student) {
    $.ajax({
        url: '/getStudentCourseSubjects',
        type: 'POST',
        data: {
            course: course_id,
            _token: $("input[name='_token']").val(),
            student: {
                'id': student.id,
                'annual_semester': student.semester,
                'organization_campus_id': document.getElementById('organization_campus_id').value,
                'session_id': student.session_id,
            }
        },
        beforeSend: function() {
            $('#course_subjects').empty();
            $('#course_subjects').html(`<button class="btn btn-primary btn-sm"><i class="fa fa-refresh fa-fw fa-spin" aria-hidden="true"></i> Fetching Subjects...</button>`);
        },
        success: function(resp) {
            $('#course_subjects').empty();
            if (resp.subjects.length !== 0) {
                // table
                let course_subjects = '';
                course_subjects += '<table class="table table-striped table-hover col-12">';
                course_subjects += '<thead>';
                course_subjects += '<tr>';
                course_subjects += '<th>#</th>';
                course_subjects += '<th>Subject Name</th>';
                course_subjects += '<th class="text-center">Semester / Annual</th>';
                course_subjects += '</tr>';
                course_subjects += '</thead>';
                course_subjects += '<tbody>';
                $.each(resp.subjects, function(key, value) {
                    course_subjects += '<input type="hidden" name="subject_names[]" value="' + value.subject_name + '">';
                    course_subjects += '<tr>';
                    course_subjects += '<td>' + (key + 1) + '</td>';
                    course_subjects += '<td>' + value.subject_name + '</td>';
                    course_subjects += '<td class="text-center">' + value.annual_semester + '</td>';
                    course_subjects += '</tr>';
                });
                course_subjects += '</tbody>';
                course_subjects += '</table>';
                $('#course_subjects').html(course_subjects);
            } else {
                $('#course_subjects').empty();
                $('#course_subjects').html(`<button class="btn btn-danger btn-sm" type="button" disabled><i class="fa fa-remove fa-fw" aria-hidden="true"></i> No Subjects Found...</button>`);
            }
        },
        error: function(data) {
            document.getElementById('course_change_loader').hidden = true;
            swal.showValidationError(`Request failed: ${data}`)
            alertify.error('Something went wrong.')
        }
    });
}

function submitForm() {
    if (this.can_change_course) {
        $('#course_change_form').submit();
    } else {
        alertify.error(self.message);
    }
}