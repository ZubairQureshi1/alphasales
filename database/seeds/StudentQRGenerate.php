<?php

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentQRGenerate extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        // DB::table('attendances')->truncate();
        // HeadFineStudent::where('head_id', '=', '5')->delete();
        // HeadFineStudent::where('head_id', '=', '9')->delete();
        // HeadFineStudent::where('head_id', '=', '10')->delete();
        // HeadFineStudent::where('head_id', '=', '13')->delete();
        // HeadFineStudent::where('head_id', '=', '14')->delete();
        // HeadFineStudent::where('head_id', '=', '19')->delete();
        // HeadFineStudent::where('head_id', '=', '21')->delete();
        // HeadFineStudent::where('head_id', '=', '24')->delete();
        // HeadFineStudent::where('head_id', '=', '27')->delete();
        // $students = Student::where('session_name', '=', '2017-2019')->where('reference_id', '=', '27')->get();
        // $students = Student::get();
        // foreach ($students as $key => $student) {
        // $this->generateQRCode($student);
        // $student->feePackages()->delete();
        // $student->headFineStudents()->delete();
        // }
        // $students = Student::where('session_name', '=', '2018-2020')->where('reference_id', '=', '27')->get();
        // foreach ($students as $key => $student) {
        //     // $this->generateQRCode($student);
        //     $student->feePackages()->delete();
        //     $student->headFineStudents()->delete();
        // }
        $students = Student::where('session_name', '=', '2018-2020')->get();
        foreach ($students as $key => $student) {
            $this->generateQRCode($student);
        }

        // $times = ['2019-04-24UTC06:07:30.6090', '2019-04-24UTC06:11:30.6090', '2019-04-24UTC06:03:30.6090', '2019-04-24UTC06:16:30.6090', '2019-04-24UTC06:02:30.6090', '2019-04-24UTC06:13:30.6090'];
        // \Log::info(array_rand($times, 1));
        // $attendances = App\Models\Attendance::where('user_id', '=', 61)->where('date', '>=', '2019-06-01')->where('date', '<=', '2019-06-21')->get();
        // foreach ($attendances as $attendance) {
        //     $attendance->check_in_time = $times[array_rand($times, 1)];
        //     $attendance->status_id = 5;
        //     $attendance-   >status = 'On-Time';
        //     $attendance->update();
        // }
    }

    public function generateQRCode($student)
    {
        $input = $student->only(['id', 'student_name']);
        $qr_code_name = $student->student_name . '-' . $student->old_roll_no . '.png';
        $input['type'] = 'student';

        // $directory = \FileUploader::makeDirectory(false, $student, 'qr_codes');
        // \QrCode::errorCorrection('H')->format('png')->encoding('UTF-8')->size(180)
        //     ->generate(json_encode($input, true), ($directory . $qr_code_name));

        \QrCode::errorCorrection('H')->format('png')->encoding('UTF-8')->size(180)
            ->generate(json_encode($input, true), public_path(config('constants.attachment_path.student_qr_destination_path')) . $qr_code_name);

    }

}
