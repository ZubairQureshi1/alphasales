<?php

namespace App\Http\Controllers;

use App\Models\AffiliatedBody;
use App\Models\Course;
use App\Models\Section;
use App\Models\SectionAffiliatedBody;
use App\Models\SectionDetail;
use App\Models\SectionTeacher;
use App\Models\SessionCourse;
use App\Models\SessionCourseSubject;
use App\Models\Student;
use App\Models\StudentAcademicHistory;
use App\Models\StudentBook;
use App\Models\Wing;
use App\User;
use DB;
use Helmesvs\Notify\Facades\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as SystemSession;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::where('organization_campus_id', SystemSession::get('organization_campus_id'))
            ->has('sectionDetails')
            ->with('sectionDetails', 'sectionDetails.sectionSubjectDetails')
            ->latest()
            ->get();
        // return $sections;
        return view('sections.index', [
            'sections' => $sections,
        ]);
    }

    public function show()
    {
    }

    public function create()
    {
        $wings = Wing::all()->pluck('name', 'id');
        return view('sections.create')->with(['wings' => $wings]);
    }

    public function edit(Section $section)
    {
        $wings = Wing::all()->pluck('name', 'id');
        return view('sections.edit', [
            'wings'   => $wings,
            'section' => $section,
        ]);
    }

    public function update(Request $request)
    {
        $input                = $request->all();
        $wingId               = $request['section']['wing_id'];
        $courseId             = $request['section']['course_id'];
        $subjectId            = $request['section']['subject_id'];
        $sectionName          = $request['section']['section_name'];
        $sectionCode          = $request['section']['section_code'];
        $affiliatedBodyId     = $request['section']['affiliated_body_id'];
        $active               = $request['section']['active'];
        $strength             = $request['section']['strength'];
        $teacherHelper        = $request['section']['teacher_helper'];
        $teacherHelperName    = $request['section']['teacher_helper_name'];
        $teacherPrimary       = $request['section']['teacher_primary'];
        $teacherPrimaryName   = $request['section']['teacher_primary_name'];
        $organizationCampusId = SystemSession::get('organization_campus_id');
        $sessionId            = SystemSession::get('selected_session_id');
        $sectionId            = $request['section']['section_id'];

        $section                         = Section::where('id', '=', $sectionId)->first();
        $section->wing_id                = $wingId;
        $section->subject_id             = $subjectId;
        $section->course_id              = $courseId;
        $section->name                   = $sectionName;
        $section->Code                   = $sectionCode;
        $section->strength               = $strength;
        $section->active                 = $active;
        $section->organization_campus_id = $organizationCampusId;
        $section->session_id             = $sessionId;
        $section->save();

        $getSectionId                      = Section::orderBy('id', 'desc')->first();
        $sectionTeacherPrimary             = SectionTeacher::where('section_id', '=', $sectionId)->first();
        $sectionTeacherPrimary->user_id    = $teacherPrimary;
        $sectionTeacherPrimary->user_name  = $teacherPrimaryName;
        $sectionTeacherPrimary->section_id = $sectionId;
        $sectionTeacherPrimary->type       = 1;
        $sectionTeacherPrimary->save();

        foreach ($teacherHelper as $val) {
            $teacherHelperDetail  = User::where('id', '=', $val)->first();
            $sectionTeacherHelper = new SectionTeacher;
            // $sectionTeacherHelper = SectionTeacher::where('section_id', '=', $sectionId)->first();
            $sectionTeacherHelper->user_id    = $teacherHelperDetail->id;
            $sectionTeacherHelper->user_name  = $teacherHelperDetail->name;
            $sectionTeacherHelper->section_id = $sectionId;
            $sectionTeacherHelper->type       = 2;
            $sectionTeacherHelper->save();
        }

        foreach ($affiliatedBodyId as $val) {
            $affiliatedBodyDetail               = AffiliatedBody::where('id', '=', $val)->first();
            $affiliatedBody                     = SectionAffiliatedBody::where('section_id', '=', $sectionId)->first();
            $affiliatedBody->section_id         = $getSectionId->id;
            $affiliatedBody->affiliated_body_id = $affiliatedBodyDetail->id;
            $affiliatedBody->save();
        }
    }

    public function store(Request $request)
    {
        $input                = $request->all();
        $wingId               = $request['section']['wing_id'];
        $courseId             = $request['section']['course_id'];
        $subjectId            = $request['section']['subject_id'];
        $sectionName          = $request['section']['section_name'];
        $sectionCode          = $request['section']['section_code'];
        $affiliatedBodyId     = $request['section']['affiliated_body_id'];
        $active               = $request['section']['active'];
        $strength             = $request['section']['strength'];
        $teacherHelper        = $request['section']['teacher_helper'];
        $teacherHelperName    = $request['section']['teacher_helper_name'];
        $teacherPrimary       = $request['section']['teacher_primary'];
        $teacherPrimaryName   = $request['section']['teacher_primary_name'];
        $organizationCampusId = SystemSession::get('organization_campus_id');
        $sessionId            = SystemSession::get('selected_session_id');

        $section                         = new Section;
        $section->wing_id                = $wingId;
        $section->subject_id             = $subjectId;
        $section->course_id              = $courseId;
        $section->name                   = $sectionName;
        $section->Code                   = $sectionCode;
        $section->strength               = $strength;
        $section->active                 = $active;
        $section->organization_campus_id = $organizationCampusId;
        $section->session_id             = $sessionId;
        $section->save();

        $getSectionId                      = Section::orderBy('id', 'desc')->first();
        $sectionTeacherPrimary             = new SectionTeacher;
        $sectionTeacherPrimary->user_id    = $teacherPrimary;
        $sectionTeacherPrimary->user_name  = $teacherPrimaryName;
        $sectionTeacherPrimary->section_id = $getSectionId->id;
        $sectionTeacherPrimary->type       = 1;
        $sectionTeacherPrimary->save();

        foreach ($teacherHelper as $val) {
            $teacherHelperDetail              = User::where('id', '=', $val)->first();
            $sectionTeacherHelper             = new SectionTeacher;
            $sectionTeacherHelper->user_id    = $teacherHelperDetail->id;
            $sectionTeacherHelper->user_name  = $teacherHelperDetail->name;
            $sectionTeacherHelper->section_id = $getSectionId->id;
            $sectionTeacherHelper->type       = 2;
            $sectionTeacherHelper->save();
        }

        foreach ($affiliatedBodyId as $val) {
            $affiliatedBodyDetail               = AffiliatedBody::where('id', '=', $val)->first();
            $affiliatedBody                     = new SectionAffiliatedBody;
            $affiliatedBody->section_id         = $getSectionId->id;
            $affiliatedBody->affiliated_body_id = $affiliatedBodyDetail->id;
            $affiliatedBody->save();
        }
    }

    public function destroy($section)
    {
        $section = Section::find($section);
        if (empty($section)) {
            Notify::error('Section Not Found!');
        }
        // NOTE: set null section related columns in student books table
        $section->studentBooks()->update([
            'section_id'                => null,
            'section_name'              => null,
            'section_detail_id'         => null,
            'section_subject_detail_id' => null,
        ]);
        $section->delete();
        Notify::success('Section Deleted Successfully!', 'Action Status');
        return redirect()->back();
    }

    public function getCourseList(Request $request)
    {
        $courses = SessionCourse::where('wing_id', '=', $request->wing)
            ->where('session_id', '=', SystemSession::get('selected_session_id'))
            ->where('organization_campus_id', '=', SystemSession::get('organization_campus_id'))
            ->get()
            ->pluck('course_name', 'course_id');
        return response()->json($courses, 200);
    }

    public function getAffilatedBodiesList($course_id)
    {
        // $course = Course::where('wing_id', '=', $wing_id)->orderBy('wing_id', 'ASC')->get()->pluck('name', 'id');
        // return response()->json(['success' => 'true', 'course' => $course]);

        // $affiliatedBodies = AffiliatedBody::where('')->leftjoin('course_affiliated_bodies', 'course_affiliated_bodies.affiliated_body_id', '=', 'affiliated_bodies.id')->get()->pluck('name','id');
        $affiliatedBodies = AffiliatedBody::select('affiliated_bodies.id', 'affiliated_bodies.name')->leftjoin('session_courses', 'session_courses.affiliated_body_id', 'affiliated_bodies.id')->groupBy('affiliated_bodies.id')->get();
        // dd($affiliatedBodies);
        return response()->json(['success' => 'true', 'affiliatedBodies' => $affiliatedBodies]);
    }

    public function getCourseAcademicTerms($course_id, $wing_id)
    {
        $terms = SessionCourse::where('course_id', '=', $course_id)
            ->where('wing_id', '=', $wing_id)
            ->where('session_id', '=', SystemSession::get('selected_session_id'))
            ->where('organization_campus_id', '=', SystemSession::get('organization_campus_id'))
            ->where('is_active', true)
            ->first();
        return $terms->sessionCourseSubjects()->groupBy('annual_semester')->pluck('annual_semester') ?? null;
    }

    public function getSubjectList($course_id, $wing_id, $term_id)
    {
        $subjects = SessionCourseSubject::where('course_id', '=', $course_id)
            ->where('wing_id', '=', $wing_id)
            ->where('annual_semester', '=', $term_id)
            ->where('session_id', '=', SystemSession::get('selected_session_id'))
            ->where('organization_campus_id', '=', SystemSession::get('organization_campus_id'))
            ->orderBy('course_id', 'ASC')
            ->get()
            ->pluck('subject_name', 'subject_id');

        return response()->json($subjects, 200);
    }

    public function getAffiliatedBodiesList()
    {
        $affiliatedBodies = AffiliatedBody::get()->pluck('name', 'id');
        return response()->json(['success' => 'true', 'affiliatedBodies' => $affiliatedBodies]);
    }

    public function getTeachersList()
    {
        $teachers = User::whereHas('roles', function ($q) {$q->where('id', '4');})->get()->pluck('name', 'id');
        return response()->json(['success' => 'true', 'teachers' => $teachers]);
    }

    public function assign()
    {
        $courses          = Course::all()->pluck('name', 'id');
        $wings            = Wing::all()->pluck('name', 'id');
        $affiliatedBodies = AffiliatedBody::all()->pluck('name', 'id');
        return view('sections.assign')->with(['courses' => $courses, 'wings' => $wings, 'affiliatedBodies' => $affiliatedBodies]);
    }

    public function getTotalStudent(Request $request)
    {
        $params   = $request->params;
        $students = Student::registrationEnded(false)
            ->where('session_id', '=', SystemSession::get('selected_session_id'))
            ->where('organization_campus_id', '=', SystemSession::get('organization_campus_id'))
            ->where('course_id', '=', $params['course_id'])
            ->where('affiliated_body_id', '=', $params['affiliated_body_id'])
            ->where('shift_id', '=', $params['shift_id'])
            ->whereHas('studentAcademicHistories', function ($query) {
                return $query->where('semester', request('params')['term_id']);
            })
            ->when($request->params['gender_id'] != 4, function ($q) {
                return $q->where('gender_id', '=', request('params')['gender_id']);
            })
            ->whereHas('studentAcademicHistories', function ($q) {
                $q->where('is_promoted', false)->whereIn('id', function ($query) {
                    $query->select('student_academic_history_id')->whereNull('section_detail_id')->whereNull('section_subject_detail_id')->from('student_books');
                });
            })
            ->get();
        return response()->json([
            'view'  => view('sections.alloted_students_list', [
                'students' => $students,
            ])->render(),
            'count' => count($students),
        ], 200);
    }

    public function getTotalStudentsAccordingToCourse(Request $request)
    {
        $params   = $request->params;
        $students = Student::registrationEnded(false)->where('session_id', '=', SystemSession::get('selected_session_id'))
            ->where('organization_campus_id', '=', SystemSession::get('organization_campus_id'))
            ->where('course_id', '=', $params['course_id'])
            ->where('affiliated_body_id', '=', $params['affiliated_body_id'])
            ->where('shift_id', '=', $params['shift_id'])
            ->whereHas('studentAcademicHistories', function ($query) {
                return $query->where('semester', request('params')['term_id']);
            })
            ->when($request->params['gender_id'] != 4, function ($q) {
                return $q->where('gender_id', '=', request('params')['gender_id']);
            })
            ->get();
        return response()->json([
            'count' => count($students),
        ], 200);
    }

    public function getStudentData($course_id, $affiliated_body_id)
    {
        $students = Student::registrationEnded(false)->where('session_id', '=', SystemSession::get('selected_session_id'))->where('organization_campus_id', '=', SystemSession::get('organization_campus_id'))->where('course_id', '=', $course_id)->where('affiliated_body_id', '=', $affiliated_body_id)->get();
        // DB::beginTransaction();
        // dd(count($students));
        try {
            foreach ($students as $valStudent) {
                $studentAcademicHistory = StudentAcademicHistory::where('session_id', '=', SystemSession::get('selected_session_id'))->where('organization_campus_id', '=', SystemSession::get('organization_campus_id'))->where('student_id', '=', $valStudent->id)->get();
                // dd(count($studentAcademicHistory), $studentAcademicHistory);
                foreach ($studentAcademicHistory as $valStudentAcademicHistory) {
                    echo $valStudentAcademicHistory->id;
                    echo '<br/>';
                    $studentBooks = StudentBook::where('organization_campus_id', '=', SystemSession::get('organization_campus_id'))->where('student_academic_history_id', '=', $valStudentAcademicHistory->id)->get();
                    // // dd(count($studentBooks), $studentBooks);

                    foreach ($studentBooks as $valStudentBook) {
                        $sections = Section::where('session_id', '=', SystemSession::get('selected_session_id'))->where('organization_campus_id', '=', SystemSession::get('organization_campus_id'))->where('subject_id', '=', $valStudentBook->subject_id)->get();
                        // dd(count($sections), $sections);

                        foreach ($sections as $valSection) {

                            echo $valStudentBook->id . 'book';
                            echo $valSection->id . 'section';
                            echo $valSection->strength . 'Strength';
                            echo $valStudentBook->subject_id . 'subjectid';
                            echo $valStudentAcademicHistory->student_id . 'studentid';

                            echo '<br/>';

                            // echo $valSection->id . $valSection->name . $valStudentBook->subject_id . $valStudentBook->student_academic_history_id . $valStudentAcademicHistory->id . $valStudent->id . $valStudent->id . $valStudent->student_name;
                            // echo '<br/>';

                            $subjectSections         = Section::where('session_id', '=', SystemSession::get('selected_session_id'))->where('organization_campus_id', '=', SystemSession::get('organization_campus_id'))->where('subject_id', '=', $valSection->subject_id)->orderBy('id', 'ASC')->get();
                            $totalStrength           = $valSection->strength;
                            $sectionName             = $valSection->name;
                            $sectionId               = $valSection->id;
                            $checkIfAssigned         = StudentBook::where('organization_campus_id', '=', SystemSession::get('organization_campus_id'))->where('subject_id', '=', $valSection->subject_id)->get()->count();
                            $totalAssignableStudents = StudentBook::where('organization_campus_id', '=', SystemSession::get('organization_campus_id'))->where('subject_id', '=', $valSection->subject_id)->get()->count();
                            $j                       = 0;
                            foreach ($subjectSections as $valSubSections) {
                                $j++;
                                for ($i = 1; $i <= $valSubSections->strength; $i++) {
                                    if ($totalAssignableStudents > 0) {
                                        // echo $j;echo '<br>';
                                        $studentGet = Student::registrationEnded(false)->where('session_id', '=', SystemSession::get('selected_session_id'))->where('organization_campus_id', '=', SystemSession::get('organization_campus_id'))->where('course_id', '=', $course_id)->where('affiliated_body_id', '=', $affiliated_body_id)->where('affiliated_body_id', '=', $affiliated_body_id)->where('section_id', '=', null)->first();
                                        // $students = Student::where('session_id', '=', SystemSession::get('selected_session_id'))->where('organization_campus_id', '=', SystemSession::get('organization_campus_id'))->where('course_id', '=', $course_id)->where('affiliated_body_id', '=', $affiliated_body_id)->where('affiliated_body_id', '=', $affiliated_body_id)->where('id', '=', $studentGet->id)->update(
                                        //         [
                                        //             'section_id' => $valSubSections->id,
                                        //             'section_name' => $valSubSections->name
                                        //         ]
                                        //     );
                                        $studentBookUpdate = StudentBook::where('organization_campus_id', '=', SystemSession::get('organization_campus_id'))->where('subject_id', '=', $valSection->subject_id)->update(
                                            [
                                                'section_id'   => $valSubSections->id,
                                                'section_name' => $valSubSections->name,
                                            ]
                                        );
                                    }
                                }
                            }
                            // break;
                        }
                        // break;
                    }
                    // break;
                }
                // break;
            }

            // DB::commit();
            // all good
        } catch (\Exception $e) {
            // DB::rollback();
            return response()->json(['success' => 'false']);
        }
        return response()->json(['success' => 'true']);
    }

    public function getAffiliatedBodiesByCourse($course_id, $wing_id)
    {
        $affiliatedBodies = SessionCourse::where('session_id', SystemSession::get('selected_session_id'))
            ->where('course_id', $course_id)
            ->where('wing_id', $wing_id)
            ->where('is_active', true)
            ->where('organization_campus_id', SystemSession::get('organization_campus_id'))
            ->groupBy('affiliated_body_id')
            ->get();
        return response()->json($affiliatedBodies, 200);
    }

    public function addCsSectionRow(Request $request)
    {
        $subjects = SessionCourseSubject::where('course_id', '=', $request->course_id)
            ->where('wing_id', '=', $request->wing_id)
            ->where('annual_semester', '=', $request->term_id)
            ->where('session_id', '=', SystemSession::get('selected_session_id'))
            ->where('organization_campus_id', '=', SystemSession::get('organization_campus_id'))
            ->orderBy('course_id', 'ASC')
            ->get();

        $section = Section::where('academic_wing_id', $request->wing_id)
            ->where('course_id', $request->course_id)
            ->where('affiliated_body_id', $request->affiliated_body_id)
            ->where('annual_semester', $request->term_id)
            ->where('shift_id', $request->shift_id)
            ->where('gender_id', $request->gender_id)
            ->where('session_id', '=', SystemSession::get('selected_session_id'))
            ->where('organization_campus_id', '=', SystemSession::get('organization_campus_id'))
            ->where('status_id', '0')
            ->first();

        if ($request['type'] !== 'edit' && $request['type'] == 'create') {
            if (!empty($section)) {
                return response()->json(['success' => false, 'message' => "Section already exists against these selections."], 200);
            }
        }

        return response()->json([
            'success'  => true,
            'subjects' => count($subjects),
            'form'     => view('sections.addCsSectionRow', [
                'count'    => $request->count,
                'subjects' => $subjects,
                'wing_id'  => $request->wing_id,
            ])->render(),
        ], 200);
    }

    public function storeSectionDetails(Request $request)
    {
        try {
            \DB::beginTransaction();
            $input   = $request->data;
            $section = Section::create([
                'academic_wing_id'       => $input['wing_id'],
                'course_id'              => $input['course_id'],
                'affiliated_body_id'     => $input['affiliated_body_id'],
                'annual_semester'        => $input['term_id'],
                'shift_id'               => $input['shift_id'],
                'status_id'              => $input['status_id'],
                // NOTE: store gender if wing is CS else store 'both' gender
                'gender_id'              => $input['wing_id'] == 2 ? $input['gender_id'] : 4,
                'session_id'             => SystemSession::get('selected_session_id'),
                'organization_campus_id' => SystemSession::get('organization_campus_id'),
            ]);
            // NOTE: checking if student lenght is greater than or not of total count of section lenght
            $totalStrengthFromFrontEnd = collect($input['sectionDetails'])->sum('strength');
            if ($input['student_strength'] > $totalStrengthFromFrontEnd && $input['result'] != 'Bypass') {
                return response()->json([
                    'success' => false, 
                    'title' => 'Variation Warning', 
                    'message' => 'There is a variation in your student strength and section total strength. <br /> Total Students: <b>' . $input['student_strength'] . '</b> - Total Section Strength: <b>' . $totalStrengthFromFrontEnd . '</b> = <b>' . ($input['student_strength'] - $totalStrengthFromFrontEnd) . '</b> remaining.', 
                    'type' => 'warning',
                    'result' => 'Bypass'
                ], 200);
            }
            // NOTE: Save section details data
            if (isset($input['sectionDetails'])) {
                foreach ($input['sectionDetails'] as $key => $detail) {
                    if (isset($detail)) {
                        $sectionDetail = $section->sectionDetails()->create([
                            'section_name'     => $detail['name'],
                            'section_code'     => $detail['code'],
                            'section_strength' => $detail['strength'],
                        ]);
                        // NOTE: save subject details
                        foreach ($detail['subjectDetails'] as $subject) {
                            if (isset($subject)) {
                                $sectionSubjectDetail = $sectionDetail->sectionSubjectDetails()->create([
                                    'section_id'       => $section->id,
                                    'subject_id'       => $subject['subject'],
                                    'academic_wing_id' => $input['wing_id'],
                                ]);
                                // NOTE: STORE TEACHERS SINGLE OR HELPER ACCORDING TO THE WING
                                if ($input['wing_id'] != 2) {
                                    if (isset($subject['teacher_helpers'])) {
                                        foreach ($subject['teacher_helpers'] as $key => $teacher) {
                                            if (isset($teacher)) {
                                                $sectionDetail->sectionTeachers()->create([
                                                    'user_id'                   => $teacher,
                                                    'user_name'                 => User::find($teacher)->display_name ?? '---',
                                                    'type'                      => 1,
                                                    'section_id'                => $section->id,
                                                    'section_subject_detail_id' => $sectionSubjectDetail->id,
                                                ]);
                                            }
                                        }
                                    }
                                }
                                // NOTE: Store primary teacher
                                $sectionDetail->sectionTeachers()->create([
                                    'user_id'                   => $subject['teacher'],
                                    'user_name'                 => User::find($subject['teacher'])->display_name,
                                    'type'                      => 0,
                                    'section_id'                => $section->id,
                                    'section_subject_detail_id' => $sectionSubjectDetail->id,
                                ]);
                            }
                        }
                    }
                }
            } else {
                return response()->json(['success' => false, 'error' => 'Please add at least one section details in order to create.'], 500);
            }
            \DB::commit();
            return response()->json(['success' => true, 'title' => 'Section created successfully.', 'message' => null, 'type' => 'success'], 200);
        } catch (\Exception $e) {
            \DB::rollback();
            if ($e->getCode() != 0) {
                if (in_array(1062, $e->errorInfo)) {
                    $exception_message = str_replace('admissions_', '', $e->errorInfo[2]);
                    $replaced_message  = str_replace('_unique', '', $exception_message);
                    $message           = str_replace('key', '', $replaced_message);
                    return response()->json(['success' => false, 'error' => $message], 500);
                } else {
                    return response()->json(['success' => false, 'error' => 'Something went wrong.'], 500);
                }
            } else {
                $exception_message                = $e->getMessage();
                $exception_message_semi_col_split = explode(":", $exception_message);
                $message                          = 'Something went wrong at ' . '"' . str_replace(' ', '', str_replace('_', '-', $exception_message_semi_col_split[1])) . '"';
                return response()->json(['success' => false, 'error' => $message], 500);
            }
        }
    }

    public function updateSectionDetails(Request $request)
    {
        try {
            \DB::beginTransaction();
            $data    = $request->data;
            $section = Section::findOrFail($request->section);
            $section->update(['status_id' => $data['status_id']]);
            // Delete old data
            $section->sectionTeachers()->delete();
            // NOTE: checking if student lenght is greater than or not of total count of section lenght
            $totalStrengthFromFrontEnd = collect($data['sectionDetails'])->sum('strength');
            if ($data['student_strength'] > $totalStrengthFromFrontEnd && $data['result'] != 'Bypass') {
                return response()->json([
                    'success' => false, 
                    'title' => 'Variation Warning', 
                    'message' => 'There is a variation in your student strength and section total strength. <br /> Total Students: <b>' . $data['student_strength'] . '</b> - Total Section Strength: <b>' . $totalStrengthFromFrontEnd . '</b> = <b>' . ($data['student_strength'] - $totalStrengthFromFrontEnd) . '</b> remaining.', 
                    'type' => 'warning', 
                    'result' => 'Bypass'
                ], 200);
            }
            //NOTE: UpdateOrInsert Section Details
            foreach ($data['sectionDetails'] as $key => $sectionDetail) {
                if (isset($sectionDetail)) {
                    $dbSectionDetail = $section->sectionDetails()->updateOrCreate(['id' => $sectionDetail['id']], [
                        'section_name'     => $sectionDetail['name'],
                        'section_code'     => $sectionDetail['code'],
                        'section_strength' => $sectionDetail['strength'],
                    ]);
                    //NOTE: UPDATE OR INSERT SECTION SUBJECT DETAILS
                    foreach ($sectionDetail['subjectDetails'] as $key => $sectionSubjectDetail) {
                        if (isset($sectionSubjectDetail)) {
                            $dbSectionSubjectDetail = $dbSectionDetail->sectionSubjectDetails()->updateOrCreate(['id' => $sectionSubjectDetail['id']], [
                                'section_id'             => $section->id,
                                'subject_id'             => $sectionSubjectDetail['subject'],
                                'academic_wing_id'       => $data['academic_wing_id'],
                                'organization_campus_id' => SystemSession::get('organization_campus_id'),
                            ]);
                            //NOTE: DELETE OLD PRIMARY TEACHER AND UPDATE NEW
                            $dbSectionDetail->sectionTeachers()->create([
                                'user_id'                   => $sectionSubjectDetail['teacher'],
                                'user_name'                 => User::find($sectionSubjectDetail['teacher'])->display_name ?? '---',
                                'type'                      => 0,
                                'section_id'                => $section->id,
                                'section_subject_detail_id' => $dbSectionSubjectDetail['id'],
                            ]);
                            //NOTE: IF WING IS NOT CS THEN UPDATE OR INSERT TEACHER
                            if ($section->academic_wing_id != 2) {
                                if (isset($sectionSubjectDetail['teacher_helpers'])) {
                                    //NOTE: delete previous teachers then create again new
                                    foreach ($sectionSubjectDetail['teacher_helpers'] as $key => $teacher) {
                                        if (isset($teacher)) {
                                            $dbSectionDetail->sectionTeachers()->create([
                                                'user_id'                   => $teacher,
                                                'user_name'                 => User::find($teacher)->display_name ?? '---',
                                                'type'                      => 1,
                                                'section_id'                => $section->id,
                                                'section_subject_detail_id' => $dbSectionSubjectDetail['id'],
                                            ]);
                                        }
                                    }
                                }
                            }

                        }
                    }
                }
            }
            // \DB::rollback();
            \DB::commit();
            return response()->json(['success' => true, 'title' => 'Section updated successfully.', 'message' => null, 'type' => 'success'], 200);
        } catch (Exception $e) {
            \DB::rollback();
            dd($e);
        }
    }

    public function deleteSectionDetails(Request $request)
    {
        if ($request->ajax()) {
            $sectionDetail = SectionDetail::findOrFail($request->section_detail_id);
            // NOTE: set section related columns to null
            $sectionDetail->studentBooks()->update([
                'section_id'                => null,
                'section_name'              => null,
                'section_detail_id'         => null,
                'section_subject_detail_id' => null,
            ]);
            $sectionDetail->sectionSubjectDetails()->delete();
            $sectionDetail->delete();
            return response()->json('Section Detail Deleted Successfully', 200);
        }
    }

    public function assignSectionToStudents(Request $request)
    {
        try {
            \DB::beginTransaction();
            $params = $request->params;
            // sections
            $section = Section::where('academic_wing_id', $params['wing_id'])
                ->where('course_id', $params['course_id'])
                ->where('affiliated_body_id', $params['affiliated_body_id'])
                ->where('annual_semester', $params['term_id'])
                ->where('shift_id', $params['shift_id'])
                ->where('gender_id', $params['gender_id'])
                ->where('session_id', '=', SystemSession::get('selected_session_id'))
                ->where('organization_campus_id', '=', SystemSession::get('organization_campus_id'))
                ->where('status_id', '0')
                ->first();
            if (empty($section)) {
                return response()->json(['success' => false, 'message' => 'No section found against these filters.'], 200);
            }

            // Student Quer;y
            $students_query = Student::query();
            $students_query = $students_query->registrationEnded(false)->where('session_id', '=', SystemSession::get('selected_session_id'))
                                ->where('organization_campus_id', '=', SystemSession::get('organization_campus_id'))
                                ->where('course_id', '=', $params['course_id'])
                                ->where('affiliated_body_id', '=', $params['affiliated_body_id'])
                                ->where('shift_id', '=', $params['shift_id'])
                                ->whereHas('studentAcademicHistories', function($query) {
                                    return $query->where('semester', request('params')['term_id']);
                                })
                                ->when($request->params['gender_id'] != 4, function ($q) {
                                    return $q->where('gender_id', '=', request('params')['gender_id']);
                                })
                                ->whereHas('studentAcademicHistories', function($q){
                                    $q->where('is_promoted', false)->whereIn('id', function($query) {
                                        $query->select('student_academic_history_id')->whereNull('section_detail_id')->from('student_books');
                                    });
                                });

            $totalStudents = $students_query->count();
            // NOTE: if student count exceds the section limit
            if ($section) {
                $sectionLength = $section->sectionDetails()->pluck('section_strength')->sum();
                if ($totalStudents > $sectionLength) {
                    return response()->json(['success' => false, 'message' => 'Section strength of (' . $sectionLength . ') does not meet the requirement for (' . $totalStudents . ') students.'], 200);
                } else if ($totalStudents < 0) {
                    return response()->json(['success' => false, 'message' => 'No Student found against these filters.'], 200);
                }
            }
            $students = $students_query->get();

            // LOOP Through subjects and delete them
            // foreach ($students as $key => $oldSubject) {
            //     $oldSubject->studentAcademicHistories()->where('is_promoted', false)->get()->last()->studentBooks()->whereNull('section_detail_id')->delete();
            // }

            // NOTE: Students Loop
            foreach ($students as $student) {
                // TODO: Loop Through filtered section details
                foreach ($section->sectionDetails as $sectionDetail) {
                    // TODO: GET COUNT OF SECTION STUDENT THAT ARE ALREADY ASSIGNED
                    $assignedSections = StudentBook::where('section_id', $section->id)
                        ->whereNotNull('section_detail_id')
                        ->whereNotNull('section_subject_detail_id')
                        ->where('section_detail_id', $sectionDetail->id)
                        ->groupBy('student_academic_history_id')
                        ->get();
                    $assignedSectionCount = count($assignedSections);
                    \Log::notice('Total Count For Assigned Students: ' . $assignedSectionCount);
                    // TODO: CHECK FOR SECTION LIMIT AND MOVE TO THE NEXT SECTION VICE VERSA
                    if ($sectionDetail->section_strength > $assignedSectionCount) {
                        // TODO: Loop through all subjects of that section
                        foreach ($sectionDetail->sectionSubjectDetails as $sectionSubjectDetail) {
                            if (isset($sectionSubjectDetail)) {
                                \Log::info($assignedSectionCount . ' ---- NEW USER IN IF ----- ' . $sectionDetail->section_strength);
                                $student->studentAcademicHistories()->where('is_promoted', false)->get()->last()->studentBooks()->whereNull('section_detail_id')->where('subject_id', $sectionSubjectDetail->subject_id)->update([
                                    'organization_campus_id'    => SystemSession::get('organization_campus_id'),
                                    'academic_wing_id'          => $params['wing_id'],
                                    'section_id'                => $section->id,
                                    'section_name'              => $sectionDetail->section_name,
                                    'section_detail_id'         => $sectionDetail->id,
                                    'section_subject_detail_id' => $sectionSubjectDetail->id,
                                ]);
                            }
                        }
                        break;
                    }
                    // NOTE: Stop the Lopp if section limit exceeds
                    else {
                        \Log::info($assignedSectionCount . ' ---- NEW USER IN ELSE ----- ' . $sectionDetail->section_strength);
                        continue;
                    }
                }
            }
            // return
            \DB::commit();
            return response()->json(['success' => true, 'message' => 'Section assigned successfully!'], 200);
        } catch (Exception $e) {
            \DB::rollback();
            dd($e);
        }
    }

    public function getSectionsDetailsByFilters(Request $request)
    {
        $params  = $request->params;
        $section = Section::where('academic_wing_id', $params['select_wing_id'])
            ->where('course_id', $params['select_course_id'])
            ->where('affiliated_body_id', $params['affiliated_body_id'])
            ->where('annual_semester', $params['annual_semester'])
            ->where('shift_id', $params['shift_id'])
            ->where('session_id', '=', SystemSession::get('selected_session_id'))
            ->where('organization_campus_id', '=', SystemSession::get('organization_campus_id'))
            ->where('status_id', '0')
            ->first();
        if (!empty($section)) {
            return $section->sectionDetails()->pluck('section_name', 'id') ?? '';
        }
    }

}
