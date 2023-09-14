<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DateSheet;
use App\Models\ExamType;
use App\Models\Session;
use App\Models\Course;
use App\Models\Section;
use App\Models\Subject;
use App\Models\DateSheetSection;
use App\Models\DateSheetBook;
use App\Models\CourseSubject;
use App\Models\StudentBook;
use App\Models\Student;
use App\Models\DateSheetRoom;
use App\Models\Room;
use App\Models\DateSheetSittingPlan;
use App\User;
use App\Models\TeacherSubject;

class ResultController extends Controller
{
    public function FacultySubject(Request $request){
        $users = User::with('roles')->get();
        $subjects = Subject::get()->pluck('name','id');
        $data = TeacherSubject::get()->groupBy('user_name');
        return view('users.faculty_subject')->with(['users'=>$users,'subjects'=>$subjects,'data'=>$data]);
    }
    public function getSubjectTeacher(Request $request){
        $input = $request->all();
        $subject_teacher = User::where('id','=',$input['selected_teacher_id'])->get();
        if($subject_teacher[0]->faculty_type == 0){
            $user_subject_teacher = TeacherSubject::where('user_id','=',$input['selected_teacher_id'])->get();
            $visitor_teacher_count = count($user_subject_teacher);
            return response()->json(['success' => 'true', 'subject_teacher' => $subject_teacher,'visitor_teacher_count' => $visitor_teacher_count ]);
        }
        else{
          return response()->json(['success' => 'true', 'subject_teacher' => $subject_teacher]);
        }
    }
    public function store(Request $request){
        $input = $request->all();
        // $user_subject_limit = TeacherSubject::where('user_id','=',$input['user_id'])->get();
        // if(count($user_subject_limit)<6){
        foreach($input['subject_id'] as $subject){
            $teacher_subjects = new TeacherSubject();
            $teacher_subjects->user_id=$input['user_id'];
            $teacher_subjects->subject_id=$subject;
            $teacher_subjects->save();           
        }
            // }
        // else{
        //     dd("Maximum Subject Limit is 6");
        // }
        return redirect('FacultySubjects');
    }
    public function edit($id){
        $teacher_subject=TeacherSubject::findorFail($id);
        $users = User::with('roles')->get();
        $subjects = Subject::get()->pluck('name','id');
        return view('users.edit_facult_subject')->with(['users'=>$users,'subjects'=>$subjects,'teacher_subject'=>$teacher_subject]);
    }
    public function update($id,Request $request){
        $input=$request->all();
        $teacher_subject = TeacherSubject::findorFail($id);
        $teacher_subject->user_id=$request->get('user_id');
        $teacher_subject->subject_id=$request->get('subject_id');
        $teacher_subject->update();
        return redirect('FacultySubjects');
    }
    public function delete($id){
        $teacher_subject = TeacherSubject::findorFail($id);
        $teacher_subject->delete();
        return redirect('FacultySubjects');
    }
    public function getSubjectUsers(Subject $subject)
    {
        $teacher_subjects = TeacherSubject::where('subject_id', $subject->id)->get()->pluck('user_id');
        // dd($teacher_subjects);
        foreach($teacher_subjects as $key => $teacher_subject)
        {
            $user_ids[$key] = $teacher_subject;
        }
        $users = User::whereIn('id', $user_ids)->get()->pluck('name', 'id');
        return view('ajax.faculty-partial-view')
        ->with('users', $users);
    }
}
