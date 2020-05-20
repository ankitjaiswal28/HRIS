<?php

namespace App\Http\Controllers\Authtentication;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Login;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
class LoginController extends Controller
{
    /**
     * It will Show The first Page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getroleId = session()->get('roleId');
        return view('index');
    }
    /**
     * It will Authentication User And Return The Role Of User.
     *
     * @param  \Illuminate\Http\Request  $request In $request  username and Passsword will their.
     * @return \Illuminate\Http\Response Return The USer Details
     */
    public function CheckLogin(Request $request)
    {

        $login = new Login();
        $username = $request['email'];
        $passwords = $request['passwords'];
        $data['username'] = $username;
        $data['passwords'] = $passwords;
        $details = $login->Authentication($data);
        // print_r($details);exit;
        $count = count($details);
        $message = '';
        if ($count === 0) {
            $message = 'NotFound';
            return $message;
        } else {

            $getpassword = $details['passwords'];
            $user_id = $details['userId'];
            $decryptPassword = Crypt::decrypt($getpassword);
           // print_r($decryptPassword);exit;
            /** This is Called Ternary operation */
            $retVal = ($decryptPassword === $passwords) ? $message = 'Done' : $message = 'PassNotFound';

            if($retVal === 'Done') {
                $role_Id = $details['roleId'];
                if ($role_Id == 1) {
                    $user_name = $details['username'];
                    // $retVal = 'superadmindashboard';
                    $request->session()->put('emailId', $username);
                    $request->session()->put('username', $user_name);
                    $request->session()->put('roleId', $role_Id);
                    $request->session()->put('userid', $user_id);
                    $request->session()->put('databasename', 'hris_management');
                    $retVal = $role_Id .'_,';
                } elseif ($role_Id == 2) {
                   // print_r($details);exit;
                    $user_name = $details['username'];
                    $userImage = $details['user_image'];
                    $database = $details['CLIENT_PREFIX'];
                    $CLIENT_ID = $details['CLIENT_ID'];
                    $setDatabasename = strtolower($database).'_management';
                    $request->session()->put('CLIENT_ID', $CLIENT_ID);
                    $request->session()->put('orignaldb', 'hris_management');
                    $request->session()->put('databasename', $setDatabasename);
                    $checklogin = $login->checkFirtstLogin($setDatabasename, $user_id);
                  ///  print_r($details['roleId']);exit;

                    if ($checklogin == 'First') {
                        $encryptUserId = Crypt::encrypt($user_id);
                        $message = 'First';
                    } else {
                        $encryptUserId = '';
                        $request->session()->put('emailId', $username);
                        $request->session()->put('username', $user_name);
                        $request->session()->put('roleId', $role_Id);
                        $request->session()->put('userid', $user_id);
                        $data['UserId'] = $user_id;
                        $data['orignamlDB'] = 'hris_management';
                        $data['dynamicDb'] = $setDatabasename;
                        $datasubmited = $login->LoginInsert($data);
                        // LoginInsert

                        $message = 'Get';
                    }
                    $retVal = $role_Id .'_,' . $userImage.'_,' . $message . '_,' . $encryptUserId;
                } else {
                    $user_name = $details['username'];
                    $userImage = $details['user_image'];
                    $database = $details['CLIENT_PREFIX'];
                    $CLIENT_ID = $details['CLIENT_ID'];
                    $setDatabasename = strtolower($database).'_management';
                    $request->session()->put('CLIENT_ID', $CLIENT_ID);
                    $request->session()->put('orignaldb', 'hris_management');
                    $request->session()->put('databasename', $setDatabasename);
                    $checklogin = $login->checkFirtstLogin($setDatabasename, $user_id);
                    // print_r($checklogin);exit;
                    if ($checklogin == 'First') {
                        $encryptUserId = Crypt::encrypt($user_id);
                        $message = 'First';
                    } else {
                        $encryptUserId = '';
                        $request->session()->put('emailId', $username);
                        $request->session()->put('username', $user_name);
                        $request->session()->put('roleId', $role_Id);
                        $request->session()->put('userid', $user_id);
                        $data['UserId'] = $user_id;
                        $data['orignamlDB'] = 'hris_management';
                        $data['dynamicDb'] = $setDatabasename;
                        $datasubmited = $login->LoginInsert($data);
                        $message = 'Get';
                    }
                    $retVal = $role_Id .'_,' . $userImage.'_,' . $message . '_,' . $encryptUserId;
                }
                return $retVal;
            } else {
                return $retVal;
            }

      }

    }

    /**
     * Logout of The User and Destroy the User
     * and Return To LOgin Page
     * @param  \Illuminate\Http\Request  $request will have Some Data.
     * @return \Illuminate\Http\Response
     */
    public function Logout(Request $request)
    {
        $login = new Login();
        $request->session()->flush(); // remove all Session
        $message = $login->SetdatabaseName();
        // return view('index');
        return redirect('/');
    }
}
