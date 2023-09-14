<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseContent;
use App\Models\Course;
use App\Models\Session;
use App\Models\CourseSubject;
use App\Models\TeacherSubject;
use App\Models\TimePeriod;
use App\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class CourseContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('coursecontents.index');
    }
    public function getCourseSemesterSubject(Request $request){
        $input = $request->all();
        $course_semester_subjects = CourseSubject::where('course_id','=',
            $input['selected_course_id'])->where('semester_id','='
            ,$input['selected_semester_id'])->get();

            return response()->json(['success' => 'true', 'course_semester_subjects' => $course_semester_subjects]);
        }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::get()->pluck('name','id');
        $sessions = Session::get()->pluck('session_name','id');
        return view('coursecontents.create')->with(['courses' => $courses,'sessions' => $sessions]);
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
        $subject_teachers = TeacherSubject::where('subject_id', '=', $input['subject_id'])->get();
        if ($subject_teachers) {
            foreach ($subject_teachers as $key => $teacher) {
                for($i=1;$i<=18;$i++){
                    $course_content = new CourseContent();
                    $course_content->course_id = $input['course_id'];
                    $course_content->session_id = $input['session_id'];
                    $course_content->semester_id = $input['semesters'];
                    $course_content->subject_id = $input['subject_id'];
                    // $course_content->lecture_days = $input['lecture_days'];
                    $course_content->week_id = $input['week_'.$i];
                    $course_content->planned_contents = $input['planned_contents'.$i];
                    $course_content->planned_activities = $input['planned_activities'.$i];
                    // $course_content->date = $input['date'.$i];
                    $course_content->user_id = $teacher->user_id;
                    // $course_content->status = $input['status'.$i];
                    $course_content->save();
                }
            }
        }

        return redirect()->back();
    }
    public function generateCourseContent(){
        $courses = Course::get()->pluck('name','id');
        return view('coursecontents.generate_course_content')->with(['courses' => $courses]);
    }
    public function CourseContentRecord(){
        $courses = Course::get()->pluck('name','id');
        return view('coursecontents.course_content_records')->with(['courses' => $courses]);
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

    public function editCourseContent(){
        $courses = Course::get()->pluck('name','id');
        return view('coursecontents.edit')->with(['courses' => $courses]);
    }
    public function getCourseContentSubjectDetail(Request $request){

        $input = $request->all();
        $course_content_subject_detail = CourseContent::where('course_id','=',$input['selected_course_id'])
        ->where('semester_id','=',$input['selected_semester_id'])
        ->where('subject_id','=',$input['selected_subject_id'])
        ->where('user_id','=',$input['selected_teacher_id'])->get();
        $course_detail = CourseSubject::where('course_id','=',$input['selected_course_id'])->get();
        $subject_teacher = TeacherSubject::where('subject_id','=',$input['selected_subject_id'])->get();
        $current_user_login = Auth::id();
        // if ($course_content_subject_detail) {
        //     $lecture_days = $course_content_subject_detail[0]['lecture_days'];
        // }

        $timeperiod_first = TimePeriod::where('course_id', $input['selected_course_id'])
        ->where('subject_id', $input['selected_subject_id'])
        ->where('user_id', $input['selected_teacher_id'])
        ->where('semester_id', $input['selected_semester_id'])->orderBy('id', 'desc')->first();

        $timeperiod_last = TimePeriod::where('course_id', $input['selected_course_id'])
        ->where('subject_id', $input['selected_subject_id'])
        ->where('user_id', $input['selected_teacher_id'])
        ->where('semester_id', $input['selected_semester_id'])->orderBy('id', 'asc')->first();
        $start_date = Carbon::parse($timeperiod_first->start_date);
        $end_date = Carbon::parse($timeperiod_last->end_date);
        if($timeperiod_first->timePeriodSubjectWeekDays->count() > 0)
        {
            foreach($timeperiod_first->timePeriodSubjectWeekDays as $timePeriodSubjectWeekDay)
            {
                $week_day_names[] = $timePeriodSubjectWeekDay->week_day_name;
            }
            $lecture_days = implode(',', $week_day_names);
        }
        else
        {
            $lecture_days = Carbon::parse($timeperiod_first->start_date)->format('l');
        }
        // dd(Carbon::parse($timeperiod_first->start_date)->format('w'));
        $total_weeks = $start_date->diffInWeeks($end_date);
        // dd($start_date->diffInWeeks($end_date));
        // for ($i=1; $i <= $total_weeks; $i++)
        // {

        // }
        $days_of_lecture_in_a_week = $timeperiod_first->timePeriodSubjectWeekDays->count();

        do
        {
            foreach ($timeperiod_first->timePeriodSubjectWeekDays as $key => $timePeriodSubjectWeekDay)
            {
                if($timePeriodSubjectWeekDay->week_day_id == $start_date->format('w'))
                {
                    $lecture_held_dates_in_a_week[$key] = $start_date->format('Y-m-d');
                }
            }
            if(!empty($lecture_held_dates_in_a_week))
            {
                $lecture_held_dates[] = implode(',', $lecture_held_dates_in_a_week);
            }
            $lecture_held_dates_in_a_week = array();
            $start_date = $start_date->addDay();
        } while ($start_date->format('Y-m-d') <= $end_date->format('Y-m-d'));
        $previous_date_week = 0;
        foreach ($lecture_held_dates as $key => $lecture_held_date)
        {
            $current_date_week = Carbon::parse($lecture_held_date)->format('W');
            if($key > 0)
            {
                $previous_date_week = Carbon::parse($lecture_held_dates[$key-1])->format('W');
                if($previous_date_week == $current_date_week)
                {
                    $Final_lecture_held_dates[] = $lecture_held_dates[$key-1].', '.$lecture_held_date;
                }
            }
            else
            {
                $Final_lecture_held_dates[] = $lecture_held_date;
            }
        }
        // dd(Carbon::parse($lecture_held_dates[2])->format('W'));

        return response()->json(['success' => 'true','course_content_subject_detail' => $course_content_subject_detail,'course_detail' => $course_detail, 'subject_teacher' => $subject_teacher, 'current_user_login' => $current_user_login, 'time_period' => $timeperiod_first, 'lecture_days' => $lecture_days, 'lecture_held_dates' => $Final_lecture_held_dates]);
    }
    public function getSubjectTeacherCourseContentDetail(Request $request){
        $input = $request->all();
        $current_user_login = Auth::id();
        $course_content_subject_detail = CourseContent::where('course_id','=',$input['selected_course_id'])
        ->where('semester_id','=',$input['selected_semester_id'])
        ->where('subject_id','=',$input['selected_subject_id'])
        ->where('user_id','=',$current_user_login)->get();
        return response()->json(['success' => 'true','course_content_subject_detail' => $course_content_subject_detail]);
    }
    public function getSubjectTeacher(Request $request){
        $input = $request->all();
        $subject_teacher = TeacherSubject::where('subject_id','=',$input['selected_subject_id'])->get();
        return response()->json(['success' => 'true', 'subject_teacher' => $subject_teacher]);
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
        $input = $request->all();
        $course_content = CourseContent::find($id);
        $course_content->lecture_days = $input['lecture_days_id'];
        $course_content->week_id = $input['week_id'];
        $course_content->planned_contents = $input['planned_contents_id'];
        $course_content->planned_activities = $input['planned_activities_id'];
        $course_content->date = $input['date_id'];
        $course_content->update();

        return response()->json(['success' => 'true']);
    }
    public function StatusUpdate(Request $request, $id){
        $input = $request->all();
        $course_content_status = CourseContent::find($id);
        $course_content_status->status = $input['content_status_id'];
        $course_content_status->update();
        return response()->json(['sucess' => 'true']);
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
