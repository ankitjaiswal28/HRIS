<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\mainModel;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Crypt;

class ProjectMasterController extends Controller
{
    public function index()
    {
        return view('Admin.project_master.show_project');
    }

    public function create()
    {
        return view('Admin.project_master.create_project');
    }

    public function addproject(Request $request)
    {
        $addmodule = new mainModel();
        date_default_timezone_set('Asia/Kolkata');
        $timaestamp = date("Y-m-d H:i:s");
        $user_id = session('userid');

        $PROJECT_NAME = $request->input('PROJECT_NAME');
        $PROJECT_DESCRIPTION = $request->input('PROJECT_DESCRIPTION');
        $PROJECT_TARGET_HR = $request->input('PROJECT_TARGET_HR');
        $PROJECT_COST = $request->input('PROJECT_COST');

        $data['PROJECT_NAME'] = $PROJECT_NAME;
        $data['PROJECT_DESCRIPTION'] = $PROJECT_DESCRIPTION;
        $data['PROJECT_TARGET_HR'] = $PROJECT_TARGET_HR;
        $data['PROJECT_COST'] = $PROJECT_COST;
        $data['CREATED_BY'] = $user_id;
        $data['CREATED_AT'] = $timaestamp;
        $data['FLAG'] = 'Show';

        $response = $addmodule->addprojectdata($data, 'mst_tbl_project_master');

        $message = '';
        $retVal = ($response == 'Done') ? $message = 'Done' : $message = 'Error';
        return $retVal;
    }

    public function show_all_project()
    {
        $details = new mainModel();
        $projectDetails = $details->showallproject();

        return Datatables::of($projectDetails)
            ->addIndexColumn()
            ->addColumn('action', function ($query) {
                $id = Crypt::encrypt($query->PROJECT_ID);
                return '<a href="' . action('Admin\ProjectMasterController@edit_project', Crypt::encrypt($query->PROJECT_ID)) . '"><img src="/asset/css/zondicons/zondicons/edit-pencil.svg"  style="width: 15px;margin-right: 20px;    filter: invert(0.5);" alt=""></a>
                <a href="javascript:void(0)" onclick="deleteDepartments(' . "'$id'" . ',event)"><img src="/asset/css/zondicons/zondicons/close.svg"
                style="width: 15px;    filter: invert(0.5);" alt=""></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function edit_project($projectid)
    {
        $project_id  = Crypt::decrypt($projectid);

        $getdata = DB::table('mst_tbl_project_master')
            ->where(
                ['FLAG' => 'Show', 'PROJECT_ID' => $project_id]
            )->get()
            ->first();
        $prodata['PROJECT_ID'] = $getdata->PROJECT_ID;
        $prodata['PROJECT_NAME'] = $getdata->PROJECT_NAME;
        $prodata['PROJECT_DESCRIPTION'] = $getdata->PROJECT_DESCRIPTION;
        $prodata['PROJECT_TARGET_HR'] = $getdata->PROJECT_TARGET_HR;
        $prodata['PROJECT_COST'] = $getdata->PROJECT_COST;

        $allprodata = (object) $prodata;

        return view('Admin.project_master.edit_project', compact('allprodata'));
    }

    public function update_project(Request  $request)
    {
        $prodetails = new mainModel();
        $timaestamp = date("Y-m-d H:i:s");
        $user_id = session('userid');

        $data['PROJECT_ID'] = $request->PROJECT_ID;
        $data['PROJECT_NAME'] = $request->PROJECT_NAME;
        $data['PROJECT_DESCRIPTION'] = $request->PROJECT_DESCRIPTION;
        $data['PROJECT_TARGET_HR'] = $request->PROJECT_TARGET_HR;
        $data['PROJECT_COST'] = $request->PROJECT_COST;
        $data['UPDATE_BY'] = $user_id;
        $data['UPDATE_AT'] = $timaestamp;

        $retmsg = $prodetails->updateproject($data);
        return $retmsg;
    }

    public function deleted_project($id)
    {
        $addmodel = new mainModel();
        date_default_timezone_set('Asia/Kolkata');
        $timaestamp = date("Y-m-d H:i:s");
        $user_id = session('userid');

        $id = Crypt::decrypt($id);
        $data['UPDATE_BY'] = $user_id;
        $data['UPDATE_AT'] = $timaestamp;
        $data['FLAG'] = 'Deleted';
        $response = $addmodel->deletedproject($id, $data);
        return $response;
    }
}
