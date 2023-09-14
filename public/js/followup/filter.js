var response_data;

function getFilteredData() {
  var querry_string = '';
  var session_id;
  if (document.getElementById('session_id') != null && document.getElementById('session_id').value != '') {
    session_id = document.getElementById('session_id').value;
  };
  var student_category_id;
  if (document.getElementById('student_category_id') != null && document.getElementById('student_category_id').value != '') {
    student_category_id = document.getElementById('student_category_id').value;
  };

  var start_date;
  if (document.getElementById('start_date') != null && document.getElementById('start_date').value != '') {
    start_date = document.getElementById('start_date').value;
  };

  var end_date;
  if (document.getElementById('end_date') != null && document.getElementById('end_date').value != '') {
    end_date = document.getElementById('end_date').value;
  };

  var followup_status_id;
  if (document.getElementById('followup_status_id') != null && document.getElementById('followup_status_id').value != '') {
    followup_status_id = document.getElementById('followup_status_id').value;
  };

  document.getElementById('report_loading').hidden = false;
  $('#datatable-buttons').DataTable().clear().draw();

  $.ajax({
    headers: {
      'X-CSRF-Token': $('meta[name="_token"]').attr('content')
    },
    url: "/followups/getFilteredData",
    type: "POST",
    data: {
      session_id: session_id,
      student_category_id: student_category_id,
      start_date: start_date,
      end_date: end_date,
      followup_status_id: followup_status_id,
    },
    success: function(data) {
      response_data = data.data;
      var folloup_datatable = $('#datatable-buttons').DataTable();
      for (var i = 0; i < response_data.length; i++) {
        var value = response_data[i];
        folloup_datatable.row.add(createDataTableArray(i, value)).draw(false);
      }
      document.getElementById('report_loading').hidden = true;
      alertify.success("Data retrieved successfully.");
      // window.location = '/admissions';
    },
    error: function(data) {
      alertify.error(data.responseJSON.error);
    }
  });

}

function createDataTableArray(i, value) {
  // var button_html = '<button class="btn btn-primary btn-sm" onclick="addToFollowupModal(' + i + ')" data-toggle="modal" type="button"><i class="mdi mdi-pencil"></i></button>'
  var button_html = "<a href='" + base_url + "/followups/addFollowUpForm/" + value.id + "' class='btn btn-primary btn-sm'><i class='mdi mdi-pencil'></i></a>";
  var array = [
    value.date_formated,
    value.enq_form_code,
    value.status,
    value.enquiry_data.name,
    value.enquiry_data.father_name != null ? value.enquiry_data.father_name : '---',
    value.enquiry_data.student_cell_no != null ? value.enquiry_data.student_cell_no : '---',
    value.enquiry_data.father_cell_no != null ? value.enquiry_data.father_cell_no : '---',
    value.enquiry_data.previous_degree_id != null ? constants.previous_degrees[value.enquiry_data.previous_degree_id] : '---',
    value.enquiry_data.marks_obtained != null ? value.enquiry_data.marks_obtained : '---',
    value.enquiry_data.percentage != null ? value.enquiry_data.percentage : '---',
    value.remarks,
    value.status_id != '2' && value.status_id != '3' ? button_html : '---',
  ];
  return array;
}

function addToFollowupModal(index) {
  var followup = response_data[index];
  document.getElementById('enquiry_id').value = followup.enquiry_id;
  document.getElementById('enquiry_code').innerHTML = followup.enquiry_data.form_code;
  document.getElementById('student_name').innerHTML = followup.enquiry_data.name;
  document.getElementById('student_cell_no').innerHTML = followup.enquiry_data.student_cell_no;
  document.getElementById('father_name').innerHTML = followup.enquiry_data.father_name;
  document.getElementById('father_cell_no').innerHTML = followup.enquiry_data.father_cell_no;
  document.getElementById('present_address').innerHTML = followup.enquiry_data.present_address;
  document.getElementById('course').innerHTML = followup.enquiry_data.course_name;
  document.getElementById('followup_id').value = followup.id;

  document.getElementById('next_date').min = followup.next_date;
  $('#add_to_followup_modal').modal('show');
}