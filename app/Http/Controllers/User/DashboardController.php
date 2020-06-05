<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\mainModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Crypt;
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
        $model = new mainModel();
        $percentage = 0;
        $USERID = session()->get('userid');
        $data['USER_ID'] = $USERID;
        $getallDeatils = $model->getUserDetails($data);
            // print_r($getallDeatils);
        if(count($getallDeatils) == 0) {
            $percentage = 0;
        } else if(count($getallDeatils) == 1) {
            $percentage = 25;
        } else if (count($getallDeatils) == 2) {
            $percentage = 50;
        } else if (count($getallDeatils) == 3) {
            $percentage = 75;
        } else if(count($getallDeatils) == 4) {
            $percentage = 100;
        }
        // $getalll = $model->showAllData('mst_tbl_personal_details');
        // print_r(session()->get('emp_code'));
        return view('User.dashboard', compact('percentage'));
    }
    /**
     * Show The All Atendence Page Vivew
     *
     * @return \Illuminate\Http\Response
     */
    public function showAttendence()
    {
        print_r('fcdfd');
        return view('User.Showallattendence');
    }

    /**
     * It Will Give The All Records Of The Levels
     *
     * @return \Illuminate\Http\Response return The Response as Data Table
     */
    public function show_all_atendence()
    {
        $model = new mainModel();
        $uesrId = session()->get('userid');
        $responese = DB::table('mst_tbl_add_attdencence')->where(['user_id' => $uesrId])->get();
        // $responese = $model->showAllData('mst_tbl_shifts');
        return Datatables::of($responese)
        ->addIndexColumn()
        ->addColumn('shift', function ($query) {
            if ($query->shift != 0) {
                 $assinedShift = DB::table('mst_tbl_shifts')->where(['Flag' => 'Show', 'SHIFT_ID' => $query->shift])->get()->first();
                return $assinedShift->SHIFT_NAME;
            } else {
                return 'No Shifts';
            }
        })
        ->addColumn('assgin_user_toclient', function ($query) {
            if ($query->assgin_user_toclient != 0) {
                 $assinedClient = DB::table('mst_tbl_admin_clients')->where(['Flag' => 'Show', 'ADMIN_CLIENT_ID' => $query->assgin_user_toclient])->get()->first();
                return $assinedClient->CLIENT_NAME;
            } else {
                return 'No Client';
            }
        })
        // ->addColumn('action', function ($query) {
        //     $id = Crypt::encrypt($query->attendenceId);
        //     return '<a href="'.action('Admin\AddShiftsController@editShifts', Crypt::encrypt($query->attendenceId)).'" id="userform'.$query->attendenceId.'"><img src="/asset/css/zondicons/zondicons/edit-pencil.svg"  style="width: 15px;margin-right: 20px;    filter: invert(0.5);" alt=""></a>
        //         <a href="javascript:void(0)" onclick="deleteShifts('."'$id'".',event)"><img src="/asset/css/zondicons/zondicons/close.svg"
        //         style="width: 15px;    filter: invert(0.5);" alt=""></a>
        //         ';
        // })
        ->rawColumns(['assgin_user_toclient', 'shift'])
       ->make(true);
    }


}
