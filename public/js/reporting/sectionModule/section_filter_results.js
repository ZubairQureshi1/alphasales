function onWingSelect(){
    document.getElementById('report_loading').hidden = false;
    select_wing_id = document.getElementById('wing_id').value;
    $('#section_details').empty();
    $('#affiliated_body_id').empty();
    $('#section_reporting_details').empty();
    $('#term_id').empty();
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
    $('#section_details').empty();
    $('#affiliated_body_id').empty();
    $('#section_reporting_details').empty();
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
    $('#section_reporting_details').empty();
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
    $('#section_reporting_details').empty();
}

//////////////////////
// FILTER VALIDATOR //
//////////////////////
function validateForm(type) {
    var form_validated = true;
    var fields = document.getElementsByClassName('item-required');
    var message = "Section data cannot retrieved without these missing fields:"
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
        getSectionDetails(type);
    }
}




function getSectionDetails(type) {
    document.getElementById('report_loading').hidden = false;
    var params = {
        wing_id: document.getElementById('wing_id').value,
        course_id: document.getElementById('course_id').value,
        affiliated_body_id: document.getElementById('affiliated_body_id').value,
        term_id: document.getElementById('term_id').value,
        shift_id: document.getElementById('shift_id').value,
        gender_id:  $('#wing_id').val() != 2 ? 4 : $('#gender_id').val(),
        type: type
    }
    // send ajax request
    $.ajax({
        url: '/reporting/sections/getSectionDetails',
        type: 'POST',
        data: {
            _token: $("input[name='_token']").val(),
            params
        },
        beforeSend: function() {
            $.notify('Checking system data, Please wait!', 'message')
        }, 
        success: function(data) {
            document.getElementById('report_loading').hidden = true;
            if (data.success) {
                $('#section_reporting_details').html(data.view);
                $('#dataTable').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        {
                            extend: 'colvis',
                            className: 'btn-success',
                            text: '<i class="fa fa-eye fa-fw"></i> Column Visibility',
                        },
                        {
                            extend: 'excel',
                            text: '<i class="fa fa-file-excel-o fa-fw"></i> Export to Excel',
                            title: new Date().toLocaleString()+'-Student-Section-Excel-Export',
                            exportOptions: { orthogonal: 'export' },
                            messageTop: 'This is a system generated export of section report generated at '+ new Date().toLocaleString(),
                            className: 'btn-success'
                        }
                    ]
                });;
            } else {
                swal({
                    title: data.message,
                    type: data.type,
                    confirmButtonText: 'Ok',
                    confirmButtonClass: 'btn btn-primary',
                    allowOutsideClick: false,
                });
            }
        }, 
        error: function(eror) {
            alertify.error('Something went wrong.')
        }
    });
    


}