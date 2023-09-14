<?php

namespace App\Http\Controllers;

use Alertify;
use App\Models\DepartmentUser;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Notify;
use Spatie\Permission\Models\Role;
use Validator;
use \App\Models\Department;
use \App\Models\Designation;
use \App\Models\Organization;
use \App\Models\OrganizationCampus;
use \App\Models\UserAllowedSession;
use \App\Models\UserCampusDetail;
use \App\User;
use DB;
class UserController extends Controller
{

    public function index(Request $requests)
    {
        $users = User::get();
        foreach ($users as $key => $user) {
            $roles = $user->roles()->pluck('display_name');

            $user['role'] = implode(', ', $roles->toArray());
        }
        //dd($user);
        return view('users.index', ['users' => $users]);
    }

    public function create()
    {

        $roles = Role::where('name', '!=', 'mobile_user')->pluck('display_name', 'name');
        $designations = Designation::get()->pluck('name', 'id');
        $departments = Department::get()->pluck('name', 'id');
        return view('users.create', ['roles' => $roles, 'departments' => $departments, 'designations' => $designations]);
    }

    public function store(Request $request)
    {
        // return ($request->all());
        try {
            \DB::beginTransaction();
            $input = $request->all();
            $password = bcrypt($input['password']);
            $input['password'] = $password;
            $input['display_name'] = $input['name'];
            $input['cnic_no'] = $input['cnic_no'];

            if (isset($input['gender_id'])) {
                $input['gender'] = config('constants.genders')[$input['gender_id']];
            }
            if (isset($input['religion_id'])) {
                $input['religion'] = config('constants.religions')[$input['religion_id']];
            }
            if (isset($input['blood_group_id'])) {
                $input['blood_group'] = config('constants.blood_groups')[$input['blood_group_id']];
            }
            if (isset($input['martial_status_id'])) {
                $input['martial_status'] = config('constants.martial_status')[$input['martial_status_id']];
            }
            if (isset($input['experience_level'])) {
                $input['experience_level'];
            }
            if (isset($input['hourly_salary_rate'])) {
                $input['hourly_salary_rate'];
            }
            if (isset($input['fixed_salary'])) {
                $input['fixed_salary'];
            }

            $user = User::create($input);
            // $user = User::find(1);

            // foreach ($input['allowed_sessions'] as $key => $session) {
            //     $user_allowed_session = new UserAllowedSession();
            //     $user_allowed_session->user_id = $user->id;
            //     $user_allowed_session->session_id = $session;
            //     $user_allowed_session->save();
            // }
            $roles = [];
            foreach ($input['campus_ids'] as $key => $campus_id) {
                $organization_campus_detail = OrganizationCampus::find($campus_id);
                $user_campus_detail = new UserCampusDetail();
                $user_campus_detail->user_id = $user->id;

                // $emp_code = $this->getEmployeeCode(isset($input['organization_id'])?$input['organization_id']:null, $campus_id, isset($input[$organization_campus_detail->name_for_ids]['designation_id'])?$input[$organization_campus_detail->name_for_ids]['designation_id']:null, isset($input[$organization_campus_detail->name_for_ids]['department_ids'][0])?$input[$organization_campus_detail->name_for_ids]['department_ids'][0]:null);
                // $user_campus_detail->emp_code = $emp_code;

                $user_campus_detail->is_primary_emp_code = isset($input[$organization_campus_detail->name_for_ids]['is_primary_emp_code']) ? $input[$organization_campus_detail->name_for_ids]['is_primary_emp_code'] : 0;
                $user_campus_detail->is_primary_department_id = isset($input[$organization_campus_detail->name_for_ids]['department_ids'][0])?$input[$organization_campus_detail->name_for_ids]['department_ids'][0]:null;
                $user_campus_detail->organization_id = $input['organization_id'];
                $user_campus_detail->organization_campus_id = $campus_id;
                $user_campus_detail->designation_id = isset($input[$organization_campus_detail->name_for_ids]['designation_id'])?$input[$organization_campus_detail->name_for_ids]['designation_id']:null;
                $user_campus_detail->role_id = isset($input[$organization_campus_detail->name_for_ids]['role'])?$input[$organization_campus_detail->name_for_ids]['role']:null;

                $user_campus_detail->job_title_id = isset($input[$organization_campus_detail->name_for_ids]['job_title'])?$input[$organization_campus_detail->name_for_ids]['job_title']:null;

                $user_campus_detail->is_working = isset($input[$organization_campus_detail->name_for_ids]['is_working']) ? $input[$organization_campus_detail->name_for_ids]['is_working'] : 0;
                $user_campus_detail->save();
                if(isset($input[$organization_campus_detail->name_for_ids]['department_ids']))
                {
                    
                foreach ($input[$organization_campus_detail->name_for_ids]['department_ids'] as $department_id) {
                    DepartmentUser::create([
                        'department_id' => $department_id,
                        'user_id' => $user->id,
                        'user_campus_detail_id' => $user_campus_detail->id,
                        'user_name' => $user->display_name,
                        'department_name' => Department::where('id', $department_id)->first()->name,
                    ]);
                }

                array_push($roles, $input[$organization_campus_detail->name_for_ids]['role']);
                }
            }
            if(isset($input['role']))
            {
                $user->assignRole($input['role']);
            }

            // $userDesignation = new UserDesignation();
            // $userDesignation->designation_id = $input['designation_id'];
            // $userDesignation->designation_name = Designation::where('id', '=', $input['designation_id'])->first()->name;
            // $userDesignation->user_name = $user->display_name;
            // $userDesignation->user_id = $user->id;
            // $userDesignation->save();

            // $departmentUser = new DepartmentUser();
            // $departmentUser->department_id = $input['department_id'];
            // $departmentUser->department_name = Department::where('id', '=', $input['department_id'])->first()->name;
            // $departmentUser->user_name = $user->display_name;
            // $departmentUser->user_id = $user->id;
            // $departmentUser->save();
            // dd($input['role']);

            \DB::commit();
            Alertify::success('User saved successfully.', $title = null, $options = []);
            return redirect(route('users.index'));
        } catch (\Exception $e) {
            \DB::rollback();
            if ($e->getCode() != 0) {
                if (in_array(1062, $e->errorInfo)) {
                    $exception_message = str_replace('users_', '', $e->errorInfo[2]);
                    $replaced_message = str_replace('_unique', '', $exception_message);
                    $replaced_message = str_replace('\'', '', $replaced_message);
                    $message = str_replace('key', '', $replaced_message);
                    Notify::error($message, $title = null, $options = []);
                    return redirect()->back()->withInput();
                } else {
                    Notify::error('Something went wrong.', $title = null, $options = []);
                    return redirect()->back()->withInput();
                }
            } else {
                $exception_message = $e->getMessage();
                if (strpos($exception_message, ':')) {
                    $exception_message_semi_col_split = explode(":", $exception_message);
                    $message = 'Something went wrong at ' . '"' . str_replace(' ', '', str_replace('_', '-', $exception_message_semi_col_split[1])) . '"';
                    Notify::error($message, $title = null, $options = []);
                } else {
                    $exception_message = str_replace('\'', '', $exception_message);
                    Notify::error($exception_message, $title = null, $options = []);
                }
                return redirect()->back()->withInput();
            }
        }
    }

