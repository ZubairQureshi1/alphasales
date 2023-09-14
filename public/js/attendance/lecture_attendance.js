var selected_courses_id;
var selected_course;
var selected_session_id;
var selected_session;
var selected_part;
var selected_part_id;
var selected_date_id;
var selected_subject_id;
function onCourseSelect() {
    selected_course = document.getElementById('course_id').options[document.getElementById('course_id').options.selectedIndex].innerText;
    selected_course_id = document.getElementById('course_id').value;
    selected_part = document.getElementById('part_id').options[document.getElementById('part_id').options.selectedIndex].innerText;
    selected_part_id = document.getElementById('part_id').value;
    selected_session = document.getElementById('session_id').options[document.getElementById('session_id').options.selectedIndex].innerText;
    selected_session_id = document.getElementById('session_id').value;
    selected_date_id = document.getElementById('date').value;
    if(selected_course_id.length<1){
        $('#course_validation').append("Course Field is required");
    }
    else if(selected_part_id.length<1){
        $('#part_validation').append("Part Field is required");
    }
    else if(selected_session_id.length<1){
        $('#session_validation').append("Session Field is required");
    }
    else if(selected_date_id.length<1){
        $('#date_validation').append("Date Field is required");
    }
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
                    add_row += "<select class='form-control' name='subject_id' id='subject_id'>";
                    add_row += "<option value='' disabled selected>-------  Select Section  -------</option>"
                    jQuery.each(data.course_subjects , function(index , value) {
                    add_row += "<option value='" + value.subject_id + "'>"+ value.subject_name +"</option>";
                });
                    add_row += "</select>";
                    $("#subjects").append(add_row);
                    $("#students_list").html("");
                    jQuery.each(data.course_students, function(i , val){
                    var add_student_row = '';
                        add_student_row += "<tr>";
                        add_student_row += "<input type='hidden' name='student_id[]'  id='student_id_"+i+"' value='"+val.id+"' />";
                        add_student_row += "<td>" + val.roll_no + "</td>";
                        add_student_row += "<td>" + val.student_name + "</td>";
                        add_student_row += "<td>";
                        add_student_row += "<select class='form-control' name='status_id[]' id='status_id"+i+"'>";
                        add_student_row += "<option>---- Select Status ----</option>";
                        jQuery.each(constants.attendance_statuses ,function(index, value){
                            if(index == 1){
                                add_student_row += "<option selected value='"+index+"'>"+value+"</option>";
                            }
                            else{
                                add_student_row += "<option value='"+index+"'>"+value+"</option>";
                            }
                        });
                        add_student_row += "</select>";
                        add_student_row += "</td>";
                        // add_student_row += "<td><button class='btn btn-primary' id='row_btn_"+i+"' onclick='LectureAttendanceSave("+i+")'>Submit</button></td>";
                        add_student_row += "</tr>";
                        $("#students_list").append(add_student_row);
                    });
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
// var lecture_attendance = {}
//     function LectureAttendanceSave(id){

//         alertify.confirm("Are you sure to proceed?", function(ev) {
//             ev.preventDefault();
//             isException = false;
//             var status_id = "status_id"+id;
//             var student_id= "student_id_"+id;
//             lecture_attendance._token = $("input[name='_token']").val();
//             try {
//                 lecture_attendance.status_id = document.getElementById(status_id).value;
            
//             } catch (exception) {
//                 isException = true;
//                 alertify.error('Something went wrong at Status.');
//             }
//             try {
//                 lecture_attendance.part_id = document.getElementById('part_id').value;
//             } catch (exception) {
//                 isException = true;
//                 alertify.error('Something went wrong at Part.');
//             }
//             try {
//                 lecture_attendance.course_id = document.getElementById('course_id').value;
//             } catch (exception) {
//                 isException = true;
//                 alertify.error('Something went wrong at Course.');
//             }
//             try {
//                 lecture_attendance.subject_id = document.getElementById('subject_id').value;
//             } catch (exception) {
//                 isException = true;
//                 alertify.error('Something went wrong at Subject.');
//             }
//             try {
//                 lecture_attendance.student_id = document.getElementById(student_id).value;
            
//             } catch (exception) {
//                 isException = true;
//                 alertify.error('Something went wrong at Student.');
//             }
//             try {
//                 lecture_attendance.date = document.getElementById('date').value;
            
//             } catch (exception) {
//                 isException = true;
//                 alertify.error('Something went wrong at Date.');
//             }
//             try {
//                 lecture_attendance.session_id = document.getElementById('session_id').value;
            
//             } catch (exception) {
//                 isException = true;
//                 alertify.error('Something went wrong at Session.');
//             }
//             if (!isException) {
//                 $.ajax({
//                     url: "/lectureAttendance",
//                     dataType: "json",
//                     type: "POST",
//                     data: lecture_attendance,
//                     success: function(data) {
//                         alertify.success("Result Process Completed Successfully.");
//                 $("#row_btn_"+id).parent().parent().hide();
//                     },
//                     error: function(data) {
//                         console.log(data);
//                 alertify.error(data.responseJSON.error);
//                     }
//                 });
//             }
//         },  
//         function(ev) {
//             ev.preventDefault();
//             alertify.error("Result Process Cancelled Successfully.");
//         });
//     }
