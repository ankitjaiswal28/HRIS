<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Session\Session;
use App\Models\mainModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Show The DashBorad Page Vivew
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Admin.dashboard');
    }


    /**
     * This Function Will Will Save The Atttendence
     * Of the User
     * @param  \Illuminate\Http\Request  $request All Session Data
     * @return \Illuminate\Http\Response
     */
    public function SaveAtdendence(Request $request)
    {
        // print_r($_SERVER);
        // exit();
        $details = new mainModel();
        //$UserShift = '1 Shift';
        $UserId = $request->session()->get('userid');
        $shiftsdetails = DB::table('mst_user_tbl')->where(['Flag' => 'Show', 'userId' => $UserId])->get()->first();
        $UserShift = $shiftsdetails->SHIFT_ID;
        $ADMINCLIENT_ID = $shiftsdetails->ADMINCLIENT_ID;

        // print_r();exit;
        $timaestamp = date("Y-m-d H:i:s");
        $date = date('Y-m-d');
        $time = date(' H:i:s');
        $data['user_id'] = $UserId;
        $data['shift'] = $UserShift;
        $data['in_Date'] = $date;
        $data['in_time'] = $time;
        $data['Stutus'] = 'IN';
        $data['Flag'] = 'Show';
        $data['CREATED_BY'] = $UserId;
        $data['created_at'] = $timaestamp;
        $data['assgin_user_toclient'] = $ADMINCLIENT_ID;
        $response = $details->saveAttendence($data);
        return $response;
        // $id = $details->insertRecords($data,'mst_tbl_add_attdencence');
        // $message = '';
        // $retVal = ($id != '') ? $message = 'Done' : $message = 'Error';
        // return $retVal;
    }
    /**
     * This Function Will Will Put Logout  The Atttendence
     * Of the User
     * @param  \Illuminate\Http\Request  $request All Session Data
     * @return \Illuminate\Http\Response
     */
    public function leaveAttendence(Request $request)
    {
        $details = new mainModel();
        $UserShift = '1 Shift';
        $UserId = $request->session()->get('userid');

        // $timaestamp = date("Y-m-d H:i:s");
        $date = date('Y-m-d');
        $time = date(' H:i:s');
        $data['user_id'] = $UserId;
        // $data['shift'] = $UserShift;
        $data['out_Date'] = $date;
        $data['out_time'] = $time;
        $data['timaestamp'] = date("Y-m-d H:i:s");
        $data['Stutus'] = 'OUT';
        // print_r($data);
        // exit;
        $updated = $details->leaveAttendence($data);
        //$updated = DB::table('mst_tbl_add_attdencence')->where(['user_id'=>$UserId])->update($data);
        // $id = $details->insertRecords($data,'mst_tbl_add_attdencence');
        $message = '';
        $retVal = ($updated != '') ? $message = 'Done' : $message = 'Error';
        return $updated;
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
     * It will Fetch Wthere Is Addthe Attendence or Not.
     *
     * @param  int  $request Contain  The User Id
     * @return \Illuminate\Http\Response
     */
    public function getAttendence(Request $request)
    {
        $userId = $request['userId'];
        $countdetails= DB::table('mst_tbl_add_attdencence')->where('in_Date', '>=', Carbon::today())->where(['user_id'=>$userId, 'Flag' => 'Show'])->get()->count();
        // print_r($countdetails);
        // exit;
        $Status = '';
        if ($countdetails != 0) {
            $details= DB::table('mst_tbl_add_attdencence')->where('in_Date', '>=', Carbon::today())->where(['user_id'=>$userId, 'Flag' => 'Show'])->get()->first();
            $Status = $details->Stutus;
        } else {
            $Status = '';
        }
       //
        return $Status;
      // $details= DB::table('mst_tbl_add_attdencence')->where(['user_id'=>$userId])->get();
      //  print_r($details);
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
