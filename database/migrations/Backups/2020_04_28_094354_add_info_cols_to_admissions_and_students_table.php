<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInfoColsToAdmissionsAndStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admissions', function (Blueprint $table) {
            $table->string('father_occupation')->nullable();
            $table->string('city_id')->nullable();
            $table->string('other_city_name')->nullable();
            $table->string('source_info_id')->nullable();
            $table->string('marketer_name')->nullable();
            $table->string('social_media_type_id')->nullable();
            $table->string('other_social_media_name')->nullable();
            $table->string('ex_student_wing_type_id')->nullable();
            $table->string('ex_student_name')->nullable();
            $table->string('friend_name')->nullable();
            $table->string('other_source_of_info')->nullable();
            $table->string('guardian_cnic')->nullable();
        });

        Schema::table('students', function (Blueprint $table) {
            $table->string('father_occupation')->nullable();
            $table->string('city_id')->nullable();
            $table->string('other_city_name')->nullable();
            $table->string('source_info_id')->nullable();
            $table->string('marketer_name')->nullable();
            $table->string('social_media_type_id')->nullable();
            $table->string('other_social_media_name')->nullable();
            $table->string('ex_student_wing_type_id')->nullable();
            $table->string('ex_student_name')->nullable();
            $table->string('friend_name')->nullable();
            $table->string('other_source_of_info')->nullable();
            $table->string('guardian_cnic')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admissions', function (Blueprint $table) {
            $table->dropColumn('father_occupation');
            $table->dropColumn('city_id');
            $table->dropColumn('other_city_name');
            $table->dropColumn('source_info_id');
            $table->dropColumn('guardian_cnic');
            $table->dropColumn('marketer_name');
            $table->dropColumn('social_media_type_id');
            $table->dropColumn('other_social_media_name');
            $table->dropColumn('ex_student_wing_type_id');
            $table->dropColumn('ex_student_name');
            $table->dropColumn('friend_name');
            $table->dropColumn('other_source_of_info');
        });

        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('father_occupation');
            $table->dropColumn('city_id');
            $table->dropColumn('other_city_name');
            $table->dropColumn('source_info_id');
            $table->dropColumn('guardian_cnic');
            $table->dropColumn('marketer_name');
            $table->dropColumn('social_media_type_id');
            $table->dropColumn('other_social_media_name');
            $table->dropColumn('ex_student_wing_type_id');
            $table->dropColumn('ex_student_name');
            $table->dropColumn('friend_name');
            $table->dropColumn('other_source_of_info');
        });
    }
}
