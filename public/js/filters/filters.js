var add_row;

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
    var querry_string = 'filters=';
    if (document.getElementById('user_id') != null && document.getElementById('user_id').value != '') {
        querry_string += 'user_id:' + document.getElementById('user_id').value + ';';
    }
    if (document.getElementById('student_id') != null && document.getElementById('student_id').value != '') {
        querry_string += 'student_id:' + document.getElementById('student_id').value + ';';
    }
    if (document.getElementById('course_id') != null && document.getElementById('course_id').value != '') {
        querry_string += 'course_id:' + document.getElementById('course_id').value + ';';
    }
    if (document.getElementById('part_id') != null && document.getElementById('part_id').value != '') {
        querry_string += 'part_id:' + document.getElementById('part_id').value + ';';
    }
    if (document.getElementById('session_id') != null && document.getElementById('session_id').value != '') {
        querry_string += 'session_id:' + document.getElementById('session_id').value + ';';
    }
    if (document.getElementById('subject_id') != null && document.getElementById('subject_id').value != '') {
        querry_string += 'subject_id:' + document.getElementById('subject_id').value + ';';
    }
    if (document.getElementById('role_id') != null && document.getElementById('role_id').value != '') {
        querry_string += 'role_id:' + document.getElementById('role_id').value + ';';
    }
    if (document.getElementById('admission_id') != null && document.getElementById('admission_id').value != '') {
        querry_string += 'admission_id:' + document.getElementById('admission_id').value + ';';
    }
    if (document.getElementById('department_id') != null && document.getElementById('department_id').value != '') {
        querry_string += 'department_id:' + document.getElementById('department_id').value + ';';
    }
    if (document.getElementById('designation_id') != null && document.getElementById('designation_id').value != '') {
        querry_string += 'designation_id:' + document.getElementById('designation_id').value + ';';
    }
    if (document.getElementById('section_id') != null && document.getElementById('section_id').value != '') {
        querry_string += 'section_id:' + document.getElementById('section_id').value + ';';
    };
    if (document.getElementById('student_category_id') != null && document.getElementById('student_category_id').value != '') {
        querry_string += 'student_category_id:' + document.getElementById('student_category_id').value + ';';
    };
    if (document.getElementById('is_end_of_reg') != null && document.getElementById('is_end_of_reg').value != '') {
        querry_string += 'is_end_of_reg:' + document.getElementById('is_end_of_reg').value + ';';
    };
    var fee_structure_type_id;
    if (document.getElementById('fee_structure_type_id') != null && document.getElementById('fee_structure_type_id').value != '') {
        // querry_string += 'fee_structure_type_id:' + document.getElementById('fee_structure_type_id').value + ';';
        fee_structure_type_id = document.getElementById('fee_structure_type_id').value;
    };
    var payment_status_id;
    if (document.getElementById('payment_status_id') != null && document.getElementById('payment_status_id').value != '') {
        // querry_string += 'payment_status_id:' + document.getElementById('payment_status_id').value + ';';
        payment_status_id = document.getElementById('payment_status_id').value;
    };
    var head_id;
    var head_name;
    if (document.getElementById('head_id') != null && document.getElementById('head_id').value != '') {
        // querry_string += 'head_id:' + document.getElementById('head_id').value + ';';
        head_id = document.getElementById('head_id').value;
        head_name = document.getElementById('head_id').options[document.getElementById('head_id').options.selectedIndex].innerText;
    };
    var voucher_status_id;
    if (document.getElementById('voucher_status_id') != null && document.getElementById('voucher_status_id').value != '') {
        // querry_string += 'voucher_status_id:' + document.getElementById('voucher_status_id').value + ';';
        voucher_status_id = document.getElementById('voucher_status_id').value;
    };
    add_row = ''
    var start_date;
    if (document.getElementById('start_date') != null && document.getElementById('start_date').value != '') {
        // querry_string += 'voucher_status_id:' + document.getElementById('voucher_status_id').value + ';';
        start_date = document.getElementById('start_date').value;
    };
    var end_date;
    if (document.getElementById('end_date') != null && document.getElementById('end_date').value != '') {
        // querry_string += 'voucher_status_id:' + document.getElementById('voucher_status_id').value + ';';
        end_date = document.getElementById('end_date').value;
    };
    add_row = ''
    document.getElementById('report_loading').hidden = false;
    // var data_table = $('#datatable-buttons').DataTable();
    // data_table.clear().draw();
    $("tbody").html(add_row);
    var self = this;
    $.ajax({
        url: route + '?' + querry_string,
        dataType: "json",
        type: "GET",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            if (data.data.module_name == 'accounts') {
                refreshToDefaultCols();
                if (head_id != null) {
                    document.getElementById('as_on_value').innerText = new Date().getDate() + '-' + (new Date().getMonth() + 1) + '-' + new Date().getFullYear();
                    document.getElementById('reporting_title').innerText = 'Due Other Heads Report';
                    document.getElementById('session_value').innerText = document.getElementById('session_id').options[document.getElementById('session_id').options.selectedIndex].innerText;
                    document.getElementById('section_value').innerText = document.getElementById('section_id').options[document.getElementById('section_id').options.selectedIndex].innerText;
                    document.getElementById('part_value').innerText = '---' /*document.getElementById('part_value').value*/ ;
                    document.getElementById('course_value').innerText = document.getElementById('course_id').options[document.getElementById('course_id').options.selectedIndex].innerText;
                    document.getElementById('category_value').innerText = '---';
                    document.getElementById('date_value').innerText = document.getElementById('start_date').value + ' - ' + document.getElementById('end_date').value;
                    document.getElementById('head_category_value').innerText = document.getElementById('head_id').options[document.getElementById('head_id').options.selectedIndex].innerText;
                    addHeadColToTable('head');
                }
                if (fee_structure_type_id != null) {
                    document.getElementById('as_on_value').innerText = new Date().getDate() + '-' + (new Date().getMonth() + 1) + '-' + new Date().getFullYear();
                    document.getElementById('reporting_title').innerText = 'Due Tution Fee ';
                    document.getElementById('session_value').innerText = document.getElementById('session_id').options[document.getElementById('session_id').options.selectedIndex].innerText;
                    document.getElementById('section_value').innerText = document.getElementById('section_id').options[document.getElementById('section_id').options.selectedIndex].innerText;
                    document.getElementById('part_value').innerText = '---' /*document.getElementById('part_value').value*/ ;
                    document.getElementById('course_value').innerText = document.getElementById('course_id').options[document.getElementById('course_id').options.selectedIndex].innerText;
                    document.getElementById('category_value').innerText = '---';
                    document.getElementById('date_value').innerText = document.getElementById('start_date').value + ' - ' + document.getElementById('end_date').value;
                    renderTableColForInstalments();
                }
                document.getElementById('report_loading').hidden = true;
                jQuery.each(data.data.students, function(index, student) {
                    if (fee_structure_type_id != null) {
                        var student_packages = student.fee_packages;
                        var student_academic_histories = student.student_academic_histories;
                        if (document.getElementById('part_id').value != null && document.getElementById('part_id').value != '' && student_academic_histories.length == document.getElementById('part_id').value) {
                            if (student_packages != null && student_packages.length > 0) {
                                var active_package = student_packages[student_packages.length - 1];
                                if (fee_structure_type_id == '0' && active_package.fee_structure_type_id == fee_structure_type_id) {
                                    if (payment_status_id != null && active_package.status_id == payment_status_id) {
                                        // populateDataTableRow(data_table, student);
                                        populateData(student);
                                    } else if (payment_status_id == null) {
                                        // populateDataTableRow(data_table, student);
                                        populateData(student);
                                    }
                                } else if (fee_structure_type_id == '1' && active_package.fee_structure_type_id == fee_structure_type_id) {
                                    // populateDataTableRow(data_table, student);
                                    jQuery.each(active_package.fee_package_installments, function(index, installment) {
                                        if (payment_status_id != null && installment.status_id == payment_status_id) {
                                            // populateDataTableRow(data_table, student);
                                            populateTableForInstalmentGenerated(self, student, installment);
                                        } else if (payment_status_id == null) {
                                            // populateDataTableRow(data_table, student);
                                            populateTableForInstalmentGenerated(self, student, installment);
                                        }
                                    });
                                }
                            }
                        }

                        if (document.getElementById('part_id').value == null || document.getElementById('part_id').value == '') {
                            if (student_packages != null && student_packages.length > 0) {
                                var active_package = student_packages[student_packages.length - 1];
                                if (fee_structure_type_id == '0' && active_package.fee_structure_type_id == fee_structure_type_id) {
                                    if (payment_status_id != null && active_package.status_id == payment_status_id) {
                                        // populateDataTableRow(data_table, student);
                                        populateData(student);
                                    } else if (payment_status_id == null) {
                                        // populateDataTableRow(data_table, student);
                                        populateData(student);
                                    }
                                } else if (fee_structure_type_id == '1' && active_package.fee_structure_type_id == fee_structure_type_id) {
                                    // populateDataTableRow(data_table, student);
                                    jQuery.each(active_package.fee_package_installments, function(index, installment) {
                                        if (payment_status_id != null && installment.status_id == payment_status_id) {
                                            // populateDataTableRow(data_table, student);
                                            populateTableForInstalmentGenerated(self, student, installment);
                                        } else if (payment_status_id == null) {
                                            // populateDataTableRow(data_table, student);
                                            populateTableForInstalmentGenerated(self, student, installment);
                                        }
                                    });
                                }
                            }
                        }

                    } else if (head_id != null) {
                        var student_packages = student.fee_packages;
                        if (document.getElementById('part_id').value != null && student_packages.length == document.getElementById('part_id').value) {
                            var student_heads = student.head_fine_students;
                            jQuery.each(student_heads, function(index, student_head) {
                                if (student_head.head_id == head_id) {
                                    if (payment_status_id != null) {
                                        if (student_head.status_id == payment_status_id) {
                                            populateDataWithHead(student, student_head, data.data.heads);
                                        }
                                    } else {
                                        populateDataWithHead(student, student_head, data.data.heads);
                                    }
                                }
                            });
                        }
                        if (document.getElementById('part_id').value == null || document.getElementById('part_id').value == '') {
                            var student_heads = student.head_fine_students;
                            jQuery.each(student_heads, function(index, student_head) {
                                if (student_head.head_id == head_id) {
                                    if (payment_status_id != null) {
                                        if (student_head.status_id == payment_status_id) {
                                            populateDataWithHead(student, student_head, data.data.heads);
                                        }
                                    } else {
                                        populateDataWithHead(student, student_head, data.data.heads);
                                    }
                                }
                            });
                        }
                    } else {
                        populateData(student);
                    }
                });
            }
            if (data.data.module_name == 'student_attendances') {
                document.getElementById('report_loading').hidden = true;
                jQuery.each(data.data.students, function(index, student) {
                    jQuery.each(student.attendances, function(index, attendance) {
                        populateStudentAttendanceData(attendance, student);
                    });
                });
            }
            if (data.data.module_name == 'employee_attendances') {
                document.getElementById('report_loading').hidden = true;
                document.getElementById('emp_attendance_export').hidden = false;
                var querry_string = 'start_date=' + document.getElementById('start_date').value + '&' + 'end_date=' + document.getElementById('end_date').value;
                document.getElementById('emp_attendance_export').href = '../employeeAttendances/exportExcel/' + data.data.user.id + '?' + querry_string;
                jQuery.each(data.data.user.attendances, function(index, attendance) {
                    populateEmployeeAttendanceData(attendance, data.data.user);
                });
            }
            $("tbody").html(add_row);
            exportReportingToExcel(data.data.module_name);
            alertify.success("Request Completed Successfully.");
        },
        error: function(data) {
            console.log(data);
            // alertify.error(data.responseJSON.error);
        }
    });
};
// function populateDataTableRow(table, student) {
//     table.row.add([student.roll_no,
//         student.old_roll_no,
//         student.student_name,
//         student.session_name,
//         student.course_name,
//         student.section_name,
//         '',
//     ]).draw(false);
// }
function refreshToDefaultCols() {
    var cols_html;
    cols_html = '<th>Roll No</th>';
    cols_html += '<th>Old Roll No</th>';
    cols_html += '<th>Student Name</th>';
    cols_html += '<th>Student Type</th>';
    cols_html += '<th>Session Name</th>';
    cols_html += '<th>Course Name</th>';
    cols_html += '<th>Section Name</th>';
    $("thead tr").html(cols_html);
}

