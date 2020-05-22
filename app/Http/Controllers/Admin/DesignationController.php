<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\mainModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
class DesignationController extends Controller
{
    /**
     * Display a listing of the all Designation.
     *
     * @return \Illuminate\Http\Response the View Page
     */
    public function listofDesignations()
    {
        return view('Admin.ShowallDesignation');
    }

    /**
     * It Will give All Designation Details
     *
     * @return \Illuminate\Http\Response It will Return The Data Table
     */
    public function show_alldesignation_datatbl()
    {
        $model = new mainModel();
        $responese = $model->showAllData('mst_tbl_designations');
        return Datatables::of($responese)
        ->addIndexColumn()
        ->addColumn('action', function ($query) {
            $number = $query->DESIGNATION_ID;
            $id = Crypt::encrypt($query->DESIGNATION_ID);
           /* $get = DB::table('mst_tbl_functions')->where(['Flag'=>'Show'])->where('DESIGNATION_ID', 'like', '%' . $number . '%')->get()->count();
            if ($get > 0) {
                return '<a href="'.action('Admin\DepartmentController@editDepartments', Crypt::encrypt($query->DESIGNATION_ID)).'" id="userform'.$query->DESIGNATION_ID.'"><img src="/asset/css/zondicons/zondicons/edit-pencil.svg"  style="width: 15px;margin-right: 20px;    filter: invert(0.5);" alt=""></a>
            <a href="javascript:void(0)">Already Assined</a>
            ';
            } else {
                return '<a href="'.action('Admin\DepartmentController@editDepartments', Crypt::encrypt($query->DESIGNATION_ID)).'" id="userform'.$query->DESIGNATION_ID.'"><img src="/asset/css/zondicons/zondicons/edit-pencil.svg"  style="width: 15px;margin-right: 20px;    filter: invert(0.5);" alt=""></a>
                <a href="javascript:void(0)" onclick="deleteDepartments('."'$id'".',event)"><img src="/asset/css/zondicons/zondicons/close.svg"
                style="width: 15px;    filter: invert(0.5);" alt=""></a>
                ';
            }*/
            return '<a href="'.action('Admin\DesignationController@editDesignations', Crypt::encrypt($query->DESIGNATION_ID)).'" id="userform'.$query->DESIGNATION_ID.'"><img src="/asset/css/zondicons/zondicons/edit-pencil.svg"  style="width: 15px;margin-right: 20px;    filter: invert(0.5);" alt=""></a>
                <a href="javascript:void(0)" onclick="deleteDesignation('."'$id'".',event)"><img src="/asset/css/zondicons/zondicons/close.svg"
                style="width: 15px;    filter: invert(0.5);" alt=""></a>
                ';
        })
        ->rawColumns(['action'])
       ->make(true);
    }

      /**
     * It will Give Add Designation Page
     * @return \Illuminate\Http\Response It will Return View Page Of Designation
     */
    public function AddDesignation()
    {
        return view('Admin.AddDesignation');
    }

    /**
     * Store a newly created Designations in Databse.
     *
     * @param  \Illuminate\Http\Request  $request Data Of Disgnation
     * @return \Illuminate\Http\Response Messgae Wether Desiogantion has Created or not
     */
    public function addDesignations(Request $request)
    {

        $model = new mainModel();
        $designation_name = $request->designation_name;
        $description = $request->description;

        $UserId = $request->session()->get('userid');
        $timaestamp = date("Y-m-d H:i:s");
        $data['DESGINATION_NAME'] = $designation_name;
        $data['DESGINATION_DESCRIPTION'] = $description;
        $data['CREATED_BY'] = $UserId;
        $data['CREATED_AT'] = $timaestamp;
        $data['FLAG'] = 'Show';
        $response = $model->addDesignations($data);
        return $response;
    }

    /**
     * Show the form for editing the Desgination  Name.
     *
     * @param  int  $id Desgination Id
     * @return \Illuminate\Http\Response It will Return The View Page of the Designation
     */
    public function editDesignations($id)
    {
        $id = Crypt::decrypt($id);
        $designations = DB::table('mst_tbl_designations')->where(['Flag' => 'Show', 'DESIGNATION_ID' => $id])->get()->first();
        return view('Admin.editDesignation', compact('designations'));
       // editDepartment
    }

    /**
     * Update the specified Desgination in Databse.
     *
     * @param  \Illuminate\Http\Request  $request It will have Data To be Update
     * @return \Illuminate\Http\Response It will Return The Message Whether Data is Updated Or Not
     */
    public function updateDesignation(Request $request)
    {
        $model = new mainModel();
        $designation_name = $request->designation_name;
        $description = $request->description;
        $designationid =$request->designationid;
        $UserId = $request->session()->get('userid');
        $timaestamp = date("Y-m-d H:i:s");
        $data['DESGINATION_NAME'] = $designation_name;
        $data['DESGINATION_DESCRIPTION'] = $description;
        $data['UPDATED_BY'] = $UserId;
        $data['UPDATED_AT'] = $timaestamp;
        $response = $model->updateDesignations($data, $designationid);
        return $response;

    }

    /**
     * Remove the specified Designation  from Databse.
     *
     * @param  int  $id Id Of The Designation To Remove
     * @return \Illuminate\Http\Response It Will Return The Message That Designation Deleted.
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
        $response = $model->deleteDesignations($id, $data);
        return $response;
    }
}
