<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\mainModel;
use Illuminate\Support\Facades\Crypt;

class LevelOrGradeControlller extends Controller
{
    /**
     * Display a listing of the Grade Or levels.
     *
     * @return \Illuminate\Http\Response
     */
    public function listofSystems()
    {
        $message ='';
       if (DB::getSchemaBuilder()->hasTable('mst_tbl_grade'))
       {
           $message ='Grade';
       } else {
           $message ='Levels';
       }
      // DB::table('')->
      //print_r("hiiii");
        return view('Admin.ShowallLevelsOrGrade', compact('message'));
    }

    /**
     * It Will Give The All Records Of The Levels
     *
     * @return \Illuminate\Http\Response return The Response as Data Table
     */
    public function show_levels_datatbl()
    {
        $model = new mainModel();
        $responese = $model->showAllData('mst_tbl_levels');
        return Datatables::of($responese)
        ->addIndexColumn()
        ->addColumn('action', function ($query) {
            $id = Crypt::encrypt($query->LEVEL_ID);
            return '<a href="'.action('Admin\LevelOrGradeControlller@editLeveles', Crypt::encrypt($query->LEVEL_ID)).'" id="userform'.$query->LEVEL_ID.'"><img src="/asset/css/zondicons/zondicons/edit-pencil.svg"  style="width: 15px;margin-right: 20px;    filter: invert(0.5);" alt=""></a>
                <a href="javascript:void(0)" onclick="deleteLeveles('."'$id'".',event)"><img src="/asset/css/zondicons/zondicons/close.svg"
                style="width: 15px;    filter: invert(0.5);" alt=""></a>
                ';
        })
        ->rawColumns(['action'])
       ->make(true);
    }
    /**
     * Show The Form To Crete The Level
     *
     * @return \Illuminate\Http\Response return The View page For The Adding Levels
     */
    public function AddLevels()
    {
        return view('Admin.AddLeveles');
    }
    /**
     * Store a newly created Leveles in Database.
     *
     * @param  \Illuminate\Http\Request  $request All Data Of The Leveles to Create
     * @return \Illuminate\Http\Response Message That Leveles Are Created Or Not.
     */
    public function craeteLeveles(Request $request)
    {
        $model = new mainModel();
        $level_name = $request->level_name;
        $description = $request->description;

        $UserId = $request->session()->get('userid');
        $timaestamp = date("Y-m-d H:i:s");
        $data['LEVEL_NAME'] = $level_name;
        $data['LEVEL_DESCRIPTION'] = $description;
        $data['CREATED_BY'] = $UserId;
        $data['CREATED_AT'] = $timaestamp;
        $data['FLAG'] = 'Show';
        $response = $model->addLeveles($data);
        return $response;
    }

