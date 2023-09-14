<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSessionCoursesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('session_courses', function(Blueprint $table)
		{
			$table->foreign('organization_campus_id')->references('id')->on('organization_campuses')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('wing_id')->references('id')->on('wings')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('session_courses', function(Blueprint $table)
		{
			$table->dropForeign('session_courses_organization_campus_id_foreign');
			$table->dropForeign('session_courses_wing_id_foreign');
		});
	}

}