function addHeadColToTable(table_type) {
    var cols_html;
    if (table_type == 'head') {
        if (document.getElementById('payment_status_id').value != '' && document.getElementById('payment_status_id').value == 0) {
            cols_html = '<th>Contact No.</th>';
            cols_html += '<th>Head Name</th>';
            cols_html += '<th>Due Amount</th>';
            cols_html += '<th>Due Date</th>';
        }
        if (document.getElementById('payment_status_id').value != '' && document.getElementById('payment_status_id').value == 1) {
            cols_html = '<th>Payment Date</th>';
            cols_html += '<th>Payment Received</th>';
            cols_html += '<th>Voucher No.</th>';
        }
        if (document.getElementById('payment_status_id').value == '') {
            cols_html = '<th>Head Name</th>';
            cols_html += '<th>Payment Date</th>';
            cols_html += '<th>Payment Received</th>';
            cols_html += '<th>Voucher No.</th>';
            cols_html += '<th>Order Placed</th>';
            cols_html += '<th>Date Of Order Delivered</th>';
            cols_html += '<th>Vendor Share (Course Wise)</th>';
        }
        $("thead tr").append(cols_html);
    }
}

function populateData(student) {
    add_row += "<tr>";
    add_row += "<td>" + student.roll_no + "</td>";
    add_row += "<td>" + student.old_roll_no + "</td>";
    add_row += "<td>" + student.student_name + "</td>";
    add_row += "<td>" + student.admission_type + "</td>";
    add_row += "<td>" + student.session_name + "</td>";
    add_row += "<td>" + student.course_name + "</td>";
    add_row += "<td>" + student.section_name + "</td>";
    add_row += "</tr>"
}

