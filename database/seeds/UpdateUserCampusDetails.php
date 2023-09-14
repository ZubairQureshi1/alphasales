<?php

use App\User;
use Illuminate\Database\Seeder;

class UpdateUserCampusDetails extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $users = User::get();
        // foreach ($users as $user) {
        //     $user->campusDetails()->where('organization_campus_id', 1)->update(['is_working' => 0]);
        // }

        $user = User::find(199);
        $user->syncRoles([11, 11]);
    }
}
