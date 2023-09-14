var selected_subject;
var selected_subject_id;
var selected_part;
var selected_part_id;
var selected_course;
var selected_course_id;
var selected_section;
var selected_section_id;
var assignment_title;
var assignment_topic;
var assignment_db_students;
function onCourseSelect() {
    assignment_title = document.getElementById('title_id').value;
    assignment_topic = document.getElementById('topic_id').value;
    selected_part = document.getElementById('part_id').options[document.getElementById('part_id').options.selectedIndex].innerText;
    selected_part_id = document.getElementById('part_id').value;
    selected_course = $('#course_id').val();
    selected_section = $('#section_id').val();
    selected_subject = document.getElementById('subject_id').options[document.getElementById('subject_id').options.selectedIndex].innerText;
    selected_subject_id = document.getElementById('subject_id').value;
    swal({
        title: 'Are you sure to Filter Course Students?',
        type: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            $.ajax({
                url: "/getAssignmentCourseStudents",
                // dataType: "json",
                type: "POST",
                data: {
                    _token: $("input[name='_token']").val(),
                    selected_subject_id: selected_subject_id,
                    selected_part_id:selected_part_id,
                    selected_course:selected_course,
                    selected_section:selected_section
                },
                success: function(data) {
                    assignment_db_students = data.course_student;
                    jQuery.each(data.course_student , function(index , value){
                        var add_row;
                        add_row += "<tr>";
                        add_row += "<td>" + value.roll_no + "</td>";
                        add_row += "<td>" + value.student_name + "</td>";
                        add_row += "<td><input type='submit' value='Assigned' class='btn btn-success'></input></td>";
                        add_row += "</tr>";
                        $('#selected_course_student').append(add_row);
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
var assignment = {};
var formdata = new FormData();

function saveAssignment() {
    alertify.confirm("Are you sure to proceed?", function(ev) {
            ev.preventDefault();
            isException = false;
            assignment._token = $("input[name='_token']").val();
            try{
                assignment.title_id = document.getElementById('title_id').value;
            }catch(exception){
                isException = true;
                alertify.error('Something went wrong at Title.');
            }
            try{
                assignment.topic_id = document.getElementById('topic_id').value;
            }catch(exception){
                isException = true;
                alertify.error('Something went wrong at Topic');
            }
            try {
                assignment.part_id = document.getElementById('part_id').value;
            } catch (exception) {
                isException = true;
                alertify.error('Something went wrong at Part.');
            }
            try {
                assignment.course_id = $('#course_id').val();
            } catch (exception) {
                isException = true;
                alertify.error('Something went wrong at Course.');
            }
            try {
                assignment.section_id = $('#section_id').val();
            } catch (exception) {
                isException = true;
                alertify.error('Something went wrong at Section.');
            }
            try {
                assignment.subject_id = document.getElementById('subject_id').value;
            } catch (exception) {
                isException = true;
                alertify.error('Something went wrong at Subject.');
            }
            try{
                assignment.assignment_db_students = assignment_db_students;
            } catch(exception){
                isException = true;
                alertify.error('Something went wrong at Students');
            }
    formdata.append('data', JSON.stringify(assignment));
    formdata.append('file', $('#assigment_file')[0].files[0]);

            if (!isException) {

                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                        },
                    url: "/assignments",
                    dataType: "json",
                    type: "POST",
                    processData: false,
                    contentType: false,
                    data: formdata,
                    success: function(data) {
                        alertify.success("Assignment Process Completed Successfully.");
                        window.location = '/assignments';
                    },
                    error: function(data) {
                        console.log(data);
                        alertify.error(data.responseJSON.error);
                    }
                });
            }
        },
        function(ev) {
            ev.preventDefault();
            alertify.error("Assignment Process Cancelled Successfully.");
        });
}