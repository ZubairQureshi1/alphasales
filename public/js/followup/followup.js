$(document).ready(function() {
	$('#answered_by_div').hide();
	$('#attendant_relationship_div').hide();
	if(document.getElementById('answered_by_div')){
		document.getElementById('answered_by_div').required = false;
		document.getElementById('attendant_relationship').required = false;
	}
});


function validateFollowupDate() {
	if (document.getElementById('enquiry_date').value != "") {
		var next_followup_date = new Date(document.getElementById('next_date').value);
		var enquiry_date = new Date(document.getElementById('enquiry_date').value);
		if (next_followup_date < enquiry_date) {
			alertify.error('Followup date cannot be less than enquiry date.');
			document.getElementById('next_date').valueAsDate = null;
		}
	} else {
		alertify.error('Select enquiry date first.');
		document.getElementById('next_date').valueAsDate = null;
		document.getElementById('enquiry_date').focus();
	}
}

function onCallStatusSelect() {
	call_status_id = document.getElementById('call_status_id').value;
	let answeredOps = [
						'Follow Up Required',
						'Dropped',
						'Sales Matured',
						'Call Disconnected',
						'Wrong No.',
						];
	if (call_status_id == "Answered" || call_status_id == "Will Call Back") {
		$('#followup_statuses').html($('<option></option>').val('').html('--- Select Status ---'));
		$.each(constants.followup_statuses, function(index, value) {
            // console.log(index);
			if (answeredOps.includes(index)) {
				$('#followup_statuses').append($('<option></option>').val(index).html(value));
			}
		});
	}
	let nansweredOps = [
						'Follow Up Required',
						'Dropped',
						'Phone Not Picked',
						'Cell Off',
												];
	if (call_status_id == "Not Answered") {
		$('#followup_statuses').html($('<option></option>').val('').html('--- Select Status ---'));
		$.each(constants.followup_statuses, function(index, value) {
            console.log(index);
			if (nansweredOps.includes(index)) {
				$('#followup_statuses').append($('<option></option>').val(index).html(value));
			}
		});
	}

}

function onFollowupStatusSelect(prospect_id = null) {
	if (prospect_id == null) {
		selected_status_id = document.getElementById('followup_statuses').value;
        console.log(selected_status_id);
        if(selected_status_id=='Dropped' || selected_status_id=='Sales Matured'){
            $('#save_button').show();
            console.log($('#save_button'));
            
            $('#revised_price_con').hide();
        }else{
        	$('#revised_price_con').show();
            $('#save_button').hide();
        }
		if (selected_status_id == "Follow Up Required") {
			$('#answered_by_div').hide();
			$('#attendant_relationship_div').hide();

			document.getElementById('next_date').hidden = false;
			document.getElementById('followup_date_div').hidden = false;

			document.getElementById('followup_interested_level_div').hidden = false;

			// document.getElementById('followup_interested_level_div').required = false;
			// document.getElementById('answered_by_div').required = false;
			// document.getElementById('attendant_relationship').required = false;
			// document.getElementById('next_date').required = true;

		} else if (selected_status_id == 1) {
			document.getElementById('next_date').hidden = false;
			document.getElementById('followup_date_div').hidden = false;
			document.getElementById('followup_interested_level_div').hidden = false;


			document.getElementById('next_date').required = true;
			document.getElementById('followup_interested_level_div').required = true;


			$('#attendant_relationship_div').show();
			$('#answered_by_div').show();
			document.getElementById('answered_by_div').required = true;
			document.getElementById('attendant_relationship').required = true;

		} else if (selected_status_id == 3) {
			document.getElementById('next_date').hidden = true;
			document.getElementById('followup_date_div').hidden = true;
			document.getElementById('followup_interested_level_div').hidden = true;


			document.getElementById('next_date').required = false;
			document.getElementById('followup_interested_level_div').required = false;


			$('#attendant_relationship_div').show();
			$('#answered_by_div').show();
			document.getElementById('answered_by_div').required = true;
			document.getElementById('attendant_relationship').required = true;

		} else if (selected_status_id == 2) {
			document.getElementById('next_date').hidden = true;
			document.getElementById('followup_date_div').hidden = true;
			document.getElementById('followup_interested_level_div').hidden = true;


			document.getElementById('next_date').required = false;
			document.getElementById('followup_interested_level_div').required = false;


			$('#attendant_relationship_div').show();
			$('#answered_by_div').show();
			document.getElementById('answered_by_div').required = true;
			document.getElementById('attendant_relationship').required = true;

		} else {
			document.getElementById('next_date').hidden = true;
			document.getElementById('followup_date_div').hidden = true;
			document.getElementById('followup_interested_level_div').hidden = true;


			document.getElementById('next_date').required = false;
			document.getElementById('followup_interested_level_div').required = false;


			$('#attendant_relationship_div').hide();
			$('#answered_by_div').hide();

			if(document.getElementById('answered_by_div')){

				document.getElementById('answered_by_div').required = false;
				document.getElementById('attendant_relationship').required = false;
			}

		}
	} else {
		selected_status_id = document.getElementById('followup_statuses' + prospect_id).value;
		if (selected_status_id > 3) {
			$('#answered_by_div' + prospect_id).hide();
			$('#attendant_relationship_div' + prospect_id).hide();
			document.getElementById('answered_by_div' + prospect_id).required = false;
			document.getElementById('attendant_relationship' + prospect_id).required = false;
		} else {
			$('#attendant_relationship_div' + prospect_id).show();
			$('#answered_by_div' + prospect_id).show();
			document.getElementById('answered_by_div' + prospect_id).required = true;
			document.getElementById('attendant_relationship' + prospect_id).required = true;
		}
		if (selected_status_id == 0) {
			document.getElementById('next_date' + prospect_id).hidden = true;
			document.getElementById('followup_date_div' + prospect_id).hidden = true;
			document.getElementById('followup_interested_level_div' + prospect_id).hidden = true;

			document.getElementById('next_date' + prospect_id).required = false;
			document.getElementById('followup_interested_level_div' + prospect_id).required = false;

		} else if (selected_status_id == 1) {
			document.getElementById('next_date' + prospect_id).hidden = false;
			document.getElementById('followup_date_div' + prospect_id).hidden = false;
			document.getElementById('followup_interested_level_div' + prospect_id).hidden = false;


			document.getElementById('next_date' + prospect_id).required = true;
			document.getElementById('followup_interested_level_div' + prospect_id).required = true;

		} else if (selected_status_id == 3) {
			document.getElementById('next_date' + prospect_id).hidden = true;
			document.getElementById('followup_date_div' + prospect_id).hidden = true;
			document.getElementById('followup_interested_level_div' + prospect_id).hidden = true;


			document.getElementById('next_date' + prospect_id).required = false;
			document.getElementById('followup_interested_level_div' + prospect_id).required = false;

		} else {
			document.getElementById('followup_interested_level_div' + prospect_id).hidden = true;


			document.getElementById('followup_interested_level_div' + prospect_id).required = false;

		}
	}
}
