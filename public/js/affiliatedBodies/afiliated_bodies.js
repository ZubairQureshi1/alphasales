

var count_checklist = 0;

function addNewCheckList() {
	event.preventDefault();

	count_checklist++;

	let _field = '';

	_field += '<div class="col-12" id="checkList_'+count_checklist+'">';
		_field += '<div class="input-group mb-3">';
			_field += '<textarea class="form-control rounded-0" rows="3" name="checklists[]" placeholder="Enter Checklist Description..." style="resize: none;" required></textarea>';
			_field += '<div class="input-group-append">';
				_field += '<button onclick="remvoeCheckList('+count_checklist+')" data-row="'+count_checklist+'" class="btn btn-link text-danger btn-sm rounded-0"><i class="fa fa-times fa-fw"></i></button>';
			_field += '</div>';
		_field += '</div>';
	_field += '</div>';

	$('#checkList').append(_field);
}

function remvoeCheckList(count) {
	event.preventDefault();
	$('#checkList_'+count).remove();
}


function editAddNewCheckList(count) {
	event.preventDefault();
	
	edit_count_checklist++;
	
	let _field = '';

	_field += '<div class="col-12" id="editCheckList_'+edit_count_checklist+'">';
		_field += '<div class="input-group mb-3">';
			_field += '<textarea class="form-control rounded-0" rows="3" name="checklists[]" placeholder="Enter Checklist Description..." style="resize: none;" required></textarea>';
			_field += '<div class="input-group-append">';
				_field += '<button onclick="remvoeEditCheckList('+edit_count_checklist+')" data-row="'+edit_count_checklist+'" class="btn btn-link text-danger btn-sm rounded-0"><i class="fa fa-times fa-fw"></i></button>';
			_field += '</div>';
		_field += '</div>';
	_field += '</div>';

	$('#editCheckListDiv_'+count).append(_field);
}


function remvoeEditCheckList(count) {
	event.preventDefault();
	$('#editCheckList_'+count).remove();
}