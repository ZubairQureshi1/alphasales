var body_row_count = 0;
var selectedSubjectCount = 0;

$(document).ready(function() {
	body_row_count = document.getElementsByClassName('affiliated_body_row_childs').length;
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $("input[name='_token']").val()
		}
	});

    selectdPlotSize = $("#plot_size option:selected").text();
    document.getElementById('plot_size_number_div').hidden = false;
    $('#plot_size_number').attr("placeholder", "Enter Plot Size In "+ selectdPlotSize);

    onPlotNatureSelect();
    onPlotTypeSelect();
    generateProductName();
	setSelectedSubjectCount();

});

function setSelectedSubjectCount() {
	for (var i = subjects.length - 1; i >= 0; i--) {
		var subject = subjects[i]
		if (subject.isChecked) {
			selectedSubjectCount++;
		}
	}
}


function addAffiliatedBodyRow() {
	var add_row = "<div class='row margin-top-10 affiliated_body_row_childs' id='" + body_row_count + "'>";
	add_row += "<div class='col-md-5'>";
	add_row += "<select id='affiliated_body_id" + body_row_count + "' name='affiliated_body_ids[]' class='form-control select2'>";
	jQuery.each(affiliated_bodies, function(key, body) {
		add_row += "<option value='" + body.id + "'>" + body.name + "</option>";
	});
	add_row += "</select></div>";
	add_row += "<div class='col-md-5'>";
	add_row += "<select id='academic_term_id" + body_row_count + "' name='academic_term_ids[]' class='form-control select2'>";
	jQuery.each(constants.academic_terms, function(key, type) {
		add_row += "<option value='" + key + "'>" + type + "</option>";
	});
	add_row += "</select></div>";
	add_row += "<div class='col-md-2'>";
	add_row += '<button class="btn btn-danger btn-sm" onclick="removeAffiliatedBodyRow(' + body_row_count + ')" type="button"><i class="mdi mdi-delete"></i></button>'
	add_row += "</div>";
	add_row += "</div>";
	$('#affiliated_body_rows').append(add_row);
	body_row_count++;
}

function removeAffiliatedBodyRow(elementId) {
	// Removes an element from the document
	var element = document.getElementById(elementId);
	element.parentNode.removeChild(element);
}

function onSubjectSelect(index, id) {

	var bool = $('#' + id).is(':checked');
	if (bool) {
		selectedSubjectCount++;
		subjects[index].isChecked = true;
	} else {
		selectedSubjectCount--
		subjects[index].isChecked = false;
	}

}


function onPlotSizeSelect() {
    //selectdPlotSize = document.getElementById('plot_size').text;
    selectdPlotSize = $("#plot_size option:selected").text();
    document.getElementById('plot_size_number_div').hidden = false;
    $('#plot_size_number').attr("placeholder", "Enter Plot Size In "+ selectdPlotSize);
}

function onPlotNatureSelect() {
    //selectdPlotSize = document.getElementById('plot_size').text;
    selectdPlotNature = $("#nature_plot option:selected").val();
    //alert(selectdPlotNature);
    //document.getElementById('plot_type_div').hidden = false;

    if (selectdPlotNature == 'Residential'){
        document.getElementById('plot_type_resid_div').hidden = false;
        document.getElementById('plot_type_comm_div').hidden = true;
        $("#plot_type1").val(null).trigger("change");

    }
    else if (selectdPlotNature == 'Commercial'){
        document.getElementById('plot_type_comm_div').hidden = false;
        document.getElementById('plot_type_resid_div').hidden = true;
        $("#plot_type").val(null).trigger("change");


    }

}

function onPlotTypeSelect() {
    //selectdPlotSize = document.getElementById('plot_size').text;
    selectdPlotType1 = $("#plot_type1 option:selected").text();
    selectdPlotType = $("#plot_type option:selected").text();

    if (selectdPlotType == 'Others' || selectdPlotType1 == 'Others'){
        document.getElementById('other_plot_type_div').hidden = false;
    }
    else{
        document.getElementById('other_plot_type_div').hidden = true;
        $(".other_plot_type").val('');
    }


}

