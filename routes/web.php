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
    return view('index');
});

Route::get('/', 'TopController@index');

Auth::routes();

Route::resource('sticker', 'StickerController');

Route::get('/design/my', 'DesignController@showMyAll');
Route::post('/design/change-public', 'DesignController@changePublicStatus');
Route::resource('design', 'DesignController');


Route::get('twitter/login', 'Auth\TwitterAuthController@login');
Route::get('twitter/auth', 'Auth\TwitterAuthController@auth');
Route::get('twitter/callback', 'Auth\TwitterAuthController@callback');