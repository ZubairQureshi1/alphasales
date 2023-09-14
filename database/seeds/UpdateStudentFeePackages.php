<?php

use App\Models\Student;
use Illuminate\Database\Seeder;

class UpdateStudentFeePackages extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $fee_packages = FeePackage::get();
        $students = Student::with('feePackages')->where('session_name', '=', '2017-2019')->where('course_id', '=', '16')->get();
        foreach ($students as $student) {
            $fee_package = $student->feePackages()->get()->last();
            // \Log::info('course: 16');
            if (isset($fee_package)) {
                $fee_package->tution_fee = '79200';
                $fee_package->admission_fee = '0';
                $fee_package->total_tution_fee = '79200';
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

        $students = Student::with('feePackages')->where('session_name', '=', '2017-2019')->where('course_id', '=', '17')->get();
        foreach ($students as $student) {
            // \Log::info('course: 17');
            $fee_package = $student->feePackages()->get()->last();
            if (isset($fee_package)) {
                $fee_package->tution_fee = '79200';
                $fee_package->admission_fee = '0';
                $fee_package->total_tution_fee = '79200';
                $fee_package->miscellaneous_amount = '0';
                $fee_package->discount = (int) $fee_package->total_tution_fee - (int) $fee_package->net_total;
                $fee_package->discount_percentage = ((int) $fee_package->discount / (int) $fee_package->total_tution_fee) * 100;
                $fee_package->update();
                // dd($fee_package->toArray());
            }
        }

        $students = Student::with('feePackages')->where('session_name', '=', '2017-2019')->where('course_id', '=', '18')->get();
        foreach ($students as $student) {
            // \Log::info('course: 18');
            $fee_package = $student->feePackages()->get()->last();
            if (isset($fee_package)) {
                $fee_package->tution_fee = '79200';
                $fee_package->admission_fee = '0';
                $fee_package->total_tution_fee = '79200';
                $fee_package->miscellaneous_amount = '0';
                $fee_package->discount = (int) $fee_package->total_tution_fee - (int) $fee_package->net_total;
                $fee_package->discount_percentage = ((int) $fee_package->discount / (int) $fee_package->total_tution_fee) * 100;
                $fee_package->update();
                // dd($fee_package->toArray());
            }
        }

        $students = Student::with('feePackages')->where('session_name', '=', '2017-2019')->where('course_id', '=', '19')->get();
        foreach ($students as $student) {
            // \Log::info('course: 19');
            $fee_package = $student->feePackages()->get()->last();
            if (isset($fee_package)) {
                $fee_package->tution_fee = '79200';
                $fee_package->admission_fee = '0';
                $fee_package->total_tution_fee = '79200';
                $fee_package->miscellaneous_amount = '0';
                $fee_package->discount = (int) $fee_package->total_tution_fee - (int) $fee_package->net_total;
                $fee_package->discount_percentage = ((int) $fee_package->discount / (int) $fee_package->total_tution_fee) * 100;
                $fee_package->update();
                // dd($fee_package->toArray());
            }
        }

        $students = Student::with('feePackages')->where('session_name', '=', '2017-2019')->where('course_id', '=', '21')->get();
        foreach ($students as $student) {
            // \Log::info('course: 21');
            $fee_package = $student->feePackages()->get()->last();
            if (isset($fee_package)) {
                $fee_package->tution_fee = '79200';
                $fee_package->admission_fee = '0';
                $fee_package->total_tution_fee = '79200';
                $fee_package->miscellaneous_amount = '0';
                $fee_package->discount = (int) $fee_package->total_tution_fee - (int) $fee_package->net_total;
                $fee_package->discount_percentage = ((int) $fee_package->discount / (int) $fee_package->total_tution_fee) * 100;
                $fee_package->update();
                // dd($fee_package->toArray());
            }
        }

        $students = Student::with('feePackages')->where('session_name', '=', '2017-2019')->where('course_id', '=', '20')->get();
        // \Log::info('course: 20');
        foreach ($students as $student) {
            $fee_package = $student->feePackages()->get()->last();
            if (isset($fee_package)) {
                $fee_package->tution_fee = '69300';
                $fee_package->admission_fee = '0';
                $fee_package->total_tution_fee = '69300';
                $fee_package->miscellaneous_amount = '0';
                $fee_package->discount = (int) $fee_package->total_tution_fee - (int) $fee_package->net_total;
                $fee_package->discount_percentage = ((int) $fee_package->discount / (int) $fee_package->total_tution_fee) * 100;
                $fee_package->update();
                // dd($fee_package->toArray());
            }
        }

        $students = Student::with('feePackages')->where('session_name', '=', '2017-2019')->where('course_id', '=', '22')->get();
        foreach ($students as $student) {
            // \Log::info('course: 22');
            $fee_package = $student->feePackages()->get()->last();
            if (isset($fee_package)) {
                $fee_package->tution_fee = '69300';
                $fee_package->admission_fee = '0';
                $fee_package->total_tution_fee = '69300';
                $fee_package->miscellaneous_amount = '0';
                $fee_package->discount = (int) $fee_package->total_tution_fee - (int) $fee_package->net_total;
                $fee_package->discount_percentage = ((int) $fee_package->discount / (int) $fee_package->total_tution_fee) * 100;
                $fee_package->update();
                // dd($fee_package->toArray());
            }
        }

        /* ===========================================2018-2020====================================================== */

        $students = Student::with('feePackages')/*->where('reference_id', '!=', '27')*/->where('session_name', '=', '2018-2020')->where('course_id', '=', 16)->get();
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
        $students = Student::with('feePackages')/*->where('reference_id', '!=', '27')*/->where('session_name', '=', '2018-2020')->where('course_id', '=', 17)->get();
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

        $students = Student::with('feePackages')/*->where('reference_id', '!=', '27')*/->where('session_name', '=', '2018-2020')->where('course_id', '=', 18)->get();
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

        $students = Student::with('feePackages')/*->where('reference_id', '!=', '27')*/->where('session_name', '=', '2018-2020')->where('course_id', '=', 19)->get();
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

        $students = Student::with('feePackages')/*->where('reference_id', '!=', '27')*/->where('session_name', '=', '2018-2020')->where('course_id', '=', 21)->get();
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

        $students = Student::with('feePackages')/*->where('reference_id', '!=', '27')*/->where('session_name', '=', '2018-2020')->where('course_id', '=', 20)->get();
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

        $students = Student::with('feePackages')/*->where('reference_id', '!=', '27')*/->where('session_name', '=', '2018-2020')->where('course_id', '=', 22)->get();
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
