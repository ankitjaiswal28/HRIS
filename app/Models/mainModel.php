<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Contracts\Session\Session;
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
        $databsename = $prefix.'_management';
        $originalDB = $data['orignaldatabase'];
        $timaestamp = date("Y-m-d H:i:s");
        $aaryofDetails = [];
        $message = '';
        $newUser = DB::table('sup_tbl_client')->where(['Flag'=>'Show','ADMIN_EMAILID'=>$email])->get()->count();
        if ($newUser == 0) {
            $checkprefix = DB::table('sup_tbl_client')->where(['Flag'=>'Show','CLIENT_PREFIX'=>$prefix])->get()->count();
            if ($checkprefix == 0) {
                DB::statement('Create database ' . $databsename);
                $tables = DB::select("SELECT  table_name FROM information_schema.tables WHERE table_schema = '$originalDB' and TABLE_NAME NOT LIKE 'sup_%' ORDER BY table_name");      $i = 0;
                foreach ($tables as $key => $value){
                    $aaryofDetails[$key] = $value;
                    $tablesname = $aaryofDetails[$i]->table_name;
                   DB::statement('Create Table ' . $databsename.'.'.$tablesname. ' Like ' . $originalDB.'.'.$tablesname);
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
                    if ($cilentuserId > 0 ) {
                        Config::set('database.connections.mysql.database', $originalDB);        Config::set('database.default', 'mysql');
                        $message = 'User Created Sucessfuly';
                    }
                }

               } else {
                $message = 'Error';
               }
            } else {
                $message = 'PreFix Already Exits';
            }

        }else {
            $message = 'Email ID Already Exits';
        }
        return $message;
    }
}
