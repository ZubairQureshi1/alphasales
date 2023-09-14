<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// Route::get('/server', function () {
//     $conn = odbc_connet('', '', '');
//     $sql = 'SELECT * FROM users';

//     $rs = odbc_exec($conn, $sql);
// });

Route::get('convertPass', function () {
    $md5 = "E10ADC3949BA59ABBE56E057F20F883E";
    if (md5(123456) == strtolower($md5)) {
        echo 'its md5 matched';
    } else {
        echo 'not matched';
    }
});

Route::get('reverseString', function () {
    $string = "Usama Kazmi";
    $string_length = strlen($string);
    $new_string = '';
    $new_string_new = '';
    for ($i = $string_length - 1; $i >= 0; $i--) {
        $new_string = $new_string . $string[$i];
    }
    echo ($new_string);
});

Route::get('pdfTest', function () {
    return view('accounts.overallClearance.clearance_slip');
});

Auth::routes();

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Route::resource('enquiries', 'EnquiryController');
Route::get('courses/getCoursesBySession/{SESSION_ID}', 'CourseController@getCoursesBySession');
Route::get('courses/getCoursesBySessionOnly/{SESSION_ID}', 'CourseController@getCoursesBySessionOnly');
Route::get('courses/getAffiliatedBodiesByCourse', 'CourseController@getAffiliatedBodiesByCourse');
Route::get('courses/getDegreeTypesByBody', 'CourseController@getDegreeTypesByBody');

Route::get('enquiries/getOrganizationCampuses', 'EnquiryController@getOrganizationCampuses');
Route::get('enquiries/{id}/remove', 'EnquiryController@destroy')->name('enquiries.remove');
Route::get('followups/{id}/remove', 'FollowupController@destroy')->name('followups.remove');

// ------------------------------------ Admin ROUTE --------------------------------------------

Route::name('admin.')->prefix('admin')->middleware(['check_super_admin'])->group(function () {
    Route::get('histories/{model_name}/{id}', 'HomeController@histories')->name('histories');
    Route::get('activityLogs/{user}', 'HomeController@activityLogs')->name('activityLogs');
});

//  ------------------------------------------------------------------------------------------------
Route::get('enquiry', 'WhatsappMessagesController@Enquiry')->name('enquiry');

