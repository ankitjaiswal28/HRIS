<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\mainModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Crypt;

class AdminClientController extends Controller
{
    public function index()
    {
        return view('Admin.admin_client.show_adminclient');
    }

    public function showadddata()
    {
        return view('Admin.admin_client.add_adminclient');
    }

    public function add_client_data(Request $request)
    {
        $addmodel = new mainModel();
        date_default_timezone_set('Asia/Kolkata');
        $timaestamp = date("Y-m-d H:i:s");
        $user_id = session('userid');

        $data['CLIENT_NAME'] = $request->input('CLIENT_NAME');
        $data['CLIENT_PREFIX'] = $request->input('CLIENT_PREFIX');
        $data['CREATED_BY'] = $user_id;
        $data['CREATED_AT'] = $timaestamp;
        $data['FLAG'] = 'Show';

        $response = $addmodel->addclientdata($data);
        return $response;
    }

    public function show_all_client()
    {
        $details = new mainModel();
        $clientDetails = $details->showallclient();

        return Datatables::of($clientDetails)
            ->addIndexColumn()
            ->addColumn('action', function ($query) {
                $id = Crypt::encrypt($query->ADMIN_CLIENT_ID);
                return '<a href="' . action('Admin\AdminClientController@edit_all_client', Crypt::encrypt($query->ADMIN_CLIENT_ID)) . '"><img src="/asset/css/zondicons/zondicons/edit-pencil.svg"  style="width: 15px;margin-right: 20px;    filter: invert(0.5);" alt=""></a>
                <a href="javascript:void(0)" onclick="deleteDepartments(' . "'$id'" . ',event)"><img src="/asset/css/zondicons/zondicons/close.svg"
                style="width: 15px;    filter: invert(0.5);" alt=""></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function edit_all_client($ADMINCLIENTID)
    {

        $ADMIN_CLIENT_ID  = Crypt::decrypt($ADMINCLIENTID);
        $getdata = DB::table('mst_tbl_admin_clients')
            ->where(['FLAG' => 'Show', 'ADMIN_CLIENT_ID' => $ADMIN_CLIENT_ID])
            ->get()
            ->first();
        $clientdata['ADMIN_CLIENT_ID'] = $getdata->ADMIN_CLIENT_ID;
        $clientdata['CLIENT_NAME'] = $getdata->CLIENT_NAME;
        $clientdata['CLIENT_PREFIX'] = $getdata->CLIENT_PREFIX;

        $allclientdata = (object) $clientdata;

        return view('Admin.admin_client.edit_adminclient', compact('allclientdata'));
    }

    public function update_client(Request $request)
    {
        $addmodel = new mainModel();
        date_default_timezone_set('Asia/Kolkata');
        $timaestamp = date("Y-m-d H:i:s");
        $user_id = session('userid');

        $data['ADMIN_CLIENT_ID'] = $request->input('ADMIN_CLIENT_ID');
        $data['CLIENT_NAME'] = $request->input('CLIENT_NAME');
        $data['CLIENT_PREFIX'] = $request->input('CLIENT_PREFIX');
        $data['UPDATE_BY'] = $user_id;
        $data['UPDATE_AT'] = $timaestamp;

        $response = $addmodel->updateclient($data);
        return $response;
    }

    public function deleted_client($id)
    {
        $addmodel = new mainModel();
        date_default_timezone_set('Asia/Kolkata');
        $timaestamp = date("Y-m-d H:i:s");
        $user_id = session('userid');

        $id = Crypt::decrypt($id);
        $data['UPDATE_BY'] = $user_id;
        $data['UPDATE_AT'] = $timaestamp;
        $data['FLAG'] = 'Deleted';
        $response = $addmodel->deletedclient($id, $data);
        return $response;
    }
}
