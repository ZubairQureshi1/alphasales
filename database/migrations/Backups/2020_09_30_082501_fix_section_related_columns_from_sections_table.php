<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixSectionRelatedColumnsFromSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sections', function (Blueprint $table) {
            $table->dropForeign(['subject_id']);
            $table->dropColumn(['subject_id']);
            $table->dropColumn(['course_id']);
        });

        Schema::table('section_subject_details', function (Blueprint $table) {
            $table->dropForeign(['course_id']);
            $table->dropColumn(['course_id']);
        });
                
        // Drop un used tables
        Schema::dropIfExists('section_courses');
        Schema::dropIfExists('section_students');
        Schema::dropIfExists('section_affiliated_bodies');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
