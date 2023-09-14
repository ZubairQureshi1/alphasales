function setAcademicWing() {
    var wing_id = document.getElementById('wing_id').value;
     // send ajax
    if(wing_id){        
        $.ajax({
            url: "wing/getWingType",
            type: "GET",
            data: {
                _token: $("input[name='_token']").val(),
                wing:wing_id
            },
            success: function(data) {
              if(data == 1){
                  $('.struck_off_limit_blank').val('');
                    document.getElementById('cs_table').hidden = false;
                    document.getElementById('ims_table').hidden = true;
              }else if(data == 2){
                    $('.credit_hour_blank').val('');
                    $('.struck_off_limit_blank').val('');
                    document.getElementById('ims_table').hidden = false;
                    document.getElementById('cs_table').hidden = true;
              }else{
                    $('.credit_hour_blank').val('');
                    $('.struck_off_limit_blank').val('');
                    document.getElementById('ims_table').hidden = true;
                    document.getElementById('cs_table').hidden = true;
               }
          },
            error: function(data) {
                alertify.error('Something Went Wrong!');
            }
        });
    } else {
        alertify.error('Please Select Required Information.');
    }

}

function setPaymentsHistory(e)
{
    if (document.getElementById("payments_history_table").style.display === "none")
        document.getElementById("payments_history_table").style.display="block";
    else
        document.getElementById("payments_history_table").style.display="none";
}

var credit_hour = 1;
var deleted_credit_hour = 0;
function addCredit(event) {
  event.preventDefault();
  let field = '';
  // make
  field += '<tr id="creditCourse_'+credit_hour+'" row_status="unchanged">';
  field += '<td><input type="number" name="credit_hour[]" id="credit_hour_'+ credit_hour +'" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" min="0" class="form-control credit_hour_blank" placeholder="XXXX"></td>';
  field += '<td><input type="number" name="struck_off_limit[]" id="struck_off_limit_'+ credit_hour +'" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" min="0" class="form-control struck_off_limit_blank" placeholder="XXXX"></td>';
  field += '<td><button type="button" row_index="' + credit_hour + '" class="btn btn-danger btn-sm deleteCreditCourseButton"><i class="fa fa-times fa-fw"></i> | Delete</button></td>';
  field += "<input type='hidden' name='credit_hour_" + credit_hour + "' id='credit_hour_" + credit_hour + "' value='unchanged'></input>";
  field += '</tr>';
  $('#tableCreditCourse tbody').append(field);
  removeCreditHourClickEvent();
  credit_hour++;
}

function removeCreditHourClickEvent() {
    $('#tableCreditCourse').off('click', '.deleteCreditCourseButton').on('click', '.deleteCreditCourseButton', deleteCreditHourRow);
}


function deleteCreditHourRow() {
  if ((credit_hour - deleted_credit_hour) > 1) {
    var cat_index = $(this).attr('row_index');
    $('#creditCourse_'+cat_index).attr('row_status', 'deleted');
    $('#creditCourse_'+cat_index).hide();
    deleted_credit_hour++;
  } else {
    $.notify("Minimum 1 Credit Course is required!");  
  }
}

