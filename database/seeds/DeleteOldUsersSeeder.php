<?php

use App\User;
use Illuminate\Database\Seeder;

class DeleteOldUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::where('email', '!=', 'admin@gmail.com')
        				->where('email', '!=', 'superadmin@gmail.com')
        				->whereDoesntHave('campusDetails')
        				->delete();
    }
}
