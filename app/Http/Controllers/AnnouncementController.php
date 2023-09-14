<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $announcements = Announcement::get();
        $courses = Course::get()->pluck('name','id');
        $subjects = Subject::get()->pluck('name','id');
        return view('academics.announcements.index')->with(['announcements' => $announcements, 'courses' => $courses, 'subjects' => $subjects]);
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
        $input = $request->all();
        $announcements = new Announcement();
        $announcements->title = $input['title'];
        $announcements->description = $input['description'];
        $announcements->part_id = $input['part'];
        $announcements->course_id = $input['course_id'];
        $announcements->subject_id = $input['subject_id'];

        $announcements->save();
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
    public function edit($id)
    {
        $announcements = Announcement::find($id);
        $courses = Course::get()->pluck('name','id');
        $subjects = Subject::get()->pluck('name','id');
        return view('academics.announcements.edit')->with(['announcements' => $announcements, 'courses' => $courses, 'subjects' => $subjects]);
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
        $announcements = Announcement::find($id);
        $announcements->title = $request->get('title');
        $announcements->description = $request->get('description');
        $announcements->part_id = $request->get('part_id');
        $announcements->course_id = $request->get('course_id');
        $announcements->subject_id = $request->get('subject_id');

        $announcements->update();
        return redirect()->route('announcements.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $announcements = Announcement::find($id);
        $announcements->delete();
        return redirect()->back();
    }
}
