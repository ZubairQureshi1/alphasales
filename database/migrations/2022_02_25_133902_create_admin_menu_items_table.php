<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminMenuItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('admin_menu_items', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('label', 191);
			$table->string('link', 191);
			$table->bigInteger('parent')->unsigned()->default(0);
			$table->integer('sort')->default(0);
			$table->string('class', 191)->nullable();
			$table->bigInteger('menu')->unsigned()->index('admin_menu_items_menu_foreign');
			$table->integer('depth')->default(0);
			$table->integer('isActive')->nullable()->default(0);
			$table->string('icon', 191)->default('mdi mdi-menu');
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
		Schema::drop('admin_menu_items');
	}

}
