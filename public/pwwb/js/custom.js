var myData = '';
var serachDataResult = '';
$('.select2').select2();
$(document).ready(function() {
    $('#table_id').DataTable();
});
var GridView = $('#table_id').DataTable({});
$('#table_id').show();
GridView.columns.adjust().draw();
$(document).ready(function() {
    $('#example').DataTable();
});
$(document).ready(function() {
    var districtSearchFilter = '';
    var priorityofsubmission = '';
    var wingSearchFilter = '';
    var courseSearchFilter = '';
    var courseEnrollerdInSearchFilter = '';
    var courseRegisteredInSearchFilter = '';
    var courseaffiliatedbody = '';
    var courseaffiliatedbody = '';
    var pwwbtransportfacility = '';
    var pwwbhostelfacility = '';
    var provisionalclaimstatus = '';
    var pwwbacademicterm = '';
    var table = $("#my_home").DataTable({
        "dom": 'Bfrtip',
        "processing": true,
        "serverSide": true,
        "pageLength": 10,
        "pagingType": "full_numbers",
        "scrollX": true,
        "scrollY": 950,
        //   dom: 'Bfrtip',
        // buttons: [
        //     {
        //     extend: 'excel',
        //     text:   'Filter Wise Export',
        //     // function () { return getExportFileName();},
        //     exportOptions: {
        //           modifier: {
        //           page: 'all',
        //           search: 'none'   
        //         }
        //     }
        // }
        // ],
        "createdRow": function(row, data, index) {
            var id = table.page.info();
            $('td', row).eq(0).html(index + 1 + id.page * id.length);
        },
        ajax: {
            type: "get",
            url: "/fillHomePage",
            data: function(data) {
                districtSearchFilter = $('#districtSearchFilter').val();
                priorityofsubmission = $('#priorityofsubmission').val();
                wingSearchFilter = $('#wingSearchFilter').val();
                courseSearchFilter = $('#courseSearchFilter').val();
                courseEnrollerdInSearchFilter = $('#courseEnrollerdInSearchFilter').val();
                courseRegisteredInSearchFilter = $('#courseRegisteredInSearchFilter').val();
                courseaffiliatedbody = $('#courseaffiliatedbody').val();
                courseaffiliatedbody = $('#courseaffiliatedbody').val();
                pwwbtransportfacility = $('#pwwbtransportfacility').val();
                pwwbhostelfacility = $('#pwwbhostelfacility').val();
                provisionalclaimstatus = $('#provisionalclaimstatus').val();
                pwwbacademicterm = $('#pwwbacademicterm').val();
                serachDataResult = $('.dataTables_filter input').val();
                if (districtSearchFilter == '') {
                    districtSearchFilter = 'nulled_sent';
                }
                if (priorityofsubmission == '') {
                    priorityofsubmission = 'nulled_sent';
                }
                if (wingSearchFilter == '') {
                    wingSearchFilter = 'nulled_sent';
                }
                if (courseSearchFilter == '') {
                    courseSearchFilter = 'nulled_sent';
                }
                if (courseEnrollerdInSearchFilter == '') {
                    courseEnrollerdInSearchFilter = 'nulled_sent';
                }
                if (courseRegisteredInSearchFilter == '') {
                    courseRegisteredInSearchFilter = 'nulled_sent';
                }
                if (courseaffiliatedbody == '') {
                    courseaffiliatedbody = 'nulled_sent';
                }
                if (pwwbtransportfacility == '') {
                    pwwbtransportfacility = 'nulled_sent';
                }
                if (pwwbhostelfacility == '') {
                    pwwbhostelfacility = 'nulled_sent';
                }
                if (provisionalclaimstatus == '') {
                    provisionalclaimstatus = 'nulled_sent';
                }
                if (pwwbacademicterm == '') {
                    pwwbacademicterm = 'nulled_sent';
                }
                if (serachDataResult == '') {
                    serachDataResult = 'nulled_sent';
                }
                var district = $('#districtSearchFilter').val();
                data.districtSearchFilter = district;
                var priority_of_submission = $('#priorityofsubmission').val();
                data.priorityofsubmission = priority_of_submission;
                var wing_Search_Filter = $('#wingSearchFilter').val();
                data.wingSearchFilter = wing_Search_Filter;
                var course_Search_Filter = $('#courseSearchFilter').val();
                data.courseSearchFilter = course_Search_Filter;
                var course_EnrollerdIn_Filter = $('#courseEnrollerdInSearchFilter').val();
                data.courseEnrollerdInSearchFilter = course_EnrollerdIn_Filter;
                var course_RegisteredIn_Filter = $('#courseRegisteredInSearchFilter').val();
                data.courseRegisteredInSearchFilter = course_RegisteredIn_Filter;
                var course_affiliated_body = $('#courseaffiliatedbody').val();
                data.courseaffiliatedbody = course_affiliated_body;
                var course_affiliated_body = $('#courseaffiliatedbody').val();
                data.courseaffiliatedbody = course_affiliated_body;
                var pwwb_transport_facility = $('#pwwbtransportfacility').val();
                data.pwwbtransportfacility = pwwb_transport_facility;
                var pwwb_hostel_facility = $('#pwwbhostelfacility').val();
                data.pwwbhostelfacility = pwwb_hostel_facility;
                var provisional_claim_status = $('#provisionalclaimstatus').val();
                data.provisionalclaimstatus = provisional_claim_status;
                var pwwb_academic_term = $('#pwwbacademicterm').val();
                if (pwwb_academic_term == 0) {
                    pwwb_academic_term = '2';
                }
                data.pwwbacademicterm = pwwb_academic_term;
                if (pwwb_academic_term == '2') {
                    $('#forannual').show();
                    $('#forsemester').hide();
                } else if (pwwb_academic_term == '1') {
                    $('#forannual').hide();
                    $('#forsemester').show();
                }
                var pwwb_academicterm_annual = $('#pwwbacademictermannual').val();
                data.pwwbacademictermannual = pwwb_academicterm_annual;
                var pwwb_academicterm_semester = $('#pwwbacademictermsemester').val();
                data.pwwbacademictermsemester = pwwb_academicterm_semester;
                // Dates.
                var dataEntry_DateEnd = $('#dataEntryDateEnd').val();
                data.dataEntryDateEnd = dataEntry_DateEnd;
                var dataEntryDate_Start = $('#dataEntryDateStart').val();
                data.dataEntryDateStart = dataEntryDate_Start;
                // Date 2..
                var submission_DateStart = $('#submissionDateStart').val();
                data.submissionDateStart = submission_DateStart;
                var submissionDate_End = $('#submissionDateEnd').val();
                data.submissionDateEnd = submissionDate_End;
                var resultSearch_Filter = $('#resultSearchFilter').val();

                var return_files = $('#return_files').val();
                data.returnFiles = return_files;

                if (resultSearch_Filter == 0) {
                    resultSearch_Filter = '2';
                }
                data.resultSearchFilter = resultSearch_Filter;
                data.serachDataResult = serachDataResult;
                // alert(resultSearch_Filter);
            },
            complete: function(response) {
                // console.log(JSON.stringify(response));
                // myData = JSON.stringify(response);
                // alert(myData);
                var newURL = districtSearchFilter + '/' + priorityofsubmission + '/' + wingSearchFilter + '/' + courseSearchFilter + '/' + courseEnrollerdInSearchFilter + '/' + courseRegisteredInSearchFilter + '/' + courseaffiliatedbody + '/' + pwwbtransportfacility + '/' + pwwbhostelfacility + '/' + provisionalclaimstatus + '/' + pwwbacademicterm + '/' + serachDataResult;
                $("#clickButton").attr("href", "/recordsExportCSV/" + newURL);
                var newURLFilter = districtSearchFilter + '/' + priorityofsubmission + '/' + wingSearchFilter + '/' + courseSearchFilter + '/' + courseEnrollerdInSearchFilter + '/' + courseRegisteredInSearchFilter + '/' + courseaffiliatedbody + '/' + pwwbtransportfacility + '/' + pwwbhostelfacility + '/' + provisionalclaimstatus + '/' + pwwbacademicterm + '/' + serachDataResult;
                $("#clickButtonFilter").attr("href", "/recordsExportCSVFilter/" + newURLFilter);
            },
        },
        columns: [{
                data: 'id'
            }, {
                data: 'roll_no'
            }, {
                data: 'district'
            }, {
                data: 'file_received_number'
            }, {
                data: 'file_module_number'
            }, {
                data: 'fresh_file_submission_in_pwwb_number'
            }, {
                data: 'priority_of_submission'
            }, {
                data: 'receiving_date'
            }, {
                data: 'worker_name'
            }, {
                data: 'worker_cnic'
            }, {
                data: 'factory_name'
            }, {
                data: 'name'
            }, {
                data: 'cnic_no'
            },
            // { data: 'bus_stop' } ,
            // { data: 'hostel_name' } ,
            {
                data: 'wings_short_name'
            }, {
                data: 'affiliated_bodies_code'
            }, {
                data: 'course_applied_in'
            }, {
                data: 'course_registered_in'
            }, {
                data: 'course_enrolled_in'
            },
            // { data: 'student_contact_relationship' } ,
            {
                data: 'self_contact'
            }, {
                data: 'father_contact'
            }, {
                data: 'transport_facility'
            }, {
                data: 'hostel_facility'
            }, {



                render: function(data, type, row) {
                    // alert(row['return_file_pwwb']);
                    if(row['return_file_pwwb'] != 1){
                        if (row["admitted"] == '1') {
                        data = `<div class="dropdown"><a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <button class='btn btn-primary btn-sm dropdown-item view' ${!viewPermission ? 'hidden' : '' }><i class='fa fa-eye'></i> View</button> <button class='btn btn-success btn-sm dropdown-item bonified_certificate'><i class='fa fa-envelope-open-text fa-fw'></i> Bonafide Certificate</button> 
                                <button class='btn btn-success btn-sm dropdown-item admission_offer_letter'><i class='fa fa-envelope-open fa-fw'></i> Admission Offer Letter</button> 
                                <button class='btn btn-success btn-sm dropdown-item claim_letter'><i class='fa fa-envelope fa-fw'></i> Claim Letter</button></div></div>`;
                        } else if (row["admitted"] == '0' && row["is_dsm"] == '1') {
                            if (dsmPrivileges) {
                                data = `<div class="dropdown"><a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">                            
                                <button class='btn btn-primary btn-sm dropdown-item view' ${!viewPermission ? 'hidden' : '' }><i class='fa fa-eye'></i> View</button> <button class='btn btn-warning btn-sm dropdown-item edit' ${!updatePermission ? 'hidden' : '' }><i class='fa fa-edit'></i> Edit</button> <button class='btn btn-danger btn-sm dropdown-item delete' ${!destroyPermission ? 'hidden' : '' }><i class='fa fa-trash fa-fw'></i> Remove</button><button class='btn btn-success btn-sm dropdown-item bonified_certificate'><i class='fa fa-envelope-open-text fa-fw'></i> Bonafide Certificate</button> 
                                    <button class='btn btn-success btn-sm dropdown-item admission_offer_letter'><i class='fa fa-envelope-open fa-fw'></i> Admission Offer Letter</button> 
                                    <button class='btn btn-success btn-sm dropdown-item claim_letter'><i class='fa fa-envelope fa-fw'></i> Claim Letter</button></div></div>`;
                            } else {
                                data = `<div class="dropdown"><a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <button class='btn btn-primary btn-sm dropdown-item view' ${!viewPermission ? 'hidden' : '' }><i class='fa fa-eye'></i> View</button> <button class='btn btn-success btn-sm dropdown-item bonified_certificate'><i class='fa fa-envelope-open-text fa-fw'></i> Bonafide Certificate</button> 
                                    <button class='btn btn-success btn-sm dropdown-item admission_offer_letter'><i class='fa fa-envelope-open fa-fw'></i> Admission Offer Letter</button> 
                                    <button class='btn btn-success btn-sm dropdown-item claim_letter'><i class='fa fa-envelope fa-fw'></i> Claim Letter</button></div></div>`;
                            }
                        } else if (row["admitted"] == '1' && row['is_dsm'] == '1') {
                            data = `<div class="dropdown"><a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <button class='btn btn-primary btn-sm dropdown-item view' ${!viewPermission ? 'hidden' : '' }><i class='fa fa-eye'></i> View</button> <button class='btn btn-success btn-sm dropdown-item bonified_certificate'><i class='fa fa-envelope-open-text fa-fw'></i> Bonafide Certificate</button> 
                                    <button class='btn btn-success btn-sm dropdown-item admission_offer_letter'><i class='fa fa-envelope-open fa-fw'></i> Admission Offer Letter</button> 
                                    <button class='btn btn-success btn-sm dropdown-item claim_letter'><i class='fa fa-envelope fa-fw'></i> Claim Letter</button></div></div>`;
                        } else {                        
                            data = `<div class="dropdown"><a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <button class='btn btn-primary btn-sm dropdown-item view' ${!viewPermission ? 'hidden' : '' }><i class='fa fa-eye'></i> View</button> <button class='btn btn-warning btn-sm dropdown-item edit' ${!updatePermission ? 'hidden' : '' }><i class='fa fa-edit'></i> Edit</button> <button class='btn btn-danger btn-sm dropdown-item delete' ${!destroyPermission ? 'hidden' : '' }><i class='fa fa-trash fa-fw'></i> Remove</button> <button class='btn btn-success btn-sm dropdown-item move'><i class='fa fa-arrow-right fa-fw'></i> Move To DSM</button> <button class='btn btn-success btn-sm dropdown-item bonified_certificate'><i class='fa fa-envelope-open-text fa-fw'></i> Bonafide Certificate</button> 
                                    <button class='btn btn-success btn-sm dropdown-item admission_offer_letter'><i class='fa fa-envelope-open fa-fw'></i> Admission Offer Letter</button> 
                                    <button class='btn btn-success btn-sm dropdown-item claim_letter'><i class='fa fa-envelope fa-fw'></i> Claim Letter</button> </div></div>`;   
                        }
                    }else{
                        data = `<div class="dropdown"><a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <button class='btn btn-primary btn-sm dropdown-item view' ${!viewPermission ? 'hidden' : '' }><i class='fa fa-eye'></i> View</button>  
                                 
                                </div></div>`;
                    }
                    
                    return data;                
                }
            },
        ],
        columnDefs: []
    });
    $('#my_home tbody').on('click', 'button.view', function() {
        var data = table.row($(this).parents('tr')).data();
        // alert( data['id'] +"'s salary is: "+ data[ 5 ] );
        window.location.href = '/view-record/' + data['id'];
    });
    $('#my_home tbody').on('click', 'button.edit', function() {
        var data = table.row($(this).parents('tr')).data();
        // alert( data['id'] +"'s salary is: "+ data[ 5 ] );
        window.location.href = '/edit-record/' + data['id'];
    });
    $('#my_home tbody').on('click', 'button.delete', function() {
        var data = table.row($(this).parents('tr')).data();
        // alert( data['id'] +"'s salary is: "+ data[ 5 ] );
        if (confirm('Are you sure you want to remove the record from database?')) {
            // Save it!
            window.location.href = '/delete-record/' + data['id'];
            console.log('Record removed.');
        } else {
            // Do nothing!
            console.log('Canceled.');
        }
    });
    $('#my_home tbody').on('click', 'button.move', function() {
        var data = table.row($(this).parents('tr')).data();
        // alert( data['id'] +"'s salary is: "+ data[ 5 ] );
        window.location.href = '/move-record/' + data['id'];
    });

    // bonified_certificate
    $('#my_home tbody').on('click', 'button.bonified_certificate', function() {
        var data = table.row($(this).parents('tr')).data();
        // alert( data['id'] +"'s salary is: "+ data[ 5 ] );
        window.location.href = '/bonified-certificate/' + data['id'];
    }); 

    // Admission Offer Letter
    $('#my_home tbody').on('click', 'button.admission_offer_letter', function() {
        var data = table.row($(this).parents('tr')).data();
        // alert( data['id'] +"'s salary is: "+ data[ 5 ] );
        window.location.href = '/admission-offer-letter/' + data['id'];
    });
    // Claim Letter
    $('#my_home tbody').on('click', 'button.claim_letter', function() {
        var data = table.row($(this).parents('tr')).data();
        // alert( data['id'] +"'s salary is: "+ data[ 5 ] );
        window.location.href = '/claim-letter/' + data['id'];
    });

    //To Add Campus .. Temporery...
    $('#my_home tbody').on('click', 'button.selectCampuus', function() {
        var data = table.row($(this).parents('tr')).data();
        // alert( data['id'] +"'s salary is: "+ data[ 5 ] );
        window.location.href = '/select-campus/' + data['id'];
    });
    $('#clickButton').click(function() {
        // table.draw();
        getExportData();
    });
    $('#clickButtonFilter').click(function() {
        // table.draw();
        getExportDataFilterWise();
    });
    $('#districtSearchFilter').change(function() {
        table.draw();
    });
    $('#priorityofsubmission').change(function() {
        table.draw();
    });
    $('#wingSearchFilter').change(function() {
        table.draw();
    });
    $('#courseSearchFilter').change(function() {
        table.draw();
    });
    $('#courseEnrollerdInSearchFilter').change(function() {
        table.draw();
    });
    $('#courseRegisteredInSearchFilter').change(function() {
        table.draw();
    });
    $('#courseaffiliatedbody').change(function() {
        table.draw();
    });
    $('#courseaffiliatedbody').change(function() {
        table.draw();
    });
    $('#pwwbtransportfacility').change(function() {
        table.draw();
    });
    $('#pwwbhostelfacility').change(function() {
        table.draw();
    });
    $('#provisionalclaimstatus').change(function() {
        table.draw();
    });
    $('#provisionalclaimstatus').change(function() {
        table.draw();
    });
    $('#pwwbacademicterm').change(function() {
        table.draw();
    });
    $('#pwwbacademictermannual').change(function() {
        table.draw();
    });
    $('#pwwbacademictermsemester').change(function() {
        table.draw();
    });
    $('#resultSearchFilter').change(function() {
        table.draw();
    });
    // Dates ...
    $('#dataEntryDateEnd').click(function() {
        table.draw();
    });
    $('#dataEntryDateStart').click(function() {
        table.draw();
    });
    $('#dataEntryDateEnd').blur(function() {
        table.draw();
    });
    $('#dataEntryDateStart').blur(function() {
        table.draw();
    });
    $('#dataEntryDateEnd').keyup(function() {
        table.draw();
    });
    $('#dataEntryDateStart').keyup(function() {
        table.draw();
    });
    $('#dataEntryDateEnd').change(function() {
        table.draw();
    });
    $('#dataEntryDateStart').change(function() {
        table.draw();
    });
    // Date 2..
    $('#submissionDateStart').click(function() {
        table.draw();
    });
    $('#submissionDateEnd').click(function() {
        table.draw();
    });
    $('#submissionDateStart').blur(function() {
        table.draw();
    });
    $('#submissionDateEnd').blur(function() {
        table.draw();
    });
    $('#submissionDateStart').keyup(function() {
        table.draw();
    });
    $('#submissionDateEnd').keyup(function() {
        table.draw();
    });
    $('#submissionDateEnd').change(function() {
        table.draw();
    });
    $('#submissionDateStart').change(function() {
        table.draw();
    });
     $('#return_files').change(function() {
        table.draw();
    });
});

