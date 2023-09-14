var selectedCourseCount=0;

$(document).ready(function() {
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $("input[name='_token']").val()
	    }
	});

  	setSelectedCourseCount()
});

function setSelectedCourseCount() {
	for (var i = courses.length - 1; i >= 0; i--) {
	 	var course = courses[i]
		if (course.isChecked) {
			selectedCourseCount++;
		}
	}
}

function onCourseSelect(index, id) {

	var bool = $('#'+ id).is(':checked');
	if (bool) {
		selectedCourseCount++;
		courses[index].isChecked = true;
	} else {
		selectedCourseCount--
		courses[index].isChecked = false;
	}

}
function updateForm(id) {
	
		event.preventDefault();
		var session_name = document.getElementById('session_name').value;
		var session_start_date = document.getElementById('session_start_date').value;
		var session_end_date = document.getElementById('session_end_date').value;
		var data = {
			_token: $("input[name='_token']").val(),
			session_name: session_name,
			session_start_date: session_start_date,
			session_end_date: session_end_date
		};
		data.courses = [];
		var index = 0;
		for (var i = 0; i < courses.length; i++) {
				var course = courses[i]
				if (course.isChecked) {
					data.courses[index] = course.id;
					index++;
				}
		}
		var formdata = new FormData();
		formdata.append('data', JSON.stringify(data));
		$.ajax({
	      url: "/sessions/" + id,
	      // dataType: "json",
	      type: "POST",
	      data: data,
	      success: function(data) {
			alertify.success('session updated successfully.');
	        window.location = '/sessions';
	      },
	      error: function(data) {
			alertify.error(data.responseJSON.message);
	      }
	    });
}
function back() {
    window.location = '/sessions';
}