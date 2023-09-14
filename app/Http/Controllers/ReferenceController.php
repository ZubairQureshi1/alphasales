<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Reference;
use App\Http\Controllers\AppBaseController;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Globals;

class ReferenceController extends Controller
{
    public function index(Request $request)
    {
        $references = Reference::get()->toArray();
        $reference_keys = [];
        if (count($references) != 0) {
            for ($i=0; $i < sizeof($references); $i++) { 
                $references[$i]['replaced_name'] = Globals::replaceSpecialChar($references[$i]['name']);
            };
            $reference_keys = array_keys($references[0]);
        }
        // dd($reference_keys);
        return view('references.index')
            ->with('references', $references)->with(['reference_keys' => $reference_keys, 'is_edit_mode' => false]);
    }

   public function store(Request $request)
    {
        $input = $request->all();
        $reference = new reference;
        $reference->name = $input['name'];
        $reference->save($input);
        if ($reference) {
            Flash::success('Reference added successfully.');
        } else {
            Flash::error('Something went wrong while adding subect.');
        }

        return redirect(route('references.index'));
    }
    public function update($id, Request $request)
    {
        $input = $request->all();
        $reference = Reference::find($id);
        $reference->name = $input['name'];
        $reference->update();
        if ($reference) {
            Flash::success('Reference details updated successfully.');
        } else {
            Flash::error('Something went wrong while adding Reference.');
        }

        return redirect(route('references.index'));
    }
    public function destroy($id)
    {
        $reference = Reference::find($id);

        if (empty($reference)) {
            Flash::error('Reference not found');

            return redirect(route('references.index'));
        }

        $reference->delete();

        Flash::success('Reference deleted successfully.');

        return redirect(route('references.index'));
    }

}