Route::middleware(['auth', 'is_guest'])->group(function () {

    Route::get('/home', 'HomeController@index')->name('home');
    // ------------------------------------ LIVE SEARCH ROUTE --------------------------------------------

    Route::post('liveSearchTableRender', 'FilterController@liveSearchTableRender');
    Route::post('liveSearchDataExport', 'FilterController@liveSearchTableRender');

    // ------------------------------------ GENERIC FILTERS --------------------------------------------

    Route::post('filterData', 'FilterController@index')->name('filters.index');
    Route::get('filterData', 'FilterController@index')->name('filters.index');
    Route::get('test-db', 'TestsController@index');
    // -------------------------------------------------------------------------

    Route::get('test', function () {
        $course = App\Models\SessionCourse::query();

        $course->leftJoin('courses', 'session_courses.course_id', '=', 'courses.id');
        $course->select('session_courses.*', 'courses.name as course_name')->distinct();

        dd($course->get()->toArray());
    });

    // Route::get('qr-code/examples/me-card', function () {
    //     $qr_code = \QRCode::meCard('$name', '$id', '$roll_no', '$type', '$contacts', []);
    //     $qr_code->setErrorCorrectionLevel('H');
    //     $qr_code->setSize(4);
    //     $qr_code->setMargin(2);
    //     $qr_code->png();
    // });
    Route::post('home/updateSystemSession', 'HomeController@updateSystemSession')->name('home.updateSystemSession');

    Route::name('users.')->prefix('users')->group(function () {
        Route::patch('changePassword/{id}', ['uses' => 'UserController@changePassword', 'as' => 'changePassword']);
        Route::get('generateQRCode/{id}', 'UserController@generateQRCode')->name('generateQRCode');
        Route::get('addUserCampusDetails/{campus_id}', 'UserController@addUserCampusDetails')->name('addUserCampusDetails');
        Route::post('checkEmailDuplicacy', 'UserController@checkEmailDuplicacy')->name('checkEmailDuplicacy');
    });
    Route::resource('users', 'UserController');

    Route::resource('roles', 'RoleController');

    Route::name('enquiries.')->prefix('enquiries')->group(function () {
        Route::get('{id}/delete', 'EnquiryController@destroy');
        Route::post('moveToFollowups/{id}', 'EnquiryController@moveToFollowups')->name('addToFollowups');
        Route::get('moveToAdmissions', 'EnquiryController@moveToAdmissions')->name('moveToAdmissions');
        Route::get('insights/growth', 'EnquiryController@growth');
        Route::post('insights/loadMonthlyDataChart', 'EnquiryController@getMonthlyEnquiryData');
        Route::get('insights/test', 'ChartController@getAllmonthsYearly');
        Route::post('insights/loadYearlyDataChart', 'EnquiryController@getYearlyEnquiryData');
        Route::post('insights/loadConversionDataChart', 'EnquiryController@getYearlyConversionData');
        Route::post('insights/loadMultiChart', 'EnquiryController@multiConversionRate');

        Route::post('{enquiry}/update', 'EnquiryController@update');

        Route::post('student/checkNumberDuplicacy', 'EnquiryController@checkNumberDuplicacy');
        Route::get('getProduct/{id}', 'EnquiryController@getProduct');
        Route::get('getDeveloper/{id}', 'EnquiryController@getDeveloper');
        Route::post('ImportEnq', 'EnquiryController@ImportEnq')->name('ImportEnq');
        
    });
    Route::post('updateEnquiryStatus', 'EnquiryController@updateEnquiryStatus')->name('updateEnquiryStatus');

    Route::name('reporting.')->prefix('reporting')->namespace('Reporting')->group(function () {
        Route::name('enquiries.')->prefix('enquiries')->group(function () {
            Route::get('index', 'EnquiryReportingController@index')->name('index');
            Route::post('getMonthlyDataEnquiryTypeWise', 'EnquiryReportingController@getMonthlyDataEnquiryTypeWise')->name('monthlyDataEnquiryTypeWise');
            Route::post('getMonthlyDataEnquiryEmployeeWise', 'EnquiryReportingController@getMonthlyDataEnquiryEmployeeWise')->name('monthlyDataEnquiryTypeWise');
            Route::post('getMonthlyDataEnquiryEnteredByWise', 'EnquiryReportingController@getMonthlyDataEnquiryEnteredByWise')->name('monthlyDataEnquiryTypeWise');
        });
        // Reporting for sections
        Route::name('sections.')->prefix('sections')->group(function () {
            // reporting for sections
            Route::get('index', 'SectionReportingController@index')->name('index');
            Route::post('getSectionDetails', 'SectionReportingController@getSectionDetails')->name('getSectionDetails');
        });
    });
    // Route::resource('profiles', 'ProfileController');
    // Route::post('profiles/{id}', 'ProfileController@update_details');
    // Route::post('profiles/{id}', 'ProfileController@update_avatar');

    Route::name('followups.')->prefix('followups')->group(function () {
        Route::post('reportings/getReportingData', 'FollowupController@getReportingData')->name('reportings.getReportingData');
        Route::get('exportExcel', 'FollowupController@export')->name('exportExcel');
        Route::get('reportings', 'FollowupController@reporting')->name('reportings');
        Route::post('getFilteredData', 'FollowupController@getFilteredData')->name('getFilteredData');
        Route::get('addFollowUpForm/{followup}', 'FollowupController@addFollowUpForm')->name('addFollowUpForm');
        Route::get('deleteEnquiryFollowUp/{followup}', 'FollowupController@deleteEnquiryFollowUp')->name('deleteEnquiryFollowUp');
        Route::post('assignEnquiry', 'FollowupController@assignEnquiry')->name('assignEnquiry');
    });
    Route::resource('followups', 'FollowupController');

    Route::name('admissions.')->prefix('admissions')->group(function () {
        Route::get('getAffiliatedBodyCheckLists/{id}', 'AdmissionController@getAffiliatedBodyCheckLists');
        Route::post('getFilteredData', 'AdmissionController@getFilteredData')->name('getFilteredData');
        Route::get('exportExcel', 'AdmissionController@export')->name('exportExcel');
        Route::get('reportings', 'AdmissionController@viewReporting')->name('reportings');
        Route::post('reportings/getReport', 'AdmissionController@getReport')->name('reportings.getReport');
        Route::post('testingPagination', 'AdmissionController@testingPagination')->name('testingPagination');
    });

    Route::get('admissions/{student}/delete', 'AdmissionController@destroy')->name('admissions.delete');

    Route::resource('admissions', 'AdmissionController');

    Route::name('studentRegistration.')->prefix('studentRegistration')->group(function () {
        Route::post('/{student}/store', 'StudentRegistrationController@store')->name('store');
        // UPDATE
        Route::patch('/{studentRegistration}/update', 'StudentRegistrationController@update')->name('update');
    });

    Route::name('admissionByEnquiryForm.')->prefix('admissionByEnquiryForm')->group(function () {
        Route::get('{enquiry}', 'AdmissionByEnquiryFormController@admissionByEnquiryForm')->name('admissionByEnquiryForm');
    });

    Route::resource('admissionByEnquiryForm', 'AdmissionByEnquiryFormController');

    Route::name('admissionByPwwbForm.')->prefix('admissionByPwwbForm')->group(function () {
        Route::get('{pwwb}', 'AdmissionByPwwbFormController@admissionByPwwbForm')->name('admissionByPwwbForm');
    });

    Route::resource('admissionByPwwbForm', 'AdmissionByPwwbFormController');

    Route::name('students.')->prefix('students')->group(function () {
        Route::post('imports', 'StudentController@import')->name('import');
        Route::get('generateQRCode/{id}', 'StudentController@generateQRCode')->name('generateQRCode');
        Route::post('changeProfilePicture', 'StudentController@changeProfilePicture')->name('changeProfilePicture');
        Route::get('studentGrowth', 'StudentController@studentgrowth');
        Route::post('loadExpelChart', 'StudentController@loadExpelStudentRate');
        Route::get('exportExcel', 'StudentController@export')->name('exportExcel');
        Route::post('semesterFreeze/{id}', 'StudentController@semesterFreeze')->name('semesterFreeze');
        Route::get('removeSubject/{id}', 'StudentController@removeSubject')->name('removeSubject');
        Route::post('addSubject/{id}', 'StudentController@addSubject')->name('addSubject');

        Route::post('getFilteredData', 'StudentController@getFilteredData')->name('getFilteredData');
        Route::get('attachments/{attachment}/remove', 'StudentController@removeAttachment')->name('removeAttachment');
        Route::post('addAttachment/{student}', 'StudentController@addAttachment')->name('addAttachment');
        // update student course
        Route::patch('updateStudentCourse/{student}', 'StudentController@updateStudentCourse')->name('updateStudentCourse');
        // update academic record
        Route::patch('updateAcademicRecords/{student}', 'StudentController@updateAcademicRecords')->name('updateAcademicRecords');
        Route::get('deleteAcademicRecords/{record}', 'StudentController@deleteAcademicRecords')->name('deleteAcademicRecords');
        Route::post('uploadAcademicAttachment/{record}', 'StudentController@uploadAcademicAttachment')->name('uploadAcademicAttachment');
    });

    Route::resource('students', 'StudentController');

    Route::resource('studentWorkers', 'StudentWorkerController');

    Route::resource('references', 'ReferenceController');

    Route::name('departments.')->prefix('departments')->group(function () {
        Route::get('activateDepartment/{id}', 'DepartmentController@activateDepartment')->name('activateDepartment');
        Route::get('deactivateDepartment/{id}', 'DepartmentController@deActivateDepartment')->name('deactivateDepartment');
        Route::get('getDepartmentDesignations/{id}', 'DepartmentController@getDepartmentDesignations')->name('getDepartmentDesignations');
        // get department acc to designation
        Route::get('getDesignationDepartments/{designation}', 'DepartmentController@getDesignationDepartments')->name('getDesignationDepartments');
        Route::get('getDesignationDepartments/{designation}/{campus}', 'DepartmentController@getDesignationDepartments')->name('getDesignationDepartments');
    });

    Route::resource('departments', 'DepartmentController');

    Route::get('designations/campusDepartmentsFields', 'DesignationController@campusDepartmentsFields')->name('campusDepartmentsFields');
    Route::resource('designations', 'DesignationController');

    
    Route::resource('subjects', 'SubjectController');

    Route::resource('affiliatedBody', 'AffiliatedBodyController');

    Route::resource('whatsapp', 'WhatsappMessagesController');
    Route::post('message', 'WhatsappMessagesController@sendMessage')->name('message');
    Route::post('ImportContact', 'WhatsappMessagesController@ImportContact')->name('ImportContact');

    Route::post('message-group', 'WhatsappMessagesController@sendMessageGroup')->name('message-group');
    Route::get('message-logs', 'WhatsappMessagesController@messageLogs')->name('message-logs');
    Route::get('contact-us', 'WhatsappMessagesController@Contacts')->name('contact-us');

    Route::get('message-templates', 'WhatsappMessagesController@MessageTemplates')->name('message-templates');
    Route::post('add-templates', 'WhatsappMessagesController@addTemplate')->name('add-templates');
    Route::post('edit-templates', 'WhatsappMessagesController@editTemplate')->name('edit-templates');

    Route::get('wa-groups', 'WhatsappMessagesController@WaGroups')->name('wa-groups');
    Route::post('add-group', 'WhatsappMessagesController@addGroup')->name('add-group');
    Route::post('addtogroup', 'WhatsappMessagesController@addToGroup')->name('addtogroup');
    Route::post('edit-group', 'WhatsappMessagesController@editGroup')->name('edit-group');
    Route::post('removeContactFromGroup', 'WhatsappMessagesController@removeContactFromGroup')->name('removeContactFromGroup');


    Route::resource('headFines', 'HeadFineController');

    Route::resource('rooms', 'RoomController');

    Route::resource('installmentplans', 'InstallmentPlanController');

    Route::name('accounts.')->prefix('accounts')->group(function () {
        Route::post('payFeePackage/{feePackage}', 'AccountController@payFeePackage')->name('payFeePackage');
        Route::get('verifyFeePackagePayment/{feePackage}', 'AccountController@verifyFeePackagePayment')->name('verifyFeePackagePayment');
        Route::get('deleteOtherFeePackageCharges/{otherFee}', 'AccountController@deleteOtherFeePackageCharges');
        Route::get('showAccountByYear/[{student_id}, {academicHistoryID}]', 'AccountController@showAccountByYear')->name('showAccountByYear');
        Route::post('createFeePackage', 'AccountController@createFeePackage')->name('createFeePackage');
        Route::post('updateFeePackage/{id}', 'AccountController@updateFeePackage')->name('updateFeePackage');
        Route::post('getFilteredData', 'AccountController@getFilteredData')->name('getFilteredData');
        Route::get('reportings', 'AccountController@reportings')->name('reportings');
        Route::get('sessionReport', 'AccountController@sessionReport')->name('sessionReport');
        Route::post('sessionReport/generate', 'AccountController@sessionReportGenerate')->name('sessionReportGenerate');
        Route::get('overallClearanceSlip', 'AccountController@getOverallClearanceSlip')->name('getOverallClearanceSlip');
        Route::post('overallClearanceSlip/generate', 'AccountController@generateOverallClearanceSlip')->name('generateOverallClearanceSlip');
        Route::get('verifyPackages', 'AccountController@verifyPackages')->name('verifyPackages');
        Route::post('verifyPayments', 'AccountController@verifyPayments')->name('verifyPayments');
        Route::post('updatePackageVerification', 'AccountController@updatePackageVerification')->name('updatePackageVerification');
        Route::get('verifyInstalments', 'AccountController@verifyInstalments')->name('verifyInstalments');
        Route::get('voucherLists', 'AccountController@voucherLists')->name('voucherLists');
        Route::get('headsVoucherLists', 'AccountController@headsVoucherLists')->name('headsVoucherLists');
        Route::post('updateInstalmentVerification', 'AccountController@updateInstalmentVerification')->name('updateInstalmentVerification');
        Route::get('verifyStudentHeads', 'AccountController@verifyStudentHeads')->name('verifyStudentHeads');
        Route::post('update_headFine', 'AccountController@update_headFine')->name('update_headFine');
        Route::post('installment', 'AccountController@installment')->name('installment');
        // OLD INSTALLMENT PAYMENT
        Route::post('installment_paid', 'AccountController@installment_paid')->name('installment_paid');
        // NEW INSTALLMENT PAYMENT
        Route::post('installmentPayment/{instalment}', 'AccountController@InstallmentPayment')->name('instalmentPayment');
        Route::post('payInstalmentFine', 'AccountController@payInstalmentFine')->name('payInstalmentFine');
        Route::post('package_paid', 'AccountController@package_paid')->name('package_paid');
        Route::post('fine_paid', 'AccountController@fine_paid')->name('fine_paid');
        Route::post('head_paid/{id}', 'AccountController@head_paid')->name('head_paid');
        Route::post('invoice', 'AccountController@invoice')->name('invoice');
        Route::post('addFines', 'AccountController@addFines')->name('addFines');
        Route::post('invoiceFine', 'AccountController@invoiceFine')->name('invoiceFine');
        Route::post('invoiceHead', 'AccountController@invoiceHead')->name('invoiceHead');
        Route::post('invoicePackage', 'AccountController@invoicePackage')->name('invoicePackage');
        Route::post('dailyReport', 'AccountController@dailyReport')->name('dailyReport');
        Route::post('edit_headFine', 'AccountController@edit_headFine')->name('edit_headFine');
        Route::post('custom_installment', 'AccountController@custom_installment')->name('custom_installment');
        Route::post('pay_fine', 'AccountController@pay_fine')->name('pay_fine');
        Route::post('InstallmentFine/generateFine', 'AccountController@generateFine')->name('generateFine');
        Route::post('attendanceFine', 'AccountController@attendanceFine')->name('attendanceFine');
        Route::post('payAttendanceFine', 'AccountController@payAttendanceFine')->name('payAttendanceFine');
        Route::delete('deleteAttendanceFine/{id}', 'AccountController@deleteAttendanceFine')->name('deleteAttendanceFine');
        Route::post('edit_installment', 'AccountController@edit_installment')->name('edit_installment');
        Route::post('verifyStudentAccount', 'AccountController@verifyStudentAccount')->name('verifyStudentAccount');
        Route::post('deletePackage', 'AccountController@deletePackage')->name('deletePackage');
        Route::post('deleteInstalment', 'AccountController@deleteInstalment')->name('deleteInstalment');
        Route::post('delivered', 'AccountController@delivered')->name('delivered');
        Route::get('placeOrder/{id}', 'AccountController@placeOrder')->name('placeOrder');
        Route::get('exportReportingToExcel', 'AccountController@exportReportingToExcel')->name('exportReportingToExcel');
        Route::get('studentSummary/[{id}, {academicHistoryID}, {year_count}]', 'AccountController@studentSummary')->name('studentSummary');
        Route::post('ExamFine/getDateSheets', 'AccountController@getDateSheets')->name('getDateSheets');
        Route::post('ExamFine/calculateExamFine', 'AccountController@calculateExamFine')->name('calculateExamFine');
        Route::post('ExamFine/payExamFine', 'AccountController@payExamFine')->name('payExamFine');
        Route::delete('ExamFine/deleteExamFine/{id}', 'AccountController@deleteExamFine')->name('deleteExamFine');
        Route::get('studentAcademicHistory/{id}', 'AccountController@getStudentAcademicHistories')->name('studentAcademicHistory');
    });

    Route::resource('accounts', 'AccountController');

    Route::name('profiles.')->prefix('profiles')->group(function () {
        Route::post('update_avatar', 'ProfileController@update_avatar')->name('update_avatar');
        Route::post('update_details', 'ProfileController@update_details')->name('update_details');
        Route::post('update_contacts', 'ProfileController@update_contacts')->name('update_contacts');
        Route::post('update_cnic', 'ProfileController@update_cnic')->name('update_cnic');
    });
    Route::resource('profiles', 'ProfileController');

    Route::name('sessions.')->prefix('sessions')->group(function () {
        Route::post('renderDegreeDetails', 'SessionController@renderDegreeDetails');
        Route::post('autoCompleteCourseName', 'SessionController@autoCompleteCourseName');
        Route::post('autoCompleteSubjectName', 'SessionController@autoCompleteSubjectName');
        Route::post('makeRoadMap', 'SessionController@makeRoadMap');
        Route::get('addNewCourse/{counters}/{row_count}', 'SessionController@addNewCourse');
        Route::get('getSessionDetails', 'SessionController@getSessionDetails');
        Route::get('getCourseAffiliatedBodies/{course}', 'SessionController@getCourseAffiliatedBodies');
        Route::get('removeDegreeFromSession', 'SessionController@removeDegreeFromSession');
        Route::get('getCompleteCourseInfo/{course}/{affiliatedbody}', 'SessionController@getCompleteCourseInfo');
        Route::get('getCompleteSubjectInfo/{session_course_subject}', 'SessionController@getCompleteSubjectInfo');
        Route::get('getWingCampuses/{row_count}/{wing}', 'SessionController@getWingCampuses');
        Route::post('{id}', 'SessionController@update');
    });

    // Asad Print Attendance
    Route::name('studentAttendance.')->prefix('studentAttendance')->group(function () {
        Route::get('/getStudentAttendance/{attendance}', 'StudentAttendanceDetailController@getAttendancePdf')->name('getStudentAttendance');
        Route::get('/attendance/downloadGeneratedPdf', 'StudentAttendanceController@downloadGeneratedPdf');

        Route::get('/studentAttendanceDetail', 'StudentAttendanceController@studentAttendanceDetail')->name('studentAttendanceDetail');
        Route::get('/editAttendanceDetail/{data}', 'StudentAttendanceDetailController@edit')->name('editAttendanceDetail');
        Route::get('/DeleteAttendanceDetails/{data}', 'StudentAttendanceDetailController@destroy')->name('DeleteAttendanceDetails');
        Route::get('/viewAttendanceDetails/{id}', 'StudentAttendanceDetailController@index');
        Route::get('/viewAttendanceList/{id}', 'StudentAttendanceDetailController@list');
        Route::get('/studentAttendance', 'StudentAttendanceController@index')->name('studentAttendance');
        // Route::get('/calculatePolicy/{id}', 'StudentAttendanceDetailController@policyCalculations')->name('calculatePolicy/{id}');
        Route::get('/attendance/getCoursesByAcademicWings/{id}', 'StudentAttendanceController@getCoursesByAcademicWings');
        Route::post('/saveAttendanceData', 'StudentAttendanceController@saveAttendanceData');
        Route::post('/editStudentAttendanceStatus', 'StudentAttendanceDetailController@editStudentAttendanceStatus');
    });
    Route::get('/wing/getWingType', 'StudentAttendanceDetailController@getWingType');
    // End
    // Asad Fine Policy
    Route::name('studentAttendancePolicy.')->prefix('studentAttendancePolicy')->group(function () {
        Route::get('/index', 'StudentAttendancePolicyController@index')->name('index');
        Route::get('/', 'StudentAttendancePolicyController@create')->name('create');
        // Route::get('/fineSheet','StudentAttendancePolicyController@fineSheet')->name('fineSheet');
        Route::get('/fineSheet/{id}', 'StudentAttendancePolicyController@fineSheet')->name('fineSheet');
        Route::get('/finePayment', 'StudentAttendancePolicyController@finePayment')->name('finePayment');
        Route::get('/edit/{policy}', 'StudentAttendancePolicyController@edit')->name('edit');
        Route::get('/show/{policy}', 'StudentAttendancePolicyController@show')->name('show');
        Route::get('/delete/{policy}', 'StudentAttendancePolicyController@destroy')->name('destroy');
        Route::post('/saveFinePolicy', 'StudentAttendancePolicyController@store');
        Route::post('/updateFilePolicy', 'StudentAttendancePolicyController@update');
    });

    // End Fine Policy

    // Attendance Routes... Start
    Route::name('attendance.')->prefix('attendance')->group(function () {
        Route::get('attendanceDetails', 'AttendanceController@index')->name('index');
        Route::get('attandanceCreate', 'AttendanceController@create')->name('create');
        Route::post('attandanceStore', 'AttendanceController@store')->name('store');
        Route::post('attandanceEdit', 'AttendanceController@edit')->name('edit');
        Route::post('attandanceUpddate', 'AttendanceController@update')->name('update');
        Route::post('attandanceDistroy', 'AttendanceController@distroy')->name('destroy');
    });

    // Attendance Routes... End

    // Section Routes ... Start
    Route::name('sections.')->prefix('sections')->group(function () {
        Route::get('/', 'SectionController@index')->name('index');
        Route::post('/storeSectionDetails', 'SectionController@storeSectionDetails');
        Route::post('/updateSectionDetails', 'SectionController@updateSectionDetails');
        Route::get('/deleteSectionDetails/{section_detail_id}', 'SectionController@deleteSectionDetails');
        Route::post('/getAffiliatedBodiesByCourse/{course}/{wing}', 'SectionController@getAffiliatedBodiesByCourse');
        Route::post('/addCsSectionRow', 'SectionController@addCsSectionRow');
        Route::get('/create', 'SectionController@create')->name('create');
        Route::post('sectionStore/{section}', 'SectionController@store')->name('store');
        Route::get('edit/{section}', 'SectionController@edit')->name('edit');
        Route::post('sectionUpdate/', 'SectionController@update')->name('update');
        Route::post('getCourseList', 'SectionController@getCourseList');
        Route::post('getAffilatedBodiesList', 'SectionController@getAffilatedBodiesList');
        Route::get('sectionAssign', 'SectionController@assign')->name('assign');
        Route::post('sectionDistroy', 'SectionController@distroy')->name('destroy');
        Route::post('getTotalStudent', 'SectionController@getTotalStudent');
        Route::post('getTotalStudentsAccordingToCourse', 'SectionController@getTotalStudentsAccordingToCourse');
        Route::post('/assignSectionToStudents', 'SectionController@assignSectionToStudents');
        Route::post('/getCourseAcademicTerms/{course_id}/{wing_id}', 'SectionController@getCourseAcademicTerms');
        Route::post('/getSubjectList/{course_id}/{wing_id}/{term_id}', 'SectionController@getSubjectList');
        Route::get('/{section}/delete', 'SectionController@destroy')->name('delete');

        Route::post('/getSectionsDetailsByFilters', 'SectionController@getSectionsDetailsByFilters');
    });
    // Section Routes ... End

    Route::resource('sessions', 'SessionController');
    Route::post('getStudentCourseSubjects', 'CourseController@getStudentCourseSubjects');
    Route::post('courses/{id}', 'CourseController@update');
    Route::post('getDetails', 'TimePeriodController@getDetails');
    Route::post('getCourseDetails', 'CourseController@getCourseDetails');

    // Asad Attendance
    Route::post('getAttendanceCourseList/{wing_id}', 'StudentAttendanceController@getAttendanceCourseList');
    Route::post('getAttendanceSubjectList/{course_id}/{wing_id}', 'StudentAttendanceController@getAttendanceSubjectList');
    Route::post('getAttendanceAffiliatedBodiesList/{subject_id}/{course_id}/{wing_id}', 'StudentAttendanceController@getAttendanceAffiliatedBodiesList');
    Route::post('getAttendanceSectionList/{subject_id}/{course_id}/{wing_id}/{term_id}', 'StudentAttendanceController@getAttendanceSectionList');
    Route::post('/getAttendanceTeachersList/{section_id}/{subject_id}', 'StudentAttendanceController@getAttendanceTeachersList');
    Route::post('/attendance/getFilteredData', 'StudentAttendanceController@getFilteredData');

    // End

    Route::post('getCourseSubjects', 'CourseController@getCourseSubjects');
    Route::post('getCourseSections', 'CourseController@getCourseSections');
    Route::post('getStudentData/{course_id}/{affiliated_body_id}', 'SectionController@getStudentData');

    Route::post('getDegreeLevelDetails', 'CourseController@getDegreeLevelDetails');
    Route::post('getCourseAffiliatedBodies', 'CourseController@getCourseAffiliatedBodies');
    Route::post('getAffiliatedBodySessions', 'CourseController@getAffiliatedBodySessions');
    Route::post('getCoursePlans', 'CourseController@getCoursePlans');

    Route::resource('courses', 'CourseController');

    Route::get('timeslots/exportExcel', 'TimeSlotController@export')->name('timeslots.exportExcel');
    Route::get('timeslots/getAJAXTimeSlot', 'TimeSlotController@getAJAXTimeSlot')->name('timeslots.ajaxTimeSlots');
    Route::resource('timeslots', 'TimeSlotController');
    Route::get('userShifts/shiftSwap', 'ShiftController@shiftSwap')->name('userShifts.shiftSwap');

    Route::get('timePeriods', 'TimePeriodController@index')->name('timePeriods.index');
    Route::get('timePeriods/create', 'TimePeriodController@create')->name('timePeriods.create');
    Route::post('timePeriods/store', 'TimePeriodController@store')->name('timePeriods.store');

    Route::delete('timePeriods/destroy/{id}', 'TimePeriodController@delete')->name('timePeriods.destroy');

    Route::get('userShifts/getAllUsers', 'ShiftController@getAllUsers');
    Route::get('userShifts/getCalendarData', 'ShiftController@getCalendarData');
    Route::get('userShifts/workingDayTimeSlots/{user}', 'ShiftController@workingDayTimeSlots');

    Route::resource('userShifts', 'ShiftController');
    Route::get('deleteShift/{id}/delete', 'ShiftController@deleteShift');

    Route::resource('attendances', 'AttendanceController');
    Route::post('calculateAttendance', 'AttendanceController@calculateAttendance')->name('attendance.calculateAttendance');

    Route::post('calculateStudentAttendance', 'AttendanceController@calculateStudentAttendance')->name('attendance.calculateStudentAttendance');
    Route::post('attendance/getEmployeeFilteredData', 'AttendanceController@getEmployeeFilteredData')->name('attendance.getEmployeeFilteredData');
    Route::get('studentAttendanceSummary', 'AttendanceController@studentAttendanceSummary')->name('attendance.studentAttendanceSummary');
    Route::get('attendance/getFilteredStudents', 'AttendanceController@getFilteredStudents')->name('attendance.getFilteredStudents');
    Route::get('attendance/generateAttendanceSummary', 'AttendanceController@generateAttendanceSummary')->name('attendance.generateAttendanceSummary');
    Route::get('isOnLeave/{id}', 'AttendanceController@isOnLeave')->name('attendance.isOnLeave');
    Route::post('manualAttendance/{id}', 'AttendanceController@manualAttendance')->name('attendance.manualAttendance');

    Route::post('facultyCheck', 'TimePeriodController@facultyCheck');

    Route::get('studentAttendances', 'AttendanceController@getStudentAttendances')->name('attendance.getStudentAttendances');
    Route::get('employeeAttendances', 'AttendanceController@getEmployeeAttendances')->name('attendance.getEmployeeAttendances');

    Route::get('visitorEmployeeAttendances', 'AttendanceController@getVisitorEmployeeAttendances')->name('attendance.getVisitorEmployeeAttendances');

    Route::post('calculateVisitorAttendance', 'AttendanceController@calculateVisitorAttendance')->name('attendance.calculateVisitorAttendance');

    Route::get('getEmployeeLateReporting', 'AttendanceController@getEmployeeLateReporting')->name('attendance.getEmployeeLateReporting');
    Route::get('getEmployeeDayWiseReporting', 'AttendanceController@getEmployeeDayWiseReporting')->name('attendance.getEmployeeDayWiseReporting');
    Route::get('getEmployeeAbsentReporting', 'AttendanceController@getEmployeeAbsentReporting')->name('attendance.getEmployeeAbsentReporting');
    Route::get('employeeAttendances/exportExcel/{id}', 'AttendanceController@export')->name('employeeAttendances.exportExcel');

    Route::get('visitorEmployeeAttendances/exportExcel/{id}', 'AttendanceController@export')->name('visitorEmployeeAttendances.exportExcel');

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    Route::resource('examtypes', 'ExamTypeController');
    Route::get('examtypes/{id}/edit', 'ExamTypeController@edit');
    Route::post('examtypes/{id}/update', 'ExamTypeController@update');
    Route::get('examtypes/{id}/destroy', 'ExamTypeController@destroy');
    Route::resource('datesheet', 'DateSheetController');
    Route::get('create', 'DateSheetController@create');
    Route::get('edit/{id}', 'DateSheetController@edit');
    Route::post('update/{id}', 'DateSheetController@update');
    Route::get('destroy/{id}', 'DateSheetController@destroy');
    Route::get('datesheetview/{id}', 'DateSheetController@datesheetview');
    Route::get('general_datesheet_view/{id}', 'DateSheetController@GeneralDatesheetView');
    Route::get('awardlist', 'DateSheetController@awardlist');
    Route::post('/getSectionDetail', 'DateSheetController@getSectionDetail');
    Route::post('/getAwardSectionDetail', 'DateSheetController@getAwardSectionDetail');
    Route::get('Sittingplan', 'DateSheetController@Sittingplan');
    Route::post('Sittingplan', 'DateSheetController@store');
    Route::post('/getSittingPlan', 'DateSheetController@getSittingPlan');
    Route::post('/DoneSittingplan', 'DateSheetController@SaveSittingPlan');
    Route::get('Sitting_Plan_View/{id}', 'DateSheetController@Sitting_Plan_View');
    Route::get('edit_sitting_plan/{id}', 'DateSheetController@edit_sitting_plan');
    Route::post('update_sitting_plan/{id}', 'DateSheetController@update_sitting_plan');
    Route::get('RollNoSlip', 'DateSheetController@roll_no_slip');
    Route::post('/getRollNoSlipDetail', 'DateSheetController@getRollNoSlipDetail');
    Route::get('RollNoSlipView/{id}', 'DateSheetController@RollNoSlipView');
    Route::post('/getStudentRollNoSlip', 'DateSheetController@getStudentRollNoSlip');
    Route::get('FacultySubjects', 'ResultController@FacultySubject')->name('FacultySubjects.index');
    Route::post('SaveFacultySubjects', 'ResultController@store');
    Route::get('EditFacultySubject/{id}', 'ResultController@edit');
    Route::post('updateFacultySubject/{id}', 'ResultController@update');
    Route::get('deleteFacultySubject/{id}', 'ResultController@delete');
    Route::post('updateStudentResult/{id}/update', 'DateSheetStudentController@update');
    Route::resource('results', 'DateSheetStudentController');
    Route::get('ResultView', 'DateSheetStudentController@getResultView');
    Route::get('resultReporting', 'DateSheetStudentController@ResultReporting')->name('resultReporting');
    Route::get('resultReportingView', 'DateSheetStudentController@ResultReportingView')->name('resultReportingView');
    Route::post('/getDateSheetSection', 'DateSheetStudentController@getDateSheetSection');
    Route::post('/getSectionStudent', 'DateSheetStudentController@getSectionStudent');
    Route::post('/getStudentResult', 'DateSheetStudentController@getStudentResult');
    Route::post('/getDateSheetInfo', 'DateSheetStudentController@getDateSheetInfo');
    Route::post('/getSubjectStudents', 'DateSheetStudentController@getSubjectStudents');
    Route::post('/getSectionResult', 'DateSheetStudentController@getSectionResult');
    Route::post('/getSubjectResult', 'DateSheetStudentController@getSubjectResult');
    Route::post('ImportStudentResult', 'DateSheetStudentController@import');
    Route::resource('assignments', 'AssignmentController');
    Route::post('/getAssignmentCourseStudents', 'AssignmentController@getAssignmentCourseStudents');
    Route::resource('notice_board', 'NoticeBoardController');
    Route::get('edit_notice_board/{id}', 'NoticeBoardController@edit');
    Route::post('update_notice_board/{id}', 'NoticeBoardController@update');
    Route::get('delete_notice_board/{id}', 'NoticeBoardController@destroy');
    Route::resource('announcements', 'AnnouncementController');
    Route::get('edit_announcement/{id}', 'AnnouncementController@edit');
    Route::post('update_announcement/{id}', 'AnnouncementController@update');
    Route::get('delete_announcement/{id}', 'AnnouncementController@destroy');
    Route::resource('lectureAttendance', 'LectureAttendanceController');
    Route::post('/lectureAttendance/getCourseSubject', 'LectureAttendanceController@getCourseSubject');
    Route::get('lectureAttendanceView', 'LectureAttendanceController@LectureAttendanceView');
    Route::post('/lectureAttendanceView/getCourseSubject', 'LectureAttendanceController@getLectureCourseSubject');
    Route::post('/filterLectureAttendance', 'LectureAttendanceController@FilterLectureAttendance');
    Route::get('studentLectureAttendanceView', 'LectureAttendanceController@StudentLectureAttendanceView')->name('studentLectureAttendanceView');
    Route::post('/filterStudentLectureAttendance', 'LectureAttendanceController@FilterStudentLectureAttendance');
    Route::resource('semester', 'SemesterController');
    // Route::get('edit',function(){
    //     return view('examtypes.edit');
    // });
    Route::get('admissionGrowth', 'AdmissionController@admissionGrowth');
    Route::post('loadAdmissionMonthlyDataChart', 'AdmissionController@admissionMonthlyChart');
    Route::post('loadAdmissionYearlyDataChart', 'AdmissionController@admissionYearlyChart');
    Route::get('accountGrowth', 'AccountController@accountGrowth');
    Route::post('loadAccountsMonthlyDataChart', 'AccountController@accountMonthlyChart');
    Route::post('loadAccountsYearlyDataChart', 'AccountController@accountYearlyChart');
    Route::post('loadAccountsMultiYearlyDataChart', 'AccountController@multiAccountConversionRate');
    Route::post('loadAccountsMultiMonthlyYearlyDataChart', 'AccountController@accountMonthlyConversionChart');
    Route::post('loadCourseAdmissionMonthlyDataChart', 'AdmissionController@courseAdmissionMonthlyChart');
    Route::post('loadCourseAdmissionYearlyDataChart', 'AdmissionController@courseAdmissionYearlyChart');
    Route::post('loadWelRegMonthlyDataChart', 'AccountController@accountMonthlyWelRegChart');
    Route::post('loadWelRegYearlyDataChart', 'AccountController@accountYearlyWelRegChart');

    Route::get('migrations', 'TransferController@dropdown');
    Route::get('studentTransfers/getStudent', 'TransferController@getStudents');
    Route::post('icrementStudentTransfers', 'TransferController@incrementPackageTransfer');

    Route::resource('organizations', 'OrganizationController');

    Route::get('campuses/campusDepartments/{id}', 'OrganizationCampusController@campusDepartments')->name('campuses.campusDepartments');
    //Route::resource('organizationCampuses', 'OrganizationCampusController');
    Route::resource('organizationOfficeLocation', 'OrganizationCampusController');
    Route::resource('wings', 'WingController');
    Route::get('devproducts','ProductsViewController@index')->name('devproducts');

    Route::get('indexBranch', 'BranchController@index')->name('branch.index');
    Route::post('branch/store', 'BranchController@store')->name('branch.store');
    Route::get('branch/delete{id}', 'BranchController@delete')->name('branch.delete');
    Route::post('branch/update/{id}', 'BranchController@update')->name('branch.update');

    Route::get('indexLocation', 'LocationController@index')->name('location.index');
    Route::post('location/store', 'LocationController@store')->name('location.store');
    Route::get('location/delete{id}', 'LocationController@delete')->name('location.delete');
    Route::post('location/update/{id}', 'LocationController@update')->name('location.update');

    Route::group(['prefix' => 'jobTitle', 'as' => 'jobtitle.'], function () {

        Route::get('/', 'JobTitleController@index')->name('index');
        Route::post('/store', 'JobTitleController@store')->name('store');
        Route::patch('/update/{job}', 'JobTitleController@update')->name('update');
        Route::delete('/delete/{job}', 'JobTitleController@delete')->name('delete');
    });

    Route::get('dynamicMenu/', 'DynamicMenuController@index')->name('dynamicMenu.index');

    Route::get('user/accounts', function () {
        return 'Accounts';
    })->name('accounts');

    // PERMISSIONS
    Route::group(['prefix' => 'permissions', 'as' => 'permissions.'], function () {
        Route::get('/', 'ModulePermissionController@index')->name('index');
        Route::post('/store', 'ModulePermissionController@store')->name('store');
        Route::get('/{permission}/edit', 'ModulePermissionController@edit')->name('edit');
        Route::patch('/{permission}/update', 'ModulePermissionController@update')->name('update');
        Route::get('/{permission}/delete', 'ModulePermissionController@delete')->name('delete');
        // delete through ajax
        Route::get('/{permission}/remove-permission', 'ModulePermissionController@removePermission');
    });

    Route::get('courseContent/edit', 'CourseContentController@editCourseContent')->name('editCourseContent');
    Route::get('courseContentRecord', 'CourseContentController@CourseContentRecord')->name('courseContentRecord');
    Route::resource('courseContent', 'CourseContentController');
    Route::post('/getCourseSemesterSubject', 'CourseContentController@getCourseSemesterSubject');
    Route::post('/getCourseContentSubjectDetail', 'CourseContentController@getCourseContentSubjectDetail');
    Route::post('/getTeacherCourseContentSubjectDetail', 'CourseContentController@getCourseContentSubjectDetail');
    Route::post('/updateCourseContentStatus/{id}/update', 'CourseContentController@StatusUpdate');
    Route::post('/updateCourseContent/{id}/update', 'CourseContentController@update');
    Route::get('generateCourseContent', 'CourseContentController@generateCourseContent')->name('generateCourseContent');
    Route::post('/getSubjectTeacher', 'ResultController@getSubjectTeacher');
    Route::resource('employments', 'EmploymentController');
    Route::get('employments/edit/{id}', 'EmploymentController@edit')->name('editEmploymentEnd');
    Route::post('employments/update/{id}', 'EmploymentController@update')->name('employments.updateEmploymentEnd');
    Route::get('employments/delete/{id}', 'EmploymentController@destroy')->name('deleteEmploymentEnd');

    Route::post('/getSubjectUsers/{subject}', 'ResultController@getSubjectUsers');
    Route::post('/courseContent/getSubjectTeacher', 'CourseContentController@getSubjectTeacher');
    Route::resource('attachments', 'AttachmentController');
    Route::post('/getCourseSessionStudent', 'AttachmentController@getCourseSessionStudent');
    // Route::get('admission/AdmissionAttachment/{id}','AdmissionController@UploadAdmissionAttachment')->name('AdmissionAttachment');
    // Route::post('admission/StoreAdmissionAttachment','AdmissionController@StoreAdmissionAttachment')->name('StoreAdmissionAttachment');

    // PWWB web.php Routes ...

    //    Route::name('pwwb.')->prefix('pwwb')->group(function () {
    Route::name('pwwb.')->prefix('')->group(function () {

        Route::get('/exportExcel', 'Pwwb\PwwbHomeController@export')->name('exportExcel');
        Route::get('/export/{district}', 'Pwwb\PwwbHomeController@export')->name('export');

        //        Route::get('exportExcel', 'AdmissionController@export')->name('exportExcel');
        //Follow Up Store
        Route::post('/pwwbfollowupstore', 'Pwwb\PwwbHomeController@pwwbfollowupstore');
        Route::get('/loadMainPage', 'Pwwb\IndexTableController@loadMainPage');
        Route::post('/index-table', 'Pwwb\IndexTableController@post');
        Route::get('/records', 'Pwwb\PwwbHomeController@index')->name('records');
        // Ali Naeem Edit.
        Route::get('checkifsidexists/{data}', 'Pwwb\PwwbHomeController@checkifsidexists');
        Route::get('getDataAgainstFileReceivedNumber/{data}', 'Pwwb\PwwbHomeController@getDataAgainstFileReceivedNumber');
        Route::get('getEnquiryFollowupsList/{data}', 'Pwwb\PwwbHomeController@getEnquiryFollowupsList');
        Route::get('getEnquiryFactoryFollowupsList/{data}', 'Pwwb\PwwbHomeController@getEnquiryFactoryFollowupsList');
        Route::get('getStudentContactsInfos/{data}', 'Pwwb\PwwbHomeController@getStudentContactsInfos');
        Route::get('getEducationalWingFollowupsList/{data}', 'Pwwb\PwwbHomeController@getEducationalWingFollowupsList');

        // Ali Naeem Edit.
        Route::get('checkrifnotexists/{data}', 'Pwwb\PwwbHomeController@checkrifnotexists');
        Route::get('checkMifnotexists/{data}', 'Pwwb\PwwbHomeController@checkMifnotexists');
        Route::get('woerkCNICAlert/{data}', 'Pwwb\PwwbHomeController@woerkCNICAlert');
        Route::get('CNICNoAlert/{data}', 'Pwwb\PwwbHomeController@CNICNoAlert');
        Route::get('workerCNICFamilyAlert/{data}', 'Pwwb\PwwbHomeController@workerCNICFamilyAlert');
        Route::get('workersContactNumberAlert/{data}', 'Pwwb\PwwbHomeController@workersContactNumberAlert');
        Route::get('factoryManagerContactNoAlert/{data}', 'Pwwb\PwwbHomeController@factoryManagerContactNoAlert');
        Route::get('studetnPersonalContactNoAlert/{data}', 'Pwwb\PwwbHomeController@studetnPersonalContactNoAlert');

        // Ali Naeem Edit.
        Route::get('/worker-eligible/{id}', 'Pwwb\PwwbHomeController@workerEligible');
        Route::get('/worker-followup/{id}', 'Pwwb\PwwbHomeController@workerFollowup');
        Route::get('/edit-record/{index_id}', 'Pwwb\PwwbHomeController@edit');
        Route::get('/move-record/{index_id}', 'Pwwb\PwwbHomeController@move');
        Route::get('/bonified-certificate/{index_id}', 'Pwwb\PwwbHomeController@bonifiedCertificate');
        Route::get('/admission-offer-letter/{index_id}', 'Pwwb\PwwbHomeController@admissionOfferLetter');
        Route::get('/claim-letter/{index_id}', 'Pwwb\PwwbHomeController@claimLetter');

        Route::get('/view-record/{index_id}', 'Pwwb\PwwbHomeController@view');
        Route::get('/delete-record/{index_id}', 'Pwwb\PwwbHomeController@delete');
        // To Add Campus ... Temporerry...
        Route::get('/select-campus/{index_id}', 'Pwwb\PwwbHomeController@selectCampus');
        Route::post('/setCampus', 'Pwwb\PwwbHomeController@setCampus');

        Route::get('/worker-family', 'Pwwb\PwwbHomeController@workerFamily');
        //Home Page Datatable...
        Route::get('/fillHomePage', 'Pwwb\PwwbHomeController@fillHomePage')->name('fillHomePage');
        Route::get('/recordsExport', 'Pwwb\PwwbHomeController@recordsExport')->name('recordsExport');
        Route::get('/recordsExportCSV/{districtSearchFilter}/{priorityofsubmission}/{wingSearchFilter}/{courseSearchFilter}/{courseEnrollerdInSearchFilter}/{courseRegisteredInSearchFilter}/{courseaffiliatedbody}/{pwwbtransportfacility}/{pwwbhostelfacility}/{provisionalclaimstatus}/{pwwbacademicterm}/{serachDataResult}', 'Pwwb\PwwbHomeController@recordsExportCSV')->name('recordsExportCSV');
        Route::get('/recordExportFollowups/{startDate}/{endDate}', 'Pwwb\PwwbHomeController@recordExportFollowups')->name('recordExportFollowups');

        Route::get('/recordsExportCSVFilter/{districtSearchFilter}/{priorityofsubmission}/{wingSearchFilter}/{courseSearchFilter}/{courseEnrollerdInSearchFilter}/{courseRegisteredInSearchFilter}/{courseaffiliatedbody}/{pwwbtransportfacility}/{pwwbhostelfacility}/{provisionalclaimstatus}/{pwwbacademicterm}/{serachDataResult}', 'Pwwb\PwwbHomeController@recordsExportCSVFilter')->name('recordsExportCSVFilter');

        Route::get('/followupslist', 'Pwwb\PwwbHomeController@followupslist')->name('followupslist');
        Route::get('/followupslist_json_rst', 'Pwwb\PwwbHomeController@followupslist_json_rst')->name('followupslist_json_rst');
        Route::get('/editFollowup/{id}', 'Pwwb\PwwbHomeController@editFollowup');
        Route::get('/followupslist_json', 'Pwwb\PwwbHomeController@followupslist_json')->name('followupslist_json');
        // Route::get('/followupslist_json_search/{search}', 'Pwwb\PwwbHomeController@followupslist_json_search')->name('followupslist_json_search');

        Route::get('/nonfollowupslist', 'Pwwb\PwwbHomeController@nonfollowupslist')->name('nonfollowupslist');
        Route::get('/worker-nonfollowup/{id}', 'Pwwb\PwwbHomeController@workerNonFollowup');

        Route::get('/eligibleList', 'Pwwb\PwwbHomeController@eligibleList')->name('eligibleList');
        Route::get('/noneligibleList', 'Pwwb\PwwbHomeController@noneligibleList')->name('noneligibleList');

        Route::post('/worker-personal-details', 'Pwwb\WorkerPersonalDetailController@post');
        Route::post('/worker-bank-security-details', 'Pwwb\WorkerBankSecurityDetailController@post');
        Route::post('/factory-service-details', 'Pwwb\FactoryDetailController@post');
        Route::post('/factory-death-manager-details', 'Pwwb\FactoryDeathManagerDetailController@post');
        Route::post('/student-personal-details', 'Pwwb\StudentPersonalDetailController@post');
        Route::post('/educational-wing-details', 'Pwwb\EducationalWingCfeController@post');
        Route::post('/transport-hostel-details', 'Pwwb\TransportHostelDetailController@post');
        Route::post('/document-attachment-details', 'Pwwb\DocumentAttachmentDetailController@post');
        Route::post('/provisional-claim-details', 'Pwwb\ProvisionalClaimDetailController@post');
        Route::post('/annual-part-one', 'Pwwb\FirstAnnualDetailController@post');
        Route::post('/annual-part-two', 'Pwwb\SecondAnnualPartDetailController@post');
        Route::post('/first-semester', 'Pwwb\FirstSemesterDetailController@post');
        Route::post('/second-semester', 'Pwwb\SecondSemesterDetailController@post');
        Route::post('/third-semester', 'Pwwb\ThirdSemesterDetailController@post');
        Route::post('/fourth-semester', 'Pwwb\FourthSemesterDetailController@post');
        Route::post('/fifth-semester', 'Pwwb\FifthSemesterDetailController@post');
        Route::post('/sixth-semester', 'Pwwb\SixthSemesterDetailController@post');
        Route::post('/seventh-semester', 'Pwwb\SeventhSemesterDetailController@post');
        Route::post('/eighth-semester', 'Pwwb\EighthSemesterDetailController@post');

        //delete calls
        Route::post('/worker-family-detail-delete', 'Pwwb\IndexTableController@deleteWorkerDetail');
        Route::post('/service-detail-delete', 'Pwwb\FactoryDetailController@deleteServiceDetail');
        Route::post('/worker-contact-number-delete', 'Pwwb\WorkerPersonalDetailController@deleteWorkerContactNumber');
        Route::post('/annual-part-one-delete', 'Pwwb\FirstAnnualDetailController@deleteFirstAnnualResultStatusDetail');
        Route::post('/annual-part-two-delete', 'Pwwb\SecondAnnualPartDetailController@deleteSecondAnnualResultStatusDetail');
        Route::post('/first-semester-delete', 'Pwwb\FirstSemesterDetailController@deleteFirstSemesterResultStatusDetail');
        Route::post('/second-semester-delete', 'Pwwb\SecondSemesterDetailController@deleteSecondSemesterResultStatusDetail');
        Route::post('/third-semester-delete', 'Pwwb\ThirdSemesterDetailController@deleteThirdSemesterResultStatusDetail');
        Route::post('/fourth-semester-delete', 'Pwwb\FourthSemesterDetailController@deleteFourthSemesterResultStatusDetail');
        Route::post('/fifth-semester-delete', 'Pwwb\FifthSemesterDetailController@deleteFifthSemesterResultStatusDetail');
        Route::post('/sixth-semester-delete', 'Pwwb\SixthSemesterDetailController@deleteSixthSemesterResultStatusDetail');
        Route::post('/seventh-semester-delete', 'Pwwb\SeventhSemesterDetailController@deleteSeventhSemesterResultStatusDetail');
        Route::post('/eighth-semester-delete', 'Pwwb\EighthSemesterDetailController@deleteEighthSemesterResultStatusDetail');

        // IMS Enrolled Course Info...
        Route::get('/getIMSEnrolledInfo/{wing_id}/{session_id}/{index_id}', 'Pwwb\IndexTableController@getIMSEnrolledInfo')->name('getIMSEnrolledInfo');
        Route::get('/getIMSRegisteredInfo/{wing_id}/{session_id}/{index_id}', 'Pwwb\IndexTableController@getIMSRegisteredInfo')->name('getIMSRegisteredInfo');

        // AF Enrolled Course Info...
        Route::get('/getAFEnrolledInfo/{wing_id}/{session_id}/{index_id}', 'Pwwb\IndexTableController@getAFEnrolledInfo')->name('getAFEnrolledInfo');
        Route::get('/getAFRegisteredInfo/{wing_id}/{session_id}/{index_id}', 'Pwwb\IndexTableController@getAFRegisteredInfo')->name('getAFRegisteredInfo');

        // BISE Enrolled Course Info...
        Route::get('/getBISEEnrolledInfo/{wing_id}/{session_id}/{index_id}', 'Pwwb\IndexTableController@getBISEEnrolledInfo')->name('getBISEEnrolledInfo');
        Route::get('/getBISERegisteredInfo/{wing_id}/{session_id}/{index_id}', 'Pwwb\IndexTableController@getBISERegisteredInfo')->name('getBISERegisteredInfo');

        // VTI Enrolled Course Info...
        Route::get('/getVTIEnrolledInfo/{wing_id}/{session_id}/{index_id}', 'Pwwb\IndexTableController@getVTIEnrolledInfo')->name('getVTIEnrolledInfo');
        Route::get('/getVTIRegisteredInfo/{wing_id}/{session_id}/{index_id}', 'Pwwb\IndexTableController@getVTIRegisteredInfo')->name('getVTIRegisteredInfo');

        // Get Courses ...
        Route::get('/getCoursesEwingSessions/{wing_id}/{session_id}', 'Pwwb\IndexTableController@getCoursesEwingSessions')->name('getCoursesEwingSessions');
        Route::get('/getAcademicTerm/{affiliatedbody_id}/{wing_id}/{course_id}', 'Pwwb\IndexTableController@getAcademicTerm')->name('getAcademicTerm');
        Route::get('/getAnnualSemesterCount/{affiliatedbody_id}/{wing_id}/{course_id}', 'Pwwb\IndexTableController@getAnnualSemesterCount')->name('getAnnualSemesterCount');
        Route::get('/getIMSAffiliatedID/{affiliatedbody_id}', 'Pwwb\IndexTableController@getIMSAffiliatedID')->name('getIMSAffiliatedID');
        Route::get('/getCoursesEwingSessions_dual/{session_id}', 'Pwwb\IndexTableController@getCoursesEwingSessions_dual')->name('getCoursesEwingSessions_dual');
        Route::get('/getAcademicTerm_dual/{affiliatedbody_id}/{course_id}', 'Pwwb\IndexTableController@getAcademicTerm_dual')->name('getAcademicTerm_dual');
        Route::get('/getAnnualSemesterCount_dual/{affiliatedbody_id}/{course_id}', 'Pwwb\IndexTableController@getAnnualSemesterCount_dual')->name('getAnnualSemesterCount_dual');
    });

    // End PWWB web.php Routes ...

});

