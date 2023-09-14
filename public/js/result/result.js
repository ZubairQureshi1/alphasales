var selected_datesheet_id;
var selected_datesheet;
var default_total_marks;

function onDateSheetSelect() {
    selected_datesheet = document.getElementById('datesheet_id').options[document.getElementById('datesheet_id').options.selectedIndex].innerText;
    selected_datesheet_id = document.getElementById('datesheet_id').value;
    $("#section_id").val('');
    swal({
        title: 'Are you sure to select this DateSheet?',
        type: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            $.ajax({
                url: "/getDateSheetInfo",
                // dataType: "json",
                type: "POST",
                data: {
                    _token: $("input[name='_token']").val(),
                    id: selected_datesheet_id
                },
                success: function(data) {
                    jQuery.each(data.datesheet_sections, function(index, value) {
                        var date_sheet_sections = value.selected_section_name;
                        if ($("#section_id").val() == '') {
                            $("#section_id").val(date_sheet_sections);
                        } else {
                            $("#section_id").val($("#section_id").val() + ', ' + date_sheet_sections);
                        }
                    });
                    jQuery.each(data.datesheet_exam_types, function(i, val) {
                        var datesheet_examtype = val.exam_type;
                        $("#exam_type_id").val(datesheet_examtype);
                    });
                    jQuery.each(data.datesheet_sessions, function(i, val) {
                        var date_sheet_sessions = val.session_name;
                        $("#session_id").val(date_sheet_sessions);
                    });
                    $(".subject_show").show();
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
var selected_subject_id;
var selected_subject;

function onSubjectSelect() {
    selected_subject = document.getElementById('subject_id').options[document.getElementById('subject_id').options.selectedIndex].innerText;
    selected_subject_id = document.getElementById('subject_id').value;
    default_total_marks = document.getElementById('default_total_marks').value;
    swal({
        title: 'Are you sure to Filter this Subject Students?',
        type: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            $.ajax({
                url: "/getSubjectStudents",
                // dataType: "json",
                type: "POST",
                data: {
                    _token: $("input[name='_token']").val(),
                    selected_subject_id: selected_subject_id,
                    selected_datesheet_id : selected_datesheet_id
                },
                success: function(data) {
                    $(".result_entry_section").html("");
                    jQuery.each(data.date_sheet_students , function(index , value) {
                    var add_row = '';
                    add_row += "<tr>";
                    add_row += "<td>"+value.student_roll_no+"</td>";
                    add_row += "<td>"+value.student_name+"</td>";
                    add_row += "<td>"+value.student_old_roll_no+"</td>";
                    add_row += "<td>"+value.student_section+"</td>";
                    add_row += "<input type='hidden' id='db_row_"+value.student_id+"' name='' class='form-control' value='"+ value.id +"'></td>";
                    add_row += "<td><input type='text' value='"+default_total_marks+"' id='total_marks_"+value.student_id+"' name='total_marks' class='form-control for_row_hide' placeholder='Enter Total Marks'></td>";
                    add_row += "<td><input type='text' id='obtain_marks_"+value.student_id+"' name='obtain_marks' onkeyup='percentageCalculate("+value.student_id+")' class='form-control' placeholder='Enter Obtain Marks'></td>";
                    add_row += "<td><input type='text' id='percentage_"+value.student_id+"' name='percentage' class='form-control' placeholder='Percentage'></td>";
                    add_row += "<td><input type='text' id='grade_"+value.student_id+"' name='grade' class='form-control' placeholder='Grade'></td>";
                    add_row += "<td><select class='form-control' name='status' id='status_id_"+value.student_id+"'>";
                    add_row += "<option>----Select Status----</option>";
                    add_row += "<option value='0'>Pass</option>";
                    add_row += "<option value='1'>Fail</option>";
                    add_row += "</select></td>";
                    add_row += "<td><input type='button' class='btn btn-primary' onclick='ResultSave("+value.student_id+")' value='Submit'></td>";
                    add_row += "</tr>";
                    $(".result_entry_section").append(add_row);
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
    action_to_perform_id = document.getElementById('action_to_perform_id').value;

    default_total_marks = document.getElementById('default_total_marks').value;

    if (action_to_perform_id == null || action_to_perform_id == '') {
        $('#action_to_perform_message').html('Select Action To Proceed');
    } else if (selected_subject_id == null || selected_subject_id == '') {
        $('#subject_message').html('Select Subject To Proceed');
    } else if (action_to_perform_id == 0 && (default_total_marks == null || default_total_marks == '')) {
        $('#default_total_marks_message').html('Set Total Marks To Proceed');
    } else {

        swal({
            title: 'Are you sure to Filter this Subject Students?',
            type: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                $(".result_entry_section").html("");
                document.getElementById('report_loading').hidden = false;
                $.ajax({
                    url: "/getSubjectStudents",
                    // dataType: "json",
                    type: "POST",
                    data: {
                        _token: $("input[name='_token']").val(),
                        selected_subject_id: selected_subject_id,
                        selected_datesheet_id: selected_datesheet_id,
                        action_to_perform: action_to_perform_id
                    },
                    success: function(data) {
                        document.getElementById('report_loading').hidden = true;
                        jQuery.each(data.date_sheet_students, function(index, value) {

                            $(".result_entry_section").append(appendStudentForResult(value, action_to_perform_id));
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
}

function appendStudentForResult(value, action_to_perform) {
    var add_row = '';
    add_row += "<tr>";
    add_row += "<td>" + value.student_roll_no + "</td>";
    add_row += "<td>" + value.student_name + "</td>";
    add_row += "<td>" + value.student_old_roll_no + "</td>";
    add_row += "<td>" + value.student_section + "</td>";
    add_row += "<input type='hidden' id='db_row_" + value.student_id + "' name='' class='form-control' value='" + value.id + "'></td>";
    if (action_to_perform == 1) {
        add_row += "<td><input type='text' value='" + value.total_marks + "' id='total_marks_" + value.student_id + "' disabled='" + value.field_disabled + "' name='total_marks' class='form-control for_row_hide' placeholder='Enter Total Marks'></td>";
    } else {
        add_row += "<td><input type='text' value='" + default_total_marks + "' id='total_marks_" + value.student_id + "' name='total_marks' class='form-control for_row_hide' placeholder='Enter Total Marks'></td>";
    }
    if (action_to_perform == 1) {
        add_row += "<td><input type='text' id='obtain_marks_" + value.student_id + "' name='obtain_marks' value='" + value.obtain_marks + "' disabled='" + value.field_disabled + "' onkeyup='percentageCalculate(" + value.student_id + ")' class='form-control' placeholder='Enter Obtain Marks'></td>";
    } else {
        add_row += "<td><input type='text' id='obtain_marks_" + value.student_id + "' name='obtain_marks' onkeyup='percentageCalculate(" + value.student_id + ")' class='form-control' placeholder='Enter Obtain Marks'></td>";
    }
    if (action_to_perform == 1) {
        add_row += "<td><input type='text' id='percentage_" + value.student_id + "' value='" + value.percentage + "' disabled='" + value.field_disabled + "'  name='percentage' class='form-control' placeholder='Percentage'></td>";
    } else {
        add_row += "<td><input type='text' id='percentage_" + value.student_id + "' name='percentage' class='form-control' placeholder='Percentage'></td>";
    }
    if (action_to_perform == 1) {
        add_row += "<td><input type='text' id='grade_" + value.student_id + "' value='" + value.grade + "' disabled='" + value.field_disabled + "'  name='grade' class='form-control' placeholder='Grade'></td>";
    } else {
        add_row += "<td><input type='text' id='grade_" + value.student_id + "' name='grade' class='form-control' placeholder='Grade'></td>";
    }
    if (action_to_perform == 1) {
        add_row += "<td><select class='form-control' name='status' disabled='" + value.field_disabled + "'  id='status_id_" + value.student_id + "'>";
        add_row += "<option selected>" + value.status + "</option>";
        add_row += "</select></td>";
    } else {
        add_row += "<td><select class='form-control' name='status' id='status_id_" + value.student_id + "'>";
        add_row += "<option>----Select Status----</option>";
        add_row += "<option value='0'>Pass</option>";
        add_row += "<option value='1'>Fail</option>";
        add_row += "</select></td>";
    }
    if (action_to_perform == 1) {
        add_row += "<td>--</td>";
    } else {
        add_row += "<td><input type='button' class='btn btn-primary' onclick='ResultSave(" + value.student_id + ")' value='Submit'></td>";
    }
    add_row += "</tr>";

    return add_row;
}
var total_marks;
var obtain_marks;
var percentage;
var status;
function percentageCalculate(st_id){
    total_marks = document.getElementById('total_marks_'+st_id).value;
    obtain_marks = document.getElementById('obtain_marks_'+st_id).value;
    percentage = (obtain_marks/total_marks)*100;
    $("#percentage_"+st_id).val(percentage);
    if(percentage < 40){
        document.querySelector('#status_id_'+st_id).value = '1';
    }else{
        document.querySelector('#status_id_'+st_id).value = '0';
    }
}
var result = {}

function ResultSave(st_id) {
    alertify.confirm("Are you sure to proceed?", function(ev) {
            ev.preventDefault();
            isException = false;
            result._token = $("input[name='_token']").val();
            try {
                result.total_marks = document.getElementById('total_marks_' + st_id).value;
            } catch (exception) {
                isException = true;
                alertify.error('Something went wrong at Total Marks.');
            }
            try {
                result.obtain_marks = document.getElementById('obtain_marks_' + st_id).value;
            } catch (exception) {
                isException = true;
                alertify.error('Something went wrong at Obtain Marks.');
            }
            try {
                result.percentage = document.getElementById('percentage_' + st_id).value;
            } catch (exception) {
                isException = true;
                alertify.error('Something went wrong at percentage.');
            }
            try {
                result.grade = document.getElementById('grade_' + st_id).value;
            } catch (exception) {
                isException = true;
                alertify.error('Something went wrong at Grade.');
            }
            try {
                result.status_id = document.getElementById('status_id_' + st_id).value;
                result.status = document.getElementById('status_id_' + st_id).options[document.getElementById('status_id_' + st_id).options.selectedIndex].innerText;
            } catch (exception) {
                isException = true;
                alertify.error('Something went wrong at Status P/F.');
            }
            if (!isException) {
                $.ajax({
                    url: "updateStudentResult/" + document.getElementById('db_row_' + st_id).value + "/update",
                    dataType: "json",
                    type: "POST",
                    data: result,
                    success: function(data) {
                        alertify.success("Result Process Completed Successfully.");
                        $("#total_marks_" + st_id).parent().parent().hide();
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
            alertify.error("Result Process Cancelled Successfully.");
        });
}