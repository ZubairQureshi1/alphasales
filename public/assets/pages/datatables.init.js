/*
 Template Name: Fonik - Responsive Bootstrap 4 Admin Dashboard
 Author: Themesbrand
 File: Datatable js
 */

$(document).ready(function() {
	$('#datatable').DataTable();

	var table;
	//Buttons examples
	if ($('#datatable-buttons').attr('isDefault') == "true") {
		console.log('printing table init');
		table = $('#datatable-buttons').DataTable({
			lengthChange: true,
			buttons: ['copy', 'excel', 'pdf', 'colvis']
		});
		table.buttons().container()
			.appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

	} else if ($('#followups') && $('#followups').attr('id') == 'followups') {

		if (followups) {
			$.each(followups, function(key, value) {
				var table = $('#' + key).DataTable({
					lengthChange: false,
					buttons: ['copy', 'excel', 'pdf', 'colvis']
				});
				table.buttons().container()
					.appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
			});
		}
	}
	
});