// open enquiries
Route::group(['prefix' => 'openEnquiries', 'as' => 'openEnquiries.'], function () {
    //view
    Route::get('/', 'OpenEnquiryController@index')->name('index');
    // create
    Route::get('/create', 'OpenEnquiryController@create')->name('create');
    // show
    Route::get('/{enquiry}', 'OpenEnquiryController@show')->name('show');
    // edit
    Route::get('/{enquiry}/edit', 'OpenEnquiryController@edit')->name('edit');
    // update
    Route::post('/{enquiry}/update', 'OpenEnquiryController@update')->name('update');
    // delete
    Route::get('/{enquiry}/delete', 'OpenEnquiryController@destroy')->name('destroy');
    // store organization campus id in system session
    Route::get('/storeOrganizationCampusSession/{id}', 'OpenEnquiryController@storeOrganizationCampusSession');
});

// for artisan commands

Route::get('migrate', function () {

    try {
        Artisan::call('migrate');
        return 'migration run successfully.';
    } catch (\Exception $e) {
        return 'migration run failed. ' . $e;
    }
});

Route::get('seed', function () {

    try {
        Artisan::call('db:seed');
        return 'seeder run successfully.';
    } catch (\Exception $e) {
        return 'seeder run failed. ' . $e;
    }
});
Route::get('cacheClear', function () {

    try {
        Artisan::call('cache:clear');
        return 'cache clear successfully.';
    } catch (\Exception $e) {
        return 'seeder run failed. ' . $e;
    }
});

Route::get('viewClear', function () {

    try {
        //Artisan::call('view:clear');
        Artisan::call('storage:link');
        return 'view clear successfully.';
    } catch (\Exception $e) {
        return 'seeder run failed. ' . $e;
    }
});

Route::get('configCache', function () {

    try {
        Artisan::call('config:cache');
        return 'config updated successfully.';
    } catch (\Exception $e) {
        return 'seeder run failed. ' . $e;
    }
});

Route::get('migrateRollback', function () {

    try {
        Artisan::call('migrate:rollback');
        return 'migration rollbacked successfully.';
    } catch (\Exception $e) {
        return 'migration rollback failed. ' . $e;
    }
});
