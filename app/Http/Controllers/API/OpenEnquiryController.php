<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SessionCourse;
use Illuminate\Http\Request;

class OpenEnquiryController extends Controller
{
    public function getAffiliatedBodiesByCourse(Request $request)
    {
        $data = SessionCourse::where('session_id', $request->session_id)
        					->where('course_id', $request->course_id)
        					->groupBy('affiliated_body_id')
        					->get();
        // response
        return response()->json([
        		'success' => 'true', 
        		'affiliated_bodies' => $data
        ]);
    }

    public function getDegreeTypesByBody(Request $request)
    {
        $data = SessionCourse::where('session_id', $request->session_id)
        					   ->where('course_id', $request->course_id)
        					   ->where('affiliated_body_id', $request->affiliated_body_id)
        					   ->get();
        // response
        return response()->json([
        		'success' => 'true', 
        		'academic_terms' => $data
        ]);
    }
}
