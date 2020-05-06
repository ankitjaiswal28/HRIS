<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Route;

// Default Browser
Route::get('/' , 'Authtentication\LoginController@index');

// Authentication of User
Route::post('/checklogin', 'Authtentication\LoginController@CheckLogin');

// Authentication of User
Route::get('/logout', 'Authtentication\LoginController@Logout');

/** This Applying Midle Ware On The ROutes */
Route::group(['middleware' => ['athuthenticate']],function () {
    Route::group(['middleware' => ['superadmin']],function (){
        Route::get('SuperAdmin/superadmindahboard' , 'SuperAdmin\DashboardController@index')->name('SuperAdmin/superadmindahboard');
        Route::get('Superadmin/client' , 'SuperAdmin\NavbarController@index')->name('Superadmin/client');
        Route::post('/createclient', 'SuperAdmin\NavbarController@createClient')->name('/createclient');
        Route::get('Superadmin/user' , 'SuperAdmin\NavbarController@index')->name('Superadmin/user');

        /////////////////////          Client Operation     ////////////////////////////////
        Route::get('SuperAdmin/Show_client' , 'SuperAdmin\TableController@Show_client')->name('SuperAdmin/Show_client');

        Route::get('Superadmin/show_Edit_client' , 'SuperAdmin\TableController@show_Edit_client')->name('SuperAdmin/show_Edit_client');
        Route::post('/show_client_datatbl' , 'SuperAdmin\TableController@show_client_datatbl')->name('show_client_datatbl');
        Route::post('/updateclient', 'SuperAdmin\TableController@updateclient')->name('/updateclient');
        Route::get('user/delete/{id}','SuperAdmin\TableController@destroy')->name('user/delete');
        Route::get('user/edit/{id}','SuperAdmin\TableController@edit')->name('user/edit');
        ///////////////////////////////////////////////////////////////////////////////////
    });
    Route::group(['middleware' => ['admin']],function (){
        Route::get('Admin/admindahboard' , 'Admin\DashboardController@index')->name('Admin/admindahboard');
        Route::post('/addatendence', 'Admin\DashboardController@SaveAtdendence')->name('/addatendence');
        Route:: post('/getatendence', 'Admin\DashboardController@getAttendence')->name('/getatendence');
        Route:: post('/leaveatendence', 'Admin\DashboardController@leaveAttendence')->name('/leaveatendence');
        Route:: get('/applyleave', 'Admin\ApplyleaveController@applyleave')->name('/applyleave');
        Route::post('/insert_applyleave', 'Admin\ApplyleaveController@insert_applyleave')->name('/insert_applyleave');
        Route:: get('/Show_timesheet', 'Admin\TimesheetController@Show_timesheet')->name('/Show_timesheet');
        Route:: get('/leave_details', 'Admin\ApplyleaveController@leave_details')->name('/leave_details');
        Route:: get('/Leave_manage', 'Admin\ApplyleaveController@Leave_manage')->name('/Leave_manage');
        Route::post('/show_pending_leave_request' , 'Admin\ApplyleaveController@show_pending_leave_request')->name('/show_pending_leave_request');
        Route::post('/show_leave_type' , 'Admin\ApplyleaveController@show_leave_type')->name('/show_leave_type');
        Route::get('decline_request/{id}','Admin\ApplyleaveController@decline_request')->name('decline_request');
        Route::get('Approve_request/{id}','Admin\ApplyleaveController@Approve_request')->name('Approve_request/approve');
        Route:: post('/insert_leave_manage', 'Admin\ApplyleaveController@insert_leave_manage')->name('/insert_leave_manage');
        Route:: post('/update_leave_manage_data', 'Admin\ApplyleaveController@update_leave_manage_data')->name('/update_leave_manage_data');
        Route:: post('/update_leave_manage_code', 'Admin\ApplyleaveController@update_leave_manage_code')->name('/update_leave_manage_code');
        Route:: post('/approve_leave_manage_data', 'Admin\ApplyleaveController@approve_leave_manage_data')->name('/approve_leave_manage_data');
        Route:: post('/approve_leave_with_user_id', 'Admin\ApplyleaveController@approve_leave_with_user_id')->name('/approve_leave_with_user_id');





        Route::get('edit_leavetype/{id}','Admin\ApplyleaveController@edit_leavetype')->name('edit_leavetype');
        Route::get('delete_leavetype/{id}','Admin\ApplyleaveController@delete_leavetype')->name('delete_leavetype/delete');



    });



});
Route::get('Admin/adduser', function () {
    return view('Admin.Add_Userr');
});
