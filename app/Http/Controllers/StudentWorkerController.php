<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentWorker;
use ConstantStrings;
use Illuminate\Http\Request;

class StudentWorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static $filters_configuration = [
        'addFilters' => true,
        // 'route' => '../accounts/reportings',
        'model_path' => 'App\Models\Student',
        'index_path' => 'studentWorker.index',
        'date_filter_column' => 'admission_date',
        'controller_path' => 'App\Http\Controllers\StudentWorkerController',
        'can_filters' => true,
        'clear_filters' => true,
        'filters' => [
            'users' => false,
            'students' => false,
            'courses' => true,
            'parts' => false,
            'sessions' => true,
            'subjects' => false,
            'visitor_users' => false,
            'roles' => false,
            'admission_forms' => false,
            'departments' => false,
            'designations' => false,
            'sections' => false,
            'admission_types' => true,
            'end_of_registrations' => false,
            'heads' => false,
            'fee_structure_types' => false,
            'payment_statuses' => false,
            'voucher_statuses' => false,
            'start_date' => false,
            'end_date' => false,
        ],
    ];

    public function index(Request $request)
    {

        $students = Student::where('student_category_id', '2')->paginate(ConstantStrings::PAGINATION_RANGE);

        foreach ($students->items() as $key => $student) {
            if ($student->profile_pic != null && $student->profile_pic != '') {
                $student->picture_pic_directory_url = asset(config('constants.attachment_path.student_qr_destination_path') . $student->roll_no . '/Profile_Pictures/' . $student->profile_pic);
            } else {
                $student->picture_pic_directory_url = asset('assets/images/users/dummy.png');
            }

        }

        return view('studentWorker.index')
            ->with('data', $students)->with('filters_configuration', $this::$filters_configuration);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudentWorker  $studentWorker
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $student = Student::find($id);

        $check = false;
        $item = "";
        $tst = array_keys($student->toArray());

        foreach ($tst as $key) {

            if ($key == 'father_work_address' || $key == 'father_name' || $key == 'father_cnic-no' || $key == 'eobi' || $key == 'ssc' || $key == 'factory_city' || $key == 'factory_reg_no' || $key == 'is_transport' || $key == 'is_hostel' || $key == 'is_provisional_letter' || $key == 'cfe_file_no' || $key == 'dairy_no' || $key == 'self_worker' || $key == 'factory_name' || $key == 'r_eight') {
                if ($student[$key] === null) {

                    $check = true;
                    $item = $key;
                }

            }

        }

        return view('studentWorker.show')->with('student', $student)->with('check', $check)->with('item', $item);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentWorker  $studentWorker
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentWorker $studentWorker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudentWorker  $studentWorker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentWorker $studentWorker)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentWorker  $studentWorker
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentWorker $studentWorker)
    {
        //
    }
}
