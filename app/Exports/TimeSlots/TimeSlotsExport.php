<?php

namespace App\Exports\TimeSlots;

use App\Models\TimeSlot;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class TimeSlotsExport implements FromCollection, WithStrictNullComparison, WithHeadings/*, FromView*/
{

    public $column_name = [
        'name' => "Slot Name",
        'start_time' => 'Start Time',
        'end_time' => 'End Time',
        'buffer_start_time' => 'Buffer Start',
        'buffer_end_time' => 'Buffer End',
        'slot_type_name' => 'Slot Type Name',
    ];
    /* public function view(): View
    {
    $followupsForKeys = TimeSlot::get()->toArray();
    $followups = TimeSlot::get()->groupBy('enq_form_code')->toArray();
    $followup_keys = [];
    if (count($followupsForKeys) != 0) {

    $followup_keys = array_keys($followupsForKeys[0]);
    }
    $sheet = view('TimeSlots.excel', ['followups' => $followups,'followup_keys' => $followup_keys, 'is_edit_mode' => false]);
    $sheet->setAutoSize(true);

    return $sheet;
    }*/

    public function headings(): array
    {
        return $this->column_name;
    }

    public function collection()
    {
        $timeslots = TimeSlot::get(array_keys($this->column_name));
        return $timeslots;
    }
}
