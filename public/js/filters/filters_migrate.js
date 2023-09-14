var add_row;
var selected_students = [];

function exportReportingToExcel(module_name) {
    // var table = TableExport(document.getElementById("reporting_table"));
    // var exportData = table.getExportData();
    // var blob = new Blob([JSON.stringify(exportData.reporting_table.xlsx.data)], {
    //     type: "application/vnd.ms-excel"
    // });
    // saveAs(blob, "Reportings.xls");
    var table = TableExport(document.getElementById(module_name + "_reporting_table"), {
        headers: true, // (Boolean), display table headers (th or td elements) in the <thead>, (default: true)
        footers: false, // (Boolean), display table footers (th or td elements) in the <tfoot>, (default: false)
        formats: ['xls', 'xlsx'], // (String[]), filetype(s) for the export, (default: ['xlsx', 'csv', 'txt'])
        filename: 'Reportings', // (id, String), filename for the downloaded file, (default: 'id')
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


function getFilterData(route) {
    document.getElementById('hide').hidden = false;
    document.getElementById('ok').hidden = false;
    document.getElementById('inc').hidden = false;


    var querry_string = 'filters=';
    if (document.getElementById('course_id') != null && document.getElementById('course_id').value != '') {
        querry_string += 'course_id:' + document.getElementById('course_id').value + ';';
    }
    if (document.getElementById('session_id') != null && document.getElementById('session_id').value != '') {
        querry_string += 'session_id:' + document.getElementById('session_id').value + ';';
    };
    if (document.getElementById('student_category_id') != null && document.getElementById('student_category_id').value != '') {
        querry_string += 'student_category_id:' + document.getElementById('student_category_id').value + ';';
    };

    var self = this;
    $.ajax({
        url: 'studentTransfers/getStudent' + '?' + querry_string,
        dataType: "json",
        type: "GET",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        success: function(data) {
            var trHTML = "";
            $.each(data.students, function(i, item) {
                trHTML += "<tr id='table_row" + item.id + "' onclick='migrateStudents(" + JSON.stringify(item.id) + ")'><td>" + item.roll_no + "'</td><td>'" + item.old_roll_no + "'</td><td>'" + item.student_name + "'</td><td>'" + item.student_type + "'</td><td>'" + item.session_name + "'</td><td>'" + item.course_name + "'</td><td>'" + item.section_name + "'</td></tr>";
            });
            $("#Subjects").html("");
            var add_row = '';
            add_row += "<select class='form-control select2 select2-multiple' multiple='multiple' name='subject' id='subject' required='required' >";
            add_row += "<option value='' disabled selected>--Select subjects--</option>"
            jQuery.each(data.subjects, function(index, value) {
                add_row += "<option value='" + value.id + "'>" + value.name + "</option>";
            });
            add_row += "</select>";
            $("#Subjects").append(add_row);

            $('#students_reporting_table').append(trHTML);
            $('#students_reporting_table tbody').on('click', 'tr', function() {
                $(this).toggleClass('selected');

            });


            $('#ok').click(function() {
                var books = $('#subject').val();
                $.ajax({
                    url: 'icrementStudentTransfers',
                    dataType: "json",
                    type: "POST",
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'selected_students': selected_students,
                        'selected_subjects': books,
                        'increment': $('input[name="increment"]').val(),
                    },
                    success: function(data) {
                        alertify.success("Migrate data Successfully.");
                        location.reload(true);
                    },
                });



            });

        }
    });
};

function migrateStudents(item) {
    selected_students.push(item);

}

function Validate() {
    var validator = document.getElementById("subject");
    if (validator.value == "") {
        document.getElementById('error').hidden = false;

    } else {
        document.getElementById('error').hidden = true;
    }


    var check = document.getElementById("increment").value;

    if (check == "") {

        document.getElementById('error1').hidden = false;
    } else {
        document.getElementById('error1').hidden = true;

    }
}



// function Required()
// {
// var check = document.getElementById("increment");
// if(check.value==""){

//         document.getElementById('error1').hidden = false;
//         }

//         return true;
// }

// $.ajax({
//         url: 'icrementstudentTransfers/getStudent',
//         dataType: "json",
//         type: "GET,
//         data:{'_token':$('input[name=_token]').val(),
//             'selected_students' :selected_students,

//         };
//         success:function(data){ 

//       },
//   });

// $(document).ready(function() {
//     var table = $('#students_reporting_table').DataTable();

//     $('#students_reporting_table tbody').on( 'click', 'tr', function () {
//         $(this).toggleClass('selected');
//     } );

// $('#button').click( function () {
//         alert( table.rows('.selected').data().length +' row(s) selected' );
//     } );
// } );



// function AppendSubject(){
//     var add_row= '';
//     add_row +="<div class= 'row'>";
//      add_row +="<div class= 'col-sm-4'>";
//      add_row +="<div class= 'form-group'>";
//      add_row +="<select class= 'form-control' name='subject[]' id='subject'>";
//      add_row +="<option value ='select_subject'>Select Multiple Subjects</option>";
//       jQuery.each(subject_array, function(index, value){
//         add_row +="<option value='" + value.id + "'>" + value.name+"</option>"
//       });
//       add_row +="</select>"; 
//        add_row +="</div>";      
//         add_row +="</div>";   
//          add_row +="</div>";  
//          $("#request_subject_node_added").append(add_row);