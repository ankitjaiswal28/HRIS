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

        $date = date('Y-m-d');
        date_default_timezone_set('Asia/Kolkata');
        $time = date("h:i:sa");

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
        $data['CREATED_DATE'] = $date;
        $data['CREATED_TIME'] = $time;
        $data['FLAG'] = 'Show';

        $insertdata = $addmodule->insertRecords($data, 'mst_tbl_project_master');
    }

    public function show_all_project()
    {
        $details = new mainModel();
        $projectDetails = $details->showallproject();

        return Datatables::of($projectDetails)->addIndexColumn()->addColumn('action', function ($query) {
            return '<a href="sfdsfdsfdsfdsfdsf"><img src="/asset/css/zondicons/zondicons/edit-pencil.svg"  style="width: 15px;margin-right: 20px;    filter: invert(0.5);" alt=""></a>
            <a href="dfdsfdfdsdsfdf"><img src="/asset/css/zondicons/zondicons/close.svg"
            style="width: 15px;    filter: invert(0.5);" alt=""></a>';
        })
        ->rawColumns(['action'])->make(true);
    }
}
