<?php

namespace App\Http\Controllers;

use App\models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\SystemPermission  $systemPermission
     * @return \Illuminate\Http\Response
     */
    public function show(SystemPermission $systemPermission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\SystemPermission  $systemPermission
     * @return \Illuminate\Http\Response
     */
    public function edit(SystemPermission $systemPermission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\SystemPermission  $systemPermission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SystemPermission $systemPermission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\SystemPermission  $systemPermission
     * @return \Illuminate\Http\Response
     */
    public function destroy(SystemPermission $systemPermission)
    {
        //
    }
}
