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
        // userid
       // echo $username = $request['timestamp'];
        // $date = Carbon::now();
        // // echo $date1 = date('Y-m-d',strtotime($date));
        // $tim1 =  date('H:i:s',strtotime($date));
        // $details = new mainModel();
        // $now = Carbon::now()->timestamp;
        // print_r($now);
        $details = new mainModel();
        $UserShift = '1 Shift';
        $UserId = $request->session()->get('userid');
        $timaestamp = date("Y-m-d H:i:s");
        $data['user_id'] = $UserId;
        $data['shift'] = $UserShift;
        $data['in_time_Date'] = $timaestamp;
        $data['Stutus'] = 'IN';
        $id = $details->insertRecords($data,'mst_tbl_add_attdencence');
        $message = '';
        $retVal = ($id != '') ? $message = 'Done' : $message = 'Error';
        return $retVal;
        //print_r($data);
        // $data[''] = $UserId;
        // $data[''] = $UserId;
        // echo $UserId;
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
        $countdetails= DB::table('mst_tbl_add_attdencence')->where('in_time_Date', '>=', Carbon::today())->where(['user_id'=>$userId])->get()->count();
        $Status = '';
        if ($countdetails != 0) {
            $details= DB::table('mst_tbl_add_attdencence')->where('in_time_Date', '>=', Carbon::today())->where(['user_id'=>$userId])->get()->first();
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
