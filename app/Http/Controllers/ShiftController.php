<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use App\Models\TimeSlot;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as SystemSession;

class ShiftController extends Controller
{

    public function index(Request $request)
    {
        // $users = User::whereHas('campusDetails',function(Builder $q){
        //     return $q->where('organization_campus_id', SystemSession::get('organization_campus_id'));
        // })->get();
        // $roster_users = [];
        // foreach ($users as $key => $user) {
        //     $user['title'] = $user['display_name'];
        //     $roster_obj = ['resourceId' => $user['id'], 'user_name' => $user['display_name'], 'className' => [$user['id'] . '_shift_day_' . $key]];

        //     $user_shifts = $user->shifts()->get();
        //     if (!empty($user_shifts) && count($user_shifts) != 0) {
        //         foreach ($user_shifts as $value) {
        //             $shift_obj = $value;
        //             // $shift_working_days = $shift_obj->shiftWorkingDays()->get();
        //             if ($value->is_week_day) {
        //                 $shift_time_slot = TimeSlot::find($shift_obj->time_slot_id);
        //                 if ($shift_time_slot == null) {
        //                     $time_slot_name = '---';
        //                 } else {
        //                     $time_slot_name = $shift_time_slot->name . '\n(' . $shift_time_slot->start_time . ' - ' . $shift_time_slot->end_time . ')';
        //                 }
        //                 // $time_slot_name = $shift_time_slot->name_with_time;
        //                 // dd($time_slot_name);

        //                 // $shift_dates = $shift_obj->shiftDates()->get();
        //                 // dd($user_shifts->last()->shift()->get()->first()->shiftDates()->get()->toArray());
        //                 // foreach ($shift_dates as $key => $shift_date) {
        //                 // if (!empty($shift_working_days) && count($shift_working_days) > 0) {
        //                 // foreach ($shift_working_days as $key => $shift_working_day) {
        //                 // dd($date_increment->format('l') . '-----' . $shift_working_day->week_day);
        //                 $roster_obj['backgroundColor'] = '#5CCA78';
        //                 $roster_obj['title'] = $time_slot_name;
        //                 $roster_obj['shift_id'] = $value->id;
        //                 $roster_obj['start'] = $value->date->format('Y-m-d');
        //                 $roster_obj['date_format'] = $value->date->format('l, d-M-Y');
        //                 // break;
        //             } else {
        //                 $roster_obj['title'] = 'Day-off';
        //                 $roster_obj['shift_id'] = $value->id;
        //                 $roster_obj['start'] = $value->date->format('Y-m-d');
        //                 $roster_obj['backgroundColor'] = '#cc808b';
        //                 $roster_obj['date_format'] = $value->date->format('l, d-M-Y');
        //             }
        //             //     }
        //             // } else {
        //             //     $roster_obj['backgroundColor'] = '#2f8ee0';
        //             //     $roster_obj['title'] = $time_slot_name;
        //             //     $roster_obj['shift_date_id'] = $shift_date->id;
        //             //     $roster_obj['start'] = $shift_date->date->format('Y-m-d');
        //             // }
        //             array_push($roster_users, $roster_obj);
        //             // }
        //         }
        //     }
        // }
        // // dd($roster_users);
        return view('userShifts.index');
        // return view('userShifts.index', ['users' => $users->toArray(), 'roster' => $roster_users]);
    }

    public function deleteShift($id)
    {
        $shift = Shift::find($id);
        if (!empty($shift)) {
            $shift->delete();
            return response()->json(['success' => true, 'message' => 'Shift for day deleted successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Shift not found']);
        }
    }

    public function calculateDateDiff($start, $end)
    {
        if ($end > $start) {
            $diff = date_diff($end, $start);
            $diff = $diff->days + $diff->invert;
            return $diff;
        } else {
            return 0;
        }
    }

    public function create()
    {
        $users = User::whereHas('campusDetails', function (Builder $q) {
            return $q->where('organization_campus_id', SystemSession::get('organization_campus_id'));
        })->pluck('name', 'id');
        $timeSlots = TimeSlot::get()->pluck('name_with_time', 'id');
        return view('userShifts.create')->with(['users' => $users])->with(['timeSlots' => $timeSlots]);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        // if (isset($input['is_repeat'])) {
        foreach ($input['users'] as $value) {
            $start_date = new \DateTime($input['start_date']);
            if (isset($input['end_date'])) {
                $end_date = new \DateTime($input['end_date']);
                do {
                    $shift                         = new Shift();
                    $shift->user_id                = $value;
                    $shift->month_id               = $start_date->format('m');
                    $shift->year                   = $start_date->format('Y');
                    $shift->date                   = $start_date;
                    $shift->is_active              = true;
                    $shift->organization_campus_id = SystemSession::get('organization_campus_id');

                    if (in_array($start_date->format('w'), $input['selected_days'])) {
                        // \Log::info($input['time_slot_id'][$start_date->format('w')]);
                        $shift->time_slot_id = $input['time_slot_id'][$start_date->format('w')];
                        $shift->is_week_day  = true;
                        $shift->save();
                    } else if (in_array($start_date->format('w'), $input['selected_off_days'])) {
                        // \Log::debug($input['time_slot_id'][$start_date->format('w')]);
                        $shift->is_week_day = false;
                        $shift->save();
                    }
                    $start_date->modify('+1day');
                } while ($start_date <= $end_date);
            } else {
                $shift                         = new Shift();
                $shift->user_id                = $value;
                $shift->month_id               = $start_date->format('m');
                $shift->year                   = $start_date->format('Y');
                $shift->date                   = $start_date;
                $shift->is_active              = true;
                $shift->time_slot_id           = $input['time_slot_id'];
                $shift->is_week_day            = true;
                $shift->organization_campus_id = SystemSession::get('organization_campus_id');
                $shift->save();
            }

            // $shiftWorkingDay = new ShiftUser();
            // $shiftWorkingDay->shift_id = $shift->id;
            // $shiftWorkingDay->is_shift_active = $shift->is_active;
            // $shiftWorkingDay->save();

            // foreach ($input['selected_days'] as $value) {
            //     $shiftWorkingDay = new ShiftWorkingDay();
            //     $shiftWorkingDay->shift_id = $shift->id;
            //     $shiftWorkingDay->week_day_id = $value;
            //     $shiftWorkingDay->week_day = config('constants.week_days')[$value];
            //     $shiftWorkingDay->save();
            // }
        }
        // } else {

        //     foreach ($input['users'] as $value) {
        //         $start_date = new \DateTime($input['start_date']);
        //         $shift = new Shift();
        //         $shift->time_slot_id = $input['time_slot_id'];
        //         $shift->user_id = $value;
        //         $shift->is_active = true;
        //         $shift->month_id = $start_date->format('m');
        //         $shift->year = $start_date->format('Y');
        //         $shift->save();

        //         // $shiftWorkingDay = new ShiftUser();
        //         // $shiftWorkingDay->shift_id = $shift->id;
        //         // $shiftWorkingDay->is_shift_active = $shift->is_active;
        //         // $shiftWorkingDay->save();
        //         // $shift->is_repeat = true;
        //         $shift_date = new ShiftDate();
        //         $shift_date->date = $start_date;
        //         $shift_date->shift_id = $shift->id;
        //         $shift_date->save();
        //     }

        // }
        // dd($shift);
        return redirect(route('userShifts.index'));
    }

