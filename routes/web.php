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
Route::get('/', 'Authtentication\LoginController@index')->name('/login');

// Authentication of User
Route::post('/checklogin', 'Authtentication\LoginController@CheckLogin');

// Authentication of User
Route::get('/logout', 'Authtentication\LoginController@Logout');

Route::get('changePassword/{id}', 'DefaultController@ShowChangePassword')->name('/changePassword');

Route::post('updatePassword/{id}', 'DefaultController@updatePassword')->name('/updatePassword');

/** This Applying Midle Ware On The ROutes */
Route::group(['middleware' => ['athuthenticate']], function () {

    Route::group(['middleware' => ['superadmin']], function () {
        Route::get('SuperAdmin/superadmindahboard', 'SuperAdmin\DashboardController@index')->name('SuperAdmin/superadmindahboard');
        Route::get('Superadmin/client', 'SuperAdmin\NavbarController@index')->name('Superadmin/client');
        Route::post('/createclient', 'SuperAdmin\NavbarController@createClient')->name('/createclient');
        Route::get('Superadmin/user', 'SuperAdmin\NavbarController@index')->name('Superadmin/user');
        Route::get('SuperAdmin/Module', 'SuperAdmin\NavbarController@showModule')->name('SuperAdmin/Module');
        Route::get('SuperAdmin/Show_Module', 'SuperAdmin\NavbarController@Show_Module')->name('SuperAdmin/Show_Module');
        Route::post('/show_module_datatbl', 'SuperAdmin\NavbarController@show_module_datatbl')->name('show_module_datatbl');
        Route::get('user/ShowEditModule/{id}', 'SuperAdmin\NavbarController@ShowEditModule')->name('user/ShowEditModule');
        Route::post('/updatemodule', 'SuperAdmin\NavbarController@updateModule')->name('/updatemodule');
        Route::get('user/showAllModule/{id}', 'SuperAdmin\TableController@showAllModule')->name('user/showAllModule');
        Route::post('/updateModules', 'SuperAdmin\TableController@AssinedMOdule')->name('updateModules');

        /////////////////////           Client Operation     ///////////////////////////////////////////////////////////////////////////////
        Route::get('SuperAdmin/Show_client', 'SuperAdmin\TableController@Show_client')->name('SuperAdmin/Show_client');
        Route::get('Superadmin/show_Edit_client', 'SuperAdmin\TableController@show_Edit_client')->name('SuperAdmin/show_Edit_client');
        Route::post('/show_client_datatbl', 'SuperAdmin\TableController@show_client_datatbl')->name('show_client_datatbl');
        Route::post('/updateclient', 'SuperAdmin\TableController@updateclient')->name('/updateclient');
        Route::get('deleteModule/{id}', 'SuperAdmin\NavbarController@destroy')->name('deleteModule');
        Route::get('user/delete/{id}', 'SuperAdmin\TableController@destroy')->name('user/delete');
        Route::get('user/edit/{id}', 'SuperAdmin\TableController@edit')->name('user/edit');
        /** Add Module */
        Route::post('/addmodule', 'SuperAdmin\NavbarController@AddModule')->name('/addmodule');
        Route::get('/showAllPoliyces/{id}', 'SuperAdmin\TableController@showAllPoliycyes')->name('/showAllPoliyces');
        // Route::get('SuperAdmin/Poliyces' , 'SuperAdmin\PolicyesController@index')->name('SuperAdmin/Poliyces');
        Route::post('/updatepoliyices', 'SuperAdmin\PolicyesController@updatepoliyices')->name('/updatepoliyices');

        ///////////////////////////////////////////////////////////////////////////////////
    });
    Route::group(['middleware' => ['admin']], function () {
        Route::get('Admin/admindahboard', 'Admin\DashboardController@index')->name('Admin/admindahboard');
        ///////////project master///////////////////////////////////

        //////////////////////////////////// APPLY LEAVE ///////////////////////////////////////////////////////////////////////////////////////
        Route::get('/leave_details', 'Admin\ApplyleaveController@leave_details')->name('/leave_details');
        Route::get('/Leave_manage', 'Admin\ApplyleaveController@Leave_manage')->name('/Leave_manage');
        Route::post('/show_pending_leave_request', 'Admin\ApplyleaveController@show_pending_leave_request')->name('/show_pending_leave_request');
        Route::post('/show_leave_type', 'Admin\ApplyleaveController@show_leave_type')->name('/show_leave_type');
        Route::get('decline_request/{id}', 'Admin\ApplyleaveController@decline_request')->name('decline_request');
        Route::get('Approve_request/{id}', 'Admin\ApplyleaveController@Approve_request')->name('Approve_request/approve');
        Route::post('/insert_leave_manage', 'Admin\ApplyleaveController@insert_leave_manage')->name('/insert_leave_manage');
        Route::post('/update_leave_manage_data', 'Admin\ApplyleaveController@update_leave_manage_data')->name('/update_leave_manage_data');
        Route::post('/update_leave_manage_code', 'Admin\ApplyleaveController@update_leave_manage_code')->name('/update_leave_manage_code');
        Route::post('/approve_leave_manage_data', 'Admin\ApplyleaveController@approve_leave_manage_data')->name('/approve_leave_manage_data');
        Route::post('/approve_leave_with_user_id', 'Admin\ApplyleaveController@approve_leave_with_user_id')->name('/approve_leave_with_user_id');
        Route::get('edit_leavetype/{id}', 'Admin\ApplyleaveController@edit_leavetype')->name('edit_leavetype');
        Route::get('delete_leavetype/{id}', 'Admin\ApplyleaveController@delete_leavetype')->name('delete_leavetype/delete');

        //////////////////////// PROJECT MASTER ///////////////////////////////////////////////////////////////////////////////////////////////
        Route::get('project/showdata', 'Admin\ProjectMasterController@index')->name('project/showdata');
        Route::get('project/create', 'Admin\ProjectMasterController@create')->name('project/create');
        Route::post('project/addproject', 'Admin\ProjectMasterController@addproject')->name('project/addproject');
        Route::post('/show_all_data', 'Admin\ProjectMasterController@show_all_project')->name('show_all_data');
        Route::get('project/editproject/{projectid}', 'Admin\ProjectMasterController@edit_project')->name('project/editproject');
        Route::post('/update_all_data', 'Admin\ProjectMasterController@update_project')->name('update_all_data');
        Route::get('deleted_project/{id}', 'Admin\ProjectMasterController@deleted_project')->name('deleted_project');

        //////////////////////// ADMIN ROLE ///////////////////////////////////////////////////////////////////////////////////////////////////
        Route::get('Admin/role', 'Admin\RoleController@ShowRoles')->name('Admin/role');
        Route::get('Admin/Add_roles', 'Admin\RoleController@ShowAddRoles')->name('Admin/Add_roles');
        Route::post('/craeteRoles', 'Admin\RoleController@addRoles')->name('/craeteRoles');
        Route::post('/show_role_datatbl', 'Admin\RoleController@allRecodrds')->name('/show_role_datatbl');
        Route::get('user/showAllClientModule/{id}', 'Admin\RoleController@showAllClientModule')->name('user/showAllClientModule');
        Route::get('/editRoleName/{id}', 'Admin\RoleController@editRoleName')->name('/editRoleName');
        Route::post('/updateRoleName', 'Admin\RoleController@updateRoles')->name('/updateRoleName');
        // Route::get('deleteAdminRole/{id}', 'Admin\RoleController@destroy')->name('deleteAdminRole');
        // Route::post('/updateAdminModules', 'Admin\RoleController@AssinedMOdule')->name('updateAdminModules');

        ///////////////////////////////// ADMIN MODULE //////////////////////////////////////////////////////////////////////////////////////////
        Route::get('Admin/Module', 'Admin\ModuleController@showModule')->name('Admin/Module');
        Route::post('/show_admin_module_datatbl', 'Admin\ModuleController@show_module_datatbl')->name('show_admin_module_datatbl');
        Route::get('deleteAdminModule/{id}', 'Admin\ModuleController@destroy')->name('deleteAdminModule');
        Route::get('ShowAdminEditModule/{id}', 'Admin\ModuleController@ShowEditModule')->name('ShowAdminEditModule');
        Route::post('/updateAdminmodule', 'Admin\ModuleController@updateModule')->name('/updateAdminmodule');
        Route::get('deleteAdminRole/{id}', 'Admin\RoleController@destroy')->name('deleteAdminRole');
        Route::post('/updateAdminModules', 'Admin\RoleController@AssinedMOdule')->name('updateAdminModules');
        Route::get('Admin/User', 'Admin\UserController@listofUser')->name('Admin/User');
        Route::post('/show_alluser_datatbl', 'Admin\UserController@show_alluser_datatbl')->name('/show_alluser_datatbl');
        Route::get('Admin/Add_User', 'Admin\UserController@AddUser')->name('Admin/Add_User');
        Route::post('/createUser', 'Admin\UserController@createUser')->name('/createUser');
        Route::get('deletethisUser/{id}', 'Admin\UserController@destroy')->name('deletethisUser');
        Route::get('/editUser/{id}', 'Admin\UserController@editUser')->name('/editUser');
        Route::post('/updateUser', 'Admin\UserController@updateUser')->name('/updateUser');

        ////////////////////////////////// ADMIN DEPARTMENT ///////////////////////////////////////////////////////////////////////////////////
        Route::get('Admin/Departments', 'Admin\DepartmentController@listofDepartments')->name('Admin/Departments');
        Route::post('/show_alldepartment_datatbl', 'Admin\DepartmentController@show_alldepartment_datatbl')->name('/show_alldepartment_datatbl');
        Route::get('Admin/Add_Departments', 'Admin\DepartmentController@AddDepartmentPage')->name('Admin/Add_Departments');
        Route::post('/craeteDepartmemnt', 'Admin\DepartmentController@addDepartments')->name('/craeteDepartmemnt');
        Route::get('/editDepartments/{id}', 'Admin\DepartmentController@editDepartments')->name('/editDepartments');
        Route::post('/updateDepartments', 'Admin\DepartmentController@updateDepartment')->name('/updateDepartments');
        Route::get('deletethisDepartment/{id}', 'Admin\DepartmentController@destroy')->name('deletethisDepartment');

        //////////////////////////////// ADMIN FUNCTION  //////////////////////////////////////////////////////////////////////////////////////
        Route::get('Admin/Functions', 'Admin\FunctionController@listofFunctions')->name('Admin/Functions');
        Route::post('/show_allfunctions_datatbl', 'Admin\FunctionController@show_allfunctions_datatbl')->name('/show_allfunctions_datatbl');
        Route::get('Admin/Add_Functions', 'Admin\FunctionController@AddCreateFunctionPage')->name('Admin/Add_Functions');
        Route::post('/craeteFunctions', 'Admin\FunctionController@addFunctions')->name('/craeteFunctions');
        Route::get('/editFunctions/{id}', 'Admin\FunctionController@editFunctions')->name('/editFunctions');
        Route::post('/updateFunctions', 'Admin\FunctionController@updateFunctions')->name('/updateFunctions');
        Route::get('deletethisFunction/{id}', 'Admin\FunctionController@destroy')->name('deletethisFunction');

        ////////////////////////////// ADMIN DESIGNATION ///////////////////////////////////////////////////////////////////////////////////////
        Route::get('Admin/Designation', 'Admin\DesignationController@listofDesignations')->name('Admin/Designation');
        Route::post('/show_alldesignation_datatbl', 'Admin\DesignationController@show_alldesignation_datatbl')->name('/show_alldesignation_datatbl');
        Route::get('Admin/Add_Designations', 'Admin\DesignationController@AddDesignation')->name('Admin/Add_Designations');
        Route::post('/craeteDesignation', 'Admin\DesignationController@addDesignations')->name('/craeteDesignation');
        Route::get('/editDesignations/{id}', 'Admin\DesignationController@editDesignations')->name('/editFunctions');
        Route::post('/updateDesignation', 'Admin\DesignationController@updateDesignation')->name('/updateDesignation');
        Route::get('deletethisDesignation/{id}', 'Admin\DesignationController@destroy')->name('deletethisDesignation');

        ///////////////////////////////// ADMIN LEVEL-GRADE ///////////////////////////////////////////////////////////////////////////////////
        Route::get('Admin/LevelsorGrade', 'Admin\LevelOrGradeControlller@listofSystems')->name('Admin/LevelsorGrade');

        // Get Datatable of The Level Records
        Route::post('/show_levels_datatbl', 'Admin\LevelOrGradeControlller@show_levels_datatbl')->name('/show_levels_datatbl');

        // Show the Form For The Add Level
        Route::get('Admin/Levels', 'Admin\LevelOrGradeControlller@AddLevels')->name('Admin/Levels');

        // Save The Leveles Records In The Data Base
        Route::post('/craeteLeveles', 'Admin\LevelOrGradeControlller@craeteLeveles')->name('/craeteLeveles');

        // Show The Edit Page Of The Leveles
        Route::get('/editLeveles/{id}', 'Admin\LevelOrGradeControlller@editLeveles')->name('/editLeveles');

        // Update The Edit Page Of The Leveles
        Route::post('/updateLeveles/{id}', 'Admin\LevelOrGradeControlller@updateLeveles')->name('/updateLeveles');

        // Delete The leveles
        Route::get('deletethisLevel/{id}', 'Admin\LevelOrGradeControlller@deleteLevel')->name('deletethisLevel');

        // Get Datatable of The Level Records
        Route::post('/show_grade_datatbl', 'Admin\LevelOrGradeControlller@show_grade_datatbl')->name('/show_grade_datatbl');

        // Show the Form For The Add Grade
        Route::get('Admin/Grade', 'Admin\LevelOrGradeControlller@AddGrade')->name('Admin/Grade');

        // Save The Leveles Records In The Data Base
        Route::post('/craeteGrades', 'Admin\LevelOrGradeControlller@craeteGrades')->name('/craeteGrades');

        // Show The Edit Page Of The Grade
        Route::get('/editGrades/{id}', 'Admin\LevelOrGradeControlller@editGrades')->name('/editGrades');

        // Update The Edit Page Of The Leveles
        Route::post('/updateGrades/{id}', 'Admin\LevelOrGradeControlller@updateGrades')->name('/updateGrades');

        // Delete The Grade
        Route::get('deletethisGrade/{id}', 'Admin\LevelOrGradeControlller@deleteGrade')->name('deletethisGrade');

        // For Geting Rolmangers Name
        Route::post('/getUsers', 'DefaultController@getUserName');
        // For Geting Rolmangers Name
        Route::post('/getDepartments', 'DefaultController@getDepartments');

        ///////////////////////// TIME SHEET REPORT ///////////////////////////////////////////////////////////////////////////////////////////
        Route::get('timesheet/showreport', 'Admin\TimesheetReportController@index')->name('timesheet/showreport');
        Route::post('timesheet/getcsvdata', 'Admin\TimesheetReportController@getcsvdata')->name('timesheet/getcsvdata');
        Route::get('/show_all_tsreport', 'Admin\TimesheetReportController@show_all_tsreport')->name('/show_all_tsreport');
        Route::post('/show_all_tsdata', 'Admin\TimesheetReportController@show_all_tsdata')->name('/show_all_tsdata');

        //////////////////////////////////// ADMIN CLIENT /////////////////////////////////////////////////////////////////////////////////////
        Route::get('/showclient', 'Admin\AdminClientController@index')->name('/showclient');
        Route::get('/show_add_client', 'Admin\AdminClientController@showadddata')->name('/show_add_client');
        Route::post('/add_client_data', 'Admin\AdminClientController@add_client_data')->name('/add_client_data');
        Route::post('/show_all_client', 'Admin\AdminClientController@show_all_client')->name('/show_all_client');
        Route::get('/edit_all_client/{ADMINCLIENTID}', 'Admin\AdminClientController@edit_all_client')->name('/edit_all_client');
        Route::post('/update_client', 'Admin\AdminClientController@update_client')->name('/update_client');
        Route::get('deleted_client/{id}', 'Admin\AdminClientController@deleted_client')->name('/deleted_client');
        //////////////////////////////////////////////////////////////////////////

        // Show All Shifts Craeteed.
        Route::get('Admin/Shifts', 'Admin\AddShiftsController@listofShits')->name('Admin/Shifts');

        // Get Datatable of The Shifts Records
        Route::post('/show_shifts_datatbl', 'Admin\AddShiftsController@show_shifts_datatbl')->name('/show_shifts_datatbl');

        // Show the Form For The Add Shifts
        Route::get('Admin/addShifts', 'Admin\AddShiftsController@AddShifts')->name('Admin/addShifts');

        // Save The Leveles Records In The Data Base
        Route::post('/craeteShifts', 'Admin\AddShiftsController@craeteShifts')->name('/craeteShifts');

        // Show The Edit Page Of The Grade
        Route::get('/editShifts/{id}', 'Admin\AddShiftsController@editShifts')->name('/editShifts');

        // Update The Edit Page Of The Leveles
        Route::post('/updateShifts/{id}', 'Admin\AddShiftsController@updateShifts')->name('/updateShifts');

        // Delete The leveles
        Route::get('deletethisShifts/{id}', 'Admin\AddShiftsController@deleteShifts')->name('deletethisShifts');

        // Get Atendence Records Page
        Route::get('Admin/add_attendance', 'Admin\AttendenceController@showAttendence')->name('Admin/add_attendance');

        // Get All Atendence Of Records
        Route::post('/showallAttendence', 'Admin\AttendenceController@show_atendence_datatbl')->name('showallAttendence');

        // Show the Form For The Create Atendence
        Route::get('Admin/Create', 'Admin\AttendenceController@CreateAtendence')->name('Admin/Create');

        // Save The Attendence Records In The Data Base
        Route::post('/saveAtttendence', 'Admin\AttendenceController@saveAtttendence')->name('/saveAtttendence');

        // Delete The leveles
        Route::get('deleteAttendence/{id}', 'Admin\AttendenceController@deleteAttendence')->name('deletethisShifts');

        // Show The Edit Page Of The Grade
        Route::get('/editAttendence/{id}', 'Admin\AttendenceController@editAttendence')->name('/editAttendence');

        // Update The Edit Page Of The Leveles
        Route::post('/updateInTime/{id}', 'Admin\AttendenceController@updateTimes')->name('/updateInTime');

        // Show The Edit Page Of The Grade
        Route::get('/editoutAttendence/{id}', 'Admin\AttendenceController@editoutAttendence')->name('/editoutAttendence');

        // Update The Edit Page Of The Leveles
        Route::post('/updateoutTime/{id}', 'Admin\AttendenceController@updateOutTimes')->name('/updateoutTime');



    });

    /* Route::group(['middleware' => ['user']], function () {
        Route::get('User/dashboard', 'User\DashboardController@index')->name('User/dashboard');

        Route::post('/addatendence', 'Admin\DashboardController@SaveAtdendence')->name('/addatendence');
        Route::post('/getatendence', 'Admin\DashboardController@getAttendence')->name('/getatendence');
        Route::post('/leaveatendence', 'Admin\DashboardController@leaveAttendence')->name('/leaveatendence');
        /////////////////////time sheet//////////////////////////////
        Route::get('timesheet/showdata', 'Admin\TimeSheetController@index')->name('timesheet/showdata');
        Route::post('timesheet/createdata', 'Admin\TimeSheetController@add_timesheet')->name('timesheet/createdata');
        Route::post('/show_all_timesheet', 'Admin\TimeSheetController@show_all_timesheet')->name('/show_all_timesheet');
        Route::post('/timesheet_get_data', 'Admin\TimeSheetController@timesheet_get_data')->name('/timesheet_get_data');
        Route::post('/update_timesheet', 'Admin\TimeSheetController@update_timesheet')->name('/update_timesheet');
        Route::get('timesheet/showreport', 'Admin\TimesheetReportController@index')->name('timesheet/showreport');
        Route::post('timesheet/getcsvdata', 'Admin\TimesheetReportController@getcsvdata')->name('timesheet/getcsvdata');

    });*/
    Route::group(['middleware' => ['user']], function () {

        /////////////////////////     USer Creation     ////////////////////////////////////////////////////////////////////////////////////////
        Route::get('/User_Creation', 'Admin\UserController@User_Creation')->name('/User_Creation');

        //////////////////////////// USER DASHBOARD ////////////////////////////////////////////////////////////////////////////////////////////
        Route::get('User/dashboard', 'User\DashboardController@index')->name('User/dashboard');
        Route::post('/addatendence', 'Admin\DashboardController@SaveAtdendence')->name('/addatendence');
        Route::post('/getatendence', 'Admin\DashboardController@getAttendence')->name('/getatendence');
        Route::post('/leaveatendence', 'Admin\DashboardController@leaveAttendence')->name('/leaveatendence');

        ///////////////////// USER TIME SHEET //////////////////////////////////////////////////////////////////////////////////////////////////
        Route::get('timesheet/showdata', 'Admin\TimeSheetController@index')->name('timesheet/showdata');
        Route::post('timesheet/createdata', 'Admin\TimeSheetController@add_timesheet')->name('timesheet/createdata');
        Route::post('/show_all_timesheet', 'Admin\TimeSheetController@show_all_timesheet')->name('/show_all_timesheet');
        Route::post('/timesheet_get_data', 'Admin\TimeSheetController@timesheet_get_data')->name('/timesheet_get_data');
        Route::post('/update_timesheet', 'Admin\TimeSheetController@update_timesheet')->name('/update_timesheet');
        Route::get('timesheet/showreport', 'Admin\TimesheetReportController@index')->name('timesheet/showreport');
        Route::post('timesheet/getcsvdata', 'Admin\TimesheetReportController@getcsvdata')->name('timesheet/getcsvdata');

        ////////////////////////////// USER APPLY LEAVE ////////////////////////////////////////////////////////////////////////////////////////
        Route::get('/applyleave', 'Admin\ApplyleaveController@applyleave')->name('/applyleave');
        Route::post('/insert_applyleave', 'Admin\ApplyleaveController@insert_applyleave')->name('/insert_applyleave');
        Route::get('User/show_atendence', 'User\DashboardController@showAttendence')->name('User/show_atendence');

        // Get Datatable of The Shifts Records
        Route::post('/show_allatendence_datatbl', 'User\DashboardController@show_all_atendence')->name('/show_allatendence_datatbl');


        Route::get('/User/Chat_UI', 'User\Chat_Controller@Chat_UI')->name('/Chat_UI');
        Route::get('/User/getmessage/{id}', 'User\Chat_Controller@getMessage')->name('getmessage');
        Route::post('/User/seenmsg/{id}', 'User\Chat_Controller@seenmsg')->name('seenmsg');
        Route::get('/User/getreciepent_message/{id}', 'User\Chat_Controller@getreciepent_message')->name('getreciepent_message');

        Route::post('/User/sendmessage', 'User\Chat_Controller@sendMessage');
        // Route::get('/User/get_chat_username/{id}', 'User\Chat_Controller@get_chat_username')->name('get_chat_username');
    });
});
Route::get('Admin/adduser', function () {
    return view('Admin.Add_Userr');
});
