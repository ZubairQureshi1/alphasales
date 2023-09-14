<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseSubject;
use App\Models\DateSheet;
use App\Models\DateSheetBook;
use App\Models\DateSheetCourse;
use App\Models\DateSheetRoom;
use App\Models\DateSheetSection;
use App\Models\DateSheetSittingPlan;
use App\Models\DateSheetStudent;
use App\Models\ExamType;
use App\Models\Room;
use App\Models\Section;
use App\Models\Session;
use App\Models\Student;
use App\Models\StudentAcademicHistory;
use App\Models\StudentBook;
use App\Models\Subject;
use App\User;
use Illuminate\Http\Request;

class DateSheetController extends Controller
{
    public function index(Request $request)
    {
        $data = DateSheet::get();
        foreach ($data as $key => $table) {
            $date_sheet_sections = DatesheetSection::where('date_sheet_id', '=', $table->id)->get();
            $data[$key]['date_sheet_sections'] = $date_sheet_sections;
            $date_sheet_books = DateSheetBook::where('date_sheet_id', '=', $table->id)->get();
            $data[$key]['date_sheet_books'] = $date_sheet_books;
            $date_sheet_courses = DateSheetCourse::where('date_sheet_id', '=', $table->id)->get();
            $data[$key]['date_sheet_courses'] = $date_sheet_courses;
        }
        return view('datesheets.index')->with('data', $data);
    }

