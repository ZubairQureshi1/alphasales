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
    $('#table_div').html("");
    document.getElementById('report_loading').hidden = false;
    // $('#datatable-buttons').DataTable().clear().draw();
    $.ajax({
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        },
        url: "/reporting/enquiries/getMonthlyDataEnquiryTypeWise",
        type: "POST",
        data: {
            start_date: start_date,
            end_date: end_date,
            session_id: session_id,
        },
        success: function(data) {
            response_data = data.data;
            document.getElementById('report_loading').hidden = true;
            $('#table_div').append(data.data);
            alertify.success("Data retrieved successfully.");
            // window.location = '/admissions';
        },
        error: function(data) {
            document.getElementById('report_loading').hidden = true;
            alertify.error(data.responseJSON.error);
        }
    });
}

function exportCourseEnquiryReportToExcel() {
    var table = TableExport(document.getElementById('enquiry_wise_report_table'), {
        headers: true, // (Boolean), display table headers (th or td elements) in the <thead>, (default: true)
        footers: false, // (Boolean), display table footers (th or td elements) in the <tfoot>, (default: false)
        formats: ['xls', 'xlsx'], // (String[]), filetype(s) for the export, (default: ['xlsx', 'csv', 'txt'])
        filename: 'Enquiry-Type-Report', // (id, String), filename for the downloaded file, (default: 'id')
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