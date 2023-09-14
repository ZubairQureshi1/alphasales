<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCourseAffiliatedBodiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('course_affiliated_bodies', function(Blueprint $table)
		{
			$table->foreign('organization_id')->references('id')->on('organizations')->onUpdate('RESTRICT')->onDelete('CASCADE');
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
		Schema::table('course_affiliated_bodies', function(Blueprint $table)
		{
			$table->dropForeign('course_affiliated_bodies_organization_id_foreign');
			$table->dropForeign('course_affiliated_bodies_wing_id_foreign');
		});
	}

}
