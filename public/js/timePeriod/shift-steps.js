var sections = null;
var sessions = null;
var subjects = null;
var course_id = null;
var subject_id = null;
var section_id = null;
var flag = true;
var flag2 = true;
var flag3 = true;
var users = null;
$('.courses').on('change', function() {
    $('input[name="' + this.name + '"]').not(this).prop('checked', false);
    if(flag)
    {
        course_id = $('input[id="' + this.id + '"]').val();
        document.getElementById('course_id').value=course_id;

        $.ajax({
            url: "/getCourseDetails",
            // dataType: "json",
            type: "POST",
            data: {
                _token: $("input[name='_token']").val(),
                id: course_id
            },
            success: function(data) {
                debugger;
                window.location.href = "/timePeriods/create#step-2";
                var table = document.getElementById("subject_table");
                sections = (data['sections']);
                subjects = (data['subjects']);
                sessions = (data['sessions']);
                for (var i = 0; i < subjects.length; i++) {
                    var row = table.insertRow(1);
                    var cell1 = row.insertCell(0);
                    var cell2 = row.insertCell(1);
                    // cell2.innerHTML = "<label for='sections[i]['name']' data-on-label='Yes' data-off-label='No'></label><input name='sections' class='sec' type='checkbox' id='sections[i]['name']' switch='bool' value='sections[i]['id']'/>";
                    cell2.innerHTML = "<input name='subjects' class='subjects' type='checkbox'"+ "onchange='getSections(subject"+ subjects[i]['subject_id'] + ");' " + "id=subject" + subjects[i]['subject_id'] + " "  + "switch ='bool'" + "value=" + subjects[i]['subject_id'] +" "+ "/>" + "<label " + "for=subject" + subjects[i]['subject_id'] + " " + "data-on-label='Yes' data-off-label='No' class='la'></label>";
                    cell1.innerHTML = subjects[i]['subject_name'];
                    //window.alert(data);
                }
                
                $("#session_courses").html("");
                    var add_row = '';
                    add_row += "<select class='form-control' name='session_id' id='session_id'>";
                    add_row += "<option value='' disabled selected>-------  Select Session  -------</option>"
                    jQuery.each(data.sessions , function(index , value) {
                    add_row += "<option value='" + value.session_id + "'>"+ value.session_name +"</option>";
                });
                    add_row += "</select>";
                    $("#session_courses").append(add_row);
            },
            error: function(data) {
                debugger;
            }
        });
        flag = false;
    }

});


$('#start_date, #end_date, #selected_days, #timeSlot_id, #room_id').on('change', function() {

    var StartDate = $('#start_date').val();
    var timeSlodId = $('#timeSlot_id').val();
    var roomId = $('#room_id').val();
    var EndDate = $('#end_date').val();
    var SelectedDays = $('#selected_days').val();
    var isRepeat = $('#is_repeat').val()

    // Get form
    var form = $('#InputForm')[0];

    // Create an FormData object
    var data = new FormData(form);

    // If you want to add an extra field for the FormData
    // data.append("is_repeat", isRepeat);
    if((StartDate && timeSlodId && roomId) || (StartDate && timeSlodId && roomId && EndDate && SelectedDays))
    {
        $.ajax({
            url: "/facultyCheck" ,
            // dataType: "json",
            type: "POST",
            data: data,

            processData: false,
            contentType: false,
            success: function(html) {
                debugger;
                $('#user_id').html(html);
            },
            error: function(html) {
                debugger;
            }
        });
    }

});

function getSections(subject_ID){
    var subject = $(subject_ID);
    $('input[name="sections"]').not(subject).prop('checked', false);
    if(flag2)
    {
        subject_id = $(subject_ID).val();
        document.getElementById('subject_id').value=subject_id;
        window.location.href = "/timePeriods/create#step-4";

        var table = document.getElementById("section_table");
        for (var i = 0; i < sections.length; i++) 
        {
            var row = table.insertRow(1);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            // cell2.innerHTML = "<label for='sections[i]['name']' data-on-label='Yes' data-off-label='No'></label><input name='sections' class='sec' type='checkbox' id='sections[i]['name']' switch='bool' value='sections[i]['id']'/>";
            cell2.innerHTML = "<input name='sections' class='sections' type='checkbox' "+ "onchange='getLastStep(section"+ sections[i]['id'] + ");' " + " id=section" + sections[i]['id'] + " "  + "switch ='bool'" + "value=" + sections[i]['id'] +" "+ "/>" + "<label " + "for=section" + sections[i]['id'] + " " + "data-on-label='Yes' data-off-label='No' class='la'></label>";
            cell1.innerHTML = sections[i]['name'];
        }

        $.ajax({
            url: "/getSubjectUsers/" + subject.val(),
            // dataType: "json",
            type: "POST",
            data: {
                _token: $("input[name='_token']").val(),
            },
            success: function(html) {
                debugger;
                $('#user_id').html(html);
            },
            error: function(data) {
                debugger;
            }
        });
        flag2=false;
    }
}

function getLastStep(section_ID)
{
    var section = $(section_ID);
    $('input[name="sections"]').not(section).prop('checked', false);
    if(flag3)
    {
        section_id = $(section_ID).val();
        document.getElementById('section_id').value=section_id;
        window.location.href = "/timePeriods/create#step-4";
        flag3=false;
    }
}

$(document).ready(function(){
    $(".room").change(function(){
        room_id = $(this).find('option:selected').val();
        start_date = document.getElementById('start_date').value;
        end_date = document.getElementById('end_date').value;
        time_slot_id = document.getElementById('timeSlot_id').value;

        $.ajax({
            url: "/getDetails",

            type: "POST",
            data: {
                _token: $("input[name='_token']").val(),
                room_id: room_id,
                start_date: start_date,
                end_date: end_date,
                time_slot_id: time_slot_id 

            },
            success: function(data) {

                var x  = data['all'][0];
                document.getElementById("test").innerHTML=data['final'];
                debugger;

            },
            error: function(data) {

                window.alert("here");
                debugger;
            }
        });


                    //window.alert(room_id+" "+start_date+" "+end_date+" "+time_slot_id);
                });
});

// function onSectionSelect(id) {
//    window.location.href = "/timePeriods/create#step-3";

//    section_id=id;
//    document.getElementById('section_id').value=section_id;


//    var select = document.getElementById("subjects");
//    select.name="subject_id";
//    for (var i = 0; i<subjects.length; i++) {

//     var option = document.createElement("option");
//     option.text = subjects[i]['subject_name'];
//     option.id= subjects[i]['id'];
//     option.value = subjects[i]['id'];
//     select.add(option);


// }
// }

function isRepeat() {
    is_repeat = $('#is_repeat').is(':checked'); // retrieve the value
    if (!is_repeat) {
        $('.is_repeat_section').attr('hidden', 'hidden');
        $('#end_date').removeAttr('required');
    } else {
        $('.is_repeat_section').removeAttr('hidden');
        $('#end_date').attr('required', 'true');
    }
}