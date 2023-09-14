<?php

namespace App\Exports\Attendances;

use App\Models\Attendance;
use Illuminate\Support\Facades\Session as SystemSession;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EmployeeAttendancesExport implements FromQuery, WithHeadings, ShouldAutoSize, WithMapping
{
    use Exportable;

    public $user_id;
    public $start_date;
    public $end_date;

    public function __construct($array)
    {
        $this->user_id = $array['id'];
        $this->start_date = $array['start_date'];
        $this->end_date = $array['end_date'];
    }

    // public function columnFormats(): array
    // {
    //     return [
    //         'D' => Date::dateTimeToExcel(),
    //         'E' => NumberFormat::FORMAT_DATE_DDMMYYYY,
    //     ];
    // }

    public $column_name = [
        'date' => "Date",
        'name' => "Employee Name",
        'emp_code' => 'Employee Code',
        'status' => 'Attendance Status',
        'time_slot_name' => 'Time Slot Name',
        'check_in_time' => 'Checkin',
        'check_out_time' => 'Checkout',
        'working_hours' => 'Working Hours',
    ];

    public function headings(): array
    {
        return $this->column_name;
    }

    public function query()
    {
        $attendances = Attendance::query()->select(array_keys($this->column_name))
                                            ->where('user_id', '=', $this->user_id)
                                            ->where('date', '>=', $this->start_date)
                                            ->where('organization_campus_id', SystemSession::get('organization_campus_id'))
                                            ->where('date', '<=', $this->end_date)
                                            ->orderBy('date', 'asc');
        return $attendances;
    }

    public function map($attendance): array
    {
        $check_in_UTC = $attendance['check_in_time'];
        $check_out_UTC = $attendance['check_out_time'];
        if ($check_in_UTC != null && $check_in_UTC != '') {
            $check_in_UTC = new \DateTime($attendance['check_in_time']);
            $check_in_UTC->setTimezone(new \DateTimeZone('PKT'));
            $attendance['check_in_time'] = $check_in_UTC->format('h:i A');
        }
        if ($check_out_UTC != null && $check_out_UTC != '') {
            $check_out_UTC = new \DateTime($attendance['check_out_time']);
            $check_out_UTC->setTimezone(new \DateTimeZone('PKT'));
            $attendance['check_out_time'] = $check_out_UTC->format('h:i A');
        }
        return $attendance->toArray();
    }

}
