<?php

namespace App\Repositories;

use App\Models\Session;
use App\Models\SessionCourse;
use DB;
use InfyOm\Generator\Common\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Interface SessionRepository.
 *
 * @package namespace App\Repositories;
 */
class SessionRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Session::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function createNewSession($input)
    {
        \DB::beginTransaction();
        try {
            $session_data = ['session_name' => $input['session_name'], 'session_start_date' => $input['session_start_date'], 'session_end_date' => $input['session_end_date'], 'affiliated_body_id' => $input['affiliated_body_id']];
            $session = Session::create($session_data);
            for ($i = 0; $i < sizeof($input['course_id']); $i++) {
                if ($input['quota'][$i] > 0 || $input['quota'][$i] != '0') {
                    $sessionCourses = new SessionCourse();
                    $sessionCourses->session_id = $session->id;
                    $sessionCourses->course_id = $input['course_id'][$i];
                    $sessionCourses->academic_term_id = $input['academic_term_id'][$i];
                    $sessionCourses->quota = $input['quota'][$i];
                    $sessionCourses->tution_fee = $input['tution_fee'][$i];
                    $sessionCourses->min_installments = $input['min_installments'][$i];
                    $sessionCourses->max_installments = $input['max_installments'][$i];
                    $sessionCourses->min_discount = $input['min_discount'][$i];
                    $sessionCourses->max_discount = $input['max_discount'][$i];
                    $sessionCourses->save();
                }
            }
            \DB::commit();
            return true;
        } catch (\Exception $e) {
            dd($e);
            \DB::rollback();
            return false;
        }

    }

    public function updateSession($session, $input)
    {

        \DB::beginTransaction();
        try {

            // \dd($input);
            $session->session_name = $input['session_name'];
            $session->session_start_date = $input['session_start_date'];
            $session->session_end_date = $input['session_end_date'];
            $session->quota = $input['quota'];
            $session->update();
            $session_courses = $session->sessionCourses;
            $session_course_array = [];
            $count = 0;
            foreach ($session_courses as $session_course) {
                $session_course_array[$count] = $session_course['course_id'];
                $count++;
            }
            $courses_to_add = array_diff($input['courses'], $session_course_array);
            if (!empty($courses_to_add)) {
                foreach ($courses_to_add as $item) {
                    $course_object = ['session_id' => $session->id, 'course_id' => $item];
                    SessionCourse::create($course_object);
                }
            }
            $courses_to_delete = array_diff($session_course_array, $input['courses']);
            if (!empty($courses_to_delete)) {
                foreach ($courses_to_delete as $item) {
                    $course_object = SessionCourse::where('course_id', '=', $item)->first();
                    if (!empty($course_object)) {
                        $course_object->delete($item);
                    }
                }
            }
            \DB::commit();
            return true;
        } catch (\Exception $e) {
            \dd($e);
            \DB::rollback();
            return false;
        }

    }
}
