var selected_teacher;
var selected_teacher_id;

function onTeacherSelect() {
    selected_teacher = document.getElementById('teacher_id').options[document.getElementById('teacher_id').options.selectedIndex].innerText;
    selected_teacher_id = document.getElementById('teacher_id').value;
    $.ajax({
        url: "/getSubjectTeacher",
        // dataType: "json",
        type: "POST",
        data: {
            _token: $("input[name='_token']").val(),
            selected_teacher_id: selected_teacher_id,
        },   
        success: function(data) {
          console.log(data.subject_teacher[0].faculty_type);
            $("#is_visitor_teacher").html("");
            var faculty_type = data.subject_teacher[0].faculty_type;
            if(faculty_type == 0){
                $("#is_visitor_teacher").append("Visitor Teacher");
            }
            console.log(data.visitor_teacher_count);
            var visitor_teacher_count = data.visitor_teacher_count;
            if(visitor_teacher_count >= 2){
                alert("This Teacher is Visitor You Just Allocate Maximum Two Subjects");
                $("#save-btn").hide();
            }
        },
        error: function(data) {
            swal.showValidationError(
                `Request failed: ${data}`
            )
            alertify.error('Something went wrong.')
        }
    });
}