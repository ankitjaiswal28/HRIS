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
        Route::get('SuperAdmin/Module' , 'SuperAdmin\NavbarController@showModule')->name('SuperAdmin/Module');
        Route::get('SuperAdmin/Show_Module' , 'SuperAdmin\NavbarController@Show_Module')->name('SuperAdmin/Show_Module');
        Route::post('/show_module_datatbl' , 'SuperAdmin\NavbarController@show_module_datatbl')->name('show_module_datatbl');
        Route::get('user/ShowEditModule/{id}','SuperAdmin\NavbarController@ShowEditModule')->name('user/ShowEditModule');
        Route::post('/updatemodule', 'SuperAdmin\NavbarController@updateModule')->name('/updatemodule');
        Route::get('user/showAllModule/{id}','SuperAdmin\TableController@showAllModule')->name('user/showAllModule');
        Route::post('/updateModules' , 'SuperAdmin\TableController@AssinedMOdule')->name('updateModules');

        /////////////////////           Client Operation     ////////////////////////////////
        Route::get('SuperAdmin/Show_client' , 'SuperAdmin\TableController@Show_client')->name('SuperAdmin/Show_client');

        Route::get('Superadmin/show_Edit_client' , 'SuperAdmin\TableController@show_Edit_client')->name('SuperAdmin/show_Edit_client');
        Route::post('/show_client_datatbl' , 'SuperAdmin\TableController@show_client_datatbl')->name('show_client_datatbl');
        Route::post('/updateclient', 'SuperAdmin\TableController@updateclient')->name('/updateclient');
        Route::get('user/delete/{id}','SuperAdmin\TableController@destroy')->name('user/delete');
        Route::get('user/edit/{id}','SuperAdmin\TableController@edit')->name('user/edit');
        /** Add Module */
        Route::post('/addmodule', 'SuperAdmin\NavbarController@AddModule')->name('/addmodule');
        ///////////////////////////////////////////////////////////////////////////////////
    });
    Route::group(['middleware' => ['admin']],function (){
        Route::get('Admin/admindahboard' , 'Admin\DashboardController@index')->name('Admin/admindahboard');
        Route::post('/addatendence', 'Admin\DashboardController@SaveAtdendence')->name('/addatendence');
        Route:: post('/getatendence', 'Admin\DashboardController@getAttendence')->name('/getatendence');
        Route:: post('/leaveatendence', 'Admin\DashboardController@leaveAttendence')->name('/leaveatendence');
    });



});
Route::get('Admin/adduser', function () {
    return view('Admin.Add_Userr');
});
