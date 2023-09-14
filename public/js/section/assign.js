function onWingSelect(){
    document.getElementById('report_loading').hidden = false;
    select_wing_id = document.getElementById('wing_id').value;
    if(select_wing_id){
        // check for gender
        if (select_wing_id != 2) {
            document.getElementById('gender_id_div').hidden = true;
        } else {
            document.getElementById('gender_id_div').hidden = false;
        }
        // send ajax call
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
                $('#affiliated_body_id').empty();
                $('#course_id').append($('<option selected disabled></option>').attr('value', '').text('---Select Course ---'));
                jQuery.each(data, function(index, value) {
                    $('#course_id').append($('<option></option>').attr('value', index).text(value));
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

function onSeclectCourse(){
    document.getElementById('report_loading').hidden = false;
    select_course_id = document.getElementById('course_id').value;
    select_wing_id = document.getElementById('wing_id').value;
    if(select_course_id){
        $.ajax({
            url: "/sections/getAffiliatedBodiesByCourse/"+select_course_id+"/"+select_wing_id,
            type: "POST",
            data: {
                _token: $("input[name='_token']").val(),
            },
            success: function(data) {
                document.getElementById('report_loading').hidden = true;
                $('#affiliated_body_id').empty();
                $('#affiliated_body_id').append($('<option selected disabled></option>').attr('value', '').text('---Select Affiliated Body---'));
                jQuery.each(data, function(index, value) {
                    $('#affiliated_body_id').append($('<option></option>').attr('value', value.affiliated_body_id).text(value.affiliated_body_name))
                })
            },
            error: function(data) {
                alert('error');
            }
        });
    }
}


function onAffiliatedBodySelect() {
    document.getElementById('report_loading').hidden = false;
    select_wing_id = document.getElementById('wing_id').value;
    select_course_id = document.getElementById('course_id').value;
    // $('#section_details').empty();
    $('#term_id').empty();
    // ajax
    if(select_course_id && select_wing_id){
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


function checkForStudentCount() {
    $.ajax({
        url: "/sections/getTotalStudent",
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
            $('#alloted_students_list').empty();
            if (data.count > 0) {
                $('#alloted_students_list').html(data.view);
            }
            $('#datatable').DataTable({
                buttons: [
                    'copy', 'excel', 'pdf'
                ]
            });
            $.notify(data.count + ' Students found.', 'info');
        },
        error: function(data) {
            $('#totalStudents').text('0');          
            alertify.error('Something went wrong.');  
        }
    });
}

function assignSectionToStudents() {
    params = {
        wing_id: $('#wing_id').val(),
        course_id: $('#course_id').val(),
        affiliated_body_id: $('#affiliated_body_id').val(),
        term_id: $('#term_id').val(),
        shift_id: $('#shift_id').val(),
        gender_id: $('#wing_id').val() != 2 ? 4 : $('#gender_id').val(),
    }       

    // Send ajax request
    swal({
        title: 'Are you sure to assign this section?',
        type: 'info',
        showCancelButton: true,
        confirmButtonColor: '#2ecc71',
        cancelButtonColor: '#34495e',
        confirmButtonText: 'Assign Section',
        confirmButtonClass: 'btn btn-success',
        showLoaderOnConfirm: true,
        reverseButtons: false
    })// Consent Action
    .then((result) => {
        if (result.value) {
             $.ajax({
                url: '/sections/assignSectionToStudents',
                type: 'POST',
                data: {
                    _token: $("input[name='_token']").val(),
                    params: params
                },
                beforeSend: function() {
                    $.notify('Please wait checking.', 'message');
                },
                success: function(data) {
                    if (data.success) {
                        swal({
                            title: data.message,
                            type: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes',
                            confirmButtonClass: 'btn btn-success',
                            showLoaderOnConfirm: true,
                            reverseButtons: false
                        }).then((result) => {
                            if (result.value) {
                                window.location = document.referrer;
                            }
                        });
                    } else {
                        swal({
                            title: data.message,
                            type: 'warning',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes',
                            confirmButtonClass: 'btn btn-success',
                            showLoaderOnConfirm: true,
                            reverseButtons: false
                        });
                    } 
                },
                error: function(error) {
                    alertify.error('Something went wrong.')
                }
            })
        } else {
            $.notify('Processing stopped successfully.', 'message');
        }
    });

    
}