function getExportDataFilterWise() {
    var districtSearchFilter = '';
    var priorityofsubmission = '';
    var wingSearchFilter = '';
    var courseSearchFilter = '';
    var courseEnrollerdInSearchFilter = '';
    var courseRegisteredInSearchFilter = '';
    var courseaffiliatedbody = '';
    var courseaffiliatedbody = '';
    var pwwbtransportfacility = '';
    var pwwbhostelfacility = '';
    var provisionalclaimstatus = '';
    var pwwbacademicterm = '';
    var searchMy = '';
    districtSearchFilter = $('#districtSearchFilter').val();
    priorityofsubmission = $('#priorityofsubmission').val();
    wingSearchFilter = $('#wingSearchFilter').val();
    courseSearchFilter = $('#courseSearchFilter').val();
    courseEnrollerdInSearchFilter = $('#courseEnrollerdInSearchFilter').val();
    courseRegisteredInSearchFilter = $('#courseRegisteredInSearchFilter').val();
    courseaffiliatedbody = $('#courseaffiliatedbody').val();
    courseaffiliatedbody = $('#courseaffiliatedbody').val();
    pwwbtransportfacility = $('#pwwbtransportfacility').val();
    pwwbhostelfacility = $('#pwwbhostelfacility').val();
    provisionalclaimstatus = $('#provisionalclaimstatus').val();
    pwwbacademicterm = $('#pwwbacademicterm').val();
    searchMy = serachDataResult;
    if (districtSearchFilter == '') {
        districtSearchFilter = 'nulled_sent'
    }
    if (priorityofsubmission == '') {
        priorityofsubmission = 'nulled_sent'
    }
    if (wingSearchFilter == '') {
        wingSearchFilter = 'nulled_sent'
    }
    if (courseSearchFilter == '') {
        courseSearchFilter = 'nulled_sent'
    }
    if (courseEnrollerdInSearchFilter == '') {
        courseEnrollerdInSearchFilter = 'nulled_sent'
    }
    if (courseRegisteredInSearchFilter == '') {
        courseRegisteredInSearchFilter = 'nulled_sent'
    }
    if (courseaffiliatedbody == '') {
        courseaffiliatedbody = 'nulled_sent'
    }
    if (pwwbtransportfacility == '') {
        pwwbtransportfacility = 'nulled_sent'
    }
    if (pwwbhostelfacility == '') {
        pwwbhostelfacility = 'nulled_sent'
    }
    if (provisionalclaimstatus == '') {
        provisionalclaimstatus = 'nulled_sent'
    }
    if (pwwbacademicterm == '') {
        pwwbacademicterm = 'nulled_sent'
    }
    if (searchMy == '') {
        searchMy = 'nulled_sent'
    }
    if (pwwbacademicterm == 0) {
        pwwbacademicterm = '2';
    }
    if (pwwbacademicterm == '2') {
        $('#forannual').show();
        $('#forsemester').hide();
    } else if (pwwbacademicterm == '1') {
        $('#forannual').hide();
        $('#forsemester').show();
    }
    var pwwb_academicterm_annual = $('#pwwbacademictermannual').val();
    var pwwb_academicterm_semester = $('#pwwbacademictermsemester').val();
    // Dates.
    var dataEntry_DateEnd = $('#dataEntryDateEnd').val();
    var dataEntryDate_Start = $('#dataEntryDateStart').val();
    // Date 2..
    var submission_DateStart = $('#submissionDateStart').val();
    var submissionDate_End = $('#submissionDateEnd').val();
    var resultSearch_Filter = $('#resultSearchFilter').val();
    if (resultSearch_Filter == 0) {
        resultSearch_Filter = '2';
    }
    var obj = {
        "districtSearchFilter": districtSearchFilter,
        "priorityofsubmission": priorityofsubmission,
        "wingSearchFilter": wingSearchFilter,
        "courseSearchFilter": courseSearchFilter,
        "courseEnrollerdInSearchFilter": courseEnrollerdInSearchFilter,
        "courseRegisteredInSearchFilter": courseRegisteredInSearchFilter,
        "courseaffiliatedbody": courseaffiliatedbody,
        "courseaffiliatedbody": courseaffiliatedbody,
        "pwwbtransportfacility": pwwbtransportfacility,
        "pwwbhostelfacility": pwwbhostelfacility,
        "provisionalclaimstatus": provisionalclaimstatus,
        "pwwbacademicterm": pwwbacademicterm,
        "searchMy": searchMy,
    };
    $.ajax({
        type: 'GET',
        url: '/recordsExport',
        // data:'_token = <?php echo csrf_token() ?>',
        responseType: 'blob', // important
        data: {
            districtSearchFilter: districtSearchFilter,
            priorityofsubmission: priorityofsubmission,
            wingSearchFilter: wingSearchFilter,
            courseSearchFilter: courseSearchFilter,
            courseEnrollerdInSearchFilter: courseEnrollerdInSearchFilter,
            courseRegisteredInSearchFilter: courseRegisteredInSearchFilter,
            courseaffiliatedbody: courseaffiliatedbody,
            courseaffiliatedbody: courseaffiliatedbody,
            pwwbtransportfacility: pwwbtransportfacility,
            pwwbhostelfacility: pwwbhostelfacility,
            provisionalclaimstatus: provisionalclaimstatus,
            pwwbacademicterm: pwwbacademicterm,
            searchMy: searchMy,
        },
        success: function(data) {
            console.log('My Rst SUccess');
            console.log(obj);
            // window.location.href = '/recordsExportCSV/'+obj.serialize();
            var newURL = districtSearchFilter + '/' + priorityofsubmission + '/' + wingSearchFilter + '/' + courseSearchFilter + '/' + courseEnrollerdInSearchFilter + '/' + courseRegisteredInSearchFilter + '/' + courseaffiliatedbody + '/' + pwwbtransportfacility + '/' + pwwbhostelfacility + '/' + provisionalclaimstatus + '/' + pwwbacademicterm + '/' + searchMy;
            $("#clickButton").attr("href", "/recordsExportCSV/" + newURL);
            var newURLFilter = districtSearchFilter + '/' + priorityofsubmission + '/' + wingSearchFilter + '/' + courseSearchFilter + '/' + courseEnrollerdInSearchFilter + '/' + courseRegisteredInSearchFilter + '/' + courseaffiliatedbody + '/' + pwwbtransportfacility + '/' + pwwbhostelfacility + '/' + provisionalclaimstatus + '/' + pwwbacademicterm + '/' + searchMy;
            $("#clickButtonFilter").attr("href", "/recordsExportCSVFilter/" + newURLFilter);
        },
        error: function(data) {
            console.log('My Rst Error');
        }
    });
    var query = {
        location: $('#location').val(),
        area: $('#area').val(),
        booth: $('#booth').val()
    }
}

