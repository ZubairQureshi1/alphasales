var selected_courses_id;
var selected_course;
var selected_session_id;
var selected_session;
var selected_part;
var selected_part_id;
var selected_date_id;
var selected_subject_id;
var selected_student;
var selected_student_id;
function onCourseSelect() {
    selected_course = document.getElementById('course_id').options[document.getElementById('course_id').options.selectedIndex].innerText;
    selected_course_id = document.getElementById('course_id').value;
    selected_part = document.getElementById('part_id').options[document.getElementById('part_id').options.selectedIndex].innerText;
    selected_part_id = document.getElementById('part_id').value;
    selected_session = document.getElementById('session_id').options[document.getElementById('session_id').options.selectedIndex].innerText;
    selected_session_id = document.getElementById('session_id').value;
    if(selected_course_id.length<1){
        $('#course_validation').append("Course Field is required");
    }
    else if(selected_part_id.length<1){
        $('#part_validation').append("Part Field is required");
    }
    else if(selected_session_id.length<1){
        $('#session_validation').append("Session Field is required");
    }
    // else if(selected_date_id.length<1){
    //     $('#date_validation').append("Date Field is required");
    // }
else{
    swal({
        title: 'Are you sure to select this Course?',
        type: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            document.getElementById('report_loading').hidden = false;
            $.ajax({
                url: "/lectureAttendance/getCourseSubject",
                // dataType: "json",
                type: "POST",
                data: {
                    _token: $("input[name='_token']").val(),
                    selected_course_id: selected_course_id,
                    selected_part_id: selected_part_id,
                    selected_session_id: selected_session_id
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
                    $("#students_list").html("");
                    var add_student_row = '';
                    add_student_row += "<select name='student' id='student_id' class='form-control' onchange='FilterStudentLectureAttendance()'>";
                    add_student_row += "<option>----- Select Student -----</option>"
                    jQuery.each(data.course_students, function(i , val){
                    add_student_row += "<option value='"+val.id+"'>"+val.student_name+"</option>";
                });
                    add_student_row += "</select>";
                        $("#students_list").append(add_student_row);
                    document.getElementById('report_loading').hidden = true;
                },
                error: function(data) {
                    swal.showValidationError(
                        `Request failed: ${data}`
                    )
                    alertify.error('Something went wrong.')
                    document.getElementById('report_loading').hidden = true;
                }
            });
        },
        allowOutsideClick: () => !swal.isLoading()
    });
}
}

function FilterStudentLectureAttendance(){
    selected_course = document.getElementById('course_id').options[document.getElementById('course_id').options.selectedIndex].innerText;
    selected_course_id = document.getElementById('course_id').value;
    selected_part = document.getElementById('part_id').options[document.getElementById('part_id').options.selectedIndex].innerText;
    selected_part_id = document.getElementById('part_id').value;
    selected_session = document.getElementById('session_id').options[document.getElementById('session_id').options.selectedIndex].innerText;
    selected_session_id = document.getElementById('session_id').value;
    selected_subject = document.getElementById('subject_id').options[document.getElementById('subject_id').options.selectedIndex].innerText;
    selected_subject_id = document.getElementById('subject_id').value;
    selected_date_id = document.getElementById('date').value;
    selected_student = document.getElementById('student_id').options[document.getElementById('student_id').options.selectedIndex].innerText;
    selected_student_id = document.getElementById('student_id').value;
    swal({
        title: 'Are you sure to Filter Student Lecture Attendance?',
        type: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            $.ajax({
                url: "/filterStudentLectureAttendance",
                // dataType: "json",
                type: "POST",
                data: {
                    _token: $("input[name='_token']").val(),
                    selected_course_id: selected_course_id,
                    selected_part_id: selected_part_id,
                    selected_session_id: selected_session_id,
                    selected_subject_id: selected_subject_id,
                    selected_date_id: selected_date_id,
                    selected_student_id: selected_student_id,
                },
            
                success: function(data) {
                    $("#lecture_attendance_list").html("");
                    jQuery.each(data.student_lecture_attendances, function(i , val){
                    var add_lecture_attendance_row = '';
                        add_lecture_attendance_row += "<tr>";
                        add_lecture_attendance_row += "<input type='hidden' id='attendance_row_id_"+ val.id + "'></td>";
                        add_lecture_attendance_row += "<td>" + val.student_name + "</td>";
                        add_lecture_attendance_row += "<td>" + val.date + "</td>";
                        add_lecture_attendance_row += "<td>"+constants.attendance_statuses[val.status_id] +"</td>";
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




