<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;
use App\Models\mainModel;
class Login extends Model
{
     /**
     * This Function is to Authenticate User
     * and Send the Details To User
     * @param  \Illuminate\Http\Request  $data In $data  username and Passsword will their.
     * @return \Illuminate\Http\Response Return The USer Details and Change The DataBase Name
     */
    public function Authentication($data)
    {
        $username = $data['username'];
        $passwords = $data['passwords'];
        $user = DB::table('sup_tbl_user')->where(['flag'=>'Show','emailId'=>$username])->get()->count();
        $aaryofDetails = [];
        if ($user != 0) {
            $getDetails = DB::table('sup_tbl_user')->where(['flag'=>'Show','emailId'=>$username])->get()->first();
            foreach ($getDetails as $key => $value){
                $aaryofDetails[$key] = $value;
            }
            // Set Default DataBase
            Config::set('database.connections.mysql.database', 'hris_management');
            Config::set('database.default', 'mysql');
        } else {
            $newUser = DB::table('sup_tbl_all_client_user')->where(['flag'=>'Show','emailId'=>$username])->get()->count();
            if ($newUser != 0) {
                $flag = "Show";
                //DB::enableQuerylog();
                $getallDetails = DB::table('sup_tbl_all_client_user as cu')->select('cu.userId','cu.CLIENT_ID','cu.emailId','cu.passwords','cu.roleId','cu.username','su.user_image','su.CLIENT_PREFIX','cu.EMP_CODE')->leftJoin('sup_tbl_client as su','su.CLIENT_ID', '=', 'cu.CLIENT_ID') ->where(['cu.Flag'=> $flag ,'cu.emailId'=>$username])->get()->first();
               // $aa= DB::getQuerylog();
                // print_r($aa);exit;
                foreach ($getallDetails as $key => $value){
                    $aaryofDetails[$key] = $value;
                }
                $prefix = $aaryofDetails['CLIENT_PREFIX'];
                $CLIENT_ID = $aaryofDetails['CLIENT_ID'];
                $EMP_CODE = $aaryofDetails['EMP_CODE'];
                $getDatBasename = strtolower($aaryofDetails['CLIENT_PREFIX']). '_management';
                // Set Dynamic Database.
                Config::set('database.connections.dynamicsql.database', $getDatBasename);
                Config::set('database.default', 'dynamicsql');

                $getclientDetails = DB::table('mst_user_tbl')->where(['flag'=>'Show','emailId'=>$username])->get()->first();
               // print_r($getclientDetails);exit;
                $aaryofDetails = [];
                foreach ($getclientDetails as $key => $value){
                    $aaryofDetails[$key] = $value;
                }
                $aaryofDetails['CLIENT_PREFIX'] = $prefix;
                $aaryofDetails['CLIENT_ID'] = $CLIENT_ID;
                $aaryofDetails['EMP_CODE'] = $EMP_CODE;
                //echo "Connected sucessfully to database ".DB::connection()->getDatabaseName().".";
               //  print_r($getDatBasename);
            }
        }
        return $aaryofDetails;

    }
    /**
     * This Function Will Change Database Name
     */
    public function SetdatabaseName()
    {
        Config::set('database.connections.mysql.database', 'hris_management');
        Config::set('database.default', 'mysql');
        $message = 'Done';
        return $message;

    }

    /**
     * This Function Will Change Database Name
     */
    public function checkFirtstLogin($dtabasename, $user_id)
    {
        Config::set('database.connections.dynamicsql.database', $dtabasename);
        Config::set('database.default', 'dynamicsql');
       // echo "Connected sucessfully to database ".DB::connection()->getDatabaseName().".";
        //DB::enableQuerylog();
         $getclientDetails = DB::table('mst_login_aduit_reports')->where(['FLAG'=>'Show','USER_ID'=>$user_id])->get()->count();
         // echo $getclientDetails;
         $retVal = ($getclientDetails == 0) ? 'First' : 'Already' ;
        // // $aa= DB::getQuerylog();
        // // print_r($aa);exit;
          return $retVal;

    }

