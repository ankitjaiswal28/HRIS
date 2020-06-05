<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\mainModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the All User
     *
     * @return \Illuminate\Http\Response
     */
    public function listofUser()
    {
        return view('Admin.ShowallUser');
    }

    public function User_Creation()
    {
        return view('Admin.User_Creation');
    }

    /**
     * It will Be Return The Data Table  Of Records
     *
     * @return \Illuminate\Http\Response it will give All Records of User
     */
    public function show_alluser_datatbl()
    {
        $model = new mainModel();
        $UserId = session()->get('userid');
        $responese = $model->getAllUserDetails($UserId);
        return Datatables::of($responese)
            ->addIndexColumn()
            ->addColumn('master_roleId', function ($query) {
                $masterROles = $query->master_roleId;
                $sql = "SELECT GROUP_CONCAT(MASTER_ROLE_NAME ,'') as 'MASTER_ROLE_NAME' FROM mst_tbl_master_role WHERE MASTER_ROLE_ID IN($masterROles) ";
                $info = DB::select(DB::raw($sql));
                // print_r();
                return $info[0]->MASTER_ROLE_NAME;
            })
            ->addColumn('REPORTING_MANGERS', function ($query) {
                $REPORTING = $query->REPORTING_MANGERS;
                $sql = "SELECT GROUP_CONCAT(username ,'') as 'REPORTING_MANGERS' FROM mst_user_tbl WHERE userId IN($REPORTING) ";
                $info = DB::select(DB::raw($sql));
                // print_r();
                return $info[0]->REPORTING_MANGERS;
            })
            ->addColumn('PRIMARY_MANGER', function ($query) {
                if ($query->PRIMARY_MANGER != null) {
                    $assinedusers = DB::table('mst_user_tbl')->where(['Flag' => 'Show', 'userId' => $query->PRIMARY_MANGER])->get()->first();
                    return $assinedusers->username;
                } else {
                    return 'Not Assinded';
                }
            })->addColumn('SHIFT_ID', function ($query) {
                if ($query->SHIFT_ID != 0) {
                     $assinedShift = DB::table('mst_tbl_shifts')->where(['Flag' => 'Show', 'SHIFT_ID' => $query->SHIFT_ID])->get()->first();
                    return $assinedShift->SHIFT_NAME;
                } else {
                    return 'No Shifts';
                }
            })
            ->addColumn('action', function ($query) {
                $id = Crypt::encrypt($query->userId);
                return '<a href="' . action('Admin\UserController@editUser', Crypt::encrypt($query->userId)) . '" id="userform' . $query->userId . '"><img src="/asset/css/zondicons/zondicons/edit-pencil.svg"  style="width: 15px;margin-right: 20px;    filter: invert(0.5);" alt=""></a>
                <a href="javascript:void(0)" onclick="deleteUser(' . "'$id'" . ',event)"><img src="/asset/css/zondicons/zondicons/close.svg"
                style="width: 15px;    filter: invert(0.5);" alt=""></a>
                ';
            })
            ->rawColumns(['action', 'PRIMARY_MANGER', 'master_roleId', 'REPORTING_MANGERS'])
            ->make(true);

    }

    /**
     * Show The Add User  Page View
     *
     * @return \Illuminate\Http\Response
     */
    public function AddUser()
    {
        $model = new mainModel();
        //print_r('dfdfdfdf');
        $roles = $model->showAllData('mst_tbl_master_role');
        $users = $model->showAllData('mst_user_tbl');
        $functions = $model->showAllData('mst_tbl_functions');
        $desigantions = $model->showAllData('mst_tbl_designations');
        $clients = $model->showAllData('mst_tbl_admin_clients');
        $shifts = $model->showAllData('mst_tbl_shifts');
        $types = '';
        $finaldata = [];
        if (DB::getSchemaBuilder()->hasTable('mst_tbl_grade')) {
            $types = 'Grade';
            $content = $model->showAllData('mst_tbl_grade');
            $length = count($content);
            $aaary1 = [];
            for ($i = 0; $i < $length; $i++) {
                $aaary1 = [];
                $aaary1['Id'] = $content[$i]->GRADE_ID;
                $aaary1['Name'] = $content[$i]->GRADE_NAME;
                $finaldata[] = $aaary1;
            }
        } else {
            $types = 'Levels';
            $content = $model->showAllData('mst_tbl_levels');
            $length = count($content);
            $aaary1 = [];
            for ($i = 0; $i < $length; $i++) {
                $aaary1 = [];
                $aaary1['Id'] = $content[$i]->LEVEL_ID;
                $aaary1['Name'] = $content[$i]->LEVEL_NAME;
                $finaldata[] = $aaary1;
            }
        }
        //$users = DB::table('mst_user_tbl')->orderBy('userId', 'DESC')->first();
        $lastdata = DB::table('mst_user_tbl')->where(['Flag' => 'Show'])->orderBy('userId', 'desc')->first();
        $Id = $lastdata->userId;
        $lastId = (int) $Id + 1;
        $empCode = session()->get('emp_code') . $lastId;
        return view('Admin.AddUser', compact('roles', 'users', 'functions', 'desigantions', 'clients', 'types', 'finaldata', 'empCode' , 'shifts'));
    }

    /**
     * Store a newly created User  in DataBase.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createUser(Request $request)
    {

        $model = new mainModel();
        $orignalDb = $request->session()->get('orignaldb');
        $dynamicdatabase = $request->session()->get('databasename');
        $userid = $request->session()->get('userid');
        $CLIENT_ID = $request->session()->get('CLIENT_ID');
        $empCodeformat = $request->session()->get('emp_code');

        $ROLEID = 3;
        $Roles = $request->roles;
        $username = $request->username;
        $reportingmanger = $request->reportingmanger;
        $email = $request->email;
        $pwd = $request->pwd;
        $primarymanger = $request->primarymanger;
        $MASTER_ROLE_ID = implode(",", $Roles);
        $REPORTING_MANAGER = implode(",", $reportingmanger);
        $departmens = $request->departmens;
        $functions = $request->functions;
        $employetype = $request->employetype;
        $designation = $request->designation;
        $companyassined = $request->companyassined;
        $gradeorlevel = $request->gradeorlevel;
        $empcode = $request->empcode;
        $employeeShifts = $request->employeeShifts;

        $input = $request->doj;
        $date = strtotime($input);
        $doj = date('Y-m-d', $date);
        //  exit;
        // $doj = $request->doj;
        $encryptPassword = Crypt::encrypt($pwd);
        $data['orignalDb'] = $orignalDb;
        $data['ROLEID'] = $ROLEID;
        $data['userid'] = $userid;
        $data['encryptPassword'] = $encryptPassword;
        $data['email'] = $email;
        $data['username'] = $username;
        $data['MASTER_ROLE_ID'] = $MASTER_ROLE_ID;
        $data['REPORTING_MANAGER'] = $REPORTING_MANAGER;
        $data['dynamicdatabase'] = $dynamicdatabase;
        $data['CLIENT_ID'] = $CLIENT_ID;
        $data['PRIMARY_MANGER'] = $primarymanger;
        $data['FUNCTION_NAME_ID'] = $functions;
        $data['DEPARTMENTS_ID'] = $departmens;
        $data['DOJ'] = $doj;
        $data['EMPLOYE_TYPE'] = $employetype;
        $data['DESIGNATION_ID'] = $designation;
        $data['ADMINCLIENT_ID'] = $companyassined;
        $data['GRADEORLEVEL_ID'] = $gradeorlevel;
        $data['GRADEORLEVEL_ID'] = $gradeorlevel;
        $data['EMPLOYEE_ID'] = $empcode;
        $data['empCodeformat'] = $empCodeformat;
        $data['SHIFT_ID'] = $employeeShifts;



        $response = $model->UserCraetion($data);
        return $response;
        // print_r($orignalDb);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editUser($id)
    {
        $model = new mainModel();
        $id = Crypt::decrypt($id);
        $users = DB::table('mst_user_tbl')->where(['Flag' => 'Show'])->where('userId', '!=', $id)->get();
        $roles = $model->showAllData('mst_tbl_master_role');
        $functions = $model->showAllData('mst_tbl_functions');
        $desigantions = $model->showAllData('mst_tbl_designations');
        $clients = $model->showAllData('mst_tbl_admin_clients');
        $shifts = $model->showAllData('mst_tbl_shifts');
        $types = '';
        $finaldata = [];
        if (DB::getSchemaBuilder()->hasTable('mst_tbl_grade')) {
            $types = 'Grade';
            $content = $model->showAllData('mst_tbl_grade');
            $length = count($content);
            $aaary1 = [];
            for ($i = 0; $i < $length; $i++) {
                $aaary1 = [];
                $aaary1['Id'] = $content[$i]->GRADE_ID;
                $aaary1['Name'] = $content[$i]->GRADE_NAME;
                $finaldata[] = $aaary1;
            }
        } else {
            $types = 'Levels';
            $content = $model->showAllData('mst_tbl_levels');
            $length = count($content);
            $aaary1 = [];
            for ($i = 0; $i < $length; $i++) {
                $aaary1 = [];
                $aaary1['Id'] = $content[$i]->LEVEL_ID;
                $aaary1['Name'] = $content[$i]->LEVEL_NAME;
                $finaldata[] = $aaary1;
            }
        }
        $assinedusers = DB::table('mst_user_tbl')->where(['Flag' => 'Show', 'userId' => $id])->get()->first();
        // $FUNCTION_ID =
        $newUser = DB::table('mst_tbl_functions')->where(['Flag' => 'Show'])->where(['FUNCTION_ID' => $assinedusers->FUNCTION_NAME_ID])->get()->first();
        $Departmentd = $newUser->DEPARTMENT_ID;
        $arrayId = explode(',', $Departmentd);
        $depatments = DB::table('mst_tbl_departments')->where(['Flag' => 'Show'])->whereIn('DEPARTMENT_ID', $arrayId)->get();
        $aaa = explode(',', $assinedusers->REPORTING_MANGERS);
        $allmanger = DB::table('mst_user_tbl')->where(['Flag' => 'Show'])->whereIn('userId', $aaa)->get();
        $details['userId'] = $assinedusers->userId;
        $details['username'] = $assinedusers->username;
        $details['emailId'] = $assinedusers->emailId;
        $passwords = $assinedusers->passwords;
        $details['passwords'] = Crypt::decrypt($passwords);
        $details['master_roleId'] = $assinedusers->master_roleId;
        $details['REPORTING_MANGERS'] = $assinedusers->REPORTING_MANGERS;
        $details['EMPLOYEE_ID'] = $assinedusers->EMPLOYEE_ID;
        $details['FUNCTION_NAME_ID'] = $assinedusers->FUNCTION_NAME_ID;
        $details['DEPARTMENTS_ID'] = $assinedusers->DEPARTMENTS_ID;
        $details['GRADEORLEVEL_ID'] = $assinedusers->GRADEORLEVEL_ID;
        $details['DESIGNATION_ID'] = $assinedusers->DESIGNATION_ID;
        $details['EMPLOYE_TYPE'] = $assinedusers->EMPLOYE_TYPE;
        $details['ADMINCLIENT_ID'] = $assinedusers->ADMINCLIENT_ID;
        $details['PRIMARY_MANGER'] = $assinedusers->PRIMARY_MANGER;
        $details['SHIFT_ID'] = $assinedusers->SHIFT_ID;

        $doj = $assinedusers->DOJ;
        $res = explode("-", $doj);
        // print_r();
        $details['DOJ'] = $res[2] . '-' . $res[1] . '-' . $res[0];
        // $users = $model->showAllData('mst_user_tbl');
        // print_r($users);
        return view('Admin.EditUser', compact('roles', 'users', 'details', 'functions', 'desigantions', 'clients', 'types', 'finaldata', 'depatments' , 'allmanger', 'shifts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateUser(Request $request)
    {
        $model = new mainModel();
        $orignalDb = $request->session()->get('orignaldb');
        $dynamicdatabase = $request->session()->get('databasename');
        $userid = $request->session()->get('userid');
        $CLIENT_ID = $request->session()->get('CLIENT_ID');
        $Roles = $request->roles;
        $username = $request->username;
        $reportingmanger = $request->reportingmanger;
        $email = $request->email;
        $pwd = $request->pwd;
        $primarymanger = $request->primarymanger;
        $MASTER_ROLE_ID = implode(",", $Roles);
        $REPORTING_MANAGER = implode(",", $reportingmanger);
        $departmens = $request->departmens;
        $functions = $request->functions;
        $employetype = $request->employetype;
        $designation = $request->designation;
        $companyassined = $request->companyassined;
        $gradeorlevel = $request->gradeorlevel;
        $input = $request->doj;
        $employeeShifts = $request->employeeShifts;
        $date = strtotime($input);
        $doj = date('Y-m-d', $date);
        //  exit;
        // $doj = $request->doj;
        // $Roles = $request->roles;
        // $username = $request->username;
        // $reportingmanger = $request->reportingmanger;
        // $email = $request->email;
        // $pwd = $request->pwd;
        $clientuserId = $request->clientuserId;
        $MASTER_ROLE_ID = implode(",", $Roles);
        $REPORTING_MANAGER = implode(",", $reportingmanger);
        $encryptPassword = Crypt::encrypt($pwd);
        $data['orignalDb'] = $orignalDb;
        $data['MASTER_ROLE_ID'] = $MASTER_ROLE_ID;
        $data['userid'] = $userid;
        $data['username'] = $username;
        $data['MASTER_ROLE_ID'] = $MASTER_ROLE_ID;
        $data['dynamicdatabase'] = $dynamicdatabase;
        $data['PRIMARY_MANGER'] = $primarymanger;
        $data['FUNCTION_NAME_ID'] = $functions;
        $data['DEPARTMENTS_ID'] = $departmens;
        $data['DOJ'] = $doj;
        $data['EMPLOYE_TYPE'] = $employetype;
        $data['DESIGNATION_ID'] = $designation;
        $data['ADMINCLIENT_ID'] = $companyassined;
        $data['GRADEORLEVEL_ID'] = $gradeorlevel;
        $data['GRADEORLEVEL_ID'] = $gradeorlevel;
        $data['encryptPassword'] = $encryptPassword;
        $data['email'] = $email;
        $data['username'] = $username;
        $data['REPORTING_MANAGER'] = $REPORTING_MANAGER;
        $data['dynamicdatabase'] = $dynamicdatabase;
        $data['CLIENT_ID'] = $CLIENT_ID;
        $data['clientuserId'] = $clientuserId;
        $data['SHIFT_ID'] = $employeeShifts;
        $response = $model->updateUserCraetion($data);
        return $response;
    }

    /**
     * Remove the specified User from Thata Base .
     *
     * @param  int  $id of The The user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = new mainModel();
        $orignalDb = session()->get('orignaldb');
        $dynamicdatabase = session()->get('databasename');
        $userid = session()->get('userid');
        $CLIENT_ID = session()->get('CLIENT_ID');
        $timaestamp = date("Y-m-d H:i:s");
        $id = Crypt::decrypt($id);
        $ROLEID = 3;
        $data['orignalDb'] = $orignalDb;
        $data['userid'] = $userid;
        $data['dynamicdatabase'] = $dynamicdatabase;
        $data['CLIENT_ID'] = $CLIENT_ID;
        $data['timaestamp'] = $timaestamp;
        $data['ROLEID'] = $ROLEID;
        $response = $model->deleteUser($id, $data);
        return $response;

    }

    public function add_attendance()
    {
        return view('Admin.add_attandance');
    }
}
