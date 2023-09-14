$(document).ready(function() {
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $("input[name='_token']").val()
	    }
	});

});

$("#semester_update").on("submit", function (event) {
		event.preventDefault();
		if($("#semester_update")[0].checkValidity()) {
		var course_id = document.getElementById('course_id').value;
		var session_id = document.getElementById('session_id').value;
		var semester = document.getElementById('semester').value;
		var min_discount = document.getElementById('min_discount').value;
		var max_discount = document.getElementById('max_discount').value;
		var min_installments = document.getElementById('min_installments').value;
		var max_installments = document.getElementById('max_installments').value;
		var id = document.getElementById('id').value;
		var data = {
			_token: $("input[name='_token']").val(),
			course_id: course_id,
			session_id: session_id,
			semester: semester,
			min_discount: min_discount,
			max_discount: max_discount,
			min_installments: min_installments,
			max_installments: max_installments
		};
		var formdata = new FormData();
		formdata.append('data', JSON.stringify(data));
		$.ajax({
	      url: "/semester/" + id,
	      // dataType: "json",
	      type: "PATCH",
	      data: data,
	      success: function(data) {
			alertify.success('semester updated successfully.');
	        back();
	      },
	      error: function(data) {
			alertify.error(data.responseJSON.message);
	      }
	    });
	}
});
function back() {
    window.location = '/semester';
}