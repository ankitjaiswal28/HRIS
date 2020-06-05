<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\mainModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class AttendenceController extends Controller
{
    /**
     * Display a listing of All Atendence of Users
     *
     * @return \Illuminate\Http\Response
     */
    public function showAttendence()
    {
        $userid = session()->get('userid');
        $allusers = DB::table('mst_user_tbl')->where(['Flag' => 'Show'])->where('userId', '!=', $userid)->get();
        return view('Admin.add_attandance', compact('allusers'));
    }

    /**
     * Show All Records of Attendence Based On UserId And Date
     *
     * @param  \Illuminate\Http\Request  $request Will Have FromDate, ToDate And User Id
     * @return \Illuminate\Http\Response
     */
    public function show_atendence_datatbl(Request $request)
    {
        // $model = new mainModel();
        $getUserId = $request->getUserId;
        $getfromdate = $request->getfromdate;
        $getToDate = $request->getToDate;
        $date = strtotime($getfromdate);
        $date2 = strtotime($getToDate);
        $startdate = date('Y-m-d', $date);
        $endDate = date('Y-m-d', $date2);
        $uesrId = session()->get('userid');
        /**  Do Not Remove From Here */
        //  $sql = "select * from `mst_tbl_add_attdencence` where date(`created_at`) >= '".$startdate."' AND date(`created_at`) <='".$startdate."'";
        // $responese = DB::select(DB::raw($sql));
        /** Till Here  */
        if ($getUserId == 'All') {
            $responese = DB::table('mst_tbl_add_attdencence')
                ->where(['Flag' => 'Show'])
                ->where('in_Date', '>=', $startdate)
                ->where('in_Date', '<=', $endDate)->get();
        } else {
            $responese = DB::table('mst_tbl_add_attdencence')
                ->where(['Flag' => 'Show', 'user_id' => $getUserId])
                ->where('in_Date', '>=', $startdate)
                ->where('in_Date', '<=', $endDate)->get();
        }
        return Datatables::of($responese)
            ->addIndexColumn()
            ->addColumn('user_id', function ($query) {
                $userName = DB::table('mst_user_tbl')->where(['Flag' => 'Show', 'userId' => $query->user_id])->get()->first();
                return $userName->username;
            })
            ->addColumn('CREATED_BY', function ($query) {
                $userName = DB::table('mst_user_tbl')->where(['Flag' => 'Show', 'userId' => $query->CREATED_BY])->get()->first();
                return $userName->username;
            })
            ->addColumn('shift', function ($query) use ($getToDate) {
                if ($query->shift != 0) {
                    $assinedShift = DB::table('mst_tbl_shifts')->where(['Flag' => 'Show', 'SHIFT_ID' => $query->shift])->get()->first();
                    return $assinedShift->SHIFT_NAME;
                } else {
                    return $getToDate;
                }
            })
            ->addColumn('assgin_user_toclient', function ($query) use ($getToDate) {
                if ($query->assgin_user_toclient != 0) {
                    $assinedClient = DB::table('mst_tbl_admin_clients')->where(['Flag' => 'Show', 'ADMIN_CLIENT_ID' => $query->assgin_user_toclient])->get()->first();
                    return $assinedClient->CLIENT_NAME;
                } else {
                    return $getToDate;
                    // return 'No Client';
                }
            })
            ->addColumn('action', function ($query) {
                $id = Crypt::encrypt($query->attendenceId);
                return '<a href="' . action('Admin\AttendenceController@editAttendence', Crypt::encrypt($query->attendenceId)) . '" id="userform' . $query->attendenceId . '">UpdateInTime</a><br><a href="' . action('Admin\AttendenceController@editoutAttendence', Crypt::encrypt($query->attendenceId)) . '" id="userform' . $query->attendenceId . '">UpdateOutTime</a>
                <a href="javascript:void(0)" onclick="deleteAttendence(' . "'$id'" . ',event)"><img src="/asset/css/zondicons/zondicons/close.svg"
                style="width: 15px;    filter: invert(0.5);" alt=""></a>
                ';
            })
            ->rawColumns(['assgin_user_toclient', 'shift', 'action'])
            ->make(true);
    }

    /**
     * Show The Form Of Create Attendence Patch
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response View Page For Create ATendence
     */
    public function CreateAtendence()
    {
        $userid = session()->get('userid');
        $allusers = DB::table('mst_user_tbl')->where(['Flag' => 'Show'])->where('userId', '!=', $userid)->get();
        return view('Admin.Add-Attendence', compact('allusers'));
    }

    /**
     * Store a newly Attendence User in storage.
     *
     * @param  \Illuminate\Http\Request  $request Data To Save The Attendence
     * @return \Illuminate\Http\Response Return Message That Attendence Is Added Or Not
     */
    public function saveAtttendence(Request $request)
    {
        $details = new mainModel();
        $startdate = $request->startdate;
        $InitialTime = $request->inTime;
        $userid = $request->userid;
        $CreatedBy = $request->session()->get('userid');
        $date = strtotime($startdate);
        $in_Date = date('Y-m-d', $date);
        $time = strtotime($InitialTime);
        $in_time = date(' H:i:s', $time);
        $shiftsdetails = DB::table('mst_user_tbl')->where(['Flag' => 'Show', 'userId' => $userid])->get()->first();
        $UserShift = $shiftsdetails->SHIFT_ID;
        $ADMINCLIENT_ID = $shiftsdetails->ADMINCLIENT_ID;
        $timaestamp = date("Y-m-d H:i:s");
        $data['user_id'] = $userid;
        $data['shift'] = $UserShift;
        $data['in_Date'] = $in_Date;
        $data['in_time'] = $in_time;
        $data['Stutus'] = 'IN';
        $data['Flag'] = 'Show';
        $data['CREATED_BY'] = $CreatedBy;
        $data['created_at'] = $timaestamp;
        $data['assgin_user_toclient'] = $ADMINCLIENT_ID;
        $response = $details->saveAttendence($data);
        return $response;
        // print_r($in_time);
    }

    /**
     * Display the specified Attendence of In Time
     *
     * @param  int  $id it Will Have Attendence
     * @return \Illuminate\Http\Response return View Page Of Attendence
     */
    public function editAttendence($id)
    {

        $id = Crypt::decrypt($id);
        $responese = DB::table('mst_tbl_add_attdencence')->where(['Flag' => 'Show' , 'attendenceId' => $id])->first();
        $userid = $responese->user_id;
        $allusers = DB::table('mst_user_tbl')->where(['Flag' => 'Show'])->where('userId', '=', $userid)->first();
        $username = $allusers->username;
        return view('Admin.Edit-Attendence',  compact('username', 'responese') );
    }

     /**
     * Display the specified Attendence of Out Time
     *
     * @param  int  $id it Will Have Attendence
     * @return \Illuminate\Http\Response return View Page Of Attendence
     */
    public function editoutAttendence($id)
    {

        $id = Crypt::decrypt($id);
        $responese = DB::table('mst_tbl_add_attdencence')->where(['Flag' => 'Show' , 'attendenceId' => $id])->first();
        $userid = $responese->user_id;
        $allusers = DB::table('mst_user_tbl')->where(['Flag' => 'Show'])->where('userId', '=', $userid)->first();
        $username = $allusers->username;
        // return view('Admin.Edit-OutAttendence')
        return view('Admin.Edit-OutAttendence',  compact('username', 'responese') );
    }

    /**
     * Update the In Time .
     *
     * @param  \Illuminate\Http\Request  $request In Time And Date
     * @param  int  $id Attendence Id
     * @return \Illuminate\Http\Response Time Is Updated
     */
    public function updateTimes(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $userdeatils = DB::table('mst_tbl_add_attdencence')->where(['Flag' => 'Show' , 'attendenceId' => $id])->first();
        $userid = $userdeatils->user_id;
        $out_time = $userdeatils->out_time;
        $details = new mainModel();
        $startdate = $request->startdate;
        $InitialTime = $request->inTime;
        $UPDATED_BY = $request->session()->get('userid');
        $date = strtotime($startdate);
        $in_Date = date('Y-m-d', $date);
        $time = strtotime($InitialTime);
        $in_time = date(' H:i:s', $time);
        if ($out_time != '') {
            $InTimeDate = $in_Date . ' ' . $in_time;
            $start  = new Carbon($InTimeDate);
            $out_Date = $userdeatils->out_Date;
            $OutTimeDate = $out_Date . ' ' . $out_time;
            $end    = new Carbon($OutTimeDate);
            $totalhours = $start->diff($end)->format('%H:%I:%S') . ' Hrs';
            $data['total_hours'] = $totalhours;
        }
        $timaestamp = date("Y-m-d H:i:s");
        $data['in_Date'] = $in_Date;
        $data['in_time'] = $in_time;
        $data['UPDATED_BY'] = $UPDATED_BY;
        $data['updated_at'] = $timaestamp;
        $data['user_id'] = $userid;
        $response = $details->updateAttedencence($data, $id, 'in_Date', $in_Date);
        return $response;
    }

    /**
     * Update the In Time .
     *
     * @param  \Illuminate\Http\Request  $request In Time And Date
     * @param  int  $id Attendence Id
     * @return \Illuminate\Http\Response Time Is Updated
     */
    public function updateOutTimes(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $startdate = $request->startdate;
        $UPDATED_BY = $request->session()->get('userid');
        $date = strtotime($startdate);
        $out_Date = date('Y-m-d', $date);
        $InitialTime = $request->inTime;
        $time = strtotime($InitialTime);
        $out_time = date(' H:i:s', $time);
        $userdeatils = DB::table('mst_tbl_add_attdencence')->where(['Flag' => 'Show' , 'attendenceId' => $id])->first();
        $userid = $userdeatils->user_id;
        $InDate = $userdeatils->in_Date;
        $InTime = $userdeatils->in_time;
        $InTimeDate = $InDate . ' ' . $InTime;
        $details = new mainModel();
        $start  = new Carbon($InTimeDate);
        $OutTimeDate = $out_Date . ' ' . $out_time;
        $end    = new Carbon($OutTimeDate);
        $totalhours = $start->diff($end)->format('%H:%I:%S') . ' Hrs';
        $timaestamp = date("Y-m-d H:i:s");
        $data['total_hours'] = $totalhours;
        $data['out_Date'] = $out_Date;
        $data['out_time'] = $out_time;
        $data['Stutus'] = 'OUT';
        $data['UPDATED_BY'] = $UPDATED_BY;
        $data['updated_at'] = $timaestamp;
        $data['user_id'] = $userid;
        $response = $details->updateAttedencence($data, $id, 'out_Date' , $out_Date);
        return $response;
        print_r($time);
        exit;
    }

    /**
     * Remove the Attendence from storage.
     *
     * @param  int  $id of The Attendence
     * @return \Illuminate\Http\Response Remove The Attendence
     */
    public function deleteAttendence($id)
    {
        $model = new mainModel();
        $userid = session()->get('userid');
        $timaestamp = date("Y-m-d H:i:s");
        $id = Crypt::decrypt($id);
        $data['UPDATED_BY'] = $userid;
        $data['updated_at'] = $timaestamp;
        $data['FLAG'] = 'Delete';
        $response = $model->deleteAttendence($id, $data);
        return $response;
    }
}