function getExportData() {
    var districtSearchFilter = '';
    var priorityofsubmission = '';
    var wingSearchFilter = '';
    var courseSearchFilter = '';
    var courseEnrollerdInSearchFilter = '';
    var courseRegisteredInSearchFilter = '';
    var courseaffiliatedbody = '';
    var courseaffiliatedbody = '';
    var pwwbtransportfacility = '';
    var pwwbhostelfacility = '';
    var provisionalclaimstatus = '';
    var pwwbacademicterm = '';
    var searchMy = '';
    districtSearchFilter = $('#districtSearchFilter').val();
    priorityofsubmission = $('#priorityofsubmission').val();
    wingSearchFilter = $('#wingSearchFilter').val();
    courseSearchFilter = $('#courseSearchFilter').val();
    courseEnrollerdInSearchFilter = $('#courseEnrollerdInSearchFilter').val();
    courseRegisteredInSearchFilter = $('#courseRegisteredInSearchFilter').val();
    courseaffiliatedbody = $('#courseaffiliatedbody').val();
    courseaffiliatedbody = $('#courseaffiliatedbody').val();
    pwwbtransportfacility = $('#pwwbtransportfacility').val();
    pwwbhostelfacility = $('#pwwbhostelfacility').val();
    provisionalclaimstatus = $('#provisionalclaimstatus').val();
    pwwbacademicterm = $('#pwwbacademicterm').val();
    searchMy = serachDataResult;
    if (districtSearchFilter == '') {
        districtSearchFilter = 'nulled_sent'
    }
    if (priorityofsubmission == '') {
        priorityofsubmission = 'nulled_sent'
    }
    if (wingSearchFilter == '') {
        wingSearchFilter = 'nulled_sent'
    }
    if (courseSearchFilter == '') {
        courseSearchFilter = 'nulled_sent'
    }
    if (courseEnrollerdInSearchFilter == '') {
        courseEnrollerdInSearchFilter = 'nulled_sent'
    }
    if (courseRegisteredInSearchFilter == '') {
        courseRegisteredInSearchFilter = 'nulled_sent'
    }
    if (courseaffiliatedbody == '') {
        courseaffiliatedbody = 'nulled_sent'
    }
    if (pwwbtransportfacility == '') {
        pwwbtransportfacility = 'nulled_sent'
    }
    if (pwwbhostelfacility == '') {
        pwwbhostelfacility = 'nulled_sent'
    }
    if (provisionalclaimstatus == '') {
        provisionalclaimstatus = 'nulled_sent'
    }
    if (pwwbacademicterm == '') {
        pwwbacademicterm = 'nulled_sent'
    }
    if (searchMy == '') {
        searchMy = 'nulled_sent'
    }
    if (pwwbacademicterm == 0) {
        pwwbacademicterm = '2';
    }
    if (pwwbacademicterm == '2') {
        $('#forannual').show();
        $('#forsemester').hide();
    } else if (pwwbacademicterm == '1') {
        $('#forannual').hide();
        $('#forsemester').show();
    }
    var pwwb_academicterm_annual = $('#pwwbacademictermannual').val();
    var pwwb_academicterm_semester = $('#pwwbacademictermsemester').val();
    // Dates.
    var dataEntry_DateEnd = $('#dataEntryDateEnd').val();
    var dataEntryDate_Start = $('#dataEntryDateStart').val();
    // Date 2..
    var submission_DateStart = $('#submissionDateStart').val();
    var submissionDate_End = $('#submissionDateEnd').val();
    var resultSearch_Filter = $('#resultSearchFilter').val();
    if (resultSearch_Filter == 0) {
        resultSearch_Filter = '2';
    }
    var obj = {
        "districtSearchFilter": districtSearchFilter,
        "priorityofsubmission": priorityofsubmission,
        "wingSearchFilter": wingSearchFilter,
        "courseSearchFilter": courseSearchFilter,
        "courseEnrollerdInSearchFilter": courseEnrollerdInSearchFilter,
        "courseRegisteredInSearchFilter": courseRegisteredInSearchFilter,
        "courseaffiliatedbody": courseaffiliatedbody,
        "courseaffiliatedbody": courseaffiliatedbody,
        "pwwbtransportfacility": pwwbtransportfacility,
        "pwwbhostelfacility": pwwbhostelfacility,
        "provisionalclaimstatus": provisionalclaimstatus,
        "pwwbacademicterm": pwwbacademicterm,
        "searchMy": searchMy,
    };
    $.ajax({
        type: 'GET',
        url: '/recordsExport',
        // data:'_token = <?php echo csrf_token() ?>',
        responseType: 'blob', // important
        data: {
            districtSearchFilter: districtSearchFilter,
            priorityofsubmission: priorityofsubmission,
            wingSearchFilter: wingSearchFilter,
            courseSearchFilter: courseSearchFilter,
            courseEnrollerdInSearchFilter: courseEnrollerdInSearchFilter,
            courseRegisteredInSearchFilter: courseRegisteredInSearchFilter,
            courseaffiliatedbody: courseaffiliatedbody,
            courseaffiliatedbody: courseaffiliatedbody,
            pwwbtransportfacility: pwwbtransportfacility,
            pwwbhostelfacility: pwwbhostelfacility,
            provisionalclaimstatus: provisionalclaimstatus,
            pwwbacademicterm: pwwbacademicterm,
            searchMy: searchMy,
        },
        success: function(data) {
            console.log('My Rst SUccess');
            console.log(obj);
            alert();
            // window.location.href = '/recordsExportCSV/'+obj.serialize();
            var newURL = districtSearchFilter + '/' + priorityofsubmission + '/' + wingSearchFilter + '/' + courseSearchFilter + '/' + courseEnrollerdInSearchFilter + '/' + courseRegisteredInSearchFilter + '/' + courseaffiliatedbody + '/' + pwwbtransportfacility + '/' + pwwbhostelfacility + '/' + provisionalclaimstatus + '/' + pwwbacademicterm + '/' + searchMy;
            $("#clickButton").attr("href", "/recordsExportCSV/" + newURL)
        },
        error: function(data) {
            console.log('My Rst Error');
        }
    });
    var query = {
        location: $('#location').val(),
        area: $('#area').val(),
        booth: $('#booth').val()
    }
}
// }).then((response) => {
//         alert();
//         const url = window.URL.createObjectURL(new Blob([response.data]));
//         const link = document.createElement('a');
//         link.setAttribute('PwwbRecordList', 'PwwbRecordList.xlsx');
//         document.body.appendChild(link);
//         link.click();
// onClick button in Home Page View File...
function recordsExport() {
    var table = $("#my_home").DataTable({
        "createdRow": function(row, data, index) {
            var id = table.page.info();
            $('td', row).eq(0).html(index + 1 + id.page * id.length);
        },
        ajax: {
            type: "get",
            url: "/recordsExport",
            data: function(data) {
                var district = $('#districtSearchFilter').val();
                data.districtSearchFilter = district;
                var priority_of_submission = $('#priorityofsubmission').val();
                data.priorityofsubmission = priority_of_submission;
                var wing_Search_Filter = $('#wingSearchFilter').val();
                data.wingSearchFilter = wing_Search_Filter;
                var course_Search_Filter = $('#courseSearchFilter').val();
                data.courseSearchFilter = course_Search_Filter;
                var course_EnrollerdIn_Filter = $('#courseEnrollerdInSearchFilter').val();
                data.courseEnrollerdInSearchFilter = course_EnrollerdIn_Filter;
                var course_RegisteredIn_Filter = $('#courseRegisteredInSearchFilter').val();
                data.courseRegisteredInSearchFilter = course_RegisteredIn_Filter;
                var course_affiliated_body = $('#courseaffiliatedbody').val();
                data.courseaffiliatedbody = course_affiliated_body;
                var course_affiliated_body = $('#courseaffiliatedbody').val();
                data.courseaffiliatedbody = course_affiliated_body;
                var pwwb_transport_facility = $('#pwwbtransportfacility').val();
                data.pwwbtransportfacility = pwwb_transport_facility;
                var pwwb_hostel_facility = $('#pwwbhostelfacility').val();
                data.pwwbhostelfacility = pwwb_hostel_facility;
                var provisional_claim_status = $('#provisionalclaimstatus').val();
                data.provisionalclaimstatus = provisional_claim_status;
                var pwwb_academic_term = $('#pwwbacademicterm').val();
                if (pwwb_academic_term == 0) {
                    pwwb_academic_term = '2';
                }
                data.pwwbacademicterm = pwwb_academic_term;
                if (pwwb_academic_term == '2') {
                    $('#forannual').show();
                    $('#forsemester').hide();
                } else if (pwwb_academic_term == '1') {
                    $('#forannual').hide();
                    $('#forsemester').show();
                }
                var pwwb_academicterm_annual = $('#pwwbacademictermannual').val();
                data.pwwbacademictermannual = pwwb_academicterm_annual;
                var pwwb_academicterm_semester = $('#pwwbacademictermsemester').val();
                data.pwwbacademictermsemester = pwwb_academicterm_semester;
                // Dates.
                var dataEntry_DateEnd = $('#dataEntryDateEnd').val();
                data.dataEntryDateEnd = dataEntry_DateEnd;
                var dataEntryDate_Start = $('#dataEntryDateStart').val();
                data.dataEntryDateStart = dataEntryDate_Start;
                // Date 2..
                var submission_DateStart = $('#submissionDateStart').val();
                data.submissionDateStart = submission_DateStart;
                var submissionDate_End = $('#submissionDateEnd').val();
                data.submissionDateEnd = submissionDate_End;
                var resultSearch_Filter = $('#resultSearchFilter').val();
                if (resultSearch_Filter == 0) {
                    resultSearch_Filter = '2';
                }
                data.resultSearchFilter = resultSearch_Filter;
                // alert(resultSearch_Filter);
            },
            complete: function(response) {
                // console.log(JSON.stringify(response));
                myData = JSON.stringify(response);
                // alert(myData);
            },
        },
        columns: [],
        columnDefs: []
    });
    $('#my_home tbody').on('click', 'button.view', function() {
        var data = table.row($(this).parents('tr')).data();
        // alert( data['id'] +"'s salary is: "+ data[ 5 ] );
        window.location.href = '/view-record/' + data['id'];
    });
    $('#my_home tbody').on('click', 'button.edit', function() {
        var data = table.row($(this).parents('tr')).data();
        // alert( data['id'] +"'s salary is: "+ data[ 5 ] );
        window.location.href = '/edit-record/' + data['id'];
    });
    $('#my_home tbody').on('click', 'button.delete', function() {
        var data = table.row($(this).parents('tr')).data();
        // alert( data['id'] +"'s salary is: "+ data[ 5 ] );
        window.location.href = '/delete-record/' + data['id'];
    });
    $('#districtSearchFilter').change(function() {
        table.draw();
    });
    $('#priorityofsubmission').change(function() {
        table.draw();
    });
    $('#wingSearchFilter').change(function() {
        table.draw();
    });
    $('#courseSearchFilter').change(function() {
        table.draw();
    });
    $('#courseEnrollerdInSearchFilter').change(function() {
        table.draw();
    });
    $('#courseRegisteredInSearchFilter').change(function() {
        table.draw();
    });
    $('#courseaffiliatedbody').change(function() {
        table.draw();
    });
    $('#courseaffiliatedbody').change(function() {
        table.draw();
    });
    $('#pwwbtransportfacility').change(function() {
        table.draw();
    });
    $('#pwwbhostelfacility').change(function() {
        table.draw();
    });
    $('#provisionalclaimstatus').change(function() {
        table.draw();
    });
    $('#provisionalclaimstatus').change(function() {
        table.draw();
    });
    $('#pwwbacademicterm').change(function() {
        table.draw();
    });
    $('#pwwbacademictermannual').change(function() {
        table.draw();
    });
    $('#pwwbacademictermsemester').change(function() {
        table.draw();
    });
    $('#resultSearchFilter').change(function() {
        table.draw();
    });
    // Dates ...
    $('#dataEntryDateEnd').click(function() {
        table.draw();
    });
    $('#dataEntryDateStart').click(function() {
        table.draw();
    });
    $('#dataEntryDateEnd').blur(function() {
        table.draw();
    });
    $('#dataEntryDateStart').blur(function() {
        table.draw();
    });
    $('#dataEntryDateEnd').keyup(function() {
        table.draw();
    });
    $('#dataEntryDateStart').keyup(function() {
        table.draw();
    });
    $('#dataEntryDateEnd').change(function() {
        table.draw();
    });
    $('#dataEntryDateStart').change(function() {
        table.draw();
    });
    // Date 2..
    $('#submissionDateStart').click(function() {
        table.draw();
    });
    $('#submissionDateEnd').click(function() {
        table.draw();
    });
    $('#submissionDateStart').blur(function() {
        table.draw();
    });
    $('#submissionDateEnd').blur(function() {
        table.draw();
    });
    $('#submissionDateStart').keyup(function() {
        table.draw();
    });
    $('#submissionDateEnd').keyup(function() {
        table.draw();
    });
    $('#submissionDateEnd').change(function() {
        table.draw();
    });
    $('#submissionDateStart').change(function() {
        table.draw();
    });
}
///////////////////////////////////////////// Start Follow Up DataTable Call /////////////////////////////////////////////////
$(document).ready(function() {
    $('#followup').DataTable();
});
$(document).ready(function() {
    var followupDateStart = '';
    var followupDateEnd = '';
    var table_follow_up = $("#follow_up").DataTable({
        "dom": 'Bfrtip',
        "processing": true,
        "serverSide": true,
        "pageLength": 10,
        "pagingType": "full_numbers",
        //   dom: 'Bfrtip',
        // buttons: [
        //     {
        //     extend: 'excel',
        //     text:   'Filter Wise Export',
        //     // function () { return getExportFileName();},
        //     exportOptions: {
        //           modifier: {
        //           page: 'all',
        //           search: 'none'   
        //         }
        //     }
        // }
        // ],
        "createdRow": function(row, data, index) {
            var id = table_follow_up.page.info();
            $('td', row).eq(0).html(index + 1 + id.page * id.length);
        },
        ajax: {
            type: "get",
            url: "/followupslist_json_rst",
            data: function(data) {
                followupDateStart = $('#followupDateStartFilter').val();
                followupDateEnd = $('#followupDateEndFilter').val();
                if (followupDateStart == '') {
                    followupDateStart = 'nulled_sent';
                }
                if (followupDateEnd == '') {
                    followupDateEnd = 'nulled_sent';
                }
                var start = $('#followupDateStartFilter').val();
                data.followupDateStartFilter = start;
                var end = $('#followupDateEndFilter').val();
                data.followupDateEndFilter = end;
            },
            complete: function(response) {
                var newURL = followupDateStart + '/' + followupDateEnd;
                $("#clickButtonFollowup").attr("href", "/recordExportFollowups/" + newURL);
            },
        },
        columns: [{
                data: 'id'
            }, {
                data: 'file_received_number'
            }, {
                data: 'fresh_file_submission_in_pwwb_number'
            }, {
                data: 'father_name'
            }, {
                data: 'father_cnic'
            }, {
                data: 'file_received_status'
            }, {
                data: 'pwwb_diary_number'
            }, {
                data: 'follow_up'
            }, {
                data: 'nextfollowupdate'
            },
            // {
            //     "defaultContent": `<div class="text-center"><button class='btn btn-warning btn-sm edit' ${!updatePermissionForProspectFollowup ? 'hidden' : ''}><i class='fa fa-edit fa-fw'></i></button></div>`
            // },
        ],
        columnDefs: []
    });
    $('#follow_up tbody').on('click', 'button.edit', function() {
        var data = table_follow_up.row($(this).parents('tr')).data();
        window.location.href = '/editFollowup/' + data['id'];
    });
    $('#followupDateStartFilter').change(function() {
        table_follow_up.draw();
    });
    $('#followupDateEndFilter').change(function() {
        table_follow_up.draw();
    });
});
///////////////////////////////////////////// End Follow Up DataTable Call /////////////////////////////////////////////////