    /**
     * Display the specified Levele Details.
     *
     * @param  int  $id of The Level That To Be Update
     * @return \Illuminate\Http\Response Return The View Page.
     */
    public function editLeveles($id)
    {
        $id = Crypt::decrypt($id);
        $leveles = DB::table('mst_tbl_levels')->where(['Flag' => 'Show', 'LEVEL_ID' => $id])->get()->first();
        return view('Admin.editLeveles', compact('leveles'));
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
     * Update the specified Leveles in Database.
     *
     * @param  \Illuminate\Http\Request  $request data To Be Updated
     * @param  int  $id Which Id To Be Update
     * @return \Illuminate\Http\Response Message That Leveles Updated Or Not
     */
    public function updateLeveles(Request $request, $id)
    {
        $model = new mainModel();
        // $id = Crypt::decrypt($id);
        $level_name = $request->level_name;
        $description = $request->description;
        $levelid =Crypt::decrypt($id);
        $UserId = $request->session()->get('userid');
        $timaestamp = date("Y-m-d H:i:s");
        $data['LEVEL_NAME'] = $level_name;
        $data['LEVEL_DESCRIPTION'] = $description;
        $data['UPDATED_BY'] = $UserId;
        $data['UPDATED_AT'] = $timaestamp;
        $response = $model->updateLevel($data, $levelid);
        return $response;
    }

    /**
     * Remove the specified Level from Database.
     *
     * @param  int  $id of The level To Remove
     * @return \Illuminate\Http\Response Message That levele Is Remove
     */
    public function deleteLevel($id)
    {
        $model = new mainModel();
        $userid = session()->get('userid');
        $timaestamp = date("Y-m-d H:i:s");
        $id = Crypt::decrypt($id);
        $data['UPDATED_BY'] = $userid;
        $data['UPDATED_AT'] = $timaestamp;
        $data['FLAG'] = 'Delete';
        $response = $model->deleteLeveles($id, $data);
        return $response;
    }

    /**
     * It Will Give The All Records Of The Levels
     *
     * @return \Illuminate\Http\Response return The Response as Data Table
     */
    public function show_grade_datatbl()
    {
        $model = new mainModel();
        $responese = $model->showAllData('mst_tbl_grade');
        return Datatables::of($responese)
        ->addIndexColumn()
        ->addColumn('action', function ($query) {
            $id = Crypt::encrypt($query->GRADE_ID);
            return '<a href="'.action('Admin\LevelOrGradeControlller@editGrades', Crypt::encrypt($query->GRADE_ID)).'" id="userform'.$query->GRADE_ID.'"><img src="/asset/css/zondicons/zondicons/edit-pencil.svg"  style="width: 15px;margin-right: 20px;    filter: invert(0.5);" alt=""></a>
                <a href="javascript:void(0)" onclick="deleteGrade('."'$id'".',event)"><img src="/asset/css/zondicons/zondicons/close.svg"
                style="width: 15px;    filter: invert(0.5);" alt=""></a>
                ';
        })
        ->rawColumns(['action'])
       ->make(true);
    }

    /**
     * Show The Form To Crete The Grade
     *
     * @return \Illuminate\Http\Response return The View page For The Adding Grade
     */
    public function AddGrade()
    {
        return view('Admin.AddGrade');
    }

    /**
     * Store a newly created Grade  in Database.
     *
     * @param  \Illuminate\Http\Request  $request All Data Of The Grade to Create
     * @return \Illuminate\Http\Response Message That Grade Are Created Or Not.
     */
    public function craeteGrades(Request $request)
    {
        $model = new mainModel();
        $grade_name = $request->grade_name;
        $description = $request->description;

        $UserId = $request->session()->get('userid');
        $timaestamp = date("Y-m-d H:i:s");
        $data['GRADE_NAME'] = $grade_name;
        $data['GRADE_DESCRIPTION'] = $description;
        $data['CREATED_BY'] = $UserId;
        $data['CREATED_AT'] = $timaestamp;
        $data['FLAG'] = 'Show';
        $response = $model->addGrades($data);
        return $response;
    }
    /**
     * Display the specified Levele Details.
     *
     * @param  int  $id of The Level That To Be Update
     * @return \Illuminate\Http\Response Return The View Page.
     */
    public function editGrades($id)
    {
        $id = Crypt::decrypt($id);
        $grades = DB::table('mst_tbl_grade')->where(['Flag' => 'Show', 'GRADE_ID' => $id])->get()->first();
        return view('Admin.editGrades' , compact('grades'));
        // return view('Admin.editLeveles');
    }
    /**
     * Update the specified Grade in Database.
     *
     * @param  \Illuminate\Http\Request  $request data To Be Updated
     * @param  int  $id Which Id To Be Update
     * @return \Illuminate\Http\Response Message That Grade Updated Or Not
     */
    public function updateGrades(Request $request, $id)
    {
        $model = new mainModel();
        // $id = Crypt::decrypt($id);
        $grade_name = $request->grade_name;
        $description = $request->description;
        $gradeid =Crypt::decrypt($id);
        $UserId = $request->session()->get('userid');
        $timaestamp = date("Y-m-d H:i:s");
        $data['GRADE_NAME'] = $grade_name;
        $data['GRADE_DESCRIPTION'] = $description;
        $data['UPDATED_BY'] = $UserId;
        $data['UPDATED_AT'] = $timaestamp;
        $response = $model->updateGrade($data, $gradeid);
        return $response;
    }
    /**
     * Remove the specified Grade from Database.
     *
     * @param  int  $id of The Grade To Remove
     * @return \Illuminate\Http\Response Message That Grade Is Remove
     */
    public function deleteGrade($id)
    {
        $model = new mainModel();
        $userid = session()->get('userid');
        $timaestamp = date("Y-m-d H:i:s");
        $id = Crypt::decrypt($id);
        $data['UPDATED_BY'] = $userid;
        $data['UPDATED_AT'] = $timaestamp;
        $data['FLAG'] = 'Delete';
        $response = $model->deleteGrade($id, $data);
        return $response;
    }


}
