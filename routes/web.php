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
// CORS
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::resource('/api/v1/game', 'GameController');

Route::resource('/api/v1/spot', 'SpotController');

Route::resource('/api/v1/group', 'GroupController');

Route::resource('/api/v1/user', 'UserController');
