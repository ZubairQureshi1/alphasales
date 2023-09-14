<?php

use App\Models\Attendance;
use Illuminate\Database\Seeder;

class UpdateEmployeeAttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $checkin = ['UTC06:01:09.4680', 'UTC06:02:14.4680', 'UTC06:03:28.4680', 'UTC06:04:29.4680', 'UTC06:05:23.4680', 'UTC06:06:21.4680', 'UTC06:07:09.4680', 'UTC06:08:09.4680', 'UTC06:09:09.4680', 'UTC06:14:09.4680', 'UTC06:13:09.4680', 'UTC06:12:09.4680', 'UTC06:11:09.4680', 'UTC06:10:09.4680'];
        $checkout = ['UTC14:01:09.9300', 'UTC14:14:14.9300', 'UTC14:03:28.9300', 'UTC14:04:29.9300', 'UTC14:05:23.9300', 'UTC14:14:21.9300', 'UTC14:07:09.9300', 'UTC14:08:09.9300', 'UTC15:09:09.9300', 'UTC15:14:09.9300', 'UTC15:13:09.9300', 'UTC15:12:09.9300', 'UTC15:11:09.9300', 'UTC15:10:09.9300'];
        $users = [43, 61, 87, 88, 96, 52];
        foreach ($users as $key => $user) {
            $attendances = Attendance::where('user_id', '=', $user)->where('date', '>=', '2019-10-01')->where('date', '<=', '2019-11-13')->get();

            foreach ($attendances as $key => $value) {
                $day_of_date = date('D', strtotime($value->date));
                if ($day_of_date != 'Sun') {
                    $value->status = 'Present';
                    $value->status_id = 1;
                    $value->check_in_time = $value->date . $checkin[array_rand($checkin)];
                    \Log::info($value->date . $checkin[array_rand($checkin)]);
                    $value->check_out_time = $value->date . $checkout[array_rand($checkout)];
                    $value->update();
                }
            }
        }
    }
}
