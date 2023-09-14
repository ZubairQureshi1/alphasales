<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\Session;
use App\Models\Course;
use App\Models\SessionCourse;
use App\Models\CourseSubject;




class getSectionSupport extends Controller
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
    public function getSection ( Request $request){
        //$sections=Section::where('course_id','=',$input['id'])->get(); 

         $input = $request->all();
        \Log::info($input);
        $sections=Section::where('course_id','=',$input['id'])->get(); 

         $sess_input = $request->all();
        \Log::info($sess_input);
        $sess_cours=SessionCourse::where('course_id','=',$sess_input['id'])->get(); 

        $input = $request->all();
        \Log::info($input);
        $books_cours=CourseSubject::where('course_id','=',$input['id'])->get();
        // return response()->json(['books_cours'=>$books_cours]);

       
       // $sess=Session:: get();

        return response()->json(['sections'=>$sections,'sess_cours'=>$sess_cours,'books_cours'=>$books_cours]); 
        // return $sections;
    }


     public function getCourse ( Request $request){

        $sess_input = $request->all();
        \Log::info($sess_input);
        $sess_cours=SessionCourse::where('course_id','=',$sess_input['id'])->get(); 
         return response()->json(['sess_cours'=>$sess_cours]); 

     }



    public function getReqSec(Request $request){
         $sec_input = $request->all();
        \Log::info($sec_input);
        $sec_cours=Session::where('id','=',$input['course_id'])->get();
        return response()->json(['sec_cours'=>$sec_cours]); 

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
        //
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
