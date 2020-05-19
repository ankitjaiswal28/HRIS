<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\mainModel;
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
        }
        // $getalll = $model->showAllData('mst_tbl_personal_details');
        // print_r(count($getallDeatils));
        return view('User.dashboard', compact('percentage'));
    }
}
