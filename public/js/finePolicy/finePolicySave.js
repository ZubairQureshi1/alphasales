$(function() {

	$('#buttonTest').click(function() {
		var fine_policies = {
			wing_id: document.getElementById('wing_id') != null ? document.getElementById('wing_id').value : '',
			absent_fine: document.getElementById('absent_fine') != null ? document.getElementById('absent_fine').value : '',
			absent_initial_fine: document.getElementById('absent_initial_fine') != null ? document.getElementById('absent_initial_fine').value : '',
			absent_maximum_fine: document.getElementById('absent_maximum_fine') != null ? document.getElementById('absent_maximum_fine').value : '',
			late_fine: document.getElementById('late_fine') != null ? document.getElementById('late_fine').value : '',
			late_initial_fine: document.getElementById('late_initial_fine') != null ? document.getElementById('late_initial_fine').value : '',
			late_maximum_fine: document.getElementById('late_maximum_fine') != null ? document.getElementById('late_maximum_fine').value : '',
			leave_quota: document.getElementById('leave_quota') != null ? document.getElementById('leave_quota').value : '',
			apply_absent: document.getElementById('apply_absent') != null ? document.getElementById('apply_absent').value : ''
		};
	
		
		fine_policies.credit_hours = [];
		if (fine_policies.wing_id != 2) {
			for (var i = 0; i < credit_hour; i++) {
				if($('#creditCourse_'+i).attr('row_status') !== 'deleted') {
					let credit_hours = {
						credit_hour: document.getElementById('credit_hour_' + i) != null ? document.getElementById('credit_hour_' + i).value : '',
						struck_off_limit: document.getElementById('struck_off_limit_' + i) != null ? document.getElementById('struck_off_limit_' + i).value : ''
					}
					fine_policies.credit_hours[i] = credit_hours;
				} 
			}
		} else {
			fine_policies.struck_off_limit = document.getElementById('struck_off_limit') != null ? document.getElementById('struck_off_limit').value : ''
		}
		$.ajax({
			url: '/studentAttendancePolicy/saveFinePolicy',
			type: 'POST',
			data: {
				_token: $("input[name='_token']").val(),
				fine_policies
			},
			beforeSend: function() {
				$.notify("Requsting Server! Please wait....", 'info');	
			},
			success: function(resp) {
                swal({
                    title: 'Fine Policy Saved Successfully!',
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
                        window.location = "/studentAttendancePolicy/index";                        
                    }
                });
            },
			error: function(error) {
				$.notify("Something went wrong!", 'error');	
				console.log(error)
			}
		})
	})
});