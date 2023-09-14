var body_row_count = 0;



function addAffiliatedBodyRow() {
	var add_row = "<div class='row margin-top-10' id='" + body_row_count + "'>";
	add_row += "<div class='col-md-5'>";
	add_row += "<select id='affiliated_body_id" + body_row_count + "' name='affiliated_body_ids[]' class='form-control select2'>";
	jQuery.each(affiliated_bodies, function(key, body) {
		add_row += "<option value='" + body.id + "'>" + body.name + "</option>";
	});
	add_row += "</select></div>";
	add_row += "<div class='col-md-5' hidden>";
	add_row += "<select id='academic_term_id" + body_row_count + "' name='academic_term_ids[]' class='form-control select2 ' hidden>";
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

function onPlotSizeSelect() {
    //selectdPlotSize = document.getElementById('plot_size').text;
    selectdPlotSize = $("#plot_size option:selected").text();
    document.getElementById('plot_size_number_div').hidden = false;
    $('#plot_size_number').attr("placeholder", "Enter Plot Size In "+ selectdPlotSize);
}

function onPlotNatureSelect() {
    //selectdPlotSize = document.getElementById('plot_size').text;
    selectdPlotNature = $("#nature_plot option:selected").val();
    document.getElementById('other_plot_type_div').hidden = true;
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
    //alert(selectdPlotType);
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
    $("#name").val(selectdPlotSizeNumber +'  '+ selectdPlotSize +' - '+ selectdPlotNature +' '+ selectdPlotType + selectdPlotType1 + '' + other_plot_type + ' - ' + projectName );

    //alert(selectdPlotType);




}

