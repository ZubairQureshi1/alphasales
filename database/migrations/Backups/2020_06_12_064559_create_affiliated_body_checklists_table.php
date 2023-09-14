<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAffiliatedBodyChecklistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affiliated_body_checklists', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->unsignedInteger('affiliated_body_id')->nullable();
            $table->foreign('affiliated_body_id')->references('id')->on('affiliated_bodies')->onDelete('cascade');

            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('affiliated_body_checklists');
    }
}
