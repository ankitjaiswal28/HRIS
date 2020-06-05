<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Models\Login;
use Illuminate\Support\Facades\Config;
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
     * Display the Page For The Change Password
     *
     * @param  int  $id User Id of The user
     * @return \Illuminate\Http\Response Page Of The user
     */
    public function ShowChangePassword($id)
    {

         $userId = Crypt::decrypt($id);
        $orignamlDB = session()->get('orignaldb');
        $getDatBasename = session()->get('databasename');
        Config::set('database.connections.dynamicsql.database', $getDatBasename);
        Config::set('database.default', 'dynamicsql');
        $getclientDetails = DB::table('mst_user_tbl')->where(['flag'=>'Show','userId'=>$userId])->get()->first();
        $Password = Crypt::decrypt($getclientDetails->passwords);
        Config::set('database.connections.dynamicsql.database', $orignamlDB);
        Config::set('database.default', 'dynamicsql');
        return view('ChangePassword.changePassword', compact('Password'));
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
     * Update the PassWord of User  in Database
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, $id)
    {
        $login = new Login();
        $userId = Crypt::decrypt($id);
        $oldPassWord = Crypt::encrypt($request->oldPassword);
        // $oldPassWord = $request->oldPassword;
        $encryptPassWord = Crypt::encrypt($request->newPassword);

        $orignamlDB = session()->get('orignaldb');
        $dynamicDb = session()->get('databasename');
        // $xxxx = Crypt::decrypt($encryptPassWord);
        // print_r($xxxx);

        // exit;
        $data['UserId'] = $userId;
        $data['oldPassWord'] = $oldPassWord;
        $data['newPassword'] = $encryptPassWord;
        $data['orignamlDB'] = $orignamlDB;
        $data['dynamicDb'] = $dynamicDb;
        $returnVal = $login->UpdatePassWord($data);
        $request->session()->flush();
        return $returnVal;
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
