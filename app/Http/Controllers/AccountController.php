<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\AttendanceFine;
use App\Models\AttendanceFineVoucher;
use App\Models\Course;
use App\Models\DateSheet;
use App\Models\DateSheetCourse;
use App\Models\DateSheetSection;
use App\Models\DateSheetStudent;
use App\Models\ExamFine;
use App\Models\ExamFineVoucher;
use App\Models\FeeFine;
use App\Models\FeeFineVoucher;
use App\Models\FeePackage;
use App\Models\FeePackageInstallment;
use App\models\FeePackageOtherCharge;
use App\Models\FeeVoucher;
use App\Models\Fine;
use App\Models\HeadFine;
use App\Models\HeadFineStudent;
use App\Models\Section;
use App\Models\SessionCourse;
use App\Models\Student;
use App\Models\StudentAcademicHistory;
use App\Models\StudentInstallmentPlan;
use App\User;
use Carbon\Carbon;
use ConstantStrings;
use DateTime;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as SystemSession;
use Notify;
use PDF;

class AccountController extends Controller
{

    private $flagPackage = true;
    public static $filters_configuration = [
        'addFilters' => true,
        // 'route' => '../accounts/reportings',
        'model_path' => 'App\Models\Student',
        'index_path' => 'accounts.index',
        'date_filter_column' => 'admission_date',
        'controller_path' => 'App\Http\Controllers\AccountController',
        'js_path' => '',
        'can_filters' => true,
        'clear_filters' => true,
        'filters' => [
            'users' => false,
            'students' => false,
            'courses' => true,
            'parts' => false,
            'sessions' => true,
            'visitor_users' => false,
            'subjects' => false,
            'roles' => false,
            'admission_forms' => false,
            'departments' => false,
            'designations' => false,
            'sections' => false,
            'admission_types' => true,
            'end_of_registrations' => true,
            'heads' => false,
            'fee_structure_types' => false,
            'payment_statuses' => false,
            'voucher_statuses' => false,
            'start_date' => true,
            'end_date' => false,
        ],
    ];
    public function index(Request $request)
    {
        $students = Student::paginate(ConstantStrings::PAGINATION_RANGE);
        // $student_keys = [];
        // if (count($students) != 0) {
        //     $student_keys = array_keys($students->toArray()[0]);
        // }
        foreach ($students->items() as $key => $student) {
            if ($student->profile_pic != null && $student->profile_pic != '') {
                $student->picture_pic_directory_url = asset(config('constants.attachment_path.student_qr_destination_path') . $student->roll_no . '/Profile_Pictures/' . $student->profile_pic);
            } else {
                $student->picture_pic_directory_url = asset('assets/images/users/dummy.png');
            }
        }
        return view('accounts.index')
            ->with('data', $students)->with('filters_configuration', $this::$filters_configuration) /*->with(['student_keys' => $student_keys])*/;
    }

    public function getFilteredData(Request $request)
    {
        $students = Student::where('old_roll_no', '=', $request['old_roll_no'])->paginate(ConstantStrings::PAGINATION_RANGE);
        // $student_keys = [];
        // if (count($students) != 0) {
        //     $student_keys = array_keys($students->toArray()[0]);
        // // }
        foreach ($students->items() as $key => $student) {
            if ($student->profile_pic != null && $student->profile_pic != '') {
                $student->picture_pic_directory_url = asset(config('constants.attachment_path.student_qr_destination_path') . $student->roll_no . '/Profile_Pictures/' . $student->profile_pic);
            } else {
                $student->picture_pic_directory_url = asset('assets/images/users/dummy.png');
            }
        }
        return view('accounts.index')
            ->with('data', $students)->with('filters_configuration', $this::$filters_configuration) /*->with(['student_keys' => $student_keys])*/;
        return;
    }

    public function getStudentAcademicHistories($id)
    {
        $student_academic_histories = StudentAcademicHistory::where('student_id', '=', $id)->get();
        return view('accounts.student_academic_histories')->with(['student_id' => $id, 'student_academic_histories' => $student_academic_histories]);
    }
    public function showAccountByYear($student_id, $id)
    {
        $heads = HeadFine::get();
        $attendance_fines = $this->getAttenanceDetails($student_id, $id);
        /*
        $attendance_fines = $attendance_fines->groupBy(function ($db_row) {
        $date = new \DateTime($db_row->from_date);
        return $date->format('M_Y');
        });*/
        // dd($attendance_fines);
        $exam_fines = ExamFine::where('student_academic_history_id', '=', $id)->get();
        // dd($attendance_fines);
        $head_keys = [];
        if (count($heads) != 0) {
            $head_keys = array_keys($heads->toArray()[0]);
        }

        $headstudents = HeadFineStudent::where('academic_history_id', '=', $id)->get();
        $headstudent_keys = [];
        if (count($headstudents) != 0) {
            $headstudent_keys = array_keys($headstudents->toArray()[0]);
            // foreach ($headstudents as $key => $value) {
            // $lateFine = $this->calculateFine($value['due_date']);
            // $value['late_head_fine'] = $lateFine;
            // }
        }

        $student = Student::find(StudentAcademicHistory::find($id)->student_id);
        $course_tution_fee = SessionCourse::where('session_id', $student->session_id)->where('course_id', $student->course_id)->get()->first()->tuition_fee;
        $fines = Fine::where('student_id', '=', $id)->get();
        $fine_keys = [];
        if (count($fines) != 0) {
            $fine_keys = array_keys($fines->toArray()[0]);
        }
        //    dd($heads->toArray());
        $fee_packages = FeePackage::where('academic_history_id', '=', $id)->get();
        $course = Course::find($student['course_id']);
        $total_fine_on_installment = 0;

        if (!empty($fee_packages) && sizeof($fee_packages) != 0) {
            $current_pakage = $fee_packages->last();
            $fee_instalments = FeePackageInstallment::with('feeFines')->where('package_id', '=', $current_pakage['id'])->get();
            $due_date = $current_pakage['due_date'];
            foreach ($fee_instalments as $key => $instalment) {
                $total_fine_on_installment = $total_fine_on_installment + $instalment->feeFines()->where('paid_date', '=', null)->sum('amount');
            }
            $lateFine = $this->calculateFine($due_date);
            $current_pakage['late_fee_fine'] = $lateFine;

            // dd(count($fee_instalments));
            if (count($fee_instalments) != 0) {
                $total_installments_amount = 0;
                $amount_for_installment = 0;
                for ($i = 0; $i < sizeof($fee_instalments); $i++) {
                    $due_date = $fee_instalments[$i]['due_date'];
                    if ((int) $fee_instalments[$i]['amount_per_installment'] > 1000) {
                        $lateFine = $this->calculateFine($due_date);
                    } else {
                        $lateFine = 0;
                    }
                    $fee_instalments[$i]['lateFine'] = $lateFine;
                    $total_installments_amount = $total_installments_amount + (int) $fee_instalments[$i]['amount_per_installment'];
                }

                $total_package_amount = (int) $current_pakage['net_total'];
                $amount_for_installment = $total_package_amount - $total_installments_amount;

            } else {

                $amount_for_installment = $current_pakage['net_total'];
            }
            $fee_instalment_keys = null;
            if (count($fee_instalments) != 0) {
                $fee_instalment_keys = array_keys($fee_instalments[0]->getAttributes());
            }
            return view('accounts.details')->with(['student' => $student, 'fee_instalments' => $fee_instalments, 'fee_package' => $current_pakage, 'fee_packages' => $fee_packages, 'course' => $course, 'fee_instalment_keys' => $fee_instalment_keys, 'fines' => $fines, 'fine_keys' => $fine_keys, 'heads' => $heads, 'head_keys' => $head_keys, 'headstudent_keys' => $headstudent_keys, 'headstudents' => $headstudents, 'amount_for_installment' => $amount_for_installment, 'attendance_fines' => $attendance_fines, 'exam_fines' => $exam_fines, 'total_fine_on_installment' => $total_fine_on_installment, 'academic_history_id' => $id]);

        } else {

            return view('accounts.details')->with('fee_instalments', null)->with('student', $student)->with('fee_package', [])->with('fee_packages', $fee_packages)->with('course', $course)->with('heads', $heads)->with('head_keys', $head_keys)->with('amount_for_installment', 0)->with('total_fine_on_installment', $total_fine_on_installment)->with('attendance_fines', $attendance_fines)->with('academic_history_id', $id)->with('course_tution_fee', $course_tution_fee);
        }

    }

    public function calculateFine($due_date)
    {

        $due_date_obj = date_create($due_date);
        $current_date_obj = date_create();
        if ($current_date_obj > $due_date_obj) {
            $diff = date_diff($due_date_obj, $current_date_obj);
            $diff = $diff->days + $diff->invert;
            // dd($diff);
            $lateFine = ($diff * 25);
            return $lateFine;
        } else {
            return 0;
        }
    }

    public function createFeePackage(Request $request)
    {
        try {
            \DB::beginTransaction();
            $input = $request->all();
            $input['status_name'] = config('constants.payment_statuses')[0];
            $input['status_id'] = 0;

            // dd($input);
            $headfine = new HeadFineStudent();

            $discount_status = config('constants.discount_statuses');
            $discount_status_name;

            for ($i = 0; $i < sizeof($discount_status); $i++) {
                if ($i == $input['discount_status_id']) {
                    $discount_status_name = $discount_status[$i];
                }
            }
            $student = Student::find($input['student_id']);
            $academic_history_id = $input['academic_history_id'];
            // dd($academic_history_id[sizeof($academic_history_id) - 1]['id']);

            $fee_package = new FeePackage();
            foreach ($input as $key => $value) {
                if ($key != '_token' && $key != 'heads' && $key != 'amount_per_installment' && $key != 'installment_due_date' && $key != 'installment_count' && $key != 'other_charges') {
                    $fee_package->$key = $value;
                }
            }
            // $fee_package->academic_history_id = $academic_history_id['id'];
            $fee_package->academic_history_id = $academic_history_id;
            $fee_package->discount_status = $discount_status_name;
            $fee_package->organization_campus_id = SystemSession::get('organization_campus_id');
            $fee_package->fee_structure_type_id = 0;
            $fee_package->fee_structure_type = config('constants.fee_structure_types')[0];
            $fee_package->user_name = \Auth::user()->name;
            $fee_package->user_id = \Auth::user()->id;
            $fee_package->save();

            // SAVE OTHER CHARGES
            if ($request->exists('other_charges')) {
                foreach ($request->other_charges as $key => $charge) {
                    if (isset($charge)) {
                        FeePackageOtherCharge::create([
                            'fee_package_id' => $fee_package->id,
                            'student_id' => $student->id,
                            'amount' => $charge['amount'],
                            'reason' => $charge['reason'],
                        ]);
                    }
                }
            }

            $voucher = FeeVoucher::get();
            $vouchers_count = sizeof($voucher);
            $newVoucher = new FeeVoucher();
            $voucher_code = sprintf('%07d', intval($vouchers_count) + 1);
            $newVoucher->voucher_code = $voucher_code;
            $newVoucher->organization_campus_id = SystemSession::get('organization_campus_id');
            $newVoucher->package_id = $fee_package->id;
            $newVoucher->save();
            $fee_package->voucher_id = $newVoucher->id;
            $fee_package->voucher_code = $voucher_code;
            $fee_package->update();

            if (isset($input['installment_count'])) {
                $student_installment_plan = new StudentInstallmentPlan();
                $student_installment_plan->student_id = $student->id;
                $student_installment_plan->fee_package_id = $fee_package->id;
                $student_installment_plan->organization_campus_id = SystemSession::get('organization_campus_id');
                $student_installment_plan->student_academic_history_id = $academic_history_id;
                $student_installment_plan->no_of_installments = $input['installment_count'];
                $student_installment_plan->save();
            }

            if (isset($input['amount_per_installment'])) {
                foreach ($input['amount_per_installment'] as $key => $amount_per_installment) {
                    $installment = new FeePackageInstallment();

                    $installment->net_total = $input['net_tuition_fee'];

                    $installment->amount_per_installment = $amount_per_installment;
                    $installment->package_id = $fee_package->id;
                    $installment->status_id = 0;
                    $installment->organization_campus_id = SystemSession::get('organization_campus_id');
                    $installment->status_name = config('constants.payment_statuses')[0];
                    $installment->student_id = $input['student_id'];
                    $installment->due_date = $input['installment_due_date'][$key];
                    $installment->academic_history_id = $fee_package->academic_history_id;
                    $installment->user_name = \Auth::user()->name;
                    $installment->user_id = \Auth::user()->id;
                    // $installment->voucher_code = $input['voucher_code'];
                    $installment->save();
                }

                $fee_package->fee_structure_type_id = 1;
                $fee_package->fee_structure_type = config('constants.fee_structure_types')[1];
                $fee_package->update();
            }
            \DB::commit();
            return response()->json('Student accounts created successfully.', 200);
        } catch (\Exception $e) {
            \DB::rollback();
            $exception_message = $e->getMessage();
            $exception_message_semi_col_split = explode(":", $exception_message);
            $message = 'Something went wrong at ' . '"' . str_replace(' ', '', str_replace('_', '-', $exception_message_semi_col_split[1])) . '"';
            return response()->json(['success' => false, 'error' => $message], 500);
        }
    }

    public function updateFeePackage(Request $request, $fee_package_id)
    {
        // $fee_package = FeePackage::find($fee_package_id);
        // dd($fee_package->feePackageInstallments()->where('status_id', 0)->first());
        // dd($request->all());
        try {
            $input = $request->all();
            \DB::beginTransaction();
            $fee_package = FeePackage::find($fee_package_id);
            foreach ($input as $key => $value) {
                if ($key != '_token' && $key != 'heads' && $key != 'amount_per_installment' && $key != 'installment_due_date' && $key != 'installment_count' && $key != 'other_fee_charges_reasons' && $key != 'other_fee_charges_amounts') {
                    $fee_package->$key = $value;
                }
            }

            // $fee_package->academic_history_id = $academic_history_id['id'];
            $fee_package->academic_history_id = $input['academic_history_id'];
            $fee_package->discount_status = isset($input['discount_status_id']) ? config('constants.discount_statuses')[$input['discount_status_id']] : null;
            $fee_package->organization_campus_id = SystemSession::get('organization_campus_id');
            if (isset($input['fee_structure_type_id'])) {
                $fee_package->fee_structure_type = config('constants.fee_structure_types')[$input['fee_structure_type_id']];
            }
            $fee_package->update();

            // update other fee charges
            if (isset($request->other_fee_charges_amounts)) {
                // NOTE: Get the current unpaid installment
                $current_unpaid_installment = $fee_package->feePackageInstallments()->where('status_id', 0)->first();
                // NOTE: If there's a installment exists then add ammount to the current unpaid installment
                if (!empty($current_unpaid_installment)) {
                    $current_unpaid_installment->update([
                        'amount_per_installment' => $current_unpaid_installment->amount_per_installment + array_sum($request->other_fee_charges_amounts),
                    ]);
                }
                // NOTE: if no unpaid installment exists then create a new installment with respect to the current fee package and due date to the next month's current date
                else {
                    $installment = new FeePackageInstallment();
                    $installment->net_total = $input['net_tuition_fee'];
                    $installment->package_id = $fee_package->id;
                    $installment->status_id = 0;
                    $installment->student_id = $fee_package->student_id;
                    $installment->organization_campus_id = SystemSession::get('organization_campus_id');
                    $installment->status_name = config('constants.payment_statuses')[0];
                    $installment->due_date = Carbon::now()->addMonths(1)->format('Y-m-d');
                    $installment->academic_history_id = $fee_package->academic_history_id;
                    $installment->user_name = \Auth::user()->name;
                    $installment->user_id = \Auth::user()->id;
                    $installment->amount_per_installment = array_sum($request->other_fee_charges_amounts);
                    $installment->save();
                }
                // NOTE: Store in other_fee_charges_charges table
                foreach ($request->other_fee_charges_amounts as $key => $otherCharge) {
                    // add new entry
                    $fee_package->feeOtherCharges()->create([
                        'student_id' => $fee_package->student_id,
                        'amount' => $otherCharge,
                        'reason' => $input['other_fee_charges_reasons'][$key],
                        'fee_package_installment_id' => $current_unpaid_installment->id ?? $installment->id ?? null,
                        'fee_package_id' => $fee_package->id,
                    ]);
                }
            }
            // NOTE: Create fee structure plan
            if (isset($input['fee_structure_type_id']) && $input['fee_structure_type_id'] == 1) {
                if (isset($input['installment_count'])) {
                    $student_installment_plan = new StudentInstallmentPlan();
                    $student_installment_plan->student_id = $input['student_id'];
                    $student_installment_plan->fee_package_id = $fee_package->id;
                    $student_installment_plan->organization_campus_id = SystemSession::get('organization_campus_id');
                    $student_installment_plan->student_academic_history_id = $input['academic_history_id'];
                    $student_installment_plan->no_of_installments = $input['installment_count'];
                    $student_installment_plan->save();
                }
                // NOTE: if any new installment then create new installments
                if (isset($input['amount_per_installment'])) {
                    foreach ($input['amount_per_installment'] as $key => $amount_per_installment) {
                        $installment = new FeePackageInstallment();
                        $installment->net_total = $input['net_tuition_fee'];
                        $installment->amount_per_installment = $amount_per_installment;
                        $installment->package_id = $fee_package->id;
                        $installment->status_id = 0;
                        $installment->student_id = $input['student_id'];
                        $installment->organization_campus_id = SystemSession::get('organization_campus_id');
                        $installment->status_name = config('constants.payment_statuses')[0];
                        $installment->due_date = $input['installment_due_date'][$key];
                        $installment->academic_history_id = $fee_package->academic_history_id;
                        $installment->user_name = \Auth::user()->name;
                        $installment->user_id = \Auth::user()->id;
                        // $installment->voucher_code = $input['voucher_code'];
                        $installment->save();
                    }
                }
            }
            \DB::commit();
            Notify::success('Student accounts information updated successfully.', 'Success', $options = []);
            return redirect()->back();
        } catch (\Exception $e) {
            \DB::rollback();
            if ($e->getCode() != 0) {
                if (in_array(1062, $e->errorInfo)) {
                    $exception_message = str_replace('admissions_', '', $e->errorInfo[2]);
                    $replaced_message = str_replace('_unique', '', $exception_message);
                    $message = str_replace('key', '', $replaced_message);
                    Notify::error($message, 'Code 500', $options = []);
                    return redirect()->back();
                } else {
                    Notify::error('Something went wrong', 'Code 500', $options = []);
                    return redirect()->back();
                }
            } else {
                $exception_message = $e->getMessage();
                $exception_message_semi_col_split = explode(":", $exception_message);
                $message = 'Something went wrong at ' . '"' . str_replace(' ', '', str_replace('_', '-', $exception_message_semi_col_split[0])) . '"';
                Notify::error($message, 'Code 500', $options = []);
                return redirect()->back();
            }
        }
    }

