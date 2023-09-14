var selected_course_id;
var selected_course;
var admission = {};
var course_push = [];
var dta = [];
function onCourseSelect() {
    selected_course = document.getElementById('course_id').value;
    course_push.push(selected_course);
    console.log(course_push);
    selected_course_id =course_push[course_push.length - 1];
    console.log(selected_course_id);
    swal({
        title: 'Are you sure to select this course?',
        type: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            $.ajax({
                url: "/getCourseDetails",
                // dataType: "json",
                type: "POST",
                data: {
                    _token: $("input[name='_token']").val(),
                    id: selected_course_id
                },
                success: function(data) {
                    Array.prototype.push.apply(dta,data.subjects);
                    var newdta = removeDuplicates(dta,"subject_name");
                    $("#course_subject").html("");
                    jQuery.each(newdta, function(index, value) {
                        var add_row = "<div class='row'><div class='col-sm-3'>";
                        add_row += "<label>" + value.subject_name + "</label></div>";//col
                        add_row += "<div class='col-sm-3'>";
                        add_row += "<strong>Date</strong>";
                        add_row += "<input name='date'  class='form-control' type='date' id='date"+ value.subject_id +"'></input>";
                        add_row += "</div>";
                        add_row += "<div class='col-sm-2'>";
                        add_row += "<strong>Start Time</strong>";
                        add_row += "<input name='start_time'  class='form-control' type='time' id='start_time_"+ value.subject_id +"'></input>";
                        add_row += "</div>";
                        add_row += "<div class='col-sm-2'>";
                        add_row += "<strong>End Time</strong>";
                        add_row += "<input name='end_time' class='form-control' type='time' id='end_time_"+ value.subject_id +"'></input>";
                        add_row += "</div>";
                        add_row += "<div class='col-sm-2'><div class='text-center'><input name='course_id' type='checkbox' id='subject_id_" + value.subject_id + "' onclick='onBooksSelect(" + value.subject_id + ")' switch='bool' value='" + value.subject_name + "'></input>"
                        add_row += "<label for='subject_id_" + value.subject_id + "' data-on-label='Yes' data-off-label='No'></label></div></div>";
                        add_row += "</div>";//row end
                        $("#course_subject").append(add_row);
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
$(document).ready(function (){
    $("#viewbooks").click(function(){
            $('#course_subject').toggle(1000);
    });
});

function removeDuplicates(originalArray, prop) {
    var newArray = [];
    var lookupObject  = {};

    for(var i in originalArray) {
       lookupObject[originalArray[i][prop]] = originalArray[i];
    }

    for(i in lookupObject) {
        newArray.push(lookupObject[i]);

    }
    newArray.pop();

     return newArray;
}
