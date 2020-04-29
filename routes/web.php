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
        Route::post('/createclient', 'SuperAdmin\NavbarController@createClient')->name('/createclient');;
        Route::get('Superadmin/user' , 'SuperAdmin\NavbarController@index')->name('Superadmin/user');;
    });
    Route::group(['middleware' => ['admin']],function (){
        Route::get('Admin/admindahboard' , 'Admin\DashboardController@index')->name('Admin/admindahboard');
        Route::post('/addatendence', 'Admin\DashboardController@SaveAtdendence')->name('/addatendence');;
        Route:: post('/getatendence', 'Admin\DashboardController@getAttendence')->name('/getatendence');;
    });



});
Route::get('Admin/adduser', function () {
    return view('Admin.Add_Userr');
});


///////////project master///////////////////////////////////
Route::get('project/showdata','Admin\ProjectMasterController@index')->name('project/showdata');
Route::get('project/create','Admin\ProjectMasterController@create')->name('project/create');
Route::post('project/addproject','Admin\ProjectMasterController@addproject')->name('project/addproject');
