<?php

use App\Models\City;
use Illuminate\Database\Seeder;

class UpdateCityTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::create(['name' => 'Other', 'country_name' => 'Other', 'state' => 'Other']);
    }
}
