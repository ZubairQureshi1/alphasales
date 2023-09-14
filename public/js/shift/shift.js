$("#is_repeat").change(function() {
    if(this.checked) {
        $('.singleShiftTimeSlot').attr('hidden', 'true');
        $('.is_repeat_section').removeAttr('hidden');
    } else {
    	$('.singleShiftTimeSlot').removeAttr('hidden');
    	$('.is_repeat_section').attr('hidden', 'hidden');
    }
});

function refreshTimeSlots(day) {
	$('#time_slot_id_'+day).html('');
	$('#time_slot_refresh_'+day).addClass("fa-spin");
	$.ajax({
		url: '/timeslots/getAJAXTimeSlot',
		type: "GET",
		success: function(data) {
			$('#time_slot_refresh_'+day).removeClass("fa-spin");
			$('#time_slot_id_'+day).append($("<option></option>").attr("value", "").text('--- Select Time Slot ---'));
			$.each(data, function(id, value) {
				$('#time_slot_id_'+day).append($("<option></option>").attr("value", id).text(value));
			});
		},
		error: function(data) {
			alertify.error('Something went wrong.');
		}
	});
}


$('#selected_days').on("select2:select", function(e) {
	document.getElementById('workingDayTimeSlots').hidden = false;
    $.ajax({
        url: "/userShifts/workingDayTimeSlots/" + e.params.data.id,
        type: "GET",
        success: function(data) {
            $('#workingDayTimeSlots').append(data);
            $('.select2').select2();
        },
        error: function(data) {
            swal.showValidationError(
                `Request failed: ${data}`
            )
            alertify.error('Something went wrong.')
        }
    });
});

$('#selected_days').on("select2:unselect", function(e) {
	if($('#workingDayTimeSlots .form-row').length < 1) {
		document.getElementById('workingDayTimeSlots').hidden = true;
	}
    $('.row-' + e.params.data.text.replace(' ', '')).html('');
});