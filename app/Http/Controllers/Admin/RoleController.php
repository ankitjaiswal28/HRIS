<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\mainModel;
use Illuminate\Support\Facades\Crypt;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Show The All  Page Vivew
     *
     * @return \Illuminate\Http\Response
     */
    public function ShowRoles()
    {
        return view('Admin.role');
    }

    /**
     * Show The Add Roles Page View
     *
     * @return \Illuminate\Http\Response
     */
    public function ShowAddRoles()
    {
        return view('Admin.Add_Role');
    }

    /**
     * It will Add Roles and  Return The Response Messgae.
     *
     * @param  \Illuminate\Http\Request  $request In $request  Role Details Is Present.
     * @return \Illuminate\Http\Response Return The Response Mesasge
     */
    public function addRoles(Request $request)
    {
        $model = new mainModel();
        $roleName = $request->role_name;
        $iconName = $request->roleIconImages;
        // print_r($roleName);exit();
        $UserId = $request->session()->get('userid');
        $timaestamp = date("Y-m-d H:i:s");
        $data['CREATED_BY'] = $UserId;
        $data['MASTER_ROLE_NAME'] = $roleName;
        $data['ICON_NAME'] = $iconName;
        $data['FLAG'] = 'Show';
        $data['CREATED_AT'] = $timaestamp;
        $response = $model->addAdminRole($data);
        $message = '';
        if ($response == 'Done') {
            $message = 'Done';
        } else if($response == 'Already') {
            $message = 'Already';
        } else {
            $message = 'Error';
        }
        return $message;
    }
    /**
     * Show The Add Roles Page  In DataTabel
     *
     * @return \Illuminate\Http\Response
     */
    public function allRecodrds()
    {
        $model = new mainModel();
        $responese = $model->showAllData('mst_tbl_master_role');
        return Datatables::of($responese)
        ->addIndexColumn()
        ->addColumn('assgin', function ($query) {
            return '<a href="'.action('Admin\RoleController@showAllClientModule', Crypt::encrypt($query->MASTER_ROLE_ID)).'" id="userform'.$query->MASTER_ROLE_ID.'">Assgin</a>';
        })
        ->addColumn('action', function ($query) {
            $id = Crypt::encrypt($query->MASTER_ROLE_ID);
            return '<a href="'.action('Admin\ModuleController@ShowEditModule', Crypt::encrypt($query->MASTER_ROLE_ID)).'" id="userform'.$query->MASTER_ROLE_ID.'"><img src="/asset/css/zondicons/zondicons/edit-pencil.svg"  style="width: 15px;margin-right: 20px;    filter: invert(0.5);" alt=""></a>
                <a href="javascript:void(0)" onclick="deleteRole('."'$id'".',event)"><img src="/asset/css/zondicons/zondicons/close.svg"
                style="width: 15px;    filter: invert(0.5);" alt=""></a>
                ';
        })
        ->rawColumns(['action', 'assgin'])
       ->make(true);
    }
    /**
     * Show the All Clients created in Data Table.
     *
     * @return \Illuminate\Http\Response Return The Data Table Of All Records Of Data Table
     */
    public function showAllClientModule($id)
    {
        $model = new mainModel();
        $id = Crypt::decrypt($id);
        $getDetails = $model->showAllData('mst_tbl_module');
        $getAssinedUser = DB::table('mst_tbl_master_role')->where(['Flag'=>'Show','MASTER_ROLE_ID'=>$id])->get()->first();
        $AssinedUser = $getAssinedUser->MODULEID;
        return view('Admin/Edit_Module',compact('getDetails', 'AssinedUser', 'id'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editRoleName($id)
    {
        $model = new mainModel();
        $id = Crypt::decrypt($id);
        $Details = $model->getRoleAdmin($id);
        return view('Admin/Edit_Role',compact('Details'));
    }

    /**
     * It will Update Roles and  Return The Response Messgae.
     *
     * @param  \Illuminate\Http\Request  $request In $request  Role Details Is Present.
     * @return \Illuminate\Http\Response Return The Response Mesasge
     */
    public function updateRoles(Request $request)
    {
        $model = new mainModel();
        $roleName = $request->role_name;
        $iconName = $request->roleIconImages;
        $roleId = $request->roleId;
        $UserId = $request->session()->get('userid');
       //  exit;
        $timaestamp = date("Y-m-d H:i:s");
        $data['roleName'] = $roleName;
        $data['roleId'] = $roleId;
        $data['UPDATE_BY'] = $UserId;
        $data['updated_at'] = $timaestamp;
        // print_r($data);
        // $data['UPDATE_BY'] = $UserId;
         $response = $model->updateROles($data);
        //print_r($response);
        return $response;

    }
    /**
     * Remove the specified resource from Data base.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = new mainModel();
        $timaestamp = date("Y-m-d H:i:s");
        $id = Crypt::decrypt($id);
        $UserId = session()->get('userid');
        $data['updated_at'] = $timaestamp;
        $data['UPDATE_BY'] = $UserId;
        $response = $model->deleteAdminRole($id, $data);
        return $response;
    }
    /**
     * It will Assgined All User Details To Client
     *  @param  \Illuminate\Http\Request  $request will have All User Detials To upadate
     * @return \Illuminate\Http\Response Return Updated All User Message
     */
    public function AssinedMOdule(Request $request)
    {
        $model = new mainModel();
        if ($request->modulename == '') {
            $assinedUser = '';
        } else {
            $assinedUser = $request->modulename;
        }
        $timaestamp = date("Y-m-d H:i:s");
        $UserId = $request->session()->get('userid');
       // $orignaldatabase = $request->session()->get('databasename');
        // print_r($request->modulename);
        $data['MODULEID'] = implode(",",$assinedUser);
        $data['MASTER_ROLE_ID'] = $request->roleId;
        $data['updated_at'] = $timaestamp;
        $data['UPDATED_BY'] = $UserId;
        // print_r($data);
        // exit;
        $response = $model->AssinedModuletoRole($data);
        return $response;
        // print_r($response);
    }

}