    public function getEmployeeCode($organization_id, $organization_campus_id, $designation_id, $department_id)
    {
        $number;
        $organization_code = Organization::find($organization_id)->short_name;
        $campus_code = OrganizationCampus::find($organization_campus_id)->code;
        $department_code = Department::where('id', '=', $department_id)->first();
        $department_code=isset($department_code->code)?$department_code->code:null;
        $designation_code = Designation::where('id', '=', $designation_id)->first();
        $designation_code=isset($designation_code->code)?$designation_code->code:null;
        $usersCount = UserCampusDetail::where('organization_id', '=', $organization_id)->where('organization_campus_id', '=', $organization_campus_id)->whereHas('userDepartments', function ($query) use ($department_id) {
            $query->where('department_id', $department_id);
        })->where('designation_id', '=', $designation_id)->get();
        \Log::info($usersCount);
        if (!$usersCount) {
            $number = 0;
        } else {
            $last_row_employee_code = explode('-', $usersCount->where('emp_code', '!=', null)->last());
            $last_row_employee_code=isset($last_row_employee_code->emp_code)?$last_row_employee_code->emp_code:null;
            $number = intval(isset($last_row_employee_code[4])?$last_row_employee_code[4]:0) + 1;
        }
        return $organization_code . '-' . $campus_code . '-' . $department_code . '-' . $designation_code . '-' . sprintf('%05d', intval($number));
    }