    /**
     * This Function is to Update Password of User
     * and Send the Response message To  User
     * @param  \Illuminate\Http\Request  $data In $data Old Password And New Password Both Will Be Their
     * @return \Illuminate\Http\Response Return The Message
     */
    public function UpdatePassWord($data)
    {
        $Model = new mainModel();
        //print_r($data);
        $UserId = $data['UserId'];
        $oldPassWord = Crypt::decrypt($data['oldPassWord']);
        $newPassword = $data['newPassword'];
        $orignamlDB = $data['orignamlDB'];
        $dynamicDb = $data['dynamicDb'];
        $date = date('Y-m-d');
        $time = date(' H:i:s');
        $timaestamp = date("Y-m-d H:i:s");
        Config::set('database.connections.dynamicsql.database', $dynamicDb);
        Config::set('database.default', 'dynamicsql');
        $getclientDetails = DB::table('mst_user_tbl')->where(['FLAG'=>'Show','userId'=>$UserId])->get()->first();
        $passWord =Crypt::decrypt($getclientDetails->passwords);
        $emailId = $getclientDetails->emailId;
        $roleId = $getclientDetails->roleId;
        $message = '';
        if($oldPassWord == $passWord) {
            $updatePassword['passwords'] = $newPassword;
            $updatePassword['updated_at'] = $timaestamp;
            $updatePassword['UPDATED_BY'] = $UserId;
            $updatePassworddetails = DB::table('mst_user_tbl')->where(['Flag'=>'Show','userId'=>$UserId])->update($updatePassword);
            if ($updatePassworddetails != '') {
                $updateData['USER_ID'] = $UserId;
                $updateData['LOGIN_DATE'] = $date;
                $updateData['CREATED_AT'] = $timaestamp;
                $updateData['LOGIN_TIME'] = $time;
                $updateData['STATUS'] = 'Password Updated';
                $updateData['FLAG'] = 'Show';
                $passwordInsert = $Model->insertRecords($updateData, 'mst_login_aduit_reports');
                if($passwordInsert != '') {
                    Config::set('database.connections.mysql.database', $orignamlDB);
                    Config::set('database.default', 'mysql');
                    $sup_tbl_all_client_user['passwords'] = $newPassword;
                    $sup_tbl_all_client_user['updated_at'] = $timaestamp;
                    $updatePasswordsup_tbl_all_client_userdetails = DB::table('sup_tbl_all_client_user')->where(['Flag'=>'Show','emailId'=>$emailId])->update($sup_tbl_all_client_user);
                    if ($updatePasswordsup_tbl_all_client_userdetails != '') {
                        if($roleId == 2) {
                            $sup_tbl_client['PASSWORDS'] = $newPassword;
                            $sup_tbl_client['updated_at'] = $timaestamp;
                            $updatePasswordsup_tbl_clientdetails = DB::table('sup_tbl_client')->where(['Flag'=>'Show','ADMIN_EMAILID'=>$emailId])->update($sup_tbl_client);
                            if ($updatePasswordsup_tbl_clientdetails != '') {
                                 $message = 'Done';
                            } else {
                                $message = 'Error1';
                            }
                        } else {
                            $message = 'Done';
                        }
                        /**/
                    } else {
                        $message = 'Error2';
                    }
                } else {
                    $message = 'Error3';

                }
            } else {
                $message = 'Error4';
            }

            /**/

            // $passwordInsert = $Model->insertRecords($updateData, 'mst_login_aduit_reports');
            // if(passwordInsert)

            // $message = 'Match';
        } else {
            $message = 'Not Match';

        }
        // $get = Crypt::decrypt($getclientDetails->passwords);
        return $message;

    }
    public function LoginInsert($data)
    {
        $Model = new mainModel();
        //print_r($data);
        $UserId = $data['UserId'];
        $orignamlDB = $data['orignamlDB'];
        $dynamicDb = $data['dynamicDb'];
        $date = date('Y-m-d');
        $time = date(' H:i:s');
        $timaestamp = date("Y-m-d H:i:s");
        Config::set('database.connections.dynamicsql.database', $dynamicDb);
        Config::set('database.default', 'dynamicsql');
        $updateData['USER_ID'] = $UserId;
        $updateData['LOGIN_DATE'] = $date;
        $updateData['CREATED_AT'] = $timaestamp;
        $updateData['LOGIN_TIME'] = $time;
        $updateData['STATUS'] = 'Login Sucessfuly';
        $updateData['FLAG'] = 'Show';
        $dataInsetrd = $Model->insertRecords($updateData, 'mst_login_aduit_reports');
        Config::set('database.connections.mysql.database', $orignamlDB);
        Config::set('database.default', 'mysql');
        return $dataInsetrd;
    }
}
