function onWingSelect(){
    select_wing_id = document.getElementById('filter_wing_id').value;
    document.getElementById('report_loading').hidden = false;
    if(select_wing_id){
        $.ajax({
            url: "/getAttendanceCourseList/"+select_wing_id,
            type: "POST",
            data: {
                _token: $("input[name='_token']").val(),
            },
            success: function(data) {
            	document.getElementById('report_loading').hidden = true;
                $('#course_id').empty();
                $('#subject_id').empty();
                $('#section_id').empty();
                $('#teacher_id').empty();
                $('#course_id').append($('<option selected disabled></option>').attr('value', '').text('---Select Course---'));
                jQuery.each(data, function(index, value) {
                    $('#course_id').append($('<option></option>').attr('value', value.course_id).html(`${value.course_name} (${value.affiliated_body_name})`));
                });
            },
            error: function(data) {
                alertify.error('Something went wrong.');
            }
        });
    } else {
		alert('No Value Selected');
	}
}

function onCourseSelect(){
    select_wing_id = document.getElementById('filter_wing_id').value;
    select_course_id = document.getElementById('course_id').value;
    document.getElementById('report_loading').hidden = false;
    if(select_course_id){
        $.ajax({
            url: "/sections/getCourseAcademicTerms/"+select_course_id+'/'+select_wing_id,
            type: "POST",
            data: {
                _token: $("input[name='_token']").val(),
            },
            success: function(data) {
            	document.getElementById('report_loading').hidden = true;
                $('#term_id').empty();
                $('#term_id').append($('<option selected disabled></option>').attr('value', '').text('---Select Term---'));
                jQuery.each(data, function(index, value) {
                    $('#term_id').append($('<option></option>').attr('value', value).text(value));
                });
            },
            error: function(data) {
                alert('error');
            }
        });
    } else {
		alert('No Value Selected');
	}
}

function onTermSelect() {
    document.getElementById('report_loading').hidden = false;
    select_wing_id = document.getElementById('filter_wing_id').value;
    select_course_id = document.getElementById('course_id').value;
    select_term_id = document.getElementById('term_id').value;
    // ajax
    if(select_course_id && select_wing_id && select_term_id){
        $.ajax({
            url: "/sections/getSubjectList/"+select_course_id+'/'+select_wing_id+'/'+select_term_id,
            type: "POST",
            data: {
                _token: $("input[name='_token']").val(),
            },
            success: function(data) {
                console.log(data);
                document.getElementById('report_loading').hidden = true;
                $('#subject_id').empty();
                $('#subject_id').append($('<option selected disabled></option>').attr('value', '').text('---Select Subject---'));
                jQuery.each(data, function(index, value) {
                    $('#subject_id').append($('<option></option>').attr('value', index).text(value));
                });
            },
            error: function(data) {
                alertify.error('Something went wrong.');
            }
        });
    } else {
        alertify.error('Please Select Required Information.');
    }
}

function onSubjectSelect(){
    select_wing_id = document.getElementById('filter_wing_id').value;
    select_course_id = document.getElementById('course_id').value;
    select_subject_id = document.getElementById('subject_id').value;
    select_term_id = document.getElementById('term_id').value;
    document.getElementById('report_loading').hidden = false;
    if (select_subject_id) {
	    $.ajax({
	        url: "/getAttendanceSectionList/"+select_subject_id+'/'+select_course_id+'/'+select_wing_id+'/'+select_term_id,
	        type: "POST",
	        data: {
	            _token: $("input[name='_token']").val(),
	        },
	        success: function(data) {
	        	document.getElementById('report_loading').hidden = true;
	        	$('#teacher_id').empty();
	        	$('#section_id').empty();
	        	// 
	        	$('#section_id').append($('<option selected disabled></option>').attr('value', '').text('---Select Subject---'));
	            jQuery.each(data, function(index, value) {
	                $('#section_id').append($('<option></option>').attr('value', value).text(index));
	            });
	        },
	        error: function(data) {
	            alert('error');
	        }
	    });
	} else {
		alert('No Value Selected');
	}
}

