<?php

use App\Models\Shift;
use Illuminate\Database\Seeder;

class MigrateShiftDateToShift extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $shifts = Shift::get();
        foreach ($shifts as $key => $shift) {

            $shift_dates = $shift->shiftDates()->get();
            foreach ($shift_dates as $key => $shift_date) {
                if ($key == 1) {
                    $shift->date = $shift_date->date;
                    $shift->update();
                } else {
                    $new_shift = new Shift();
                    $keys = array_keys($shift->toArray());
                    foreach ($keys as $index => $key) {
                        if ($key != 'id' && $key != 'created_at' && $key != 'deleted_at' && $key != 'updated_at') {
                            $new_shift->$key = $shift[$key];
                        }
                    }
                    $new_shift->date = $shift_date->date;
                    dd($new_shift->toArray());
                    $new_shift->save();
                }
            }
        }
    }
}
