<?php

use App\Models\DateSheet;
use App\Models\DateSheetCourse;
use App\Models\DateSheetSection;
use App\Models\DateSheetStudent;
use App\Models\ExamFine;
use App\Models\SectionCourse;
use App\Models\Student;
use App\Models\StudentBook;
use Illuminate\Database\Seeder;

class UpdateDateSheetStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $date_sheets = DateSheet::where('session_id', '=', 4)->get();
        foreach ($date_sheets as $key => $sheet) {
            // dd($sheet->id);
            $date_sheet_students = DateSheetStudent::where('date_sheet_id', '=', $sheet->id)->where('total_marks', '=', '')->where('obtain_marks', '=', '')->delete();
            $date_sheet_courses = DateSheetCourse::where('date_sheet_id', '=', $sheet->id)->get();
            $date_sheet_sections = DateSheetSection::where('date_sheet_id', '=', $sheet->id)->get();
            foreach ($date_sheet_courses as $key => $course) {
                $sections = SectionCourse::where('course_id', '=', $course->course_id)->get();
                foreach ($date_sheet_sections as $key => $value) {
                    foreach ($sections as $key => $section) {
                        if ($section->section_id == $value->section_id) {
                            # code...
                            $students = Student::with('studentAcademicHistories')->where('session_id', '=', $sheet->session_id)->where('course_id', '=', $course->course_id)->where('section_id', '=', $value->section_id)->get();
                            // dd($students->toArray());
                            foreach ($students as $key => $student) {
                                if (count($student->studentAcademicHistories()->get()->toArray()) > 0) {
                                    $student_academic_history = $student->studentAcademicHistories()->get()->last();
                                    $student_books = StudentBook::where('student_academic_history_id', '=', $student_academic_history->id)->get();
                                    foreach ($student_books as $key => $book) {
                                        $student_date_sheet = new DateSheetStudent();
                                        $student_date_sheet->date_sheet_id = $sheet->id;
                                        $student_date_sheet->course_id = $course->id;
                                        $student_date_sheet->student_id = $student->id;
                                        $student_date_sheet->subject_id = $book->subject_id;
                                        $student_date_sheet->save();
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        // $date_sheet_students = DateSheetStudent::where('status','=','Pass')->where('status_id', '=', 1)->get();
        // foreach ($date_sheet_students as $key => $result) {
        //     $result->status_id = 0;
        //     $result->update();
        // }
        // $date_sheet_students = DateSheetStudent::where('status','=','Fail')->where('status_id', '=', 2)->get();
        // foreach ($date_sheet_students as $key => $result) {
        //     $result->status_id = 1;
        //     $result->update();
        // }
        // $date_sheet_students = DateSheetStudent::where('status','=','----Select Status----')->where('status_id', '=', 0)->get();
        // foreach ($date_sheet_students as $key => $result) {
        //     $result->status_id = 1;
        //     $result->status = 'Fail';
        //     $result->update();
        // }

        // $updateExamFines = ExamFine::where('exam_type_id', '=', 1)->get();
        // foreach ($updateExamFines as $key => $fine) {

        // }
    }

    public function calculateExamFine($fine)
    {
        $input = $fine->toArray();
        $exam_fine = ExamFine::find($fine['id']);

        $student_result = DateSheetStudent::where('student_id', '=', $input['student_id'])->where('date_sheet_id', '=', $input['date_sheet_id'])->where('status_id', '=', '1')->get();
        $fine_amount = count($student_result) * 200;
        $exam_fine->amount = $fine_amount;
        $exam_fine->update();
    }
}
