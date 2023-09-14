var academic_count = 0;

$(document).ready(function () {
    academic_count = acadmicRecords.length;
});

$("#add_academic").click(function() {
    addAcademic();
});

function addAcademic() {

    // var add_row = "<script type=\"text/javascript\">  $('#multiple_drops').multiselect();</script>";
    var academic = {};
    var add_row = "<tr>";
    add_row += "<td><div class='form-group row'>";
    add_row += "<div class='col-sm-12'>";
    add_row += "<select id='academic_type_" + academic_count + "' class='form-control'>";
    jQuery.each(constants.academic_types, function(key, type) {
        add_row += "<option value='" + key + "'>" + type + "</option>";
    });
    add_row += "</select></div></div></td>";
    add_row += "<td><div class='form-group col-md-12'><input id='academic_year_" + academic_count + "' type='text' placeholder='YYYY' data-mask='9999' class='form-control'></div></td>"
    add_row += "<td><div class='form-group col-md-12'><input id='academic_marks_" + academic_count + "' type='text' placeholder='Marks' class='form-control'></div></td>"
    add_row += "<td><div class='form-group col-md-12'><input id='academic_grade_" + academic_count + "' type='text' placeholder='Grades' class='form-control'></div></td>"
    add_row += "<td><div class='form-group col-md-12'><input id='academic_school_" + academic_count + "' type='text' placeholder='School/College' class='form-control'></div></td>"
    add_row += "<td><div class='form-group col-md-12'><input id='academic_board_uni_" + academic_count + "' type='text' placeholder='Board/University' class='form-control'></div></td>"
    add_row += "<td><div class='form-group col-md-12'><div row_index='" + academic_count + "' class='deleteRowButton'><i class='mdi mdi-delete'></i></div></div></td>";
    add_row += "<input type='hidden' name='academic_row_state_" + academic_count + "' id='academic_row_state_" + academic_count + "' value='unchanged'></input>";
    add_row += "</tr>";
    $("#academic_table_body").append(add_row);
    removeRowClickEvent();
    if ($('#combo').attr('name') == "edit_combo") {
        $("#row_state_" + academic_count).val('edited');
    }
    academic_count++;
}

function removeRowClickEvent() {

    $('#academic_table_body').off('click', '.deleteRowButton').on('click', '.deleteRowButton', deleteAcademicTableRow);
}

function deleteAcademicTableRow(table_name) {
    $(this).parents('tr').first().hide();
    var cat_index = $(this).attr('row_index');
    $("#academic_row_state_" + cat_index).val('deleted');
}

function delete_admission(id) {
    swal({
        title: 'Do you want to delete this admission form?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        confirmButtonClass: 'btn btn-success',
        showLoaderOnConfirm: true,
        cancelButtonClass: 'btn btn-danger',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: "/enquiries/" + id + '/delete',
                // dataType: "json",
                method: "GET",
                success: function(data) {
                    orderIndexTable()
                },
                error: function(data) {
                    swal('Something went wrong!', data.statusText, 'error')
                }
            });
        } else if (
            // Read more about handling dismissals
            result.dismiss === swal.DismissReason.cancel) {
            swal('Cancelled', 'Admission form deletion cancelled successfully', 'error')
        }
    });
}

var selected_course;

function onCourseSelect(id) {
        selected_course = id;
}

function saveAdmission(form_no) {

    var admission = {
        _token: $("input[name='_token']").val(),
        form_no: form_no,
        student_name: document.getElementById('student_name').value,
        student_cnic_no: document.getElementById('student_cnic_no').value,
        father_name: document.getElementById('father_name').value,
        father_cnic_no: document.getElementById('father_cnic_no').value,
        d_o_b: document.getElementById('d_o_b').value,
        email: document.getElementById('email').value,
        father_cell_no: document.getElementById('father_cell_no').value,
        student_cell_no: document.getElementById('student_cell_no').value,
        ptcl_no: document.getElementById('ptcl_no').value,
        gaurdian_name: document.getElementById('gaurdian_name').value,
        gaurdian_cell_no: document.getElementById('gaurdian_cell_no').value,
        gaurdian_relationship: document.getElementById('gaurdian_relationship').value,
        present_address: document.getElementById('present_address').value,
        permanent_address: document.getElementById('permanent_address').value,
        father_work_address: document.getElementById('father_work_address').value,
        reference: document.getElementById('reference').value,
        course_name: document.getElementById('course_name').value,
        session_name: document.getElementById('session_name').value,
        session_id: document.getElementById('session_id').value,
        course_id: selected_course,
    }
    admission.acadmicRecords = [];
    for (var i = 0; i < academic_count; i++) {
        if (document.getElementById('academic_row_state_' + i).value != 'deleted') {
            var record = {
                type_name: constants.academic_types[document.getElementById('academic_type_' + i).value],
                type_id: document.getElementById('academic_type_' + i).value,
                year: document.getElementById('academic_year_' + i).value,
                grade: document.getElementById('academic_grade_' + i).value,
                marks: document.getElementById('academic_marks_' + i).value,
                school_college: document.getElementById('academic_school_' + i).value,
                board_uni: document.getElementById('academic_board_uni_' + i).value,
            }
            admission.acadmicRecords[i] = record;
        }
    }
    $.ajax({
          url: "/admissions",
          // dataType: "json",
          type: "POST",
          data: admission,
          success: function(data) {
            window.location = '/admissions';
          },
          error: function(data) {
            alertify.error('Something went wrong.')
          }
        });
}
