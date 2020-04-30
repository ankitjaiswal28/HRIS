<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\mainModel;
use Illuminate\Support\Facades\Crypt;
use Yajra\Datatables\Datatables;

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
        $response = $model->insertRecords($data, 'mst_tbl_master_role');
        $message = '';
        if ($response != '') {
            $message = 'Done';
        } else {
            $message = 'Error';
        }
        return $message;
        //print_r($request->file());
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
        // $details= DB::table('sup_tbl_client')->where(['Flag'=>'Show'])->get();
        return Datatables::of($responese)
        ->addIndexColumn()
        ->addColumn('assgin', function ($query) {
            return '<a href="'.action('Admin\RoleController@showAllClientModule', Crypt::encrypt($query->MASTER_ROLE_ID)).'" id="userform'.$query->MASTER_ROLE_ID.'">Assgin</a>';
        })
        ->addColumn('action', function ($query) {
            return '<a href="'.action('SuperAdmin\TableController@edit', Crypt::encrypt($query->MASTER_ROLE_ID)).'" id="userform'.$query->MASTER_ROLE_ID.'"><img src="/asset/css/zondicons/zondicons/edit-pencil.svg"  style="width: 15px;margin-right: 20px;    filter: invert(0.5);" alt=""></a>
            <a href="'.action('SuperAdmin\TableController@destroy', Crypt::encrypt($query->MASTER_ROLE_ID)).'" id="userform'.$query->MASTER_ROLE_ID.'"><img src="/asset/css/zondicons/zondicons/close.svg"
            style="width: 15px;    filter: invert(0.5);" alt=""></a>';
        })
        ->rawColumns(['action', 'assgin'])
       ->make(true);
        // return view('Admin.Add_Role');
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
      //  print_r($id);exit();
        // $getDetails = '';
        // $AssinedUser = '';
        // $clinetDetais = '';
        // $getDetails = DB::table('sup_tbl_module')->where(['Flag'=>'Show'])->get();
        // $getAssinedUser = DB::table('sup_tbl_client')->where(['Flag'=>'Show','CLIENT_ID'=>$id])->get()->first();
        // $AssinedUser = $getAssinedUser->AssginModuleId;
        // $clinetDetais['COMPANY_NAME'] = $getAssinedUser->COMPANY_NAME;
        // $clinetDetais['id'] = $id;
        // print_r($getDetails[0]->moduleName);
        return view('Admin/Edit_Module',compact('getDetails'));
    }

}