function populateStudentAttendanceData(attendance, student) {
    if (document.getElementById('start_date').value != '') {
        attendance_date = new Date(attendance.date);
        start_date = new Date(document.getElementById('start_date').value);
        end_date = new Date(document.getElementById('end_date').value);
        if (attendance_date.getTime() >= start_date.getTime() && attendance_date.getTime() <= end_date.getTime()) {

            add_row += "<tr>";
            add_row += "<td>" + attendance.date + "</td>";
            add_row += "<td>" + student.student_name + "</td>";
            add_row += "<td>" + student.section_name + "</td>";
            add_row += "<td>" + student.roll_no + "</td>";
            // add_row += "<td>" + student.old_roll_no + "</td>";
            // add_row += "<td>" + student.admission_type + "</td>";
            
            // if (student.student_cell_no != null && student.student_cell_no != '') {
            //     add_row += "<td>" + student.student_cell_no + "</td>";
            // } else {
            //     add_row += "<td>" + "---" + "</td>";
            // }

            // if (student.father_cell_no != null && student.father_cell_no != '') {
            //     add_row += "<td>" + student.father_cell_no + "</td>";
            // } else {
            //     add_row += "<td>" + "---" + "</td>";
            // }

            if (attendance.check_in_time_gmt != null && attendance.check_in_time_gmt != '') {
                // add_row += "<td>" + attendance.check_in_time_gmt + "</td>";
                add_row += "<td>";
                add_row += '<input class="form-control input-date-time" type="datetime" id="check_in_time_gmt_' + attendance.id + '" value="' + attendance.check_in_time_gmt + '"/>';
                add_row += "</td>";
            } else {
                add_row += "<td>" + "---" + "</td>";
            }
            if (attendance.check_out_time_gmt != null && attendance.check_out_time_gmt != '') {
                // add_row += "<td>" + attendance.check_out_time_gmt + "</td>";
                add_row += "<td>";
                add_row += '<input class="form-control input-date-time" type="datetime" id="check_out_time_gmt_' + attendance.id + '" value="' + attendance.check_out_time_gmt + '"/>';
                add_row += "</td>";
            } else {
                add_row += "<td>" + "---" + "</td>";
            }
            // if (attendance.time_slot_name != null && attendance.time_slot_name != '') {
            //     add_row += "<td>" + attendance.time_slot_name + "</td>";
            // } else {
            //     add_row += "<td>" + "---" + "</td>";
            // }
            add_row += "<td>" + attendance.status + "</td>";
            add_row += "<td>";
            add_row += "<button class='btn btn-secondary waves-effect waves-light' id='present_" + attendance.id + "' onclick='updateManualAttendance(" + attendance.id + ")'>P</button>";
            add_row += "<button class='btn btn-warning waves-effect waves-light' id='leave_" + attendance.id + "' onclick='setLeave(" + attendance.id + ")'>L</button>";
            add_row += "</td>";
            add_row += "</tr>"
        }
    } else {

        add_row += "<tr>";
        add_row += "<td>" + attendance.date + "</td>";
        add_row += "<td>" + student.student_name + "</td>";
        add_row += "<td>" + student.section_name + "</td>";
        add_row += "<td>" + student.roll_no + "</td>";
        // add_row += "<td>" + student.old_roll_no + "</td>";
        add_row += "<td>" + student.admission_type + "</td>";
        if (student.student_cell_no != null && student.student_cell_no != '') {
            add_row += "<td>" + student.student_cell_no + "</td>";
        } else {
            add_row += "<td>" + "---" + "</td>";
        }
        if (student.father_cell_no != null && student.father_cell_no != '') {
            add_row += "<td>" + student.father_cell_no + "</td>";
        } else {
            add_row += "<td>" + "---" + "</td>";
        }
        if (attendance.check_in_time_gmt != null && attendance.check_in_time_gmt != '') {
            // add_row += "<td>" + attendance.check_in_time_gmt + "</td>";
            add_row += "<td>";
            add_row += '<input class="form-control input-date-time" type="datetime" id="check_in_time_gmt_' + attendance.id + '" value="' + attendance.check_in_time_gmt + '"/>';
            add_row += "</td>";
        } else {
            add_row += "<td>" + "---" + "</td>";
        }
        if (attendance.check_out_time_gmt != null && attendance.check_out_time_gmt != '') {
            // add_row += "<td>" + attendance.check_out_time_gmt + "</td>";
            add_row += "<td>";
            add_row += '<input class="form-control input-date-time" type="datetime" id="check_out_time_gmt_' + attendance.id + '" value="' + attendance.check_out_time_gmt + '"/>';
            add_row += "</td>";
        } else {
            add_row += "<td>" + "---" + "</td>";
        }
        // if (attendance.time_slot_name != null && attendance.time_slot_name != '') {
        //     add_row += "<td>" + attendance.time_slot_name + "</td>";
        // } else {
        //     add_row += "<td>" + "---" + "</td>";
        // }
        add_row += "<td>" + attendance.status + "</td>";
        add_row += "<td>";
        add_row += "<button class='btn btn-secondary waves-effect waves-light' id='leave_" + attendance.id + "' onclick='updateManualAttendance(" + attendance.id + ")'>P</button>";
        add_row += "<button class='btn btn-warning waves-effect waves-light' id='leave_" + attendance.id + "' onclick='setLeave(" + attendance.id + ")'>L</button>";
        add_row += "</td>";
        add_row += "</tr>"

    }
}

