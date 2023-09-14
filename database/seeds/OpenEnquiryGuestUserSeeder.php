<?php

use App\User;
use Illuminate\Database\Seeder;

class OpenEnquiryGuestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'name' 		=> 'Guest',
        	'email'    	=> 'guest@cfe.com',
        	'is_guest'  => 1
        ]);
    }
}
