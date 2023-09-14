<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColHeadFineStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('head_fine_students', function (Blueprint $table) {
            
            $table->unsignedInteger('academic_history_id')->nullable();
            $table->foreign('academic_history_id')->references('id')->on('student_academic_histories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('head_fine_students', function (Blueprint $table) {
            $table->dropForeign(['academic_history_id']);
            $table->dropColumn('academic_history_id');
        });
    }
}
