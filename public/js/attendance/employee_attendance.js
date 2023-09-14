var add_row;

function exportOverallReportingToExcel(module_name) {
    // var table = TableExport(document.getElementById("reporting_table"));
    // var exportData = table.getExportData();
    // var blob = new Blob([JSON.stringify(exportData.reporting_table.xlsx.data)], {
    //     type: "application/vnd.ms-excel"
    // });
    // saveAs(blob, "Reportings.xls");
    var table = TableExport(document.getElementById(module_name), {
        headers: true, // (Boolean), display table headers (th or td elements) in the <thead>, (default: true)
        theadSelector: 'tr',
        footers: false, // (Boolean), display table footers (th or td elements) in the <tfoot>, (default: false)
        formats: ['xls', 'xlsx'], // (String[]), filetype(s) for the export, (default: ['xlsx', 'csv', 'txt'])
        filename: 'Overall Attendnace Report', // (id, String), filename for the downloaded file, (default: 'id')
        bootstrap: true, // (Boolean), style buttons using bootstrap, (default: true)
        exportButtons: true, // (Boolean), automatically generate the built-in export buttons for each of the specified formats (default: true)
        position: 'top', // (top, bottom), position of the caption element relative to table, (default: 'bottom')
        ignoreRows: null, // (Number, Number[]), row indices to exclude from the exported file(s) (default: null)
        ignoreCols: [2, 3], // (Number, Number[]), column indices to exclude from the exported file(s) (default: null)
        trimWhitespace: true // (Boolean), remove all leading/trailing newlines, spaces, and tabs from cell text in the exported file(s) (default: false)
    });
    table.reset();

    // window.location = route;
}

var day_names = [
    'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'
];
var month_names = [
    'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
];
var date_formats = [{
    'default': 'ddd mmm dd yyyy HH:MM:ss'
	}, {
	    'shortDate': 'm/d/yy'
	}, {
	    'mediumDate': 'mmm d, yyyy'
	}, {
	    'longDate': 'mmmm d, yyyy'
	}, {
	    'month_year': 'mmmm yyyy'
	}, {
	    'fullDate': 'dddd, mmmm d, yyyy'
	}, {
	    'shortTime': 'h:MM TT'
	}, {
	    'mediumTime': 'h:MM:ss TT'
	}, {
	    'longTime': 'h:MM:ss TT Z'
	}, {
	    'isoDate': 'yyyy-mm-dd'
	}, {
	    'isoTime': 'HH:MM:ss'
	}, {
	    'isoDateTime': 'yyyy-mm-dd\'T\'HH:MM:sso'
	}, {
	    'isoUtcDateTime': 'UTC:yyyy-mm-dd\'T\'HH:MM:ss\'Z\''
	}, {
	    'expiresHeaderFormat': 'ddd, dd mmm yyyy HH:MM:ss Z'
	}, ];


function onAttendanceReportSelect() {
	var type_id = document.getElementById('report_type_id').value
	// check for type
	if (type_id == 0) {
		document.getElementById('user_div_id').hidden = true;
		document.getElementById('department_div_id').hidden = false;
	} else if (type_id == 1) { 
		document.getElementById('user_div_id').hidden = false;
		document.getElementById('department_div_id').hidden = true;
	}
}

function getEmployeeFilteredData() {
	event.preventDefault();
	document.getElementById('report_loading').hidden = false;
	var params = {
		report_type_id: document.getElementById('report_type_id').value,
		user_id: document.getElementById('user_id') != null ? document.getElementById('user_id').value : '',
		department_id: document.getElementById('department_id') != null  ? document.getElementById('department_id').value : '',
		start_date: document.getElementById('start_date').value,
		end_date: document.getElementById('end_date').value
	};

    add_row = '';
	// ajax
	$.ajax({
		url: '/attendance/getEmployeeFilteredData',
		type: 'POST',
		data: {
			_token: $("input[name='_token']").val(),
			params
		},
		success: function(data) {
			document.getElementById('report_loading').hidden = true;
			// NOTE: check if user count is 1
			if (data.data.user.length == 1 && data.data.module_name == 'employee_attendances') {
				document.getElementById('emp_attendance_export').hidden = false;
	            var querry_string = 'start_date=' + document.getElementById('start_date').value + '&' + 'end_date=' + document.getElementById('end_date').value;
	            document.getElementById('emp_attendance_export').href = '../employeeAttendances/exportExcel/' + data.data.user[0].id + '?' + querry_string;
                jQuery.each(data.data.user, function(index, user) {
                    jQuery.each(user.attendances, function(index, attendance) {
                        populateSingleEmployeeAttendanceData(attendance, user);
                    });
                });
            } else if (data.data.module_name == 'department_attendances') {
            	document.getElementById('emp_attendance_export').hidden = true;
                $("#overall_attendances_reporting_body").empty();
                jQuery.each(data.data.user, function(index, user) {
                    populateOverAllEmployeeAttendanceData(user.attendances, user);
                });
            } else {
            	document.getElementById('emp_attendance_export').hidden = true;
                $("#overall_attendances_reporting_body").empty();
                jQuery.each(data.data.user, function(index, user) {
                    populateOverAllEmployeeAttendanceData(user.attendances, user);
                });
            }

            // Populate Date
            if (data.data.user.length == 1 && data.data.module_name == 'employee_attendances') {
                document.getElementById("single_emp_attendances_reporting_table").hidden = false;
                document.getElementById("overall_attendances_reporting_table").hidden = true;
                $("#single_emp_attendances_reporting_body").html(add_row);
            } else {
                document.getElementById("single_emp_attendances_reporting_table").hidden = true;
                document.getElementById("overall_attendances_reporting_table").hidden = false;
                $("#overall_attendances_reporting_body").html(add_row);
                exportOverallReportingToExcel("overall_attendances_reporting_body" /*data.data.module_name*/ );
            }
            alertify.success("Request Completed Successfully.");

		}, error: function(error) {
            document.getElementById('report_loading').hidden = true;
			alertify.error(error.statusText);
			console.log(error)
		}
	})

}

