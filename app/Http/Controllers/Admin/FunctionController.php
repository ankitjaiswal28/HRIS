<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\mainModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class FunctionController extends Controller
{
    /**
     * Display a listing of the Functions.
     *
     * @return \Illuminate\Http\Response
     */
    public function listofFunctions()
    {
        return view('Admin.ShowallFunctions');
    }

    /**
     * It Will give All Department Details
     *
     * @return \Illuminate\Http\Response It will Return The Data Table
     */
    public function show_allfunctions_datatbl()
    {
        $model = new mainModel();
        $responese = $model->showAllData('mst_tbl_functions');
        return Datatables::of($responese)
        ->addIndexColumn()
        ->addColumn('DEPARTMENT_Names', function ($query) {
            $DEPARTMENT_ID = $query->DEPARTMENT_ID;
            $sql = "SELECT GROUP_CONCAT(DEPARTMENT_NAME ,'') as 'DEPARTMENT_NAME' FROM mst_tbl_departments WHERE DEPARTMENT_ID IN($DEPARTMENT_ID) ";
            $info = DB::select(DB::raw($sql));
            return $info[0]->DEPARTMENT_NAME;
        })
        ->addColumn('action', function ($query) {
            $id = Crypt::encrypt($query->FUNCTION_ID);
            return '<a href="'.action('Admin\FunctionController@editFunctions', Crypt::encrypt($query->FUNCTION_ID)).'" id="userform'.$query->FUNCTION_ID.'"><img src="/asset/css/zondicons/zondicons/edit-pencil.svg"  style="width: 15px;margin-right: 20px;    filter: invert(0.5);" alt=""></a>
                <a href="javascript:void(0)" onclick="deleteFunctions('."'$id'".',event)"><img src="/asset/css/zondicons/zondicons/close.svg"
                style="width: 15px;    filter: invert(0.5);" alt=""></a>
                ';
        })
        ->rawColumns(['action', 'DEPARTMENT_Names'])
       ->make(true);
    }

    /**
     * It will Give Add Function Page
     * @return \Illuminate\Http\Response It will Return View Page Of Function To Create
     */
    public function AddCreateFunctionPage()
    {
        $model = new mainModel();
        $deparments = $model->showAllData('mst_tbl_departments');
        return view('Admin.AddFunctions',compact('deparments'));
    }

    /**
     * Store a newly created Functions  in DataBase.
     *
     * @param  \Illuminate\Http\Request  $request Data Of The Function To be Created
     * @return \Illuminate\Http\Response It Will Send The Messge Wheter Function Created Or Not
     */
    public function addFunctions(Request $request)
    {
        $model = new mainModel();
        $functionName = $request->functionname;
        $departments = implode(",",$request->departments);
        $UserId = $request->session()->get('userid');
        $timaestamp = date("Y-m-d H:i:s");
        $data['FUNCTION_NAME'] = $functionName;
        $data['DEPARTMENT_ID'] = $departments;
        $data['CREATED_BY'] = $UserId;
        $data['CREATED_AT'] = $timaestamp;
        $data['FLAG'] = 'Show';
        $response = $model->addFunctions($data);
        return $response;
    }

    /**
     * Display the specified Function In View.
     *
     * @param  int  $id ID Of The Function
     * @return \Illuminate\Http\Response Return The View Page
     */
    public function editFunctions($id)
    {
        $model = new mainModel();
        $deparments = $model->showAllData('mst_tbl_departments');
        $id = Crypt::decrypt($id);
        $getFunction = DB::table('mst_tbl_functions')->where(['Flag' => 'Show', 'FUNCTION_ID' => $id])->get()->first();
        return view('Admin.EditFunctiuon', compact('deparments', 'getFunction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified Function  in Datbase.
     *
     * @param  \Illuminate\Http\Request  $request Data That Has been Update
     * @return \Illuminate\Http\Response Reurtn The Message That user Is Updated or Not
     */
    public function updateFunctions(Request $request)
    {
        $model = new mainModel();
        $functionName = $request->functionname;
        $functionId = $request->functionId;
        $departments = implode(",",$request->departments);
        $UserId = $request->session()->get('userid');
        $timaestamp = date("Y-m-d H:i:s");
        $data['FUNCTION_NAME'] = $functionName;
        $data['DEPARTMENT_ID'] = $departments;
        $data['UPDATED_BY'] = $UserId;
        $data['UPDATED_AT'] = $timaestamp;
        $response = $model->updateFunctions($data, $functionId);
        return $response;
    }

    /**
     * Remove the specified Function  from Datbase.
     *
     * @param  int  $id Of The Functions
     * @return \Illuminate\Http\Response Return Message Wether Function Deleted Or Not
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
        $response = $model->deleteFunctions($id, $data);
        return $response;
    }
}
