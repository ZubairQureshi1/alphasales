<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsToFactoryDeathManagerDetailContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('factory_death_manager_detail_contacts', function (Blueprint $table) {
             $table->string('manager_contact_relationship')->nullable();
            $table->string('manager_specify_relationship')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('factory_death_manager_detail_contacts', function (Blueprint $table) {
            $table->dropColumn(['manager_contact_relationship','manager_specify_relationship']);
           });
    }
}
