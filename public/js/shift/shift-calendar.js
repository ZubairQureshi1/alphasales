var calendar = $('#calendar').fullCalendar({
	lazyFetching: true,
	defaultView: 'timelineMonth',
	slotWidth: 200,
	height: 750,
	header: {
		left: 'prev,next',
		center: 'title',
		right: ''
	},
	resourceAreaWidth: 200,
	refetchResourcesOnNavigate: false,
	resourceLabelText: 'Employees',
	resources: function(callback) {
        $.ajax({
            url: '/userShifts/getCalendarData',
            type: 'GET',
            dataType: 'json',
            success: function(resp) {
                var users = [];
                if(!!resp.users){
                    $.map(resp.users, function(r) {
                        users.push({
                            id: r.id,
                            title: r.display_name
                        });
                    });
	                callback(users);
                }
            }
        });
    },
	eventClick: function(eventObj) {
		console.log(eventObj);
		$.alert({
			title: 'Delete Shift',
			content: 'Are you sure to delete ' + eventObj.title + ' Dated: <b>' + eventObj.date_format + '</b>' + ' for <b>User - ' + eventObj.user_name + '</b>?',
			type: 'red',
			typeAnimated: true,
			buttons: {
				confirm: {
					text: 'Delete',
					btnClass: 'btn-danger',
					keys: ['enter'],
					action: function() {
						$.ajax({
							url: "/deleteShift/" + eventObj.shift_id + '/delete',
							// dataType: "json",
							method: "GET",
							headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
							success: function(data) {
								$.alert({
									title: 'Success',
									content: 'Shift Deleted For User - ' + eventObj.user_name + ' On ' + eventObj.date_format,
									type: 'green',
									typeAnimated: true,
									buttons: {
										confirm: {
											text: 'Finish',
											btnClass: 'btn-secondary',
											action: function() {
												window.location = '/userShifts';
											}
										}
									}
								});
							},
							error: function(data) {
								swal('Something went wrong!', data.statusText, 'error')
							}
						});
					}
				},
				cancel: function() {}
			}
		});
	},
	events: function(start, end, timezone, callback) {
        jQuery.ajax({
            url: '/userShifts/getCalendarData',
            type: 'GET',
            dataType: 'json',
            // cache: true,
            beforeSend: function() {
	            $('#calendarLoading').show();
            },
            success: function(resp) {
	            $('#calendarLoading').hide();
                callback(resp.roster);
            }
        });
    }
});


