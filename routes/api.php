<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', 'UserController@login');
Route::post('/punchAttendance', 'AttendanceAPIController@punchAttendance');
Route::get('/getAttendanceSupportingData', 'AttendanceAPIController@getAttendanceSupportingData');
Route::post('/getAttendances', 'AttendanceAPIController@getAttendances');

Route::post('/getDeviceLogs', 'AttendanceAPIController@getDeviceLogs');
Route::get('/getUsersForDevice', 'UserController@getUsersForDevice');
Route::get('/getStudentsForDevice', 'UserController@getStudentsForDevice');

Route::post('accounts', 'API\AccountAPIController@getPost');
Route::post('postData', 'API\AccountAPIController@postData');
Route::post('enquiries', 'API\EnquiryAPIController@allEnquiry');
Route::get('students', 'API\StudentAPIController@getStudents');
Route::post('updateStudent/{id}', 'API\StudentAPIController@updateStudent');
Route::post('getHead', 'API\HeadAPIController@getHead');

Route::post('admissions', 'API\AdmissionAPIController@getAdmission');
Route::get('getUsers', 'API\UserController@getUsers');
Route::post('update/{id}', 'API\ProfileAPIController@update');
Route::get('getAdmission', 'API\getAdmissionsSupport@getAdmission');
Route::get('getBooks', 'API\getAdmissionsSupport@getBooks');

Route::post('getCourse', 'API\getSectionSupport@getCourse');
Route::post('getSection', 'API\getSectionSupport@getSection');
Route::post('saveAdmission', 'API\AdmissionAPIController@saveAdmission');

Route::post('packageSet', 'API\AccountAPIController@packageSet');
Route::post('deletePackage', 'API\AccountAPIController@deletePackage');
Route::post('custom_installment', 'API\AccountAPIController@custom_installment');
Route::post('edit_installment', 'API\AccountAPIController@edit_installment');
Route::post('deleteInstalment', 'API\AccountAPIController@deleteInstalment');
Route::post('installment_paid', 'API\AccountAPIController@installment_paid');

Route::get('getFeeStatus', 'API\AccountAPIController@getFeeStatus');
Route::get('getHeadsName', 'API\AccountAPIController@getHeadsName');
Route::post('head_paid/{id}', 'API\AccountAPIController@head_paid');
Route::post('update_headFine', 'API\AccountAPIController@update_headFine');
Route::post('deleteHeads/{id}', 'API\AccountAPIController@deleteHeads');

// Route::post('getReqSec', 'API\getSectionSupport@getReqSec');


