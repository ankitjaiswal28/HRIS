<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\mainModel;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Crypt;

class TimeSheetController extends Controller
{

    public function index()
    {
        $getdata = DB::table('mst_tbl_project_master')->where(['FLAG' => 'Show'])->get();
        $projectlist = (object) $getdata;

        $getactivity = DB::table('mst_tbl_activity_master')->where(['FLAG' => 'Show'])->get();
        $activitytype = (object) $getactivity;


        return view('Admin.time_sheet.show_timesheet', compact('projectlist', 'activitytype'));
    }

    public function add_timesheet(Request $request)
    {
        $addmodel = new mainModel();
        date_default_timezone_set('Asia/Kolkata');
        $timaestamp = date("Y-m-d H:i:s");
        $user_id = session('userid');

        $START_TIME = $request->InitialTime;
        $STOP_TIME = $request->EndTime;
        $s1 = explode(' ', $START_TIME);
        $s2 = explode(' ', $STOP_TIME);

        $diff = (strtotime($s2[0]) - strtotime($s1[0]));
        $total = $diff / 60;
        $total_time = sprintf("%02d:%02d", floor($total / 60), $total % 60);
        $newtime = explode(":", $total_time);

        $TOTAL_HR = $newtime[0];
        $TOTAL_MIN = $newtime[1];
        $date = strtotime($request->datepicker);
        $startdate = date('Y-m-d', $date);
        $data['USER_ID'] = $user_id;
        $data['PROJECT_ID'] = $request->PROJECT_ID;
        $data['ACTIVITY_TYPE'] = $request->ACTIVITY_TYPE;
        $data['TIMESHEET_DATE'] = $startdate;
        $data['DESCRIPTION'] = $request->DESCRIPTION;
        $data['START_TIME'] = $START_TIME;
        $data['STOP_TIME'] = $STOP_TIME;
        $data['TOTAL_HR'] = $TOTAL_HR;
        $data['TOTAL_MIN'] = $TOTAL_MIN;
        $data['CREATED_BY'] = $user_id;
        $data['CREATED_AT'] = $timaestamp;
        $data['FLAG'] = 'Show';

        $response = $addmodel->addtimesheet($data, 'mst_tbl_timesheet');
        $message = '';
        $retVal = ($response == 'Done') ? $message = 'Done' : $message = 'Error';
        return $retVal;
    }



    public function show_all_timesheet()
    {
        $addmodel = new mainModel();
        $timesheetDetails = $addmodel->showalltimesheet();

        return Datatables::of($timesheetDetails)->addIndexColumn()->addColumn('action', function ($query) {
            return '<a onclick="editapplyleavetype(' . $query->TIMESHEET_ID . ')"><img src="/asset/css/zondicons/zondicons/edit-pencil.svg"  style="width: 15px;margin-right: 20px;    filter: invert(0.5);" alt=""></a>';
        })
            ->rawColumns(['action'])->make(true);
    }

    public function timesheet_get_data(Request $request)
    {
        $update_id = new mainModel();
        $autoid = $request->autoid;
        $data['autoid'] = $autoid;
        $responsemessg = $update_id->timesheet_get_data($data);
        return  $responsemessg;
    }

    public function update_timesheet(Request  $request)
    {
        $addmodel = new mainModel();
        date_default_timezone_set('Asia/Kolkata');
        $timaestamp = date("Y-m-d H:i:s");
        $user_id = session('userid');

        $START_TIME = $request->UP_InitialTime;

        $STOP_TIME = $request->UP_EndTime;
        $s1 = explode(' ', $START_TIME);
        $s2 = explode(' ', $STOP_TIME);

        $diff = (strtotime($s2[0]) - strtotime($s1[0]));
        $total = $diff / 60;
        $total_time = sprintf("%02d:%02d", floor($total / 60), $total % 60);
        $newtime = explode(":", $total_time);
        $TOTAL_HR = $newtime[0];
        $TOTAL_MIN = $newtime[1];

        $date = strtotime($request->datepicker);
        $startdate = date('Y-m-d', $date);
        $data['USER_ID'] = $user_id;
        $data['PROJECT_ID'] = $request->UP_PROJECT_ID;
        $data['ACTIVITY_TYPE'] = $request->UP_ACTIVITY_TYPE;
        $data['DESCRIPTION'] = $request->UP_DESCRIPTION;
        $data['START_TIME'] = $START_TIME;
        $data['STOP_TIME'] = $STOP_TIME;
        $data['TOTAL_HR'] = $TOTAL_HR;
        $data['TOTAL_MIN'] = $TOTAL_MIN;
        $data['TIMESHEET_ID'] = $request->TIMESHEET_ID;
        $data['UPDATED_BY'] = $user_id;
        $data['UPDATED_AT'] = $timaestamp;

        $response = $addmodel->updatetimesheet($data, 'mst_tbl_timesheet');
        $message = '';
        $retVal = ($response == 'Done') ? $message = 'Done' : $message = 'Error';
        return $retVal;
    }
}
