<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Http\Controllers\AppBaseController;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Globals;

class SubjectController extends Controller
{
	public function index(Request $request)
    {
        $subjects = Subject::get()->toArray();
        $subject_keys = [];
        if (count($subjects) != 0) {
            for ($i=0; $i < sizeof($subjects); $i++) { 
                $subjects[$i]['replaced_name'] = Globals::replaceSpecialChar($subjects[$i]['name']);
            };
            $subject_keys = array_keys($subjects[0]);
        }
        // dd($subject_keys);
        return view('subjects.index')
            ->with('subjects', $subjects)->with(['subject_keys' => $subject_keys, 'is_edit_mode' => false]);
    }

    public function create()
    {
        return view('subjects.create');
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $subject = new Subject;
        $subject->name = $input['name'];
        $subject->save($input);
        if ($subject) {
            Flash::success('Subject added successfully.');
        } else {
            Flash::error('Something went wrong while adding subect.');
        }

        return redirect(route('subjects.index'));
    }
     public function edit($id)
    {
        $subject = Subject::find($id)->first();
        if ($subject) {
            return view('subjects.index')->with('subject', $subject)->with('is_edit_mode', true);
        } else {
            Flash::error('Something went wrong while adding Subject.');
        }

        return redirect(route('subjects.index'));
    }
    public function update($id, Request $request)
    {
        $input = $request->all();
        $subject = Subject::find($id);
        $subject->name = $input['name'];
        $subject->update();
        if ($subject) {
            Flash::success('Subject details updated successfully.');
        } else {
            Flash::error('Something went wrong while adding Subject.');
        }

        return redirect(route('subjects.index'));
    }
    public function destroy($id)
    {
        $subject = Subject::find($id);

        if (empty($subject)) {
            Flash::error('Subject not found');

            return redirect(route('subjects.index'));
        }

        $subject->delete();

        Flash::success('Subjects deleted successfully.');

        return redirect(route('subjects.index'));
    }
    // public function dropdown(Request $request){
    //     // $input=$request->all();
    //      $subject = Subject::get();

    //       return view('students.transfer')->with('subject', $subject);

    // }
}
