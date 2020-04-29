<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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
        $date = date('Y-m-d');
        date_default_timezone_set('Asia/Kolkata');
        $time = date("h:i:sa");


        $user_id = session('userid');
        $CLIENT_ID = session('clientid');

        $databasename = session('databasename');

        echo $databasename;

        $PROJECT_NAME = $request->input('PROJECT_NAME');
        $PROJECT_DESCRIPTION = $request->input('PROJECT_DESCRIPTION');
        $PROJECT_TARGET_HR = $request->input('PROJECT_TARGET_HR');
        $PROJECT_COST = $request->input('PROJECT_COST');

        $selectdata =   DB::table('mst_tbl_project_master')->where('FLAG', 'Show')->count();



        if ($selectdata > 0) {
            echo "already";
        } else {
            echo "nooooo";

            // $insertdata =
            //   DB::tsable('mst_tbl_project_master')->insert([

            //     'CLIENT_ID' => $CLIENT_ID,
            //     'PROJECT_NAME' => $PROJECT_NAME,
            //     'PROJECT_DESCRIPTION' => $PROJECT_DESCRIPTION,
            //     'PROJECT_TARGET_HR' => $PROJECT_TARGET_HR,
            //     'PROJECT_COST' => $PROJECT_COST,
            //     'CREATED_BY' => $user_id,
            //     'CREATED_DATE' => $date,
            //     'CREATED_TIME' => $time,
            //     'FLAG' => 'Show'
            // ]);

            // if ($insertdata > 0) {
            //     echo 'not';
            // } else {
            //     echo 'done';
            // }
        }
    }
}
