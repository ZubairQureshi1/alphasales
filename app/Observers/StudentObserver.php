<?php

namespace App\Observers;

use App\Models\Admission;
use App\Models\Pwwb\AfDetail;
use App\Models\Pwwb\BiseDetail;
use App\Models\Pwwb\DualCourseDetail;
use App\Models\Pwwb\EducationalWingCfe;
use App\Models\Pwwb\ImsDetail;
use App\Models\Pwwb\IndexTable;
use App\Models\Pwwb\VtiDetail;
use App\Models\SessionCourse;
use App\Models\Student;

class StudentObserver
{
    /**
     * Handle the student "created" event.
     *
     * @param  \App\Student  $student
     * @return void
     */
    public function created(Student $student)
    {
        //
    }

    /**
     * Handle the menu items "updated" event.

     * @param  \App\MenuItems  $menuItems
     * @return void
     */

    /**
     * Handle the student "updated" event.
     *
     * @param  \App\Student  $student
     * @return void
     */
    public function retrieved(Student $student)
    {
        $admission = Admission::find($student->admission_id);

        $session_course = SessionCourse::where('organization_campus_id', $student->organization_campus_id)->where('session_id', $student->session_id)->where('course_id', $student->course_id)->get()->first();
        if ($student->student_category_id == 0) {
            $file = IndexTable::find($admission->pwwb_file_id); 
            $detail;
            //  --------------------------- FIRST VARIAT OF ROLL NUMBER -------------------------------------------------
            $file->organization_campus_id = $student->organization_campus_id;

            //  --------------------------- SECOND VARIAT OF ROLL NUMBER -------------------------------------------------
            $file->session = $student->session_id;

            //  --------------------------- THIRD VARIAT OF ROLL NUMBER -------------------------------------------------
            // dd($session_course, $file);
            $detail = $this->getWingModelObject($file->id, $session_course->wing_id, $file->wing_id);
            $detail = $this->validateDataWingDifference($detail, $file->id, $session_course->wing_id, $file->wing_id);
            //  --------------------------- FOURTH VARIAT OF ROLL NUMBER -------------------------------------------------
            $detail->setChangeForObserver($student);
            // dd($detail->toArray());
            $detail->save();

            // updating values
            $file->wing_id = $session_course->wing_id;
            $file->course_id = $student->course_id;
            $file->affiliated_body_id = $student->affiliated_body_id;

            $file->update();
            if (isset($detail)) {
            }
        }
    }

    public function getWingModelObject($file_id, $new_course_wing, $file_wing)
    {
        $object;
        if ($file_wing == 1) {
            $object = AfDetail::where('index_table_id', $file_id)->get()->last();
        }
        if ($file_wing == 2) {
            $object = BiseDetail::where('index_table_id', $file_id)->get()->last();
        }
        if ($file_wing == 3) {

            $object = ImsDetail::where('index_table_id', $file_id)->get()->last();
        }
        if ($file_wing == 4) {
            $object = VtiDetail::where('index_table_id', $file_id)->get()->last();
            if ($object->vti_dual_course == 'yes') {
                $object = DualCourseDetail::where('index_table_id', $file_id)->get()->last();
            }
        }

        return $object;
    }

    public function validateDataWingDifference($object, $file_id, $new_course_wing, $file_wing)
    {

        if ($new_course_wing != $file_wing) {
            foreach ($object->getAttributes() as $key => $attribute) {
                if ($key != 'id' && $key != 'created_at' && $key != 'updated_at' && $key != 'index_table_id') {
                    $object->$key = null;
                }
            }
            $object->update();
            $object = $this->getWingModelObject($file_id, $new_course_wing, $file_wing);
            $object->index_table_id = $file_id;
            $wing_update = EducationalWingCfe::where('index_table_id', $file_id)->get()->last();
            $wing_update->educational_wing_cfe = $new_course_wing;
            $wing_update->update();

        }
        return $object;
    }

    /**
     * Handle the student "deleted" event.
     *
     * @param  \App\Student  $student
     * @return void
     */
    public function deleted(Student $student)
    {
        //
    }

    /**
     * Handle the student "restored" event.
     *
     * @param  \App\Student  $student
     * @return void
     */
    public function restored(Student $student)
    {
        //
    }

    /**
     * Handle the student "force deleted" event.
     *
     * @param  \App\Student  $student
     * @return void
     */
    public function forceDeleted(Student $student)
    {
        //
    }
}
