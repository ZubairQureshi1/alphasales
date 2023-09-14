<?php

namespace App\Exports\Pwwbs;

use App\Http\Controllers\Pwwb\PwwbHomeController;
use App\Models\Pwwb\IndexTable;
use App\Models\Pwwb\StudentContactNumber;
use Illuminate\Support\Facades\Config;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Illuminate\Support\Collection;
use App\Models\Admission;

class PwwbFilteredListExport implements FromCollection, WithStrictNullComparison, WithHeadings, ShouldAutoSize
{   
    private $recordsFiltered;
    public function __construct($recordsFiltered){
        $this->recordsFiltered = $recordsFiltered;
        // dd($this->recordsFiltered);
    }
 public $column_name = [        
        'district' => 'District',
        'file_received_number' => 'File Received Number',
        'file_module_number' => 'File Module Number',
        'fresh_file_submission_in_pwwb_number' => 'Fresh File Submission Number',
        'receiving_date' => 'Receiving Date',
        'worker_name' =>'Worker Name',
        'worker_cnic' =>'Worker CNIC',
        'name' => 'Studen Name',
        'cnic_no' => 'Student CNIC',
        'transport_facility' => 'Transport Facility',
        'hostel_facility' => 'Hostel Facility',
        'wings_short_name' => 'Wing',
        'affiliated_bodies_code' => 'Affiliated Body',
        'self_contact' => 'Self Contact 1',
        'self_coontact_2' => 'Self Contact 2',
        'self_coontact_3' => 'Self Contact 3',
        'father_contact' => 'Father Contact',
        'course_applied' => 'Course Applied Name',
        'course_enrolled' => 'Course enrolled In Name',
        'course_registered' => 'Course Registered In Name',
        'roll_no' => 'Roll Number',
    ];
          // protected $appends = ['self_contact', 'father_contact', 'course_applied_in', 'course_enrolled_in', 'course_registered_in'];

    public function headings(): array
    {
        return $this->column_name;
    }

    public function collection()
    {

        foreach ($this->recordsFiltered as $val) {
            // dd($val->id);
        }

        // dD($this->recordsFiltered);
        return $this->recordsFiltered;
        
    }
}
