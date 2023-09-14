<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Employment;
class EmploymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $end_of_employments = Employment::get();
        return view('employment.index')->with(['end_of_employments' => $end_of_employments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = User::get()->pluck('name','id');
        return view('employment.create')->with(['employees' => $employees]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $end_of_employment = new Employment();
        $end_of_employment->user_id = $input['user_id'];
        $date_obj = new \DateTime($input['end_employment_date']);
        $end_of_employment->end_employment_date = $date_obj;
        $end_of_employment->reason_end_employment = $input['reason_end_employment'];
        $end_of_employment->save();
        return redirect()->route('employments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $end_of_employment = Employment::find($id);
        $employees = User::get()->pluck('name','id');
        return view('employment.edit')->with(['end_of_employment' => $end_of_employment, 'employees' => $employees]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $end_of_employment = Employment::find($id);
        $end_of_employment->user_id = $input['user_id'];
        $date_obj = new \DateTime($input['end_employment_date']);
        $end_of_employment->end_employment_date = $date_obj;
        $end_of_employment->reason_end_employment = $input['reason_end_employment'];
        $end_of_employment->update();
        return redirect()->route('employments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $end_of_employment = Employment::find($id);
        $end_of_employment->delete();
        return redirect()->back();
    }
}
