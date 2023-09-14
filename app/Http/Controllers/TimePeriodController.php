<?php

namespace App\Http\Controllers;

use Alertify;
use App\Models\Course;
use App\Models\Room;
use App\Models\Session;
use App\Models\TeacherSubject;
use App\Models\TimePeriod;
use App\Models\TimePeriodSubjectWeekDay;
use App\Models\TimeSlot;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Response;
use Validator;
use \App\User;

class TimePeriodController extends Controller
{
    public function index(Request $request)
    {
        $TimePeriods = TimePeriod::all();
        return view('timePeriods.index')
            ->with('timeperiods', $TimePeriods);
    }

    public function create()
    {
        $courses = Course::get();

        // $subjects = Subject::get();
        // dd($subjects);
        $timeSlots = TimeSlot::where('slot_type_id', '=', '1')->get()->pluck('name_with_time', 'id');
        $rooms = Room::get()->pluck('name', 'id');
        $users = User::get()->pluck('name', 'id');
        $sessions = Session::get()->pluck('session_name', 'id');

        return view('timePeriods.create')
            ->with('courses', $courses)
            ->with('timeSlots', $timeSlots)
            ->with('rooms', $rooms)
            ->with('users', $users)
            ->with('sessions', $sessions);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $isRepeatTimePeriodRecords = TimePeriod::where('is_repeat', 1)->where('time_slot_id', $input['timeSlot_id'])->where('room_id', $input['room_id']);

        $isNotRepeatTimePeriodRecords = TimePeriod::where('is_repeat', 0)->where('time_slot_id', $input['timeSlot_id'])->where('room_id', $input['room_id']);

        //single makeup class helding check
        if (!isset($input['is_repeat'])) {
            //checking in single class defined already
            $sig_count = $isNotRepeatTimePeriodRecords->where('start_date', $input['start_date'])->count();
            if ($sig_count > 0) {
                Alertify::error('Room occupied on the selected time slot.', $title = null, $options = []);
                return redirect()->back();
            }
            //end checking in single class defined already

            //checking in perodic defined class
            if ($isNotRepeatTimePeriodRecords->count() > 0) {
                $start_dateInrtpr = Carbon::parse($isRepeatTimePeriodRecords->start_date);
                foreach ($isRepeatTimePeriodRecords->timePeriodSubjectWeekDays as $key => $tpswd) {
                    if ($start_dateInrtpr->format('w') == $tpswd->format('w')) {
                        if ($start_dateinrtpr->format('Y-m-d') == $input['start_date']) {
                            Alertify::error('Periodic Room occupied on the selected time slot.', $title = null, $options = []);
                            return redirect()->back();
                        }
                    }
                }
            }

            //end checking in perodic defined class
        }
        //end single makeup class helding check

        //periodic makeup class helding check
        else {
            //checking in single class defined already
            $btw_inrtpr_records = $isNotRepeatTimePeriodRecords->whereBetween('start_date', [$input['start_date'], $input['end_date']])->get();
            foreach ($input['selected_days'] as $selected_day) {
                foreach ($btw_inrtpr_records as $btw_inrtpr_record) {
                    if (Carbon::parse($btw_inrtpr_record->start_date)->format('w') == $selected_day) {
                        Alertify::error('Room occupied on the selected time slots.', $title = null, $options = []);
                        return redirect()->back();
                    }
                }
            }
            //end checking in single class defined already

            //checking in periodic class defined already
            $btw_irtpr_records = $isRepeatTimePeriodRecords->whereBetween('start_date', [$input['start_date'], $input['end_date']])->get();

            foreach ($btw_irtpr_records as $btw_irtpr_record) {
                foreach ($input['selected_days'] as $selected_day) {
                    $irtpr_record_start_date = Carbon::parse($btw_irtpr_record->start_date);
                    $irtpr_record_end_date = Carbon::parse($btw_irtpr_record->end_date);
                    do {
                        if ($irtpr_record_start_date->format('w') == $selected_day) {
                            Alertify::error('Room occupied on the selected time slots.', $title = null, $options = []);
                            return redirect()->back();
                        }
                        $irtpr_record_start_date = $irtpr_record_start_date->addDay();
                    } while ($irtpr_record_start_date <= $irtpr_record_end_date);
                }
            }
            //end checking in periodic class defined already
        }
        //end periodic makeup class helding check

        try {
            \DB::beginTransaction();

            $rules = array(
                //
            );
            $messages = array(
                //
            );

            $validator = Validator::make(Input::all(), $rules, $messages);
            if ($validator->fails()) {
                foreach ($validator->errors() as $key => $error) {
                    Alertify::error($error, $title = null, $options = []);
                }
                return redirect()->back();
            } else {

                if (isset($input['is_repeat'])) {
                    $timePeriod = new TimePeriod();
                    $timePeriod->course_id = $input['course_id'];
                    $timePeriod->section_id = $input['section_id'];
                    $timePeriod->subject_id = $input['subject_id'];
                    $timePeriod->time_slot_id = $input['timeSlot_id'];
                    $timePeriod->semester_id = $input['semester_id'];
                    $timePeriod->session_id = $input['session_id'];
                    $timePeriod->room_id = $input['room_id'];
                    $timePeriod->user_id = $input['user_id'];
                    $timePeriod->start_date = $input['start_date'];
                    $timePeriod->is_repeat = true;
                    $timePeriod->end_date = $input['end_date'];
                    $timePeriod->save();

                    foreach ($input['selected_days'] as $value) {

                        $timePeriodSubjectWeekDay = new TimePeriodSubjectWeekDay();
                        $timePeriodSubjectWeekDay->time_period_id = $timePeriod->id;

                        $timePeriodSubjectWeekDay->week_day_id = $value;
                        //dd(config('constants.week_days')[$value]);
                        $timePeriodSubjectWeekDay->week_day_name = config('constants.week_days')[$value];
                        $timePeriodSubjectWeekDay->save();
                        //  dd('hi');
                    }
                } else {

                    $timePeriod = new TimePeriod();
                    $timePeriod->course_id = $input['course_id'];
                    $timePeriod->section_id = $input['section_id'];
                    $timePeriod->subject_id = $input['subject_id'];
                    $timePeriod->time_slot_id = $input['timeSlot_id'];
                    $timePeriod->semester_id = $input['semester_id'];
                    $timePeriod->session_id = $input['session_id'];
                    $timePeriod->room_id = $input['room_id'];
                    $timePeriod->user_id = $input['user_id'];
                    $timePeriod->start_date = $input['start_date'];
                    $timePeriod->is_repeat = false;
                    $timePeriod->save();
                }
            }

            //  dd($input);
            \DB::commit();
            return redirect()->back();

        } catch (\Exception $e) {
            dd($e);
            \DB::rollback();
            Alertify::error('Something went wrong.', $title = null, $options = []);
            return redirect()->back();
        }

    }

