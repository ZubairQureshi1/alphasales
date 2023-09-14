$(document).ready(function() {
    onSummaryTypeSelect();
});

function onSummaryTypeSelect() {

    if (document.getElementById('summary_type_id').value == 0) {
        // individual selected
        document.getElementById('summary_button').hidden = true; //hidden
        document.getElementById('filter_button').hidden = false; //shown
        document.getElementById('student_select').hidden = true; //hidden
        document.getElementById('start_select').hidden = true; //hidden
        document.getElementById('end_select').hidden = true; //hidden
    } else {
        // overall selected
        document.getElementById('summary_button').hidden = false; //shown
        document.getElementById('filter_button').hidden = true; //hidden
        document.getElementById('student_select').hidden = true; //hidden
        document.getElementById('start_select').hidden = false; //shown
        document.getElementById('end_select').hidden = false; //shown
    }
}

function getFilteredStudents(route) {
    var querry_string = '';
    if (document.getElementById('course_id') != null && document.getElementById('course_id').value != '') {
        querry_string += 'course_id=' + document.getElementById('course_id').value + '&';
    }
    if (document.getElementById('part_id') != null && document.getElementById('part_id').value != '') {
        querry_string += 'part_id=' + document.getElementById('part_id').value + '&';
    }
    if (document.getElementById('session_id') != null && document.getElementById('session_id').value != '') {
        querry_string += 'session_id=' + document.getElementById('session_id').value + '&';
    }
    if (document.getElementById('section_id') != null && document.getElementById('section_id').value != '') {
        querry_string += 'section_id=' + document.getElementById('section_id').value + '&';
    };
    if (document.getElementById('summary_type_id') != null && document.getElementById('summary_type_id').value != '' && document.getElementById('summary_type_id').value == '0') {
        var self = this;
        $('#student_id').html($('<option>', {
            value: null,
            text: '--- Select Student ---'
        }));
        document.getElementById('report_loading').hidden = false;
        $.ajax({
            url: route + '?' + querry_string,
            dataType: "json",
            type: "GET",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $.each(data.data.students, function(index, student) {
                    $('#student_id').append($('<option>', {
                        value: student.id,
                        text: student.student_name + ' - ' + student.old_roll_no
                    }));
                });
                document.getElementById('student_select').hidden = false;
                document.getElementById('start_select').hidden = false;
                document.getElementById('end_select').hidden = false;
                document.getElementById('summary_button').hidden = false;
                document.getElementById('report_loading').hidden = true;
                alertify.success("Request Completed Successfully.");
            },
            error: function(data) {
                console.log(data);
                // alertify.error(data.responseJSON.error);
            }
        });

    } else {
        document.getElementById('start_select').hidden = false;
        document.getElementById('end_select').hidden = false;
    }
}
var day_names = [
    'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'
];
var month_names = [
    'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
];
var date_formats = [{
    'default': 'ddd mmm dd yyyy HH:MM:ss'
}, {
    'shortDate': 'm/d/yy'
}, {
    'mediumDate': 'mmm d, yyyy'
}, {
    'longDate': 'mmmm d, yyyy'
}, {
    'month_year': 'mmmm yyyy'
}, {
    'fullDate': 'dddd, mmmm d, yyyy'
}, {
    'shortTime': 'h:MM TT'
}, {
    'mediumTime': 'h:MM:ss TT'
}, {
    'longTime': 'h:MM:ss TT Z'
}, {
    'isoDate': 'yyyy-mm-dd'
}, {
    'isoTime': 'HH:MM:ss'
}, {
    'isoDateTime': 'yyyy-mm-dd\'T\'HH:MM:sso'
}, {
    'isoUtcDateTime': 'UTC:yyyy-mm-dd\'T\'HH:MM:ss\'Z\''
}, {
    'expiresHeaderFormat': 'ddd, dd mmm yyyy HH:MM:ss Z'
}, ];

function setTitleForSummary() {
    var selected_student = document.getElementById('student_id').options[document.getElementById('student_id').options.selectedIndex].innerText;
    $('#summary_title').html(selected_student + ' Absent Details');
}