function onSectionSelect(){
    select_wing_id = document.getElementById('filter_wing_id').value;
    select_section_id = document.getElementById('section_id').value;
    subject_id = document.getElementById('subject_id').value;
    document.getElementById('report_loading').hidden = false;

    if (select_section_id) {
	    $.ajax({
	        url: "/getAttendanceTeachersList/"+select_section_id+"/"+subject_id,
	        type: "POST",
	        data: {
	            _token: $("input[name='_token']").val(),
	        },
	        success: function(data) {
	            document.getElementById('report_loading').hidden = true;
	            $('#teacher_id').empty();
	        	// append
	        	$('#teacher_id').append($('<option selected disabled></option>').attr('value', '').text('---Select Subject---'));
	            jQuery.each(data, function(index, value) {
	                $('#teacher_id').append($('<option></option>').attr('value', index).text(value));
	            });
	        },
	        error: function(data) {
	            alert('error');
	        }
	    });
	} else {
		alert('No Value Selected');
	}
}


function getFilteredData() {
    document.getElementById('report_loading').hidden = false;
	var params = {
        wing_id: document.getElementById('filter_wing_id').value,
        course_id: document.getElementById('course_id').value,
        subject_id: document.getElementById('subject_id').value,
        section_detail_id: document.getElementById('section_id').value,
        teacher_id: document.getElementById('teacher_id').value,
        term_id: document.getElementById('term_id').value,
        room_id: document.getElementById('room_id').value,
        title: document.getElementById('title').value,
        date_time: document.getElementById('date_time').value
    }
    
    // send request
    $.ajax({
        url: "/attendance/getFilteredData/",
        type: "POST",
        data: {
            _token: $("input[name='_token']").val(),
            params: params
        },
        beforeSend: function() {
           	$('#filteredResponse').empty();
        },
        success: function(data) {
            document.getElementById('report_loading').hidden = true;
           	// return view	
           	$('#filteredResponse').append(data);
        },
        error: function(data) {
            alert('error');
        }
    });
}

// Validate Attendance Filter Start...
var form_bypassed = 0;
function validateForm() {
    var self = this;
    var form_validated = true;
    var can_show_bypass_message = true;
    var fields = document.getElementsByClassName('item-required');
    var message = "Note: Please select required Feilds!"
    var bypass_message = "<strong class='text-danger'>Note:</strong> <u> Please select required Feilds!</u><br>"
    $.each(fields, function(i, field) {
        if (!field.hidden && !field.value && !field.hasAttribute('never-bypass')) {
            bypass_message += "<br> --- \r\n" + field.attributes.errorlabel.value;
            form_validated = false;
        } else if (!field.hidden && !field.value && field.hasAttribute('never-bypass')) {
            form_validated = false;
            can_show_bypass_message = false;
            message += "\r\n" + field.attributes.errorlabel.value;
        }
    });
    if (form_validated) {
        self.form_bypassed = 0

        getFilteredData();
    } else {
        if (can_show_bypass_message) {
            alertify.alert(bypass_message, function() {
                self.form_bypassed = 1
            }, function() {
                return form_validated;
            });
        } else {
            $.notify(message, "error");
        }
    }
}
// Validate Attendance Filter End...

function storeAttendanceData() {    
    event.preventDefault();
    var studentAttendances = [];
    var student_count = 0;

    studentAttendances = {
        'wing_id' : document.getElementById('filter_wing_id').value,
        'course_id' : document.getElementById('course_id').value,
        'subject_id' : document.getElementById('subject_id').value,
        'section_id' : document.getElementById('section_id').value,
        'teacher_id' : document.getElementById('teacher_id').value,
        'room_id' : document.getElementById('room_id').value,
        'title' : document.getElementById('title').value,
        'date_time' : document.getElementById('date_time').value,
    }
    studentAttendances.attendance = [];
    for (var i = 1; i <= $('#students_count').val(); i++ ) {
        var attendance = {
            student_id: document.getElementById('student_id_'+i).value != null ? document.getElementById('student_id_'+i).value : '',
            attendance_status_id: document.getElementById('attendance_status_id_'+i).value != null ? document.getElementById('attendance_status_id_'+i).value : '',
            attendance_status_type: document.getElementById('attendance_status_id_'+i).options[document.getElementById('attendance_status_id_'+i).options.selectedIndex].innerText != null ?  document.getElementById('attendance_status_id_'+i).options[document.getElementById('attendance_status_id_'+i).options.selectedIndex].innerText : '',
        }
        studentAttendances.attendance[i] = attendance;
    }
    // alert(student_count);

    $.ajax({
        url: "/studentAttendance/saveAttendanceData",
        type: "POST",
        data: {
            _token: $("input[name='_token']").val(),
            studentAttendances:studentAttendances
        },
        beforeSend: function() {
                $.notify("Requsting Server! Please wait....", 'info');  
            },
            success: function(resp) {
                swal({
                    title: 'Attendance Saved Successfully!',
                    type: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok',
                    confirmButtonClass: 'btn btn-success',
                    showLoaderOnConfirm: true,
                    reverseButtons: false
                }).then((result) => {
                    if (result.value) {
                        window.location = "/studentAttendance/studentAttendanceDetail";                        
                    }
                });
            },
            error: function(error) {
                $.notify("Something went wrong!", 'error'); 
                console.log(error)
            }
    });
}


