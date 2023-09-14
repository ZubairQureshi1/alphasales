<?php

namespace App\Exports\Followups;

use App\Models\EnquiryFollowup;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class FollowupsExport implements FromCollection, WithStrictNullComparison, WithHeadings/*, FromView*/
{

    public $column_name = [
        'enq_form_code' => "Form Code",
        'next_date' => 'Next Followup Date',
        'status' => 'Status',
        'remarks' => 'Remarks',
    ];
    /* public function view(): View
    {
    $followupsForKeys = EnquiryFollowup::get()->toArray();
    $followups = EnquiryFollowup::get()->groupBy('enq_form_code')->toArray();
    $followup_keys = [];
    if (count($followupsForKeys) != 0) {

    $followup_keys = array_keys($followupsForKeys[0]);
    }
    $sheet = view('enquiryFollowups.excel', ['followups' => $followups,'followup_keys' => $followup_keys, 'is_edit_mode' => false]);
    $sheet->setAutoSize(true);

    return $sheet;
    }*/

    public function headings(): array
    {
        return $this->column_name;
    }

    public function collection()
    {
        $followups = EnquiryFollowup::get(array_keys($this->column_name));
        return $followups;
    }
}
