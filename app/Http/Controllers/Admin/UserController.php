<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\mainModel;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    /**
     * Display a listing of the All User
     *
     * @return \Illuminate\Http\Response
     */
    public function listofUser()
    {
        return view('Admin.ShowallUser');
    }

    /**
     * It will Be Return The Data Table  Of Records
     *
     * @return \Illuminate\Http\Response it will give All Records of User
     */
    public function show_alluser_datatbl()
    {
        $model = new mainModel();
        $UserId = session()->get('userid');
        $responese = $model->getAllUserDetails($UserId);
        return Datatables::of($responese)
        ->addIndexColumn()
        ->addColumn('master_roleId', function ($query) {
            $masterROles = $query->master_roleId;
        })
        ->addColumn('PRIMARY_MANGER', function ($query) {
            if ($query->PRIMARY_MANGER != null) {
                return $query->PRIMARY_MANGER ;
            } else {
                return 'Not Assinded';
            }
        })
        ->addColumn('assgin', function ($query) {
            return '<a href="'.action('Admin\RoleController@showAllClientModule', Crypt::encrypt($query->userId)).'" id="userform'.$query->userId.'">Assgin</a>';
        })
        ->addColumn('action', function ($query) {
            $id = Crypt::encrypt($query->userId);
            return '<a href="'.action('Admin\ModuleController@ShowEditModule', Crypt::encrypt($query->userId)).'" id="userform'.$query->userId.'"><img src="/asset/css/zondicons/zondicons/edit-pencil.svg"  style="width: 15px;margin-right: 20px;    filter: invert(0.5);" alt=""></a>
                <a href="javascript:void(0)" onclick="deleteUser('."'$id'".',event)"><img src="/asset/css/zondicons/zondicons/close.svg"
                style="width: 15px;    filter: invert(0.5);" alt=""></a>
                ';
        })
        ->rawColumns(['action', 'assgin', 'PRIMARY_MANGER' ,'master_roleId'])
       ->make(true);

    }

    /**
     * Show The Add User  Page View
     *
     * @return \Illuminate\Http\Response
     */
    public function AddUser()
    {
        $model = new mainModel();
        //print_r('dfdfdfdf');
        $roles = $model->showAllData('mst_tbl_master_role');
        $users = $model->showAllData('mst_user_tbl');
        // print_r($roles);
         return view('Admin.AddUser', compact('roles', 'users'));
    }

    /**
     * Store a newly created User  in DataBase.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createUser(Request $request)
    {
        $model = new mainModel();
        $orignalDb =$request->session()->get('orignaldb');
        $dynamicdatabase =$request->session()->get('databasename');
        $userid =$request->session()->get('userid');
        $CLIENT_ID =$request->session()->get('CLIENT_ID');

        $ROLEID =  3;
        $Roles = $request->roles;
        $username = $request->username;
        $reportingmanger = $request->reportingmanger;
        $email = $request->email;
        $pwd = $request->pwd;
        $MASTER_ROLE_ID = implode(",",$Roles);
        $REPORTING_MANAGER = implode(",",$reportingmanger);
        $encryptPassword = Crypt::encrypt($pwd);
        $data['orignalDb'] = $orignalDb;
        $data['ROLEID'] = $ROLEID;
        $data['userid'] = $userid;
        $data['encryptPassword'] = $encryptPassword;
        $data['email'] = $email;
        $data['username'] = $username;
        $data['MASTER_ROLE_ID'] = $MASTER_ROLE_ID;
        $data['REPORTING_MANAGER'] = $REPORTING_MANAGER;
        $data['dynamicdatabase'] = $dynamicdatabase;
        $data['CLIENT_ID'] = $CLIENT_ID;
        $response = $model->UserCraetion($data);
        return $response;
        // print_r($orignalDb);
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
     * Remove the specified User from Thata Base .
     *
     * @param  int  $id of The The user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = new mainModel();
        $orignalDb = session()->get('orignaldb');
        $dynamicdatabase = session()->get('databasename');
        $userid = session()->get('userid');
        $CLIENT_ID = session()->get('CLIENT_ID');
        $timaestamp = date("Y-m-d H:i:s");
        $id = Crypt::decrypt($id);
        $ROLEID =  3;
        $data['orignalDb'] = $orignalDb;
        $data['userid'] = $userid;
        $data['dynamicdatabase'] = $dynamicdatabase;
        $data['CLIENT_ID'] = $CLIENT_ID;
        $data['timaestamp'] = $timaestamp;
        $data['ROLEID'] = $ROLEID;
        $response = $model->deleteUser($id, $data);
        return $response;

    }
}
