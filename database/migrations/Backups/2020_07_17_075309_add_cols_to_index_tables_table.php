<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColsToIndexTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('index_tables', function (Blueprint $table) {
            //
            $table->string('course_name')->nullable();
            $table->string('course_enrolled_id')->nullable();
            $table->string('course_registered_id')->nullable();
            $table->string('course_enrolled_name')->nullable();
            $table->string('course_registered_name')->nullable();
            $table->string('organization_campus_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('index_tables', function (Blueprint $table) {
            //
            $table->dropColumn('course_name');
            $table->dropColumn('course_enrolled_id');
            $table->dropColumn('course_registered_id');
            $table->dropColumn('course_enrolled_name');
            $table->dropColumn('course_registered_name');
            $table->dropColumn('organization_campus_id');
        });
    }
}
