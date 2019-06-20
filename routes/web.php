<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', 'Auth\\LoginController@showLoginForm')->name('loginForm');
Route::post('/login', 'Auth\\LoginController@login')->name('loginProcess');

Route::group(['middleware' => 'isAdmin'], function () {
    Route::get('admin/dashboard', 'Admin\\DashboardController@index')->name('admin_dashboard');
    Route::get('admin', 'Admin\\DashboardController@index')->name('admin_index');
    Route::get('admin/users', 'Admin\\UserController@getList')->name('admin_user_list');
    Route::get('admin/users/store', 'Admin\\UserController@store')->name('admin_user_form');
    Route::post('admin/users/store', 'Admin\\UserController@store')->name('admin_user_from_process');
    Route::get('admin/users/store/{id}', 'Admin\\UserController@update')->name('admin_user_from_update')->where('id', '[0-9]+');
    Route::post('admin/users/store/{id}', 'Admin\\UserController@update')->name('admin_user_from_update_process')->where('id', '[0-9]+');
    Route::get('admin/users/remove/{id}', 'Admin\\UserController@remove')->name('admin_user_remove')->where('id', '[0-9]+');
    Route::any('admin/weather/add_city', 'Admin\\WeatherController@addCity')->name('admin_weather_add_city');
    Route::get('admin/weather/delete_city/{id}', 'Admin\\WeatherController@deleteCity')->name('admin_weather_delete_city')->where('id', '[0-9]+');
    Route::get('admin/weather', 'Admin\\WeatherController@getList')->name('admin_weather_list');
    Route::get('admin/weather/{id}', 'Admin\\WeatherController@show')->name('admin_weather_show')->where('id', '[0-9]+');
});
