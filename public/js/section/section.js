var cs_section_row_count = 1;

function onWingSelect(){
    document.getElementById('report_loading').hidden = false;
    select_wing_id = document.getElementById('wing_id').value;
    // Clearout related data
    cs_section_row_count = 1
    $('#section_details').empty();
    $('#affiliated_body_id').empty();
    $('#term_id').empty();
    $('#totalStudents').text('0');
    if (select_wing_id != 2) {
        document.getElementById('gender_id_div').hidden = true;
    } else {
        document.getElementById('gender_id_div').hidden = false;
    }
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
                $('#course_id').empty();                
                $('#course_id').append($('<option selected disabled></option>').attr('value', '').text('---Select Course---'));
                jQuery.each(data, function(index, value) {
                    $('#course_id').append($('<option></option>').attr('value', index).text(value));
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
    select_wing_id = document.getElementById('wing_id').value;
    select_course_id = document.getElementById('course_id').value;
    // Clearout previos results
    cs_section_row_count = 1
    $('#section_details').empty();
    $('#affiliated_body_id').empty();
    $('#totalStudents').text('0');
    $('#term_id').empty();
    if(select_course_id && select_wing_id){
        $.ajax({
            url: "/sections/getAffiliatedBodiesByCourse/"+select_course_id+'/'+select_wing_id,
            type: "POST",
            data: {
                _token: $("input[name='_token']").val(),
            },
            success: function(data) {
                document.getElementById('report_loading').hidden = true;
                $('#affiliated_body_id').empty();
                $('#affiliated_body_id').append($('<option></option>').attr('value', '').text('--- Select Affiliated Body ---'));
                jQuery.each(data, function(index, value) {
                    $('#affiliated_body_id').append($('<option></option>').attr('value', value.affiliated_body_id).text(value.affiliated_body_name));
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
    affiliated_body_id = document.getElementById('affiliated_body_id').value;
    select_wing_id = document.getElementById('wing_id').value;
    select_course_id = document.getElementById('course_id').value;
    // Clearout previos results
    cs_section_row_count = 1
    $('#section_details').empty();
    $('#term_id').empty();
    $('#totalStudents').text('0');
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
                $('#term_id').empty();
                $('#term_id').append($('<option selected disabled></option>').attr('value', '').text('---Select Term---'));
                jQuery.each(data, function(index, value) {
                    $('#term_id').append($('<option></option>').attr('value', value).text(value));
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

function onTermSelect() {
    // Clearout previos results
    cs_section_row_count = 1
    $('#totalStudents').text('0');
    $('#section_details').empty();
}

var totalStudentCount = 0;

function checkForStudentCount() {
    $.ajax({
        url: "/sections/getTotalStudentsAccordingToCourse",
        type: "POST",
        data: {
            _token: $("input[name='_token']").val(),
            params: {
                course_id: $('#course_id').val(),
                affiliated_body_id: $('#affiliated_body_id').val(),
                term_id: $('#term_id').val(),
                shift_id: $('#shift_id').val(),
                gender_id: $('#wing_id').val() != 2 ? 4 : $('#gender_id').val(),
            }
        },
        beforeSend: function() {
            $.notify('Fetching students. Please Wait', 'message');
        },
        success: function(data) {
            $('#totalStudents').text(data.count);
            totalStudentCount = data.count;
            if (data.count <= 0) {
                swal({
                    title: 'No student found against these filters.',
                    type: 'warning',
                    showCancelButton: false,
                    confirmButtonColor: '#c0392b',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok',
                    confirmButtonClass: 'btn btn-success',
                    showLoaderOnConfirm: false,
                    reverseButtons: false
                });
            } else {
                $.notify(data.count + ' Students found.', 'info');
            }
        },
        error: function(data) {
            $('#totalStudents').text('0');          
            alertify.error('Something went wrong.');  
        }
    });
}

function addNewSectionRow() {
    var form_validated = true;
    var wing_id = document.getElementById('wing_id').value;
    var course_id = document.getElementById('course_id').value;
    var term_id = document.getElementById('term_id').value;
    var fields = document.getElementsByClassName('header-required');
    var message = "Please Fill out these fields in order to add new section."
    $.each(fields, function(i, field) {
        if (!field.hidden && !field.value && !field.parentElement.hidden) {
            message += "\r\n" + field.attributes.errorlabel.value;
            form_validated = false;
        }
    });
    if (!form_validated) {
        $.notify(message, "error");
    } else {
        $.ajax({
            url: `/sections/addCsSectionRow`,
            type: 'POST',
            data: {
                _token: $("input[name='_token']").val(),
                count: cs_section_row_count,
                wing_id: wing_id,
                term_id: term_id,
                shift_id: document.getElementById('shift_id').value,
                gender_id: wing_id != 2 ? 4 : $('#gender_id').val(),
                course_id: document.getElementById('course_id').value,
                affiliated_body_id: document.getElementById('affiliated_body_id').value,
                type: 'create'
            },
            beforeSend: function() {
                $.notify(`Checking Please Wait`, "info");
            },
            success: function(data) {
                if (!data.success) {
                    swal({
                        title: data.message,
                        type: 'warning',
                        showCancelButton: false,
                        confirmButtonColor: '#c0392b',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok',
                        confirmButtonClass: 'btn btn-success',
                        showLoaderOnConfirm: false,
                        reverseButtons: false
                    });
                } else {
                    if (data.subjects > 0) {
                        $.notify(`Section Row Added`, "success");
                        $('#section_details').append(data.form);
                        $('.select2').select2();
                        // scroll to that div
                        $('html, body').animate({
                            scrollTop: $('#sectionDiv_'+cs_section_row_count).offset().top
                        }, 1000);
                        // NOTE: increment section count
                        cs_section_row_count++;
                        
                    } else {
                        $.notify(`No Subjects Available!`, "error");
                    }
                }
            },
            error: function(error) {
                alertify.error('Something went wrong.');
            }
        });
    }
}

function deleteSectionRow(count) {
    if(!$('#sectionDiv_'+count).prop('hidden')) {
        $('#sectionDiv_'+count).attr('row-status', 'deleted');
        $('#sectionDiv_'+count+' :input').removeClass('item-required');
        document.getElementById('sectionDiv_'+count).hidden = true;
        $.notify('Section row deleted successfully!', 'message');
    }
}

function saveSection(result = null) {
    var section_obj = [];
    section_obj = {
        result: result,
        wing_id: document.getElementById('wing_id').value != null ? document.getElementById('wing_id').value : '',
        course_id: document.getElementById('course_id').value != null ? document.getElementById('course_id').value : '',
        term_id: document.getElementById('term_id').value != null ? document.getElementById('term_id').value : '',
        affiliated_body_id: document.getElementById('affiliated_body_id').value != null ? document.getElementById('affiliated_body_id').value : '',
        shift_id: document.getElementById('shift_id').value != null ? document.getElementById('shift_id').value : '',
        gender_id: document.getElementById('gender_id').value != null ? document.getElementById('gender_id').value : '',
        status_id: document.getElementById('status_id').value != null ? document.getElementById('status_id').value : '',
        student_strength: totalStudentCount
    }
    count_subjects = document.getElementById('count_subjects').value != null ? document.getElementById('count_subjects').value : '';
    //NOTE: CREATE FORM DETAILS OBJECT
    section_obj.sectionDetails = []
    for (var i = 1; i < cs_section_row_count; i++) {
        if ($('#sectionDiv_' + i).attr('row-status') !== 'deleted') {
            section = {};
            section.name = document.getElementById(`section_name_${i}`).value != null ? document.getElementById(`section_name_${i}`).value : '';
            section.code = document.getElementById(`section_code_${i}`).value != null ? document.getElementById(`section_code_${i}`).value : '';
            section.strength = document.getElementById(`section_strength_${i}`).value != null ? document.getElementById(`section_strength_${i}`).value : '';
            // fetching section values
            section.subjectDetails = [];
            for (var j = 0; j < count_subjects; j++) {
                subjectDetails = {
                    subject: document.getElementById(`subject_${i}_${j}`).value != null ? document.getElementById(`subject_${i}_${j}`).value : '',
                    teacher: document.getElementById(`teacher_${i}_${j}`).value != null ? document.getElementById(`teacher_${i}_${j}`).value : ''
                };
                // NOTE: only when wing is not for CS 
                if(section_obj.wing_id != 2) {
                    subjectDetails.teacher_helpers = $(`#helper_teachers_${i}_${j}`).val() != null ? $(`#helper_teachers_${i}_${j}`).val() : ''
                }
                section.subjectDetails[j] = subjectDetails;
            }
            section_obj.sectionDetails[i] = section;
        }
    }

    // Send ajax request
    swal({
        title: $("#course_id option:selected").text()+' Course Section',
        text: 'Are you sure to save this section information?',
        type: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        confirmButtonClass: 'btn btn-success',
        showLoaderOnConfirm: true,
        reverseButtons: false
    })
    // Consent Action
    .then((result) => {
        if (result.value) {
            $.ajax({
                url: '/sections/storeSectionDetails',
                type: 'POST',
                data: {
                    _token: $("input[name='_token']").val(),
                    data: section_obj
                },
                beforeSend: function() {
                    $.notify('Saving Section Details, Please Wait.','message')
                }, 
                success: function(data) {
                    if (data.success) {
                        swal({
                            title: data.title,
                            type: data.type,
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes',
                            confirmButtonClass: 'btn btn-success',
                            showLoaderOnConfirm: true,
                            reverseButtons: false
                        }).then((result) => {
                            if (result.value) {
                                window.location=document.referrer;
                            }
                        });
                    } else {
                        swal({
                            title: data.title,
                            html: data.message,
                            type: data.type,
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: data.result ? data.result : 'OK',
                            confirmButtonClass: 'btn btn-success',
                        })
                        .then((result) => {
                            if (data.result == 'Bypass') {
                                saveSection(data.result);
                            }
                        });
                    }
                },
                error: function(error) {
                   swal('Something went wrong!', JSON.parse(error.responseText).error, 'error');
                }
            })
        } else {
            $.notify('Processing stopped successfully.', 'message');
        }
    });
}