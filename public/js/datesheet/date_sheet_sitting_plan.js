var selected_datesheet_id;
var selected_datesheet;
var sitting = {};

function onDateSheetSelect() {
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
                url: "/getSittingPlan",
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
                        add_row += "<label>" + value.selected_section_name + "</label>";
                        add_row += " ]";
                        $(".sitting_plan_schedule").append(add_row);

                    });
                    $(".selecetd_rooms").html("")
                    jQuery.each(data.date_sheet_rooms, function(i, val) {
                        var room_row = "<div class='row'><div class='col-sm-2'>";
                        room_row += "<label>" + val.selected_room_name + "</label></div>"; //col
                        room_row += "<div class='col-sm-2'>";
                        room_row += "<strong>Invigilator Name</strong>";
                        room_row += "<select name='invigilator' id='invigilator" + val.room_id + "' class='form-control'>";
                        room_row += "<option>--- Select Invigilator ---</option>"
                        jQuery.each(data.users, function(i, val) {
                            if (val.roles.length > 0) {
                                if (val.roles[0].id == '4') {
                                    room_row += "<option>" + val.name + "</option>";
                                }
                            }
                        });
                        room_row += "</select>";
                        room_row += "</div>";
                        room_row += "<div class='col-sm-2'>";
                        room_row += "<strong>Duty Days</strong>";
                        room_row += "<input name='days' class='form-control' id='days_id" + val.room_id + "' placeholder='Duty Days'></input>";
                        room_row += "</div>";
                        room_row += "<div class='col-sm-2'>";
                        room_row += "<strong>Start Time</strong>";
                        room_row += "<input name='start_time'  class='form-control' type='time' id='start_time_id" + val.room_id + "'></input>";
                        room_row += "</div>";
                        room_row += "<div class='col-sm-2'>";
                        room_row += "<strong>End Time</strong>";
                        room_row += "<input name='end_time' class='form-control' type='time' id='end_time_id" + val.room_id + "'></input>";
                        room_row += "</div>";
                        room_row += "<div class='col-sm-2'><input type='checkbox' id='room_id" + val.room_id + "' onclick='onRoomSelect(" + val.room_id + ")'></input></div>"
                        room_row += "</div>"; //row end
                        $(".selecetd_rooms").append(room_row);
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

function onRoomSelect(selected_room_id) {
    var object = {
        room_id: selected_room_id,
        invigilator: document.getElementById('invigilator' + selected_room_id).value,
        days: document.getElementById('days_id' + selected_room_id).value,
        start_time_id: document.getElementById('start_time_id' + selected_room_id).value,
        end_time_id: document.getElementById('end_time_id' + selected_room_id).value,
    };
    debugger;
    var name = object;
    if (!sitting.datesheetRooms) {
        sitting.datesheetRooms = [];
    }
    sitting.datesheetRooms.push(name);
}

function saveSitting() {
    alertify.confirm("Are you sure to proceed?", function(ev) {
            ev.preventDefault();
            isException = false;
            sitting._token = $("input[name='_token']").val();
            try {
                sitting.datesheet_id = document.getElementById('datesheet_id').value;
            } catch (exception) {
                isException = true;
                alertify.error('Something went wrong at datesheet.');
            }
            if (!isException) {

                $.ajax({
                    url: "/DoneSittingplan",
                    dataType: "json",
                    type: "POST",
                    data: sitting,
                    success: function(data) {
                        alertify.success("sitting Process Completed Successfully.");
                        window.location = '/DoneSittingplan';
                    },
                    error: function(data) {
                        console.log(data);
                        alertify.error(data.responseJSON.error);
                    }
                });
            }
        },
        function(ev) {
            ev.preventDefault();
            alertify.error("sitting Process Cancelled Successfully.");
        });
}