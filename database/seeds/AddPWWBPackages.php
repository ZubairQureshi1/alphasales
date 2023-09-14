<?php

use App\Models\FeePackage;
use App\Models\FeeVoucher;
use App\Models\HeadFineStudent;
use App\Models\Student;
use Illuminate\Database\Seeder;

class AddPWWBPackages extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = Student::where('reference_id', '=', '27')->where('session_name', '=', '2017-2019')->where('course_id', '=', 16)->get();
        // dd($students->toArray());
        foreach ($students as $student) {
            $this->createPackagePart2($student);
        }
        $students = Student::where('reference_id', '=', '27')->where('session_name', '=', '2017-2019')->where('course_id', '=', 17)->get();
        foreach ($students as $student) {
            $this->createPackagePart2($student);
        }
        $students = Student::where('reference_id', '=', '27')->where('session_name', '=', '2017-2019')->where('course_id', '=', 18)->get();
        foreach ($students as $student) {
            $this->createPackagePart2($student);
        }

        $students = Student::where('reference_id', '=', '27')->where('session_name', '=', '2017-2019')->where('course_id', '=', 21)->get();
        foreach ($students as $student) {
            $this->createPackagePart2($student);
        }

        $students = Student::where('reference_id', '=', '27')->where('session_name', '=', '2017-2019')->where('course_id', '=', 23)->get();
        foreach ($students as $student) {
            $this->createPackagePart2($student);
        }
        $students = Student::where('reference_id', '=', '27')->where('session_name', '=', '2017-2019')->where('course_id', '=', 20)->get();
        foreach ($students as $student) {
            $this->createPackagePart2FAICOM($student);
        }
        $students = Student::where('reference_id', '=', '27')->where('session_name', '=', '2017-2019')->where('course_id', '=', 22)->get();
        foreach ($students as $student) {
            $this->createPackagePart2FAICOM($student);
        }
