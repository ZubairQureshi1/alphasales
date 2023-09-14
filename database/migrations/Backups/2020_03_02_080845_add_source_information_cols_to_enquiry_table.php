<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSourceInformationColsToEnquiryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enquiries', function (Blueprint $table) {
            $table->string('marketer_name')->nullable();
            $table->string('social_media_type_id')->nullable();
            $table->string('other_social_media_name')->nullable();
            $table->string('ex_student_wing_type_id')->nullable();
            $table->string('ex_student_name')->nullable();
            $table->string('friend_name')->nullable();
            $table->string('other_source_of_info')->nullable();
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