    public function deleteOtherFeePackageCharges(FeePackageOtherCharge $otherFee)
    {
        $response = [];
        $fee_package = $otherFee->feePackage;
        // update fee package total price
        $fee_package->total_package = $fee_package->total_package - $otherFee->amount;
        $fee_package->update();
        // last unpaid installment - minus current amount (if exists)
        $current_unpaid_installment = $fee_package->feePackageInstallments()->where('status_id', 0)->first();
        if (!empty($current_unpaid_installment)) {
            $current_unpaid_installment->update([
                'amount_per_installment' => $current_unpaid_installment->amount_per_installment - $otherFee->amount,
            ]);
            // deleted_from_installment => fee pack id
            $otherFee->update(['deleted_from_installment_id' => $current_unpaid_installment->id]);
            // if installment generated from the other charges module then delete the instalment
            if ((int) $current_unpaid_installment->amount_per_installment <= 0) {
                $current_unpaid_installment->delete();
            }
            // delete from db
            $otherFee->delete();
            // return
            return response()->json(['success' => true, 'message' => 'Other Charges Removed Successfully!']);
        }
    }

    public function custom_installment(Request $request)
    {

        try {
            \DB::beginTransaction();
            $input = $request->all();

            $input = $request->all();
            $installment = new FeePackageInstallment();

            $installment->net_total = $input['net_total'];

            $installment->amount_per_installment = $input['amount_per_installment'];
            $installment->package_id = $input['package_id'];
            $installment->status_id = $input['status_id'];
            $installment->status_name = $input['status_name'];
            $installment->due_date = $input['due_date'];
            $feePackage = FeePackage::find($input['package_id']);
            $installment->academic_history_id = $feePackage->academic_history_id;
            $installment->user_name = \Auth::user()->name;
            $installment->user_id = \Auth::user()->id;
            // $installment->voucher_code = $input['voucher_code'];
            $installment->save();
            $feePackage->fee_structure_type_id = 1;
            $feePackage->fee_structure_type = config('constants.fee_structure_types')[1];
            $feePackage->update();
            \DB::commit();
            return redirect()->back();

        } catch (\Exception $e) {
            \DB::rollback();
        }
    }
    public function verifyPackages(Request $request)
    {

        try {
            \DB::beginTransaction();
            $students = Student::with('feePackages')->get();
            // dd($students->first()->feePackages);
            \DB::commit();
            return view('accounts.index_verification')->with(['students' => $students, 'render' => 'accounts.table_package_verify_plan']);

        } catch (\Exception $e) {
            \DB::rollback();
        }
    }
    public function updatePackageVerification(Request $request)
    {

        try {
            \DB::beginTransaction();
            $input = $request->all();
            $package = FeePackage::find($input['id']);
            $package->is_verified = true;
            $package->verified_by = \Auth::user()->name;
            $package->update();
            // dd($students->first()->feePackages);
            \DB::commit();
            return response()->json(['success' => true, 'message' => 'Package Verified Successfully.'], 200);

        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['success' => false, 'message' => 'Package Verification Failed.'], 500);
        }
    }

    public function verifyStudentAccount(Request $request)
    {
        try {
            \DB::beginTransaction();
            $input = $request->all();
            $packages = FeePackage::where('student_id', '=', $input['student_id'])->get();
            foreach ($packages as $key => $package) {
                $package->is_verified = true;
                $package->verified_by = \Auth::user()->name;

                $package_instalments = $package->feePackageInstallments()->get();
                if ($package_instalments != null && count($package_instalments) > 0) {
                    foreach ($package_instalments as $key => $instalment) {
                        $instalment->is_verified = true;
                        $instalment->verified_by = \Auth::user()->name;
                        $instalment->update();
                    }
                }
                $package->update();
            }
            $student_heads = HeadFineStudent::where('student_id', '=', $input['student_id'])->get();
            foreach ($student_heads as $key => $head) {
                $head->is_verified = true;
                $head->verified_by = \Auth::user()->name;
                $head->update();
            }
            \DB::commit();
            return redirect()->back();

        } catch (\Exception $e) {
            dd($e);
            \DB::rollback();
            return redirect()->back();
        }
    }

    public function voucherLists()
    {
        $students = Student::with('feePackages', 'feePackages.feePackageInstallments')->get();
        return view('accounts.index_voucher_list')->with(['students' => $students]);
    }

    public function headsVoucherLists()
    {
        $students = Student::with('headFineStudents')->get();
        return view('accounts.index_head_voucher_list')->with(['students' => $students]);
    }

    public function verifyPayments(Request $request)
    {
        $input = $request->all();
        if ($input['payment_type'] == 'instalment') {
            $instalment = FeePackageInstallment::find($input['instalment_id']);
            $instalment->payment_verification = true;
            $instalment->payment_verified_by = \Auth::user()->name;
            $instalment->update();
        }
        if ($input['payment_type'] == 'heads') {
            $head_fine_student = HeadFineStudent::find($input['head_student_id']);
            $head_fine_student->payment_verification = true;
            $head_fine_student->payment_verified_by = \Auth::user()->name;
            $head_fine_student->update();
        }
        return redirect()->back();
    }

    public function verifyInstalments(Request $request)
    {

        try {
            \DB::beginTransaction();
            $students = Student::with('feePackages', 'feePackages.feePackageInstallments')->get();
            // dd($students->first()->feePackages);
            \DB::commit();
            return view('accounts.index_verification')->with(['students' => $students, 'render' => 'accounts.table_instalment_verify_plan']);

        } catch (\Exception $e) {
            \DB::rollback();
        }
    }
    public function updateInstalmentVerification(Request $request)
    {
        try {
            \DB::beginTransaction();
            $input = $request->all();
            $package = FeePackageInstallment::find($input['id']);
            $package->is_verified = true;
            $package->verified_by = \Auth::user()->name;
            $package->update();
            // dd($students->first()->feePackages);
            \DB::commit();
            return response()->json(['success' => true, 'message' => 'Instalment Verified Successfully.'], 200);

        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['success' => false, 'message' => 'Instalment Verification Failed.'], 500);
        }
    }
    public function varifyStudentHeads(Request $request)
    {
        try {
            \DB::beginTransaction();
            $students = Student::with('headFineStudents')->get();
            // dd($students->first()->feePackages);
            \DB::commit();
            return view('accounts.index_varification')->with(['students' => $students]);

        } catch (\Exception $e) {
            \DB::rollback();
        }
    }
    public function deletePackage(Request $request)
    {
        try {
            \DB::beginTransaction();
            $input = $request->all();
            $package = FeePackage::find($input['package_id']);
            $package->delete();
            // dd($students->first()->feePackages);
            \DB::commit();
            return redirect()->back();

        } catch (\Exception $e) {
            dd($e);
            \DB::rollback();
        }
    }

    public function deleteInstalment(Request $request)
    {
        try {
            \DB::beginTransaction();
            $input = $request->all();
            $packageInstalment = FeePackageInstallment::find($input['instalment_id']);
            // if other charges exists
            if (count($packageInstalment->feeOtherCharges) > 0) {
                $packageInstalment->feePackage->update([
                    'total_package' => $packageInstalment->feePackage->total_package - $packageInstalment->feeOtherCharges->sum('amount'),
                ]);
                $packageInstalment->feeOtherCharges()->delete();
            }

            $packageInstalment->delete();
            \DB::commit();
            Notify::success('Installment deleted successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            Notify::error('Something went wrong', 'Cod 500');
            return redirect()->back();
            \DB::rollback();
        }
    }

/** @NOTE: OLD VERSION */
    public function installment_paid(Request $request)
    {
        try {
            \DB::beginTransaction();
            $input = $request->all();

            $student = Student::find($input['student_id']);
            $date = date("d/m/Y");

            $installment = FeePackageInstallment::find($input['instalment_id']);
            $this->createInstallmentFine($input['instalment_id'], $input['lateFine']);

            $installment->is_carry_forward = $input['is_carry_forward'];
            if ($installment->status_id == 0) {

                $installment->voucher_code = $input['voucher_code'];

                $voucher = new FeeVoucher();
                $voucher->voucher_code = $input['voucher_code'];
                $voucher->installment_id = $installment->id;
                $voucher->save();
                $installment->voucher_id = $voucher->id;
            }

            $totalAmount = (int) $input['total_amount'];
            $amountPaid = (int) $input['amount_paid'];

            if ($installment->status_id == "2") {
                // dd($input);

                $amount_after_remain_paid = (int) $installment->remaining_balance - (int) $input['amount_paid'];
                if ($amount_after_remain_paid > 0) {
                    $installment->amount_per_installment = (int) $installment->amount_per_installment - $amount_after_remain_paid;
                    $installment->amount_with_fine = (int) $installment->amount_with_fine - $amount_after_remain_paid;
                    $installment->remaining_balance = $input['amount_paid'];
                }
                $fine = (int) $input['lateFine'];
                $fine2 = (int) $installment->late_fee_fine;
                $paid = (int) $installment->amount_per_installment;
                $remaining = (int) $installment->remaining_balance;
                $total = $remaining + $fine;

                $installment->remaining_balance_late_fine = $input['lateFine'];
                $installment->remaining_balance_paid_date = $input['paid_date'];
                $installment->remaining_balance_paid_amount = $input['amount_paid'];

                $installment->remaining_balance_voucher_id = $input['voucher_code'];
                $installment->r_b_late_fee_fine_voucher_code = $input['late_fee_fine_voucher_code'];
                $installment->remaining_balance_fine_waived = $input['fine_waived'];
                $installment->total_remaining_balance = $total;
                $installment->total_amount_collected = ($paid + $fine + $fine2);
                $installment->payment_verification = false;

            } else {
                $installment->paid_date = $input['paid_date'];
                $installment->late_fee_fine = $input['lateFine'];
                $installment->amount_with_fine = $input['amount_per_installment'] + $input['lateFine'];
                $installment->late_fee_fine_voucher_code = $input['late_fee_fine_voucher_code'];
                $installment->fine_waived = $input['fine_waived'];
                $installment->paid_amount = $input['amount_paid'];
                $installment->payment_verification = false;

            }
            if ($input['late_fee_fine_voucher_code'] != null && $input['late_fee_fine_voucher_code'] != '') {
                $difference = $totalAmount - $amountPaid;
            } else {
                if ($installment->status_id == 2) {
                    $difference = $installment->remaining_balance - $amountPaid;
                } else {
                    $difference = $installment->amount_per_installment - $amountPaid;
                }
            }

            if ($difference <= 0) {
                $installment->status_id = $input['status_id'];
                $installment->status_name = $input['status_name'];

            } else {

                $installment->status_id = "2";
                $installment->status_name = config('constants.payment_statuses')[2];
                $installment->remaining_balance = $difference;
            }

            //     dd($installment->status_id);
            $remaining_amount = 0;
            if ($input['late_fee_fine_voucher_code'] != null && $input['late_fee_fine_voucher_code'] != '') {
                $remaining_amount = (int) $input['amount_paid'] - (int) $installment->amount_with_fine;
            } else {
                if ($installment->status_id == 2) {
                    $remaining_amount = (int) $input['amount_paid'] - (int) $installment->amount_with_fine;
                } else {
                    $remaining_amount = (int) $input['amount_paid'] - (int) $installment->amount_with_fine;
                }
            }
            $other_instalments = $student->feePackages()->get()->last()->feePackageInstallments()->get();
            if ($installment->is_carry_forward == "true") {
                foreach ($other_instalments as $key => $instalment) {
                    if ($remaining_amount > 0) {
                        if ($instalment->status_id == 0 && $instalment->id != $input['instalment_id']) {
                            $instalment->carry_forward = $remaining_amount;
                            $instalment->paid_date = $input['paid_date'];
                            $lateFine = 0;
                            $paid_date = date_create($input['paid_date']);
                            $due_date_obj = date_create($instalment->due_date);
                            if ($paid_date > $due_date_obj && $instalment->amount_per_installment > 1000) {
                                $diff = date_diff($due_date_obj, $paid_date);
                                $diff = $diff->days + $diff->invert;
                                // dd($diff);
                                $lateFine = ($diff * 25);
                            }

                            $instalment->late_fee_fine = $lateFine;
                            $instalment->amount_with_fine = ((int) $instalment->amount_per_installment + (int) $lateFine);
                            $instalment->paid_amount = $remaining_amount;
                            if ($input['late_fee_fine_voucher_code'] != null && $instalment->paid_amount >= $instalment->amount_with_fine) {
                                if ($installment->status_id == "2") {
                                    // dd($input);
                                    $fine = (int) $input['lateFine'];
                                    $fine2 = (int) $installment->late_fee_fine;
                                    $paid = (int) $installment->amount_per_installment;
                                    $remaining = (int) $installment->remaining_balance;
                                    $total = $remaining + $fine;
                                    $installment->remaining_balance_late_fine = $input['lateFine'];
                                    $installment->remaining_balance_paid_date = $input['paid_date'];
                                    $installment->remaining_balance_paid_amount = $remaining_amount;
                                    $instalment->status_id = "1";
                                    $instalment->status_name = config('constants.payment_statuses')[1];
                                    $installment->remaining_balance_voucher_id = $input['voucher_code'];
                                    $installment->r_b_late_fee_fine_voucher_code = $input['late_fee_fine_voucher_code'];
                                    $installment->remaining_balance_fine_waived = $input['fine_waived'];
                                    $installment->total_remaining_balance = $total;
                                    $installment->total_amount_collected = ($paid + $fine + $fine2);
                                    $remaining_amount = (int) $remaining_amount - (int) $total;
                                    $installment->payment_verification = false;

                                } else {
                                    $instalment->status_id = "1";
                                    $instalment->status_name = config('constants.payment_statuses')[1];
                                    $instalment->paid_date = $input['paid_date'];
                                    $instalment->late_fee_fine = $input['lateFine'];
                                    $instalment->amount_with_fine = $input['amount_per_installment'] + $input['lateFine'];
                                    $instalment->late_fee_fine_voucher_code = $input['late_fee_fine_voucher_code'];
                                    $instalment->fine_waived = $input['fine_waived'];
                                    $instalment->paid_amount = $remaining_amount;
                                    $instalment->payment_verification = false;
                                    $remaining_amount = (int) $remaining_amount - (int) $instalment->amount_with_fine;
                                    $instalment->voucher_code = $input['voucher_code'];
                                    $instalment->voucher_id = $installment->voucher_code;
                                }

                            } else if ($input['late_fee_fine_voucher_code'] == null && $instalment->paid_amount >= $instalment->amount_per_installment) {
                                if ($installment->status_id == "2") {
                                    // dd($input);
                                    $fine = (int) $input['lateFine'];
                                    $fine2 = (int) $installment->late_fee_fine;
                                    $paid = (int) $installment->amount_per_installment;
                                    $remaining = (int) $installment->remaining_balance;
                                    $total = $remaining + $fine;
                                    $installment->remaining_balance_late_fine = $input['lateFine'];
                                    $installment->remaining_balance_paid_date = $input['paid_date'];
                                    $installment->remaining_balance_paid_amount = $remaining_amount;
                                    $instalment->status_id = "1";
                                    $instalment->status_name = config('constants.payment_statuses')[1];
                                    $installment->remaining_balance_voucher_id = $input['voucher_code'];
                                    $installment->r_b_late_fee_fine_voucher_code = $input['late_fee_fine_voucher_code'];
                                    $installment->remaining_balance_fine_waived = $input['fine_waived'];
                                    $installment->total_remaining_balance = $total;
                                    $installment->total_amount_collected = ($paid + $fine + $fine2);
                                    $remaining_amount = (int) $remaining_amount - (int) $remaining;
                                    $installment->payment_verification = false;

                                } else {
                                    $instalment->paid_date = $input['paid_date'];
                                    $instalment->late_fee_fine = $input['lateFine'];
                                    $instalment->amount_with_fine = $input['amount_per_installment'] + $input['lateFine'];
                                    $instalment->late_fee_fine_voucher_code = $input['late_fee_fine_voucher_code'];
                                    $instalment->fine_waived = $input['fine_waived'];
                                    $instalment->paid_amount = $remaining_amount;
                                    $instalment->payment_verification = false;
                                    $instalment->status_id = "1";
                                    $instalment->status_name = config('constants.payment_statuses')[1];
                                    $remaining_amount = (int) $remaining_amount - (int) $instalment->amount_per_installment;
                                    $instalment->voucher_code = $input['voucher_code'];
                                    $instalment->voucher_id = $installment->voucher_code;
                                }

                            } else {
                                $instalment->status_id = "2";
                                $instalment->status_name = config('constants.payment_statuses')[2];
                                $instalment->remaining_balance = ((int) $instalment->amount_with_fine - (int) $remaining_amount);
                                $remaining_amount = 0;
                            }

                            $instalment->update();
                            // dd($installment2);
                        }
                    }
                }
            }

            $installment->update();
            \DB::commit();
            return redirect()->back();

        } catch (\Exception $e) {
            dd($e);
            \DB::rollback();
        }

    }

/**
 * installment payment from accounts module
 * @param Request               $request    Form Object
 * @param FeePackageInstallment $instalment Current Installment
 */
    public function InstallmentPayment(Request $request, FeePackageInstallment $instalment)
    {
        try {
            \DB::beginTransaction();
            // update
            $instalment->paid_amount = $request->amount_paid;
            $instalment->paid_date = $request->paid_date;
            $instalment->voucher_code = $request->voucher_code;
            $instalment->status_id = 1;
            $instalment->status_name = config('constants.payment_statuses')[$instalment->status_id];
            $instalment->payment_verification = false;
            $instalment->update();
            \DB::commit();
            Notify::success('Student Installment Paid Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            \DB::rollback();
            if ($e->getCode() != 0) {
                if (in_array(1062, $e->errorInfo)) {
                    $exception_message = str_replace('admissions_', '', $e->errorInfo[2]);
                    $replaced_message = str_replace('_unique', '', $exception_message);
                    $message = str_replace('key', '', $replaced_message);
                    return response()->json(['success' => false, 'error' => $message], 500);
                } else {
                    return response()->json(['success' => false, 'error' => 'Something went wrong.'], 500);
                }
            } else {
                $exception_message = $e->getMessage();
                $exception_message_semi_col_split = explode(":", $exception_message);
                $message = 'Something went wrong at ' . '"' . str_replace(' ', '', str_replace('_', '-', $exception_message_semi_col_split[1])) . '"';
                return response()->json(['success' => false, 'error' => $message], 500);
            }

        }

    }

    public function createInstallmentFine($installment_id, $due_date)
    {
        $fee_fine = new FeeFine();
        $fee_fine->amount = $due_date;
        $fee_fine->installment_id = $installment_id;
        $fee_fine->save();
    }

    public function payInstalmentFine(Request $request)
    {
        $input = $request->all();
        $instalment = FeePackageInstallment::find($input['instalment_id']);
        if (isset($input['late_fee_fine_voucher_code'])) {
            $instalment->late_fee_fine_voucher_code = $input['late_fee_fine_voucher_code'];
        }
        if (isset($input['r_b_late_fee_fine_voucher_code'])) {
            $instalment->r_b_late_fee_fine_voucher_code = $input['r_b_late_fee_fine_voucher_code'];
        }
        if (isset($input['remaining_balance_fine_paid_date'])) {
            $instalment->remaining_balance_fine_paid_date = $input['remaining_balance_fine_paid_date'];
        }
        if (isset($input['fine_paid_date'])) {
            $instalment->fine_paid_date = $input['fine_paid_date'];
        }
        if (isset($input['remaining_balance_fine_waived'])) {
            $instalment->remaining_balance_fine_waived = $input['remaining_balance_fine_waived'];
        }
        if (isset($input['fine_waived'])) {
            $instalment->fine_waived = $input['fine_waived'];
        }
        $instalment->update();
        return redirect()->back();
    }

    public function package_paid(Request $request)
    {

        try {
            \DB::beginTransaction();
            $input = $request->all();
            // dd($input);
            $date = date("d/m/Y");
            $fee = FeePackage::find($input['fee_id']);
            $fee->status_id = $input['status_id'];
            $fee->status_name = $input['status_name'];
            if (array_key_exists("voucher_code", $input)) {

                $fee->paid_date = $input['paid_date'];
                $fee->voucher_code = $input['voucher_code'];
                $fee->update();
                $voucher = FeeVoucher::where('package_id', '=', $input['fee_id'])->first();
                $voucher->voucher_code = $input['voucher_code'];
                $voucher->package_id = $fee->id;

                $voucher->update();
            } else {

                $fee->paid_date = $date;
                $fee->update();
            }

            \DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            \DB::rollback();
        }
    }

    public function getAttenanceDetails($student_id, $academic_history_id, $start_month = null, $end_month = null)
    {
        if ($start_month) {
            $fines = AttendanceFine::where('student_id', '=', $student_id)->where('academic_history_id', '=', $academic_history_id)->where('previous_reference', '=', null)->where('due_date', '>=', $start_month)->get();
        } else if (is_null($start_month)) {
            $fines = AttendanceFine::where('student_id', '=', $student_id)->where('academic_history_id', '=', $academic_history_id)->where('previous_reference', '=', null)->get();
        } else if ($start_month && $end_month) {
            $fines = AttendanceFine::where('student_id', '=', $student_id)->where('academic_history_id', '=', $academic_history_id)->where('previous_reference', '=', null)->where('due_date', '>=', $start_month)->where('due_date', '>=', $end_month)->get();
        }
        $attenance_fines = [];
        foreach ($fines as $key => $fine) {
            $data = [];
            $fine_nodes = array($fine);
            $next_reference = $fine->next_reference;
            while ($next_reference != null) {
                $referenced_data = AttendanceFine::where('id', '=', $next_reference)->get()->first();
                if ($referenced_data != null) {
                    $next_reference = $referenced_data->next_reference;
                    array_push($fine_nodes, $referenced_data);
                } else {
                    $next_reference = $referenced_data;
                }
            }
            $from = new DateTime($fine->from_date);
            $to = new DateTime($fine->to_date);
            if ($from == $to) {
                $data['month_of'] = $from->format('M Y');
            } else {
                $data['month_of'] = $from->format('M Y') . ' - ' . $to->format('M Y');
            }

            $data['node_count'] = count($fine_nodes);
            $data['fine_nodes'] = $fine_nodes;
            array_push($attenance_fines, $data);
        }
        return $attenance_fines;
    }

    public function getExamFineDetails($date_sheet_id, $student_id)
    {
        $fines = ExamFine::where('date_sheet_id', '=', $date_sheet_id)->where('student_id', '=', $student_id)->where('previous_reference', '=', null)->get();
        $exam_fines = [];
        foreach ($fines as $key => $fine) {
            $data = [];
            $fine_nodes = array($fine->toArray());
            $next_reference = $fine->next_reference;
            while ($next_reference != null) {
                $referenced_data = ExamFine::where('id', '=', $next_reference)->get()->first();
                if ($referenced_data != null) {
                    $next_reference = $referenced_data->next_reference;
                    array_push($fine_nodes, $referenced_data->toArray());
                } else {
                    $next_reference = $referenced_data;
                }
            }
            $data['node_count'] = count($fine_nodes);
            $data['fine_nodes'] = $fine_nodes;
            array_push($exam_fines, $data);
        }
        return $exam_fines;
    }

    public function studentSummary($id, $academic_history_id, $year_count)
    {
        $heads_to_show = ['2' => 'Publications', '3' => 'Uniform', '4' => 'Student Card', '15' => 'Prospectus', '6' => 'Transportation', '7' => 'Test Session', '1' => 'Affiliated Body Registration', '1' => 'Affiliated Body Examination', '20' => 'Absent Fine', '30' => 'Exam Fail fine', '40' => 'Discipline Voilation Fine', '50' => 'UMC'];
        $student = Student::with('studentAcademicHistories', 'feePackages', 'feePackages.feePackageInstallments', 'headFineStudents', 'dateSheetStudents')->find($id);
        // $student->dateSheetStudents->groupBy('date_sheet_name');
        // dd($student->dateSheetStudents->where('status_id', '=', '1')->groupBy('date_sheet_name'));
        // $student->absent_days = Attendance::where('student_id', '=', $student->id)->where('status_id', '=', 0)->where('date', '>=', $student->admission_date)->orderBy('date', 'asc')->get()->groupBy(function ($db_row) {
        //     $date = new \DateTime($db_row->date);
        //     return $date->format('M Y');
        // })->toArray();
        // $total_absent_days_fine = 0;
        // $total_absent_days = 0;
        // foreach ($student->absent_days as $key => $array) {
        //     $total_absent_days = $total_absent_days + count($array);
        //     $total_absent_days_fine = $total_absent_days_fine + (count($array) * 200);
        // }

        $attendance_fines = $this->getAttenanceDetails($student->id, $academic_history_id);
        $total_absent_days = 0;
        $total_absent_days_fine = 0;
        $total_absent_fine_remaining = 0;
        foreach ($attendance_fines as $key => $fine) {
            foreach ($fine['fine_nodes'] as $key => $node) {
                if ($key == 0) {
                    $total_absent_days_fine = $total_absent_days_fine + $node->amount;
                    $total_absent_fine_remaining = $node->paid_date == null ? ($total_absent_fine_remaining + $node->amount) : 0;
                } else {
                    $total_absent_fine_remaining = $node->paid_date == null ? ($total_absent_fine_remaining + $node->amount) : 0;
                }
                $total_absent_days = $total_absent_days + $node->absent_count;
            }
        }
        // dd($attendance_fines->toArray());
        $student->attendance_fines = $attendance_fines;
        $total_exam_fail_fine = 0;
        $total_subject_fail = 0;

        $exam_fine_array = [];
        $total_subject_fail = $student->dateSheetStudents->where('academic_history_id', '=', $academic_history_id)->where('status_id', '=', '1')->count();
        foreach ($student->dateSheetStudents->where('academic_history_id', '=', $academic_history_id)->where('status_id', '=', '1')->groupBy('date_sheet_id') as $key => $array) {
            $date_sheet = DateSheet::find($key);
            if (!empty($date_sheet)) {
                $failure_subjects = DateSheetStudent::where('date_sheet_id', '=', $date_sheet->id)->where('student_id', '=', $student->id)->where('status_id', '=', '1')->get(['id', 'subject_id', 'status_id', 'date_sheet_id', 'student_id']);
                $failure_fine_details = $this->getExamFineDetails($date_sheet->id, $student->id) /*ExamFine::where('date_sheet_id', '=', $date_sheet->id)->where('student_id', '=', $student->id)->get()*/;
                $date_sheet = $date_sheet->toArray();
                $date_sheet['failure_subjects'] = $failure_subjects->toArray();
                $date_sheet['failure_fine_details'] = $failure_fine_details;

                array_push($exam_fine_array, $date_sheet);
                // dd($failure_fi   ne_details);
                foreach ($failure_fine_details as $key => $detail) {
                    foreach ($detail['fine_nodes'] as $key => $node) {
                        if ($key == 0) {
                            $total_exam_fail_fine = $node['paid_date'] == null ? ($total_exam_fail_fine + $node['amount']) : ($total_exam_fail_fine + $node['balance']);
                        } else {
                            $total_exam_fail_fine = $total_exam_fail_fine + $node['balance'];
                        }
                    }
                }
            }
        }
        $student->exam_fines = $exam_fine_array;

        if ($student->profile_pic != null && $student->profile_pic != '') {
            $student->picture_pic_directory_url = asset(config('constants.attachment_path.student_qr_destination_path') . $student->roll_no . '/Profile_Pictures/' . $student->profile_pic);
        } else {
            $student->picture_pic_directory_url = asset('assets/images/users/dummy.png');
        }
        // $student_academic_histories = StudentAcademicHistory::where('student_id', '=', $student->id)->get();
        // $student->student_academic_histories = $student_academic_histories;
        $clearance_date = new \DateTime();
        $clearance_date = $clearance_date->format('l, d-M-Y');
        $outstanding_clearance_section = $student->studentAcademicHistories()->where('id', '=', $academic_history_id)->get()->last();
        $fee_package = $student->feePackages()->where('academic_history_id', '=', $outstanding_clearance_section->id)->get();
        $total_tution_fee = 0;
        $tution_fee_received = 0;
        $total_fine_on_instalment = 0;
        $total_fine_adjustment_on_instalment = 0;
        $actual_fine_receivable = 0;
        $instalments = [];
        $over_due_till_today = 0;
        $over_due_heads_till_today = 0;
        if (!$fee_package->isEmpty()) {
            $fee_package = $fee_package->last();
            $total_tution_fee = $fee_package->net_total;
            if ($fee_package->fee_structure_type_id == 0) {

                if ($fee_package->status_id == 0) {
                    $tution_fee_received = 0;
                } else {
                    $tution_fee_received = $total_tution_fee;
                }
            } else {
                $instalments = $fee_package->feePackageInstallments()->get();
                $tution_fee_received = 0;
                foreach ($instalments as $key => $instalment) {
                    $due_date = new \DateTime($instalment->due_date);
                    $paid_date = new \DateTime($instalment->paid_date);
                    $remaining_paid_date = new \DateTime($instalment->remaining_balance_paid_date);
                    $diff = 0;
                    $current_date = new \DateTime();

                    if ($instalment->status_id == 2) {
                        if ($due_date <= $current_date) {
                            $over_due_till_today = $over_due_till_today + $instalment->remaining_balance;
                        }
                    } else if ($instalment->status_id == 0) {

                        if ($due_date <= $current_date) {
                            $over_due_till_today = $over_due_till_today + $instalment->amount_per_installment;
                        }
                    }

                    if ($instalment->status_id == 2) {
                        $tution_fee_received = $tution_fee_received + ($instalment->amount_per_installment - $instalment->remaining_balance);
                    } else if ($instalment->status_id == 1) {
                        $tution_fee_received = $tution_fee_received + $instalment->amount_per_installment;
                    }

                    if ($instalment->feeFines()->get()->count() > 0) {
                        foreach ($instalment->feeFines()->get() as $key => $fine) {
                            $diff = date_diff($due_date, $paid_date != null ? $paid_date : $current_date);
                            $diff = $diff->days + $diff->invert;
                            // dd($diff);
                            // $lateFine = ($diff);
                            $instalment->late_fine_days_for = $diff;
                            // $instalment->late_fee_fine = $fine->amount;
                            $total_fine_adjustment_on_instalment = $total_fine_adjustment_on_instalment + ($fine->paid_date != null ? ($fine->amount_waived) : 0);
                            $total_fine_on_instalment = $total_fine_on_instalment + ($fine->paid_date == null ? $fine->amount : 0);
                        }

                    } else {

                        if ($instalment->status_id == 0) {
                            if (!isset($instalment->late_fee_fine)) {

                                if ($instalment->amount_per_installment > 1000 && $current_date > $due_date) {
                                    $late_fee_fine = $this->calculateFine($instalment->due_date);
                                    $diff = date_diff($due_date, $current_date);
                                    $diff = $diff->days + $diff->invert;
                                    // dd($diff);
                                    $lateFine = ($diff);
                                    $instalment->late_fine_days_for = $diff;
                                    $instalment->late_fee_fine = $late_fee_fine;
                                } else {
                                    $instalment->late_fine_days_for = 0;
                                }

                                $total_fine_on_instalment = ($total_fine_on_instalment + ($instalment->fine_paid_date == null ? $instalment->late_fee_fine : 0));
                            }
                        } else if ($instalment->status_id == 1) {

                            $total_fine_on_instalment = ($total_fine_on_instalment + ($instalment->fine_paid_date == null ? $instalment->late_fee_fine : 0) + ($instalment->remaining_balance_late_fine != null ? ($instalment->remaining_balance_fine_paid_date == null ? $instalment->remaining_balance_late_fine : 0) : 0));
                            $total_fine_adjustment_on_instalment = ($total_fine_adjustment_on_instalment + $instalment->fine_waived + ($instalment->remaining_balance_fine_waived != null ? $instalment->remaining_balance_fine_waived : 0));

                        }
                    }
                }

            }
        }

        // dd($instalments->toArray());
        // dd($total_fine_adjustment_on_instalment  );
        $studentHeads = $student->headFineStudents()->where('academic_history_id', '=', $outstanding_clearance_section->id)->get();
        foreach ($studentHeads as $key => $head) {
            if ($head->status_id == 0) {
                $due_date = new \DateTime($head->due_date);
                $current_date = new \DateTime();
                // if ($due_date <= $current_date) {
                $over_due_heads_till_today = $over_due_heads_till_today + ($head->head_amount != '' ? $head->head_amount : (!$head->headFine()->get()->isEmpty() ? $head->headFine()->get()->first()->amount : 0));
                // }
            }
            if ($head->status_id == 2) {
                $due_date = new \DateTime($head->due_date);
                $current_date = new \DateTime();
                // if ($due_date <= $current_date) {
                $over_due_heads_till_today = $over_due_heads_till_today + ($head->remaining_balance);
                // }
            }
        }
        $outstanding_clearance_section->outstanding_balance = 0;
        $outstanding_clearance_section->over_due_till_today = $over_due_till_today;
        $outstanding_clearance_section->current_tution_fee = $total_tution_fee;
        $outstanding_clearance_section->over_due_heads_till_today = $over_due_heads_till_today;
        $outstanding_clearance_section->tution_fee_received = $tution_fee_received;
        $outstanding_clearance_section->total_fine_on_instalment = $total_fine_on_instalment;
        $outstanding_clearance_section->total_fine_adjustment_on_instalment = $total_fine_adjustment_on_instalment;
        $outstanding_clearance_section->total_absent_days = $total_absent_days;
        $outstanding_clearance_section->total_absent_days_fine = $total_absent_days_fine;
        $outstanding_clearance_section->total_absent_fine_remaining = $total_absent_fine_remaining;
        $outstanding_clearance_section->total_exam_fail_fine = $total_exam_fail_fine;
        $outstanding_clearance_section->total_subject_fail = $total_subject_fail;

        $student_package = ['student' => $student];

        // $html = \View::make('accounts.detail_summary', $student_package)->render();
        // $pdf = \PDF::loadHTML($html);
        // return $pdf->stream();
        return view('accounts.index_summary')->with(['student' => $student, 'fee_package' => $fee_package, 'outstanding_clearance_section' => $outstanding_clearance_section, 'student_heads' => $studentHeads, 'instalments' => $instalments, 'clearance_date' => $clearance_date, 'heads_to_show' => $heads_to_show, 'year_count' => $year_count]);
    }

    public function fine_paid(Request $request)
    {
        try {
            \DB::beginTransaction();

            $input = $request->all();
            //  dd($input);

            $date = date("d/m/Y");
            //dd($date);

            $fine = Fine::find($input['id']);

            $fine->status_name = $input['status_name'];
            $fine->status_id = $input['status_id'];
            $fine->voucher_code = $input['voucher_code'];
            $fine->paid_date = $input['paid_date'];

            $voucher = new FeeVoucher();
            $voucher->voucher_code = $input['voucher_code'];
            $voucher->fine_id = $fine->id;
            $voucher->save();

            $fine->update();

            \DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            \DB::rollback();
        }

    }

    public function head_paid(Request $request, $id)
    {
        try {
            \DB::beginTransaction();

            $input = $request->all();
            // dd(config('voucher_status')[0]);

            $date = date("d-m-Y");
            //dd($date);

            $headFine = HeadFineStudent::find($id);

            $headFine->voucher_code = $input['voucher_code'];

            $headFine->paid_date = $input['paid_date'];
            $headFine->is_carry_forward = $input['is_carry_forward'];
            if ($headFine->status_id == 0) {
                $voucher = FeeVoucher::where('head_fine_student_id', '=', $id)->first();

                $voucher->voucher_code = $input['voucher_code'];
                //dd($input['id']);
                $voucher->update();

            }

            $totalAmount = (int) $input['total_amount'];
            $amountPaid = (int) $input['amount_paid'];

            $difference = $totalAmount - $amountPaid;

            if ($headFine->status_id == 2) {
                // dd($input);
                $fine = (int) $input['lateFine'];
                $fine2 = (int) $headFine->late_fee_fine;
                if ($headFine->amount_after_discount == null || $headFine->amount_after_discount == '') {
                    $paid = (int) (!$headFine->headFine()->get()->isEmpty() ? $headFine->headFine()->get()->first()->amount : 0);
                } else {
                    $paid = (int) $headFine->amount_after_discount;

                }
                $remaining = (int) $headFine->remaining_balance;
                $total = $remaining + $fine;
                $headFine->remaining_balance_late_fine = $input['lateFine'];
                $headFine->remaining_balance_paid_date = $input['paid_date'];
                $headFine->status_id = $input['status_id'];
                $headFine->status_name = $input['status_name'];
                $headFine->remaining_balance_voucher_id = $input['voucher_code'];
                $headFine->total_remaining_balance = $total;
                $headFine->total_amount_collected = ($paid + $fine + $fine2);

            } else {
                // dd('here in else of status 2');
                $headFine->paid_date = $input['paid_date'];
                $headFine->late_fee_fine = $input['lateFine'];
                $headFine->amount_with_fine = $input['total_amount'];
                $headFine->paid_amount = $input['amount_paid'];

            }
            if ($difference <= 0) {
                $headFine->status_id = $input['status_id'];
                $headFine->status_name = $input['status_name'];

            } else {

                $headFine->status_id = "2";
                $headFine->status_name = config('constants.payment_statuses')[2];
                $headFine->remaining_balance = $difference;
            }

            //     dd($headFine->status_id);
            $headFine->update();
// for change
            if ($headFine->is_carry_forward == "true") {
                $headFine2 = HeadFineStudent::find($id + 1);
                if ($headFine2 != null) {
                    $headFine2->carry_forward = $input['carry_forward'];
                    $headFine2->paid_date = $input['paid_date'];
                    $lateFine = 0;
                    $paid_date = date_create($input['paid_date']);
                    $due_date_obj = date_create($headFine2->due_date);
                    $headFine2->late_fee_fine = $lateFine;
                    if ($headFine2->amount_after_discount == null || $headFine2->amount_after_discount == '') {
                        $amount = (int) (!$headFin2->headFine()->get()->isEmpty() ? $headFin2->headFine()->get()->first()->amount : 0);
                        $headFine2->amount_with_fine = ((int) $amount + (int) $lateFine);
                    } else {
                        $headFine2->amount_with_fine = ((int) $headFine2->amount_after_discount + (int) $lateFine);
                    }
                    $headFine2->paid_amount = $input['carry_forward'];
                    if ($headFine2->amount_after_discount == null || $headFine2->amount_after_discount == '') {
                        $amount = (int) (!$headFine2->headFine()->get()->isEmpty() ? $headFine2->headFine()->get()->first()->amount : 0);

                        if ($headFine2->paid_amount >= $amount) {
                            $headFine2->status_id = "1";
                            $headFine2->status_name = config('constants.payment_statuses')[1];
                        } else {
                            $headFine2->status_id = "2";
                            $headFine2->status_name = config('constants.payment_statuses')[2];
                            $headFine2->remaining_balance = ((int) $amount - (int) $input['carry_forward']);
                        }

                    } else {

                        if ($headFine2->paid_amount >= $headFine2->amount_after_discount) {
                            $headFine2->status_id = "1";
                            $headFine2->status_name = config('constants.payment_statuses')[1];
                        } else {
                            $headFine2->status_id = "2";
                            $headFine2->status_name = config('constants.payment_statuses')[2];
                            $headFine2->remaining_balance = ((int) $headFine2->amount_after_discount - (int) $input['carry_forward']);
                        }
                    }
                    $headFine2->update();
                    // dd($installment2);

                }
            }

            \DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            dd($e);
            \DB::rollback();
        }
    }

    public function invoice(Request $request)
    {

        $input = $request->all();

        $currentDate = date("d-m-Y");
        $currentDate = date_create($currentDate);
        // dd($input);
        $installment = FeePackageInstallment::find($input['installment_id']);

        $dueDate = $installment['due_date'];

        $dueDate = str_replace("/", "-", $dueDate);
        $dueDate = date_create($dueDate);

        $newDate = date_format($dueDate, "d/m/Y");

        $diff = date_diff($dueDate, $currentDate);

        $diff = (int) $diff->format("%R%a");

        if ($diff < 0) {

            $diff = 0;
        }

        $student = Student::find($input['student_id']);
        $count = $input['count'];
        $fine = Fine::where('student_id', '=', $input['student_id'])->get()->toArray();

        $headFineStudents = HeadFineStudent::where('student_id', '=', $input['student_id'])->get();

        // $headFineStudents[0]->headFine()->get()->toArray();

        return view('accounts.invoice')->with('installment', $installment)->with('student', $student)->with('count', $count)->with('fine', $fine)->with('diff', $diff)->with('headFineStudents', $headFineStudents);

    }

    public function addFines(Request $request)
    {
        try {
            \DB::beginTransaction();

            $input = $request->all();

            $fine = new Fine();

            $voucher = FeeVoucher::get();
            $newVoucher = new FeeVoucher;
            $number = sizeof($voucher);
            $voucher_code = sprintf('%07d', intval($number) + 1);

            $fine->name = $input['name'];
            $fine->amount = $input['amount'];
            $fine->due_date = $input['due_date'];
            $fine->status_name = $input['status_name'];
            $fine->status_id = $input['status_id'];
            $fine->student_id = $input['student_id'];
            $fine->course_id = $input['course_id'];
            $fine->voucher_code = $voucher_code;

            $fine->save();

            $newVoucher->voucher_code = $voucher_code;
            $newVoucher->fine_id = $fine->id;
            $newVoucher->save();

            \DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            \DB::rollback();
        }

    }

    public function invoiceFine(Request $request)
    {

        $input = $request->all();

        $fine = Fine::find($input['id']);

        $student = $fine->student()->get()->first();
        //dd($input);
        $fine->status_name = $input['status_name'];
        $fine->status_id = $input['status_id'];
        $fine->update();

        return view('accounts.invoiceFine')->with('fine', $fine)->with('student', $student);

    }
    public function invoiceHead(Request $request)
    {

        $input = $request->all();

        $headFineStudent = HeadFineStudent::find($input['id']);
        $student = Student::find($input['student_id']);
        //dd($input);
        $headFineStudent->update();

        return view('accounts.invoiceHead')->with('student', $student)->with('headFineStudent', $headFineStudent);

    }
    public function invoicePackage(Request $request)
    {

        $input = $request->all();

        $fee = FeePackage::find($input['id']);

        $student = $fee->student()->get()->first();
        //dd($student);

        $currentDate = date("d-m-Y");
        $currentDate = date_create($currentDate);
        // dd($input);

        $dueDate = $fee['due_date'];

        // $dueDate = str_replace("/", "-", $dueDate);
        // $dueDate = date_create($dueDate);
        $dueDate = date_create('2018/12/02');
        // dd($dueDate->format('d-m-Y'));

        $diff = date_diff($dueDate, $currentDate);
        $diff = (int) $diff->format("%R%a");
        // dd($diff);

        if ($diff < 0) {

            $diff = 0;
        }

        $fine = Fine::where('student_id', '=', $input['student_id'])->get()->toArray();

        $headFineStudents = HeadFineStudent::where('student_id', '=', $input['student_id'])->get();

        return view('accounts.invoicePackage')->with('fee', $fee)->with('student', $student)->with('diff', $diff)->with('fine', $fine)->with('headFineStudents', $headFineStudents);

    }

    public function update_headFine(Request $request)
    {
        try {
            \DB::beginTransaction();

            $input = $request->all();
            // dd($input['heads']);
            $academic_history_id = $input['academic_history_id'];
            for ($i = 0; $i < sizeof($input['heads']); $i++) {

                $voucher = FeeVoucher::get();
                $number = sizeof($voucher);
                $voucher_code = sprintf('%07d', intval($number) + 1);

                $head_fine_Student_obj = ['head_id' => $input['heads'][$i], 'student_id' => $input['student_id'], 'status_name' => $input['status_name'], 'status_id' => $input['status_id'], 'package_id' => $input['package_id'], 'due_date' => $input['due_date'][$i], 'discount_in_amount' => $input['discount_in_amount'][$i], 'head_amount' => $input['head_amount'][$i], 'discount_in_percentage' => $input['discount_in_percentage'][$i], 'amount_after_discount' => $input['amount_after_discount'][$i], 'voucher_code' => $voucher_code, 'academic_history_id' => $academic_history_id, 'user_name' => \Auth::user()->name, 'user_id' => \Auth::user()->id];
                $headfine = HeadFineStudent::create($head_fine_Student_obj);

                $newVoucher = new FeeVoucher;
                $newVoucher->voucher_code = $voucher_code;
                $newVoucher->head_fine_student_id = $headfine->id;
                $newVoucher->save();

                \DB::commit();
            }
            return redirect()->back();
        } catch (\Exception $e) {
            \DB::rollback();
        }

    }

    public function edit_headFine(Request $request)
    {
        try {
            \DB::beginTransaction();
            $input = $request->all();

            $headFine = HeadFineStudent::find($input['id']);

            $headFine->due_date = $input['due_date'];
            $headFine->update();

            \DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            \DB::rollback();
        }

    }

    public function edit_installment(Request $request)
    {
        try {
            \DB::beginTransaction();
            $input = $request->all();
            $installment = FeePackageInstallment::find($input['id']);
            $installment->amount_per_installment = $input['amount_per_installment'];
            $installment->update();

            Notify::success('Student Installment updated successfully', 'Success', $options = []);
            \DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            \DB::rollback();
            if ($e->getCode() != 0) {
                if (in_array(1062, $e->errorInfo)) {
                    $exception_message = str_replace('admissions_', '', $e->errorInfo[2]);
                    $replaced_message = str_replace('_unique', '', $exception_message);
                    $message = str_replace('key', '', $replaced_message);
                    return response()->json(['success' => false, 'error' => $message], 500);
                } else {
                    return response()->json(['success' => false, 'error' => 'Something went wrong.'], 500);
                }
            } else {
                $exception_message = $e->getMessage();
                $exception_message_semi_col_split = explode(":", $exception_message);
                $message = 'Something went wrong at ' . '"' . str_replace(' ', '', str_replace('_', '-', $exception_message_semi_col_split[1])) . '"';
                return response()->json(['success' => false, 'error' => $message], 500);
            }

        }

    }

    public function dailyReport(Request $request)
    {

        $voucher = FeeVoucher::get()->all();
        //dd($voucher[1]->feePackage()->get()->first()->id);
        return view('accounts.dailyReport')->with('voucher', $voucher);

    }

    public function placeOrder(Request $request, $id)
    {
        $studentHead = HeadFineStudent::find($id);
        $studentHead->is_order_placed = true;
        $studentHead->update();
        return redirect()->back();
    }

    public function delivered(Request $request)
    {
        $input = $request->all();
        $studentHead = HeadFineStudent::find($input['student_head_id']);
        $studentHead->date_of_order_delivered = $input['date_of_order_delivered'];
        $studentHead->update();
        return redirect()->back();
    }

    public function destroy($id)
    {
        try {
            \DB::beginTransaction();
            $feeVoucher = FeeVoucher::where('head_fine_student_id', '=', $id)->get()->first();
            // dd($feeVoucher);
            $feeVoucher->delete();

            $headFineStudent = HeadFineStudent::find($id);

            if (empty($headFineStudent)) {
                Flash::error('headFineStudent not found');

                return redirect()->back();
            }

            $headFineStudent->delete();

            Flash::success('headFines deleted successfully.');
            \DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            \DB::rollback();
        }

    }
    public function reportings(Request $request)
    {
        try {
            if ($request->ajax()) {
                $input = $request->all();
                $filtersArray = explode(';', $input['filters']);
                // \Log::info($filtersArray);
                $filteredStudents = Student::when($filtersArray, function ($querry, $filtersArray) {
                    foreach ($filtersArray as $key => $value) {
                        if ($key < (sizeof($filtersArray) - 1)) {
                            $filter = explode(':', $value);
                            // if ($filter[0] == 'student_id') {
                            //     $querry->where('id', '=', $filter[1]);
                            // } else {
                            // }
                            if ($filter[0] == 'course_id' || $filter[0] == 'session_id' || $filter[0] == 'section_id' || $filter[0] == '  ' || $filter[0] == 'is_end_of_reg' || $filter[0] == 'student_category_id') {
                                $querry->where($filter[0], '=', $filter[1]);
                            }
                        }
                    }
                })->with('feePackages', 'studentAcademicHistories', 'course', 'feePackages.feePackageInstallments', 'headFineStudents', 'headFineStudents.headFine')->get();
                // $studentsWithHeads;
                // foreach ($filtersArray as $key => $value) {
                //     if ($key < (sizeof($filtersArray) - 1)) {
                //         $filter = explode(':', $value);
                //         if ($filter[0] == 'head_id') {
                //             foreach ($filteredStudents as $key => $student) {
                //                 $studentHeads = HeadFineStudent::where('student_id', '=', $student['id'])->where($filter[0], '=', $filter[1])->get();
                //             }
                //         }
                //     }
                // }
                $students = $filteredStudents;
                $heads = HeadFine::get();
                return response()->json(['success' => true, 'message' => 'data retrieved successfully', 'data' => ['module_name' => 'accounts', 'students' => $students, 'heads' => $heads]], 200);
            } else {

                $filters_configuration = [
                    'addFilters' => true,
                    'route' => '../accounts/reportings',
                    'js_path' => asset('js/accounts/reportings.js'),
                    'can_filters' => true,
                    'clear_filters' => true,
                    'filters' => [
                        'users' => false,
                        'students' => false,
                        'courses' => true,
                        'parts' => true,
                        'sessions' => true,
                        'subjects' => false,
                        'roles' => false,
                        'admission_forms' => false,
                        'departments' => false,
                        'designations' => false,
                        'sections' => true,
                        'visitor_users' => false,
                        'admission_types' => true,
                        'end_of_registrations' => true,
                        'heads' => true,
                        'fee_structure_types' => true,
                        'payment_statuses' => true,
                        'voucher_statuses' => false,
                        'start_date' => true,
                        'end_date' => true,
                    ],
                ];
                return view('accounts.index_reporting')->with(['filters_configuration' => $filters_configuration]);
            }
        } catch (\Exception $e) {
            \Log::info($e);
        }
    }

    public function exportReportingToExcel()
    {
        \Excel::create('New file', function ($excel) {
            $excel->sheet('New sheet', function ($sheet) {
                $sheet->loadView('accounts.table_reporting');
            });

        })->export('xlsx');
    }
    public function accountGrowth()
    {
        $current_date = new \DateTime();
        $current_date = $current_date->format('Y');
        $years_array = [];
        for ($i = 0; $i < 5; $i++) {
            $year = date('Y', strtotime('-' . $i . 'years'));
            array_push($years_array, $year);
        }

        return view('accounts.accounts_growth')->with('years', $years_array);
    }

    public function accountMonthlyChart(Request $request)
    {

        $input = $request->all();
        $chart_array = [];
        $month_count = [];
        $datasets = [];
        $datasets1 = [];
        $labels = [''];
        $chart_x_axis = [];
        $available_years_with_months = [0];
        $paid_rate = [0];
        $accounts_growth = $input['accounts_growth'];
        $package_dates = FeePackage::whereYear('created_at', '=', $accounts_growth)->get()->groupBy(function ($row) {
            return $row->created_at->format('M');
        })->toArray();
        foreach ($package_dates as $key => $unformatted_date) {
            $month_index = date("m", strtotime($key));
            $package1_dates = FeePackage::whereYear('created_at', '=', $accounts_growth)->whereMonth('created_at', '=', $month_index)->get()->sum('total_package');
            $package2_dates = FeePackageInstallment::whereYear('paid_date', '=', $accounts_growth)->whereMonth('paid_date', '=', $month_index)->get()->sum('paid_amount');

            array_push($labels, $key);
            array_push($available_years_with_months, $package1_dates);
            array_push($paid_rate, $package2_dates);

        }

        array_push($chart_x_axis, $labels);
        array_push($datasets, ['data' => $available_years_with_months]);
        array_push($datasets1, ['data' => $paid_rate]);
        $chart_array = ['labels' => $labels, 'datasets' => $available_years_with_months, 'datasets1' => $paid_rate];
        return response()->json(['chart_array' => $chart_array]);
    }
    public function accountYearlyChart(Request $request)
    {
        $input = $request->all();
        $value_to_subtract = $input['value_to_subtract'];
        $chart1_array = [];
        $datasets = [0];
        $datasets1 = [0];
        $year_counts = [0];
        $year_paid_counts = [0];
        $chart_x_axis = [''];
        for ($i = $value_to_subtract; $i >= 0; $i--) {
            $year = date('Y', strtotime('-' . $i . 'years'));
            array_push($chart_x_axis, $year);

            $yearly_account_count = FeePackage::whereYear('created_at', $year)->get()->sum('total_package');
            $package2_dates = FeePackageInstallment::whereYear('paid_date', $year)->get()->sum('paid_amount');

            array_push($year_counts, $yearly_account_count);
            array_push($year_paid_counts, $package2_dates);

        }
        array_push($datasets, ['data' => $year_counts]);
        array_push($datasets1, ['data' => $year_paid_counts]);
        $chart1_array = ['labels' => $chart_x_axis, 'datasets' => $year_counts, 'datasets1' => $year_paid_counts];
        // $estimated_value = $this->chartEstimatedValues($yearly_enquiry_count);
        // dd($estimated_value);
        return response()->json(['chart1_array' => $chart1_array]);

    }
    public function multiAccountConversionRate(Request $request)
    {
        $input = $request->all();
        $chart_x_axis = [];
        $year_counts = [];
        $year_counts1 = [];
        $year_counts2 = [];
        $year_counts3 = [];
        $multi_chart = [];
        $datasets = [];
        $datasets1 = [];
        $datasets2 = [];
        $datasets3 = [];
        $multi_choose_year = $input['multi_choose_year'];
        for ($i = $multi_choose_year; $i >= 0; $i--) {
            $year = date('Y', strtotime('-' . $i . 'years'));
            array_push($chart_x_axis, $year);
            $account_date = FeePackageInstallment::whereYear('created_at', $year)->get()->count();
            array_push($year_counts3, $account_date);
            array_push($datasets3, $year_counts3);
            $data = config('constants.payment_statuses')[0];
            $yearly_account_count = FeePackageInstallment::whereYear('created_at', $year)->where('status_id', '=', 0)->get()->count($data);
            array_push($year_counts, $yearly_account_count);

            array_push($datasets, ['data' => $year_counts]);
            $data1 = config('constants.payment_statuses')[1];
            $yearly_account_count1 = FeePackageInstallment::whereYear('created_at', $year)->where('status_id', '=', 1)->get()->count($data1);
            array_push($year_counts1, $yearly_account_count1);
            array_push($datasets1, $year_counts1);
            $data2 = config('constants.payment_statuses')[2];
            $yearly_account_count2 = FeePackageInstallment::whereYear('created_at', $year)->where('status_id', '=', 2)->get()->count($data2);
            array_push($year_counts2, $yearly_account_count2);
            array_push($datasets2, $year_counts2);

        }
        $multi_chart = ['labels' => $chart_x_axis, 'datasets' => $year_counts, 'datasets1' => $year_counts1, 'datasets2' => $year_counts2, 'datasets3' => $year_counts3];

        return response()->json(['multi_chart' => $multi_chart]);

    }
    public function accountMonthlyConversionChart(Request $request)
    {

        $input = $request->all();
        $multi_monthly_chart = [];
        $month_year_count = [];
        $month_year_count1 = [];
        $month_year_count2 = [];
        $month_year_count3 = [];
        $datasets = [];
        $datasets1 = [];
        $datasets2 = [];
        $datasets3 = [];
        $labels = [''];
        $chart_x_axis = [];
        $select_year_month = $input['select_year_month'];
        $package_dates = FeePackage::whereYear('created_at', '=', $select_year_month)->get()->groupBy(function ($row) {
            return $row->created_at->format('M');
        })->toArray();
        foreach ($package_dates as $key => $unformatted_date) {
            $month_index = date("m", strtotime($key));

            array_push($labels, $key);
            $month_count = FeePackageInstallment::whereYear('created_at', '=', $select_year_month)->whereMonth('created_at', '=', $month_index)->get()->count();
            array_push($month_year_count, $month_count);
            array_push($datasets, ['data' => $month_year_count]);
            $data1 = config('constants.payment_statuses')[0];
            $month_count1 = FeePackageInstallment::whereYear('created_at', '=', $select_year_month)->whereMonth('created_at', '=', $month_index)->where('status_id', '=', 0)->get()->count($data1);
            array_push($month_year_count1, $month_count1);

            array_push($datasets1, ['data' => $month_year_count1]);
            $data2 = config('constants.payment_statuses')[1];
            $month_count2 = FeePackageInstallment::whereYear('created_at', '=', $select_year_month)->whereMonth('created_at', '=', $month_index)->where('status_id', '=', 1)->get()->count($data2);
            array_push($month_year_count2, $month_count2);

            array_push($datasets2, ['data' => $month_year_count2]);
            $data3 = config('constants.payment_statuses')[2];
            $month_count3 = FeePackageInstallment::whereYear('created_at', '=', $select_year_month)->whereMonth('created_at', '=', $month_index)->where('status_id', '=', 2)->get()->count($data3);
            array_push($month_year_count3, $month_count3);

            array_push($datasets3, ['data' => $month_year_count3]);}

        $multi_monthly_chart = ['labels' => $labels, 'datasets' => $month_year_count, 'datasets1' => $month_year_count1, 'datasets2' => $month_year_count2, 'datasets3' => $month_year_count3];

        return response()->json(['multi_monthly_chart' => $multi_monthly_chart]);
    }

    public function accountMonthlyWelRegChart(Request $request)
    {

        $input = $request->all();
        $multi_monthly_reg_wel_chart = [];
        $month_year_count_reg = [];
        $month_year_count_wel = [];
        $datasets = [0];
        $datasets1 = [0];
        $labels = [];
        $chart_x_axis = [];
        $select_year_for_wel_reg = $input['select_year_for_wel_reg'];
        $package_dates = Student::whereYear('created_at', '=', $select_year_for_wel_reg)->get()->groupBy(function ($row) {
            return $row->created_at->format('M');
        })->toArray();

        foreach ($package_dates as $key => $unformatted_date) {
            $month_index = date("m", strtotime($key));

            array_push($labels, $key);

            $data = config('constants.student_categories')[0];
            $history = Student::whereYear('created_at', '=', $select_year_for_wel_reg)->whereMonth('created_at', '=', $month_index)->where('student_category_id', '=', 0)->get();

            foreach ($history as $value) {
                $reg_amount = FeePackage::where('student_id', '=', $value['id'])->get()->sum('total_package');
            }
            array_push($month_year_count_reg, $reg_amount);
            array_push($datasets, ['data' => $month_year_count_reg]);
            $data1 = config('constants.student_categories')[2];
            $history_wel = Student::whereYear('created_at', '=', $select_year_for_wel_reg)->whereMonth('created_at', '=', $month_index)->where('student_category_id', '=', 2)->get();
            foreach ($history_wel as $value1) {
                $wel_amount = FeePackage::where('student_id', '=', $value1['id'])->get()->sum('total_package');
            }

            array_push($month_year_count_wel, $wel_amount);
            array_push($datasets1, ['data' => $month_year_count_wel]);
            $multi_monthly_reg_wel_chart = ['labels' => $labels, 'datasets' => $month_year_count_reg, 'datasets1' => $month_year_count_wel];
        }

        return response()->json(['multi_monthly_reg_wel_chart' => $multi_monthly_reg_wel_chart]);

    }

    public function accountYearlyWelRegChart(Request $request)
    {
        $input = $request->all();
        $chart_x_axis = [];
        $year_counts_reg = [];
        $year_counts_wel = [];
        $multi_yearly_wel_reg_chart = [];
        $datasets = [];
        $datasets1 = [];
        $choose_year_for_welreg = $input['choose_year_for_welreg'];
        for ($i = $choose_year_for_welreg; $i >= 0; $i--) {
            $year = date('Y', strtotime('-' . $i . 'years'));
            array_push($chart_x_axis, $year);
            $reg = config('constants.student_categories')[0];
            $total_reg = Student::whereYear('created_at', $year)->where('student_category_id', '=', 0)->get();
            foreach ($total_reg as $key) {

                $reg_amount_yearwise = FeePackage::where('student_id', '=', $key['id'])->get()->sum('total_package');

                array_push($year_counts_reg, $reg_amount_yearwise);

            }

            $wel = config('constants.student_categories')[2];
            $total_wel = Student::whereYear('created_at', $year)->where('student_category_id', '=', 2)->get();

            foreach ($total_wel as $key1) {

                $wel_amount_yearwise = FeePackage::where('student_id', '=', $key1['id'])->get()->sum('total_package');

                array_push($year_counts_wel, $wel_amount_yearwise);
            }

            array_push($datasets, ['data' => $year_counts_reg]);

            array_push($datasets1, ['data' => $year_counts_wel]);

            $multi_yearly_reg_wel_chart = ['labels' => $chart_x_axis, 'datasets' => $year_counts_reg, 'datasets1' => $year_counts_wel];

        }

        return response()->json(['multi_yearly_reg_wel_chart' => $multi_yearly_reg_wel_chart]);

    }

    public function pay_fine(Request $request)
    {
        try {
            \DB::beginTransaction();
            if ($request->has('overall_paid')) {

                $input = $request->all();
                $amount_deferred_percentage = $input['amount_deferred'];
                $amount_waived_percentage = $input['amount_waived'];
                $installments = FeePackageInstallment::where('package_id', '=', $input['package_id'])->get();
                foreach ($installments as $key => $installment) {
                    $fee_fines = FeeFine::where('installment_id', '=', $installment->id)->where('paid_date', '=', null)->get();
                    foreach ($fee_fines as $key => $fee_fine) {
                        $amount = $fee_fine->amount;
                        $amount_waived = (int) round(($fee_fine->amount * $amount_waived_percentage) / 100, 0, PHP_ROUND_HALF_DOWN);
                        $amount_after_waived = $fee_fine->amount - $amount_waived;
                        $remaining_amount = (int) round(($amount_after_waived * $amount_deferred_percentage) / 100, 0, PHP_ROUND_HALF_DOWN);
                        $paid_amount = $amount_after_waived - $remaining_amount;

                        $fee_voucher = new FeeFineVoucher();
                        $fee_fine->voucher_number = $input['voucher_number'];
                        $fee_fine->paid_date = $input['paid_date'];
                        $fee_fine->paid_amount = $paid_amount;
                        $fee_fine->balance = $remaining_amount;
                        $fee_fine->amount_waived = $amount_waived;
                        $fee_fine->amount_after_waived = $amount_after_waived;
                        $fee_fine->installment_id = $installment->id;
                        $fee_voucher->voucher_code = $fee_fine->voucher_number;
                        $fee_voucher->fee_fine_id = $fee_fine->id;
                        $fee_voucher->save();
                        if ($remaining_amount != null) {
                            $newfee_fine = new FeeFine();
                            $newfee_fine->amount = $remaining_amount;
                            $newfee_fine->previous_reference = $fee_fine->id;
                            $newfee_fine->installment_id = $fee_fine->installment_id;
                            $newfee_fine->save();
                            $fee_fine->next_reference = $newfee_fine->id;
                        }
                        $fee_fine->fee_voucher_id = $fee_voucher->id;
                        $fee_fine->update();
                    }
                }

            } else {
                $input = $request->all();
                $fee_fine = FeeFine::find($input['fee_fine_id']);
                $fee_voucher = new FeeFineVoucher();
                $fee_fine->voucher_number = $input['fine_voucher_code'];
                $fee_fine->paid_date = $input['paid_date'];
                $fee_fine->paid_amount = $input['amount_paid'];
                $fee_fine->balance = $input['remaining_balance'];
                $fee_fine->amount_waived = $input['amount_waived'];
                $fee_fine->amount_after_waived = $input['TotalFine'];
                $fee_fine->installment_id = $input['installment_id'];
                $fee_voucher->voucher_code = $input['fine_voucher_code'];
                $fee_voucher->fee_fine_id = $fee_fine->id;
                $fee_voucher->save();
                if ($input['remaining_balance'] != null && $input['remaining_balance'] != 0 && $input['remaining_balance'] != '0') {
                    $newfee_fine = new FeeFine();
                    $newfee_fine->amount = $input['remaining_balance'];
                    $newfee_fine->previous_reference = $fee_fine->id;
                    $newfee_fine->installment_id = $fee_fine->installment_id;
                    $newfee_fine->save();
                    $fee_fine->next_reference = $newfee_fine->id;
                }
                $fee_fine->fee_voucher_id = $fee_voucher->id;
                $fee_fine->update();
            }
            \DB::commit();
            return redirect()->back();

        } catch (\Exception $e) {
            dd($e);
            \DB::rollback();
        }
    }

    public function attendanceFine(Request $request)
    {

        $atd_fine = new AttendanceFine();

        $absents = 0;
        $input = $request->all();
        $academic_history_id = $input['academic_history_id'];
        $atd = Attendance::where('student_id', '=', $input['student_id'])->where('date', '>=', $input['from_date'])->where('date', '<=', $input['to_date'])->get()->toArray();

        foreach ($atd as $value) {

            if ($value['status_id'] == 0) {
                $absents++;
            }

        }
        $fine = $absents * 200;
        $atd_fine->amount = $fine;
        $atd_fine->student_id = $input['student_id'];
        $atd_fine->from_date = $input['from_date'];
        $atd_fine->to_date = $input['to_date'];
        $atd_fine->academic_history_id = $academic_history_id;
        $atd_fine->save();

        return response()->json(['fine' => $fine]);

    }

    public function payAttendanceFine(Request $request)
    {

        $input = $request->all();
        $atd_fine = AttendanceFine::find($input['attendance_fine_id']);
        $atd_voucher = new AttendanceFineVoucher();
        $atd_fine->voucher_number = $input['fine_voucher_code'];
        $atd_fine->paid_date = $input['paid_date'];
        $atd_fine->paid_amount = $input['amount_paid'];
        $atd_fine->balance = $input['atd_remaining_balance'];
        $atd_fine->amount_waived = $input['atd_amount_waived'];
        $atd_fine->amount_after_waived = $input['atd_TotalFine'];
        $atd_voucher->voucher_code = $input['fine_voucher_code'];

        $atd_voucher->attendance_fine_id = $atd_fine->id;
        $atd_voucher->save();
        if ($input['atd_remaining_balance'] != null && $input['atd_remaining_balance'] != 0) {
            $newAtd_fine = new AttendanceFine();
            $newAtd_fine->amount = $input['atd_remaining_balance'];
            $newAtd_fine->from_date = $atd_voucher->from_date;
            $newAtd_fine->to_date = $atd_voucher->to_date;
            $newAtd_fine->previous_reference = $atd_fine->id;
            $newAtd_fine->student_id = $atd_fine->student_id;
            $newAtd_fine->save();
            $atd_fine->next_reference = $newAtd_fine->id;
        }

        $atd_fine->attendance_fine_voucher_id = $atd_voucher->id;
        $atd_fine->update();
        return redirect()->back();

    }

    public function deleteAttendanceFine($id)
    {
        $attendance_fine = AttendanceFine::find($id);
        if (empty($attendance_fine)) {
            return redirect()->back();
        }
        $next_reference = $attendance_fine->next_reference;
        $attendance_fine_voucher = AttendanceFineVoucher::find($attendance_fine->attendance_fine_voucher_id);
        if (!empty($attendance_fine_voucher)) {
            $attendance_fine_voucher->delete();
        }
        $previous_reference = $attendance_fine->previous_reference;
        if ($previous_reference != null) {
            $previous_referenced_data = AttendanceFine::find($previous_reference);
            $previous_referenced_data->next_reference = null;
            $previous_referenced_data->update();
        }
        $attendance_fine->delete();
        while ($next_reference != null) {
            $next_reference_fine = AttendanceFine::find($next_reference);
            $attendance_fine_voucher = AttendanceFineVoucher::find($attendance_fine->attendance_fine_voucher_id);
            if (empty($next_reference_fine)) {
                $next_reference = null;
            } else {
                $next_reference = $next_reference_fine->next_reference;
                $next_reference_fine->delete();
            }
            if (!empty($attendance_fine_voucher)) {
                $attendance_fine_voucher->delete();
            }
        }
        return redirect()->back();
    }

    public function calculateExamFine(Request $request)
    {
        $input = $request->all();
        $exam_fine = new ExamFine();

        $student_result = DateSheetStudent::where('student_id', '=', $input['student_id'])->where('date_sheet_id', '=', $input['date_sheet_id'])->where('status_id', '=', '1')->get();
        $academichistoryID = $input['academic_history_id'];
        $fine = count($student_result) * 200;
        $exam_fine->amount = $fine;
        $exam_fine->student_id = $input['student_id'];
        $exam_fine->exam_type_id = $input['exam_type_id'];
        $exam_fine->date_sheet_id = $input['date_sheet_id'];
        $exam_fine->student_academic_history_id = $academichistoryID;
        $exam_fine->save();

        return response()->json(['fine' => $fine]);
    }

    public function payExamFine(Request $request)
    {
        try {
            \DB::beginTransaction();
            if ($request->has('overall_paid')) {
                dd('over_here');
                $input = $request->all();
                $amount_deferred_percentage = $input['amount_deferred'];
                $amount_waived_percentage = $input['amount_waived'];
                $exam_fines = ExamFine::where('student_id', '=', $input['student_id'])->where('paid_date', '=', null)->get();
                foreach ($exam_fines as $key => $exam_fine) {
                    $amount = $exam_fine->amount;
                    $amount_waived = (int) round(($exam_fine->amount * $amount_waived_percentage) / 100, 0, PHP_ROUND_HALF_DOWN);
                    $amount_after_waived = $exam_fine->amount - $amount_waived;
                    $remaining_amount = (int) round(($amount_after_waived * $amount_deferred_percentage) / 100, 0, PHP_ROUND_HALF_DOWN);
                    $paid_amount = $amount_after_waived - $remaining_amount;

                    $exam_fine_voucher = new ExamFineVoucher();
                    $exam_fine->voucher_number = $input['voucher_number'];
                    $exam_fine->paid_date = $input['paid_date'];
                    $exam_fine->paid_amount = $paid_amount;
                    $exam_fine->balance = $remaining_amount;
                    $exam_fine->amount_waived = $amount_waived;
                    $exam_fine->amount_after_waived = $amount_after_waived;
                    $exam_fine_voucher->voucher_code = $exam_fine->voucher_number;
                    $exam_fine_voucher->exam_fine_id = $exam_fine->id;
                    $exam_fine_voucher->save();
                    if ($remaining_amount != null && $remaining_amount > 0) {
                        $new_exam_fine = new ExamFine();
                        $new_exam_fine->amount = $remaining_amount;
                        $new_exam_fine->previous_reference = $exam_fine->id;
                        $new_exam_fine->student_id = $exam_fine->student_id;
                        $new_exam_fine->date_sheet_id = $exam_fine->date_sheet_id;
                        $new_exam_fine->exam_type_id = $exam_fine->exam_type_id;
                        $new_exam_fine->student_academic_history_id = $exam_fine->student_academic_history_id;
                        $new_exam_fine->save();
                        $exam_fine->next_reference = $new_exam_fine->id;
                    }
                    $exam_fine->exam_fine_voucher_id = $exam_fine_voucher->id;
                    $exam_fine->update();
                }
            } else {
                $input = $request->all();
                $exam_fine = ExamFine::/*where('student_id', '=', $input['student_id'])->where('date_sheet_id', '=', $input['date_sheet_id'])->where('exam_type_id', '=', $input['exam_type_id'])->get()->first()*/find($input['exam_fine_id']);

                $exam_fine_voucher = new ExamFineVoucher();
                $exam_fine->voucher_number = $input['fine_voucher_code'];
                $exam_fine->paid_date = $input['paid_date'];
                $exam_fine->paid_amount = $input['amount_paid'];
                $exam_fine->balance = $input['ex_remaining_balance'];
                $exam_fine->amount_waived = $input['ex_amount_waived'];
                $exam_fine->amount_after_waived = $input['ex_TotalFine'];
                $exam_fine_voucher->voucher_code = $input['fine_voucher_code'];

                $exam_fine_voucher->exam_fine_id = $exam_fine->id;
                $exam_fine_voucher->save();
                if ($input['ex_remaining_balance'] != null && $input['ex_remaining_balance'] > 0) {
                    $new_exam_fine = new ExamFine();
                    $new_exam_fine->amount = $input['ex_remaining_balance'];
                    $new_exam_fine->previous_reference = $exam_fine->id;
                    $new_exam_fine->student_id = $exam_fine->student_id;
                    $new_exam_fine->date_sheet_id = $exam_fine->date_sheet_id;
                    $new_exam_fine->exam_type_id = $exam_fine->exam_type_id;
                    $new_exam_fine->student_academic_history_id = $exam_fine->student_academic_history_id;
                    $new_exam_fine->save();
                    $exam_fine->next_reference = $new_exam_fine->id;
                }

                $exam_fine->exam_fine_voucher_id = $exam_fine_voucher->id;
                $exam_fine->update();
            }
            \DB::commit();
            return redirect()->back();

        } catch (\Exception $e) {
            dd($e);
            \DB::rollback();
        }

    }

    public function deleteExamFine($id)
    {

        $exam_fine = ExamFine::find($id);
        if (empty($exam_fine)) {
            return redirect()->back();
        }
        $next_reference = $exam_fine->next_reference;
        $exam_fine_voucher = ExamFineVoucher::find($exam_fine->exam_fine_voucher_id);
        if (!empty($exam_fine_voucher)) {
            $exam_fine_voucher->delete();
        }
        $previous_reference = $exam_fine->previous_reference;
        if ($previous_reference != null) {
            $previous_referenced_data = ExamFine::find($previous_reference);
            $previous_referenced_data->next_reference = null;
            $previous_referenced_data->update();
        }
        $exam_fine->delete();
        while ($next_reference != null) {
            $next_reference_fine = ExamFine::find($next_reference);
            $exam_fine_voucher = ExamFineVoucher::find($exam_fine->exam_fine_voucher_id);
            if (empty($next_reference_fine)) {
                $next_reference = null;
            } else {
                $next_reference = $next_reference_fine->next_reference;
                $next_reference_fine->delete();
            }
            if (!empty($exam_fine_voucher)) {
                $exam_fine_voucher->delete();
            }
        }
        return redirect()->back();
    }

    public function getDateSheets(Request $request)
    {
        $input = $request->all();
        $date_sheets = DateSheet::where('exam_type_id', '=', $input['exam_type_id'])->where('session_id', '=', $input['session_id'])->get();

        $date_sheet_against_sections = [];
        foreach ($date_sheets as $key => $date_sheet) {
            $course_wise_date_sheets = DateSheetCourse::where('course_id', '=', (int) $input['course_id'])->where('date_sheet_id', '=', $date_sheet->id)->get();
            foreach ($course_wise_date_sheets as $key => $course_date_sheet) {

                $returned_data = DateSheetSection::where('section_id', '=', (int) $input['section_id'])->where('date_sheet_id', '=', $course_date_sheet->date_sheet_id)->get();
                // dd($returned_data);
                if (count($returned_data->toArray()) > 0) {
                    array_push($date_sheet_against_sections, $date_sheet);
                }
            }
        }
        return response()->json(['success' => true, 'data' => ['date_sheets' => $date_sheet_against_sections]]);
    }

    public function generateFine(Request $request)
    {
        $input = $request->all();
        $installment = FeePackageInstallment::find($input['installment_id']);
        $fine = 0;
        $due_date_obj = date_create($installment->due_date);

        $current_date_obj = isset($input['fine_date']) ? date_create($input['fine_date']) : date_create();
        if ($current_date_obj > $due_date_obj) {
            $diff = date_diff($due_date_obj, $current_date_obj);
            $diff = $diff->days + $diff->invert;
            // dd($diff);
            $fine = ($diff * 25);
        } else {
            $fine = 0;
        }
        $this->createInstallmentFine($installment->id, $fine);
        return redirect()->back();
    }

    public function sessionReport()
    {
        return view('accounts.reports.index_session_report');
    }

    public function sessionReportGenerate(Request $request)
    {
        // dd(FeePackageInstallment::where('package_id', '3748')->where('due_date', 'LIKE', '2019-07%')->get());
        $student_query = Student::query();
        foreach ($request->all() as $key => $param) {
            if ($key != 'semester_year_id' && $key != 'start_month' && $key != 'end_month') {
                if (!is_null($param) && $param != '') {
                    $student_query->where($key, '=', $param);
                }
            }
        }
        $fileHeader = ['course' => Course::find($request->get('course_id'))->name, 'semesters_years' => config('constants.semesters_years')[$request->get('semester_year_id')], 'section' => Section::find($request->get('section_id'))->name, 'category' => ($request->get('is_worker') != null ? config('constants.is_worker')[$request->get('is_worker')] : 'All'), 'shift' => 'All'];
        $students = $student_query->where('is_end_of_reg', '=', 0)->orderBy('old_roll_no')->get();
        $reportData = [];
        $table_columns = ['old_roll_no' => 'C. Roll #', 'student_name' => 'Name', 'roll_no' => 'Sys Roll #', 'father_name' => 'F. Name', 'father_cell_no' => 'F. Cell #', 'student_cell_no' => 'S. Cell #', 'tuition_fee' => 'T. Fee', 'installment_count' => 'Ins Count'];
        $all_session_installments;
        $fee_package_total = 0;
        $installment_difference_total = 0;

        $heads_due_total = 0;
        $heads_paid_total = 0;

        $transport_head_due_total = 0;
        $transport_head_paid_total = 0;

        $fine_due_total = 0;
        $fine_waived_total = 0;
        $fine_paid_total = 0;

        $start_month_start_date = Carbon::parse($request->get('start_month'))->startOfMonth()->format('Y-m-d');
        $end_month_end_date = Carbon::parse($request->get('end_month'))->endOfMonth()->format('Y-m-d');

        if (!$students->isEmpty()) {

            foreach ($students as $key => $student) {

                $total_absent_days_fine = 0;
                $total_fine_on_instalment = 0;

                $total_absent_fine_remaining = 0;
                $total_fine_adjustment_on_instalment = 0;

                $total_absent_fine_paid = 0;
                $total_installment_fine_paid = 0;

                \Log::info(config('constants.semesters_years')[$request->semester_year_id]);
                if (config('constants.semesters_years')[$request->semester_year_id] >= $student->studentAcademicHistories()->count()) {
                    $reportData[$key]['old_roll_no'] = $student->old_roll_no;
                    $reportData[$key]['student_name'] = $student->student_name;
                    $reportData[$key]['roll_no'] = $student->roll_no;
                    $reportData[$key]['is_worker'] = config('constants.is_worker')[$student->is_worker];
                    $reportData[$key]['shift_id'] = $student->shift_id;
                    $reportData[$key]['shift'] = isset($student->shift_id) ? config('constants.shifts')[$student->shift_id] : '---';

                    $reportData[$key]['course_id'] = $student->course_id;
                    $reportData[$key]['course'] = $student->course_name;
                    $reportData[$key]['section_id'] = $student->section_id;
                    $reportData[$key]['section'] = $student->section_name;
                    $reportData[$key]['father_name'] = $student->father_name;
                    $reportData[$key]['father_cell_no'] = $student->father_cell_no;
                    $reportData[$key]['student_cell_no'] = $student->student_cell_no;
                    if (array_key_exists($request->semester_year_id, $student->studentAcademicHistories()->get())) {
                        $student_academic_history = $student->studentAcademicHistories()->get('id')[$request->semester_year_id];
                    } else {
                        $student_academic_history = $student->studentAcademicHistories()->get('id')->last();
                    }
                    $student_package = $student->feePackages()->where('academic_history_id', $student_academic_history->id)->get(['id', 'net_total'])->last();
                    $fee_package_total = $fee_package_total + $student_package['net_total'];
                    $reportData[$key]['tuition_fee'] = $student_package['net_total'];
                    $reportData[$key]['package_id'] = $student_package['id'];
                    $reportData[$key]['installment_count'] = 0;
                    if ($student_package) {
                        $reportData[$key]['installment_count'] = $student_package->feePackageInstallments()->count();

                        $student_installments = $student_package->feePackageInstallments()->where('due_date', '>=', $start_month_start_date)->where('due_date', '<=', $end_month_end_date)->get(['id', 'due_date', 'package_id', 'amount_per_installment', 'status_id', 'paid_amount', 'remaining_balance']);
                        $reportData[$key]['total_installments_due'] = $student_installments->sum('amount_per_installment');
                        $partial_paid_total = $student_installments->where('status_id', '=', 2)->sum('amount_per_installment') - $student_installments->where('status_id', '=', 2)->sum('remaining_balance');
                        $reportData[$key]['total_installment_paid'] = $student_installments->where('status_id', '=', 1)->sum('amount_per_installment') + $partial_paid_total;
                        $reportData[$key]['installment_difference'] = $reportData[$key]['tuition_fee'] - $student_package->feePackageInstallments()->sum('amount_per_installment');
                        $installment_difference_total = $installment_difference_total + $reportData[$key]['installment_difference'];
                        if (isset($all_session_installments)) {
                            $all_session_installments = $all_session_installments->merge($student_installments);
                        } else {
                            $all_session_installments = $student_installments;
                        }
                        foreach ($student_installments as $instalment) {

                            $due_date = new \DateTime($instalment->due_date);
                            $paid_date = new \DateTime($instalment->paid_date);
                            $remaining_paid_date = new \DateTime($instalment->remaining_balance_paid_date);
                            $diff = 0;
                            $current_date = new \DateTime();
                            if ($instalment->feeFines()->get()->count() > 0) {
                                foreach ($instalment->feeFines()->get() as $fine) {
                                    $diff = date_diff($due_date, $paid_date != null ? $paid_date : $current_date);
                                    $diff = $diff->days + $diff->invert;
                                    // dd($diff);
                                    // $lateFine = ($diff);
                                    $instalment->late_fine_days_for = $diff;
                                    // $instalment->late_fee_fine = $fine->amount;
                                    $total_fine_adjustment_on_instalment = $total_fine_adjustment_on_instalment + ($fine->paid_date != null ? ($fine->amount_waived) : 0);
                                    $total_fine_on_instalment = $total_fine_on_instalment + ($fine->previous_reference == null ? $fine->amount : 0);
                                    $total_installment_fine_paid = $total_installment_fine_paid + ($fine->paid_date != null ? ($fine->amount - $fine->amount_waived - $fine->balance) : 0);
                                }

                            } else {

                                if ($instalment->status_id == 0) {
                                    if (!isset($instalment->late_fee_fine)) {

                                        if ($instalment->amount_per_installment > 1000 && $current_date > $due_date) {
                                            $late_fee_fine = $this->calculateFine($instalment->due_date);
                                            $diff = date_diff($due_date, $current_date);
                                            $diff = $diff->days + $diff->invert;
                                            // dd($diff);
                                            $lateFine = ($diff);
                                            $instalment->late_fine_days_for = $diff;
                                            $instalment->late_fee_fine = $late_fee_fine;
                                        } else {
                                            $instalment->late_fine_days_for = 0;
                                        }

                                        $total_fine_on_instalment = ($total_fine_on_instalment + ($instalment->fine_paid_date == null ? $instalment->late_fee_fine : 0));

                                        $total_installment_fine_paid = ($total_installment_fine_paid + ($instalment->fine_paid_date != null ? $instalment->late_fee_fine : 0));
                                    }
                                } else if ($instalment->status_id == 1) {

                                    $total_installment_fine_paid = ($total_installment_fine_paid + ($instalment->fine_paid_date != null ? $instalment->late_fee_fine : 0) + ($instalment->remaining_balance_late_fine != null ? ($instalment->remaining_balance_fine_paid_date != null ? $instalment->remaining_balance_late_fine : 0) : 0));

                                    $total_fine_on_instalment = ($total_fine_on_instalment + ($instalment->fine_paid_date == null ? $instalment->late_fee_fine : 0) + ($instalment->remaining_balance_late_fine != null ? ($instalment->remaining_balance_fine_paid_date == null ? $instalment->remaining_balance_late_fine : 0) : 0));
                                    $total_fine_adjustment_on_instalment = ($total_fine_adjustment_on_instalment + $instalment->fine_waived + ($instalment->remaining_balance_fine_waived != null ? $instalment->remaining_balance_fine_waived : 0));

                                }
                            }
                        }
                    }

                    $student_head = $student->headFineStudents()->where('academic_history_id', '=', $student_academic_history->id)->where('head_id', '!=', 6)->where('head_id', '!=', 48)->get();
                    $student_heads_due = $student_head->sum('head_amount');
                    $student_heads_paid = $student_head->where('status_id', '=', 1)->sum('head_amount');
                    $student_heads_paid = $student_heads_paid + ($student_head->where('status_id', '=', 2)->sum('head_amount') - $student_head->where('status_id', '=', 2)->sum('remaining_balance'));

                    $reportData[$key]['heads_due'] = $student_heads_due;
                    $reportData[$key]['heads_paid'] = $student_heads_paid;

                    $heads_due_total = $heads_due_total + $student_heads_due;
                    $heads_paid_total = $heads_paid_total + $student_heads_paid;

                    $student_transport_head = $student->headFineStudents()->where('academic_history_id', '=', $student_academic_history->id)->where('due_date', '>=', $start_month_start_date)->where('due_date', '<=', $end_month_end_date)->where('head_id', '=', $student->student_category_id == 0 ? 6 : 48)->get();

                    $student_transport_head_due = $student_transport_head->sum('head_amount');
                    $student_transport_head_paid = $student_transport_head->where('status_id', '=', 1)->sum('head_amount');
                    $student_transport_head_paid = $student_transport_head_paid + ($student_transport_head->where('status_id', '=', 2)->sum('head_amount') - $student_transport_head->where('status_id', '=', 2)->sum('remaining_balance'));

                    $reportData[$key]['transport_heads_due'] = $student_transport_head_due;
                    $reportData[$key]['transport_heads_paid'] = $student_transport_head_paid;

                    $transport_head_due_total = $transport_head_due_total + $student_transport_head_due;
                    $transport_head_paid_total = $transport_head_paid_total + $student_transport_head_paid;

                    $attendance_fines = $this->getAttenanceDetails($student->id, $student_academic_history->id);

                    foreach ($attendance_fines as $fine) {
                        foreach ($fine['fine_nodes'] as $fineNodekey => $node) {
                            if ($fineNodekey == 0) {
                                $total_absent_days_fine = $total_absent_days_fine + $node->amount;
                                $total_absent_fine_remaining = $node->paid_date == null ? ($total_absent_fine_remaining + $node->amount) : 0;
                            } else {
                                $total_absent_fine_remaining = $node->paid_date == null ? ($total_absent_fine_remaining + $node->amount) : 0;
                            }
                        }
                    }

                    $reportData[$key]['total_fine_due'] = $total_absent_days_fine + $total_fine_on_instalment;
                    $reportData[$key]['total_fine_waived'] = $total_absent_fine_remaining + $total_fine_adjustment_on_instalment;
                    $reportData[$key]['total_fine_paid'] = $total_absent_fine_paid + $total_installment_fine_paid;

                    $fine_due_total = $fine_due_total + ($total_absent_days_fine + $total_fine_on_instalment);
                    $fine_waived_total = $fine_waived_total + ($total_absent_fine_remaining + $total_fine_adjustment_on_instalment);
                    $fine_paid_total = $fine_paid_total + ($total_absent_fine_paid + $total_installment_fine_paid);
                }

            }
            $month_cols = [];
            $monthly_installment_total = [];
            $monthly_due_total = 0;
            $monthly_paid_total = 0;
            $monthly_remaining_total = 0;
            if (isset($all_session_installments) && !$all_session_installments->isEmpty()) {
                $exploded_max_date = explode('-', $all_session_installments->max('due_date'));
                $max_date = Carbon::create($exploded_max_date[0], $exploded_max_date[1], 5);
                $exploded_min_date = explode('-', $all_session_installments->min('due_date'));
                $min_date = Carbon::create($exploded_min_date[0], $exploded_min_date[1], 5);

                $month_difference = $max_date->diffInMonths($min_date);
                for ($i = 0; $i <= $month_difference; $i++) {
                    array_push($month_cols, $min_date->format('Y-m-d'));
                    $monthly_due = 0;
                    $monthly_paid = 0;
                    $monthly_remaining = 0;
                    foreach ($reportData as $key => $data) {
                        $monthly_due = $monthly_due + FeePackageInstallment::where('package_id', $data['package_id'])->where('due_date', 'LIKE', $min_date->format('Y-m') . '%')->sum('amount_per_installment');

                        $partial_paid_total = FeePackageInstallment::where('package_id', $data['package_id'])->where('due_date', 'LIKE', $min_date->format('Y-m') . '%')->where('status_id', '=', 2)->sum('amount_per_installment') - FeePackageInstallment::where('package_id', $data['package_id'])->where('due_date', 'LIKE', $min_date->format('Y-m') . '%')->where('status_id', '=', 2)->sum('remaining_balance');

                        $monthly_paid = $monthly_paid + FeePackageInstallment::where('package_id', $data['package_id'])->where('due_date', 'LIKE', $min_date->format('Y-m') . '%')->where('status_id', '=', 1)->sum('amount_per_installment') + $partial_paid_total;
                        $monthly_remaining = $monthly_remaining + (FeePackageInstallment::where('package_id', $data['package_id'])->where('due_date', 'LIKE', $min_date->format('Y-m') . '%')->sum('amount_per_installment') - (FeePackageInstallment::where('package_id', $data['package_id'])->where('due_date', 'LIKE', $min_date->format('Y-m') . '%')->where('status_id', '=', 1)->sum('amount_per_installment') + $partial_paid_total));
                    }
                    $monthly_due_total = $monthly_due_total + $monthly_due;
                    $monthly_paid_total = $monthly_paid_total + $monthly_paid;
                    $monthly_remaining_total = $monthly_remaining_total + $monthly_remaining;
                    array_push($monthly_installment_total, ['monthly_due' => $monthly_due, 'monthly_paid' => $monthly_paid, 'monthly_remaining' => $monthly_remaining]);
                    $min_date->modify('+1month');
                }
            }

            // dd(FeePackageInstallment::where('package_id', '3748')->where('due_date', 'LIKE', '2019-07%')->get()->toArray());
            $view = view('accounts.reports.sessionReport')->with('table_columns', $table_columns)->with('fee_package_total', $fee_package_total)->with('monthly_due_total', $monthly_due_total)->with('monthly_paid_total', $monthly_paid_total)->with('monthly_remaining_total', $monthly_remaining_total)->with('heads_due_total', $heads_due_total)->with('heads_paid_total', $heads_paid_total)->with('reportData', $reportData)->with('monthly_installment_total', $monthly_installment_total)->with('month_cols', $month_cols)->with('all_session_installments', isset($all_session_installments) ? $all_session_installments : [])->with('semester_year', 'semester_year_id')->with('fileHeader', $fileHeader)->with('installment_difference_total', $installment_difference_total)->with('transport_head_due_total', $transport_head_due_total)->with('transport_head_paid_total', $transport_head_paid_total)->with('fine_due_total', $fine_due_total)->with('fine_waived_total', $fine_waived_total)->with('fine_paid_total', $fine_paid_total);
            $view = $view->render();
            return response()->json(['success' => true, 'message' => count($reportData) > 0 ? 'Report Generated Successfully.' : 'No record found.', 'data' => $view], 200);
        } else {
            return response()->json(['success' => true, 'message' => 'No data found for this selections.', 'data' => ""], 200);
        }
    }

    public function getOverallClearanceSlip(Request $request)
    {
        return view('accounts.overallClearance.index_overall_clearance');
    }

    public function generateOverallClearanceSlip(Request $request)
    {
        // for ($i = 0; $i < 10; $i++) {
        //     response()->json(['true'], 200)->send();
        // }
        set_time_limit(9999);
        $heads_to_show = ['2' => 'Publications', '3' => 'Uniform', '4' => 'Student Card', '15' => 'Prospectus', '6' => 'Transportation', '7' => 'Test Session', '1' => 'Affiliated Body Registration', '1' => 'Affiliated Body Examination', '20' => 'Absent Fine', '30' => 'Exam Fail fine', '40' => 'Discipline Voilation Fine', '50' => 'UMC'];

        $student_query = Student::query();
        foreach ($request->all() as $key => $param) {
            if ($key != 'semester_year_id' && $key != '_token' && $key != 'start_month' && $key != 'end_month') {
                if (!is_null($param) && $param != '') {
                    $student_query->where($key, '=', $param);
                }
            }
        }
        $students = $student_query->where('is_end_of_reg', '=', 0)->orderBy('old_roll_no')->get();
        $combined_view = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
        <html lang="en">

        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title></title>

        <style type="text/css">
        body {
          margin: 0 auto;
          padding: 0;
          background-color:
        #fff;
          width: 98%;
          font-size: 13px
      }

      .font-200 {
          font-weight: 200;
      }

      .font-bold {
          font-weight: bold;
      }

      .m-0 {
          margin: 0px;
      }

      .m-10 {
          margin: 10px;
      }

      .m-t-0 {
          margin-top: 0px;
      }

      .m-b-0 {
          margin-bottom: 0px;
      }

      .m-t-5 {
          margin-top: 5px;
      }

      .m-b-5 {
          margin-bottom: 5px;
      }

      .m-b-10 {
          margin-bottom: 10px;
      }

      .m-t-10 {
          margin-top: 10px;
      }

      .headerleft {
          width: 20%;
          display: inline-block;
      }

      .headerleft h5 {
          text-align: left;
      }

      .headercenter {
          width: 55%;
          display: inline-block;
          text-align: center;
      }

      .headerright {
          width: 20%;
          display: inline-block;
          text-align: left;
      }

      .headerright h5 {
          text-align: left;
      }

      .headervalue {
          font-weight: 300;
      }

      .pdf-header-wrapper {
          margin-top: 15px;
          border:1px solid #000;
          padding:10px;
      }

      .clearenceslip {
          border: 1px solid #000;
          padding: 5px 5px;
          margin: 5px auto;
          margin-bottom: 5px;
          width: 160px;
      }


      .fee_package_tbl{
          margin-top:20px;
      }
      .left {
          float: left;
      }

      .right {
          float: right;
      }

      .overallSummary {
          width: 49%;
      }

      .feepackageDetail {
          width: 49%;
          /* margin-top: 19px; */
      }

      .studentDetailBody {
          margin-top: 10px;
      }

      .netFeeIns {
      // padding-top: 22px;
          clear: both;
      }

      .footer {
          padding-top: 22px;
          clear: both;
      }

      table tr th,
      table tr td {
          padding: 2px;
      }

      .otherHeads {
      // padding-top: 22px;
          clear: both;
      }
      .last_row td{
          padding-top: 14px;
          padding-bottom: 13px;
      }
      .last_row_transport_detail td{
          padding-top: 25px;
          padding-bottom: 25px;
      }
      .page-break { display: block; page-break-before: always; }
      .page-break-after { display: block; page-break-after: always; }
      @media print {
        .page-break { display: block; page-break-before: always; }
        .page-break-after { display: block; page-break-after: always; }

    }
    </style>
    </head>

    <body>';

        $start_month_start_date = Carbon::parse($request->get('start_month'))->startOfMonth()->format('Y-m-d');
        $end_month_end_date = Carbon::parse($request->get('end_month'))->endOfMonth()->format('Y-m-d');

        foreach ($students as $key => $student) {
            if (array_key_exists($request->semester_year_id, $student->studentAcademicHistories()->get())) {
                $student_academic_history = $student->studentAcademicHistories()->get('id')[$request->semester_year_id];
            } else {
                $student_academic_history = $student->studentAcademicHistories()->get('id')->last();
            }
            $academic_history_id = $student_academic_history->id;

            if ($student->profile_pic != null && $student->profile_pic != '') {
                $student->picture_pic_directory_url = asset(config('constants.attachment_path.student_qr_destination_path') . $student->roll_no . '/Profile_Pictures/' . $student->profile_pic);
            } else {
                $student->picture_pic_directory_url = asset('assets/images/users/dummy.png');
            }
            // $student_academic_histories = StudentAcademicHistory::where('student_id', '=', $student->id)->get();
            // $student->student_academic_histories = $student_academic_histories;
            $clearance_date = new \DateTime();
            $clearance_date = $clearance_date->format('l, d-M-Y');

            // ------------------------------------------------ Previous Academic Histories Calculation (OUTSTANDING BALANCE CALCULATIONS)
            $outstanding_balance = 0;
            $total_tution_fee = 0;
            $tution_fee_received = 0;
            $total_fine_on_instalment = 0;
            $total_fine_adjustment_on_instalment = 0;
            $total_installment_fine_paid = 0;
            $actual_fine_receivable = 0;
            $instalments = [];
            $over_due_till_today = 0;
            $over_due_heads_till_today = 0;
            foreach (config('constants.semesters_years') as $key => $value) {
                if ($key < $request->semester_year_id) {
                    if (array_key_exists($request->semester_year_id, $student->studentAcademicHistories()->get()->toArray())) {
                        $student_academic_history = $student->studentAcademicHistories()->get('id')[$key];
                    } else {
                        $student_academic_history = null;
                    }
                    if (!is_null($student_academic_history)) {
                        $fee_package = $student->feePackages()->where('academic_history_id', '=', $student_academic_history->id)->get();
                        $outstanding_balance = $outstanding_balance + $fee_package->last()->feePackageInstallments()->where('status_id', '=', 0)->sum('amount_per_installment');
                        $outstanding_balance = $outstanding_balance + ($fee_package->last()->feePackageInstallments()->where('status_id', '=', 2)->sum('amount_per_installment') - $fee_package->last()->feePackageInstallments()->where('status_id', '=', 2)->sum('paid_amount'));
                        \Log::info($student->student_name . ' - Instal - ' . $outstanding_balance);

                        $attendance_fines = $this->getAttenanceDetails($student->id, $student_academic_history->id);
                        $total_absent_days = 0;
                        $total_absent_days_fine = 0;
                        $total_absent_fine_remaining = 0;
                        foreach ($attendance_fines as $key => $fine) {
                            foreach ($fine['fine_nodes'] as $key => $node) {
                                if ($key == 0) {
                                    $total_absent_days_fine = $total_absent_days_fine + $node->amount;
                                    $total_absent_fine_remaining = $node->paid_date == null ? ($total_absent_fine_remaining + $node->amount) : 0;
                                } else {
                                    $total_absent_fine_remaining = $node->paid_date == null ? ($total_absent_fine_remaining + $node->amount) : 0;
                                }
                                $total_absent_days = $total_absent_days + $node->absent_count;
                            }
                        }
                        $outstanding_balance = $outstanding_balance + $total_absent_fine_remaining;
                        foreach ($fee_package->last()->feePackageInstallments()->get() as $key => $instalment) {

                            $due_date = new \DateTime($instalment->due_date);
                            $paid_date = new \DateTime($instalment->paid_date);
                            $remaining_paid_date = new \DateTime($instalment->remaining_balance_paid_date);
                            $diff = 0;
                            $current_date = new \DateTime();
                            if ($instalment->feeFines()->get()->count() > 0) {
                                foreach ($instalment->feeFines()->get() as $key => $fine) {
                                    $diff = date_diff($due_date, $paid_date != null ? $paid_date : $current_date);
                                    $diff = $diff->days + $diff->invert;
                                    // dd($diff);
                                    // $lateFine = ($diff);
                                    $instalment->late_fine_days_for = $diff;
                                    // $instalment->late_fee_fine = $fine->amount;
                                    $fine_adjustment_on_instalment = ($fine->paid_date != null ? ($fine->amount_waived) : 0);
                                    $total_fine_adjustment_on_instalment = $total_fine_adjustment_on_instalment + $fine_adjustment_on_instalment;

                                    $fine_on_instalment = ($fine->previous_reference == null ? $fine->amount : 0);
                                    $total_fine_on_instalment = $total_fine_on_instalment + $fine_on_instalment;

                                    $installment_fine_paid = ($fine->paid_date != null ? ($fine->amount - $fine->amount_waived - $fine->balance) : 0);
                                    $total_installment_fine_paid = $total_installment_fine_paid + $installment_fine_paid;

                                    $outstanding_balance = $outstanding_balance + ($fine_on_instalment - ($fine_adjustment_on_instalment + $installment_fine_paid));
                                    \Log::info($student->student_name . ' - Fine for ' . $instalment->amount_per_installment . ' - ' . $instalment->amount_per_installment . ' - ' . $outstanding_balance);
                                }

                            } else {

                                if ($instalment->status_id == 0) {
                                    if (!isset($instalment->late_fee_fine)) {

                                        if ($instalment->amount_per_installment > 1000 && $current_date > $due_date) {
                                            $late_fee_fine = $this->calculateFine($instalment->due_date);
                                            $diff = date_diff($due_date, $current_date);
                                            $diff = $diff->days + $diff->invert;
                                            // dd($diff);
                                            $lateFine = ($diff);
                                            $instalment->late_fine_days_for = $diff;
                                            $instalment->late_fee_fine = $late_fee_fine;
                                        } else {
                                            $instalment->late_fine_days_for = 0;
                                        }

                                        $fine_on_instalment = ($instalment->fine_paid_date == null ? $instalment->late_fee_fine : 0);
                                        $total_fine_on_instalment = ($total_fine_on_instalment + $fine_on_instalment);

                                        $installment_fine_paid = (($instalment->fine_paid_date != null ? $instalment->late_fee_fine : 0));
                                        $total_installment_fine_paid = ($total_installment_fine_paid + $installment_fine_paid);
                                    }

                                    $outstanding_balance = $outstanding_balance + ($fine_on_instalment - $installment_fine_paid);
                                    \Log::info($student->student_name . ' - Fine 2 - ' . $outstanding_balance);

                                } else if ($instalment->status_id == 1) {

                                    $installment_fine_paid = (($instalment->fine_paid_date != null ? $instalment->late_fee_fine : 0) + ($instalment->remaining_balance_late_fine != null ? ($instalment->remaining_balance_fine_paid_date != null ? $instalment->remaining_balance_late_fine : 0) : 0));

                                    $total_installment_fine_paid = ($total_installment_fine_paid + $installment_fine_paid);

                                    $fine_on_instalment = (($instalment->fine_paid_date == null ? $instalment->late_fee_fine : 0) + ($instalment->remaining_balance_late_fine != null ? ($instalment->remaining_balance_fine_paid_date == null ? $instalment->remaining_balance_late_fine : 0) : 0));

                                    $total_fine_on_instalment = ($total_fine_on_instalment + $fine_on_instalment);

                                    $fine_adjustment_on_instalment = ($instalment->fine_waived + ($instalment->remaining_balance_fine_waived != null ? $instalment->remaining_balance_fine_waived : 0));
                                    $total_fine_adjustment_on_instalment = ($total_fine_adjustment_on_instalment + $fine_adjustment_on_instalment);

                                    $outstanding_balance = $outstanding_balance + ($fine_on_instalment - ($fine_adjustment_on_instalment + $installment_fine_paid));
                                    \Log::info($student->student_name . ' - Fine 3 - ' . $outstanding_balance);

                                }
                            }
                        }

                        $outstanding_balance = $outstanding_balance + $student->headFineStudents()->where('academic_history_id', '=', $student_academic_history->id)->where('status_id', '=', 0)->sum('head_amount');
                        $outstanding_balance = $outstanding_balance + ($student->headFineStudents()->where('academic_history_id', '=', $student_academic_history->id)->where('status_id', '=', 2)->sum('head_amount') - $student->headFineStudents()->where('academic_history_id', '=', $student_academic_history->id)->where('status_id', '=', 2)->sum('remaining_balance'));

                    } else {
                        $outstanding_balance = 0;
                        \Log::info($student->student_name . ' - AH Not Found - ' . $outstanding_balance);
                    }
                }
            }
            // ------------------------------------------------ (OUTSTANDING BALANCE CALCULATIONS) ENDS HERE

            $attendance_fines = $this->getAttenanceDetails($student->id, $academic_history_id, $start_month_start_date, $end_month_end_date);
            $total_absent_days = 0;
            $total_absent_days_fine = 0;
            $total_absent_fine_remaining = 0;
            foreach ($attendance_fines as $key => $fine) {
                foreach ($fine['fine_nodes'] as $key => $node) {
                    if ($key == 0) {
                        $total_absent_days_fine = $total_absent_days_fine + $node->amount;
                        $total_absent_fine_remaining = $node->paid_date == null ? ($total_absent_fine_remaining + $node->amount) : 0;
                    } else {
                        $total_absent_fine_remaining = $node->paid_date == null ? ($total_absent_fine_remaining + $node->amount) : 0;
                    }
                    $total_absent_days = $total_absent_days + $node->absent_count;
                }
            }
            // dd($attendance_fines->toArray());
            $student->attendance_fines = $attendance_fines;
            $total_exam_fail_fine = 0;
            $total_subject_fail = 0;

            $exam_fine_array = [];
            $total_subject_fail = $student->dateSheetStudents->where('academic_history_id', '=', $academic_history_id)->where('status_id', '=', '1')->count();
            foreach ($student->dateSheetStudents->where('academic_history_id', '=', $academic_history_id)->where('status_id', '=', '1')->groupBy('date_sheet_id') as $key => $array) {
                $date_sheet = DateSheet::find($key);
                if (!empty($date_sheet)) {
                    $failure_subjects = DateSheetStudent::where('date_sheet_id', '=', $date_sheet->id)->where('student_id', '=', $student->id)->where('status_id', '=', '1')->get(['id', 'subject_id', 'status_id', 'date_sheet_id', 'student_id']);
                    $failure_fine_details = $this->getExamFineDetails($date_sheet->id, $student->id) /*ExamFine::where('date_sheet_id', '=', $date_sheet->id)->where('student_id', '=', $student->id)->get()*/;
                    $date_sheet = $date_sheet->toArray();
                    $date_sheet['failure_subjects'] = $failure_subjects->toArray();
                    $date_sheet['failure_fine_details'] = $failure_fine_details;

                    array_push($exam_fine_array, $date_sheet);
                    // dd($failure_fi   ne_details);
                    foreach ($failure_fine_details as $key => $detail) {
                        foreach ($detail['fine_nodes'] as $key => $node) {
                            if ($key == 0) {
                                $total_exam_fail_fine = $node['paid_date'] == null ? ($total_exam_fail_fine + $node['amount']) : ($total_exam_fail_fine + $node['balance']);
                            } else {
                                $total_exam_fail_fine = $total_exam_fail_fine + $node['balance'];
                            }
                        }
                    }
                }
            }
            $student->exam_fines = $exam_fine_array;

            $outstanding_clearance_section = $student->studentAcademicHistories()->where('id', '=', $academic_history_id)->get()->last();
            $fee_package = $student->feePackages()->where('academic_history_id', '=', $outstanding_clearance_section->id)->get();
            $total_tution_fee = 0;
            $tution_fee_received = 0;
            $total_fine_on_instalment = 0;
            $total_fine_adjustment_on_instalment = 0;
            $total_installment_fine_paid = 0;
            $actual_fine_receivable = 0;
            $instalments = [];
            $over_due_till_today = 0;
            $over_due_heads_till_today = 0;
            if (!$fee_package->isEmpty()) {
                $fee_package = $fee_package->last();

                $total_tution_fee = $fee_package->net_total;
                if ($fee_package->fee_structure_type_id == 0) {

                    if ($fee_package->status_id == 0) {
                        $tution_fee_received = 0;
                    } else {
                        $tution_fee_received = $total_tution_fee;
                    }
                } else {
                    $instalments = $fee_package->feePackageInstallments()->where('due_date', '>=', $start_month_start_date)->where('due_date', '<=', $end_month_end_date)->get();
                    $tution_fee_received = 0;
                    foreach ($instalments as $key => $instalment) {
                        $due_date = new \DateTime($instalment->due_date);
                        $paid_date = new \DateTime($instalment->paid_date);
                        $remaining_paid_date = new \DateTime($instalment->remaining_balance_paid_date);
                        $diff = 0;
                        $current_date = new \DateTime();

                        if ($instalment->status_id == 2) {
                            if ($due_date <= $current_date) {
                                $over_due_till_today = $over_due_till_today + $instalment->remaining_balance;
                            }
                        } else if ($instalment->status_id == 0) {

                            if ($due_date <= $current_date) {
                                $over_due_till_today = $over_due_till_today + $instalment->amount_per_installment;
                            }
                        }
                        if ($instalment->status_id == 2) {
                            $tution_fee_received = $tution_fee_received + ($instalment->amount_per_installment - $instalment->remaining_balance);
                        } else if ($instalment->status_id == 1) {
                            $tution_fee_received = $tution_fee_received + $instalment->amount_per_installment;
                        }

                        if ($instalment->feeFines()->get()->count() > 0) {
                            foreach ($instalment->feeFines()->get() as $key => $fine) {
                                $diff = date_diff($due_date, $paid_date != null ? $paid_date : $current_date);
                                $diff = $diff->days + $diff->invert;
                                // dd($diff);
                                // $lateFine = ($diff);
                                $instalment->late_fine_days_for = $diff;
                                // $instalment->late_fee_fine = $fine->amount;
                                $total_fine_adjustment_on_instalment = $total_fine_adjustment_on_instalment + ($fine->paid_date != null ? ($fine->amount_waived) : 0);
                                $total_fine_on_instalment = $total_fine_on_instalment + ($fine->previous_reference == null ? $fine->amount : 0);
                                $total_installment_fine_paid = $total_installment_fine_paid + ($fine->paid_date != null ? ($fine->amount - $fine->amount_waived - $fine->balance) : 0);
                            }

                        } else {

                            if ($instalment->status_id == 0) {
                                if (!isset($instalment->late_fee_fine)) {

                                    if ($instalment->amount_per_installment > 1000 && $current_date > $due_date) {
                                        $late_fee_fine = $this->calculateFine($instalment->due_date);
                                        $diff = date_diff($due_date, $current_date);
                                        $diff = $diff->days + $diff->invert;
                                        // dd($diff);
                                        $lateFine = ($diff);
                                        $instalment->late_fine_days_for = $diff;
                                        $instalment->late_fee_fine = $late_fee_fine;
                                    } else {
                                        $instalment->late_fine_days_for = 0;
                                    }

                                    $total_fine_on_instalment = ($total_fine_on_instalment + ($instalment->fine_paid_date == null ? $instalment->late_fee_fine : 0));

                                    $total_installment_fine_paid = ($total_installment_fine_paid + ($instalment->fine_paid_date != null ? $instalment->late_fee_fine : 0));}
                            } else if ($instalment->status_id == 1) {

                                $total_installment_fine_paid = ($total_installment_fine_paid + ($instalment->fine_paid_date != null ? $instalment->late_fee_fine : 0) + ($instalment->remaining_balance_late_fine != null ? ($instalment->remaining_balance_fine_paid_date != null ? $instalment->remaining_balance_late_fine : 0) : 0));

                                $total_fine_on_instalment = ($total_fine_on_instalment + ($instalment->fine_paid_date == null ? $instalment->late_fee_fine : 0) + ($instalment->remaining_balance_late_fine != null ? ($instalment->remaining_balance_fine_paid_date == null ? $instalment->remaining_balance_late_fine : 0) : 0));
                                $total_fine_adjustment_on_instalment = ($total_fine_adjustment_on_instalment + $instalment->fine_waived + ($instalment->remaining_balance_fine_waived != null ? $instalment->remaining_balance_fine_waived : 0));

                            }
                        }
                    }

                }
            }

            // dd($instalments->toArray());
            // dd($total_fine_adjustment_on_instalment  );
            $over_due_transport_till_today = 0;
            $total_transport_till_today = 0;
            $total_transport_paid_till_today = 0;
            $studentHeads = $student->headFineStudents()->where('academic_history_id', '=', $outstanding_clearance_section->id)->where('due_date', '>=', $start_month_start_date)->where('due_date', '<=', $end_month_end_date)->get();
            foreach ($studentHeads as $key => $head) {
                if ($head->head_id != 6 || $head->head_id != 48) {
                    if ($head->status_id == 0) {
                        $due_date = new \DateTime($head->due_date);
                        $current_date = new \DateTime();
                        // if ($due_date <= $current_date) {
                        $over_due_heads_till_today = $over_due_heads_till_today + ($head->head_amount != '' ? $head->head_amount : (!$head->headFine()->get()->isEmpty() ? $head->headFine()->get()->first()->amount : 0));
                        // }
                    }
                    if ($head->status_id == 2) {
                        $due_date = new \DateTime($head->due_date);
                        $current_date = new \DateTime();
                        // if ($due_date <= $current_date) {
                        $over_due_heads_till_today = $over_due_heads_till_today + ($head->remaining_balance);
                        // }
                    }
                }
            }
            foreach ($studentHeads as $key => $head) {
                if ($head->head_id == 6 || $head->head_id == 48) {
                    if ($head->status_id == 0) {
                        $due_date = new \DateTime($head->due_date);
                        $current_date = new \DateTime();
                        // if ($due_date <= $current_date) {
                        $over_due_transport_till_today = $over_due_transport_till_today + $head->head_amount;
                        // }
                    }
                    if ($head->status_id == 1) {
                        $due_date = new \DateTime($head->due_date);
                        $current_date = new \DateTime();
                        // if ($due_date <= $current_date) {
                        $total_transport_paid_till_today = $total_transport_paid_till_today + ($head->head_amount != '' ? $head->head_amount : (!$head->headFine()->get()->isEmpty() ? $head->headFine()->get()->first()->amount : 0));
                        // }
                    }
                    if ($head->status_id == 2) {
                        $due_date = new \DateTime($head->due_date);
                        $current_date = new \DateTime();
                        // if ($due_date <= $current_date) {
                        $over_due_transport_till_today = $over_due_transport_till_today + ($head->remaining_balance);
                        $total_transport_paid_till_today = $total_transport_paid_till_today + (($head->head_amount != '' ? $head->head_amount : (!$head->headFine()->get()->isEmpty() ? $head->headFine()->get()->first()->amount : 0) - $head->remaining_balance));
                        // }
                    }
                    $total_transport_till_today = $total_transport_till_today + ($head->head_amount);

                }
            }
            $outstanding_clearance_section->outstanding_balance = $outstanding_balance;
            $outstanding_clearance_section->over_due_till_today = $over_due_till_today;
            $outstanding_clearance_section->current_tution_fee = $total_tution_fee;
            $outstanding_clearance_section->over_due_heads_till_today = $over_due_heads_till_today;
            $outstanding_clearance_section->over_due_transport_till_today = $over_due_transport_till_today;
            $outstanding_clearance_section->total_transport_till_today = $total_transport_till_today;
            $outstanding_clearance_section->total_transport_paid_till_today = $total_transport_paid_till_today;
            $outstanding_clearance_section->tution_fee_received = $tution_fee_received;
            $outstanding_clearance_section->total_fine_on_instalment = $total_fine_on_instalment;
            $outstanding_clearance_section->total_fine_adjustment_on_instalment = $total_fine_adjustment_on_instalment;
            $outstanding_clearance_section->total_installment_fine_paid = $total_installment_fine_paid;
            $outstanding_clearance_section->total_absent_days = $total_absent_days;
            $outstanding_clearance_section->total_absent_days_fine = $total_absent_days_fine;
            $outstanding_clearance_section->total_absent_fine_remaining = $total_absent_fine_remaining;
            $outstanding_clearance_section->total_exam_fail_fine = $total_exam_fail_fine;
            $outstanding_clearance_section->total_subject_fail = $total_subject_fail;

            $student_package = ['student' => $student];

            // $html = \View::make('accounts.detail_summary', $student_package)->render();
            // $pdf = \PDF::loadHTML($html);
            // return $pdf->stream();
            $view = view('accounts.overallClearance.clearance_slip')->with(['student' => $student, 'fee_package' => $fee_package, 'outstanding_clearance_section' => $outstanding_clearance_section, 'student_heads' => $studentHeads, 'instalments' => $instalments, 'clearance_date' => $clearance_date, 'heads_to_show' => $heads_to_show, 'year_count' => config('constants.semesters_years')[$request->semester_year_id]]);
            $view = $view->render();
            $combined_view = $combined_view . $view;
        }
        $combined_view = $combined_view . '</body></html>';
        $pdf = PDF::loadHTML($combined_view);
        return $pdf->download('Overall Clearance Slip.pdf');
    }

    public function payFeePackage(Request $request, FeePackage $feePackage)
    {
        try {
            \DB::beginTransaction();
            if (isset($request->voucher_code) && isset($request->paid_date)) {
                $feePackage->status_id = 1;
                $feePackage->status_name = config('constants.payment_statuses')[1];
                $feePackage->paid_date = $request->paid_date;
                $feePackage->voucher_code = $request->voucher_code;
                $feePackage->update();
                Notify::success('Student Fee Package Paid Successfully', 'Success');
            } else {
                Notify::warning('Something went wrong!', 'Please Try Again');
            }
            \DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            \DB::rollback();
            if ($e->getCode() != 0) {
                if (in_array(1062, $e->errorInfo)) {
                    $exception_message = str_replace('admissions_', '', $e->errorInfo[2]);
                    $replaced_message = str_replace('_unique', '', $exception_message);
                    $message = str_replace('key', '', $replaced_message);
                    Notify::warning($message, 'Warning');
                    return redirect()->back();
                } else {
                    Notify::warning($message, 'Warning');
                    return redirect()->back();
                }
            } else {
                $exception_message = $e->getMessage();
                $exception_message_semi_col_split = explode(":", $exception_message);
                $message = 'Something went wrong at ' . '"' . str_replace(' ', '', str_replace('_', '-', $exception_message_semi_col_split[1])) . '"';
                Notify::warning($message, 'Warning');
                return redirect()->back();
            }
        }
    }

    public function verifyFeePackagePayment(Request $request, FeePackage $feePackage)
    {
        if ($feePackage->fee_structure_type_id == 0 && $feePackage->status_id == 1 && $feePackage->is_verified == 0) {
            $feePackage->is_verified = true;
            $feePackage->verified_by = \Auth::user()->name;
            $feePackage->update();
        }
        Notify::success('Payment is verified successfully!', 'Success');
        return redirect()->back();
    }

}