function populateEmployeeAttendanceData(attendance, user) {
    if (document.getElementById('start_date').value != '') {
        attendance_date = new Date(attendance.date);
        start_date = new Date(document.getElementById('start_date').value);
        end_date = new Date(document.getElementById('end_date').value);
        if (attendance_date.getTime() >= start_date.getTime() && attendance_date.getTime() <= end_date.getTime()) {

            add_row += "<tr>";
            add_row += "<td>" + attendance.date_formated + "</td>";
            add_row += "<td>" + user.emp_code + "</td>";
            add_row += "<td>" + user.display_name + "</td>";
            add_row += "<td>" + user.mobile_no + "</td>";
            if (attendance.check_in_time_gmt != null && attendance.check_in_time_gmt != '') {
                // add_row += "<td>" + attendance.check_in_time_gmt + "</td>";
                add_row += "<td>";
                add_row += '<input class="form-control input-date-time" type="datetime" id="check_in_time_gmt_' + attendance.id + '" value="' + attendance.check_in_time_gmt + '"/>';
                add_row += "</td>";
            } else {
                add_row += "<td>" + "---" + "</td>";
            }
            if (attendance.check_out_time_gmt != null && attendance.check_out_time_gmt != '') {
                // add_row += "<td>" + attendance.check_out_time_gmt + "</td>";
                add_row += "<td>";
                add_row += '<input class="form-control input-date-time" type="datetime" id="check_out_time_gmt_' + attendance.id + '" value="' + attendance.check_out_time_gmt + '"/>';
                add_row += "</td>";
            } else {
                add_row += "<td>" + "---" + "</td>";
            }

            if (attendance.working_hours != null && attendance.working_hours != '') {
                add_row += "<td>" + attendance.working_hours + "</td>";
            } else {
                add_row += "<td>" + "---" + "</td>";
            }
            if (attendance.time_slot_name != null && attendance.time_slot_name != '') {
                add_row += "<td>" + attendance.time_slot_name + "</td>";
            } else {
                add_row += "<td>" + "---" + "</td>";
            }
            add_row += "<td>" + attendance.status + "</td>";
            add_row += "</tr>"
        }
    } else {

        add_row += "<tr>";
        add_row += "<td>" + attendance.date_formated + "</td>";
        add_row += "<td>" + user.emp_code + "</td>";
        add_row += "<td>" + user.display_name + "</td>";
        add_row += "<td>" + user.mobile_no + "</td>";
        if (attendance.check_in_time_gmt != null && attendance.check_in_time_gmt != '') {
            // add_row += "<td>" + attendance.check_in_time_gmt + "</td>";
            add_row += "<td>";
            add_row += '<input class="form-control input-date-time" type="datetime" id="check_in_time_gmt_' + attendance.id + '" value="' + attendance.check_in_time_gmt + '"/>';
            add_row += "</td>";
        } else {
            add_row += "<td>" + "---" + "</td>";
        }
        if (attendance.check_out_time_gmt != null && attendance.check_out_time_gmt != '') {
            // add_row += "<td>" + attendance.check_out_time_gmt + "</td>";
            add_row += "<td>";
            add_row += '<input class="form-control input-date-time" type="datetime" id="check_out_time_gmt_' + attendance.id + '" value="' + attendance.check_out_time_gmt + '"/>';
            add_row += "</td>";
        } else {
            add_row += "<td>" + "---" + "</td>";
        }
        if (attendance.working_hours != null && attendance.working_hours != '') {
            add_row += "<td>" + attendance.working_hours + "</td>";
        } else {
            add_row += "<td>" + "---" + "</td>";
        }
        if (attendance.time_slot_name != null && attendance.time_slot_name != '') {
            add_row += "<td>" + attendance.time_slot_name + "</td>";
        } else {
            add_row += "<td>" + "---" + "</td>";
        }
        add_row += "<td>" + attendance.status + "</td>";
        add_row += "</tr>"
    }
}

