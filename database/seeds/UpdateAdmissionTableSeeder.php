<?php

use App\Models\Admission;
use Illuminate\Database\Seeder;

class UpdateAdmissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admissions = Admission::get();
        foreach ($admissions as $key => $admission) {
            if ($admission->student_category_id != null) {
                $admission->student_category_name = isset(config('constants.student_categories')[$admission->student_category_id]) ? config('constants.student_categories')[$admission->student_category_id] : null;
            } else {
                $admission->student_category_name = '---';
            }

            $admission->update();
        }
    }
}
