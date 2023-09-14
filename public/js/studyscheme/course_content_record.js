var selected_course;
var selected_course_id;
var selected_semester;
var seleted_semester_id;
var login_user;
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
    selected_course = document.getElementById('course_id').options[document.getElementById('course_id').options.selectedIndex].innerText;
    selected_course_id = document.getElementById('course_id').value;
    selected_subject = document.getElementById('subject_id').options[document.getElementById('subject_id').options.selectedIndex].innerText;
    selected_subject_id = document.getElementById('subject_id').value;
    selected_semester = document.getElementById('semester_id').options[document.getElementById('semester_id').options.selectedIndex].innerText;
    selected_semester_id = document.getElementById('semester_id').value;
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
                url: "/courseContent/getSubjectTeacherCourseContentDetail",
                // dataType: "json",
                type: "POST",
                data: {
                    _token: $("input[name='_token']").val(),
                    selected_course_id: selected_course_id,
                    selected_semester_id: selected_semester_id,
                    selected_subject_id: selected_subject_id,
                },   
                success: function(data) {
                    login_user = data.current_user_login;
                    console.log(login_user);
                    console.log(data.course_content_subject_detail);
                    $("#lecture_days").html("");
                    var add_lecture_days  = '';
                    jQuery.each(data.course_content_subject_detail , function(index , value){
                            var add_week_row = '';
                            add_week_row += "<tr>";
                            add_week_row += "<input type='hidden' value='"+value.id+"' name='' id='id_for_week_row_"+value.id+"' </td>";
                            add_week_row += "<td>";
                            add_week_row += "<select disabled name='week_"+value.id+"' id='week_id_"+value.id+"' class='form-control'>";
                            add_week_row += "<option value=''>--- Select Week ---</option>";
                            for(i=1;i<=18;i++){
                                if(value.week_id == i){
                                    add_week_row += "<option value='"+i+"' selected>week "+i+"</option>";
                                }
                            }
                            add_week_row += "</select>";
                            add_week_row += "</td>";
                            add_week_row += "<td>";
                            add_week_row += "<input type='text' disabled name='planned_contents_"+value.id+"' data-planned_contents='notchange' class='form-control' value='"+value.planned_contents+"' id='planned_contents_id_"+value.id+"' placeholder='Enter Content' />";
                            add_week_row += "</td>"
                            add_week_row += "<td>";
                            add_week_row += "<input type='text' disabled name='planned_activities_"+value.id+"' class='form-control' value='"+value.planned_activities+"' id='planned_activities_id_"+value.id+"' placeholder='Enter Activities' />";
                            add_week_row += "</td>"
                            add_week_row += "<td>";
                            add_week_row += "<input type='text' name='status_"+value.id+"' class='form-control' value='"+value.status+"' id='content_status_id_"+value.id+"'  placeholder='Enter Status'/>";
                            add_week_row += "</td>"
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
                lecture_attendance.content_status_id = document.getElementById('content_status_id_'+week_row_id).value;
            } catch (exception) {
                isException = true;
                alertify.error('Something went wrong at Status.');
            }
            if (!isException) {

                $.ajax({
                    url: "/updateCourseContentStatus/"+document.getElementById('id_for_week_row_'+week_row_id).value+"/update",
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