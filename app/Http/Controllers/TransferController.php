<?php

namespace App\Http\Controllers;

use App\Models\CourseSubject;
use App\Models\FeePackage;
use App\Models\Student;
use App\Models\StudentAcademicHistory;
use App\Models\StudentBook;
use App\Models\Subject;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    //
    public function dropdown(Request $request)
    {
        $subject = Subject::get();
        return view('students.transfer')->with('subject', $subject);
    }
    public function getStudents(Request $request)
    {
        $input = $request->all();
        $filtersArray = explode(';', $input['filters']);
        // \Log::info($filtersArray);
        $filteredStudents = Student::when($filtersArray, function ($querry, $filtersArray) {
            foreach ($filtersArray as $key => $value) {
                if ($key < (sizeof($filtersArray) - 1)) {
                    $filter = explode(':', $value);
                    if ($filter[0] == 'course_id' || $filter[0] == 'session_id' || $filter[0] == 'student_category_id') {
                        $querry->where($filter[0], '=', $filter[1]);
                    }
                }
            }
        })->with('feePackages', 'course', 'feePackages.feePackageInstallments', 'headFineStudents', 'headFineStudents.headFine')->get();
        foreach ($filtersArray as $key => $value) {
            if ($key < (sizeof($filtersArray) - 1)) {
                $filter = explode(':', $value);
                if ($filter[0] == 'course_id') {
                    $coursesubjects = CourseSubject::where($filter[0], '=', $filter[1]);
                }
            }
        }
        $coursesubjects = $coursesubjects->get()->pluck('subject_id');
        $subjects = Subject::whereIn('id', $coursesubjects)->get();
        $students = $filteredStudents;
        return response()->json(['students' => $students, 'subjects' => $subjects]);
    }

    public function incrementPackageTransfer(Request $request)
    {
        $input = $request->all();
        $x = 1;
        $student_books = new StudentBook;
        $selected_subjects = $request->get('selected_subjects');

        foreach ($input['selected_students'] as $index => $value) {
            \Log::info('loop_count --- ' . $index);

            $history = StudentAcademicHistory::where('student_id', '=', $value)->get()->last();

            $student_academic_history = new StudentAcademicHistory();

            $student_academic_history->course_name = $history['course_name'];
            $student_academic_history->student_id = $value;
            $student_academic_history->course_id = $history['course_id'];
            $student_academic_history->session_name = $history['session_name'];
            $student_academic_history->session_id = $history['session_id'];
            $student_academic_history->session_name = $history['session_name'];
            $student_academic_history->semester_id = $history['semester_id'];
            $student_academic_history->is_promoted = true;
            $student_academic_history->save();
            foreach ($selected_subjects as $key => $row) {
                $subject = Subject::find($row);
                $subject_course = $subject['name'];
                $studentbooks = StudentBook::create([
                    'subject_name' => $subject_course,
                    'student_academic_history_id' => $student_academic_history['id'],
                ]);
            }
            $data = FeePackage::where('academic_history_id', '=', $history['id'])->get()->first();
            $getPackage = $data['net_total'];
            $increment_amount = $request->get('increment');
            $increment = ($getPackage * $increment_amount) / 100;
            $increment_fee = $increment + $getPackage;

            $current_date = Carbon::now();
            $due_date = $current_date->addMonth()->format('Y-m-d');

            $feePackages = new FeePackage();
            $feePackages->academic_history_id = $student_academic_history['id'];
            $feePackages->student_id = $value;
            $feePackages->total_package = $increment_fee;
            $feePackages->net_total = $increment_fee;
            $feePackages->status_name = config('constants.payment_statuses')[0];
            $feePackages->status_id = key(config('constants.payment_statuses'));
            $feePackages->net_total = $increment_fee;
            $feePackages->due_date = $due_date;
            $feePackages->tution_fee = $increment_fee;
            $feePackages->total_tution_fee = $increment_fee;
            $feePackages->user_id = Auth::user()->id;
            $feePackages->user_name = Auth::user()->name;
            $feePackages->save();

        }
        return response()->json(['success' => true, 'message' => 'data migrate successfully',
            $studentbooks, $feePackages], 200);

    }
}
