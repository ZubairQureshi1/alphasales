<?php

namespace App\Http\Controllers;

use App\Models\InstallmentPlan;
use Flash;
use Illuminate\Http\Request;

class InstallmentPlanController extends Controller
{
    public function index()
    {
        $installmentplans = InstallmentPlan::get()->toArray();
        $installmentplans_keys = [];
        if (count($installmentplans) != 0) {

            $installmentplans_keys = array_keys($installmentplans[0]);
        }
        //dd($installmentplans_keys);
        return view('installmentPlan.index')
            ->with('installmentplans', $installmentplans)->with(['installmentplans_keys' => $installmentplans_keys]);
    }
    public function create()
    {
        return view('installmentPlan.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        try {
            \DB::beginTransaction();
            $installmentplan = new InstallmentPlan();

            $installmentplan->academic_term_id = $input['academic_term_id'];
            $installmentplan->max_installments = $input['max_installments'];
            $installmentplan->min_installments = $input['min_installments'];
            $installmentplan->max_discount = $input['max_discount'];
            $installmentplan->min_discount = $input['min_discount'];

            $installmentplan->save($input);

            if ($installmentplan) {
                Flash::success('Installment Plan added successfully.');
            } else {
                Flash::error('Something went wrong while adding Installment Plan.');
            }

            \DB::commit();
            return redirect(route('installmentplans.index'));
        } catch (Exception $e) {
            \DB::rollback();
        }
    }
    public function edit($id)
    {
        $installmentplan = InstallmentPlan::where('id', '=', $id)->first();
        return view('installmentPlan.edit')->with(['installmentplan' => $installmentplan]);
    }
    public function update($id, Request $request)
    {
        try {
            \DB::beginTransaction();
            $input = $request->all();
            $installmentplan = InstallmentPlan::find($id);
            $installmentplan->academic_term_id = $input['academic_term_id'];
            $installmentplan->max_installments = $input['max_installments'];
            $installmentplan->min_installments = $input['min_installments'];
            $installmentplan->max_discount = $input['max_discount'];
            $installmentplan->min_discount = $input['min_discount'];

            $installmentplan->update();

            if (!empty($installmentplan)) {
                Flash::success('Installment Plan updated successfully.');
            } else {
                Flash::error('Something went wrong while Updating Installment Plan.');
            }

            \DB::commit();
            return redirect(route('installmentplans.index'));
        } catch (Exception $e) {
            \DB::rollback();
        }
    }
}