function generateProductName() {
    //alert('abc');
    projectName = $("#project option:selected").text();
    selectdPlotSize = $("#plot_size option:selected").text();
    selectdPlotNature = $("#nature_plot option:selected").text();
    selectdPlotSizeNumber = $("#plot_size_number").val();

    selectdPlotType1Val = $("#plot_type1 option:selected").val();

    if(selectdPlotType1Val){
        selectdPlotType1 = $("#plot_type1 option:selected").text();
    }
    else{
        selectdPlotType1 = '';
    }

    selectdPlotTypeVal = $("#plot_type option:selected").val();

    if(selectdPlotTypeVal){
        selectdPlotType = $("#plot_type option:selected").text();
    }
    else{
        selectdPlotType = '';
    }


    //selectdPlotType = $("#plot_type option:selected").text();
    other_plot_type = $("#other_plot_type").val();


    if (selectdPlotType == 'Others' || selectdPlotType1 == 'Others'){
        selectdPlotType1 = '';
        selectdPlotType = '';
    }
    else{

       // $("#other_plot_type").val("");
       other_plot_type = '';
        selectdPlotType1 = selectdPlotType1;
        selectdPlotType = selectdPlotType;

    }
   // alert(selectdPlotType);
    $("#name").val(selectdPlotSizeNumber +'  '+ selectdPlotSize +' - '+ selectdPlotNature +' - '+ selectdPlotType + selectdPlotType1 + '' + other_plot_type + ' - ' + projectName );

    //alert(selectdPlotType);




}


function updateForm(id) {
console.log(id);
		event.preventDefault();

		var name = document.getElementById('name').value;
		var plot_size = document.getElementById('plot_size').value;
		var plot_size_number = document.getElementById('plot_size_number').value;
		var duration_per_semester = document.getElementById('duration_per_semester').value;
		var course_code = document.getElementById('course_code').value;
		var vendor_share_amount = document.getElementById('vendor_share_amount').value;
		var degree_level_id = document.getElementById('degree_level_id').value;
		var data = {
			_token: $("input[name='_token']").val(),
			name: name,
			plot_size: plot_size,
			plot_size_number: plot_size_number,
			duration_per_semester: duration_per_semester,
			course_code: course_code,
			vendor_share_amount: vendor_share_amount,
			duration_per_semester: duration_per_semester,
			degree_level_id: degree_level_id,
		};

		// data.subjects = [];
		// console.log(data.subjects);
		// var index = 0;
		// for (var i = 0; i < subjects.length; i++) {
		// 	var subject = subjects[i]
		// 	if (subject.isChecked) {
		// 		data.subjects[index] = subject.id;
		// 		index++;
		// 	}
		// }
		// data.semesters = [];
		// var index = 0;
		// for (var i = 0; i < subjects.length; i++) {
		// 	var subject = subjects[i]
		// 	if (subject.isChecked) {
		// 		data.semesters[index] = document.getElementById('semester_id' + subject.id).value;
		// 		index++;
		// 	}
		// }
		// data.mid_term_attendance_percentage = [];
		// var index = 0;
		// for (var i = 0; i < subjects.length; i++) {
		// 	var subject = subjects[i]
		// 	if (subject.isChecked) {
		// 		data.mid_term_attendance_percentage[index] = document.getElementById('mid_term_attendance_percentage' + subject.id).value;
		// 		index++;
		// 	}
		// }
		// data.final_term_attendance_percentage = [];
		// var index = 0;
		// for (var i = 0; i < subjects.length; i++) {
		// 	var subject = subjects[i]
		// 	if (subject.isChecked) {
		// 		data.final_term_attendance_percentage[index] = document.getElementById('final_term_attendance_percentage' + subject.id).value;
		// 		index++;
		// 	}
		// }
		// data.prerequisite_subject_id = [];
		// var index = 0;
		// for (var i = 0; i < subjects.length; i++) {
		// 	var subject = subjects[i]
		// 	if (subject.isChecked) {
		// 		data.prerequisite_subject_id[index] = document.getElementById('prerequisite_subject_id' + subject.id).value;
		// 		index++;
		// 	}
		// }
		// data.credit_hours = [];
		// var index = 0;
		// for (var i = 0; i < subjects.length; i++) {
		// 	var subject = subjects[i]
		// 	if (subject.isChecked) {
		// 		data.credit_hours[index] = document.getElementById('credit_hours_id' + subject.id).value;
		// 		index++;
		// 	}
		// }
		// var affiliated_bodies = document.getElementsByClassName('affiliated_body_row_childs')
		// for (var i = 0; i < affiliated_bodies.length; i++) {
		// 	var selects = affiliated_bodies[i].getElementsByTagName('select');
		// 	for (var j = 0; j < selects.length; j++) {
		// 		if (selects[j].name in data) {

		// 			data[selects[j].name][i] = selects[j].value;
		// 		} else {
		// 			data[selects[j].name] = [];
		// 			data[selects[j].name][i] = selects[j].value;
		// 		}
		// 	}
		// }
		var formdata = new FormData();
		formdata.append('data', JSON.stringify(data));
		$.ajax({
			url: "/courses/" + id,
			// dataType: "json",
			type: "POST",
			data: data,
			success: function(data) {
				alertify.success('Course updated successfully.');
				window.location = '/courses';
			},
			error: function(data) {
				alertify.error(data.responseJSON.message);
			}
		});

}

function back() {
	window.location = '/courses';
}
