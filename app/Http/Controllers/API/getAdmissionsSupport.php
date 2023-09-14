<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseSubject;
use App\Models\Reference;
use Illuminate\Http\Request;

class getAdmissionsSupport extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$ref=Reference:: get();  $admissions=User::get();
        // return $ref;
    }

    public function getBooks(Request $request)
    {
        $books_input = $request->all();
        \Log::info($books_input);
        $books_cours = CourseSubject::where('course_id', '=', $books_input['id'])->get();
        return response()->json(['books_cours' => $books_cours]);
    }

    public function getAdmission()
    {
        $ref = Reference::get();

        $cours = Course::get();
        $academic_types = config('constants.academic_types');
        $admission_types = config('constants.student_categories');

        return response()->json(['ref' => $ref, 'admission_types' => $admission_types, 'academic_types' => $academic_types, 'cours' => $cours]);

        // $ref=Course:: get();
        // return $ref;

        //    return $admission_types;

        // $academic_types = config('constants.academic_types');
        //   return $academic_types;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

}
