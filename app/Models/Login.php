<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

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
                $getallDetails = DB::table('sup_tbl_all_client_user as cu')->select('cu.userId','cu.CLIENT_ID','cu.emailId','cu.passwords','cu.roleId','cu.username','su.user_image','su.CLIENT_PREFIX')->leftJoin('sup_tbl_client as su','su.CLIENT_ID', '=', 'cu.CLIENT_ID') ->where(['cu.Flag'=> $flag ,'cu.emailId'=>$username])->get()->first();
               // $aa= DB::getQuerylog();
                // print_r($aa);exit;
                foreach ($getallDetails as $key => $value){
                    $aaryofDetails[$key] = $value;
                }
                $prefix = $aaryofDetails['CLIENT_PREFIX'];
                $CLIENT_ID = $aaryofDetails['CLIENT_ID'];
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
}
