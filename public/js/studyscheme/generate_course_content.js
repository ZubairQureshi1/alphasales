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
                    add_lecture_days += "<input type='text' name='lecture_days' id='lecture_days_id' class='form-control' value='" + data.lecture_days + "' placeholder='Enter Lecture days' />";
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
                            add_week_row += "<td>";
                            add_week_row += ""+value.week_id+"";
                            add_week_row += "</td>";
                            add_week_row += "<td>";
                            add_week_row += ""+value.planned_contents+"";
                            add_week_row += "</td>"
                            add_week_row += "<td>";
                            add_week_row += ""+value.planned_activities+"";
                            add_week_row += "</td>"
                            add_week_row += "<td>";
                            add_week_row += ""+data.lecture_held_dates[index]+"";
                            add_week_row += "</td>"
                            add_week_row += "<td>";
                            add_week_row += ""+value.status+"";
                            add_week_row += "</td>"
                            add_week_row += "</tr>";
                            $("#lecture_weeks").append(add_week_row);
                    });
                    var add_time_period = '';
                    add_time_period += "<select class='form-control' name='time_period_id' id='time_period_id' onchange='onTimePeriodSelect()'>";
                    add_time_period += "<option>---- Select Time period ----</option>";
                    jQuery.each(data.timeperiods , function(index,val){
                        add_time_period += "<option value='"+val.id+"'>"+val.user_name+"</option>";
                    });
                    add_time_period += "</select>";
                    $("#time_period").append(add_time_period);
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
function onTimePeriodSelect() {
    // body...
}
