function getPlatformTypes() {
	var id = $(event.target).val(), field  = '';

	$('#platform').empty();
	$('#registration').empty();

	if (!id) {
		alertify.error('Please Select Valid Option.');
	} else {
		field += '<div class="form-row">';
			// check if option is cfe platform
			if (id == 0) {
				field += '<div class="form-group col-md-6">';
					field += '<label>CFE Plaform Type:</label>';
					field += '<select class="form-control" name="registration_type_id">';
						field += '<option value="" disabled selected>--- Select CFE Platform Type ---</option>';
						$.each(constants.cfe_platforms, function(index, el){
							field += '<option value="'+index+'">'+el+'</option>';
						});
					field += '</select>';
				field += '</div>'; 
			}
			field += '<div class="form-group col-md-6">';
				field += '<label>Registration Status:</label>';
				field += '<select class="form-control" name="registration_status_id" id="registration_status_id" onchange="checkForRegistrationStatus()">';
				field += '<option value="" disabled selected>--- Select Registration Status ---</option>';
				$.each(constants.registration_statuses, function(index, el){
					field += '<option value="'+index+'">'+el+'</option>';
				});
				field += '</select>';
			field += '</div>';
		field += '</div>';

		$('#platform').append(field);
	}
}


function checkForRegistrationStatus() {
	var id = $(event.target).val(), field  = '';

	$('#registration').empty();

	// check if value is 1 (registered)
	if (id == 1) {
		field += '<div class="form-row">';
			field += '<div class="form-group col-md-6">';
				field += '<label>Registration No:</label>';
				field += '<input id="registration_no" type="text" name="registration_no" class="form-control" placeholder="Please Enter Student Registration Number">';
			field += '</div>';

			field += '<div class="form-group col-md-6">';
				field += '<label>Card Received:</label>';
				field += '<select id="registration_card_received_id" class="form-control" name="registration_card_received_id">';
				field += '<option selected>--- Select Card Received Status ---</option>';
				$.each(constants.registration_card_received, function(index, el){
					field += '<option value="'+index+'">'+el+'</option>';
				});
				field += '</select>';
			field += '</div>';
		field += '</div>';
		$('#registration').append(field);
	}
}


function editRegistration() {
    // change button on selection
    $(event.target).toggleClass('active');


    $.each($('.registration_editable'), function(i, field) {
        $(field).prop('disabled') ? $(field).prop('disabled', false) : $(field).prop('disabled', true);
    });

    let editable_btn = $('.registration_editable-button');
    editable_btn.prop('hidden') ? editable_btn.prop('hidden', false) : editable_btn.prop('hidden', true);
}