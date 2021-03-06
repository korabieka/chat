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
	return view('start'); 
})->name('login');

Route::post('chat','UserController@mainChat');
Route::get('chatbox/{userId}','UserController@chatbox')->name('chatbox');
Route::post('sendMsg','ChatController@saveMessage');
Route::post('getChat','ChatController@getChat');
Route::post('getLatestMsg','ChatController@getLatestMsg');
Route::get('logout','UserController@logout');