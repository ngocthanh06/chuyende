<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//List Employers
Route::get('/allemployers/{limit}','EmployersController@index');
Route::get('/deleteEmployer/{id}', 'EmployersController@destroy');
Route::get('/getEmployer/{id}', 'EmployersController@get');
Route::post('/addEmployer', 'EmployersController@add');
Route::post('/editEmployer/{id}', 'EmployersController@Edit');
