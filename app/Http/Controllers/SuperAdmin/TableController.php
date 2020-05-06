<?php

namespace App\Http\Controllers\Superadmin;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\mainModel;
use App\User;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class TableController extends Controller
{
    public function show_client_datatbl()
    {
        $details= DB::table('sup_tbl_client')->where(['Flag'=>'Show'])->get();
        return Datatables::of($details)
        ->addIndexColumn()
        ->addColumn('action', function ($query) {
            return '<a href="'.action('SuperAdmin\TableController@edit', Crypt::encrypt($query->CLIENT_ID)).'" id="userform'.$query->CLIENT_ID.'"><img src="/asset/css/zondicons/zondicons/edit-pencil.svg"  style="width: 15px;margin-right: 20px;    filter: invert(0.5);" alt=""></a>
            <a href="'.action('SuperAdmin\TableController@destroy', Crypt::encrypt($query->CLIENT_ID)).'" id="userform'.$query->CLIENT_ID.'"><img src="/asset/css/zondicons/zondicons/close.svg"
            style="width: 15px;    filter: invert(0.5);" alt=""></a>
            ';
        })
        ->rawColumns(['action'])
       ->make(true);
    //    ->addColumn('delete', function ($query) {
    //     return '<div class="">
    //<button  type="button" style="background: none;border: none;" onclick="deleteFunction('.$query->CLIENT_ID.',event)"><img src="/asset/css/zondicons/zondicons/edit-pencil.svg"
    //        style="width: 15px;margin-right: 20px;    filter: invert(0.5);" alt=""></button>
    //     <form action="'.action('UsersController@destroy', Crypt::encrypt($query->user_id)).'" id="userform'.$query->user_id.'"method="post">
    //     '.csrf_field().'
    //     <input name="_method" type="hidden" value="PATCH">
    //     <center><button  type="submit"  class = "tdbutton " onclick="deleteFunction('.$query->user_id.',event)"><img class="imgresp" src="'.asset('images/icon/delete.png').'"></button>
    //     </form></div>';
    // })

    // ->addColumn('edit',function($query){
    //     return '<center><a href="' . action('UsersController@edit',Crypt::encrypt($query->user_id)) .'" ><img class="imgresp" src="'.asset('images/icon/edit.png').'"></a></center>';
    // })
    // ->rawColumns(['edit','delete'])
        // return view('SuperAdmin/Show_client');
    }

    public function show_Edit_client()
    {
        return view('SuperAdmin/show_Edit_client');
    }

    public function updateclient(Request $request)
    {
        $details = new mainModel();
        $clientid = $request->clientid;
        $companyname = $request->companyname;

        $adminname = $request->adminname;
        $mobileno = $request->mobileno;
        $email = $request->email;
        $prefix = $request->prefix;
        $pwd = $request->pwd;
        $orignaldatabase = $request->session()->get('databasename');
        $encryptPassword = Crypt::encrypt($pwd);
        $data['CLIENT_ID'] = $clientid;
        $data['COMPANY_NAME'] = $companyname;
        $data['ADMIN_NAME'] = $adminname;
        $data['ADMIN_MOB_NO'] = $mobileno;
        $data['ADMIN_EMAILID'] = $email;
        $data['CLIENT_PREFIX'] = $prefix;
        // $data['PASSWORDS'] = $encryptPassword;
        // $data['orignaldatabase'] = $orignaldatabase;

        $table_name = 'sup_tbl_client';
        $keyvalue = $clientid;
        $keyname = 'CLIENT_ID';
       $responsemessg = $details->clientupdate($table_name,$keyname,$keyvalue,$data);

    //    print_rv($responsemessg);
    //    return  $responsemessg;
    }

    public function Show_client()
    {
        // $details= DB::table('sup_tbl_client')->get();
        // return Datatables::of($details)->make(true);
        return view('SuperAdmin/Show_client');
    }
    public function edit($id)
	{
        $id = Crypt::decrypt($id);
       $data = DB::table('sup_tbl_client')->where(['Flag'=>'Show','CLIENT_ID'=>$id])->get()->first();
        return view('SuperAdmin/show_Edit_client',compact('data'));
    }
    public function destroy($id)
	{
        // print_r($id);
	 	$id = Crypt::decrypt($id);
        $Delete_query = DB::table('sup_tbl_client')->where(['Flag'=>'Show','CLIENT_ID'=>$id])->update(['Flag'=>'Deleted']);
        // print_r($Delete_query);
		return view("Superadmin/Show_client");

	}

}
