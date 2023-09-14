<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use Alertify;
use App\Models\AcademicRecord;
use App\Models\Admission;
use App\Models\AdmissionByEnquiryForm;
use App\Models\Course;
use App\Models\Enquiry;
use App\Models\Reference;
use App\Models\Section;
use App\Models\SectionStudent;
use App\Models\Session;
use App\Models\Student;
use App\Models\StudentAcademicHistory;
use App\Models\StudentBook;
use App\Models\SystemRollNumber;
use ConstantStrings;
use Illuminate\Http\Request;

class AdmissionAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $admissions = Admission::get();
        return $admissions;
    }

        
        

    public function getAdmission(Request $request){
        $input = $request->all();
        \Log::info($input);
        $admissions=Admission::where('user_id','=',$input['id'])->get();  
        return $admissions;
    }


     public function saveAdmission(Request $request){
        $input = $request->all();
        try {
            \DB::beginTransaction();

            $admission = Admission::create($request->all());
            $student_input = $input;
            $student_input['admission_id'] = $admission->id;
            $student = Student::create($student_input);

            $sectionStudentInput = ['section_id' => $input['section_id'], 'student_id' => $student->id];
            $sectionStudent = SectionStudent::create($sectionStudentInput);

            $courseWiseStudents = SystemRollNumber::where('course_id', '=', $input['course_id'])->where('session_id', '=', $input['session_id'])->get();
            $courseStudentCount;
            if (!$courseWiseStudents) {
                $courseStudentCount = 1;
            } else {
                // $courseStudentCount = sizeof($courseWiseStudents);
                $courseStudentCount = $courseWiseStudents->last()->generated_at_length + 1;

            }
            $end_date = Session::find($input['session_id'])->session_end_date;
            $session_end_date = new \DateTime(str_replace('/', '-', $end_date));
            $section_code = Section::find($input['section_id'])->code;
            $course_code = Course::find($input['course_id'])->course_code;
            $student_roll_no = 'CFE-' . $session_end_date->format('Y') . '-' . $course_code . '-' . $section_code . '-' . sprintf('%05d', intval($courseStudentCount));
            $system_roll_no_input = ['roll_no' => $student_roll_no, 'session_id' => $input['session_id'], 'section_id' => $input['section_id'], 'course_id' => $input['course_id'], 'student_id' => $student->id, 'admission_id' => $admission->id, 'session_name' => $input['session_name'], 'section_name' => $input['section_name'], 'student_name' => $student->student_name, 'course_name' => $input['course_name'], 'is_assigned' => true, 'generated_at_length' => $courseStudentCount];
            $system_roll_no = SystemRollNumber::create($system_roll_no_input);

            $student->roll_no = $student_roll_no;
            $student->user_id = $input['user_id'];
            $student->user_name = $input['user_name'];
            $student->system_roll_number_id = $system_roll_no->id;
            $student->update();

            $this->generateQRCode($student);
            \Log::info($input);
            $acadmicRecords = json_decode($input['acadmicRecords'], true);
            foreach ($acadmicRecords as $key => $acadmicRecord) {
                $acadmicRecord['admission_id'] = $admission->id;
                $acadmicRecord['student_id'] = $student->id;
                $acadmicRecord = AcademicRecord::create($acadmicRecord);
            }

            $admission->student_id = $student->id;

            $admission->user_id = $input['user_id'];
            $admission->user_name = $input['user_name'];
            $form_code = $this->getAdmissionFormCode();
            $system_roll_no->admission_form_code = $form_code;
            $system_roll_no->update();
            $admission->form_no = $form_code;
            $admission->update();
            if (isset($input['enquiry_id'])) {
                $enquiry = Enquiry::find($input['enquiry_id']);
                $enquiry->status_id = 8;
                $enquiry->status = ConstantStrings::statuses()[8];
                $enquiry->save();
                $admissionByEnquiryForms = AdmissionByEnquiryForm::where('enquiry_id', '=', $input['enquiry_id'])->get();
                foreach ($admissionByEnquiryForms as $key => $value) {
                    $admissionByEnquiryForm = AdmissionByEnquiryForm::find($value->id);
                    $admissionByEnquiryForm->status = ConstantStrings::statuses()[8];
                    $admissionByEnquiryForm->status_id = 8;
                    $admissionByEnquiryForm->update();
                }
            }
            $studentAcademicHistory = new StudentAcademicHistory;
            $studentAcademicHistory->course_name = $input['course_name'];
            $studentAcademicHistory->course_id = $input['course_id'];
            $studentAcademicHistory->session_name = $input['session_name'];
            $studentAcademicHistory->session_id = $input['session_id'];
            $studentAcademicHistory->is_promoted = false;
            $studentAcademicHistory->student_id = $student->id;
            $studentAcademicHistory->save();

            $studentBookSelected = json_decode($input['courseBooks'], true);
            foreach ($studentBookSelected as $index => $value) {
                $studentBook = new StudentBook;
                $studentBook->subject_name = $value;
                $studentBook->student_academic_history_id = $studentAcademicHistory->id;
                $studentBook->save();
            }

            Alertify::success('Admission saved successfully.');

            // return redirect(route('admissions.index'));
            \DB::commit();
            return response()->json(['success' => true, 'data' => [$session_end_date, $section_code, $course_code]], 200);
        } catch (\Exception $e) {
            \Log::info($e);
            \DB::rollback();
        }

     }

      public function getAdmissionFormCode()
    {
        $number;
        $admissions = Admission::withTrashed()->get();
        if (!$admissions) {
            $number = 0;
        } else {
            $number = sizeof($admissions);
        }
        return 'CFE-' . sprintf('%05d', intval($number) + 1);
    }


     public function generateQRCode($student)
    {

        try {
            \DB::beginTransaction();
            $input = $student->only(['id', 'student_name']);
            $qr_code_name = $student->student_name . '-' . $student->roll_no . '.png';
            $input['type'] = 'student';
            // $qr_code_server = \QRCode::text(json_encode($input, true));
            // $qr_code_server->setErrorCorrectionLevel('H');
            // $qr_code_server->setSize(4);
            // $qr_code_server->setMargin(2);
            // $qr_code_server->setOutfile(public_path(config('constants.attachment_path.student_qr_destination_path')) . $qr_code_name . '.png');
            // $qr_code_server->png();

            $qr_code = \QRCode::text(json_encode($input, true));
            $qr_code->setErrorCorrectionLevel('H');
            $qr_code->setSize(4);
            $qr_code->setMargin(2);
            $directory = \FileUploader::makeDirectory(false, $student, 'qr_codes');
            $qr_code->setOutfile($directory . $qr_code_name);
            $qr_code->png();

            $student->qr_code_name = $qr_code_name;
            $student->update();
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
        }
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
