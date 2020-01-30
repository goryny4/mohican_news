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

Route::resource('/', 'NewsController')->only([
    'index'
]);

Route::resource('/news', 'NewsController')->only([
    'show'
]);


Route::resource('/manager', 'ManagerController');
