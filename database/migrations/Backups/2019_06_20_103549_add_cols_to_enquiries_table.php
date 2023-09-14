<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsToEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enquiries', function (Blueprint $table) {
            $table->string('father_cell_no')->nullable();
            $table->string('student_cell_no')->nullable();
            $table->string('gaurdian_cell_no')->nullable();
            $table->string('other_cell_no')->nullable();
            $table->string('present_address')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('reference_name')->nullable();
            $table->integer('reference_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enquiries', function (Blueprint $table) {
            $table->dropColumn(['father_cell_no', 'student_cell_no', 'gaurdian_cell_no', 'other_cell_no', 'present_address',
                'permanent_address', 'reference_name', 'reference_id']);
        });
    }
}
