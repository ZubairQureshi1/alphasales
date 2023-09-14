<?php

use App\Models\Student;
use Illuminate\Database\Seeder;

class UpdateStudentFeePackages2020 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $fee_packages = FeePackage::get();
        $students = Student::with('feePackages')->where('reference_id', '!=', '27')->where('session_name', '=', '2018-2020')->where('course_id', '=', 16)->get();
        foreach ($students as $student) {
            $fee_package = $student->feePackages()->get()->last();
            if (isset($fee_package)) {
                $fee_package->tution_fee = '72000';
                $fee_package->total_tution_fee = '80000';
                $fee_package->miscellaneous_amount = '0';
                $fee_package->discount = (int) $fee_package->total_tution_fee - (int) $fee_package->net_total;
                $fee_package->discount_percentage = ((int) $fee_package->discount / (int) $fee_package->total_tution_fee) * 100;
                $fee_package->update();
            }
            // dd($fee_package->toArray());

            // if ($package->admission_fee == '') {
            //     $package->admission_fee = (int) $package->total_tution_fee - ((int) $package->tution_fee + (int) $package->miscellaneous_amount);
            //     $package->update();
            // }
        }
        $students = Student::with('feePackages')->where('reference_id', '!=', '27')->where('session_name', '=', '2018-2020')->where('course_id', '=', 17)->get();
        foreach ($students as $student) {
            $fee_package = $student->feePackages()->get()->last();
            if (isset($fee_package)) {
                $fee_package->tution_fee = '72000';
                $fee_package->total_tution_fee = '80000';
                $fee_package->miscellaneous_amount = '0';
                $fee_package->discount = (int) $fee_package->total_tution_fee - (int) $fee_package->net_total;
                $fee_package->discount_percentage = ((int) $fee_package->discount / (int) $fee_package->total_tution_fee) * 100;
                $fee_package->update();
                // dd($fee_package->toArray());
            }
        }

        $students = Student::with('feePackages')->where('reference_id', '!=', '27')->where('session_name', '=', '2018-2020')->where('course_id', '=', 18)->get();
        foreach ($students as $student) {
            $fee_package = $student->feePackages()->get()->last();
            if (isset($fee_package)) {
                $fee_package->tution_fee = '72000';
                $fee_package->total_tution_fee = '80000';
                $fee_package->miscellaneous_amount = '0';
                $fee_package->discount = (int) $fee_package->total_tution_fee - (int) $fee_package->net_total;
                $fee_package->discount_percentage = ((int) $fee_package->discount / (int) $fee_package->total_tution_fee) * 100;
                $fee_package->update();
                // dd($fee_package->toArray());
            }
        }

        $students = Student::with('feePackages')->where('reference_id', '!=', '27')->where('session_name', '=', '2018-2020')->where('course_id', '=', 19)->get();
        foreach ($students as $student) {
            $fee_package = $student->feePackages()->get()->last();
            if (isset($fee_package)) {
                $fee_package->tution_fee = '72000';
                $fee_package->total_tution_fee = '80000';
                $fee_package->miscellaneous_amount = '0';
                $fee_package->discount = (int) $fee_package->total_tution_fee - (int) $fee_package->net_total;
                $fee_package->discount_percentage = ((int) $fee_package->discount / (int) $fee_package->total_tution_fee) * 100;
                $fee_package->update();
                // dd($fee_package->toArray());
            }
        }

        $students = Student::with('feePackages')->where('reference_id', '!=', '27')->where('session_name', '=', '2018-2020')->where('course_id', '=', 21)->get();
        foreach ($students as $student) {
            $fee_package = $student->feePackages()->get()->last();
            if (isset($fee_package)) {
                $fee_package->tution_fee = '72000';
                $fee_package->total_tution_fee = '80000';
                $fee_package->miscellaneous_amount = '0';
                $fee_package->discount = (int) $fee_package->total_tution_fee - (int) $fee_package->net_total;
                $fee_package->discount_percentage = ((int) $fee_package->discount / (int) $fee_package->total_tution_fee) * 100;
                $fee_package->update();
                // dd($fee_package->toArray());
            }
        }

        $students = Student::with('feePackages')->where('reference_id', '!=', '27')->where('session_name', '=', '2018-2020')->where('course_id', '=', 20)->get();
        foreach ($students as $student) {
            $fee_package = $student->feePackages()->get()->last();
            if (isset($fee_package)) {
                $fee_package->tution_fee = '63000';
                $fee_package->total_tution_fee = '71000';
                $fee_package->miscellaneous_amount = '0';
                $fee_package->discount = (int) $fee_package->total_tution_fee - (int) $fee_package->net_total;
                $fee_package->discount_percentage = ((int) $fee_package->discount / (int) $fee_package->total_tution_fee) * 100;
                $fee_package->update();
                // dd($fee_package->toArray());
            }
        }

        $students = Student::with('feePackages')->where('reference_id', '!=', '27')->where('session_name', '=', '2018-2020')->where('course_id', '=', 22)->get();
        foreach ($students as $student) {
            $fee_package = $student->feePackages()->get()->last();
            if (isset($fee_package)) {
                $fee_package->tution_fee = '63000';
                $fee_package->total_tution_fee = '71000';
                $fee_package->miscellaneous_amount = '0';
                $fee_package->discount = (int) $fee_package->total_tution_fee - (int) $fee_package->net_total;
                $fee_package->discount_percentage = ((int) $fee_package->discount / (int) $fee_package->total_tution_fee) * 100;
                $fee_package->update();
                // dd($fee_package->toArray());
            }
        }

    }
}
