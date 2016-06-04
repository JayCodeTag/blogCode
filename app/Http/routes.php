<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|iddleware'=>['web']
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=>'admin','namespace'=>'Admin'], function () {

//    Route::get('/', function () {
//        return view('welcome');
//    });

    Route::any('login', 'LoginController@login');
    Route::get('code', 'LoginController@code');
//    Route::get('admin/crypt', 'Admin\LoginController@crypt');
//    Route::get('admin/index', 'Admin\IndexController@index');
//    Route::any('admin/info', 'Admin\IndexController@info');
});

Route::group(['middleware'=>['admin.login'],'prefix'=>'admin','namespace'=>'Admin'], function () {
    Route::get('index', 'IndexController@index');
    Route::get('info', 'IndexController@info');
    Route::get('quit', 'LoginController@quit');
    Route::any('pass', 'IndexController@pass');
    Route::resource('category','CategoryController');
    Route::post('cate/changeorder','CategoryController@changeOrder');
});

