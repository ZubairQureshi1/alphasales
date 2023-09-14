<?php

namespace App\Http\Controllers;

use App\Models\Admission;
use App\Models\Course;
use App\Models\CourseAffiliatedBody;
use App\Models\CourseSubject;
use App\Models\OrganizationCampusWing;
use App\Models\Session;
use App\Models\SessionCourse;
use App\Models\SessionCourseSubject;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Wing;
use Flash;
use Globals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as SystemSession;
use Response;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $this->view["page-title"] = 'Product(s)';
        $courses = Course::select(
            'courses.id as ProductId',
            'courses.name as product_name',
            'plot_size',
            'plot_size_number',
            'nature_plot',
            'plot_type',
            'other_plot_type',
            'wings.name as project'
        )
            ->leftJoin('wings', 'wings.id', 'courses.project')
            ->get()->toArray();
        //dd($courses);
        $course_keys = [];
        if (count($courses) != 0) {
            for ($i = 0; $i < sizeof($courses); $i++) {
                $courses[$i]['replaced_name'] = Globals::replaceSpecialChar($courses[$i]['product_name']);
            };

            $course_keys = array_keys($courses[0]);
            $course_keys = \array_diff($course_keys, ["duration", "no_of_semesters", "duration_per_semester", "created_at", "updated_at", "deleted_at", "course_code", "vendor_share_amount", "degree_level_id", "organization_id", "wing_id"]);
        }
        // dd($courses);
        // dd($course_keys);
        return view('courses.index')
            ->with('courses', $courses)
            ->with(['course_keys' => $course_keys])
            ->with('pageTitle', $this->view["page-title"]);
    }

    public function create()
    {
        $subjects = Subject::all();
        $projects = Wing::all();
        $all_subjects = Subject::get()->pluck('name', 'id');
        return view('courses.create')->with(['subjects' => $subjects, 'all_subjects' => $all_subjects, 'projects' => $projects]);
    }

    public function show(Request $request)
    {
        return $request;
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $input = $request->all();
        if (!is_null($input['plot_type_resid'])) {
            $input['plot_type'] = $input['plot_type_resid'];
        } else {
            $input['plot_type'] = $input['plot_type_com'];
        }
        // dd($input['plot_type']);

        try {
            \DB::beginTransaction();
            $course = new Course;

            $course->name = $input['name'];
            $course->plot_size = $input['plot_size'];
            $course->plot_size_number = $input['plot_size_number'];
            $course->nature_plot = $input['nature_plot'];
            $course->plot_type = $input['plot_type'];
            $course->other_plot_type = $input['other_plot_type'];
            $course->project = $input['project'];

            //  $course->course_code = $input['course_code'];
            //  $course->vendor_share_amount = $input['vendor_share_amount'];

            $course->save($input);
            // $semesters = array_filter($input['semesters']);
            if(isset($input['affiliated_body_ids']))
            {
                foreach ($input['affiliated_body_ids'] as $key => $id) {
                    $course_affiliated_body = new CourseAffiliatedBody();
                    $course_affiliated_body->affiliated_body_id = $id;
                    $course_affiliated_body->academic_term_id = $input['academic_term_ids'][$key];
                    $course_affiliated_body->course_id = $course->id;
                    $course_affiliated_body->save();
                }
                
            }
            // foreach ($input['subjects'] as $key => $value) {

            //     $courseSubject = new CourseSubject;
            //     $subject = Subject::where('id', '=', $input['subjects'][$key])->first();
            //     $courseSubject->subject_id = $input['subjects'][$key];
            //     $courseSubject->subject_name = $subject->name;
            //     $courseSubject->semester_id = $input['semesters'][$key];
            //     $courseSubject->credit_hours = $input['credit_hours'][$key];
            //     $courseSubject->prerequisite_subject = $input['prerequisite_subject_id'][$key];
            //     $courseSubject->mid_term_attendance_percentage = $input['mid_term_attendance_percentage'][$key];
            //     $courseSubject->final_term_attendance_percentage = $input['final_term_attendance_percentage'][$key];
            //     $courseSubject->semester = config('constants.semesters_years')[$input['semesters'][$key]];
            //     $courseSubject->course_id = $course->id;
            //     $courseSubject->course_name = $course->name;
            //     $courseSubject->save();
            // }

            if ($course) {
                Flash::success('course added successfully.');
            } else {
                Flash::error('Something went wrong while adding subjects.');
            }

            \DB::commit();
            return redirect(route('courses.index'));
        } catch (Exception $e) {
            \DB::rollback();
        }
    }

    public function edit($id)
    {
        $subjects = Subject::all();
        $all_subjects = Subject::get()->pluck('name', 'id');
        $course = Course::where('id', '=', $id)->first();
        $projects = Wing::all();
        // $course = Course::select('courses.*', 'wings.name as project')
        // ->leftJoin('wings', 'wings.id', 'courses.project')
        // ->where('courses.id', '=', $id)->first();

        //dd($course);
        //dd($course['plot_type']);
        $courseSubject = $course->courseSubjects;
        foreach ($subjects as $key => $subject) {
            foreach ($courseSubject as $course_key => $hassubject) {
                if (!$subject['isChecked']) {
                    if ($subject->id == $hassubject->subject_id) {
                        $subject->isChecked = true;
                        $subject->semester_id = $hassubject->semester_id;
                        $subject->prerequisite_subject = $hassubject->prerequisite_subject;
                        $subject->credit_hours = $hassubject->credit_hours;
                        $subject->mid_term_attendance_percentage = $hassubject->mid_term_attendance_percentage;
                        $subject->final_term_attendance_percentage = $hassubject->final_term_attendance_percentage;
                    } else {
                        $subject->isChecked = false;
                    }
                }
            }
        }
        // dd($subjects->toArray());
        return view('courses.edit')->with(['subjects' => $subjects, 'course' => $course, 'all_subjects' => $all_subjects, 'projects' => $projects]);

        /* if ($course) {
    return view('courses.index')->with('course', $course);
    } else {
    Flash::error('Something went wrong while adding course.');
    }

    return redirect(route('courses.index'));
     */
    }

    public function update($id, Request $request)
    {
        //dd($request->all());
        try {
            \DB::beginTransaction();
            $input = $request->all();
            if (!is_null($input['plot_type_resid'])) {
                $input['plot_type'] = $input['plot_type_resid'];
            } else {
                $input['plot_type'] = $input['plot_type_com'];
            }

            // if (isset($input['plot_type'])) {
            //     echo "Yes, mail is set";
            // } else {
            //     echo "N0, mail is not set";
            // }

            $course = Course::find($id);
            // dd($course);

            $course->name = $input['name'];
            $course->plot_size = $input['plot_size'];
            $course->plot_size_number = $input['plot_size_number'];
            $course->nature_plot = $input['nature_plot'];
            $course->plot_type = $input['plot_type'];
            $course->other_plot_type = $input['other_plot_type'];
            $course->project = $input['project'];



            // $course->name = $input['name'];
            // $course->duration = $input['duration'];
            // $course->no_of_semesters = $input['no_of_semesters'];
            // $course->duration_per_semester = $input['duration_per_semester'];

            // $course->course_code = $input['course_code'];
            // $course->vendor_share_amount = $input['vendor_share_amount'];
            // $course->degree_level_id = $input['degree_level_id'];

            $course->update();

            //     $course_subjects = $course->courseSubjects;

            //     $course_subject_array = [];
            //     $count = 0;
            //     foreach ($course_subjects as $course_subject) {
            //         $course_subject_array[$count] = $course_subject['subject_id'];
            //         $count++;
            //     }
            //     $subject_to_update = $course_subject_array;

            //     if (!empty($input['subjects'])) {
            //         $subjects_to_add = array_diff($input['subjects'], $course_subject_array);
            //     }

            //     if (!empty($subjects_to_add)) {
            //         foreach ($subjects_to_add as $key => $item) {
            //             $subject_object = [
            //                 'course_id' => $course->id, 'course_name' => $course->name, 'subject_id' => $item,
            //                 'subject_name' => Subject::find($item)->name, 'semester_id' => $input['semesters'][$key],
            //                 'prerequisite_subject_id' => $input['prerequisite_subject_id'][$key], 'credit_hours' => $input['credit_hours'][$key],
            //                 'mid_term_attendance_percentage' => $input['mid_term_attendance_percentage'][$key], 'final_term_attendance_percentage' => $input['final_term_attendance_percentage'][$key],
            //                 'semester' => config('constants.semesters_years')[$input['semesters'][$key]]
            //             ];
            //             if (empty($subject_object)) {

            //                 dd("subject not found");
            //             }

            //             $subject = CourseSubject::create($subject_object);
            //         }
            //     }

            //     $subjects_to_delete = array_diff($course_subject_array, $input['subjects']);
            //     if (!empty($subjects_to_delete)) {
            //         foreach ($subjects_to_delete as $item) {
            //             $subject_object = CourseSubject::where('course_id', '=', $id)->where('subject_id', '=', $item)->get()->first();
            //             if (!empty($subject_object)) {
            //                 $subject_object->delete();
            //                 //dd($subject_object);
            //             }
            //         }
            //     }

            //     $subject_to_update = array_diff($course_subject_array, $subjects_to_delete);
            //     $subject_to_update = array_values($subject_to_update);

            //     foreach ($subject_to_update as $key => $update_subject) {
            //         $subject = [
            //             'course_id' => $course->id, 'course_name' => $course->name, 'subject_id' => $update_subject,
            //             'subject_name' => Subject::find($update_subject)->name, 'semester_id' => $input['semesters'][$key],
            //             'prerequisite_subject_id' => $input['prerequisite_subject_id'][$key], 'credit_hours' => $input['credit_hours'][$key],
            //             'mid_term_attendance_percentage' => $input['mid_term_attendance_percentage'][$key], 'final_term_attendance_percentage' => $input['final_term_attendance_percentage'][$key],
            //             'semester' => config('constants.semesters_years')[$input['semesters'][$key]]
            //         ];

            //         \Log::info($update_subject);
            //         $update_subject = CourseSubject::where('course_id', '=', $id)->where('subject_id', '=', $update_subject)->first()->update($subject);
            //     }

            $course->courseAffiliatedBodies()->delete();
            if(isset($input['affiliated_body_ids']))
            {
                foreach ($input['affiliated_body_ids'] as $key => $id) {
                    $course_affiliated_body = new CourseAffiliatedBody();
                    $course_affiliated_body->affiliated_body_id = $id;
                    $course_affiliated_body->academic_term_id = $input['academic_term_ids'][$key];
                    $course_affiliated_body->course_id = $course->id;
                    $course_affiliated_body->save();
                }
            }


            // foreach ($input['affiliated_body_ids'] as $key => $id) {
            //     $course_affiliated_body = new CourseAffiliatedBody();
            //     $course_affiliated_body->affiliated_body_id = $id;
            //     $course_affiliated_body->academic_term_id = $input['academic_term_ids'][$key];
            //     $course_affiliated_body->course_id = $course->id;
            //     $course_affiliated_body->save();
            // }

            if (!empty($course)) {
                Flash::success('course details updated successfully.');
            } else {
                Flash::error('Something went wrong while adding course.');
            }

            \DB::commit();
            return redirect(route('courses.index'));
        } catch (Exception $e) {
            \DB::rollback();
        }
    }

    public function destroy($id)
    {
        try {
            \DB::beginTransaction();
            $course = Course::find($id);

            if (empty($course)) {
                Flash::error('course not found');

                return redirect(route('courses.index'));
            }

            $courseSubjects = CourseSubject::where('course_id', '=', $course->id)->count();
            if ($courseSubjects > 0) {
                // foreach ($followups as $key => $followup) {
                CourseSubject::where('course_id', '=', $course->id)->delete();
                // }
            }
            $course_affiliated_bodies = CourseAffiliatedBody::where('course_id', '=', $course->id)->count();
            if ($course_affiliated_bodies > 0) {
                // foreach ($followups as $key => $followup) {
                CourseAffiliatedBody::where('course_id', '=', $course->id)->delete();
                // }
            }
            $course->delete();

            Flash::success('courses deleted successfully.');

            \DB::commit();
            return redirect(route('courses.index'));
        } catch (Exception $e) {
            \DB::rollback();
        }
    }

    public function getCourseDetails(Request $request)
    {
        $input = $request->all();
        $course = Course::find($input['id']);
        $courseSubjects = SessionCourseSubject::where('organization_campus_id', $input['organization_campus_id'] ?? SystemSession::get('organization_campus_id'))->where('session_id', '=', $input['session_id'])->where('course_id', '=', $course->id)->get();
        // $courseSections = $course->sectionCourses()->get();
        $courseSections = [];
        $sessionCount = count($course->courseSessions()->get()->toArray());
        $courseSessions = $course->courseSessions()->get();
        $db_course_students = Student::where('course_id', '=', $course->id)->get();
        $total_students = count($db_course_students);
        return response()->json(['success' => 'true', 'subjects' => $courseSubjects, 'sections' => $courseSections, 'sessions' => $courseSessions, 'total_students' => $total_students]);
    }

    public function getCourseSubjects(Request $request)
    {
        $input = $request->all();
        return response()->json([
            'success' => 'true',
            'subjects' => Course::find($input['id'])->courseSubjects()->get(),
        ]);
    }

    public function getStudentCourseSubjects(Request $request)
    {
        // dd(SessionCourseSubject::where('organization_campus_id', $request->organization_campus_id ?? SystemSession::get('organization_campus_id'))
        //         ->where('session_id', $request->student['session_id'])
        //         ->where('course_id', $request->course)
        //         ->where('annual_semester', $request->student['annual_semester'])
        //         ->orderBy('annual_semester', 'ASC')->get()->toArray());
        return response()->json([
            'success' => 'true',
            'subjects' => SessionCourseSubject::where('organization_campus_id', $request->student['organization_campus_id'] ?? SystemSession::get('organization_campus_id'))
                ->where('session_id', $request->student['session_id'])
                ->where('course_id', $request->course)
                ->where('annual_semester', $request->student['annual_semester'])
                ->orderBy('annual_semester', 'ASC')->get(),
        ]);
    }

    public function getCourseSessions(Request $request)
    {
        return response()->json([
            'success' => 'true',
            'sessions' => Course::find($input['id'])->courseSubjects()->get(),
        ]);
    }

    public function getCourseSections(Request $request)
    {
        return response()->json([
            'success' => 'true',
            'sections' => Course::find($input['id'])->sections()->get(),
        ]);
    }

    public function getDegreeLevelDetails(Request $request)
    {
        return response()->json([
            'success' => 'true',
            'courses' => Course::where('degree_level_id', $request->id)->get(),
        ]);
    }
    public function getCourseAffiliatedBodies(Request $request)
    {
        return response()->json([
            'success' => 'true',
            'courseAffiliatedBodies' => CourseAffiliatedBody::where(
                'organization_campus_id',
                SystemSession::get('organization_campus_id')
            )
                ->where('course_id', $request->id)
                ->with(['affiliatedBody'])
                ->get(),
        ]);
    }
    public function getAffiliatedBodySessions(Request $request)
    {
        return response()->json([
            'success' => 'true',
            'sessions' => Session::where('affiliated_body_id', $request->id)->get(),
        ]);
    }
    public function getCoursesBySession(Request $request, $session_id)
    {
        $courses = SessionCourse::where('session_id', $session_id)
            ->whereIn('wing_id', OrganizationCampusWing::where('organization_campus_id', $request->organization_campus ?? SystemSession::get('organization_campus_id'))->pluck('wing_id'))
            ->where('is_active', true)
            ->groupBy('course_id')
            ->get();
        if (is_null(SystemSession::get('selected_session_id'))) {
            $session = SystemSession::put(['selected_session_id' => $session_id]);
        }
        return response()->json(['success' => 'true', 'courses' => $courses]);
    }
    public function getCoursesBySessionOnly($session_id)
    {
        $courses = SessionCourse::where('session_id', $session_id)->where('is_active', true)->groupBy('course_id')->get();
        if (is_null(SystemSession::get('selected_session_id'))) {
            $session = SystemSession::put(['selected_session_id' => $session_id]);
        }
        return response()->json(['success' => 'true', 'courses' => $courses]);
    }
    public function getAffiliatedBodiesByCourse(Request $request)
    {
        $affiliated_bodies = SessionCourse::where('session_id', $request->session_id)
            ->where('course_id', $request->course_id)
            ->where('organization_campus_id', isset($request->organization_campus) ? $request->organization_campus : SystemSession::get('organization_campus_id'))
            ->groupBy('affiliated_body_id')
            ->get();

        return response()->json([
            'success' => 'true',
            'affiliated_bodies' => $affiliated_bodies,
        ]);
    }
    public function getDegreeTypesByBody(Request $request)
    {
        $academic_terms = SessionCourse::where('session_id', $request->session_id)
            ->where('course_id', $request->course_id)
            ->where('affiliated_body_id', $request->affiliated_body_id)
            ->where('organization_campus_id', isset($request->organization_campus) ? $request->organization_campus : SystemSession::get('organization_campus_id'))
            ->get();
        return response()->json(['success' => 'true', 'academic_terms' => $academic_terms]);
    }
    public function getCoursePlans(Request $request)
    {
        $input = $request->all();
        $sessionCourse = SessionCourse::where('organization_campus_id', $input['organization_campus_id'] ?? SystemSession::get('organization_campus_id'))->where('session_id', '=', $input['session_id'])->where('course_id', $input['course_id'])->where('affiliated_body_id', $input['affiliated_body_id'])->where('academic_term_id', $input['body_academic_term_id'])->first();
        $admission_count = Admission::where('session_id', '=', $input['session_id'])->where('course_id', $input['course_id'])->count();
        $form_display = false;
        // dd($admission_count, $sessionCourse->quota);
        $message = "";
        if ($sessionCourse->is_active) {
            if ($admission_count <= $sessionCourse->quota) {
                $form_display = true;
            } else {
                $message = "Qouta exceeded.";
            }
        } else {
            $message = "Selected campus does not offer the selected degree of selected affiliated body.";
        }
        return response()->json(['success' => $form_display, 'sessionCourse' => $sessionCourse, 'form_display' => $form_display, 'message' => $message]);
    }
}
