<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\mainModel;
use Illuminate\Support\Facades\Crypt;

class NavbarController extends Controller
{
    /**
     * Show The View Page For The Client Creation.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('SuperAdmin.Add_Client');
        // return view('SuperAdmin.clientcreation'); Add_Client.blade
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
     * This function is use For The Client
     * Creatrion
     *
     * @param  \Illuminate\Http\Request  $request will Have all Detils For Craeting The Client
     * @return \Illuminate\Http\Response if Clinet Is Created It Will Return Creted.
     */
    public function createClient(Request $request)
    {
        $details = new mainModel();
         $companyname = $request->companyname;
         $adminname = $request->adminname;
         $mobileno = $request->mobileno;
         $email = $request->email;
         $prefix = $request->prefix;
         $pwd = $request->pwd;
         $orignaldatabase = $request->session()->get('databasename');
         $encryptPassword = Crypt::encrypt($pwd);
         $data['companyname'] = $companyname;
         $data['adminname'] = $adminname;
         $data['mobileno'] = $mobileno;
         $data['email'] = $email;
         $data['prefix'] = $prefix;
         $data['pwd'] = $encryptPassword;
         $data['orignaldatabase'] = $orignaldatabase;
        $responsemessg = $details->clientCreation($data);
        // print_r($responsemessg);
        return  $responsemessg;
       // print_r($request);
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
