<?php

namespace App\Http\Controllers;

use Alertify;
use App\Models\AffiliatedBody;
use App\Models\Course;
use App\Models\CourseAffiliatedBody;
use App\Models\CourseSubject;
use App\Models\OrganizationCampus;
use App\Models\OrganizationCampusWing;
use App\Models\Session;
use App\Models\SessionCourse;
use App\Models\SessionCourseSubject;
use App\Models\Subject;
use App\Models\Wing;
use App\Repositories\SessionRepository;
use Carbon\Carbon;
use Flash;
use Globals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

// use Carbon\Carbon;

class SessionController extends Controller
{
    private $sessionRepository;

    public function __construct(SessionRepository $sessionRepo)
    {
        $this->sessionRepository = $sessionRepo;
    }

    public function index(Request $request)
    {
        $sessions = Session::get()->toArray();
        $session_keys = [];
        if (count($sessions) != 0) {
            for ($i = 0; $i < sizeof($sessions); $i++) {
                $sessions[$i]['replaced_name'] = Globals::replaceSpecialChar($sessions[$i]['session_name']);
            };
            $session_keys = array_keys($sessions[0]);
        }
        // dd($session_keys);
        return view('sessions.index')
            ->with('sessions', $sessions)->with(['session_keys' => $session_keys]);
        Alertify::standard('I like alerts');
    }

    public function create()
    {
        $courses = Course::all();
        return view('sessions.create')->with('courses', $courses);
    }

