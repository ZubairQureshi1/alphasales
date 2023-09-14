var Global_count = 0;

function onAddSessionDetails(is_edit_mode = false, session_id = null) {
    Global_count++;
    $.notify("Please Wait!", "info");
    $.ajax({
        url: "/sessions/getSessionDetails/?row_count=" + Global_count + '&is_edit_mode=' + is_edit_mode + '&session_id=' + session_id,
        // dataType: "json",
        type: "GET",
        success: function(data) {
            $('#session_detail').append(data);
            $.notify("New degree section added. Scroll down to the last.", "success");
        },
        error: function(data) {
            Global_count--;
            $.notify("Whoops! Something went wrong.", "error");
        }
    });
}

function onCourseSelect(row_count) {
    if (document.getElementById('courseName' + row_count).value != "" && document.getElementById('courseName' + row_count).value != undefined) {
        $.ajax({
            url: "/sessions/getCourseAffiliatedBodies/" + document.getElementById('courseName' + row_count).value,
            // dataType: "json",
            type: "GET",
            success: function(data) {
                $('#course_affiliated_body_div' + row_count).html(data);
            },
            error: function(data) {
                swal.showValidationError(`Request failed: ${data}`)
                alertify.error('Something went wrong.')
            }
        });
    } else {
        $('#courses_div').html('');
    }
}

function removeDegreeFromSession(event, row_count, session_id, course_id) {
    event.target.disabled = true;
    alertify.error('Please wait! you request is in processing.')
    $.ajax({
        url: "/sessions/removeDegreeFromSession/?session_id=" + session_id + '&course_id=' + course_id,
        // dataType: "json",
        type: "GET",
        success: function(data) {
            $('#sessionDetailRow' + row_count).html("");
            $.notify(data.message, "success");
            event.target.disabled = false;
        },
        error: function(data) {
            event.target.disabled = false;
            $.notify("Whoops! Something went wrong.", "error");
        }
    });
}

function deleteSessionDetail(row_count) {
    $('#sessionDetailRow' + row_count).html("");
}

function autoCompleteCourseName(row_count) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajax({
        url: "/sessions/autoCompleteCourseName",
        // dataType: "json",
        data: {
            course_name: $('#courseName' + row_count).val(),
            row_count: row_count,
            affiliated_body_id: $('#affiliated_body' + row_count).val(),
        },
        type: "POST",
        success: function(data) {
            $('#courseNameSuggestions' + row_count).html(data);
        },
        error: function(data) {
            swal.showValidationError(`Request failed: ${data}`)
            alertify.error('Something went wrong.')
        }
    });
}

function updateDegreeInSession(event, row_count) {
    event.target.disabled = true;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    var form = $("#session_form_" + row_count);
    $.ajax({
        url: form.attr('action'),
        // dataType: "json",
        data: form.serializeArray(),
        type: form.attr('method'),
        success: function(data) {
            $.notify(data.message, "success");
            event.target.disabled = false;
        },
        error: function(data) {
            $.notify(data.responseJSON.message, "error");
            event.target.disabled = false;
        }
    });
}

function completeName(courseId, row_count, affiliatedId = null) {
    // $('#courseName'+row_count).val(course.replace('_', ' '));
    $.ajax({
        url: "/sessions/getCompleteCourseInfo/" + courseId + '/' + affiliatedId,
        // dataType: "json",
        type: "GET",
        success: function(data) {
            $('#courseName' + row_count).val(data['course'].name);
            $('#courseCode' + row_count).val(data['course'].course_code);
            $('#courseId' + row_count).val(data['course'].id);
            $('#courseNameSuggestions' + row_count).html('');
            $('#academicTerm' + row_count).html(data['affiliated_body']);
        },
        error: function(data) {
            swal.showValidationError(`Request failed: ${data}`)
            alertify.error('Something went wrong.')
        }
    });
}

function createRoadMap(row_count, is_edit_mode = false) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    var session_start_month_year = $('#sessionStartDate' + row_count).val();
    var session_end_month_year = $('#sessionEndDate' + row_count).val();
    var academic_term_id = $('#academicTerm' + row_count).val();
    if (session_start_month_year != null && session_end_month_year != null && academic_term_id) {
        $.ajax({
            url: "/sessions/makeRoadMap",
            // dataType: "json",
            data: {
                session_start_month_year: session_start_month_year,
                session_end_month_year: session_end_month_year,
                row_count: row_count,
                is_edit_mode: is_edit_mode,
                academic_term_id: academic_term_id,
                course_id: $('#courseId' + row_count).val(),
            },
            type: "POST",
            success: function(data) {
                $('#roadMap' + row_count).html(data);
            },
            error: function(data) {
                swal.showValidationError(`Request failed: ${data}`)
                alertify.error('Something went wrong.')
            }
        });
    }
}

function clearSearchedCourse(row_count) {
    $('#courseName' + row_count).val('');
    $('#courseNameSuggestions' + row_count).html('');
    $('#courseId' + row_count).val('');
}
var global_temp = 1;

