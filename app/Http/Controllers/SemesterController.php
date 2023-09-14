<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Session;
use App\Models\Semester;
use Flash;
class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $semesters = Semester::all();
        return view('semesters.index')
        ->with('semesters', $semesters);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::get()->pluck('name','id');
        $sessions = Session::get()->pluck('session_name', 'id');
        return view('semesters.create')->with(['courses' => $courses,'sessions' => $sessions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $semester = new Semester();
        $semester->semester = $input['semester'];
        $semester->course_id = $input['course_id'];
        $semester->session_id = $input['session_id'];
        $semester->min_discount = $input['min_discount'];
        $semester->max_discount = $input['max_discount'];
        $semester->min_installments = $input['min_installments'];
        $semester->max_installments = $input['max_installments'];
        $semester->save();
        return redirect()->back();
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
    public function edit(Semester $semester)
    {

        $courses = Course::get()->pluck('name','id');
        $sessions = Session::get()->pluck('session_name', 'id');
        return view('semesters.edit')
        ->with('semester', $semester)
        ->with(['courses' => $courses,'sessions' => $sessions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Semester $semester)
    {
        $input = $request->all();
        $semester = $semester->update($input);
        return 'semester updated successfully';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $semester = Semester::find($id);

        if (empty($semester)) {
            Flash::error('Semester not found');

            return redirect(route('semesters.index'));
        }

        $semester->delete();

        Flash::success('Semester deleted successfully.');

        return redirect(route('semester.index'));
    }
}
