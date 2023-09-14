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
                    add_row += "<select class='form-control' name='subject_id' id='subject_id'>";
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