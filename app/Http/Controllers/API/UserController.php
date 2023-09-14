<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $input = $request->all();
        $return_data = [];
        if ($input['type'] == 'student') {
            $student = Student::where('roll_no', '=', $input['email'])->get()->first();
            if (empty($student)) {
                return response()->json(['success' => false, 'message' => 'Incorrect Credentials'], 401);
            }
            $return_data['user'] = $student;
            return response()->json(['success' => true, 'message' => 'User Loggedin Successfully', $return_data], 200);
        } else if ($input['type'] == 'employee') {

            $user = User::with('roles', 'roles.permissions')->where('email', '=', $input['email'])->get()->first();
            if (empty($user)) {
                return response()->json(['success' => false, 'message' => 'Incorrect Credentials'], 401);
            }
            $return_data['user'] = $user;
            return response()->json(['success' => true, 'message' => 'User Loggedin Successfully', 'data' => $return_data], 200);
        }
    }

    public function getUsersForDevice()
    {
        $users = User::has('campusDetails')->orderBy('id', 'ASC')->get();
        if ($users) {
            return response()->json($users, 200);
        }
    }

    public function getStudentsForDevice()
    {
        $students =  Student::orderByRaw('length(roll_no)', 'ASC')->orderBy('roll_no', 'ASC')->get(['id','student_name', 'gender', 'admission_id', 'organization_campus_id', 'session_id', 'course_id', 'student_category_id']);
        if ($students) {
            return response()->json($students, 200);
        }
    }

}
