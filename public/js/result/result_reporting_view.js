var selected_date_sheet_id;
var selected_datesheet;

function onDateSheetSelect() {
    selected_datesheet = document.getElementById('datesheet_id').options[document.getElementById('datesheet_id').options.selectedIndex].innerText;
    selected_date_sheet_id = document.getElementById('datesheet_id').value;
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
                url: "/getDateSheetSection",
                // dataType: "json",
                type: "POST",
                data: {
                    _token: $("input[name='_token']").val(),
                    id: selected_date_sheet_id,
                },
            
                success: function(data) {
                    $("#sections").html("");
                    var add_row = '';
                    add_row += "<select class='form-control' id='section_id' onChange='OnSectionSelect()'>";
                    add_row += "<option>-------  Select Section  -------</option>";
                    jQuery.each(data.date_sheet_sections , function(index , value) {
                    add_row += "<option value='" + value.section_id + "'>"+ value.section_name +"</option>";
                });
                    add_row += "</select>";
                    $("#sections").append(add_row);
                    $("#date_sheet_books").html("");
                    var add_date_sheet_books = '';
                    add_date_sheet_books += "<select class='form-control' id='subject_id' onChange='OnSubjectSelect()'>";
                    add_date_sheet_books += "<option value=''>-------  Select Section  -------</option>"
                    jQuery.each(data.date_sheet_books , function(index , value) {
                    add_date_sheet_books += "<option value='" + value.subject_id + "'>"+ value.subject_name +"</option>";
                });
                    add_date_sheet_books += "</select>";
                    $("#date_sheet_books").append(add_date_sheet_books); 
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
var selected_section_id;
var selected_section;
function OnSectionSelect(){
    selected_section = document.getElementById('section_id').options[document.getElementById('section_id').options.selectedIndex].innerText;
    selected_section_id = document.getElementById('section_id').value;
    selected_datesheet = document.getElementById('datesheet_id').options[document.getElementById('datesheet_id').options.selectedIndex].innerText;
    selected_date_sheet_id = document.getElementById('datesheet_id').value;
    swal({
        title: 'Are you sure to select this Section?',
        type: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            $.ajax({
                url: "/getSectionResult",
                // dataType: "json",
                type: "POST",
                data: {
                    _token: $("input[name='_token']").val(),
                    selected_section_id:selected_section_id,
                    selected_date_sheet_id:selected_date_sheet_id,
                },
            
                success: function(data) {
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

// var selected_subject_id;
// var selected_subject;
// function OnSubjectSelect(){
//     selected_subject = document.getElementById('subject_id').options[document.getElementById('subject_id').options.selectedIndex].innerText;
//     selected_subject_id = document.getElementById('subject_id').value;
//     selected_section = document.getElementById('section_id').options[document.getElementById('section_id').options.selectedIndex].innerText;
//     selected_section_id = document.getElementById('section_id').value;
//     swal({
//         title: 'Are you sure to select this Subject?',
//         type: 'warning',
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         showCancelButton: true,
//         confirmButtonText: 'Yes',
//         showLoaderOnConfirm: true,
//         preConfirm: () => {
//             $.ajax({
//                 url: "/getSubjectResult",
//                 // dataType: "json",
//                 type: "POST",
//                 data: {
//                     _token: $("input[name='_token']").val(),
//                     selected_subject_id:selected_subject_id,
//                     selected_section_id:selected_section_id,
//                 },
//                 success: function(data) {
//                     jQuery.each(data.final_result_data , function(index,value){
//                         console.log(value.obtain_marks);
//                     });
//                 },
//                 error: function(data) {
//                     swal.showValidationError(
//                         `Request failed: ${data}`
//                     )
//                     alertify.error('Something went wrong.')
//                 }
//             });
//         },
//         allowOutsideClick: () => !swal.isLoading()
//     });
// }