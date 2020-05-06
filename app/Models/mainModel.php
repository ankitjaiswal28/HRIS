<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Contracts\Session\Session;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Crypt;

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
        $insert =  DB::table($tablename)->insertGetId($data);
        return $insert;
    }
    /**
     * This Function is to Craete The Client
     * and Send Response To controller
     * @param $data \Illuminate\Http\Request  $data will Have All Data To insert.
     * @return \Illuminate\Http\Response Return Response Message of Client Craeted
     */
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
                        $userdata['roleId'] = 2;
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
        // DB::enableQuerylog();
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
    /**
     * This Function is Will Give All Modules the Details
     * and Send Response To controller
     * @return \Illuminate\Http\Response Return Response all Detais  of Module
     */
    public function allModule()
    {
        $details = DB::table('sup_tbl_module')->where(['Flag' => 'Show'])->get();
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
        /*print_r($countdetails);exit;*/
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
}
