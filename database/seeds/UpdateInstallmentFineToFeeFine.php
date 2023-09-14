<?php

use App\Models\FeeFine;
use App\Models\FeeFineVoucher;
use App\Models\FeePackageInstallment;
use Illuminate\Database\Seeder;

class UpdateInstallmentFineToFeeFine extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $installments = FeePackageInstallment::get();
        foreach ($installments as $key => $installment) {
            $status = $installment->status_id;
            if ($status == '1') {
                $remaining_balance = $installment->remaining_balance;
                if ($remaining_balance == null) {
                    \Log::info($installment);
                    $late_fee_fine = $installment->late_fee_fine;
                    if ($late_fee_fine != null && $late_fee_fine != '0') {
                        $fine_paid_date = $installment->fine_paid_date;
                        if ($fine_paid_date == null) {
                            $fee_fine = new FeeFine();
                            $fee_fine->amount = $late_fee_fine;
                            $fee_fine->installment_id = $installment->id;
                            $fee_fine->save();
                        }
                        if ($fine_paid_date != null) {
                            $fee_fine = new FeeFine();
                            $fee_fine->amount = $late_fee_fine;
                            $fee_fine->amount_waived = $installment->fine_waived;
                            $fee_fine->amount_after_waived = (int) $installment->late_fee_fine - (int) $installment->fine_waived;
                            $fee_fine->installment_id = $installment->id;
                            $fee_fine->voucher_number = $installment->late_fee_fine_voucher_code;
                            $fee_fine->paid_amount = (int) $installment->late_fee_fine - (int) $installment->fine_waived;
                            $fee_fine->paid_date = $installment->fine_paid_date;
                            $fee_fine->save();
                            $this->generateVoucher($fee_fine);
                        }
                    }
                } else if ($remaining_balance != null) {
                    $late_fee_fine = $installment->late_fee_fine;
                    if ($late_fee_fine != null && $late_fee_fine != '0') {
                        $fine_paid_date = $installment->fine_paid_date;
                        if ($fine_paid_date == null) {
                            $fee_fine = new FeeFine();
                            $fee_fine->amount = $late_fee_fine;
                            $fee_fine->installment_id = $installment->id;
                            $fee_fine->save();
                        }
                        if ($fine_paid_date != null) {
                            $fee_fine = new FeeFine();
                            $fee_fine->amount = $late_fee_fine;
                            $fee_fine->installment_id = $installment->id;
                            $fee_fine->amount_waived = $installment->fine_waived;
                            $fee_fine->amount_after_waived = (int) $installment->late_fee_fine - (int) $installment->fine_waived;
                            $fee_fine->voucher_number = $installment->late_fee_fine_voucher_code;
                            $fee_fine->paid_amount = (int) $installment->late_fee_fine - (int) $installment->fine_waived;
                            $fee_fine->paid_date = $installment->fine_paid_date;
                            $fee_fine->save();
                            $this->generateVoucher($fee_fine);
                        }
                    }
                    $remaining_balance_late_fine = $installment->remaining_balance_late_fine;
                    if ($remaining_balance_late_fine != null && $remaining_balance_late_fine != '0') {
                        $fine_paid_date = $installment->fine_paid_date;
                        if ($fine_paid_date == null) {
                            $fee_fine = new FeeFine();
                            $fee_fine->amount = $remaining_balance_late_fine;
                            $fee_fine->installment_id = $installment->id;
                            $fee_fine->save();
                        }
                        if ($fine_paid_date != null) {
                            $fee_fine = new FeeFine();
                            $fee_fine->amount = $remaining_balance_late_fine;
                            $fee_fine->installment_id = $installment->id;
                            $fee_fine->amount_waived = $installment->remaining_balance_fine_waived;
                            $fee_fine->amount_after_waived = (int) $remaining_balance_late_fine - (int) $installment->remaining_balance_fine_waived;
                            $fee_fine->voucher_number = $installment->r_b_late_fee_fine_voucher_code;
                            $fee_fine->paid_amount = $fee_fine->amount_after_waived;
                            $fee_fine->paid_date = $installment->remaining_balance_fine_paid_date;
                            $fee_fine->save();
                            $this->generateVoucher($fee_fine);
                        }
                    }
                }
            } else if ($status == '2') {
                \Log::info($installment);
                $late_fee_fine = $installment->late_fee_fine;
                if ($late_fee_fine != null && $late_fee_fine != '0') {
                    $fine_paid_date = $installment->fine_paid_date;
                    if ($fine_paid_date == null) {
                        $fee_fine = new FeeFine();
                        $fee_fine->amount = $late_fee_fine;
                        $fee_fine->installment_id = $installment->id;
                        $fee_fine->save();
                    }
                    if ($fine_paid_date != null) {
                        $fee_fine = new FeeFine();
                        $fee_fine->amount = $late_fee_fine;
                        $fee_fine->installment_id = $installment->id;
                        $fee_fine->amount_waived = $installment->fine_waived;
                        $fee_fine->amount_after_waived = (int) $installment->late_fee_fine - (int) $installment->fine_waived;
                        $fee_fine->voucher_number = $installment->late_fee_fine_voucher_code;
                        $fee_fine->paid_amount = (int) $installment->late_fee_fine - (int) $installment->fine_waived;
                        $fee_fine->paid_date = $installment->fine_paid_date;
                        $fee_fine->save();
                        $this->generateVoucher($fee_fine);
                    }
                }
            }
        }
    }

    public function generateVoucher($fee_fine)
    {
        $fee_fine_voucher = new FeeFineVoucher();
        $fee_fine_voucher->fee_fine_id = $fee_fine->id;
        $fee_fine_voucher->voucher_code = $fee_fine->voucher_number;
        $fee_fine_voucher->save();

        $fee_fine->fee_voucher_id = $fee_fine_voucher->id;
        $fee_fine->update();
    }
}
