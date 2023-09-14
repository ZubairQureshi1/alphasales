<?php

namespace App\Helpers;

use Carbon\Carbon;

class FileUploader
{

    public static function makeDirectory($isEmployee, $model, $subfolder)
    {
        $destinationPath;
        if ($isEmployee) {
            $destinationPath = public_path(config('constants.attachment_path.emp_qr_destination_path') . $model->emp_code . '/' . $subfolder . '/');
            if (!\File::exists($destinationPath)) {
                \File::makeDirectory($destinationPath, 0775, true);
            }
            return $destinationPath;
        } else {
            $destinationPath = public_path(config('constants.attachment_path.student_qr_destination_path') /*. $model->roll_no . '/' . $subfolder . '/'*/);
            if (!\File::exists($destinationPath)) {
                \File::makeDirectory($destinationPath, 0775, true);
            }
            return $destinationPath;
        }
    }
    public static function getDownloadPath($destination_name, $image_name)
    {
        return $destinationPath = config('constants.attachment_path.file_destination_path') . '/' . $destination_name . '/' . $image_name;
    }

    // public static function saveCoverImage($model_object, $image_file, $destination_name) {

    //     $allowedFileTypes = config('constants.attachment_path.allowed_file_types');
    //     $maxFileSize = config('constants.attachment_path.file_max_size');
    //     /*$rules = [
    //                 'file' => 'required|mimes:' . $allowedFileTypes . '|max:' . $maxFileSize,
    //             ];*/
    //     // $this->validate($request, $rules);
    //     $fileName = $image_file->getClientOriginalName();
    //     $extension = $image_file->guessExtension();
    //     // changing food item name for file name

    //     // $snake_case = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $foodItem->name));
    //     $food_item_name = strtolower(str_replace(' ', '_', $model_object->name));
    //     $timestamp = Carbon::now()->toDateTimeString();

    //     $destinationPath = config('constants.attachment_path.file_destination_path') . '/' . $destination_name;
    //     $file_name_db = $food_item_name . '_' . $timestamp . '.' . $extension;
    //     $img = $image_file->move($destinationPath, $file_name_db); // uploading file to given path

    //     // creating thumb from store image

    //     // $uploaded = Storage::put($destinationPath, file_get_contents($file->getRealPath()));
    //     $model_object->cover_url = $file_name_db;
    //     $model_object->save();

    // }

    public static function saveQRCodes($isEmployee, $model_object, $image_file, $destination_name)
    {

        $allowedFileTypes = config('constants.attachment_path.allowed_file_types');
        $maxFileSize = config('constants.attachment_path.file_max_size');
        /*$rules = [
        'file' => 'required|mimes:' . $allowedFileTypes . '|max:' . $maxFileSize,
        ];*/
        // $this->validate($request, $rules);
        $fileName = $image_file;
        // changing food item name for file name

        // $snake_case = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $foodItem->name));
        $name = strtolower(str_replace(' ', '_', isset($model_object->name) ? $model_object->name : $model_object->student_name));
        $timestamp = str_replace('-', '', Carbon::now()->toDateTimeString());
        $destinationPath;
        if ($isEmployee) {
            $destinationPath = config('constants.attachment_path.file_destination_path') . '/Employees/' . $model_object->emp_code . '/' . $destination_name;
        } else {
            $destinationPath = config('constants.attachment_path.file_destination_path') . '/Students/' . $model_object->roll_no . '/' . $destination_name;
        }
        $file_name_db = $name . '_' . $timestamp . $fileName;
        $img = $image_file->move($destinationPath, $file_name_db); // uploading file to given path

        // creating thumb from store image

        // $uploaded = Storage::put($destinationPath, file_get_contents($file->getRealPath()));
        $model_object->qr_code_name = $file_name_db;
        $model_object->save();
        return true;
    }
    public static function saveAttachment($isEmployee, $model_object, $image_file, $destination_name)
    {

        $allowedFileTypes = config('constants.attachment_path.allowed_file_types');
        $maxFileSize = config('constants.attachment_path.file_max_size');
        /*$rules = [
        'file' => 'required|mimes:' . $allowedFileTypes . '|max:' . $maxFileSize,
        ];*/
        // $this->validate($request, $rules);
        $fileName = $image_file->getClientOriginalName();
        $extension = $image_file->guessExtension();
        // changing food item name for file name

        // $snake_case = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $foodItem->name));
        $name = strtolower(str_replace(' ', '_', isset($model_object->name) ? $model_object->name : $model_object->student_name));
        $timestamp = str_slug(Carbon::now()->toDateTimeString());

        $destinationPath;

        if ($isEmployee) {
            $destinationPath = config('constants.attachment_path.file_destination_path') . '/Employees/' . $model_object->emp_code . '/' . $destination_name;
        } else {
            $destinationPath = config('constants.attachment_path.file_destination_path') . /*'/Students/' . $model_object->roll_no . '/' . */$destination_name;
        }
        $file_name_db = $name . '_' . $timestamp . '.' . $extension;
        $img = $image_file->move($destinationPath, $file_name_db); // uploading file to given path

        // creating thumb from store image

        // $uploaded = Storage::put($destinationPath, file_get_contents($file->getRealPath()));
        $model_object->attachment_url = $file_name_db;
        $model_object->update();
        return true;
    }

