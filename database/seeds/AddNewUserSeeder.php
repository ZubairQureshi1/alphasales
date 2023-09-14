<?php

use Illuminate\Database\Seeder;

class AddNewUserSeeder extends Seeder
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
            'name' => 'Super Admin',
            'email' => 'superadmin@cfe.edu.pk',
            'password' => Hash::make('123456'),
            'username' => 'superadmin',
            'display_name' => 'Super Admin',
            'is_super_admin' => 1,
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $admin = \App\User::create($admin);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
