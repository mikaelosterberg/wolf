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

// Custom register
Route::get('/register','RegisterController@create')->name('register:form');
Route::post('/register','RegisterController@store')->name('register');

// Custom auth
Route::get('/login','AuthController@create')->name('login');
Route::post('/login','AuthController@store')->name('auth');
Route::get('/logout','AuthController@destroy')->name('logout');
Route::get('/me','AuthController@show')->name('me');

// Default password reset.
Route::group(['middleware' => 'guest', 'prefix' => 'password', 'namespace' => 'Auth'], function () {
    Route::post('/email','ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('/reset','ResetPasswordController@reset');
    Route::get('/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
});

// Default password reset.
Route::group(['middleware' => 'guest', 'prefix' => 'password', 'namespace' => 'Auth'], function () {
    Route::post('/email','ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('/reset','ResetPasswordController@reset');
    Route::get('/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
});

// Crud routing the Howl controller
Route::resource('howl', 'HowlController');

// Home controller, placeholder.
Route::get('/home', 'HomeController@index')->name('home');
