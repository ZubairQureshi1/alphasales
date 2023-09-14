<?php

use App\Models\Admission;
use App\Models\Student;
use Illuminate\Database\Seeder;

class UpdateTransportCheckInAdmissionAndStudentTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // cs campus

        $admissions = Admission::where('session_id', '4')->where('is_transport', '0')->get();
        foreach ($admissions as $key => $admission) {
            $admission->is_transport = 1;
            $admission->transport_route_id = null;
            $admission->update();
        }
        $students = Student::where('session_id', '4')->where('is_transport', '0')->get();
        foreach ($students as $key => $student) {
            $student->is_transport = 1;
            $student->transport_route_id = null;
            $student->update();
        }
    }
}