function renderTableColForInstalments() {
    var cols_html;
    cols_html = '<th>Old Roll No</th>';
    cols_html += '<th>Roll No</th>';
    cols_html += '<th>Student Name</th>';
    cols_html += '<th>Contact No.</th>';
    cols_html += '<th>Father Contact No.</th>';
    cols_html += '<th>Due Installment</th>';
    cols_html += '<th>Due Date</th>';
    $("thead tr").html(cols_html);

}

function populateTableForInstalmentGenerated(context, student, installment) {


    // var timeDiff = paid_d    ate.getTime() - due_date.getTime();
    if (document.getElementById('start_date').value != '') {
        due_date = new Date(installment.due_date);
        start_date = new Date(document.getElementById('start_date').value);
        end_date = new Date(document.getElementById('end_date').value);
        if (due_date.getTime() >= start_date.getTime() && due_date.getTime() <= end_date.getTime()) {

            add_row += "<tr>";
            add_row += "<td>" + student.roll_no + "</td>";
            add_row += "<td>" + student.old_roll_no + "</td>";
            add_row += "<td>" + student.student_name + "</td>";
            add_row += "<td>" + student.student_cell_no + "</td>";
            add_row += "<td>" + student.father_cell_no + "</td>";
            add_row += "<td>" + installment.amount_per_installment + "</td>";
            add_row += "<td>" + installment.due_date + "</td>";
            add_row += "</tr>"
        }
    } else {
        add_row += "<tr>";
        add_row += "<td>" + student.roll_no + "</td>";
        add_row += "<td>" + student.old_roll_no + "</td>";
        add_row += "<td>" + student.student_name + "</td>";
        add_row += "<td>" + student.student_cell_no + "</td>";
        add_row += "<td>" + installment.amount_per_installment + "</td>";
        add_row += "<td>" + installment.due_date + "</td>";
        add_row += "</tr>"
    }
}

