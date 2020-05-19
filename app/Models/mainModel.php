<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Contracts\Session\Session;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Crypt;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\Mail;

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
        $query = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME =  ?";
        $db = DB::select($query, [$databsename]);
        if (empty($db)) {
            $newUser = DB::table('sup_tbl_client')->where(['Flag' => 'Show', 'ADMIN_EMAILID' => $email])->get()->count();
        if ($newUser == 0) {
            $checkprefix = DB::table('sup_tbl_client')->where(['Flag' => 'Show', 'CLIENT_PREFIX' => $prefix])->get()->count();
            if ($checkprefix == 0) {
                // Config::set('database.connections.dynamicsql.database', $databsename);
                // Config::set('database.default', 'dynamicsql');
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

                        $userdata['username'] = $adminname;
                        $userdata['emailId'] = $email;
                        $userdata['passwords'] = $pwd;
                        $userdata['Flag'] = 'Show';
                        $userdata['created_at'] = $timaestamp;
                        $userdata['roleId'] = 2;
                        DB::disconnect('mysql');
                        Config::set('database.connections.mysql.database', $databsename);
                        // Config::set('database.connections.dynamicsql.database', $databsename);
                        // Config::set('database.default', 'dynamicsql');
                //         echo "Connected sucessfully to database ".DB::connection()->getDatabaseName().".";
                //  print_r($databsename);exit;
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
    } else {
            $message = 'Database Already Exits';
        }
        return $message;
        // exit();
        // return $message;
    }
    /**
     * Function Will Update The Client Details
     * and Send The Response To Every One
     *
     */
    public function clientupdate($table_name, $keyname, $keyvalue, $data)
    {
        $CLIENT_ID = $data['CLIENT_ID'];
        $COMPANY_NAME = $data['COMPANY_NAME'];
        $ADMIN_NAME = $data['ADMIN_NAME'];
        $ADMIN_MOB_NO = $data['ADMIN_MOB_NO'];
        $ADMIN_EMAILID = $data['ADMIN_EMAILID'];
        $PASSWORDS = $data['PASSWORDS'];
        $orignaldatabase = $data['orignaldatabase'];
        $timaestamp = date("Y-m-d H:i:s");
        /**  This For  The Sup Tbl  Column to Update  */
        $sup_tbl_client['COMPANY_NAME'] = $COMPANY_NAME;
        $sup_tbl_client['ADMIN_NAME'] = $ADMIN_NAME;
        $sup_tbl_client['ADMIN_MOB_NO'] = $ADMIN_MOB_NO;
        $sup_tbl_client['ADMIN_EMAILID'] = $ADMIN_EMAILID;
        $sup_tbl_client['PASSWORDS'] = $PASSWORDS;
        $sup_tbl_client['updated_at'] = $timaestamp;

        /**  This For  The sup_tbl_all_client_user  Column to Update  */
        $sup_tbl_all_client_user['username'] = $ADMIN_NAME;
        $sup_tbl_all_client_user['emailId'] = $ADMIN_EMAILID;
        $sup_tbl_all_client_user['passwords'] = $PASSWORDS;
        $sup_tbl_all_client_user['updated_at'] = $timaestamp;

        /**  This For  The Client User mst_user_tbl  Column to Update  */
        $mst_user_tbl['username'] = $ADMIN_NAME;
        $mst_user_tbl['emailId'] = $ADMIN_EMAILID;
        $mst_user_tbl['passwords'] = $PASSWORDS;
        $mst_user_tbl['updated_at'] = $timaestamp;

        // DB::enableQuerylog();

        /** Check Emaild Exits In Sup_tbl_client*/
        $createdUser = DB::table('sup_tbl_client')->where(['Flag' => 'Show', 'ADMIN_EMAILID' => $ADMIN_EMAILID])->where('CLIENT_ID', '!=', $CLIENT_ID)->get()->count();
        $message = '';
        if ($createdUser == 0) {
            /** Fetch Client Prefix For User Database */
            $getcreatedUser = DB::table('sup_tbl_client')->where(['Flag' => 'Show', 'CLIENT_ID' => $CLIENT_ID])->get()->first();
            $getEmailID = $getcreatedUser->ADMIN_EMAILID;
            $getallClientUser = DB::table('sup_tbl_all_client_user')->where(['Flag' => 'Show', 'emailId' => $getEmailID])->get()->first();
            /** Check Email Id Exits In sup_tbl_all Client */
            $clientuserId = $getallClientUser->userId;
            $createdallUser = DB::table('sup_tbl_all_client_user')->where(['Flag' => 'Show', 'emailId' => $ADMIN_EMAILID])->where('userId', '!=', $clientuserId)->get()->count();
            if ($createdallUser == 0) {
                $userDataBaseName = $getcreatedUser->CLIENT_PREFIX . '_management';
                Config::set('database.connections.dynamicsql.database', $userDataBaseName);
                Config::set('database.default', 'dynamicsql');
                $getUser = DB::table('mst_user_tbl')->where(['Flag' => 'Show', 'emailId' => $getEmailID])->get()->first();
                $userId = $getUser->userId;
                $clientallUser = DB::table('mst_user_tbl')->where(['Flag' => 'Show', 'emailId' => $ADMIN_EMAILID])->where('userId', '!=', $userId)->get()->count();
                if ($clientallUser == 0) {
                    /** Update User Table */
                    $usertbl =  DB::table('mst_user_tbl')->where(['userId' => $userId, 'Flag' => 'Show'])->update($mst_user_tbl);
                    if ($usertbl != '') {
                        Config::set('database.connections.mysql.database', $orignaldatabase);
                        Config::set('database.default', 'mysql');
                        /** Update Super Admin sup_tbl_all_client_user User Table */
                        $clienttbl =  DB::table('sup_tbl_all_client_user')->where(['userId' => $clientuserId, 'Flag' => 'Show'])->update($sup_tbl_all_client_user);
                        if ($clienttbl != '') {
                            $suptbl =  DB::table('sup_tbl_client')->where(['CLIENT_ID' => $CLIENT_ID, 'Flag' => 'Show'])->update($sup_tbl_client);
                            if ($suptbl != '') {
                                $message = 'Done';
                            } else {
                                $message = 'Error';
                            }
                        } else {
                            $message = 'Error';
                        }
                    } else {
                        $message = 'Error';
                    }
                    // print_r($clientallUser);

                } else {
                    $message = 'Already';
                }
            } else {
                $message = 'Already';
            }
        } else {
            $message = 'Already';
        }
        // $aa= DB::getQuerylog();
        //  print_r($aa);exit;
        //$updates =  DB::table($table_name)->where([$keyname => $keyvalue, 'flag' => 'Show'])->update($data);
        return $message;
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
        //DB::enableQuerylog();
        $countdetails = DB::table('mst_tbl_add_attdencence')->where('in_Date', '>=', Carbon::today())->where(['user_id' => $userId, 'Stutus' => 'IN'])->get()->count();
        $message = '';
        if ($countdetails == 1) {
            $details = DB::table('mst_tbl_add_attdencence')->where('in_Date', '>=', Carbon::today())->where(['user_id' => $userId, 'Stutus' => 'IN'])->get()->first();
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
            $updated = DB::table('mst_tbl_add_attdencence')->where(['attendenceId' => $attendenceId])->update($columndata);
            if ($updated > 0) {
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
    /**
     * This Function is Will Give All Modules the Details
     * and Send Response To controller
     * @return \Illuminate\Http\Response Return Response all Detais  of Module
     */
    public function allModule($tablename)
    {
        $details = DB::table($tablename)->where(['Flag' => 'Show'])->get();
        return $details;
    }
    /**
     * This Function is Wil Craete The Module
     * and Send Response To controller
     * @param $data \Illuminate\Http\Request  $data will Have All Data To Create .
     * *@param $data \Illuminate\Http\Request  $tableName will Have TableName .
     * @return \Illuminate\Http\Response Return Response Message of Module  Craeted
     */
    public function AddModuletobase($data, $tableName)
    {

        $tablename = $tableName;

        $details['moduleName'] = $data['moduleName'];
        $details['moduleLink'] =   $data['moduleLink'];
        $details['Flag'] =   $data['Flag'];
        $details['created_at'] =   $data['created_at'];
        $message = '';
        // DB::enableQuerylog();
        $countdetails = DB::table('sup_tbl_module')->where(['Flag' => 'Show', 'moduleName' => $data['moduleName']])->get()->count();
        // $aa= DB::getQuerylog();
        // print_r($aa);exit;
        /* print_r($countdetails);exit;*/
        if ($countdetails == 0) {
            $updated =  $this->insertRecords($details, $tablename);
            $retVal = ($updated != '') ? $message = 'Done' : $message = 'Error';
        } else {
            $message = 'Already';
        }
        return $message;
    }

    /**
     * This Function is Update The Module
     * and Send Response To controller
     * @param $data \Illuminate\Http\Request  $data will Have All Data To Update.
     * @return \Illuminate\Http\Response Return Response Message of Module Updated Craeted
     */
    public function updateModule($data)
    {
        $modelId = $data['moduleId'];
        $details['moduleName'] = $data['modulename'];
        $details['updated_at'] =  $data['updated_at'];
        $message = '';
        // DB::enableQuerylog();
        $countdetails = DB::table('sup_tbl_module')->where(['Flag' => 'Show', 'moduleName' => $data['modulename']])->where('moduleId', '!=', $modelId)->get()->count();
        //  $aa= DB::getQuerylog();
        // print_r($aa);exit;
        // print_r($countdetails);exit;
        if ($countdetails == 0) {
            $updated = DB::table('sup_tbl_module')->where(['moduleId' => $modelId])->update($details);
            $retVal = ($updated != '') ? $message = 'Done' : $message = 'Error';
        } else {
            $message = 'Already';
        }
        return $message;
    }

    /**
     * This Function is to Assined Module To Client
     * And Create Module In Clients DataBase
     * @param $data \Illuminate\Http\Request  $data will have Assined User and Client Id
     * @return \Illuminate\Http\Response Return Response Message to The Controller
     */
    public function AssinedModuletoClient($data)
    {
        $CLIENT_ID = $data['ClientId'];
        $modulesId['AssginModuleId'] = $data['Assinderuser'];
        $modulesId['updated_at'] = $data['updated_at'];
        // $modulesId = $data['Assinderuser'];
        $Assinderuser = explode(",", $data['Assinderuser']);
        // print_r($Assinderuser);exit();
        // $aaa = array($Assinderuser);
        $userClient = DB::table('sup_tbl_client')->where(['Flag' => 'Show', 'CLIENT_ID' => $CLIENT_ID])->get()->first();
        $Prefix = $userClient->CLIENT_PREFIX;
        $databasename = $Prefix . '_management';
        $i = 0;
        $getModules = DB::table('sup_tbl_module')->where(['Flag' => 'Show'])->whereIn('moduleId', $Assinderuser)->get();
        $updated = DB::table('sup_tbl_client')->where(['CLIENT_ID' => $CLIENT_ID])->update($modulesId);
        Config::set('database.connections.dynamicsql.database', $databasename);
        Config::set('database.default', 'dynamicsql');
        foreach ($getModules as $key => $value) {
            $aaryofDetails[$key] = $value;
            $moduleId = $aaryofDetails[$key]->moduleId;
            $columnData['ClientModuleId'] = $moduleId;
            $columnData['moduleName'] = $aaryofDetails[$key]->moduleName;
            $columnData['moduleLink'] = $aaryofDetails[$key]->moduleLink;
            $columnData['created_at'] = $data['updated_at'];
            $columnData['Flag'] = 'Show';
            $countOfIds = DB::table('mst_tbl_module')->where(['ClientModuleId' => $moduleId])->get()->count();
            if ($countOfIds == 0) {
                $insertIds = $this->insertRecords($columnData, 'mst_tbl_module');
                $arrayModel[] = $insertIds;
            } else {
                $detailsofIds = DB::table('mst_tbl_module')->where(['ClientModuleId' => $moduleId])->get()->first();
                $newColumn['Flag'] = 'Show';
                $newColumn['updated_at'] = $data['updated_at'];
                $newFlag = DB::table('mst_tbl_module')->where(['moduleId' => $detailsofIds->moduleId])->update($newColumn);
                $arrayModel[] = $moduleId;
            }
            $columnData = [];
            $newColumn = [];

            // $arrayModel[] = $aaryofDetails[$key]->moduleId;
            $i++;
        }
        $databasename = $data['databasename'];
        $done['Flag'] = 'Delete';
        $done['updated_at'] = $data['updated_at'];
        $allModulesUpdated = DB::table('mst_tbl_module')->whereNotIn('moduleId', $arrayModel)->update($done);
        $arrayModel = [];
        $done = [];
        $message = '';
        if ($allModulesUpdated > 0 | $allModulesUpdated == 0) {
            $message = 'Done';
        } else {
            $message = 'Errror';
        }
        // print_r($allModulesUpdated);exit;
        // $retVal = ($allModulesUpdated >=  0) ? 'Error' : 'Done' ;
        return $message;
        //  DB::statement('Create Table ' . $databasename . '.' . 'mst_tbl_module'

    }
    /**
     * This Function will Give All Records
     * @param $tablename \Illuminate\Http\Request  $tablename Tabel Name.
     * @return \Illuminate\Http\Response Return All Data
     */
    public function showAllData($tablename)
    {
        // print_r(session('databasename'));
        // echo "Connected sucessfully to database ".DB::connection()->getDatabaseName().".";
        $details = DB::table($tablename)->where(['Flag' => 'Show'])->get();
        return $details;
    }

    /** project modules start */

    public function showallproject()
    {
        $showdata = DB::table('mst_tbl_project_master')->where('FLAG', 'Show')->get();
        return $showdata;
    }

    public function addprojectdata($data, $tablename)
    {

        $message = '';

        $countprodata = DB::table('mst_tbl_project_master')->where(['FLAG' => 'Show', 'PROJECT_NAME' => $data['PROJECT_NAME']])->get()->count();

        if ($countprodata > 0) {
            $message = 'Already';
        } else {
            $insertdata = $this->insertRecords($data, $tablename);
            $retVal = ($insertdata != '') ? $message = 'Done' : $message = 'Error';
        }
        return $message;
    }

    public function updateproject($data)
    {
        $message = '';

        $PROJECT_ID = $data['PROJECT_ID'];
        $pro_details['PROJECT_NAME'] = $data['PROJECT_NAME'];
        $pro_details['PROJECT_DESCRIPTION'] = $data['PROJECT_DESCRIPTION'];
        $pro_details['PROJECT_TARGET_HR'] = $data['PROJECT_TARGET_HR'];
        $pro_details['PROJECT_COST'] = $data['PROJECT_COST'];
        $pro_details['UPDATE_BY'] = $data['UPDATE_BY'];
        $pro_details['UPDATE_AT'] = $data['UPDATE_AT'];

        // print_r($pro_details);
        // exit;
        // DB::enableQuerylog();

        $updatedata = DB::table('mst_tbl_project_master')->where(['PROJECT_ID' => $PROJECT_ID])->update($pro_details);
        $retVal = ($updatedata != '') ? $message = 'Done' : $message = 'Error';

        return $message;
    }

    /** Time sheet module start */

    public function addtimesheet($data, $tablename)
    {
        $message = '';
        $insertdata = $this->insertRecords($data, $tablename);
        $retVal = ($insertdata != '') ? $message = 'Done' : $message = 'Error';

        return $message;
    }

    public function showalltimesheet()
    {
        $user_id = session('userid');
        // $showdata = DB::table('mst_tbl_timesheet')->where(['FLAG'=>'Show' , 'USER_ID'=>$user_id])->get();
        $showdata = DB::table('mst_tbl_timesheet')
            ->select('*')
            ->leftjoin('mst_tbl_project_master', 'mst_tbl_project_master.PROJECT_ID', '=', 'mst_tbl_timesheet.PROJECT_ID')
            ->where(['mst_tbl_timesheet.FLAG' => 'Show', 'mst_tbl_timesheet.USER_ID' => $user_id])
            ->orderBy('mst_tbl_timesheet.TIMESHEET_ID', 'DESC')
            ->get();
        return $showdata;
    }

    public function timesheet_get_data($data)
    {
        $update_timesheet_id = $data['autoid'];
        $details = DB::table('mst_tbl_timesheet')
            ->leftjoin('mst_tbl_project_master', 'mst_tbl_project_master.PROJECT_ID', '=', 'mst_tbl_timesheet.PROJECT_ID')
            ->where(['mst_tbl_timesheet.TIMESHEET_ID' => $update_timesheet_id])->get();
        return $details;
    }


    public function updatetimesheet($data)
    {
        $message = '';

        $TIMESHEET_ID = $data['TIMESHEET_ID'];
        $TS_details['USER_ID'] = $data['USER_ID'];
        $TS_details['PROJECT_ID'] = $data['PROJECT_ID'];
        $TS_details['TIMESHEET_DATE'] = $data['TIMESHEET_DATE'];
        $TS_details['DESCRIPTION'] = $data['DESCRIPTION'];
        $TS_details['START_HR'] = $data['START_HR'];
        $TS_details['START_MIN'] = $data['START_MIN'];
        $TS_details['STOP_HR'] = $data['STOP_HR'];
        $TS_details['STOP_MIN'] = $data['STOP_MIN'];
        $TS_details['START_TIME'] = $data['START_TIME'];
        $TS_details['STOP_TIME'] = $data['STOP_TIME'];
        $TS_details['TOTAL_HR'] = $data['TOTAL_HR'];
        $TS_details['TOTAL_MIN'] = $data['TOTAL_MIN'];
        $TS_details['UPDATED_BY'] = $data['UPDATED_BY'];
        $TS_details['UPDATED_AT'] = $data['UPDATED_AT'];

//  print_r($TS_details);
//  DB::enableQuerylog();
        // exit;
        $updatetsdata = DB::table('mst_tbl_timesheet')->where(['TIMESHEET_ID' => $TIMESHEET_ID])->update($TS_details);
        $retVal = ($updatetsdata != '') ? $message = 'Done' : $message = 'Error';

        return $message;

    }
    /**
     * This Function will Give All Records
     * @param $tablename \Illuminate\Http\Request  $id of Roles
     * @return \Illuminate\Http\Response Return All Data
     */
    public function getRoleAdmin($id)
    {
        //print_r($id);
        // print_r(session('databasename'));
        // // echo "Connected sucessfully to database ".DB::connection()->getDatabaseName().".";
        $details= DB::table('mst_tbl_master_role')->where(['Flag'=>'Show', 'MASTER_ROLE_ID' =>$id])->get()->first();
        return $details;
    }
    /**
     * This Function will Give All Records
     * @param $tablename \Illuminate\Http\Request  $tablename Tabel Name.
     * @return \Illuminate\Http\Response Return All Data
     */
    public function updateROles($data)
    {
        $update = [];
        $updateData['MASTER_ROLE_NAME'] = $data['roleName'];
        $roleId = $data['roleId'];
        $updateData['UPDATED_BY'] = $data['UPDATE_BY'];
        $updateData['UPDATED_AT'] = $data['updated_at'];
       // return  $updateData;
         $details= DB::table('mst_tbl_master_role')->where(['Flag'=>'Show', 'MASTER_ROLE_NAME' =>$data['roleName']])->where('MASTER_ROLE_ID', '!=', $roleId)->get()->count();
         $message = '';
         if ($details == 0) {
           // $message = 'Done';
            // DB::enableQuerylog();
             $Update_query = DB::table('mst_tbl_master_role')->where(['Flag'=>'Show','MASTER_ROLE_ID'=>$roleId])->update($updateData);
             // $aa= DB::getQuerylog();
           // print_r($aa);exit;
             $message = $Update_query;
            if ($Update_query != '') {
               $message = 'Done';
            } else {
               $message = 'Error';
            }
         } else {
             $message = 'Already';
         }

         return  $message;
        // echo $details;
    }
    /**
     * This Function will Delete Clients
     * @param $tablename \Illuminate\Http\Request  $id Will Have Client Id
     * @return \Illuminate\Http\Response Return the Response
     */
    public function deleteClient($id, $data)
    {
        $updated['updated_at'] = $data['updated_at'];
        $updated['Flag'] = 'Deleted';
        $userClient = DB::table('sup_tbl_client')->where(['Flag' => 'Show', 'CLIENT_ID' => $id])->get()->first();
        $databasename = $userClient->CLIENT_PREFIX. '_management';
        // return $databasename;
        // exit();
        $Delete_query = DB::table('sup_tbl_client')->where(['Flag'=>'Show','CLIENT_ID'=>$id])->update($updated);
        $message = '';
        if ($Delete_query  != '') {
            $query = DB::table('sup_tbl_all_client_user')->where(['Flag'=>'Show','CLIENT_ID'=>$id])->update($updated);
            if ($query != '') {
                Config::set('database.connections.dynamicsql.database', $databasename);
                Config::set('database.default', 'dynamicsql');
                DB::statement("DROP DATABASE $databasename");
                $message = 'Done';
            } else {
                $message = 'Error';
            }
        } else {
            $message = 'Error';
        }
        return $message;

        // Config::set('database.connections.dynamicsql.database', $databasename);
        // Config::set('database.default', 'dynamicsql');
    }

    /**
     * This Function will Delete Module
     * @param $tablename \Illuminate\Http\Request  $id Will Have Module Id
     * @return \Illuminate\Http\Response Return the Response
     */
    public function deleteModule($id,$data)
    {
        $updated['updated_at'] = $data['updated_at'];
        $updated['Flag'] = 'Deleted';
        $Delete_query = DB::table('sup_tbl_module')->where(['Flag'=>'Show','moduleId'=>$id])->update($updated);
        $message = '';
        $retVal = ($Delete_query != '') ? $message = 'Done' : $message = 'Erorr' ;
        return $retVal;
    }

    /**
     * This Function is to Save the Details
     * and Send Response To controller
     * @param $data \Illuminate\Http\Request  $data will Have All Data To insert.
     * @param $tablename \Illuminate\Http\Request  $tablename Tabel Name.
     * @return \Illuminate\Http\Response Return Response Message
     */
    public function addAdminRole($data)
    {
        $rolename = $data['MASTER_ROLE_NAME'];
        $GetROles = DB::table('mst_tbl_master_role')->where(['Flag' => 'Show', 'MASTER_ROLE_NAME' => $rolename])->get()->count();
        $message = '';
        if ($GetROles == 0) {
            $insert =  DB::table('mst_tbl_master_role')->insertGetId($data);
            if($insert != '') {
                $message = 'Done';
            } else {
                $message = 'Error';
            }
        } else {
            $message = 'Already';
        }

        // $count = $GetROles->count();
        // print_r(session('databasename'));
        // echo "Connected sucessfully to database ".DB::connection()->getDatabaseName().".";
        // $insert =  DB::table($tablename)->insertGetId($data);
        return $message;
    }
    /**
     * This Function will Delete Module
     * @param $tablename \Illuminate\Http\Request  $id Will Have Module Id
     * @return \Illuminate\Http\Response Return the Response
     */
    public function deleteAdminModule($id,$data)
    {
        $updated['updated_at'] = $data['updated_at'];
        $updated['UPDATE_BY'] = $data['UPDATE_BY'];
        $updated['Flag'] = 'Deleted';
        $Delete_query = DB::table('mst_tbl_module')->where(['Flag'=>'Show','moduleId'=>$id])->update($updated);
        $message = '';
        $retVal = ($Delete_query != '') ? $message = 'Done' : $message = 'Erorr' ;
        return $retVal;
    }

    /**
     * This Function is Update The Module
     * and Send Response To controller
     * @param $data \Illuminate\Http\Request  $data will Have All Data To Update.
     * @return \Illuminate\Http\Response Return Response Message of Module Updated Craeted
     */
    public function updateAdminModule($data)
    {
        $modelId = $data['moduleId'];
        $details['moduleName'] = $data['moduleName'];
        $details['updated_at'] =  $data['updated_at'];
        $details['UPDATE_BY'] =  $data['UPDATE_BY'];
        $message = '';
        // DB::enableQuerylog();
        $countdetails = DB::table('mst_tbl_module')->where(['Flag' => 'Show', 'moduleName' => $data['moduleName']])->where('moduleId', '!=', $modelId)->get()->count();
        //  $aa= DB::getQuerylog();
        // print_r($aa);exit;
        // print_r($countdetails);exit;
        if ($countdetails == 0) {
            $updated = DB::table('mst_tbl_module')->where(['moduleId' => $modelId])->update($details);
            $retVal = ($updated != '') ? $message = 'Done' : $message = 'Error';
        } else {
            $message = 'Already';
        }
        return $message;
    }
    /**
     * This Function will Delete Module
     * @param $tablename \Illuminate\Http\Request  $id Will Have Module Id
     * @return \Illuminate\Http\Response Return the Response
     */
    public function deleteAdminRole($id,$data)
    {
        $updated['updated_at'] = $data['updated_at'];
        $updated['UPDATED_BY'] = $data['UPDATE_BY'];
        $updated['Flag'] = 'Deleted';
        $Delete_query = DB::table('mst_tbl_master_role')->where(['Flag'=>'Show','MASTER_ROLE_ID'=>$id])->update($updated);
        $message = '';
        $retVal = ($Delete_query != '') ? $message = 'Done' : $message = 'Erorr' ;
        return $retVal;
    }
    /**
     * This Function is to Assined Module To Client
     * And Create Module In Clients DataBase
     * @param $data \Illuminate\Http\Request  $data will have Assined User and Client Id
     * @return \Illuminate\Http\Response Return Response Message to The Controller
     */
    public function AssinedModuletoRole($data)
    {
        $MASTER_ROLE_ID = $data['MASTER_ROLE_ID'];
        $Assinderuser = explode(",",$data['MODULEID']);
        $columnData['UPDATED_AT'] = $data['updated_at'];
        $columnData['MODULEID'] = $data['MODULEID'];
        $columnData['UPDATED_BY'] = $data['UPDATED_BY'];
        $update = DB::table('mst_tbl_master_role')->where(['MASTER_ROLE_ID' => $MASTER_ROLE_ID])->update($columnData);
        $message = '';
        if ($update != '') {
           $message = 'Done';
        } else {
            $message = 'Error';
        }
        return $message;
    }
    /**
     * This Function is to get All User Of the Client
     * And Create Module In Clients DataBase
     * @param $data \Illuminate\Http\Request  $data will have Assined User and Client Id
     * @return \Illuminate\Http\Response Return Response Message to The Controller
     */
    public function getAllUserDetails($id)
    {
        $getallDetails = DB::table('mst_user_tbl')->where(['Flag' => 'Show'])->where('userId', '!=', $id)->get();
        return $getallDetails;
         // $getallDetails = DB::table('sup_tbl_all_client_user as cu')->select('cu.userId','cu.CLIENT_ID','cu.emailId','cu.passwords','cu.roleId','cu.username','su.user_image','su.CLIENT_PREFIX')->leftJoin('sup_tbl_client as su','su.CLIENT_ID', '=', 'cu.CLIENT_ID') ->where(['cu.Flag'=> $flag ,'cu.emailId'=>$username])->get()->first();
    }
    public function UserCraetion($data)
    {

        // $REPORTING_MANAGER = $data['REPORTING_MANAGER'];
        // $email = $data['email'];
        // $userid = $data['userid'];
        // $username = $data['username'];
        // $timaestamp = date("Y-m-d H:i:s");
        // $Stutus = $this->SendMails('4', 'Ankit Jaiswal');
        // print($Stutus);
        // exit;
        $orignalDb = $data['orignalDb'];
        $CLIENT_ID = $data['CLIENT_ID'];
        $ROLEID = $data['ROLEID'];
        $userid = $data['userid'];
        $encryptPassword = $data['encryptPassword'];
        $email = $data['email'];
        $username = $data['username'];
        $MASTER_ROLE_ID = $data['MASTER_ROLE_ID'];
        $REPORTING_MANAGER = $data['REPORTING_MANAGER'];
        $dynamicdatabase = $data['dynamicdatabase'];
        $PRIMARY_MANGER = $data['PRIMARY_MANGER'];
        $FUNCTION_NAME_ID = $data['FUNCTION_NAME_ID'];
        $DEPARTMENTS_ID = $data['DEPARTMENTS_ID'];
        $DOJ = $data['DOJ'];
        $EMPLOYE_TYPE = $data['EMPLOYE_TYPE'];
        $DESIGNATION_ID = $data['DESIGNATION_ID'];
        $ADMINCLIENT_ID = $data['ADMINCLIENT_ID'];
        $GRADEORLEVEL_ID =$data['GRADEORLEVEL_ID'];


        $timaestamp = date("Y-m-d H:i:s");
        Config::set('database.connections.mysql.database', $orignalDb);
        Config::set('database.default', 'mysql');
        $newUser = DB::table('sup_tbl_all_client_user')->where(['Flag' => 'Show', 'emailId' => $email])->get()->count();
        $message = '';
        if ($newUser == 0) {
            Config::set('database.connections.dynamicsql.database', $dynamicdatabase);
            Config::set('database.default', 'dynamicsql');
            $clientnewUser = DB::table('mst_user_tbl')->where(['Flag' => 'Show', 'emailId' => $email])->get()->count();
            if ($clientnewUser == 0) {
                $userdata['username'] = $username;
                $userdata['emailId'] = $email;
                $userdata['passwords'] = $encryptPassword;
                $userdata['Flag'] = 'Show';
                $userdata['created_at'] = $timaestamp;
                $userdata['roleId'] = $ROLEID;
                $userdata['CREATED_BY'] = $userid;
                $userdata['master_roleId'] = $MASTER_ROLE_ID;
                $userdata['REPORTING_MANGERS'] = $REPORTING_MANAGER;
                $userdata['PRIMARY_MANGER'] = $PRIMARY_MANGER;
                $userdata['FUNCTION_NAME_ID'] = $FUNCTION_NAME_ID;
                $userdata['DEPARTMENTS_ID'] = $DEPARTMENTS_ID;
                $userdata['DOJ'] = $DOJ;
                $userdata['EMPLOYE_TYPE'] = $EMPLOYE_TYPE;
                $userdata['DESIGNATION_ID'] = $DESIGNATION_ID;
                $userdata['ADMINCLIENT_ID'] = $ADMINCLIENT_ID;
                $userdata['GRADEORLEVEL_ID'] = $GRADEORLEVEL_ID;

                $cilentuserId = $this->insertRecords($userdata, 'mst_user_tbl');
                if ($cilentuserId != '') {
                    Config::set('database.connections.mysql.database', $orignalDb);
                    Config::set('database.default', 'mysql');
                    $newdata['CLIENT_ID'] = $CLIENT_ID;
                    $newdata['emailId'] = $email;
                    $newdata['passwords'] = $encryptPassword;
                    $newdata['roleId'] = $ROLEID;
                    $newdata['username'] = $username;
                    $newdata['Flag'] = 'Show';
                    $newdata['created_at'] = $timaestamp;
                    $userId = $this->insertRecords($newdata, 'sup_tbl_all_client_user');
                    if ($userId != '') {
                        Config::set('database.connections.dynamicsql.database', $dynamicdatabase);
                        Config::set('database.default', 'dynamicsql');
                        $ServeAddres = $_SERVER['HTTP_HOST'];
                        $UserName = $username;
                        $Subject = 'User Creation';
                        $MailStuts = 'Pending';
                        $sql = "SELECT GROUP_CONCAT(emailId ,'') as 'EmailId' FROM mst_user_tbl WHERE userId IN($REPORTING_MANAGER) ";

                        $info = DB::select(DB::raw($sql));
                        $cc = $info[0]->EmailId;
                        $To = $email;
                        $body = "<h2>Hello ".$UserName." ,</h5>
                        Wlecome To Our Orginaztion We are gald To Inform You That Have been Selected In Our Orginazation.
                        please Fill Your Form <a href='".$ServeAddres."'>UserCreation</a>";
                        $saveMialReports['SUBJECT'] = $Subject;
                        $saveMialReports['FROM_MAILID'] = 'myanki28@gmail.com';
                        $saveMialReports['TO_MAILID'] = $To;
                        $saveMialReports['MAIL_BODY'] = $body;
                        $saveMialReports['CC_MAILID'] = $cc;
                        $saveMialReports['MAIL_STATUS'] = $MailStuts;
                        $saveMialReports['CREATED_BY'] = $userid;
                        $saveMialReports['CREATED_AT'] = $timaestamp;
                        $saveMialReports['FLAG'] = 'Show';

                        $MailReports = $this->insertRecords($saveMialReports, 'mst_tbl_mail_reports');
                        if ($MailReports != '') {
                            //print_r($MailReports);
                            $Stutus = $this->SendMails($MailReports,$UserName);
                            if ($Stutus == 'Done') {
                                $rportinmangersids = explode("," , $REPORTING_MANAGER);
                                $notification = 0;
                                for ($i=0; $i <  count($rportinmangersids) ;$i++) {
                                    $saveNotiFication = '';
                                    $notifcationReports['Status'] = 'UserCreation';
                                    $notifcationReports['sent_to'] = $rportinmangersids[$i];
                                    $notifcationReports['created_at'] = $timaestamp;
                                    $notifcationReports['Flag'] = 'Show';
                                    $notifcationReports['created_by'] = $userid;
                                    $saveNotiFication = $this->insertRecords($notifcationReports, 'mst_tbl_notification');
                                    if($saveNotiFication != '') {
                                        $notification = $notification +1;
                                    }
                                }
                                if($notification == count($rportinmangersids)) {
                                    $message = 'Done';
                                } else {
                                    $message = 'Erorr';
                                }
                             } else {
                                $message = 'Erorr';
                            }
                        } else {
                             $message = 'Erorr';
                        }
                    } else {
                        $message = 'Erorr';
                    }
                } else {
                    $message = 'Erorr';
                }
            } else {
                $message = 'Already';
            }


        } else {
            $message = 'Already';
        }
        return $message;


    }
    /**
     * This Function will Delete User
     * @param $tablename \Illuminate\Http\Request  $id Will Have User Id
     * @return \Illuminate\Http\Response Return the Response
     */
    public function deleteUser($id, $data)
    {
        $userdeatils = DB::table('mst_user_tbl')->where(['Flag' => 'Show', 'userId' => $id])->get()->first();
        $clientEmailId = $userdeatils->emailId;
        $originalDB = $data['orignalDb'];
        $clientColumn['updated_at'] = $data['timaestamp'];
        $clientColumn['Flag'] = 'Deleted';
        $clientColumn['UPDATED_BY'] = $data['userid'];
        $Delete_query = DB::table('mst_user_tbl')->where(['Flag'=>'Show','userId'=>$id])->update($clientColumn);
        $message = '';
        if ($Delete_query  != '') {
            Config::set('database.connections.mysql.database', $originalDB);
            Config::set('database.default', 'mysql');
            $superadmindeatils = DB::table('sup_tbl_all_client_user')->where(['Flag' => 'Show','emailId' => $clientEmailId, 'CLIENT_ID' => $data['CLIENT_ID'], 'roleId' => 3])->get()->first();
            $newId = $superadmindeatils->userId;
            $finalDetails['updated_at'] = $data['timaestamp'];
            $finalDetails['Flag'] = 'Deleted';
            $Delete_user= DB::table('sup_tbl_all_client_user')->where(['Flag'=>'Show','userId'=>$newId])->update($finalDetails);
            if ($Delete_user != '') {
                $message = 'Done';
            } else {
                $message = 'Error';
            }
        } else {
            $message = 'Error';
        }
        return $message;
        // Config::set('database.connections.dynamicsql.database', $databasename);
        // Config::set('database.default', 'dynamicsql');
    }
    public function updateUserCraetion($data)
    {
        // print_r($data);exit;
        $orignalDb = $data['orignalDb'];
        $CLIENT_ID = $data['CLIENT_ID'];
        $clientuserId = $data['clientuserId'];
        $userid = $data['userid'];
        $encryptPassword = $data['encryptPassword'];
        $email = $data['email'];
        $username = $data['username'];
        $MASTER_ROLE_ID = $data['MASTER_ROLE_ID'];
        $REPORTING_MANAGER = $data['REPORTING_MANAGER'];
        $dynamicdatabase = $data['dynamicdatabase'];
        $timaestamp = date("Y-m-d H:i:s");
        $fetchdeatails = DB::table('mst_user_tbl')->where(['Flag' => 'Show', 'userId' => $clientuserId])->get()->first();
        $firstEmail = $fetchdeatails->emailId;
        $clientREPORTING_MANGERS = $fetchdeatails->REPORTING_MANGERS;
        // DB::enableQuerylog();
        $clientnewUser = DB::table('mst_user_tbl')->where(['Flag' => 'Show', 'emailId' => $email])->where('emailId', '!=', $firstEmail)->get()->count();
        // $aa= DB::getQuerylog();
        // print_r($aa);exit;
        if ($clientnewUser == 0) {
            Config::set('database.connections.mysql.database', $orignalDb);
            Config::set('database.default', 'mysql');
            $dyanimicfetchdeatails = DB::table('sup_tbl_all_client_user')->where(['Flag' => 'Show', 'emailId' => $firstEmail, 'CLIENT_ID' => $CLIENT_ID])->get()->first();
            $firstuserId = $dyanimicfetchdeatails->userId;
            $dynamiclientnewUser = DB::table('sup_tbl_all_client_user')->where(['Flag' => 'Show', 'emailId' => $email])->where('emailId', '!=', $firstEmail)->get()->count();
            if ($dynamiclientnewUser == 0) {
                    $newdata['emailId'] = $email;
                    $newdata['passwords'] = $encryptPassword;
                    $newdata['username'] = $username;
                    $newdata['updated_at'] = $timaestamp;
                    $userId = DB::table('sup_tbl_all_client_user')->where(['Flag'=>'Show','userId'=>$firstuserId])->update($newdata);
                    if ($userId != '') {
                        Config::set('database.connections.dynamicsql.database', $dynamicdatabase);
                        Config::set('database.default', 'dynamicsql');
                        $userdata['username'] = $username;
                        $userdata['emailId'] = $email;
                        $userdata['passwords'] = $encryptPassword;
                        $userdata['updated_at'] = $timaestamp;
                        $userdata['CREATED_BY'] = $userid;
                        $userdata['master_roleId'] = $MASTER_ROLE_ID;
                        $userdata['REPORTING_MANGERS'] = $REPORTING_MANAGER;
                        if ($clientREPORTING_MANGERS != $REPORTING_MANAGER) {
                            $userdata['PRIMARY_MANGER'] = null;
                            $userdata['SECOND_MANGER'] = null;
                            $userdata['THIRD_MANGER'] = null;
                        }
                        $clintsuserId = DB::table('mst_user_tbl')->where(['Flag'=>'Show','userId'=>$clientuserId])->update($userdata);
                        if ($clintsuserId !='') {
                            $message = 'Done';
                        } else {
                            $message = 'Erorr';
                        }
                    } else {
                        $message = 'Erorr';
                    }
            } else {
                $message = 'Already';
            }


        }else {
            $message = 'Already';
        }
        return $message;

    }
    /**
     * This Function will Send The mail User
     * @param $tablename \Illuminate\Http\Request  $id Will Have User Id
     * @return \Illuminate\Http\Response Return the Response that mail Sent Or Not
     */
    function SendMails($MailId,$UserName) {
        $mailReports = DB::table('mst_tbl_mail_reports')->where(['Flag' => 'Show', 'MAIL_ID' => $MailId])->get()->first();
        // print_r($mailReports);exit;
        $data['body'] = $mailReports->MAIL_BODY;
        $to = $mailReports->TO_MAILID;
        $fromId = $mailReports->FROM_MAILID;
        $cc = $mailReports->CC_MAILID;
        $finalAaary = explode(",", $cc);
        $subject = $mailReports->SUBJECT;
        Mail::send(['text'=>'Admin.TestMail'], ['data' => $data], function($message) use($to, $subject, $finalAaary, $fromId,$UserName) {
           // $message->to($to, 'Test Mail')->subject
           $message->to($to, $UserName)->subject
               ($subject);
            $message->from($fromId,'HSS');
            $message->cc(($finalAaary));
           // $message->cc(($finalAaary), 'Test Mail');
         });
         $response = '';
         if (Mail::failures())
         {
            //  $mail_id = $data['mail_queue_id'];
              $dataresponse = DB::table('mst_tbl_mail_reports')->where(['Flag'=>'Show','MAIL_ID'=>$MailId])->update(['MAIL_STATUS'=>'Error']);
              if ($dataresponse != '') {
                   $response = 'Done';
              } else {
                   $response = 'Erorr';
              }

            //  echo 'Email was Not sent!!!!!';


         }
         else
         {
            $dataresponse1 = DB::table('mst_tbl_mail_reports')->where(['Flag'=>'Show','MAIL_ID'=>$MailId])->update(['MAIL_STATUS'=>'Send']);
            if ($dataresponse1 != '') {
                 $response = 'Done';
            } else {
                 $response = 'Erorr';
            }
            // echo 'Email was  sent!!!!!';
            //  $mail_id = $data['mail_queue_id'];
            //  DB::table('tran_mail_queue')->where(['flag'=>'Show','mail_queue_id'=>$mail_id])->update(['Status'=>'Send']);
         }
         return $response;
    }
    /**
     * This Function will Check Department Exit Or Not If Not Then It will Create The Department
     * @param $data \Illuminate\Http\Request  $data It will be The Data Of Drepartment To Create
     * @return \Illuminate\Http\Response Return The Messge That Department Craeted Or Already Exits
     */
    public function addDepartments($data)
    {
        $departmentName = $data['DEPARTMENT_NAME'];
        $departmentDetails = DB::table('mst_tbl_departments')->where(['Flag' => 'Show', 'DEPARTMENT_NAME' => $departmentName])->get()->count();
        $message = '';
        if ($departmentDetails == 0) {
            $insertDepartment = $this->insertRecords($data, 'mst_tbl_departments');
            if ($insertDepartment != '') {
               $message = 'Done';
            } else {
               $message = 'Error';
            }
        } else {
            $message = 'Already';
        }
        return $message;
    }

    /**
     * This Function will Check Department Exit Or Not If Not Then Update  The Department
     * @param $data \Illuminate\Http\Request  $data It will be The Data Of Drepartment To Update
     * @param $id \Illuminate\Http\Request  $id It will be The Id Of Drepartment To Update
     * @return \Illuminate\Http\Response Return The Messge That Department Updeted Or Already Exits
     */
    public function updateDepartments($data, $id)
    {
        $departmentName = $data['DEPARTMENT_NAME'];
        $departmentDetails = DB::table('mst_tbl_departments')->where(['Flag' => 'Show', 'DEPARTMENT_NAME' => $departmentName])->where('DEPARTMENT_ID', '!=', $id)->get()->count();
        $message = '';
        if ($departmentDetails == 0) {
            $updateDepatments = DB::table('mst_tbl_departments')->where(['Flag'=>'Show','DEPARTMENT_ID'=>$id])->update($data);
            // $insertDepartment = $this->insertRecords($data, 'mst_tbl_departments');
            if ($updateDepatments != '') {
               $message = 'Done';
            } else {
               $message = 'Error';
            }
        } else {
            $message = 'Already';
        }
        return $message;
    }

    /**
     * This Function will Delete Department
     * @param $tablename \Illuminate\Http\Request  $id Will Have Department To be Deleted  Id
     * @return \Illuminate\Http\Response Return the Response that User Deleted
     */
    public function deleteDepartments($id, $data)
    {
        $updateDepatments = DB::table('mst_tbl_departments')->where(['Flag'=>'Show','DEPARTMENT_ID'=>$id])->update($data);
        $message = '';
        if ($updateDepatments != '') {
            $message = 'Done';
        } else {
            $message = 'Error';
        }
        return $message;
    }
     /**
     * This Function will Check Function Exit Or Not If Not Then It will Create The Functions
     * @param $data \Illuminate\Http\Request  $data It will be The Data Of Function To Create
     * @return \Illuminate\Http\Response Return The Messge That Function Craeted Or Already Exits
     */
    public function addFunctions($data)
    {
        $FUNCTION_NAME = $data['FUNCTION_NAME'];
        $departmentDetails = DB::table('mst_tbl_functions')->where(['Flag' => 'Show', 'FUNCTION_NAME' => $FUNCTION_NAME])->get()->count();
        $message = '';
        if ($departmentDetails == 0) {
            $insertDepartment = $this->insertRecords($data, 'mst_tbl_functions');
            if ($insertDepartment != '') {
               $message = 'Done';
            } else {
               $message = 'Error';
            }
        } else {
            $message = 'Already';
        }
        return $message;
    }
    /**
     * This Function will Check Function Name  Exit Or Not If Not Then Update  The Function Name
     * @param $data \Illuminate\Http\Request  $data It will be The Data Of Function Name To Update
     * @param $id \Illuminate\Http\Request  $id It will be The Id Of Function Name To Update
     * @return \Illuminate\Http\Response Return The Messge That Function Name Updeted Or Already Exits
     */
    public function updateFunctions($data, $id)
    {
        $FUNCTION_NAME = $data['FUNCTION_NAME'];
        $FunctionDetails = DB::table('mst_tbl_functions')->where(['Flag' => 'Show', 'FUNCTION_NAME' => $FUNCTION_NAME])->where('FUNCTION_ID', '!=', $id)->get()->count();
        $message = '';
        if ($FunctionDetails == 0) {
            $updateFunctions = DB::table('mst_tbl_functions')->where(['Flag'=>'Show','FUNCTION_ID'=>$id])->update($data);
            // $insertDepartment = $this->insertRecords($data, 'mst_tbl_departments');
            if ($updateFunctions != '') {
               $message = 'Done';
            } else {
               $message = 'Error';
            }
        } else {
            $message = 'Already';
        }
        return $message;
    }

    /**
     * This Function will Delete Function
     * @param $tablename \Illuminate\Http\Request  $id Will Have Funbction  To be Deleted  Id
     * @return \Illuminate\Http\Response Return the Response that Function Is  Deleted
     */
    public function deleteFunctions($id, $data)
    {
        $updateDepatments = DB::table('mst_tbl_functions')->where(['Flag'=>'Show','FUNCTION_ID'=>$id])->update($data);
        $message = '';
        if ($updateDepatments != '') {
            $message = 'Done';
        } else {
            $message = 'Error';
        }
        return $message;
    }

    /**
     * This Function will Check Designation Name  Exit Or Not If Not Then It will Create The Designation
     * @param $data \Illuminate\Http\Request  $data It will be The Data Of Designation To Create
     * @return \Illuminate\Http\Response Return The Messge That Designation Craeted Or Already Exits
     */
    public function addDesignations($data)
    {
        $DESGINATION_NAME = $data['DESGINATION_NAME'];
        $departmentDetails = DB::table('mst_tbl_designations')->where(['Flag' => 'Show', 'DESGINATION_NAME' => $DESGINATION_NAME])->get()->count();
        $message = '';
        if ($departmentDetails == 0) {
            $insertDepartment = $this->insertRecords($data, 'mst_tbl_designations');
            if ($insertDepartment != '') {
               $message = 'Done';
            } else {
               $message = 'Error';
            }
        } else {
            $message = 'Already';
        }
        return $message;
    }

    /**
     * This Function will Check Designation Name  Exit Or Not If Not Then Update  The Designation Name
     * @param $data \Illuminate\Http\Request  $data It will be The Data Of Designation Name To Update
     * @param $id \Illuminate\Http\Request  $id It will be The Id Of Designation Name To Update
     * @return \Illuminate\Http\Response Return The Messge That Designation Name Updeted Or Already Exits
     */
    public function updateDesignations($data, $id)
    {
        $DESGINATION_NAME = $data['DESGINATION_NAME'];
        $DesignationDetails = DB::table('mst_tbl_designations')->where(['Flag' => 'Show', 'DESGINATION_NAME' => $DESGINATION_NAME])->where('DESIGNATION_ID', '!=', $id)->get()->count();
        $message = '';
        if ($DesignationDetails == 0) {
            $updateDesignation= DB::table('mst_tbl_designations')->where(['Flag'=>'Show','DESIGNATION_ID'=>$id])->update($data);
            // $insertDepartment = $this->insertRecords($data, 'mst_tbl_departments');
            if ($updateDesignation != '') {
               $message = 'Done';
            } else {
               $message = 'Error';
            }
        } else {
            $message = 'Already';
        }
        return $message;
    }
    /**
     * This Function will Delete Designation
     * @param $tablename \Illuminate\Http\Request  $id Will Have Funbction  To be Deleted  Id
     * @return \Illuminate\Http\Response Return the Response that Desgination Is  Deleted
     */
    public function deleteDesignations($id, $data)
    {
        $updateDepatments = DB::table('mst_tbl_designations')->where(['Flag'=>'Show','DESIGNATION_ID'=>$id])->update($data);
        $message = '';
        if ($updateDepatments != '') {
            $message = 'Done';
        } else {
            $message = 'Error';
        }
        return $message;
    }

    /**
     * This Function will Add The Policyes to the Client
     * @param $data \Illuminate\Http\Request  $data It will be The Data Of Polycies To be Added To Client
     * @param $id \Illuminate\Http\Request  $id It will be The Id Of Client
     * @param  $orignaldatabase WIll Have Database name
     * @return \Illuminate\Http\Response Return The Messge That Polices is Added
     */
    public function AddPolicyes($data, $id, $orignaldatabase)
    {
        $deaatils = DB::table('sup_tbl_client')->where(['Flag'=>'Show','CLIENT_ID'=>$id])->get()->first();
        $GRADEORLEVEL = $data['GRADEORLEVEL'];
        $updatePolicyies = DB::table('sup_tbl_client')->where(['Flag'=>'Show','CLIENT_ID'=>$id])->update($data);
      //  print_r($updatePolicyies);exit;
        $message = '';
        if ($updatePolicyies != '' ) {
            $dynamicDB = $deaatils->CLIENT_PREFIX . '_management';
            Config::set('database.connections.dynamicsql.database', $dynamicDB);
            Config::set('database.default', 'dynamicsql');
            if($GRADEORLEVEL == 'Grade') {
                DB::statement("DROP table mst_tbl_levels");
                // DB::table('mst_tbl_levels')->delete();
                $message ='LevelDeleted';
            } else {
                DB::statement("DROP table mst_tbl_grade");
                // DB::table('mst_tbl_grade')->delete();
                $message ='GradeDeleted';
            }

        } else {
            $message = 'Error';
        }
        return $message;

    }
    function getUserDetails($data) {
        $USER_ID = $data['USER_ID'];
        // DB::enableQuerylog();
        // $insert =  DB::table($tablename)->insertGetId($data);
         // $aa= DB::getQuerylog();
         // print_r($aa);exit;
        $getallDetails = DB::table('mst_tbl_personal_details')->where(['Flag' => 'Show' , 'USER_ID' => $USER_ID])->get()->first();
        $deatils = [];
        if(count($getallDetails) > 0) {
            // echo "Hiii";
            $deatils[] = $getallDetails;
        }
        // $aa= DB::getQuerylog();
        // print_r($aa);exit;
        $getallacdmic = DB::table('mst_tbl_academic_experience_details')
            ->select('*')
            ->leftjoin('mst_tbl_document_info', 'mst_tbl_document_info.USER_ID', '=', 'mst_tbl_academic_experience_details.USER_ID')
            ->where(['mst_tbl_academic_experience_details.FLAG' => 'Show', 'mst_tbl_academic_experience_details.USER_ID' => $USER_ID])
            ->get()->first();
            if (count($getallacdmic)) {
                $deatils[] = $getallacdmic;
            }
         return $deatils;
        ;
    }


}