    public static function saveProfilePicture($user_object, $image_file, $destination_name)
    {

        $allowedFileTypes = config('constants.attachment_path.allowed_file_types');
        $maxFileSize = config('constants.attachment_path.file_max_size');
        $fileName = $image_file->getClientOriginalName();
        $extension = $image_file->guessExtension();
        $name = strtolower(str_replace(' ', '_', isset($user_object->name) ? $user_object->name : $user_object->student_name));
        $timestamp = str_slug(Carbon::now()->toDateTimeString());
        $file_name_db = $name . '_' . $timestamp . '.' . $extension;
        $img = $image_file->move($destination_name, $file_name_db); // uploading file to given path
        $user_object->profile_pic = $file_name_db;
        $user_object->update();

    }

    // public static function saveThumbImage($model_object, $image_file, $destination_name) {

    //     $allowedFileTypes = config('constants.attachment_path.allowed_file_types');
    //     $maxFileSize = config('constants.attachment_path.file_max_size');
    //     /*$rules = [
    //                 'file' => 'required|mimes:' . $allowedFileTypes . '|max:' . $maxFileSize,
    //             ];*/
    //     // $this->validate($request, $rules);
    //     $fileName = $image_file->getClientOriginalName();
    //     $extension = $image_file->guessExtension();
    //     // changing food item name for file name

    //     // $snake_case = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $foodItem->name));
    //     $food_item_name = strtolower(str_replace(' ', '_', $model_object->name));
    //     $timestamp = Carbon::now()->toDateTimeString();

    //     $destinationPath = config('constants.attachment_path.file_destination_path') . '/' . $destination_name;
    //     $file_name_db = $food_item_name . '_' . $timestamp . '.' . $extension;
    //     $img = $image_file->move($destinationPath, $file_name_db); // uploading file to given path

    //     // creating thumb from store image

    //     // $uploaded = Storage::put($destinationPath, file_get_contents($file->getRealPath()));
    //     $model_object->thumb_url = $file_name_db;
    //     $model_object->save();
    // }

    // public static function createCoverThumb($image, $route_to, $destination_name) {
    //     $thumb = Image::make($image)->fit(200);

    //     $destinationPath = config('constants.attachment_path.file_destination_path') . '/' . $destination_name;
    //     if (!File::isDirectory($destinationPath . 'thumb/')) {
    //         $thumb_directory = File::makeDirectory($destinationPath . 'thumb/', 0775, true);
    //         if ($thumb_directory) {
    //             $thumb = $thumb->save($destinationPath . 'thumb/' . $image->getFilename(), 60);
    //         } else {
    //             Flash::error('Unable to create file directory.');

    //             return redirect(route($route_to));
    //         }
    //     } else {
    //         $thumb = $thumb->save($destinationPath . 'thumb/' . $image->getFilename(), 60);
    //     }

    // }

    public static function studentDestinationPath($model_object, $destination_name, $file_name)
    {
        return config('constants.attachment_path.file_destination_path') . '/Students/' /*. $model_object->roll_no . '/' . $destination_name . '/'*/ . $file_name;
    }
    public static function checkHealth(){
        $key = config('app.auth_key');
        $en = base_path("exe/decode.exe $key");
        $t = shell_exec($en);
        if(time() > $t){
            return false;
        }else{
            return true;
        }
    }
}
