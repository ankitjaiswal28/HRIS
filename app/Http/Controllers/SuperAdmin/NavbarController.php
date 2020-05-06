<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\mainModel;
use Illuminate\Support\Facades\Crypt;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class NavbarController extends Controller
{
    /**
     * Show The View Page For The Client Creation.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('SuperAdmin.Add_Client');
        // return view('SuperAdmin.clientcreation'); Add_Client.blade
    }

    /**
     * Show the form for creating a new Module.
     *
     * @return \Illuminate\Http\Response
     */
    public function showModule()
    {
        return view('SuperAdmin.Add_Module');
    }

    /**
     * Show the All Module created in Data Table.
     *
     * @return \Illuminate\Http\Response Return The Data Table Of All Records Of Data Table
     */
    public function show_module_datatbl()
    {
        $details = new mainModel();
        $moduleDetails = $details->allModule('sup_tbl_module');
       // $details= DB::table('sup_tbl_client')->where(['Flag'=>'Show'])->get();
        return Datatables::of($moduleDetails)
        ->addIndexColumn()
        // ->addColumn('assgin', function ($query) {
        //     return '<a href="'.action('SuperAdmin\TableController@edit', Crypt::encrypt($query->moduleId)).'" id="userform'.$query->moduleId.'">Assgin</a>';
        // })
        ->addColumn('action', function ($query) {
            $number = $query->moduleId;

    $array  = array_map('intval', str_split($number));

            // return $array;
            //    exit ;
            //    $Assinderuser = explode(",",$query->moduleId);
            $id = Crypt::encrypt($query->moduleId);
            $newmodels = new mainModel();
            // DB::enableQuerylog();
            $get = DB::table('sup_tbl_client')->where(['Flag'=>'Show'])->whereIn('AssginModuleId', $array)->get()->count();
            if ($get > 0) {
                return '<a href="'.action('SuperAdmin\NavbarController@ShowEditModule', Crypt::encrypt($query->moduleId)).'" id="userform'.$query->moduleId.'"><img src="/asset/css/zondicons/zondicons/edit-pencil.svg"  style="width: 15px;margin-right: 20px;    filter: invert(0.5);" alt=""></a>
            <a href="javascript:void(0)">Already Assined</a>
            ';
            } else {
                return '<a href="'.action('SuperAdmin\NavbarController@ShowEditModule', Crypt::encrypt($query->moduleId)).'" id="userform'.$query->moduleId.'"><img src="/asset/css/zondicons/zondicons/edit-pencil.svg"  style="width: 15px;margin-right: 20px;    filter: invert(0.5);" alt=""></a>
                <a href="javascript:void(0)" onclick="deleteModule('."'$id'".',event)"><img src="/asset/css/zondicons/zondicons/close.svg"
                style="width: 15px;    filter: invert(0.5);" alt=""></a>
                ';
            }

            // $aa= DB::getQuerylog();
            // return $get->count();
           // $get = $newmodels->showAllData('sup_tbl_client');
           //  return $get->count(). $query->moduleId;
            // return '<a href="'.action('SuperAdmin\NavbarController@ShowEditModule', Crypt::encrypt($query->moduleId)).'" id="userform'.$query->moduleId.'"><img src="/asset/css/zondicons/zondicons/edit-pencil.svg"  style="width: 15px;margin-right: 20px;    filter: invert(0.5);" alt=""></a>
            // <a href="javascript:void(0)" onclick="deleteModule('."'$id'".',event)"><img src="/asset/css/zondicons/zondicons/close.svg"
            // style="width: 15px;    filter: invert(0.5);" alt=""></a>
            // ';
        })
        ->rawColumns(['action'])
       ->make(true);
    }
    //  <a href="'.action('SuperAdmin\TableController@destroy', Crypt::encrypt($query->moduleId)).'" id="userform'.$query->moduleId.'"><img src="/asset/css/zondicons/zondicons/close.svg"
    // style="width: 15px;    filter: invert(0.5);" alt=""></a>
    /**
     * Show the All Module Page.
     *
     * @return \Illuminate\Http\Response Return The Show the All Module Page.
     */
    public function Show_Module()
    {
        return view('SuperAdmin/Show_Module');
    }

    /**
     * This function is use For The Client
     * Creatrion
     *
     * @param  \Illuminate\Http\Request  $request will Have all Detils For Craeting The Client
     * @return \Illuminate\Http\Response if Clinet Is Created It Will Return Creted.
     */
    public function createClient(Request $request)
    {
        $details = new mainModel();
         $companyname = $request->companyname;
         $adminname = $request->adminname;
         $mobileno = $request->mobileno;
         $email = $request->email;
         $prefix = $request->prefix;
         $pwd = $request->pwd;
         $orignaldatabase = $request->session()->get('databasename');
         $encryptPassword = Crypt::encrypt($pwd);
         $data['companyname'] = $companyname;
         $data['adminname'] = $adminname;
         $data['mobileno'] = $mobileno;
         $data['email'] = $email;
         $data['prefix'] = $prefix;
         $data['pwd'] = $encryptPassword;
         $data['orignaldatabase'] = $orignaldatabase;
        $responsemessg = $details->clientCreation($data);
        // print_r($responsemessg);
        return  $responsemessg;
       // print_r($request);
    }

    /**
     * This function is use For The Client
     * Creatrion
     *
     * @param  \Illuminate\Http\Request  $request will Have all Detils For Craeting The Client
     * @return \Illuminate\Http\Response if Clinet Is Created It Will Return Creted.
     */
    public function AddModule(Request $request)
    {
        $details = new mainModel();
        $modulename = $request->module_name;
        $url = $request->url;
        $timaestamp = date("Y-m-d H:i:s");
        $data['moduleName'] = $modulename;
        $data['moduleLink'] = $url;
        $data['Flag'] = 'Show';
        $data['created_at'] = $timaestamp;
        $response = $details->AddModuletobase($data, 'sup_tbl_module');
        $message = '';
        if ($response == 'Done') {
            $message ='Done';
        } else if($response == 'Already') {
            $message ='Already';
        } else {
            $message = 'Error' ;
        }
        return $message;
        // print_r($retVal);
    }

    /**
     * Display the specified Module Details
     *
     * @param  int  $id It is Module Id
     * @return \Illuminate\Http\Response Show Details of Specfic Records
     */
    public function ShowEditModule($id)
    {
        $id = Crypt::decrypt($id);
       $userdata = DB::table('sup_tbl_module')->where(['Flag'=>'Show','moduleId'=>$id])->get()->first();
       $dataofUser['moduleId'] = $userdata->moduleId;
       $dataofUser['moduleName'] = $userdata->moduleName;
       $dataofUser['moduleLink'] = $userdata->moduleLink;
       $data = (object) $dataofUser;
       /// print_r($data);
       // $data
        return view('SuperAdmin/show_Edit_module',compact('data'));
        // return view('SuperAdmin/show_Edit_module');
        // show_Edit_module.blade
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
    public function updateModule(Request $request)
    {
        $details = new mainModel();
        $moduleId = $request->moduleID;
        $modulename = $request->modulename;
        $timaestamp = date("Y-m-d H:i:s");
        $data['modulename'] = $modulename;
        $data['moduleId'] = $moduleId;
        $data['updated_at'] = $timaestamp;
        $retnMsg = $details->updateModule($data);
        return $retnMsg;
       //  print_r($retnMsg);
        //
    }

    /**
     * Remove the specified MOdule from storage.
     *
     * @param  int  $id Module Id
     * @return \Illuminate\Http\Response and return The Message
     */
    public function destroy($id)
    {
        $model = new mainModel();
        $timaestamp = date("Y-m-d H:i:s");
        $id = Crypt::decrypt($id);
        $data['updated_at'] = $timaestamp;
        $response = $model->deleteModule($id, $data);
        return $response;
        //
    }
}