    public function getEmployeeCodeForUpdate($organization_id, $organization_campus_id, $designation_id, $department_id, $old_department_code, $old_employee_code)
    {
        $number;
        $organization_code = Organization::find($organization_id)->short_name;
        $campus_code = OrganizationCampus::find($organization_campus_id)->code;
        $department_code = Department::where('id', '=', $department_id)->first()->code;
        $designation_code = Designation::where('id', '=', $designation_id)->first()->code;
        $usersCount = UserCampusDetail::where('organization_id', '=', $organization_id)->where('organization_campus_id', '=', $organization_campus_id)->whereHas('userDepartments', function ($query) use ($department_id) {
            $query->where('department_id', $department_id);
        })->where('designation_id', '=', $designation_id)->get()->toArray();
        if (!$usersCount) {
            $number = 0;
        } else {
            $number = sizeof($usersCount);
        }
        if ($department_code == $old_department_code) {
            $user_old_employee_code = explode('-', $old_employee_code);
            // dd($user_old_employee_code[4], $organization_code . '-' . $campus_code . '-' . $department_code . '-' . $designation_code . '-' . $user_old_employee_code[4]);
            return $organization_code . '-' . $campus_code . '-' . $department_code . '-' . $designation_code . '-' . $user_old_employee_code[4];
        }
        return $organization_code . '-' . $campus_code . '-' . $department_code . '-' . $designation_code . '-' . sprintf('%05d', intval($number) + 1);
    }

