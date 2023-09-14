<?php

namespace App\Http\Controllers;

use App\Imports\Exams\ResultImport;
use App\Models\DateSheet;
use App\Models\DateSheetBook;
use App\Models\DateSheetSection;
use App\Models\DateSheetStudent;
use App\Models\ExamType;
use App\Models\Section;
use App\Models\Session;
use App\Models\Student;
use App\Models\StudentAcademicHistory;
use App\Models\StudentBook;
use App\Models\TeacherSubject;
use App\User;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DateSheetStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datesheets = DateSheet::get()->pluck('date_sheet_name', 'id');
        $users = User::with('roles')->get();
        $auth_user = Auth::user();
        $user_subjects = TeacherSubject::where('user_id', '=', $auth_user->id)->get()->pluck('subject_name', 'subject_id');

        return view('results.index', ['datesheets' => $datesheets, 'users' => $users, 'user_subjects' => $user_subjects]);
    }
    public function getDateSheetInfo(Request $request)
    {
        $input = $request->all();
        $datesheet = DateSheet::find($input['id']);
        $datesheet_sections = DateSheetSection::where('date_sheet_id', '=', $datesheet->id)->get();
        foreach ($datesheet_sections as $key => $datesheet_section) {
            $selected_section = Section::find($datesheet_section->section_id);
            $selected_section_name = $selected_section['name'];
            $datesheet_sections[$key]['selected_section_name'] = $selected_section_name;
        }
        $datesheet_exam_types = ExamType::where('id', '=', $datesheet->exam_type_id)->get();
        $datesheet_sessions = Session::where('id', '=', $datesheet->session_id)->get();
        $date_sheet_books = DateSheetBook::where('date_sheet_id', '=', $input['id'])->get();

        return response()->json(['success' => 'true', 'datesheet_sections' => $datesheet_sections, 'datesheet_exam_types' => $datesheet_exam_types,
            'datesheet_sessions' => $datesheet_sessions]);
    }
    public function getSubjectStudents(Request $request)
    {
        try {
            $input = $request->all();

            if ($input['action_to_perform'] == 0) {

                $date_sheet_students = DateSheetStudent::where('subject_id', '=', $input['selected_subject_id'])->where('date_sheet_id', '=', $input['selected_datesheet_id'])->get();
                $date_sheet_students = $date_sheet_students->where('obtain_marks', '==', null);
                foreach ($date_sheet_students as $key => $student) {
                    $student->field_disabled = false;
                }
                return response()->json(['success' => 'true', 'date_sheet_students' => $date_sheet_students]);
            } else if ($input['action_to_perform'] == 1) {
                $date_sheet_students = DateSheetStudent::where('subject_id', '=', $input['selected_subject_id'])->where('date_sheet_id', '=', $input['selected_datesheet_id'])->get();
                $date_sheet_students = $date_sheet_students->where('obtain_marks', '!=', null);
                foreach ($date_sheet_students as $key => $student) {
                    $student->field_disabled = true;
                }
                return response()->json(['success' => 'true', 'date_sheet_students' => $date_sheet_students], 200);
            }

        } catch (\Exception $e) {
            return response()->json(['success' => 'false', 'error' => $e->getMessage()], 500);
        }
    }

    public function import(Request $request)
    {
        $result = Excel::toArray(new ResultImport, $request->file('import'));
        $sheet_one_result = $result[0];
        $sheet_data = $sheet_one_result[1];
        return view('results.result_imported')->with('sheet_data', $sheet_data);
    }

    public function getResultView()
    {
        $date_sheets = DateSheet::get()->pluck('date_sheet_name', 'id');
        return view('results.result_view')->with(['date_sheets' => $date_sheets]);
    }
    public function getDateSheetSection(Request $request)
    {
        $input = $request->all();
        $date_sheet_sections = DateSheetSection::where('date_sheet_id', '=', $input['id'])->get();
        $datesheet = DateSheet::where('id', '=', $input['id'])->get()->first();
        $exam_type = ExamType::where('id', '=', $datesheet->exam_type_id)->get();
        $date_sheet_books = DateSheetBook::where('date_sheet_id', '=', $input['id'])->get();
        return response()->json(['success' => 'true', 'exam_type' => $exam_type, 'datesheet' => $datesheet,
            'date_sheet_sections' => $date_sheet_sections, 'date_sheet_books' => $date_sheet_books]);

    }
    public function getSectionStudent(Request $request)
    {
        $input = $request->all();
        $section_students = Student::where('section_id', '=', $input['selected_section_id'])->get();
        return response()->json(['success' => 'true', 'section_students' => $section_students]);

    }
    public function getSectionResult(Request $request)
    {
        $input = $request->all();
        $result_students = [];
        $date_sheet_books = DateSheetBook::where('date_sheet_id', '=', $input['selected_date_sheet_id'])->get();
        //pending;
        return response()->json(['success' => 'true', 'result_students' => $result_students]);
    }
    public function getStudentResult(Request $request)
    {
        $input = $request->all();
        $student = Student::where('id', '=', $input['id'])->get()->first();
        $student_result = DateSheetStudent::where('date_sheet_id', '=', $input['selected_date_sheet_id'])->where('student_id', '=', $input['id'])->get();
        return response()->json(['success' => 'true', 'student_result' => $student_result, 'student_detail' => $student]);
    }
    // public function getSubjectResult(Request $request){
    //     $input = $request->all();
    //     $result_students = [];
    //     $final_result_data = [];
    //     $section_students = Student::where('section_id','=',$input['selected_section_id'])->get();
    //     foreach($section_students as $section_student){
    //         $date_sheet_students = DateSheetStudent::where('student_id','=',$section_student->id)->get();
    //         array_push($result_students,$date_sheet_students);
    //     }
    //     foreach($result_students as $result_student){
    //         foreach($result_student as $value){
    //             if($value->subject_id == $input['selected_subject_id']){
    //                 array_push($final_result_data,$value);
    //             }
    //         }
    //     }
    //     return response()->json(['success' => 'true', 'final_result_data' => $final_result_data]);
    // }
    public function ResultReporting()
    {
        return view('resultReporting.index');
    }
    public function ResultReportingView()
    {
        $date_sheets = DateSheet::get()->pluck('date_sheet_name', 'id');
        return view('resultReporting.result_reporting_view')->with(['date_sheets' => $date_sheets]);
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
    public function ImportStudentResult(Request $request)
    {
        $sheets = Excel::toArray(new ResultImport, $request->file('import'));
        // dd($sheets);
        foreach ($sheets as $key => $sheet) {
            $data = $sheet;
            $sheet_cols = $data[0]; //Array Form;
            \Log::info($sheet_cols);
            $subjects = []; // Subject name will be added from sheet col as per structure/format of excel;
            $subject_ids = $data[1]; // Array Form;
            $subject_total_marks = $data[2]; // Array Form;
            foreach ($sheet_cols as $key => $value) {
                if ($key >= 5 && $value != null) {
                    $subject = ['id' => (int) $subject_ids[$key], 'excel_cell_index' => $key, 'name' => $value, 'total_marks' => (int) $subject_total_marks[$key]];
                    array_push($subjects, $subject);
                }
            }
            for ($i = 3; $i < count($data); $i++) {
                $student_result = $data[$i];
                // dd($student_result);
                $old_roll_no = $student_result[0];
                $date_sheet_id = $student_result[2];
                $student = Student::where('old_roll_no', '=', $old_roll_no)->get();
                if (count($student->toArray()) > 0) {
                    $student = $student->first();
                    foreach ($subjects as $key => $subject) {
                        $datesheet_student = DateSheetStudent::create(['date_sheet_id' => $date_sheet_id, 'course_id' => $student->course_id, 'subject_id' => $subject['id'], 'student_id' => $student['id']]);
                    }
                    $academic_history = StudentAcademicHistory::where('student_id', '=', $student->id)->get();
                    // \Log::info($academic_history);
                    if (count($academic_history->toArray()) > 0) {
                        $student_books = StudentBook::where('student_academic_history_id', '=', $academic_history->last()->id)->get();
                        $student_result_books = DateSheetStudent::where('date_sheet_id', '=', $date_sheet_id)->where('student_id', '=', $student->id)->get();
                        // \Log::info($student_books);
                        // dd($academic_history);
                        foreach ($student_result_books as $student_book_key => $value) {
                            // \Log::info($student_result_books);
                            foreach ($subjects as $subject_key => $subject) {
                                if ($value->subject_id == $subject['id']) {
                                    // \Log::info($student->old_roll_no . ' - ' . $student_result[$subject['excel_cell_index']]);
                                    $value->total_marks = $subject['total_marks'];
                                    $value->obtain_marks = $student_result[$subject['excel_cell_index']];
                                    $value->percentage = ((int) $value->obtain_marks / (int) $value->total_marks) * 100;
                                    if (((int) $value->percentage) >= 40) {
                                        $value->status = config('constants.result_statuses')[0];
                                        $value->status_id = 0;
                                    } else {
                                        $value->status = config('constants.result_statuses')[1];
                                        $value->status_id = 1;
                                    }
                                    $value->update();
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    public function store(Request $request)
    {

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
        $input = $request->all();
        $result = DateSheetStudent::find($id);
        $result->total_marks = $input['total_marks'];
        $result->obtain_marks = $input['obtain_marks'];
        $result->percentage = $input['percentage'];
        $result->grade = $input['grade'];
        $result->status = $input['status'];
        $result->status_id = $input['status_id'];
        $result->update();
        return response()->json(['success', 'true']);
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