/* ====================================================2018-2020============================================================*/

		$students = Student::where('reference_id', '=', '27')->where('session_name', '=', '2018-2020')->where('course_id', '=', 16)->get();
        // dd($students->toArray());
        foreach ($students as $student) {
            $this->createPackagePart1($student);
        }
        $students = Student::where('reference_id', '=', '27')->where('session_name', '=', '2018-2020')->where('course_id', '=', 17)->get();
        foreach ($students as $student) {
            $this->createPackagePart1($student);
        }
        $students = Student::where('reference_id', '=', '27')->where('session_name', '=', '2018-2020')->where('course_id', '=', 18)->get();
        foreach ($students as $student) {
            $this->createPackagePart1($student);
        }

        $students = Student::where('reference_id', '=', '27')->where('session_name', '=', '2018-2020')->where('course_id', '=', 21)->get();
        foreach ($students as $student) {
            $this->createPackagePart1($student);
        }

        $students = Student::where('reference_id', '=', '27')->where('session_name', '=', '2018-2020')->where('course_id', '=', 23)->get();
        foreach ($students as $student) {
            $this->createPackagePart1($student);
        }
        $students = Student::where('reference_id', '=', '27')->where('session_name', '=', '2018-2020')->where('course_id', '=', 20)->get();
        foreach ($students as $student) {
            $this->createPackagePart1FAICOM($student);
        }
        $students = Student::where('reference_id', '=', '27')->where('session_name', '=', '2018-2020')->where('course_id', '=', 22)->get();
        foreach ($students as $student) {
            $this->createPackagePart1FAICOM($student);
        }

    }

    public function createPackagePart2($student)
    {

        try {
            \DB::beginTransaction();
            $status_name = config('constants.payment_statuses')[0];
            $status_id = 0;

            $discount_status_id = 19;
            $discount_status_name = 'PWWB(worker Welfare)';

            $academicHistoryArray = $student->studentAcademicHistories()->get()->last();
            // dd($academicHistoryArray[sizeof($academicHistoryArray) - 1]['id']);

            $fee_package = new FeePackage();
            //dd($input);

            $fee_package->admission_fee = '0';
            $fee_package->tution_fee = '72000';
            $fee_package->miscellaneous_amount = '0';
            $fee_package->total_tution_fee = '' . (0 + 72000 + 0) . '';
            $fee_package->status_id = $status_id;
            $fee_package->discount = '0';
            $fee_package->discount_percentage = '0';
            $fee_package->status_name = $status_name;
            $fee_package->discount_status_id = $discount_status_id;
            $fee_package->discount_status = $discount_status_name;
            $fee_package->net_total = $fee_package->total_tution_fee;
            $fee_package->total_package = $fee_package->total_tution_fee;
            $fee_package->student_id = $student->id;
            $fee_package->due_date = '2018-10-27';
            $fee_package->fee_structure_type_id = 0;
            $fee_package->fee_structure_type = config('constants.fee_structure_types')[0];
            $fee_package->user_name = 'admin';
            $fee_package->user_id = 1;
            $fee_package->save();

            $voucher = FeeVoucher::get();
            $vouchers_count = sizeof($voucher);
            $newVoucher = new FeeVoucher();
            $voucher_code = sprintf('%07d', intval($vouchers_count) + 1);
            $newVoucher->voucher_code = $voucher_code;
            $newVoucher->package_id = $fee_package->id;
            $newVoucher->save();
            $fee_package->voucher_id = $newVoucher->id;
            $fee_package->voucher_code = $voucher_code;
            $fee_package->update();

            $head_to_add = ['2', '6', '7', '32', '33'];
            for ($i = 0; $i < sizeof($head_to_add); $i++) {

                $headfine = new HeadFineStudent();
                $headfine->head_id = $head_to_add[$i];
                $headfine->student_id = $student->id;
                $headfine->status_name = $status_name;
                $headfine->status_id = $status_id;
                $headfine->package_id = $fee_package->id;
                if ($i == '3') {
                    $headfine->head_amount = '2750';
                }
                if ($i == '4') {
                    $headfine->head_amount = '8500';
                }
                $headfine->voucher_code = $voucher_code;
                $headfine->due_date = '2018-10-27';
                $headfine->user_name = 'admin';
                $headfine->user_id = 1;
                $headfine->save();

                $voucher = FeeVoucher::get();
                $number = sizeof($voucher);
                $newVoucher = new FeeVoucher();
                $voucher_code = sprintf('%07d', intval($number) + 1);
                $newVoucher->voucher_code = $voucher_code;
                $newVoucher->head_fine_student_id = $headfine->id;
                $newVoucher->save();
            }

            \DB::commit();

        } catch (\Exception $e) {
            dd($e);
            \DB::rollback();
            Alertify::error('Something went wrong.', $title = null, $options = []);
        }
    }
    public function createPackagePart2FAICOM($student)
    {

        try {
            \DB::beginTransaction();
            $status_name = config('constants.payment_statuses')[0];
            $status_id = 0;

            $discount_status_id = 19;
            $discount_status_name = 'PWWB(worker Welfare)';

            $academicHistoryArray = $student->studentAcademicHistories()->get()->last();
            // dd($academicHistoryArray[sizeof($academicHistoryArray) - 1]['id']);

            $fee_package = new FeePackage();
            //dd($input);

            $fee_package->admission_fee = '0';
            $fee_package->tution_fee = '63000';
            $fee_package->miscellaneous_amount = '0';
            $fee_package->total_tution_fee = '' . (0 + 63000 + 0) . '';
            $fee_package->status_id = $status_id;
            $fee_package->discount = '0';
            $fee_package->discount_percentage = '0';
            $fee_package->status_name = $status_name;
            $fee_package->discount_status_id = $discount_status_id;
            $fee_package->discount_status = $discount_status_name;
            $fee_package->net_total = $fee_package->total_tution_fee;
            $fee_package->total_package = $fee_package->total_tution_fee;
            $fee_package->student_id = $student->id;
            $fee_package->due_date = '2018-10-27';
            $fee_package->fee_structure_type_id = 0;
            $fee_package->fee_structure_type = config('constants.fee_structure_types')[0];
            $fee_package->user_name = 'admin';
            $fee_package->user_id = 1;
            $fee_package->save();

            $voucher = FeeVoucher::get();
            $vouchers_count = sizeof($voucher);
            $newVoucher = new FeeVoucher();
            $voucher_code = sprintf('%07d', intval($vouchers_count) + 1);
            $newVoucher->voucher_code = $voucher_code;
            $newVoucher->package_id = $fee_package->id;
            $newVoucher->save();
            $fee_package->voucher_id = $newVoucher->id;
            $fee_package->voucher_code = $voucher_code;
            $fee_package->update();

            $head_to_add = ['2', '6', '7', '32', '33'];
            for ($i = 0; $i < sizeof($head_to_add); $i++) {

                $headfine = new HeadFineStudent();
                $headfine->head_id = $head_to_add[$i];
                $headfine->student_id = $student->id;
                $headfine->status_name = $status_name;
                $headfine->status_id = $status_id;
                $headfine->package_id = $fee_package->id;
                $headfine->voucher_code = $voucher_code;
                if ($i == '3') {
                    $headfine->head_amount = '2750';
                }
                if ($i == '4') {
                    $headfine->head_amount = '8500';
                }
                $headfine->due_date = '2018-10-27';
                $headfine->user_name = 'admin';
                $headfine->user_id = 1;
                $headfine->save();

                $voucher = FeeVoucher::get();
                $number = sizeof($voucher);
                $newVoucher = new FeeVoucher();
                $voucher_code = sprintf('%07d', intval($number) + 1);
                $newVoucher->voucher_code = $voucher_code;
                $newVoucher->head_fine_student_id = $headfine->id;
                $newVoucher->save();
            }

            \DB::commit();

        } catch (\Exception $e) {
            dd($e);
            \DB::rollback();
            Alertify::error('Something went wrong.', $title = null, $options = []);
        }
    }
    public function createPackagePart1($student)
    {

        try {
            \DB::beginTransaction();
            $status_name = config('constants.payment_statuses')[0];
            $status_id = 0;

            $discount_status_id = 19;
            $discount_status_name = 'PWWB(worker Welfare)';

            $academicHistoryArray = $student->studentAcademicHistories()->get()->last();
            // dd($academicHistoryArray[sizeof($academicHistoryArray) - 1]['id']);

            $fee_package = new FeePackage();
            //dd($input);

            $fee_package->admission_fee = '8000';
            $fee_package->tution_fee = '72000';
            $fee_package->miscellaneous_amount = '0';
            $fee_package->total_tution_fee = '' . (8000 + 72000 + 0) . '';
            $fee_package->status_id = $status_id;
            $fee_package->discount = '0';
            $fee_package->discount_percentage = '0';
            $fee_package->status_name = $status_name;
            $fee_package->discount_status_id = $discount_status_id;
            $fee_package->discount_status = $discount_status_name;
            $fee_package->net_total = $fee_package->total_tution_fee;
            $fee_package->total_package = $fee_package->total_tution_fee;
            $fee_package->student_id = $student->id;
            $fee_package->due_date = '2018-10-27';
            $fee_package->fee_structure_type_id = 0;
            $fee_package->fee_structure_type = config('constants.fee_structure_types')[0];
            $fee_package->user_name = 'admin';
            $fee_package->user_id = 1;
            $fee_package->save();

            $voucher = FeeVoucher::get();
            $vouchers_count = sizeof($voucher);
            $newVoucher = new FeeVoucher();
            $voucher_code = sprintf('%07d', intval($vouchers_count) + 1);
            $newVoucher->voucher_code = $voucher_code;
            $newVoucher->package_id = $fee_package->id;
            $newVoucher->save();
            $fee_package->voucher_id = $newVoucher->id;
            $fee_package->voucher_code = $voucher_code;
            $fee_package->update();

            $head_to_add = ['1', '2','3','4', '6', '7', '32', '33'];
            for ($i = 0; $i < sizeof($head_to_add); $i++) {

                $headfine = new HeadFineStudent();
                $headfine->head_id = $head_to_add[$i];
                $headfine->student_id = $student->id;
                $headfine->status_name = $status_name;
                $headfine->status_id = $status_id;
                $headfine->package_id = $fee_package->id;
                $headfine->voucher_code = $voucher_code;
                $headfine->due_date = '2018-10-27';
                $headfine->user_name = 'admin';
                $headfine->user_id = 1;
                $headfine->save();

                $voucher = FeeVoucher::get();
                $number = sizeof($voucher);
                $newVoucher = new FeeVoucher();
                $voucher_code = sprintf('%07d', intval($number) + 1);
                $newVoucher->voucher_code = $voucher_code;
                $newVoucher->head_fine_student_id = $headfine->id;
                $newVoucher->save();
            }

            \DB::commit();

        } catch (\Exception $e) {
            dd($e);
            \DB::rollback();
            Alertify::error('Something went wrong.', $title = null, $options = []);
        }
    }
    public function createPackagePart1FAICOM($student)
    {

        try {
            \DB::beginTransaction();
            $status_name = config('constants.payment_statuses')[0];
            $status_id = 0;

            $discount_status_id = 19;
            $discount_status_name = 'PWWB(worker Welfare)';

            $academicHistoryArray = $student->studentAcademicHistories()->get()->last();
            // dd($academicHistoryArray[sizeof($academicHistoryArray) - 1]['id']);

            $fee_package = new FeePackage();
            //dd($input);

            $fee_package->admission_fee = '0';
            $fee_package->tution_fee = '63000';
            $fee_package->miscellaneous_amount = '0';
            $fee_package->total_tution_fee = '' . (0 + 63000 + 0) . '';
            $fee_package->status_id = $status_id;
            $fee_package->discount = '0';
            $fee_package->discount_percentage = '0';
            $fee_package->status_name = $status_name;
            $fee_package->discount_status_id = $discount_status_id;
            $fee_package->discount_status = $discount_status_name;
            $fee_package->net_total = $fee_package->total_tution_fee;
            $fee_package->total_package = $fee_package->total_tution_fee;
            $fee_package->student_id = $student->id;
            $fee_package->due_date = '2018-10-27';
            $fee_package->fee_structure_type_id = 0;
            $fee_package->fee_structure_type = config('constants.fee_structure_types')[0];
            $fee_package->user_name = 'admin';
            $fee_package->user_id = 1;
            $fee_package->save();

            $voucher = FeeVoucher::get();
            $vouchers_count = sizeof($voucher);
            $newVoucher = new FeeVoucher();
            $voucher_code = sprintf('%07d', intval($vouchers_count) + 1);
            $newVoucher->voucher_code = $voucher_code;
            $newVoucher->package_id = $fee_package->id;
            $newVoucher->save();
            $fee_package->voucher_id = $newVoucher->id;
            $fee_package->voucher_code = $voucher_code;
            $fee_package->update();

            $head_to_add = ['1', '2','3','4', '6', '7', '32', '33'];
            for ($i = 0; $i < sizeof($head_to_add); $i++) {

                $headfine = new HeadFineStudent();
                $headfine->head_id = $head_to_add[$i];
                $headfine->student_id = $student->id;
                $headfine->status_name = $status_name;
                $headfine->status_id = $status_id;
                $headfine->package_id = $fee_package->id;
                $headfine->voucher_code = $voucher_code;
                $headfine->due_date = '2018-10-27';
                $headfine->user_name = 'admin';
                $headfine->user_id = 1;
                $headfine->save();

                $voucher = FeeVoucher::get();
                $number = sizeof($voucher);
                $newVoucher = new FeeVoucher();
                $voucher_code = sprintf('%07d', intval($number) + 1);
                $newVoucher->voucher_code = $voucher_code;
                $newVoucher->head_fine_student_id = $headfine->id;
                $newVoucher->save();
            }

            \DB::commit();

        } catch (\Exception $e) {
            dd($e);
            \DB::rollback();
            Alertify::error('Something went wrong.', $title = null, $options = []);
        }
    }
}
