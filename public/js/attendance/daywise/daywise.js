function getPreviousDayWiseAttendances() {

	var date_to_get = document.getElementById('date_filtered_for').value;
	document.getElementById('date_prev').disabled = true;
	date = new Date(date_to_get);
	date.setDate(date.getDate() - 1);
	document.getElementById('date_filtered_for').value = date.getFullYear() + '-' + (((date.getMonth() + 1) < 10 ? '0' : '') + (date.getMonth() + 1)) + '-' + (date.getDate() < 10 ? '0' : '') + (date.getDate());
	document.getElementById('report_loading').hidden = false;
	$("#attendances_daywise_reporting_table_body").html("");
	$.ajax({
		url: '../getEmployeeDayWiseReporting',
		dataType: "json",
		type: "get",
		data: {
			date: document.getElementById('date_filtered_for').value
		},
		success: function(data) {

			attendances = data.late_attendances;
			showData(attendances);

			document.getElementById('date_prev').disabled = false;
			document.getElementById('date_next').disabled = false;
			alertify.success("Daywise Reporting Retrieved Successfully.");
		},
		error: function(data) {
			console.log(data);
			document.getElementById('report_loading').hidden = true;
			alertify.error(data.responseJSON.error);
		}
	});

}

function getNextDayWiseAttendances() {

	var date_to_get = document.getElementById('date_filtered_for').value;
	document.getElementById('date_next').disabled = true;
	date = new Date(date_to_get);
	today = new Date();
	date.setDate(date.getDate() + 1);
	document.getElementById('date_filtered_for').value = date.getFullYear() + '-' + (((date.getMonth() + 1) < 10 ? '0' : '') + (date.getMonth() + 1)) + '-' + (date.getDate() < 10 ? '0' : '') + (date.getDate());
	document.getElementById('report_loading').hidden = false;
	$("#attendances_daywise_reporting_table_body").html("");
	$.ajax({
		url: '../getEmployeeDayWiseReporting',
		dataType: "json",
		type: "get",
		data: {
			date: document.getElementById('date_filtered_for').value
		},
		success: function(data) {
			attendances = data.late_attendances;
			showData(attendances);
			if (date.toDateString() != today.toDateString()) {
				document.getElementById('date_next').disabled = false;
			}
			alertify.success("Daywise Reporting Retrieved Successfully.");
		},
		error: function(data) {
			console.log(data);
			document.getElementById('report_loading').hidden = true;
			alertify.error(data.responseJSON.error);
		}
	});

}

function showData(attendances) {
	var add_row = '';
	$.each(attendances, function(index, value) {
		add_row += "<tr><td>" + value.date_formated + "</td>";
		add_row += "<td>" + value.emp_code + "</td>";
		add_row += "<td>" + value.name + "</td>";
		if (value.check_in_time_gmt) {
			add_row += "<td>" + value.check_in_time_gmt + "</td>";
		} else {
			add_row += "<td>---</td>";
		}
		if (value.check_out_time_gmt) {
			add_row += "<td>" + value.check_out_time_gmt + "</td>";
		} else {
			add_row += "<td>---</td>";
		}
		if (value.working_hours) {
			add_row += "<td>" + value.working_hours + "</td>";
		} else {
			add_row += "<td>---</td>";
		}
		add_row += "<td>" + value.time_slot_name + "</td>";
		add_row += "<td>" + value.status + "</td>";

		add_row += "</tr>";
	});
	$("#attendances_daywise_reporting_table_body").html(add_row);
	document.getElementById('report_loading').hidden = true;
}

function exportDayWiseReportingToExcel() {
	var table = TableExport(document.getElementById("attendances_daywise_reporting_table"), {
		headers: true, // (Boolean), display table headers (th or td elements) in the <thead>, (default: true)
		footers: false, // (Boolean), display table footers (th or td elements) in the <tfoot>, (default: false)
		formats: ['xlsx'], // (String[]), filetype(s) for the export, (default: ['xlsx', 'csv', 'txt'])
		filename: 'Late Reporting', // (id, String), filename for the downloaded file, (default: 'id')
		bootstrap: true, // (Boolean), style buttons using bootstrap, (default: true)
		exportButtons: true, // (Boolean), automatically generate the built-in export buttons for each of the specified formats (default: true)
		position: 'top', // (top, bottom), position of the caption element relative to table, (default: 'bottom')
		ignoreRows: null, // (Number, Number[]), row indices to exclude from the exported file(s) (default: null)
		ignoreCols: 1, // (Number, Number[]), column indices to exclude from the exported file(s) (default: null)
		trimWhitespace: true // (Boolean), remove all leading/trailing newlines, spaces, and tabs from cell text in the exported file(s) (default: false)
	});
	table.reset();
}