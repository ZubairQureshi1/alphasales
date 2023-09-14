<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\FeePackage;
use App\Models\FeePackageInstallment;
use App\Models\FeeVoucher;
use App\Models\HeadFine;
use App\Models\HeadFineStudent;
use App\Models\Student;
use Illuminate\Http\Request;
use response;

class AccountAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $input = $request->all();

        // $post=FeePackage::where('student_id','=',$input['id'])->get();

        //    return $post;
    }

    public function getPost(Request $request)
    {
        $input = $request->all();
        \Log::info($input);
        $post = FeePackage::where('student_id', '=', $input['id'])->get();
        return $post;
    }

    public function postData(Request $request)
    {
        $input = $request->all();
        \Log::info($input);
        $post = FeePackageInstallment::where('package_id', '=', $input['fee'])->get();
        return $post;
    }

    public function getFeePackage(Request $request)
    {
        // $input = $request->all();
        $package = FeePackage::find(1);
        // dd($package);
        return $package;

    }

    public function getFeeStatus()
    {
        $discount_statuses = config('constants.discount_statuses');
        return response()->json(['discount_statuses' => $discount_statuses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function packageSet(Request $request)
    {
        try {
            \DB::beginTransaction();
            $input = $request->all();
            \Log::info($input);
            // dd($input);
            $input['status_name'] = config('constants.payment_statuses')[0];
            $input['status_id']   = 0;

            $headfine = new HeadFineStudent();

            $discount_status = config('constants.discount_statuses');
            $discount_status_name;

            for ($i = 0; $i < sizeof($discount_status); $i++) {
                if ($i == $input['discount_status_id']) {
                    $discount_status_name = $discount_status[$i];
                }
            }
            $student = Student::find($input['student_id']);
            \Log::info($student);
            $academicHistoryArray = $student->studentAcademicHistories()->get()->last();
            // dd($academicHistoryArray[sizeof($academicHistoryArray) - 1]['id']);

            $fee_package = new FeePackage();
            //dd($input);
            foreach ($input as $key => $value) {
                if ($key != '_token' && $key != 'heads') {
                    $fee_package->$key = $value;
                }
            }
            $fee_package->academic_history_id   = $academicHistoryArray['id'];
            $fee_package->discount_status       = $discount_status_name;
            $fee_package->fee_structure_type_id = 0;
            $fee_package->fee_structure_type    = config('constants.fee_structure_types')[0];
            $fee_package->user_name             = $input['user_name'];
            $fee_package->user_id               = $input['user_id'];
            $fee_package->save();

            $voucher                  = FeeVoucher::get();
            $vouchers_count           = sizeof($voucher);
            $newVoucher               = new FeeVoucher();
            $voucher_code             = sprintf('%07d', intval($vouchers_count) + 1);
            $newVoucher->voucher_code = $voucher_code;
            $newVoucher->package_id   = $fee_package->id;
            $newVoucher->save();
            $fee_package->voucher_id   = $newVoucher->id;
            $fee_package->voucher_code = $voucher_code;
            $fee_package->update();

            if (isset($input['heads'])) {
                for ($i = 0; $i < sizeof($input['heads']); $i++) {

                    $headfine             = new HeadFineStudent();
                    $headfine->head_id    = $input['heads'][$i];
                    $headfine->student_id = $input['student_id'];
                    dd($headfine->student_id);
                    $headfine->status_name  = $input['status_name'];
                    $headfine->status_id    = $input['status_id'];
                    $headfine->package_id   = $fee_package->id;
                    $headfine->voucher_code = $voucher_code;
                    $headfine->due_date     = $input['due_date'];
                    $headfine->user_name    = \Auth::user()->name;
                    $headfine->user_id      = \Auth::user()->id;
                    $headfine->save();

                    $voucher                          = FeeVoucher::get();
                    $number                           = sizeof($voucher);
                    $newVoucher                       = new FeeVoucher();
                    $voucher_code                     = sprintf('%07d', intval($number) + 1);
                    $newVoucher->voucher_code         = $voucher_code;
                    $newVoucher->head_fine_student_id = $headfine->id;
                    $newVoucher->save();
                }
            }
            \DB::commit();
            return response()->json(['success' => true], 200);

        } catch (\Exception $e) {
            \Log::info($e);
            \DB::rollback();
            return response(json(['success' => false], 500));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function deletePackage(Request $request)
    {

        try {
            \DB::beginTransaction();
            $input = $request->all();
            \Log::info($input);
            $package = FeePackage::find($input['package_id']);
            $package->delete();
            // dd($students->first()->feePackages);
            \DB::commit();
            return response()->json(['success' => true], 200);

        } catch (\Exception $e) {
            \Log::info($e);
            \DB::rollback();
            return response(json(['success' => false], 500));
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
            $installment->package_id             = $input['package_id'];
            $installment->status_id              = $input['status_id'];
            $installment->status_name            = $input['status_name'];
            $installment->due_date               = $input['due_date'];
            $installment->user_name              = $input['user_name'];
            $installment->user_id                = $input['user_id'];
            // $installment->voucher_code = $input['voucher_code'];
            $installment->save();
            $feePackage                        = FeePackage::find($input['package_id']);
            $feePackage->fee_structure_type_id = 1;
            $feePackage->fee_structure_type    = config('constants.fee_structure_types')[1];
            $feePackage->update();
            \DB::commit();
            return response()->json(['success' => true], 200);

        } catch (\Exception $e) {
            \DB::rollback();
            return response(json(['success' => false], 500));
        }
    }

    public function edit_installment(Request $request)
    {
        try {
            \DB::beginTransaction();
            $input = $request->all();
            \Log::info($input);
            $installment = FeePackageInstallment::find($input['id']);

            $installment->due_date = $input['due_date'];

            $installment->amount_per_installment = $input['amount_per_installment'];
            // $installment->voucher_code = $input['voucher_code'];
            $installment->update();

            \DB::commit();
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            \DB::rollback();
            return response(json(['success' => false], 500));
        }

    }

    public function deleteInstalment(Request $request)
    {

        try {
            \DB::beginTransaction();
            $input              = $request->all();
            $package_instalment = FeePackageInstallment::find($input['instalment_id']);
            $package_instalment->delete();
            // dd($students->first()->feePackages);
            \DB::commit();
            return response()->json(['success' => true], 200);

        } catch (\Exception $e) {
            dd($e);
            \DB::rollback();
            return response(json(['success' => false], 500));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function installment_paid(Request $request)
    {
        try {
            \DB::beginTransaction();
            $input = $request->all();
            \Log::info($input);
            $student = Student::find($input['student_id']);
            $date    = date("d/m/Y");

            $installment = FeePackageInstallment::find($input['instalment_id']);

            $installment->is_carry_forward = $input['is_carry_forward'];
            if ($installment->status_id == 0) {

                $installment->voucher_code = $input['voucher_code'];

                $voucher                 = new FeeVoucher();
                $voucher->voucher_code   = $input['voucher_code'];
                $voucher->installment_id = $installment->id;
                $voucher->save();
                $installment->voucher_id = $voucher->id;
            }

            $totalAmount = (int) $input['total_amount'];
            $amountPaid  = (int) $input['amount_paid'];
            if ($input['late_fee_fine_voucher_code'] != null && $input['late_fee_fine_voucher_code'] != '') {
                $difference = $totalAmount - $amountPaid;
            } else {
                if ($installment->status_id == 2) {
                    $difference = $installment->remaining_balance - $amountPaid;
                } else {
                    $difference = $installment->amount_per_installment - $amountPaid;
                }
            }

            if ($installment->status_id == "2") {
                // dd($input);
                $fine                                        = (int) $input['lateFine'];
                $fine2                                       = (int) $installment->late_fee_fine;
                $paid                                        = (int) $installment->amount_per_installment;
                $remaining                                   = (int) $installment->remaining_balance;
                $total                                       = $remaining + $fine;
                $installment->remaining_balance_late_fine    = $input['lateFine'];
                $installment->remaining_balance_paid_date    = $input['paid_date'];
                $installment->remaining_balance_paid_amount  = $input['amount_paid'];
                $installment->status_id                      = $input['status_id'];
                $installment->status_name                    = $input['status_name'];
                $installment->remaining_balance_voucher_id   = $input['voucher_code'];
                $installment->r_b_late_fee_fine_voucher_code = $input['late_fee_fine_voucher_code'];
                $installment->remaining_balance_fine_waived  = $input['fine_waived'];
                $installment->total_remaining_balance        = $total;
                $installment->total_amount_collected         = ($paid + $fine + $fine2);
                $installment->payment_verification           = false;

            } else {
                $installment->paid_date                  = $input['paid_date'];
                $installment->late_fee_fine              = $input['lateFine'];
                $installment->amount_with_fine           = $input['amount_per_installment'] + $input['lateFine'];
                $installment->late_fee_fine_voucher_code = $input['late_fee_fine_voucher_code'];
                $installment->fine_waived                = $input['fine_waived'];
                $installment->paid_amount                = $input['amount_paid'];
                $installment->payment_verification       = false;

            }
            if ($difference <= 0) {
                $installment->status_id   = $input['status_id'];
                $installment->status_name = $input['status_name'];

            } else {

                $installment->status_id         = "2";
                $installment->status_name       = config('constants.payment_statuses')[2];
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
                            $instalment->paid_date     = $input['paid_date'];
                            $lateFine                  = 0;
                            $paid_date                 = date_create($input['paid_date']);
                            $due_date_obj              = date_create($instalment->due_date);
                            if ($paid_date > $due_date_obj && $instalment->amount_per_installment > 1000) {
                                $diff = date_diff($due_date_obj, $paid_date);
                                $diff = $diff->days + $diff->invert;
                                // dd($diff);
                                $lateFine = ($diff * 25);
                            }

                            $instalment->late_fee_fine    = $lateFine;
                            $instalment->amount_with_fine = ((int) $instalment->amount_per_installment + (int) $lateFine);
                            $instalment->paid_amount      = $remaining_amount;
                            if ($input['late_fee_fine_voucher_code'] != null && $instalment->paid_amount >= $instalment->amount_with_fine) {
                                if ($installment->status_id == "2") {
                                    // dd($input);
                                    $fine                                        = (int) $input['lateFine'];
                                    $fine2                                       = (int) $installment->late_fee_fine;
                                    $paid                                        = (int) $installment->amount_per_installment;
                                    $remaining                                   = (int) $installment->remaining_balance;
                                    $total                                       = $remaining + $fine;
                                    $installment->remaining_balance_late_fine    = $input['lateFine'];
                                    $installment->remaining_balance_paid_date    = $input['paid_date'];
                                    $installment->remaining_balance_paid_amount  = $remaining_amount;
                                    $instalment->status_id                       = "1";
                                    $instalment->status_name                     = config('constants.payment_statuses')[1];
                                    $installment->remaining_balance_voucher_id   = $input['voucher_code'];
                                    $installment->r_b_late_fee_fine_voucher_code = $input['late_fee_fine_voucher_code'];
                                    $installment->remaining_balance_fine_waived  = $input['fine_waived'];
                                    $installment->total_remaining_balance        = $total;
                                    $installment->total_amount_collected         = ($paid + $fine + $fine2);
                                    $remaining_amount                            = (int) $remaining_amount - (int) $total;
                                    $installment->payment_verification           = false;

                                } else {
                                    $instalment->status_id                  = "1";
                                    $instalment->status_name                = config('constants.payment_statuses')[1];
                                    $instalment->paid_date                  = $input['paid_date'];
                                    $instalment->late_fee_fine              = $input['lateFine'];
                                    $instalment->amount_with_fine           = $input['amount_per_installment'] + $input['lateFine'];
                                    $instalment->late_fee_fine_voucher_code = $input['late_fee_fine_voucher_code'];
                                    $instalment->fine_waived                = $input['fine_waived'];
                                    $instalment->paid_amount                = $remaining_amount;
                                    $instalment->payment_verification       = false;
                                    $remaining_amount                       = (int) $remaining_amount - (int) $instalment->amount_with_fine;
                                    $instalment->voucher_code               = $input['voucher_code'];
                                    $instalment->voucher_id                 = $installment->voucher_code;
                                }

                            } else if ($input['late_fee_fine_voucher_code'] == null && $instalment->paid_amount >= $instalment->amount_per_installment) {
                                if ($installment->status_id == "2") {
                                    // dd($input);
                                    $fine                                        = (int) $input['lateFine'];
                                    $fine2                                       = (int) $installment->late_fee_fine;
                                    $paid                                        = (int) $installment->amount_per_installment;
                                    $remaining                                   = (int) $installment->remaining_balance;
                                    $total                                       = $remaining + $fine;
                                    $installment->remaining_balance_late_fine    = $input['lateFine'];
                                    $installment->remaining_balance_paid_date    = $input['paid_date'];
                                    $installment->remaining_balance_paid_amount  = $remaining_amount;
                                    $instalment->status_id                       = "1";
                                    $instalment->status_name                     = config('constants.payment_statuses')[1];
                                    $installment->remaining_balance_voucher_id   = $input['voucher_code'];
                                    $installment->r_b_late_fee_fine_voucher_code = $input['late_fee_fine_voucher_code'];
                                    $installment->remaining_balance_fine_waived  = $input['fine_waived'];
                                    $installment->total_remaining_balance        = $total;
                                    $installment->total_amount_collected         = ($paid + $fine + $fine2);
                                    $remaining_amount                            = (int) $remaining_amount - (int) $remaining;
                                    $installment->payment_verification           = false;

                                } else {
                                    $instalment->paid_date                  = $input['paid_date'];
                                    $instalment->late_fee_fine              = $input['lateFine'];
                                    $instalment->amount_with_fine           = $input['amount_per_installment'] + $input['lateFine'];
                                    $instalment->late_fee_fine_voucher_code = $input['late_fee_fine_voucher_code'];
                                    $instalment->fine_waived                = $input['fine_waived'];

                                    $instalment->paid_amount          = $remaining_amount;
                                    $instalment->payment_verification = false;
                                    $instalment->status_id            = "1";
                                    $instalment->status_name          = config('constants.payment_statuses')[1];
                                    $remaining_amount                 = (int) $remaining_amount - (int) $instalment->amount_per_installment;
                                    $instalment->voucher_code         = $input['voucher_code'];
                                    $instalment->voucher_id           = $installment->voucher_code;
                                }

                            } else {
                                $instalment->status_id         = "2";
                                $instalment->status_name       = config('constants.payment_statuses')[2];
                                $instalment->remaining_balance = ((int) $instalment->amount_with_fine - (int) $remaining_amount);
                                $remaining_amount              = 0;
                            }

                            $instalment->update();
                            // dd($installment2);
                        }
                    }
                }
            }

            $installment->update();
            \DB::commit();
            return response()->json(['success' => true], 200);

        } catch (\Exception $e) {
            dd($e);
            \DB::rollback();
            return response()->json(['success' => false], 500);
        }

    }
    /////////////////////////////////////////////
    public function payInstalmentFine(Request $request)
    {
        $input      = $request->all();
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
        // return response()->json(['success' => true], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getHeadsName(Request $request)
    {

        $heads = HeadFine::get()->all();
        // where('name')->get()->all();
        return $heads;
    }

    public function addFines(Request $request)
    {
        try {
            \DB::beginTransaction();

            $input = $request->all();

            $fine = new Fine();

            $voucher      = FeeVoucher::get();
            $newVoucher   = new FeeVoucher;
            $number       = sizeof($voucher);
            $voucher_code = sprintf('%07d', intval($number) + 1);

            $fine->name         = $input['name'];
            $fine->amount       = $input['amount'];
            $fine->due_date     = $input['due_date'];
            $fine->status_name  = $input['status_name'];
            $fine->status_id    = $input['status_id'];
            $fine->student_id   = $input['student_id'];
            $fine->course_id    = $input['course_id'];
            $fine->voucher_code = $voucher_code;

            $fine->save();

            $newVoucher->voucher_code = $voucher_code;
            $newVoucher->fine_id      = $fine->id;
            $newVoucher->save();

            \DB::commit();
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['success' => false], 500);
        }

    }
    ///////////////////////////////////////////////////////////////////////////
    public function head_paid(Request $request, $id)
    {
        try {
            \DB::beginTransaction();

            $input = $request->all();
            \Log::info($input);
            // dd(config('voucher_status')[0]);

            $date = date("d-m-Y");
            // dd($date);

            $headFine = HeadFineStudent::find($id);

            $headFine->voucher_code = $input['voucher_code'];

            $headFine->paid_date        = $input['paid_date'];
            $headFine->is_carry_forward = $input['is_carry_forward'];

            if ($headFine->status_id == 0) {
                $voucher = FeeVoucher::where('head_fine_student_id', '=', $id)->first();

                $voucher->voucher_code = $input['voucher_code'];
                $voucher->update();

            }

            $totalAmount = (int) $input['total_amount'];
            $amountPaid  = (int) $input['amount_paid'];
            $difference  = $totalAmount - $amountPaid;
            // dd($difference);

            if ($headFine->status_id == 2) {
                // dd($input);
                $fine  = (int) $input['lateFine'];
                $fine2 = (int) $headFine->late_fee_fine;
                if ($headFine->amount_after_discount == null || $headFine->amount_after_discount == '') {
                    $paid = (int) $headFine->headFine()->get()->first()->amount;
                } else {
                    $paid = (int) $headFine->amount_after_discount;

                }
                $remaining                              = (int) $headFine->remaining_balance;
                $total                                  = $remaining + $fine;
                $headFine->remaining_balance_late_fine  = $input['lateFine'];
                $headFine->remaining_balance_paid_date  = $input['paid_date'];
                $headFine->status_id                    = $input['status_id'];
                $headFine->status_name                  = $input['status_name'];
                $headFine->remaining_balance_voucher_id = $input['voucher_code'];
                $headFine->total_remaining_balance      = $total;
                $headFine->total_amount_collected       = ($paid + $fine + $fine2);

            } else {
                // dd('here in else of status 2');
                $headFine->paid_date        = $input['paid_date'];
                $headFine->late_fee_fine    = $input['lateFine'];
                $headFine->amount_with_fine = $input['total_amount'];
                $headFine->paid_amount      = $input['amount_paid'];

            }
            if ($difference <= 0) {
                $headFine->status_id   = $input['status_id'];
                $headFine->status_name = $input['status_name'];

            } else {

                $headFine->status_id         = "2";
                $headFine->status_name       = config('constants.payment_statuses')[2];
                $headFine->remaining_balance = $difference;
            }

            //     dd($headFine->status_id);
            $headFine->update();

            if ($headFine->is_carry_forward == "true") {
                $headFine2 = HeadFineStudent::find($id + 1);
                if ($headFine2 != null) {
                    $headFine2->carry_forward = $input['carry_forward'];
                    $headFine2->paid_date     = $input['paid_date'];
                    $lateFine                 = 0;
                    $paid_date                = date_create($input['paid_date']);
                    $due_date_obj             = date_create($headFine2->due_date);
                    $headFine2->late_fee_fine = $lateFine;
                    if ($headFine2->amount_after_discount == null || $headFine2->amount_after_discount == '') {
                        $amount                      = (int) $headFin2->headFine()->get()->first()->amount;
                        $headFine2->amount_with_fine = ((int) $amount + (int) $lateFine);
                    } else {
                        $headFine2->amount_with_fine = ((int) $headFine2->amount_after_discount + (int) $lateFine);
                    }
                    $headFine2->paid_amount = $input['carry_forward'];
                    if ($headFine2->amount_after_discount == null || $headFine2->amount_after_discount == '') {
                        $amount = (int) $headFine2->headFine()->get()->first()->amount;

                        if ($headFine2->paid_amount >= $amount) {
                            $headFine2->status_id   = "1";
                            $headFine2->status_name = config('constants.payment_statuses')[1];
                        } else {
                            $headFine2->status_id         = "2";
                            $headFine2->status_name       = config('constants.payment_statuses')[2];
                            $headFine2->remaining_balance = ((int) $amount - (int) $input['carry_forward']);
                        }

                    } else {

                        if ($headFine2->paid_amount >= $headFine2->amount_after_discount) {
                            $headFine2->status_id   = "1";
                            $headFine2->status_name = config('constants.payment_statuses')[1];
                        } else {
                            $headFine2->status_id         = "2";
                            $headFine2->status_name       = config('constants.payment_statuses')[2];
                            $headFine2->remaining_balance = ((int) $headFine2->amount_after_discount - (int) $input['carry_forward']);
                        }
                    }
                    dd($headFine2);
                    $headFine2->update();

                }
            }

            \DB::commit();
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            dd($e);
            \DB::rollback();
            return response()->json(['success' => false], 500);
        }
    }
    ////////////////////////////////////////////////////////////////////////////
    public function update_headFine(Request $request)
    {
        try {
            \DB::beginTransaction();

            $input = $request->all();
            \Log::info($input);
            $input['heads'] = json_decode($input['heads']);
            // dd($input['heads']);

            for ($i = 0; $i < sizeof($input['heads']); $i++) {

                $voucher      = FeeVoucher::get();
                $number       = sizeof($voucher);
                $voucher_code = sprintf('%07d', intval($number) + 1);
                $head         = $input['heads'][$i];
                // dd($head);
                $head_fine_Student_obj = ['student_id' => $head->student_id, 'head_id' => $head->head_id, 'status_name' => $head->status_name, 'status_id' => $head->status_id, 'package_id' => $head->package_id, 'due_date' => $head->due_date, 'discount_in_amount' => $head->discount_in_amount, 'head_amount' => $head->head_amount, 'discount_in_percentage' => $head->discount_in_percentage, 'amount_after_discount' => $head->amount_after_discount, 'voucher_code' => $voucher_code, 'user_name' => $head->user_name, 'user_id' => $head->user_id];

                $headfine = HeadFineStudent::create($head_fine_Student_obj);

                $newVoucher                       = new FeeVoucher;
                $newVoucher->voucher_code         = $voucher_code;
                $newVoucher->head_fine_student_id = $headfine->id;
                $newVoucher->save();

                \DB::commit();
            }
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            dd($e);
            \DB::rollback();
            return response()->json(['success' => false], 500);
        }

    }
    ///////////////////////////////////////
    public function deleteHeads($id)
    {
        try {
            \DB::beginTransaction();
            $feeVoucher = FeeVoucher::where('head_fine_student_id', '=', $id)->get()->first();
            $feeVoucher->delete();
            $headFineStudent = HeadFineStudent::find($id);
            // dd($id);

            $headFineStudent->delete();

            \DB::commit();
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['success' => false], 500);
        }

    }
}
