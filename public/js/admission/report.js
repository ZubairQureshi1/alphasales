var response_data;

function getFilteredData() {
  var querry_string = '';
  var start_date;
  if (document.getElementById('start_date') != null && document.getElementById('start_date').value != '') {
    start_date = document.getElementById('start_date').value;
  };
  var end_date;
  if (document.getElementById('end_date') != null && document.getElementById('end_date').value != '') {
    end_date = document.getElementById('end_date').value;
  };
  var session_id;
  if (document.getElementById('session_id') != null && document.getElementById('session_id').value != '') {
    session_id = document.getElementById('session_id').value;
  };

  // document.getElementById('report_loading').hidden = false;
  // $('#datatable-buttons').DataTable().clear().draw();

  $('#course_wise_report').html('');
  $('#employee_wise_report').html('');
  $.ajax({
    headers: {
      'X-CSRF-Token': $('meta[name="_token"]').attr('content')
    },
    url: "/admissions/reportings/getReport",
    type: "POST",
    data: {
      start_date: start_date,
      end_date: end_date,
      session_id :session_id,
    },
    success: function(data) {
      response_data = data.data;

      for (var i = 0; i < response_data.course_wise_report.length; i++) {
        var value = response_data.course_wise_report[i];
        var add_row = "<tr>";
        add_row += "<td>" + response_data.formated_date_range + "</td>";
        add_row += "<td>" + value.course_name + "</td>";
        add_row += "<td>" + value.total_count + "</td>";
        add_row += "<td>" + value.paid_count + "</td>";
        add_row += "<td>" + value.pwwb_count + "</td>";
        add_row += "</tr>";
        $('#course_wise_report').append(add_row);
      }
      // -----------Total of Courses --------------
      var add_row = "<tr>";
      add_row += "<td><b>" + response_data.formated_date_range + " (Total)</b></td>";
      add_row += "<td><b>Total</b></td>";
      add_row += "<td><b>" + response_data.total_courses_count.total_courses_enq_count + "</b></td>";
      add_row += "<td><b>" + response_data.total_courses_count.total_courses_paid_count + "</b></td>";
      add_row += "<td><b>" + response_data.total_courses_count.total_courses_pwwb_count + "</b></td>";
      add_row += "</tr>";
      $('#course_wise_report').append(add_row);

      // -----------------------------------------------------------

      for (var i = 0; i < response_data.user_wise_report.length; i++) {
        var value = response_data.user_wise_report[i];
        var add_row = "<tr>";
        add_row += "<td>" + response_data.formated_date_range + "</td>";
        add_row += "<td>" + value.user_name + "</td>";
        add_row += "<td>" + value.total_count + "</td>";
        add_row += "<td>" + value.paid_count + "</td>";
        add_row += "<td>" + value.pwwb_count + "</td>";
        add_row += "</tr>";
        $('#employee_wise_report').append(add_row);
      }
      // -----------Total of Employee --------------
      var add_row = "<tr>";
      add_row += "<td><b>" + response_data.formated_date_range + " (Total)</b></td>";
      add_row += "<td><b>Total</b></td>";
      add_row += "<td><b>" + response_data.total_emp_count.total_emp_enq_count + "</b></td>";
      add_row += "<td><b>" + response_data.total_emp_count.total_emp_paid_count + "</b></td>";
      add_row += "<td><b>" + response_data.total_emp_count.total_emp_pwwb_count + "</b></td>";
      add_row += "</tr>";
      $('#employee_wise_report').append(add_row);

      // -----------------------------------------------------------
      // document.getElementById('report_loading').hidden = true;
      alertify.success("Data retrieved successfully.");
      // window.location = '/admissions';
    },
    error: function(data) {
      alertify.error(data.responseJSON.error);
    }
  });

}


function exportCourseEnquiryReportToExcel() {

  var table = TableExport(document.getElementById('course_wise_report_table'), {
    headers: true, // (Boolean), display table headers (th or td elements) in the <thead>, (default: true)
    footers: false, // (Boolean), display table footers (th or td elements) in the <tfoot>, (default: false)
    formats: ['xls', 'xlsx'], // (String[]), filetype(s) for the export, (default: ['xlsx', 'csv', 'txt'])
    filename: 'Enq-Report', // (id, String), filename for the downloaded file, (default: 'id')
    bootstrap: true, // (Boolean), style buttons using bootstrap, (default: true)
    exportButtons: true, // (Boolean), automatically generate the built-in export buttons for each of the specified formats (default: true)
    position: 'top', // (top, bottom), position of the caption element relative to table, (default: 'bottom')
    ignoreRows: null, // (Number, Number[]), row indices to exclude from the exported file(s) (default: null)
    ignoreCols: null, // (Number, Number[]), column indices to exclude from the exported file(s) (default: null)
    trimWhitespace: true // (Boolean), remove all leading/trailing newlines, spaces, and tabs from cell text in the exported file(s) (default: false)
  });
  table.reset();
  // window.location = route;
}

function exportEmployeeEnquiryReportToExcel() {

  var table = TableExport(document.getElementById('employee_wise_report_table'), {
    headers: true, // (Boolean), display table headers (th or td elements) in the <thead>, (default: true)
    footers: false, // (Boolean), display table footers (th or td elements) in the <tfoot>, (default: false)
    formats: ['xls', 'xlsx'], // (String[]), filetype(s) for the export, (default: ['xlsx', 'csv', 'txt'])
    filename: 'Emp Enquiry Report', // (id, String), filename for the downloaded file, (default: 'id')
    bootstrap: true, // (Boolean), style buttons using bootstrap, (default: true)
    exportButtons: true, // (Boolean), automatically generate the built-in export buttons for each of the specified formats (default: true)
    position: 'top', // (top, bottom), position of the caption element relative to table, (default: 'bottom')
    ignoreRows: null, // (Number, Number[]), row indices to exclude from the exported file(s) (default: null)
    ignoreCols: null, // (Number, Number[]), column indices to exclude from the exported file(s) (default: null)
    trimWhitespace: true // (Boolean), remove all leading/trailing newlines, spaces, and tabs from cell text in the exported file(s) (default: false)
  });
  table.reset();

  // window.location = route;
}