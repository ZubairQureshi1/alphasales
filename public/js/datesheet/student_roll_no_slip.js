var selected_student_id;
var selected_student;

function onStudentSelect() {
    selected_student = document.getElementById('student_id').options[document.getElementById('student_id').options.selectedIndex].innerText;
    selected_student_id = document.getElementById('student_id').value;
    date_sheet_id = document.getElementById('date_sheet_id').value;


    swal({
        title: 'Are you sure to select this Student?',
        type: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            $.ajax({
                url: "/getStudentRollNoSlip",
                // dataType: "json",
                type: "POST",
                data: {
                    _token: $("input[name='_token']").val(),
                    id: selected_student_id,
                    date_sheet_id: date_sheet_id,
                },

                success: function(data) {
                    $(".student_detail").html("");
                    student = data.student_detail;
                    var add_row = "<div class='row'>";
                    add_row += "<div class='col-sm-4'> <label>Roll no: </label>" + student.roll_no + "</div>";
                    add_row += "<div class='col-sm-8 text-right'> <label>Session: </label>" + student.session_name + "</div>";
                    add_row += "</div>";
                    add_row += "<div class='row'>";
                    add_row += "<div class='col-sm-4'> <label>Student Name: </label>" + student.student_name + "<br><label>Father Name: </label>" + student.father_name + "</div>";
                    add_row += "<div class='col-sm-8 text-right'><label>Degree: </label>" + student.course_name + "<br><label>Section: </label>" + student.section_name + "</div>";
                    add_row += "</div>";
                    $(".student_detail").append(add_row);
                    $("#datesheet_subjects").html("");
                    $.each(student.books, function(index, val) {
                        var add_subject_row = '';
                        add_subject_row += "<tr>";
                        add_subject_row += "<td>" + val.date_formated + "</td>";
                        add_subject_row += "<td>" + val.book_name + "</td>";
                        add_subject_row += "<td>" + val.start_time_formated + "</td>";
                        add_subject_row += "<td>" + val.end_time_formated + "</td>";
                        add_subject_row += "<td>" + val.syllabus + "</td>";

                        add_subject_row += "</tr>";
                        $("#datesheet_subjects").append(add_subject_row);
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