function populateSingleEmployeeAttendanceData(attendance, user) {
    if (document.getElementById('start_date').value != '') {
        attendance_date = new Date(attendance.date);
        start_date = new Date(document.getElementById('start_date').value);
        end_date = new Date(document.getElementById('end_date').value);

        add_row += "<tr>";
        add_row += "<td>" + attendance.date_formated + "</td>";
        add_row += "<td>" + user.emp_code + "</td>";
        add_row += "<td>" + user.display_name + "</td>";
        add_row += "<td>" + user.job_title + "</td>";
        if (user.mobile_no != null && user.mobile_no != '') {
            add_row += "<td>" + user.mobile_no + "</td>";
        } else {
            add_row += "<td>" + "---" + "</td>";
        }
        if (attendance.check_in_time_gmt != null && attendance.check_in_time_gmt != '') {
            // add_row += "<td>" + attendance.check_in_time_gmt + "</td>";
            add_row += "<td>";
            add_row += '<input class="form-control input-date-time" type="datetime" id="check_in_time_gmt_' + attendance.id + '" value="' + attendance.check_in_time_gmt + '"/>';
            add_row += "</td>";
        } else {
            add_row += "<td>" + "---" + "</td>";
        }
        if (attendance.check_out_time_gmt != null && attendance.check_out_time_gmt != '') {
            // add_row += "<td>" + attendance.check_out_time_gmt + "</td>";
            add_row += "<td>";
            add_row += '<input class="form-control input-date-time" type="datetime" id="check_out_time_gmt_' + attendance.id + '" value="' + attendance.check_out_time_gmt + '"/>';
            add_row += "</td>";
        } else {
            add_row += "<td>" + "---" + "</td>";
        }

        if (attendance.working_hours != null && attendance.working_hours != '') {
            add_row += "<td>" + attendance.working_hours + "</td>";
        } else {
            add_row += "<td>" + "---" + "</td>";
        }
        if (attendance.time_slot_name != null && attendance.time_slot_name != '') {
            add_row += "<td>" + attendance.time_slot_name + "</td>";
        } else {
            add_row += "<td>" + "---" + "</td>";
        }
        add_row += `<td class="text-center table-${attendance.status_id == 0 ? 'danger' : (attendance.status_id == 1 ? 'success' : (attendance.status_id == 2 ? 'info' : (attendance.status_id == 3 ? 'info' : (attendance.status_id == 4 ? 'danger' : (attendance.status_id == 5 ? 'success' : (attendance.status_id == 6 ? 'warning' : 'primary' ))))))  }" >${attendance.status}</td>`;
        add_row += "</tr>"
    }
}

function populateOverAllEmployeeAttendanceData(attendances, user) {
    groupKey = 0;
    if (attendances) {
        groups = attendances.reduce(function(date_grouped, attendance) {
            var attendance_date = attendance.date;
            var parts1 = attendance_date.split("-");
            attendance_date = new Date(parts1[0], parts1[1] - 1, parts1[2]);
            var m = month_names[attendance_date.getMonth()];
            (date_grouped[m]) ? date_grouped[m].data.push(attendance) : date_grouped[m] = {
                group: String(groupKey++),
                data: [attendance]
            };
            return date_grouped;
        }, {});

        console.log(user)

        $.each(groups, function(index, object) {
            add_row += "<tr><td>" + index + "</td>";
            add_row += "<td>" + user.display_name + "</td>";
            add_row += "<td>" + user.emp_code + "</td>";
            add_row += "<td>" + user.job_title + "</td>";
            add_row += "<td>" + user.selected_department + "</td>";
            if (user.mobile_no != null && user.mobile_no != '') {
                add_row += "<td>" + user.mobile_no + "</td>";
            } else {
                add_row += "<td>" + "---" + "</td>";
            }
            add_row += "<td><div class='form-group row'>";
            add_row += "<div class='col-sm-12'>";
            jQuery.each(object.data, function(index, object_data) {
                if (object_data.status_id == 0) {
                    date_obj = new Date(object_data.date);
                    add_row += `${date_obj.getDate().toString()} | `;
                }
            });
            add_row += "</div></div></td>";
            add_row += "<td>" + user.late_arrivals + "</td>";
            add_row += "<td>" + user.absents + "</td>";
            add_row += "<td>" + user.missing_checkouts + "</td>";
            add_row += "</tr>";
        });
    }
}


function usersCheckForLogs() {
	$('#users').prop('disabled', $(event.target).prop('checked'));
	$('#users').val([]).change();
	document.getElementById('report_loading').hidden = true;
}