    public function GeneralDatesheetView($id)
    {
        $datesheet = DateSheet::find($id);
        $date_sheet_sections = DateSheetSection::where('date_sheet_id', '=', $datesheet->id)->get();
        $date_sheet_books = DateSheetBook::where('date_sheet_id', '=', $datesheet->id)->get();
        $date_sheet_sessions = Session::where('id', '=', $datesheet->session_id)->get();
        $date_sheet_exam_types = ExamType::where('id', '=', $datesheet->exam_type_id)->get();
        foreach ($date_sheet_exam_types as $date_sheet_exam_type) {
            $date_sheet_exam_type_name = new ExamType();
            $date_sheet_exam_type_name = $date_sheet_exam_type->exam_type;
        }
        //
        //section_students
        // $selected_datesheet_section_students = [];

        // //books loop
        foreach ($date_sheet_books as $key => $books) {
            $selected_books = Subject::find($books->subject_id);
            $book_name = $selected_books['name'];
            $date_sheet_books[$key]['book_name'] = $book_name;
        }

        // foreach ($date_sheet_sections as $date_sheet_section) {
        //     $selected_sections = Section::find($date_sheet_section->section_id);
        //     $datesheet_section_students = Student::where('is_end_of_reg', '=', '0')->where('session_id', '=', $datesheet->session_id)->where('section_id', '=', $date_sheet_section->section_id)->get()->toArray();
        //     foreach ($datesheet_section_students as $key => $student) {
        //         $academic_history = StudentAcademicHistory::where('student_id', '=', $student['id'])->get();
        //         // \Log::info($academic_history);
        //         if (count($academic_history->toArray()) > 0) {
        //             $student_books = StudentBook::where('student_academic_history_id', '=', $academic_history->last()->id)->get();
        //             // \Log::info($student_books);
        //             // dd($academic_history);
        //             foreach ($student_books as $student_book_key => $value) {
        //                 foreach ($date_sheet_books as $date_sheet_key => $date_sheet_book) {
        //                     if ($date_sheet_book->subject_id == $value['subject_id']) {
        //                         $datesheet_section_students[$key]['books'][$student_book_key] = $date_sheet_book->toArray();
        //                     }
        //                 }
        //             }
        //         }
        //     }
        //     $selected_datesheet_section_students = array_merge($selected_datesheet_section_students, $datesheet_section_students);
        // }
        // // dd($selected_datesheet_section_students[1]);
        // //sections loop
        foreach ($date_sheet_sections as $key => $section) {
            $selected_section = Section::find($section->section_id);
            $section_name = $selected_section['name'];
            $date_sheet_sections[$key]['section_name'] = $section_name;
        }

        return view('datesheets.general_datesheet_view', ['datesheet' => $datesheet, 'date_sheet_sections' => $date_sheet_sections,
            'date_sheet_books' => $date_sheet_books, 'date_sheet_sessions' => $date_sheet_sessions, 'date_sheet_exam_types' => $date_sheet_exam_types]);
    }
    public function datesheetview($id)
    {
        $datesheet = DateSheet::find($id);
        $date_sheet_sections = DateSheetSection::where('date_sheet_id', '=', $datesheet->id)->get();
        $date_sheet_books = DateSheetBook::where('date_sheet_id', '=', $datesheet->id)->get();
        $date_sheet_sessions = Session::where('id', '=', $datesheet->session_id)->get();
        $date_sheet_exam_types = ExamType::where('id', '=', $datesheet->exam_type_id)->get();
        foreach ($date_sheet_exam_types as $date_sheet_exam_type) {
            $date_sheet_exam_type_name = new ExamType();
            $date_sheet_exam_type_name = $date_sheet_exam_type->exam_type;
        }
        //
        //section_students
        $selected_datesheet_section_students = [];

        //books loop
        foreach ($date_sheet_books as $key => $books) {
            $selected_books = Subject::find($books->subject_id);
            $book_name = $selected_books['name'];
            $date_sheet_books[$key]['book_name'] = $book_name;
        }

        foreach ($date_sheet_sections as $date_sheet_section) {
            $selected_sections = Section::find($date_sheet_section->section_id);
            $datesheet_section_students = Student::where('is_end_of_reg', '=', '0')->where('session_id', '=', $datesheet->session_id)->where('section_id', '=', $date_sheet_section->section_id)->get()->toArray();
            foreach ($datesheet_section_students as $key => $student) {
                $academic_history = StudentAcademicHistory::where('student_id', '=', $student['id'])->get();
                // \Log::info($academic_history);
                if (count($academic_history->toArray()) > 0) {
                    $student_books = StudentBook::where('student_academic_history_id', '=', $academic_history->last()->id)->get();
                    // \Log::info($student_books);
                    // dd($academic_history);
                    foreach ($student_books as $student_book_key => $value) {
                        foreach ($date_sheet_books as $date_sheet_key => $date_sheet_book) {
                            if ($date_sheet_book->subject_id == $value['subject_id']) {
                                $datesheet_section_students[$key]['books'][$student_book_key] = $date_sheet_book->toArray();
                            }
                        }
                    }
                }
            }
            $selected_datesheet_section_students = array_merge($selected_datesheet_section_students, $datesheet_section_students);
        }
        // dd($selected_datesheet_section_students[1]);
        //sections loop
        foreach ($date_sheet_sections as $key => $section) {
            $selected_section = Section::find($section->section_id);
            $section_name = $selected_section['name'];
            $date_sheet_sections[$key]['section_name'] = $section_name;
        }

        return view('datesheets.datesheet_view', ['datesheet' => $datesheet, 'date_sheet_sections' => $date_sheet_sections,
            'date_sheet_books' => $date_sheet_books, 'date_sheet_exam_types' => $date_sheet_exam_types, 'selected_datesheet_section_students' => $selected_datesheet_section_students]);
    }
    public function getStudentRollNoSlip(Request $request)
    {
        $input = $request->all();
        $datesheet = DateSheet::find($input['date_sheet_id']);
        $date_sheet_books = DateSheetBook::where('date_sheet_id', '=', $datesheet->id)->get();

        $selected_datesheet_section_students = [];

        //books loop
        foreach ($date_sheet_books as $key => $books) {
            $selected_books = Subject::find($books->subject_id);
            $book_name = $selected_books['name'];
            $date_sheet_books[$key]['book_name'] = $book_name;
        }

        $student = Student::find($input['id'])->toArray();
        $academic_history = StudentAcademicHistory::where('student_id', '=', $student['id'])->get();
        // \Log::info($academic_history);
        if (count($academic_history->toArray()) > 0) {
            $student_books = StudentBook::where('student_academic_history_id', '=', $academic_history->last()->id)->get();
            // \Log::info($student_books);
            // dd($academic_history);
            foreach ($student_books as $student_book_key => $value) {
                foreach ($date_sheet_books as $date_sheet_key => $date_sheet_book) {
                    if ($date_sheet_book->subject_id == $value['subject_id']) {
                        $date_sheet_book->date_formated = $date_sheet_book->date->format('D, Y, M d');
                        $date_sheet_book->start_time_formated = $date_sheet_book->start_time->format('h:i a');
                        $date_sheet_book->end_time_formated = $date_sheet_book->end_time->format('h:i a');
                        $student['books'][$student_book_key] = $date_sheet_book->toArray();
                    }
                }
            }
        }

        return response()->json(['success' => 'true', 'student_detail' => $student]);
    }
    public function awardlist(Request $request)
    {
        $sections = Section::get()->pluck('name', 'id');
        $courses = Course::get()->pluck('name', 'id');
        $subjects = Subject::get()->pluck('name', 'id');
        $sessions = Session::get()->pluck('session_name', 'id');
        return view('datesheets.awardlist', ['sections' => $sections, 'courses' => $courses, 'subjects' => $subjects, 'sessions' => $sessions]);
    }
    public function getAwardSectionDetail(Request $request)
    {
        $input = $request->all();
        $sections = Section::find($input['id']);
        $section_students = Student::where('is_end_of_reg', '=', '0')->where('section_id', '=', $sections->id)->get();
        $total_students = count($section_students);
        return response()->json(['success' => 'true', 'section_students' => $section_students, 'total_students' => $total_students]);
    }
    public function Sittingplan(Request $request)
    {
        $datesheets = DateSheet::get()->pluck('date_sheet_name', 'id');
        return view('datesheets.sitting_plan', ['datesheets' => $datesheets]);
    }
    public function getSittingPlan(Request $request)
    {
        $input = $request->all();
        $datesheet = DateSheet::find($input['id']);
        $datesheet_sections = DateSheetSection::where('date_sheet_id', '=', $datesheet->id)->get();
        foreach ($datesheet_sections as $key => $datesheet_section) {
            $selected_section = Section::find($datesheet_section->section_id);
            $selected_section_name = $selected_section['name'];
            $datesheet_sections[$key]['selected_section_name'] = $selected_section_name;
        }
        $date_sheet_rooms = DateSheetRoom::where('date_sheet_id', '=', $datesheet->id)->get();
        foreach ($date_sheet_rooms as $key => $date_sheet_room) {
            $selected_rooms = Room::find($date_sheet_room->room_id);
            $selected_room_name = $selected_rooms['name'];
            $date_sheet_rooms[$key]['selected_room_name'] = $selected_room_name;
        }
        $users = User::with('roles')->get();
        return response()->json(['success' => 'true', 'datesheet_sections' => $datesheet_sections, 'date_sheet_rooms' => $date_sheet_rooms, 'users' => $users]);
    }
    public function create(Request $request)
    {
        $data = DateSheet::get();
        $examtypes = ExamType::get()->pluck('exam_type', 'id');
        $sessions = Session::get()->pluck('session_name', 'id');
        $courses = Course::get()->pluck('name', 'id');
        $sections = Section::get()->pluck('name', 'id');
        $subjects = Subject::get();
        $rooms = Room::get()->pluck('name', 'id');
        $rooms_data = Room::get();
        return view('datesheets.create', ['examtypes' => $examtypes, 'sessions' => $sessions, 'courses' => $courses, 'sections' => $sections, 'subjects' => $subjects, 'rooms' => $rooms, 'rooms_data' => $rooms_data])->with('data', $data);
    }
    public function getSectionDetail(Request $request)
    {
        $input = $request->all();
        $sections = Section::find($input['id']);
        $db_section_students = Student::where('is_end_of_reg', '=', '0')->where('session_id', '=', $input['session_id'])->where('section_id', '=', $sections->id)->get();
        $total_students = count($db_section_students);
        // return response()->json(['test' => $input]);
        return response()->json(['success' => 'true', 'total_students' => $total_students, 'db_section_students' => $db_section_students]);
    }
    public function roll_no_slip(Request $request)
    {
        $datesheets = DateSheet::get()->pluck('id', 'id');
        return view('datesheets.roll_no_slip', ['datesheets' => $datesheets]);
    }
    public function getRollNoSlipDetail(Request $request)
    {
        $input = $request->all();
        $datesheet = DateSheet::find($input['id']);
        $datesheet_sections = DateSheetSection::where('date_sheet_id', '=', $datesheet->id)->get();
        foreach ($datesheet_sections as $key => $datesheet_section) {
            $selected_section = Section::find($datesheet_section->section_id);
            $selected_section_name = $selected_section['name'];
            $datesheet_sections[$key]['selected_section_name'] = $selected_section_name;
        }
        $selected_section_student = [];
        $selected_datesheet_sections = DateSheetSection::where('date_sheet_id', '=', $datesheet->id)->get();
        foreach ($selected_datesheet_sections as $selected_datesheet_section) {
            $selected_sections = Section::find($selected_datesheet_section->section_id);
            $students = Student::where('is_end_of_reg', '=', '0')->where('section_id', '=', $selected_sections->id)->get()->toArray();
            $selected_section_student = array_merge($selected_section_student, $students);
        }
        return response()->json(['success' => 'true', 'datesheet_sections' => $datesheet_sections, 'selected_section_student' => $selected_section_student]);
    }

