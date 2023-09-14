var selected_courses_id;
var selected_course;
var selected_session_id;
var selected_session;
var selected_part;
var selected_part_id;
var selected_date_id;
var selected_subject;
var selected_subject_id;
function onCourseSelect() {
    selected_course = document.getElementById('course_id').options[document.getElementById('course_id').options.selectedIndex].innerText;
    selected_course_id = document.getElementById('course_id').value;
    swal({
        title: 'Are you sure to select this Course?',
        type: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            $.ajax({
                url: "/lectureAttendanceView/getCourseSubject",
                // dataType: "json",
                type: "POST",
                data: {
                    _token: $("input[name='_token']").val(),
                    selected_course_id: selected_course_id
                },
            
                success: function(data) {
                    $("#subjects").html("");
                    var add_row = '';
                    add_row += "<select class='form-control' id='subject_id'>";
                    add_row += "<option value='' disabled selected>-------  Select Section  -------</option>"
                    jQuery.each(data.course_subjects , function(index , value) {
                    add_row += "<option value='" + value.subject_id + "'>"+ value.subject_name +"</option>";
                });
                    add_row += "</select>";
                    $("#subjects").append(add_row);
                },
                error: function(data) {
                    swal.showValidationError(
                        `Request failed: ${data}`
                    )
                    alertify.error('Something went wrong.')
                }
            });
        },
        allowOutsideClick: () => !swal.isLoading()
    });
}
function FilterLectureAttendance(){
    selected_course = document.getElementById('course_id').options[document.getElementById('course_id').options.selectedIndex].innerText;
    selected_course_id = document.getElementById('course_id').value;
    selected_part = document.getElementById('part_id').options[document.getElementById('part_id').options.selectedIndex].innerText;
    selected_part_id = document.getElementById('part_id').value;
    selected_session = document.getElementById('session_id').options[document.getElementById('session_id').options.selectedIndex].innerText;
    selected_session_id = document.getElementById('session_id').value;
    selected_subject = document.getElementById('subject_id').options[document.getElementById('subject_id').options.selectedIndex].innerText;
    selected_subject_id = document.getElementById('subject_id').value;
    selected_date_id = document.getElementById('date').value;
    swal({
        title: 'Are you sure to Filter Lecture Attendance?',
        type: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            $.ajax({
                url: "/filterLectureAttendance",
                // dataType: "json",
                type: "POST",
                data: {
                    _token: $("input[name='_token']").val(),
                    selected_course_id: selected_course_id,
                    selected_part_id: selected_part_id,
                    selected_session_id: selected_session_id,
                    selected_subject_id: selected_subject_id,
                    selected_date_id: selected_date_id,
                },
            
                success: function(data) {
                    $("#lecture_attendance_list").html("");
                    jQuery.each(data.lecture_attendances, function(i , val){
                    var add_lecture_attendance_row = '';
                        add_lecture_attendance_row += "<tr>";
                        add_lecture_attendance_row += "<input type='hidden' id='attendance_row_id_"+ val.id + "'></td>";
                        add_lecture_attendance_row += "<td>" + val.student_name + "</td>";
                        add_lecture_attendance_row += "<td>" + val.date + "</td>";
                        add_lecture_attendance_row += "<td><input type='text' name='status_id' class='form-control' disabled id='status_id_"+val.id+"' value='"+constants.attendance_statuses[val.status_id] +"'></td>";
                        add_lecture_attendance_row += "<td>";
                        add_lecture_attendance_row += "<button class='btn btn-success mr-2' onclick='onPresentClick("+val.id+")'>P</button>"; 
                        add_lecture_attendance_row += "<button class='btn btn-danger mr-2' onclick='onAbsentClick("+val.id+")'>A</button>";
                        add_lecture_attendance_row += "<button class='btn btn-dark mr-2' onclick='onLeaveClick("+val.id+")'>L</button>";
                        add_lecture_attendance_row += "<button class='btn btn-warning mr-2' onclick='onLateClick("+val.id+")'>Lt</button>";
                        add_lecture_attendance_row += "</td>";
                        add_lecture_attendance_row += "</tr>";
                        $("#lecture_attendance_list").append(add_lecture_attendance_row);
                    });
                },
                error: function(data) {
                    swal.showValidationError(
                        `Request failed: ${data}`
                    )
                    alertify.error('Something went wrong.')
                }
            });
        },
        allowOutsideClick: () => !swal.isLoading()
    });
}
var lecture_attendance_status_update ={}
function onLeaveClick(row_id){
    alertify.confirm("Are you sure to proceed?", function(ev) {
        ev.preventDefault();
        isException = false;
        lecture_attendance_status_update._token = $("input[name='_token']").val();
        try {
            lecture_attendance_status_update.status_id = 2;
        } catch (exception) {
            isException = true;
            alertify.error('Something went wrong at Attendance Status.');
        }
        if (!isException) {
        var status_url = "/updateAttendanceStatus/"+row_id+"/update";
            $.ajax({
                url: status_url ,
                dataType: "json",
                type: "POST",
                data: lecture_attendance_status_update,
                success: function(data) {
                    alertify.success("Attendance Status Updated Successfully.");
                },
                error: function(data) {
                    if (data.success) {
                        alertify.success("Attendance Status Updated Successfully.");
                    } else {
                        console.log(data);
                        alertify.error(data.responseJSON.error);
                    }
                }
            });
        }
    },
    function(ev) {
        ev.preventDefault();
        alertify.error("Attendance Status Updated Process Cancelled Successfully.");
    });
} 
function onPresentClick(row_id){
    alertify.confirm("Are you sure to proceed?", function(ev) {
        ev.preventDefault();
        isException = false;
        lecture_attendance_status_update._token = $("input[name='_token']").val();
        try {
            lecture_attendance_status_update.status_id = 1;
        } catch (exception) {
            isException = true;
            alertify.error('Something went wrong at Attendance Status.');
        }
        if (!isException) {
        var status_url = "/updateAttendanceStatus/"+row_id+"/update";
            $.ajax({
                url: status_url ,
                dataType: "json",
                type: "POST",
                data: lecture_attendance_status_update,
                success: function(data) {
                    alertify.success("Attendance Status Updated Successfully.");
                },
                error: function(data) {
                    if (data.success) {
                        alertify.success("Attendance Status Updated Successfully.");
                    } else {
                        console.log(data);
                        alertify.error(data.responseJSON.error);
                    }
                }
            });
        }
    },
    function(ev) {
        ev.preventDefault();
        alertify.error("Attendance Status Updated Process Cancelled Successfully.");
    });
} 
function onAbsentClick(row_id){
    alertify.confirm("Are you sure to proceed?", function(ev) {
        ev.preventDefault();
        isException = false;
        lecture_attendance_status_update._token = $("input[name='_token']").val();
        try {
            lecture_attendance_status_update.status_id = 0;
        } catch (exception) {
            isException = true;
            alertify.error('Something went wrong at Attendance Status.');
        }
        if (!isException) {
        var status_url = "/updateAttendanceStatus/"+row_id+"/update";
            $.ajax({
                url: status_url ,
                dataType: "json",
                type: "POST",
                data: lecture_attendance_status_update,
                success: function(data) {
                    alertify.success("Attendance Status Updated Successfully.");
                },
                error: function(data) {
                    if (data.success) {
                        alertify.success("Attendance Status Updated Successfully.");
                    } else {
                        console.log(data);
                        alertify.error(data.responseJSON.error);
                    }
                }
            });
        }
    },
    function(ev) {
        ev.preventDefault();
        alertify.error("Attendance Status Updated Process Cancelled Successfully.");
    });
} 
function onLateClick(row_id){
    alertify.confirm("Are you sure to proceed?", function(ev) {
        ev.preventDefault();
        isException = false;
        lecture_attendance_status_update._token = $("input[name='_token']").val();
        try {
            lecture_attendance_status_update.status_id = 4;
        } catch (exception) {
            isException = true;
            alertify.error('Something went wrong at Attendance Status.');
        }
        if (!isException) {
        var status_url = "/updateAttendanceStatus/"+row_id+"/update";
            $.ajax({
                url: status_url ,
                dataType: "json",
                type: "POST",
                data: lecture_attendance_status_update,
                success: function(data) {
                    alertify.success("Attendance Status Updated Successfully.");
                },
                error: function(data) {
                    if (data.success) {
                        alertify.success("Attendance Status Updated Successfully.");
                    } else {
                        console.log(data);
                        alertify.error(data.responseJSON.error);
                    }
                }
            });
        }
    },
    function(ev) {
        ev.preventDefault();
        alertify.error("Attendance Status Updated Process Cancelled Successfully.");
    });
} 



