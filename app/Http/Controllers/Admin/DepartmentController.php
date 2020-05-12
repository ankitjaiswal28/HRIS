<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\mainModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the All Departments.
     *
     * @return \Illuminate\Http\Response
     */
    public function listofDepartments()
    {
        return view('Admin.ShowallDepartments');
        //.blade
    }

    /**
     * It Will give All Department Details
     *
     * @return \Illuminate\Http\Response It will Return The Data Table
     */
    public function show_alldepartment_datatbl()
    {
        $model = new mainModel();
        $responese = $model->showAllData('mst_tbl_departments');
        return Datatables::of($responese)
        ->addIndexColumn()
        ->addColumn('action', function ($query) {
            $number = $query->DEPARTMENT_ID;
            $id = Crypt::encrypt($query->DEPARTMENT_ID);
            $get = DB::table('mst_tbl_functions')->where(['Flag'=>'Show'])->where('DEPARTMENT_ID', 'like', '%' . $number . '%')->get()->count();
            if ($get > 0) {
                return '<a href="'.action('Admin\DepartmentController@editDepartments', Crypt::encrypt($query->DEPARTMENT_ID)).'" id="userform'.$query->DEPARTMENT_ID.'"><img src="/asset/css/zondicons/zondicons/edit-pencil.svg"  style="width: 15px;margin-right: 20px;    filter: invert(0.5);" alt=""></a>
            <a href="javascript:void(0)">Already Assined</a>
            ';
            } else {
                return '<a href="'.action('Admin\DepartmentController@editDepartments', Crypt::encrypt($query->DEPARTMENT_ID)).'" id="userform'.$query->DEPARTMENT_ID.'"><img src="/asset/css/zondicons/zondicons/edit-pencil.svg"  style="width: 15px;margin-right: 20px;    filter: invert(0.5);" alt=""></a>
                <a href="javascript:void(0)" onclick="deleteDepartments('."'$id'".',event)"><img src="/asset/css/zondicons/zondicons/close.svg"
                style="width: 15px;    filter: invert(0.5);" alt=""></a>
                ';
            }
        })
        ->rawColumns(['action'])
       ->make(true);
    }

    /**
     * It will Give Add Department Page
     * @return \Illuminate\Http\Response It will Return View Page Of Departments
     */
    public function AddDepartmentPage()
    {
        return view('Admin.AddDepartments');
    }

    /**
     * Store a newly created Department in Databse.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addDepartments(Request $request)
    {

        $model = new mainModel();
        $departmentName = $request->department_name;
        $UserId = $request->session()->get('userid');
        $timaestamp = date("Y-m-d H:i:s");
        $data['DEPARTMENT_NAME'] = $departmentName;
        $data['CREATED_BY'] = $UserId;
        $data['CREATED_AT'] = $timaestamp;
        $data['FLAG'] = 'Show';
        $response = $model->addDepartments($data);
        return $response;
    }

    /**
     * Show the form for editing the Department  Name.
     *
     * @param  int  $id Department Id
     * @return \Illuminate\Http\Response It will Return The View Page of the Department
     */
    public function editDepartments($id)
    {
        $id = Crypt::decrypt($id);
        $departnments = DB::table('mst_tbl_departments')->where(['Flag' => 'Show', 'DEPARTMENT_ID' => $id])->get()->first();
        return view('Admin.editDepartment', compact('departnments'));
       // editDepartment
    }

    /**
     * Update the specified Department in Databse.
     *
     * @param  \Illuminate\Http\Request  $request It will have Data ATo be Update
     * @return \Illuminate\Http\Response It will Return The Message Whether Data is Updated Or Not
     */
    public function updateDepartment(Request $request)
    {
        $model = new mainModel();
        $departmentName = $request->department_name;
        $departmentid = $request->departmentid;
        $UserId = $request->session()->get('userid');
        $timaestamp = date("Y-m-d H:i:s");
        $data['DEPARTMENT_NAME'] = $departmentName;
        $data['UPDATED_BY'] = $UserId;
        $data['UPDATED_AT'] = $timaestamp;
        $response = $model->updateDepartments($data, $departmentid);
        return $response;

    }

    /**
     * Remove the specified Department  from Databse.
     *
     * @param  int  $id Id Of The Departrment To Remove
     * @return \Illuminate\Http\Response It Will Return The Message That User Deleted.
     */
    public function destroy($id)
    {
        $model = new mainModel();
        $userid = session()->get('userid');
        $timaestamp = date("Y-m-d H:i:s");
        $id = Crypt::decrypt($id);
        $data['UPDATED_BY'] = $userid;
        $data['UPDATED_AT'] = $timaestamp;
        $data['FLAG'] = 'Delete';
        $response = $model->deleteDepartments($id, $data);
        return $response;
    }
}
