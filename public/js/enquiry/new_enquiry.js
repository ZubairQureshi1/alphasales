var ca_section_show;

function showCASection() {
    ca_section_show = $('#is_ca').is(':checked'); // retrieve the value
    if (ca_section_show) {
        $('#ca_section').removeAttr('hidden');
    } else {
        $('#ca_section').attr('hidden', 'hidden');
    }
}

function delete_enquiry(id) {
    swal({
        title: 'Do you want to delete this enquiry?',
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
            swal('Please wait ...', 'your request is in processing', 'info')
            $.ajax({
                url: "/enquiries/" + id + '/delete',
                // dataType: "json",
                method: "GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    swal({
                        position: 'top-end',
                        type: 'success',
                        title: 'Enquiry deleted successfully.',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(result => {
                        if (result.dismiss === swal.DismissReason.timer) {
                            window.location = '/enquiries';
                        }
                    })
                },
                error: function(data) {
                    swal('Something went wrong!', data.statusText, 'error')
                }
            });
        } else if (
            // Read more about handling dismissals
            result.dismiss === swal.DismissReason.cancel) {
            swal('Cancelled', 'Enquiry deletion cancelled successfully', 'error')
        }
    });
}

function saveEnquiry() {

    swal({
        title: 'Do you want to create this enquiry?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        cancelButtonText: 'No, cancel!',
        confirmButtonClass: 'btn btn-success',
        showLoaderOnConfirm: true,
        cancelButtonClass: 'btn btn-danger',
        reverseButtons: true
    }).then((result) => {
        swal('Please wait ...', 'your request is in processing', 'info');
        if (result.value) {
            isException = false;
            var enquiry = {};
            enquiry._token = $("input[name='_token']").val();

            student_name = document.getElementById('student_name').value;
            if (student_name == null || student_name == '') {
                $('#student_name_message').html('Student Name Required').css('color', 'red');
                isException = true;
            } else {
                enquiry.student_name = student_name;
            }
            // enquiry.old_roll_no = document.getElementById('old_roll_no').value;

            student_cnic_no = document.getElementById('student_cnic_no').value;
            if (student_cnic_no == null || student_cnic_no == '') {
                $('#student_cnic_no_message').html('Student CNIC Required').css('color', 'red');
                isException = true;
            } else {
                enquiry.student_cnic_no = student_cnic_no;
            }

            father_name = document.getElementById('father_name').value;
            if (father_name == null || father_name == '') {
                $('#father_name_message').html('Father Name Required').css('color', 'red');

                isException = true;
            } else {
                enquiry.father_name = father_name;
            }

            father_cnic_no = document.getElementById('father_cnic_no').value;
            if (father_cnic_no == null || father_cnic_no == '') {
                $('#father_cnic_no_message').html('Father CNIC Required').css('color', 'red');

                isException = true;
            } else {
                enquiry.father_cnic_no = father_cnic_no;
            }

            d_o_b = document.getElementById('d_o_b').value;
            if (d_o_b == null || d_o_b == '') {
                $('#d_o_b_message').html('Student Date of Birth Required').css('color', 'red');
                isException = true;
            } else {
                enquiry.d_o_b = d_o_b;
            }

            email = document.getElementById('email').value;
            if (email == null || email == '') {
                $('#email_message').html('Student Email Required').css('color', 'red');
                isException = true;
            } else {
                enquiry.email = email;
            }

            father_cell_no = document.getElementById('father_cell_no').value;
            if (father_cell_no == null || father_cell_no == '') {
                $('#father_cell_no_message').html('Student Cell No Required').css('color', 'red');
                isException = true;
            } else {
                enquiry.father_cell_no = father_cell_no;
            }

            student_cell_no = document.getElementById('student_cell_no').value;
            if (student_cell_no == null || student_cell_no == '') {
                $('#student_cell_no_message').html('Student Cell No Required').css('color', 'red');
                isException = true;
            } else {
                enquiry.student_cell_no = student_cell_no;
            }

            ptcl_no = document.getElementById('ptcl_no').value;
            if (ptcl_no == null || ptcl_no == '') {
                $('#ptcl_no_message').html('Ptcl No Required').css('color', 'red');
                isException = true;
            } else {
                enquiry.ptcl_no = ptcl_no;
            }

            gaurdian_name = document.getElementById('gaurdian_name').value;
            if (gaurdian_name == null || gaurdian_name == '') {
                enquiry.gaurdian_name = father_name;
                isException = false;
            } else {
                enquiry.gaurdian_name = gaurdian_name;
            }

            gaurdian_cell_no = document.getElementById('gaurdian_cell_no').value;
            if (gaurdian_cell_no == null || gaurdian_cell_no == '') {
                enquiry.gaurdian_cell_no = father_cell_no;
                isException = false;
            } else {
                enquiry.gaurdian_cell_no = gaurdian_cell_no;
            }

            gaurdian_relationship = document.getElementById('gaurdian_relationship').value;
            if (gaurdian_relationship == null || gaurdian_relationship == '') {
                enquiry.gaurdian_relationship = 'Father';
                isException = false;
            } else {
                enquiry.gaurdian_relationship = gaurdian_relationship;
            }

            present_address = document.getElementById('present_address').value;
            if (present_address == null || present_address == '') {
                $('#present_address_message').html('Present Address Required').css('color', 'red');
                isException = true;
            } else {
                enquiry.present_address = present_address;
            }

            permanent_address = document.getElementById('permanent_address').value;
            if (permanent_address == null || permanent_address == '') {
                enquiry.permanent_address = present_address;
                isException = true;
            } else {
                enquiry.permanent_address = permanent_address;
            }

            father_work_address = document.getElementById('father_work_address').value;
            if (father_work_address == null || father_work_address == '') {
                $('#father_work_address_message').html('Father Work Address Required').css('color', 'red');
                isException = true;
            } else {
                enquiry.father_work_address = father_work_address;
            }

            reference_id = document.getElementById('reference_id').value;
            if (reference_id == null || reference_id == '') {
                $('#reference_id_message').html('Reference Required').css('color', 'red');
                isException = true;
            } else {
                enquiry.reference_id = reference_id;
            }

            reference_name = document.getElementById('reference_id').options[document.getElementById('reference_id').options.selectedIndex].innerText;
            if (reference_name == null || reference_name == '') {
                $('#reference_id_message').html('Reference Required').css('color', 'red');
                isException = true;
            } else {
                enquiry.reference_name = reference_name;
            }

            course_name = selected_course;
            if (course_name == null || course_name == '') {
                $('#course_message').html('Course Required').css('color', 'red');
                isException = true;
            } else {
                enquiry.course_name = course_name;
            }

            course_id = selected_course_id;
            if (course_id == null || course_id == '') {
                $('#course_message').html('Course Required').css('color', 'red');
                isException = true;
            } else {
                enquiry.course_id = course_id;
            }

            enquiry.ca_section_show = self.ca_section_show;
            if (ca_section_show) {
                enquiry.ca_status_id = document.getElementById('ca_status').value;
                enquiry.ca_status_name = document.getElementById('ca_status').options[document.getElementById('ca_status').options.selectedIndex].innerText;
                enquiry.ca_subject = document.getElementById('ca_subject').value;
                enquiry.raet_institution = document.getElementById('raet_institution').value;
                enquiry.icap_crn = document.getElementById('icap_crn').value;
                enquiry.icap_roll_no = document.getElementById('icap_roll_no').value;
            }
            if (!isException) {

                $.ajax({
                    url: "/enquiries",
                    // dataType: "json",
                    type: "POST",
                    data: enquiry,
                    success: function(data) {
                        window.location = '/enquiries';
                    },
                    error: function(data) {
                        swal('Something went wrong!', data.statusText, 'error')
                    }
                });
            }

        } else if (
            // Read more about handling dismissals
            result.dismiss === swal.DismissReason.cancel) {
            swal('Cancelled', 'Enquiry creation cancelled successfully', 'error')
        }
    });
}