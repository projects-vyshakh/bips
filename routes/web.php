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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'HomeController@index')->name('home');
Route::any('password/sendPasswordResetLink','Auth\CustomPasswordResetController@sendPasswordResetLink');
Route::any('password/set_password','Auth\CustomPasswordResetController@showSetPassword');
Route::any('password/handleSetNewPassword','Auth\CustomPasswordResetController@handleSetNewPassword');


Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', 'Auth\LoginController@logout');


Route::get('/register-employer', 'Employer\EmployerController@showRegister');
Route::any('/handleRegisterEmployer', 'Employer\EmployerController@handleRegister');

Route::get('/register-employee', 'Employee\EmployeeController@showRegister');
Route::any('/handleRegisterEmployee', 'Employee\EmployeeController@handleRegister');


Route::group([ 'middleware' => ['auth','web','checkroles'], 'prefix'=>'admin'], function () {
    Route::any('/dashboard','Users\UsersController@showDashboard');
    Route::any('/manage-users','Users\UsersController@showManageUsers');
    Route::any('/add-users','Users\UsersController@showAddUser');


    Route::any('/manage-roles','Settings\RolesController@showManageRoles');
    Route::any('/add-roles','Settings\RolesController@showAddRoles');

    Route::any('/manage-permissions','Settings\PermissionController@showManagePermissions');

    Route::any('/manage-workorder','Workorder\WorkorderController@showManageWorkorder');
    Route::any('/add-workorder','Workorder\WorkorderController@showAddWorkorder');
    Route::any('/workordertype','Workorder\WorkorderController@showManageWorkorderType');

    Route::any('/punch','Attendance\AttendanceController@showPunch');
    Route::any('/timesheet','Attendance\AttendanceController@showTimeCards');




    Route::any('/add-files','Uploads\UploadsController@showAddFiles');
    Route::any('/manage-uploads','Uploads\UploadsController@showManageUploads');




});
Route::group([ 'middleware' => ['auth','web'], 'prefix'=>'admin'], function () {
    Route::any('/handleAddUsers','Users\UsersController@handleAddUsers');
    Route::any('/handleAddRoles','Settings\RolesController@handleAddRoles');
    Route::any('/handleAddWorkorder','Workorder\WorkorderController@handleAddWorkorder');


});




//Agents Controller
//---------------------------------------------------------------------------------
Route::group([ 'middleware' => ['auth','web','checkroles'], 'prefix'=>'agent'], function () {
    Route::any('/dashboard','Users\UsersController@showDashboard');
    Route::any('/punch','Attendance\AttendanceController@showPunch');
    Route::any('/timesheet','Attendance\AttendanceController@showTimeCards');
    Route::any('/manage-workorder','Workorder\WorkorderController@showManageWorkorder');
    Route::any('/add-workorder','Workorder\WorkorderController@showAddWorkorder');

    Route::any('/handleAddWorkorder','Workorder\WorkorderController@handleAddWorkorder');

    Route::any('/manage-users','Users\UsersController@showManageUsers');
    Route::any('/add-users','Users\UsersController@showAddUser');


});

Route::group([ 'middleware' => ['auth','web'], 'prefix'=>'agent'], function () {

    //Route::any('/handleClockIn','Attendance\ClockInController@handleClockIn');
    Route::any('/handleClockOut','Attendance\ClockOutController@handleClockOut');


    Route::get('/laravel-send-email', 'Attendance\AttendanceController@mail');

});
//---------------------------------------------------------------------------------




Route::group([ 'middleware' => ['auth','web']], function () {
    Route::any('/handleRegisterTickets','Tickets\TicketsController@handleRegisterTickets');
    Route::any('/handleAddVacancy','Vacancy\VacancyController@handleAddVacancy');
    Route::any('/handleAddAvailability','Availability\AvailabilityController@handleAddAvailability');
    Route::any('/handleAddPayments','Payments\PaymentController@handleAddPayments');
    Route::any('/handleAddFiles','Uploads\UploadsController@handleAddFiles');
//    Route::any('/handleVacancyStatusChange','Vacancy\VacancyController@handleVacancyStatusChange');

    Route::any('/handleAddWorkorder','Workorder\WorkorderController@handleAddWorkorder');
});






//Ajax Requests

Route::group([ 'middleware' => ['auth','web']], function () {
    Route::any('/handleUserDelete','Users\UsersController@handleUserDelete');
    Route::any('/handleRolesDelete','Settings\RolesController@handleRolesDelete');
    Route::any('/handleWorkorderDelete','Workorder\WorkorderController@handleWorkorderDelete');
    Route::any('/handleWorkorderTypeDelete','Workorder\WorkorderController@handleWorkorderTypeDelete');
    Route::any('/handleSaveWorkorderType','Workorder\WorkorderController@handleSaveWorkorderType');
    Route::any('/handleUpdateWorkorderType','Workorder\WorkorderController@handleUpdateWorkorderType');

    Route::any('/handleResetTimer','Attendance\AttendanceController@handleResetTimer');
    Route::any('/setAttendanceTimer','Attendance\AttendanceController@setAttendanceTimer');
    Route::any('/handleClockIn','Attendance\AttendanceController@handleClockIn');
    Route::any('/handleClockOut','Attendance\AttendanceController@handleClockOut');
    Route::any('/handleBreak','Attendance\AttendanceController@handleBreak');

});


Route::get('menus','MenuController@index');

Route::get('menus-show','MenuController@show');

Route::post('menus','MenuController@store')->name('menus.store');