    public function shiftSwap(Request $request)
    {
        $users = User::pluck('display_name', 'id');
        return view('userShifts.swap')->with(['users' => $users]);
    }

    /**
     * @return return all events in json
     */
    public function getCalendarData(Request $request)
    {
        // if($request->ajax()) {
        $users = User::whereHas('campusDetails', function (Builder $q) {
            return $q->where('organization_campus_id', SystemSession::get('organization_campus_id'));
        })->get();
        $roster_users = [];
        foreach ($users as $key => $user) {
            $user['title'] = $user['display_name'];
            $roster_obj    = ['resourceId' => $user['id'], 'user_name' => $user['display_name'], 'className' => [$user['id'] . '_shift_day_' . $key]];

            $user_shifts = $user->shifts()->where('organization_campus_id', SystemSession::get('organization_campus_id'))->get();
            if (!empty($user_shifts) && count($user_shifts) != 0) {
                foreach ($user_shifts as $value) {
                    $shift_obj = $value;
                    // $shift_working_days = $shift_obj->shiftWorkingDays()->get();
                    if ($value->is_week_day) {
                        $shift_time_slot = TimeSlot::find($shift_obj->time_slot_id);
                        if ($shift_time_slot == null) {
                            $time_slot_name = '---';
                        } else {
                            $time_slot_name = $shift_time_slot->name . "\n(" . $shift_time_slot->start_time . ' - ' . $shift_time_slot->end_time . ')';
                        }
                        // $time_slot_name = $shift_time_slot->name_with_time;
                        // dd($time_slot_name);

                        // $shift_dates = $shift_obj->shiftDates()->get();
                        // dd($user_shifts->last()->shift()->get()->first()->shiftDates()->get()->toArray());
                        // foreach ($shift_dates as $key => $shift_date) {
                        // if (!empty($shift_working_days) && count($shift_working_days) > 0) {
                        // foreach ($shift_working_days as $key => $shift_working_day) {
                        // dd($date_increment->format('l') . '-----' . $shift_working_day->week_day);
                        $roster_obj['backgroundColor'] = '#2ecc71';
                        $roster_obj['title']           = $time_slot_name;
                        $roster_obj['shift_id']        = $value->id;
                        $roster_obj['start']           = $value->date->format('Y-m-d');
                        $roster_obj['date_format']     = $value->date->format('l, d-M-Y');
                        // break;
                    } else {
                        $roster_obj['title']           = "Day \n Off";
                        $roster_obj['shift_id']        = $value->id;
                        $roster_obj['start']           = $value->date->format('Y-m-d');
                        $roster_obj['backgroundColor'] = '#ff9f1a';
                        $roster_obj['date_format']     = $value->date->format('l, d-M-Y');
                    }
                    //     }
                    // } else {
                    //     $roster_obj['backgroundColor'] = '#2f8ee0';
                    //     $roster_obj['title'] = $time_slot_name;
                    //     $roster_obj['shift_date_id'] = $shift_date->id;
                    //     $roster_obj['start'] = $shift_date->date->format('Y-m-d');
                    // }
                    array_push($roster_users, $roster_obj);
                    // }
                }
            }
        }
        return response()->json(['users' => $users->toArray(), 'roster' => $roster_users], 200);
        // }
        // return redirect()->back();
    }

    public function getAllUsers()
    {
        if (request()->ajax()) {
            $users = User::whereHas('campusDetails', function (Builder $q) {
                return $q->where('organization_campus_id', SystemSession::get('organization_campus_id'));
            })->get();

            return response()->json($users);
        }
    }

    public function workingDayTimeSlots($day)
    {
        return view('userShifts.workingDayTimeSlotsView', [
            'id'        => $day,
            'day'       => config('constants.week_days')[$day],
            'timeSlots' => TimeSlot::get()->pluck('name_with_time', 'id'),
        ]);
    }

}
