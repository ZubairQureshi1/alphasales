function validateForm(e) {
	e.preventDefault();
	var forn_validated = true;
	var fields = document.getElementsByClassName('item-required');
	var message = "Form cannot be saved. Following required fields are empty:"
	$.each(fields, function(i, field) {
		if (!field.hidden && !field.value) {
			message += "\r\n" + field.attributes.errorlabel.value;
			forn_validated = false;
		}
	});
	if (!forn_validated) {
		$.notify(message, "error");
	} else {
		$('#permissionForm').submit();
	}
}

function addPermissionColumn() {
	event.preventDefault();
	let _field = '';
	count++;

	_field += '<div class="list-group-item" id="permissionItem_'+count+'">';
    	_field += '<div class="input-group">';
			_field += '<input type="hidden" name="permission_ids[]" value="" id="permissionID_'+count+'">';
			_field += '<input type="text" name="permissions[]" class="form-control rounded-0 item-required" errorLabel="Permission name (Row '+(count+1)+')" placeholder="Permission action name"/>';
			_field += '<div class="input-group-append"><button class="btn btn-sm btn-danger" type="button" onclick="removePermissionColumn('+count+')"><i class="fa fa-times fa-fw"></i></button></div>';
    	_field += '</div>';
    _field += '</div>';

    $('#permissionListGroup').append(_field);
}


function removePermissionColumn(count) {
	event.preventDefault();

	var id = $('#permissionID_'+count).val();

	if (id) {
		Swal.fire({
			title: 'Are you sure to delete this permission??',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#2ecc71',
			cancelButtonColor: '#e74c3c',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.value) {
				handleDeletedColumn(id);
			}
		})
	} else {
		$('#permissionItem_'+count).remove();
	}

}


function handleDeletedColumn(id) {
	$.get('/permissions/'+id+'/remove-permission')
	.done(function() {
		$('#permissionItem_'+count).remove();
		alertify.success('Permission deleted successfully!');
	})
	.error(function(err){
		alertify.error(err.responseJSON.error);
	})
}
