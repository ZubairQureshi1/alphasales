function updateManualAttendance( /*route, */ id) {
	var manual_attendance = {};
	manual_attendance._token = $("input[name='_token']").val();
	// manual_attendance.check_in_time = document.getElementById('check_in_time').value;
	// manual_attendance.check_out_time = document.getElementById('check_out_time').value;

	$.ajax({
		url: '../manualAttendance/' + id,
		dataType: "json",
		type: "POST",
		data: manual_attendance,
		success: function(data) {
			// jQuery("#" + id).modal("hide");
			alertify.success("Manual Attendance Updated Successfully.");
            document.getElementById('present_' + id).hidden = true;
            document.getElementById('leave_' + id).disabled = true;
            $('#status_' + id).text('Present');
			// document.getElementById('check_in_time_gmt_' + id).value = data.data.check_in_time;
			// document.getElementById('check_out_time_gmt_' + id).value = data.data.check_out_time;
		},
		error: function(data) {
			console.log(data);
			alertify.error(data.responseJSON.error);
		}
	});
}

function setLeave( /*route, */ id) {

	$.ajax({
		url: '../isOnLeave/' + id,
		dataType: "json",
		type: "GET",
		headers: {
			'X-CSRF-TOKEN': $("input[name='_token']").val()
		},
		success: function(data) {
			alertify.success("Leave Applied Successfully.");
			
            document.getElementById('leave_' + id).hidden = true;
            document.getElementById('present_' + id).disabled = true;
			$('#status_' + id).text('Leave');
			// document.getElementById('attendance_edit_' + id).hidden = true;
		},
		error: function(data) {
			alertify.error(data.responseJSON.error);
		}
	});
}


function onWingSelect(){
    document.getElementById('report_loading').hidden = false;
    select_wing_id = document.getElementById('calculation_wing_id').value;
    $('#calculation_affiliated_body_id').empty();
    $('#calculation_term_id').empty();
    $('#calculation_section_id').empty();
    // send ajax
    if(select_wing_id){        
        $.ajax({
            url: "/sections/getCourseList",
            type: "POST",
            data: {
                _token: $("input[name='_token']").val(),
                wing: select_wing_id
            },
            success: function(data) {
                document.getElementById('report_loading').hidden = true;
                $('#calculation_course_id').empty();                
                $('#calculation_course_id').append($('<option selected disabled></option>').attr('value', '').text('---Select Course---'));
                jQuery.each(data, function(index, value) {
                    $('#calculation_course_id').append($('<option></option>').attr('value', index).text(value));
                });
            },
            error: function(data) {
                alertify.error('Something Went Wrong!');
            }
        });
    } else {
        alertify.error('Please Select Required Information.');
    }
}


function onCourseSelect(){
    document.getElementById('report_loading').hidden = false;
    select_wing_id = document.getElementById('calculation_wing_id').value;
    select_course_id = document.getElementById('calculation_course_id').value;
    // Clearout previos results
    $('#calculation_affiliated_body_id').empty();
    $('#calculation_term_id').empty();
    $('#calculation_section_id').empty();
    if(select_course_id && select_wing_id){
        $.ajax({
            url: "/sections/getAffiliatedBodiesByCourse/"+select_course_id+'/'+select_wing_id,
            type: "POST",
            data: {
                _token: $("input[name='_token']").val(),
            },
            success: function(data) {
                document.getElementById('report_loading').hidden = true;
                $('#calculation_affiliated_body_id').empty();
                $('#calculation_affiliated_body_id').append($('<option></option>').attr('value', '').text('--- Select Affiliated Body ---'));
                jQuery.each(data, function(index, value) {
                    $('#calculation_affiliated_body_id').append($('<option></option>').attr('value', value.affiliated_body_id).text(value.affiliated_body_name));
                });
            },
            error: function(data) {
                alertify.error('Something went wrong.')
            }
        });
    } else {
        alertify.error('Please Select Required Information.');
    }
}

function onAffiliatedBodySelect() {
    document.getElementById('report_loading').hidden = false;
    affiliated_body_id = document.getElementById('calculation_affiliated_body_id').value;
    select_wing_id = document.getElementById('calculation_wing_id').value;
    select_course_id = document.getElementById('calculation_course_id').value;
    // Clearout previos results
    $('#term_id').empty();
    $('#calculation_section_id').empty();
    // ajax
    if(affiliated_body_id && select_wing_id){
        $.ajax({
            url: "/sections/getCourseAcademicTerms/"+select_course_id+'/'+select_wing_id,
            type: "POST",
            data: {
                _token: $("input[name='_token']").val(),
            },
            success: function(data) {
                document.getElementById('report_loading').hidden = true;
                $('#calculation_term_id').empty();
                $('#calculation_term_id').append($('<option selected disabled></option>').attr('value', '').text('---Select Term---'));
                jQuery.each(data, function(index, value) {
                    $('#calculation_term_id').append($('<option></option>').attr('value', value).text(value));
                });
            },
            error: function(data) {
                alertify.error('Something went wrong.')
            }
        });
    } else {
        alertify.error('Please Select Required Information.');
    }
}

function onShiftSelect() {
    document.getElementById('report_loading').hidden = false;
    let params = {
	    select_wing_id: document.getElementById('calculation_wing_id').value,
	    select_course_id: document.getElementById('calculation_course_id').value,
	    affiliated_body_id: document.getElementById('calculation_affiliated_body_id').value,
	    annual_semester: document.getElementById('calculation_term_id').value,
	    shift_id: document.getElementById('calculation_shift_id').value
    };
    // ajax
    if(params.select_wing_id && params.select_course_id && params.affiliated_body_id && params.annual_semester && params.shift_id){
        $.ajax({
            url: "/sections/getSectionsDetailsByFilters",
            type: "POST",
            data: {
                _token: $("input[name='_token']").val(),
                params : params
            },
            success: function(data) {
                document.getElementById('report_loading').hidden = true;
                $('#calculation_section_id').empty();
                $('#calculation_section_id').append($('<option selected disabled></option>').attr('value', '').text('--- Select Section ---'));
                jQuery.each(data, function(index, value) {
                    $('#calculation_section_id').append($('<option></option>').attr('value', index).text(value));
                });
            },
            error: function(data) {
                alertify.error('Something went wrong.')
            }
        });
    } else {
        alertify.error('Please Select Required Information.');
    }
}




function validateForm() {
    var form_validated = true;
    var fields = document.getElementsByClassName('item-required');
    var message = "Attendance cannot be calculated unless you select required fields:"
    $.each(fields, function(i, field) {
        if (!field.hidden && !field.value && !field.parentElement.hidden) {
            message += "\r\n" + field.attributes.errorlabel.value;
            form_validated = false;
        }
    });
    if (!form_validated) {
        $.notify(message, "error");
    } else {
        form_validated = true;
        $('#calculateStudentAttendance').submit();
    }
}