var Global_count = count;

function onAddSessionDetails(count = Global_count) {
	if (Global_count == 0 && count != 0) {
		Global_count = count;
		count = Global_count;
		Global_count++;
	} else {
		Global_count++;
		count++;
	}

	$.ajax({
		url: "/session/getSessionDetails/?row_count=" + count,
		// dataType: "json",
		type: "GET",
		success: function(data) {
			$('#session_detail').append(data);
		},
		error: function(data) {
			count--;
			swal.showValidationError(
				`Request failed: ${data}`
			)
			alertify.error('Something went wrong.')
		}
	});

}
function onCourseSelect(row_count) {
	if (document.getElementById('courseName' + row_count).value != "" && document.getElementById('courseName' + row_count).value != undefined) {
		$.ajax({
			url: "/sessions/getCourseAffiliatedBodies/" + document.getElementById('courseName' + row_count).value,
			// dataType: "json",
			type: "GET",
			success: function(data) {
				$('#course_affiliated_body_div' + row_count).html(data);
			},
			error: function(data) {
				swal.showValidationError(
					`Request failed: ${data}`
				)
				alertify.error('Something went wrong.')
			}
		});
	} else {
		$('#courses_div').html('');
	}
}

function deleteSessionDetail(row_count) {
	$('#sessionDetailRow' + row_count).html("");
}

function autoCompleteCourseName(row_count) {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	});
	$.ajax({
		url: "/sessions/autoCompleteCourseName",
		// dataType: "json",
		data: {
			course_name: $('#courseName' + row_count).val(),
			row_count: row_count,
			affiliated_body_id: $('#affiliated_body' + row_count).val(),
		},
		type: "POST",
		success: function(data) {
			$('#courseNameSuggestions' + row_count).html(data);
		},
		error: function(data) {
			swal.showValidationError(
				`Request failed: ${data}`
			)
			alertify.error('Something went wrong.')
		}
	});
}

function completeName(courseId, row_count, affiliatedId = null) {
	// $('#courseName'+row_count).val(course.replace('_', ' '));
	$.ajax({
		url: "/sessions/getCompleteCourseInfo/" + courseId + '/' + affiliatedId,
		// dataType: "json",
		type: "GET",
		success: function(data) {
			$('#courseName' + row_count).val(data['course'].name + '-' + data['course'].course_code);
			$('#courseId' + row_count).val(data['course'].id);
			$('#courseNameSuggestions' + row_count).html('');
			$('#academicTerm' + row_count).html(data['affiliated_body']);
		},
		error: function(data) {
			swal.showValidationError(
				`Request failed: ${data}`
			)
			alertify.error('Something went wrong.')
		}
	});
}

function createRoadMap(row_count) {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	});
	var session_start_month_year = $('#sessionStartDate' + row_count).val();
	var session_end_month_year = $('#sessionEndDate' + row_count).val();
	var academic_term_id = $('#academicTerm' + row_count).val();
	if (session_start_month_year != null && session_end_month_year != null && academic_term_id) {
		$.ajax({
			url: "/sessions/makeRoadMap",
			// dataType: "json",
			data: {
				session_start_month_year: session_start_month_year,
				session_end_month_year: session_end_month_year,
				row_count: row_count,
				academic_term_id: academic_term_id,
				course_id: $('#courseId' + row_count).val(),
			},
			type: "POST",
			success: function(data) {
				$('#roadMap' + row_count).html(data);
			},
			error: function(data) {
				swal.showValidationError(
					`Request failed: ${data}`
				)
				alertify.error('Something went wrong.')
			}
		});
	}
}

function clearSearchedCourse(row_count) {
	$('#courseName' + row_count).val('');
	$('#courseNameSuggestions' + row_count).html('');
	$('#courseId' + row_count).val('');
}
var temp = 1;

function addNewCourses(annual_semester_counter, course_count, row_count) {
	old_counter = row_count + '-' + annual_semester_counter + '-' + course_count;
	var counters = row_count + '-' + annual_semester_counter + '-' + (course_count + temp);

	$.ajax({
		url: "/sessions/addNewCourse/" + counters + "/" + row_count,
		// dataType: "json",
		type: "GET",
		success: function(data) {
			$('#newCourses' + old_counter).append(data);
			temp++;
		},
		error: function(data) {
			swal.showValidationError(
				`Request failed: ${data}`
			)
			alertify.error('Something went wrong.')
		}
	});
}

function removeCourseAddRow(annual_semester_counter, course_count, row_count) {
	var counters = row_count + '-' + annual_semester_counter + '-' + course_count;
	$('#courseAddedRow' + counters).remove();
}

function autoCompleteSubjectName(annual_semester_counter, course_count, row_count) {
	// alert(counters);
	var counters = row_count + '-' + annual_semester_counter + '-' + course_count;
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	});
	$.ajax({
		url: "/sessions/autoCompleteSubjectName",
		// dataType: "json",
		data: {
			subject_name: $('#subjectName' + counters).val(),
			counters: counters,
			course_id: $('#courseId' + row_count).val(),
			row_count: row_count
		},
		type: "POST",
		success: function(data) {
			$('#subjectNameSuggestions' + counters).html(data);
		},
		error: function(data) {
			swal.showValidationError(
				`Request failed: ${data}`
			)
			alertify.error('Something went wrong.')
		}
	});
}

function completeSubjectName(subjectId, row_count, annual_semester_counter, course_count) {
	// $('#courseName'+row_count).val(course.replace('_', ' '));
	var counters = row_count + '-' + annual_semester_counter + '-' + course_count;
	$.ajax({
		url: "/sessions/getCompleteSubjectInfo/" + subjectId,
		// dataType: "json",
		type: "GET",
		success: function(data) {
			$('#subjectName' + counters).val(data.name);
			$('#subjectId' + counters).val(data.id);
			$('#subjectNameSuggestions' + counters).html('');
		},
		error: function(data) {
			alertify.error('Something went wrong.')
		}
	});
}

function checkBackDate(row_count) {
	var start_month_year = new Date($('#sessionStartDate' + row_count).val());
	var end_month_year = new Date($('#sessionEndDate' + row_count).val());
	if (start_month_year >= end_month_year) {
		$('#sessionEndDate' + row_count).val('');
		// $('#academicTerm' + row_count).val('');
		$('#roadMap' + row_count).html('');
		alertify.error('End date cannot be less than start date');
	}
}

function getWingCampuses(row_count) {
	var wingId = $('#wingId' + row_count).val();
	$.ajax({
		url: "/sessions/getWingCampuses/" + row_count + "/" + wingId,
		type: "GET",
		success: function(data) {
			$('#campusDetails' + row_count).html(data);
		},
		error: function(data) {
			alertify.error('Something went wrong.')
		}
	});
}
function calculateAdmissionRegistrationFee(row_count) {
	var admission_fee = parseInt($('#cfe_admission_fee-'+ row_count).val());
	var marketer_incentive = parseInt($('#marketer_incentive-'+ row_count).val());
	var registration_fee = parseInt($('#registration_fee-'+ row_count).val());
	console.log(registration_fee);
	var calculated_amount = 0;
	if(admission_fee != undefined && marketer_incentive != undefined && registration_fee != undefined)
	{
		var calculated_amount = admission_fee + marketer_incentive + registration_fee;
		$('#admission_registration_fee-'+ row_count).val(calculated_amount);
	}
	else
	{
		$('#admission_registration_fee-'+ row_count).val(0);
	}
}
