<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function Superadmin_index(){
        return view('SuperAdmin.dashboard');
    }
    public function Superadmin_Module(){
        return view('SuperAdmin.module');
    }
    public function Superadmin_role(){
        return view('SuperAdmin.role');
    }
    public function Superadmin_user(){
        return view('SuperAdmin.User');
    }
    public function Superadmin_client(){
        return view('SuperAdmin.Client');
    }
    public function Superadmin_add_module(){
        return view('SuperAdmin.Add_Module');
    }
    public function Superadmin_user_submit(){
        return view('SuperAdmin.Add_User_Submit');
    }


    public function MyAccount(){
        return view('User.my_account');
    }
}