    public function store(Request $request)
    {
        // $input = $request->all();
        // dd($request->all());
        \DB::beginTransaction();
        try {
            $session = new Session();
            $session->session_name = $request->session_name;
            $session->organization_id = $request->organization_id;
            $session->save();
            foreach ($request->course_ids as $course_key => $course_id) {
                $temp_course_id = $course_id;

                //campus wise number of seats, discounts, installments and degree offering.
                // dd($request->input('campus_' . $request->row_counts[$course_key] . '_ids'));
                foreach ($request->input('campus_' . $request->row_counts[$course_key] . '_ids') as $campus_key => $campus_id) {
                    //session courses data saving
                    $session_course = new SessionCourse();
                    $session_course->session_id = $session->id;
                    $session_course->organization_campus_id = $campus_id;
                    $session_course->course_code = $request->course_codes[$course_key];
                    $session_course->wing_id = $request->wing_ids[$course_key];
                    $session_course->is_active = isset($request->input('is_' . $request->row_counts[$course_key] . '_actives')[$campus_key]) ? 1 : 0;

                    //course saving if don't exists
                    if ($course_id == null && $temp_course_id == null) {
                        // course saving if course is not been searched
                        $course = new Course();
                        $course->name = $request->course_names[$course_key];
                        $course->course_code = $request->course_codes[$course_key];
                        $course->organization_id = $request->organization_id;
                        $course->wing_id = $request->wing_ids[$course_key];
                        $course->save();

                        //after course creation attaching the affiliated body
                        $course_affiliated_body = new CourseAffiliatedBody();
                        $course_affiliated_body->course_id = $course->id;
                        $course_affiliated_body->affiliated_body_id = $request->affiliated_body_ids[$course_key];
                        $course_affiliated_body->academic_term_id = $request->academic_term_ids[$course_key];
                        $course_affiliated_body->organization_id = $request->organization_id;
                        $course_affiliated_body->wing_id = $request->wing_ids[$course_key];
                        $course_affiliated_body->save();

                        $session_course->course_id = $course->id;
                        $temp_course_id = $course->id;
                    } else {

                        if (CourseAffiliatedBody::where('course_id', $temp_course_id)->where('affiliated_body_id', $request->affiliated_body_ids[$course_key])->count() == 0) {
                            $course_affiliated_body = new CourseAffiliatedBody();
                            $course_affiliated_body->course_id = $temp_course_id;
                            $course_affiliated_body->affiliated_body_id = $request->affiliated_body_ids[$course_key];
                            $course_affiliated_body->academic_term_id = $request->academic_term_ids[$course_key];
                            $course_affiliated_body->organization_id = $request->organization_id;
                            $course_affiliated_body->wing_id = $request->wing_ids[$course_key];
                            $course_affiliated_body->save();
                        }
                        $course = Course::find($temp_course_id);
                        $session_course->course_id = $temp_course_id;
                    }
                    $session_course->academic_term_id = $request->academic_term_ids[$course_key];
                    $session_course->tuition_fee = $request->tuition_fees[$course_key];
                    $session_course->session_start_date = $request->session_start_dates[$course_key];
                    $session_course->session_end_date = $request->session_end_dates[$course_key];
                    $session_course->affiliated_body_id = $request->affiliated_body_ids[$course_key];

                    // management don't want minimum installments validation so keep it 0
                    $session_course->min_installments = 0;
                    $session_course->max_installments = $request->input('max_' . $request->row_counts[$course_key] . '_installments')[$campus_key];
                    $session_course->min_discount = $request->input('min_' . $request->row_counts[$course_key] . '_discounts')[$campus_key];
                    $session_course->max_discount = $request->input('max_' . $request->row_counts[$course_key] . '_discounts')[$campus_key];
                    $session_course->quota = $request->input('quotas_' . $request->row_counts[$course_key])[$campus_key];

                    // fees and accounts heads for the current session

                    //new changes from the group columns added,
                    $session_course->cfe_admission_fee = $request->cfe_admission_fees[$course_key];
                    $session_course->marketer_incentive = $request->marketer_incentives[$course_key];
                    $session_course->registration_fee = $request->registration_fees[$course_key];

                    $session_course->admission_registration_fee = $request->admission_registration_fees[$course_key];

                    $session_course->transport_charges = $request->transport_charges[$course_key];
                    $session_course->miscellaneous = $request->miscellaneous[$course_key];

                    $session_course->exam_fee = $request->exam_fees[$course_key];
                    $session_course->exam_stationery = $request->exam_stationeries[$course_key];
                    // $session_course->cfe_publication = $request->cfe_publications[$course_key];
                    // $session_course->student_card_fee = $request->student_card_fees[$course_key];
                    // $session_course->trasnport_card_fee = $request->trasnport_card_fees[$course_key];
                    // $session_course->uniform_charges = $request->uniform_charges[$course_key];
                    // $session_course->library_card_fee = $request->library_card_fees[$course_key];
                    $session_course->save();
                    foreach ($request->academic_timespans[$request->row_counts[$course_key]] as $academic_timespan) {
                        foreach ($request->subject_ids[$request->row_counts[$course_key]][$academic_timespan] as $subject_key => $subject_id) {

                            // subject saving if subject is not been searched
                            $existing_db_subject = '';
                            if ($subject_id == null && $course_id == null) {
                                //check subject already exists in db with same name
                                $existing_db_subject = Subject::where('name', $request->subject_names[$request->row_counts[$course_key]][$academic_timespan][$subject_key])->get();
                                if ($existing_db_subject->count() > 0) {
                                    $subject = $existing_db_subject->first();
                                } else {
                                    $subject = new Subject();
                                    $subject->name = $request->subject_names[$request->row_counts[$course_key]][$academic_timespan][$subject_key];
                                    $subject->code = $request->subject_codes[$request->row_counts[$course_key]][$academic_timespan][$subject_key];
                                    $subject->organization_id = $request->organization_id;
                                    $subject->wing_id = $request->wing_ids[$course_key];
                                    $subject->save();
                                }
                                // creating links of course subjects
                                $course_subject = new CourseSubject();
                                $course_subject->subject_id = $subject->id;
                                $course_subject->course_id = $course->id;
                                $course_subject->course_name = $course->name;
                                $course_subject->subject_name = $subject->name;

                                $course_subject->credit_hours = $request->credit_hours[$request->row_counts[$course_key]][$academic_timespan][$subject_key];
                                $course_subject->semester = $academic_timespan;
                                $course_subject->prerequisite_subject = $request->prerequisite_subjects[$request->row_counts[$course_key]][$academic_timespan][$subject_key];

                                $course_subject->organization_id = $request->organization_id;
                                $course_subject->wing_id = $request->wing_ids[$course_key];
                                $course_subject->save();

                                // session course subjects saving
                                $session_course_subject = new SessionCourseSubject();
                                $session_course_subject->session_id = $session->id;
                                $session_course_subject->session_course_id = $session_course->id;
                                $session_course_subject->course_id = $session_course->course_id;
                                $session_course_subject->organization_campus_id = $campus_id;
                                $session_course_subject->wing_id = $request->wing_ids[$course_key];

                                $session_course_subject->subject_code = $request->subject_codes[$request->row_counts[$course_key]][$academic_timespan][$subject_key];
                                $session_course_subject->credit_hours = $request->credit_hours[$request->row_counts[$course_key]][$academic_timespan][$subject_key];
                                $session_course_subject->prerequisite_id = $request->prerequisite_subjects[$request->row_counts[$course_key]][$academic_timespan][$subject_key];

                                $session_course_subject->course_name = $course->name;
                                $session_course_subject->subject_id = $subject->id;
                                $session_course_subject->subject_name = $subject->name;
                                $session_course_subject->annual_semester = $academic_timespan;
                                $session_course_subject->save();

                            } elseif ($subject_id == null && $course_id != null) {
                                $existing_db_subject = Subject::where('name', $request->subject_names[$request->row_counts[$course_key]][$academic_timespan][$subject_key])->get();
                                if ($existing_db_subject->count() > 0) {
                                    $subject = $existing_db_subject->first();
                                } else {
                                    $subject = new Subject();
                                    $subject->name = $request->subject_names[$request->row_counts[$course_key]][$academic_timespan][$subject_key];
                                    $subject->code = $request->subject_codes[$request->row_counts[$course_key]][$academic_timespan][$subject_key];
                                    $subject->organization_id = $request->organization_id;
                                    $subject->wing_id = $request->wing_ids[$course_key];
                                    $subject->save();
                                }

                                $course_subject = new CourseSubject();
                                $course_subject->subject_id = $subject->id;
                                $course_subject->course_id = $course->id;
                                $course_subject->semester = $academic_timespan;
                                $course_subject->credit_hours = $request->credit_hours[$request->row_counts[$course_key]][$academic_timespan][$subject_key];
                                $course_subject->prerequisite_subject = $request->prerequisite_subjects[$request->row_counts[$course_key]][$academic_timespan][$subject_key];
                                $course_subject->organization_id = $request->organization_id;
                                $course_subject->wing_id = $request->wing_ids[$course_key];
                                $course_subject->save();

                                // session course subjects saving
                                $session_course_subject = new SessionCourseSubject();
                                $session_course_subject->session_id = $session->id;
                                $session_course_subject->session_course_id = $session_course->id;
                                $session_course_subject->course_id = $session_course->course_id;
                                $session_course_subject->organization_campus_id = $campus_id;
                                $session_course_subject->wing_id = $request->wing_ids[$course_key];
                                $session_course_subject->course_name = $course->name;

                                $session_course_subject->subject_code = $request->subject_codes[$request->row_counts[$course_key]][$academic_timespan][$subject_key];
                                $session_course_subject->credit_hours = $request->credit_hours[$request->row_counts[$course_key]][$academic_timespan][$subject_key];
                                $session_course_subject->prerequisite_id = $request->prerequisite_subjects[$request->row_counts[$course_key]][$academic_timespan][$subject_key];

                                $session_course_subject->subject_id = $subject->id;
                                $session_course_subject->subject_name = $subject->name;
                                $session_course_subject->annual_semester = $academic_timespan;
                                $session_course_subject->save();
                            } elseif ($subject_id != null && $course_id == null) {
                                $not_alloted_existing_subject = Subject::where('id', $subject_id)->first();
                                $course_subject = new CourseSubject();
                                $course_subject->subject_id = $not_alloted_existing_subject->id;
                                $course_subject->course_id = $course->id;
                                $course_subject->credit_hours = $request->credit_hours[$request->row_counts[$course_key]][$academic_timespan][$subject_key];
                                $course_subject->semester = $academic_timespan;
                                $course_subject->prerequisite_subject = $request->prerequisite_subjects[$request->row_counts[$course_key]][$academic_timespan][$subject_key];
                                $course_subject->organization_id = $request->organization_id;
                                $course_subject->wing_id = $request->wing_ids[$course_key];
                                $course_subject->save();

                                // session course subjects saving
                                $session_course_subject = new SessionCourseSubject();
                                $session_course_subject->session_id = $session->id;
                                $session_course_subject->session_course_id = $session_course->id;
                                $session_course_subject->course_id = $session_course->course_id;
                                $session_course_subject->organization_campus_id = $campus_id;
                                $session_course_subject->wing_id = $request->wing_ids[$course_key];
                                $session_course_subject->course_name = $course->name;

                                $session_course_subject->subject_code = $request->subject_codes[$request->row_counts[$course_key]][$academic_timespan][$subject_key];
                                $session_course_subject->credit_hours = $request->credit_hours[$request->row_counts[$course_key]][$academic_timespan][$subject_key];
                                $session_course_subject->prerequisite_id = $request->prerequisite_subjects[$request->row_counts[$course_key]][$academic_timespan][$subject_key];

                                $session_course_subject->subject_id = $not_alloted_existing_subject->id;
                                $session_course_subject->subject_name = $not_alloted_existing_subject->name;
                                $session_course_subject->annual_semester = $academic_timespan;
                                $session_course_subject->save();
                            } else {
                                // $session_course_subject->course_name = Course::where('id', $course_id)->name;
                                $existing_subject = Subject::where('id', $subject_id)->first();

                                // session course subjects saving
                                $session_course_subject = new SessionCourseSubject();
                                $session_course_subject->session_id = $session->id;
                                $session_course_subject->session_course_id = $session_course->id;
                                $session_course_subject->course_id = $session_course->course_id;
                                $session_course_subject->organization_campus_id = $campus_id;
                                $session_course_subject->wing_id = $request->wing_ids[$course_key];
                                $session_course_subject->subject_id = $existing_subject->id;
                                // dd($request->subject_codes, $request->row_counts[$course_key]);

                                $session_course_subject->subject_code = $request->subject_codes[$request->row_counts[$course_key]][$academic_timespan][$subject_key];
                                $session_course_subject->credit_hours = $request->credit_hours[$request->row_counts[$course_key]][$academic_timespan][$subject_key];
                                $session_course_subject->prerequisite_id = $request->prerequisite_subjects[$request->row_counts[$course_key]][$academic_timespan][$subject_key];

                                $session_course_subject->subject_name = $existing_subject->name;
                                $session_course_subject->annual_semester = $academic_timespan;
                                $session_course_subject->save();
                            }
                        }

                    }

                }
            }
            \DB::commit();
            return redirect(route('sessions.index'));
        } catch (\Exception $e) {
            dd($e);
            \DB::rollback();
            $exception_message = $e->getMessage();
            $exception_message_semi_col_split = explode(":", $exception_message);
            $message = 'Something went wrong at ' . '"' . str_replace(' ', '', str_replace('_', '-', $exception_message_semi_col_split[1])) . '"';
            alertify()->error($message);
            return redirect(route('sessions.index'));
        }

    }

