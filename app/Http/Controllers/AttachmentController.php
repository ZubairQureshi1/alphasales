<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Session;
use App\Models\Student;
use App\Models\StudentAttachment;
use Illuminate\Http\Request;

class AttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessions = Session::get()->pluck('session_name', 'id');
        $courses = Course::get()->pluck('name', 'id');
        return view('registrationManagement.attachments.index')->with(['courses' => $courses, 'sessions' => $sessions]);
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
    public function getCourseSessionStudent(Request $request)
    {
        $input = $request->all();

        $students = Student::where('course_id', '=', $input['selected_course_id'])
            ->where('session_id', '=', $input['selected_session_id'])->get();

        return response()->json(['success', true, 'student' => $students]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        dd('here');
        $data = $request->all();
        $input = json_decode($data['data'], true);
        // dd($data['files']);
        foreach ($data['files'] as $key => $file) {
            $attachment = new StudentAttachment();
            $attachment_file_name = $file->getClientOriginalName();
            $attachment_file_name = time() . $attachment_file_name;
            $attachment_file_destination = public_path('/files');
            $file->move($attachment_file_destination, $attachment_file_name);
            $attachment->attachment_name = $input['student_id'] . '-' . "Attachment";
            $attachment->attachment_url = $attachment_file_name;
            $attachment->attachment_from = "App\Models\Admission";
            $attachment->attachment_type_id = $input['attachment_type'][$key];
            $attachment->attachment_for = $input['student_id'];
            $attachment->save();
        }
        return response()->json(['success', true]);
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
