<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 191)->nullable();
			$table->string('email', 191)->unique();
			$table->string('password', 191)->nullable();
			$table->string('username', 191)->nullable();
			$table->string('display_name', 191)->nullable();
			$table->string('profile_pic_url', 191)->nullable();
			$table->string('remember_token', 100)->nullable();
			$table->timestamps(3);
			$table->string('d_o_b', 191)->nullable();
			$table->string('mobile_no', 191)->nullable();
			$table->string('landline_no', 191)->nullable();
			$table->string('cnic_no', 191)->nullable();
			$table->string('cnic_expiry', 191)->nullable();
			$table->string('age', 191)->nullable();
			$table->string('gender', 191)->nullable();
			$table->string('religion', 191)->nullable();
			$table->string('martial_status', 191)->nullable();
			$table->string('blood_group', 191)->nullable();
			$table->string('father_name', 191)->nullable();
			$table->string('qr_code_name', 191)->nullable();
			$table->integer('gender_id')->nullable();
			$table->integer('religion_id')->nullable();
			$table->integer('martial_status_id')->nullable();
			$table->integer('blood_group_id')->nullable();
			$table->integer('faculty_type')->nullable();
			$table->string('experience_level', 191)->nullable();
			$table->string('hourly_salary_rate', 191)->nullable();
			$table->string('fixed_salary', 191)->nullable();
			$table->boolean('is_super_admin')->default(0);
			$table->boolean('is_guest')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