    public function edit(Session $session)
    {
        $course_affiliated_body = new CourseAffiliatedBody();
        $sessionCourses = $session->sessionCourses;
        $courses = CourseAffiliatedBody::where('affiliated_body_id', $session->affiliated_body_id)->get();
        if ($session) {
            return view('sessions.edit.edit')->with(['session' => $session, 'courses' => $courses, 'session_courses' => $sessionCourses, 'course_affiliated_body' => $course_affiliated_body]);
        } else {
            Flash::error('Something went wrong while adding session.');
        }

        return redirect(route('sessions.index'));
    }

    public function update($id, Request $request)
    {
        // dd($request->all());
        $session = Session::find($id);
        \DB::beginTransaction();
        try {
            // $session->update($request->all());

            SessionCourseSubject::where('session_id', $session->id)->where('course_id', $request->course_id)->delete();
            SessionCourse::where('session_id', $session->id)->where('course_id', $request->course_id)->delete();
            $course_id = $request->course_id;
            $temp_course_id = $course_id;
            //campus wise number of seats, discounts, installments and degree offering.
            foreach ($request->input('campus_' . $request->row_count . '_ids') as $campus_key => $campus_id) {
                //session courses data saving
                $session_course = new SessionCourse();
                $session_course->session_id = $session->id;
                $session_course->organization_campus_id = $campus_id;
                $session_course->course_code = $request->course_code;
                $session_course->wing_id = $request->wing_id;
                $session_course->is_active = isset($request->input('is_' . $request->row_count . '_actives')[$campus_key]) ? 1 : 0;

                //course saving if don't exists
                if ($course_id == null && $temp_course_id == null) {
                    // course saving if course is not been searched
                    $course = new Course();
                    $course->name = $request->course_name;
                    $course->organization_id = $request->organization_id;
                    $course->wing_id = $request->wing_id;
                    $course->save();

                    //after course creation attaching the affiliated body
                    $course_affiliated_body = new CourseAffiliatedBody();
                    $course_affiliated_body->course_id = $course->id;
                    $course_affiliated_body->affiliated_body_id = $request->affiliated_body_id;
                    $course_affiliated_body->academic_term_id = $request->academic_term_id;
                    $course_affiliated_body->organization_id = $request->organization_id;
                    $course_affiliated_body->wing_id = $request->wing_id;
                    $course_affiliated_body->save();
                    $session_course->course_id = $course->id;
                    $temp_course_id = $course->id;

                } else {

                    if (CourseAffiliatedBody::where('course_id', $course_id)->where('affiliated_body_id', $request->affiliated_body_id)->count() == 0) {
                        $course_affiliated_body = new CourseAffiliatedBody();
                        $course_affiliated_body->course_id = $course_id;
                        $course_affiliated_body->affiliated_body_id = $request->affiliated_body_id;
                        $course_affiliated_body->academic_term_id = $request->academic_term_id;
                        $course_affiliated_body->organization_id = $request->organization_id;
                        $course_affiliated_body->wing_id = $request->wing_id;
                        $course_affiliated_body->save();
                    }
                    $course = Course::find($temp_course_id);
                    $course->name = $request->course_name;
                    $course->update();
                    $session_course->course_id = $temp_course_id;
                }
                $session_course->academic_term_id = $request->academic_term_id;
                $session_course->tuition_fee = $request->tuition_fee;
                $session_course->session_start_date = $request->session_start_date;
                $session_course->session_end_date = $request->session_end_date;
                $session_course->affiliated_body_id = $request->affiliated_body_id;

                // management don't want minimum installments validation so keep it 0
                $session_course->min_installments = 0;
                $session_course->max_installments = $request->input('max_' . $request->row_count . '_installments')[$campus_key];
                $session_course->min_discount = $request->input('min_' . $request->row_count . '_discounts')[$campus_key];
                $session_course->max_discount = $request->input('max_' . $request->row_count . '_discounts')[$campus_key];
                $session_course->quota = $request->input('quotas_' . $request->row_count)[$campus_key];

                // fees and accounts heads for the current session

                // new changes from the group, columns added
                $session_course->cfe_admission_fee = $request->cfe_admission_fee;
                $session_course->marketer_incentive = $request->marketer_incentive;
                $session_course->registration_fee = $request->registration_fee;

                $session_course->admission_registration_fee = $request->admission_registration_fee;

                $session_course->transport_charges = $request->transport_charge;
                $session_course->miscellaneous = $request->miscellaneou;

                $session_course->exam_fee = $request->exam_fee;
                $session_course->exam_stationery = $request->exam_stationerie;
                // $session_course->cfe_publication = $request->cfe_publication;
                // $session_course->student_card_fee = $request->student_card_fee;
                // $session_course->trasnport_card_fee = $request->trasnport_card_fee;
                // $session_course->uniform_charges = $request->uniform_charge;
                // $session_course->library_card_fee = $request->library_card_fee;
                $session_course->save();
                // dd($request->all());
                if (isset($request->academic_timespans)) {
                    foreach ($request->academic_timespans as $academic_timespan) {
                        foreach ($request->subject_ids[$academic_timespan] as $subject_key => $subject_id) {

                            // subject saving if subject is not been searched
                            $existing_db_subject = '';
                            if ($subject_id == null && $course_id == null) {
                                //check subject already exists in db with same name
                                $existing_db_subject = Subject::where('name', $request->subject_names[$academic_timespan][$subject_key])->get();
                                if ($existing_db_subject->count() > 0) {
                                    $subject = $existing_db_subject->first();
                                } else {
                                    $subject = new Subject();
                                    $subject->name = $request->subject_names[$academic_timespan][$subject_key];
                                    $subject->code = $request->subject_codes[$academic_timespan][$subject_key];
                                    $subject->organization_id = $request->organization_id;
                                    $subject->wing_id = $request->wing_id;
                                    $subject->save();
                                }
                                // creating links of course subjects
                                $course_subject = new CourseSubject();
                                $course_subject->subject_id = $subject->id;
                                $course_subject->course_id = $course->id;
                                $course_subject->course_name = $course->name;
                                $course_subject->subject_name = $subject->name;

                                $course_subject->credit_hours = $request->credit_hours[$academic_timespan][$subject_key];
                                $course_subject->semester = $academic_timespan;
                                $course_subject->prerequisite_subject = $request->prerequisite_subjects[$academic_timespan][$subject_key];

                                $course_subject->organization_id = $request->organization_id;
                                $course_subject->wing_id = $request->wing_id;
                                $course_subject->save();

                                // session course subjects saving
                                $session_course_subject = new SessionCourseSubject();
                                $session_course_subject->session_id = $session->id;
                                $session_course_subject->session_course_id = $session_course->id;
                                $session_course_subject->course_id = $session_course->course_id;
                                $session_course_subject->organization_campus_id = $campus_id;
                                $session_course_subject->wing_id = $request->wing_id;

                                $session_course_subject->subject_code = $request->subject_codes[$academic_timespan][$subject_key];
                                $session_course_subject->credit_hours = $request->credit_hours[$academic_timespan][$subject_key];
                                $session_course_subject->prerequisite_id = $request->prerequisite_subjects[$academic_timespan][$subject_key];
                                $session_course_subject->course_name = $course->name;
                                $session_course_subject->subject_id = $subject->id;
                                $session_course_subject->subject_name = $subject->name;
                                $session_course_subject->annual_semester = $academic_timespan;
                                $session_course_subject->save();

                            } elseif ($subject_id == null && $course_id != null) {
                                $existing_db_subject = Subject::where('name', $request->subject_names[$academic_timespan][$subject_key])->get();
                                if ($existing_db_subject->count() > 0) {
                                    $subject = $existing_db_subject->first();
                                } else {
                                    $subject = new Subject();
                                    $subject->name = $request->subject_names[$academic_timespan][$subject_key];
                                    $subject->code = $request->subject_codes[$academic_timespan][$subject_key];
                                    $subject->organization_id = $request->organization_id;
                                    $subject->wing_id = $request->wing_id;
                                    $subject->save();
                                }

                                $course_subject = new CourseSubject();
                                $course_subject->subject_id = $subject->id;
                                $course_subject->course_id = $course->id;
                                $course_subject->semester = $academic_timespan;
                                $course_subject->credit_hours = $request->credit_hours[$academic_timespan][$subject_key];
                                $course_subject->prerequisite_subject = $request->prerequisite_subjects[$academic_timespan][$subject_key];
                                $course_subject->organization_id = $request->organization_id;
                                $course_subject->wing_id = $request->wing_id;
                                $course_subject->save();

                                // session course subjects saving
                                $session_course_subject = new SessionCourseSubject();
                                $session_course_subject->session_id = $session->id;
                                $session_course_subject->session_course_id = $session_course->id;
                                $session_course_subject->course_id = $session_course->course_id;
                                $session_course_subject->organization_campus_id = $campus_id;
                                $session_course_subject->wing_id = $request->wing_id;
                                $session_course_subject->course_name = $course->name;
                                $session_course_subject->subject_id = $subject->id;
                                $session_course_subject->subject_code = $request->subject_codes[$academic_timespan][$subject_key];
                                $session_course_subject->credit_hours = $request->credit_hours[$academic_timespan][$subject_key];
                                $session_course_subject->prerequisite_id = $request->prerequisite_subjects[$academic_timespan][$subject_key];
                                $session_course_subject->subject_name = $subject->name;
                                $session_course_subject->annual_semester = $academic_timespan;
                                $session_course_subject->save();
                            } elseif ($subject_id != null && $course_id == null) {
                                $not_alloted_existing_subject = Subject::where('id', $subject_id)->first();
                                $course_subject = new CourseSubject();
                                $course_subject->subject_id = $not_alloted_existing_subject->id;
                                $course_subject->course_id = $course->id;
                                $course_subject->credit_hours = $request->credit_hours[$academic_timespan][$subject_key];
                                $course_subject->semester = $academic_timespan;
                                $course_subject->prerequisite_subject = $request->prerequisite_subjects[$academic_timespan][$subject_key];
                                $course_subject->organization_id = $request->organization_id;
                                $course_subject->wing_id = $request->wing_id;
                                $course_subject->save();

                                // session course subjects saving
                                $session_course_subject = new SessionCourseSubject();
                                $session_course_subject->session_id = $session->id;
                                $session_course_subject->session_course_id = $session_course->id;
                                $session_course_subject->course_id = $session_course->course_id;
                                $session_course_subject->organization_campus_id = $campus_id;
                                $session_course_subject->wing_id = $request->wing_id;
                                $session_course_subject->course_name = $course->name;
                                $session_course_subject->subject_code = $request->subject_codes[$academic_timespan][$subject_key];
                                $session_course_subject->credit_hours = $request->credit_hours[$academic_timespan][$subject_key];
                                $session_course_subject->prerequisite_id = $request->prerequisite_subjects[$academic_timespan][$subject_key];
                                $session_course_subject->subject_id = $not_alloted_existing_subject->id;
                                $session_course_subject->subject_name = $not_alloted_existing_subject->name;
                                $session_course_subject->annual_semester = $academic_timespan;
                                $session_course_subject->save();
                            } else {
                                // $session_course_subject->course_name = Course::where('id', $course_id)->name;

                                // session course subjects saving
                                $session_course_subject = new SessionCourseSubject();
                                $session_course_subject->session_id = $session->id;
                                $session_course_subject->session_course_id = $session_course->id;
                                $session_course_subject->course_id = $session_course->course_id;
                                $session_course_subject->organization_campus_id = $campus_id;
                                $session_course_subject->wing_id = $request->wing_id;
                                $session_course_subject->subject_id = $subject_id;
                                $session_course_subject->subject_code = $request->subject_codes[$academic_timespan][$subject_key];
                                $session_course_subject->credit_hours = $request->credit_hours[$academic_timespan][$subject_key];
                                $session_course_subject->prerequisite_id = $request->prerequisite_subjects[$academic_timespan][$subject_key];
                                $session_course_subject->subject_name = $request->subject_names[$academic_timespan][$subject_key];
                                $session_course_subject->annual_semester = $academic_timespan;
                                $session_course_subject->save();
                            }
                        }

                    }
                }

            }

            \DB::commit();
            return response()->json(['success' => true, 'message' => 'Session record updated successfully.'], 200);
            // return redirect(route('sessions.index'));
        } catch (\Exception $e) {
            dd($e);
            \DB::rollback();
            return response()->json(['success' => false, 'message' => 'Whoops! Something went wrong.'], 500);
            // return redirect(route('sessions.index'));
        }
    }
    public function destroy($id)
    {
        \DB::beginTransaction();
        try {
            $session = Session::find($id);

            if (empty($session)) {
                Flash::error('Session not found');
                return redirect(route('sessions.index'));
            }
            SessionCourseSubject::whereIn('session_course_id', SessionCourse::where('session_id', $id)->pluck('id'))->delete();
            $session->sessionCourses()->delete();
            $session->userAllowedSessions()->update(['is_active' => 0]);
            $session->delete();

            Flash::success('Sessions deleted successfully.');
            \DB::commit();
            return redirect(route('sessions.index'));
        } catch (\Exception $e) {
            dd($e);
            \DB::rollback();
            return redirect(route('sessions.index'));
        }
    }
    public function removeDegreeFromSession()
    {
        try {

            SessionCourse::with('sessionCourseSubjects')->where('session_id', Input::all()['session_id'])->where('course_id', Input::all()['course_id'])->delete();
            return response()->json(['message' => 'Record removed successfully.'], 200);

        } catch (\Exception $e) {
            dd($e);
            return response()->json(['message' => 'Record removed successfully.'], 500);
        }
    }
    public function getSessionDetails()
    {
        $view = view('sessions.session_course_detail')
            ->with('row_count', Input::all()['row_count'])->with('is_edit_mode', Input::all()['is_edit_mode']);
        if (Input::all()['is_edit_mode']) {
            $session = Session::find(Input::all()['session_id']);
            $view->with('session', $session);
        }
        $view = $view->render();
        return response()->json($view, 200);
    }
    public function getCourseAffiliatedBodies(Course $course)
    {
        $affiliated_bodies = CourseAffiliatedBody::join('affiliated_bodies', 'course_affiliated_bodies.affiliated_body_id', '=', 'affiliated_bodies.id')->where('course_id', $course->id)->select('course_affiliated_bodies.id', 'course_affiliated_bodies.academic_term_id', 'affiliated_bodies.name')->get();

        // $affiliated_bodies = collect($affiliated_bodies->toArray())->flatten()->all();
        $view = view('sessions.affiliated_body_course')->with(['affiliated_bodies' => $affiliated_bodies]);
        $view = $view->render();
        return response()->json($view, 200);
    }
    public function makeRoadMap(Request $request)
    {
        $subjects = new Subject();
        $session_start_carbon_date = Carbon::parse($request->session_start_month_year);
        $session_end_carbon_date = Carbon::parse($request->session_end_month_year);
        if ($request->academic_term_id == 0) // annual
        {
            $temp = 0;
            $difference = $session_start_carbon_date->diffInMonths($session_end_carbon_date);
            if ($difference != 0) {
                // dd('im in if');
                for ($i = $difference; $i > 0; $i = $i - 12) {
                    $temp++;
                }
                // dd($temp);
                $difference = $temp;
            }
        } elseif ($request->academic_term_id == 1) // semester
        {
            $difference = $session_start_carbon_date->diffInMonths($session_end_carbon_date);
            $temp = 0;

            // dd($difference);
            // if($difference != 0 && $difference % 6 == 0)
            if ($difference != 0) {
                // dd('im in if');
                for ($i = $difference; $i > 0; $i = $i - 6) {
                    $temp++;
                }
                // dd($temp);
                $difference = $temp;
            }

            // dd($difference);
        }
        if ($request->course_id) {
            $course_subject_ids = CourseSubject::where('course_id', $request->course_id)->pluck('subject_id');
            $subjects = $subjects->whereIn('id', $course_subject_ids)->get();
        } else {
            $subjects = $subjects->all();
        }
        return view('sessions.roadmap')
            ->with([
                'academic_term_id' => $request->academic_term_id,
                'academic_timespan' => $difference,
                'row_count' => $request->row_count,
                'subjects' => $subjects,
                'is_edit_mode' => $request->is_edit_mode,
            ]);

    }
    public function autoCompleteCourseName(Request $request)
    {
        // dd($request->all());
        $affiliated_body_course_ids = CourseAffiliatedBody::where('affiliated_body_id', $request->affiliated_body_id)->pluck('course_id');
        $course = new Course();
        if ($affiliated_body_course_ids->count() > 0) {
            $course = Course::whereIn('id', $affiliated_body_course_ids);
        }
        $search_string_array = explode('-', trim($request->course_name));
        foreach ($search_string_array as $key => $search_string) {
            $found_records = $course->where(function ($query) use ($search_string) {
                $query->where('name', 'LIKE', '%' . trim($search_string) . '%')->orWhere('course_code', 'LIKE', '%' . trim($search_string) . '%');
            })->get();
        }
        if ($request->course_name != '') {
            $output = '<ul class="dropdown-item dropdown-menu" style="display: inline-block; position: relative;
            z-index: 5;">';
            foreach ($found_records as $row) {
                $name_code = str_replace(' ', '_', $row->name) . '-' . $row->course_code;
                if ($request->affiliated_body_id) {
                    $output .= '<li><a href="javascript:void(0);" onclick=completeName("' . $row->id . '",' . $request->row_count . ',' . $request->affiliated_body_id . ')>' . $row->name . '-' . $row->course_code . '</a></li>';
                } else {
                    $output .= '<li><a href="#" onclick=completeName("' . $row->id . '",' . $request->row_count . ')>' . $row->name . '-' . $row->course_code . '</a></li>';
                }
            }
            $output .= '</ul>';
            return $output;
        } else {
            return '';
        }
    }
    public function getCompleteCourseInfo(Course $course, $affiliatedbody)
    {
        if ($affiliatedbody != null) {
            $affiliated_body = AffiliatedBody::where('id', $affiliatedbody)->first();
            $course_affiliated_bodies = CourseAffiliatedBody::where('course_id', $course->id)->where('affiliated_body_id', $affiliatedbody)->get();
            $output = '<option selected="" value="">--- Select Academic Term ---</option>';
            if ($course_affiliated_bodies->count() > 0) {
                foreach ($course_affiliated_bodies as $course_affiliated_body) {
                    $output .= '<option value="' . $course_affiliated_body->academic_term_id . '">' . config('constants.academic_terms')[$course_affiliated_body->academic_term_id] . '</option>';
                }
            } else {
                foreach (config('constants.academic_terms') as $key => $academic_term) {
                    $output .= '<option value="' . $key . '">' . $academic_term . '</option>';
                }
            }
            $record['affiliated_body'] = $output;
        }
        $record['course'] = $course;
        return $record;
    }
    public function addNewCourse($counters, $row_count, Request $request)
    {
        return view('sessions.add_new_course')
            ->with('counters', $counters)
            ->with('row_count', $row_count)->with('is_edit_mode', $request->is_edit_mode);
    }
    public function autoCompleteSubjectName(Request $request)
    {
        $subjects = new SessionCourseSubject();
        if ($request->course_id != '') {
            // $course_subject_ids = SessionCourseSubject::where('course_id', $request->course_id)->pluck('subject_id');
            // $subjects = $subjects->whereIn('subject_id', $course_subject_ids);
            $subjects = SessionCourseSubject::where('course_id', $request->course_id);
        }
        // dd($subjects->get()->toArray());
        $search_string_array = explode('-', trim($request->subject_name));
        // dd($search_string_array);
        foreach ($search_string_array as $key => $search_string) {
            $found_records = $subjects->where(function ($query) use ($search_string) {
                $query->where('subject_name', 'LIKE', '%' . trim($search_string) . '%')->orWhere('subject_code', 'LIKE', '%' . trim($search_string) . '%');
            })->get()->unique('annual_semester');
            // $subjects->where('name', 'LIKE', '%' . trim($search_string) . '%')->get();

        }
        $exploded_counters = explode('-', $request->counters);

        if ($request->subject_name != '' && $found_records->count() > 0) {
            $output = '<ul class="dropdown-item dropdown-menu" style="display: inline-block; position: relative;
            z-index: 5;">';
            foreach ($found_records as $row) {
                $name = str_replace(' ', '_', $row->name);
                $output .= '<li><a href="javascript:void(0);" onclick=completeSubjectName("' . $row->id . '",' . $request->row_count . ',' . $exploded_counters[1] . ',' . $exploded_counters[2] . ')>' . $row->subject_name . ' (' . $row->subject_code . ')' . '</a></li>';
            }
            $output .= '</ul>';
            return $output;
        } else {
            return '';
        }
    }
    public function getCompleteSubjectInfo(SessionCourseSubject $session_course_subject)
    {

        return $session_course_subject;
    }
    public function getWingCampuses($row_count, Wing $wing)
    {
        $organization_campus_ids = OrganizationCampusWing::where('wing_id', $wing->id)->pluck('organization_campus_id');
        $organization_campuses = OrganizationCampus::whereIn('id', $organization_campus_ids)->get();
        return view('sessions.session_campuses_detail')
            ->with('campuses', $organization_campuses)
            ->with('row_count', $row_count);
    }

    public function renderDegreeDetails(Request $request)
    {
        $session = Session::find($request->session_id);
        $view = view('sessions.edit.session_details')->with('session', $session)->with('wing_id', $request->wing_id)->with('course_id', $request->course_id)->with('affiliated_body_id', $request->affiliated_body_id);
        $view = $view->render();

        return $view;
    }
}
