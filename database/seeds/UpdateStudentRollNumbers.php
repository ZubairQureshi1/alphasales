<?php

use App\Models\Student;
use App\Models\SystemRollNumber;
use Illuminate\Database\Seeder;

class UpdateStudentRollNumbers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = Student::get();
        foreach ($students as $student) {
            $system_roll_number = SystemRollNumber::where('organization_campus_id', '=', $student->organization_campus_id)->where('course_id', '=', $student->course_id)->where('session_id', '=', $student->session_id)->where('student_id', $student->id)->get()->first();
            $student->system_roll_number_id = $system_roll_number->id;
            $student->update();
        }
    }
    /*
public function run()
{
DB::statement('SET FOREIGN_KEY_CHECKS=0;');
DB::table('system_roll_numbers')->truncate();
$students = Student::get();
$old_roll_numbers = DB::table('system_roll_numbers_old')->get();
foreach ($students as $key => $student) {
// if ($old_roll_numbers->where('student_id', $student->id)->count() > 0) {

$system_roll_number = new SystemRollNumber();

$course = Course::find($student->course_id);
// NOTE: Fetch session start date

$start_date = SessionCourse::where([
'session_id' => $student->session_id,
'course_id' => $course->id,
'organization_campus_id' => $student->organization_campus_id,
// 'academic_term_id' => $student->academic_term_id,
])->get()->last()->session_start_date;
$session_start_date = new \DateTime(str_replace('/', '-', $start_date));
// NOTE: Fetch student roll number from system roll number
// NOTE: Roll Number requirements
// NOTE: Generating shift id
$course_code = $course->courseSessions()->where(['organization_campus_id' => $student->organization_campus_id, 'session_id' => $student->session_id])->get()->last()->course_code ?? 'CODENOTFOUND';
\Log::info([
'student_id' => $student->id,
'session_id' => $student->session_id,
'course_id' => $course->id,
'course_name' => $course->name,
'course_code' => $course_code,
'organization_campus_id' => $student->organization_campus_id,
'academic_term_id' => $student->academic_term_id,
]);
$student_shift = $student->shift_id == 0 ? 'M' : ($student->shift_id == 1 ? 'E' : ($student->shift_id == 2 ? 'W' : ''));
// NOTE: updated roll number
$courseWiseStudents = SystemRollNumber::withTrashed()->where('organization_campus_id', '=', $student->organization_campus_id)->where('course_id', '=', $course->id)->where('session_id', '=', $student->session_id)->get();

$courseStudentCount;
if (!empty($courseWiseStudents) && count($courseWiseStudents) == 0) {
$courseStudentCount = 1;
} else {
$courseStudentCount = $courseWiseStudents->last()->generated_at_length + 1;
}
$student_roll_no = OrganizationCampus::find($student->organization_campus_id)->code . '-' . AffiliatedBody::find($student->affiliated_body_id)->code . '-' . $session_start_date->format('Y') . '-' . $course_code . '-' . $student_shift . '-' . sprintf('%05d', intval($courseStudentCount));
// NOTE: updated system roll number
$system_roll_no_input = ['roll_no' => $student_roll_no, 'session_id' => $student->session_id, 'course_id' => $student->course_id, 'student_id' => $student->id, 'admission_id' => $student->admission_id, 'session_name' => $student->session_name, 'student_name' => $student->student_name, 'course_name' => $student->course_name, 'is_assigned' => true, 'generated_at_length' => $courseStudentCount, 'organization_campus_id' => $student->organization_campus_id];
$system_roll_number->create($system_roll_no_input);
// NOTE: Update in student model
$student->update(['system_roll_number_id' => $system_roll_number->id, 'roll_no' => $student_roll_no]);

// also update student roll number in pwwb module
// update new roll number to pwwb file if student category is pwwb
if ($student->student_category_id == 0) {
$admission = Admission::find($student->admission_id);
$pwwbFile = IndexTable::find($admission->pwwb_file_id);
$pwwbFile->roll_no = $student_roll_no;
$pwwbFile->update();
}

// $dirs = array_filter(glob('uploads\Students\*'), 'is_dir');

// NOTE" shift uploaded con// NOTE" shift uploaded content to new folder if roll number is updated
// if (\File::exists(public_path(config('constants.attachment_path.file_destination_path') . '/Students/' . $old_roll_numbers->where('student_id', $student->id)->last()->roll_no))) {
//     $src_dir = public_path(config('constants.attachment_path.file_destination_path') . '/Students/' . $old_roll_numbers->where('student_id', $student->id)->last()->roll_no);
//     $dest_dir = public_path(config('constants.attachment_path.file_destination_path') . '/Students/' . $student->id);
//     \Log::info($src_dir . ' ---------- ' . $dest_dir);
//     File::copyDirectory($src_dir, $dest_dir);
//     if ($old_roll_numbers->where('roll_no', $old_roll_numbers->where('student_id', $student->id)->last()->roll_no)->count() == SystemRollNumber::whereIn('student_id', $old_roll_numbers->where('roll_no', $old_roll_numbers->where('student_id', $student->id)->last()->roll_no)->pluck('student_id'))->count()) {
//         File::deleteDirectory($src_dir);
//     }

// }

// } else {
//     \Log::info('Roll No Code Not Ran for --- ' . $student->roll_no);
// }
}

DB::statement('SET FOREIGN_KEY_CHECKS=1;');
}*/
}
