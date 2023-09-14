<?php

use App\Models\SectionStudent;
use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSectionUpdateSeeder extends Seeder
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
            $updateStudent = Student::find($student['id']);
            $sectionStudent = SectionStudent::where('student_id', '=', $student['id'])->get()->last();
            $updateStudent->section_id = $sectionStudent->section_id;
            $updateStudent->section_name = $sectionStudent->section_name;
            $updateStudent->update();
        }
    }
}
