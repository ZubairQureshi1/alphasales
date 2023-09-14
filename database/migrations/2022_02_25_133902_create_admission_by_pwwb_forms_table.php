<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmissionByPwwbFormsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('admission_by_pwwb_forms', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('admission_id')->unsigned()->nullable()->index('admission_by_pwwb_forms_admission_id_foreign');
			$table->bigInteger('index_table_id')->unsigned()->nullable()->index('admission_by_pwwb_forms_index_table_id_foreign');
			$table->boolean('is_admitted')->default(0);
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('admission_by_pwwb_forms_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('admission_by_pwwb_forms_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('admission_by_pwwb_forms_academic_wing_id_foreign');
			$table->timestamps(3);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('admission_by_pwwb_forms');
	}

}
