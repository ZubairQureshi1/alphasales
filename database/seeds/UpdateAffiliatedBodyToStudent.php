<?php

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\AffiliatedBody;

class UpdateAffiliatedBodyToStudent extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$students = Student::all();
        foreach ($students as $student) {
        	$student->affiliated_body_id = AffiliatedBody::first()->id;
        	$student->update();
        }
    }
}
