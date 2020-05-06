<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\mainModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
class ModuleController extends Controller
{
    /**
     * Display a listing of the All MOdule
     *
     * @return \Illuminate\Http\Response All Module
     */
    public function showModule()
    {
        return view('Admin.Show_Module');
    }

    /**
     * Show the All Module created in Data Table.
     *
     * @return \Illuminate\Http\Response Return The Data Table Of All Records Of Data Table
     */
    public function show_module_datatbl()
    {
        // print_r('dfdfd');
        // exit;
        $details = new mainModel();
        $moduleDetails = $details->allModule('mst_tbl_module');
        return Datatables::of($moduleDetails)
        ->addIndexColumn()
        ->addColumn('action', function ($query) {
            $id = Crypt::encrypt($query->moduleId);
            return '<a href="'.action('Admin\ModuleController@ShowEditModule', Crypt::encrypt($query->moduleId)).'" id="userform'.$query->moduleId.'"><img src="/asset/css/zondicons/zondicons/edit-pencil.svg"  style="width: 15px;margin-right: 20px;    filter: invert(0.5);" alt=""></a>
                <a href="javascript:void(0)" onclick="deleteModule('."'$id'".',event)"><img src="/asset/css/zondicons/zondicons/close.svg"
                style="width: 15px;    filter: invert(0.5);" alt=""></a>
                ';
        })
        ->rawColumns(['action'])
       ->make(true);
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
     * @param  int  $id of That Particuylar Module
     * @return \Illuminate\Http\Response
     */
    public function ShowEditModule($id)
    {
        $id = Crypt::decrypt($id);
        $userdata = DB::table('mst_tbl_module')->where(['Flag'=>'Show','moduleId'=>$id])->get()->first();
        $dataofUser['moduleId'] = $userdata->moduleId;
        $dataofUser['moduleName'] = $userdata->moduleName;
        $data = (object) $dataofUser;
         return view('Admin/show_Edit_module',compact('data'));
    }

    /**
     * Update the MOdule  resource in IN Database.
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
        $UserId = $request->session()->get('userid');
        $timaestamp = date("Y-m-d H:i:s");
        $data['moduleName'] = $modulename;
        $data['moduleId'] = $moduleId;
        $data['updated_at'] = $timaestamp;
        $data['UPDATE_BY'] = $UserId;
        $retnMsg = $details->updateAdminModule($data);
        return $retnMsg;

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
        $response = $model->deleteAdminModule($id, $data);
        return $response;
    }
}
