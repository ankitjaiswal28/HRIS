<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\Stream;
use App\Models\mainModel;
use Yajra\DataTables\Facades\DataTables;

class TimesheetReportController extends Controller
{
    public function index()
    {

        $getdata = DB::table('mst_tbl_project_master')->where(['FLAG' => 'Show'])->get();
        $projectlist = (object) $getdata;

        $getuser = DB::table('mst_user_tbl')->where(['FLAG' => 'Show', 'roleId' => '3'])->get();
        $usernamelist = (object) $getuser;

        return view('Admin.time_sheet.timesheet_report', compact('projectlist', 'usernamelist'));
    }

    public function getcsvdata(Request $request)
    {

        $PROJECT_ID = $request->PROJECT_ID;
        $USER_ID = $request->USER_ID;
        $FROM_DATE = $request->FROM_DATE;
        $TO_DATE = $request->TO_DATE;

        if ($PROJECT_ID == '0' && $USER_ID == '0') {

            $getcsvdata = DB::table('mst_tbl_timesheet')
                ->where(['FLAG' => 'Show'])
                ->whereBetween('TIMESHEET_DATE', [$FROM_DATE, $TO_DATE])
                ->get();
        } else if ($PROJECT_ID == '0' && $USER_ID != '0') {

            $getcsvdata = DB::table('mst_tbl_timesheet')
                ->where(['FLAG' => 'Show', 'USER_ID' => $USER_ID])
                ->whereBetween('TIMESHEET_DATE', [$FROM_DATE, $TO_DATE])
                ->get();
        } else if ($PROJECT_ID != '0' && $USER_ID == '0') {

            $getcsvdata = DB::table('mst_tbl_timesheet')
                ->where(['FLAG' => 'Show', 'PROJECT_ID' => $PROJECT_ID])
                ->whereBetween('TIMESHEET_DATE', [$FROM_DATE, $TO_DATE])
                ->get();
        } else {

            $getcsvdata = DB::table('mst_tbl_timesheet')
                ->where(['FLAG' => 'Show', 'PROJECT_ID' => $PROJECT_ID, 'USER_ID' => $USER_ID])
                ->whereBetween('TIMESHEET_DATE', [$FROM_DATE, $TO_DATE])
                ->get();
        }
        $csvlist = (object) $getcsvdata;
        $i = 0;
        $csv_header = array('PROJECT NAME', 'EMPLOYEE NAME', 'ACTIVITY TYPE', 'DATE', 'START TIME', 'STOP TIME', 'TOTAL HOURS', 'TOTAL MINUTES', 'DESCRIPTION');

        foreach ($csvlist as $csvlists) {
            $csvData = [];
            $getproid = $csvlists->PROJECT_ID;
            $getproname = DB::table('mst_tbl_project_master')
                ->where(['PROJECT_ID' => $getproid, 'FLAG' => 'Show'])
                ->get();

            $csvData[] = $getproname[0]->PROJECT_NAME;

            $getuserid  = $csvlists->USER_ID;
            $getusername = DB::table('mst_user_tbl')
                ->where(['userId' => $getuserid, 'FLAG' => 'Show'])
                ->get();

            $csvData[] = $getusername[0]->username;

            $getactivityid  = $csvlists->ACTIVITY_TYPE;
            $getactivitytype = DB::table('mst_tbl_activity_master')
                ->where(['ACTIVITY_ID' => $getactivityid, 'FLAG' => 'Show'])
                ->get();

            $csvData[] = $getactivitytype[0]->ACTIVITY_TYPE;

            $csvData[]  = $csvlists->TIMESHEET_DATE;
            $csvData[]  = $csvlists->START_TIME;
            $csvData[]  = $csvlists->STOP_TIME;
            $csvData[]  = $csvlists->TOTAL_HR;
            $csvData[]  = $csvlists->TOTAL_MIN;
            $csvData[]  = $csvlists->DESCRIPTION;

            $allcsvdata[] = $csvData;

            $i++;
        }

        // print_r($allcsvdata);
        $finalcsvarray = [];
        $finalcsvarray[] = $csv_header;
        $finalcsvarray[] = $allcsvdata;

        // print_r($finalcsvarray);

        if (!isset($finalcsvarray)) {
            $finalcsvarray = "";
        }
        $json_data = array(
            "data"  => $finalcsvarray
        );

        echo json_encode($json_data);
    }


    public function show_all_tsreport()
    {
        return view('Admin.time_sheet.show_timesheet_report');
    }

    public function show_all_tsdata()
    {
        $addmodel = new mainModel();
        $alltimesheetDetails = $addmodel->showalltsdata();

        return Datatables::of($alltimesheetDetails)
            ->addIndexColumn()
            ->addColumn('action', function ($query) {
                return '<a onclick=""><img src="/asset/css/zondicons/zondicons/edit-pencil.svg"  style="width: 15px;margin-right: 20px;    filter: invert(0.5);" alt=""></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
