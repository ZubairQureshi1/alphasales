function getEmployeeFilteredData() {
    document.getElementById('report_loading').hidden = false;
    var querry_string = '';
    var start_date;
    var end_date;
    var session_id;
    $('#employee_table_div').html("");
    if (document.getElementById('employee_start_date') != null && document.getElementById('employee_start_date').value != '') {
        start_date = document.getElementById('employee_start_date').value;
    };
    if (document.getElementById('employee_end_date') != null && document.getElementById('employee_end_date').value != '') {
        end_date = document.getElementById('employee_end_date').value;
    };
    if (document.getElementById('employee_session_id') != null && document.getElementById('employee_session_id').value != '') {
        session_id = document.getElementById('employee_session_id').value;
    };
    // $('#datatable-buttons').DataTable().clear().draw();
    $.ajax({
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        },
        url: "/reporting/enquiries/getMonthlyDataEnquiryEmployeeWise",
        type: "POST",
        data: {
            start_date: start_date,
            end_date: end_date,
            session_id: session_id,
        },
        success: function(data) {
            response_data = data.data;
            document.getElementById('report_loading').hidden = true;
            $('#employee_table_div').append(data.data);
            alertify.success("Data retrieved successfully.");
            // window.location = '/admissions';
        },
        error: function(data) {
            document.getElementById('report_loading').hidden = true;
            alertify.error(data.responseJSON.error);
        }
    });
}

function exportEmployeeEnquiryReportToExcel() {
    var table = TableExport(document.getElementById('enquiry_employee_wise_report_table'), {
        headers: true, // (Boolean), display table headers (th or td elements) in the <thead>, (default: true)
        footers: false, // (Boolean), display table footers (th or td elements) in the <tfoot>, (default: false)
        formats: ['xls', 'xlsx'], // (String[]), filetype(s) for the export, (default: ['xlsx', 'csv', 'txt'])
        filename: 'Enquiry-CSO-Report', // (id, String), filename for the downloaded file, (default: 'id')
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