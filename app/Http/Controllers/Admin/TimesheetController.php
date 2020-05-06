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

        return view('Admin.time_sheet.show_timesheet', compact('projectlist'));
    }

    public function add_timesheet(Request $request)
    {
        $addmodel = new mainModel();
        date_default_timezone_set('Asia/Kolkata');
        // $time = date("h:i:sa");
        $timaestamp = date("Y-m-d H:i:s");
        $user_id = session('userid');

        $START_HR = $request->START_HR;
        $START_MIN = $request->START_MIN;
        $STOP_HR = $request->STOP_HR;
        $STOP_MIN = $request->STOP_MIN;

        $starttime = $START_HR . ':' . $START_MIN;
        $stoptime = $STOP_HR . ':' . $STOP_MIN;
        $diff = (strtotime($stoptime) - strtotime($starttime));
        $total = $diff / 60;
        $total_time = sprintf("%02d:%02d", floor($total / 60), $total % 60);
        $newtime = explode(":", $total_time);
        //   print_r($newtime);echo "<br>";

        $TOTAL_HR = $newtime[0];
        $TOTAL_MIN = $newtime[1];

        $data['USER_ID'] = $user_id;
        $data['PROJECT_ID'] = $request->PROJECT_ID;
        $data['TIMESHEET_DATE'] = $request->TIMESHEET_DATE;
        $data['DESCRIPTION'] = $request->DESCRIPTION;
        $data['START_HR'] = $START_HR;
        $data['START_MIN'] = $START_MIN;
        $data['STOP_HR'] = $STOP_HR;
        $data['STOP_MIN'] = $STOP_MIN;
        $data['START_TIME'] = $starttime;
        $data['STOP_TIME'] = $stoptime;
        $data['TOTAL_HR'] = $TOTAL_HR;
        $data['TOTAL_MIN'] = $TOTAL_MIN;
        $data['CREATED_BY'] = $user_id;
        $data['CREATED_AT'] = $timaestamp;
        $data['FLAG'] = 'Show';

        // print_r($data);

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
        // $time = date("h:i:sa");
        $timaestamp = date("Y-m-d H:i:s");
        $user_id = session('userid');

        $START_HR = $request->UP_START_HR;
        $START_MIN = $request->UP_START_MIN;
        $STOP_HR = $request->UP_STOP_HR;
        $STOP_MIN = $request->UP_STOP_MIN;

        $starttime = $START_HR . ':' . $START_MIN;
        $stoptime = $STOP_HR . ':' . $STOP_MIN;
        $diff = (strtotime($stoptime) - strtotime($starttime));
        $total = $diff / 60;
        $total_time = sprintf("%02d:%02d", floor($total / 60), $total % 60);
        $newtime = explode(":", $total_time);
        //   print_r($newtime);echo "<br>";

        $TOTAL_HR = $newtime[0];
        $TOTAL_MIN = $newtime[1];

        $data['TIMESHEET_ID'] = $request->TIMESHEET_ID;
        $data['USER_ID'] = $user_id;
        $data['PROJECT_ID'] = $request->UP_PROJECT_ID;
        $data['TIMESHEET_DATE'] = $request->UP_TIMESHEET_DATE;
        $data['DESCRIPTION'] = $request->UP_DESCRIPTION;
        $data['START_HR'] = $START_HR;
        $data['START_MIN'] = $START_MIN;
        $data['STOP_HR'] = $STOP_HR;
        $data['STOP_MIN'] = $STOP_MIN;
        $data['START_TIME'] = $starttime;
        $data['STOP_TIME'] = $stoptime;
        $data['TOTAL_HR'] = $TOTAL_HR;
        $data['TOTAL_MIN'] = $TOTAL_MIN;
        $data['UPDATED_BY'] = $user_id;
        $data['UPDATED_AT'] = $timaestamp;


        // print_r($data);

            $response = $addmodel->updatetimesheet($data, 'mst_tbl_timesheet');
            $message = '';
            $retVal = ($response == 'Done') ? $message = 'Done' : $message = 'Error';
            return $retVal;
    }
}
