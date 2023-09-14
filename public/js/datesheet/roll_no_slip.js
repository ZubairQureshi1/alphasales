var selected_datesheet_id;
var selected_datesheet;
var sitting = {};
function onDateSheetSelect(){
    selected_datesheet = document.getElementById('datesheet_id').options[document.getElementById('datesheet_id').options.selectedIndex].innerText;
    selected_datesheet_id = document.getElementById('datesheet_id').value;

    swal({
        title: 'Are you sure to select this DateSheet?',
        type: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            $.ajax({
                url: "/getRollNoSlipDetail",
                // dataType: "json",
                type: "POST",
                data: {
                    _token: $("input[name='_token']").val(),
                    id: selected_datesheet_id
                },
                
                success: function(data) {
                  $(".sitting_plan_schedule").html("");
                    jQuery.each(data.datesheet_sections, function(index, value) {
                        var add_row = "[ "; 
                        add_row += "<label>" + value.selected_section_name +  "</label>";
                        add_row += " ]";
                        $(".sitting_plan_schedule").append(add_row);
                       
                    });
                    $("#section_students_data").html("");
                    jQuery.each(data.selected_section_student,function(index,val){
                        var add_row;
                        add_row += "<tr>";
                        add_row += "<td>" + val.roll_no + "</td>";
                        add_row += "<td>" + val.student_name + "</td>";
                        add_row += "<td><a href='../RollNoSlipView/"+val.id+"'><button class='btn btn-info' >Roll no Slip</button></a></td>";
                        add_row += "</tr>";
                        $("#section_students_data").append(add_row);   
                        
                         });
                },
                error: function(data) {
                    swal.showValidationError(
                        `Request failed: ${data}`
                    )
                    alertify.error('Something went wrong.')
                }
            });
        },
        allowOutsideClick: () => !swal.isLoading()
    });
}