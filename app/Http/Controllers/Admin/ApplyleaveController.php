<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\mainModel;
use App\User;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class ApplyleaveController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }

    public function applyleave()
    {
        $details = new mainModel();
        $leave_details = $details->show_leavedata();
        $all_leave_type = $details->all_leave_type();
        $UserId = 10;
        $unplanned_pending_leave = $details->unplanned_pending_leave($UserId);
        return view('Admin.Apply_leave',compact('leave_details','all_leave_type'));
    }

    public function Leave_manage()
    {
        $details = new mainModel();
        $request_count = $details->show_leave_pending_req_count();
        return view('Admin.Leave_manage',compact('request_count'));
    }

    public function update_leave_manage_data(Request $request)
    {

        $update_id = new mainModel();
        $autoid = $request->autoid;
        $data['autoid'] = $autoid;
        $responsemessg = $update_id->update_leave_manage_data($data);
        return  $responsemessg;
    }

    public function approve_leave_manage_data(Request $request)
    {
        $update_id = new mainModel();
        $autoid = $request->autoid;
        $data['autoid'] = $autoid;
        $responsemessg = $update_id->approve_leave_manage_data($data);
        return  $responsemessg;
    }

    public function approve_leave_with_user_id(Request $request)
    {
        $update_id = new mainModel();
        $user_id_approve = $request->user_id_approve;
        $leave_status = $request->leave_status;

        $data['LEAVE_ID'] = $user_id_approve;
        $data['LEAVE_STATUS'] = $leave_status;
        $table_name = 'mst_tbl_leaves';
        $keyvalue = $request->user_id_approve;
        $keyname = 'LEAVE_ID';
        $responsemessg = $update_id->approve_leave_with_user_id($table_name,$keyname,$keyvalue,$data);
        return  $responsemessg;
    }


    public function update_leave_manage_code(Request $request)
    {

        $edit_leave_manage = new mainModel();
        $edit_leave_type_name = $request->edit_leave_type_name;
        $edit_allote_day = $request->edit_allote_day;
        $leave_type_id = $request->leave_type_id;
        $data['LEAVE_TYPE_ID'] = $leave_type_id;
        $data['LEAVE_TYPE_NAME'] = $edit_leave_type_name;
        $data['ALLOTED_DAYS'] = $edit_allote_day;
        $table_name = 'mst_tbl_leave_type';
        $keyvalue = $request->leave_type_id;
        $keyname = 'LEAVE_TYPE_ID';
        $responsemessg = $edit_leave_manage->update_leave_manage_codeee($table_name,$keyname,$keyvalue,$data);
        // return  $responsemessg;
    }

    public function show_leave_type()
    {
        $details = new mainModel();
        $leavetype_details = $details->show_leave_type();
        return Datatables::of($leavetype_details)
        ->addIndexColumn()
        ->addColumn('action', function ($query) {
            return '<a  onclick="editapplyleavetype('.$query->LEAVE_TYPE_ID.')"><img src="/asset/css/zondicons/zondicons/edit-pencil.svg"  style="width: 15px;margin-right: 20px;    filter: invert(0.5);" alt=""></a>
            <a href="'.action('Admin\ApplyleaveController@delete_leavetype', Crypt::encrypt($query->LEAVE_TYPE_ID)).'"><img src="/asset/css/zondicons/zondicons/close.svg"
            style="width: 15px;    filter: invert(0.5);" alt=""></a>
            ';
        })
        ->rawColumns(['action'])
       ->make(true);
    }
    // public function edit_leavetype($id)
    // {
    //     echo $ddddd = Crypt::decrypt($id);
    // }
    public function delete_leavetype($id)
    {
       $leave_type_id = Crypt::decrypt($id);
       $Delete_query = DB::table('mst_tbl_leave_type')->where(['FLAG'=>'Show','LEAVE_TYPE_ID'=>$leave_type_id])->update(['FLAG'=>'Deleted']);
       $details = new mainModel();
       $request_count = $details->show_leave_pending_req_count();
       return view('Admin.Leave_manage',compact('request_count'));
    }

    public function show_pending_leave_request()
    {
        $details = new mainModel();
        $Pending_leave_details = $details->show_leave_pending_req();
        return Datatables::of($Pending_leave_details)
        ->addIndexColumn()
        ->addColumn('action', function ($query) {
            return '<a onclick="declineleaverequest('.$query->LEAVE_ID.')" id="userform'.$query->LEAVE_ID.'" style="color: white;padding: 8px 12px;background: #ef5753;border-radius: 25px;" data-effect="mfp-move-from-top">Decline</a>
            <a href="#" onclick="approveleaverequest('.$query->LEAVE_ID.')" id="userform'.$query->LEAVE_ID.'" style="color: white;padding: 8px 12px;background: #03aef6;border-radius: 25px;margin: 0px 10px;">Approve</a>
            ';
        })
        ->rawColumns(['action'])
       ->make(true);
    }
     public function decline_request($ddddd)
    {
        echo $ddddd = Crypt::decrypt($ddddd);
    }
    public function Approve_request($ddddd)
    {
       echo $ddddd = Crypt::decrypt($ddddd);
    }

    public function insert_leave_manage(Request $request)
    {
        $insert_leave_manage = new mainModel();
        $leave_type_name = $request->leave_type_name;
        $allote_day = $request->allote_day;
        $data['leave_type_name'] = $leave_type_name;
        $data['allote_day'] = $allote_day;
        $responsemessg = $insert_leave_manage->insert_leave_manage_model($data);
        return  $responsemessg;
    }

    public function insert_applyleave(Request $request)
    {
        $details = new mainModel();

        $leave_type = $request->leave_type;
        $reason = $request->reason;
        $start_leave_date = $request->start_leave_date;
        $end_leave_date = $request->end_leave_date;
        $user_id = $request->user_id;
        $username = $request->username;
        $today_date = $request->today_date;
        $leave_status = $request->leave_status;
        $leave_reason = $request->reason;
        $leave_days = $request->days;
        $Start_datewithday = $request->Start_datewithday;

        $data['leave_type'] = $leave_type;
        $data['reason'] = $reason;
        $data['start_leave_date'] = $start_leave_date;
        $data['end_leave_date'] = $end_leave_date;
        $data['user_id'] = $user_id;
        $data['username'] = $username;
        $data['today_date'] = $today_date;
        $data['leave_status'] = $leave_status;
        $data['leave_reason'] = $leave_reason;
        $data['leave_days'] = $leave_days;
        $data['Start_datewithday'] = $Start_datewithday;

       $responsemessg = $details->insert_apply_leave($data);
        return  $responsemessg;
    }
}
