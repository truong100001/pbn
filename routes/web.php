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

Route::get('/','HomeController@index');

Route::get('/add-domain','HomeController@addDomain');
Route::post('/add-domain','HomeController@postAddDomain');

Route::post('/add-keyword','HomeController@addkeyWord');

Route::get('/check-domain','HomeController@check_domain');

Route::get('/test','HomeController@check_keyword');