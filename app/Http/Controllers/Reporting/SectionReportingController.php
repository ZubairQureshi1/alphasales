<?php

namespace App\Http\Controllers\Reporting;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\SessionCourse;
use App\Models\SessionCourseSubject;
use App\Models\Student;
use App\Models\Wing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as SystemSession;

class SectionReportingController extends Controller
{
    /**
     * @return generate reporting for sections
     */
    public function index(Request $request)
    {
        $wings = Wing::get()->pluck('name', 'id');
        return view('reporting.sectionModule.index')->with('wings', $wings);
    }
    
    public function getSectionDetails(Request $request)
    {
        $params   = $request->params;
        $students = Student::registrationEnded(false)->where('session_id', '=', SystemSession::get('selected_session_id'))
                            ->where('organization_campus_id', '=', SystemSession::get('organization_campus_id'))
                            ->where('course_id', '=', $params['course_id'])
                            ->where('affiliated_body_id', $params['affiliated_body_id'])
                            ->where('shift_id', $params['shift_id'])
                            ->whereHas('studentAcademicHistories', function ($query) use ($params) {
                                return $query->where('semester', $params['term_id'])->where('is_promoted', false)->whereIn('id', function ($query) {
                                    $query->select('student_academic_history_id')->whereNotNull('section_detail_id')->whereNotNull('section_subject_detail_id')->from('student_books');
                                });
                            })
                            ->when($params['gender_id'] != 4, function ($q) use ($params) {
                                return $q->where('gender_id', '=', $params['gender_id']);
                            })
                            ->orderBy('roll_no', 'ASC')
                            ->get();

        $subjects = SessionCourseSubject::where('course_id', '=', $params['course_id'])
                                        ->where('wing_id', '=', $params['wing_id'])
                                        ->where('annual_semester', '=', $params['term_id'])
                                        ->where('session_id', '=', SystemSession::get('selected_session_id'))
                                        ->where('organization_campus_id', '=', SystemSession::get('organization_campus_id'))
                                        ->orderBy('course_id', 'ASC')
                                        ->get()
                                        ->pluck('subject_name', 'subject_id');
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

        if ($params['type'] == 'student') {
            if (count($students) > 0) {
                return response()->json([
                    'success' => true,
                    'count'   => 1,
                    'view'    => view($params['wing_id'] != 2 ? 'reporting.sectionModule.sectionReportingTable' : 'reporting.sectionModule.sectionReportingForCsTable', [
                        'students'       => $students,
                        'subjects'       => $subjects,
                        'gender_id'      => $params['gender_id'],
                        'section'        => $section,
                        'sectionDetails' => $section->sectionDetails ?? null,
                    ])->render(),
                ]);
            } else {
                return response()->json(['success' => false, 'message' => 'No student found against these filters.', 'type' => 'info']);
            }
        } else if ($params['type'] == 'subject') {
            $course = SessionCourse::where('wing_id', $params['wing_id'])
                        ->where('organization_campus_id', SystemSession::get('organization_campus_id'))
                        ->where('session_id', '=', SystemSession::get('selected_session_id'))
                        ->where('course_id', $params['course_id'])
                        ->where('is_active', true)
                        ->first();

                        if (!empty($course)) {
                            return response()->json([
                                'success' => true,
                                'view'    => view('reporting.sectionModule.sectionSubjectReportingTable', [
                                    'course' => $course,
                                    'params' => $params,
                                ])->render(),
                            ]);
                        } else {
                            return response()->json(['success' => false, 'message' => 'No course found against these filters.', 'type' => 'info']);
                        }
        }
    }


}
