<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColsToStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->integer('admission_type_id')->nullable();
            $table->string('admission_type')->nullable();
            $table->boolean('is_end_of_reg')->default(false);
            $table->string('reason_end_of_reg')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('admission_type_id');
            $table->dropColumn('admission_type');
            $table->dropColumn('is_end_of_reg');
            $table->dropColumn('reason_end_of_reg');
        });
    }
}