function printAttendanceDocument() {
	document.getElementById('report_loading').hidden = false;
	$.ajax({
        url: "/printAttendance",
        type: "GET",
        data: {
            _token: $("input[name='_token']").val(),
            params: {
            	wing_id,
            	course_id,
            	subject_id,
            	section_id,
            	teacher_id,
            	room_id,
            	title,
            	date_time
            }
        },
        beforeSend: function() {
           	alertify.success('Please Wait.....');
        },
        success: function(data) {
            document.getElementById('report_loading').hidden = true;
           	// return view
           	if(data.success) {
	           	window.open('/attendance/downloadGeneratedPdf', '_blank');
           	}	
        },
        error: function(error) {
            alertify.error('Something went wrong');
        }
    });
}

function onStatusChange(e){
    var status_id = $(e.target).val();
    var student_attendance_id = $(e.target).attr('data_attendance_id');
    var student_id = $(e.target).attr('data_student_id');
    var section_subject_detail_id = $(e.target).attr('data_subject_id');
    var section_detail_id = $(e.target).attr('data_section_id');
    var status_type = '';
    var student_obj = [];
    jQuery.each(constants.attendance_statuses, function(key, type) {
        if(key == status_id){
            status_type = type;
        }
    });
    student_obj = {
        'status_id' : status_id,
        'attendance_id' : student_attendance_id,
        'status_type' : status_type,
        'student_id' : student_id,
        'section_subject_detail_id' : section_subject_detail_id,
        'section_detail_id' : section_detail_id,
    };

    $.ajax({
        url: "/studentAttendance/editStudentAttendanceStatus",
        type: "POST",
        data:{
            _token: $("input[name='_token']").val(),
            student_obj,
        },
        beforeSend: function() {
                $.notify("Requsting Server! Please wait....", 'info');  
            },
            success: function(resp) {
                swal({
                    title: 'Attendance Updated Successfully.',
                    type: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok',
                    confirmButtonClass: 'btn btn-success',
                    showLoaderOnConfirm: true,
                    reverseButtons: false
                }).then((result) => {
                    if (result.value) {
                        // window.location = document.referrer;                        
                    }
                });

            },
            error: function(error) {
                $.notify("Something went wrong!", 'error'); 
                console.log(error)
            }
    });

}

function onClickEditStudentAttendence(){
    var student_attendance_status_id =  document.getElementById('status_id').value != null ? document.getElementById('status_id').value : '0';
    var attendance_id = document.getElementById('attendance_id').value != null ? document.getElementById('attendance_id').value : '';
    var student_id = document.getElementById('student_id').value != null ? document.getElementById('student_id').value : '';
    var student_obj = [];

    student_obj = {
        'status_id' : student_attendance_status_id,
        'attendance_id' : attendance_id,
        'student_id' : student_id,
    };

    console.log(student_obj);
    $.ajax({
        url: "/studentAttendance/editStudentAttendanceStatus",
        type: "POST",
        data:{
            _token: $("input[name='_token']").val(),
            student_obj,
        },
        beforeSend: function() {
                $.notify("Requsting Server! Please wait....", 'info');  
            },
            success: function(resp) {
                swal({
                    title: 'Attendance Updated Successfully.',
                    type: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok',
                    confirmButtonClass: 'btn btn-success',
                    showLoaderOnConfirm: true,
                    reverseButtons: false
                }).then((result) => {
                    if (result.value) {
                        window.location = document.referrer;
                    }
                });

            },
            error: function(error) {
                $.notify("Something went wrong!", 'error'); 
                console.log(error)
            }
    });
}