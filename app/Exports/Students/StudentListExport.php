<?php

namespace App\Exports\Students;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class StudentListExport implements FromCollection, WithStrictNullComparison, WithHeadings
{

    public $column_name = [
        'old_roll_no' => 'Custom Roll Number',
        'roll_no' => "System Roll Number",
        'student_name' => "Student Name",
        'student_category_id' => "Student Category",
        'shift' => 'Shift',
        'student_cnic_no' => 'Student CNIC',
        'gender' => 'Gender',
        'course_name' => 'Course',
        'session_name' => 'Session',
        'section_name' => 'Section',
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
        $students = Student::get();
        foreach ($students as $key => $student) {
            $students[$key]['student_category'] = $student->student_category_id != null ? config('constants.student_categories')[$student->student_category_id] : '---';
            $students[$key]['shift'] = isset($student->shift_id) ? config('constants.shifts')[$student->shift_id] : '---';
            $students[$key] = $student->only(array_keys($this->column_name));
        }
        return $students;
    }
}
