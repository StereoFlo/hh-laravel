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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', 'Auth\\LoginController@showLoginForm')->name('loginForm');
Route::post('/login', 'Auth\\LoginController@login')->name('loginProcess');

Route::group(['middleware' => 'isAdmin'], function () {
    Route::get('admin/dashboard', 'Admin\\DashboardController@index')->name('admin_dashboard');
    Route::get('admin', 'Admin\\DashboardController@index')->name('admin_index');
    Route::get('admin/users', 'Admin\\UserController@getList')->name('admin_user_list');
    Route::get('admin/users/store', 'Admin\\UserController@store')->name('admin_user_form');
    Route::post('admin/users/store', 'Admin\\UserController@store')->name('admin_user_from_process');
    Route::get('admin/users/store/{id}', 'Admin\\UserController@update')->name('admin_user_from_update');
    Route::post('admin/users/store/{id}', 'Admin\\UserController@update')->name('admin_user_from_update_process');
});
