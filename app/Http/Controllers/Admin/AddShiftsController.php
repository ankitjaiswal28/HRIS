<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\mainModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
class AddShiftsController extends Controller
{
    /**
     * Display a listing of the Shifts
     *
     * @return \Illuminate\Http\Response It will return the View Page
     */
    public function listofShits()
    {
        return view('Admin.ShowallShifts');
    }

    /**
     * It Will Give The All Records Of The Levels
     *
     * @return \Illuminate\Http\Response return The Response as Data Table
     */
    public function show_shifts_datatbl()
    {
        $model = new mainModel();
        $responese = $model->showAllData('mst_tbl_shifts');
        return Datatables::of($responese)
        ->addIndexColumn()
        ->addColumn('action', function ($query) {
            $id = Crypt::encrypt($query->SHIFT_ID);
            return '<a href="'.action('Admin\AddShiftsController@editShifts', Crypt::encrypt($query->SHIFT_ID)).'" id="userform'.$query->SHIFT_ID.'"><img src="/asset/css/zondicons/zondicons/edit-pencil.svg"  style="width: 15px;margin-right: 20px;    filter: invert(0.5);" alt=""></a>
                <a href="javascript:void(0)" onclick="deleteShifts('."'$id'".',event)"><img src="/asset/css/zondicons/zondicons/close.svg"
                style="width: 15px;    filter: invert(0.5);" alt=""></a>
                ';
        })
        ->rawColumns(['action'])
       ->make(true);
    }

    /**
     * Show the form for creating a new Shifts
     *
     * @return \Illuminate\Http\Response View page Of Add New Shifts
     */
    public function AddShifts()
    {
        return view('Admin.AddShifts');
    }

    /**
     * Store a newly created Shifts in storage.
     *
     * @param  \Illuminate\Http\Request  $request All Data To be Craeted
     * @return \Illuminate\Http\Response Wether The Shits Is Craeted Or Not
     */
    public function craeteShifts(Request $request)
    {
        $model = new mainModel();
        $shifts_name = $request->shifts_name;
        $input = $request->InitialTime;
        $input2 = $request->EndTime;
        $starttime = strtotime($input);
        $endtime = strtotime($input2);
        $InitialTime = date(' H:i:s' , $starttime);
        $EndTime = date(' H:i:s' , $endtime);
        $UserId = $request->session()->get('userid');
        $timaestamp = date("Y-m-d H:i:s");
        $data['SHIFT_NAME'] = $shifts_name;
        $data['START_TIME'] = $InitialTime;
        $data['END_TIME'] = $EndTime;
        $data['CREATED_BY'] = $UserId;
        $data['CREATED_AT'] = $timaestamp;
        $data['FLAG'] = 'Show';
        $details = $model->addShifts($data);
        return $details;
        // print_r($data);
    }

    /**
     * Display the specified Shifts.
     *
     * @param  int  $id of The The Shifts
     * @return \Illuminate\Http\Response View Page Of Shifts
     */
    public function editShifts($id)
    {
        $id = Crypt::decrypt($id);
        $shiftsdetails = DB::table('mst_tbl_shifts')->where(['Flag' => 'Show', 'SHIFT_ID' => $id])->get()->first();
        $d = $shiftsdetails->START_TIME;
        $d2 = $shiftsdetails->END_TIME;
        $t1 = explode(':', $d);
        $t2 = explode(':', $d2);
        $startTime = $t1[0] . ':' . $t1[1];
        $endTimne = $t2[0] . ':' . $t2[1];
        $shiftDetais['SHIFT_NAME'] = $shiftsdetails->SHIFT_NAME;
        $shiftDetais['START_TIME'] = $shiftsdetails->START_TIME;
        $shiftDetais['END_TIME'] = $shiftsdetails->END_TIME;
        // $t1 = implode(" " , $shiftsdetails->START_TIME);
        // $t2 = implode(" " , $shiftsdetails->END_TIME);
        // print_r($shiftDetais);
        return view('Admin.editShifts', compact('shiftDetais'));
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
     * Update the specified Shifts  in storage.
     *
     * @param  \Illuminate\Http\Request  $request Data To be Updated
     * @param  int  $id Which To be Updated
     * @return \Illuminate\Http\Response Message That Shifts Updated
     */
    public function updateShifts(Request $request, $id)
    {
        $model = new mainModel();
        // $id = Crypt::decrypt($id);
        $shifts_name = $request->shifts_name;
        $input = $request->InitialTime;
        $input2 = $request->EndTime;
        $starttime = strtotime($input);
        $endtime = strtotime($input2);
        $InitialTime = date(' H:i:s' , $starttime);
        $EndTime = date(' H:i:s' , $endtime);
        $SHIFT_ID =Crypt::decrypt($id);
        $UserId = $request->session()->get('userid');
        $timaestamp = date("Y-m-d H:i:s");
        $data['SHIFT_NAME'] = $shifts_name;
        $data['START_TIME'] = $InitialTime;
        $data['END_TIME'] = $EndTime;
        $data['UPDATED_BY'] = $UserId;
        $data['UPDATED_AT'] = $timaestamp;
        $response = $model->updateShifts($data, $SHIFT_ID);
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteShifts($id)
    {
        $model = new mainModel();
        $userid = session()->get('userid');
        $timaestamp = date("Y-m-d H:i:s");
        $id = Crypt::decrypt($id);
        $data['UPDATED_BY'] = $userid;
        $data['UPDATED_AT'] = $timaestamp;
        $data['FLAG'] = 'Delete';
        $response = $model->deleteShifts($id, $data);
        return $response;
    }
}
