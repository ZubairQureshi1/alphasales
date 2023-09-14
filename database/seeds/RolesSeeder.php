<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$role_array = [

			// categories permissions
			['name' => 'admin', 'display_name' => 'Admin'],

		];

		DB::statement('SET FOREIGN_KEY_CHECKS=0;
			');
		DB::table('roles')->truncate();
		DB::table('role_has_permissions')->truncate();
		foreach ($role_array as $key => $role) {
			Role::create($role);
		}
		$admin_role = Role::find(1);
		$permissions = Permission::all();
		foreach ($permissions as $key => $permission) {
			// $admin_role->revokePermissionTo($permission['name']);
			$admin_role->givePermissionTo($permission['name']);
		}

		DB::statement('SET FOREIGN_KEY_CHECKS=1;');

	}
}
