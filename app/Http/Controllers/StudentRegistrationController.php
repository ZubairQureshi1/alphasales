<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\models\StudentRegistration;
use Helmesvs\Notify\Facades\Notify;
use Illuminate\Http\Request;

class StudentRegistrationController extends Controller
{
    public function store(Request $request, Student $student)
    {
    	$input = $request->all();

    	$input['student_id'] 				= $student->id;
    	$input['admission_id']  			= $student->admission_id;
    	$input['academic_history_id']   	= $student->studentAcademicHistories->last()->id;
    	$input['organization_id'] 	    	= $student->organization_id ;
    	$input['organization_campus_id'] 	= $student->organization_campus_id;
    	$input['academic_wing_id'] 	    	= $student->academic_wing_id;
		
		StudentRegistration::create($input);

		Notify::success('Student Registration Created Successfully', 'Success');  	
    	return redirect()->back();
    }

    public function update(Request $request, StudentRegistration $studentRegistration)
    {
    	// update
    	$studentRegistration->update($request->all());
    	// redirect
    	Notify::success('Student Registration Updated Successfully', 'Success');  
    	return redirect()->back();
    }

}
