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

Route::get('/', function () {
    return view('welcome');
});


Route::post('sendToken', 'resetPasswordController@sendToken');
Route::post('validateToken', 'resetPasswordController@validateToken');
Route::post('resetPassword', 'resetPasswordController@resetPassword');


// Auth::routes();
//Path nên dược đặt dưới cùng
Route::any('{path}', 'HomeController@index')->where(['path' => '.*']);