<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class DefaultController extends Controller
{
    /**
     *  listing of the All User Names Passed here .
     *
     * @param  \Illuminate\Http\Request  $request Will have Aary Of User Id
     * @return \Illuminate\Http\Response
     */
    public function getUserName(Request $request)
    {
        $aaa =  $request->roles;
        $newUser = DB::table('mst_user_tbl')->where(['Flag' => 'Show'])->whereIn('userId', $aaa)->get();
        return $newUser;
    }

    /**
     *  listing of the All Departments Names Passed For Function .
     *
     * @param  \Illuminate\Http\Request  $request Will have FunctionsId
     * @return \Illuminate\Http\Response
     */
    public function getDepartments(Request $request)
    {
        $aaa =  $request->functions;
        $newUser = DB::table('mst_tbl_functions')->where(['Flag' => 'Show'])->where(['FUNCTION_ID'=> $aaa])->get()->first();
        $Departmentd = $newUser->DEPARTMENT_ID;
        $arrayId = explode(',', $Departmentd);
        $depatments  = DB::table('mst_tbl_departments')->where(['Flag' => 'Show'])->whereIn('DEPARTMENT_ID', $arrayId)->get();
        return $depatments;
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