function generateAttendanceSummary(route) {

    var querry_string = '';
    var conditions_clear = false;
    if (document.getElementById('summary_type_id').value == '0') {

        if (document.getElementById('student_id') != null && document.getElementById('student_id').value != '' && document.getElementById('student_id').value != '--- Select Student ---') {
            querry_string += 'student_id=' + document.getElementById('student_id').value + '&';
            conditions_clear = true;
        } else {
            $('#student_id_message').html('Please select student first').css('color', 'red');
            conditions_clear = false;
        }
    } else {
        if (document.getElementById('course_id') != null && document.getElementById('course_id').value != '') {
            querry_string += 'course_id=' + document.getElementById('course_id').value + '&';
        }
        if (document.getElementById('part_id') != null && document.getElementById('part_id').value != '') {
            querry_string += 'part_id=' + document.getElementById('part_id').value + '&';
        }
        if (document.getElementById('session_id') != null && document.getElementById('session_id').value != '') {
            querry_string += 'session_id=' + document.getElementById('session_id').value + '&';
        }
        if (document.getElementById('section_id') != null && document.getElementById('section_id').value != '') {
            querry_string += 'section_id=' + document.getElementById('section_id').value + '&';
        };
    }
    if (document.getElementById('start_date') != null && document.getElementById('start_date').value != '') {
        querry_string += 'start_date=' + document.getElementById('start_date').value + '&';
        conditions_clear = true;
    } else {
        $('#start_date_message').html('Start date is required').css('color', 'red');
        conditions_clear = false;
    }
    if (document.getElementById('end_date') != null && document.getElementById('end_date').value != '') {
        querry_string += 'end_date=' + document.getElementById('end_date').value + '&';
        conditions_clear = true;
    } else {
        $('#end_date_message').html('End date is required').css('color', 'red');
        conditions_clear = false;
    }
    if (document.getElementById('summary_type_id') != null && document.getElementById('summary_type_id').value != '') {
        querry_string += 'summary_type_id=' + document.getElementById('summary_type_id').value + '&';
    }
    querry_string += 'status_id=0';
    if (conditions_clear) {

        document.getElementById('report_loading').hidden = false;
        $("#attendance_summary_body").html('');
        $('#summary_box_body').html('');

        // var data_table = $('#datatable-buttons').DataTable();
        // data_table.clear().draw();
        var self = this;
        $.ajax({
            url: route + '?' + querry_string,
            dataType: "json",
            type: "GET",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $('#summary_box_body').html(data.data.view);
                if (document.getElementById('summary_type_id').value == '0') {
                    groupKey = 0;
                    groups = data.data.attendances.reduce(function(date_grouped, attendance) {

                        var attendance_date = attendance.date;
                        var parts1 = attendance_date.split("-");
                        attendance_date = new Date(parts1[0], parts1[1] - 1, parts1[2]);
                        var m = month_names[attendance_date.getMonth()];

                        (date_grouped[m]) ? date_grouped[m].data.push(attendance): date_grouped[m] = {
                            group: String(groupKey++),
                            data: [attendance]
                        };
                        return date_grouped;
                    }, {});

                    $.each(groups, function(index, object) {
                        var add_row = '';
                        add_row += "<tr><td>" + index + "</td>";
                        add_row += "<td><div class='form-group row'>";
                        add_row += "<div class='col-sm-12'>";
                        jQuery.each(object.data, function(index, object_data) {
                            add_row += object_data.date + ', ';
                        });
                        add_row += "</div></div></td>";
                        add_row += "<td>" + object.data.length + "</td>";
                        add_row += "<td>" + (object.data.length * 200) + "</td>";
                        add_row += "<td></td>";
                        add_row += "</tr>";
                        $("#attendance_summary_body").append(add_row);
                    });
                }
                document.getElementById('report_loading').hidden = true;
                alertify.success("Request Completed Successfully.");
            },
            error: function(data) {
                console.log(data);
                // alertify.error(data.responseJSON.error);
            }
        });
    }
};