    // public function RollNoSlipView($id){
    //     $students = Student::find($id);
    //     $datesheet_sections = DateSheetSection::where('section_id','=',$students->section_id)->get();
    //     foreach($datesheet_sections as $datesheet_section){
    //         $datesheet_section_students = Student::where('is_end_of_reg', '=', '0')->where('section_id','=',$datesheet_section->section_id)->get();
    //     }
    //     return view('datesheets.student_roll_no_slip',['datesheet_section_students'=>$datesheet_section_students]);
    // }
    public function store(Request $request)
    {
        try {
            \DB::beginTransaction();
            $input = $request->all();
            $data = DateSheet::get()->all();
            $datesheet = new DateSheet();
            $datesheet->session_id = $input['session_id'];
            $datesheet->exam_type_id = $input['exam_type_id'];
            $datesheet->save();
            foreach ($input['course_id'] as $value) {
                $date_sheet_course = new DateSheetCourse();
                $date_sheet_course->course_id = $value;
                $date_sheet_course->date_sheet_id = $datesheet->id;
                $date_sheet_course->save();
            }
            foreach ($input['sections'] as $value) {
                $date_sheet_section = new DateSheetSection();
                $date_sheet_section->section_id = $value;
                $date_sheet_section->date_sheet_id = $datesheet->id;
                $date_sheet_section->save();
            }
            foreach ($input['rooms'] as $value) {
                $date_sheet_room = new DateSheetRoom();
                $date_sheet_room->room_id = $value;
                $date_sheet_room->date_sheet_id = $datesheet->id;
                $date_sheet_room->save();
            }
            foreach ($input['datesheetBooks'] as $value) {
                $date_sheet_book = new DateSheetBook;
                $date_sheet_book->subject_id = $value['subject_id'];
                $date_obj = new \DateTime($value['date']);
                $start_time_obj = new \DateTime($value['start_time']);
                $end_time_obj = new \DateTime($value['end_time']);
                $date_sheet_book->date = $date_obj;
                $date_sheet_book->start_time = $start_time_obj;
                $date_sheet_book->end_time = $end_time_obj;
                $date_sheet_book->syllabus = $value['syllabus'];
                $date_sheet_book->date_sheet_id = $datesheet->id;
                foreach ($input['db_students'] as $student) {

                    // dd($input['db_students']);
                    // \Log::info($student);
                    $academic_history = StudentAcademicHistory::where('student_id', '=', $student)->get();
                    // \Log::info($academic_history);
                    if (count($academic_history->toArray()) > 0) {
                        $student_books = StudentBook::where('student_academic_history_id', '=', $academic_history->last()->id)->get();
                        // \Log::info($student_books);
                        // dd($academic_history);
                        foreach ($input['sections'] as $val) {
                            $student_sections = Student::where('id', '=', $student)->where('section_id', '=', $val)->get();
                            foreach ($student_sections as $student_section) {
                                if ($student == $student_section->id && $val == $student_section->section_id) {
                                    foreach ($student_books as $key => $student_book) {
                                        if ($student_book->subject_id == $value['subject_id']) {
                                            $date_sheet_students = new DateSheetStudent();
                                            $date_sheet_students->student_id = $student;
                                            $date_sheet_students->date_sheet_id = $datesheet->id;
                                            $date_sheet_students->course_id = $date_sheet_course->course_id;
                                            $date_sheet_students->section_id = $val;
                                            $date_sheet_students->subject_id = $value['subject_id'];
                                            $date_sheet_students->academic_history_id = $academic_history->last()->id;
                                            $date_sheet_students->save();
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                // dd('stop here');
                $date_sheet_book->save();
            }

            // \DB::commit();
            // return response()->json(['success' => 'true']);
        } catch (\Exception $e) {
            \DB::rollback();
            // dd($e);
            return response()->json(['success' => false, 'error' => 'Something went wrong.'], 500);
        }
    }
    public function SaveSittingPlan(Request $request)
    {
        $input = $request->all();
        foreach ($input['datesheetRooms'] as $value) {
            $sitting_room = new DateSheetSittingPlan();
            $sitting_room->room_id = $value['room_id'];
            $sitting_room->invigilator = $value['invigilator'];
            $sitting_room->days = $value['days'];
            $start_time_obj = new \DateTime($value['start_time_id']);
            $sitting_room->start_time = $start_time_obj;
            $end_time_obj = new \DateTime($value['end_time_id']);
            $sitting_room->end_time = $end_time_obj;
            $sitting_room->date_sheet_id = $input['datesheet_id'];
            $sitting_room->save();
        }
        return redirect('Sittingplan');
    }
    public function Sitting_Plan_View($id)
    {
        $datesheet = DateSheet::find($id);
        $datesheet_sitting_plans = DateSheetSittingPlan::where('date_sheet_id', '=', $datesheet->id)->get();
        foreach ($datesheet_sitting_plans as $key => $datesheet_sitting_plan) {
            $selected_rooms = Room::find($datesheet_sitting_plan->room_id);
            $selected_room_name = $selected_rooms['name'];
            $datesheet_sitting_plans[$key]['selected_room_name'] = $selected_room_name;
        }

        return view('datesheets.sitting_plan_view')->with(['datesheet' => $datesheet, 'datesheet_sitting_plans' => $datesheet_sitting_plans]);
    }
    public function edit($id)
    {
        $datesheet = DateSheet::findorFail($id);
        $examtypes = ExamType::get()->pluck('exam_type', 'id');
        $sessions = Session::get()->pluck('session_name', 'id');
        $courses = Course::get();
        $sections = Section::get()->pluck('name', 'id');
        $subjects = Subject::get();
        $date_sheet_sections = DateSheetSection::where('date_sheet_id', '=', $datesheet->id)->get();
        foreach ($date_sheet_sections as $key => $section) {
            $selected_section = Section::find($section->section_id);
            $section_name = $selected_section['name'];
            $date_sheet_sections[$key]['section_name'] = $section_name;
        }
        $date_sheet_courses = DateSheetCourse::where('date_sheet_id', '=', $datesheet->id)->get();
        foreach ($date_sheet_courses as $key => $course) {
            $selected_course = Course::find($course->course_id);
            $course_name = $selected_course['name'];
            $date_sheet_courses[$key]['course_name'] = $course_name;
        }
        $course_subjects = CourseSubject::where('course_id', '=', $course->course_id)->get();
        $date_sheet_books = DateSheetBook::where('date_sheet_id', '=', $datesheet->id)->get();
        foreach ($date_sheet_books as $sheet_key => $date_sheet_subject) {
            if (!$date_sheet_subject['isChecked']) {
                $date_sheet_subject->isChecked = true;
                $date_sheet_subject->date_formated = $date_sheet_subject->date->format('Y-m-d');
                $date_sheet_subject->start_time_formated = $date_sheet_subject->start_time->format('h:i');
                $date_sheet_subject->end_time_formated = $date_sheet_subject->end_time->format('h:i');
            } else {
                $subject->isChecked = false;
            }
        }
        return view('datesheets.edit')->with(['datesheets' => $datesheet, 'examtypes' => $examtypes,
            'sessions' => $sessions, 'courses' => $courses, 'sections' => $sections,
            'subjects' => $subjects, 'date_sheet_sections' => $date_sheet_sections, 'date_sheet_books' => $date_sheet_books, 'date_sheet_courses' => $date_sheet_courses]);
    }
    public function edit_sitting_plan($id)
    {
        $datesheet = DateSheet::find($id);
        $datesheets = DateSheet::get()->pluck('id', 'id');
        $datesheet_sections = DateSheetSection::where('date_sheet_id', '=', $datesheet->id)->get();
        foreach ($datesheet_sections as $key => $datesheet_section) {
            $selected_section = Section::find($datesheet_section->section_id);
            $selected_section_name = $selected_section['name'];
            $datesheet_sections[$key]['selected_section_name'] = $selected_section_name;
        }
        $datesheet_sitting_plans = DateSheetSittingPlan::where('date_sheet_id', '=', $datesheet->id)->get();
        foreach ($datesheet_sitting_plans as $key => $datesheet_sitting_plan) {
            $selected_rooms = Room::find($datesheet_sitting_plan->room_id);
            $selected_room_name = $selected_rooms['name'];
            $datesheet_sitting_plans[$key]['selected_room_name'] = $selected_room_name;
        }
        $users = User::with('roles')->get();
        return view('datesheets.edit_sitting_plan', ['datesheets' => $datesheets, 'datesheet' => $datesheet, 'datesheet_sections' => $datesheet_sections, 'datesheet_sitting_plans' => $datesheet_sitting_plans, 'users' => $users]);
    }
    public function update($id, Request $request)
    {
        $input = $request->all();
        $datesheet = DateSheet::findOrFail($id);
        $datesheet->exam_type_id = $request->get('exam_type_id');
        $datesheet->session_id = $request->get('session_id');
        $datesheet->update();

        //New Section Add
        $db_sections = [];
        $date_sheet_sections = DateSheetSection::where('date_sheet_id', '=', $datesheet->id)->get();
        foreach ($date_sheet_sections as $date_sheet_section) {
            $db_selected_sections = new DateSheetSection();
            array_push($db_sections, $date_sheet_section->section_id);
        }
        $selected_sections = $input['sections'];
        // foreach ($input['sections'] as $value) {
        //     $section = Section::find($value);
        //     $section_detail = new Section();
        //     array_push($selected_sections, $section->id);
        // }
        $add_sections = array_diff($selected_sections, $db_sections);
        foreach ($add_sections as $add_section) {
            $new_section = new DateSheetSection();
            $new_section->section_id = $add_section;
            $new_section->date_sheet_id = $datesheet->id;
            $new_section->save();
        }

        //End New Section Add

        //Delete Section
        $del_sections = array_diff($db_sections, $selected_sections);
        foreach ($del_sections as $del_section) {
            $delete_sections = DateSheetSection::where('section_id', '=', $del_section)->get()->first();
            $delete_sections->delete();
        }
        //End Delete Section

        // Add Books
        $db_books = [];
        $date_sheet_books = DateSheetBook::where('date_sheet_id', '=', $datesheet->id)->get();
        foreach ($date_sheet_books as $date_sheet_book) {
            $db_selected_books = new DateSheetBook();
            array_push($db_books, $date_sheet_book->subject_id);
        }
        $selected_books = (!isset($input['subject'])) ? [] : $input['subject'];
        // dd($input['subject']);
        // foreach ($input['subject'] as $input_subjects) {
        //     $subject = Subject::where('id', '=', $input_subjects)->get()->first();
        //     $subject_detail = new Subject();
        //     array_push($selected_books, $subject->id);
        // }
        $add_books = array_diff($selected_books, $db_books);
        foreach ($add_books as $key => $add_book) {
            $new_book = new DateSheetBook();
            $new_book->subject_id = $add_book;
            $date_obj = new \DateTime($input['date'][$key]);
            $new_book->date = $date_obj;
            $start_time_obj = new \DateTime($input['start_time'][$key]);
            $new_book->start_time = $start_time_obj;
            $end_time_obj = new \DateTime($input['end_time'][$key]);
            $new_book->end_time = $end_time_obj;
            $new_book->syllabus = $input['syllabus'][$key];
            $new_book->date_sheet_id = $datesheet->id;
            $new_book->save();
        }
        //End New Books Add

        //Delete Books
        $del_books = array_diff($db_books, $selected_books);
        foreach ($del_books as $del_book) {
            $delete_book = DateSheetBook::where('subject_id', '=', $del_book)->get()->first();
            $delete_book->delete();
        }
        //End Delete

        //Schedule_update
        $date_sheet_books = DateSheetBook::where('date_sheet_id', '=', $datesheet->id)->get();
        foreach ($date_sheet_books as $key => $date_sheet_book) {
            $schedule = DateSheetBook::find($date_sheet_book->id);
            $date_obj = new \DateTime($input['date'][$key]);
            $schedule->date = $date_obj;
            $start_time_obj = new \DateTime($input['start_time'][$key]);
            $schedule->start_time = $start_time_obj;
            $end_time_obj = new \DateTime($input['end_time'][$key]);
            $schedule->end_time = $end_time_obj;
            $schedule->syllabus = $input['syllabus'][$key];
            $schedule->date_sheet_id = $datesheet->id;
            $schedule->update();
        }
        return redirect('datesheet');
    }
    public function update_sitting_plan($id, Request $request)
    {
        $input = $request->all();
        $datesheet = DateSheet::find($id);
        $datesheet_sitting_plan = DateSheetSittingPlan::where('date_sheet_id', '=', $datesheet->id)->get();
        foreach ($datesheet_sitting_plan as $value) {
            $datesheet_sitting_plan_update = new DateSheetSittingPlan();
            $datesheet_sitting_plan_update->days = $input['days'];
            $datesheet_sitting_plan_update->update();
        }
        return redirect()->to('Sitting_Plan_View/' . $id);
    }
    public function destroy($id)
    {
        $datesheet = DateSheet::find($id);
        $date_sheet_sections = DateSheetSection::where('date_sheet_id', '=', $datesheet->id)->delete();
        $date_sheet_books = DateSheetBook::where('date_sheet_id', '=', $datesheet->id)->delete();
        $date_sheet_courses = DateSheetCourse::where('date_sheet_id', '=', $datesheet->id)->delete();
        $date_sheet_rooms = DateSheetRoom::where('date_sheet_id', '=', $datesheet->id)->delete();
        $date_sheet_students = DateSheetStudent::where('date_sheet_id', '=', $datesheet->id)->delete();
        $datesheet->delete();

        return redirect('datesheet');
    }
}
