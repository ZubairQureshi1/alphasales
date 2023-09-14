$(function() {
  editAcademicWing();
})
function editAcademicWing() {
          var wing_id = document.getElementById('wing_id').value
           if(wing_id == 2){
                document.getElementById('cs_table').hidden = false;
                document.getElementById('ims_table').hidden = true;
            }
            else if(wing_id == 3){
                document.getElementById('ims_table').hidden = false;
                document.getElementById('cs_table').hidden = true;
            }
            else{
                document.getElementById('ims_table').hidden = true;
                document.getElementById('cs_table').hidden = true;
       }
}

var edit_credit_hour = detail_count;
var edit_deleted_credit_hour = 0;
function editCredit(event) {
  event.preventDefault();
  let field = '';
  // make
  field += '<tr id="editCreditCourse_'+edit_credit_hour+'" row_status="unchanged">';
  field += '<td><input type="number" name="credit_hour[]" id="credit_hour_'+ edit_credit_hour +'" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" min="0" class="form-control" placeholder="XXXX"></td>';
  field += '<td><input type="number" name="struck_off_limit[]" id="struck_off_limit_'+ edit_credit_hour +'" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" min="0" class="form-control" placeholder="XXXX"></td>';
  field += '<td><button type="button" row_index="' + edit_credit_hour + '" class="btn btn-danger btn-sm editDeleteCreditCourseButton"><i class="fa fa-times fa-fw"></i> | Delete</button></td>';
  field += "<input type='hidden' name='credit_hour_" + edit_credit_hour + "' id='credit_hour_" + edit_credit_hour + "' value='unchanged'></input>";
  field += '</tr>';
  $('#editTableCreditCourse tbody').append(field);
  editRemoveCreditHourClickEvent();
  edit_credit_hour++;
}

function editRemoveCreditHourClickEvent() {
    $('#editTableCreditCourse').off('click', '.editDeleteCreditCourseButton').on('click', '.editDeleteCreditCourseButton', editDeleteCreditHourRow);
}


function editDeleteCreditHourRow() {
  if ((edit_credit_hour - edit_deleted_credit_hour) > 1) {
    var cat_index = $(this).attr('row_index');
    $('#editCreditCourse_'+cat_index).attr('row_status', 'deleted');
    $('#editCreditCourse_'+cat_index).hide();
    edit_deleted_credit_hour++;
  } else {
    $.notify("Minimum 1 Credit Course is required!");  
  }
}

