<?php

namespace App\Http\Controllers;

use App\Models\HeadFine;
use Flash;
use Globals;
use Illuminate\Http\Request;

class HeadFineController extends Controller
{
    public function index(Request $request)
    {
        $headfines = Headfine::get()->toArray();

        $headfine_keys = [];
        if (count($headfines) != 0) {
            for ($i = 0; $i < sizeof($headfines); $i++) {
                $headfines[$i]['replaced_name'] = Globals::replaceSpecialChar($headfines[$i]['name']);
            };
            $headfine_keys = array_keys($headfines[0]);
        }
        // dd($headfine_keys);
        return view('headFines.index')
            ->with('headfines', $headfines)->with(['headfine_keys' => $headfine_keys, 'is_edit_mode' => false]);
    }

    public function create()
    {
        return view('headFines.index');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $headFine = new HeadFine;
        $headFine->name = $input['name'];
        $headFine->amount = $input['amount'];
        $headFine->vendor_share_amount = $input['vendor_share_amount'];

        $headFine->save($input);
        if ($headFine) {
            Flash::success('headFine added successfully.');
        } else {
            Flash::error('Something went wrong while adding subect.');
        }

        return redirect(route('headFines.index'));
    }

    public function edit($id)
    {
        $headFine = HeadFine::find($id)->first();

        if ($headFine) {
            return view('headFines.index')->with('headFine', $headFine)->with('is_edit_mode', true);
        } else {
            Flash::error('Something went wrong while adding headFine.');
        }

        return redirect(route('headFines.index'));
    }

    public function update($id, Request $request)
    {
        $input = $request->all();
        $headFine = HeadFine::find($id);
        $headFine->name = $input['name'];
        $headFine->amount = $input['amount'];
        $headFine->vendor_share_amount = $input['vendor_share_amount'];

        $headFine->update();
        if ($headFine) {
            Flash::success('headFine details updated successfully.');
        } else {
            Flash::error('Something went wrong while adding headFine.');
        }

        return redirect(route('headFines.index'));
    }

    public function destroy($id)
    {
        $headFine = HeadFine::find($id);

        if (empty($headFine)) {
            Flash::error('headFine not found');

            return redirect(route('headFines.index'));
        }

        $headFine->headFineStudent()->delete();
        $headFine->delete();
        Flash::success('headFines deleted successfully.');

        return redirect(route('headFines.index'));
    }
}
