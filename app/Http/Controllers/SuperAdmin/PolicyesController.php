<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\mainModel;

class PolicyesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Update  a the  poliycies  in Database in The Client.
     *
     * @param  \Illuminate\Http\Request  $request All Poliycies For The Client
     * @return \Illuminate\Http\Response Return The response What Poliycy Is Difine
     */
    public function updatepoliyices(Request $request)
    {
        $details = new mainModel();
        $ClientId = $request->ClientId;
        $gradeorlevelvalue  = $request->gradeorlevelvalue;
        $orignaldatabase = $request->session()->get('databasename');
        $timaestamp = date("Y-m-d H:i:s");
        $message = '';
        if ($gradeorlevelvalue != null) {
            $data['GRADEORLEVEL'] = $gradeorlevelvalue;
            $data['updated_at'] = $timaestamp;
            $retnMsg = $details->AddPolicyes($data, $ClientId,$orignaldatabase);
            // print_r($retnMsg);exit;
            if ($retnMsg == 'LevelDeleted') {
                $message = 'Grades System Added';
            } else if($retnMsg == 'GradeDeleted') {
                $message = 'Levels Syestem Added';

            } else {
                $message = 'Error';
            }
        //     print_r($retnMsg);
        //   //  print_r($gradeorlevelvalue);
        } else {
            $message = "Not Allowed";
        }
        return $message;
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