    public function getDetails(Request $request)
    {
        $input = $request->all();
        $available = array();
        $notavailable = array();
        $final = array();
        $dates = array();
        $dates2 = array();
        $timePeriod = TimePeriod::where('room_id', '=', $input['room_id'])->where('time_slot_id', '=', $input['time_slot_id'])->get()->toArray();
        $all = array(sizeof($timePeriod));
        for ($i = 0; $i < sizeof($timePeriod); $i++) {

            $start0 = strtotime($timePeriod[$i]['start_date']);
            $end0 = strtotime($timePeriod[$i]['end_date']);
            $cj = 0;
            for ($j = $start0; $j <= $end0; $j = $j + 86400) {
                $thisDate = date('Y-m-d', $j);

                $dates[$cj] = $thisDate;
                $cj++;

            }

            $start = strtotime($input['start_date']);
            $end = strtotime($input['end_date']);
            $count = 0;
            for ($k = $start; $k <= $end; $k = $k + 86400) {
                $thisDate = date('Y-m-d', $k);
                $flag = 0;

                for ($z = 0; $z < sizeof($dates); $z++) {

                    if ($dates[$z] != $thisDate) {

                        $flag++;

                        if ($flag == sizeof($dates)) {

                            $final[$count] = $thisDate;
                            $count++;

                        }

                    }
                }

            }
            $all[$i] = $final;

        }

        return response()->json(['success' => 'true', 'final' => $final, 'all' => $all]);
    }
    public function facultyCheck(Request $request)
    {

        $input = $request->all();
        $users = new User();
        $teacher_subjects = TeacherSubject::where('subject_id', $input['subject_id'])->get()->pluck('user_id');

        foreach ($teacher_subjects as $key => $teacher_subject) {
            $user_ids[$key] = $teacher_subject;
        }
        $users = User::whereIn('id', $user_ids);

        $isRepeatTimePeriodRecords = TimePeriod::where('is_repeat', 1)->where('time_slot_id', $input['timeSlot_id'])->where('room_id', $input['room_id']);

        $isNotRepeatTimePeriodRecords = TimePeriod::where('is_repeat', 0)->where('time_slot_id', $input['timeSlot_id'])->where('room_id', $input['room_id']);
        // dd($request->all());

        // if user about to create a makup class
        if (!isset($input['is_repeat'])) {
            $inrtpr_users = $isNotRepeatTimePeriodRecords->where('start_date', $input['start_date'])->get()->pluck('user_id');
            //if faculty exists in single time period
            if ($inrtpr_users->count() > 0) {
                foreach ($inrtpr_users as $key => $val) {
                    $users = $users->where('id', '!=', $val);
                }
            }

            $isRepeatTimePeriodRecords = $isRepeatTimePeriodRecords->where('start_date', '<=', $input['start_date'])->where('end_date', '>=', $input['start_date']);

            // if faculty exists in periodic time period
            $input_startDate = Carbon::parse($input['start_date']);
            if ($isRepeatTimePeriodRecords->count() > 0) {
                foreach ($isRepeatTimePeriodRecords->get() as $key => $irtpr) {
                    foreach ($irtpr->timePeriodSubjectWeekDays as $key => $tpswd) {
                        if ($input_startDate->format('w') == $tpswd->week_day_id) {
                            $users = $users->where('id', '!=', $irtpr->user_id);
                        }
                    }
                }
            }
        }
        //if user about to define a periodic time period
        else {
            // checking in single makeup class
            $isNotRepeatTimePeriodRecords = $isNotRepeatTimePeriodRecords->whereBetween('start_date', [$input['start_date'], $input['end_date']]);
            if ($isNotRepeatTimePeriodRecords->count() > 0) {
                $input_start_date = Carbon::parse($input['start_date']);
                foreach ($isNotRepeatTimePeriodRecords->get() as $key => $inrtpr) {
                    do {
                        if ($inrtpr->start_date == $input_start_date->format('Y-m-d')) {
                            $instpr_start_date = Carbon::parse($inrtpr->start_date);
                            foreach ($input['selected_days'] as $inp_sel_day) {
                                if ($inp_sel_day == $instpr_start_date->format('w')) {
                                    $users = $users->where('id', '!=', $inrtpr->user_id);
                                }
                            }
                        }

                        $input_start_date = $input_start_date->addDay();
                    } while ($input_start_date <= $input['end_date']);
                }
            }

            //checking in periodic time period
            $btw_irtpr_records = $isRepeatTimePeriodRecords->whereBetween('start_date', [$input['start_date'], $input['end_date']]);
            if ($btw_irtpr_records->count() > 0) {
                foreach ($btw_irtpr_records->get() as $btw_irtpr_record) {

                    $irtpr_record_start_date = Carbon::parse($btw_irtpr_record->start_date);
                    $irtpr_record_end_date = Carbon::parse($btw_irtpr_record->end_date);
                    foreach ($btw_irtpr_record->timePeriodSubjectWeekDays as $tp_weekDay) {
                        do {
                            foreach ($input['selected_days'] as $selected_day) {
                                if ($tp_weekDay->week_day_id == $irtpr_record_start_date->format('w')) {
                                    if ($irtpr_record_start_date->format('w') == $selected_day) {
                                        $users = $users->where('id', '!=', $btw_irtpr_record->user_id);
                                    }
                                }
                            }
                            $irtpr_record_start_date = $irtpr_record_start_date->addDay();
                        } while ($irtpr_record_start_date <= $irtpr_record_end_date);
                    }
                }
            }
        }

        $users = $users->get()->pluck('name', 'id');
        return view('ajax.faculty-partial-view')
            ->with('users', $users);
    }

    public function delete($id)
    {
        $timeperiod = TimePeriod::find($id);

        if (empty($timeperiod)) {
            return redirect(route('timeperiods.index'));
        }
        TimePeriodSubjectWeekDay::where('time_period_id', $id)->delete();
        $timeperiod->delete();
        return redirect(route('timePeriods.index'));
    }

}
