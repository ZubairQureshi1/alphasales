var academic_count = 0;
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

function courseSelect() {
    console.log('select called');
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
var selected_course_id;
var selected_course;
var datesheet = {};
var dta = [];

function onCourseSelect() {
    selected_course = $('#course_id').val();
    selected_course_id = selected_course[selected_course.length - 1];
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

                    Array.prototype.push.apply(dta, data.subjects);

                    console.log(dta);
                    var newdta = removeDuplicates(dta, "subject_name");
                    console.log(newdta);
                    $("#course_subject").html("");
                    jQuery.each(newdta, function(index, value) {
                        var add_row = "<div class='row'><div class='col-sm-2'>";
                        add_row += "<label>" + value.subject_name + "</label></div>"; //col
                        add_row += "<div class='col-sm-2'>";
                        add_row += "<strong>Date</strong>";
                        add_row += "<input name='date'  class='form-control' type='date' id='date" + value.subject_id + "'></input>";
                        add_row += "</div>";
                        add_row += "<div class='col-sm-2'>";
                        add_row += "<strong>Start Time</strong>";
                        add_row += "<input name='start_time'  class='form-control' type='time' id='start_time_" + value.subject_id + "'></input>";
                        add_row += "</div>";
                        add_row += "<div class='col-sm-2'>";
                        add_row += "<strong>End Time</strong>";
                        add_row += "<input name='end_time' class='form-control' type='time' id='end_time_" + value.subject_id + "'></input>";
                        add_row += "</div>";
                        add_row += "<div class='col-sm-2'>";
                        add_row += "<strong>Syllabus</strong>";
                        add_row += "<textarea name='syllabus' class='form-control' id='syllabus" + value.subject_id + "'></textarea>";
                        add_row += "</div>";
                        add_row += "<div class='col-sm-2'><div class='text-center'><input name='course_id' type='checkbox' id='subject_id_" + value.subject_id + "' onclick='onBooksSelect(" + value.subject_id + ")' switch='bool' value='" + value.subject_name + "'></input>"
                        add_row += "<label for='subject_id_" + value.subject_id + "' data-on-label='Yes' data-off-label='No'></label></div></div>";
                        add_row += "</div>"; //row end
                        $("#course_subject").append(add_row);
                    });
                    $("#student_quantity").val(data.total_students);
                    var student_strength = data.total_students;
                    jQuery.each(rooms_array, function(i, val) {
                        if (student_strength > 0) {
                            student_strength = student_strength - val.sitting_capacity;
                            document.getElementById('rooms').options[i].selected = true;
                            $('#rooms').trigger('change');
                        } else {
                            document.getElementById('rooms').options[i].selected = false;
                            $('#rooms').trigger('change');
                        }
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

function onBooksSelect(selected_book_id) {
    var object = {
        subject_id: selected_book_id,
        date: document.getElementById('date' + selected_book_id).value,
        start_time: document.getElementById('start_time_' + selected_book_id).value,
        end_time: document.getElementById('end_time_' + selected_book_id).value,
        syllabus: document.getElementById('syllabus' + selected_book_id).value,
    };
    var name = object;
    if (!datesheet.datesheetBooks) {
        datesheet.datesheetBooks = [];
    }
    datesheet.datesheetBooks.push(name);
}
var selected_section_id;
var selected_section;
var student_strength = 0;
var db_students = [];
temp_array = [];
temp_selected_section = [];
selected_section = null;

function onSectionSelect() {
    temp_selected_section = $('#sections').val();
    if (selected_section == null) {
        selected_section = temp_selected_section;
        selected_section_id = temp_selected_section[0];
    } else {
        temp_selected_section.filter(function(n) {
            if (selected_section.indexOf(n) === -1) {
                selected_section_id = n;
            }
        });
        selected_section.push(selected_section_id);
    }
    swal({
        title: 'Are you sure to select this Section?',
        type: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            $.ajax({
                url: "/getSectionDetail",
                // dataType: "json",
                type: "POST",
                data: {
                    _token: $("input[name='_token']").val(),
                    id: selected_section_id,
                    session_id: $('#session_id').val(),
                },
                success: function(data) {
                    db_students = db_students.concat(data.db_section_students);
                    student_strength = data.total_students + student_strength;

                    $("#student_quantity").val(student_strength);
                    var temp_student_strength = student_strength;
                    jQuery.each(rooms_array, function(i, val) {
                        if (temp_student_strength > 0) {
                            temp_student_strength = temp_student_strength - val.sitting_capacity;
                            var x = document.getElementById('rooms').options[i].selected = true;

                            $('#rooms').trigger('change');
                        } else {
                            document.getElementById('rooms').options[i].selected = false;
                            $('#rooms').trigger('change');
                        }
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
} //section_room_select End
$(document).ready(function() {
    $("#SectionResetbtn").click(function() {
        window.location.reload(true);
    });
});

var selected_award_section_id;
var selected_award_section;

function onAwardSectionSelect() {
    selected_award_section = document.getElementById('sections').options[document.getElementById('sections').options.selectedIndex].innerText;
    selected_award_section_id = document.getElementById('sections').value;
    swal({
        title: 'Are you sure to select this Section for Student Award List?',
        type: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            $.ajax({
                url: "/getAwardSectionDetail",
                // dataType: "json",
                type: "POST",
                data: {
                    _token: $("input[name='_token']").val(),
                    id: selected_award_section_id
                },
                success: function(data) {
                    $("#student_quantity").val(data.total_students);
                    $("#section_students_data").html("");
                    jQuery.each(data.section_students, function(index, value) {
                        var add_row;
                        add_row += "<tr>";
                        add_row += "<td>" + value.roll_no + "</td>";
                        add_row += "<td>" + value.old_roll_no + "</td>";
                        add_row += "<td>" + value.student_name + "</td>";
                        add_row += "<td></td>";
                        add_row += "<td></td>";
                        add_row += "</tr>";
                        $("#section_students_data").append(add_row);
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
} //end Award List

function saveDatesheet() {
    alertify.confirm("Are you sure to proceed?", function(ev) {
            ev.preventDefault();
            isException = false;
            datesheet._token = $("input[name='_token']").val();
            try {
                datesheet.exam_type_id = document.getElementById('exam_type_id').value;
            } catch (exception) {
                isException = true;
                alertify.error('Something went wrong at examtype.');
            }
            try {
                datesheet.session_id = document.getElementById('session_id').value;
            } catch (exception) {
                isException = true;
                alertify.error('Something went wrong at session.');
            }
            try {
                datesheet.course_id = $('#course_id').val();
            } catch (exception) {
                isException = true;
                alertify.error('Something went wrong at course.');
            }
            try {
                datesheet.sections = $("#sections").val();
            } catch (exception) {
                isException = true;
                alertify.error('Something went wrong at section.');
            }
            try {
                datesheet.rooms = $("#rooms").val();
            } catch (exception) {
                isException = true;
                alertify.error('Something went wrong at room.');
            }
            try {
                datesheet.db_students = [];
                for (var i = 0; i < db_students.length; i++) {
                    datesheet.db_students.push(db_students[i].id);
                }
            } catch (exception) {
                isException = true;
                alertify.error('Something went wrong at students.');
            }
            if (document.getElementById('enquiry_id') && document.getElementById('enquiry_id').value) {
                datesheet.enquiry_id = document.getElementById('enquiry_id').value;
            }
            if (!isException) {

                $.ajax({
                    url: "/datesheet",
                    dataType: "json",
                    type: "POST",
                    data: datesheet,
                    success: function(data) {
                        alertify.success("DateSheet Process Completed Successfully.");
                        // window.location = '/datesheet';
                    },
                    error: function(data) {
                        if (data.success) {
                            alertify.success("DateSheet Process Completed Successfully.");
                            // window.location = '/datesheet';
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
            alertify.error("DateSheet Process Cancelled Successfully.");
        });
}

function removeDuplicates(originalArray, prop) {
    var newArray = [];
    var lookupObject = {};

    for (var i in originalArray) {
        lookupObject[originalArray[i][prop]] = originalArray[i];
    }

    for (i in lookupObject) {
        newArray.push(lookupObject[i]);

    }
    newArray.pop();

    return newArray;
}