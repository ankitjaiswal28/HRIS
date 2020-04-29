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
        if($createdUser == 0) {
            /** Fetch Client Prefix For User Database */
            $getcreatedUser = DB::table('sup_tbl_client')->where(['Flag' => 'Show', 'CLIENT_ID' => $CLIENT_ID])->get()->first();
            $getEmailID = $getcreatedUser->ADMIN_EMAILID;
            $getallClientUser = DB::table('sup_tbl_all_client_user')->where(['Flag' => 'Show', 'emailId' => $getEmailID])->get()->first();
            /** Check Email Id Exits In sup_tbl_all Client */
            $clientuserId = $getallClientUser->userId;
            $createdallUser = DB::table('sup_tbl_all_client_user')->where(['Flag' => 'Show', 'emailId' => $ADMIN_EMAILID])->where('userId', '!=', $clientuserId)->get()->count();
            if($createdallUser == 0){
                $userDataBaseName = $getcreatedUser->CLIENT_PREFIX. '_management';
                Config::set('database.connections.dynamicsql.database', $userDataBaseName);
                Config::set('database.default', 'dynamicsql');
                $getUser = DB::table('mst_user_tbl')->where(['Flag' => 'Show', 'emailId' => $getEmailID])->get()->first();
                $userId = $getUser->userId;
                $clientallUser = DB::table('mst_user_tbl')->where(['Flag' => 'Show', 'emailId' => $ADMIN_EMAILID])->where('userId', '!=', $userId)->get()->count();
                if ($clientallUser == 0) {
                    /** Update User Table */
                    $usertbl =  DB::table('mst_user_tbl')->where(['userId' => $userId, 'Flag' => 'Show'])->update($mst_user_tbl);
                    if($usertbl != '') {
                        Config::set('database.connections.mysql.database', $orignaldatabase);
                        Config::set('database.default', 'mysql');
                        /** Update Super Admin sup_tbl_all_client_user User Table */
                        $clienttbl =  DB::table('sup_tbl_all_client_user')->where(['userId' => $clientuserId, 'Flag' => 'Show'])->update($sup_tbl_all_client_user);
                        if ($clienttbl != '') {
                            $suptbl =  DB::table('sup_tbl_client')->where(['CLIENT_ID' => $CLIENT_ID, 'Flag' => 'Show'])->update($sup_tbl_client);
                            if ($suptbl != '') {
                                $message = 'Done';
                            } else {
                                $message ='Error';
                            }

                        } else {
                            $message ='Error';
                        }

                    } else {
                        $message ='Error';
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
    /**
     * This Function is Will Give All Modules the Details
     * and Send Response To controller
     * @return \Illuminate\Http\Response Return Response all Detais  of Module
     */
    public function allModule()
    {
        $details= DB::table('sup_tbl_module')->where(['Flag'=>'Show'])->get();
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
        $countdetails= DB::table('sup_tbl_module')->where(['Flag'=>'Show', 'moduleName' => $data['moduleName']])->get()->count();
       // $aa= DB::getQuerylog();
        // print_r($aa);exit;
        /*print_r($countdetails);exit;*/
        if ($countdetails == 0) {
            $updated =  $this->insertRecords($details, $tablename);
            $retVal = ($updated != '') ? $message = 'Done' : $message = 'Error' ;
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
        $countdetails= DB::table('sup_tbl_module')->where(['Flag'=>'Show', 'moduleName' => $data['modulename']])->where('moduleId', '!=', $modelId)->get()->count();
      //  $aa= DB::getQuerylog();
         // print_r($aa);exit;
        // print_r($countdetails);exit;
        if ($countdetails == 0) {
            $updated = DB::table('sup_tbl_module')->where(['moduleId'=>$modelId])->update($details);
            $retVal = ($updated != '') ? $message = 'Done' : $message = 'Error' ;
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
        // $Assinderuser = $data['Assinderuser'];
        $Assinderuser = explode(",",$data['Assinderuser']);
        // $aaa = array($Assinderuser);
        $userClient = DB::table('sup_tbl_client')->where(['Flag' => 'Show', 'CLIENT_ID' => $CLIENT_ID])->get()->first();
        $Prefix = $userClient->CLIENT_PREFIX;
        $databasename = $Prefix . '_management';
        $i = 0;
        $getModules = DB::table('sup_tbl_module')->where(['Flag' => 'Show'])->whereIn('moduleId', $Assinderuser)->get();
        foreach ($getModules as $key => $value) {
            $aaryofDetails[$key] = $value;
            print_r($aaryofDetails[$key]->moduleName);
            $i++;
        }
      //  DB::statement('Create Table ' . $databasename . '.' . 'mst_tbl_module'

    }
}
