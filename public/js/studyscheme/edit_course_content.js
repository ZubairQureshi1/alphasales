var selected_course;
var selected_course_id;
var selected_semester;
var seleted_semester_id;
function onSemesterSelect() {
    selected_course = document.getElementById('course_id').options[document.getElementById('course_id').options.selectedIndex].innerText;
    selected_course_id = document.getElementById('course_id').value;
    selected_semester = document.getElementById('semester_id').options[document.getElementById('semester_id').options.selectedIndex].innerText;
    selected_semester_id = document.getElementById('semester_id').value;
    swal({
        title: 'Are you sure to Continue?',
        type: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            $.ajax({
                url: "/getCourseSemesterSubject",
                // dataType: "json",
                type: "POST",
                data: {
                    _token: $("input[name='_token']").val(),
                    selected_course_id: selected_course_id,
                    selected_semester_id: selected_semester_id,
                },   
                success: function(data) {
                  console.log(data.course_semester_subjects);
                    $("#course_semester_subjects").html("");
                    var add_row = '';
                    add_row += "<select class='form-control' name='subject_id' id='subject_id' onchange='onSubjectSelect()'>";
                    add_row += "<option value='' disabled selected>-------  Select Section  -------</option>"
                    jQuery.each(data.course_semester_subjects , function(index , value) {
                    add_row += "<option value='" + value.subject_id + "'>"+ value.subject_name +"</option>";
                });
                    add_row += "</select>";
                    $("#course_semester_subjects").append(add_row);
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
var selected_subject;
var selected_subject_id;
function onSubjectSelect() {
    selected_subject = document.getElementById('subject_id').options[document.getElementById('subject_id').options.selectedIndex].innerText;
    selected_subject_id = document.getElementById('subject_id').value;

    swal({
        title: 'Are you sure to Select this Subject ?',
        type: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            $.ajax({
                url: "/courseContent/getSubjectTeacher",
                // dataType: "json",
                type: "POST",
                data: {
                    _token: $("input[name='_token']").val(),
                    selected_subject_id: selected_subject_id,
                },   
                success: function(data) {
                    console.log(data.subject_teacher);
                    $("#subject_teacher").html("");
                    var add_teacher = '';
                    add_teacher += "<select class='form-control' name='teacher_id' id='teacher_id' onchange='onTeacherSelect()'>";
                    add_teacher += "<option>---- Select Teacher ----</option>";
                    jQuery.each(data.subject_teacher , function(index,val){
                        add_teacher += "<option value='"+val.user_id+"'>"+val.user_name+"</option>";
                    });
                    add_teacher += "</select>";
                    $("#subject_teacher").append(add_teacher);
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
var selected_teacher;
var selected_teacher_id;
function onTeacherSelect(){
    selected_teacher = document.getElementById('teacher_id').options[document.getElementById('teacher_id').options.selectedIndex].innerText;
    selected_teacher_id = document.getElementById('teacher_id').value;
    selected_course = document.getElementById('course_id').options[document.getElementById('course_id').options.selectedIndex].innerText;
    selected_course_id = document.getElementById('course_id').value;
    selected_subject = document.getElementById('subject_id').options[document.getElementById('subject_id').options.selectedIndex].innerText;
    selected_subject_id = document.getElementById('subject_id').value;
    selected_semester = document.getElementById('semester_id').options[document.getElementById('semester_id').options.selectedIndex].innerText;
    selected_semester_id = document.getElementById('semester_id').value;
    swal({
        title: 'Are you sure to Select this Teacher ?',
        type: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            $.ajax({
                url: "/getTeacherCourseContentSubjectDetail",
                // dataType: "json",
                type: "POST",
                data: {
                    _token: $("input[name='_token']").val(),
                    selected_teacher_id: selected_teacher_id,
                    selected_course_id: selected_course_id,
                    selected_subject_id: selected_subject_id,
                    selected_semester_id: selected_semester_id,
                },   
                success: function(data) {
                    console.log(data);

                    $("#lecture_days").html("");
                    var add_lecture_days  = '';
                    add_lecture_days += "<input type='text' name='lecture_days' id='lecture_days_id' class='form-control' value='" + data.course_content_subject_detail[0].lecture_days + "' placeholder='Enter Lecture days' />";
                    $("#lecture_days").append(add_lecture_days);
                    $("#content_program_name").html("");
                    var program_name  = '';
                    program_name += ""+data.course_detail[0].course_name+"";
                    $("#content_program_name").append(program_name);
                    $("#content_subject_name").html("");
                    var subject_name  = '';
                    subject_name += ""+data.course_detail[0].subject_name+"";
                    $("#content_subject_name").append(subject_name);
                    $("#content_subject_credit").html("");
                    var subject_credit  = '';
                    subject_credit += ""+data.course_detail[0].credit_hours+"";
                    $("#content_subject_credit").append(subject_credit);
                    $("#content_subject_prerequisit").html("");
                    var prerequisit_subject  = '';
                    prerequisit_subject += ""+data.course_detail[0].prerequisite_subject+"";
                    $("#content_subject_prerequisit").append(prerequisit_subject);


                    $("#content_subject_teacher").html("");
                    var subject_teacher  = '';
                    subject_teacher += ""+data.subject_teacher[0].user_name+"";
                    $("#content_subject_teacher").append(subject_teacher);




                    $("#lecture_weeks").html("");
                    jQuery.each(data.course_content_subject_detail , function(index , value){
                            var add_week_row = '';
                            add_week_row += "<tr>";
                            add_week_row += "<input type='hidden' value='"+value.id+"' name='' id='id_for_week_row_"+value.id+"' </td>";
                            add_week_row += "<td>";
                            add_week_row += "<select name='week_"+value.id+"' id='week_id_"+value.id+"' class='form-control'>";
                            add_week_row += "<option value=''>--- Select Week ---</option>";
                            for(i=1;i<=18;i++){
                                if(value.week_id == i){
                                    add_week_row += "<option value='"+i+"' selected>week "+i+"</option>";
                                }
                            }
                            add_week_row += "</select>";
                            add_week_row += "</td>";
                            add_week_row += "<td>";
                            add_week_row += "<input type='text' name='planned_contents_"+value.id+"' data-planned_contents='notchange' class='form-control' value='"+value.planned_contents+"' id='planned_contents_id_"+value.id+"' placeholder='Enter Content' />";
                            add_week_row += "</td>"
                            add_week_row += "<td>";
                            add_week_row += "<input type='text' name='planned_activities_"+value.id+"' class='form-control' value='"+value.planned_activities+"' id='planned_activities_id_"+value.id+"' placeholder='Enter Activities' />";
                            add_week_row += "</td>"
                            add_week_row += "<td>";
                            add_week_row += "<input type='date' name='date_"+value.id+"' class='form-control' value='"+value.date+"' id='date_id_"+value.id+"'/>";
                            add_week_row += "</td>"
                            // add_week_row += "<td>";
                            // add_week_row += "<input type='text' name='status_"+value.id+"' class='form-control' value='"+value.status+"' id='content_status_id_"+value.id+"'  placeholder='Enter Status'/>";
                            // add_week_row += "</td>"
                            add_week_row += "<td>";
                            add_week_row += "<button class='btn btn-primary' onclick='updateCourseContent("+value.id+")'>Update</button>";
                            add_week_row += "</td>";
                            add_week_row += "</tr>";
                            $("#lecture_weeks").append(add_week_row);
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

var lecture_attendance = {}
function updateCourseContent(week_row_id) {
    alertify.confirm("Are you sure to proceed?", function(ev) {
            ev.preventDefault();
            isException = false;
            lecture_attendance._token = $("input[name='_token']").val();
            try {
                lecture_attendance.lecture_days_id = document.getElementById('lecture_days_id').value;
            } catch (exception) {
                isException = true;
                alertify.error('Something went wrong at Lecture Days.');
            }
            try {
                lecture_attendance.week_id = document.getElementById('week_id_'+week_row_id).value;
            } catch (exception) {
                isException = true;
                alertify.error('Something went wrong at Week.');
            }
            try {
                lecture_attendance.planned_contents_id = document.getElementById('planned_contents_id_'+week_row_id).value;
            } catch (exception) {
                isException = true;
                alertify.error('Something went wrong at planned Content.');
            }
            try {
                lecture_attendance.planned_activities_id = document.getElementById('planned_activities_id_'+week_row_id).value;
            } catch (exception) {
                isException = true;
                alertify.error('Something went wrong at planned Activity.');
            }
            try {
                lecture_attendance.date_id = document.getElementById('date_id_'+week_row_id).value;
            } catch (exception) {
                isException = true;
                alertify.error('Something went wrong at Date.');
            }
            if (!isException) {

                $.ajax({
                    url: "/updateCourseContent/"+document.getElementById('id_for_week_row_'+week_row_id).value+"/update",
                    dataType: "json",
                    type: "POST",
                    data: lecture_attendance,
                    success: function(data) {
                        alertify.success("Course Content Updated Successfully.");
                    },
                    error: function(data) {
                        if (data.success) {
                            alertify.success("Course Content Updated Successfully.");
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
            alertify.error("Course Content Updated Process Cancelled Successfully.");
        });
}