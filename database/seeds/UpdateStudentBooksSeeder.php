<?php

use App\Models\Student;
use App\Models\StudentBook;
use Illuminate\Database\Seeder;

class UpdateStudentBooksSeeder extends Seeder
{

    public $courses_books = [

        'F.Sc. Pre Medical' => [
            '1' => [
                '6' => 'English',
                '5' => 'Urdu',
                '8' => 'Islamyat',
                '3' => 'Chemistry',
                '7' => 'Biology',
                '1' => 'Physics,',
            ],
            '2' => [
                '6' => 'English',
                '5' => 'Urdu',
                '21' => 'Pakistan Studies',
                '3' => 'Chemistry',
                '7' => 'Biology',
                '1' => 'Physics,',
            ],
        ],
        'F.Sc. Pre Engineering' => [
            '1' => [
                '6' => 'English',
                '5' => 'Urdu',
                '8' => 'Islamyat',
                '3' => 'Chemistry',
                '9' => 'Mathamatics',
                '1' => 'Physics,',
            ],
            '2' => [
                '6' => 'English',
                '5' => 'Urdu',
                '21' => 'Pakistan Studies',
                '3' => 'Chemistry',
                '9' => 'Mathamatics',
                '1' => 'Physics,',
            ],
        ],
        'I.Cs. Physics' => [
            '1' => [
                '6' => 'English',
                '5' => 'Urdu',
                '8' => 'Islamyat',
                '9' => 'Mathamatics',
                '10' => 'Computer Science',
                '1' => 'Physics,',
            ],
            '2' => [
                '6' => 'English',
                '5' => 'Urdu',
                '21' => 'Pakistan Studies',
                '9' => 'Mathamatics',
                '10' => 'Computer Science',
                '1' => 'Physics,',
            ],
        ],
        'I.Cs. Stat' => [
            '1' => [
                '6' => 'English',
                '5' => 'Urdu',
                '8' => 'Islamyat',
                '9' => 'Mathamatics',
                '10' => 'Computer Science',
                '11' => 'Business Statistics,',
            ],
            '2' => [
                '6' => 'English',
                '5' => 'Urdu',
                '21' => 'Pakistan Studies',
                '9' => 'Mathamatics',
                '10' => 'Computer Science',
                '11' => 'Business Statistics,',
            ],
        ],
        'I.COM' => [
            '1' => [
                '6' => 'English',
                '5' => 'Urdu',
                '8' => 'Islamyat',
                '12' => 'Business Mathematics',
                '13' => 'Principles of Accounting',
                '14' => 'Principles of Economics',
                '15' => 'Principles of Commerce',
            ],
            '2' => [
                '6' => 'English',
                '5' => 'Urdu',
                '21' => 'Pakistan Studies',
                '11' => 'Business Statistics,',
                '13' => 'Principles of Accounting',
                '17' => 'Commercial Geography',
                '18' => 'Principles of Banking',
            ],
        ],
    ];

    public function run()
    {
        $students = Student::with('studentAcademicHistories', 'studentAcademicHistories.studentBooks')->get();
        foreach ($students as $key => $student) {
            $student_academic_histories = $student->studentAcademicHistories()->get();
            foreach ($student_academic_histories as $key => $student_history) {
                $student_books = $student_history->studentBooks()->get();
                if (count($student_books->toArray()) == 0) {
                    if (isset($this->courses_books[$student->course_name])) {
                        $course_books = $this->courses_books[$student->course_name][$key + 1];
                        foreach ($course_books as $key => $book) {
                            $student_book = new StudentBook();
                            $student_book->subject_name = $book;
                            $student_book->student_academic_history_id = $student_history->id;
                            $student_book->subject_id = $key;
                            $student_book->save();
                        }
                    }
                }
            }
        }
    }
}
