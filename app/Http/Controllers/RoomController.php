<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomFacility;
use Flash;
use Globals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as SystemSession;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $rooms = Room::get()->toArray();
        // $roomFacilities = RoomFacility::get();

        $room_keys = [];
        if (count($rooms) != 0) {
            for ($i = 0; $i < sizeof($rooms); $i++) {
                $rooms[$i]['replaced_name'] = Globals::replaceSpecialChar($rooms[$i]['name']);
            };
            $room_keys = array_keys($rooms[0]);
        }
        // dd($room_keys);
        return view('rooms.index')
            ->with('rooms', $rooms)->with(['room_keys' => $room_keys, 'is_edit_mode' => false]);
    }

    public function create()
    {
        return view('rooms.index');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $room = new Room;
        $room->name = $input['name'];
        $room->organization_campus_id = SystemSession::get('organization_campus_id');
        $room->sitting_capacity = $input['sitting_capacity'];   
        $room->save($input);

        if ($room) {
            foreach ($input['facilities'] as $facility){

                $getRoom = Room::orderBy('id', 'DESC')->first();
                $roomFacility = new RoomFacility;
                $roomFacility->room_id = $getRoom->id;
                $roomFacility->facility_id = $facility;
                $roomFacility->save();
            }
            Flash::success('room added successfully.');
        } else {
            Flash::error('Something went wrong while adding subect.');
        }

        return redirect(route('rooms.index'));
    }

    public function edit($id)
    {
        $room = Room::find($id)->first();

        if ($room) {
            return view('rooms.index')->with('room', $room)->with('is_edit_mode', true);
        } else {
            Flash::error('Something went wrong while adding room.');
        }

        return redirect(route('rooms.index'));
    }

    public function update($id, Request $request)
    {
        $input = $request->all();
        $room = Room::find($id);
        $room->name = $input['name'];
        $room->sitting_capacity = $input['sitting_capacity'];
        $room->update();
        if ($room) {
              $removeFacility = RoomFacility::where('room_id', '=', $id)->delete();
              foreach ($input['facilities'] as $facility){
                $roomFacility = new RoomFacility;
                $roomFacility->room_id = $id;
                $roomFacility->facility_id = $facility;
                $roomFacility->save();                
              }

            Flash::success('room details updated successfully.');
        } else {
            Flash::error('Something went wrong while adding room.');
        }

        return redirect(route('rooms.index'));
    }

    public function destroy($id)
    {
        $room = Room::find($id);

        if (empty($room)) {
            Flash::error('room not found');

            return redirect(route('rooms.index'));
        }

        $room->delete();
        $removeFacility = RoomFacility::where('room_id', '=', $id)->delete();

        Flash::success('rooms deleted successfully.');

        return redirect(route('rooms.index'));
    }
}
