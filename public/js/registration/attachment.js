var countAttachment=0;
function AddAttachment(){
    var add_attachment_row = '';
    add_attachment_row += "<tr>";
    add_attachment_row += "<td>";
    add_attachment_row += "<input type='file' name='attachment' id='attachment"+countAttachment+"' class='form-control-file'>";
    add_attachment_row += "</td>";
    add_attachment_row += "<td>";
    add_attachment_row += "<select id='attachment_type_id"+countAttachment+"' name='attachment_type_id' class='form-control'>";
    add_attachment_row += "<option value=''>-- Select Attachment Type --</option>";
    jQuery.each(constants.attachment_types, function(key, attachmentType) {
        add_attachment_row += "<option value='" + key + "'>" + attachmentType + "</option>";
    });
    add_attachment_row += "</select>";
    add_attachment_row += "</td>";
    add_attachment_row += "<td>";
    add_attachment_row += "<i class='fa fa-trash remove-attachment-row' aria-hidden='true'></i>";
    add_attachment_row += "</td>";
    add_attachment_row += "</tr>";
$("#attachment_table_body").append(add_attachment_row);

countAttachment++;
}
$(document).on('click','.remove-attachment-row',function(){
    $(this).parents('tr').remove();
});
var selected_course;
var selected_course_id;
function onCourseSelect() {
    selected_course = document.getElementById('course_id').options[document.getElementById('course_id').options.selectedIndex].innerText;
    selected_course_id = document.getElementById('course_id').value;
    swal({
        title: 'Are you sure to select this course?',
        type: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            $.ajax({
                url: "/getCourseDetails",
                // dataType: "json",
                type: "POST",
                data: {
                    _token: $("input[name='_token']").val(),
                    id: selected_course_id
                },
                success: function(data) {
                    console.log(data.subjects);
                    $("#session_select").html('');
                        var session_select = '';
                        session_select += "<select id='session_id' onChange='getCourseSessionStudent()' class='form-control'>";
                        session_select += "<option value=''>------ Select Session ------</option>";
                        jQuery.each(data.sessions, function(index, value) {
                            session_select += "<option value='" + value.session_id + "'>" + value.session_name + "</option>";
                        });
                        session_select += "</select></div>";
                        $("#session_select").append(session_select);
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
function getCourseSessionStudent() {
    selected_course = document.getElementById('course_id').options[document.getElementById('course_id').options.selectedIndex].innerText;
    selected_course_id = document.getElementById('course_id').value;
    selected_session = document.getElementById('course_id').options[document.getElementById('course_id').options.selectedIndex].innerText;
    selected_session_id = document.getElementById('course_id').value;
    swal({
        title: 'Are you sure to select this Session?',
        type: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            $.ajax({
                url: "/getCourseSessionStudent",
                // dataType: "json",
                type: "POST",
                data: {
                    _token: $("input[name='_token']").val(),
                    selected_course_id: selected_course_id,
                    selected_session_id: selected_session_id
                },
                success: function(data) {
                    console.log(data.student);
                    $("#student_list").html('');
                        var add_student = '';
                        add_student += "<select id='student_id' name='student_id' class='form-control'>";
                        add_student += "<option value=''>--- Select Student ---</option>";
                        jQuery.each(data.student, function(i,val){
                            add_student += "<option value='"+val.id+"'>"+val.student_name+"</option>";
                        });
                        add_student +="</select>";
                    $("#student_list").append(add_student);
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

var formdata = new FormData();
var attachment = {};
function saveAttachment(){
    attachment._token = $("input[name='_token']").val();
    for(i=0;i<countAttachment;i++){
        attachment.student_id = document.getElementById('student_id').value;
        attachment.attachment_type = [];
        for(k=0;k<countAttachment;k++){
            attachment_type_id = document.getElementById('attachment_type_id'+k).value;
            attachment.attachment_type [k] = attachment_type_id;
        }
        console.log(attachment);
        // console.log(attachment_type_id);

        formdata.append('data', JSON.stringify(attachment));
        const files = document.getElementById('attachment'+i).files;
        for (let i = 0; i < files.length; i++) {
            let file = files[i]
            formdata.append('files[]', file)
          }  
    }  
      $.ajax({
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
            },
        url: "/attachments",
        dataType: "json",
        type: "POST",
        contentType: false,   
        processData: false,
        data: formdata,
        success: function(data) {
            alertify.success("Attachment Process Completed Successfully.");
            // window.location = '/attachments';
        },
        error: function(data) {
            console.log(data);
            alertify.error(data.responseJSON.error);
        }
    });
}