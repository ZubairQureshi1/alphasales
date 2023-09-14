<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExamType;
class ExamTypeController extends Controller
{
    public function index(Request $request)
    {
        $data=ExamType::get();
        return view('examtypes.index')->with('data',$data);
    }
public function store(Request $request){
    $input = $request->all();
    $examtype= new ExamType();
    $examtype->exam_type=$input['exam_type'];
    $examtype->save();
    return redirect()->back();
}
public function edit($id)
{
    $examtype = ExamType::find($id);
    return view('examtypes.edit')->with('examtypes',$examtype);
}
public function update($id, Request $request)
{
    $examtype = ExamType::findOrFail($id);

    $this->validate($request, [
        'exam_type' => 'required',
    ]);

    $input = $request->all();

    $examtype->fill($input)->save();

    // Session::flash('flash_message', 'Task successfully added!');

    return redirect('examtypes');
}
public function destroy($id)
{
    $examtype=ExamType::find($id);
    $examtype->delete();
    return redirect('examtypes');
}
}