function populateDataWithHead(student, student_head, heads) {

    // var timeDiff = paid_d    ate.getTime() - due_date.getTime();
    if (document.getElementById('start_date').value != '') {
        due_date = new Date(student_head.due_date);
        start_date = new Date(document.getElementById('start_date').value);
        end_date = new Date(document.getElementById('end_date').value);
        if (due_date.getTime() >= start_date.getTime() && due_date.getTime() <= end_date.getTime()) {
            var date_options = {
                year: 'numeric',
                month: 'short',
                day: 'numeric'
            };
            head_name = document.getElementById('head_id').options[document.getElementById('head_id').options.selectedIndex].innerText;
            head_id = document.getElementById('head_id').value;
            add_row += "<tr>";
            add_row += "<td>" + student.roll_no + "</td>";
            add_row += "<td>" + student.old_roll_no + "</td>";
            add_row += "<td>" + student.student_name + "</td>";
            add_row += "<td>" + student.admission_type + "</td>";
            add_row += "<td>" + student.session_name + "</td>";
            add_row += "<td>" + student.course_name + "</td>";
            add_row += "<td>" + student.section_name + "</td>";
            if (document.getElementById('payment_status_id').value != '' && document.getElementById('payment_status_id').value == 0) {
                if (student.student_cell_no != null && student.student_cell_no != '') {
                    add_row += "<td>" + student.student_cell_no + "</td>";
                } else {
                    add_row += "<td>" + '---' + "</td>";
                }
                if (student_head.head_name != null && student_head.head_name != '') {
                    add_row += "<td>" + student_head.head_name + "</td>";
                } else {
                    add_row += "<td>" + '---' + "</td>";
                }
                if (student_head.head_amount != null && student_head.head_amount != '') {
                    add_row += "<td>" + student_head.head_amount + "</td>";
                } else {
                    add_row += "<td>" + student_head.head_fine.amount + "</td>";
                }
                if (student_head.due_date != null && student_head.due_date != '') {
                    add_row += "<td>" + student_head.due_date + "</td>";
                } else {
                    add_row += "<td>" + '---' + "</td>";
                }
            }
            if (document.getElementById('payment_status_id').value != '' && document.getElementById('payment_status_id').value == 1) {
                if (student_head.paid_date != null && student_head.paid_date != '') {
                    add_row += "<td>" + student_head.paid_date + "</td>";
                } else {
                    add_row += "<td>" + '---' + "</td>";
                }
                if (student_head.amount_after_discount != null && student_head.amount_after_discount != '') {
                    add_row += "<td>" + student_head.amount_after_discount + "</td>";
                } else if (student_head.head_amount != null && student_head.head_amount != '') {
                    add_row += "<td>" + student_head.head_amount + "</td>";
                } else {
                    add_row += "<td>" + student_head.head_fine.amount + "</td>";
                }
                add_row += "<td>" + student_head.voucher_code + "</td>";
            }
            if (document.getElementById('payment_status_id').value == '') {
                if (student_head.head_name != null && student_head.head_name != '') {
                    add_row += "<td>" + student_head.head_name + "</td>";
                } else {
                    add_row += "<td>" + '---' + "</td>";
                }
                if (student_head.paid_date != null && student_head.paid_date != '') {
                    add_row += "<td>" + student_head.paid_date + "</td>";
                } else {
                    add_row += "<td>" + '---' + "</td>";
                }
                if (student_head.amount_after_discount != null && student_head.amount_after_discount != '') {
                    add_row += "<td>" + student_head.amount_after_discount + "</td>";
                } else if (student_head.head_amount != null && student_head.head_amount != '') {
                    add_row += "<td>" + student_head.head_amount + "</td>";
                } else {
                    add_row += "<td>" + student_head.head_fine.amount + "</td>";
                }
                add_row += "<td>" + student_head.voucher_code + "</td>";
                add_row += "<td>" + student_head.is_order_placed + "</td>";
                if (student_head.date_of_order_delivered != null && student_head.date_of_order_delivered != '') {
                    var date_of_order_delivered_obj = new Date(student_head.date_of_order_delivered);
                    add_row += "<td>" + date_of_order_delivered_obj.toLocaleDateString("en-US", date_options) + "</td>";
                } else {
                    add_row += "<td>" + '---' + "</td>";
                }
                if (head_name == 'book' || head_name == 'books' || head_name == 'publication' ||
                    head_name == 'publications' || head_name == 'Book' || head_name == 'Books' ||
                    head_name == 'Publication' || head_name == 'Publications') {
                    if (student.course.vendor_share_amount != null && student.course.vendor_share_amount != '') {
                        add_row += "<td>" + student.course.vendor_share_amount + "</td>";
                    } else {
                        add_row += "<td>" + '---' + "</td>";
                    }
                } else {
                    jQuery.each(heads, function(index, head) {
                        if (head.id == head_id) {
                            if (head.vendor_share_amount != null && head.vendor_share_amount != '') {
                                add_row += "<td>" + head.vendor_share_amount + "</td>";
                            } else {
                                add_row += "<td>" + '---' + "</td>";
                            }
                        }
                    });
                }
            }
            add_row += "</tr>"
        }
    } else {
        var date_options = {
            year: 'numeric',
            month: 'short',
            day: 'numeric'
        };
        head_name = document.getElementById('head_id').options[document.getElementById('head_id').options.selectedIndex].innerText;
        head_id = document.getElementById('head_id').value;
        add_row += "<tr>";
        add_row += "<td>" + student.roll_no + "</td>";
        add_row += "<td>" + student.old_roll_no + "</td>";
        add_row += "<td>" + student.student_name + "</td>";
        add_row += "<td>" + student.admission_type + "</td>";
        add_row += "<td>" + student.session_name + "</td>";
        add_row += "<td>" + student.course_name + "</td>";
        add_row += "<td>" + student.section_name + "</td>";
        if (document.getElementById('payment_status_id').value != '' && document.getElementById('payment_status_id').value == 0) {
            if (student.student_cell_no != null && student.student_cell_no != '') {
                add_row += "<td>" + student.student_cell_no + "</td>";
            } else {
                add_row += "<td>" + '---' + "</td>";
            }
            if (student_head.head_name != null && student_head.head_name != '') {
                add_row += "<td>" + student_head.head_name + "</td>";
            } else {
                add_row += "<td>" + '---' + "</td>";
            }
            if (student_head.amount_after_discount != null && student_head.amount_after_discount != '') {
                add_row += "<td>" + student_head.amount_after_discount + "</td>";
            } else if (student_head.head_amount != null && student_head.head_amount != '') {
                add_row += "<td>" + student_head.head_amount + "</td>";
            } else {
                add_row += "<td>" + student_head.head_fine.amount + "</td>";
            }
            if (student_head.due_date != null && student_head.due_date != '') {
                add_row += "<td>" + student_head.due_date + "</td>";
            } else {
                add_row += "<td>" + '---' + "</td>";
            }
        }
        if (document.getElementById('payment_status_id').value != '' && document.getElementById('payment_status_id').value == 1) {
            if (student_head.paid_date != null && student_head.paid_date != '') {
                add_row += "<td>" + student_head.paid_date + "</td>";
            } else {
                add_row += "<td>" + '---' + "</td>";
            }
            if (student_head.amount_after_discount != null && student_head.amount_after_discount != '') {
                add_row += "<td>" + student_head.amount_after_discount + "</td>";
            } else if (student_head.head_amount != null && student_head.head_amount != '') {
                add_row += "<td>" + student_head.head_amount + "</td>";
            } else {
                add_row += "<td>" + student_head.head_fine.amount + "</td>";
            }
            add_row += "<td>" + student_head.voucher_code + "</td>";
        }
        if (document.getElementById('payment_status_id').value == '') {
            if (student_head.head_name != null && student_head.head_name != '') {
                add_row += "<td>" + student_head.head_name + "</td>";
            } else {
                add_row += "<td>" + '---' + "</td>";
            }
            if (student_head.paid_date != null && student_head.paid_date != '') {
                add_row += "<td>" + student_head.paid_date + "</td>";
            } else {
                add_row += "<td>" + '---' + "</td>";
            }
            if (student_head.amount_after_discount != null && student_head.amount_after_discount != '') {
                add_row += "<td>" + student_head.amount_after_discount + "</td>";
            } else if (student_head.head_amount != null && student_head.head_amount != '') {
                add_row += "<td>" + student_head.head_amount + "</td>";
            } else {
                add_row += "<td>" + student_head.head_fine.amount + "</td>";
            }
            add_row += "<td>" + student_head.voucher_code + "</td>";
            add_row += "<td>" + student_head.is_order_placed + "</td>";
            if (student_head.date_of_order_delivered != null && student_head.date_of_order_delivered != '') {
                var date_of_order_delivered_obj = new Date(student_head.date_of_order_delivered);
                add_row += "<td>" + date_of_order_delivered_obj.toLocaleDateString("en-US", date_options) + "</td>";
            } else {
                add_row += "<td>" + '---' + "</td>";
            }
            if (head_name == 'book' || head_name == 'books' || head_name == 'publication' ||
                head_name == 'publications' || head_name == 'Book' || head_name == 'Books' ||
                head_name == 'Publication' || head_name == 'Publications') {
                if (student.course.vendor_share_amount != null && student.course.vendor_share_amount != '') {
                    add_row += "<td>" + student.course.vendor_share_amount + "</td>";
                } else {
                    add_row += "<td>" + '---' + "</td>";
                }
            } else {
                jQuery.each(heads, function(index, head) {
                    if (head.id == head_id) {
                        if (head.vendor_share_amount != null && head.vendor_share_amount != '') {
                            add_row += "<td>" + head.vendor_share_amount + "</td>";
                        } else {
                            add_row += "<td>" + '---' + "</td>";
                        }
                    }
                });
            }
        }
        add_row += "</tr>"
    }
}