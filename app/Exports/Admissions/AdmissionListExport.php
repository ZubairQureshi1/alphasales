<?php

namespace App\Exports\Admissions;

use App\Models\Admission;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class AdmissionListExport implements FromCollection, WithStrictNullComparison, WithHeadings
{
    public $column_name = [
        'old_roll_no' => 'Custom Roll Number',
        'student_name' => "Student Name",
        'student_cnic_no' => 'Student CNIC',
        'gender' => 'Gender',
        'course_name' => 'Course',
        'session_name' => 'Session',
        'semester' => 'Semester',
        'father_name' => 'Father Name',
        'father_cell_no' => 'Father Cell Number',
        'student_cell_no' => 'Student Cell Number',
        'present_address' => 'Present Address',
        'd_o_b' => 'D_O_B',
        'email' => 'Email',
        'user_name' => 'Added By (User)',
    ];

    public function headings(): array
    {
        return $this->column_name;
    }

    public function collection()
    {
        $admission = Admission::get(array_keys($this->column_name));
        return $admission;
    }
}
