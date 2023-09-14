<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAndUpdateColsForFeePackageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fee_packages', function (Blueprint $table) {
            // column renaming
            $table->renameColumn('admission_fee', 'cfe_admission_fee');
            $table->renameColumn('net_total', 'net_tuition_fee');
            $table->renameColumn('tution_fee', 'tuition_fee');

            // drop column
            $table->dropColumn('total_tution_fee');

            // new column addition
            $table->string('marketer_incentive')->nullable()->after('due_date');
            $table->string('registration_fee')->nullable()->after('marketer_incentive');
            $table->string('transport_month_count')->nullable();
            $table->string('transport_monthly_amount')->nullable();
            $table->string('total_transport_charges')->nullable();
            $table->string('miscellaneous_charges')->nullable();
            $table->string('other_charges')->nullable();
        });

        Schema::table('fee_packages', function (Blueprint $table) {
            $table->string('total_admission_registration_fee')->nullable()->after('cfe_admission_fee');
            $table->string('admission_registration_voucher_code')->nullable()->after('total_admission_registration_fee');
            $table->string('admission_registration_paid_date')->nullable()->after('admission_registration_voucher_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fee_packages', function (Blueprint $table) {
            // column renaming reverting
            $table->renameColumn('cfe_admission_fee', 'admission_fee');
            $table->renameColumn('net_tuition_fee', 'net_total');
            $table->renameColumn('tuition_fee', 'tution_fee');

            // drop column reverting
            $table->string('total_tution_fee')->nullable();

            // new column addition reverting
            $table->dropColumn('marketer_incentive');
            $table->dropColumn('registration_fee');
            $table->dropColumn('total_admission_registration_fee');
            $table->dropColumn('admission_registration_voucher_code');
            $table->dropColumn('admission_registration_paid_date');
            $table->dropColumn('transport_month_count');
            $table->dropColumn('transport_monthly_amount');
            $table->dropColumn('total_transport_charges');
            $table->dropColumn('miscellaneous_charges');
            $table->dropColumn('other_charges');
        });
    }
}
