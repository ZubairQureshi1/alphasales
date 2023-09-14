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
                    add_row += "<select class='form-control' id='section_id' onChange='onSectionSelect()'>";
                    add_row += "<option>-------  Select Section  -------</option>"
                    jQuery.each(data.date_sheet_sections , function(index , value) {
                    add_row += "<option value='" + value.section_id + "'>"+ value.section_name +"</option>";
                });
                    add_row += "</select>";
              
                    $("#sections").append(add_row);

                    $("#result_card_exam_type").html("");  
                    var add_examtype = '';
                    add_examtype += "<strong>" + data.exam_type[0].exam_type + "</strong>";
                    $("#result_card_exam_type").append(add_examtype);
                 
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

function onSectionSelect() {
    selected_section = document.getElementById('section_id').options[document.getElementById('section_id').options.selectedIndex].innerText;
    selected_section_id = document.getElementById('section_id').value;
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
                url: "/getSectionStudent",
                // dataType: "json",
                type: "POST",
                data: {
                    _token: $("input[name='_token']").val(),
                    selected_section_id: selected_section_id,
                },
            
                success: function(data) {
                    $("#students").html("");
                    var add_row = '';
                    add_row += "<select class='form-control' id='student_id' onChange='onStudentSelect()'>";
                    add_row += "<option>-------  Select Student  -------</option>"
                    jQuery.each(data.section_students , function(index , value) {
                    add_row += "<option value='" + value.id + "'>"+ value.student_name +"</option>";
                });
                    add_row += "</select>";
              
                    $("#students").append(add_row);

                 
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



var selected_student_id;
var selected_student;

function onStudentSelect() {
    selected_student = document.getElementById('student_id').options[document.getElementById('student_id').options.selectedIndex].innerText;
    selected_student_id = document.getElementById('student_id').value;
    swal({
        title: 'Are you sure to select this Student?',
        type: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            $.ajax({
                url: "/getStudentResult",
                // dataType: "json",
                type: "POST",
                data: {
                    _token: $("input[name='_token']").val(),
                    id: selected_student_id,
                    selected_date_sheet_id : selected_date_sheet_id,
                },
            
                success: function(data) {
                    $(".student_detail").html("");
                    var add_row = "<div class='row'>";
                    add_row += "<div class='col-sm-4'> <label>Roll no: </label>" + data.student_detail.roll_no + "</div>";
                    add_row += "<div class='col-sm-8 text-right'> <label>Session: </label>" + data.student_detail.session_name + "</div>";
                    add_row += "</div>";
                    add_row += "<div class='row'>";
                    add_row += "<div class='col-sm-4'> <label>Student Name: </label>" + data.student_detail.student_name + "<br><label>Father Name: </label>" + data.student_detail.father_name + "</div>";
                    add_row += "<div class='col-sm-8 text-right'><label>Degree: </label>" + data.student_detail.course_name + "<br><label>Section: </label>" + data.student_detail.section_name + "</div>";
                    add_row += "</div>";
                    $(".student_detail").append(add_row);

                        
                    $("#result_detail").html("");
                    jQuery.each(data.student_result , function(index , value) {
                        var add_result = '';
                        add_result += "<tr>";
                        add_result += "<td>" + value.subject_name + "</td>";
                        add_result += "<td>" + value.total_marks + "</td>";
                        add_result += "<td>" + value.obtain_marks + "</td>";
                        add_result += "<td>" + value.percentage + "</td>";
                        add_result += "<td>" + value.grade + "</td>";
                        add_result += "<td>" + value.status + "</td>";
                        add_result += "</tr>";  
                        $("#result_detail").append(add_result);
                    });
                    $("#chart_section").html("");
                    var Subjects = new Array();
                    for(i=0;i<data.student_result.length;i++){
                        Subjects[i] = data.student_result[i].subject_name;
                    }
                    console.log(Subjects);
                    var Obtain_Marks = new Array();
                    for(j=0;j<data.student_result.length;j++){
                        Obtain_Marks[j] = data.student_result[j].obtain_marks;
                    }
                    console.log(Obtain_Marks);
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var chart = new Chart(ctx, {
                        // The type of chart we want to create
                        type: 'bar',

                        // The data for our dataset
                        data: {
                                labels:Subjects,
                            datasets: [{
                                label: 'My First dataset',
                                backgroundColor: '#284168',
                                borderColor: 'rgb(255, 99, 132)',
                                data: Obtain_Marks
                            }]
                        },
                        // Configuration options go here
                        options: {}
                        });
                    $("#chart_section").append(); 
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