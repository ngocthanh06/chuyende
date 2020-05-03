<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These``
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([ 'middleware' => 'api','prefix' => 'auth'], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('user', 'AuthController@user');
});

Route::get('/password_reset/{id}','resetPasswordController@checkResetPassword' );

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => 'jwt.verify'], function ($router) {
    /**
     * Todo Role
     */
    Route::get('/Role','RoleController@all');
    /**
     * Todo List Employers
     */ 
    Route::get('/allemployers/{limit}','EmployersController@index');
    Route::get('/deleteEmployer/{id}', 'EmployersController@destroy');
    Route::get('/getEmployer/{id}', 'EmployersController@get');
    Route::get('/allEmployersDangder/{limit}','EmployersController@allEmployersDangder');
    Route::get('/empCompany/{id}','EmployersController@EmpCompany');
    Route::get('/openCompany/{id}','EmployersController@openCompany');
    Route::post('/addEmployer', 'EmployersController@add');
    Route::post('/editEmployer/{id}', 'EmployersController@Edit');
    Route::post('/addEmployersSpead','EmployersController@AddSpead');
    Route::post('/getsNgayLvNv', 'EmployersController@getsNgayLvNv');
    Route::post('/demoPost','EmployersController@demoPost');
    Route::post('/getsArrUser','EmployersController@getsArrUser');
    Route::post('/getListUser','EmployersController@getListUser');
    Route::post('/delCawhereID','EmployersController@delCawhereID');
    Route::post('/getEmployersByCompany', 'EmployersController@getEmployersByCompany'); 
    Route::post('/getCongNv', 'EmployersController@getCongNv');
    Route::post('/totalCong','EmployersController@totalCong');
    Route::post('/userPerMiss', 'EmployersController@userPerMiss');
     /**
     * Todo List Chức vụ
     */
    Route::resource('/chucvu','chucvuController');
    /**
     * Todo List CaLam
     */
    Route::resource('/CaLam','CaLamController');
    Route::post('/addCalam','CaLamController@add');
    Route::get('/CalamID/{id}','CaLamController@getcalam');
    Route::post('/editCalam/{id}', 'CalamController@editCalam');
    Route::post('/countCaLam','CaLamController@countCalam');
    Route::post('/editCalamUser', 'CaLamController@editCalamUser');
    Route::post('/delCalam', 'CaLamController@delCalam'); 
    /**
     * Todo List Company
     */
    Route::resource('/company', 'CompanyController');
    Route::post('/postEditCompany', 'CompanyController@update');
    Route::get('/getCompany/{limit}', 'CompanyController@getLimit');
    /**
     * Todo workshifts
     */ 
    Route::post('/postWorkshifts','WorkshiftsController@postWorkshifts');
    Route::post('/checkWorkshiftsWhere','WorkshiftsController@checkWorkshiftsWhere');
    Route::post('/diemdanh','WorkshiftsController@diemdanh');
    Route::get('/getWorkshifts/{id}','WorkshiftsController@getWorkshifts');
    Route::post('/workshilftsByformDateUser','WorkshiftsController@workshilftsByformDateUser');
    Route::post('/getsWorkshilftsNV', 'WorkshiftsController@getsWorkshilftsNV');
    /**
     * Todo attendance
     */    
    Route::post('/getAttendanceWhereId','AttendanceController@getAttendanceWhereId');
    Route::post('/getsWorkAttendance','AttendanceController@getsWorkAttendance');
    Route::post('/updateAttendance','AttendanceController@updateAttendance');
    Route::post('/listAttendance', 'AttendanceController@listAttendance');
    Route::post('/checkPhep', 'AttendanceController@checkPhep');
    Route::post('/createPhep', 'AttendanceController@createPhep' );
    Route::post('/getsPhepNV', 'AttendanceController@getsPhepNV');

    /**
     * Todo prepayment
     */ 
    Route::resource('/prepayment', 'PrepaymentController');
    Route::post('/checkPrepay','PrepaymentController@checkPrepay');
    Route::post('/loadPrepayment','PrepaymentController@loadPrepayment');
    Route::get('/editStatus/{id}', 'PrepaymentController@editStatus');
    Route::post('/listAll','PrepaymentController@listAll');
    /**
     * Todo permission
     */ 
    Route::post('/checkIssetPermission','permissionController@checkIssetPermission');
    Route::post('/listLuongNV/{limit}', 'permissionController@listLuongNV');
    Route::post('/addLuong','permissionController@addLuong');
    Route::post('/thongke','permissionController@thongke');
    Route::post('/luongNV', 'permissionController@luongNV');
    /**
     * Todo Demo
     */ 
    Route::get('/getIp','HomeController@getIp');

    /**
     * Todo Thong ke
     */
    Route::post('/loadthongke', 'ThongkeController@loadthongke');
});
    /**
     * Todo Login
     */ 
Route::resource('/login','LoginController');







