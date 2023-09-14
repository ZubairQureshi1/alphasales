<?php

namespace App\Exports\Followups;

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

class PwwbFowwowupExportList implements FromCollection, WithStrictNullComparison, WithHeadings, ShouldAutoSize
{   
    private $recordsFiltered;
    public function __construct($recordsFiltered){
        $this->recordsFiltered = $recordsFiltered;
    }
 public $column_name = [
        'file_received_number' => 'File Received Number',
        'fresh_file_submission_in_pwwb_number' => 'Fresh File Submission Number',
        'father_name' => 'Father Name',
        'father_cnic' =>'Father CNIC',
        'file_received_status' =>'File Received Status',
        'pwwb_diary_number' => 'Diary Number',
        'follow_up' => 'First Followup Date',
        'nextfollowupdate' => 'Next Followup Date',
        'student_name' => 'Student Name',
    ];
          // protected $appends = ['self_contact', 'father_contact', 'course_applied_in', 'course_enrolled_in', 'course_registered_in'];

    public function headings(): array
    {
        return $this->column_name;
    }

    public function collection()
    {   
        // dd($this->recordsFiltered);
        return $this->recordsFiltered;
        
    }
}