function addNewCourses(event = null, is_edit_mode = false, annual_semester_counter, course_count, row_count, temp = 0) {
    if (event != null) {
        event.target.disabled = true;
    }
    old_counter = row_count + '-' + annual_semester_counter + '-' + course_count;
    if (temp == 0) {
        var counters = row_count + '-' + annual_semester_counter + '-' + (parseInt(course_count) + global_temp);
    } else {
        global_temp = temp;
        var counters = row_count + '-' + annual_semester_counter + '-' + (parseInt(course_count) + temp);
    }
    $.ajax({
        url: "/sessions/addNewCourse/" + counters + "/" + row_count + '?is_edit_mode=' + is_edit_mode,
        // dataType: "json",
        type: "GET",
        success: function(data) {
            $('#newCourses' + old_counter).append(data);
            if (event != null) {
                event.target.disabled = false;
            }
            global_temp++;
        },
        error: function(data) {
            swal.showValidationError(`Request failed: ${data}`)
            alertify.error('Something went wrong.')
            if (event != null) {
                event.target.disabled = false;
            }
        }
    });
}

function removeCourseAddRow(annual_semester_counter, course_count, row_count) {
    var counters = row_count + '-' + annual_semester_counter + '-' + course_count;
    $('#courseAddedRow' + counters).remove();
}

function autoCompleteSubjectName(annual_semester_counter, course_count, row_count) {
    // alert(counters);
    var counters = row_count + '-' + annual_semester_counter + '-' + course_count;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajax({
        url: "/sessions/autoCompleteSubjectName",
        // dataType: "json",
        data: {
            subject_name: $('#subjectName' + counters).val(),
            counters: counters,
            course_id: $('#courseId' + row_count).val(),
            row_count: row_count
        },
        type: "POST",
        success: function(data) {
            $('#subjectNameSuggestions' + counters).html(data);
        },
        error: function(data) {
            swal.showValidationError(`Request failed: ${data}`)
            alertify.error('Something went wrong.')
        }
    });
}

function completeSubjectName(subjectId, row_count, annual_semester_counter, course_count) {
    // $('#courseName'+row_count).val(course.replace('_', ' '));
    var counters = row_count + '-' + annual_semester_counter + '-' + course_count;
    $.ajax({
        url: "/sessions/getCompleteSubjectInfo/" + subjectId,
        // dataType: "json",
        type: "GET",
        success: function(data) {
            $('#subjectName' + counters).val(data.subject_name);
            $('#subjectCode' + counters).val(data.subject_code != null ? data.subject_code : '');
            $('#creditHour' + counters).val(data.credit_hour != null ? data.credit_hour : 0);
            $('#subjectId' + counters).val(data.subject_id);
            $('#subjectNameSuggestions' + counters).html('');
        },
        error: function(data) {
            alertify.error('Something went wrong.')
        }
    });
}

function checkBackDate(row_count) {
    var start_month_year = new Date($('#sessionStartDate' + row_count).val());
    var end_month_year = new Date($('#sessionEndDate' + row_count).val());
    if (start_month_year >= end_month_year) {
        $('#sessionEndDate' + row_count).val('');
        // $('#academicTerm' + row_count).val('');
        $('#roadMap' + row_count).html('');
        alertify.error('End date cannot be less than start date');
    }
}

function getWingCampuses(row_count) {
    var wingId = $('#wingId' + row_count).val();
    $.ajax({
        url: "/sessions/getWingCampuses/" + row_count + "/" + wingId,
        type: "GET",
        success: function(data) {
            $('#campusDetails' + row_count).html(data);
        },
        error: function(data) {
            alertify.error('Something went wrong.')
        }
    });
}

function calculateAdmissionRegistrationFee(row_count) {
    var admission_fee = parseInt($('#cfe_admission_fee-' + row_count).val());
    var marketer_incentive = parseInt($('#marketer_incentive-' + row_count).val());
    var registration_fee = parseInt($('#registration_fee-' + row_count).val());
    console.log(registration_fee);
    var calculated_amount = 0;
    if (admission_fee != undefined && marketer_incentive != undefined && registration_fee != undefined) {
        var calculated_amount = admission_fee + marketer_incentive + registration_fee;
        $('#admission_registration_fee-' + row_count).val(calculated_amount);
    } else {
        $('#admission_registration_fee-' + row_count).val(0);
    }
}

function renderDegreeDetails(session_id) {
    wing_id = document.getElementById('filter_wing_id').value;
    affiliated_body_id = document.getElementById('filter_affiliated_body_id').value;
    course_id = document.getElementById('filter_course_id').value;
    session_id = session_id;
    if (wing_id == '') {
        $.notify("Please select wing to proceed.", "error");
        return;
    }
    if (affiliated_body_id == '') {
        $.notify("Please select affiliated body to proceed.", "error");
        return;
    }
    if (course_id == '') {
        $.notify("Please select course to proceed.", "error");
        return;
    }
    $.notify("Please Wait! System is searching for your requested data.", "info");
    $('#edit_session_detail').html('');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajax({
        url: "/sessions/renderDegreeDetails",
        // dataType: "json",
        data: {
            wing_id: wing_id,
            course_id: course_id,
            session_id: session_id,
            affiliated_body_id: affiliated_body_id,
        },
        type: "POST",
        success: function(data) {
            Global_count++;
            $.notify("Data displayed successfully.", "success");
            $('#edit_session_detail').html(data);
        },
        error: function(data) {
            $.notify("Whoops! Something went wrong.", "error");
            Global_count--;
        }
    });
}