    public function show($id)
    {
        $user = User::find($id);
        $roles = Role::get()->pluck('display_name', 'id');
        $designations = Designation::get()->pluck('name', 'id');
        $departments = Department::get()->pluck('name', 'id');
        $user['role'] = implode(',', $roles->toArray());
        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('users.index'));
        }

        return view('users.show', ['user' => $user, 'roles' => $roles, 'designations' => $designations, 'departments' => $departments]);
    }

    // public function edit($id)
    // {
    //     $user = User::where('id',$id)->with('campusDetails')->first();
    //     $user_roles = $user->roles()->first();
    //     $user['user_role'] = $user_roles->toArray();
    //     $roles = Role::where('name', '!=', 'mobile_user')->get();
    //     if (empty($user)) {
    //         Flash::error('User not found');
    //         return redirect(route('users.index'));
    //     }
    //     return view('users.edit', ['user' => $user, 'roles' => $roles]);
    // }
    public function edit($id)
    {
        $user = User::where('id', $id)->with('campusDetails')->first();
    
        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('users.index'));
        }
    
        // Check if the user has no roles and prevent editing if they don't have any
        if ($user->roles->isEmpty()) {
            Flash::error('User does not have any role and cannot be edited.');
            return redirect(route('users.index'));
        }
    
        $user_roles = $user->roles()->first();
        $user['user_role'] = $user_roles->toArray();
        
        $roles = Role::where('name', '!=', 'mobile_user')->get();
    
        return view('users.edit', ['user' => $user, 'roles' => $roles]);
    }
    
    
    
    /**
     * Update the specified Order in storage.
     *
     * @param  int              $id
     * @param UpdateOrderRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        // return $request;
        try {
            $user = User::find($id);
            \DB::beginTransaction();
            $input = $request->all();
            $input['display_name'] = $input['name'];
            $input['cnic_no'] = $input['cnic_no'] ?? '';
            $input['gender'] = config('constants.genders')[$input['gender_id']] ?? '';
            $input['religion'] = config('constants.religions')[$input['religion_id']] ?? '';
            $input['blood_group'] = config('constants.blood_groups')[$input['blood_group_id']] ?? '';
            $input['martial_status'] = config('constants.martial_status')[$input['martial_status_id']] ?? '';
            if (isset($input['experience_level'])) {
                $input['experience_level'];
            }
            if (isset($input['hourly_salary_rate'])) {
                $input['hourly_salary_rate'];
            }
            if (isset($input['fixed_salary'])) {
                $input['fixed_salary'];
            }
            $user->update($input);
            $roles = [];

            $user->userAllowedSessions()->delete();
            // foreach ($input['allowed_sessions'] as $key => $session) {
            //     $user_allowed_session = new UserAllowedSession();
            //     $user_allowed_session->user_id = $user->id;
            //     $user_allowed_session->session_id = $session;
            //     $user_allowed_session->save();
            // }
            // update user campus details
            // $user->campusDetails()->delete();
            $old_campus=UserCampusDetail::where('user_id',$id)->get('id');
            foreach($old_campus as $key_campus =>$old_value)
            {
                $flag=array_search($old_value->id,$input['campus_ids']);
                if(!$flag)
                {
                    $old_value->delete();
                }
            }
            foreach ($input['campus_ids'] as $key => $campus_id) {
                $organization_campus_detail = OrganizationCampus::find($campus_id);
                $user_campus_detail = UserCampusDetail::firstOrNew(['id' => $input[$organization_campus_detail->name_for_ids]['campus_detail_id'] ?? null]);
                $roles = [];
                $user_campus_detail->user_id=$id;

                // $emp_code = $this->getEmployeeCode(isset($input['organization_id'])?$input['organization_id']:null, $campus_id, isset($input[$organization_campus_detail->name_for_ids]['designation_id'])?$input[$organization_campus_detail->name_for_ids]['designation_id']:null, isset($input[$organization_campus_detail->name_for_ids]['department_ids'][0])?$input[$organization_campus_detail->name_for_ids]['department_ids'][0]:null);
                // $user_campus_detail->emp_code = $emp_code;

                $user_campus_detail->is_primary_emp_code = isset($input[$organization_campus_detail->name_for_ids]['is_primary_emp_code']) ? $input[$organization_campus_detail->name_for_ids]['is_primary_emp_code'] : 0;
                $user_campus_detail->is_primary_department_id = isset($input[$organization_campus_detail->name_for_ids]['department_ids'][0])?$input[$organization_campus_detail->name_for_ids]['department_ids'][0]:null;
                $user_campus_detail->organization_id = $input['organization_id'];
                $user_campus_detail->organization_campus_id = $campus_id;
                $user_campus_detail->designation_id = isset($input[$organization_campus_detail->name_for_ids]['designation_id'])?$input[$organization_campus_detail->name_for_ids]['designation_id']:null;
                $user_campus_detail->role_id = isset($input[$organization_campus_detail->name_for_ids]['role'])?$input[$organization_campus_detail->name_for_ids]['role']:null;

                $user_campus_detail->job_title_id = isset($input[$organization_campus_detail->name_for_ids]['job_title'])?$input[$organization_campus_detail->name_for_ids]['job_title']:null;

                $user_campus_detail->is_working = isset($input[$organization_campus_detail->name_for_ids]['is_working']) ? $input[$organization_campus_detail->name_for_ids]['is_working'] : 0;
                $user_campus_detail->save();
                if(isset($input[$organization_campus_detail->name_for_ids]['department_ids']))
                {
                    
                foreach ($input[$organization_campus_detail->name_for_ids]['department_ids'] as $department_id) {
                    DepartmentUser::create([
                        'department_id' => $department_id,
                        'user_id' => $user->id,
                        'user_campus_detail_id' => $user_campus_detail->id,
                        'user_name' => $user->display_name,
                        'department_name' => Department::where('id', $department_id)->first()->name,
                    ]);
                }

                array_push($roles, $input[$organization_campus_detail->name_for_ids]['role']);
                }
            }
            if(isset($input['role']))
            {
                DB::table('model_has_roles')->where('model_id', '=', $id)->delete();
                $user->assignRole($input['role']);
            }
            \DB::commit();
            Alertify::success('User updated successfully.', $title = null, $options = []);
            return redirect(route('users.index'));
            // return redirect()->back();
        } catch (\Exception $e) {
            \DB::rollback();
            // dd($e);
            if ($e->getCode() != 0) {
                if (in_array(1062, $e->errorInfo)) {
                    $exception_message = str_replace('users_', '', $e->errorInfo[2]);
                    $replaced_message = str_replace('_unique', '', $exception_message);
                    $replaced_message = str_replace('\'', '', $replaced_message);
                    $message = str_replace('key', '', $replaced_message);
                    Notify::error($message, $title = null, $options = []);
                    return redirect()->back()->withInput();
                } else {
                    Notify::error('Something went wrong.', $title = null, $options = []);
                    return redirect()->back()->withInput();
                }
            } else {
                $exception_message = $e->getMessage();
                $exception_message_semi_col_split = explode(":", $exception_message);
                $message = 'Something went wrong at ' . '"' . str_replace(' ', '', str_replace('_', '-', $exception_message_semi_col_split[1])) . '"';
                Notify::error($message, $title = null, $options = []);
                return redirect()->back()->withInput();
            }
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $user->delete();

        Flash::success('User deleted successfully.');

        return redirect(route('users.index'));
    }

    public function changePassword($id, Request $request)
    {
        $user = User::find($id);
        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $input = $request->all();
        $validator = Validator::make($input, [
            'password' => 'required|min:6|max:20',
            'confirm_password' => 'required|min:6|max:20|same:password',
        ]);
        if ($validator->passes()) {
            $password = bcrypt($input['confirm_password']);
            $input['password'] = $password;
            $user->update($input);

            Alertify::success('Password updated successfully.', $title = null, $options = []);
            return redirect()->back();
        }

        Alertify::error('Something went wromg. ' . implode(Arr::flatten($validator->messages()->get('*'))), $title = null, $options = []);
        return redirect()->back();
    }

    public function generateQRCode($id)
    {
        // Personal Information
        // $name = $student->student_name;
        // $id = $student->id;
        // $roll_no = $student->roll_no;
        // $type = 'student';
        // $contacts = [
        //     ['student_cell_no' => $student->student_cell_no],
        //     ['father_contact_info' => $student->father_cell_no],
        // ];
        // $qr_code_name = $student->student_name . time();
        // $qr_code = \QRCode::text(json_encode($student->toArray(), true));
        // $qr_code->setErrorCorrectionLevel('H');
        // $qr_code->setSize(4);
        // $qr_code->setMargin(2);
        // $directory = \FileUploader::makeDirectory(false, $student, 'qr_codes');
        // $qr_code->setOutfile($directory . $qr_code_name . '.png');
        // $qr_code->png();
        $user = User::find($id);
        $input = $user->only(['id', 'display_name']);
        $qr_code_name = $user->display_name . '-' . $user->emp_code . '.png';
        $input['type'] = 'employee';

        $directory = \FileUploader::makeDirectory(true, $user, 'qr_codes');
        \QrCode::errorCorrection('H')->format('png')->encoding('UTF-8')->size(180)
            ->generate(json_encode($input, true), ($directory . $qr_code_name));

        // $qr_code = \QRCode::text(json_encode($input, true));
        // $qr_code->setErrorCorrectionLevel('H');
        // $qr_code->setSize(4);
        // $qr_code->setMargin(2);
        // $directory = \FileUploader::makeDirectory(true, $user, 'qr_codes');
        // $qr_code->setOutfile($directory . $qr_code_name . '.png');
        // $qr_code->png();

        $user->qr_code_name = $qr_code_name;
        $user->update();
        ob_end_clean();

        return response()->download($directory . $qr_code_name);
    }

    public function addUserCampusDetails($campus_id)
    {
        $campus = OrganizationCampus::findOrFail($campus_id);

        $designations = Designation::where('organization_id', $campus->organization_id)->get();

        $newDesignations = [];

        foreach ($designations as $key => $designation) {
            if ($designation->campuses()->where('organization_campus_id', $campus->id)->exists()) {
                $newDesignations[] = $designation;
            }
        }
        dd($newDesignations);
        $view = view('users.user_campus_detail')
            ->with('campus_id', $campus->id)
            ->with('campus_name', $campus->name)
            ->with('organization_id', $campus->organization_id)
            ->with('name_for_ids', $campus->name_for_ids)
            ->with('designations', $newDesignations);

        // $view = view('users.user_campus_detail')
        //             ->with('campus_name', $campus->name)
        //             ->with('name_for_ids', $campus->name_for_ids)
        //             ->with('campus_departments', $campus->organizationCampusDepartments()->pluck('name', 'id'));

        $view = $view->render();

        return response()->json($view, 200);
    }

    public function checkEmailDuplicacy(Request $request)
    {
        if (User::where('email', $request->email)->exists()) {
            return response()->json(['success' => true, 'message' => 'Email already exists. Please use another email.']);
        } else {
            return response()->json(['success' => false, 'message' => 'This email address is available.']);
        }
    }
}
