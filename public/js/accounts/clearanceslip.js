function filterReport() {
	if (document.getElementById('session_id').value == null || document.getElementById('session_id').value == "") {
		alertify.error("Session must be selected to proceed!");
	} else if (document.getElementById('course_id').value == null || document.getElementById('course_id').value == "") {
		alertify.error("Course must be selected to proceed!");
	} else if (document.getElementById('semester_year_id').value == null || document.getElementById('semester_year_id').value == "") {
		alertify.error("Year/Semester must be selected to proceed!");
	} else {
		// document.getElementById('report_loading').hidden = false;
		$('#generate_report').addClass("fa-spin");
		$('#clearanceslip_form').submit();
		// $.ajax({
		// 	headers: {
		// 		'X-CSRF-Token': $('meta[name="_token"]').attr('content')
		// 	},
		// 	url: "/accounts/overallClearanceSlip/generate",
		// 	type: "POST",
		// 	data: {
		// 		session_id: document.getElementById('session_id').value,
		// 		course_id: document.getElementById('course_id').value,
		// 		section_id: document.getElementById('section_id').value,
		// 		student_category_id: document.getElementById('student_category_id').value,
		// 		semester_year_id: document.getElementById('semester_year_id').value,
		// 		start_month: document.getElementById('start_month').value,
		// 		end_month: document.getElementById('end_month').value,
		// 	},
		// 	success: function(data, textStatus, jqXHR) {
		// 		alertify.success(data.message);
		// 		$("#report_div").html(data.data);
		// 		if (data.data != "") {
		// 			// exportToExcel();
		// 		}
		// 		$('#generate_report').removeClass("fa-spin");
		// 		document.getElementById('report_loading').hidden = true;

		// 	},
		// 	error: function(data) {
		// 		alertify.error(data.responseJSON.error);
		// 		$('#generate_report').removeClass("fa-spin");
		// 		document.getElementById('report_loading').hidden = true;
		// 	}
		// });
	}
}

function onCourseSelect() {
	$.ajax({
		url: "/getCourseDetails",
		// dataType: "json",
		type: "POST",
		data: {
			_token: $("input[name='_token']").val(),
			id: document.getElementById('course_id').value,
		},
		success: function(data) {
			document.getElementById('report_loading').hidden = true;
			$("#section_select").html('');

			// $('#course_subjects').modal();
			if (data.sections.length == 0) {
				$("#section_select").html('');
			} else {
				var section_select = "<div><label>Sections:</label>";
				section_select += "<select id='section_id' name='section_id' class='form-control select2'>";
				section_select += "<option disabled selected hidden value>--- Select Section --- </option>";
				jQuery.each(data.sections, function(index, value) {
					section_select += "<option value='" + value.section_id + "'>" + value.section_name + "</option>";
				});
				section_select += "</select></div>";
				document.getElementById('section_select').classList.add('col-2');
				$("#section_select").html(section_select);
				$('.select2').select2();
			}

		},
		error: function(data) {
			document.getElementById('report_loading').hidden = true;
			swal.showValidationError(
				`Request failed: ${data}`
			)
			alertify.error('Something went wrong.')
		}
	});

}
/*
function exportToExcel() {
	var table = TableExport(document.getElementById('reportExport'), {
		headers: true, // (Boolean), display table headers (th or td elements) in the <thead>, (default: true)
		footers: false, // (Boolean), display table footers (th or td elements) in the <tfoot>, (default: false)
		formats: ['xlsx'], // (String[]), filetype(s) for the export, (default: ['xlsx', 'csv', 'txt'])
		filename: 'General Account Report', // (id, String), filename for the downloaded file, (default: 'id')
		bootstrap: true, // (Boolean), style buttons using bootstrap, (default: true)
		exportButtons: true, // (Boolean), automatically generate the built-in export buttons for each of the specified formats (default: true)
		position: 'top', // (top, bottom), position of the caption element relative to table, (default: 'bottom')
		ignoreRows: null, // (Number, Number[]), row indices to exclude from the exported file(s) (default: null)
		ignoreCols: null, // (Number, Number[]), column indices to exclude from the exported file(s) (default: null)
		trimWhitespace: true // (Boolean), remove all leading/trailing newlines, spaces, and tabs from cell text in the exported file(s) (default: false)
	});
	table.reset();
}*/