<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
use Image;

class ProfileController extends Controller
{

    public function index(Request $request)
    {

        $user = Auth::user();
    
        // $user=collect($user);
        return view('profiles.index')->with('user', $user);
    }

    public function update_details(Request $request)
    {

        $input = $request->all();
        $user = Auth::user();
        if ($input['name'] != null) {
            $user->name = $input['name'];
            $user->display_name = $input['name'];
        }
        if ($input['father_name'] != null) {
            $user->father_name = $input['father_name'];
        }
        if ($input['age'] != null) {
            $user->age = $input['age'];
        }
        if ($input['d_o_b'] != null) {
            $user->d_o_b = $input['d_o_b'];
        }
        if ($input['mobile_no'] != null) {
            $user->mobile_no = $input['mobile_no'];
        }
        if ($input['landline_no'] != null) {
            $user->landline_no = $input['landline_no'];
        }
        if ($input['email'] != null) {
            $user->email = $input['email'];
        }
        if ($input['cnic_no'] != null) {
            $user->cnic_no = $input['cnic_no'];
        }
        // if ($input['cnic_expiry'] != null) {
        //     $user->cnic_expiry = $input['cnic_expiry'];
        // }
        // if ($input['cnic_expiry'] != null) {
        //     $user->cnic_expiry = $input['cnic_expiry'];
        // }
        if ($input['gender_id'] != null) {
            $user->gender = config('constants.genders')[$input['gender_id']];
            $user->gender_id = $input['gender_id'];
        }
        if ($input['religion_id'] != null) {
            $user->religion = config('constants.religions')[$input['religion_id']];
            $user->religion_id = $input['religion_id'];
        }
        if ($input['blood_group_id'] != null) {
            $user->blood_group = config('constants.blood_groups')[$input['blood_group_id']];
            $user->blood_group_id = $input['blood_group_id'];
        }
        if ($input['martial_status_id'] != null) {
            $user->martial_status = config('constants.martial_status')[$input['martial_status_id']];
            $user->martial_status_id = $input['martial_status_id'];
        }

        $user->update();

        // dd($input['role']);

        //  Alertify::success('User saved successfully.', $title = null, $options = []);
        return redirect('profiles');

    }
    public function update_avatar(Request $request)
    {

        $user = Auth::user();
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            //dd($avatar);
            $directory = \FileUploader::makeDirectory(true, $user, 'profile_picture');

            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save($directory . $filename);

            $user->profile_pic_url = $filename;

            $user->save();
        }

        return redirect('profiles');

    }

}
