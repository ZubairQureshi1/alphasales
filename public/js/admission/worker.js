var selected_worker_id;
var selected_worker;

function onWorkerSelect() {
    selected_worker = document.getElementById('student_category_id').options[document.getElementById('student_category_id').options.selectedIndex].innerText;
    selected_worker_id = document.getElementById('student_category_id').value;
    if (selected_worker_id == 0) {
        console.log(enquiry);
        $("#worker_details").html("");
        var add_worker_detail_row = '';
        add_worker_detail_row += "<div class='col-md-4 pl-5 pt-3'>";
        add_worker_detail_row += "<input type='checkbox' name='self_worker' id='self_worker' class='form-check-input'>";
        add_worker_detail_row += "<label>self worker</label>";
        add_worker_detail_row += "</div>";
        add_worker_detail_row += "<div class='col-md-4'>";
        add_worker_detail_row += "<label>CFE File No.</label>";
        add_worker_detail_row += "<input type='text' name='cfe_file_no' id='cfe_file_no' class='form-control' placeholder='CFE File No'>";
        add_worker_detail_row += "</div>";
        add_worker_detail_row += "<div class='col-md-4'>";
        add_worker_detail_row += "<label>Dairy No</label>";
        add_worker_detail_row += "<input type='text' name='dairy_no' id='dairy_no' class='form-control' placeholder='Dairy No'>";
        add_worker_detail_row += "</div>";
        add_worker_detail_row += "<div class='col-md-4'>";
        add_worker_detail_row += "<label>Experience</label>";
        add_worker_detail_row += "<input type='text' value='" + enquiry.experience + "' name='experience' id='experience' class='form-control' placeholder='Experience'>";
        add_worker_detail_row += "</div>";
        add_worker_detail_row += "<div class='col-md-4'>";
        add_worker_detail_row += "<label>Designation</label>";
        add_worker_detail_row += "<input type='text' value='" + enquiry.designation + "' name='designation' id='designation' class='form-control' placeholder='Designation'>";
        add_worker_detail_row += "</div>";
        add_worker_detail_row += "<div class='col-md-4'>";
        add_worker_detail_row += "<label>EOBI</label>";
        add_worker_detail_row += "<input type='text' name='eobi' id='eobi' class='form-control' placeholder='EOBI'>";
        add_worker_detail_row += "</div>";
        add_worker_detail_row += "<div class='col-md-4'>";
        add_worker_detail_row += "<label>S.S.C</label>";
        add_worker_detail_row += "<input type='text' name='ssc' id='ssc' class='form-control' placeholder='S.S.C'>";
        add_worker_detail_row += "</div>";
        add_worker_detail_row += "<div class='col-md-4'>";
        add_worker_detail_row += "<label>S.S.C City</label>";
        add_worker_detail_row += "<input type='text' name='ssc_city' id='ssc_city' class='form-control' placeholder='S.S.C City'>";
        add_worker_detail_row += "</div>";
        add_worker_detail_row += "<div class='col-md-4'>";
        add_worker_detail_row += "<label>R-8-/D 5</label>";
        add_worker_detail_row += "<input type='text' name='r_eight' id='r_eight' class='form-control' placeholder='R-8'>";
        add_worker_detail_row += "</div>";
        add_worker_detail_row += "<div class='col-md-4'>";
        add_worker_detail_row += "<label>Factory Registration No.</label>";
        add_worker_detail_row += "<input type='text' name='factory_reg_no' id='factory_reg_no' class='form-control' placeholder='Factory Registration No'>";
        add_worker_detail_row += "</div>";
        add_worker_detail_row += "<div class='col-md-4'>";
        add_worker_detail_row += "<label>Is Transport</label>";
        add_worker_detail_row += "<select name='is_transport' id='is_transport' class='form-control'>";
        add_worker_detail_row += "<option>----- Select -----</option>";
        jQuery.each(constants.is_transport, function(index, value) {
            add_worker_detail_row += "<option value='" + index + "'>" + value + "</option>";
        });
        add_worker_detail_row += "</select>";
        add_worker_detail_row += "</div>";
        add_worker_detail_row += "<div class='col-md-4'>";
        add_worker_detail_row += "<label>Is Hostel</label>";
        add_worker_detail_row += "<select name='is_hostel' id='is_hostel' class='form-control'>";
        add_worker_detail_row += "<option>----- Select -----</option>";
        jQuery.each(constants.is_hostel, function(i, val) {
            add_worker_detail_row += "<option value='" + i + "'>" + val + "</option>";
        });
        add_worker_detail_row += "</select>";
        add_worker_detail_row += "</div>";
        add_worker_detail_row += "<div class='col-md-4 pl-5 pt-3'>";
        add_worker_detail_row += "<input type='checkbox' name='is_provisional_letter' id='is_provisional_letter' class='form-check-input'>";
        add_worker_detail_row += "<label>Provisional Letter</label>";
        add_worker_detail_row += "</div>";
        $("#worker_details").append(add_worker_detail_row);
    }
    if (selected_worker_id == 1) {
        $("#worker_details").html("");
    }
}