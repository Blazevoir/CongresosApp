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

Route::get('/', 'IndexController@index');

Auth::routes(['verify' => true]);
Route::resource('ponencia', 'PonenciaController')->middleware('auth');
Route::resource('userponencia', 'UserPonenciaController')->middleware('auth','UserPagadoVerificado');
Route::resource('congreso', 'CongresoController');

Route::get('/verify/{usertoken?}', 'VerifyController@verify');
Route::post('/resetpassword','IndexController@resetPassword');
Route::post('/update','IndexController@updateUser')->middleware('auth');
Route::get('/home', 'HomeController@index')->middleware('auth');

Route::get('/listausers','IndexController@listausers');
Route::post('/hacerponente','IndexController@hacerponente')->middleware('auth');
