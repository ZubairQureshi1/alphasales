<?php

use App\Models\StudentBook;
use App\Models\Subject;
use Illuminate\Database\Seeder;

// use App\Models\Subject;
class UpdateStudentBooksTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $student_books_detail = StudentBook::get();
        // foreach ($student_books_detail as $key => $value) {
        //     $subject = Subject::where('name', '=', $value['subject_name'])->get()->first();
        //     if (!empty($subject)) {

        //         $student_book = StudentBook::find($value['id']);
        //         $student_book->subject_id = $subject->id;
        //         $student_book->update();
        //     }
        // }
        $student_books_detail = StudentBook::where('subject_id', '=', null)->get();
        // dd($student_books_detail[0]);
        foreach ($student_books_detail as $key => $value) {
            $student_book = StudentBook::find($value['id']);
            if (!Subject::where('name', '=', $value['subject_name'])->get()->isEmpty()) {
                $student_book->subject_id = Subject::where('name', '=', $value['subject_name'])->get()->last()->id;
                $student_book->update();
            } else {
                if ($value['subject_name'] == 'Islamyat') {
                    $student_book->subject_name = 'Islamiyat';
                    $student_book->subject_id = 8;
                    $student_book->update();
                } else if ($value['subject_name'] == 'Pak studies') {
                    $student_book->subject_name = 'Pakistan studies';
                    $student_book->subject_id = 21;
                    $student_book->update();
                } else if ($value['subject_name'] == 'Business Math') {
                    $student_book->subject_name = 'Business Mathematics';
                    $student_book->subject_id = 12;
                    $student_book->update();
                } else if ($value['subject_name'] == 'Accounting') {
                    $student_book->subject_name = 'Principles of Accounting';
                    $student_book->subject_id = 13;
                    $student_book->update();
                } else if ($value['subject_name'] == 'commerce') {
                    $student_book->subject_name = 'Principles of Commerce';
                    $student_book->subject_id = 15;
                    $student_book->update();
                } else if ($value['subject_name'] == 'banking') {
                    $student_book->subject_name = 'Principles of Banking';
                    $student_book->subject_id = 18;
                    $student_book->update();
                } else if ($value['subject_name'] == 'geographic') {
                    $student_book->subject_name = 'Commercial Geography';
                    $student_book->subject_id = 17;
                    $student_book->update();
                }
            }

        }
    }
}

// <?php

// use App\Models\StudentBook;
// use Illuminate\Database\Seeder;

// class UpdateStudentBooksTable extends Seeder
// {
//     /**
//      * Run the database seeds.
//      *
//      * @return void
//      */
//     public function run()
//     {
//         $student_books_detail = StudentBook::where('name', '=', 'Statics')->get();
//         foreach ($student_books_detail as $key => $value) {
//             $student_book = StudentBook::find($value['id']);
//             $student_book->subject_name = 'Statistics Commerce Group';
//             $student_book->subject_id = 11;
//             $student_book->update();

//         }
//     }
// }
