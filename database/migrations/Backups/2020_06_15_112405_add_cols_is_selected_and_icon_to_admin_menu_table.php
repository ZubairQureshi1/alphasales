<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColsIsSelectedAndIconToAdminMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_menus', function (Blueprint $table) {
            $table->boolean('is_selected')->default(false)->after('name');
        });

        Schema::table('admin_menu_items', function (Blueprint $table) {
            $table->string('icon')->default('mdi mdi-menu')->after('depth');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admin_menus', function (Blueprint $table) {
            $table->dropColumn('is_selected');
        });

        Schema::table('admin_menu_items', function (Blueprint $table) {
            $table->dropColumn('icon');
        });
    }
}
