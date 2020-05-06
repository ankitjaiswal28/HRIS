<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Contracts\Session\Session;
use Carbon\Carbon;
use DateTime;
class mainModel extends Model
{
    /**
     * This Function is to Save the Details
     * and Send Response To controller
     * @param $data \Illuminate\Http\Request  $data will Have All Data To insert.
     * @param $tablename \Illuminate\Http\Request  $tablename Tabel Name.
     * @return \Illuminate\Http\Response Return Response Message
     */
    public function insertRecords($data, $tablename)
    {
        // print_r(session('databasename'));
        // echo "Connected sucessfully to database ".DB::connection()->getDatabaseName().".";
        // DB::enableQuerylog();
        $insert =  DB::table($tablename)->insertGetId($data);
        // $aa= DB::getQuerylog();
        // print_r($aa);exit;
        return $insert;
    }
    /**
     * This Function is to Craete The Client
     * and Send Response To controller
     * @param $data \Illuminate\Http\Request  $data will Have All Data To insert.
     * @return \Illuminate\Http\Response Return Response Message of Client Craeted
     */


    public function insert_leave_manage_model($data)
    {
        $leave_type_name = $data['leave_type_name'];
        $allote_day = $data['allote_day'];
        $message = '';
        $newleave = DB::table('mst_tbl_leave_type')->where(['LEAVE_TYPE_NAME' => $leave_type_name , 'FLAG' => 'Show'])->get()->count();
        if ($newleave == 0) {
            $columnname['LEAVE_TYPE_NAME'] = $leave_type_name;
            $columnname['ALLOTED_DAYS'] = $allote_day;
            $columnname['FLAG'] = "Show";
            $Leave_type_id = $this->insertRecords($columnname, 'mst_tbl_leave_type');
        }else {
            $message = 'Already';
        }
        return $message;
    }

    public function insert_apply_leave($data)
    {
        $leave_type = $data['leave_type'];
        $start_leave_date = $data['start_leave_date'];
        $end_leave_date= $data['end_leave_date'];
        $user_id = $data['user_id'];
        $username = $data['username'];
        $today_date = $data['today_date'];
        $leave_status = $data['leave_status'];
        $leave_reason = $data['leave_reason'];
        $leave_days = $data['leave_days'];
        $Start_datewithday = $data['Start_datewithday'];
        $message = '';
        $newleave = DB::table('mst_tbl_leaves')->where(['LEAVE_REASON' => $leave_reason])->get()->count();
        // print_r($newleave);
        if ($newleave == 0) {
            $columnname['USER_ID'] = $user_id;
            $columnname['USER_NAME'] = $username;
            $columnname['CURRENT_DATE'] = $today_date;
            $columnname['LEAVE_TYPE'] = $leave_type;
            $columnname['START_LEAVE_DATE'] = $start_leave_date;
            $columnname['END_LEAVE_DATE'] = $end_leave_date;
            $columnname['LEAVE_REASON'] = $leave_reason;
            $columnname['LEAVE_STATUS'] = $leave_status;
            $columnname['LEAVE_DAYS'] = $leave_days;
            $columnname['START_DATEWITHDAY'] = $Start_datewithday;

            //print_r($columnname);
            $Leave_ID = $this->insertRecords($columnname, 'mst_tbl_leaves');
        }else {
            $message = 'Already';
        }
        return $message;
    }

    public function clientCreation($data)
    {
        // $originalDB = Session :: get('databasename');;
        $companyname = $data['companyname'];
        $adminname = $data['adminname'];
        $mobileno = $data['mobileno'];
        $email = $data['email'];
        $prefix = strtolower($data['prefix']);
        $pwd = $data['pwd'];
        $databsename = $prefix . '_management';
        $originalDB = $data['orignaldatabase'];
        $timaestamp = date("Y-m-d H:i:s");
        $aaryofDetails = [];
        $message = '';
        $newUser = DB::table('sup_tbl_client')->where(['Flag' => 'Show', 'ADMIN_EMAILID' => $email])->get()->count();
        if ($newUser == 0) {
            $checkprefix = DB::table('sup_tbl_client')->where(['Flag' => 'Show', 'CLIENT_PREFIX' => $prefix])->get()->count();
            if ($checkprefix == 0) {
                DB::statement('Create database ' . $databsename);
                $tables = DB::select("SELECT  table_name FROM information_schema.tables WHERE table_schema = '$originalDB' and TABLE_NAME NOT LIKE 'sup_%' ORDER BY table_name");
                $i = 0;
                foreach ($tables as $key => $value) {
                    $aaryofDetails[$key] = $value;
                    $tablesname = $aaryofDetails[$i]->table_name;
                    DB::statement('Create Table ' . $databsename . '.' . $tablesname . ' Like ' . $originalDB . '.' . $tablesname);
                    //print_r($tablesname);
                    $i++;
                }
                $columnname['COMPANY_NAME'] = $companyname;
                $columnname['ADMIN_NAME'] = $adminname;
                $columnname['ADMIN_MOB_NO'] = $mobileno;
                $columnname['ADMIN_EMAILID'] = $email;
                $columnname['CLIENT_PREFIX'] = $prefix;
                $columnname['PASSWORDS'] = $pwd;
                $columnname['Flag'] = 'Show';
                $columnname['created_at'] = $timaestamp;
                //print_r($columnname);
                $ClinetID = $this->insertRecords($columnname, 'sup_tbl_client');
                if ($ClinetID > 0) {
                    $newdata['CLIENT_ID'] = $ClinetID;
                    $newdata['emailId'] = $email;
                    $newdata['passwords'] = $pwd;
                    $newdata['roleId'] = 2;
                    $newdata['username'] = $adminname;
                    $newdata['Flag'] = 'Show';
                    $newdata['created_at'] = $timaestamp;
                    $userId = $this->insertRecords($newdata, 'sup_tbl_all_client_user');
                    if ($userId > 0) {
                        Config::set('database.connections.dynamicsql.database', $databsename);
                        Config::set('database.default', 'dynamicsql');
                        $userdata['username'] = $adminname;
                        $userdata['emailId'] = $email;
                        $userdata['passwords'] = $pwd;
                        $userdata['Flag'] = 'Show';
                        $userdata['created_at'] = $timaestamp;
                        $cilentuserId = $this->insertRecords($userdata, 'mst_user_tbl');
                        if ($cilentuserId > 0) {
                            Config::set('database.connections.mysql.database', $originalDB);
                            Config::set('database.default', 'mysql');
                            $message = 'User Created Sucessfuly';
                        }
                    }
                } else {
                    $message = 'Error';
                }
            } else {
                $message = 'PreFix Already Exits';
            }
        } else {
            $message = 'Email ID Already Exits';
        }
        return $message;
    }

