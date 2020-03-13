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



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => 'jwt.verify'], function ($router) {
    //List Employers
    Route::get('/allemployers/{limit}','EmployersController@index');
    Route::get('/deleteEmployer/{id}', 'EmployersController@destroy');
    Route::get('/getEmployer/{id}', 'EmployersController@get');
    Route::post('/addEmployer', 'EmployersController@add');
    Route::post('/editEmployer/{id}', 'EmployersController@Edit');
    Route::get('/empCompany/{id}','EmployersController@EmpCompany');
    Route::post('/addEmployersSpead','EmployersController@AddSpead');
    Route::post('/getsNgayLvNv', 'EmployersController@getsNgayLvNv');
    Route::post('/demoPost','EmployersController@demoPost');

    //List CaLam
    Route::resource('/CaLam','CaLamController');
    Route::post('/addCalam','CaLamController@add');
    Route::get('/CalamID/{id}','CaLamController@getcalam');
    Route::post('/editCalam/{id}', 'CalamController@editCalam');
    Route::post('/countCaLam','CaLamController@countCalam');
    Route::post('/editCalamUser', 'CaLamController@editCalamUser');
    Route::post('/delCalam', 'CaLamController@delCalam');

    // /List Company
    Route::resource('/company', 'CompanyController');
    Route::get('/getCompany/{limit}', 'CompanyController@getLimit');
});

//Login
Route::resource('/login','LoginController');







