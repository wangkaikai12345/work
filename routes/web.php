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


//单点登录授权访问入口
Route::get('/oauth/redirect', 'OAuthController@redirect');
//授权回调地址
Route::get('/oauth/callback', 'OAuthController@callback');

Route::get('/', function () {
    return view('welcome');
});