    public function clientupdate($table_name, $keyname, $keyvalue, $data)
    {
        $updates =  DB::table($table_name)->where([$keyname => $keyvalue, 'flag' => 'Show'])->update($data);
        return $updates;
    }
    /**
     * This Function is to update the Logut Time of the User
     * and Send Response To controller
     * @param $data \Illuminate\Http\Request  $data will Have All Data To insert.
     * @return \Illuminate\Http\Response Return Response Message
     */
    public function leaveAttendence($data)
    {
        $userId = $data['user_id'];
        $columndata['out_Date'] = $data['out_Date'];
        $columndata['out_time'] = $data['out_time'];
        $columndata['Stutus'] = $data['Stutus'];
        $timaestamp = $data['timaestamp'];
        // DB::enableQuerylog();
        $countdetails= DB::table('mst_tbl_add_attdencence')->where('in_Date', '>=', Carbon::today())->where(['user_id'=>$userId, 'Stutus' => 'IN'])->get()->count();
        $message = '';
        if($countdetails == 1) {
            $details= DB::table('mst_tbl_add_attdencence')->where('in_Date', '>=', Carbon::today())->where(['user_id'=>$userId, 'Stutus' => 'IN'])->get()->first();
            $attendenceId = $details->attendenceId;
            $InDate = $details->in_Date;
            $InTime = $details->in_time;
            $InTimeDate = $InDate . ' ' . $InTime;
            $message = $InTime;
            $start  = new Carbon($InTimeDate);
            $end    = new Carbon($timaestamp);
            $totalhours = $start->diff($end)->format('%H:%I:%S') . ' Hrs';
            $columndata['total_hours'] = $totalhours;
            // echo $difference;
            $updated = DB::table('mst_tbl_add_attdencence')->where(['attendenceId'=>$attendenceId])->update($columndata);
            if($updated > 0) {
                $message = 'Done';
            }
        } else {
            $message = 'Not Done';
        }
        // $aa= DB::getQuerylog();
        // print_r($aa);
        return $message;
    }

    public function show_leavedata(){
        $details= DB::table('mst_tbl_leaves')->orderBy('LEAVE_ID', 'desc')->get();
        return $details;
    }

    public function all_leave_type(){
        $details= DB::table('mst_tbl_leave_type')->where(['FLAG' => 'Show'])->get();
        return $details;
    }

    public function unplanned_pending_leave($id){

        $details= DB::table('mst_tbl_leaves')->where(['USER_ID' => $id])->get();
        return $details;
    }


    public function show_leave_type(){
        $details= DB::table('mst_tbl_leave_type')->where(['FLAG' => 'Show'])->get();
        return $details;
    }

    public function show_leave_pending_req(){
        $details= DB::table('mst_tbl_leaves')->where(['LEAVE_STATUS' => 'Pending'])->orderBy('LEAVE_ID', 'desc')->get();
        return $details;
    }

    public function show_leave_pending_req_count(){
        $details= DB::table('mst_tbl_leaves')->where(['LEAVE_STATUS' => 'Pending'])->get()->count();
        return $details;
    }

    public function update_leave_manage_data($data)
    {
        $update_leave_type_id = $data['autoid'];
        $details= DB::table('mst_tbl_leave_type')->where(['LEAVE_TYPE_ID'=>$update_leave_type_id])->get();
        return $details;
    }
    public function update_leave_manage_codeee($table_name, $keyname, $keyvalue, $data)
    {

        // DB::enableQuerylog();
        $updatess =  DB::table($table_name)->where([$keyname => $keyvalue, 'FLAG' => 'Show'])->update($data);
        //  $aa= DB::getQuerylog();
        return $updatess;
    }
    public function approve_leave_manage_data($data)
    {
        $approve_leave_type_id = $data['autoid'];
        $details= DB::table('mst_tbl_leaves')->where(['LEAVE_ID'=>$approve_leave_type_id])->get();
        return $details;
    }

    public function approve_leave_with_user_id($table_name, $keyname, $keyvalue, $data)
    {
        $updatess =  DB::table($table_name)->where([$keyname => $keyvalue])->update($data);
        return $updatess;
    }

}
