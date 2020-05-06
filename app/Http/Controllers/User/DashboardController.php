<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Show The DashBorad Page Vivew
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('User.dashboard');
    }
}
