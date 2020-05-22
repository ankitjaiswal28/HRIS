<?php

namespace App\Http\Controllers\Superadmin;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\mainModel;
use App\User;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Config;
class TableController extends Controller
{
    /**
     * Show the All Clients created in Data Table.
     *
     * @return \Illuminate\Http\Response Return The Data Table Of All Records Of Data Table
     */
    public function show_client_datatbl()
    {
        $details= DB::table('sup_tbl_client')->where(['Flag'=>'Show'])->get();
        return Datatables::of($details)
        ->addIndexColumn()
        ->addColumn('assgin', function ($query) {
            return '<a href="'.action('SuperAdmin\TableController@showAllModule', Crypt::encrypt($query->CLIENT_ID)).'" id="userform'.$query->CLIENT_ID.'">Assgin</a>';
        })
        ->addColumn('assginpolycies', function ($query) {
            return '<a href="'.action('SuperAdmin\TableController@showAllPoliycyes', Crypt::encrypt($query->CLIENT_ID)).'" id="userform'.$query->CLIENT_ID.'">Assgin</a>';
        })
        ->addColumn('action', function ($query) {
            $id = Crypt::encrypt($query->CLIENT_ID);
            return '<a href="'.action('SuperAdmin\TableController@edit', Crypt::encrypt($query->CLIENT_ID)).'" id="userform'.$query->CLIENT_ID.'"><img src="/asset/css/zondicons/zondicons/edit-pencil.svg"  style="width: 15px;margin-right: 20px;    filter: invert(0.5);" alt=""></a>
            <a href="javascript:void(0)" onclick="deleteClient('."'$id'".',event)"><img src="/asset/css/zondicons/zondicons/close.svg"
            style="width: 15px;    filter: invert(0.5);" alt=""></a>';
        })
        ->rawColumns(['action', 'assgin', 'assginpolycies'])
       ->make(true);
    }

    public function show_Edit_client()
    {
        return view('SuperAdmin/show_Edit_client');
    }
    /**
     * Show the All Clients created in Data Table.
     *
     * @return \Illuminate\Http\Response Return The Data Table Of All Records Of Data Table
     */
    public function showAllModule($id)
    {
        $id = Crypt::decrypt($id);
        $getDetails = DB::table('sup_tbl_module')->where(['Flag'=>'Show'])->get();
        $getAssinedUser = DB::table('sup_tbl_client')->where(['Flag'=>'Show','CLIENT_ID'=>$id])->get()->first();
        $AssinedUser = $getAssinedUser->AssginModuleId;
        $clinetDetais['COMPANY_NAME'] = $getAssinedUser->COMPANY_NAME;
        $clinetDetais['id'] = $id;
        // print_r($getDetails[0]->moduleName);
        return view('SuperAdmin/Edit_Module',compact('getDetails', 'AssinedUser', 'clinetDetais'));
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
        // print_r($assinedUser);
        // exit;
        $timaestamp = date("Y-m-d H:i:s");
        $orignaldatabase = $request->session()->get('databasename');
        // print_r($request->modulename);
        $data['Assinderuser'] = implode(",",$assinedUser);
        $data['ClientId'] = $request->ClientId;
        $data['updated_at'] = $timaestamp;
        $data['databasename'] = $orignaldatabase;
        $response = $model->AssinedModuletoClient($data);
        return $response;
        // print_r($response);
    }


     /**
     * It Will Update The Client Of user
     *
     *  @param  \Illuminate\Http\Request  $request will Have all datas
     * @return \Illuminate\Http\Response Return Updated All User Message
     */
    public function updateclient(Request $request)
    {
        $details = new mainModel();
        $clientid = $request->clientid;
        $companyname = $request->companyname;

        $adminname = $request->adminname;
        $mobileno = $request->mobileno;
        $email = $request->email;
       //  $prefix = $request->prefix;
        $pwd = $request->pwd;
        $orignaldatabase = $request->session()->get('databasename');
        $encryptPassword = Crypt::encrypt($pwd);
        $data['CLIENT_ID'] = $clientid;
        $data['COMPANY_NAME'] = $companyname;
        $data['ADMIN_NAME'] = $adminname;
        $data['ADMIN_MOB_NO'] = $mobileno;
        $data['ADMIN_EMAILID'] = $email;
       // $data['CLIENT_PREFIX'] = $prefix;
        $data['PASSWORDS'] = $encryptPassword;
        $data['orignaldatabase'] = $orignaldatabase;

        $table_name = 'sup_tbl_client';
        $keyvalue = $clientid;
        $keyname = 'CLIENT_ID';
       $responsemessg = $details->clientupdate($table_name,$keyname,$keyvalue,$data);
       // print_r($responsemessg);
       return  $responsemessg;
    }

    public function Show_client()
    {
        // $details= DB::table('sup_tbl_client')->get();
        // return Datatables::of($details)->make(true);
        return view('SuperAdmin/Show_client');
    }
    public function edit($id)
	{
        $id = Crypt::decrypt($id);
       $userdata = DB::table('sup_tbl_client')->where(['Flag'=>'Show','CLIENT_ID'=>$id])->get()->first();
       $dataofUser['CLIENT_ID'] = $userdata->CLIENT_ID;
       $dataofUser['COMPANY_NAME'] = $userdata->COMPANY_NAME;
       $dataofUser['ADMIN_MOB_NO'] = $userdata->ADMIN_MOB_NO;
       $dataofUser['ADMIN_EMAILID'] = $userdata->ADMIN_EMAILID;
       $dataofUser['CLIENT_PREFIX'] = $userdata->CLIENT_PREFIX;
       $dataofUser['ADMIN_NAME'] = $userdata->ADMIN_NAME;
       $password = $userdata->PASSWORDS;
       $dataofUser['PASSWORDS'] = Crypt::decrypt($password);
       $data = (object) $dataofUser;
       /// print_r($data);
       // $data
        return view('SuperAdmin/show_Edit_client',compact('data'));
    }
    public function destroy($id)
	{
        $model = new mainModel();
        $id = Crypt::decrypt($id);
        $timaestamp = date("Y-m-d H:i:s");
        $data['updated_at'] = $timaestamp;
        $response = $model->deleteClient($id, $data);
        return $response;

    }
    /**
     * Show the All Ploycies
     *
     * @return \Illuminate\Http\Response Return The Data Table Of All Records Of Data Table
     */
    public function showAllPoliycyes($id)
    {
        $id = Crypt::decrypt($id);
        $getDetails = DB::table('sup_tbl_module')->where(['Flag'=>'Show'])->get();
        $getAssinedUser = DB::table('sup_tbl_client')->where(['Flag'=>'Show','CLIENT_ID'=>$id])->get()->first();
        $AssinedUser = $getAssinedUser->AssginModuleId;
        $clinetDetais['COMPANY_NAME'] = $getAssinedUser->COMPANY_NAME;
        $clinetDetais['id'] = $id;
        $clinetDetais['GRADEORLEVEL'] = $getAssinedUser->GRADEORLEVEL;
        // print_r($getDetails[0]->moduleName);
        return view('SuperAdmin/AddPolicyes',compact('getDetails', 'AssinedUser', 'clinetDetais'));
    }

}
