<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColsToSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sections', function (Blueprint $table) {
            //
            $table->unsignedInteger('subject_id')->nullable();
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->BigInteger('strength')->nullable();
            $table->BigInteger('active')->nullable();
            $table->BigInteger('wing_id')->nullable();
            $table->BigInteger('campus_id')->nullable();
            $table->BigInteger('session_id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sections', function (Blueprint $table) {
            //
            $table->dropColumn('subject_id');
            $table->dropColumn('strength');
            $table->dropColumn('active');
            $table->dropColumn('wing_id');
            $table->dropColumn('campus_id');
            $table->dropColumn('session_id');
        });
    }
}
