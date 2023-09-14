<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$admin = [

			// create users permissions
			'name' => 'admin',
			'email' => 'admin@gmail.com',
			'password' => Hash::make('123456'),
			'username' => 'admin',
			'emp_code' => 'EMP-ADM-00001',
			'display_name' => 'Admin',
		];

		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		DB::table('users')->truncate();

		$admin = \App\User::create($admin);
		$admin->removeRole(Role::find(1));
		$admin->assignRole(Role::find(1));
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
